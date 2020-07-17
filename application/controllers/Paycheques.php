<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

//require_once('PHPMailerAutoload.php');
class Paycheques extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();


        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        $this->gen->checkLogin();

        //$this->load->library('PHPMailerfunction');

        $putNewSession = $this->users->checkUserSession($_SESSION['email']);
        if ($putNewSession === FALSE) {
            redirect(base_url() . "nopriveledge");
        }
    }

    public function index() {
        redirect(base_url());
    }
    
    
    
    
   

    public function payotherchequebranchonly() {

        $title = "EXPENSE PRO :: HOMEPAGE";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $getAccountID = $this->adminmodel->getuserID($_SESSION['email']);
        //get all the groups accoutn from the datatbase
        $getallgroupdaccount = $this->mainlocation->getmainaccount();
        
        $accgroupPH = $this->cashiermodel->actgrouporthaourt() ? $this->cashiermodel->actgrouporthaourt() : "";
        
        //echo $userid = assetregisteruserid($accgroupPH);
       
        // Get Uuser Access and determin Which view to load
        $getuseridfromhere = $this->gen->haveAccess($_SESSION['id'], $accgroupPH);
       
        $getUserLocation = $this->cashiermodel->getuserlocation($_SESSION['email']);
        $mySessionEmail = $_SESSION['email'];
        if ($getuseridfromhere) {
            
            $getallresult = $this->cashiermodel->getbygroupid();
            /*
            $getallresult = $this->mainlocation->getaccoutpayment($mySessionEmail);
                $getAccountID = $this->adminmodel->getuserID($mySessionEmail);
                $getallgroupdaccount = $this->mainlocation->getmainaccount();
                 if($getallgroupdaccount){
                    foreach ($getallgroupdaccount as $get){
                          $dAccountgroup = $get->dAccountgroup;
                   
                   //Use the result to check if the userid is in the array
                    $checkcash_groupaccount = $this->mainlocation->cashgroup($dAccountgroup);
                    
                    $kaboom = explode(",", $checkcash_groupaccount);
                    
                     if(in_array($getAccountID, $kaboom)){
                         $getallresult = $this->mainlocation->getpaymentnow($dAccountgroup);
                         //var_dump($getallresult);
                     }else{
                        $getallresult = "";
                     }
                }
                
             } */
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel,  'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('chequerequestforotherlocations', $values);
        } else {
            echo "you do not have access to this page, please contact IT";
        }
    }
    
    
    
    
    public function preparecheque($id, $md5_id, $approvals) {
        $this->load->model('maintenance');
        $title = "EXPENSE PRO :: HOMEPAGE";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $getAccountID = $this->adminmodel->getuserID($_SESSION['email']);
        
        $sessionID = $_SESSION['id'];
        //$getUserLocation = $this->cashiermodel->getuserlocation($_SESSION['email']);
        $accgroupPH = $this->cashiermodel->actgrouporthaourt() ? $this->cashiermodel->actgrouporthaourt() : "";
        $getuseridfromhere = $this->gen->haveAccess($_SESSION['id'], $accgroupPH);
                     
        if ($getApprovalLevel == 4 || $getApprovalLevel == 6 || $getApprovalLevel == 7 || $getuseridfromhere || 
                $sessionID == 206) {
            
            $getallresult = $this->cashiermodel->chequereadyprepare($id, $md5_id, $approvals);
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            //$this->load->view('preparechequeforsigning', $values);
            $this->load->view('preparechequeforsigningpt', $values);
        } else {
           $this->load->view('noaccessview');
        }
    }
    
   
    
    
    public function confirmchequerequestnownow (){
     
     $data = [];
     if(isset($_POST['transactID'])){
         
       // $chequeDate = $this->input->post('chequeDate', TRUE);
        $payee = $this->input->post('payee', TRUE);
        $mainAount = $this->input->post('mainAount', TRUE);
        $getBank = $this->input->post('getBank', TRUE);
        $chequeNo = $this->input->post('chequeNo', TRUE);
        $transactID = $this->input->post('transactID', TRUE);
        $acctGroup = $this->input->post('acctGroup', TRUE);
        $chequeDate = $this->input->post('chequeManualDate', TRUE);
        $partAmount = $this->input->post('partAmount', TRUE);
        
        $getAmount = $this->adminmodel->getpaymentamount($transactID);
        
        
        //For Dollar and Other Currencies
         $CurrencyAmount = isset($_POST['CurrencyAmount']) ? ($_POST['CurrencyAmount'] * $getAmount) : '0.00';
         $CurrencyType = isset($_POST['CurrencyType']) ? $this->input->post('CurrencyType', TRUE) : '0.00';
          
         
        //echo $getAmount. "<br/>";
        //echo $mainAount;
         if($transactID == "" || $chequeDate == ""){
           $data = ['warr'=>'Please make sure all fields are field<br/>'];  
         }else
         
         if($getAmount !== $mainAount){
            $data = ['warr'=>'There is a difference in Amount. Please Check details again. Something is wrong<br/>'];    
         }else if($partAmount > $mainAount){
             $data = ['warr'=>'Part Payment cannot be greater than amount<br/>'];    
         }else{
             
          // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod)
         //approve = 3(approved by ICu), approve = 4 (Cheque Ready for Collection) , approve = 5(Rejected)
         // approve == 7 (Cheque sent for signature)
         $approve = '8'; // Signed and Approved
         $sessionID = $_SESSION['email'];
         $getSessEmail = $this->mainlocation->getuserSessionEmail($sessionID);
             if($getSessEmail){
                foreach($getSessEmail as $get){
                     $uid = $get->id;
                     $fname = $get->fname;
                     $lname = $get->lname;
                     $fullname = $fname.' '.$lname;
                }
            }
         $type = "cheque";    
         


        //($assetID, $paidTo, $dDate, $sessionID, $uid, $tillID, $tillType, $cashierEmail);
         $makedpaymebnt = $this->mainlocation->chequesentforpayment($transactID, $payee, $chequeDate, $sessionID, $uid, $chequeNo, $type, $getBank);
         
         
         //This is for summary report and i will like to have an idea of what it does
         $updateothernewrequestable = $this->mainlocation->updateothertable($transactID, $chequeDate, $sessionID);
         
         
         //Use the Request ID to Update the Table
         $updatrequestTable = $this->mainlocation->daccountwhopays($transactID, $sessionID, $approve, $partAmount, $chequeDate);
         
         if(isset($_POST['CurrencyAmount'])){
           $converstionRate = $this->input->post('CurrencyAmount', TRUE);
          $forConvertedCurrency = $this->mainlocation->updateconvertedcurrency($transactID, $CurrencyAmount, $converstionRate); 
         }
      
         
          //Use the asset ID to return the Email of the Person that sends the request
         $getEmailofOwner = $this->mainlocation->emailownerrequest($transactID);
         
         //The Description of Item
         $getDescription = $this->mainlocation->descriptionofitem($transactID);
         
         
         ///////////////////BEGINNING INSTALLING INTO SUPER ACCOUNTANT ////////////////////////////////
          $myurl = mycustom_url();
          $appID = "01"; // 01 === PETTY CASH  02 == MAINTENANCE
          $getUserLocation = $this->users->getLocationEmail($_SESSION['email']);
          $getUserUnit = $this->users->getUnit($_SESSION['email']);
          $dUserID = $this->adminmodel->getuserID($_SESSION['email']);
          $approval = "1";
          $getTillName = ""; 
          $requesterEmail = $this->accounting->emailownerrequesta($transactID);
          
          $addTotal = $this->mainlocation->addtoaccountpayable($type, $acctGroup, $getTillName, $myurl, $getUserLocation, $getUserUnit, $appID, $transactID, $makedpaymebnt, $dUserID, $mainAount, $approval, $requesterEmail, $payee, $sessionID, $chequeNo="", $getBank, $partAmount, $chequeDate);
          
          $runDateupdate = $this->mainlocation->updatemanualdate($addTotal, $chequeDate);
         //////////////////END OF INSTALLING INTO SUPER ACCOUNTANT ///////////////////////////////////
          $randomNumpartPay = random_string('alnum', 15);
          if($partAmount != ""){
            $partialPayAmount =  $partAmount;
            $doPartpayment = $this->mainlocation->dopartpayment($transactID, $randomNumpartPay, $partialPayAmount, $requesterEmail, $getBank, $chequeNo, $sessionID);
           }else{
               $doPartpayment = "";
               $partialPayAmount =  $getAmount;
           }
           
          //Audit Trail
         $updatedBy = "Account Approval - $sessionID, time: ". date('Y-m-d H:i:s'). "<hr/>";
          
         $createdby = "Approved by Accountant - $sessionID, time: ". date('Y-m-d H:i:s'). "<hr/>";
         $updateAuditTrail= $this->mainlocation->updatedupdatetrail($updatedBy, $createdby, $transactID);
          
             ////////////////***************DO WORK FOR ASSET MGT *************************////////////////////////////
         //Return the from_app_id NOTE: Asset Mgt is "2"
          $fromAssetmgt = $this->adminmodel->myuniqueappid($transactID);
           //Return the request id to update the maintenance table
          $returnupdateIDforacccest = $this->adminmodel->assetrequestid($transactID);
         
          
         if($fromAssetmgt == 9){
             $assetsessionID = $this->session->id;
             $assetsessionEmail = $this->session->email;
             $hComment = "Payments Approved by ". $assetsessionEmail . "Time ". date('Y-m-d');
             $dStatus = '7'; // Paid
             echo $assetResult =  $this->adminmodel->paymaintenancevendor($returnupdateIDforacccest, $dStatus, $fullname);
             echo "<br/>";
             echo $returnupdateIDforacccest;
             return;
         }
         
         if($fromAssetmgt == 6){
             $assetsessionID = $this->session->id;
             $assetsessionEmail = $this->session->email;
             $hComment = "<br/>Payment approved by ". $assetsessionEmail;
             $documentationapproval = "paid";
             $assetResult =  $this->adminmodel->documentationaccount($returnupdateIDforacccest, $documentationapproval, $assetsessionEmail, $updatedBy);
         }
         ////////////////***************END OF DO WORK FOR ASSET MGT *************************////////////////////////////
         
         
         
           //////////////////////*****************TRAVE START LOADS HERE ********************///////////////////////
          $this->load->model('travelmodel');	 
          // Use the ID to return the return enumType 
            $getenumType = $this->travelmodel->getnumType($transactID);
          // if enumType == travel, then return the travelID
            if($getenumType == 'travel'){
             // Use the travel ID to update the request in travel Start
             $getTravelID = $this->travelmodel->getTravelID($transactID);
             //Run Travel ID Update change status to 
             // 0 -- waiting approval  1-- approved and sent to HOD  2-- rejected
             // HOD and ICU approved = '3', Account Awaiting = '4' , Paid = '5'
             //Update the paymentType - for travelstart Table
             $approval = '5';
             $doUpdate = $this->travelmodel->makedoUpdate($approval, $getTravelID, $sessionID);
             $comment = "<br/>Approved By $sessionID  time ". date('Y-m-s H:i:s');
             $doauditTrail = $this->travelmodel->runauditTrail($comment, $getTravelID);
             
            //Update the reimbursement part to 2
            $doReimbursement = $this->travelmodel->doreimbursement($getTravelID);
            
            //Get my Result
            $getMyresult = $this->travelmodel->getmoredetails($getTravelID);
             if($getMyresult){
                 foreach($getMyresult as $devM){
                     $mytravelID = $devM->id;
                     $staffName = $devM->staffName;
                     $dateCreated = $devM->dateCreated;
                     $dCurrency = $devM->dCurrency;
                     $dAccountgroup = $devM->dAccountgroup;
                     $staffEmail = $devM->staffEmail;
                     $staffID = $devM->staffID;
                     $unit = $devM->unit;
                     $location = $devM->location;
                     $sTotal = $devM->sTotal;
                     $paymentType = $devM->paymentType;
                     
                     $title = "Travel expense for". $staffName;
                 }
             }
            //Use the ID to insert it into account recievables
            $travelInsertRequest = $this->travelmodel->insercashrecievables($dateCreated, $paymentType, $mytravelID, $title, $staffName, $dCurrency, $dAccountgroup, $staffID, $staffEmail, $location, $unit, $sTotal);

            }
          
           //////////////////////*****************TRAVE START LOADS HERE ********************///////////////////////

         //////////////////////////// PROCUREMENT FEEDBACK //////////////////////////////////////////////////
         if($fromAssetmgt == 3){
             //$audit = "Payment Approved By $sessionID". date('Y-m-d H:i:s'); 
             //Audit Trail
         $updatedBy = "Payment Approved By $sessionID". date('Y-m-d H:i:s');
         $createdby = "Approved by Accountant - $sessionID, time: ". date('Y-m-d H:i:s');
         $procurementUpdate= $this->generalmd->procureupdate($updatedBy, $createdby, $returnupdateIDforacccest);
         }
        //////////////////////////END OF PROCUREMNT FEED BACK ///////////////////////////////////////////
        
        //$getbenName = $this->mainlocation->getbenefiaciaryName($transactID);
           $datePaidNow = date("Y-m-d H:i:s");
         $url = base_url();
         
         if($url !== "http://localhost/moneybook/"){
            if($getEmailofOwner && $addTotal){

                  $message = "<p> Your request for payment with the description is ready for collection</p> ";
                $message .= "<div style='width:500px;  padding:10px; border:1px solid #adaaa9'><div><b> Request Title: ".$getDescription." </b></div> ";
                $message .= "<div><b> Amount: ".@number_format($partialPayAmount, 2)."</b></div>";
                $message .= "<div><b> Requester Email: ".$getEmailofOwner." </b></div>";
                $message .= "<div><b> Beneficiary: ".$payee." </b></div>";
                $message .= "<div><b> Paid By: ".$sessionID." </b></div>";
                $message .= "<div><b> Date Paid: ".$datePaidNow." </b></div>";
                $message .= "<div><b> Account Group: ".$acctGroup." </b></div>";
                $message .= "<div><b> Request ID: ".$transactID." </b></div></div>";
                $message .= "<p></p>";
                $message .= "<small>This is an automatically generated email, please do not reply.</small>";

                  $fromEmail = "expensepro@c-iprocure.com";

                  $config = array(
                       'mailtype' => "html",
                   );

                  $this->email->initialize($config);
                  $this->email->from($fromEmail, 'TBS EXPENSE PRO'); 
                  $this->email->to($getEmailofOwner);
                  $this->email->bcc("victor.ogiogio@c-ileasing.com, abiodun.adetayo@c-ileasing.com");
                  $this->email->subject('CHEQUE REQUEST FOR PAYMENT :: PAYMENT APPROVED'); 
                  $this->email->message($message); 
                  $this->email->send();

              }
         }   
         
         $accgroupPH = $this->cashiermodel->actgrouporthaourt() ? $this->cashiermodel->actgrouporthaourt() : ""; 
        $accgroupABJ = $this->cashiermodel->actgroupabuja() ? $this->cashiermodel->actgroupabuja() : "";
        $accgroupMUSHIN = $this->cashiermodel->actgroupmushin() ? $this->cashiermodel->actgroupmushin() : "";
        $accgroupHERTZ = $this->cashiermodel->actgrouphertz() ? $this->cashiermodel->actgrouphertz() : "";
       
         $dAccess = $this->gen->haveAccess($_SESSION['id'], $accgroupABJ);
         $dAccess2 = $this->gen->haveAccess($_SESSION['id'], $accgroupPH);
         $dAccess3 = $this->gen->haveAccess($_SESSION['id'], $accgroupMUSHIN);
         $dAccess4 = $this->gen->haveAccess($_SESSION['id'], $accgroupHERTZ);
         
         if($dAccess){
             $link = "paycheques/payotherchequebranchonlyforabuja";
         }else if($dAccess2){
              $link = "paycheques/payotherchequebranchonly";
         }else if($dAccess3){
             $link = "paycheques/payotherchequebranchonlyformushin"; 
         }else if($dAccess4){
             $link = "paycheques/paychequehertz"; 
         }else{
            //$link = "home/myapproval"; 
             $link = "accounts/index"; 
         }
         
         if($makedpaymebnt && $updatrequestTable){
             $data = ['msg'=>'Cheque Successfully successfully prepared for signature<br/>', 'newlink'=>$link];
         }
         
        }
     }
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
 
 
 
    public function mytransaction(){
        $title = "EXPENSE PRO :: MY TRANSACTIONS";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $getAccountID = $this->adminmodel->getuserID($_SESSION['email']);
                     
       
       // if ($getApprovalLevel == 4 || $getApprovalLevel == 6 || $getuseridfromhere) {
            
            if($getApprovalLevel == 6){
              //$getallresult = $this->cashiermodel->getpaidbymeadmin(); 
              $getallresult = $this->generalmd->getdresult("*", "cash_newrequestdb", "", "");
            }else{
              //$getallresult = $this->cashiermodel->getpaidbyme($_SESSION['email']);
              //$getallresult = $this->generalmd->getdresult("*", "cash_newrequestdb", "dCashierwhopaid", $_SESSION['email']);
              $getallresult = $this->generalmd->getresultwithand("*", "cash_newrequestdb", "dCashierwhopaid", $_SESSION['email'], "nPayment", "2");
            }
           
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            //$this->load->view('allmytransactionipaid', $values);
            $this->load->view('2019/dyanmicviewlater', $values);
       // } 
    }
    
    
    
   //////////////////////////////////////PAY CHEQUE FOR ABUJA /////////////////////////////////////////////////////////
     public function payotherchequebranchonlyforabuja() {

        $title = "EXPENSE PRO :: HOMEPAGE";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $getAccountID = $this->adminmodel->getuserID($_SESSION['email']);
        //get all the groups accoutn from the datatbase
        $getallgroupdaccount = $this->mainlocation->getmainaccount();
        
        $accgroupABJ = $this->cashiermodel->actgroupabuja() ? $this->cashiermodel->actgroupabuja() : "";
        
        //echo $userid = assetregisteruserid($accgroupPH);
       
        // Get Uuser Access and determin Which view to load
        $getuseridfromhere = $this->gen->haveAccess($_SESSION['id'], $accgroupABJ);
       
        $getUserLocation = $this->cashiermodel->getuserlocation($_SESSION['email']);
        $mySessionEmail = $_SESSION['email'];
        if ($getuseridfromhere) {
            
            $getallresult = $this->cashiermodel->getbygroupidabj();
          
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel,  'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('chequerequestforotherlocations', $values);
        } else {
            echo "you do not have access to this page, please contact IT";
        }
    }
    
    
    
     //////////////////////////////////////PAY CHEQUE FOR ABUJA /////////////////////////////////////////////////////////
     public function payotherchequebranchonlyformushin() {

        $title = "EXPENSE PRO :: HOMEPAGE";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $getAccountID = $this->adminmodel->getuserID($_SESSION['email']);
        //get all the groups accoutn from the datatbase
        $getallgroupdaccount = $this->mainlocation->getmainaccount();
        
        $accgroupMUSHIN = $this->cashiermodel->actgroupmushin() ? $this->cashiermodel->actgroupmushin() : "";
       
        // Get Uuser Access and determin Which view to load
        $getuseridfromhere = $this->gen->haveAccess($_SESSION['id'], $accgroupMUSHIN);
       
        $getUserLocation = $this->cashiermodel->getuserlocation($_SESSION['email']);
        $mySessionEmail = $_SESSION['email'];
        if ($getuseridfromhere) {
            
            $getallresult = $this->cashiermodel->getbygroupidmushin();
          
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel,  'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('chequerequestforotherlocations', $values);
        } else {
            echo "you do not have access to this page, please contact IT";
        }
    }
    
    
    
    
    
    
     //////////////////////////////////////PAY CHEQUE FOR ABUJA /////////////////////////////////////////////////////////
     public function makenormalpaymentforuser() {

        $title = "EXPENSE PRO :: HOMEPAGE";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $getAccountID = $this->adminmodel->getuserID($_SESSION['email']);
       
       $accgroupADMINFLOAT = $this->cashiermodel->getadminfloat() ? $this->cashiermodel->getadminfloat() : "";
       
        // Get Uuser Access and determin Which view to load
        $getuseridfromhere = $this->gen->haveAccess($_SESSION['id'], $accgroupADMINFLOAT);
       
        $mySessionEmail = $_SESSION['email'];
        if ($getuseridfromhere) {
           
            $getallresult = $this->cashiermodel->getadminfloatfromgroup();
            //$getallresult = $this->cashiermodel->getmaintenancenotpetty($_SESSION['email']); 08172007242
          
            
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getuseridfromhere'=>$getuseridfromhere, 'getApprovalLevel' => $getApprovalLevel,  'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('floatrequest', $values);
        } else {
            echo "you do not have access to this page, please contact IT";
        }
    }
    
    
    
    public function printrequestdetailsbymaintenance($id){
      
      if($id){
                $title = "Petty Cash Pro :: C & ILeasing Plc";
               $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
                $accgroupADMINFLOAT = $this->cashiermodel->getadminfloat() ? $this->cashiermodel->getadminfloat() : "";
       
                // Get Uuser Access and determin Which view to load
                $getuseridfromhere = $this->gen->haveAccess($_SESSION['id'], $accgroupADMINFLOAT);
               if($getuseridfromhere){
                //$get all Reesult 
                $getallresult = $this->mainlocation->getdexactresultfromdb($id);

                $values = ['title' => $title, 'getallresult'=>$getallresult];
                $this->load->view('printrequestdetailcheque', $values);
               }
                
    
        } else {
            redirect(base_url());
        }
  }
  


 public function adminmaintenanceapprovaluser($id, $md5_id, $approvals) {

        $title = "EXPENSE PRO :: HOMEPAGE";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $getAccountID = $this->adminmodel->getuserID($_SESSION['email']);
        $accgroupADMINFLOAT = $this->cashiermodel->getadminfloat() ? $this->cashiermodel->getadminfloat() : "";
       
        // Get Uuser Access and determin Which view to load
        $getuseridfromhere = $this->gen->haveAccess($_SESSION['id'], $accgroupADMINFLOAT);
        //$getUserLocation = $this->cashiermodel->getuserlocation($_SESSION['email']);
        
        if ($getApprovalLevel == 1 && $getuseridfromhere) {
            
            $getallresult = $this->cashiermodel->chequereadyprepare($id, $md5_id, $approvals);
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('adminchequeforsigning', $values);
        } else {
            echo "you do not have access to this page, please contact IT";
        }
    }  

    
 
public function makedpaymentnotillforadmin(){
     $approve = "";
     $data = [];
     if(isset($_POST['transactID'])){
         
         $transactID = $this->input->post('transactID', TRUE);
         $nPaymentTypes = $this->input->post('nPaymentTypes', TRUE);
         $dAmount = $this->input->post('dAmount', TRUE);
         $payee = $this->input->post('payee', TRUE);
        
         //Use the id to return the email of the person who made the request
         $madeprequestemail = $this->adminmodel->maderequestbyme($transactID);
         
         //Use the id to return the email of the person who made the request
         $madeapprovals = $this->mainlocation->returnformrequest($transactID);
         
         if($transactID == "" || $dAmount == ""){
           $data = ['warr'=>'Please make sure all fields are field'];  
         }
         
        /* if($nPaymentTypes == 1 && $paymentCode !== ""){
          $getUserCode = $this->mainlocation->checkCode($paymentCode, $transactID);
         } */
         //Use the AssetID to get the Amount
         $getpaymentAmount = $this->adminmodel->getpaymentamount($transactID);
        // getcurrenttillbalance($cashierEmail, $tillID)
        
         if ($madeapprovals !== '3'){
             $data = ['warr'=>'Please wait for under ICU to approve']; 
             
         }else{
         
         $approve = '4';
        
         $sessionID = $_SESSION['email'];
         $getSessEmail = $this->mainlocation->getuserSessionEmail($sessionID);
             if($getSessEmail){
                foreach($getSessEmail as $get){
                     $uid = $get->id;
                     $fname = $get->fname;
                     
                }
            }
         $dDate = date('y-m-d');
         $tillID = "";
         $tillType = "no till".' '.$sessionID;
         
         $makedpaymebnt = $this->mainlocation->insertmakepayment($transactID, $payee, $dDate, $sessionID, $uid, $tillID, $tillType, $sessionID);
         
         //Use the Request ID to Update the Table
         $updatrequestTable = $this->mainlocation->dcashierwhopays($transactID, $sessionID, $approve, $tillID, $tillType, $sessionID, $dDate, $madeprequestemail);
         
         //This is for summary report and i will like to have an idea of what it does
         $updateothernewrequestable = $this->mainlocation->updateothertable($transactID, $dDate, $sessionID);
        
        
          //Use the asset ID to return the Email of the Person that sends the request
         $getEmailofOwner = $this->mainlocation->emailownerrequest($transactID);
         
         //The Description of Item
         $getDescription = $this->mainlocation->descriptionofitem($transactID);
         
         $getTillName = "no till.' '.$sessionID";
         
           //////////////////////*****************TRAVE START LOADS HERE ********************///////////////////////
          $this->load->model('travelmodel');	 
          // Use the ID to return the return enumType 
            $getenumType = $this->travelmodel->getnumType($transactID);
          // if enumType == travel, then return the travelID
            if($getenumType == 'travel'){
             // Use the travel ID to update the request in travel Start
             $getTravelID = $this->travelmodel->getTravelID($transactID);
             //Run Travel ID Update change status to 
             // 0 -- waiting approval  1-- approved and sent to HOD  2-- rejected
             // HOD and ICU approved = '3', Account Awaiting = '4' , Paid = '5'
             //Update the paymentType - for travelstart Table
             $approval = '5';
             $doUpdate = $this->travelmodel->makedoUpdate($approval, $getTravelID, $sessionID);
             $comment = "<br/>Approved By $sessionID  time ". date('Y-m-s H:i:s');
             $doauditTrail = $this->travelmodel->runauditTrail($comment, $getTravelID);

            }
          
           //////////////////////*****************TRAVE START LOADS HERE ********************///////////////////////

          $updatefortillname = $this->mainlocation->updatewithtillname($transactID, $getTillName);
         $datePaidNow = date("Y-m-d H:i:s");
         
            if($getEmailofOwner){
                 
                $message = "<p> Your request for payment with the description is ready for collection</p> ";
                $message .= "<div style='width:500px; padding:10px; border:1px solid #adaaa9'><div><b> Request Title: ".$getDescription." </b></div> ";
                $message .= "<div><b> Amount: ".@number_format($dAmount, 2)."</b></div> ";
                $message .= "<div><b> Requester Email: ".$getEmailofOwner." </b></div> ";
                $message .= "<div><b> Beneficiary: ".$payee." </b></div> ";
                $message .= "<div><b> Paid By: ".$sessionID." </b></div> ";
                $message .= "<div><b> Date Paid: ".$datePaidNow." </b></div>";
                $message .= "<div><b> Request ID: ".$transactID." </b></div>";
                
                $message .= "<div><b> NOTE: PAYMENT MADE BY ADMIN </b></div></div> ";
                $message .= "<p></p> ";
                
                $message .= "<small>This is an automatically generated email, please do not reply.</small>";
                
                $fromEmail = "expensepro@c-iprocure.com";
                
                $config = array(
                     'mailtype' => "html",
                 );

                $this->email->initialize($config);
                $this->email->from($fromEmail, 'TBS EXPENSE PRO'); 
                $this->email->to($getEmailofOwner);
                $this->email->bcc("victor.ogiogio@c-ileasing.com, abiodun.adetayo@c-ileasing.com");
                $this->email->subject('REQUEST FOR PAYMENT'); 
                $this->email->message($message); 
                $this->email->send();
                            
               
                
            } 
           
         
         if($makedpaymebnt && $updatrequestTable){
             $data = ['msg'=>'Payment Successfully Made'];
         }
         
         //Use it to send an email to everybody in ICU
         }
         
         
     } // End of if Isset
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
   

 public function mytransactionformaint(){
        $title = "EXPENSE PRO :: MY TRANSACTIONS";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $getAccountID = $this->adminmodel->getuserID($_SESSION['email']);
        
        //$getUserLocation = $this->cashiermodel->getuserlocation($_SESSION['email']);
        
        if ($getApprovalLevel == 1) {
            
               $getallresult = $this->mainlocation->dcashiersdetailsfromsuperaccount($_SESSION['email']);
           
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('maintenancetransact', $values);
        } else {
            echo "you do not have access to this page, please contact IT";
        }
    }
    
    
    
    
     public function partpaymentdetails($id=""){
        $title = "EXPENSE PRO :: VIEW PART PAYMENT DETAILS";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        
        if ($getApprovalLevel == 6 || $getApprovalLevel == 7 || $getApprovalLevel == 4) {
            
            $getallresult = $this->mainlocation->getpartpaydetailstoview($id);
           
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'myid'=>$id, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('partpaydetails', $values);
        } else {
            $this->load->view('noaccesstoview');
        }
    }
    
    
    
    
    
      public function paychequehertz() {

        $title = "EXPENSE PRO :: HOMEPAGE";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $getAccountID = $this->adminmodel->getuserID($_SESSION['email']);
        //get all the groups accoutn from the datatbase
        $getallgroupdaccount = $this->mainlocation->getmainaccount();
        
        $accgroupHERTZ = $this->cashiermodel->actgrouphertz() ? $this->cashiermodel->actgrouphertz() : "";
        
        //echo $userid = assetregisteruserid($accgroupPH);
       
        // Get Uuser Access and determin Which view to load
        //$getuseridfromhere = $this->gen->haveAccess($_SESSION['id'], $accgroupHERTZ);
       
        $getUserLocation = $this->cashiermodel->getuserlocation($_SESSION['email']);
        $mySessionEmail = $_SESSION['email'];
        if ($accgroupHERTZ == 368) {
            
            $getallresult = $this->cashiermodel->getbygroupidhertz();
          
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel,  'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('chequerequestforotherlocations', $values);
        } else {
            echo "you do not have access to this page, please contact IT";
        }
    }
    
    
}

// End of Class Home
