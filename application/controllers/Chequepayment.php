<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
require_once (dirname(__FILE__) . "/maincontroller.php");
//require('./application/controllers/maincontroller.php');

//require_once('PHPMailerAutoload.php');
class Chequepayment extends Maincontroller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();


        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        $this->gen->checkLogin();
        $this->gen->mainSetting();

        //$this->load->library('PHPMailerfunction');
        $this->load->model('accountmodel');
    }

     

    public function confirm_paycheque($id) {
        $sessionID = $this->session->id;
        $getmenuAccess = $this->generalmd->getsinglecolumn("userid", "main_menu", "id", $id);
        
        //$explodeString = explode(",", $getmenuAccess);
        $checkAccess = $this->haveAccess($sessionID, $getmenuAccess);
        
        if($id == ""){
            redirect(base_url()."nopriveledge");
        }else if($checkAccess == TRUE){
             $getResult = $this->generalmd->getdresult("*", "cash_groupaccount", "", "");
            $gid = $this->automatedLoop($sessionID, $getResult);

            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $getallresult = $this->cashiermodel->getbygroupid_latest($gid, '3', '2');

            $title = "EXPENSE PRO :: ACCOUNTANT";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('chequerequestforotherlocations', $values);
        }else{
            $this->load->view('noaccesstoview');
        }
      
       
    }

}

// End of Class Home
