<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();


        $pageTitle = "C&I :: Expense Pro Setup";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        $this->gen->checkLogin();
    }

    public function index() {
        redirect(base_url());
    }

    public function location() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 5 || $getApprovalLevel == 6) {
            $title = "Expense Pro :: HOD SETUP";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('locationsetup', $values);
        } else {
            redirect(base_url());
        }
    }

    public function paymentmode() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 5 || $getApprovalLevel == 6) {
            $title = "Expense Pro :: PAYMENT MODE SETUP";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('paymentmode', $values);
        } else {
            redirect(base_url());
        }
    }

    public function accesssetup() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 5 || $getApprovalLevel == 6) {
            $title = "Expense Pro :: ACCESS MODE SETUP";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('accessmode', $values);
        } else {
            redirect(base_url());
        }
    }

    public function payment() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 5 || $getApprovalLevel == 6) {
            $title = "Expense Pro :: PAYMENT MODE SETUP";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('paymentmode', $values);
        } else {
            redirect(base_url());
        }
    }

    public function usersetup() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 5 || $getApprovalLevel == 6) {
            $title = "Expense Pro :: USER MODE SETUP";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('usersetup', $values);
        } else {
            redirect(base_url());
        }
    }

    public function dcategory() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 5 || $getApprovalLevel == 6) {
            $title = "Expense Pro :: VENDOR SETUP";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('vendorsetup', $values);
        } else {
            redirect(base_url());
        }
    }

    public function dunit() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 5 || $getApprovalLevel == 6) {
            $title = "Expense Pro :: UNIT MODE SETUP";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('dunit', $values);
        } else {
            redirect(base_url());
        }
    }

    public function accountgroup() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 8 || $getApprovalLevel == 6) {
            $title = "Expense Pro :: ACCOUNT GROUP SETUP";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('accountgroup', $values);
        } else {
            redirect(base_url());
        }
    }

    public function bankalert() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 8 || $getApprovalLevel == 6) {
            $title = "Expense Pro :: ACCOUNT BANK GROUP SETUP";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('bankalert', $values);
        } else {
            redirect(base_url());
        }
    }

    public function setupaccountants() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 8 || $getApprovalLevel == 6) {
            $title = "Expense Pro :: ACCOUNT GROUP SETUP";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('putaccountantingroup', $values);
        } else {
            redirect(base_url());
        }
    }

    public function setupicupeople() {
        $getHeadICU = $this->adminmodel->getHODICUpriv($_SESSION['id']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 5 || $getApprovalLevel == 6 || $getHeadICU === $_SESSION['id']) {
            $title = "Petty Cash Pro :: ICU GROUP SETUP";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('puticuingroups', $values);
        } else {
            redirect(base_url());
        }
    }

    public function cashiersetup() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 8 || $getApprovalLevel == 6 || $getApprovalLevel == 5) {
            $title = "Petty Cash Pro :: CASHIER SETUP";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('setupyourcashier', $values);
        } else {
            redirect(base_url());
        }
    }

    public function icugroup() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 6) {
            $title = "Petty Cash Pro :: ICU GROUP SETUP";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('createicugroup', $values);
        } else {
            redirect(base_url());
        }
    }

    public function setaccount() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 8 || $getApprovalLevel == 6 || $getApprovalLevel == 5) {
            $title = "Expense Pro :: ACCOUNT SETUP";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);

            $allCategory = $this->generalmd->getdresult("*", "account_code_group", "", "");

            $values = ['title' => $title, 'allCategory' => $allCategory, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('accountsetupgl', $values);
        } else {
            redirect(base_url());
        }
    }

    public function addBank() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 8 || $getApprovalLevel == 6 || $getApprovalLevel == 5) {
            $title = "Money Book Pro :: BANK SETUP";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('addBankandaccount', $values);
        } else {
            redirect(base_url());
        }
    }

    public function setuplevies() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 8 || $getApprovalLevel == 6 || $getApprovalLevel == 5) {
            $title = "Money Book Pro :: GOVERNMENT LEVIES - VAT & WITHOLDING TAX";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('vatwithold', $values);
        } else {
            redirect(base_url());
        }
    }

    public function processvattax() {
        $data = [];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 6 || $getApprovalLevel == 8 || $getApprovalLevel == 5) {
            if (isset($_POST['vat']) || isset($_POST['withold'])) {
                $vat = $this->input->post('vat', TRUE);
                $vatactnumber = $this->input->post('vatactnumber', TRUE);

                $vatPercent = ($vat / 100);
                $vattext = "vat";

                //Update the value that was there before
                $thispostvatcalculate = $this->allresult->calucatevatresult($vat, $vatactnumber, $vatPercent, $vattext);

                $data = ['msg' => 'Statutory Charges Successfully Setup'];
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function witholdingtax() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 8 || $getApprovalLevel == 6 || $getApprovalLevel == 5) {
            $title = "Money Book Pro :: GOVERNMENT LEVIES - VAT & WITHOLDING TAX";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('allwitholdingtax', $values);
        } else {
            redirect(base_url());
        }
    }

    public function processwitholding() {
        $data = [];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 6 || $getApprovalLevel == 8 || $getApprovalLevel == 5) {
            if (isset($_POST['witholding']) || isset($_POST['actwitholdnumber'])) {

                $actwitholdnumber = $this->input->post('actwitholdnumber', TRUE);
                $witholding = $this->input->post('witholding', TRUE);
                $details = $this->input->post('details', TRUE);


                $witholdingtaxPercent = ($witholding / 100);
                $withholdtext = "withold";

                $thispostvatcalculate = $this->allresult->calucatewitholdtaxresult($details, $witholding, $actwitholdnumber, $witholdingtaxPercent, $withholdtext);

                $data = ['msg' => 'Statutory Charges Successfully inserted'];
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function hoddropdownforusers() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 5 || $getApprovalLevel == 6) {
            $title = "Expense Pro :: ADD AS HOD OPTION";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('hodoptiongroup.php', $values);
        } else {
            redirect(base_url());
        }
    }

    public function titles() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 5 || $getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 2 || $getApprovalLevel == 7 || $getApprovalLevel == 8) {
            $title = "Expense Pro :: TITLE SETUP";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('addtitles', $values);
        } else {
            redirect(base_url());
        }
    }

    //////////////////////////////////////////SETTING UP LOCATION ///////////////////////////////////////////////        
    public function addtitleshere() {
        $data = [];
        if (isset($_POST['dtitle'])) {

            // Declaring put putting all variables in Values
            $dtitle = $this->input->post('dtitle', TRUE);
            $SessionName = $this->session->email;

            //Check if location is already in Database
            $dTitleCheck = $this->mainlocation->checkfortitle($dtitle);
            if ($dtitle == "") {
                $data = ['msg' => 'Please enter a Location'];  // Please make sure asset Name , Cost and Date purchased is not empty
            } else
            if ($dTitleCheck == TRUE) {

                $data = ['msg' => $dtitle . ' is already in the Database'];
            } else {
                // Insert into the Database;  $aCost, $fassetID, $refNo, $sessionID
                $Title = $this->mainlocation->insertintotitles($dtitle, $SessionName);

                $data = ['msg' => 'Titles Successfully Created']; // 'Asset is now Schedule for Maintenance.'
            }  // End of Else { 
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

//////////////////////////////////////////SETTING UP LOCATION /////////////////////////////////////////////// 




    public function icuheadsetup() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 6) {
            $title = "Expense Pro :: ";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('setupicuHeadids', $values);
        } else {
            redirect(base_url());
        }
    }

    public function changeicumemberlimit() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $getHeadICU = $this->adminmodel->getHODICUpriv($_SESSION['id']);
        if ($getApprovalLevel == 3 && $getHeadICU === $_SESSION['id']) {

            //Use the hod ID to return the group
            $getdHOdgroup = $this->adminmodel->gethodgroup($getHeadICU);

            //$getresultfromGroup = $this->adminmodel->getalluserforthatgroup($getdHOdgroup);
            $getresultfromGroup = $this->adminmodel->getalluserinicu();

            $title = "Expense Pro :: ";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getdHOdgroup' => $getdHOdgroup, 'getresultfromGroup' => $getresultfromGroup, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('changeiculimit', $values);
        } else if ($getApprovalLevel == 6 || $getApprovalLevel == 5) {

            $getHeadICU = $this->adminmodel->getchangeforadmin($_SESSION['id']);
            //Use the hod ID to return the group
            $getdHOdgroup = $this->adminmodel->getsuperadminonly($getHeadICU);

            //$getresultfromGroup = $this->adminmodel->getalluserforthatgroup($getdHOdgroup);
            $getresultfromGroup = $this->adminmodel->getalluserinicu();

            $title = "Expense Pro :: ";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getdHOdgroup' => $getdHOdgroup, 'getresultfromGroup' => $getresultfromGroup, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('changeiculimit', $values);
        } else {
            redirect(base_url());
        }
    }

    public function editiculimit($id, $dGroupID, $getdHOdgroup, $icu_userID, $limitAmount) {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $getHeadICU = $this->adminmodel->getHODICUpriv($_SESSION['id']);
        if ($getApprovalLevel == 3 && $getHeadICU === $_SESSION['id']) {

            $title = "Expense Pro :: ";

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'id' => $id, 'dGroupID' => $dGroupID, 'getdHOdgroup' => $getdHOdgroup, 'icu_userID' => $icu_userID, 'limitAmount' => $limitAmount, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('editicu', $values);
        } else if ($getApprovalLevel == 6) {

            $getHeadICU = $this->adminmodel->getchangeforadmin($_SESSION['id']);

            $title = "Expense Pro :: ";

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'id' => $id, 'dGroupID' => $dGroupID, 'getdHOdgroup' => $getdHOdgroup, 'icu_userID' => $icu_userID, 'limitAmount' => $limitAmount, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('editicu', $values);
        } else {
            redirect(base_url());
        }
    }

//////////////////////////////////////////CHANGE LIMIT///////////////////////////////////////////////        
    public function changelimitbyhod() {
        $data = [];
        if (isset($_POST['transID']) && isset($_POST['userLimit'])) {

            // Declaring put putting all variables in Values
            $transID = $this->input->post('transID', TRUE);
            $userLimit = $this->input->post('userLimit', TRUE);
            $SessionName = $this->session->email;

            if ($transID == "" || $userLimit == "") {
                $data = ['msg' => 'Please make sure all fields are fields'];  // Please make sure asset Name , Cost and Date purchased is not empty
            } else {
                // Insert into the Database;  $aCost, $fassetID, $refNo, $sessionID
                $changeLimit = $this->adminmodel->hodhaschangeyourlimit($userLimit, $transID);

                $data = ['msg' => 'Titles Successfully Created']; // 'Asset is now Schedule for Maintenance.'
            }  // End of Else { 
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

//////////////////////////////////////////CHANGE LIMIT /////////////////////////////////////////////// 



    public function currency() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 6 || $getApprovalLevel == 7) {
            $title = "Expense Pro :: ADD HOTEL";
            //get all the result
            $allCurrency = $this->generalmd->getdresult("*", "currencytype", "", "");
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'allCurrency' => $allCurrency, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('currency', $values);
        } else {
            $this->load->view('noaccessview', $values);
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function updateCurrency() {
        $data = [];
        if (isset($_POST['currencyType']) && isset($_POST['exchange_rate'])) {

            // Declaring put putting all variables in Values
            $currencyTypeID = $this->input->post('currencyType', TRUE);
            $exchange_rate = $this->input->post('exchange_rate', TRUE);
            $SessionName = $this->session->email;

            if ($currencyTypeID == "" || $exchange_rate == "") {
                $data = ['msg' => 'Please make sure all fields are fields'];  // Please make sure asset Name , Cost and Date purchased is not empty
            } else {
              
               // $currency['dAmount'] = $currencyType;
                $currency['exchange_rate'] = $exchange_rate;
               
                $options = array(
                    'table' => 'currencytype',
                    'data' => $currency
                );

                $updateRecord = $this->generalmd->update("id", $currencyTypeID, $options);
               
                
                $data = ['msg' => 'Currency Successfully Updated']; // 'Asset is now Schedule for Maintenance.'
            }  // End of Else { 
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

}
