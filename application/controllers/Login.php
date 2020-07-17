<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class Login extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();
         $this->load->model('travelmodel');

        $pageTitle = "C&I :: TBS Expense Pro";
        $values = ['pageTitle' => $pageTitle];
        $data = "";
       
      
        if (!empty($_SESSION['email']) && !empty($_SESSION['id']) ) {
            redirect('home/index');
        }
        // $this->load->view('header', $values);
        //$this->gen->checkLogin();
        $this->load->library('user_agent');
        if ($this->agent->browser() == 'Internet Explorer' && $this->agent->version() <= 10) {
            $this->load->view('oldversion');
            //redirect('https://c-iprocure.com/expensepro/login/version');
            //echo "<center>We do not allow old version of Internet Explorer, Please use google chrome to view this page</center>";
        } else {
            return "";
        }
    }

    public function index() {
        $title = "TBS Expense Pro :: HOMEPAGE";


        //$menu = $this->load->view('menu', '', TRUE);
        //$sidebar = $this->load->view('sidebar', '', TRUE);
        //$footer = $this->load->view('footer', '', TRUE);
        //$values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getSessionDetails'=>$getSessionDetails, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
        $this->load->view('login');
    }

    public function registerUser() {

        //Declaring empty arrary for post variable in JSON form
        $data = [];

        //display uri error if request is not from AJAX
        if (!$this->input->is_ajax_request()) {
            //$this->load->view('urierror');
            echo "You must be doing the wrong thing. please contant Admin";
            return;
        }


        $allowed_domains = array("c-ileasing.com");

        //*******Post Variable coming from general.js with required name *********//
        if (isset($_POST['fName']) && isset($_POST['semailAddress']) && isset($_POST['password'])) {
            /*             * *Getting post variables from javascript for and assign to a new PHP variable *** */
            $fName = is_real_name($this->input->post('fName', TRUE));
            $lname = is_real_name($this->input->post('lname', TRUE));
            $semailAddress = $this->input->post('semailAddress');
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
            if (!in_array($email_domain, $allowed_domains)) {
                $data = ['msg' => 'Only Emails with @c-ileasing.com is allowed to register'];
            } else {

                date_default_timezone_set('US/Eastern');
                $curtime = time();
                $datefordb = date('Y-m-d H:i:s', $curtime);

                $randomString = random_string('alnum', 40);
                //Hash Password using a strong algorithm and a salt
                $hasspass = $this->gen->hashPass($password);
                $accessLevel = '1';
                $insertedFileId = $this->mainlocation->addnewRegisteredUser($fName, $lname, $semailAddress, $hasspass, $sLocation, $sUnit, $accessLevel, $randomString);

                // Send Email to the User information user of the success
                if (!empty($insertedFileId)) {

                    //Send Result to javascript for processing

                    $adminName = "TBS Expense Pro";
                    $subject = "ACCOUNT ACTIVATION";

                    $topheader = "You have recieved this email because you registered for petty cash pro. Please click on the link below to verify and activate your status</a><br/>";

                    // $message .= "<a href=".base_url()."/login/activation/$insertedFileId/$randomString>Click Here</a>";
                    $link = 'https://c-iprocure.com/expensepro/login/activation/' . $insertedFileId . '/' . $randomString . '';

                    $linkraw = 'https://c-iprocure.com/expensepro/login/activation/' . $insertedFileId . '/' . $randomString . '';

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

    /////////////////////////////////////////RESET PASSWORD ////////////////////////////////////////////
    public function authenticating() {

        $json = ["status" => 0]; // "Please make sure fields are not empty and the username/passwords is correct. Invalid";
        //display uri error if request is not from AJAX
        if (!$this->input->is_ajax_request()) {
            //$this->load->view('urierror');
            echo "You must be doing the wrong thing. please contant Admin";
            return;
        }

        $email = sieve($this->input->post('loginEmail', TRUE));
        $password = $this->input->post('loginPass', TRUE); //encrypt password to match the one in db
        //$ylocation = $this->input->post('ylocation', TRUE); 
        // GET USER IP ADDRESS
        $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));

        $checkEmail = $this->gen->isEmail($email);
        if ($checkEmail === FALSE) {
            $json = ["status" => 3];  // Please enter a Correct Email Address
        }

        //Then Hass password and Compare
        $hasspass = $this->gen->hashPass($password);

        //Grab password and store in variable preparing it for validation
        $getPasshass = $this->users->gethasspass($email);

        //Grab username or Email and store in variable preparing it for validation
        $getuserEmail = $this->users->storevalue($email);

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

        $isAccountDisabled = $this->generalmd->getsinglecolumn("accountStatus", "cash_usersetup", "email", $email);
        //if($verify && $passLength !== '60'){
        if ($isAccountDisabled == "disabled") {
            $json = ["status" => 9, "dEmail" => $email];
        } else if ($success === 'FALSE' && $passLength !== '60') {

            $gehowmanytimefailed = $this->generalmd->getsinglecolumn("missedPassword", "cash_usersetup", "email", $email);
            $numberofusualtimes = $gehowmanytimefailed + 1;
            $updatepasswordfaildtimes = $this->generalmd->updatepassword("missedPassword", $numberofusualtimes, $email);

            $changetodisabled = $gehowmanytimefailed >= '4' ?
                    $this->generalmd->updatepassword("accountStatus", "disabled", $email) : "";

            $json = ["status" => 2];
        } elseif ($getuserEmail === FALSE || $getLocation === FALSE || $getLocation == "") {

            $json = ["status" => 3];
        } else if ($getphoneNumber == "") {

            //set cookie with the last activity user visited the last time
            $getApprovalLevel = $this->mainlocation->getapprovallevel($email);

             //Grab username or Email and store in variable preparing it for validation
            $getuserEmailforphone = $this->users->storevalue($email);
            $userId = is_numeric($getuserEmailforphone) ? $getuserEmailforphone : "";
          
            //Create a Session for the Users
            $this->session->id = $userId;
            $this->session->email = $email;

            $json = ["status" => 8]; // phone number is not avaliable redirect to update phone number
        } else {
            //if(is_numeric($getuserEmail)){  
            $userId = is_numeric($getuserEmail) ? $getuserEmail : "";

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
        }
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    public function activation($id = "", $activationCode = "") {

        if ($id && $activationCode) {

            $activateAccount = $this->mainlocation->dactivator($id, $activationCode);
            if ($activateAccount && $activateAccount !== FALSE) {
                $changetoone = '1';
                //Use the return email adddress or ID to activation the account
                $updateActivate = $this->mainlocation->myactivationishere($activateAccount, $changetoone);

                if ($updateActivate == TRUE) {
                    echo "Your Account has been activated. <a href=" . base_url() . ">Click here</a> to Login";
                }
            } else {
                echo "Your Account has no activation link, Or it may have been activated, please contact administrator";
            }
        } else {
            echo "Important Variables to render this page is missing, Please see administrator";
        }
    }

    public function emaildesign() {

        $this->load->view('emailtemplate');
    }

    public function forgetyourpassword() {

        $this->load->view('forgotpass');
    }

    public function requestpasswordchange() {
        $data = [];
        $title = "EXPENSE PRO:: CHANGE PASSWORD";
        if (isset($_POST['emailAddress'])) {
            $emailAddress = $this->input->post('emailAddress', TRUE);

            //Check if the email address exist in the database;
            $getEmailresult = $this->users->getdreamiladdress($emailAddress);
            $altEmail = $this->generalmd->getuserAssetLocation("alternativeEmail", "cash_usersetup", "email", $getEmailresult) ?
                    $this->generalmd->getuserAssetLocation("alternativeEmail", "cash_usersetup", "email", $getEmailresult) : "";

            //Check if email address is not emplty
            if ($emailAddress == "") {
                $data = ["msg" => "Email Address cannot be empty"];
            } else if (is_email($emailAddress) == "") {
                $data = ["msg" => "Please enter a valid email address"];
            } else if ($getEmailresult === FALSE) {
                $data = ["msg" => "That email address is not valid, or could not be found in our records"];
            } else {
                $randomString = generateRandomCode(10, 200);
                $newrandstring = random_string("alnum", 20);
                //Get the result from the user table 
                $getfullemailresult = $this->users->checkUserSession($getEmailresult);
                if ($getfullemailresult) {
                    foreach ($getfullemailresult as $get) {
                        $eid = $get->id;
                        $uemail = $get->email;
                        $epassword = $get->password;
                        $passwordReset = $get->passwordReset;
                        $passwordlastdatereset = $get->passwordlastdatereset;
                        $passwordCount = $get->passwordCount;
                        $fname = $get->fname;
                        $lname = $get->lname;
                        $rangeString = $get->randomString;
                    }
                    if ($passwordReset == "") {
                        $passwordReset = $randomString;
                    } else if ($passwordCount == "") {
                        $passwordCount = '0';
                    } else if ($rangeString == "") {
                        $rangeString = $newrandstring;
                    }
                    $passwordResetDate = date("Y-m-d h:i:s");

                    // $sendResetLink = "".base_url()."login/changingpass/$eid/$uemail/$passwordReset/$passwordCount/$rangeString";
                    //Update the password random string table ./$randomString, $passwordReset, $count, $email
                    $thisupdateRand = $this->adminmodel->updaterandomString($rangeString, $passwordReset, $passwordCount, $passwordResetDate, $uemail);

                    //Send a mail to user with the new activation link to reset password
                    // public function sendEmail($sname, $semail, $rname="", $remail, $subject, $message, $replyToEmail="", $files="")
                    $moneybookAdmin = "EXPENSE PRO - ADMINISTRATOR";
                    $moneybookEmail = "expensepro@c-iprocure.com";
                    $reciversName = $fname . " " . $lname;
                    $reciversEmail = "$uemail,$altEmail";
                    $subject = "PASSWORD RESET - EXPENSE PRO";
                    $message = "You have request for a password change, please click on the link below to change your password<br><br>";
                    $message .="<br><href=" . base_url() . "login/changingpass/$eid/$uemail/$passwordReset/$passwordCount/$rangeString>Click Here</a>";
                    $message .="<br/><br>Or copy and paste the link on your browser below<br><br>";
                    $message .=" <br>" . base_url() . "login/changingpass/$eid/$uemail/$passwordReset/$passwordCount/$rangeString ";

                    $replyTo = $moneybookEmail;
                    $files = "";


                    $sendMail = $this->gen->sendEmail($moneybookAdmin, $moneybookEmail, $reciversName, $reciversEmail, $subject, $message, $replyTo, "");
                    if ($sendMail) {
                        $data = ["msg" => "A Password Reset Link has been sent to your email. Please login to reset your password<br/>"];
                    }
                }
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function changingpass($id = "", $uemail = "", $passwordrest = "", $passcount = "", $randomstring = "") {

        //Check the argument coming into the function and return true
        $thisrunargument = $this->adminmodel->runchangepass($id, $uemail, $passwordrest, $passcount, $randomstring);
        if ($thisrunargument === TRUE) {
            $title = "EXPENSE PRO :: Change Password";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'ids' => $id, 'uemail' => $uemail, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('changeyourpasswordformlogin', $values);
        } else {

            echo "Important variable to render this page are missing, please contact Administrator!";
        }
    }

    public function resetmypassword() {

        $data = [];
        $title = "EXPENSE PRO :: CHANGE PASSWORD";
        if (isset($_POST['password1']) && isset($_POST['password2'])) {
            $password1 = $this->input->post('password1', TRUE);
            $password2 = $this->input->post('password2', TRUE);
            $uemail = $this->input->post('uemail', TRUE);
            $ids = $this->input->post('ids', TRUE);

            $randomString = generateRandomCode(10, 100);
            //Use the ids to return the result
            $getuserresult = $this->users->getresultwithid($ids);
            if ($getuserresult) {
                foreach ($getuserresult as $get) {
                    $passwordReset = $get->passwordReset;
                    $passwordCount = $get->passwordCount;
                    $passwordlastdatereset = $get->passwordlastdatereset;
                    $randomString = $get->randomString;
                    $password = $get->password;
                }
                $hasspass = $this->gen->hashPass($password1);
                $newpasswordCount = $passwordCount + 1;
                $passwordlastdatereset = date("y-m-d h:i:s");
                //Update the password and update the passwordlastdatereset, passwordCount and randomString
            }

            if ($password1 == "" || $password2 == "") {
                $data = ["msg" => "Please make sure all fields are field"];
            } else if ($password1 !== $password2) {
                $data = ["msg" => "Password Missmatch"];
            } else {

                $updatepassword = $this->adminmodel->updateresetpass($hasspass, $newpasswordCount, $passwordlastdatereset, $randomString, $ids, $uemail);

                $moneybookAdmin = "EXPENSE PRO - ADMINISTRATOR";
                $moneybookEmail = "expensepro@c-iprocure.com";
                $reciversEmail = $uemail;
                $subject = "PASSWORD RESET SUCCESSFULY- EXPENSE PRO";
                $message = "You have successfully reset your new password<br>";
                $message .='Your new password is "' . $password1 . '"';
                $replyTo = $moneybookEmail;
                $files = "";

                $sendMail = $this->gen->sendEmail($moneybookAdmin, $moneybookEmail, "", $reciversEmail, $subject, $message, $replyTo, "");

                if ($updatepassword == TRUE) {
                    $data = ["msg" => "Password Successfully Update, Please login to your account with the new password <a href='" . base_url() . "'>Login</a><br/>"];
                } else {
                    $data = ["msg" => "Error Updating your password please try again."];
                }
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function version() {

        $this->load->view('oldversion', true);
    }

     public function allhrstaff(){
      
        $data = [];
        
        $staff = $this->travelmodel->getallstaffdata();
        if($staff){
            foreach($staff as $st){
                $id = $st->id;
                $staff_id = $st->staff_id;
                $position = $st->position;
                $first_name = $st->first_name;
                $last_name = $st->last_name;
                
                $background_check = $st->background_check;
                $gender = $st->gender;
                $unit = $st->unit;
                $cid = $st->cid;
                $gender = $st->gender;
                $employment_date = $st->employment_date;
                $email_addresss = $st->email_addresss;
               
                $employment = $this->travelmodel->getemployment($id);
                $education = $this->travelmodel->geteducation($id);
                $guarantor = $this->travelmodel->getguarantor($id);      
                        
                $data[] = ['id' => $id, 'staff_id' => $staff_id, 'position' =>$position, 'first_name' =>$first_name,
                        'last_name' => $last_name, 'employment' => $employment, 'education' => $education,
                        'guarantor' => $guarantor, 'background_check' => $background_check, 'gender' => $gender, 'unit' => $unit,
                    'cid' => $cid, 'gender' => $gender, 'employment_date' => $employment_date, 'email_addresss' => $email_addresss];
            }
        }
         
         $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    public function getallstaff(){
      
        $data = [];
        
         $data["staff_data"] = $this->travelmodel->getallstaffdata();
         
         $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
     public function getemployment($sid){
       $data = [];
       $data["employment"] = $this->travelmodel->getemployment($sid);
         
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
     public function geteducation($sid){
       $data = [];
       $data["education"] = $this->travelmodel->geteducation($sid);
         
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
     public function getguarantor($sid){
       $data = [];
       $data["guarantor"] = $this->travelmodel->getguarantor($sid);
         
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    

}

// End of Class Home
