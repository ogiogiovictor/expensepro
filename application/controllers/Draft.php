<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

//require_once('PHPMailerAutoload.php');
class Draft extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();


        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        $this->gen->checkLogin();

        //$this->load->library('PHPMailerfunction');

        $putNewSession = $this->users->checkUserSession($_SESSION['email']);
        if ($putNewSession === FALSE) {
            redirect(base_url() . "nopriveledge");
        }
    }

    public function index() {
        redirect(base_url());
    }

    public function draftnewrequest() {

        $data = [];
        $mime = "";
        $ext = "";
        $userGenCode = "";
        require_once 'allowedMimes.php'; //array of allowed types
        if (isset($_POST['descItem'])) {

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
            $sumall = $this->input->post('sumall', TRUE);
            $dCurrencyType = $this->input->post('dCurrencyType', TRUE);
            $dCurrencyType = $dCurrencyType == 'null' ? 'naira' : $dCurrencyType;

            $dcashier = $this->input->post('dcashier', TRUE) ? $this->input->post('dcashier', TRUE) : "";
            $daccountant = $this->input->post('daccountant', TRUE) ? $this->input->post('daccountant', TRUE) : "";

            $approvals = $dhod !== "" ? '0' : '0';
            $sessionEmail = $_SESSION['email'];
            $getallsums = "";

            if ($paymentType == 1) {
                if ($sumall > 800000) {
                    $getallsums = $sumall;
                }
            }

            if ($descItem == "") {

                $data = ['status' => 0, 'msg' => 'Please make sure you fill out all fields'];
            } else

            if ($dcashier == null && $daccountant == 0) {
                $data = ['status' => 9, 'msg' => 'Please wait for the page to load and refresh your browser'];
            } else

            if ($getallsums > 800000) {
                $data = ['status' => 7, 'msg' => 'You can not raise petty Cash of that amount select Cheque Requsition under payment type'];
            } else

            if ($dcashier == $sessionEmail || $dhod == $sessionEmail) {
                $data = ['status' => 3, 'msg' => 'You Cannot set yourself as the 2nd/1st Level Approval, Please select another'];
            } else {

                $dgetheadersession = $this->users->checkUserSession($sessionEmail);
                if ($dgetheadersession) {
                    foreach ($dgetheadersession as $get) {
                        $id = $get->id;
                        $fname = $get->fname;
                        $lname = $get->lname;
                        $uLocation = $get->uLocation;
                    }
                    $fullname = $fname . " " . $lname;
                }
                //DO FIRST INSERTION AND RETURN THE ID 
                // Note SessionID is the email of the person who registered the request.
                $randomString = generateRandomCode(1, 10);
                if ($paymentType == 1) {
                    $userGenCode = str_shuffle(rand(0, 100000)) . $randomString;
                }
                $insertedFileId = $this->mainlocation->insertAdvanceRequest($dateCreated, $dCurrencyType, $userGenCode, $descItem, $benName, $dUnit, $paymentType, $dComment, $dhod, $dicu, $dcashier, $daccountant, $sessionEmail, $approvals, $uLocation, $fullname, $sessionEmail);

                $md5ID = md5($insertedFileId);
                //Run MD5 ID
                $createdby = "Created by $fullname, time: " . date('Y-m-d H:i:s');

                $updatemdid = $this->mainlocation->updatemdfiveid($md5ID, $createdby, $insertedFileId);
//////////////////////START MANIPULATION OF THE SECOND REQUEST WHICH IS EXPENSE DETAILS ////////////////////////////////
                if ($insertedFileId) {

                    $exDetailofpayment = $this->input->post('exDetailofpayment', TRUE);
                    $exAmount = $this->input->post('exAmount', TRUE);
                    $exCode = $this->input->post('exCode', TRUE);
                    $exDate = $this->input->post('exDate', TRUE);
                    $sumall = $this->input->post('sumall', TRUE);

                    foreach ($exAmount as $i => $a) { // need index to match other properties
                        $data = array(
                            'ex_Amount' => $a,
                            'ex_Details' => isset($exDetailofpayment[$i]) ? $exDetailofpayment[$i] : '',
                            'ex_Code' => isset($exCode[$i]) ? $exCode[$i] : '',
                            'ex_Date' => isset($exDate[$i]) ? $exDate[$i] : '',
                            'requestID' => $insertedFileId,
                        );

                        /*
                          foreach ($exLocation as $i => $a) { // need index to match other properties
                          $data = array(
                          'ex_Location' => $a,
                          'ex_Amount' => isset($exAmount[$i]) ? $exAmount[$i] : '',
                          'ex_Payee' => isset($exPayee[$i]) ? $exPayee[$i] : '',
                          'ex_Details' => isset($exDetailofpayment[$i]) ? $exDetailofpayment[$i] : '',
                          'ex_Code' => isset($exCode[$i]) ? $exCode[$i] : '',
                          'ex_Date' => isset($exDate[$i]) ? $exDate[$i] : '',
                          'requestID'=> $insertedFileId,
                          );
                         */
                        $insertexpesedetails = $this->mainlocation->expensedetailsfromdbadvancerequest($data);

                        //Update the total amount record
                        $thisUpdateTotalAmount = $this->mainlocation->updateTotalAmount($sumall, $insertedFileId);
                    }
                } // End of  if($insertedFileId){
///////////////////////////////////BEGINNING OF FILE UPLOAD PROCESSING /////////////////////////////////////////////////
                /*
                  $maxFileSize = 10000000;
                  $i = 0;
                  $files = array();
                  $is_file_error = FALSE;
                  if(!empty($_FILES["upload_file1"]["name"]) && $insertedFileId ){

                  $config['upload_path'] = "public/documents/";
                  $config['allowed_types'] = $allowed; //'gif|jpg|png|jpeg|jpe';
                  $config['file_ext_tolower'] = TRUE;
                  $config['max_size'] = $maxFileSize;//in kb
                  $config['encrypt_name'] = FALSE;

                  //WILL THE FUNCTION BE HERE
                  //SOMETHING LIKE
                  //$this->functionname();

                  foreach ($_FILES as $key => $value) {
                  if (!empty($value['name'])) {
                  $this->load->library('upload', $config);
                  if (!$this->upload->do_upload($key)) {
                  //echo $this->upload->display_errors();
                  $data = ['status'=>5, 'msg'=> $this->upload->display_errors() ];
                  $is_file_error = TRUE;
                  } else {
                  $files[$i] = $this->upload->data();
                  ++$i;
                  }
                  }

                  } //   End of foreach ($_FILES as $key => $value) {


                  if (!$is_file_error && $files) {
                  $resp = $this->mainlocation->save_files_info($files, $insertedFileId);
                  }

                  //////////////////////////////Checking the extension of a File////////////////////////////////////////////////////
                  $name = $_FILES["upload_file1"]["name"];
                  $tmp_name = $_FILES['upload_file1']['tmp_name'];
                  $location = 'public/documents/';
                  $ext = pathinfo($location.$name, PATHINFO_EXTENSION);
                  $mimeType = "application/vnd.ms-outlook";
                  $getexplod = explode(".", $name);
                  $explode = end($getexplod);
                  if($ext == "msg" || $explode == "msg"){
                  move_uploaded_file($tmp_name, $location.$name);
                  //Do the insertion for the expense details
                  $inserting = $this->mainlocation->addnewfile($name, $name, $ext, $mimeType, $insertedFileId);
                  }

                  //////////////////////////////END Checking the extension of a File////////////////////////////////////////////////////

                  } // End of  if(!empty($_FILES["fileUpload"]["tmp_name"])){

                 */

//////////////////////////////////MULITIPLE FILE UPLOAD APP///////////////////////////////////////////////////////////
                if (isset($_FILES['upfile']['name'])) {
                    $name = str_replace(' ', '', $_FILES['upfile']['name']);
                    $name = preg_replace("([#%$></\ +])", "", $name);

                    $origName = str_replace(' ', '', $_FILES['upfile']['name']);
                    $origName = preg_replace("([#%$></\ +])", "", $origName);

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


                $data = ['status' => 1, 'msg' => 'Request Successfully Sent, Please wait you will be redirected'];
            } // End of Else
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } // End of if(isset($_POST['descItem']) || isset($_POST['dhod'])){
    }

    public function draftedit($id = "", $mdid = "", $approvals = "") {

        $checkApproval = $approvals;

        if ($checkApproval != 0) {
            echo "You cannot perform that operation. Only draft request can be edited in this section";
        } else {

            $getallresult = $this->mainlocation->editrejectedrequest($id, $mdid, $checkApproval);
            $getEmail = $this->adminmodel->maderequestbyme($id);
            if ($getallresult == "" || $getallresult == FALSE || $getEmail !== $_SESSION['email']) {
                echo "You cannot perform that operation. Please contact IT Department";
            } else {
                $title = "Petty Cash Pro - Edit Details :: HOMEPAGE";

                $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

                $useidtogetname = $this->mainlocation->descriptionofitem($id);

                $getallaccounts = $this->mainlocation->getallaccounts();
                if ($getallaccounts) {
                    $allact = "";
                    foreach ($getallaccounts as $get) {
                        $codeid = $get->codeid;
                        $codeName = $get->codeName;
                        $codeNumber = $get->codeNumber;
                        $allact .= "<option  value='$codeNumber'> " . $codeName . ' - ' . $codeNumber . '</option>';
                    }
                    //return $allact;
                }

                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'useidtogetname' => $useidtogetname, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer, 'fillSelect' => $allact];
                $this->load->view('draftrequestfinal', $values);
            }
        }
    }

    public function advancedraftrequestnew() {

        $data = [];
        $mime = "";
        $ext = "";
        require_once 'allowedMimes.php'; //array of allowed types
        if (isset($_POST['hideID']) && isset($_POST['descItem'])) {

            // Declaring put putting all variables in Values
            $dateCreated = $this->input->post('dateCreated', TRUE);
            $descItem = $this->input->post('descItem', TRUE);
            $benName = $this->input->post('benName', TRUE);
            $dUnit = $this->input->post('dUnit', TRUE);
            $paymentType = $this->input->post('paymentType', TRUE);
            $dComment = $this->input->post('dComment', TRUE);
            $dComment = preg_replace("/[^a-z A-Z 0-9_-]/", "", $dComment);
            $dhod = $this->input->post('dhod', TRUE);
            $dicu = $this->input->post('dicu', TRUE);
            $exAmount = $this->input->post('exAmount', TRUE);
            $hideID = $this->input->post('hideID', TRUE);
            $mdID = $this->input->post('mdID', TRUE);
            $sumall = $this->input->post('sumall', TRUE);

            $dcashier = $this->input->post('dcashier', TRUE) ? $this->input->post('dcashier', TRUE) : "";
            $daccountant = $this->input->post('daccountant', TRUE) ? $this->input->post('daccountant', TRUE) : "";

            $approvals = $dhod !== "" ? '1' : '0';
            $sessionEmail = $_SESSION['email'];

            $getallsums = "";

            /* if($paymentType == 1){
              if($sumall > 500000){
              $getallsums = $sumall;
              }
              }
             */
            if ($paymentType == "" || $descItem == "" || $dateCreated == "" || $exAmount == "" || $dhod == "") {

                $data = ['status' => 0, 'msg' => 'Please make sure you fill out all fields'];
            } else {

                $dgetheadersession = $this->users->checkUserSession($sessionEmail);
                if ($dgetheadersession) {
                    foreach ($dgetheadersession as $get) {
                        $id = $get->id;
                        $fname = $get->fname;
                        $lname = $get->lname;
                        $uLocation = $get->uLocation;
                    }
                    $fullname = $fname . " " . $lname;
                }
                //DO FIRST INSERTION AND RETURN THE ID 


                $insertedFileId = $this->accounting->rundraftupdate($dateCreated, $descItem, $benName, $dUnit, $paymentType, $dComment, $dhod, $dicu, $dcashier, $daccountant, $sessionEmail, $approvals, $uLocation, $fullname, $sessionEmail, $hideID, $mdID);


                //////////////////////START MANIPULATION OF THE SECOND REQUEST WHICH IS EXPENSE DETAILS ////////////////////////////////
                if ($hideID) {
                    $exid = $this->input->post('exid', TRUE);
                    $exDetailofpayment = $this->input->post('exDetailofpayment', TRUE);
                    $exAmount = $this->input->post('exAmount', TRUE);
                    $exCode = $this->input->post('exCode', TRUE);
                    $exDate = $this->input->post('exDate', TRUE);
                    //$sumall = $this->input->post('sumall', TRUE); 


                    for ($i = 0; $i < count($exid); $i++) {
                        $ex_id = $exid[$i];
                        $ex_Detailofpayment = $exDetailofpayment[$i];
                        $ex_Amount = $exAmount[$i];
                        $ex_Code = $exCode[$i];
                        $ex_Date = $exDate[$i];

                        //Use the ex_id to check if exist in the database, then update, else insert
                        $iExist = $this->accounting->meExist($ex_id);

                        if ($iExist == TRUE) {
                            $query = $this->accounting->pushUpdate($ex_id, $ex_Amount, $ex_Detailofpayment, $ex_Code, $ex_Date);
                        }
                    }

                    /* for($i= 0; $i < count($exid); $i++) {
                      $ex_id = $exid[$i];
                      $ex_Detailofpayment = $exDetailofpayment[$i];
                      $ex_Amount = $exAmount[$i];
                      $ex_Code = $exCode[$i];
                      $ex_Date = $exDate[$i];
                      //Use the ex_id to check if exist in the database, then update, else insert
                      $iExist = $this->accounting->meExist($ex_id);

                      if($iExist == ""){
                      $query2 = $this->accounting->InsertExpenseUpdate($ex_Amount, $ex_Detailofpayment, $ex_Code, $ex_Date, $hideID);

                      }

                      } */

                    //Update the total amount record
                    $thisUpdateTotalAmount = $this->mainlocation->updateTotalAmount($sumall, $hideID);
                }
            } // End of  if($insertedFileId){
//////////////////////////////////MULITIPLE FILE UPLOAD APP///////////////////////////////////////////////////////////
            if (isset($_FILES['upfile']['name'])) {
                $name = str_replace(' ', '', $_FILES['upfile']['name']);
                $name = preg_replace("([#%$></\ +])", "", $name);

                $origName = str_replace(' ', '', $_FILES['upfile']['name']);
                $origName = preg_replace("([#%$></\ +])", "", $origName);

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

                    $inserting = $this->mainlocation->addnewfile($fname, $newName, $ext, $mimeType, $hideID);
                    $i++;
                }
            }
/////////////////////////////////END OF MULTIPLE FILE UPLOAD FILE ////////////////////////////////////////////////////


            $data = ['status' => 1, 'msg' => 'Request Successfully Sent, Please wait you will be redirected'];
        } // End of Else
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

// End of if(isset($_POST['descItem']) || isset($_POST['dhod'])){

    //////////////////////////////////////////NORMAL EDIT BEGINS HERE NOT DRAFT EDIT OH ///////////////////////////////////

    public function editrequestforwaitingapproval($id, $mdid, $approvals, $sessionID) {

        $getallresult = $this->cashiermodel->editrejectedrequestawait($id, $mdid, $sessionID);
        $whichApp = @$this->generalmd->getsinglecolumn("apprequestID", "cash_newrequestdb", "id", $id);
        if ($getallresult && $whichApp == "") {
            $title = "Petty Cash Pro - Edit Details :: EDIT ME REQUEST";

            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

            $userUnit = $this->generalmd->getuserAssetLocation("dUnit", "cash_usersetup", "email", $this->session->email);

            $this->load->model('maintenance');

            $allVendors = "";
            $getallvendors = $this->maintenance->fromaintenance("*", "maintenance_workshop", "unitID", $userUnit);
            if ($getallvendors) {

                foreach ($getallvendors as $get) {
                    $mainID = $get->id;
                    $wkName = $get->workshop_name;
                    $allVendors .= "<option  value='$mainID'>$wkName</option>";
                }
                //return $allact;
            }

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'myvendors' => $allVendors, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('draftawaitinghodapproval', $values);
        } else {
            echo "You do not have access to this page, only request not approved by HOD can be edited";
        }
    }

    public function waitinghodtoapproval() {

        $data = [];
        $mime = "";
        $ext = "";
        $userGenCode = "";
        require_once 'allowedMimes.php'; //array of allowed types
        if (isset($_POST['hideID'])) {

            // Declaring put putting all variables in Values
            $dateCreated = $this->input->post('dateCreated', TRUE);
            $descItem = addslashes($this->input->post('descItem', TRUE));
            $benName = addslashes($this->input->post('benName', TRUE));
            //$benEmail = $this->input->post('benEmail', TRUE);
            $dUnit = $this->input->post('dUnit', TRUE);
            $paymentType = $this->input->post('paymentType', TRUE);
            $dComment = addslashes($this->input->post('dComment', TRUE));
            $dhod = $this->input->post('dhod', TRUE);
            $dicu = $this->input->post('dicu', TRUE);
            $exAmount = $this->input->post('exAmount', TRUE);
            $hideID = $this->input->post('hideID', TRUE);
            $sumall = $this->input->post('sumall', TRUE);
            $hashmd5id = $this->input->post('hashmd5id', TRUE);
            $currencyType = $this->input->post('currencyType', TRUE);

            //Use the hideID to return approval 
            $CheckifApproved = $this->cashiermodel->getdapprovals($hideID);

            $dcashier = $this->input->post('dcashier', TRUE) ? $this->input->post('dcashier', TRUE) : "";
            $daccountant = $this->input->post('daccountant', TRUE) ? $this->input->post('daccountant', TRUE) : "";

            $approvals = $dhod !== "" ? '1' : '0';
            $sessionEmail = $_SESSION['email'];

            $getallsums = "";



            if ($paymentType == "" || $descItem == "" || $dateCreated == "" || $exAmount == "") {

                $data = ['status' => 0, 'msg' => 'Please make sure you fill out all fields'];
            } else

            if ($CheckifApproved == 2) {
                $data = ['status' => 7, 'msg' => 'Your cannot edit this request, please check with your HOD it has already been approved'];
            } else

            if ($dhod == $sessionEmail) {
                $data = ['status' => 3, 'msg' => 'You Cannot set yourself as the 2nd/1st Level Approval, Please select another'];
            } else {

                $dgetheadersession = $this->users->checkUserSession($sessionEmail);
                if ($dgetheadersession) {
                    foreach ($dgetheadersession as $get) {
                        $id = $get->id;
                        $fname = $get->fname;
                        $lname = $get->lname;
                        $uLocation = $get->uLocation;
                    }
                    $fullname = $fname . " " . $lname;
                }
                //DO FIRST INSERTION AND RETURN THE ID 
                // Note SessionID is the email of the person who registered the request.
                $randomString = generateRandomCode(1, 10);
                if ($paymentType == 1) {
                    $userGenCode = str_shuffle(rand(0, 100000)) . $randomString;
                }

                $insertedFileId = $this->accounting->rundraftupdate("$dateCreated", "$descItem", "$benName", "$dUnit", "$paymentType", "$dComment", "$dhod", "$dicu", "$dcashier", "$daccountant", "$sessionEmail", "$approvals", "$uLocation", "$fullname", "$sessionEmail", "$hideID", "$hashmd5id");

                if ($paymentType == 2) {

                    $dataoption = [];
                    $dataoption['CurrencyType'] = $currencyType;

                    $myfulloptions = array(
                        'table' => 'cash_newrequestdb',
                        'data' => $dataoption
                    );

                    $saveDate = $this->generalmd->update("id", $hideID, $myfulloptions);
                }


                //////////////////////START MANIPULATION OF THE SECOND REQUEST WHICH IS EXPENSE DETAILS ////////////////////////////////
                if ($hideID) {
                    $exid = $this->input->post('exid', TRUE);
                    $exDetailofpayment = $this->input->post('exDetailofpayment');
                    $exAmount = $this->input->post('exAmount', TRUE);
                    $exCode = $this->input->post('exCode', TRUE);
                    $exDate = $this->input->post('exDate', TRUE);
                    //$sumall = $this->input->post('sumall', TRUE); 


                    for ($i = 0; $i < count($exid); $i++) {
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
//////////////////////////////////MULITIPLE FILE UPLOAD APP///////////////////////////////////////////////////////////
                /*       if(isset($_FILES['upfile']['name'])){  
                  $name = str_replace(' ', '', $_FILES['upfile']['name']);
                  // $name = preg_replace("([#%$></\ +])", "", $name);

                  $origName = str_replace(' ', '', $_FILES['upfile']['name']);
                  //$origName = preg_replace("([#%$></\ +])", "", $origName);

                  $location = 'public/documents/';
                  $i = 0;
                  while($i < count($name)){
                  $mimeType = $_FILES['upfile']['type'][$i];
                  $temp = $_FILES['upfile']['tmp_name'][$i];
                  $fname = $name[$i];
                  $random = random_string('alnum', 10);
                  $savetime = date("mdy-Hms");
                  $newName = $random.$savetime.$origName[$i];

                  $ext = pathinfo($location.$fname, PATHINFO_EXTENSION);
                  move_uploaded_file($temp, $location.$newName);

                  $inserting = $this->mainlocation->addnewfile($fname, $newName, $ext, $mimeType, $hideID);
                  $i++;
                  }
                  }

                 */
                //////////////////////////////////END OF FILE UPLOAD PROCESSING ////////////////////////////////////////////////                   

                $data = ['status' => 1, 'msg' => 'Request Successfully Sent, Please wait you will be redirected'];
            } // End of Else
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } // End of if(isset($_POST['descItem']) || isset($_POST['dhod'])){
    }

    public function deletexpense() {

        $data = [];
        $delete = $this->input->post('deleteid', TRUE);
        $sessionEmail = $_SESSION['email'];
        //use the tid to return the request id and use the reques id to return the user
        $isRequestID = $this->allresult->getExpenseID($delete);
        $isOwner = $this->adminmodel->maderequestbyme($isRequestID);

        if ($isOwner == $sessionEmail) {
            $theresult = $this->allresult->deleteExpenseDetails($delete);

            if ($theresult == TRUE) {
                $data = ['msg' => "successfully deleted"];
            }
        }
        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function uploaddocuments($id = "", $mdid = "", $sessionID = "") {
        $getallresult = $this->accounting->uploadocument($id, $mdid, $sessionID);
        $whichApp = @$this->generalmd->getsinglecolumn("apprequestID", "cash_newrequestdb", "id", $id);
        //  if($getallresult){
        $title = "Petty Cash Pro - Edit Details :: EDIT ME REQUEST";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('uploadmydoc.php', $values);
        //  }else{
        //echo "You do not have access to this page, only request not approved by HOD can be edited";
        // }
    }

    public function uploaddocumentsfromproc($id = "", $mdid = "", $sessionID = "") {
        $getallresult = $this->accounting->uploadocument($id, $mdid, $sessionID);
        $whichApp = @$this->generalmd->getsinglecolumn("apprequestID", "cash_newrequestdb", "id", $id);
        //  if($getallresult){
        $title = "Petty Cash Pro - Edit Details :: EDIT ME REQUEST";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('uploadmydocfromproc.php', $values);
        //  }else{
        //echo "You do not have access to this page, only request not approved by HOD can be edited";
        // }
    }

    public function upoadFiles() {

        $data = [];

        if (isset($_POST['fileIDupload'])) {
            //Use the Item to delete Request
            $requestID = $this->input->post('fileIDupload', TRUE);

            $checkifprocurement = $this->generalmd->getsinglecolumn("approvals", "cash_newrequestdb", "id", $requestID);

            //if($letCheckStatus == 1){
            if ($checkifprocurement == 15) {

                if (isset($_FILES['upfile']['name'])) {
                    $name = str_replace(' ', '', $_FILES['upfile']['name']);
                    // $name = preg_replace("([#%$></\ +])", "", $name);

                    $origName = str_replace(' ', '', $_FILES['upfile']['name']);
                    //$origName = preg_replace("([#%$></\ +])", "", $origName);

                    $location = 'https://c-iprocure.com/scp/user_data/';
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

                        $inserting = $this->mainlocation->addnewfile($fname, $newName, $ext, $mimeType, $requestID);
                        $i++;
                    }

                  /*  $updateArray['approvals'] = '2';
                    $options = array(
                        'table' => 'cash_newrequestdb',
                        'data' => $updateArray
                    );
                    $updateRecord = $this->generalmd->update("id", $requestID, $options);
                   * 
                   */

                    $data = ["status" => 200, "msg" => "Files Successfully Uploaded"];
                }
            } else {
                $data = ["status" => 401, "msg" => "You Cannot Upload To Request, Please Check Status"];
            }
        } else {
            $data = ["status" => 402, "msg" => "Important Variable To Process Page Missing"];
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function processupload() {
        $fileName = str_replace(' ', '', $_FILES['file1']['name']);
        $fileTemp = $_FILES["file1"]["tmp_name"];
        $mimeType = $_FILES["file1"]["type"];
        $fileSize = $_FILES["file1"]["size"];
        $fileerror = $_FILES["file1"]["error"];
        $fileIDupload = $this->input->post('fileIDupload');

        $random = random_string('alnum', 10);
        $savetime = date("mdy-Hms");
        $newName = $random . $savetime . $fileName;

        $uploadlocation = "public/documents/$newName";
        $ext = pathinfo($uploadlocation . $newName, PATHINFO_EXTENSION);

        if (!$fileTemp) {
            echo "ERROR: Uploading File, please make sure your file name has no special character and no spaces $mimeType";
            exit();
        }
        if (move_uploaded_file($fileTemp, $uploadlocation)) {
            $inserting = $this->mainlocation->addnewfile($fileName, $newName, $ext, $mimeType, $fileIDupload);
            echo "$fileName upload is complete";
        } else {
            echo "File was not uploaded. Please avoid special characters and long file names";
        }
    }

    public function fileupload() {

        include('class.uploader.php');

        $uploader = new Uploader();

        /* $fileName =  $_FILES['files']['name'];
          $random = random_string('alnum', 10);
          $savetime = date("mdy-Hms");
          $newName = $random.$savetime.$fileName; */
        $getID = $this->input->post('type', TRUE);
        $checkifprocurement = $this->generalmd->getsinglecolumn("from_app_id", "cash_newrequestdb", "id", $getID);

        if ($checkifprocurement == 3) {
            
        } else {
            $data = $uploader->upload($_FILES['files'], array(
                'limit' => 10, //Maximum Limit of files. {null, Number}
                'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
                'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
                'required' => false, //Minimum one file is required for upload {Boolean}
                'uploadDir' => 'public/documents/', //Upload directory {String}
                'title' => array('auto'), //New file name {null, String, Array} *please read documentation in README.md
                'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
                'perms' => null, //Uploaded file permisions {null, Number}
                'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
                'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
                'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
                'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
                'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
                'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
            ));
        }

        if ($data['isComplete']) {
            $getID = $this->input->post('type', TRUE);
            $files = $data['data'];
            //$files = $data['data']['files'][0];
            $new_filesName = $data['data']['metas'][0]['name'];
            $old_filesName = $data['data']['metas'][0]['old_name'];
            $extension = $data['data']['metas'][0]['extension'];
            $size2 = $data['data']['metas'][0]['size2'];
            $dateUploaded = $data['data']['metas'][0]['date'];
            //$files = $data['title'];
            $dataoption = [];
            $dataoption['newFilename'] = $old_filesName;
            $dataoption['origFilename'] = $new_filesName;
            $dataoption['ext'] = $extension;
            //$dataoption['size'] = $size2;
            $dataoption['dateUploaded'] = date("y-m-d");
            $dataoption['f_requestID'] = $getID;

            //Insert the Details on the Referal Table
            $myfulloptions = array(
                'table' => 'cash_fileupload',
                'data' => $dataoption
            );

            //$inserting = $this->mainlocation->addnewfile($fileName, $newName, $ext, $mimeType, $fileIDupload);  
            //Insert into notifications
            $solidresponse = $this->generalmd->create($myfulloptions);

            //////////////////////////////////////// SEND EMAIL TO ICU OFFICER////////////////////////////////////////////
            // check if from procurement
            $checkifprocurement = $this->generalmd->getsinglecolumn("from_app_id", "cash_newrequestdb", "id", $getID);
            if ($checkifprocurement == 3) {
                $updateArray['approvals'] = '2';
                $options = array(
                    'table' => 'cash_newrequestdb',
                    'data' => $updateArray
                );
                $updateRecord = $this->generalmd->update("id", $getID, $options);
            }

            //////////////////////////////////////  SEND EMAIL TO ICU OFFICER ///////////////////////////////////////////


            print_r($files);
        }

        if ($data['hasErrors']) {
            $errors = $data['errors'];
            print_r($errors);
        }
    }

    public function sendtoicu() {

        $data = [];

        if (isset($_POST['fileIDupload'])) {
            //Use the Item to delete Request
            $requestID = $this->input->post('fileIDupload', TRUE);
            $checkifprocurement = $this->generalmd->getsinglecolumn("approvals", "cash_newrequestdb", "id", $requestID);

            if ($checkifprocurement == 15) {

                $updateArray['approvals'] = '2';
                $options = array(
                    'table' => 'cash_newrequestdb',
                    'data' => $updateArray
                );
                $updateRecord = $this->generalmd->update("id", $requestID, $options);

                $data = ["status" => 200, "msg" => "Successfully Sent To ICU"];
            } 
        } else {
            $data = ["status" => 402, "msg" => "Important Variable To Process Page Missing"];
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    
    ///////////////////////////////////////END OF NOR EDIT//////////////////////////////////////////////////////////////
}

// End of Class Home
