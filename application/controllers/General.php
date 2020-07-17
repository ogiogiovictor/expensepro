<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class General extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();


        $pageTitle = "C&I :: Expense Pro Setup";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        $this->gen->checkLogin();
    }

    public function index() {
        redirect(base_url());
    }

   public function totalrequesthod(){
       
   }
   
   public function checktillhistory($email, $tillname){
           $title = "Cashiers Till History";
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            if($getApprovalLevel == 6 || $getApprovalLevel == 3){	
                
            $gettillrequest = $this->assets->gettillhistory($email, $tillname);
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'gettillrequest'=>$gettillrequest, 'getApprovalLevel'=>$getApprovalLevel, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('cashierstillhistory', $values);
            
            }else{
                $this->load->view('noaccesstoview');
            }
       
   }
// End of Main Search Category 
}

// End of Class
