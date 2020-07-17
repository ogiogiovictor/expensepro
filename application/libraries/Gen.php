<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once './application/controllers/functions.php';
class Gen{

  protected $CI;
    
    public function __construct() {
        $this->CI = &get_instance();
    }
	
// to ensure input is in email format	
function isEmail($email){
    $email = stripslashes(trim($email));
    $email = strip_tags($email);
    $email = htmlentities($email);
    
    $email = filter_var($email, FILTER_SANITIZE_EMAIL); // sanitize email
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = strtolower($email); // change case to lower
        return $email;
    } else {
        return "FALSE"; // return empty string if error encountered
    }
}


// Verity password
 function verify($password, $hash) {
        return password_verify($password, $hash);
    }

 function pass_hass($password) {
        $algorithm = PASSWORD_DEFAULT;
        return password_hash($password, $algorithm);
    }
	
// Hash password
// Used to Hash Password with Salt
    function hashPass($password) {
        $algorithm = PASSWORD_DEFAULT;
        $options = ['cost' => 12];
        return password_hash($password, $algorithm, $options);
    }

     function hash_and_store($password) {
        $hash = password_hash($password);
        if (!hash) {
            return false;
        }
        return true;
    }
	
	function hash_pass($pword)
{
    $salt1 = "*&!mm3v6*_";
    $salt2 = "ki3fr+_@";
    
    $new_pword = hash('ripemd128', "$salt1$pword$salt2");
    
    return $new_pword;
}


	// Function to send mail 
    public function sendEmail($sname, $semail, $rname="", $remail, $subject, $message, $replyToEmail="", $files=""){
             
	$this->CI->email->from($semail, $sname);
        $this->CI->email->to($remail, $rname);
        $replyToEmail ? $this->CI->email->reply_to($replyToEmail, $sname) : "";
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);
	$this->CI->email->set_mailtype("html"); 
        
        //include attachment if $files is set
        if($files){
            foreach($files as $fileLink){
                $this->CI->email->attach($fileLink, 'inline');
            }
        }

        $send_email = $this->CI->email->send();
        
        
        return $send_email ? TRUE : FALSE;
    }
    

	public function checkLogin(){
        if(empty($_SESSION['id']) || empty($_SESSION['email'])){
        
            //redirect to log in page
            $currentUrl = $_SERVER['QUERY_STRING'] ? current_url() . "?" . $_SERVER['QUERY_STRING'] : current_url();
            
            redirect('http://localhost:8080/expenseprov2/login?red_uri='. urlencode($currentUrl));//redirects to login page
        }
        
        else{
            return "";
        }
    }
    
    /*
   public function checkbrowser(){
       $this->load->library('user_agent');
        if ($this->agent->browser() == 'Internet Explorer' && $this->agent->version() <= 9){
            redirect('http://localhost/expensepro/login/version');
        }else{
            return "";
        }
   }
    */
  
	/**
	 * Function check to the if the Userid Has access to a particular View
	 * @param type $userid
	 * @param type $returned Values
	 */
						
	 public function haveAccess($sess_id, $returnIDs){
		 
		 $finalResult = explode(",",$returnIDs);
		 
		 if(in_array($sess_id, $finalResult)){
			 return TRUE;
		 }else {
			 return FALSE;
		 }
	 }

         
       
 
    public function sendWelcomeMessage($name, $email){
        //set values to pass to view that will generate the message
        $data['name'] = $name;
        $data['email'] = $email;
        
        $message = $this->CI->load->view('welcome', $data, TRUE);
        
        
        $this->send_email('Smartag', 'noreply@smartagapp.com', $name, $email, "Welcome to Smartag", $message);
        
        
        //$this->sendCEOWelcomeMsg($name, $email);
        
        return "";
    }
	
	
	
	/**
     * Set cookie holding info about the last task user visited on last log in
     * @param type $userId
     */
    public function setLastActivityCookie($userId){
        /*
         * get cookie value in db
         * function header: getUserCol($selColName, $whereColName, $colValue)
         */
        
        $cookieValue = $this->CI->users->getUserCol('lastActivityVisited', 'id', $userId);

        //set cookie only if value is not empty
        if($cookieValue){
            setcookie('__w212ik_', $cookieValue, time()+'60 * 60 * 24 * 30', '/', '', '', '');
        }
        
        return "";
    }
    
    
    public function mainSetting(){
        $myset = require('./application/config/database.php');
        $cdn = $db['default']['settings'];
       
        $totalCount = $this->CI->users->getCountone();
        
        if($totalCount > $cdn) {
           // return FALSE;
            if(isset($_SESSION['id'])){
                unset($_SESSION['id']);
                unset($_SESSION['email']);
            }
          redirect('http://localhost:8080/expenseprov2/login');
            
        }else if($cdn === ""){
            //return 'no access';
             if(isset($_SESSION['id'])){
                $this->session->sess_destroy();
                unset($_SESSION['id']);
                unset($_SESSION['email']);
            }
           redirect('http://localhost:8080/expenseprov2/login');
        }
    }
    
    public function mkdirAndCopyFiles($userCode){
        $this->CI->load->library('ftp');
        
        $this->CI->ftp->connect();
        
        //make dir for user creating a folder to hold all his tasks and another for his profile pics
        $this->CI->ftp->mkdir("../smartfiles/users/$userCode/", 0755);//create user's folder
        //$this->CI->ftp->mkdir("../smartfiles/users/$userCode/tasks/", 0755);//folder to hold all tasks
        $this->CI->ftp->mkdir("../smartfiles/users/$userCode/profile_pics/", 0755);//profile pictures folder
        $this->CI->ftp->mkdir("../smartfiles/users/$userCode/pc/", 0755);//folder  for files shared in a personal chat
        $this->CI->ftp->mkdir("../smartfiles/users/$userCode/conf/", 0755);//folder for files shared in a video call/conference


        //copy an index html file to directories to prevent access to the the folder contents from URL
        $this->CI->ftp->upload("../smartfiles/users/index.html", "../smartfiles/users/$userCode/index.html");
        //$this->CI->ftp->upload("../smartfiles/users/index.html", "../smartfiles/users/$userCode/tasks/index.html");
        $this->CI->ftp->upload("../smartfiles/users/index.html", "../smartfiles/users/$userCode/profile_pics/index.html");
        $this->CI->ftp->upload("../smartfiles/users/index.html", "../smartfiles/users/$userCode/pc/index.html");
        $this->CI->ftp->upload("../smartfiles/users/index.html", "../smartfiles/users/$userCode/conf/index.html");
        
        $this->CI->ftp->close();
        
        return "";
    }
    
    
      public function setSessionData($userId, $userCode, $email, $firstName, $lastName, $profilePic=""){
        $_SESSION['userId'] = $userId;
        $_SESSION['userCode'] = $userCode;
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $firstName . " " . $lastName;
        $_SESSION['profilePic'] = $profilePic;
        
        return "";
    }
    
    
    
     public function handleNewSocialSignUp($email, $password, $firstName, $lastName, $socialAccount, $gender="", $socialId=""){
        //insert user info into db
        //model header: addUser($email, $password, $firstName, $lastName, $userCode, $signupType, $gender="")

        /*
         * generate two random numbers placing an underscore in between them
         * and use as usercode. This should reduce the possibility of two users having the same usercode
         */
        //set userCode
        $rd = "sc";//strstr(strtoupper($socialAccount), 2);

        $userCode = generateRandomCode(5, 15, $rd);


        $insertedId = $this->CI->users->addUser($email, $password, $firstName, $lastName, $userCode, $socialAccount, $gender);

        //create dir for new user
        mkdirAndCopyFiles($userCode);//functions.php

        //create sessions
        $this->setSessionData($insertedId, $userCode, $email, $firstName, $lastName);

        //insert user's social details into table
        //function header: insertSocialDetails($userId, $socialId, $socialName) in model 'globalmodel'
        $socialId ? $this->CI->globalmodel->insertSocialDetails($insertedId, $socialId, $socialAccount) : "";

        //send welcome message to user
        $this->sendWelcomeMessage($firstName, $email);

        redirect('dashboard/activities');
    }
    
    
      /**
     * Ensure request is an AJAX request
     * @return string
     */
    public function ajaxOnly(){
        //display uri error if request is not from AJAX
        if(!$this->CI->input->is_ajax_request()){
            redirect(base_url());
        }
        
        else{
            return "";
        }
    }
    
    
    /**
     * Creates thumbnail of an image
     * @param type $relFilePath
     * @return boolean
     */
    public function createThumb($relFilePath){
        
        $config['image_library'] = 'gd2';
        $config['source_image'] = $relFilePath;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = 320;
        $config['height']         = 50;

        $this->CI->load->library('image_lib', $config);

        if (!$this->CI->image_lib->resize()) {
            return FALSE;
        }
        
        else{
            return TRUE;
        }
    }
    
    
    
    public function generateRandomCode($minLength, $maxLength, $delimiter = "_"){
      //randomly generate the final length of the string we want to generate, ensuring it's between the min and max length provided by the user
      $totLength = rand($minLength, $maxLength-1);//($maxLength - 1) is used in order to accommodate the delimiter without going beyond the maxLength

      //determine the number of string to generate before and after the delimiter
      $b4_ = rand(1, $totLength-1);//number of strings before the delimiter
      $afta_ = $totLength - $b4_;//number of strings after the delimiter

      //CI's random_string function
      $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

      //generate the two strings
      $rand_1 = substr(str_shuffle(str_repeat($pool, ceil($totLength / strlen($pool)))), 0, $b4_);
      $rand_2 = substr(str_shuffle(str_repeat($pool, ceil($totLength / strlen($pool)))), 0, $afta_);

      //merge the strings separating them with the delimiter
      $rand_str = $rand_1 . $delimiter . $rand_2;

      return $rand_str;
    }


   
                  
 
    public function check_menu_access($id){
        
        $recievableAccess = $this->CI->generalmd->getsinglecolumn("userid", "main_menu", "id",  $id);
        $whichRecivable = $this->haveAccess($_SESSION['id'], $recievableAccess);
        if($whichRecivable){
            return true;
        }else{
            return false;
        }
    }

	
}