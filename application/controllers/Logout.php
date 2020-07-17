<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('functions.php');

class Logout extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
            
   
       
    public function index(){
       
    if(isset($_SESSION['id'])){
        $this->pagelogout->destroyall($_SESSION['id']);
        
         $dataoptionotify['loggedout_asset'] = 0;
                //Insert the Details on the Referal Table
                $myfulloptionsnotify = array(
                    'table' => 'cash_usersetup',
                     'data'  => $dataoptionotify
                );
          //Insert into notifications
      $solidresponse = $this->pagelogout->updateExpensepro("id", $this->session->id, $myfulloptionsnotify );
      
        $this->session->sess_destroy();
        
        unset($_SESSION['id']);
	unset($_SESSION['email']);
        
        /*
        * unset all cookies
        * //Thanks to http://stackoverflow.com/questions/2310558/how-to-delete-all-cookies-of-my-website-in-php
        *
		*/
		
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }
        
        session_write_close();
        
        redirect(base_url());
        
        }else{
            redirect(base_url());
        }
    }
	
	
}