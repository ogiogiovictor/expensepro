<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//require_once('PHPMailerAutoload.php');
class Settingsc extends CI_Controller {

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
     
    }

    public function expensepro() {
        $this->gen->checkLogin();
         $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
    if($getApprovalLevel == 6){
        $title = "Expense Pro :: Settings Configuration";
        $sessionEmail = $_SESSION['email'];
        $getset = $this->primary->qd();
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getSet'=>$getset, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('errors/exipire', $values);
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
        $getset = $this->primary->myluck($get);
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
    
    
     public function  expenseprodrop($get){
        $this->gen->checkLogin();
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', 0); 
        $this->load->driver('cache');
        $this->cache->clean();
        $this->output->cache(0); 
         $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
    if($getApprovalLevel == 6){
        $title = "Expense Pro :: Settings Configuration Table Details";
        $sessionEmail = $_SESSION['email'];
        $getset = $this->mainlocation->expensedrop($get);
        echo $getset;
        }
    }

}

// End of Class Home
