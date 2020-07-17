<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
class Howorks extends CI_Controller {

	/**
	 * Name : Ogiogio Victor
	 * Phone : 07038807891
	 */
    
    public function __construct() {
        parent::__construct(); 
		
		
        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle'=>$pageTitle];
        $this->load->view('header', $values);
         $this->load->library('user_agent');
        if ($this->agent->browser() == 'Internet Explorer' && $this->agent->version() <= 10){
             $this->load->view('oldversion');
            //redirect('https://c-iprocure.com/expensepro/login/version');
            //echo "<center>We do not allow old version of Internet Explorer, Please use google chrome to view this page</center>";
        }else{
            return "";
        }
	
    }   
    
    
	public function index()
	{
         $title = "TBS Expense Pro :: HOMEPAGE";
	
            $this->load->view('howitworks', $title);
	}
        
    
} // End of Class Home
