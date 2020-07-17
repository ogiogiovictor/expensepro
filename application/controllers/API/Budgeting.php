<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Budgeting extends CI_Controller {

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
    
    
    public function index(){
    $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
    if($getApprovalLevel == 6 || $getApprovalLevel == 3){
        $title = "Expense Pro :: Settings Configuration";
        $sessionEmail =  $this->session->email;
        
        $userUnit = $this->generalmd->getuserAssetLocation("dUnit", "cash_usersetup", "email", $sessionEmail);
               
        //$getallaccounts = $this->generalmd->getaccountcodefromdb("unitaccountcode", "unit", $userUnit);
        
        //Get User Unit
       $credential = array('unit' => $userUnit);
        // Checking login credential for admin
       $query = $this->db->get_where('unitaccountcode', $credential);
       
        if ($query->num_rows() > 0) {
          $row = $query->row();
          //print_r($row);
        }
       print_r($query);
       exit();
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getSet'=>$getset, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('budget/bigbudget', $values);
        }else{
            redirect('/');
        }
    }
        
      
    
    
} // End of Class Home
