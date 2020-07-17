<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admininistrator extends CI_Controller {

	/**
	 * Name : Ogiogio Victor
	 * Phone : 07038807891
	 */
    
    public function __construct() {
        parent::__construct(); 
		
		
        $pageTitle = "C&I :: Expense Pro Setup";
        $values = ['pageTitle'=>$pageTitle];
        $this->load->view('header', $values);
	$this->gen->checkLogin();
    }
    
	public function index()
	{
            redirect(base_url());
	}
        
        
     public function icuapproval(){
     
     $data = [];
     if(isset($_POST['icuacceptrequestID'])){
         
         $sessionID = $_SESSION['email'];
         
         $icuacceptrequestID = $this->input->post('icuacceptrequestID', TRUE);
         $groupIDinICU = $this->input->post('groupIDinICU', TRUE);
         $mainAmount = $this->input->post('mainAmount', TRUE);
         
         $getUserID = $this->adminmodel->getuserID($sessionID);
         //Use the group to get the limit
         $getUserLimit = $this->mainlocation->geticulimitofuser($getUserID, $groupIDinICU);
         
         if($icuacceptrequestID == ""){
           $data = ['msgError'=>'Important variable to render this page is missing, Please contact Administrator'];  
         }else{
         
          // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod)
         //approve = 3(approved by ICu), approve = 4 (Payment Made) , approve = 5(Rejected)
         $approve = '3';
                  
         $updateApprove = $this->mainlocation->updaterequestbyicu($approve, $icuacceptrequestID, $sessionID);
         
         //Insert all approval in this table approvalnewrequest
         //$updateApprove = $this->mainlocation->dapprovalforequest($acceptrequestID, $hodEmail,  $dComment, $sessionID);
         
         //Use the asset ID to return the Email of the Person that sends the request
         $getEmailofOwner = $this->mainlocation->emailownerrequest($icuacceptrequestID);
         
         //The Description of Item
         $getDescription = $this->mainlocation->descriptionofitem($icuacceptrequestID);
         
         
         
            if($getEmailofOwner){
                
                $message = "<p> Your request with the following description '".$getDescription."' has been verified by $sessionID in Inter Control Unit</p> ";
                
                $fromEmail = "expensepro@c-iprocure.com";
                
                $config = array(
                    'mailtype' => "html",
                );
                
                $this->email->initialize($config);
                $this->email->from($fromEmail, 'TBS EXPENSE PRO'); 
                $this->email->to($getEmailofOwner);
                $this->email->subject('YOUR REQUEST HAS BEEN VERIFIED'); 
                $this->email->message($message); 
                $this->email->send();
              } 
          
         
         $getcashieroraccount = $this->mainlocation->getcashierandaccount($icuacceptrequestID);
         if($getcashieroraccount){
             
             foreach($getcashieroraccount as $get){
                 $dcashiers = $get->cashiers;
                 $dAccountgroup = $get->dAccountgroup;
                 
                 if($dcashiers !='null' || $dcashiers !== ""){
                   
                    $message .= "<p> You have a new request awaiting payment verification, please click the link below</p> ";
                    
                    $message .= "<p><a href='".base_url()."'home/myapproval'>Click Here</a></p>";
                    
                    $message .="Thank you.";
                    
                    
                    $fromEmail = "expensepro@c-iprocure.com";
                
                    $config = array(
                        'mailtype' => "html",
                    );

                    $this->email->initialize($config);
                    $this->email->from($fromEmail, 'TBS EXPENSE PRO'); 
                    $this->email->to($dcashiers);
                    $this->email->subject('NEW REQUEST AWAITING PAYMENT'); 
                    $this->email->message($message); 
                    $this->email->send();
                
                   
                 }else if($dAccountgroup !== '0' || $dAccountgroup !== 0){
                     
                     //Get the User ID's in the group and send a mail to then
                     $getUserid = $this->mainlocation->cashgroup($dAccountgroup);
                     
                     //$newArray = array_shift($getUserid[0]);
                     $nums = explode(',', $getUserid);
                     
                     $nums = array_diff($nums, array(0));
                     
                    // $implodeid = implode(",", $nums);
                     foreach($nums as $key => $value) {
                       
                        //Use the Value to get the UserEmail and Send them a mail
                         $getEmailofAccountGroup = $this->users->getuseremail($value);
                         if($getEmailofAccountGroup){
                             
                          
                            $message .= "<p> You have a new request awaiting payment, please click the link below</p> ";

                            $message .= "<p><a href='".base_url()."'home/myapproval'>Click Here</a></p>";

                            $message .="Thank you.";

                            $fromEmail = "expensepro@c-iprocure.com";
                
                            $config = array(
                                'mailtype' => "html",
                            );

                            $this->email->initialize($config);
                            $this->email->from($fromEmail, 'TBS EXPENSE PRO'); 
                            $this->email->to($getEmailofAccountGroup);
                            $this->email->subject('NEW REQUEST AWAITING PAYMENT'); 
                            $this->email->message($message); 
                            $this->email->send();
                             
                         }
                     }
                 }
             }
         }
        
         
         if($updateApprove){
             $data = ['msg'=>'You have successfully verified the request'];
         }
         
         //Use it to send an email to everybody in ICU
         }
         
     }
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
 
 
 
 
 public function processmycashierstill() {

        $json = [];
        $gettillRequest = $this->adminmodel->getresultfromtillbalancesformadmin();
        
        if ($gettillRequest) {
            foreach ($gettillRequest as $get) {
                $id = $get->id;
                $tillName = $get->tillName;
                $cahsierTillID = $get->cahsierTillID;
                $cashierEmail = $get->cashierEmail;
                $tillBalance = $get->tillBalance;
                $cashierTillLimit = $get->cashierTillLimit;
                $tillType = $get->tillType;
                
              
                        $data[] = ['Id' => $id, 'tillName'=>$tillName, 'tillBalance'=>$tillBalance,  'cahsierTillID' => $cahsierTillID, 'cashierEmail' =>$cashierEmail];
                    }
                    $json['ci'] = $data;
             
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    
    public function makedpayment (){
     
     $data = [];
     if(isset($_POST['assetID'])){
         
         $assetID = $this->input->post('assetID', TRUE);
         $paidTo = $this->input->post('paidTo', TRUE);
         $dDate = $this->input->post('dDate', TRUE);
         $myTillwithme = $this->input->post('myTillwithme', TRUE);
         $userCode = $this->input->post('userCode', TRUE);
        // $dBank = $this->input->post('dBank', TRUE);
         //$dChequeNo = $this->input->post('dChequeNo', TRUE);
        
         if($assetID == "" || $paidTo == "" || $dDate == "" || $myTillwithme == "" || $userCode == ""){
           $data = ['warr'=>'Please make sure all fields are field'];  
         }
         
          $getUserCode = $this->mainlocation->checkCode($userCode, $assetID);
         //Use the AssetID to get the Amount
         $getpaymentAmount = $this->adminmodel->getpaymentamount($assetID);
         
         
        
         //Use the sesion Email or ID to get the Current Cashiers Till Balances
         $getCurrentBalance = $this->adminmodel->getcurrenttillbalanceforadmin($myTillwithme);
         
         if($getpaymentAmount > $getCurrentBalance || $getCurrentBalance == ""){
             
              $data = ['warr'=>'There is not enough cash in that user till']; 
         }else if($getUserCode == FALSE){
             $data = ['warr'=>'Please enter a valid Code']; 
         }else{
         
          // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod)
         //approve = 3(approved by ICu), approve = 4 (Payment Made By Cashiers) , approve = 5(Rejected)
         $approve = '4';
         $sessionID = $_SESSION['email'];
         $getSessEmail = $this->mainlocation->getuserSessionEmail($sessionID);
             if($getSessEmail){
                foreach($getSessEmail as $get){
                     $uid = $get->id;
                     $fname = $get->fname;
                     
                }
            }
            
           //Use the Till ID to return the till Details 
         $theTillInformation = $this->adminmodel->getresultofcashiers($myTillwithme);
         if($theTillInformation){
             foreach($theTillInformation as $till){
                 $tillID = $till->id;
                 $getTillName = $till->tillName;
                 $tillType = $till->tillType;
                 $cashierEmail = $till->cashierEmail;
             }
             
         
          }
         $makedpaymebnt = $this->mainlocation->insertmakepayment($assetID, $paidTo, $dDate, $sessionID, $uid, $tillID, $tillType, $cashierEmail);
         
         //Use the Request ID to Update the Table
         $updatrequestTable = $this->mainlocation->dcashierwhopays($assetID, $sessionID, $approve, $tillID, $tillType, $cashierEmail, $dDate);
        
         //This is for summary report and i will like to have an idea of what it does
         $updateothernewrequestable = $this->mainlocation->updateothertable($assetID, $dDate, $sessionID);
         
          //Use the asset ID to return the Email of the Person that sends the request
         $getEmailofOwner = $this->mainlocation->emailownerrequest($assetID);
         
         //The Description of Item
         $getDescription = $this->mainlocation->descriptionofitem($assetID);
         
         //First you will need to return the till balance
         $returntillbalance = $this->adminmodel->getcurrenttillbalance($cashierEmail, $tillID);
         
         //Get the new balance 
         $newBalance = $returntillbalance - $getpaymentAmount;
         //Remove the amount paid paid from the till balance
         $removeamountfromtillbalance = $this->adminmodel->negativetillbalance($newBalance, $cashierEmail, $tillID);
         
         
         ///////////////////////////////////////EXPENSE STARTS HERE//////////////////////////////////////////////
         //First you will need to return the till balance
         $returntillexpense = $this->tillbalances->getcurrenttillexpense($cashierEmail, $tillID);
         
         //Get the new balance 
         $newBalanceforexpense = $returntillexpense + $getpaymentAmount;
         //Remove the amount paid paid from the till balance
         $addamountfromtillexpense = $this->tillbalances->additiontillexpense($newBalanceforexpense, $cashierEmail, $tillID);
         /////////////////////////////////////EXPENSES ENDS HERE ////////////////////////////////////////////////////
         
         $updatefortillname = $this->mainlocation->updatewithtillname($assetID, $getTillName);
         
            if($getEmailofOwner){
                 
                
                $message = "<p> Your request with the following description '".$getDescription."' for payment has been made by $sessionID in Account</p> ";
                
                $message .= "<p>If you are yet to collect your payment/cheque please see cashier/accountant immediately. </p>";
                $message .="Thank you.";
              
                $fromEmail = "expensepro@c-iprocure.com";
                
                $config = array(
                     'mailtype' => "html",
                 );

                $this->email->initialize($config);
                $this->email->from($fromEmail, 'TBS EXPENSE PRO'); 
                $this->email->to($getEmailofOwner);
                $this->email->subject('YOUR CHEQUE/PAYMENT HAS BEEN MADE'); 
                $this->email->message($message); 
                $this->email->send();
                            
                
                
            } 
           
         
         if($makedpaymebnt && $updatrequestTable){
             $data = ['msg'=>'Payment Successfully Made'];
         }
         
         //Use it to send an email to everybody in ICU
         }
         
         
     } // End of if isset
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
 
 //////////////////////////END OF THE ACCOUNT PART //////////////////////////////////////
 
  public function changeStatus(){
      $data = [];
      if(isset($_POST['newid'])){
          
          $newid = $this->input->post('newid', true);
          
          //Use the id to get the status, Return status based on ID
          $getState = $this->users->getmystatusid($newid);
         //if($getState){
              
              switch($getState){
                 case 1:
                 $newvalue = "0";
                 break;
                 
                 case 0:
                 $newvalue = "1";
                 break;
                 
                 default:
                 $newvalue = "2";
              }
              
              //Update the New Status and send back to the view
              $changeValue = $this->users->updatenewvalue($newvalue, $newid);
              //if($changeValue){
                   $data = ['msg'=>$changeValue];
              //}
          //}
      }
       $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }  
   
  
  public function editUser($id){
          $title = "Expense Pro :: EDIT DETAILS";
			
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
            if($getApprovalLevel == 6 || $getApprovalLevel == 5){	
              
            $detailsresult = $this->users->getresultwithid($id);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'detailsresult'=>$detailsresult, 'getApprovalLevel'=>$getApprovalLevel, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('editUserdetails', $values);
            
            }else{
                redirect(base_url());
            }
      
  }
  

  public function resendactivemail(){
      
        
       // Send Email to the User information user of the success
                if(isset($_POST['hiddenID'])){
                          
                    $hiddenID = $this->input->post('hiddenID', TRUE);
                  
                    //Use the ID to return the result
                    $getUserdetails = $this->users->getresultwithid($hiddenID);
                    if($getUserdetails){
                        foreach($getUserdetails as $get){
                                $id = $get->id;
                                $fname = $get->fname;
                                $lname = $get->lname;
                                $email = $get->email;
                                $randomString = $get->randomString;
                        }
                    }
			
			$adminName = "TBS  EXPENSE PRO";
			$subject = "ACCOUNT ACTIVATION";
			
                        $topheader = "You have recieved this email because you registered for petty cash pro. Please click on the link below to verify and activate your status</a><br/>";
			
                       // $message .= "<a href=".base_url()."/login/activation/$insertedFileId/$randomString>Click Here</a>";
			$link = 'https://c-iprocure.com/expensepro/login/activation/'.$id.'/'.$randomString.'';
                        
                        $linkraw = 'https://c-iprocure.com/expensepro/login/activation/'.$id.'/'.$randomString.'';
                       
                        $values = ['topheader' => $topheader, 'link' => $link, 'linkraw' => $linkraw];
                        
                        $message = $this->load->view('emailtemplate', $values, TRUE);
                        
                        //sendEmail($sname, $semail, $rname="", $remail, $subject, $message, $replyToEmail="", $files="") 
			$sendMail = $this->gen->sendEmail($adminName, "info@c-iprocure.com", $fname, $email, $subject, $message, "info@c-iprocure.com", "");
                                    
                    $data = ['msg' => 'An activation email has been sent to your the email address<br/>'];      
                }
                 $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }
    
  
 public function resetdpassword(){
     if(isset($_POST['hiddenID'])){
                           $data = [];
                    $hiddenID = $this->input->post('hiddenID', TRUE);
                  
                    //Use the ID to return the result
                    $getUserdetails = $this->users->getresultwithid($hiddenID);
                    if($getUserdetails){
                        foreach($getUserdetails as $get){
                                $id = $get->id;
                                $fname = $get->fname;
                                $lname = $get->lname;
                                $email = $get->email;
                                $randomString = $get->randomString;
                                $passwordReset = $get->passwordReset;
                                $passwordCount = $get->passwordCount;
                        }
                    }
			
                // public function sendEmail($sname, $semail, $rname="", $remail, $subject, $message, $replyToEmail="", $files="")
                       $moneybookAdmin = "EXPENSE PRO - ADMINISTRATOR";
                       $moneybookEmail = "expensepro@c-iprocure.com";
                       $reciversName = $fname." ".$lname;
                       $reciversEmail = $email;
                       $subject = "PASSWORD RESET - EXPENSE PRO";
                       $message = "You have request for a password change, please click on the link below to change your password<br><br>";
                       $message .="<br><a href=".base_url()."login/changingpass/'.$id.'/'.$email.'/'.$passwordReset.'/'.$passwordCount.'/'.$randomString.'>Click Here</a>";
                       $message .="<br/><br>Or copy and paste the link on your browser below<br><br>";
                       $message .=" <br>".base_url()."login/changingpass/$id/$email/$passwordReset/$passwordCount/$randomString ";
                       
                       $replyTo = $moneybookEmail;
                       $files = "";
                       
                       $sendMail = $this->gen->sendEmail($moneybookAdmin, $moneybookEmail, $reciversName, $reciversEmail, $subject, $message, $replyTo, "");
                       if($sendMail){
                            $data = ["msg" =>"A Password Reset Link has been sent to the email. <br/>"];
                       }     
                 }
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 } 
  
 
 
 public function hodhasapproval(){
     $data = [];
     if(isset($_POST['acceptrequestID'])){
         
         $acceptrequestID = $this->input->post('acceptrequestID', TRUE);
         //$dComment = addslashes($this->input->post('dComment', TRUE));
         $hodEmail = $this->input->post('hodEmail', TRUE);
        
         $addhod = "Approve By ";
         if($acceptrequestID == ""){
           $data = ['msg'=>'Important variable to process this page is missing'];  
         }
         
                
         $getHODname =  $this->mainlocation->getuserSessionEmail($hodEmail);
         if($getHODname){
             foreach($getHODname as $get){
                 $fname = $get->fname;
                 $lname = $get->lname;
                 
                 $fullname = $addhod.' '.$fname.' '.$lname;
             }
         }
         // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod)
         //approve = 3(approved by ICu), approve = 4 (Payment Made) , approve = 5(Rejected)
         $approve = '2';
         $sessionID = $_SESSION['email'];
         
         $updateApprove = $this->mainlocation->updaterequestbyhodbyadmin($approve, $fullname, $acceptrequestID, $sessionID);
         
         //Insert all approval in this table approvalnewrequest
         $updateApprove = $this->mainlocation->dapprovalforequest($acceptrequestID, $hodEmail,  $fullname, $sessionID);
         
         //Use the asset ID to return the Email of the Person that sends the request
         $getEmailofOwner = $this->mainlocation->emailownerrequest($acceptrequestID);
         $message = ""; 
         //The Description of Item
         $getDescription = $this->mainlocation->descriptionofitem($acceptrequestID);
        
        
         //You will need to send a mail to every body that is ICU
         // Use the Request ID to get all ICU Members
         $getthegroupitwasento = $this->mainlocation->allicumember($acceptrequestID);
         
         //Use the ID to send to the group to check the ICU group
         $getusersinthisgroup = $this->mainlocation->icugroupdisplay($getthegroupitwasento);
        // var_dump($getusersinthisgroup);
         
         $nums = explode(',', $getusersinthisgroup);
        // print_r($nums);         
         $nums = array_diff($nums, array(0));
         
         //$nums = array_shift($nums);
         //$implodeid = implode(",", $nums);
         $messageicu = "";
         foreach($nums as $key => $value) {
                  
          //  echo $key."-".$value;
            //Use the Value to get the UserEmail and Send them a mail
            $getemailofperson = $this->users->getuseremail($value);
           // var_dump($getemailofperson);
            if($getemailofperson){
                
                $messageicu = "<p>There is a Request awaiting your verification, Please login to the link below to verify</p><br/>";
                           
                $messageicu .= "<p><a href='".base_url()."home/myapproval'>Click Here</a></p>";
                           
                $messageicu .="Thank you.";
                           
                $config = array(
                    'mailtype' => "html",
                 );
                
                $this->email->initialize($config);
                $this->email->from("expensepro@c-iprocure.com", 'TBS EXPENSE PRO'); 
                $this->email->to($getemailofperson);
                $this->email->subject('REQUEST AWAITING YOUR VERIFICATION'); 
                $this->email->message($messageicu); 
                
            }
             
         }
                   
         if($updateApprove){
             $data = ['msg'=>'Request Successfully Approved'];
         }
         
         //Use it to send an email to everybody in ICU
         
     }
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
 
 
 
 public function adduserashod(){
     
      $sessionEmail = $_SESSION["email"];
      $data = [];
      //$getusergroupresult = [];
      
	if(isset($_POST['dUsernam']) && isset($_POST['dhodgroup']) ){
			
	// Declaring put putting all variables in Values
	$dUsernam = $this->input->post('dUsernam', TRUE);
        $dhodgroup = $this->input->post('dhodgroup', TRUE);
	
        //$changeaccountIDtoarray = explode(",", $dAccountName);
        
        //Return the userid to see if the account is already in that group
        $getusergroupresult = $this->adminmodel->getuseridashod($dhodgroup) ? $this->adminmodel->getuseridashod($dhodgroup) : "0";
        //var_dump($getusergroupresult);
        
        $kaboom = explode(",", $getusergroupresult);
        
        if($dUsernam == "" || $dhodgroup == ""){
            
             $data = ['msg'=> 'Please make sure you select the group and the accountant'];
        }else 
           
           if(in_array($dUsernam, $kaboom)){
               
             $data = ['msg'=> 'User already a member of that group'];
           }else{
             
               //do an array push to the group
               $pushUsertoGroup = array_push($kaboom, $dUsernam);
               
               //Make sure what you are inserting into the database is unique
               $uniqueArray = array_unique($kaboom);
               
               //Convert it back to a string and prepare for insertion
               $finalResult = implode(",",$uniqueArray);
             
               $updateRow = $this->adminmodel->setHODcontrol($finalResult, $dhodgroup);
		$data = ['msg'=>'User Successfully Added to Group'];
               
           }
               
		
	}
        
        
   $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
 
  
 
 
 
 
  public function addheadicu(){
     
      $sessionEmail = $_SESSION["email"];
      $data = [];
      //$getusergroupresult = [];
      
	if(isset($_POST['dUsernam']) && isset($_POST['dicugroup']) ){
			
	// Declaring put putting all variables in Values
	$dUsernam = $this->input->post('dUsernam', TRUE);
        $dicugroup = $this->input->post('dicugroup', TRUE);
	
        //$changeaccountIDtoarray = explode(",", $dAccountName);
        
        //Return the userid to see if the account is already in that group
        $getusergroupresult = $this->adminmodel->updateicuhead($dicugroup, $dUsernam);
      
       
	$data = ['msg'=>'User Successfully Added to Group'];
           		
	}else {
          $data = ['msg'=>'Please make sure all fields are filled'];  
        }
        
        
   $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
 
 
 
 
}// End of Class




