<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class Register extends CI_Controller {

	/**
	 * Name : Ogiogio Victor
	 * Phone : 07038807891
	 */
    
    public function __construct() {
        parent::__construct(); 
		
		
        $pageTitle = "C&I :: TBS Expense Pro";
        $values = ['pageTitle'=>$pageTitle];
         if (!empty($_SESSION['email'])) {
            redirect('home/index');
        }
       // $this->load->view('header', $values);
	//$this->gen->checkLogin();
        $this->load->library('user_agent');
        if ($this->agent->browser() == 'Internet Explorer' && $this->agent->version() <= 10){
            redirect('https://c-iprocure.com/expensepro/login/version');
            echo "<center>We do not allow old version of Internet Explorer, Please use google chrome to view this page</center>";
        }else{
            return "";
        }
       
      
    }   
    
    
	public function index()
	{
            $title = "TBS Expense pro :: HOMEPAGE";
	
         
            //$menu = $this->load->view('menu', '', TRUE);
            //$sidebar = $this->load->view('sidebar', '', TRUE);
            //$footer = $this->load->view('footer', '', TRUE);
            //$values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getSessionDetails'=>$getSessionDetails, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('register');
			
	}
        
        
        public function registerUser(){
            
             //Declaring empty arrary for post variable in JSON form
        $data = [];
        
        $allowed_domains = array("c-ileasing.com");
       
        //*******Post Variable coming from general.js with required name *********//
        if (isset($_POST['fName']) && isset($_POST['semailAddress']) && isset($_POST['password'])) {
            /*   * *Getting post variables from javascript for and assign to a new PHP variable *** */
            $fName = $this->db->escape_str($this->input->post('fName', TRUE));
            $lname = $this->db->escape_str($this->input->post('lname', TRUE));
            $semailAddress = $this->db->escape_str($this->input->post('semailAddress', TRUE));
            //$semailAddress = $_POST['semailAddress'];
            $password = $this->input->post('password', TRUE);
            $sLocation = $this->input->post('sLocation', TRUE);
            $sUnit = $this->input->post('sUnit', TRUE);
            $confPassword = $this->input->post('confPassword', TRUE);

            //Returns True if useremail Exist
            $checkEmail = $this->mainlocation->checkemail($semailAddress);
            $email_domain = explode("@", $semailAddress);
            $email_domain = array_pop($email_domain);
            
            //Checking for empty values and sending error response
            if (empty($fName) || empty($lname) || empty($semailAddress) || empty($password) || empty($sLocation)) {
                $data = ['msg' => 'Please make sure all fields are field'];
            } else
            if (is_email($semailAddress) == '') {
                $data = ['msg' => 'Please enter a valid email address'];
            } else
            if ($password != $confPassword) {
                $data = ['msg' => 'Password does not match, please check password'];
            } else
            if (strlen($password) <= 6) {
                $data = ['msg' => 'Password must be more than 6 characters'];
            } else
            if ($checkEmail === TRUE) {
                $data = ['msg' => 'Email Already Exist in our Database'];
            } else 
            if(!in_array($email_domain, $allowed_domains)){
                 $data = ['msg' => 'Only Emails with @c-ileasing.com is allowed to register']; 
             }else {

                date_default_timezone_set('US/Eastern');
                $curtime = time();
                $datefordb = date('Y-m-d H:i:s', $curtime);
                
                $randomString = random_string('alnum', 40);
                //Hash Password using a strong algorithm and a salt
                $hasspass = $this->gen->hashPass($password);
                $accessLevel = '1';
                $insertedFileId = $this->mainlocation->addnewRegisteredUser($fName, $lname, $semailAddress, $hasspass, $sLocation, $sUnit, $accessLevel, $randomString);
                
                // Send Email to the User information user of the success
                if(!empty($insertedFileId)){
                          
                        //Send Result to javascript for processing
			
			$adminName = "TBS Expense Pro";
			$subject = "ACCOUNT ACTIVATION";
			
                        $topheader = "You have recieved this email because you registered for Expense Pro - Cash Transaction Register. Please click on the link below to verify and activate your status</a><br/>";
			
                       // $message .= "<a href=".base_url()."/login/activation/$insertedFileId/$randomString>Click Here</a>";
			$link = 'https://c-iprocure.com/expensepro/login/activation/'.$insertedFileId.'/'.$randomString.'';
                        
                        $linkraw = 'https://c-iprocure.com/expensepro/login/activation/'.$insertedFileId.'/'.$randomString.'';
                       
                        $values = ['topheader' => $topheader, 'link' => $link, 'linkraw' => $linkraw];
                        
                        $message = $this->load->view('emailtemplate', $values, TRUE);
                        
                        //sendEmail($sname, $semail, $rname="", $remail, $subject, $message, $replyToEmail="", $files="") 
			$sendMail = $this->gen->sendEmail($adminName, "info@c-iprocure.com", $fName, $semailAddress, $subject, $message, "info@c-iprocure.com", "");
                                    
                    $data = ['msg' => 'You have been successfully Created. An activation email has been sent to your email address, Please login to your email address to activate your account'];      
                }
               
                  
                
            }
        } // End of if(isset($_POST['email'])){

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
      
        
   
    
    public function version(){
       
        $this->load->view('oldversion', true);
    }
    
    
} // End of Class Home
