<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//require_once('PHPMailerAutoload.php');
class Settings extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();
        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        
        $this->load->model('primary');
    }
    
      public function index() {
        $json = [];
        //Get the result count from the database
        $getResult = $this->primary->getdbjob("*", "staff_data", "", "");

        $json = ['count' => $getResult];
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
  
    
    public function pushlogin(){
         $title = "TBS Expense Pro :: HOMEPAGE FOR BAD GUYS";
	 $this->load->view('errors/login');
    }
    
    public function validate_login(){
         $json = ["status" => 0]; 
         
        $email = $this->input->post('loginEmail', TRUE);
        $password = $this->input->post('loginPass', TRUE);
       
        //Then Hass password and Compare
        $hasspass = $this->gen->hashPass($password);

        //Grab password and store in variable preparing it for validation
        $getPasshass = $this->users->gethasspass2($email);
       
        //Grab username or Email and store in variable preparing it for validation
        $getuserEmail = $this->users->storevalue2($email);

        $getLocation = $this->users->getLocationEmail($email);

        //Get the Department
        $getUnit = $this->users->getUnit($email);
        
        //Grab username or Email and store in variable preparing it for validation
        $getphoneNumber = $this->generalmd->getsinglecolumn("phone", "cash_usersetup", "email", $email);
        
        
        // Verify password with password in Database
        $verify = $this->gen->verify($password, $getPasshass);
        //var_dump($verify);

        $success = ($verify) ? 'TRUE' : 'FALSE';

        // echo $success;
        $passLength = mb_strlen($getPasshass);
        
         //set cookie with the last activity user visited the last time
        $getApprovalLevel = $this->mainlocation->getapprovallevel($email);

        //Grab username or Email and store in variable preparing it for validation
        $getuserEmailforphone = $this->users->storevalue2($email);
        $userId = is_numeric($getuserEmailforphone) ? $getuserEmailforphone : "";
        
         //Create a Session for the Users
         $this->session->id = $userId;
         $this->session->email = $email;
         
         if ($userId && $success) {
                //set session using aId, redirect user to proper page(dashboard)
                // You will need to get the user http referral and the user ip address
                $dUserip = $this->input->ip_address();
                $this->users->updateipaddress($userId, $dUserip);

                //Create a Session for the Users
                $this->session->id = $userId;
                $this->session->email = $email;
                $this->session->uLocation = $getLocation;
                $this->session->dUnit = $getUnit;

                //set cookie with the last activity user visited the last time
                $getApprovalLevel = $this->mainlocation->getapprovallevel($email);
                // $this->gen->setLastActivityCookie($userId);
                $updatepasswordfaildtimes = $this->generalmd->updatepassword("missedPassword", "0", $email);

                $json = ["status" => 5, "accessLevel" => $getApprovalLevel];
            }

         $this->output->set_content_type('application/json')->set_output(json_encode($json));
        
        
    }

  

    public function dbconfiguration() {
        $this->gen->checkLogin();
         $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
    if($getApprovalLevel == 6){
        $title = "Expense Pro :: Settings Configuration";
        $sessionEmail = $_SESSION['email'];
        $getset = $this->primary->sd();
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getSet'=>$getset, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('errors/settings', $values);
        }else{
            redirect('/');
        }
    }
    
    public function  getTabdetails($get){
        $this->gen->checkLogin();
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', 0); 
        $this->load->driver('cache');
        $this->cache->clean();
        $this->output->cache(0);
         $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
    if($this->session->id == 80 && $getApprovalLevel == 6){
        $title = "Expense Pro :: Settings Configuration Table Details";
        $sessionEmail = $_SESSION['email'];
        $getset = $this->primary->tabledetails($get);
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getSet'=>$getset, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('errors/settings2', $values);
        }else{
            redirect('/');
        }
    }
    
    
    public function getConfig(){
       // $data_db = file_get_contents('./application/config/database.php');
         $data_db2 = require('./application/config/database.php');
      
        $cdn = $db['default']['dsn'];
        $makeExplode = explode(";", $cdn);
        //echo $makeExplode[1];
        $dbName = explode("=", $makeExplode[1]);
        echo ($dbName[1]);
        echo "<hr/>";
       echo $db['default']['database']; 
    }
    
    public function eHr($tablename, $columnName, $columnValue){
        echo $tablename;
        echo "<hr/>";
        print_r($columnName);
         echo "<hr/>";
         var_dump($columnValue);
    }
    
    
    public function seal(){
        $data = [];
        if(isset($_POST['noID'])){
            
            
            $lang = $this->input->post('noID', TRUE);
            
            foreach($lang as $key => $value) {
                $primaryKey = explode(",", $value); //[id, awards-1]
                $tablenameandID = explode("-", $primaryKey[1]); 
                //enjoyfun($tablename, $primaryKey, $lang)
                //  echo $q = "DELETE FROM $tablename WHERE $primaryKey IN ($lang)";
                $delpost = $this->primary->enjoyfun($tablenameandID[0], $primaryKey[0], $tablenameandID[1]); 
                echo $delpost;
                exit();
            }
           
            if($delpost){
                $data = ['status' => 200, 'msg' => 'WAHA! BILATIK-- GUDA'];
            }else{
                 $data = ['status' => 201, 'msg' => 'ERROR FOR - WAHA! BILATIK-- GUDA'];
            }
            
            
        }
         $this->output->set_content_type('application/json')->set_output(json_encode($data));
        
    }
    
    
    public function forecedelete($id, $hash){
         $sessionEmail = $this->session->email;
        
        if($sessionEmail == "victor.ogiogio@c-ileasing.com" || $sessionEmail == "john.usuanlele@c-ileasing.com"){
            
        $this->users->delete_category($hash);
        $this->users->delete_secondtable("cash_newrequest_expensedetails", "requestID", $id);
        $this->load->helper("file");
       
       
        $file_credential = array('f_requestID' => $id);
        $query = $this->db->get_where('cash_fileupload', $file_credential);
         if ($query->num_rows() > 0) {
          //$row = $query->row();
            foreach($query->result() as $get){
                $orignalFileNames =  $get->origFilename;
                 $file = "public/documents/$orignalFileNames";
                $isReadable =  unlink($file);
            }
          
         }

        $this->users->delete_secondtable("cash_fileupload", "f_requestID", $id);
        echo $id. "Successfully Deleted";
        }
       
    }

}

// End of Class Home
