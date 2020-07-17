<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
//require_once('PHPMailerAutoload.php');
require_once (dirname(__FILE__) . "/Maincontroller.php");
class Accountcode extends CI_Controller {

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
        
	//$this->load->library('PHPMailerfunction');
        
	$putNewSession = $this->users->checkUserSession($_SESSION['email']);
            if($putNewSession === FALSE){
		redirect(base_url()."nopriveledge");
	}
         
      $this->load->model('maintenance');
      $this->load->helper('text');
      
    }   
    
    
	public function index()
	{
          redirect(base_url());
	}
        
        public function departmentaccountcode($email){
               $title = "Expense Pro :: ADD Account Code";
               $sessemail = $_SESSION['email'];
               //get all the result
               $getallaccounts = $this->mainlocation->getallaccounts();
               //Get the Unit the user belongs to
               $userUnit = $this->generalmd->getuserAssetLocation("dUnit", "cash_usersetup", "email", $sessemail);
               
               //Use the Units to return the account code
               $getaccountcodes = $this->generalmd->getaccountcodefromdb("unitaccountcode", "unit", $userUnit);
               $menu = $this->load->view('menu', '', TRUE);
               $sidebar = $this->load->view('sidebar', '', TRUE);
               $footer = $this->load->view('footer', '', TRUE);
               $values = ['title' => $title, 'allCodes'=>$getaccountcodes, 'accountCode' => $getallaccounts, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
               $this->load->view('addcode', $values);
           
        }
  
        
    public function addcode() {

        $data = [];
        //get data from post
        $codeaccountname = $this->input->post('codeaccountname', TRUE);
        $adddby = $this->session->email;
        
        //Use the Units to return the account code
        $getunitdetails = $this->generalmd->getaccountcodefromdb("codeact", "codeid", $codeaccountname);
        if($getunitdetails){
            foreach($getunitdetails as $get){
                $codeid = $get->codeid;
                $codeName = $get->codeName;
                $codeNumber = $get->codeNumber;
            }
        }
        //Get the Unit the user belongs to
        $userUnit = $this->generalmd->getuserAssetLocation("dUnit", "cash_usersetup", "email", $adddby);
        
        //$userCodeifExist = $this->generalmd->getuserAssetLocation("codeNumber", "unitaccountcode", "codeNumber", $codeNumber);
        $userCodeifExist = $this->generalmd->getsinglecolumnwithand("codeNumber", "unitaccountcode", "codeNumber", $codeNumber, "unit", $userUnit);
        if($userCodeifExist){
           $data = ['status' => 2, 'msg' => "Account Code Already Exist"]; 
        }else if($codeaccountname == ""){
             $data = ['status' => 0, 'msg' => "Please Choose an Account Code"]; 
        }else{
             /////////////////////////////////////// -- THE INSERTIO N--////////////////////////////////////////////////
            $dataoption = [];
            $dataoption['actID'] = $codeid;
            $dataoption['codeName'] = $codeName;
            $dataoption['codeNumber'] = $codeNumber;
            $dataoption['unit'] = $userUnit;
            $dataoption['addBy'] = $adddby;
            
             //Insert the Details on the Referal Table
            $myfulloptions = array(
                'table' => 'unitaccountcode',
                'data'  => $dataoption
	    );
            
/////////////////////////////////////////////////////////INSERT INTO THE FIELD TABLE ////////////////////////////////
	    $solidresponse = $this->generalmd->create($myfulloptions);
            $data = ['status' => 1, 'msg' => "Account Code Successfully Added"];
        }
        

        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    } 
        
    
    
     public function addvendor($email){
               $title = "Expense Pro :: Add Vendor";
               $sessemail = $_SESSION['email'];
               
               //Get the Unit the user belongs to
               $userUnit = $this->generalmd->getuserAssetLocation("dUnit", "cash_usersetup", "email", $sessemail);
               
             
               $getallvendors =  $this->maintenance->fromaintenance("*", "maintenance_workshop", "unitID", $userUnit);
              
               $menu = $this->load->view('menu', '', TRUE);
               $sidebar = $this->load->view('sidebar', '', TRUE);
               $footer = $this->load->view('footer', '', TRUE);
               $values = ['title' => $title, 'allUnitVendors'=>$getallvendors, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
               $this->load->view('addvendor', $values);
           
        }
        
    
      
      public function addvendorinmaintenance() {

        $data = [];
        
        $adddby = $this->session->email;
        
        //Get the Unit the user belongs to
        $userUnit = $this->generalmd->getuserAssetLocation("dUnit", "cash_usersetup", "email", $adddby);
       
        
        $vendorName = $this->input->post('vendorName', TRUE);
        $vendorEmail = $this->input->post('vendorEmail', TRUE);
        $vendorPhone = $this->input->post('vendorPhone', TRUE);
        $vendorAddress = $this->input->post('vendorAddress', TRUE);
        $dUnit = $this->input->post('dUnit', TRUE);
        
        $converted = strtolower(str_replace(' ', '', $vendorName));
        $getvendorName = $this->maintenance->fromaintenance("vendor_name_concat", "maintenance_workshop", "vendor_name_concat", $converted);
        
        $getvendorEmail = $this->maintenance->fromaintenance("workshop_email", "maintenance_workshop", "workshop_email", $vendorEmail);

        $getvendorPhone = $this->maintenance->fromaintenance("workshop_phone", "maintenance_workshop", "workshop_phone", $vendorPhone);
        
        $isPhone = is_phone_number($vendorPhone);
        $isEmail = is_email($vendorEmail);
       
        $isPalindrom = strtolower(strrev($vendorName));
        
        //$accessLevel = $this->generalmd->getuserAssetLocation("accessLevel", "cash_usersetup", "email", $this->session->email);
         
        if($getvendorName){
             $data = ['status' => 2, 'msg' => "Vendor Already Exist"]; 
        }else if($isPhone ==  ""){
            $data = ['status' => 3, 'msg' => "Please enter a Valid Phone Number"]; 
        }else if($vendorEmail !== "" && $isEmail ==  ""){
            $data = ['status' => 4, 'msg' => "Please enter a Valid Email Address"]; 
        }else if($getvendorName == $isPalindrom){
            $data = ['status' => 5, 'msg' => "You cannot use that vendor. A Palindrone"]; 
        }else if($getvendorEmail  == $vendorEmail){
            $data = ['status' => 6, 'msg' => "Vendor Already Exist, Vendor Name: ". $getvendorName]; 
        }else if($getvendorPhone  == $vendorPhone){
            $data = ['status' => 7, 'msg' => "Vendor Already Exist, Vendor Name: ". $getvendorName]; 
        }else{
             /////////////////////////////////////// -- THE INSERTIO N--////////////////////////////////////////////////
            $dataoption = [];
           // $dataoption['unitID'] = $userUnit;
            $dataoption['unitID'] = $dUnit;
            $dataoption['workshop_name'] = strtoupper($vendorName);
            $dataoption['vendor_name_concat'] = $converted;
            $dataoption['workshop_address'] = $vendorAddress;
            $dataoption['workshop_phone'] = $vendorPhone;
            $dataoption['workshop_email'] = $vendorEmail;
            $dataoption['status'] = "active";
            $dataoption['addedBy'] = $adddby;
            
             //Insert the Details on the Referal Table
            $myfulloptions = array(
                'table' => 'maintenance_workshop',
                'data'  => $dataoption
	    );
            
/////////////////////////////////////////////////////////INSERT INTO THE FIELD TABLE ////////////////////////////////
	    $solidresponse = $this->maintenance->create($myfulloptions);
            
//////////////////////////////// BEGINNING OF XML FOR SMS PRIME ////////////////////////////////////////////////////

///////////////////////////////// END OF SMS FOR SMS PRIME //////////////////////////////////////////////////////////            
            
            $data = ['status' => 1, 'msg' => "Vendor Successfully Added"];
        }
        

        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    } 
    
   
      
        
        
        
        public function allivendors(){
             $title = "Expense Pro :: Add Vendor";
               $sessemail = $_SESSION['email'];
               
               //Get the Unit the user belongs to
               $userUnit = $this->generalmd->getuserAssetLocation("dUnit", "cash_usersetup", "email", $sessemail);
               
             
               $getallvendors =  $this->maintenance->fromaintenance("*", "maintenance_workshop", "", "");
              
               $menu = $this->load->view('menu', '', TRUE);
               $sidebar = $this->load->view('sidebar', '', TRUE);
               $footer = $this->load->view('footer', '', TRUE);
               $values = ['title' => $title, 'allUnitVendors'=>$getallvendors, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
               $this->load->view('ivendors', $values);
        }
        
        
        public function loadmorevendors(){
            
            $this->load->model('generalmd');
            if(isset($_POST["limit"], $_POST["start"])){
                
                $getLoad = $this->generalmd->getajaxload($_POST["start"], $_POST["limit"]);
                if($getLoad){
                    echo $build = "<table class='table'><tr><th>ID</th><th>UNIT</th><th>WORKSHOP NAME</th><th>PHONE</th><th>EMAIL</th><th>STATUS</th></tr>";
                    foreach($getLoad as $get){
                        $id = $get->id;
                        $unit = $get->unitID;
                        $workshopName = $get->workshop_name;
                        $workshopPhone = $get->workshop_phone;
                        $workshopEmail = $get->workshop_email;
                        $workshopStatus = $get->status;
                        
                        echo $build ="<tr><td>$id</td><td>$unit</td><td>$workshopName</td><td>$workshopPhone</td><td>$workshopEmail</td><td>$workshopStatus</td></tr>";
                    }
                    echo $build = "</table>";
                }else{
                    echo $build = "";
                }
                
                
            }
        }
    
    
        
    
    
} // End of Class Home
