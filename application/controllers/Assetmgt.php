<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
class Assetmgt extends CI_Controller {

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
    
    
	public function index()
	{
             $title = "Asset Management :: HOMEPAGE";
             $email = $this->session->email;
             $id = $this->session->id;
             $fname = $this->generalmd->getuserAssetLocation("fname", "cash_usersetup", "id", $this->session->id);
             $lname = $this->generalmd->getuserAssetLocation("lname", "cash_usersetup", "id", $this->session->id);
             $getAsset = $this->generalmd->getuserAssetLocation("contratMgt", "cash_usersetup", "id", $this->session->id);
             $fullname = $fname." ".$lname;
              $isLogged = $this->generalmd->getuserAssetLocation("loggedout_asset", "cash_usersetup", "id", $this->session->id);
             $values = ['email' => $email, 'isLogged'=>$isLogged, 'fname'=>$fullname, 'id'=>$id, 'haveAccess'=> $getAsset];
            $this->load->view('forassetmgt', $values);
			
	}
        
        
    
    
        public function joborder()
	{
            $title = "EXPENSE PRO :: HOMEPAGE";
	$title = "C&I ::Owned Asset";
	$sessID = $this->session->id;
        $getAllAcess = "";
	//Get second level approval ID
	 $getLevelApprove = $this->users->getSecondlevelapproval($_SESSION['id']);
	
        //$get all Reesult 
	$getallresult = $this->mainlocation->getdetailsofrequestwithsession($_SESSION['email']);
			
	//Get Session Details
	$getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
          $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         if($getApprovalLevel == 2){
            $getAllAcess = $this->assets->awaitingapprovalbylocaldept($_SESSION['email']);
           
         }
         
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getAllAcess'=>$getAllAcess, 'getLevelApprove'=>$getLevelApprove, 'getApprovalLevel'=>$getApprovalLevel, 'getSessionDetails'=>$getSessionDetails, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('joborderstatement', $values);
			
	}
        
        
        
        
  public function viewawaitingapproval($id){
      
        $getAllAccess = $this->assets->getIDforMaintenance($id, $_SESSION['email']);
     
        $title = "EXPENSE PRO :: HOMEPAGE";
	$title = "C&I ::Owned Asset";
	$sessID = $this->session->id;
		
	//Get second level approval ID
	 $getLevelApprove = $this->users->getSecondlevelapproval($_SESSION['id']);
	
        //$get all Reesult 
	$getallresult = $this->mainlocation->getdetailsofrequestwithsession($_SESSION['email']);
			
	//Get Session Details
	$getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
          $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         if($getLevelApprove == 2 && $getApprovalLevel == 2 && $getAllAccess){
           
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'mid'=>$getAllAccess, 'getLevelApprove'=>$getLevelApprove, 'getApprovalLevel'=>$getApprovalLevel, 'getSessionDetails'=>$getSessionDetails, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('viewawaitingapproval', $values);
            
          }else{
            $this->load->view('noaccesstoview');  
          }
	
	}
        
        
        
       
     public function approveformaintenance(){
		
		$data = [];
			if(isset($_POST['assetID'])){
			
			// Declaring put putting all variables in Values
			$assetID = $this->input->post('assetID', TRUE);
			$recomm = $this->input->post('recomm', TRUE);
			$theID = $this->input->post('theID', TRUE);
			$vendorchoice = $this->input->post('vendorchoice', TRUE);
			$schDate = $this->input->post('schDate', TRUE);
			$sessionID = $this->session->id;
			$approved = '1';
			if($assetID == "" || $recomm == "" ){
				
				$data = ['msg'=> 'Please enter a Recommendation'];  // Please make sure asset Name , Cost and Date purchased is not empty
			}
			else{
						
				// Insert into the Database;  $aCost, $fassetID, $refNo, $sessionID
			$setupfromjson = $this->assets->approvedformaintenance($theID, $assetID, $vendorchoice, $approved, $recomm, $sessionID);
			$addComent = $this->assets->addallComments($theID, $recomm, $sessionID);
                        $sessionEmail = $_SESSION['email'];
                        $this->load->model('cmaintenance');
                        $getOwnersEmail = $this->cmaintenance->joborderhod($assetID);
                         $getassetName = $this->cmaintenance->getmaintenaceassetname($assetID);
                         $getproblem = $this->cmaintenance->getdproblem($assetID);

                        $getfullnameofasset = $this->cmaintenance->alloAssetName($getassetName);
                        
                        if ($setupfromjson) {

                            $this->email->to($getOwnersEmail);
                            $this->email->from($sessionEmail);
                            $this->email->reply_to($sessionEmail);
                            $this->email->subject('JOB ORDER HAS BEEN APPROVED - CREATE YOUR REQUISITION NOW');
                            $message = "Job Order sent by you for this request <b>$getfullnameofasset</b> has been approved<br/>";
                            $message .= "<br/>Asset Name : $getfullnameofasset";
                            $message .= "<br/>Problem : $getproblem<br/>";
                            $message .= "Please check the link below to view the approved requisition to generate";
                            $message .= "<a href='https://c-iprocure.com/asset/maintenance/requisition/>Click here</a>";
                            $this->email->message($message);
                            $this->email->set_mailtype("html");
                            $this->email->send();
                        }

                        $data = ['msg'=> 'Job Order has been approved.' ]; // 'Asset is now Schedule for Maintenance.'
				
			}  // End of Else { 
		
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}   
        
        
     //NOT APPROVED FOR MAINTENANCE
	public function notapproveformaintenance(){
		
		$data = [];
			if(isset($_POST['assetID'])){
			
			// Declaring put putting all variables in Values
			$assetID = $this->input->post('assetID', TRUE);
			$recomm = $this->input->post('recomm', TRUE);
			$theID = $this->input->post('theID', TRUE);
                        $dreasonID = $this->input->post('dreasonID', TRUE);
                        $vendorchoice = $this->input->post('vendorchoice', TRUE) ? $this->input->post('vendorchoice', TRUE) : "";
			$sessionID = $this->session->id;
			$notapproved = '2';
                        $vendorchoicenoid =  "";
			if($assetID == "" || $recomm == "" ){
				
				$data = ['msg'=> 'Please enter a Recommendation'];  // Please make sure asset Name , Cost and Date purchased is not empty
			}
			else{
						
				// Insert into the Database;  $aCost, $fassetID, $refNo, $sessionID
				$setupfromjson = $this->assets->approvedformaintenance($theID, $assetID, $vendorchoicenoid, $notapproved, $recomm, $sessionID);
				
                                $status ="0";
                                //Now change back the 1 to 0 in the insurance/warranty table
                                $changedreasonStatus = $this->assets->updateinsurcepolicy($dreasonID, $status);
                                $addComent = $this->assets->addallComments($theID, $recomm, $sessionID);
                                
                                 $sessionEmail = $_SESSION['email'];
                                $this->load->model('cmaintenance');
                                $getOwnersEmail = $this->cmaintenance->joborderhod($assetID);
                                 $getassetName = $this->cmaintenance->getmaintenaceassetname($assetID);
                                 $getproblem = $this->cmaintenance->getdproblem($assetID);

                                $getfullnameofasset = $this->cmaintenance->alloAssetName($getassetName);
                        
                                if ($setupfromjson) {

                                $this->email->to($getOwnersEmail);
                                $this->email->from($sessionEmail);
                                $this->email->reply_to($sessionEmail);
                                $this->email->subject('JOB ORDER HAS BEEN REJECTED');
                                $message = "Job Order sent by you for this request <b>$getfullnameofasset</b> has been rejected<br/>";
                                $message .= "<br/>Asset Name : $getfullnameofasset";
                                $message .= "<br/>Problem : $getproblem<br/>";
                                $message .= "Please check the link below to view the rejected job order";
                                $message .= "<a href='https://c-iprocure.com/asset/maintenance/viewjoborder/>Click here</a>";
                                $this->email->message($message);
                                $this->email->set_mailtype("html");
                                $this->email->send();
                            }
                
                            
				$data = ['msg'=> 'Request Reject, Please wait..' ]; // 'Asset is now Schedule for Maintenance.'
				
			
				
			}  // End of Else { 
		
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	   
     
} // End of Class Home
