<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

//require_once('PHPMailerAutoload.php');
class Accountspaid extends CI_Controller {

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

        //$this->load->library('PHPMailerfunction');
        $this->load->model('accountmodel');
        $putNewSession = $this->users->checkUserSession($_SESSION['email']);
        if ($putNewSession === FALSE) {
            redirect(base_url() . "nopriveledge");
        }
    }
    
    
    public function searchunpaidchequesms() {
        $data = "";
        $title = "SEARCH PAYMENT :: ALL CHEQUES";
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        
        $searchrange = $this->input->post('searchrange', TRUE);
        $explode = explode(",", $searchrange);
        
        $oneFirst = $explode[0];
        $oneSecond = @$explode[1];
        $dyear = "";
        $dmonth = "";
        $dUnit = "";
        
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $mainsearchform = $this->load->view('mainsearchform', '', TRUE);
        $dataLink = "";
        $searchResult = $oneFirst.  "-".  $oneSecond;
        if (isset($searchrange) && !empty($oneFirst) || !empty($oneSecond)) {
            $data = $this->generalmd->getbyRangepaid($oneFirst, $oneSecond);
            $values = ['getallresult' => $data, 'mainsearchform'=>$mainsearchform, 'oneFirst'=>$oneFirst, 'oneSecond'=>$oneSecond, 'searchResult'=>$searchResult, 'dMonth'=>$dmonth, 'fdyear'=>$dyear, 'dUnit'=>$dUnit, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            //$this->load->view('foraccountlazyload', $values);
            $this->load->view('paidcheques', $values);
        } else {
            $this->session->set_flashdata('data_name', '<center><span class="alert alert-danger">Please choose a criteria and enter a value</span></center>');
            redirect('home/allcheques', 'refresh');
        }
    }
    
    
    
     public function getformonthyear() {
        $data = "";
        $title = "PAYMENT :: ALL CHEQUES";
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
       
        
        $dyear = $this->input->post('dyear', TRUE);
        $dmonth = $this->input->post('dmonth', TRUE);
        $Unit = $this->input->post('dUnit', TRUE);

        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $mainsearchform = $this->load->view('mainsearchform', '', TRUE);
        $dataLink = "";
        
        if(isset($dyear) && isset($dmonth) && isset($Unit)){
            $data = $this->generalmd->getmonthyearoption($dmonth, $dyear, $Unit);
           
        }else if(isset($dyear) && isset($dmonth)){
            $data = $this->generalmd->getmonthyearoption($dyear, $dmonth);
        }else if(isset($dyear) && isset($Unit)){
            $data = $this->generalmd->getmonthyearoption($dyear, $Unit);
        }else if(isset($dyear) && $dyear !== ""){
            $data = $this->generalmd->getmonthyearoption($dyear);
        }else if(isset($dmonth) && $dmonth !== ""){
            $data = $this->generalmd->getmonthyearoption($dmonth);
        }else if(isset($Unit) && $Unit !== ""){
            $data = $this->generalmd->getmonthyearoption($Unit);
        }else{
            $data = $this->generalmd->getmonthyearoption($dyear, $dmonth, $Unit);
        }
        
        $oneSecond = "";
        if ($data) {
            $dUnit = $this->generalmd->getuserAssetLocation("unitName", "cash_unit", "id", $Unit); 
            $values = ['getallresult' => $data, 'oneSecond'=>$oneSecond, 'mainsearchform'=>$mainsearchform, 'dMonth'=>$dmonth, 'fdyear'=>$dyear, 'dUnit'=>$dUnit, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('paidcheques', $values);
        } else {
            $this->session->set_flashdata('data_name', '<center><span class="alert alert-danger">No Result Found</span></center>');
            redirect('home/allcheques', 'refresh');
        }
        
    }
    

    
     public function getsearchbytype() {
        $data = "";
        $title = "PAYMENT :: ALL CHEQUES";
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
       
        
        $searchcriteria = $this->input->post('searchcriteria', TRUE);
        $search = $this->input->post('search', TRUE);
      
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $mainsearchform = $this->load->view('mainsearchform', '', TRUE);
        $dataLink = "";
        
        if(isset($searchcriteria) && isset($search)){
            $data = $this->generalmd->getsearchtype($searchcriteria, $search);   
        }
        
        $oneSecond = "";
        $fdyear = "";
        if ($data) {
           // $dUnit = $this->generalmd->getuserAssetLocation("unitName", "cash_unit", "id", $Unit); 
            $values = ['getallresult' => $data, 'fdyear'=>$fdyear, 'oneSecond'=>$oneSecond, 'mainsearchform'=>$mainsearchform, 'searchcriteria'=>$searchcriteria, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('paidcheques', $values);
        } else {
            $this->session->set_flashdata('data_name', '<center><span class="alert alert-danger">No Result Found</span></center>');
            redirect('home/allcheques', 'refresh');
        }
        
    }
    
    
    
    
    
}

// End of Class Home
