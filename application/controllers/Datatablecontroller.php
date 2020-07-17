<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
class Datatablecontroller extends CI_Controller {

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
		redirect("https://c-iprocure.com/moneybook/nopriveledge");
	}
         
      
      
    }   
    
    
	public function index()
	{
          redirect(base_url());
	}
        
        public function fetch_home(){
             $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $fetch_data = $this->datatablemodels->make_datatables($_SESSION['email']);
            
            $data = [];
            foreach($fetch_data as $row){
                $sub_array = array();
                $sub_array[] = $row->id;
                $sub_array[] = $row->dateCreated;
                $sub_array[] = $row->ndescriptOfitem;
                $sub_array[] = $row->dAmount;
                $sub_array[] = $row->nPayment;
                $sub_array[] = $row->approvals;
                
                $data[] = $sub_array;
            }
            
            $output = array(
                "draw"              =>  intval($_POST["draw"]),
                //"recordsTotal"      =>  $this->datatablemodels->get_all_data(),
                "recordsFiltered"   =>  $this->datatablemodels->get_filtered_data($_SESSION['email']),
                "data"              =>  $data
            );
           $this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
    
    
    
} // End of Class Home
