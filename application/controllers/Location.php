<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class Location extends CI_Controller {

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
            redirect(base_url());
			
	}
        
        
        public function changelocation($id){
             $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            if($getApprovalLevel == 4 || $getApprovalLevel == 3 ){
            
            $title = "Expense Pro :: CHANGE LOCATION";
            
            $getResult = $this->mainlocation->getdexactresultfromdb($id);
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getResult'=>$getResult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('changetoanotherlocation', $values);
            
            }else{
                redirect(base_url());
            }
        }
        
        
        public function changegrouplocation(){
            
            $data = [];
		if(isset($_POST['groupName']) && isset($_POST['locationchanging']) ){
			
		// Declaring put putting all variables in Values
		$groupName = $this->input->post('groupName', TRUE);
                $locationchanging = $this->input->post('locationchanging', TRUE);
		
                //Check if it has been approved or not
                $idCheck = $this->tillbalances->checkidforlocation($locationchanging);
                
		if($locationchanging == "" ||  $groupName == ""){
                    $data = ['msg'=> 'Please select group location'];  // Please make sure asset Name , Cost and Date purchased is not empty
		} else 
                    if($idCheck == 4 || $idCheck == 7 || $idCheck == 11 || $idCheck == 12 ){
                    
                    $data = ['msg'=> 'You cannot change group location. Please ensure it has been approved and not rejected'];
                }
                else{
			// Insert into the Database;  $aCost, $fassetID, $refNo, $sessionID
			$dLocation = $this->tillbalances->changeupdatelocation($groupName, $locationchanging);
				
			$data = ['msg'=> 'Location Successfully Changed']; // 'Asset is now Schedule for Maintenance.'
			
			}  // End of Else { 
		
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
     
} // End of Class Home
