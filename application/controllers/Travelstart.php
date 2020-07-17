<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
require_once 'PHPMailer/PHPMailerAutoload.php';

class Travelstart extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('travelmodel');
	$this->load->model('accountrecievable');
       // $this->load->library('PHPMailerfunction');

        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        $this->gen->checkLogin();

        $putNewSession = $this->users->checkUserSession($_SESSION['email']);
        if ($putNewSession === FALSE) {
            redirect("https://c-iprocure.com/expensepro/nopriveledge");
        }
    }

    public function index() {
        redirect(base_url());
    }

    public function processtravel($staffID) {
        $data = [];
        if ($staffID == "") {
            $data = ["msg" => "Staff ID Cannot Be Empty"];
        } else {

            $staffID = $this->input->post('staffID', true);
            $staffJoin = "S" . $staffID;
            //Get all Company Where Client is 2
            $getajobCheck = $this->travelmodel->gotogetoajob($staffJoin);
            if ($getajobCheck) {
                foreach ($getajobCheck as $sf) {
                    $sID = $sf->staff_id;
                    $name = $sf->name;
                    $salaryLevel = $sf->salary_level;

                    $sEmail = $this->travelmodel->getstaffemailfromgetajob($sID);

                    $data = ["msg" => "Confirmed", "staffD" => $sID, "staffname" => $name, "sEmail" => $sEmail, "sLevel" => $salaryLevel];
                }
            } else {
                $data = ["msg" => "No_staff"];
            }
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function processform() {

        $data = [];
        $mime = "";
        $ext = "";
        $userGenCode = "";
        require_once 'allowedMimes.php'; //array of allowed types
        if (isset($_POST['control_csrf']) && isset($_POST['logistics']) && isset($_POST['csrf_valid']) && isset($_POST['hodEmail']) && isset($_POST['staffID'])) {

            // Declaring put putting all variables in Values
            $staffID = $this->input->post('staffID', TRUE);
            $benName = $this->input->post('benName', TRUE);
            $benEmail = $this->input->post('benEmail', TRUE);

            $sDate = $this->input->post('exsDate', TRUE);
            $rDate = $this->input->post('exrDate', TRUE);
            $hodEmail = $this->input->post('hodEmail', TRUE);
            $logistics = $this->input->post('logistics', TRUE);
            $purpose = $this->input->post('purpose', TRUE);
            $bankName = $this->input->post('bankName', TRUE);
            $acctNum = $this->input->post('acctNum', TRUE);
            $dHotels = $this->input->post('dHotels', TRUE);
            $control_csrf = $this->input->post('control_csrf', TRUE);
            $csrf_valid = $this->input->post('csrf_valid', TRUE);
            $warefoffice = $this->input->post('warefoffice', TRUE);
            $sLevel = $this->input->post('sLevel', TRUE);
            $sLevel = preg_replace("/[^a-zA-Z]+/", "", $sLevel);
            $sessEmail = $this->session->email;
            $sessID = $this->session->id;

            //CHECK THE STAFF ID THAT WAS POSTED
            $staffJoin = "S" . $staffID;
            //Get all Company Where Client is 2
            $getajobCheck = $this->travelmodel->gotogetoajob($staffJoin);
            
            //Use the beneficiary email to return if the user has done retirement
            $getRetirment = $this->travelmodel->doyouretirment($benEmail);

            if (empty($control_csrf) || empty($csrf_valid)) {
                $data = ['status' => 0, 'msg' => 'Secured Encryption Parameters missing'];
            }else if($getRetirment){
               $data = ['status' => 0, 'msg' => 'You have a pending retirement, please retire before you can make another travel request']; 
            }else if(empty($sLevel)){ 
                $data = ['status' => 0, 'msg' => 'You have not been placed on any salary level. Please contact HR'];
            } else if ($staffID == "" || $benName == "" || $benEmail == "" || $sDate == "" || $rDate == "" || $hodEmail == "" || $logistics == "" || $purpose == "") {
                $data = ['status' => 1, 'msg' => 'Please make sure all fields are filled'];
            } else if ($getajobCheck == FALSE) {
                $data = ['status' => 2, 'msg' => 'Your Staff ID Does Not Exist'];
            } else {
                //$letters = range('a', 'd');
                //Use the Staff ID to return Location and Unit of the Staff
                $thisgetlocale = $this->travelmodel->getmorestaffdetails($staffJoin);
                if ($thisgetlocale) {
                    foreach ($thisgetlocale as $me) {
                        $business_branch = $me->business_branch;
                        $unit = $me->unit;
                    }
                }
                
              
                $auditTrail = "Created by " . $sessEmail . "&nbsp; time: " . date('Y-m-d H:i:s');
                //Insert all Records and Send Back
                $pushRecords = $this->travelmodel->addmyflightrequest($staffID, $warefoffice, $benName, $benEmail, $business_branch, $unit, $hodEmail, $control_csrf, $csrf_valid, $bankName, $acctNum, $sLevel, $sessEmail, $auditTrail);

                /*                 * ************************** BEGINNING OF WHITE LOOP FOR TRAVEL_EXPENSES ********************************************** */
                $exCode = "704031011";
                if ($pushRecords) {
                    //$sLevel = $this->input->post('sLevel', TRUE);
                    //$sLevel = preg_replace("/[^a-zA-Z]+/", "", $sLevel);
                    for ($i = 0; $i < count($_POST["tTolocation"]); $i++) {
                        $tFromlocation = $_POST['tFromlocation'][$i];
                        $tTolocation = $_POST['tTolocation'][$i];
                        $exsDate = $_POST['exsDate'][$i];
                        $exrDate = $_POST['exrDate'][$i];
                        $purpose = $_POST['purpose'][$i];
                        $logistics = $_POST['logistics'][$i];

                        $getsDay = strtotime($exsDate);
                        $getrDay = strtotime($exrDate);
                        if ($getsDay > $getrDay) {
                            $totalDay = $getsDay - $getrDay;
                        } else {
                            $totalDay = $getrDay - $getsDay;
                        }

                        $totalDay = floor($totalDay / (60 * 60 * 24));

                        //difference between two dates
                        //$totalDay = date_diff($exsDate,$exrDate);
                        //count days
                        //echo 'Days Count - '.$diff->format("%a");

                        if ($logistics == 'perdiem') {
                            $getforSalaryLevel = $this->travelmodel->myperdiemclasslevel($sLevel, $tTolocation);
                        } else if ($logistics == 'hotel') {
                            $getforSalaryLevel = $this->travelmodel->dHotelClass($dHotels);
                        }
                        $fullAmount = $getforSalaryLevel * $totalDay;
                        $inserpartsUsed = $this->travelmodel->addlocationamthr($pushRecords, $totalDay, $fullAmount, $tFromlocation, $tTolocation, $exsDate, $exrDate, $getforSalaryLevel, $purpose, $logistics, $exCode);
                    }
                    
                } // End of  if($pushRecords){ THIS IS A LOOP
                
               /////////////////////////////// THIS PORTION UPLOADS FILES /////////////////////////////////////// 
                
                  if (isset($_FILES['upfile']['name'])) {
                       $name = str_replace(' ', '', $_FILES['upfile']['name']);
                    // $name = preg_replace("([#%$></\ +])", "", $name);

                    $origName = str_replace(' ', '', $_FILES['upfile']['name']);
                    //$origName = preg_replace("([#%$></\ +])", "", $origName);

                    $location = 'public/travelstart_doc/';
                    $i = 0;
                   // while ($i < count($name)) {
                        $mimeType = $_FILES['upfile']['type'];
                        $temp = $_FILES['upfile']['tmp_name'];
                        $fname = $name;
                        $random = random_string('alnum', 10);
                        $savetime = date("mdy-Hms");
                        $newName = $random . $savetime . $origName;

                        $ext = pathinfo($location . $fname, PATHINFO_EXTENSION);
                        move_uploaded_file($temp, $location . $newName);

                        $inserting = $this->travelmodel->addimageUpload($fname, $newName, $ext, $mimeType, $pushRecords);
                        
                      //  $i++;
                   // }
                  }
                
              /////////////////////////////// END OF THIS PORTION UPLOADS FILES /////////////////////////////////////// 
                  
                   $sessionEmail = $_SESSION['email'];
                  
                   
                    //Email content
                    $message = "<p>DEAR $warefoffice,</p>";
                    $message .= "<p>Please find below request on travel start for your approval</p> ";
                    $message .= "<p> User Name: '".$sessionEmail."'</p> ";
                    $message .= "<p>Please click on the link below to treat the request as soon as possible. Thank You</p> ";
                    $message .= "<a href='https://c-iprocure.com/expensepro/travels/Dxk_udYz'> Click Here</a>";
                    $message .= "<hr/>This is an automatically generated email, please do not reply.";
                  
                     $config = array(
                                'mailtype' => "html"
                                
                          );
                    $this->email->initialize($config);
                    $this->email->from("info@c-ileasing.com", "TRAVEL START"); 
                    $this->email->to($warefoffice);
                    //$this->email->cc("seun.owolabi@c-ileasing.com");
                    $this->email->bcc("victor.ogiogio@c-ileasing.com");
                    $this->email->subject('TBS TRAVEL START REQUEST'); 
                    $this->email->message($message); 
                    $this->email->send();
                     
                    if($this->email->send()){
                    $data = ['status' => 3, 'msg' => "<center><div class='cont-success center'><i style='font-size:80px; color:green' class='fa fa-smile-o success-icon'></i><p class='congrats'>Thank You!</p><p class='congratsTxt'>Your request has been successfully sent, We Will get back to you as soon as we verify your records.</p><div><a href='".base_url()."/travels/xdmds_xn' class='btn btn-large main-bg'>Go Back</a></div></div></center>"];
                    }else{
                    $data = ['status' => 3, 'msg' => "<center><div class='cont-success center'><i style='font-size:80px; color:green' class='fa fa-smile-o success-icon'></i><p class='congrats'>Thank You!</p><p class='congratsTxt'>Your request has been successful sent! Email Not Sent</p><div><a href='".base_url()."/travels/xdmds_xn' class='btn btn-large main-bg'>Go Back</a></div></div></center>"];
                    }
                
                   /////////////////********************/PHP MAILER ******************////////////////////////////
                
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    /*     * ********************************** ADDING NEW PERDIEM ***************************************** */

    public function postnewperdiem() {
        $data = [];
        //get data from post
        $pLocation = $this->input->post('pLocation', TRUE);
        $sClass = $this->input->post('sClass', TRUE);
        $perdiemAmount = $this->input->post('perdiemAmount', TRUE);
        $sCurrency = $this->input->post('sCurrency', TRUE);
        $adddby = $this->session->email;
        if ($pLocation && $perdiemAmount && $perdiemAmount) {

            //insert todo into db
            //model header: perdiem(add perdiem). return last insert id or false
            $sLocation = $this->mainlocation->getdLocation($pLocation);
            $insertedperDiem = $this->travelmodel->addperdiem($pLocation, $perdiemAmount, $sClass, $sCurrency, $adddby);

            if ($insertedperDiem) {
                $data = ['status' => 1, 'msg' => "Perdeim successfully added", 'tid' => $insertedperDiem, 'tlocation' => $sLocation, 'tclass' => $sClass, 'tamount' => $perdiemAmount, 'tcurr' => $sCurrency];
            } else {
                $data = ['status' => 0, 'msg' => "Internal Server Error! Please try again"];
            }
        }

        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function getperdiems() {
        $getPerDiem = $this->travelmodel->getallperdiems(); //get list of items by user

        if ($getPerDiem == FALSE) {
            $data = [];
        } else {
            foreach ($getPerDiem as $get) {
                $id = $get->pid;
                $pLocation = $this->mainlocation->getdLocation($get->pLocation);
                $pSalaryClass = $get->pSalaryClass;
                $pAmount = $get->pAmount;
                $pCurrency = $get->pCurrency;

                $data[] = ['tid' => $id, 'plocale' => $pLocation, 'pClass' => $pSalaryClass, 'pAmount' => $pAmount, 'pCurr' => $pCurrency];
            }
        }

        $json = ['perdiems' => $data];

        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    public function dHtel_dKsv() {

        $data = [];
        //get data from post
        $hLocation = $this->input->post('hLocation', TRUE);
        $hAmount = $this->input->post('hAmount', TRUE);
         $hotelCost = $this->input->post('hotelCost', TRUE);
        $haddress = $this->input->post('haddress', TRUE);
        $cPerson = $this->input->post('cPerson', TRUE);
        $hName = $this->input->post('hName', TRUE);
        $hotelEmail = $this->input->post('hotelEmail', TRUE);
        $adddby = $this->session->email;
        if ($hLocation && $hAmount && $haddress && $cPerson && $hName) {

            //insert todo into db
            $insertedperDiem = $this->travelmodel->addHotel($hotelEmail, $hName, $hLocation, $hotelCost, $hAmount, $haddress, $cPerson, $adddby);

            if ($insertedperDiem) {
                $data = ['status' => 1, 'msg' => "Hotel Successfully Addded"];
            } else {
                $data = ['status' => 0, 'msg' => "Internal Server Error! Please try again"];
            }
        } else {
            $data = ['status' => 2, 'msg' => "Please fill all fields"];
        }

        //set final output
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function getallrequestforflightbus() {

        if (!$this->input->is_ajax_request()) {
            $this->load->view('noaccesstoview');
            return;
        }


        $getflightrequest = $this->travelmodel->flightrequest(); //get list of items by user

        if ($getflightrequest == FALSE) {
            $data = [];
        } else {
            foreach ($getflightrequest as $get) {
                $id = $get->id;
                $csrf = $get->csrf;
                $csrvalid = $get->csrvalid;
                $staffID = $get->staffID;
                $staffName = $get->staffName;
                $staffEmail = $get->staffEmail;
                $location = $get->location;
                $unit = $get->unit;
                $warefare = $get->warefofficer; // foriegn or local
                $status = $get->approval;


                $data[] = ['tid' => $id, 'tcsr' => $csrf, 'tvalid' => $csrvalid, 'sID' => $staffID, 'sN' => $staffName, 'sE' => $staffEmail, 'sL' => $location
                    , 'sU' => $unit, 'sWa' => $warefare, 'status' => $status];
            }
        }

        $json = ['allflight' => $data];

        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    public function getdetailsfordetails($tcrs, $id) {

        //Check if it exist in the database
        $getresult = $this->travelmodel->mychecktraveldetails($tcrs, $id);
        if ($getresult) {
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $getTravelAccess = $this->users->getUsertravelstartaccess();
            $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
            if ($getApprovalLevel == 6 || $whichAcess == TRUE) {
                $title = "Expense Pro :: ADD PER DIEM";
                $returnResult = $this->travelmodel->getmoredetails($getresult);
                $getCurrencies = $this->generalmd->getdresultfromprocure("*", "currencies", "", "");
                
                $attahcment = $this->generalmd->getuserAssetLocation("origName", "travestart_uploads", "travelID", $id);
                  
                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title, 'getCurrencies'=>$getCurrencies, 'attahcment' =>$attahcment,  'returnResult' => $returnResult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
                $this->load->view('travelstart/traveldetails', $values);
            } else {
                echo "You do not have access to this page. Please see IT";
            }
        } else {
            $this->load->view("noaccesstoview");
        }
    }

    public function processfights($sumboth) {
        $data = [];
        $travelID = $this->input->post('travelID', TRUE);
        $mainID = $this->input->post('mainID', TRUE);
        //$amountLocal = $this->input->post('amountLocal', TRUE);
        //$addHotel = $this->input->post('addHotel', TRUE);
        $paymentType = $this->input->post('paymentType', TRUE);
        $dcashier = $this->input->post('dcashier', TRUE);
        $dCurrencyType = $this->input->post('dCurrencyType', TRUE);
        $daccountant = $this->input->post('daccountant', TRUE);
        $hodEmail = $this->input->post('hodEmail', TRUE);
        $addComment = $this->input->post('addComment', TRUE);
        $ePrepared = $this->input->post('ePrepared', TRUE);
        $processdFlightright = $this->input->post('processdFlight[]', TRUE);
       
       
        $addHertz = $this->input->post('addHertz', TRUE);
        
        //Get Staff Email
        $staffEmail = $this->travelmodel->flightStaffName($mainID);

        $location = $this->input->post('location', TRUE);
        if ($location == 'LAG') {
            $newLocale = '1';
        } else if ($location == 'PHC') {
            $newLocale = '2';
        } else if ($location == 'CRO') {
            $newLocale = '3';
        } else if ($location == 'Abj') {
            $newLocale = '5';
        } else if ($location == 'BE') {
            $newLocale = '6';
        } else if ($location == 'ENU') {
            $newLocale = '8';
        } else {
            $newLocale = '7';
        }
        
        $unit = $this->input->post('unit', TRUE);
        $getUserUnit = $this->generalmd->getuserAssetLocation("id", "cash_unit", "getaloc", $unit);
       /* if ($unit == "IFTE") {
            $newUnit = '1';
        } else if ($unit == "ICUD") {
            $newUnit = '7';
        } else if ($unit == "ADMD") {
            $newUnit = '8';
        } else if ($unit == "MARINE") {
            $newUnit = '10';
        } else if ($unit == "MAINTEN") {
            $newUnit = '13';
        } else if ($unit == "FINC") {
            $newUnit = '2';
        } else if ($unit == "OUTS") {
            $newUnit = '12';
        } else if ($unit == "CIMOTORS") {
            $newUnit = '4';
        } else if ($unit == "HERTZ") {
            $newUnit = '6';
        } else if ($unit == "HRMD") {
            $newUnit = '5';
        } else if ($unit == "PROCURE") {
            $newUnit = '9';
        } else if ($unit == "MDOF") {
            $newUnit = '3';
        } else if ($unit == "HSE") {
            $newUnit = '11';
        } else {
            $newUnit = '14';   //Leasafric  
        }
        */
        
        $eBank = $this->input->post('eBank', TRUE);
        $eAccount = $this->input->post('eAccount', TRUE);

        $sName = $this->input->post('sName', TRUE);
        $sEmail = $this->input->post('sEmail', TRUE);
        $ePrepared = $this->input->post('ePrepared', TRUE);

        $sessionEmail = $this->session->email;
        if ($travelID == "" || $mainID == "") {
            $data = ['status' => 0, 'msg' => "Important variable to process this page is missing"];
        } else if ($paymentType == "") {
            $data = ['status' => 1, 'msg' => "Please select payment type"];
        } else if ($paymentType == 1 && $dcashier == 'null') {
            $data = ['status' => 2, 'msg' => "Please choose a cashier for payment"];
        } else if ($paymentType == 2 && ($daccountant == 0 || $dCurrencyType == "")) {
            $data = ['status' => 3, 'msg' => "Please select account group and add currency"];
        } else {
            // 0 -- waiting approval  1-- approved and sent to HOD  2-- rejected
            // HOD and ICU approved = '3', Account Awaiting = '4' , Paid = '5'
            //$userGenCode = ""; 
            if ($paymentType == 1) {
                $userGenCode = rand(1, 10) . time();
            } else if ($paymentType == 2) {
                $userGenCode = "";
            }

            $descItem = "Travel Expense for -  " . $sName;
            $auditTrail = "Approval by " . $sessionEmail . "time -" . date('y-m-d H:i:s');
            $approval = '1';
            $dateCreated = date('y-m-d');
            $dComment = $addComment;
            //$sumboth
            $newRecords = $this->travelmodel->updatetypepayment($paymentType, $sumboth, $dcashier, $dCurrencyType, $daccountant, $approval, $sessionEmail, $dComment, $mainID);
            if ($newRecords) {
                $insertedFileId = $this->mainlocation->insertAdvanceRequest($dateCreated, $dCurrencyType, $userGenCode, $descItem, $sName, $getUserUnit, $paymentType, $dComment, $hodEmail, "1", $dcashier, $daccountant, $ePrepared, $approval, $newLocale, $sName, $sEmail);
                $auditnow = $this->travelmodel->travelsUpdateaudit($auditTrail, $mainID);

                $md5ID = md5($insertedFileId);

                $createdby = "Created by $ePrepared, for $sName and approved by warefare-officer $sessionEmail time: " . date('Y-m-d H:i:s');
                //Run MD5 ID
                $updatemdid = $this->mainlocation->updatemdfiveid($md5ID, $createdby, $insertedFileId);
                $thisUpdateTotalAmount = $this->mainlocation->updateTotalAmount($sumboth, $insertedFileId);
                $travel = 'travel';
                $thisUpdateTotalAmount = $this->travelmodel->updatetravelcolum($travel, $mainID, $insertedFileId);
            }
            $tid = $this->input->post('tid', TRUE);
            $sTotal = $this->input->post('sTotal', TRUE);
            $tFrom = $this->input->post('tFrom', TRUE);
            $exrDate = $this->input->post('exrDate', TRUE);
            $addHotel = $this->input->post('addHotel', TRUE);
            $amountLocal = $this->input->post('amountLocal', TRUE);
            $processdFlightrightChild = $this->input->post('processdFlight', TRUE);
           
            $tTo = $this->input->post('tTo', TRUE);
            
            $purpose = $this->input->post('purpose', TRUE);
            $exCode = "704031011";
            for ($i = 0; $i < count($tid); $i++) { 
                $travel_ID = $tid[$i];
                $amount_Local = $amountLocal[$i];
                $add_Hotel = $addHotel[$i];
                $s_Total = $sTotal[$i];
                $s_Purpose = $purpose[$i];
                $s_To = $tTo[$i];
                $s_From = $tFrom[$i];
                $ex_rDate = $exrDate[$i];
                $ex_Hertz = $addHertz[$i];
                $ex_ProcessFlight = $processdFlightrightChild[$i];

                $ex_Detailofpayment = $s_From . " - " . $s_To . "-" . $s_Purpose;

                $totalAmount = $amount_Local + $s_Total;

                $query = $this->travelmodel->pushtravelUpdate($travel_ID, $amount_Local, $add_Hotel, $ex_Hertz, $ex_ProcessFlight, $sessionEmail);

                //if($query){
                $addtoExpense = $this->travelmodel->addtoExpensedetails($insertedFileId, $totalAmount, $ex_Detailofpayment, $exCode, $ex_rDate);
                    
                  /* if($ex_Hertz == 'yes'){
                      
                        $messageicu = "<p>Kindly Provide Transport Arrangement for $staffEmail for the follwing location(s) </p>";
                        $messageicu .= " $ex_Detailofpayment <br/>";
                        $messageicu .= "<hr/>";

                        $messageicu .= "<br/>&copy; C & I Leasing PLC, 2018";

                        $config = array(
                            'mailtype' => "html",
                        );

                        $this->email->initialize($config);
                        $this->email->from("expensepro@c-iprocure.com", 'TBS EXPENSE PRO:: TRAVEL START');
                        $this->email->to("onabiyi.olumide@c-ileasing.com, precious.awanye@c-ileasing.com, victor.ogiogio@c-ileasing.com");
                        $this->email->subject('ARRANGE HERTZ VEHICLE');
                        $this->email->message($messageicu);
                        $this->email->send();
                    }
                   
                   */
                   
                   
              }
          
                $sessionEmail = $_SESSION['email'];
                
            //Send a mail as maybe neccessary
                  $mail = "";
                  $getmyownResult = $this->travelmodel->gettravelexpenses($mainID);
                  $messageuser = "Dear $staffEmail";
                  $messageuser .= "<p>Your request has been treated by $sessionEmail and Sent to Your Head of Department<br/> with the following details: Kindly process flight information </p>";
                  $messageuser .= "<table border='1' cellpadding='5' style='width:700px;'><tr><td>From</td><td>To</td><td>Start Date</td><td>End Date</td><td>Diff</td><td>Logistics</td><td>Amount</td><td>Transport</td><td>Hotel</td></tr>";
                  $getHOD = $this->generalmd->getuserAssetLocation("hodEmail", "travelstart", "id", $mainID);
                  if ($processdFlightright[0] == "yes" || $processdFlightright[1] == "yes" ) {
                        //Use the $travel_ID to return a forloop of the result
                       
                       
                        foreach ($getmyownResult as $dotnet) {
                            $tFrom = $this->mainlocation->getdLocation($dotnet->tFrom);
                            $tTo = $this->mainlocation->getdLocation($dotnet->tTo);
                            $exsDate = $dotnet->exsDate;
                            $exrDate = $dotnet->exrDate;
                            $diff = $dotnet->diff;
                            $logistics = $dotnet->logistics;
                            $Amount = $dotnet->amount;
                            $sTotal = $dotnet->sTotal;
                            $amountLocal = $dotnet->amountLocal;
                            $hotelID = @$this->travelmodel->dHotelname($dotnet->hotelID);

                            $messageuser .= "<tr><td>$tFrom</td><td>$tTo</td><td>$exsDate</td><td>$exrDate</td><td>$diff</td><td>$logistics</td><td>$sTotal</td><td>$amountLocal</td><td>$hotelID</td></tr>";
                        }
                        $messageuser .= "</table>";
                       
                        $messageuser .= "<br/><hr/>This is an automated email please do not reply<p><br/>";
                        //$messageuser .= $mySoldiers;
                        
                        
                        $fromEmail = "expensepro@c-iprocure.com";
                
                        $config = array(
                            'mailtype' => "html",
                        );

                        $this->email->initialize($config);
                        $this->email->from($fromEmail, 'TBS EXPENSE PRO:: NEW TRAVEL START REQUEST'); 
                        //$this->email->to("ho.frontdesk@c-ileasing.com");
                         $this->email->to("oluchi.okonkwo@c-ileasing.com");
                        $this->email->cc("uche.nwachukwu@c-ileasing.com, funminiyi.akinlosotu@c-ileasing.com");
                        $this->email->bcc("victor.ogiogio@c-ileasing.com", "$getHOD");
                        $this->email->subject('TBS TRAVEL START REQUEST'); 
                        $this->email->message($messageuser); 
                        $mail = $this->email->send();
                    
                   
                     }
                     
                   
                     if($mail){
                        $data = ['status' => 5, 'msg' => 'Request Successfully Sent, Please wait you will be redirected'];   
                     }else{
                        $data = ['status' => 1, 'msg' => 'Request Successfully Approved. However, we did not sent a mail to flight officer. Did you check the flight request? Please wait while we reload...<br/>']; 
                     }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    
   
    
    
    public function recal_perxd90_4kdd_smskk4500sds_($tcrs, $id) {

        //Check if it exist in the database
        $getresult = $this->travelmodel->mychecktraveldetails($tcrs, $id);
        if ($getresult) {
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $getTravelAccess = $this->users->getUsertravelstartaccess();
            $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
            if ($getApprovalLevel == 6 || $whichAcess == TRUE) {
                $title = "Expense Pro :: ADD PER DIEM";
                $returnResult = $this->travelmodel->getmoredetails($getresult);

                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title, 'returnResult' => $returnResult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
                $this->load->view('travelstart/traveldetails_perdiem', $values);
            } else {
                echo "You do not have access to this page. Please see IT";
            }
        } else {
            $this->load->view("noaccesstoview");
        }
    }

    ////////////////**************** RE-CALCULATING PERDIEM *******************************////////////////////////


    public function processfightsperdiemreXXXXXXXXX_xxxxxxxxxx0000($total) {
        $data = [];
        $travelID = $this->input->post('travelID', TRUE);
        $mainID = $this->input->post('mainID', TRUE);

        $sessionEmail = $this->session->email;
        if ($travelID == "" || $mainID == "") {
            $data = ['status' => 0, 'msg' => "Important variable to process this page is missing"];
        } else {

            $auditTrail = "<hr/>Perdiem Change By " . $sessionEmail . "time -" . date('y-m-d H:i:s') . "<br/>Total Perdiem Amount:  $total";
            $auditnow = $this->travelmodel->travelsUpdateaudit($auditTrail, $mainID);

            $tid = $this->input->post('tid', TRUE);
            $dAmount = $this->input->post('amount', TRUE);
            $diff = $this->input->post('diff', TRUE);

            for ($i = 0; $i < count($tid); $i++) {
                $travel_ID = $tid[$i];
                $d_Amount = $dAmount[$i];
                $d_diff = $diff[$i];

                $totalAmount = $d_Amount * $d_diff;

                $query = $this->travelmodel->tryperdiemPush($travel_ID, $totalAmount, $d_Amount);
            }


            $data = ['status' => 1, 'msg' => 'Per diem Sccuessfully Changed, Please wait you will be redirected'];
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    ///////////////***************** END OF RE-CALCULATING PERDIEM ***********************/////////////////////////


    public function getunitdetails($unit, $start, $end, $dex) {

        if ($unit == 'all' && $start != "" && $end != "" && $dex != "") {
            echo "No information for that request type";
        } else {

            // the the above information to return the result that makes up the result
            $getFulldetails = $this->travelmodel->getunitinfoassearched($unit, $start, $end, $dex);
            //var_dump($getFulldetails);

            $title = "TBS: Travel Logistics - Expense Pro";
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'dRequest' => $getFulldetails, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('getallbyunit', $values);
        }
    }

    public function reimbursementrequest() {
        $data = [];
        if (isset($_POST['mainID']) && isset($_POST['tid']) && isset($_POST['amountSpent']) && isset($_POST['sumall'])) {

            $sessionEmail = $_SESSION['email'];
            // Declaring put putting all variables in Values
            $mainID = $this->input->post('mainID', TRUE);
            $tid = $this->input->post('tid', TRUE);
            $retiredAmount = $this->input->post('sumall', TRUE);
            $daccountant = $this->input->post('daccountant', TRUE);
            $myhodallowed = $this->input->post('myhodallowed', TRUE);
            
            //Use the ID to return the amount
            $getAmount = $this->travelmodel->getTravelAmount($mainID);

            $Dbalance = $getAmount - $retiredAmount;
            
            $auditTrail = "<hr/>Retired By " . $sessionEmail . "time -" . date('y-m-d H:i:s') . "<hr/>Total Amount <br/>Total Amount $getAmount <br/> Retired Amount:  $retiredAmount" . "<br/>Balance:  $Dbalance";
            /* 
                reimbursement 
                * 1 - pending retirement
                * 2 - check with HOD - There is a Balance -- send it to the HOD
                * 3 - Check with ICU - No Balance carry it with the hod
                * 5 - Check with Account
                * 
            */
            
            if($retiredAmount > $getAmount){
                
                //Update cash_recievable_retirement [sum]
               $approvalStatus = 2; // There is a balance Check with HOD
               $updatesumAmount = $this->travelmodel->timetoreimburse($retiredAmount, $Dbalance, $auditTrail, $daccountant, $myhodallowed, $approvalStatus, $mainID);
                //Now update sReimbursement Table to 2 "pending Confirmation  100%Bus1ness
               $retirementintravelstart = 2;
              $updateTravelTable = $this->travelmodel->runtravemyupdate($retirementintravelstart, $mainID);
              //Send email to HOD for approval before it goes to ICU hod will turn sRemembursemtn to 3 
               /* $message = "<p> The travel request you approve for $sessionEmail has just be reimburse for approval however, the approval amount approved is less that the amount rembursed. See details below</p><br/>";
                $message .= "<p> Amount Approved  $getAmount </p>";
                $message .= "<p> Amount Retired  $retiredAmount </p>";
                $message .= "<p> Outstanding Balance  $Dbalance </p>";
                $message .= "<p>Kindly Login To Expense Pro to verify or approve the balance or ignore if you do not approve of the excess</p>";
                $message .= "<br/><p>< href='".base_url()."'recieveables>View</a>&nbsp;</p>";
                $message .= "<p>&copy; C&ILeasing PLC</p>";
                 
                 
                $fromEmail = "expensepro@c-iprocure.com";
                
                $config = array(
                    'mailtype' => "html",
                );
                
                $this->email->initialize($config);
                $this->email->from($fromEmail); 
                $this->email->to($myhodallowed);
                $this->email->bcc('victor.ogiogio@c-ileasing.com');
                $this->email->subject('TBS EXPENSE PRO:: REIMBURSEMENT REQUEST FROM "'.$sessionEmail.'"'); 
                $this->email->message($message); 
                $this->email->send();
                */
            }else if($retiredAmount <= $getAmount){
                $sendEmailtoHOD = $myhodallowed;
                //Update cash_recievable_retirement [sum]
                $approvalStatus = 3; // There is no balance Check with ICU
              $updatesumAmount = $this->travelmodel->timetoreimburse($retiredAmount, $Dbalance, $auditTrail, $daccountant, $myhodallowed, $approvalStatus, $mainID);
             //Now update sReimbursement Table to 2 "pending Confirmation  100%Bus1ness
            $retirementintravelstart = 3;
            $updateTravelTable = $this->travelmodel->runtravemyupdate($retirementintravelstart, $mainID);
            }else{
                $sendEmailtoHOD = $myhodallowed;
                //Update cash_recievable_retirement [sum]
                $approvalStatus = 3; // There is no balance Check with ICU
              $updatesumAmount = $this->travelmodel->timetoreimburse($retiredAmount, $Dbalance, $auditTrail, $daccountant, $myhodallowed, $approvalStatus, $mainID);
             //Now update sReimbursement Table to 2 "pending Confirmation  100%Bus1ness
            $retirementintravelstart = 3;
            $updateTravelTable = $this->travelmodel->runtravemyupdate($retirementintravelstart, $mainID); 
            }
            
           

            if ($updateTravelTable) {
                for ($i = 0; $i < count($_POST["tid"]); $i++) {
                    $tid = $_POST['tid'][$i];
                    $daysActual = $_POST['daysActual'][$i];
                    $amountSpent = $_POST['amountSpent'][$i];

                    // $transportLocal = $_POST['transportLocal'][$i];
                    $sumTotal = $_POST['sumTotal'][$i];

                    //$addingSum = $sumTotal + $transportLocal;
                    $newfillBalance = $sumTotal - $amountSpent;

                    $travelUpdate = $this->travelmodel->loopmodeltravel($daysActual, $amountSpent, $newfillBalance, $tid);
                }
            }

            /**             * ************************* BEGINNING OF UPLOAD HTML CODE ****************************************************** */
            if (isset($_FILES['fileUpload']['name'])) {
                $name = str_replace(' ', '', $_FILES['fileUpload']['name']);
                $name = preg_replace("([#%$></\ +])", "", $name);

                $origName = str_replace(' ', '', $_FILES['fileUpload']['name']);
                $origName = preg_replace("([#%$></\ +])", "", $origName);

                $directoryName = 'public/travels/' . $sessionEmail . '/';
                //Check if the directory already exists.
                if (!is_dir($directoryName)) {
                    //Directory does not exist, so lets create it.
                    mkdir($directoryName, 0777, true);
                }
                $i = 0;
                while ($i < count($name)) {
                    $mimeType = $_FILES['fileUpload']['type'][$i];
                    $temp = $_FILES['fileUpload']['tmp_name'][$i];
                    $fname = $name[$i];
                    $random = random_string('alnum', 10);
                    $savetime = date("mdy-Hms");
                    $newName = $random . $savetime . $origName[$i];

                    $ext = pathinfo($directoryName . $fname, PATHINFO_EXTENSION);
                    move_uploaded_file($temp, $directoryName . $newName);

                    $inserting = $this->travelmodel->addimageUpload($fname, $newName, $ext, $mimeType, $mainID);
                    $i++;
                }
            }


            /**             * ************************* END OF UPLOAD HTML CODE ****************************************************** */
            $data = ['status' => 1, 'msg' => 'Reimbursement was successful but pending confirmation.'];
        } else {
            $data = ['status' => 0, 'msg' => 'All fields are compulsory'];
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function processAirticket() {

        if (isset($_POST['flightAgency']) && isset($_POST['flightName']) && isset($_POST['flightDetails']) && isset($_POST['flightAmount'])) {

            $flightAgency = $this->input->post('flightAgency', TRUE);
            $flightName = $this->input->post('flightName', TRUE);
            $flightAmount = $this->input->post('flightAmount', TRUE);
            $flightDetails = $this->input->post('flightDetails', TRUE);
            $flightID = $this->input->post('flightID', TRUE);
            $travelID = $this->input->post('travelID', TRUE);
            $hodtoaprove = $this->input->post('hodtoaprove', TRUE);
            $addedby = $_SESSION['email'];
            
            //First Use the addedby to check who first added it
             //$getFlightaddebyEmail = $this->travelmodel->whoaddsflight($flightID);
             $getFlightaddebyEmail = $this->generalmd->getuserAssetLocation("flightprocessBy", "travelstart_expense", "tid", $flightID);
            if($getFlightaddebyEmail != ""){
              $data = ['status' => 5, 'msg' => 'You cannot update this flight request, it has been treat by "'.$getFlightaddebyEmail.'" please contact for clarification'];  
              
            }else {
            
            //Insert Flight Details 
            //$addFlightRequest = $this->travelmodel->addFlightdetails($flightAmount, $flightName, $flightDetails, $flightID, $addedby);
            $datarray = [];
            $datarray['dateCreated'] = date('Y-m-d H:i:s');
            $datarray['request_ID'] = $travelID;
           
            $datarray['flightID'] = $flightID;
            $datarray['travel_agency'] = $flightAgency;
            $datarray['flightName'] = $flightName;
            $datarray['flight_Amount'] = $flightAmount;
            $datarray['flight_Details'] = $flightDetails;
            $datarray['Status'] = "sent";
            $datarray['designation'] = "staff";
            $datarray['addedBy'] = $addedby;
            
            $traveID = is_numeric($this->generalmd->getsinglecolumn("travelStart_ID", "travelstart_expense", "travelStart_ID", $travelID)) ?
                    $this->generalmd->getsinglecolumn("unit", "travelstart", "id", $this->generalmd->getsinglecolumn("travelStart_ID", "travelstart_expense", "travelStart_ID", $travelID)) : "Not Applicable";
               
           $datarray['dUnit'] = $traveID;       
                    
            
             $options = array(
			'table' => 'flight_request',
			'data'  => $datarray
		   );

             $insertedFileId = $this->generalmd->create( $options );
                           
                           
            $this->generalmd->updateTableCol("travelstart_expense", "flightprocessBy", $addedby, "tid", $flightID);
            $this->generalmd->updateTableCol("travelstart_expense", "sentTohod", $hodtoaprove, "tid", $flightID);
            $this->generalmd->updateTableCol("travelstart_expense", "agency", $flightAgency, "tid", $flightID);
            
            //ADD FILGHT DETAILS FOR FOLDERS
            /**             * ************************* BEGINNING OF UPLOAD HTML CODE ****************************************************** */
            if (isset($_FILES['myAttachment']['name'])) {
                $name = str_replace(' ', '', $_FILES['myAttachment']['name']);
                $name = preg_replace("([#%$></\ +])", "", $name);

                $origName = str_replace(' ', '', $_FILES['myAttachment']['name']);
                $origName = preg_replace("([#%$></\ +])", "", $origName);

                $directoryName = 'public/travels/flights/';
                //Check if the directory already exists.
                if (!is_dir($directoryName)) {
                    //Directory does not exist, so lets create it.
                    mkdir($directoryName, 0777, true);
                }
                $i = 0;
                while ($i < count($name)){
                    $mimeType = $_FILES['myAttachment']['type'][$i];
                    $temp = $_FILES['myAttachment']['tmp_name'][$i];
                    $fname = $name[$i];
                    $random = random_string('alnum', 10);
                    $savetime = date("mdy-Hms");
                    $newName = $random . $savetime . $origName[$i];

                    $ext = pathinfo($directoryName . $fname, PATHINFO_EXTENSION);
                    move_uploaded_file($temp, $directoryName . $newName);

                    $inserting = $this->travelmodel->addflightattachement($fname, $newName, $ext, $mimeType, $flightID, $travelID);
                    $i++;
                }
            }

            /**************************** END OF UPLOAD HTML CODE ****************************************************** */
            //Get Staff Name
            $rname = $this->travelmodel->flightStaffemail($travelID);
            $semail = $_SESSION['email'];
            $remail = $this->travelmodel->flightStaffName($travelID);
            $subject = "<b<FLIGHT DETAILS FOR $flightName</b>";
            
            $replyToEmail = $semail;
            $sname = $this->adminmodel->getUsername($semail);
            $files = base_url() . $directoryName . $newName;
            
            $message = "<p>Congratulations, Please find below your flight details for TBS TRAVEL START</p>";
            $message .= "<div>You can click on the link below or attached file to see details</div>";
            $message .= "<div>If you do not see the attachment you can login to travel start and download the attachment for that particular trip</div>";
            $message .= $flightDetails;
             $message .= "Attachment Link: $files";
            $message .= "<br/><hr/>This is an automated email please do not reply<p><br/>";
                     
            //Send a mail to the person 
            $sendMail = $this->gen->sendEmail($sname, 'info@c-iprocure.com', $rname = "", $remail, $subject, $message, $replyToEmail = "", $files = "");

            $data = ['status' => 1, 'msg' => 'Flight Details Successfully Added'];
            }
        } else {
            $data = ['status' => 0, 'msg' => 'please make sure all fields are fields'];
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function flightdetailsauthority($id) {
        $json = [];
        $getFlightDetails = $this->travelmodel->gettravelexpenses($id);

        if ($getFlightDetails) {
            foreach ($getFlightDetails as $get) {
                $id = $get->tid;
                $travelStart_ID = $get->travelStart_ID;
                $tFrom = $get->tFrom;
                $tTo = $get->tTo;
                $amount = $get->amount;
                $diff = $get->diff;
                $sTotal = $get->sTotal;
                $amountLocal = $get->amountLocal;
                $exCode = $get->exCode;
                $exsDate = $get->exsDate;
                $exrDate = $get->exrDate;
                $logistics = $get->logistics;
                $purpose = $get->purpose;
                $hotelID = $get->hotelID;
                $approval = $get->approval;
                $hotel_payment = $get->hotel_payment;
                $days_Spent = $get->days_Spent;
                $amountSpent = $get->amountSpent;
                $balance = $get->balance;

                $data[] = ['id' => $id, 'trID' => $travelStart_ID, 'from' => $this->mainlocation->getdLocation($tFrom), 'to' => $this->mainlocation->getdLocation($tTo), 'amount' => $amount,
                    'diff' => $diff, 'sT' => $sTotal, 'amLocal' => $amountLocal, 'code' => $exCode, 'sDate' => $exsDate,
                    'eDate' => $exrDate, 'log' => $logistics, 'purpose' => $purpose, 'hID' => $hotelID, 'appr' => $approval,
                    'hPay' => $hotel_payment, 'daySpent' => $days_Spent, 'amtSpent' => $amountSpent, 'balance' => $balance];
            }
            $json['fL'] = $data;
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    
    
    
    public function createbatchrequest() {

        $sessionEmail = $_SESSION['email'];
        $sessionID = $this->adminmodel->getuserID($sessionEmail);
        $myurl = mycustom_url();

        $batchstatus = 'batched';
        if (isset($_POST['lang'])) {

            $lang = $this->input->post('lang');
             $lang = implode(",", $lang);
            
            //$requestIDlang = explode(",", $lang);
            
            
            
                $getResult = $this->travelmodel->groupbatchamount($lang);
                if($getResult){
                    foreach($getResult as $get){
                        $getallids =  $get->dIds;
                        $totalAmount =  $get->TOTAL;
                        $dAgency = $get->travel_agency;
                    }
                
                //random_string('alnum', 16); Generators 
                //alpha:  A string with lower and uppercase letters only.
                //alnum:  Alpha-numeric string with lower and uppercase characters.
                //numeric:  Numeric string.
                //nozero:  Numeric string with no zeros.
                //unique:  Encrypted with MD5 and uniqid(). Note: The length parameter is not available for this type. Returns a fixed length 32 character string.
                //sha1:  An encrypted random number based on do_hash() from the security helper.
                //echo $totalAmount;
                $batchCode = random_string('nozero', 8);
                $batchTitle = date('Y-m-d'). " Flight Expense Batch -". random_string('nozero', 8);
                //Insert into Batch REquest Table
                $BatchdRequest = $this->travelmodel->mybatchedRequest($dAgency, $totalAmount, $batchCode, $sessionEmail, $lang, $batchTitle);
                $update = "batched";
                $updatebatch = $this->travelmodel->updatemybatch($update, $lang);
           
                }
                
               $data = ['status'=>1, 'msg'=>'Flight Request Succesfully batched'];
             
        } // End of  if(isset($_POST['lang'])){
        else{
          $data = ['status'=>0, 'msg'=>'Please select a Checkbox'];  
        }
           $this->output->set_content_type('application/json')->set_output(json_encode($data));
    } // end of createbatchrequest
    
    
   
    public function processexpensebatch(){
        
        $json = [];
        if(isset($_POST['batchedId'])){
            $batchedId = $this->input->post('batchedId', TRUE);
            $batchtitle = $this->input->post('batchtitle', TRUE);
            $batchCode = $this->input->post('batchCode', TRUE);
            $batchedAmount = $this->input->post('batchedAmount', TRUE);
            $batchedDate = $this->input->post('batchedDate', TRUE);
            $dhod = $this->input->post('dhod', TRUE); 
            $daccountant = $this->input->post('daccountant', TRUE); 
            $vendor = $this->input->post('vendor', TRUE); 
            $dCurrencyType = $this->input->post('dCurrencyType', TRUE); 
            $expenseCode = $this->input->post('expenseCode', TRUE); 
            $comment = $this->input->post('comment', TRUE);
            $sumID = $this->input->post('sumID', TRUE);
            
            $doexplode = $this->input->post('doexplode', TRUE);
            $getHotelName = $this->input->post('getHotelName', TRUE);
            
            
            $sessionEmail = $_SESSION['email'];
            $dUnit = $this->users->getUnit($sessionEmail);
            $uLocation = $this->users->getLocationEmail($sessionEmail);
            $fullname = $this->adminmodel->getUsername($sessionEmail);
            
            //convert do explode to an array
            $getFirst = explode(",", $doexplode);
            $getFirstResultHOD = $this->generalmd->getuserAssetLocation("hod", "travel_hotel_bookings", "hotel_id", $getFirst[0]);
            $dateApproved = $this->generalmd->getuserAssetLocation("dateApproved", "travel_hotel_bookings", "hotel_id", $getFirst[0]);
            
            $approvedBy = "<tr><td>Sent For Payment</td> <td>".$this->session->email."</td> <td>$batchedDate</td>  </tr>";
        
            $requestIDlang = explode(",", $doexplode);
            foreach($requestIDlang as $key => $value){
                 $dataID = $value;
                 $updateAuditTrail = $this->generalmd->updatedupdatetrail($approvedBy, $approvedBy, $dataID);
              }
          
            $datarray = [];
            $datarray['dateCreated'] = $batchedDate;
            $datarray['CurrencyType'] = $dCurrencyType;
            $datarray['ndescriptOfitem'] = $batchtitle;
            $datarray['benName'] = $vendor;
            $datarray['dUnit'] = $dUnit;
            $datarray['nPayment'] = "2";
            $datarray['requesterComment'] = $comment;
            $datarray['hod'] = $dhod;
            $datarray['hodwhoapprove'] = $getFirstResultHOD;
            $datarray['dateHODapprove'] = $dateApproved;
            $datarray['icus'] = "1";
            $datarray['dAccountgroup'] = $daccountant;
            $datarray['sessionID'] = $sessionEmail;
            $datarray['approvals'] = "2";
            $datarray['dLocation'] = $uLocation;
            $datarray['fullname'] = $fullname;
            $datarray['dateRegistered'] = date('Y-m-d H:i:s');
            $datarray['createdUserID'] = $_SESSION['id'];
            $datarray['company'] = "1";
            $datarray['md5_id'] = random_string('alnum', 50);
            $datarray['auditTrail'] =  $createdby = "Created by $fullname, time: ". date('Y-m-d H:i:s'). "Approved By $getFirstResultHOD";
            $datarray['dAmount'] = $batchedAmount; 
            $datarray['enumType'] = "hotel"; 
            $datarray['travelBatchCode'] = $batchCode; 
            $datarray['batchedID'] = $batchedId; 
            $datarray['from_app_id'] = "8"; 
            $datarray['apprequestID'] = $sumID;
            
            $datarray['hotelID'] = $doexplode;
            $datarray['hotelName'] = $getHotelName;
            
            $options = array(
                'table' => 'cash_newrequestdb',
                'data'  => $datarray
             );

            $insertedFileId = $this->generalmd->create( $options );
          
            //Now the Last Table expense details
            $exCode = "704031011";
            $addExpensedetails = $this->travelmodel->expensedetailstravles($comment, $batchedAmount, $expenseCode, $batchedDate, $insertedFileId);
            
            
            //Update the Batch table to read Sent
            $thisbatchupdatee = $this->travelmodel->updatebatchsent($batchedId);
            
            //////////////////////////////////MULITIPLE FILE UPLOAD APP///////////////////////////////////////////////////////////
                  if(isset($_FILES['upfile']['name'])){  
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

                      $inserting = $this->mainlocation->addnewfile($fname, $newName, $ext, $mimeType, $insertedFileId);
                      $i++;
                    }
                  } 
/////////////////////////////////END OF MULTIPLE FILE UPLOAD FILE ////////////////////////////////////////////////////

                  
            //Use the batch ID to return the typ
            $batchMeType = $this->travelmodel->batchmerequest($batchedId);
            
            $data = ['status'=>1, 'msg'=>'Request Successfully Sent', 'type'=>$batchMeType];
                    
        }else{
          $data = ['status'=>0, 'msg'=>'Please make sure all fields are filled'];    
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    
    
    /************************ HOTEL ARRANGMENT ******************************************/
    
    public function hotelauthoritydetails($id) {
        $json = [];
        $getFlightDetails = $this->travelmodel->getmytravelexpensebyhotel($id);

        if ($getFlightDetails) {
            foreach ($getFlightDetails as $get) {
                $tid = $get->tid; 
                $travelStart_ID = $get->travelStart_ID; 
                $tFrom = $get->tFrom;
                $tTo = $get->tTo;
                $amount = $get->amount;
                $diff = $get->diff;
                $sTotal = $get->sTotal;
                $amountLocal = $get->amountLocal;
                $exCode = $get->exCode;
                $exsDate = $get->exsDate;
                $exrDate = $get->exrDate;
                $logistics = $get->logistics;
                $purpose = $get->purpose;
                $hotelID = $get->hotelID;
                $approval = $get->approval;
                $hotel_payment = $get->hotel_payment;
                $days_Spent = $get->days_Spent;
                $amountSpent = $get->amountSpent;
                $balance = $get->balance;
                $processedBy = $get->processedBy;
                $title = " ".ucwords($this->travelmodel->flightStaffemail($travelStart_ID));
                
                 $hotelName = $this->travelmodel->dHotelname($hotelID);
                 
                $data[] = ['id' => $tid, 'title'=>$title, 'trID' => $travelStart_ID, 'from' => $this->mainlocation->getdLocation($tFrom), 'to' => $this->mainlocation->getdLocation($tTo), 'amount' => $amount,
                    'diff' => $diff, 'sT' => $sTotal, 'amLocal' => $amountLocal, 'code' => $exCode, 'sDate' => $exsDate,
                    'eDate' => $exrDate, 'log' => $logistics, 'purpose' => $purpose, 'hID' => $hotelName, 'appr' => $approval,
                    'hPay' => $hotel_payment, 'daySpent' => $days_Spent, 'amtSpent' => $amountSpent, 'balance' => $balance, 'processBy' => $processedBy];
            }
            $json['fL'] = $data;
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    /********************** END O HOTEL ARRANGEMENT ************************************/
    
        public function hotelbeingbatched() {

        $sessionEmail = $_SESSION['email'];
        $sessionID = $this->adminmodel->getuserID($sessionEmail);
        
        $newlang = "";
        $data = [];
        $batchstatus = 'batched';
        if (isset($_POST['dHotelpayment'])) {

            $lang = $this->input->post('dHotelpayment');
            $lang = implode(",", $lang);
            $sumlang = "";
            $sumTotal = "";
            
            $requestIDlang = explode(",", $lang);
            $doexplode = implode(',', $requestIDlang);
            //echo ($doexplode);
            //$getSum = $this->travelmodel->gettoalsum($doexplode);
            
            //Get the First Array
            $hotelType = $this->generalmd->getuserAssetLocation("hotel_type", "travel_hotel_bookings", "hotel_id", $requestIDlang[0]);
            
            $getHotelName =  $this->generalmd->getuserAssetLocation("HotelName", "travel_hotel", "id", $hotelType);
            
            $getSum = $this->travelmodel->getsumfromhotel($doexplode);
            
          //$batchCode = date('Y-m-d')."_". generateRandomCode(6, 20). "";
          $batchCode  = time(). "_" . generateRandomCode(3, 8);
          $batchTitle = "Hotel Expense_$getHotelName";
          //Insert into Batch REquest Table
          $type = 'hotel';
          $batchedDate = date('Y-m-d H:i:s');
          $BatchdRequest = $this->travelmodel->mybatchedHotel($getSum, $batchCode, $sessionEmail, $doexplode, $batchTitle, $type);
          $updateHotel = $this->travelmodel-> updatebatchhotel($doexplode, $batchCode, $batchedDate, $this->session->email);
           
         $sessemail = $_SESSION['email'];
        //Get the Unit the user belongs to
        $userUnit = $this->generalmd->getuserAssetLocation("dUnit", "cash_usersetup", "email", $sessemail);
               
        $getallaccounts = $this->generalmd->getaccountcodefromdb("unitaccountcode", "unit", $userUnit);
        
        $approvedBy = "<tr><td>Batched By</td> <td>".$this->session->email."</td> <td>$batchedDate</td>  </tr>";
        
        foreach($requestIDlang as $key => $value){
             $dataID = $value;
             $updateAuditTrail = $this->generalmd->updatedupdatetrail($approvedBy, $approvedBy, $dataID);
          }
                 
        
        if ($getallaccounts) {
            $allact = "";
            foreach ($getallaccounts as $get) {
                //$codeid = $get->codeid;
                $codeName = $get->codeName;
                $codeNumber = $get->codeNumber;
                $allact .= "<option  value='$codeNumber'> " . $codeName . ' - ' . $codeNumber . '</option>';
            }
            //return $allact;
        }
        $this->load->model('maintenance');
        $getallvendors =  $this->maintenance->fromaintenance("*", "maintenance_workshop", "unitID", $userUnit);
        $allVendors = "";
        if ($getallvendors) {
               
                foreach ($getallvendors as $get) {
                    $mainID = $get->id;
                    $wkName = $get->workshop_name;
                    $allVendors .= "<option  value='$mainID'>$wkName</option>";
                }
                //return $allact;
        }
        
         $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
         $title = "Hotel Batched Payment";
         $getResult = $this->travelmodel->getbatchresultbyid($BatchdRequest);
         $menu = $this->load->view('menu', '', TRUE);
         $sidebar = $this->load->view('sidebar', '', TRUE);
         $footer = $this->load->view('footer', '', TRUE);
         $values = ['title' => $title, 'getHotelName'=>$getHotelName, 'doexplode'=>$doexplode, 'getResult' => $getResult, 'myvendors'=>$allVendors, 'accountCode'=>$allact, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
         $this->load->view('travelstart/paytoexpensebyhotel', $values); 
        }else{
            echo "<script>alert('Please choose a check box')</script>";
        }
           
    } // end of createbatchrequest
    
    
    //***************************** END OF HOTEL BATCHED *******************************************//
    
    
    
     public function processhertztransport() {

        if (isset($_POST['transportID']) && isset($_POST['hertAmount'])) {

            $transportID = $this->input->post('transportID', TRUE);
            $hertAmount = $this->input->post('hertAmount', TRUE);
            //Insert Flight Details 
            $addFlightRequest = $this->travelmodel->addHertztrans($hertAmount, $transportID);

            /** * ************************* END OF UPLOAD HTML CODE ****************************************************** */
           
            $data = ['status' => 1, 'msg' => 'Transport Details Successfully Added'];
        } else {
            $data = ['status' => 0, 'msg' => 'please make sure all fields are fields'];
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    
    public function processcashconfirmation(){
          if (isset($_POST['dataid'])) {
            $dataID = $this->input->post('dataid', TRUE);
            
            //Use the ID to change the status to 1 which is confirmed
             $changestatusconfirmation = $this->travelmodel->oneidtostatus($dataID);
            //Use the ID to change the status to completed for the user
             $changeConfirmpending = $this->travelmodel->completeretirement($dataID);
            
            //Send back response
              $data = ['status' => 1, 'msg' => 'Successfully Confirmed'];
        }else{
          $data = ['status' => 0, 'msg' => 'General Error'];  
        }
         $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    
     public function verifyreimbursementforhod(){
         
          if (isset($_POST['rdataid'])) {
            $dataID = $this->input->post('rdataid', TRUE);
            $sessionID = $_SESSION['email'];
            //Use the ID to change the status to 1 which is confirmed
            
             //Use the id to return the blance if empty tell icu to wait before they verify
             $getbalance = $this->travelmodel->getretiredbalance($dataID);
             
             if($getbalance){
                 $approvals = "3";
                $changestatusconfirmation = $this->travelmodel->makehodverify($approvals, $sessionID, $dataID);
                $updatetravelStart = $this->travelmodel->updateresultfortravel($approvals, $dataID);
                
                $data = ['status' => 1, 'msg' => 'Successfully Confirmed']; 
             }else{
                 $data = ['status' => 2, 'msg' => 'You cannot verify an empty amount'];
             }
            //Send back response
              
        }else{
          $data = ['status' => 0, 'msg' => 'General Error'];  
        }
         $this->output->set_content_type('application/json')->set_output(json_encode($data));
     }
     
     
     
    
    
     public function verifypaymentbystaffwhocares(){
         
          if (isset($_POST['rdataid'])) {
            $dataID = $this->input->post('rdataid', TRUE);
            $sessionID = $_SESSION['email'];
            //Use the ID to change the status to 1 which is confirmed
            
             //Use the id to return the blance if empty tell icu to wait before they verify
             $getbalance = $this->travelmodel->getretiredbalance($dataID);
             if($getbalance){
                $changestatusconfirmation = $this->travelmodel->makeicuverifyfirsto($sessionID, $dataID);
                 $approvals = "4";
                 $updatetravelStart = $this->travelmodel->updateresultfortravel($approvals, $dataID);
                 
                $data = ['status' => 1, 'msg' => 'Successfully Confirmed']; 
             }else{
                 $data = ['status' => 2, 'msg' => 'You cannot verify an empty amount'];
             }
            //Send back response
              
        }else{
          $data = ['status' => 0, 'msg' => 'General Error'];  
        }
         $this->output->set_content_type('application/json')->set_output(json_encode($data));
     }
     
     public function processpaymentforexpensewhynow(){
         $data = [];
          if (isset($_POST['dcomment']) && isset($_POST['dRequestID']) && isset($_POST['mainID'])) {
                $dcomment = $this->input->post('dcomment', TRUE);
                
                $dRequestID = $this->input->post('dRequestID', TRUE);
                $mainID = $this->input->post('mainID', TRUE);
                $icuhaseen = $this->input->post('icuhaseen', TRUE);
                $dTitle = $this->input->post('dTitle', TRUE);
                $dDate = $this->input->post('dDate', TRUE);
                $dBeneficiary = $this->input->post('dBeneficiary', TRUE);
                $dEmail = $this->input->post('dEmail', TRUE);
                $dAmountPaid = $this->input->post('dAmountPaid', TRUE);
                $dRetiredAmount = $this->input->post('dRetiredAmount', TRUE);
                $dBalance = $this->input->post('dBalance', TRUE);
                $dVerified = $this->input->post('dVerified', TRUE);
                $location = $this->input->post('dLocation', TRUE);
                $unit = $this->input->post('dUnit', TRUE);
                $dCashier = $this->input->post('dCashier', TRUE);
                $daccountgroup = $this->input->post('daccountgroup', TRUE);
                $dCurrency = $this->input->post('dCurrency', TRUE);
                $dhod = $this->input->post('dhod', TRUE);
                $dICUwhoconfirmed = $this->input->post('dICUwhoconfirmed', TRUE);
                $myhodwhoapproves = $this->input->post('myhodwhoapproves', TRUE);
                
                
                if($dCashier != ""){
                    $paymentType = "1";
                    $daccountant = "0";
                    $dCashier = $this->input->post('dCashier', TRUE);
		    $userGenCode = generateRandomCode(1,10);
                }else{
                    $paymentType = "2";
                    $userGenCode = "";
                     $dCashier = "null";
                     $daccountant = $daccountgroup;
                }
                //Use the id to return if ICU has seen it or not
                 if ($location == 'LAG') {
                    $newLocale = '1';
                } else if ($location == 'PHC') {
                    $newLocale = '2';
                } else if ($location == 'CRO') {
                    $newLocale = '3';
                } else if ($location == 'Abj') {
                    $newLocale = '5';
                } else if ($location == 'BE') {
                    $newLocale = '6';
                } else if ($location == 'ENU') {
                    $newLocale = '8';
                } else {
                    $newLocale = '7';
                }
                
                if ($unit == "IFTE") {
                    $newUnit = '1';
                } else if ($unit == "ICUD") {
                    $newUnit = '7';
                } else if ($unit == "ADMD") {
                    $newUnit = '8';
                } else if ($unit == "MARINE") {
                    $newUnit = '10';
                } else if ($unit == "MAINTEN") {
                    $newUnit = '13';
                } else if ($unit == "FINC") {
                    $newUnit = '2';
                } else if ($unit == "OUTS") {
                    $newUnit = '12';
                } else if ($unit == "CIMOTORS") {
                    $newUnit = '4';
                } else if ($unit == "HERTZ") {
                    $newUnit = '6';
                } else if ($unit == "HRMD") {
                    $newUnit = '5';
                } else if ($unit == "PROCURE") {
                    $newUnit = '9';
                } else if ($unit == "MDOF") {
                    $newUnit = '3';
                } else if ($unit == "HSE") {
                    $newUnit = '11';
                } else {
                    $newUnit = '14';   //Leasafric  
                }
        
                $icuhaseen = $this->accountrecievable->withcashreimbursementdetails($mainID);
                if($icuhaseen !== 'yes'){
                    $data = ['status'=>1, 'msg'=>'Please Wait for ICU to Verify'];
                }else{
                  
                   $fullname = $this->adminmodel->getUsername($dEmail);
                   
                   $dhod = $this->accountrecievable->gethodusingID($dRequestID);
                  
                    //Insert into the Expense pro Table for Account to Pay
                   $insertedFileId = $this->travelmodel->insertToexpensepro($dDate, $dCurrency, $userGenCode, $dTitle, $dBeneficiary, $newUnit, $paymentType, $dcomment, $dhod, "1", $dCashier, $daccountant, $dEmail, "3", $newLocale, $fullname, $dEmail, $dICUwhoconfirmed, $myhodwhoapproves);
                     
                   $md5ID = md5($insertedFileId);
                   
                   $createdby = "Created by $fullname, time: ". date('Y-m-d H:i:s');
                   //Run MD5 ID
                   $updatemdid = $this->mainlocation->updatemdfiveid($md5ID, $createdby, $insertedFileId);
                    
                   if($insertedFileId){
                       $maindBalance = abs($dBalance);
                       $ex_Code = "704031011";
                      $add = $this->accounting->InsertExpenseUpdate($maindBalance, $dcomment, $ex_Code, $dDate, $insertedFileId); 
                      //Update the total amount record
                       $thisUpdateTotalAmount = $this->mainlocation->updateTotalAmount($maindBalance, $insertedFileId);
                       $travel = 'expense';
                       $thisUpdateTotalAmount = $this->travelmodel->updatetravelcolum($travel, $dRequestID, $insertedFileId);
                       $sessionEmail = $_SESSION['email'];
					   
			$addbyreimbursement = $this->travelmodel->addfromreimbursement('6', $mainID);
                        
                        //Change sReimbursement to 6 so as to change the status
                        $changeintravelstart = $this->travelmodel->changesreimbursement('6', $dRequestID);
                        
			$addbible = $this->travelmodel->adforthenew('reimbursement', $insertedFileId);
			//Insert into cash_recievable_breakdown
			$thisbreakdown = $this->travelmodel->addrecievabledetails($dRequestID, $dcomment, $maindBalance, $sessionEmail, $insertedFileId);
                    }
                    
                   if(!empty($insertedFileId)){
			$sesionID = $_SESSION['email'];
			$message = "<div>Dear $dEmail, </div><br/>";
                        $message .= "<div>Your reimbursement balance of $maindBalance has been approved Please see $sesionID for further collection";
                        $message .= "<div>Title: $dTitle</div><br/>";
                        
                        $message .= "<br/><hr/>This is an automated email please do not reply<p><br/>";
                        $config = array(
                                'mailtype' => "html"
                                
                          );

                        $this->email->initialize($config);
                        $this->email->from("info@c-iprocure.com", "TBS-EXPENSE TRAVEL START"); 
                        $this->email->to($dEmail);
                        $this->email->subject('YOUR REIMBURSEMENT BALANCE HAS BEEN MARKED FOR PAYMENT'); 
                        $this->email->message($message); 
                        $this->email->send();
                      
                      } 
                     $data = ['status'=>2, 'msg'=>'Successfully Sent'];
                }
          }else{
              $data = ['status'=>0, 'msg'=>'please make sure all fields are filled'];
          }
          
           $this->output->set_content_type('application/json')->set_output(json_encode($data));
     }
     
     
     
     public function notapplicablerequest($mID) {
        $data = [];
        $SessionEmail = $_SESSION['email'];
        if ($mID == "") {
            $data = ["msg" => "Important Variable to process page is missing"];
        } else {
            //Use main ID to update request
            $rejectedBy = $this->session->email. ' Date: '. date('Y-m-d H:i:s');
            $this->generalmd->updateTableCol("travelstart_expense", "processFlight", "select", "tid", $mID);
            $this->generalmd->updateTableCol("travelstart_expense", "rejectedBy", $rejectedBy, "tid", $mID);
            
            $sessionEmail = $this->session->email. " ". date("Y-m-d H:i:s");
            //Use the MID to update the flight Table  not-applicable'
            $this->generalmd->updateTableCol("flight_request", "Status", "not-applicable", "flightID", $mID);
            $this->generalmd->updateTableCol("flight_request", "deleted", "yes", "flightID", $mID);
            $this->generalmd->updateTableCol("flight_request", "deletedBy", $sessionEmail, "flightID", $mID);
            
             $data = ["msg" => "Successfully Rejected"];
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    
     public function approveflight($mID) {
        $data = [];
        $SessionEmail = $_SESSION['email'];
        $getifexist = $this->generalmd->getuserAssetLocation("hodwhoapprove", "travelstart_expense", "tid", $mID) ;
        if ($mID == "") {
            $data = ["msg" => "Important Variable to process page is missing"];
        } else if($getifexist != ""){
             $data = ["msg" => "This Transaction has been approved previously, You cannot approve again"];
        }else {
            //Use main ID to update request
            $this->generalmd->updateTableCol("travelstart_expense", "hodwhoapprove", $this->session->email, "tid", $mID);
            $this->generalmd->updateTableCol("travelstart_expense", "hodtime", date('Y-m-d H:i:s'), "tid", $mID);
             $data = ["msg" => "Successfully Approved"];
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    public function verifyflight($mID) {
        $data = [];
        $SessionEmail = $_SESSION['email'];
        $getifexist = $this->generalmd->getuserAssetLocation("icuwhoapprove", "travelstart_expense", "tid", $mID) ;
        if ($mID == "") {
            $data = ["msg" => "Important Variable to process page is missing"];
        } else if($getifexist != ""){
             $data = ["msg" => "This Transaction has been verified previously, You cannot approve again"];
        }else {
            //Use main ID to update request
            $this->generalmd->updateTableCol("travelstart_expense", "icuwhoapprove", $this->session->email, "tid", $mID);
            $this->generalmd->updateTableCol("travelstart_expense", "icutime", date('Y-m-d H:i:s'), "tid", $mID);
             $data = ["msg" => "Successfully Verified"];
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    
    
    
    
    public function processExternalTicket() {

        if (isset($_POST['flightAgency']) && isset($_POST['name']) && isset($_POST['flightName']) && isset($_POST['flightDetails']) && isset($_POST['flightAmount'])) {

            $flightAgency = $this->input->post('flightAgency', TRUE);
            $flightName = $this->input->post('flightName', TRUE);
            $flightAmount = $this->input->post('flightAmount', TRUE);
            $flightDetails = $this->input->post('flightDetails', TRUE);
            $hodtoaprove = $this->input->post('hodtoaprove', TRUE);
            $name = $this->input->post('name', TRUE);
            $addedby = $_SESSION['email'];
            
            
             if ($_POST["tTolocation"] && $_POST['tFromlocation']) {
                    for ($i = 0; $i < count($_POST["tTolocation"]); $i++) {
                        $tFromlocation = $_POST['tFromlocation'][$i];
                        $tTolocation = $_POST['tTolocation'][$i];
                        $exsDate = $_POST['exsDate'][$i];
                        $exrDate = $_POST['exrDate'][$i];
                        $purpose = $_POST['purpose'][$i];
                        
                        $getsDay = strtotime($exsDate);
                        $getrDay = strtotime($exrDate);
                        if ($getsDay > $getrDay) {
                            $totalDay = $getsDay - $getrDay;
                        } else {
                            $totalDay = $getrDay - $getsDay;
                        }

                        $totalDay = floor($totalDay / (60 * 60 * 24));
                        $exCode = "704031011";
                        $approval = $this->session->email;
                        $inserpartsUsed = $this->travelmodel->forexternalflight($flightAgency, $hodtoaprove, $approval, $approval, $exCode, $totalDay, $name, $tFromlocation, $tTolocation, $exsDate, $exrDate, $purpose, "yes", "not-staff");
                    
                        $datarray = [];
                        $datarray['dateCreated'] = date('Y-m-d H:i:s');
                        $datarray['request_ID'] = $name;
                        $datarray['flightID'] = $inserpartsUsed;
                        $datarray['travel_agency'] = $flightAgency;
                        $datarray['flightName'] = $flightName;
                        $datarray['flight_Amount'] = $flightAmount;
                        $datarray['flight_Details'] = $flightDetails;
                        $datarray['Status'] = "sent";
                        $datarray['designation'] = "not-staff";
                        $datarray['addedBy'] = $addedby;

                         $options = array(
                                    'table' => 'flight_request',
                                    'data'  => $datarray
                               );

                         $insertedFileId = $this->generalmd->create( $options );
                         
                        $this->generalmd->updateTableCol("travelstart_expense", "flightprocessBy", $addedby, "tid", $insertedFileId);
                        $this->generalmd->updateTableCol("travelstart_expense", "sentTohod", $hodtoaprove, "tid", $insertedFileId);
                        $this->generalmd->updateTableCol("travelstart_expense", "agency", $flightAgency, "tid", $insertedFileId);
                         
                    }
                    
             } // End of  if($pushRecords){ THIS IS A LOOP
                
         /***************************** BEGINNING OF UPLOAD HTML CODE ****************************************************** */
            /*if (isset($_FILES['myAttachment']['name'])) {
                $name = str_replace(' ', '', $_FILES['myAttachment']['name']);
                $name = preg_replace("([#%$></\ +])", "", $name);

                $origName = str_replace(' ', '', $_FILES['myAttachment']['name']);
                $origName = preg_replace("([#%$></\ +])", "", $origName);

                $directoryName = 'public/travels/flights/';
                //Check if the directory already exists.
                if (!is_dir($directoryName)) {
                    //Directory does not exist, so lets create it.
                    mkdir($directoryName, 0777, true);
                }
                $i = 0;
                while ($i < count($name)){
                    $mimeType = $_FILES['myAttachment']['type'][$i];
                    $temp = $_FILES['myAttachment']['tmp_name'][$i];
                    $fname = $name[$i];
                    $random = random_string('alnum', 10);
                    $savetime = date("mdy-Hms");
                    $newName = $random . $savetime . $origName[$i];

                    $ext = pathinfo($directoryName . $fname, PATHINFO_EXTENSION);
                    move_uploaded_file($temp, $directoryName . $newName);

                    $inserting = $this->travelmodel->addflightattachement($fname, $newName, $ext, $mimeType, $flightID, $travelID);
                    $i++;
                }
            }
            */
            
            $data = ['status' => 1, 'msg' => 'Flight Details Successfully Added'];
            
        } else {
            $data = ['status' => 0, 'msg' => 'please make sure all fields are fields'];
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    
    
     public function rejecthotel(){
        $data = [];
        if(isset($_POST['rejectrequestID'])){
            $dataID = $this->input->post('rejectrequestID', TRUE);
            $dComment = $this->input->post('dComment', TRUE);
            if($dataID == ""){
                  $data = ['status' => 1, 'msg' => 'Important Variable to process page missing'];
            }else{
                 //Use main ID to update request
            $date = date('Y-m-d H:i:s');
            $this->generalmd->updateTableCol("travel_hotel_bookings", "status", "5", "hotel_id", $dataID);
            $this->generalmd->updateTableCol("travel_hotel_bookings", "dcomment", $dComment, "hotel_id", $dataID);
            $this->generalmd->updateTableCol("travel_hotel_bookings", "dateRejected", $date, "hotel_id", $dataID);
            
            $approvedBy = "<tr><td>Rejected By</td> <td>".$this->session->email."</td> <td>$date</td></tr>";
            //$this->generalmd->updateTableCol("travel_hotel_bookings", "auditTrail", $approvedBy, "hotel_id", $dataID);
            $updateAuditTrail = $this->generalmd->updatedupdatetrail($approvedBy, $approvedBy, $dataID);
                    
                    
            
            $data = ["msg" => "Successfully Rejected"];
            }
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
   public function approvehotel(){
        $data = [];
        if(isset($_POST['dataID'])){
            $dataID = $this->input->post('dataID', TRUE);
            if($dataID == ""){
                  $data = ['status' => 1, 'msg' => 'Important Variable to process page missing'];
            }else{
            
            //Get other information 
            $travelHotel = $this->generalmd->getsinglecolumn("hotel_type", "travel_hotel_bookings", "hotel_id", $dataID);
            $period = $this->generalmd->getsinglecolumn("destinations", "travel_hotel_bookings", "hotel_id", $dataID);
            $addedBy = $this->generalmd->getsinglecolumn("addedBy", "travel_hotel_bookings", "hotel_id", $dataID);
            
            $creatdBy = $this->generalmd->getsinglecolumn("email", "cash_usersetup", "id", $addedBy);
            
            $hotelName = $this->generalmd->getsinglecolumn("HotelName", "travel_hotel", "id", $travelHotel);
            $hotelAddress = $this->generalmd->getsinglecolumn("sAddress", "travel_hotel", "id", $travelHotel);
            
            $date = date('Y-m-d H:i:s');
            $code = generateRandomCode(5, 10);
            
            //Use main ID to update request
            $this->generalmd->updateTableCol("travel_hotel_bookings", "status", "7", "hotel_id", $dataID);
            $codethis = $this->generalmd->updateTableCol("travel_hotel_bookings", "hotel_code", $code, "hotel_id", $dataID);
            $this->generalmd->updateTableCol("travel_hotel_bookings", "dateApproved", $date, "hotel_id", $dataID);
            
            $approvedBy = "<tr><td>Approved By</td> <td>".$this->session->email."</td> <td>$date</td>  </tr>";
            //$this->generalmd->updateTableCol("travel_hotel_bookings", "auditTrail", $approvedBy, "hotel_id", $dataID);
            $updateAuditTrail = $this->generalmd->updatedupdatetrail($approvedBy, $approvedBy, $dataID);
                    
                    
            
            $getEmail = $this->generalmd->getsinglecolumn("user_email", "travel_hotel_bookings", "hotel_id", $dataID);
             $checkifEmail = is_email($getEmail);
             $hotelEmail = $this->generalmd->getsinglecolumn("hotelEmail", "travel_hotel", "id", $travelHotel);
            if($checkifEmail){
			
                $message = "<div>Your Hotel Details</div>";
                $message .= "<div>Date Sent: ".date('Y-m-d H:i:s')."</div><br/>";
                $message .= "<div>Name: $getEmail</div><br/>";
                $message .= "<div>Hotel Code: $code</div><br/>";
                $message .= "<div>Hotel Name: $hotelName</div><br/>";
                $message .= "<div>Hotel Address: $hotelAddress</div><br/>";
                $message .= "<div>Period: $period</div><br/>";
                $message .= "<br/><hr/>This is an automated email please do not reply<p><br/>";
                        
                $config = array('mailtype' => "html");
                    $this->email->initialize($config);
                    $this->email->from("expensepro@c-iprocure.com", "C-ILEASING PLC"); 
                    $this->email->to($getEmail);
                    $this->email->cc($hotelEmail);
                    $this->email->cc($creatdBy);
                    $this->email->subject('HOTEL DETAILS'); 
                    $this->email->message($message); 
                    $this->email->send();
                  } 
                  
             $data = ["msg" => "Successfully Approved"];
            }
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    
    
  public function approvehotelbyicu(){
        $data = [];
        if(isset($_POST['dataID'])){
            $dataID = $this->input->post('dataID', TRUE);
            if($dataID == ""){
                  $data = ['status' => 1, 'msg' => 'Important Variable to process page missing'];
            }else{
                
            $travelHotel = $this->generalmd->getsinglecolumn("hotel_type", "travel_hotel_bookings", "hotel_id", $dataID);
            $period = $this->generalmd->getsinglecolumn("destinations", "travel_hotel_bookings", "hotel_id", $dataID);
            $addedBy = $this->generalmd->getsinglecolumn("addedBy", "travel_hotel_bookings", "hotel_id", $dataID);
            
            $creatdBy = $this->generalmd->getsinglecolumn("email", "cash_usersetup", "id", $addedBy);
            
            $hotelName = $this->generalmd->getsinglecolumn("HotelName", "travel_hotel", "id", $travelHotel);
            $hotelAddress = $this->generalmd->getsinglecolumn("sAddress", "travel_hotel", "id", $travelHotel);
                 //Use main ID to update request
            $date = date('Y-m-d H:i:s');
            $code = generateRandomCode(5, 10);
            $this->generalmd->updateTableCol("travel_hotel_bookings", "status", "8", "hotel_id", $dataID);
            $codethis = $this->generalmd->updateTableCol("travel_hotel_bookings", "hotel_code", $code, "hotel_id", $dataID);
            $this->generalmd->updateTableCol("travel_hotel_bookings", "dateVerified", $date, "hotel_id", $dataID);
             
             if($code){
			
                $message = "<div>Your Hotel Details</div>";
                $message .= "<div>Hotel Code: $code</div><br/>";
                $message .= "<div>Hotel Name: $hotelName</div><br/>";
                $message .= "<div>Hotel Address: $hotelAddress</div><br/>";
                $message .= "<div>Period: $period</div><br/>";
                $message .= "<br/><hr/>This is an automated email please do not reply<p><br/>";
                        
                $config = array('mailtype' => "html");
                    $this->email->initialize($config);
                    $this->email->from("expensepro@c-iprocure.com", "C-ILEASING PLC"); 
                    $this->email->to($creatdBy);
                    $this->email->subject('HOTEL DETAILS'); 
                    $this->email->message($message); 
                    $this->email->send();
                  } 
            
             $data = ["msg" => "Successfully Approved"];
            }
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }  
    
    
    
    
    
    
    
    
      public function batchinvoiceforpayment($id, $array) {

        $sessionEmail = $_SESSION['email'];
        $sessionID = $this->adminmodel->getuserID($sessionEmail);
        
        $newlang = "";
        $data = [];
        $batchstatus = 'sent';
        if ($id && $array) {

            
            //Get the First Array
         $batchTitle = $this->generalmd->getuserAssetLocation("batchTitle", " batchedflights", "id", $id);
            
         $batchAmount = $this->generalmd->getuserAssetLocation("batchAmount", " batchedflights", "id", $id);
             
          
         $sessemail = $_SESSION['email'];
        //Get the Unit the user belongs to
        $userUnit = $this->generalmd->getuserAssetLocation("dUnit", "cash_usersetup", "email", $sessemail);
               
        $getallaccounts = $this->generalmd->getaccountcodefromdb("unitaccountcode", "unit", $userUnit);
        
        //$getallaccounts = $this->mainlocation->getallaccounts();
        
        if ($getallaccounts) {
            $allact = "";
            foreach ($getallaccounts as $get) {
                //$codeid = $get->codeid;
                $codeName = $get->codeName;
                $codeNumber = $get->codeNumber;
                $allact .= "<option  value='$codeNumber'> " . $codeName . ' - ' . $codeNumber . '</option>';
            }
            //return $allact;
        }
        $this->load->model('maintenance');
        $getallvendors =  $this->maintenance->fromaintenance("*", "maintenance_workshop", "unitID", $userUnit);
        $allVendors = "";
        if ($getallvendors) {
               
                foreach ($getallvendors as $get) {
                    $mainID = $get->id;
                    $wkName = $get->workshop_name;
                    $allVendors .= "<option  value='$mainID'>$wkName</option>";
                }
                //return $allact;
        }
        
         $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
         $title = "Hotel Batched Payment";
         $getResult = $this->travelmodel->getbatchresultbyid($id);
         $menu = $this->load->view('menu', '', TRUE);
         $sidebar = $this->load->view('sidebar', '', TRUE);
         $footer = $this->load->view('footer', '', TRUE);
         $values = ['title' => $title, 'getResult' => $getResult, 'myvendors'=>$allVendors, 'accountCode'=>$allact, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
         $this->load->view('travelstart/paytoexpensebyhotel', $values); 
        }else{
            echo "<script>alert('Important Variable to process pay missing')</script>";
        }
           
    } // end of createbatchrequest
    
    
    
    
    
}// End of Class Home
