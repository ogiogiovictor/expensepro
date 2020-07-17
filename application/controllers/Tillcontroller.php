<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
class Tillcontroller extends CI_Controller {

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
        
        
        public function amountcollect($tillname){
             $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            if($getApprovalLevel == 4 ){
            
        
            $title = "Expense Pro :: MY TILL";
            
            $getResult = $this->mainlocation->cashierstillwithtype($_SESSION['email'], $tillname);
            //$getResult = $this->mainlocation->getnewrequestbycashier($_SESSION['email']);
            //var_dump($getResult);
            //$sendTillHistory = $this->tillbalances->gettotalamountcollected($_SESSION['email']);
           $sendTillHistory = $this->tillbalances->tillhistorynow($_SESSION['email'], $tillname);
            
            $menu = $this->load->view('menu', '', TRUE);
             $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'tillname'=>$tillname, 'sendTillHistory'=>$sendTillHistory, 'getResult'=> $getResult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('cashiersamountcollected', $values);
            
            }else{
                redirect(base_url());
            }
        }
        
     
} // End of Class Home
