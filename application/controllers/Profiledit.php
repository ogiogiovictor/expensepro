<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class Profiledit extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();


        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        //$this->load->model("datatablemodels"); 
        $this->gen->checkLogin();
    }

    public function index($email) {
        $title = "EXPENSE PRO :: EXPENSE BY YEAR";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        
        if($_SESSION['email'] == $email){
            
        //use the session email to result result
        $getRequest = $this->allresult->getmysessionresult($_SESSION['email']);
        $getLocale = $this->mainlocation->getalllocation();
        $getUnit = $this->mainlocation->getallunit();
       
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getLocale'=>$getLocale, 'getUnit'=>$getUnit, 'getRequest'=>$getRequest, 'email'=>$email, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('updatedetails', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }

    
    
    public function updatedetails(){
         $data = [];
        if(isset($_POST['pEmail'])){
            
            $pEmail = $this->input->post('pEmail', TRUE);
            $altEmail = $this->input->post('altEmail', TRUE);
            $phoneNum = $this->input->post('phoneNum', TRUE);
            $fUnit = $this->input->post('fUnit', TRUE);
            $fLocation = $this->input->post('fLocation', TRUE);
            $lname = $this->input->post('lname', TRUE);
            $fname = $this->input->post('fname', TRUE);
            
            if(empty($pEmail)){
               $data = ['msg' => "Please your primary email cannot be empty"]; 
            }else{
               
                $updatePinfo = $this->assets->changeupdateprofile($fname, $lname, $fLocation, $fUnit, $phoneNum, $altEmail, $pEmail);
                $data = ['msg' => "Your information has been successfully Updated"]; 
            }

        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
        
    }
    
    
}

// End of Class Home
