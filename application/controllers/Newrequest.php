<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
require_once 'allowedMimes.php'; //array of allowed types
//require_once('PHPMailerAutoload.php');
//   ini_set('post_max_size', '64M');
//  ini_set('upload_max_filesize', '64M');

class Newrequest extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
   public $paymentType;
   public $dateCreated;
   public $descItem;
   public $benName;
   public $vendor;
   public $dUnit;
   public $dComment;
   public $dhod;
   public $dicu;
   public $dCurrencyType;
   public $sumall;
   public $getmyUnit;
   public $sageRef;
   public $dcashier;
   public $daccountant;
   public $approvals;
   public $datenow;
   public $multiTotal;
   public $p_exAmount;
   public $exAmount;
   
    public function __construct() {
        parent::__construct();


        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        $this->gen->checkLogin();
        $this->gen->mainSetting();

        //redirect(base_url()."nopriveledge");
        // redirect(base_url());
    }

    private function postvars() {

        // Declaring put putting all variables in Values
        $this->dateCreated = $this->input->post('dateCreated', TRUE);
        $this->descItem = $this->db->escape_str($this->input->post('descItem', TRUE));
        $this->benName = $this->db->escape_str($this->input->post('benName', TRUE));
        $this->vendor = $this->db->escape_str($this->input->post('vendor', TRUE));
        $this->dUnit = $this->input->post('dUnit', TRUE);
        $this->paymentType = $this->input->post('paymentType', TRUE);
        $this->dComment = $this->db->escape_str($this->input->post('dComment', TRUE));
        $this->dhod = $this->input->post('dhod', TRUE);
        $this->dicu = $this->input->post('dicu', TRUE);
        $this->dCurrencyType = $this->input->post('dCurrencyType', TRUE);
        $this->sumall = number_format($this->input->post('sumall', TRUE), 2);
        $this->getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        $this->sageRef = $this->input->post('sageRef', TRUE);

        $this->dcashier = $this->input->post('dcashier', TRUE) ? $this->input->post('dcashier', TRUE) : "";
        $this->daccountant = $this->input->post('daccountant', TRUE) ? $this->input->post('daccountant', TRUE) : "";

        $this->approvals = $this->dhod !== "" ? '1' : '0';
    }
    
    
    
    private function validations($paymentType, $benName, $vendor, $descItem, $dateCreated, $dcashier, $daccountant, $getallsums, 
            $dCurrencyType, $dhod, $sessionEmail, $today, $sumall, $p_exAmount){
        
            $datenow = date('Y-m-d');
          
            
            //for ($i = 0; $i < count($_POST["exAmount"]); $i++) {
            for ($i = 0; $i < count($p_exAmount); $i++) {

                $this->exAmount = $p_exAmount[$i];

                $this->multiTotal += $this->exAmount;
            }
            
            if ($paymentType == 1 && $benName == "") {
                $data = ['status' => 10, 'msg' => 'Please add Beneficary and make sure its petty cash'];
            } else if ($paymentType == 2 && $vendor == "") {
                $data = ['status' => 14, 'msg' => 'Please select vendor and make sure its petty cash'];
            } else if ($dateCreated < $datenow) {
                $data = ['status' => 17, 'msg' => 'Why are you trying to backdate your request. NOT ALLOWED!'];
            } else if ($paymentType == "" || $descItem == "" || $dateCreated == "" || $dhod == "" || ($dcashier == "" && $daccountant == "") || $dateCreated == "0000-00-00") {

                $data = ['status' => 0, 'msg' => 'Please make sure you fill out all fields'];
            } else if ($paymentType == 2 && $dCurrencyType == 'null') {
                $data = ['status' => 6, 'msg' => 'You must select a Currency type of Cheque'];
            } else if ($dcashier == null && $daccountant == 0) {
                $data = ['status' => 9, 'msg' => 'Please wait for the page to load and refresh your browser'];
            } else

            if ($getallsums > 200000) {
                $data = ['status' => 7, 'msg' => 'You can not raise petty Cash of that amount select Cheque Requsition under payment type'];
            } else

            if ($dhod == $sessionEmail) { //$dcashier == $sessionEmail ||
                $data = ['status' => 3, 'msg' => 'You Cannot set yourself as the 2nd/1st Level Approval, Please select another'];
            } else if ($dateCreated < $today) {
                $data = ['status' => 8, 'msg' => 'You cannot set a date in the past'];
                //if($multiTotal > $sumall || $multiTotal != $sumall || $sumall > $multiTotal){
            } else if ($sumall > @number_format($this->multiTotal, 2)) {
                $data = ['status' => 12, 'msg' => 'Balances do not agree please check your amount' . $this->multiTotal];
            } 

    }
    
    
    public function advancenewrequest() {

        $data = [];
        $mime = "";
        $ext = "";
        $userGenCode = "";

        if ($this->input->is_ajax_request()) {

            $this->postvars();

            $sessionEmail = strtolower($_SESSION['email']);
           $sessionName = $this->adminmodel->getUsername($this->session->email);
            $getallsums = "";
            $today = date("Y-m-d");
            if ($this->paymentType == 1) {
                if ($this->sumall > 200000) {
                    $getallsums = $this->sumall;
                }
            }
            
           

           

            $mainBeneficiary = $this->paymentType == 1 ? $this->benName : $this->vendor;

            $this->validations($this->paymentType, $this->benName, $this->vendor, $this->descItem, $this->dateCreated, 
                    $this->dcashier, $this->daccountant, $getallsums, $this->dCurrencyType, $this->dhod, 
                    $sessionEmail, $today, $this->sumall, $this->p_exAmount);
            
            
            //else {

               
                //DO FIRST INSERTION AND RETURN THE ID 
                // Note SessionID is the email of the person who registered the request.
                $randomString = generateRandomCode(1, 10);
                if ($this->paymentType == 1) {
                    $userGenCode = str_shuffle(rand(0, 100000)) . $randomString;
                    $newDescription = $this->descItem;
                } else if ($this->paymentType == 2) {
                    $newDescription = $this->descItem . ' - ' . $this->sageRef;
                } else {
                    $newDescription = $this->descItem;
                }

                $datarray = [];
                $datarray['dateCreated'] = date('Y-m-d H:i:s');
                $datarray['CurrencyType'] = $this->dCurrencyType;
                $datarray['userCode'] = $userGenCode;
                $datarray['ndescriptOfitem'] = $this->descItem;
                $datarray['benName'] = $mainBeneficiary;
                $datarray['dUnit'] = $this->dUnit;
                $datarray['nPayment'] = $this->paymentType;
                $datarray['requesterComment'] = $this->dComment;
                $datarray['hod'] = $this->dhod;
                $datarray['icus'] = $this->dicu;
                $datarray['cashiers'] = $this->dcashier;
                $datarray['dAccountgroup'] = $this->daccountant;
                $datarray['sessionID'] = $sessionEmail;
                $datarray['approvals'] = $this->approvals;
                $datarray['dLocation'] =   $this->session->uLocation;
                $datarray['fullname'] = $sessionName;
                $datarray['pendingHOD'] = $sessionEmail;
                $datarray['dateRegistered'] = date("y-m-d");
                $datarray['sageRef'] = $this->sageRef;
                $datarray['createdUserID'] = $_SESSION['id'];
                $datarray['company'] = "1";
                if ($this->paymentType == 1) {
                    $datarray['from_app_id'] = "0";
                } else {
                    $datarray['from_app_id'] = "8";
                }


                $options = array(
                    'table' => 'cash_newrequestdb',
                    'data' => $datarray
                );

                $insertedFileId = $this->generalmd->create($options);


                $md5ID = md5($insertedFileId);

                $createdby = "Created by $sessionName, time: " . date('Y-m-d H:i:s');
                //Run MD5 ID
                $updatemdid = $this->mainlocation->updatemdfiveid($md5ID, $createdby, $insertedFileId);
//////////////////////START MANIPULATION OF THE SECOND REQUEST WHICH IS EXPENSE DETAILS ////////////////////////////////
                if ($insertedFileId) {

                    $exDetailofpayment = $this->db->escape_str($this->input->post('exDetailofpayment', TRUE));
                    $exAmount = $this->input->post('exAmount', TRUE);
                    $exCode = $this->input->post('exCode', TRUE);
                    $exCode = preg_replace("/[^0-9]/", "", $exCode);
                    $exDate = $this->input->post('exDate', TRUE);
                    $sumall = $this->input->post('sumall', TRUE);


                    foreach ($exAmount as $i => $a) { // need index to match other properties
                        $data = array(
                            'ex_Amount' => $a,
                            'ex_Details' => $exDetailofpayment[$i],
                            'ex_Code' => $exCode[$i],
                            'ex_Date' => $exDate[$i],
                            'requestID' => $insertedFileId,
                        );

                        $insertexpesedetails = $this->mainlocation->expensedetailsfromdbadvancerequest($data);

                        //Update the total amount record
                        $thisUpdateTotalAmount = $this->mainlocation->updateTotalAmount($sumall, $insertedFileId);
                    }
                } // End of  if($insertedFileId){
             
//////////////////////////////////MULITIPLE FILE UPLOAD APP///////////////////////////////////////////////////////////
                if (isset($_FILES['upfile']['name'])) {
                    $name = str_replace(' ', '', $_FILES['upfile']['name']);
                    // $name = preg_replace("([#%$></\ +])", "", $name);

                    $origName = str_replace(' ', '', $_FILES['upfile']['name']);
                    //$origName = preg_replace("([#%$></\ +])", "", $origName);

                    $location = 'public/documents/';
                    $i = 0;
                    while ($i < count($name)) {
                        $mimeType = $_FILES['upfile']['type'][$i];
                        $temp = $_FILES['upfile']['tmp_name'][$i];
                        $fname = $name[$i];
                        $random = random_string('alnum', 10);
                        $savetime = date("mdy-Hms");
                        $newName = $random . $savetime . $origName[$i];

                        $ext = pathinfo($location . $fname, PATHINFO_EXTENSION);
                        move_uploaded_file($temp, $location . $newName);

                        $inserting = $this->mainlocation->addnewfile($fname, $newName, $ext, $mimeType, $insertedFileId);
                        $i++;
                    }
                }
/////////////////////////////////END OF MULTIPLE FILE UPLOAD FILE ////////////////////////////////////////////////////


                $randomString = random_string('alnum', 60);
                $baseUrl = base_url();

                  if(!empty($insertedFileId)){

                  $message = "<div>New Request awaiting your approval</div>";
                  $message .= "<div>Request Title: $this->descItem</div><br/>";
                  $message .= "<div>Click here for details:</div>"
                  . "<a href=".base_url()."home/approvaldetails/$insertedFileId/$md5ID/$randomString>Link to request</a>";


                  $message .= "<br/><hr/>This is an automated email please do not reply<p><br/>";
                  $config = array(
                  'mailtype' => "html"

                  );

                  $this->email->initialize($config);
                  $this->email->from("expensepro@c-iprocure.com", "TBS-EXPENSE PRO");
                  $this->email->to($this->dhod);
                  $this->email->subject('NEW REQUEST FOR APPROVAL');
                  $this->email->message($message);
                  $this->email->send();

               

                  } 

             
                //////////////////////////////////END OF FILE UPLOAD PROCESSING ////////////////////////////////////////////////                   

                $data = ['status' => 1, 'msg' => 'Request Successfully Sent, Please wait you will be redirected'];
           // } // End of Else
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } // End of if(isset($_POST['descItem']) || isset($_POST['dhod'])){
    }

   
}

// End of Class Home
