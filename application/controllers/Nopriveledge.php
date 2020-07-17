<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('functions.php');

class Nopriveledge extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        echo "You don't have the right priviledge to access this page. Please contact admin to activate your account";
    }

   public function advancenewrequest(){
      
                $data = [];
                $mime = "";
                $ext = "";
                $userGenCode = "";
                require_once 'allowedMimes.php';//array of allowed types
		if(isset($_POST['hideID'])){
			
		// Declaring put putting all variables in Values
		$dateCreated = $this->input->post('dateCreated', TRUE);
                $descItem = $this->input->post('descItem', TRUE);
                $benName = $this->input->post('benName', TRUE);
                //$benEmail = $this->input->post('benEmail', TRUE);
                $dUnit = $this->input->post('dUnit', TRUE);
                $paymentType = $this->input->post('paymentType', TRUE);
                $dComment = $this->input->post('dComment', TRUE);
                $dhod = $this->input->post('dhod', TRUE);
                $dicu = $this->input->post('dicu', TRUE);
                $exAmount = $this->input->post('exAmount', TRUE); 
                $hideID = $this->input->post('hideID', TRUE);
                $sumall = $this->input->post('sumall', TRUE); 
                $auditTrailRequest = $this->input->post('auditTrailRequest', TRUE);
                $hashmd5id = $this->input->post('hashmd5id', TRUE);
                $currencyType = $this->input->post('currencyType', TRUE);
                
                $dcashier = $this->input->post('dcashier', TRUE) ? $this->input->post('dcashier', TRUE) : "";
                $daccountant = $this->input->post('daccountant', TRUE) ? $this->input->post('daccountant', TRUE) : "";
                
                $approvals = $dhod !== "" ? '1' : '0';
                $sessionEmail = $_SESSION['email'];
                
                 $getallsums = "";
                
                if($paymentType == 1){
                    if($sumall > 500000){
                        $getallsums = $sumall;
                    }
                }
                
               if($paymentType == "" || $descItem == "" ||  $dateCreated == "" || $exAmount ==""){
				
                   $data = ['status'=> 0,  'msg'=> 'Please make sure you fill out all fields'];  
                }else 
                
                if($getallsums > 500000){
                    $data = ['status'=> 7,  'msg'=> 'You can not raise petty Cash of that amount select Cheque Requsition under payment type. Please note, if you are editing this request you cannot change payment type. So if you want to change payment type, raise a new request'];  
                }else 
                
                if($dcashier == $sessionEmail || $dhod == $sessionEmail){
                    $data = ['status'=> 3,  'msg'=> 'You Cannot set yourself as the 2nd/1st Level Approval, Please select another'];  
                }else {
                    
                $dgetheadersession =  $this->users->checkUserSession($sessionEmail);			 
                    if($dgetheadersession ){
                        foreach($dgetheadersession as $get){
                            $id = $get->id;
                  	    $fname = $get->fname;
			    $lname = $get->lname;
			    $uLocation = $get->uLocation;
			}
                             $fullname = $fname. " ". $lname;
		   }
                   //DO FIRST INSERTION AND RETURN THE ID 
                   // Note SessionID is the email of the person who registered the request.
                   $randomString = generateRandomCode(1,10);
                   if($paymentType == 1){
                       $userGenCode = str_shuffle(rand(0,100000)).$randomString;
                   }
                   
                   //$insertedFileId = $this->mainlocation->insertAdvanceRequest($dateCreated, "naira", $userGenCode, $descItem, $benName, $dUnit, $paymentType, $dComment, $dhod, $dicu, $dcashier, $daccountant, $sessionEmail, $approvals, $uLocation, $fullname, $sessionEmail);
                    $insertedFileId = $this->accounting->rundraftupdate($dateCreated, $descItem, $benName, $dUnit, $paymentType, $dComment, $dhod, $dicu, $dcashier, $daccountant, $sessionEmail, $approvals, $uLocation, $fullname, $sessionEmail, $hideID, $hashmd5id);
                    
                 if($paymentType == 2){
                      
                    $dataoption = [];
                    $dataoption['CurrencyType'] = $currencyType;

                    $myfulloptions = array(
                      'table' => 'cash_newrequestdb',
                      'data'  => $dataoption
                      );
                  
                   $saveDate = $this->generalmd->update("id", $hideID, $myfulloptions);
                  }
                  
                  //Get the Old Audit Trail
                  $getoldAudit = $this->generalmd->getuserAssetLocation("auditTrail", "cash_newrequestdb", "id", $hideID);
                   //Run MD5 ID
                   $createdby = "--Updated By $sessionEmail ". date('Y-m-d H:i:s'). " and Sent to $dhod for approval";
                   
                   $joinStatement = $getoldAudit.' '. $createdby;
                   
                   $updatemdid = $this->mainlocation->updatemdfiveid($hashmd5id, $joinStatement, $insertedFileId);
                   
                   /*//Use the hideid to disable edit request
                    $disabled = "disabed";
                    $approval = "11";
                    $updatehideID = $this->mainlocation->disablehide($disabled, $approval, $hideID);
                    
                    $updatenewRequest = $this->mainlocation->updatenewrequest($hideID, $insertedFileId);
                    */
                   
                    //////////////////////START MANIPULATION OF THE SECOND REQUEST WHICH IS EXPENSE DETAILS ////////////////////////////////
                   if($hideID){
                      $exid = $this->input->post('exid', TRUE);   
                      $exDetailofpayment =  $this->input->post('exDetailofpayment'); 
                      $exAmount = $this->input->post('exAmount', TRUE); 
                      $exCode = $this->input->post('exCode', TRUE); 
                      $exDate = $this->input->post('exDate', TRUE); 
                      //$sumall = $this->input->post('sumall', TRUE); 
                     
                      
                      for ($i= 0; $i < count($exid); $i++) {
                         $ex_id = $exid[$i];
                         $ex_Detailofpayment = addslashes($exDetailofpayment[$i]);
                         $ex_Amount = $exAmount[$i];
                         $ex_Code = $exCode[$i];
                         $ex_Date = $exDate[$i];
                         
                         $query = $this->accounting->mypushUpdate($ex_id, $ex_Amount, $ex_Detailofpayment, $ex_Code, $ex_Date);
                        
                      }
                         
                     //Update the total amount record
                    $thisUpdateTotalAmount = $this->accounting->updateTotalAmount($sumall, $hideID);
                      
                   } // End of  if($insertedFileId){
                   

                     $randomString = random_string('alnum', 60);
                      if(!empty($thisUpdateTotalAmount)){
			
			$message = "<div>New Request awaiting your approval</div>";
                        $message .= "<div>Request Title: $descItem</div><br/>";
                        $message .= "<div>Click here for details:</div>"
                                . "<a href=".base_url()."home/approvaldetails/$hideID/$hashmd5id>Link to request</a>";
                        
                        $message .= "<br/><hr/>This is an automated email please do not reply<p><br/>";
                        $config = array(
                                'mailtype' => "html"
                                
                          );

                        $this->email->initialize($config);
                        $this->email->from("expensepro@c-iprocure.com", "TBS - EXPENSE PRO"); 
                        $this->email->to($dhod);
                        $this->email->subject('NEW REQUEST FOR APPROVAL'); 
                        $this->email->message($message); 
                        $this->email->send();
                        
                      } 
                     
 //////////////////////////////////END OF FILE UPLOAD PROCESSING ////////////////////////////////////////////////                   
                  
                  $data = ['status'=>1, 'msg'=>'Request Successfully Sent, Please wait you will be redirected'];
                    
                    
                    
                } // End of Else
               $this->output->set_content_type('application/json')->set_output(json_encode($data)); 
               
         } // End of if(isset($_POST['descItem']) || isset($_POST['dhod'])){
  }  
  
  /*
   public function do_msg($name, $insertedFileId){
        $tmp_name = $_FILES['upload_file1']['tmp_name'];
        $location = 'public/documents/'; 
       echo $ext = pathinfo($location.$name, PATHINFO_EXTENSION);
        $mimeType = "application/vnd.ms-outlook";
        $getexplod = explode(".", $name);
       echo $explode = end($getexplod);
         if($ext == "msg" || $explode == "msg"){
             for($i = 0; $i < count($tmp_name); $i++){
                 move_uploaded_file($tmp_name[$i], $location.$name[$i]); 
                 //Do the insertion for the expense details
                $inserting = $this->mainlocation->addnewfile($name[$i], $name[$i], $ext[$i], $mimeType, $insertedFileId);
             }
         
        }
                         
     }
      */                  
  
  public function deleteimage(){
      
       $data = [];
       $delete = $this->input->post('deleteid', TRUE);
       $sessionEmail = $_SESSION['email'];
       //use the tid to return the request id and use the reques id to return the user
         $isRequestID = $this->allresult->gettherequestid($delete);
         $isOwner = $this->adminmodel->maderequestbyme($isRequestID);
       
        if($isOwner == $sessionEmail){
         $theresult = $this->allresult->deletedImage($delete);
         //$theresult = "DELETE FROM cash_fileupload WHERE fid='$delete'";
         
            if($theresult == TRUE){
                 $data = ['msg'=>"successfully deleted"];
            }
        }
       //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }
  
  
}
