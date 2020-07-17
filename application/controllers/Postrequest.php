<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class Postrequest extends CI_Controller {

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
        $this->load->model("maintenance");
        $this->gen->checkLogin();
        $this->gen->mainSetting();
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
        $this->getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        $this->sageRef = $this->input->post('sageRef', TRUE);

        $this->dcashier = $this->input->post('dcashier', TRUE) ? $this->input->post('dcashier', TRUE) : "";
        $this->daccountant = $this->input->post('daccountant', TRUE) ? $this->input->post('daccountant', TRUE) : "";

        //$this->approvals = $this->dhod !== "" ? '1' : '0';
        $this->approvals = '0';
    }

    private function validations($paymentType, $benName, $vendor, $descItem, $dateCreated, $dcashier, $daccountant,
            $dCurrencyType, $dhod, $sessionEmail, $today) {

        $datenow = date('Y-m-d');

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
        } else if ($dhod == $sessionEmail) { //$dcashier == $sessionEmail ||
            $data = ['status' => 3, 'msg' => 'You Cannot set yourself as the 2nd/1st Level Approval, Please select another'];
        } else if ($dateCreated < $today) {
            $data = ['status' => 8, 'msg' => 'You cannot set a date in the past'];
        }
    }

    public function index() {
        $data = [];
        $userGenCode = "";
        $today = date("Y-m-d");
        if ($this->input->is_ajax_request()) {

            $this->postvars();
            $sessionEmail = strtolower($_SESSION['email']);
            $sessionName = $this->adminmodel->getUsername($this->session->email);
            $mainBeneficiary = $this->paymentType == 1 ? $this->benName : $this->vendor;

            $this->validations($this->paymentType, $this->benName, $this->vendor, $this->descItem, $this->dateCreated,
                    $this->dcashier, $this->daccountant, $this->dCurrencyType, $this->dhod,
                    $sessionEmail, $today);

            //Implementation of random generated string
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
            $datarray['dLocation'] = $this->session->uLocation;
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
            $updatemdid = $this->mainlocation->updatemdfiveid($md5ID, $createdby, $insertedFileId);

            $data = ['status' => 1, 'md5' => $md5ID, 'id' => $insertedFileId, 'dUnit' => $this->dUnit, 'msg' => 'Request Successfully created, One More Step....'];
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function add_expense_code($id = "", $unit = "", $md5 = "") {


        $allact = "";
        $title = "Expense Pro :: NEW REQUEST-ADD EXPENSE";
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);

        $sessemail = $_SESSION['email'];
        //Get the Unit the user belongs to
        $userUnit = $this->generalmd->getuserAssetLocation("dUnit", "cash_usersetup", "email", $sessemail);
        //$getallaccounts = $this->generalmd->getaccountcodefromdb("unitaccountcode", "unit", $unit);
        $getallaccounts = $this->generalmd->withthreevaluesresult("*", "unitaccountcode_budget_setup", "unit", $unit, "month", date('m'), 'year', date('Y'));

        //Use the md5 and Unit to return id
        $getbackid = $this->generalmd->getsinglecolumnwithand("id", "cash_newrequestdb", "dUnit", $unit, "md5_id", $md5);
        $letCheckStatus = $this->generalmd->getsinglecolumnwithand("approvals", "cash_newrequestdb", "dUnit", $unit, "md5_id", $md5);

        if ($id == "" || $unit == "" || $md5 == "") {
            $this->load->view('noaccesstoview');
        } else if ($getbackid !== $id) {
            echo "<center>Wrong Parameter Passed, Please contact Administrator</center>";
            $this->load->view('noaccesstoview');
        } else if ($letCheckStatus != 0) {
            echo "<center>Please check status of Request $letCheckStatus</center>";
            $this->load->view('noaccesstoview');
        } else {

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

            $all_request = $this->generalmd->getdresult("*", "cash_newrequestdb", "id", $id);
            $all_request_expense = $this->generalmd->getdresult("*", "cash_newrequest_expensedetails", "requestID", $id);

            $values = ['title' => $title, 'all_request_expense' => $all_request_expense, 'all_request' => $all_request, 'md5' => $md5, 'unit' => $unit, 'mID' => $id, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer, 'fillSelect' => $allact];
            $this->load->view('newrequest_add_accountcode', $values);
        }
    }

    public function add_item_code() {

        $data = [];

        if (isset($_POST['requestID']) && isset($_POST['exAmount']) && isset($_POST['exCode'])) {

            $requestID = $this->input->post('requestID', TRUE);
            $exAmount = $this->input->post('exAmount', TRUE);
            $exCode = $this->input->post('exCode', TRUE);
            $exDate = $this->input->post('exDate', TRUE);
            $exDetailofpayment = $this->input->post('exDetailofpayment', TRUE);
            $md5 = $this->input->post('md5', TRUE);
            $unit = $this->input->post('unit', TRUE);

            //Get Current Current Unit Of Transaction
            $month = date('m');
            $year = date('Y');
            $getBudgetDifference = 0;



            //Get the Currency Type
            $curencyType = $this->generalmd->getsinglecolumn("CurrencyType", "cash_newrequestdb", "id", $requestID);

            //Return the Budget for the Current Month For the Item
            //$currentUnitBudget =  $this->generalmd->totalbudgetforunit($exCode, $unit, $year);
            $currentUnitBudget = $this->generalmd->monthlytotalbudgetforunit($exCode, $unit, $month, $year);

            //Return the Total Expense for the Budget for the Current Month
            $totalexpenseperunitcode = $this->generalmd->monthlyexpenseperunit($exCode, $unit, $month, $year);
            $exchangeRate = 1;
            if ($curencyType == "NGN" || $curencyType == "naira") {
                //Do the Maths
                $getBudgetDifference = $totalexpenseperunitcode + $exAmount;
                $exchangeRate = 1;
            } else {
                $exchangeRate = $this->generalmd->getsinglecolumn("exchange_rate", "currencytype", "name", $curencyType);
                $getBudgetDifference = $totalexpenseperunitcode + ($exAmount * $exchangeRate);
            }
//            echo $curencyType."<br/>";
//            echo $exchangeRate. "<br/>";
//            echo $getBudgetDifference; currentBudgetperItem
//            return;


            if ($exCode == "" || $exAmount == "" || $exDetailofpayment == "") {
                $data = ["status" => 424, "msg" => "Please fill out all fields"];
            } else if ($requestID == "") {
                $data = ["status" => 424, "msg" => "Important Variable To Process Page Missing, Contact Administrator"];
            } else if ($currentUnitBudget == "" || $currentUnitBudget == 0) {
                $data = ["status" => 424, "msg" => "That Item Code Has Not Been Budgeted For in That Unit, Please See Unit HOD Clarification"];
                //}else if($getBudgetDifference > $currentBudgetperItem){
            } else if ($getBudgetDifference >= $currentUnitBudget) {
                $data = ["status" => 425, 'md' => 'Get Executive Approval From MD', 'budget' => $currentUnitBudget, 'previous_expense' => @number_format($totalexpenseperunitcode, 2),
                    'total_expense' => @number_format($getBudgetDifference, 2), 'current_amount' => $exAmount, 'exchange_rate' => @number_format($exchangeRate, 2),
                    "msg" => "You can no longer raise request for the expense as budget is overspent! "
                    . "Kindly Inform your HOD about the issue. Budget- $currentUnitBudget. Expense - $getBudgetDifference"];
            } else {

                //insert the budget into the table cash_newrequest_expensedetails
                $budgetArray['requestID'] = $requestID;
                $budgetArray['ex_Details '] = $exDetailofpayment;
                $budgetArray['ex_Amount'] = $exAmount;
                $budgetArray['ex_Code'] = $exCode;
                $budgetArray['ex_Date'] = date('Y-m-d');
                $budgetArray['dUnit'] = $unit;
                $budgetArray['approved'] = "no";
                $budgetArray['approved_status'] = "0";
                $budgetArray['ex_Code_id '] = $this->generalmd->getsinglecolumn("codeid", "codeact", "codeNumber", $exCode);

                $option = array(
                    'table' => 'cash_newrequest_expensedetails',
                    'data' => $budgetArray
                );

                $insertedFileId = $this->generalmd->create($option);


                //Update Sum
                $sumAmount = $this->generalmd->getsumamount($requestID);
                //insert the budget into the table cash_newrequest_expensedetails
                $ibudgetArray['dAmount'] = $sumAmount;

                $options = array(
                    'table' => 'cash_newrequestdb',
                    'data' => $ibudgetArray
                );

                $updateRecord = $this->generalmd->update("id", $requestID, $options);



                if ($insertedFileId) {
                    $data = ["status" => 200, 'exID' => $insertedFileId, "requestID" => $requestID, 'dUnit' => $unit, 'md5' => $md5, "msg" => "Added Successfully, If you are done adding your items, Please Click the Continue Button"];
                } else {
                    $data = ["status" => 400];
                }
            }
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function deleterequest() {
        $data = [];


        if (isset($_POST['requestID'])) {
            //Use the Item to delete Request
            $exid = $this->input->post('requestID', TRUE);
            $requestID = $this->generalmd->getsinglecolumn("requestID", "cash_newrequest_expensedetails", "exid", $exid);

            $unit = $this->generalmd->getsinglecolumn("dUnit", "cash_newrequestdb", "id", $requestID);
            $md5 = $this->generalmd->getsinglecolumn("md5_id", "cash_newrequestdb", "id", $requestID);

            $letCheckStatus = $this->generalmd->getsinglecolumnwithand("approvals", "cash_newrequestdb", "id", $requestID, "md5_id", $md5);

            if ($letCheckStatus == 0 || $letCheckStatus == 1 || $letCheckStatus == '0' || $letCheckStatus == '5' || $letCheckStatus == '6' || $letCheckStatus == '10') {

                //Delete the Response For Sucess
                $this->load->model('primary');
                $deleteRequest = $this->primary->delete("exid", "$exid", "cash_newrequest_expensedetails");

                //Update Sum
                $sumAmount = $this->generalmd->getsumamount($requestID);
                //insert the budget into the table cash_newrequest_expensedetails
                $ibudgetArray['dAmount'] = $sumAmount;

                $options = array(
                    'table' => 'cash_newrequestdb',
                    'data' => $ibudgetArray
                );

                $updateRecord = $this->generalmd->update("id", $requestID, $options);

                if ($deleteRequest) {
                    $data = ["status" => 200];
                } else {
                    $data = ["status" => 400];
                }
            } else {
                $data = ["status" => 401, "msg" => "You Cannot Delete This Request, Please Check Status 0"];
            }
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function processforfileupload() {
        $data = [];

        if (isset($_POST['a_requestID'])) {
            //Use the Item to delete Request
            $requestID = $this->input->post('a_requestID', TRUE);
            $a_unit = $this->input->post('a_unit', TRUE);
            $a_md5 = $this->input->post('a_md5', TRUE);

            $getAmount = $this->generalmd->getsinglecolumn("ex_Amount", "cash_newrequest_expensedetails", "requestID", $requestID);

            if ($getAmount == "" || $getAmount == 0.00) {
                $data = ["status" => 401, "msg" => "please add expense details before your click continue"];
            } else {

                $sumAmount = $this->generalmd->getsumamount($requestID);
                //insert the budget into the table cash_newrequest_expensedetails
                $budgetArray['approvals'] = '1';
                $budgetArray['dAmount'] = $sumAmount;

                $options = array(
                    'table' => 'cash_newrequestdb',
                    'data' => $budgetArray
                );

                $updateRecord = $this->generalmd->update("id", $requestID, $options);

                $randomString = random_string('alnum', 60);

                $hod = $this->generalmd->getsinglecolumn("hod", "cash_newrequestdb", "id", $requestID);
                $description = $this->generalmd->getsinglecolumn("ndescriptOfitem", "cash_newrequestdb", "id", $requestID);

                if (!empty($hod)) {

                    $message = "<div>New Request awaiting your approval</div>";
                    $message .= "<div>Request Title: $description</div><br/>";
                    $message .= "<div>Click here for details:</div>"
                            . "<a href=" . base_url() . "home/approvaldetails/$requestID/$a_md5/$randomString>Link to request</a>";


                    $message .= "<br/><hr/>This is an automated email please do not reply<p><br/>";
                    $config = array(
                        'mailtype' => "html"
                    );

                    $this->email->initialize($config);
                    $this->email->from("expensepro@c-iprocure.com", "TBS-EXPENSE PRO");
                    $this->email->to($hod);
                    $this->email->subject('NEW REQUEST FOR APPROVAL');
                    $this->email->message($message);
                    $this->email->send();
                }



                if ($updateRecord) {
                    $data = ["status" => 200, 'id' => $requestID, "unit" => $a_unit, 'md5' => $a_md5];
                } else {
                    $data = ["status" => 400];
                }
            }
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function makefileupload($id = "", $unit = "", $md5 = "") {

        $allact = "";
        $title = "Expense Pro :: NEW REQUEST-ADD EXPENSE";
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);

        $sessemail = $_SESSION['email'];

        //Use the md5 and Unit to return id
        $getbackid = $this->generalmd->getsinglecolumnwithand("id", "cash_newrequestdb", "dUnit", $unit, "md5_id", $md5);
        $letCheckStatus = $this->generalmd->getsinglecolumnwithand("approvals", "cash_newrequestdb", "dUnit", $unit, "md5_id", $md5);

        if ($id == "" || $unit == "" || $md5 == "") {
            $this->load->view('noaccesstoview');
        } else if ($getbackid !== $id) {
            echo "<center>Wrong Parameter Passed, Please contact Administrator</center>";
            $this->load->view('noaccesstoview');
        } else if ($letCheckStatus != 1) {
            echo "<center>Please check status of Request $letCheckStatus</center>";
            $this->load->view('noaccesstoview');
        } else {


            $all_request = $this->generalmd->getdresult("*", "cash_newrequestdb", "id", $id);
            $all_request_expense = $this->generalmd->getdresult("*", "cash_newrequest_expensedetails", "requestID", $id);
            $all_files = $this->generalmd->getdresult("*", "cash_fileupload", "f_requestID", $id);

            $values = ['title' => $title, 'all_files' => $all_files, 'all_request_expense' => $all_request_expense, 'all_request' => $all_request, 'md5' => $md5, 'unit' => $unit, 'mID' => $id, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('newrequest_add_files', $values);
        }
    }

    public function upoadFiles() {

        $data = [];

        if (isset($_POST['requestID'])) {
            //Use the Item to delete Request
            $requestID = $this->input->post('requestID', TRUE);
            $unit = $this->input->post('unit', TRUE);
            $md5 = $this->input->post('md5', TRUE);

            $letCheckStatus = $this->generalmd->getsinglecolumnwithand("approvals", "cash_newrequestdb", "id", $requestID, "md5_id", $md5);

            if ($letCheckStatus == 1) {

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

                        $inserting = $this->mainlocation->addnewfile($fname, $newName, $ext, $mimeType, $requestID);
                        $i++;
                    }

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

    public function finishproocess() {
        $data = [];

        if (isset($_POST['a_requestID'])) {
            //Use the Item to delete Request
            $requestID = $this->input->post('a_requestID', TRUE);
            $a_unit = $this->input->post('a_unit', TRUE);
            $a_md5 = $this->input->post('a_md5', TRUE);

            $sumAmount = $this->generalmd->getsumamount($requestID);
            //insert the budget into the table cash_newrequest_expensedetails
            $budgetArray['approvals'] = '1';
            $budgetArray['dAmount'] = $sumAmount;

            $options = array(
                'table' => 'cash_newrequestdb',
                'data' => $budgetArray
            );

            $updateRecord = $this->generalmd->update("id", $requestID, $options);

            if ($updateRecord) {
                $data = ["status" => 200];
            } else {
                $data = ["status" => 400];
            }
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function editrequest($id = "", $unit = "", $md5 = "") {

        $allact = "";
        $title = "Expense Pro :: EDIT REQUEST";
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);

        $sessemail = $_SESSION['email'];
        //Get the Unit the user belongs to
        $userUnit = $this->generalmd->getuserAssetLocation("dUnit", "cash_usersetup", "email", $sessemail);
        //$getallaccounts = $this->generalmd->getaccountcodefromdb("unitaccountcode_budget_setup", "unit", $unit);
         $getallaccounts = $this->generalmd->withthreevaluesresult("*", "unitaccountcode_budget_setup", "unit", $unit, "month", date('m'), 'year', date('Y'));

        //Use the md5 and Unit to return id 
        $getbackid = $this->generalmd->getsinglecolumnwithand("id", "cash_newrequestdb", "dUnit", $unit, "md5_id", $md5);
        $letCheckStatus = $this->generalmd->getsinglecolumnwithand("approvals", "cash_newrequestdb", "dUnit", $unit, "md5_id", $md5);

        $which_app = $this->generalmd->getuserAssetLocation("from_app_id", "cash_newrequestdb", "id", $id);

        if ($id == "" || $unit == "" || $md5 == "") {
            $this->load->view('noaccesstoview');
        } else if ($which_app == 9 || $which_app == 3 || $which_app == 5) {
            echo "<center><h4 style='color:red'>You Cannot Edit Request Coming From Another Application</h4></center>";
            $this->load->view('noaccesstoview');
        } else if ($getbackid !== $id) {
            echo "<center>Wrong Parameter Passed, Please contact Administrator</center>";
            $this->load->view('noaccesstoview');
        } else if ($letCheckStatus == 0 || $letCheckStatus == 1 || $letCheckStatus == 5 || $letCheckStatus == 6 || $letCheckStatus == 10) {

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

            $all_request = $this->generalmd->getdresult("*", "cash_newrequestdb", "id", $id);
            $all_request_expense = $this->generalmd->getdresult("*", "cash_newrequest_expensedetails", "requestID", $id);
            $all_files = $this->generalmd->getdresult("*", "cash_fileupload", "f_requestID", $id);

            $values = ['title' => $title, 'all_files' => $all_files, 'all_request_expense' => $all_request_expense, 'all_request' => $all_request, 'md5' => $md5, 'unit' => $unit, 'mID' => $id, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer, 'fillSelect' => $allact];
            $this->load->view('newrequest_edit', $values);
        } else {
            echo "<center>Please check status of Request $letCheckStatus</center>";
            $this->load->view('noaccesstoview');
        }
    }

    public function edit_request_first() {
        $data = [];
        $a_requestID = $this->input->post('a_requestID', TRUE);
        $a_unit = $this->input->post('a_unit', TRUE);
        $a_md5 = $this->input->post('a_md5', TRUE);
        $ndescription = $this->input->post('ndescription', TRUE);
        $unitName = $this->input->post('unitName', TRUE);
        $hod = $this->input->post('hod', TRUE);
        $cashier = isset($_POST['cashier']) ? $this->input->post('cashier', TRUE) : '';
        $accountGroup = isset($_POST['accountGroup']) ? $this->input->post('accountGroup', TRUE) : '';
        $curencyType = $this->input->post('curencyType', TRUE);
        $benName = $this->input->post('benName', TRUE);
        $comment = $this->input->post('comment', TRUE);
        $nPayment = $this->input->post('nPayment', TRUE);

        $letCheckStatus = $this->generalmd->getsinglecolumnwithand("approvals", "cash_newrequestdb", "dUnit", $a_unit, "md5_id", $a_md5);

        if ($letCheckStatus == 0 || $letCheckStatus == 1 || $letCheckStatus == '0' || $letCheckStatus == '5' || $letCheckStatus == '6' || $letCheckStatus == '10') {

            $budgetArray['approvals'] = '1';
            $budgetArray['dUnit'] = $unitName;
            $budgetArray['ndescriptOfitem'] = $ndescription;
            $budgetArray['hod'] = $hod;

            $budgetArray['hod '] = $hod;
            $budgetArray['CurrencyType '] = $curencyType;
            $budgetArray['benName '] = $benName;
            $budgetArray['requesterComment '] = $comment;

            if ($nPayment == 1) {
                $budgetArray['cashiers'] = $cashier;
            } else if ($nPayment == 2) {
                $budgetArray['dAccountgroup'] = $accountGroup;
            }

            $options = array(
                'table' => 'cash_newrequestdb',
                'data' => $budgetArray
            );

            $updateRecord = $this->generalmd->update("id", $a_requestID, $options);

            if ($updateRecord) {
                $data = ["status" => 200, "msg" => "Request Successfully Edited"];
            } else {
                $data = ["status" => 400, "msg" => "Error Editing Request"];
            }
        } else {
            $data = ["status" => 401, "msg" => "Cannot Edit Request"];
        }


        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function ibanktransfer() {
        $data = [];
        if (isset($_POST['descriptionOftransfer']) && isset($_POST['tr_exAmount']) && isset($_POST['tr_vendor'])) {

            $bankArray['description_transfer'] = $this->input->post('descriptionOftransfer', TRUE);
            $bankArray['tr_dateCreated'] = $this->input->post('tr_dateCreated', TRUE);
            $bankArray['tr_dhod'] = $this->input->post('tr_dhod', TRUE);
            $bankArray['tr_dUnit'] = $this->input->post('tr_dUnit', TRUE);
            $bankArray['tr_vendor'] = $this->input->post('tr_vendor', TRUE);
            $bankArray['tr_exDetailofpayment'] = $this->input->post('tr_exDetailofpayment', TRUE);
            $bankArray['tr_exAmount'] = $this->input->post('tr_exAmount', TRUE);
            $bankArray['tr_exCode'] = $this->input->post('tr_exCode', TRUE);
           
             if (isset($_FILES['tr_uploadFile']['name'])) {
                    $name = str_replace(' ', '', $_FILES['tr_uploadFile']['name']);
                    $origName = str_replace(' ', '', $_FILES['tr_uploadFile']['name']);
                    
                    $mimeType = $_FILES['tr_uploadFile']['type'];
                    $temp = $_FILES['tr_uploadFile']['tmp_name'];
                    $location = 'public/documents/';
                    $random = random_string('alnum', 10);
                    
                    $savetime = date("mdy-Hms");
                    $newName = $random . $savetime . $origName;
                    $ext = pathinfo($location . $name, PATHINFO_EXTENSION);
                        move_uploaded_file($temp, $location . $newName);

                  $bankArray['file_name'] = $name;
                  $bankArray['file_new_name'] = $newName;
                  $bankArray['file_mime_type'] = $mimeType;
                  $bankArray['sessionID'] = $_SESSION['id'];
                  $bankArray['paymentType'] = 3;
                  $bankArray['accountGroup'] = 1;    
                  $bankArray['status'] = 1;     //Sent
             }
          
            $option = array(
                'table' => 'cash_bank_transfer',
                'data' => $bankArray
            );

           
            
            $insertedFileId = $this->generalmd->create($option);
            
             if ($insertedFileId) {
                $data = ["status" => 200, "msg" => "Request Successfully Edited"];
            }else{
                $data = ["status" => 400, "msg" => "Error Processing Request"];  
            }
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    
    
    
    
    public function allbankrequest($id=""){
        $title = "Expense Pro :: BANK TRANSFER";

        $sessionID = $_SESSION['id'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        
         $checkAcess = $this->gen->check_menu_access($id);
        if ($checkAcess == true) {

             $result = $this->generalmd->getresultwithand("*", "cash_bank_transfer", "tr_dhod", $sessionID, "status", "1"); 
           /* if($getApprovalLevel == 4){
                $result = $this->generalmd->getdresult("*", "cash_bank_transfer", "sessionID", $sessionID);  
            }else if($getApprovalLevel == 2){
               $result = $this->generalmd->getresultwithand("*", "cash_bank_transfer", "tr_dhod", $sessionID, "status", "1"); 

            }else if($getApprovalLevel == 3){
                 $result = $this->generalmd->getresultwithand("*", "cash_bank_transfer", "tr_dhod", $sessionID, "status", "2");  
            }else if($getApprovalLevel == 7){
                $result = $this->generalmd->getresultwithand("*", "cash_bank_transfer", "tr_dhod", $sessionID, "status", "3");   
            }else if($getApprovalLevel == 6){
                $result = $this->generalmd->getdresult("*", "cash_bank_transfer", "", ""); 
            }else{
                $result = $this->generalmd->getdresult("*", "cash_bank_transfer", "sessionID", $sessionID);
            }
            * 
            */


            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'result' => $result, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('bank_transfer', $values);
        } else {
            echo "no access";
        }
    }
    
    
    
    
    
    public function approvetransfer(){
       $data = [];
       
       $id = $this->input->post('id', TRUE);
        $sessionEmail = $_SESSION['email'];
        
         $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
         $get_audit = $this->generalmd->getsinglecolumn("audit", "cash_bank_transfer", "id", $id);
        
            if($getApprovalLevel == 2){
                $msg =  "successfully approved by $sessionEmail";
                $budgetArray['status'] = 2;
                $budgetArray['audit'] = $msg ."<br/>". $get_audit;
            }else if($getApprovalLevel == 3){
              $budgetArray['status'] = 3;
              $msg =  "successfully approved by $sessionEmail";
              $budgetArray['audit'] = $msg."<br/>". $get_audit;
            }else if($getApprovalLevel == 7){
              $budgetArray['status'] = 4;
              $msg =  "successfully approved by $sessionEmail";
              $budgetArray['audit'] = $msg."<br/>". $get_audit;
            }else{
              //$budgetArray['status'] = 1;
              //$msg =  "no access to approve";
                 $msg =  "successfully approved by $sessionEmail";
                $budgetArray['status'] = 2;
                $budgetArray['audit'] = $msg ."<br/>". $get_audit;
            }
           

            $options = array(
                'table' => 'cash_bank_transfer',
                'data' => $budgetArray
            );

            $updateRecord = $this->generalmd->update("id", $id, $options);
            
              if ($updateRecord) {
                $data = ["status" => 200, "msg" => $msg];
            }else{
                $data = ["status" => 400, "msg" => "Error Processing Request"];  
            }
       
       $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    
}

// End of Class Home
