<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
class Validator extends CI_Controller {

    /**
     * Author : Ogiogio Victor
     * Phone : 07038807891 Email: ogiogiovictor@gmail.com
     *
     */
    public function __construct() {
        parent::__construct();
        //Load Model Here

        $values = "Code Igniter Validation";
        //$this->load->view('headers/header', $values);
        //$this->gen->checkLogin();
    }

    public function index() {
       if (!empty($_SESSION['cEmail'])) {
            redirect('dashboard/index');
        }
    }

    public function login(){
         //display uri error if request is not from AJAX
        if(!$this->input->is_ajax_request()){
            $this->load->view('urierror');
            return;
        }
        
        //for regular log in
        $this->input->post('login', TRUE) == 1 ? $this->loginVal() : "";
    }

    
     /**
     * Validates log in credentials
     * @return string
     */
    private function loginVal() {//to validate login form
        //set default value to return. This will change only if login details are correct
        $json = ['status'=>0];// "Incorrect Email/Password combination";
        
        $email = is_email($this->input->post('loginEmail', TRUE));
        $password = $this->input->post('password'); //encrypt password to match the one in db
        
        //Then Hass password and Compare
        $hasspass = $this->gen->hashPass($password);
        
        //call model function to validate email and password only if the email format is valid
        //$userId = $email ? $this->users->login($email, $hasspass) : ""; //function will return userId if login details match value in db
        //Grab password and store in variable preparing it for validation
         $getPasshass = $this->users->gethasspass($email);
         
         // Verify password with password in Database
         $verify = $this->gen->verify($password, $getPasshass);
        
          $success = ($verify) ? 'TRUE' : 'FALSE';
          $passLength = mb_strlen($getPasshass);
          
          //Grab username or Email and store in variable preparing it for validation
          $getuserEmail = $this->users->storevalue($email);
          
          //Grab username or Email and store in variable preparing it for validation
          $signupType = $this->primary->getsinglecolumn("sigupType", "usertable", "cEmail", $email);
        
          //if($verify && $passLength !== '60'){
        if($signupType != "regular" && $signupType == "google"){
            $json = ["status" => 5];  
        }else if($signupType != "regular" && $signupType == "facebook"){
            $json = ["status" => 6];  
        }else if ($success === 'FALSE' && $passLength !== '60') {
            $json = ["status" => 2];
        }else if ($getuserEmail === FALSE) {
            $json = ["status" => 3];
        } else {
            
            //if(is_numeric($getuserEmail)){  
            $userId = is_numeric($getuserEmail) ? $getuserEmail : "";
            if($userId && $success) {
                //set session using email AND userId, redirect user to proper page(dashboard)
                $this->session->cEmail = $email;
                $this->session->cid = $userId;

                //get user's full name to be displayed on the dashboard and put in session
                $this->session->csrv_md = $this->users->getrandID($userId);
                $this->session->fullname = $this->users->getfullname($userId);
                $this->session->firstname = $this->users->getfirstname($userId);
                $this->session->levelapproval = $this->users->getapprovallevel($userId);


                //set cookie with the last activity user visited the last time
                $this->gen->setLastActivityCookie($userId);
                $this->primary->updateUserStatus("usertable", "cid",  $userId);

                $json = ['status'=>1];//redirect to dashboard
            }
        }
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

}
