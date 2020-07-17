<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
class Changecashier extends CI_Controller {

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
      
    }   
    
    
	public function index($id="", $tillName="", $cashierID="", $cashierEmail="")
	{
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            if($getApprovalLevel == 6){
                 
                $gettilldetails = $this->mainlocation->getmytilldetailsall($id, $tillName, $cashierID, $cashierEmail);
                if($gettilldetails){
                $title = "Expense Pro :: MY TILL";
                $sessionEmail = $_SESSION['email'];
                $sessionID = $_SESSION['id'];
                
                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title, 'gettilldetails'=>$gettilldetails, 'sessionID'=> $sessionID, 'sessionEmail'=> $sessionEmail, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
                $this->load->view('assigntilltoanotheruser.php', $values);
                }else{
                   echo "<h3>You cannot perform that operation, if problem persist please contact I.T Department</h3>";  
                }
            }else{
                echo "You do not have approved right to view this page";
            }
			
	}
        
  
        public function changemycashier($id="", $mdID="", $sessionID=""){
          
          $title = "Expense Pro: Change Cashier/ICU";
          $getUserDetails = $this->mainlocation->changemycashier($id, $mdID, $sessionID);
          $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
          
          if($getUserDetails){
              
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title,  'getResult'=> $getUserDetails, 'getApprovalLevel'=>$getApprovalLevel, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('changemycashierandicu', $values);
             
          }else{
              echo "You cannot perform that operation. Please contact IT Department Or ICU";
          }
        }
       
        
        public function changecashdetails(){
            
            $data = [];
            if(isset($_POST['postID']) && isset($_POST['approveID']) && isset($_POST['sessionID']) ){
                
                $postID = $this->input->post('postID', TRUE);
                $approveID = $this->input->post('approveID', TRUE);
                $sessionID = $this->input->post('sessionID', TRUE);
                $changemyicu = $this->input->post('changemyicu', TRUE);
                $changemycashier = $this->input->post('changemycashier', TRUE);
                
                $getapproveIDetails = $this->mainlocation->getuserapprovaldetails($postID, $sessionID);
                if($postID == "" || $approveID == ""){
                   $data = ['msgError' => 'Important variable to process request is missing, please Contact IT'];   
                }else if($getapproveIDetails == FALSE){
                   $data = ['msgError' => 'You can only change details if you request is awaiting approval or HOD has approved request'];  
                }else{
                   
                    //Run Update for the required filed only
                    $updatedrequest = $this->mainlocation->changemyrequestderails($changemyicu, $changemycashier, $postID, $sessionID);
                    $data = ['msg' => 'Request Successfully Updated. please wait while we sync data'];
                }
            }else{
               $data = ['msgError' => 'Error processing request, please try again later'];     
            }
            
              $this->output->set_content_type('application/json')->set_output(json_encode($data));
            
        }
     
        
        
        public function attachnewcasher(){
            $data = [];
           if(isset($_POST['idwhochangeit']) && isset($_POST['emailwhochangeit']) && isset($_POST['oldchashieremail'])){
               
                $idwhochangeit = $this->input->post('idwhochangeit', TRUE);
                $emailwhochangeit = $this->input->post('emailwhochangeit', TRUE);
                $oldchashieremail = $this->input->post('oldchashieremail', TRUE);
                $tillType = $this->input->post('tillType', TRUE);
                $newcashier = $this->input->post('newcashier', TRUE);
                $tillbalance = $this->input->post('tillbalance', TRUE);
                $tillID = $this->input->post('tillID', TRUE);
                
                //Check if user is a casher
                $checkusercashier = $this->archievesmodel->areyouascashier($newcashier);
                
                //Use the cashier to return the type of till he is managing
                $newcashiermangetill = $this->archievesmodel->whatypeoftillareumanaging($newcashier);
                
                if($newcashier == "" || $tillType == "" || $oldchashieremail =="" || $emailwhochangeit == "" || $idwhochangeit ==""){
                    $data = ['msgError' => 'Please make sure all fields are fields'];      
                }else if($checkusercashier == FALSE){
                     $data = ['msgError' => 'User not a Cashier, please contact I.T Department to set user as a cashier'];  
                }else if($checkusercashier && $tillType == $newcashiermangetill){
                     $data = ['msgError' => 'Cashier already has a primary till, you may want to set the till as secondary for now'];  
                }else{
                    
                    //Use the new cashier email to return the ID
                    $getnewcashierID = $this->archievesmodel->newcashierwithid($newcashier);
                    
                    //Update the Till to the new cashier
                    $runnewcashier = $this->archievesmodel->updatenewchasierintill($getnewcashierID, $newcashier, $tillType, $tillID);
                   
                    //Insert transaction and who changed it to the change table for cashier till and amount given
                    $insertTransaction = $this->archievesmodel->newchasierintill($newcashier, $oldchashieremail, $tillType, $tillbalance, $emailwhochangeit);
                    
                    $data = ['msg' => 'You have succcessfully added new user to till'];
                   //Send email to the old cashier that his till has been transferred to another cashier with the new cashier email.
                    
                 /*   if($insertTransaction){
                
                        $message ="Your till has been reallocated to $newcashier please contact account "
                                . "to find out if you approve this change. Thank you.";

                        $config = array(
                            'mailtype' => "html",
                         );

                        $this->email->initialize($config);
                        $this->email->from("expensepro@c-iprocure.com", 'TBS - EXPENSE PRO'); 
                        $this->email->to($oldchashieremail);
                        $this->email->subject('YOUR TILL HAS BEEN RE-ALLOCATED'); 
                        $this->email->message($message); 
                
                     } */
            
                }
                
           }
           
           $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        
    
        
        
        
        public function addmoney($id="", $tillName="", $cashierID="", $cashierEmail="")
	{
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            if($getApprovalLevel == 6 || $_SESSION['id'] == 84){
                 
                $gettilldetails = $this->mainlocation->getmytilldetailsall($id, $tillName, $cashierID, $cashierEmail);
                if($gettilldetails){
                $title = "Expense Pro :: MY TILL";
                $sessionEmail = $_SESSION['email'];
                $sessionID = $_SESSION['id'];
                
                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title, 'gettilldetails'=>$gettilldetails, 'sessionID'=> $sessionID, 'sessionEmail'=> $sessionEmail, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
                $this->load->view('addnewmoney', $values);
                }else{
                   echo "<h3>You cannot perform that operation, if problem persist please contact I.T Department</h3>";  
                }
            }else{
                echo "You do not have approved right to view this page";
            }
			
	}
        
        
        
        
    public function addmoremoney(){
        $data = [];
        $messageaccount = "";
        if(isset($_POST['idwhochangeit']) || isset($_POST['cashieremail'])  || isset($_POST['tillID']) || isset($_POST['addAmount'])){
            
            $idwhochangeit = $this->input->post('idwhochangeit', TRUE);
            $cashieremail = $this->input->post('cashieremail', TRUE);
            $tillID = $this->input->post('tillID', TRUE);
            $addAmount = $this->input->post('addAmount', TRUE);
            $emailwhochangeit = $this->input->post('emailwhochangeit', TRUE);
            $tillbalance = $this->input->post('tillbalance', TRUE);
            $tillName = $this->input->post('tillName', TRUE);
            
            //Use the tillid to return the post first time amount must be equal to 1
            $tillAddmoney = $this->datatablemodels->getpostid($tillID);
            $tillAllPosted = $this->datatablemodels->allpostedvalue($tillID);
            
            if($cashieremail == "" || $addAmount ==""){
                $data = ['msgEror' =>"Please make sure all fields are filled"];
            }else if($tillAddmoney != '1'){
                $data = ['msgEror' =>"You cannot add Amount, make sure postFirst time = 1"];
            }else if($tillAllPosted == '1'){
               $data = ['msgEror' =>"You have posted an amount for that till before. Please contact Administrator"];
                
            }else{
                //Get the till balance
             $getTillbalance = $this->datatablemodels->gettillbalance($tillID);
             $getTillLimit = $this->datatablemodels->gettilllimit($tillID);
             
             if($addAmount > $getTillLimit){
                 $data = ['msgEror' =>"Cannot post that amount limit is $getTillLimit"];
             }else{
                 
                 $date = date('y-m-d');
                 $fullAmount = $getTillbalance + $addAmount;
                 $allposteed = '1';
                 $sessionEmail = $_SESSION['email'];
                 //Add the amount to the till balance
                 $newtillAmount = $this->datatablemodels->addnewmount($fullAmount, $allposteed, $tillID);
                 //Add the till history
                 $addHistory = $this->datatablemodels->addtillhistory($date, $addAmount, $tillName, $cashieremail, $_SESSION['email']);
                 
                 $data = ['msg' =>"Successfully Added, New till balance $fullAmount"];
                 
                 if($addHistory){
                  $messageaccount .= "<div> Cashier has been given a new amount</div> ";
                  $messageaccount .= "<div><b>Cashier Email</b> : $cashieremail</div>";
                  $messageaccount .= "<div><b>Till Name</b> : $tillName</div>";
                  $messageaccount .= "<div><b>Till ID</b> : $tillID</div>";
                  $messageaccount .= "<div><b>Till Limit</b> : $getTillLimit</div>";
                  $messageaccount .= "<div><b>Old Balance</b> : $getTillbalance</div>";
                  $messageaccount .= "<div><b>New Amount</b> : $addAmount</div>";
                  $messageaccount .= "<div><b>Till Balance</b> : $fullAmount</div>";
                  $messageaccount .= "<div><b>Posted By</b> : $sessionEmail</div>";
                  $messageaccount .= "<div><b>Date Posted </b>: $date</div>";
                
                  $fromEmail = "expensepro@c-iprocure.com";
                
                  $config = array(
                      'mailtype' => "html",
                  );

                  $this->email->initialize($config);
                  $this->email->from($fromEmail, 'TBS EXPENSE PRO'); 
                  $this->email->to('victor.ogiogio@c-ileasing.com');
                  $this->email->bcc('john.usuanlele@c-ileasing.com');
                  $this->email->cc('oladejo.lasisi@c-ileasing.com, adeyemi.adedokun@c-ileasing.com');
                  $this->email->subject('NEW AMOUNT ADDED TO CASHIER'); 
                  $this->email->message($messageaccount); 
                  $this->email->send();
                 }
                            
             }
             
             
            }
        }
         $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }    
        
} // End of Class Home
