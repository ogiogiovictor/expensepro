<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
class Action extends CI_Controller {

	/**
	 * Name : Ogiogio Victor
	 * Phone : 07038807891
	 */
    
    public function __construct() {
        parent::__construct(); 
		
		
        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle'=>$pageTitle];
        $this->load->view('header', $values);
	$this->gen->checkLogin();
		
	$putNewSession = $this->users->checkUserSession($_SESSION['email']);
            if($putNewSession === FALSE){
		redirect("https://c-iprocure.com/expensepro/nopriveledge");
	}
         
      
      
    }   
    
    
	public function index()
	{
          redirect(base_url());
	}
        
        
    public function approvecashamount(){
            $session = $_SESSION['email'];
            if(isset($_POST["action"]) && $_POST['action'] == "approve_id"){
			
            $id = $this->input->post('aid', TRUE);
           
            //Empty Check
            if($id == "" ){
		echo "empty_id";
		exit();
            }
            //Use the id to return the Category and insert into Databse
            $getResult = $this->adminmodel->getTillresult($id);
            if($getResult){
                
                foreach($getResult as $get){
                        $tillid = $get->id;
                        $userID = $get->userID;
                        $Amount = $get->Amount;
                        $fmrequestID = $get->fmrequestID;
                        $tillName = $get->tillName;
               }
                
                
            $approval = '1';
            $datetime = date('Y-m-d');
            //Use id to approve the amout                    //($tillAmount, $id, $approval, $session, $datetime);
            $trulyupdated = $this->adminmodel->approvecashierstill($Amount, $id, $approval, $session, $datetime);
            $newapproval = '2'; // for cashiers till request not application for accountant
            $mainaccountapproval = '8'; //Cheque signed and ready for collection only applicable for accountants
            
           $implodeid = explode(",", $fmrequestID);
            //print_r($implodeid);
            //
            //Now we will do a foreach loop to loop through those values and update
              foreach($implodeid as $key => $value) {
                
               $allSelected[] = $value;
               
               //Update record where the id = $value
               $runUpdatefornewrequest = $this->adminmodel->updatewithid($mainaccountapproval, $newapproval, $session, $value);
               
              }
            
             // for approval of till 0 - cashier has sent request 1 = it has been approved = 2 - it was not approved
            if($trulyupdated == TRUE && $tillName !== ""){
                //Use the cashiers id to return tillAmount, balance and expense
                $getcashiertillcurrentdetails = $this->adminmodel->getcashiertilldetails($userID);
                if($getcashiertillcurrentdetails){

                    foreach($getcashiertillcurrentdetails as $get){

                        $cahsierTillID = $get->cahsierTillID;
                        $oldtillAmount = $get->tillAmount;
                        $tillBalance = $get->tillBalance;

                    }
                        $newtillTotalAmount = $oldtillAmount + $Amount;
                        $newtillBalance = $tillBalance + $Amount;
                     
                       //Update the till Table
                       $tillTableUpdate = $this->adminmodel->addTillamounttogeter($userID, $tillName, $newtillTotalAmount, $newtillBalance);

                }
            
            }
            
              if($trulyupdated){
		echo "amount_approve";
                    exit();
                }
            
            } // if($getTillAmount){
            
           } //if(isset($_POST["action"]) && $_POST['action'] == "approve_id"){
        }
        
        
        
    public function requestamountnotapproved(){
            $session = $_SESSION['email'];
            if(isset($_POST["action"]) && $_POST['action'] == "notapprove_id"){
			
            $id = $this->input->post('aid', TRUE);
           
            //Empty Check
            if($id == "" ){
		echo "empty_id";
		exit();
            }
            //Use the id to return the Category and insert into Databse
            $getTillAmount = $this->adminmodel->getTillresult($id);
            if($getTillAmount){
                
                foreach($getTillAmount as $get){
                        $tillid = $get->id;
                        $cashierID = $get->cashierID;
                        $tillAmount = $get->tillAmount;
                        $fmrequestID = $get->fmrequestID;
                }
            
            $newtillAmount = "0";
            $approval = '2';
            $datetime = date('Y-m-d');
            //Use id to approve the amout
            // for approval of till 0 - cashier has sent request 1 = it has been approved = 2 - it was not approved
            $trulyupdated = $this->adminmodel->approvecashierstill($newtillAmount, $id, $approval, $session, $datetime);
            $newapproval = '3';
            
           $implodeid = explode(",", $fmrequestID);
            //print_r($implodeid);
            //
            //Now we will do a foreach loop to loop through those values and update
              foreach($implodeid as $key => $value) {
                
               $allSelected[] = $value;
               
               //Update record where the id = $value
               $runUpdatefornewrequest = $this->adminmodel->updatewithid($newapproval, $value);
               
              }
              if($trulyupdated){
		echo "disamount_unapprove";
                    exit();
                }
            
            } // if($getTillAmount){
            
           } //if(isset($_POST["action"]) && $_POST['action'] == "approve_id"){
        }    
        
   
 public function addtogroup(){
     
      $sessionEmail = $_SESSION["email"];
      $data = [];
      //$getusergroupresult = [];
      
	if(isset($_POST['dAccountName']) && isset($_POST['dAccountGroup']) ){
			
	// Declaring put putting all variables in Values
	$dAccountName = $this->input->post('dAccountName', TRUE);
        $dAccountGroup = $this->input->post('dAccountGroup', TRUE);
	
        //$changeaccountIDtoarray = explode(",", $dAccountName);
        
        //Return the userid to see if the account is already in that group
        $getusergroupresult = $this->adminmodel->getuseridforgroup($dAccountGroup) ? $this->adminmodel->getuseridforgroup($dAccountGroup) : "0";
        //var_dump($getusergroupresult);
        
        $kaboom = explode(",", $getusergroupresult);
        
        if($dAccountName == "" || $dAccountGroup == ""){
            
             $data = ['msg'=> 'Please make sure you select the group and the accountant'];
        }else 
           
           if(in_array($dAccountName, $kaboom)){
               
             $data = ['msg'=> 'User already a member of that group'];
           }else{
             
               //do an array push to the group
               $pushUsertoGroup = array_push($kaboom, $dAccountName);
               
               //Make sure what you are inserting into the database is unique
               $uniqueArray = array_unique($kaboom);
               
               //Convert it back to a string and prepare for insertion
               $finalResult = implode(",",$uniqueArray);
             
               $updateRow = $this->adminmodel->setControlforusers($finalResult, $dAccountGroup);
		$data = ['msg'=>'User Successfully Added to Group'];
               
           }
               
		
	}
        
        
   $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
 
 
    public function addcashierlevel(){
        
      $sessionEmail = $_SESSION["email"];
      $data = [];
      //$getusergroupresult = [];
      
	if(isset($_POST['dUser']) && isset($_POST['dLevel']) ){
			
	// Declaring put putting all variables in Values
	$dUser = $this->input->post('dUser', TRUE);
        $dLevel = $this->input->post('dLevel', TRUE);
	
        //$changeaccountIDtoarray = explode(",", $dAccountName);
        
        if($dUser == "" || $dLevel == ""){
            $data = ['msg'=>'Please make sure all fields are selected'];
        }else {
             
        $updateRow = $this->adminmodel->setascashier($dUser, $dLevel);
	$data = ['msg'=>'User Successfully Setup'];
                
        }
      	
	}
        
        
   $this->output->set_content_type('application/json')->set_output(json_encode($data));
        
    }    
    
    
 
    
  public function addtogroupinicuonly(){
     
      $sessionEmail = $_SESSION["email"];
      $data = [];
      //$getusergroupresult = [];
      
	if(isset($_POST['dicugroupname']) && isset($_POST['dICUname']) ){
			
	// Declaring put putting all variables in Values
	$dicugroupname = $this->input->post('dicugroupname', TRUE);
        $dICUname = $this->input->post('dICUname', TRUE);
        $approvalLimit = $this->input->post('approvalLimit', TRUE);
	
        //$changeaccountIDtoarray = explode(",", $dAccountName);
        
        //Return the userid to see if the account is already in that group
        $getusergroupresult = $this->adminmodel->getuserforicugroup($dicugroupname) ? $this->adminmodel->getuserforicugroup($dicugroupname) : "0";
        //var_dump($getusergroupresult);
        
        $kaboom = explode(",", $getusergroupresult);
        
        if($dicugroupname == "" || $dICUname == "" || $approvalLimit == ""){
            
             $data = ['msg'=> 'Please make sure all fields are fields'];
        }else 
           
           if(in_array($dICUname, $kaboom)){
               
             $data = ['msg'=> 'User already a member of that group'];
           }else{
             
               //do an array push to the group
               $pushUsertoGroup = array_push($kaboom, $dICUname);
               
               //Make sure what you are inserting into the database is unique
               $uniqueArray = array_unique($kaboom);
               
               //Convert it back to a string and prepare for insertion
               $finalResult = implode(",",$uniqueArray);
             
               $updateRow = $this->adminmodel->setControlforicugroup($finalResult, $dicugroupname);
               
               $publicHoliday = $this->adminmodel->setUsericulimit($dICUname, $approvalLimit, $dicugroupname);
	
               $data = ['msg'=>'User Successfully Added to Group in ICU'];
               
           }
               
		
	}
        
        
   $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
 
    
 
 ////////////////////////////////////FIRST AMOUNT FOR TILL ////////////////////////////////////////////////////////////////////
 
  public function filltillfirstamount(){
        
      $sessionEmail = $_SESSION["email"];
      $data = [];
      //$getusergroupresult = [];
      
	if(isset($_POST['postID']) && isset($_POST['firsttillamount']) ){
			
	// Declaring put putting all variables in Values
	$postID = $this->input->post('postID', TRUE);
        $firsttillamount = $this->input->post('firsttillamount', TRUE);
	
        // Use the postId to return whether the amount has been posted before
        $getpostStatus = $this->adminmodel->getpoststatusoftillfirstime($postID);
        
        // Use the postId to return whether the amount has been posted before
        $getcashiertTillLimit = $this->adminmodel->getcashiersTillLimit($postID);
        
        $postfisrttime = "1";
        if($postID == "" || $firsttillamount == ""){
            $data = ['msg'=>'Please make sure all fields are selected'];
        }else if($getpostStatus == 1){
             $data = ['msgError'=>'You can only make this request one time, Please see the Administrator. - "postFirsttime" == 1'];
        }else if($firsttillamount > $getcashiertTillLimit){
             $data = ['msgError'=>'Cashiers Till Limit is '.$getcashiertTillLimit.' So you cannot post that amount'];
        }else {
        //$zeortill = 0;
        $updateRow = $this->adminmodel->updatefirsttimetillrequest($firsttillamount, $postfisrttime, $sessionEmail, $postID);
        
        
        // Use the postId to return whether the amount has been posted before
        $tillName = $this->accounting->usepostidgetillname($postID);
        
        $cashiserEmail = $this->accounting->getTillemail($postID);
        
        $dateprepared  = date('y-m-d');
        //Do an insertion to a new table to see all the money we have give the cashier
        $insertforCashier = $this->accounting->insertamountdetails($dateprepared, $firsttillamount, $tillName, $cashiserEmail, $sessionEmail);
	
        $data = ['msg'=>'Cashiers Till Successfully Filled'];
                
        }
      	
	}
        
        
   $this->output->set_content_type('application/json')->set_output(json_encode($data));
        
    }    
    
 //////////////////////////////////END OF FIRST AMOUNT FOR TILL //////////////////////////////////////////////////
 
  public function processmycashierstill($email) {

        $json = [];
        $gettillRequest = $this->adminmodel->getresultfromtillbalances($email);
        
        if ($gettillRequest) {
            foreach ($gettillRequest as $get) {
                $id = $get->id;
                $tillName = $get->tillName;
                $cahsierTillID = $get->cahsierTillID;
                $cashierEmail = $get->cashierEmail;
                $tillBalance = $get->tillBalance;
                $cashierTillLimit = $get->cashierTillLimit;
                $tillType = $get->tillType;
                
              
                        $data[] = ['Id' => $id, 'tillName'=>$tillName, 'tillBalance'=>$tillBalance,  'cahsierTillID' => $cahsierTillID, 'cashierEmail' =>$cashierEmail];
                    }
                    $json['ci'] = $data;
             
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
 ////////////////////////////////////////////// EDIT REJECTED REQUEST/////////////////////////////////////////////////
      public function editprequestdetails(){
        
      $sessionEmail = $_SESSION["email"];
      $data = [];
     
	if(isset($_POST['hideID']) && isset($_POST['dAmount']) ){
			
	// Declaring put putting all variables in Values
	$dAmount = $this->input->post('dAmount', TRUE);
        $hideID = $this->input->post('hideID', TRUE);
        $ndescriptOfitem = $this->input->post('ndescriptOfitem', TRUE);
        $dAmount = $this->input->post('dAmount', TRUE);
        $dComment = $this->input->post('dComment', TRUE);
        $benName = $this->input->post('benName', TRUE);
        $newDate = $this->input->post('newDate', TRUE);
        $dcashier = $this->input->post('dcashier', TRUE) ? $this->input->post('dcashier', TRUE) : "";
        $dAccountGroup = $this->input->post('dAccountGroup', TRUE) ? $this->input->post('dAccountGroup', TRUE) : "0";
        $dHOD = $this->input->post('dHOD', TRUE);
	
        //Use refid to return the result
        $gethideIDresult = $this->mainlocation->getdexactresultfromdb($hideID);
        if($gethideIDresult){
            
            foreach($gethideIDresult as $get){
                  $uid = $get->id;
		  $nPayment = $get->nPayment;
		  $hod = $get->hod;
		  $icus = $get->icus;
		  $cashiers = $get->cashiers;
		  $sessionID = $get->sessionID;
                  $Location = $get->dLocation;
                  $unit = $get->dUnit;
                  $sessionID = $get->sessionID;
                  $fullname = $get->fullname;
                  $dateRegistered = $get->dateRegistered;
            }
            
        }
        
        
        $randomString = generateRandomCode(1,10);
        if($nPayment == 1){
            $userGenCode = str_shuffle(rand(0,100000)).$randomString;
        }
        if($dAmount == "" || $hideID == ""){
            $data = ['warr'=>'Please make sure an amount is selected'];
        }else {
        $approvals = '1';
        $updateRow = $this->adminmodel->sendneweditedrequest($userGenCode, $dHOD, $dAccountGroup, $dcashier, $newDate, $sessionID, $fullname, $nPayment, $approvals, $Location, $unit, $icus, $dAmount, $ndescriptOfitem, $dComment, $benName, $hideID);
        
        //Use the hideid to disable edit request
        $disabled = "disabed";
        $approval = "11";
        $updatehideID = $this->mainlocation->disablehide($disabled, $approval, $hideID);
        
	$data = ['msg'=>'Request Successfully Sent'];
                
        }
      	
	}
        
        
   $this->output->set_content_type('application/json')->set_output(json_encode($data));
        
    }    
    
    ///////////////////////////////////END OF EDIT REJECTED REQUEST//////////////////////////////////////////////////
    
     public function processmorecode() {

        $json = [];
        $act = $this->mainlocation->getallaccounts();
        
        if ($act) {
            foreach ($act as $get) {
                $codeid = $get->codeid;
                $codeName = $get->codeName;
                $codeNumber = $get->codeNumber;
              
                        $data[] = ['codeid' => $codeid, 'codeName'=>$codeName, 'codeNumber'=>$codeNumber];
                    }
                    $json['ci'] = $data;
             
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    

    
 public function getdinforfromdetails($id) {

        $json = [];
        $getresult = $this->mainlocation->getdexactresultfromdb($id);
        
        if ($getresult) {
            foreach ($getresult as $get) {
                $id = $get->id;
                $benName = $get->benName;
                $dAmount = $get->dAmount;
                        $data[] = ['benName' => $benName, 'dAmount' => $dAmount];
                    }
                    $json['ci'] = $data;
             
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function addbankaccountnoprocess(){
        
      $sessionEmail = $_SESSION["email"];
      $data = [];
      //$getusergroupresult = [];
      
	if(isset($_POST['bankName']) && isset($_POST['actNumber']) ){
			
	// Declaring put putting all variables in Values
	$bankName = $this->input->post('bankName', TRUE);
        $actNumber = $this->input->post('actNumber', TRUE);
        $address1 = $this->input->post('address1', TRUE);
        $state = $this->input->post('state', TRUE);
        $acctName = $this->input->post('acctName', TRUE);
	
        //$changeaccountIDtoarray = explode(",", $dAccountName);
        
        if($bankName == "" || $actNumber == "" || $address1 == "" || $actNumber == ""){
            $data = ['msg'=>'Please make sure all fields are fields'];
        }else {
             
        $updateRow = $this->adminmodel->addbankaccountnameandnumber($acctName, $bankName, $actNumber, $address1, $state, $sessionEmail);
	$data = ['msg'=>'Bank Successfully Setup'];
                
        }
      	
	}
        
        
   $this->output->set_content_type('application/json')->set_output(json_encode($data));
        
    }    
    
  
  public function getbankstatement($somenumber){
      
            $title = "MONEY BOOK PRO :: BANK STATEMENT";
            $lang = $this->input->post('lang');
            $dBankAct = $this->input->post('dBankAct');
            $ssession =  $_SESSION['email'];
            //Get Session Details
            $getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
             $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
             $sumlang = "";
            if($getApprovalLevel == 7 ||  $getApprovalLevel == 6 || $getApprovalLevel == 8){
                
                  //$postBankNow = $this->input->post('generateStatement', TRUE);
               $mainaccountapproval = '8';
                $newthenumber = explode(",", $somenumber);
                if($newthenumber){
                foreach($newthenumber as $key => $value) {

                     $getlangID = $this->adminmodel->getthefmrequestID($value);
                     $newapproval = '2';  
                     $allSelected[] = $value;

                     //Update record where the id = $value
                $runUpdatefornewrequest = $this->adminmodel->updatewithidforbankst($mainaccountapproval, $newapproval, $ssession, $getlangID);

                   }
                }
                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title,  'getApprovalLevel'=>$getApprovalLevel, 'dBankAct'=>$dBankAct, 'somenumber'=>$somenumber, 'getSessionDetails'=>$getSessionDetails, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
                $this->load->view('generateStatementforBank', $values);
             }else{
                 echo "You do not have permission to view this page";
             }
  }      
 
  
  public function cashierstillrequest(){
      
      $sseionEmail = $_SESSION['email'];
        $sessionID = $this->adminmodel->getuserID($sseionEmail);
        $myurl = mycustom_url();
        
        $newlang = ""; 
        $data = [];
        $approval = '1';
        if(isset($_POST['lang'])){
           
           $lang = $this->input->post('lang');
           $lang = implode(",", $lang);
           $sumlang = "";
            
            //$getTillTypeforbothprimaryandsecondary = $this->adminmodel->getTilltype($lang);  // This is suppose to be for secondary till to enable it seondary till
            //Check if user has a pending request
            $checkrequest = $this->adminmodel->checkforrequest($sseionEmail, $sessionID, $myurl);
            if($checkrequest){
                 $data = ['status'=>2, 'msg'=>'You have a pending request, Please see the accountant'];
            
            } else {
            
            $getallIds = $this->generalmd->intotoReimbursement($sseionEmail, $lang);      
            $requestIDlang = explode(",", $lang);
            if($requestIDlang){
                
                 foreach($requestIDlang as $key => $value) {
                     
                    $getlangID = $this->adminmodel->getonlyamount($value);
                    $update = '1'; //Change back to 1
                    
                    //Update cash_newrequest where the update is 1
                    $updatetillRequest = $this->adminmodel->updatecashiertillrequest($update, $value);
               
                    if($getlangID){

                         foreach($getlangID as $get){
                             $id = $get->id;
                             $Amount = $get->dAmount;

                             ////////SUM AMOUNT 
                                 if($Amount){
                                     $sumlang += $Amount;
                                 } 

                             }

                          }
                          
                  //Tie array for insertion
                 //$explodearray = implode(",", $lang);
                 } //  foreach($requestIDlang as $key => $value) {
                 
                 
                 
                 /////////////////////////I WILL NEED TO CHECK THIS PART BEFORE THE FORLOOP ////////////////////////////////
                 
                 $getTillType = $this->adminmodel->getTilltype($lang);
                 $getdcashierLimit = $this->adminmodel->getyourlimit($sseionEmail, $getTillType);
                 /////////////////////////////END OF PART I WILL NEED TO CONFIR ///////////////////////////////////////////
               
                  if($sumlang > $getdcashierLimit){
                     $update = '0';
                     $updatetillRequest = $this->adminmodel->updatecashiertillrequest($update, $value);
                             $data = ['status'=>3, 'msg'=>'Total Amount above your limit. please reduce request'];
                  }else{
                     //Use the Total to add the amount and sent to the database
                  $appID = "01"; // 01 === PETTY CASH  02 == MAINTENANCE
                  $getUserLocation = $this->users->getLocationEmail($sseionEmail);
                  $getUserUnit = $this->users->getUnit($sseionEmail);
                  $approval = "0";
                  
                  if($getTillType == 'primary'){
                  //Use cashiers email and ID to return till Name
                  $getTillName = $this->mainlocation->getdTillname($sseionEmail);
                  }else{
                     $getTillName = $this->mainlocation->getdTillnameforsecondary($sseionEmail);  
                  }
                                              //sendtosuperaccount($getTillName="", $myurl, $getUserLocation, $getUserUnit, $appID, $fmrequestID, $makedpaymebnt, $sessionID, $sumlang, $partAmount="", $approval, $sseionEmail, $chequeNo="", $type="", $getBank="", $payee="", $paidByAcct=""){
                 $addTotal = $this->adminmodel->sendtosuperaccountfromcashier($getTillName, $myurl, $getUserLocation, $getUserUnit, $appID, $lang, "", $sessionID, $sumlang, "", $approval, "", "", "", "", $sseionEmail, ""); 
                //Now update a new column in the database where cashiertillrequest from 0 to 1
                $myupdate = $this->generalmd->updatemyreimbursement($sumlang, $getallIds);
                   //$data = ['status'=>1, 'msg'=>'Request Successfully Made, Please wait for Account to approve Payment for your till'];
                 }// Cashiers Limit Exceeded;
                
            
           
            } // End of   } else {
            
           $data = ['status'=>1, 'msg'=>'Reimbursement successfully created'];
            }
        
            
        } else{
                 $data = ['status'=>0, 'msg'=>'Please select a checkbox'];
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
            
  } // End of The Funiction
  
 
  
   public function updatereimbursementdetails(){
        
      $sessionEmail = $_SESSION["email"];
      $data = [];
      //$getusergroupresult = [];
      
	if(isset($_POST['sendformID']) && isset($_POST['daccountant']) ){
			
	// Declaring put putting all variables in Values
	$sendformID = $this->input->post('sendformID', TRUE);
        $daccountant = $this->input->post('daccountant', TRUE);
	
        //$changeaccountIDtoarray = explode(",", $dAccountName);
        //Get all the groups
        $getUserid = $this->mainlocation->cashgroup($daccountant);
        $nums = explode(',', $getUserid);
         foreach($nums as $key => $value) {            
         //Use the Value to get the UserEmail and Send them a mail
         $getEmailofAccountGroup = $this->users->getuseremail($value);
            if($getEmailofAccountGroup){
                $message .= "<p> $sessionEmail has sent you a request for reimbursement, please click the link below</p> ";
                //$message .= "<p><a href=".base_url()."home/requestforpayment'>Click Here</a></p>";
                $message .= "<p><a href='https://c-iprocure.com/expensepro/home/requestforpayment'>Click Here</a></p>";
                $message .="Thank you.";
                $fromEmail = "expensepro@c-iprocure.com";
                
                $config = array(
                     'mailtype' => "html",
                  );

                $this->email->initialize($config);
                $this->email->from($fromEmail, 'TBS MONEY BOOK'); 
                $this->email->to($getEmailofAccountGroup);
                $this->email->cc("victor.ogiogio@c-ileasing.com");
                $this->email->bcc("ogiogiovictor@gmail.com");
                $this->email->subject('REQUEST FOR REIMBURSEMENT'); 
                $this->email->message($message); 
                $this->email->send();
                             
                }
            }
        
        if($sendformID == "" || $daccountant == ""){
            $data = ['msg'=>'Please make sure all fields are fields'];
        }else {
             
        $updateRow = $this->adminmodel->updatecashiertocheque($daccountant, $sessionEmail, $sendformID);
	$data = ['msg'=>'Request Successfully Sent'];
                
        }
      	
	}
        
        
   $this->output->set_content_type('application/json')->set_output(json_encode($data));
        
    }    
    
    public function preparecheque($id){
        
         $title = "MONEY BOOK PRO :: PREPARE CHEQUE";
	
            //Get Session Details
            $getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
             $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
            if($getApprovalLevel == 7 ||  $getApprovalLevel == 6 || $getApprovalLevel == 8){
                
                $getResult = $this->mainlocation->getidresultfromchequedb($id);
                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title, 'getResult'=>$getResult, 'getApprovalLevel'=>$getApprovalLevel, 'getSessionDetails'=>$getSessionDetails, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
                $this->load->view('prepareothercheques.php', $values);
             }else{
                 echo "You do not have permission to view this page";
             }
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    

    public function changepassword(){
        
        $title = "MONEY BOOK PRO :: PREPARE CHEQUE";
	
            //Get Session Details
            $getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
             $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
          
                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title,  'getApprovalLevel'=>$getApprovalLevel, 'getSessionDetails'=>$getSessionDetails, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
                $this->load->view('changeyourpass', $values);
             
    }
    
  
    
    
     public function disableduser(){
        
       $title = "Expense Pro :: MY APPROVAL";
			
            //$get all Reesult 
            $getallresult = $this->users->getallusersfromdb();
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
            if($getApprovalLevel == 6 || $getApprovalLevel == 5){	
              
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getallresult'=>$getallresult, 'getApprovalLevel'=>$getApprovalLevel, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('allUsers', $values);
            
            }else{
                redirect(base_url());
            }
    }
    
   
    
  
/////////////////////////////////////////NEW APPROVAL FOR ACCOUNT LEVEL //////////////////////////////////////////////
 
public function accountpayment (){
     
     $data = [];
     if(isset($_POST['id'])){
         
        $id = $this->input->post('id', TRUE);
        $dgroup = $this->input->post('dgroup', TRUE);
        $mainAmount = $this->input->post('mainAmount', TRUE);
        
        //Use the AssetID to get the Amount
         $getAmount = $this->adminmodel->getpaymentamount($id);
         $getbenName = $this->mainlocation->getbenefiaciaryName($id);
         $requesterEmail = $this->accounting->emailownerrequesta($id);
         
         if($id == "" || $dgroup == "" || $mainAmount == "" ){
           $data = ['warr'=>'Please make sure all fields are field<br/>'];  
         }else
         
         if($getAmount != $mainAmount){
            $data = ['warr'=>'There is a difference in Amount. Please Check details again.<br/>'];    
         }else{
         
          // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod)
         //approve = 3(approved by ICu), approve = 4 (Cheque Ready for Collection) , approve = 5(Rejected)
         // approve == 7 (Cheque sent for signature)
        $datePaid = date('y-m-d');
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
         $type = "cheque";                                    //($assetID, $paidTo, $dDate, $sessionID, $uid, $tillID, $tillType, $cashierEmail);
         $makedpaymebnt = $this->accounting->chequesentforpaymenta($id, $getbenName, $sessionID, $uid, $type);
         
         
         //This is for summary report and i will like to have an idea of what it does
         $updateothernewrequestable = $this->accounting->updateothertablea($id, $datePaid, $sessionID);
         
         //Use the Request ID to Update the Table
         $updatrequestTable = $this->accounting->daccountwhopaysa($id, $sessionID, $approve, $datePaid);
         
          //Use the asset ID to return the Email of the Person that sends the request
         $getEmailofOwner = $this->accounting->emailownerrequesta($id);
         
         //The Description of Item
         $getDescription = $this->accounting->descriptionofitema($id);
         
         
         ///////////////////BEGINNING INSTALLING INTO SUPER ACCOUNTANT ////////////////////////////////
          $myurl = mycustom_url();
          $appID = "01"; // 01 === PETTY CASH  02 == MAINTENANCE
          $getUserLocation = $this->users->getLocationEmail($_SESSION['email']); // The Accountant Location
          $getUserUnit = $this->users->getUnit($_SESSION['email']);  // The Accountant Unit
          $dUserID = $this->adminmodel->getuserID($_SESSION['email']);
          $approval = "1"; // Means its approved
          $getTillName = ""; 
          
          $addTotal = $this->accounting->sendtosuperaccounta($type, $dgroup, $getTillName, $myurl, $getUserLocation, $getUserUnit, $appID, $id, $makedpaymebnt, $dUserID, $getAmount, $approval, $requesterEmail, $getbenName, $sessionID);
          
          
         //////////////////END OF INSTALLING INTO SUPER ACCOUNTANT ///////////////////////////////////
          
          
          //Audit Trail
         $updatedBy = "Account Approval - $sessionID, time: ". date('Y-m-d H:i:s'). "<hr/>";
          
         $createdby = "Approved by Accountant - $sessionID, time: ". date('Y-m-d H:i:s'). "<hr/>";
         $updateAuditTrail= $this->mainlocation->updatedupdatetrail($updatedBy, $createdby, $id);
          
             ////////////////***************DO WORK FOR ASSET MGT *************************////////////////////////////
         //Return the from_app_id NOTE: Asset Mgt is "2"
          $fromAssetmgt = $this->adminmodel->myuniqueappid($id);
           //Return the request id to update the maintenance table
          $maintenanceID = $this->adminmodel->assetrequestid($id);
          
         
        
         ////////////////***************BEGINNING OF TRAVEL START *************************////////////////////////////
           $this->load->model('travelmodel');	 
            // Use the ID to return the return enumType 
            $getenumType = $this->travelmodel->getnumType($id);
            // if enumType == travel, then return the travelID
           if($getenumType == 'travel'){
            // Use the travel ID to update the request in travel Start
            $getTravelID = $this->travelmodel->getTravelID($id);
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
         ////////////////***************END OF TRAVEL START *************************////////////////////////////
         
           //////////////////////////// PROCUREMENT FEEDBACK //////////////////////////////////////////////////
         if($fromAssetmgt == 3){
             //$audit = "Payment Approved By $accountwhoapprove". date('Y-m-d H:i:s'); 
             //Update the Record in Procurement
             $updatedBy = "Payment Approved By $sessionID". date('Y-m-d H:i:s');
             $createdby = "Approved by Accountant - $sessionID, time: ". date('Y-m-d H:i:s');
             //$procurementUpdate = $this->generalmd->procureupdate($maintenanceID, $audit);
             //$procurementUpdate= $this->generalmd->procureupdate($updatedBy, $createdby, $maintenanceID);
             $procurementUpdate = $this->generalmd->updateprocurementportal($updatedBy, $createdby, 2, $maintenanceID);
         }
        //////////////////////////END OF PROCUREMNT FEED BACK ///////////////////////////////////////////
         
         /////////////////////////////EMAIL IS SENT HERE /////////////////////////////////////////
         $datePaidNow = date("Y-m-d H:i:s");
         
          if($getEmailofOwner){
                
                $message = "<p> Your request for payment with the description is ready for collection</p> ";
                $message .= "<div style='width:600px; color:#adaaa9; padding:10px; border:1px solid #e0dcdb'><div><b> Request Title: ".$getDescription." </b></div> ";
                $message .= "<div><b> Amount: ".@number_format($getAmount, 2)."</b></div> ";
                $message .= "<div><b> Requester Email: ".$getEmailofOwner." </b></div> ";
                $message .= "<div><b> Beneficiary: ".$getbenName." </b></div> ";
                $message .= "<div><b> Date Paid: ".$datePaidNow." </b></div> ";
                $message .= "<div><b> Account Group: ".$dgroup." </b></div> ";
                $message .= "<div><b> Request ID: ".$id." </b></div></div> ";
                $message .= "<p></p> ";
                $message .= "<small>This is an automatically generated email, please do not reply.</small>";
                
                
                $fromEmail = "expensepro@c-iprocure.com";
                
                $config = array(
                     'mailtype' => "html",
                 );

                $this->email->initialize($config);
                $this->email->from($fromEmail, 'TBS EXPENSE PRO'); 
                $this->email->to($getEmailofOwner);
                $this->email->bcc("victor.ogiogio@c-ileasing.com, abiodun.adetayo@c-ileasing.com, john.usuanlele@c-ileasing.com");
                $this->email->subject('REQUEST FOR PAYMENT APPROVED'); 
                $this->email->message($message); 
                $this->email->send();
                
            }
         
         
         ////////////////////////////END OF EMAIL IS SENT HERE ///////////////////////////////////
           
         
         if($updatrequestTable && $addTotal){
             $data = ['msg'=>'Cheque Successfully Approved for Payment<br/>'];
         }
         
        }
     }
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
   
 
 /////////////////////////////////////////////END OF  NEW ACCOUNT APPROVAL /////////////////////////////////////////////
    
 
////////////////////////////////////////////REQUEST REJECTED BY ACCOUNTANT ////////////////////////////////////////////
 
 public function cancelnewrequestbyaccount(){
     $data = [];
     if(isset($_POST['rejectrequestID']) && isset($_POST['dComment'])){
         
         $rejectrequestID = $this->input->post('rejectrequestID', TRUE);
         $dComment = addslashes($this->input->post('dComment', TRUE));
         
         $hodEmail = $_SESSION['email'];
         
         $whosendit = $this->adminmodel->maderequestbyme($rejectrequestID);
         
         if($dComment == "" || $rejectrequestID == ""){
           $data = ['msg'=>'Please make sure you enter a comment before you approve'];  
         }
         
         // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod)
         //approve = 3(approved by ICu), approve = 4 (Payment Made) , approve = 5(Rejected)
         // approve = 12 == rejected by account
         $approve = '12';
         $sessionID = $_SESSION['email'];
         
         $updateApprove = $this->accounting->updaterequestbyhodwhorejecta($approve, $dComment, $rejectrequestID, $sessionID);
         
         //Insert all approval in this table approvalnewrequest
         $updateApprove = $this->accounting->dapprovalforequesta($rejectrequestID, $dComment, $sessionID );
         
         //Use the asset ID to return the Email of the Person that sends the request
         $getEmailofOwner = $this->mainlocation->emailownerrequest($rejectrequestID);
         
         //The Description of Item
         $getDescription = $this->mainlocation->descriptionofitem($rejectrequestID);
         
         $userCode = "";
         //Use the ID to remove the code 
         $removeCode = $this->mainlocation->emptyuserCode($rejectrequestID, $userCode);
         
          //Audit Trail
         $updatedBy = "Rejected - $sessionID, <br/>Comment: $dComment. <br/>time: ". date('Y-m-d H:i:s'). "<hr/>";
          
         $createdby = "Rejected by - $sessionID, <br/>Comment: $dComment. <br/>time: ". date('Y-m-d H:i:s'). "<hr/>";
         $updateAuditTrail= $this->mainlocation->updatedupdatetrail($updatedBy, $createdby, $rejectrequestID);

          ////////////////***************DO WORK FOR ASSET MGT *************************////////////////////////////
         //Return the from_app_id NOTE: Asset Mgt is "2"
          $fromAssetmgt = $this->adminmodel->myuniqueappid($rejectrequestID);
          //Return the request id to update the maintenance table
          $returnupdateIDforacccest = $this->adminmodel->assetrequestid($rejectrequestID);
        
         $getmdfive = $this->mainlocation->getmdfive($rejectrequestID);
         $getwhoapproval = $this->mainlocation->returnformrequest($rejectrequestID);
         
         //////////////********************TRAVEL START FOR EXPENSE PRO ***********************/////////////////////
         
              $this->load->model('travelmodel');	 
              // Use the ID to return the return enumType 
              $getenumType = $this->travelmodel->getnumType($rejectrequestID);
              // if enumType == travel, then return the travelID
              if($getenumType == 'travel'){
               // Use the travel ID to update the request in travel Start
               $getTravelID = $this->travelmodel->getTravelID($rejectrequestID);
               //Run Travel ID Update change status to 
               $approval = '2';
               $doUpdate = $this->travelmodel->makedoUpdate($approval, $getTravelID, $sessionID);
               $comment = "<br/>Rejected By $sessionID   Comments: $dComment   time ". date('y-m-s H:i:s');
               $doauditTrail = $this->travelmodel->runauditTrail($comment, $getTravelID);

              //Run Delete for expense pro and expense pro expense
               $myfirstDelete = $this->travelmodel->deletefromexpensepro($rejectrequestID);
               $mysecondDelete = $this->travelmodel->deletefromcashexpensedetails($rejectrequestID);
              }
       
         /////////////*********************TRAVEL STRAT FOR EXPENSE PRO **********************///////////////////////
         
           //////////////////////////// PROCUREMENT FEEDBACK //////////////////////////////////////////////////
         if($fromAssetmgt == 3){
             //$audit = "Payment Rejected By $sessionID". date('Y-m-d H:i:s'); 
             //Update the Record in Procurement
             //$procurementUpdate = $this->generalmd->procureupdaterejected($returnupdateIDforacccest, $audit);
              $updatedBy = "Payment Rejected By $sessionID". date('Y-m-d H:i:s');
             $createdby = "REJECTED - $sessionID, time: ". date('Y-m-d H:i:s');
             //$procurementUpdate = $this->generalmd->procureupdate($maintenanceID, $audit);
             $procurementUpdate= $this->generalmd->rejectprocurementportal($updatedBy, $createdby, 3, $returnupdateIDforacccest);
         }
        //////////////////////////END OF PROCUREMNT FEED BACK ///////////////////////////////////////////
        
         
            if($getEmailofOwner){
                          
                //Send Result to javascript for processing
		
                $message = "<p> Your request was not approved  by Accounts.</p> ";
                $message .= "<p> Request Title: '".$getDescription."'</p>";
                $message .= "<p>Click here for details:<br/><a href='".base_url()."home/editejectedrequest/$rejectrequestID/$getmdfive/$getwhoapproval'>Link to request</a></p>";
                             
                $fromEmail = "expensepro@c-iprocure.com";
                
                $config = array(
                    'mailtype' => "html",
                );
                
                $this->email->initialize($config);
                $this->email->from($fromEmail, 'TBS EXPENSE PRO'); 
                $this->email->to($getEmailofOwner);
                $this->email->subject('YOUR REQUEST WAS NOT APPROVED'); 
                $this->email->message($message); 
                $this->email->send();
         
              } 
           
         
         if($updateApprove){
             $data = ['msg'=>'Request not Approved'];
         }
         
         //Use it to send an email to everybody in ICU
         
     }
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
 
///////////////////////////////////////////END OF REQUEST REJECTED BY ACCOUNTANT //////////////////////////////////////

 
////////////////////////////////////////NEW CASHIERS REIMBURSEMENT ///////////////////////////////////////////////////

public function preparecashierscheque(){
        
      $sessionEmail = $_SESSION["email"];
      $data = [];
      //$getusergroupresult = [];
      
	if(isset($_POST['newid']) && isset($_POST['newamounts']) ){
			
	// Declaring put putting all variables in Values
	$newid = $this->input->post('newid', TRUE);
        $newamounts = $this->input->post('newamounts', TRUE);
        //$cashiserEmail = $this->input->post('cashiserEmail', TRUE);
        $dateprepared =  date('y-m-d');
        
        //Use the ID to check if the request has been approved
        $thisCheckifapproved = $this->accounting->checkmyid($newid);
        
        $cashiserEmail = $this->accounting->requesterEmailwhosentit($newid);
        
         //Use the ID to check if the request has been approved
        $checkIFICUhaseen = $this->accounting->checkificuhaseen($newid);
        
        if($newid == "" || $newamounts == ""){
            $data = ['msg'=>'Please make sure all fields are filled'];
        }else if($checkIFICUhaseen !== "yes"){
             $data = ['error'=>'User is yet to post on Sage. because ICU has not verified request'];
        }else if($thisCheckifapproved == 1){
            $data = ['msg'=>'Reimbursement has been paid. please reload your browser'];
        }else {
         $hasentbycashier = 'paid'; 
         $type = 'cheque'; 
        $updateRow = $this->accounting->updatechequerequesta($hasentbycashier, $type, $sessionEmail, $dateprepared, $cashiserEmail, $newamounts, $newid);
	
        //programming for cashiers sections begins here
        $getResult = $this->adminmodel->getTillresult($newid);
            if($getResult){
                
                foreach($getResult as $get){
                        $tillid = $get->id;
                        $userID = $get->userID;
                        $Amount = $get->Amount;
                        $fmrequestID = $get->fmrequestID;
                        $tillName = $get->tillName;
               }
               
             $newapproval = '2'; // for cashiers till request not application for accountant
              $implodeid = explode(",", $fmrequestID);
            //print_r($implodeid);
            //
            //Now we will do a foreach loop to loop through those values and update
              foreach($implodeid as $key => $value) {
               $allSelected[] = $value;
               //Update record where the id = $value
               $runUpdatefornewrequest = $this->adminmodel->updatewithid($newapproval, $sessionEmail, $value);
               
              }
               if($updateRow == TRUE && $tillName !== ""){
                $getcashiertillcurrentdetails = $this->adminmodel->getcashiertilldetails($userID, $tillName);  
                 if($getcashiertillcurrentdetails){
                    foreach($getcashiertillcurrentdetails as $get){
                        $cahsierTillID = $get->cahsierTillID;
                        $oldtillAmount = $get->tillAmount;
                        $tillBalance = $get->tillBalance;

                    }
                        $newtillTotalAmount = $oldtillAmount + $Amount;
                        $newtillBalance = $tillBalance + $Amount;
                     
                       //Update the till Table
                       $tillTableUpdate = $this->adminmodel->addTillamounttogeter($userID, $tillName, $newtillTotalAmount, $newtillBalance);
                       
                       //Do an insertion to a new table to see all the money we have give the cashier
                       $insertforCashier = $this->adminmodel->insertamountdetails($dateprepared, $userID, $Amount, $tillBalance, $newtillBalance, $tillName, $cashiserEmail, $sessionEmail, $fmrequestID);
                       
                       if($insertforCashier){
			
			$message = "<div>New Remibursement request has been approved, Details below<br/></div>";
                        $message .= "<div>Till Name: $tillName</div>";
                        $message .= "<div>Cashiers Email: $cashiserEmail</div>";
                        $message .= "<div>Till Balance: $tillBalance</div>";
                        $message .= "<div>New Amount: $Amount</div>";
                        $message .= "<div>New Balance: $newtillBalance</div>";
                        $message .= "<div>Approved By: $sessionEmail</div>";
                        $message .= "<div>Date: $dateprepared</div>";
                        
                        $config = array(
                                'mailtype' => "html"
                                
                          );

                        $this->email->initialize($config);
                        $this->email->from("expensepro@c-iprocure.com", "TBS-EXPENSE PRO"); 
                        $this->email->to($cashiserEmail);
                        $this->email->cc('victor.ogiogio@c-ileasing.com, abiodun.adetayo@c-ileasing.com, john.usuanlele@c-ileasing.com, oladejo.lasisi@c-ileasing.com, deborah.osademe@c-ileasing.com');
                        $this->email->bcc($sessionEmail);
                        $this->email->subject('CASHIER HAS BEEN REIMBURSED'); 
                        $this->email->message($message); 
                        $this->email->send();
                    
                      } 
                      
                      
                      
                      
                 }
               } // End of  if($updateRow == TRUE && $tillName !== ""){
              
            } // End of   if($getResult){
        ///programming for cashiers sections ends here
        $data = ['msg'=>'Cashier Cheque Successfully Paid'];
                
        }
      	
	} else{
           $data = ['msg'=>'Please make sure all fields are filled']; 
        } 
   $this->output->set_content_type('application/json')->set_output(json_encode($data));
        
    }    
    
//////////////////////////////////END OF NEW CASHIERS REIMBURSEMENT ///////////////////////////////////////////////////    
    
    
    
     public function confirmreimbursementrequest(){
        $data = [];
        if(isset($_POST['newid']) && isset($_POST['newamounts'])){
            // Declaring put putting all variables in Values
	$newid = $this->input->post('newid', TRUE);
        $newamounts = $this->input->post('newamounts', TRUE);
        
        //Use the $new to confirm it to yes
        
           $thisconfirmyes = $this->accounting->confirmtoyes($newid);
            if($thisconfirmyes){
                $data = ['msg'=>'Reimbursement Successfully Confirmed']; 
            }else{
                $data = ['msg'=>'Error Confirming Request, Please try again']; 
            }
        
        }
         $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
} // End of Class Home
