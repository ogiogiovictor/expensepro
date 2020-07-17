<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
//require_once('PHPMailerAutoload.php');
class Vendors extends CI_Controller {

	/**
	 * Name : Ogiogio Victor
	 * Phone : 07038807891
	 */
    
    public function __construct() {
        parent::__construct(); 
	
        $pageTitle = "C&I :: Vendor Manager";
        $values = ['pageTitle'=>$pageTitle];
        $this->load->view('header', $values);
	$this->gen->checkLogin();
        $this->load->model('assets');
        $this->load->model('maintenance');
	
    }   
    
    
   public function index(){
      $title = "Vendor Management";
     $sessionID = $this->session->id;
     $getUnit = $this->generalmd->getuserAssetLocation("dUnit", "cash_usersetup", "id", $sessionID);
     
     $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
    
        if($getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 7){
            $getallVendors = $this->assets->getvendorsbyunitforicuaccount();
        }else{
            $getallVendors = $this->assets->getvendorsbyunit($getUnit);
            
           
        }
        
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title,  'getallVendors' => $getallVendors, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];

        $this->load->view('vendorbyunits', $values);
   }
       
   
   public function getdetails($id){
        $title =  "Details of Payment";
        $getallRequest = $this->assets->getallrequestin($id);
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title,  'getallRequest' => $getallRequest, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];

        $this->load->view('paymentdetailsforvendors', $values);
        
   }
        
} // End of Class Home
