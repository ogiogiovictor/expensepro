<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('functions.php');
require_once (dirname(__FILE__) . "/Maincontroller.php");

class Verify extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('generalmd');
    }
            
     
    public function index(){
      
    }
    
     public function verifycode($email) {

        if ($email == "") {
            $this->load->view('login');
        } else {
            $yesPhone = $this->generalmd->getsinglecolumn("phone", "cash_usersetup", "email", $email);
            $mainNumber = $yesPhone != "" ? $yesPhone : "";
            $data = ['whichEmail' => $email, 'mPhone' => $mainNumber];
            $this->load->view('verifycodewithphone', $data);
        }
    }
    
    public function sendsms(){
        
       $postNumber = $this->input->post('phoneNumber');
       $postEmail = $this->input->post('email');
        
       
         //$sendphone = $this->generalmd->getuserAssetLocation("phone", "cash_usersetup", "email", $requesterEmail);
        $SMS =  rand(1111111, 9999999);
        //Upadte SMS Code Section 
        
        $confirm = Maincontroller::initiateSmsActivation($postNumber, $SMS); 
        $updateUser = $this->generalmd->updateTableCol("cash_usersetup", "sms", $SMS, "email", $postEmail);
        //$updateColumn2 = $this->generalmd->updateTableCol("account_payable", "paidTo", $payeeL, "fmrequestID", $requestID);
       
        
        
        
        $data = ['whichEmail' => $postEmail, 'mPhone' => $postNumber];
        $this->load->view('smscode', $data);
         
    }
    
    
    public function openaccount(){
        
        $smsCode = $this->input->post('smsCode');
        $postEmail = $this->input->post('email');
        
        //Upadte SMS CODE SECTION 
        $this->generalmd->updateTableCol("cash_usersetup", "missedPassword", "0", "email", $postEmail);
        
        //Upadte SMS CODE SECTION 
        $this->generalmd->updateTableCol("cash_usersetup", "accountStatus", "enabled", "email", $postEmail);
        
        $this->generalmd->updateTableCol("cash_usersetup", "sms", "", "email", $postEmail);
        
        redirect('https://c-iprocure.com/expensepro'); 
        
    }
	
	
}