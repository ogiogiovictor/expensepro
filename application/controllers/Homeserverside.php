<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
class Homeserverside extends CI_Controller {

	/**
	 * Name : Ogiogio Victor
	 * Phone : 07038807891
	 */
    
    public function __construct() {
        parent::__construct(); 
		
	$this->load->model('mycustomrequestmodel');	
        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle'=>$pageTitle];
        $this->load->view('header', $values);
        //$this->load->model("datatablemodels"); 
	$this->gen->checkLogin();
      
    }   
    
    
 public function myrequestisent() {
        $fetch_data = $this->mycustomrequestmodel->makeDatabase($_SESSION['email']);
        
        $data = [];
        $randomString = random_string('alnum', 60);
        foreach ($fetch_data as $row) {
            $sub_array = array();

             $sub_array[] = $row->id;
             $sub_array[] = $row->dateCreated;
             $sub_array[] = "<span style='color:blue'>".$row->ndescriptOfitem. "</span>";
             $sub_array[] = @number_format($row->dAmount, 2);
             $approvals = $row->approvals;
             $sub_array[] = $this->adminmodel->getUsername($row->sessionID);
            
            
            if ($approvals == 0) {
                $sub_array[] = "Pending";
            } else if ($approvals == 1) {
                $sub_array[] = "<span style='color:red'>Awaiting HOD Approval</span>";
            } else if ($approvals == 2) {
                $sub_array[] = "<span style='color:blue'>Awaiting ICU Approval</span>";
            } else if ($approvals == 3) {
                $sub_array[] = "<span style='color:indigo'>Awaiting Payment</span>";
            } else if ($approvals == 4) {
                $sub_array[] = "<span style='color:green'>Ready for Collection</span>";
            } else if ($approvals == 5) {
                $sub_array[] = "<span style='color:red'>Not Approved By HOD</span>";
            } else if ($approvals == 6) {
               $sub_array[] = "<span style='color:grey'>Reject by ICU</span>";
            } else if ($approvals == 7) {
                $sub_array[] = "<span style='color:indigo'>Cheque Sent for Signature</span>";
            } else if ($approvals == 8) {
                $sub_array[] = "<span style='color:green'>Signed & Ready for Collection</span>";
            } else if ($approvals == 11) {
               $sub_array[] = "<span style='color:brown'>Closed</span>";
            } else if ($approvals == 12) {
               $sub_array[] = "<span style='color:brown'>Rejected By Accounts</span>";
            }
            
           
            
            $sub_array[] = "<a href='" . base_url() . "home/viewreqeuestdetails/$row->id/$approvals/$randomString'><button class='btn btn-xs btn-facebook'>View</button></a>";

            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->mycustomrequestmodel->getAll_data($_SESSION['email']),
            "recordsFiltered" => $this->mycustomrequestmodel->get_data_filtered($_SESSION['email']),
            "data" => $data
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
        
        
  
        
} // End of Class Home
