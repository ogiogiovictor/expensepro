<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class PhoneNumber extends CI_Controller {

	/**
	 * Name : Ogiogio Victor
	 * Phone : 07038807891
	 */
    
    public function __construct() {
        parent::__construct(); 
		
		
        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle'=>$pageTitle];
        $this->load->view('header', $values);
	//$this->gen->checkLogin();
    }   
    
    
    public function updaterecord() {
         $email = $this->session->email;
         $id = $this->session->id;
        $getphoneNumber = $this->generalmd->getsinglecolumn("phone", "cash_usersetup", "email", $email);
        
        if($getphoneNumber !=""){
             redirect('home/index');
        }else if ($email && $id) {
            $data = ['whichEmail' => $email, 'id' => $id];
            $this->load->view('update_profile', $data);
        } else {
            echo "Missing Authentication Token on Page, please contact Support";
        }
    }
     
    
    
  
    public function phoneUpdate() {
        $phone = $this->input->post('phoneNumber1', TRUE);
       
        $email = $this->session->email;
        $id = $this->session->id;
        
        if (empty($email) || empty($id)) {
            echo "Missing Authentication Token on Page, please contact Support";
        } else {
            //Do preg replace here
            // $preReplace = preg_replace(['0-9'], '', $phone);
            $updateTable = $this->generalmd->updateTableCol("cash_usersetup", "phone", $phone, "email", $email);
            if ($updateTable && ($email && $id)) {
                redirect('home/index');
            } else {
                echo "No post phone data";
            }
        } 
    }
    
} // End of Class Home
