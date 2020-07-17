<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
class Mergedpay extends CI_Controller {

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
        
    public function mergepayment($variables){
        
            $title = "Merge parment: C&I Leasing Plc";
             $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
            if($getApprovalLevel == 6 || $getApprovalLevel == 8 || $getApprovalLevel == 7 ){
                $joinBenName = "";
                //Use the $variables to check if any thing exist in the database
                $getVariables = explode(",", $variables);
                
                $getVariables = array_shift($getVariables);
                                
                $getVariables = explode(",", $getVariables);
              
                foreach($getVariables as $key => $values){
                    //Use the values to check the database if any of the result exist
                   $getResult = $this->mainlocation->getallresultbutanarray($values);
                    //$getResult = $this->mainlocation->getdexactresultfromdb($values);
                    
                    if($getResult == FALSE){
                       echo "No result found. Please make sure you are on the right page.";
                       exit();
                    }else{
                        foreach($getResult as $get){
                            $benName = $get['benName'];
                            
                           }
                         
                    }
                    
                }
           $menu = $this->load->view('menu', '', TRUE);
           $sidebar = $this->load->view('sidebar', '', TRUE);
           $footer = $this->load->view('footer', '', TRUE);
           $values = ['title' => $title, 'controllerbenName'=>$benName,  'variables'=>$variables, 'getResult'=>$getResult, 'getApprovalLevel'=>$getApprovalLevel, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
           $this->load->view('mergedpayment', $values);
               
            }else{
                echo "You do not have permission to view this page";
            }
        
    }
    
 
    
  public function confirmchequerequestnownow (){
     
     $data = [];
     if(isset($_POST['chequeID'])){
         
        $chequeDate = $this->input->post('chequeDate', TRUE);
        $payee = $this->input->post('payee', TRUE);
        $mainAmount = $this->input->post('mainAmount', TRUE);
        $getBank = $this->input->post('getBank', TRUE);
        $chequeNo = $this->input->post('chequeNo', TRUE);
        $chequeID = $this->input->post('chequeID', TRUE);
        
        $vatcharge = $this->input->post('vatcharge', TRUE);
        $witholdingtax = $this->input->post('witholdingtax', TRUE);
        $witholdtax = "";
        
         if($chequeDate == "" || $getBank == "" || $chequeNo == "" || $mainAmount == "" || $chequeID == ""){
           $data = ['warr'=>'Please make sure all fields are field<br/>'];  
         }
                
          // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod)
         //approve = 3(approved by ICu), approve = 4 (Cheque Ready for Collection) , approve = 5(Rejected)
         // approve == 7 (Cheque sent for signature)
         $approve = '7';
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
         $makedpaymebnt = $this->mainlocation->chequesentforpayment($chequeID, $payee, $chequeDate, $sessionID, $uid, $chequeNo, $type, $getBank);
         
         
         //Before you update you need to explode and update the table as an array of valeus
         $makeChedquIDarray = explode(",", $chequeID);
         
         foreach($makeChedquIDarray as $key => $value){
         //This is for summary report and i will like to have an idea of what it does
         $updateothernewrequestable = $this->mainlocation->updateothertable($value, $chequeDate, $sessionID);
         
         $partAmount = "";
         //Use the Request ID to Update the Table
         $updatrequestTable = $this->mainlocation->daccountwhopays($value, $sessionID, $approve, $partAmount, $chequeDate);
         }
         
         ///////////////////BEGINNING INSTALLING INTO SUPER ACCOUNTANT ////////////////////////////////
          $myurl = mycustom_url();
          $appID = "01"; // 01 === PETTY CASH  02 == MAINTENANCE
          $getUserLocation = $this->users->getLocationEmail($_SESSION['email']);
          $getUserUnit = $this->users->getUnit($_SESSION['email']);
          $dUserID = $this->adminmodel->getuserID($_SESSION['email']);
          $approval = "0";
          $getTillName = "0"; 
          $mergedpayment = "merged";
          
          if($vatcharge !== ""){
              
              $getvatpercent = $this->allresult->getvatpercent($vatcharge);
              //Calculate the VAT by multiplying with the amount
              $vatAmount = $mainAmount * $getvatpercent;
          }
          
          if($witholdingtax !== ""){
              $getwitholdtax = $this->allresult->getwitholdtax($witholdingtax);
              $witholdtax = $mainAmount * $getwitholdtax;
          }
          
          $addTotal = $this->adminmodel->sendtosuperaccount($getTillName, $myurl, $getUserLocation, $getUserUnit, $appID, $chequeID, $makedpaymebnt, $dUserID, $mainAmount, $partAmount, $approval, $_SESSION['email'], $chequeNo, $type, $getBank, $payee, $sessionID, $mergedpayment, $vatAmount, $witholdtax);
          
          
           //Add tax levies
          $addLevies = $this->allresult->addgovtlevies($addTotal, $mainAmount, $vatcharge, $witholdingtax, $sessionID);
         
          
         //////////////////END OF INSTALLING INTO SUPER ACCOUNTANT ///////////////////////////////////
         
         if($makedpaymebnt && $addTotal){
             $data = ['msg'=>'Cheque Successfully successfully prepared for signature<br/>'];
         }
         
        
     }
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }  
    
} // End of Class Home
