<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
require_once (dirname(__FILE__) . "/Maincontroller.php");

class Dprocess extends CI_Controller {

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
            $this->gen->mainSetting();
		
		$putNewSession = $this->users->checkUserSession($_SESSION['email']);
			if($putNewSession === FALSE){
				redirect(base_url()."nopriveledge");
			}
    }
    
	public function index()
	{
            redirect(base_url());
			
	}


//////////////////////////////////////////SETTING UP LOCATION ///////////////////////////////////////////////        
        public function mainlocation(){
            $data = [];
		if(isset($_POST['dlocation'])){
			
		// Declaring put putting all variables in Values
		$dlocation = $this->input->post('dlocation', TRUE);
		
                //Check if location is already in Database
                $locationCheck = $this->mainlocation->checklocalation($dlocation);
		if($dlocation == "" ){
                    $data = ['msg'=> 'Please enter a Location'];  // Please make sure asset Name , Cost and Date purchased is not empty
		} else 
                    if($locationCheck ==  TRUE){
                    
                    $data = ['msg'=> $dlocation. ' is already in the Database'];
                }
                else{
			// Insert into the Database;  $aCost, $fassetID, $refNo, $sessionID
			$dLocation = $this->mainlocation->insertnewlocation($dlocation);
				
			$data = ['msg'=> 'Location Successfully Created']; // 'Asset is now Schedule for Maintenance.'
			
			}  // End of Else { 
		
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
//////////////////////////////////////////SETTING UP LOCATION /////////////////////////////////////////////// 
        
        

//////////////////////////////////////////SETTING UP LOCATION ///////////////////////////////////////////////        
        public function dpaymentmode(){
            $data = [];
		if(isset($_POST['payment'])){
			
		// Declaring put putting all variables in Values
		$payment = $this->input->post('payment', TRUE);
		
                //Check if location is already in Database
                $checkPayment = $this->mainlocation->checkpayment($payment);
		if($payment == "" ){
                    $data = ['msg'=> 'Please enter a Payment Mode'];  // Please make sure asset Name , Cost and Date purchased is not empty
		} else 
                    if($checkPayment ==  TRUE){
                    
                    $data = ['msg'=> $payment. ' is already in the Database'];
                }
                else{
			// Insert into the Database;  $aCost, $fassetID, $refNo, $sessionID
			$inSertpayment = $this->mainlocation->insertnewpayment($dlocation);
				
			$data = ['msg'=> 'Payment Mode Successfully Created']; // 'Asset is now Schedule for Maintenance.'
			
			}  // End of Else { 
		
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
//////////////////////////////////////////SETTING UP LOCATION /////////////////////////////////////////////// 
        
        

//////////////////////////////////////////SETTING UP LOCATION ///////////////////////////////////////////////        
        public function daccesspriv(){
            $data = [];
		if(isset($_POST['accessmode'])){
			
		// Declaring put putting all variables in Values
		$accessmode = $this->input->post('accessmode', TRUE);
		
                //Check if location is already in Database
                $checkaccessmode = $this->mainlocation->checkdaccess($accessmode);
		if($accessmode == "" ){
                    $data = ['msg'=> 'Please enter a Access Level'];  // Please make sure asset Name , Cost and Date purchased is not empty
		} else 
                    if($checkaccessmode ==  TRUE){
                    
                    $data = ['msg'=> $accessmode. ' is already in the Database'];
                }
                else{
			// Insert into the Database;  $aCost, $fassetID, $refNo, $sessionID
			$inSertasset = $this->mainlocation->insertnewaccess($accessmode);
				
			$data = ['msg'=> 'Access Successfully Setup']; // 'Asset is now Schedule for Maintenance.'
			
			}  // End of Else { 
		
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
//////////////////////////////////////////SETTING UP LOCATION /////////////////////////////////////////////// 
        
        


//////////////////////////////////////////SETTING UP LOCATION ///////////////////////////////////////////////        
        public function postcategory(){
            $data = [];
		if(isset($_POST['vendorName'])){
			
		// Declaring put putting all variables in Values
		$vendorName = $this->input->post('vendorName', TRUE);
                $actNo = $this->input->post('actNo', TRUE);
		
                //Check if location is already in Database
                $checkcategoryName = $this->mainlocation->getVendorName($actNo);
		if($vendorName == "" ){
                    $data = ['msg'=> 'Please enter a Vendor Name'];  // Please make sure asset Name , Cost and Date purchased is not empty
		} else 
                    if($checkcategoryName ==  TRUE){
                    
                    $data = ['msg'=> $postcategoryName. ' is already in the Database'];
                }
                else{
			// Insert into the Database;  $aCost, $fassetID, $refNo, $sessionID
			$inSertasset = $this->mainlocation->insertcat($postcategoryName);
				
			$data = ['msg'=> 'Vendor Successfully Created']; // 'Asset is now Schedule for Maintenance.'
			
			}  // End of Else { 
		
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        
        
    
        
        public function postunit(){
            $data = [];
		if(isset($_POST['unitName'])){
			
		// Declaring put putting all variables in Values
		$unitName = $this->input->post('unitName', TRUE);
		
                //Check if location is already in Database
                $checkunitName = $this->adminmodel->getdUnit($unitName);
		if($unitName == "" ){
                    $data = ['msg'=> 'Please enter a Unit'];  // Please make sure asset Name , Cost and Date purchased is not empty
		} else 
                    if($checkunitName ==  TRUE){
                    
                    $data = ['msg'=> $unitName. ' is already in the Database'];
                }
                else{
			// Insert into the Database;  $aCost, $fassetID, $refNo, $sessionID
			$inSertasset = $this->adminmodel->inserttoUnit($unitName);
				
			$data = ['msg'=> 'Unit Successfully Created']; // 'Asset is now Schedule for Maintenance.'
			
			}  // End of Else { 
		
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
//////////////////////////////////////////SETTING UP LOCATION /////////////////////////////////////////////// 
        


//////////////////////////////////////////CREATE NEW USER ///////////////////////////////////////////////        
        public function newuser(){
            $data = [];
		if(isset($_POST['email']) || isset($_POST['sAccess'])){
			
		// Declaring put putting all variables in Values
		$email = $this->input->post('email', TRUE);
                $sAccess = $this->input->post('sAccess', TRUE);
                $fname = $this->input->post('fname', TRUE);
                $lname = $this->input->post('lname', TRUE);
                $sLocation = $this->input->post('sLocation', TRUE);
		
                //Check if location is already in Database
                $checkEmail = $this->mainlocation->checkemail($email);
		if($email == "" || $sAccess == ""){
                    $data = ['msg'=> 'Please make sure all fields are filled'];  // Please make sure asset Name , Cost and Date purchased is not empty
		} else 
                    if($checkEmail ==  TRUE){
                    
                    $data = ['msg'=> $email. ' is already in the Database'];
                }
                else{
			// Insert into the Database;  $aCost, $fassetID, $refNo, $sessionID
			$insertnewUser = $this->mainlocation->addNewuser($fname, $lname, $email, $sAccess, $sLocation);
				
			$data = ['msg'=> 'User Successfully Created']; // 'Asset is now Schedule for Maintenance.'
			
			}  // End of Else { 
		
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
//////////////////////////////////////////END OF CREATE NEW USER /////////////////////////////////////////////// 
        
        
        

//////////////////////////////////////////CREATE NEW USER ///////////////////////////////////////////////        
        public function prequestorder(){
            $data = [];
            $mime = "";
            $ext = "";
            require_once 'allowedMimes.php';//array of allowed types
		if(isset($_POST['descItem']) || isset($_POST['dhod'])){
			
		// Declaring put putting all variables in Values
		$dhod = $this->input->post('dhod', TRUE);
                $descItem = $this->input->post('descItem', TRUE);
                $dAmount = $this->input->post('dAmount', TRUE);
                $dUnit = $this->input->post('dUnit', TRUE);
                $dicu = $this->input->post('dicu', TRUE);
                $fileUpload = $this->input->post('fileUpload', TRUE);
                $dateCreated = $this->input->post('dateCreated', TRUE);
                $paymentType = $this->input->post('paymentType', TRUE);
                $itemCat = $this->input->post('itemCat', TRUE);
                $benEmail = $this->input->post('benEmail', TRUE);
                $benName = $this->input->post('benName', TRUE); 
                $getLocation = $this->input->post('locationName', TRUE);
                $sessionEmail = $_SESSION['email'];
                $maxFileSize = 100000000;
                
                
                $dcashier = $this->input->post('dcashier', TRUE) ? $this->input->post('dcashier', TRUE) : "";
                $daccountant = $this->input->post('daccountant', TRUE) ? $this->input->post('daccountant', TRUE) : "";
                $dtransfer = $this->input->post('dtransfer', TRUE) ? $this->input->post('dtransfer', TRUE) : "";
                
                $approvals = $dhod !== "" ? '1' : '0';
                $origName= "";
                $newfileName = "";
                $linkOnDisk = "";
                
		if($dhod == "" || $dAmount == "" ||  $dateCreated == "" ){
				
                   $data = ['status'=> 0,  'msg'=> 'Please make sure you fill out all fields'];  
                }else 
                
                if($dcashier == $sessionEmail || $dhod == $sessionEmail || $daccountant == $sessionEmail){
                    $data = ['status'=> 3,  'msg'=> 'You Cannot set yourself as the 3rd Level Approval, Please select another cashier'];  
                }else {
                
                if(!empty($_FILES["fileUpload"]["tmp_name"])){
                    
                    $fileName = $_FILES['fileUpload']['name'];
                    $tmpName = $_FILES['fileUpload']['tmp_name'];
                    $fileType = $_FILES['fileUpload']['type'];
                    $fileSize = $_FILES['fileUpload']['size'];
                    $fileError = $_FILES['fileUpload']['error'];
                    
                    if($fileSize > $maxFileSize){
			$data = ['status'=>2, 'msg'=>'Filesize too large. Please check the file size of your image.'];
			//return $this->output->set_content_type('application/json')->set_output(json_encode($msg));
			}  
                        
                        
                    $config['upload_path'] = "public/documents/";
                    $config['allowed_types'] = $allowed; //'gif|jpg|png|jpeg|jpe';
                    $config['file_ext_tolower'] = TRUE;
                    $config['max_size'] = $maxFileSize;//in kb
                    $config['encrypt_name'] = FALSE;
                      
                    $origName = str_replace(' ', '', $_FILES['fileUpload']['name']);
                    $randomNumber = random_string('alnum', 16);
                    $savetime = date("mdy-Hms");
                    $newfileName = $randomNumber.$savetime."-".$origName;
                    $config['file_name'] = $newfileName;
                    
                    $this->load->library('upload', $config);//load CI's 'upload' library
                    
                    if($this->upload->do_upload('fileUpload') == FALSE){//if upload was not successful
			$data = ['status'=>5, 'msg'=> $this->upload->display_errors() ];
			//error = $this->upload->display_errors("", "");
                     }
                            
                            //get array of file info on success
                            $data = $this->upload->data();
                            $mime = $data['file_type'];//e.g. "image/png"
			    $ext = $data['file_ext'];
			    $linkOnDisk = "public/documents/$newfileName";
                            
                      }      
                      
                      $sessionID = $_SESSION['email'];
                      $dgetheadersession =  $this->users->checkUserSession($sessionID);			 
			if($dgetheadersession ){
                            foreach($dgetheadersession as $get){
                                $id = $get->id;
				$fname = $get->fname;
				$lname = $get->lname;
				$email = $get->email;
				$uLocation = $get->uLocation;
					}
                                 $fullname = $fname. " ". $lname;
				}
                     
                    $insertedFileId = $this->mainlocation->insertRequest($descItem, $dateCreated, $itemCat, $paymentType, $dhod, $dicu, $dcashier, $origName, $newfileName, $sessionID, $approvals, $linkOnDisk, $dAmount, $getLocation, $dUnit, $benEmail, $benName, $mime, $ext, $daccountant, $dtransfer);
                     
                      
                      /*
                      if(!empty($insertedFileId)){
                          
                        //Send Result to javascript for processing
			$admin = $sessionID;
			$adminName = "Administrator";
			$subject = "NEW REQUEST FOR APPROVAL";
			$message = "New Request awaiting your approval, click here to approval request <a href='http://localhost/expensepro/home/approvaldetails/'.$insertedFileId>Click Here</a>";
			
			$sendMail = $this->gen->sendEmail($fullname, $sessionID, "", $dhod, $subject, $message, $sessionID, "");
                                               //sendEmail($sname, $semail, $rname="", $remail, $subject, $message, $replyToEmail="", $files="") 
                      } */
                      
                      $data = ['status'=>1, 'msg'=>'Request Successfully Sent, Please wait you will be redirected'];
                }
                   
                }
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
//////////////////////////////////////////END OF CREATE NEW USER /////////////////////////////////////////////// 
        
        
 //////////////////////////////////////////////HOD APPROVAL ///////////////////////////////////////////////////
        
 public function hodhasapproval(){
     $dComment = "";
     $data = [];
     if(isset($_POST['acceptrequestID'])){
         
         $acceptrequestID = $this->input->post('acceptrequestID', TRUE);
         $dComment = addslashes($this->input->post('dComment', TRUE)) ?  addslashes($this->input->post('dComment', TRUE)) : "";
         $hodEmail = $this->input->post('hodEmail', TRUE);
        
         $requestUnit = $this->generalmd->getsinglecolumn("dUnit", "cash_newrequestdb", "id", $acceptrequestID);
         $hodUnit = $this->session->dUnit;
                 
         $whomaderequest = $this->adminmodel->maderequestbyme($acceptrequestID);
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
         
         ////////////////***************DO WORK FOR ASSET MGT *************************////////////////////////////
         //Return the from_app_id NOTE: Asset Mgt is "2"
          $fromAssetmgt = $this->adminmodel->myuniqueappid($acceptrequestID);
           //Return the request id to update the maintenance table
          $returnupdateIDforacccest = $this->adminmodel->assetrequestid($acceptrequestID);
         if($fromAssetmgt == 2){
             $assetsessionID = $this->session->id;
             $assetsessionEmail = $this->session->email;
             $hComment =  "approved by". $assetsessionEmail. " ". $dComment;
             $Assetapproval = '5';
             $assetResult =  $this->adminmodel->runassetmaintenance($returnupdateIDforacccest, $Assetapproval, $assetsessionID, $hComment);
         }
         ////////////////***************END OF DO WORK FOR ASSET MGT *************************////////////////////////////
         
         
         // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod)
         //approve = 3(approved by ICu), approve = 4 (Payment Made) , approve = 5(Rejected)
         $approve = '2';
         $sessionID = $_SESSION['email'];
         
         $updateApprove = $this->mainlocation->updaterequestbyhod($approve, $fullname, $acceptrequestID, $sessionID, $whomaderequest);
         
         //Audit Trail
         $updatedBy = "Updated by HOD - $fullname, time: ". date('Y-m-d H:i:s'). "<hr/>";
          
         $createdby = "<hr/>Approved by $sessionID, time: ". date('Y-m-d H:i:s'). "<hr/>";
         $updateAuditTrail= $this->mainlocation->updatedupdatetrail($updatedBy, $createdby, $acceptrequestID);
         
         //Use the asset ID to return the Email of the Person that sends the request
         $getEmailofOwner = $this->mainlocation->emailownerrequest($acceptrequestID);
         $message = ""; 
         //The Description of Item
         $getDescription = $this->mainlocation->descriptionofitem($acceptrequestID);
         //You will need to send a mail to every body that is ICU
         // Use the Request ID to get all ICU Members
         $getthegroupitwasento = $this->mainlocation->allicumember($acceptrequestID);
         
         //Use the ID to send to the group to check the ICU group
         //$getusersinthisgroup = $this->mainlocation->icugroupdisplay($getthegroupitwasento);
        
          /////////////*************TRAVEL START AUDIT *******************************////////////////////
         
         $this->load->model('travelmodel');	 
         // Use the ID to return the return enumType 
         $getenumType = $this->travelmodel->getnumType($acceptrequestID);
         // if enumType == travel, then return the travelID
           if($getenumType == 'travel'){
            // Use the travel ID to update the request in travel Start
            $getTravelID = $this->travelmodel->getTravelID($acceptrequestID);
            //Run Travel ID Update change status to 
            // 0 -- waiting approval  1-- approved and sent to HOD  2-- rejected
            // HOD and ICU approved = '3', Account Awaiting = '4' , Paid = '5'
            //Update the paymentType - for travelstart Table
            $approval = '3';
            $doUpdate = $this->travelmodel->makedoUpdate($approval, $getTravelID, $sessionID);
            $comment = "<br/>Approved By $sessionID  time ". date('Y-m-s H:i:s');
            $doauditTrail = $this->travelmodel->runauditTrail($comment, $getTravelID);
         }
         
         
        // $nums = explode(',', $getusersinthisgroup);
       
         $messageicu = "";
         
            //Use the Value to get the UserEmail and Send them a mail
           // $getemailofperson = $this->users->getuseremail($value);
           
            if($requestUnit != $hodUnit){
                //Then send mail to the HOD of the department
                 $departmentHOD = $this->generalmd->getsinglecolumn("hod", "cash_unit", "id", $requestUnit);
                 $dAmount = $this->generalmd->getsinglecolumn("dUnit", "cash_newrequestdb", "id", $acceptrequestID);
                 $dateCreated = $this->generalmd->getsinglecolumn("dateCreated", "cash_newrequestdb", "id", $acceptrequestID);
                  
                $messageicu .= "<h3>Unathorized Approval</h3>";
                $messageicu .= "<hr/>";
                 $messageicu .= "<p>An approval for payment was authorized by $createdby, please note that <br/> this will "
                         . "have effect on your department budget, if you do not agree with the approval, kindly inform ARC"
                         . "to reject approval. See information of approval below:</p>";
                $messageicu .= "<p>Request Title: $getDescription</p>";
                $messageicu .= "<p>Amount: $dAmount</p>";
                $messageicu .= "<p>Date: $dateCreated</p>";
                           
                $messageicu .= "<p>Click here for details:<br/><a href='".base_url()."home/myapproval'>Link to request</a></p>";
                           
                $messageicu .="<hr style='width:70px'/>This is an automated message, and its sent to your because you are the hod of the department please do not reply";
                           
                $messageicu .="Thank you.";
                           
                $config = array(
                    'mailtype' => "html",
                 );
                
                $this->email->initialize($config);
                $this->email->from("expensepro@c-iprocure.com", 'TBS EXPENSE PRO'); 
                $this->email->to($departmentHOD);
                $this->email->subject('UNATHORIZED APPROVAL ON EXPENSE PRO IN YOUR UNIT'); 
                $this->email->message($messageicu); 
                
            }
         
         
         
         
           
           //I stop the foreach here before incase there is an error please return        
         if($updateApprove){
             $data = ['msg'=>'Request Successfully Approved'];
         }
         
         //Use it to send an email to everybody in ICU
         
     }
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
 
 
 public function hodrejection(){
     $dComment = "";
     $data = [];
     if(isset($_POST['rejectrequestID']) && isset($_POST['dComment'])){
         
         $rejectrequestID = $this->input->post('rejectrequestID', TRUE);
         $dComment = addslashes($this->input->post('dComment', TRUE)) ?  addslashes($this->input->post('dComment', TRUE)) : "";
         $hodEmail = $this->adminmodel->getdhodemailforapproval($rejectrequestID);
         
         $whosendit = $this->adminmodel->maderequestbyme($rejectrequestID);
         if($dComment == "" || $rejectrequestID == ""){
           $data = ['msg'=>'Please make sure you enter a comment before you approve'];  
         }
         
         // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod)
         //approve = 3(approved by ICu), approve = 4 (Payment Made) , approve = 5(Rejected)
         $approve = '5';
         $sessionID = $_SESSION['email'];
         
         $updateApprove = $this->mainlocation->updaterequestbyhodwhoreject($approve, $dComment, $rejectrequestID, $sessionID, $whosendit);
         
         //Insert all approval in this table approvalnewrequest
         $updateApprove = $this->mainlocation->dapprovalforequest($rejectrequestID, $dComment, $sessionID);
         
         //Use the asset ID to return the Email of the Person that sends the request
         $getEmailofOwner = $this->mainlocation->emailownerrequest($rejectrequestID);
         
         //The Description of Item
         $getDescription = $this->mainlocation->descriptionofitem($rejectrequestID);
         
         $userCode = "";
         //Use the ID to remove the code 
         $removeCode = $this->mainlocation->emptyuserCode($rejectrequestID, $userCode);
         
          //Audit Trail
         $updatedBy = "HOD Rejected - $sessionID, Comment :- $dComment <br/> time: ". date('Y-m-d H:i:s'). "<hr/>";
          
         $createdby = "<br/>Rejected By HOD - $sessionID, Comment :- $dComment <br/> time: ". date('Y-m-d H:i:s'). "<hr/>";
         $updateAuditTrail= $this->mainlocation->updatedupdatetrail($updatedBy, $createdby, $rejectrequestID);
         
           ////////////////***************DO WORK FOR ASSET MGT *************************////////////////////////////
         //Return the from_app_id NOTE: Asset Mgt is "2"
          $fromAssetmgt = $this->adminmodel->myuniqueappid($rejectrequestID);
           //Return the request id to update the maintenance table
          $returnupdateIDforacccest = $this->adminmodel->assetrequestid($rejectrequestID);
         if($fromAssetmgt == 5){
             $assetsessionID = $this->session->id;
             $assetsessionEmail = $this->session->email;
             //$hComment = $dComment;
             $Assetapproval = 'rejected';
             $assetResult =  $this->adminmodel->runrejection($returnupdateIDforacccest, $Assetapproval, $assetsessionEmail, $createdby);
         }
         if($fromAssetmgt == 6){
             $assetsessionID = $this->session->id;
             $assetsessionEmail = $this->session->email;
             $hComment = "<br/>Rejected by ". $assetsessionEmail;
             $documentationapproval = "rejected";
             $assetResult =  $this->adminmodel->documentrejection($returnupdateIDforacccest, $documentationapproval, $assetsessionEmail, $createdby);
         }
         ////////////////***************END OF DO WORK FOR ASSET MGT *************************////////////////////////////
         
         
         
          ////////////////***************BEGINNING OF TRAVEL START *************************////////////////////////////
         $this->load->model('travelmodel');	 
         // Use the ID to return the return enumType 
         $getenumType = $this->travelmodel->getnumType($rejectrequestID);
         // if enumType == travel, then return the travelID
         if($getenumType == 'travel'){
          // Use the travel ID to update the request in travel Start
          $getTravelID = $this->travelmodel->getTravelID($rejectrequestID);
          //Run Travel ID Update change status to 
          $reject = "2";
          $doUpdate = $this->travelmodel->makedoUpdate($reject, $getTravelID, $sessionID);
          $comment = "<br/>Rejected By $sessionID   Comments: $dComment   time ". date('y-m-s H:i:s');
          $doauditTrail = $this->travelmodel->runauditTrail($comment, $getTravelID);
          
         //Run Delete for expense pro and expense pro expense
            $myfirstDelete = $this->travelmodel->deletefromexpensepro($rejectrequestID);
            $mysecondDelete = $this->travelmodel->deletefromcashexpensedetails($rejectrequestID);
         }
       
        
         //Send notification to User and copy warefareoffice
         
         
          ////////////////*************** END OF TRAVEL START *************************////////////////////////////
            if($getEmailofOwner){
                          
                //Send Result to javascript for processing
		
                $message = "<p> Your request was not approved.</p>";
                $message .= "<p> Request Title: '".$getDescription."'</p>";
                $message .= "<p> Comment: '".$dComment."'</p>";
                $message .= "<p>Click here for details:<br/><a href='".base_url()."home'>Link to request</a></p>";
                             
                $fromEmail = "expensepro@c-iprocure.com";
                
                $config = array(
                    'mailtype' => "html",
                );
                
                $this->email->initialize($config);
                $this->email->from($fromEmail, 'TBS EXPENSE PRO'); 
                $this->email->to($getEmailofOwner);
                $this->email->subject('YOUR REQUEST WAS NOT APPROVED'); 
                $this->email->message($message); 
                $this->email->send();
         
              } 
           
         
         if($updateApprove){
             $data = ['msg'=>'Request not Approved'];
         }
         
         //Use it to send an email to everybody in ICU
         
     }
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
           
////////////////////////////////////////////END OF HOD APPROVAL///////////////////////////////////////////////
        
//////////////////////////////////////////ICU APPROVAL REQUEST ///////////////////////////////////////////////
 
 public function icuapproval(){
     
     $data = [];
     if(isset($_POST['icuacceptrequestID'])){
         
         $sessionID = $_SESSION['email'];
         
         $icuacceptrequestID = $this->input->post('icuacceptrequestID', TRUE);
         $groupIDinICU = $this->input->post('groupIDinICU', TRUE);
         $mainAmount = $this->input->post('mainAmount', TRUE);
         
         $whomaderequest = $this->adminmodel->maderequestbyme($icuacceptrequestID);
         $getUserID = $this->adminmodel->getuserID($sessionID);
         
         $hotel_id = $this->generalmd->getsinglecolumn("hotelID", " cash_newrequestdb", "id", $icuacceptrequestID);
         $batch_id = $this->generalmd->getsinglecolumn("batchedID", " cash_newrequestdb", "id", $icuacceptrequestID);
         
         //Use the group to get the limit
          $getUserLimit = $this->mainlocation->geticulimitofuser($getUserID, $groupIDinICU);
                  
         if($icuacceptrequestID == ""){
           $data = ['msgError'=>'Important variable to render this page is missing, Please contact Administrator'];  
         }else if($getUserLimit === FALSE || $mainAmount > $getUserLimit){
             $data = ['msgError'=>'You cannot verify this request because of your low limit, Please wait for other higher group member to verify it.'];  
         }else{
         
          // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod)
         //approve = 3(approved by ICu), approve = 4 (Payment Made) , approve = 5(Rejected)
         $startLimit = $this->generalmd->getsinglecolumn("START_LIMIT", "cash_accesslevel", "id", 9);
         $endLimit = $this->generalmd->getsinglecolumn("END_LIMIT", "cash_accesslevel", "id", 9);
          
          
         if($mainAmount >= $startLimit && $mainAmount <=  $endLimit){
           $approve = '14';  // ED
         }else if($mainAmount > $endLimit){
           $approve = '13';  // MD 
         }else if($mainAmount < $startLimit){
          $approve = '3';
         }else{
           $approve = '3'; 
         }
                  
         $updateApprove = $this->mainlocation->updaterequestbyicu($approve, $icuacceptrequestID, $sessionID, $whomaderequest);
         
         //Audit Trail
         $updatedBy = "ICU Approval - $sessionID, time: ". date('Y-m-d H:i:s'). "<hr/>";
          
         $createdby = "Approved by ICU - $sessionID, time: ". date('Y-m-d H:i:s'). "<hr/>";
         $updateAuditTrail= $this->mainlocation->updatedupdatetrail($updatedBy, $createdby, $icuacceptrequestID);
         
         //Use the asset ID to return the Email of the Person that sends the request
         $getEmailofOwner = $this->mainlocation->emailownerrequest($icuacceptrequestID);
         
         //The Description of Item
         $getDescription = $this->mainlocation->descriptionofitem($icuacceptrequestID);
         
           ////////////////***************DO WORK FOR ASSET MGT *************************////////////////////////////
         //Return the from_app_id NOTE: Asset Mgt is "2"
          $fromAssetmgt = $this->adminmodel->myuniqueappid($icuacceptrequestID);
           //Return the request id to update the maintenance table
          $returnupdateIDforacccest = $this->adminmodel->assetrequestid($icuacceptrequestID);
            
      
         ////////////////***************END OF DO WORK FOR ASSET MGT *************************////////////////////////////
         
         if($hotel_id && $hotel_id !=""){
             $this->load->model('travelmodel');
             $updatehotelresult = $this->travelmodel->updatehotelid($hotel_id);
             $Batched = $this->travelmodel->batchedbystatus($batch_id);
             
         }
         
         $messagecashier = "";
         $getcashieroraccount = $this->mainlocation->getcashierandaccount($icuacceptrequestID);
        
         
         /////////////*************TRAVEL START AUDIT *******************************////////////////////
         
         $this->load->model('travelmodel');	 
         // Use the ID to return the return enumType 
         $getenumType = $this->travelmodel->getnumType($icuacceptrequestID);
         // if enumType == travel, then return the travelID
           if($getenumType == 'travel'){
            // Use the travel ID to update the request in travel Start
            $getTravelID = $this->travelmodel->getTravelID($icuacceptrequestID);
            //Run Travel ID Update change status to 
            // 0 -- waiting approval  1-- approved and sent to HOD  2-- rejected
            // HOD and ICU approved = '3', Account Awaiting = '4' , Paid = '5'
            //Update the paymentType - for travelstart Table
            $approval = '4';
            $doUpdate = $this->travelmodel->makedoUpdate($approval, $getTravelID, $sessionID);
            $comment = "<br/>Approved By $sessionID  time ". date('Y-m-s H:i:s');
            $doauditTrail = $this->travelmodel->runauditTrail($comment, $getTravelID);
            //$addflightdetails = $this->travelmodel->addflightrequest($getTravelID);
         }
         
         ////////////****************END OF TRAVEL START AUDIT *********************/////////////////////
         
         //USe the request ID to return payment Code icuapproval
         $thispaymentCode = $this->cashiermodel->getpaymentCode($icuacceptrequestID);
         $getPaymentType = $this->cashiermodel->getpaymentType($icuacceptrequestID);
         $getDescription = $this->mainlocation->descriptionofitem($icuacceptrequestID);
         $requesterEmail = $this->mainlocation->emailownerrequest($icuacceptrequestID);
         $requesteralternativeEmail = $this->allresult->requesteralternative($requesterEmail);
         
         if($requesteralternativeEmail != ""){
             $alternativeEmail = $requesteralternativeEmail;
         }else{
             $alternativeEmail = $requesterEmail;
         }
         
        // $confirm = "";
         if($thispaymentCode && $getPaymentType == '1'){
             
             
                $sendphone = $this->generalmd->getuserAssetLocation("phone", "cash_usersetup", "email", $requesterEmail);
               
                $SMS = "Petty Code: $thispaymentCode, Description $getDescription Amount $mainAmount, ID $icuacceptrequestID Approved";
                $confirm = Maincontroller::initiateSmsActivation($sendphone, $SMS);
               
             
                // Decode JSON data to PHP associative array
                $arr = json_decode($confirm, true);
                
                $result = array_merge($arr, ["name"=>$requesterEmail,"message"=>$SMS, "phone"=>$sendphone, "timeSent"=>date('Y-m-d H:i:s'), "approvedBy"=>$sessionID]);
               // print_r($result);
              
                // $arr['status'], $arr['count'], $arr['price']
                $add = $this->generalmd->saveToDB("smsTable", $result);
                
                $messagecode = "<p>Your payment Code is  $thispaymentCode with this description $getDescription
                and for this amount $mainAmount
                You will be providing this code to the cashier once payment is ready.<br/>
                <small>Note: please only give the cashier your payment code when you are set to collect your money.</small> <p><br/>";
                                
                $config = array(
                     'mailtype' => "html"
                );

                $this->email->initialize($config);
                $this->email->from("expensepro@c-iprocure.com", "TBS-EXPENSE PRO"); 
                $this->email->to($requesterEmail);
                $this->email->cc($alternativeEmail);
                $this->email->subject('PAYMENT CODE'); 
                $this->email->message($messagecode); 
                $this->email->send();
                        
          }
         
         
         if($updateApprove){
             $data = ['msg'=>'You have successfully verified the request'];
         }
         
         //Use it to send an email to everybody in ICU
         }
         
     }
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
 
 
 
 
 
 
 public function icurejection(){
     $commentfromicu = "";
     $data = [];
     if(isset($_POST['icurejectrequestID']) && isset($_POST['commentfromicu']) ){
         $sessionID = $_SESSION['email'];
         
         $icurejectrequestID = $this->input->post('icurejectrequestID', TRUE);
         $commentfromicu = addslashes($this->input->post('commentfromicu', TRUE));
         $fullcomment = "Reject By ICU - Details: ".$commentfromicu;
         
         $fromAssetmgt = (int)$this->adminmodel->myuniqueappid($icurejectrequestID);
         
         $whomaderequest = $this->adminmodel->maderequestbyme($icurejectrequestID);
         $groupIDinICU = $this->input->post('groupIDinICU', TRUE);
         $mainAmount = $this->input->post('mainAmount', TRUE);
         
         $getUserID = $this->adminmodel->getuserID($sessionID);
         //Use the group to get the limit
         $getUserLimit = $this->mainlocation->geticulimitofuser($getUserID, $groupIDinICU);
         
         if($icurejectrequestID == ""){
           $data = ['msg'=>'Important variable to render this page is missing, Please contact Administrator'];  
         }else if($getUserLimit === FALSE || $mainAmount > $getUserLimit){
             $data = ['msgError'=>'You cannot reject this request because of your low limit, Please wait for other higher group member to verify it.'];  
         }else{
         
          // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod)
         //approve = 3(approved by ICu), approve = 4 (Payment Made) , approve = 5(Rejected)
         //approve = 6 (Rejectby by ICU)
             
             
         if($fromAssetmgt == 3){
            $approve = '15';
            $fullComment = $commentfromicu ."<br/>Returned By : ". $sessionID;
            $updateApprove = $this->mainlocation->requestaddinfo($approve, $icurejectrequestID, $fullComment, $sessionID);
          }
             
         if($fromAssetmgt != 3){
            $approve = '6';

            $updateApprove = $this->mainlocation->rejectedrequstbyicu($approve, $icurejectrequestID, $sessionID, $whomaderequest);

            //Insert all approval in this table approvalnewrequest
            $updateApprove = $this->mainlocation->dapprovalforequest($icurejectrequestID, $commentfromicu, $sessionID);

            //Use the asset ID to return the Email of the Person that sends the request
            $getEmailofOwner = $this->mainlocation->emailownerrequest($icurejectrequestID);

            //The Description of Item
            $getDescription = $this->mainlocation->descriptionofitem($icurejectrequestID);

            //Audit Trail
            $updatedBy = "ICU Rejected - $sessionID, <br/>Comment: $commentfromicu. <br/>time: ". date('Y-m-d H:i:s'). "<hr/>";

            $createdby = "Rejected by ICU - $sessionID, <br/>Comment: $commentfromicu. <br/>time: ". date('Y-m-d H:i:s'). "<hr/>";

            $updateAuditTrail= $this->mainlocation->updatedupdatetrail($updatedBy, $createdby, $icurejectrequestID);

         }
        
          ////////////////***************DO WORK FOR ASSET MGT *************************////////////////////////////
         //Return the from_app_id NOTE: Asset Mgt is "2"
          $fromAssetmgt = $this->adminmodel->myuniqueappid($icurejectrequestID);
          //Return the request id to update the maintenance table
          $returnupdateIDforacccest = $this->adminmodel->assetrequestid($icurejectrequestID);
         if($fromAssetmgt == 2){
             $assetsessionID = $this->session->id;
             $assetsessionEmail = $this->session->email;
             $hComment = $commentfromicu;
             $Assetapproval = 8;
             $actualCost = "NULL";
             $assetResult =  $this->adminmodel->runrejection($returnupdateIDforacccest, $Assetapproval, $assetsessionID, $fullcomment, $actualCost);
             
         }
         ////////////////***************END OF DO WORK FOR ASSET MGT *************************////////////////////////////
         
           ////////////////***************BEGINNING OF TRAVEL START *************************////////////////////////////
            $this->load->model('travelmodel');	 
            // Use the ID to return the return enumType 
            $getenumType = $this->travelmodel->getnumType($icurejectrequestID);
            // if enumType == travel, then return the travelID
            if($getenumType == 'travel'){
             // Use the travel ID to update the request in travel Start
             $getTravelID = $this->travelmodel->getTravelID($icurejectrequestID);
             //Run Travel ID Update change status to 
               // 0 -- waiting approval  1-- approved and sent to HOD  2-- rejected
            // HOD and ICU approved = '3', Account Awaiting = '4' , Paid = '5'
            //Update the paymentType - for travelstart Table
             $approval = '2';
             $doUpdate = $this->travelmodel->makedoUpdate($approval, $getTravelID, $sessionID);
             $comment = "<br/>Rejected By $sessionID   Comments: $commentfromicu   time ". date('y-m-s H:i:s');
             $doauditTrail = $this->travelmodel->runauditTrail($comment, $getTravelID);

            //Run Delete for expense pro and expense pro expense
               $myfirstDelete = $this->travelmodel->deletefromexpensepro($icurejectrequestID);
               $mysecondDelete = $this->travelmodel->deletefromcashexpensedetails($icurejectrequestID);
            }
            
            
            $getEmailofOwner = $this->mainlocation->emailownerrequest($icurejectrequestID);
            $getDescription = $this->mainlocation->descriptionofitem($icurejectrequestID);
         
            if($fromAssetmgt !== 3){
                
		$message = "Dear". $getEmailofOwner;
                
                $message .= "<p> Your request  has been rejected by Inter Control Unit</p> ";
                
                 $message .= "<p> Request Title: '".$getDescription."'</p>";
                 
                  $message .= "<p> Comment: '".$commentfromicu."'</p>";
                
                $message .="For details:<br/>";
                $message .= "<p>Click here for details:<br/><a href='".base_url()."home'>Link to request</a></p>";
                 
                 $message .= "<hr>This is an automatically generated email, please do not reply.";
                
                $fromEmail = "expensepro@c-iprocure.com";
                
                $config = array(
                     'mailtype' => "html",
                 );

                $this->email->initialize($config);
                $this->email->from($fromEmail, 'TBS EXPENSE PRO'); 
                $this->email->to($getEmailofOwner);
                $this->email->subject('YOUR REQUEST HAS BEEN REJECTED'); 
                $this->email->message($message); 
                $this->email->send();
                            
              } 
           
             
             if($fromAssetmgt == 3){
              
                $imessage = "Dear". $getEmailofOwner;
                $imessage .= "<p> Your request  has been returned and not approved by $sessionID in ARC</p> ";
                $imessage .= "<p> Request Title: '".$getDescription."'</p> ";
                $imessage .= "<p> Comment: '".$commentfromicu."'</p> ";
                $imessage .= "<hr style='width:80px'/>This is an automatically generated email, please do not reply.";
                
                $fromEmail = "expensepro@c-iprocure.com";
                
                $config = array(
                     'mailtype' => "html",
                 );

                $this->email->initialize($config);
                $this->email->from($fromEmail, 'TBS EXPENSE PRO'); 
                $this->email->to($getEmailofOwner);
                $this->email->subject('YOUR REQUEST HAS BEEN RETURNED'); 
                $this->email->message($imessage); 
                $this->email->send();
            }
           
          
         
            if($fromAssetmgt !==3 ){
                $data = ['msg'=>'You have successfully Rejected the request'];
            }else if($fromAssetmgt == 3){
                $data = ['msg'=>'Request for additional information has been sent to requester as added in your comment box']; 
            }else{
                $data = ['msg'=>'You have successfully Rejected the request']; 
            }
         
         //Use it to send an email to everybody in ICU
         }
     }
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
 
 ////////////////////////////////////////END OF ICU APPROVAL REQUEST 
 
 
 
 //////////////////////////THE ACCOUNT PART THAT PAYS ////////////////////////////////////
 
 public function makedpayment (){
     $approve = "";
     $data = [];
     if(isset($_POST['assetID'])){
         
         $assetID = $this->input->post('assetID', TRUE);
         $paidTo = $this->input->post('paidTo', TRUE);
         $dDate = $this->input->post('dDate', TRUE);
         $myTillwithme = $this->input->post('myTillwithme', TRUE);
         $userCode = $this->input->post('userCode', TRUE);
         $paymentTypes = $this->input->post('paymentTypes', TRUE);
        // $dBank = $this->input->post('dBank', TRUE);
         //$dChequeNo = $this->input->post('dChequeNo', TRUE);
        
         //Use the id to return the email of the person who made the request
         $madeprequestemail = $this->adminmodel->maderequestbyme($assetID);
         
         
         //use the ID to check if the payment has been made before if yes send error
         $getifpaidbefore = $this->generalmd->getuserAssetLocation("dCashierwhopaid", "cash_newrequestdb", "id", $assetID);
         
         if($assetID == "" || $paidTo == "" || $dDate == "" || $myTillwithme == ""){
           $data = ['warr'=>'Please make sure all fields are field'];  
         }
         
         if($paymentTypes == 1 && $userCode !== ""){
          $getUserCode = $this->mainlocation->checkCode($userCode, $assetID);
         }
         //Use the AssetID to get the Amount
         $getpaymentAmount = $this->adminmodel->getpaymentamount($assetID);
        // getcurrenttillbalance($cashierEmail, $tillID)
         //Use the sesion Email or ID to get the Current Cashiers Till Balances
         $getCurrentBalance = $this->adminmodel->getcurrenttillbalance($_SESSION['email'], $myTillwithme);
         
         if($getpaymentAmount > $getCurrentBalance || $getCurrentBalance == ""){
             
              $data = ['warr'=>'You do not have enough money in your till']; 
         }else if($getifpaidbefore != ""){
               $data = ['warr'=>'Payment has already been made, please refresh your browser']; 
         }else if($paymentTypes == 1 && $getUserCode == FALSE){
             $data = ['warr'=>'Please enter a valid Code']; 
         }else{
         
          // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod)
         //approve = 3(approved by ICu), approve = 4 (Payment Made By Cashiers) , approve = 5(Rejected)
         if($paymentTypes == 1){
         $approve = '4';
         }else if($paymentTypes == 2){
          $approve = '8';  
         }
         
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
         
           //Use the Request ID to Update the Table
         $updatrequestTable = $this->mainlocation->dcashierwhopays($assetID, $sessionID, $approve, $tillID, $tillType, $cashierEmail, $dDate, $madeprequestemail);

         //First you will need to return the till balance
         $returntillbalance = $this->adminmodel->getcurrenttillbalance($cashierEmail, $tillID);
         //Get the new balance 
         $newBalance = $returntillbalance - $getpaymentAmount;
         //Remove the amount paid paid from the till balance
         $removeamountfromtillbalance = $this->adminmodel->negativetillbalance($newBalance, $cashierEmail, $tillID);
         
          //Move to the button
         $makedpaymebnt = $this->mainlocation->insertmakepayment($assetID, $paidTo, $dDate, $sessionID, $uid, $tillID, $tillType, $cashierEmail);
         
         //This is for summary report and i will like to have an idea of what it does
         $updateothernewrequestable = $this->mainlocation->updateothertable($assetID, $dDate, $sessionID);
        
          //Use the asset ID to return the Email of the Person that sends the request
         $getEmailofOwner = $this->mainlocation->emailownerrequest($assetID);
         
         //The Description of Item
         $getDescription = $this->mainlocation->descriptionofitem($assetID);
         
         ///////////////////////////////////////EXPENSE STARTS HERE//////////////////////////////////////////////
         //First you will need to return the till balance
         $returntillexpense = $this->tillbalances->getcurrenttillexpense($cashierEmail, $tillID);
         //Get the new balance 
         $newBalanceforexpense = $returntillexpense + $getpaymentAmount;
         //Remove the amount paid paid from the till balance
         $addamountfromtillexpense = $this->tillbalances->additiontillexpense($newBalanceforexpense, $cashierEmail, $tillID);
         /////////////////////////////////////EXPENSES ENDS HERE ////////////////////////////////////////////////////
         
          $updatefortillname = $this->mainlocation->updatewithtillname($assetID, $getTillName);
          
           //Audit Trail
         $updatedBy = "Cashier Approval - $sessionID, time: ". date('Y-m-d H:i:s'). "<hr/>";
         $createdby = "Approved by Cashier - $sessionID, time: ". date('Y-m-d H:i:s'). "<hr/>";
         $updateAuditTrail= $this->mainlocation->updatedupdatetrail($updatedBy, $createdby, $assetID);
         
         ////////////*************CASHIER PAYMENT *********************//////////////////////
         
         $this->load->model('travelmodel');	 
         // Use the ID to return the return enumType 
         $getenumType = $this->travelmodel->getnumType($assetID);
         // if enumType == travel, then return the travelID
           if($getenumType == 'travel'){
            // Use the travel ID to update the request in travel Start
            $getTravelID = $this->travelmodel->getTravelID($assetID);
            //Run Travel ID Update change status to 
            // 0 -- waiting approval  1-- approved and sent to HOD  2-- rejected
            // HOD and ICU approved = '3', Account Awaiting = '4' , Paid = '5'
            //Update the paymentType - for travelstart Table
            $approval = '5';
            $doUpdate = $this->travelmodel->makedoUpdate($approval, $getTravelID, $sessionID);
            $comment = "<br/>Approved By $sessionID  time ". date('Y-m-s H:i:s');
            $doauditTrail = $this->travelmodel->runauditTrail($comment, $getTravelID);
            
           }
         
         /////////////////**************END OF CASHIER PAYMENT ***************///////////////
         $datePaidNow = date("Y-m-d H:i:s");
            if($getEmailofOwner){
                 
                
               $message = "<p> Your request for petty cash payment with the description is ready for collection</p> ";
                $message .= "<div style='width:600px; color:#adaaa9; padding:10px; border:1px solid red'><div><b> Request Title: ".$getDescription." </b></div> ";
                $message .= "<div><b> Amount: ".@number_format($getpaymentAmount, 2)."</b></div> ";
                $message .= "<div><b> Requester Email: ".$getEmailofOwner." </b></div> ";
                $message .= "<div><b> Beneficiary: ".$paidTo." </b></div> ";
                $message .= "<div><b> Date Paid: ".$datePaidNow." </b></div> ";
                $message .= "<div><b> Paid By: ".$sessionID." </b></div> ";
                $message .= "<div><b> Request ID: ".$assetID." </b></div></div> ";
                $message .= "<p></p> ";
                $message .= "<small>This is an automatically generated email, please do not reply.</small>";
                
                $fromEmail = "expensepro@c-iprocure.com";
                
                $config = array(
                     'mailtype' => "html",
                 );

                $this->email->initialize($config);
                $this->email->from($fromEmail, 'TBS EXPENSE PRO'); 
                $this->email->to($getEmailofOwner);
                $this->email->bcc("victor.ogiogio@c-ileasing.com, abiodun.adetayo@c-ileasing.com");
                $this->email->subject('REQUEST FOR PAYMENT'); 
                $this->email->message($message); 
                $this->email->send();
                            
               
                
            } 
           
         
         if($makedpaymebnt && $updatrequestTable){
             $data = ['msg'=>'Payment Successfully Made'];
         }
         
         //Use it to send an email to everybody in ICU
         }
         
         
     } // End of if Isset
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
 
 //////////////////////////END OF THE ACCOUNT PART //////////////////////////////////////
 
 
 //////////////////////////////SETUP GROUP ACCOUNT ////////////////////////////////////
 
  public function groupaccount(){
            $data = [];
		if(isset($_POST['dgroupaccout'])){
			
		// Declaring put putting all variables in Values
		$dgroupaccout = $this->input->post('dgroupaccout', TRUE);
		
                //Check if location is already in Database
                $checkdgroupaccout = $this->adminmodel->getgroupaccount($dgroupaccout);
		if($dgroupaccout == "" ){
                    $data = ['msg'=> 'Please enter a Group'];  // Please make sure asset Name , Cost and Date purchased is not empty
		} else 
                    if($checkdgroupaccout ==  TRUE){
                    
                    $data = ['msg'=> $dgroupaccout. ' is already in the Database'];
                }
                else{
			// Insert into the Database;  $aCost, $fassetID, $refNo, $sessionID
			$inSertasset = $this->adminmodel->insertToaccountgroup($dgroupaccout);
				
			$data = ['msg'=> 'Group Successfully Created']; // 'Asset is now Schedule for Maintenance.'
			
			}  // End of Else { 
		
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
 ///////////////////////////END OF SETUP FOR GROUP ACCOUNT/////////////////////////////
 
 ///////////////////////////////////SETUP FOR BANK ALERT ///////////////////////////////
        
         public function bankalert(){
            $data = [];
		if(isset($_POST['dgroupbankalert'])){
			
		// Declaring put putting all variables in Values
		$dgroupbankalert = $this->input->post('dgroupbankalert', TRUE);
		
                //Check if location is already in Database
                $checkdgroupaccout = $this->adminmodel->getbankallert($dgroupbankalert);
		if($dgroupbankalert == "" ){
                    $data = ['msg'=> 'Please enter a Group'];  // Please make sure asset Name , Cost and Date purchased is not empty
		} else 
                    if($checkdgroupaccout ==  TRUE){
                    
                    $data = ['msg'=> $dgroupaccout. ' is already in the Database'];
                }
                else{
			// Insert into the Database;  $aCost, $fassetID, $refNo, $sessionID
			$inSertasset = $this->adminmodel->insertbankgroup($dgroupbankalert);
				
			$data = ['msg'=> 'Group Successfully Created']; // 'Asset is now Schedule for Maintenance.'
			
			}  // End of Else { 
		
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        
////////////////////////////////////END OF SETUP OF BANK ALERT /////////////////////////
 
 ////////////////////////////////////////TILL REQUEST //////////////////////////////////
   
    public function tillrequest(){
        
        $data = [];
     if(isset($_POST['tillsDate']) && isset($_POST['tilleDate']) ){
         
         $tillsDate = $this->input->post('tillsDate', TRUE);
         $tilleDate = $this->input->post('tilleDate', TRUE);
         $tillAmount = $this->input->post('tillAmount', TRUE);
         $sseionEmail = $_SESSION['email'];
         $sessionID = $this->adminmodel->getuserID($sseionEmail);
         
         $approve = '0';
         if($tillsDate == "" || $tilleDate == "" || $tillAmount == ""){
           $data = ['msg'=>'Please make sure all fields are fields'];  
         }
         
         $makeRequest = $this->adminmodel->tilrequest($tillsDate, $tilleDate, $tillAmount, $sseionEmail, $sessionID, $approve);
       
         if($makeRequest){
             $data = ['msg'=>'Request Successfully Made, Please wait for Account to approve Payment for your till'];
         }
         
         //Use it to send an email to everybody in ICU
         
     }
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
        
////////////////////////////////////////END OF TILL REQUEST ///////////////////////////
    

 public function makedpaymentbyaccount (){
     
     $data = [];
     if(isset($_POST['assetID'])){
         
         $assetID = $this->input->post('assetID', TRUE);
         $paidTo = $this->input->post('paidTo', TRUE);
         $dDate = $this->input->post('dDate', TRUE);
        $chequeNo = $this->input->post('chequeNo', TRUE);
        //$getSignatory = $this->input->post('getSignatory', TRUE);
        $dBank = $this->input->post('dBank', TRUE);
        $madeprequestemail = $this->adminmodel->maderequestbyme($assetID);
         if($assetID == "" || $paidTo == "" || $dDate == "" || $chequeNo == "" || $dBank == ""){
           $data = ['warr'=>'Please make sure all fields are field'];  
         }
         
         //Use the AssetID to get the Amount
         $getpaymentAmount = $this->adminmodel->getpaymentamount($assetID);
         
          // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod)
         //approve = 3(approved by ICu), approve = 4 (Cheque Ready for Collection) , approve = 5(Rejected)
         // approve == 7 (Cheque sent for signature)
         $approve = '7';
         $sessionID = $_SESSION['email'];
         $getSessEmail = $this->mainlocation->getuserSessionEmail($sessionID);
             if($getSessEmail){
                foreach($getSessEmail as $get){
                     $uid = $get->id;
                     $fname = $get->fname;
                     $lname = $get->lname;
                     $fullname = $fname.' '.$lname;
                }
            }
          $type = "cheque";                                    //($assetID, $paidTo, $dDate, $sessionID, $uid, $tillID, $tillType, $cashierEmail);
         $makedpaymebnt = $this->mainlocation->chequesentforpayment($assetID, $paidTo, $dDate, $sessionID, $uid, $chequeNo, $type, $dBank);
         
         
         //This is for summary report and i will like to have an idea of what it does
         $updateothernewrequestable = $this->mainlocation->updateothertable($assetID, $dDate, $sessionID);
         //Use the Request ID to Update the Table
         $updatrequestTable = $this->mainlocation->daccountwhopays($assetID, $sessionID, $approve, $dDate, $madeprequestemail);
         
          //Use the asset ID to return the Email of the Person that sends the request
         $getEmailofOwner = $this->mainlocation->emailownerrequest($assetID);
         
         //The Description of Item
         $getDescription = $this->mainlocation->descriptionofitem($assetID);
         
         
         ///////////////////BEGINNING INSTALLING INTO SUPER ACCOUNTANT ////////////////////////////////
          $myurl = mycustom_url();
          $appID = "01"; // 01 === PETTY CASH  02 == MAINTENANCE
          $getUserLocation = $this->users->getLocationEmail($_SESSION['email']);
          $getUserUnit = $this->users->getUnit($_SESSION['email']);
          $dUserID = $this->adminmodel->getuserID($_SESSION['email']);
          $approval = "0";
          $getTillName = ""; 
          
          $addTotal = $this->adminmodel->sendtosuperaccount($getTillName, $myurl, $getUserLocation, $getUserUnit, $appID, $assetID, $makedpaymebnt, $dUserID, $getpaymentAmount, "" , $approval, $_SESSION['email'], $chequeNo, $type, $dBank, $paidTo, $sessionID); 
                
         //////////////////END OF INSTALLING INTO SUPER ACCOUNTANT ///////////////////////////////////
         
         
         if($makedpaymebnt && $updatrequestTable){
             $data = ['msg'=>'Cheque Successfully successfully prepared for signature'];
         }
         
         //Use it to send an email to everybody in ICU
        // } // End of Check if the accountant/cashier has balance
     }
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
 
 //////////////////////////END OF THE ACCOUNT PART //////////////////////////////////////
 
 
    
///////////////////////////////////////END OF SUPER ADMIN ACCOUNT MAKE PAYMENT SECTION //////////////////////////////////
    
    
 ///////////////////////////////////////////ICU GROUP SETUP ////////////////////////////////////////////////////////
 
     public function createicugroup(){
            $data = [];
		if(isset($_POST['icugroupname']) && isset($_POST['grouplimit']) ){
			
		// Declaring put putting all variables in Values
		$icugroupname = addslashes($this->input->post('icugroupname', TRUE));
                $grouplimit = addslashes($this->input->post('grouplimit', TRUE));
		
                //Check if location is already in Database
                $checkdicugroupname = $this->adminmodel->geticugroup($icugroupname);
		if($icugroupname == "" || $grouplimit == "" ){
                    $data = ['msg'=> 'Please enter a Group'];  // Please make sure asset Name , Cost and Date purchased is not empty
		} else 
                    if($checkdicugroupname ==  TRUE){
                    
                    $data = ['msg'=> $icugroupname. ' is already in the Database'];
                }
                else{
			// Insert into the Database;  $aCost, $fassetID, $refNo, $sessionID
			$inSertasset = $this->adminmodel->insertforicugroup($icugroupname, $grouplimit);
				
			$data = ['msg'=> 'Group Successfully Created']; // 'Asset is now Schedule for Maintenance.'
			
			}  // End of Else { 
		
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
 
 //////////////////////////////////////////END OF ICU GROUP SETUP//////////////////////////////////////////////////
 
        
        
           public function postforaccount(){
            $data = [];
		if(isset($_POST['actName'])){
			
		// Declaring put putting all variables in Values
		$actName = addslashes($this->input->post('actName', TRUE));
                $actCode = $this->input->post('actCode', TRUE);
                $Accountcategory = $this->input->post('Accountcategory', TRUE);
		
                //Check if location is already in Database
                $checkcategoryName = $this->mainlocation->getActCode($actCode);
		if($actCode == "" || $actName == "" || $Accountcategory == ""){
                    $data = ['msg'=> 'Please enter a Account Code'];  // Please make sure asset Name , Cost and Date purchased is not empty
		} else 
                    if($checkcategoryName ==  TRUE){
                    
                    $data = ['msg'=> $actCode. ' is already in the Database'];
                }
                else{
			// Insert into the Database;  $aCost, $fassetID, $refNo, $sessionID
			$inSertasset = $this->mainlocation->insertcatActCode($actName, $actCode, $Accountcategory);
				
			$data = ['msg'=> 'Account Successfully Created']; // 'Asset is now Schedule for Maintenance.'
			
			}  // End of Else { 
		
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        
        
  public function printrequestdetails($id){
      $this->load->model('maintenance');
      $accgroupPH = $this->cashiermodel->actgrouporthaourt() ? $this->cashiermodel->actgrouporthaourt() : "";
      $getuseridfromhere = $this->gen->haveAccess($_SESSION['id'], $accgroupPH);
      $this->load->model('travelmodel');
      if($id){
                $title = "Petty Cash Pro :: C & ILeasing Plc";
               $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
               if($getApprovalLevel == 4 || $getApprovalLevel == 6 || $getApprovalLevel == 7 || $getApprovalLevel ==8 || $getuseridfromhere){
                //$get all Reesult 
                $getallresult = $this->mainlocation->getdexactresultfromdb($id);

                $values = ['title' => $title, 'getallresult'=>$getallresult];
                $this->load->view('printrequestdetailcheque', $values);
               }
                
    
        } else {
            $this->load->view('noaccesstoview');
        }
  }
     


public function viewdetailsofrequest($fidqruest){
    $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
    $icusessionID = $_SESSION['id'];
    
    $cashiersRequest = $this->users->getcashiersrequest();
    $whichRecivable = $this->gen->haveAccess($_SESSION['id'], $cashiersRequest);
    
     if($whichRecivable == TRUE){ // This is HOD
      
       $getfrequestIDs = $fidqruest;
       
       //$nums = explode(',', $getfrequestIDs);
       
       //Implode comma to the array
       /*$implodemyarray = explode(",",  $fidqruest);
         
        foreach($implodemyarray as $key => $value) {
          
        //$allSelected[] = $value;
        //Use the Value to get the UserEmail and Send them a mail
        $getresult = $this->mainlocation->getdexactresultfromdb($value);
                         
       } */
       $menu = $this->load->view('menu', '', TRUE);
       $sidebar = $this->load->view('sidebar', '', TRUE);
       $footer = $this->load->view('footer', '', TRUE);
       $values = ['getApprovalLevel'=>$getApprovalLevel, 'urlids'=>$getfrequestIDs,  'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
       $this->load->view('viewdetailsbysuperaccount', $values);
       }else{
        
           $this->load->view('noaccesstoview');
      
           
       }
}  
  

public function viewbytheaccount($id){
    $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
     if($getApprovalLevel == 8 || $getApprovalLevel == 6){ // This is HOD
      
      
      $getresult = $this->mainlocation->getfromthechequesignaturerequest($id);
        
       $menu = $this->load->view('menu', '', TRUE);
       $sidebar = $this->load->view('sidebar', '', TRUE);
       $footer = $this->load->view('footer', '', TRUE);
       $values = ['getApprovalLevel'=>$getApprovalLevel, 'getresult'=>$getresult,  'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
       $this->load->view('viewaccountrequestforsigniing', $values);
       }else{
        
           $this->load->view('noaccesstoview');
      
           
       }
    }  

    
    
       public function maketillrequest(){
        $sseionEmail = $_SESSION['email'];
        $sessionID = $this->adminmodel->getuserID($sseionEmail);
        $myurl = mycustom_url();
        
        $newlang = ""; 
        $data = [];
        $approval = '1';
        if(isset($_POST['lang'])){
           
           $lang = $this->input->post('lang');
           $sumlang = "";
            
            //Check if user has a pending request
            $checkrequest = $this->adminmodel->checkforrequest($sseionEmail, $sessionID, $myurl);
            if($checkrequest){
                 $data = ['status'=>2, 'msg'=>'You have a pending request, Please see the accountant'];
            
            } else {
            // C$newlangonverting the array to comma separated string
           
           //$lang = implode(",", $lang);
           
          foreach($lang as $key => $value) {
                
               $allSelected[] = $value;
               
               $update = '0'; //Change back to 1
               $updatetillRequest = $this->adminmodel->updatecashiertillrequest($update, $value);
               
               //Use the ID to return the Amount for each of the $lang
               $getlangID = $this->adminmodel->getonlyamount($value);
               //$getlangID = $this->adminmodel->getpaymentamount($value);
               
               if($getlangID){
                
                foreach($getlangID as $get){
                    $id = $get->id;
                    $dAmount = $get->dAmount;
                    
                    ////////SUM AMOUNT 
                        if($dAmount){
                            $sumlang += $dAmount;
                        } 
                        
                    }

                 }
                    
                //Tie array for insertion
                 $explodearray = implode(",", $lang);

               } 
               
               
               
               $getTillType = $this->adminmodel->getTilltype($lang);
               $getdcashierLimit = $this->adminmodel->getyourlimit($sseionEmail, $getTillType);
                //Get the till type using the post ID
            
                if($sumlang > $getdcashierLimit){
                     $update = '0';
                     $updatetillRequest = $this->adminmodel->updatecashiertillrequest($update, $value);
                             $data = ['status'=>3, 'msg'=>'Total Amount above your limit. please reduce request'];
                  }else{
                 //Use the Total to add the amount and sent to the database
                  $appID = "01"; // 01 === PETTY CASH  02 == MAINTENANCE
                  $getUserLocation = $this->users->getLocationEmail($sseionEmail);
                  $getUserUnit = $this->users->getUnit($sseionEmail);
                  
                  if($getTillType == 'primary'){
                  //Use cashiers email and ID to return till Name
                  $getTillName = $this->mainlocation->getdTillname($sseionEmail);
                  }else{
                     $getTillName = $this->mainlocation->getdTillnameforsecondary($sseionEmail);  
                  }
                 
                 
                 $addTotal = $this->adminmodel->sendtosuperaccount($getTillName, $myurl, $getUserLocation, $getUserUnit, $appID, $explodearray, "", $sessionID, $sumlang, $approval, $sseionEmail); 
                //Now update a new column in the database where cashiertillrequest from 0 to 1
               // 
                        
                 //$data = ['status'=>1, 'msg'=>'Request Successfully Made, Please wait for Account to approve Payment for your till'];
                 
                  } // Cashiers Limit Exceeded;
                 
             $data = ['status'=>1, 'msg'=>'Reimbursement successfully created'];
            } // Pending Request Here
           
        }else{
            $data = ['status'=>0, 'msg'=>'Please select a checkbox'];
             
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
 //////////////////////////////////////////ACOUNT SUPER ADMIN ADMIN  MAKE PAYMENT SECTION ////////////////////////////////
    
 public function preparecashierscheque(){
        
      $sessionEmail = $_SESSION["email"];
      $data = [];
      //$getusergroupresult = [];
      
	if(isset($_POST['dateprepared']) && isset($_POST['dAmount']) ){
			
	// Declaring put putting all variables in Values
	$dateprepared = $this->input->post('dateprepared', TRUE);
        $cheQueNo = $this->input->post('cheQueNo', TRUE);
        $dPayee = $this->input->post('dPayee', TRUE);
        $dAmount = $this->input->post('dAmount', TRUE);
        $dBank = $this->input->post('dBank', TRUE);
        $sentID = $this->input->post('sentID', TRUE);
        
        if($dateprepared == "" || $dAmount == ""){
            $data = ['msg'=>'Please make sure all fields are filled'];
        }else {
         $hasentbycashier = 'paid'; 
         $type = 'cheque'; 
        $updateRow = $this->adminmodel->updatechequerequest($hasentbycashier, $type, $sessionEmail, $dateprepared, $cheQueNo, $dBank, $sentID);
	
        //programming for cashiers sections begins here
        $getResult = $this->adminmodel->getTillresult($sentID);
            if($getResult){
                
                foreach($getResult as $get){
                        $tillid = $get->id;
                        $userID = $get->userID;
                        $Amount = $get->Amount;
                        $fmrequestID = $get->fmrequestID;
                        $tillName = $get->tillName;
               }
               
             $newapproval = '2'; // for cashiers till request not application for accountant
              $implodeid = explode(",", $fmrequestID);
            //print_r($implodeid);
            //
            //Now we will do a foreach loop to loop through those values and update
              foreach($implodeid as $key => $value) {
               $allSelected[] = $value;
               //Update record where the id = $value
               $runUpdatefornewrequest = $this->adminmodel->updatewithid($newapproval, $sessionEmail, $value);
               
              }
               if($updateRow == TRUE && $tillName !== ""){
                $getcashiertillcurrentdetails = $this->adminmodel->getcashiertilldetails($userID, $tillName);  
                 if($getcashiertillcurrentdetails){
                    foreach($getcashiertillcurrentdetails as $get){
                        $cahsierTillID = $get->cahsierTillID;
                        $oldtillAmount = $get->tillAmount;
                        $tillBalance = $get->tillBalance;

                    }
                        $newtillTotalAmount = $oldtillAmount + $Amount;
                        $newtillBalance = $tillBalance + $Amount;
                     
                       //Update the till Table
                       $tillTableUpdate = $this->adminmodel->addTillamounttogeter($userID, $tillName, $newtillTotalAmount, $newtillBalance);
                       
                       //Do an insertion to a new table to see all the money we have give the cashier
                       $insertforCashier = $this->adminmodel->insertamountdetails($dateprepared, $userID, $Amount, $tillName, $dPayee, $sessionEmail, $fmrequestID);
                 }
               } // End of  if($updateRow == TRUE && $tillName !== ""){
              
            } // End of   if($getResult){
        ///programming for cashiers sections ends here
        $data = ['msg'=>'Cheque Successfully Created'];
                
        }
      	
	} else{
           $data = ['msg'=>'Please make sure all fields are filled']; 
        } 
   $this->output->set_content_type('application/json')->set_output(json_encode($data));
        
    }    
    
    
    
    
    public function newicurejection(){
     
     $data = [];
     if(isset($_POST['icurejectrequestID']) && isset($_POST['commentfromicu']) ){
         $sessionID = $_SESSION['email'];
         
         $icurejectrequestID = $this->input->post('icurejectrequestID', TRUE);
         $commentfromicu = addslashes($this->input->post('commentfromicu', TRUE));
         $fullcomment = "Reject By ICU - Details: ".$commentfromicu;
        
         
         $fromAssetmgt = (int)$this->adminmodel->myuniqueappid($icurejectrequestID);
         
        
         
         $hotel_id = $this->generalmd->getsinglecolumn("hotelID", " cash_newrequestdb", "id", $icurejectrequestID);
         $batch_id = $this->generalmd->getsinglecolumn("batchedID", " cash_newrequestdb", "id", $icurejectrequestID);
              
         $whorejected = $this->adminmodel->maderequestbyme($icurejectrequestID);
         //Use the id to return the groupid and the amount
         
         //$groupIDinICU = $this->input->post('groupIDinICU', TRUE);
          $groupIDinICU =  $this->adminmodel->gettheicugroup($icurejectrequestID);
         //$mainAmount = $this->input->post('mainAmount', TRUE);
         $mainAmount = $this->adminmodel->getpaymentamount($icurejectrequestID);
                 
         $getUserID = $this->adminmodel->getuserID($sessionID);
         //Use the group to get the limit
         $getUserLimit = $this->mainlocation->geticulimitofuser($getUserID, $groupIDinICU);
         
         if($icurejectrequestID == ""){
           $data = ['msg'=>'Important variable to render this page is missing, Please contact Administrator'];  
         }else if($getUserLimit === FALSE || $mainAmount > $getUserLimit){
             $data = ['msgError'=>'You cannot reject this request because of your low limit, Please wait for other higher group member to verify it.'];  
         }else{
         
          // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod)
         //approve = 3(approved by ICu), approve = 4 (Payment Made) , approve = 5(Rejected)
         //approve = 6 (Rejectby by ICU)
         
         if($fromAssetmgt !==  3){    
            
            $approve = '6';

            $updateApprove = $this->mainlocation->rejectedrequstbyicu($approve, $icurejectrequestID, $sessionID, $whorejected);

            //Insert all approval in this table approvalnewrequest
            $updateApprove = $this->mainlocation->dapprovalforequest($icurejectrequestID, $commentfromicu, $sessionID);

            //Use the asset ID to return the Email of the Person that sends the request
            $getEmailofOwner = $this->mainlocation->emailownerrequest($icurejectrequestID);

            //The Description of Item
            $getDescription = $this->mainlocation->descriptionofitem($icurejectrequestID);

             //Audit Trail
            $updatedBy = "ICU Rejected - $sessionID, <br/>Comment: $commentfromicu. <br/>time: ". date('Y-m-d H:i:s'). "<hr/>";

            $createdby = "Rejected by ICU - $sessionID, <br/>Comment: $commentfromicu. <br/>time: ". date('Y-m-d H:i:s'). "<hr/>";
            $updateAuditTrail= $this->mainlocation->updatedupdatetrail($updatedBy, $createdby, $icurejectrequestID);
        
         }
         
          ////////////////***************DO WORK FOR ASSET MGT *************************////////////////////////////
         //Return the from_app_id NOTE: Asset Mgt is "2"
          $fromAssetmgt = $this->adminmodel->myuniqueappid($icurejectrequestID);
          //Return the request id to update the maintenance table
          $returnupdateIDforacccest = $this->adminmodel->assetrequestid($icurejectrequestID);
        
        if($fromAssetmgt == 5){
             $assetsessionID = $this->session->id;
             $assetsessionEmail = $this->session->email;
             //$hComment = $dComment;
             $Assetapproval = 'rejected';
             $assetResult =  $this->adminmodel->runrejection($returnupdateIDforacccest, $Assetapproval, $assetsessionEmail, $createdby);
         }
         
        /* 
         if($fromAssetmgt == 6){
             $assetsessionID = $this->session->id;
             $assetsessionEmail = $this->session->email;
             $hComment = "<br/>Rejected by ". $assetsessionEmail;
             $documentationapproval = "rejected";
             $assetResult =  $this->adminmodel->documentrejection($returnupdateIDforacccest, $documentationapproval, $assetsessionEmail, $createdby);
         }
         * 
         */
         ////////////////***************END OF DO WORK FOR ASSET MGT *************************////////////////////////////
         
         if($hotel_id && $hotel_id !=""){
             $this->load->model('travelmodel');
             $updatehotelresult = $this->travelmodel->rejectupdatehotelid($hotel_id);
             $Batched = $this->travelmodel->rejectedbatched($batch_id);
             
         }
         
          //////////////////////////// PROCUREMENT FEEDBACK //////////////////////////////////////////////////
         if($fromAssetmgt == 3){
            $approve = '15';
            $fullComment = $commentfromicu ."<br/>Returned By : ". $sessionID;
            $updateApprove = $this->mainlocation->requestaddinfo($approve, $icurejectrequestID, $fullComment, $sessionID);
          }
         
        /* if($fromAssetmgt == 3){
             //$audit = "Payment Rejected By $sessionID". date('Y-m-d H:i:s'); 
             //Update the Record in Procurement
             //$procurementUpdate = $this->generalmd->procureupdaterejected($returnupdateIDforacccest, $audit);
              $updatedBy = "Payment Rejected By $sessionID". date('Y-m-d H:i:s');
             $createdby = "REJECTED - $sessionID, time: ". date('Y-m-d H:i:s');
             //$procurementUpdate = $this->generalmd->procureupdate($maintenanceID, $audit);
             $procurementUpdate= $this->generalmd->procureupdaterejected($updatedBy, $createdby, $returnupdateIDforacccest);
         } */
        //////////////////////////END OF PROCUREMNT FEED BACK ///////////////////////////////////////////
         
         
         ////////////////***************BEGINNING OF TRAVEL START *************************////////////////////////////
            $this->load->model('travelmodel');	 
            // Use the ID to return the return enumType 
            $getenumType = $this->travelmodel->getnumType($icurejectrequestID);
            // if enumType == travel, then return the travelID
            if($getenumType == 'travel'){
             // Use the travel ID to update the request in travel Start
             $getTravelID = $this->travelmodel->getTravelID($icurejectrequestID);
             //Run Travel ID Update change status to 
               // 0 -- waiting approval  1-- approved and sent to HOD  2-- rejected
            // HOD and ICU approved = '3', Account Awaiting = '4' , Paid = '5'
            //Update the paymentType - for travelstart Table
             $approval = '2';
             $doUpdate = $this->travelmodel->makedoUpdate($approval, $getTravelID, $sessionID);
             $comment = "<br/>Rejected By $sessionID   Comments: $commentfromicu   time ". date('y-m-s H:i:s');
             $doauditTrail = $this->travelmodel->runauditTrail($comment, $getTravelID);

            //Run Delete for expense pro and expense pro expense
               $myfirstDelete = $this->travelmodel->deletefromexpensepro($icurejectrequestID);
               $mysecondDelete = $this->travelmodel->deletefromcashexpensedetails($icurejectrequestID);
            }
            
              //////////////////////////// PROCUREMENT FEEDBACK //////////////////////////////////////////////////
        /* if($fromAssetmgt == 3){
              //$audit = "Payment Rejected By $sessionID". date('Y-m-d H:i:s'); 
             //Update the Record in Procurement
             //$procurementUpdate = $this->generalmd->procureupdaterejected($returnupdateIDforacccest, $audit);
              $updatedBy = "Payment Rejected By $sessionID". date('Y-m-d H:i:s');
             $createdby = "REJECTED - $sessionID, time: ". date('Y-m-d H:i:s');
             //$procurementUpdate = $this->generalmd->procureupdate($maintenanceID, $audit);
             $procurementUpdate= $this->generalmd->procureupdaterejected($updatedBy, $createdby, $returnupdateIDforacccest);
         } */
        //////////////////////////END OF PROCUREMNT FEED BACK ///////////////////////////////////////////
        $getEmailofOwner = $this->mainlocation->emailownerrequest($icurejectrequestID);
       $getDescription = $this->mainlocation->descriptionofitem($icurejectrequestID);
       
            if($getEmailofOwner && $fromAssetmgt != 3){
                
		$message = "Dear". $getEmailofOwner;
                
                $message .= "<p> Your request  has been rejected by Inter Control Unit</p> ";
                
                 $message .= "<p> Request Title: '".$getDescription."'</p> ";
                 
                 $message .= "<p> Comment: '".$commentfromicu."'</p> ";
                
                $message .="Click here for details: ";
                 $message .= "<p><a href='".base_url()."home'>Link to request</a></p>";
                 
                 $message .= "<hr style='width:80px'/>This is an automatically generated email, please do not reply.";
                
                $fromEmail = "expensepro@c-iprocure.com";
                
                $config = array(
                     'mailtype' => "html",
                 );

                $this->email->initialize($config);
                $this->email->from($fromEmail, 'TBS EXPENSE PRO'); 
                $this->email->to($getEmailofOwner);
                $this->email->subject('YOUR REQUEST HAS BEEN REJECTED'); 
                $this->email->message($message); 
                $this->email->send();
                            
              } 
              
            if($fromAssetmgt == 3){
              
                $imessage = "Dear". $getEmailofOwner;
                $imessage .= "<p> Your request  has been returned and not approved by $sessionID in ARC</p> ";
                $imessage .= "<p> Request Title: '".$getDescription."'</p> ";
                $imessage .= "<p> Comment: '".$commentfromicu."'</p> ";
                $imessage .= "<hr style='width:80px'/>This is an automatically generated email, please do not reply.";
                
                $fromEmail = "expensepro@c-iprocure.com";
                
                $config = array(
                     'mailtype' => "html",
                 );

                $this->email->initialize($config);
                $this->email->from($fromEmail, 'TBS EXPENSE PRO'); 
                $this->email->to($getEmailofOwner);
                $this->email->subject('YOUR REQUEST HAS BEEN RETURNED'); 
                $this->email->message($imessage); 
                $this->email->send();
            }
           
          
          // $fromAssetmgt  if($updateApprove && $fromAssetmgt !==3 ){
            if($fromAssetmgt == 3){
                $data = ['msg'=>'Request for additional information has been sent to requester as added in your comment box']; 
            }else{
                $data = ['msg'=>'You have successfully Rejected the request, User will be notified']; 
            }
         
         //Use it to send an email to everybody in ICU
         }
     }
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
 
 ////////////////////////////////////////END OF ICU APPROVAL REQUEST 
 
  
 
 public function hodapprovalinside(){
     $data = [];
     if(isset($_POST['acceptrequestID'])){
         
         $acceptrequestID = $this->input->post('acceptrequestID', TRUE);
         //Use the id to return the email address
         //$hodEmail = $this->input->post('hodEmail', TRUE);
         $hodEmail = $this->adminmodel->getdhodemailforapproval($acceptrequestID);
        $whomaderequest = $this->adminmodel->maderequestbyme($acceptrequestID);
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
         
         
          ////////////////***************DO WORK FOR ASSET MGT *************************////////////////////////////
         //Return the from_app_id NOTE: Asset Mgt is "2"
          $fromAssetmgt = $this->adminmodel->myuniqueappid($acceptrequestID);
          //Return the request id to update the maintenance table
          $returnupdateIDforacccest = $this->adminmodel->assetrequestid($acceptrequestID);
         
         if($fromAssetmgt == 5){
             $assetsessionID = $this->session->id;
             $assetsessionEmail = $this->session->email;
             $hComment = "<br/>approved by ". $assetsessionEmail;
             $Assetapproval = "invoice-approve-hod";
             $assetResult =  $this->adminmodel->runassetmaintenance($returnupdateIDforacccest, $Assetapproval, $assetsessionEmail, $hComment);
             
         }
         
         if($fromAssetmgt == 6){
             $assetsessionID = $this->session->id;
             $assetsessionEmail = $this->session->email;
             $hComment = "<br/>Payment approved by ". $assetsessionEmail;
             $documentationapproval = "awaiting-verification";
             $assetResult =  $this->adminmodel->documentation($returnupdateIDforacccest, $documentationapproval, $assetsessionEmail, $hComment);
         }
         ////////////////***************END OF DO WORK FOR ASSET MGT *************************////////////////////////////
         
         
         
         // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod)
         //approve = 3(approved by ICu), approve = 4 (Payment Made) , approve = 5(Rejected)
         $approve = '2';
         $sessionID = $_SESSION['email'];
         
         $updateApprove = $this->mainlocation->updaterequestbyhod($approve, $fullname, $acceptrequestID, $sessionID, $whomaderequest);
         
         //Audit Trail
         $updatedBy = "Updated by HOD - $fullname, time: ". date('Y-m-d H:i:s'). "<hr/>";
          
         $createdby = "<hr/>Approved by $sessionID, time: ". date('Y-m-d H:i:s'). "<hr/>";
         $updateAuditTrail= $this->mainlocation->updatedupdatetrail($updateApprove, $createdby, $acceptrequestID);
         
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
        
         $messageicu = "";
         
         //////////////////////*****************TRAVE START LOADS HERE ********************///////////////////////
          $this->load->model('travelmodel');	 
          // Use the ID to return the return enumType 
            $getenumType = $this->travelmodel->getnumType($acceptrequestID);
          // if enumType == travel, then return the travelID
            if($getenumType == 'travel'){
             // Use the travel ID to update the request in travel Start
             $getTravelID = $this->travelmodel->getTravelID($acceptrequestID);
             //Run Travel ID Update change status to 
             // 0 -- waiting approval  1-- approved and sent to HOD  2-- rejected
             // HOD and ICU approved = '3', Account Awaiting = '4' , Paid = '5'
             //Update the paymentType - for travelstart Table
             $approval = '3';
             $doUpdate = $this->travelmodel->makedoUpdate($approval, $getTravelID, $sessionID);
             $comment = "<br/>Approved By $sessionID  time ". date('Y-m-s H:i:s');
             $doauditTrail = $this->travelmodel->runauditTrail($comment, $getTravelID);

            }
          
           //////////////////////*****************TRAVE START LOADS HERE ********************///////////////////////

         //foreach($nums as $key => $value) {
         foreach($nums as $key => $value) {
                  
          
            $getemailofperson = $this->users->getuseremail($value);
            
            if($getemailofperson){
                
                $messageicu = "<p>Request awaiting verification,</p>";
                $messageicu .= "<p>Request Title: $getDescription</p>";
                           
                $messageicu .= "<p>Click here for details:<br/><a href='".base_url()."home/myapproval'>Link to request</a></p>";
                           
                $messageicu .="<hr style='width:70px'/>This is an automated message, please do not reply";
                           
                $config = array(
                    'mailtype' => "html",
                 );
                
                $this->email->initialize($config);
                $this->email->from("expensepro@c-iprocure.com", 'TBS EXPENSE PRO'); 
                $this->email->to($getemailofperson);
                $this->email->subject('REQUEST AWAITING YOUR VERIFICATION'); 
                $this->email->message($messageicu); 
                $this->email->send();
                
            }
            
                
         }
         /*   if($getEmailofOwner){
                $message = "<p><b>Your request with the following description</b> '".$getDescription."' has been approved by $sessionID</p> ";
                //$message .="<p>Thank you.</p>";
                $fromEmail = "moneybook@c-iprocure.com";
                
                $config = array(
                    'mailtype' => "html",
                );
                
                $this->email->initialize($config);
                $this->email->from($fromEmail, 'TBS MONEY BOOK'); 
                $this->email->to($getEmailofOwner);
                $this->email->subject('YOUR REQUEST HAS BEEN APPROVED'); 
                $this->email->message($message); 
                $this->email->send();
         
              } 
          
          */
           
           //I stop the foreach here before incase there is an error please return        
         if($updateApprove){
             $data = ['msg'=>'Request Successfully Approved'];
         }
         
         //Use it to send an email to everybody in ICU
         
     }
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
 
    
 
  public function printcashiersreimbursementrequest($id, $fid){
      
      if($id){
                $title = "Petty Cash Pro :: C & ILeasing Plc";
               $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
               if($getApprovalLevel == 6 || $getApprovalLevel == 7 || $getApprovalLevel == 8 || $getApprovalLevel == 2 || $getApprovalLevel == 4){
                
                   
                $values = ['title' => $title, 'id'=>$id,  'fid'=>$fid];
                $this->load->view('printcashiersreimbursementdetails', $values);
               }
                
    
        } else {
            redirect(base_url());
        }
  }
  
  
  
  
  
  
  
   
 public function mdapprovalinside(){
     $data = [];
     if(isset($_POST['acceptrequestID'])){
         
         $acceptrequestID = $this->input->post('acceptrequestID', TRUE);
       
        $whomaderequest = $this->adminmodel->maderequestbyme($acceptrequestID);
        
         if($acceptrequestID == ""){
           $data = ['msg'=>'Important variable to process this page is missing'];  
         }
        
         $approve = '3';
         $sessionID = $_SESSION['email'];
         
         $updateApprove = $this->mainlocation->updatebymd($approve, $acceptrequestID, $sessionID);
         
         //Audit Trail
         $updatedBy = "Updated by  $sessionID, time: ". date('Y-m-d H:i:s'). "<hr/>";
         $createdby = "<hr/>Approved by $sessionID, time: ". date('Y-m-d H:i:s'). "<hr/>";
         $updateAuditTrail= $this->mainlocation->updatedupdatetrail($updatedBy, $createdby, $acceptrequestID);
         
         //Use the asset ID to return the Email of the Person that sends the request
         $getEmailofOwner = $this->mainlocation->emailownerrequest($acceptrequestID);
        
         //The Description of Item
         $getDescription = $this->mainlocation->descriptionofitem($acceptrequestID);
        
      
            if($getEmailofOwner){
                $message = "<p><b>Your request with the following description</b> '".$getDescription."' has been approved by $sessionID</p> ";
                //$message .="<p>Thank you.</p>";
                $fromEmail = "info@c-iprocure.com";
                
                $config = array(
                    'mailtype' => "html",
                );
                
                $this->email->initialize($config);
                $this->email->from($fromEmail, 'TBS MONEY BOOK'); 
                $this->email->to($getEmailofOwner);
                $this->email->subject('YOUR REQUEST HAS BEEN APPROVED FOR PAYMENT'); 
                $this->email->message($message); 
                $this->email->send();
         
              } 
           //I stop the foreach here before incase there is an error please return        
         if($updateApprove){
             $data = ['msg'=>'Request Successfully Approved For Payment'];
         }
         
         //Use it to send an email to everybody in ICU
         
     }
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
  
  

} // End of The Till
