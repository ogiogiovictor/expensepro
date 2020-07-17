<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

//require_once('PHPMailerAutoload.php');
class Accounts extends CI_Controller {

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
        $this->gen->mainSetting();

        //$this->load->library('PHPMailerfunction');
        $this->load->model('maintenance');
        $this->load->model('accountmodel');
        $putNewSession = $this->users->checkUserSession($_SESSION['email']);
        if ($putNewSession === FALSE) {
            redirect(base_url() . "nopriveledge");
        }
    }

    public function index() {
        $this->load->model('maintenance');
        $data = "";
        $this->load->library('pagination');
        $title = "EXPENSE PRO :: ALL CHQUES";
        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($mySessionEmail);
        if ($getApprovalLevel == 7 || $getApprovalLevel == 6) {
            $columns = array("id", "sageRef", "md5_id", "dateCreated", "hod", "CurrencyType", "ndescriptOfitem", "partPay",
                "nPayment", "dAmount", "dateICUapprove", "from_app_id", "benName", "dLocation", "dAccountgroup", "fullname", "dateRegistered", "approvals", "sessionID", "dUnit");

       
            $getTotalCount = $this->generalmd->countbyaccountgroup("cash_newrequestdb");

            $config = [];
            $config['base_url'] = base_url() . 'accounts/index';
            $config['total_rows'] = $getTotalCount;
            $config['per_page'] = 10;
            $config['num_links'] = 5;
            //$config['uri_segment'] = 3;
            //Add Boostrap Pagination Style
            //Add Boostrap To style Pagination
            $config["full_tag_open"] = '<ul class="pagination">';
            $config["full_tag_close"] = '</ul>';
            $config["first_link"] = "&laquo;";
            $config["first_tag_open"] = "<li>";
            $config["first_tag_close"] = "</li>";
            $config["last_link"] = "&raquo;";
            $config["last_tag_open"] = "<li>";
            $config["last_tag_close"] = "</li>";
            $config['next_link'] = '&gt;';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '<li>';
            $config['prev_link'] = '&lt;';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '<li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $this->pagination->initialize($config);
            $page = $this->uri->segment(3);
            $type = "";
            $type2 = "";

            ////////////////////////BRING THE GROUP DATA////////////////////////////////////
            //Return the ID of the accoutant
            $getAccountID = $this->adminmodel->getuserID($mySessionEmail);
            //get all the groups accoutn from the datatbase
            $getallgroupdaccount = $this->mainlocation->getmainaccount();
            if ($getallgroupdaccount) {
                foreach ($getallgroupdaccount as $get) {
                    $dAccountgroup = $get->dAccountgroup;

                    //Use the result to check if the userid is in the array
                    $checkcash_groupaccount = $this->mainlocation->cashgroup($dAccountgroup);

                    $kaboom = explode(",", $checkcash_groupaccount);

                    if (in_array($getAccountID, $kaboom)) {
                        
                        //$data = $this->mainlocation->getaccountresult($dAccountgroup, $config['per_page'], $page, $columns);
                        $data = $this->generalmd->getaccountresultbygroup("cash_newrequestdb", $config['per_page'], $page, $columns, $dAccountgroup);
                       
                    }
                }
            }


            $dataLink = $this->pagination->create_links();
            $dyear = "";
            $dmonth = "";
            $dUnit = "";
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getallresult' => $data, 'fdyear'=>$dyear, 'dMonth'=>$dmonth, 'dUnit'=>$dUnit, 'paginationLinks'=>$dataLink, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('foraccountlazyload', $values);
        } else {
            $this->load->view('error404');
        }
    }

    
    public function searchunpaidcheques() {
        $data = "";
        $title = "AWAITING PAYMENT :: ALL CHEQUES";
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $search = $this->input->post('search', TRUE);
        $searchcriteria = $this->input->post('searchcriteria', TRUE);
        $dyear = "";
        $dmonth = "";
        $dUnit = "";
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $dataLink = "";
        if (isset($search) && !empty($search) && isset($searchcriteria) && !empty($searchcriteria)) {
            //$data = $this->generalmd->search_result_by_account("cash_newrequestdb", $search);
            $data = $this->generalmd->search_result_only_account("cash_newrequestdb", $search, $searchcriteria);
            $values = ['getallresult' => $data, 'fdyear'=>$dyear, 'dMonth'=>$dmonth, 'dUnit'=>$dUnit,  'paginationLinks' => $dataLink, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('foraccountlazyload', $values);
        } else {
            $this->session->set_flashdata('data_name',  '<center><span class="alert alert-danger">Please choose a criteria and enter a value</span></center>');
            redirect('accounts/index', 'refresh');
        }
    }
    
    
     public function searchunpaidchequesm() { //searchunpaidchequesm
        $data = "";
        $title = "AWAITING PAYMENT :: ALL CHEQUES";
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
       
        
         $dyear = $this->input->get('dyear', TRUE);
         $dmonth = $this->input->get('dmonth', TRUE);
        $Unit = $this->input->get('dUnit', TRUE);
       $searchrange = $this->input->get('searchrange', TRUE);
        
        if(isset($searchrange)){
        $explode = explode(",", $searchrange);
        $oneFirst = $explode[0];
        $oneSecond = $explode[1];
        }
        
       

        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $dataLink = "";
        if (isset($dyear) && isset($dmonth) && isset($Unit)) {
            $data = $this->generalmd->getdMonthyear($dmonth, $dyear, $Unit);
            $dUnit = $this->generalmd->getuserAssetLocation("unitName", "cash_unit", "id", $Unit); 
            $values = ['getallresult' => $data, 'dMonth'=>$dmonth, 'fdyear'=>$dyear, 'dUnit'=>$dUnit, 'paginationLinks' => $dataLink, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('foraccountlazyload', $values);
        }else if(isset($dyear) && isset($dmonth) && isset($Unit) && isset($searchrange)){
            
            $data = $this->generalmd->getdMonthyearbyRange($dmonth, $dyear, $Unit, $oneFirst, $oneSecond);
            
            $dUnit = $this->generalmd->getuserAssetLocation("unitName", "cash_unit", "id", $Unit); 
            $values = ['getallresult' => $data, 'dMonth'=>$dmonth, 'fdyear'=>$dyear, 'dUnit'=>$dUnit, 'paginationLinks' => $dataLink, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('foraccountlazyload', $values);
            
            
        }else {
            $this->session->set_flashdata('data_name', '<center><span class="alert alert-danger">Please choose a criteria and enter a value</span></center>');
            redirect('accounts/index', 'refresh');
        }
    }
    
    
    public function searchunpaidchequesms() {
        $data = "";
        $title = "AWAITING PAYMENT :: ALL CHEQUES";
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        
        $searchrange = $this->input->post('searchrange', TRUE);
        $explode = explode(",", $searchrange);
        
        $oneFirst = $explode[0];
        $oneSecond = $explode[1];
        $dyear = "";
        $dmonth = "";
        $dUnit = "";
        
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $dataLink = "";
        if (isset($searchrange) && !empty($oneFirst) && !empty($oneSecond)) {
            $data = $this->generalmd->getbyRange($oneFirst, $oneSecond);
            $values = ['getallresult' => $data, 'paginationLinks' => $dataLink, 'dMonth'=>$dmonth, 'fdyear'=>$dyear, 'dUnit'=>$dUnit, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('foraccountlazyload', $values);
        } else {
            $this->session->set_flashdata('data_name', '<center><span class="alert alert-danger">Please choose a criteria and enter a value</span></center>');
            redirect('accounts/index', 'refresh');
        }
    }
    
    
    
    
    
    
    public function processcheques() {

        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($mySessionEmail);

        ////////////////////////BRING THE GROUP DATA////////////////////////////////////
        //Return the ID of the accoutant
        $getAccountID = $this->adminmodel->getuserID($mySessionEmail);
        //get all the groups accoutn from the datatbase
        $getallgroupdaccount = $this->mainlocation->getmainaccount();
        if ($getallgroupdaccount) {
            foreach ($getallgroupdaccount as $get) {
                $dAccountgroup = $get->dAccountgroup;

                //Use the result to check if the userid is in the array
                $checkcash_groupaccount = $this->mainlocation->cashgroup($dAccountgroup);

                $kaboom = explode(",", $checkcash_groupaccount);

                if (in_array($getAccountID, $kaboom)) {

                    //$fetch_data = $this->accountmodel->makeDatabase($dAccountgroup);
                    $fetch_data = $this->accountmodel->getnewdbforaccount();
                    //$getallresult = $this->mainlocation->getaccountresult($dAccountgroup);
                    //var_dump($getallresult);
                }
            }
        }

        ///////////////////////END OF THE GROUP DATA//////////////////////////////////
        // $fetch_data = $this->accountmodel->makeDatabase(); $fetch_data = $this->accountmodel->makeDatabase();

        $data = [];
        $randomString = random_string('alnum', 60);
        foreach ($fetch_data as $row) {
            $sub_array = array();

            $sub_array[] = $row->id;
            $sub_array[] = $row->dateCreated;
            $sub_array[] = "<span style='color:blue'>" . $row->ndescriptOfitem . "</span>";
            $sub_array[] = $this->adminmodel->getUsername($row->sessionID);

            $CurrencyType = $row->CurrencyType;
            if ($CurrencyType == 'naira') {
                $newCurrency = '<span>&#8358;</span>';
            } else if ($CurrencyType == 'dollar') {
                $newCurrency = '<span>&#x0024;</span>';
            } else if ($CurrencyType == 'euro') {
                $newCurrency = '<span>&#8364;</span>';
            } else if ($CurrencyType == 'pounds') {
                $newCurrency = '<span>&#163;</span>';
            } else if ($CurrencyType == 'yen') {
                $newCurrency = '<span>&#165;</span>';
            } else if ($CurrencyType == 'singaporDollar') {
                $newCurrency = '<span>S&#x0024;</span>';
            } else if ($CurrencyType == 'AED') {
                $newCurrency = '<span>(AED)</span>';
            } else if ($CurrencyType == 'rupee') {
                $newCurrency = '<span>&#8377;</span>';
            } else {
                $newCurrency = '<span>&#8358;</span>';
            }

            $sub_array[] = is_numeric($row->dLocation) ? $this->mainlocation->getdLocation($row->dLocation) : $row->dLocation;
            $sub_array[] = $newCurrency . @number_format($row->dAmount, 2);
            $approvals = $row->approvals;
            //$sub_array[] = $row->benName;

            $md5_id = $row->md5_id;
            $dAccountgroup = $row->dAccountgroup;


            if ($approvals == 0) {
                $sub_array[] = "Pending";
            } else if ($approvals == 1) {
                $sub_array[] = "<span style='color:red'>Awaiting HOD Approval</span>";
            } else if ($approvals == 2) {
                $sub_array[] = "<span style='color:blue'>Awaiting ICU Approval</span>";
            } else if ($approvals == 3) {
                $sub_array[] = "<span style='color:indigo'>Awaiting Payment</span>";
            } else if ($approvals == 4) {
                $sub_array[] = "<span style='color:green'>Ready for Collection</span>";
            } else if ($approvals == 5) {
                $sub_array[] = "<span style='color:red'>Not Approved By HOD</span>";
            } else if ($approvals == 6) {
                $sub_array[] = "<span style='color:grey'>Reject by ICU</span>";
            } else if ($approvals == 7) {
                $sub_array[] = "<span style='color:indigo'>Cheque Sent for Signature</span>";
            } else if ($approvals == 8) {
                $sub_array[] = "<span style='color:green'>Paid</span>";
            } else if ($approvals == 11) {
                $sub_array[] = "<span style='color:brown'>Closed</span>";
            } else if ($approvals == 12) {
                $sub_array[] = "<span style='color:brown'>Rejected By Accounts</span>";
            }

            $newrandomString = generateRandomCode(10, 20);

            //$sub_array[] = "<a href='" . base_url() . "home/viewreqeuestdetails/$row->id/$approvals/$randomString'><button title='Full Details' class='btn btn-xs btn-facebook'>V</button></a>&nbsp;";

            if ($getApprovalLevel == 7 && $approvals == 3) {
                $sub_array[] = "<span title='Approve' class='btn btn-xs btn-success' onClick='approvecheques($row->id, $dAccountgroup, $row->dAmount)'><i class='material-icons'>check</i></span>"
                        . "&nbsp;<input type='submit' title='Reject' name='theaccountantrejectedit' data-id='$row->id' class='theaccountantrejectedit btn btn-xs btn-danger disposebox'  value='X' class='btn btn-xs btn-danger'/>"
                        . "&nbsp<span title='print' class='btn btn-xs btn-default' onClick='printchequerequests($row->id)'><i class='material-icons'>print</i></span>"
                        . "&nbsp;<a href='" . base_url() . "paycheques/preparecheque/$row->id/$md5_id/$approvals/$newrandomString' title='Prepare Cheque'><span title='Cheque Preparation' class='btn btn-xs btn-warning' >C</span></a>"
                        . "&nbsp;<a title='view' href='" . base_url() . "home/approvaldetails/$row->id/$md5_id/$newrandomString'><span class='btn btn-xs btn-facebook'><i class='material-icons'>insert_drive_file</i></span></a>";
            } else {
                $sub_array[] = "";
            }


            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->accountmodel->getAll_data(),
            "recordsFiltered" => $this->accountmodel->get_data_filtered($dAccountgroup),
            "data" => $data
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    
    
    
    
    
    
     public function settings() {
        $this->load->model('primary');
         $title = "Expense Pro :: REPORT";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 6 || $getApprovalLevel == 7 || $getApprovalLevel == 5 || $getApprovalLevel == 3) {

             $getallUsers = $this->cashiermodel->getmyuserfulldetals();
             $getallUnits = $this->mainlocation->getallunit();
             $getallAccountcode = $this->cashiermodel->getallaccountcodesforsummary();
             
             $dTotal = $this->cashiermodel->getallrequestfromunit();
             $dYearonly = $this->reportmodel->getamountbyyear();
             $otherCurrencies = $this->reportmodel->othercurrencies();
             
             
             ////////////////****************** GENERAL REPORTING *******************/////////////////////////////////
             $totalRequest = $this->allresult->allrequestindb("cash_newrequestdb", "id");
             
             $petteycash = $this->allresult->tcountpetteycash("cash_newrequestdb", "id", "1");
             $chequerequestonly = $this->allresult->tcountcheque("cash_newrequestdb", "id", "2");
             
             $totalExpenseCode = $this->allresult->tcount("codeact", "codeid");
             $travelRequest = $this->allresult->tcountravel("cash_newrequestdb", "id");
             $fromProcurement  = $this->allresult->procurementR("cash_newrequestdb", "id");
             
             $upaidCheques = $this->allresult->unpaidcheque("cash_newrequestdb", "id");
             $paidCheques = $this->allresult->paidcheque("cash_newrequestdb", "id");
             
             
             //////////////******************** END OF GENERAL REPORTING **************/////////////////////////////
                         
            $thirtydays = $this->primary->countthirtydays();
            $thirtyonetosixty = $this->primary->countthirtyonetosixtydays();
            $sixtyonetoonetwenty = $this->primary->countsixtyonetoonetwenty();
            $abovesixmonth = $this->primary->countabovesixmonths();
            $twelvemonth = $this->primary->twelvemonths();
             
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'pc'=>$petteycash, 'ch'=>$chequerequestonly, 'twelvemonth'=>$twelvemonth, 'abovesixmonth'=>$abovesixmonth, 'sixtyonetoonetwenty'=>$sixtyonetoonetwenty, 'thirtyonetosixty'=>$thirtyonetosixty, 'thirtydays'=>$thirtydays, 'paidCheques'=>$paidCheques, 'upaidCheques'=>$upaidCheques, 'fromP'=>$fromProcurement, 'travelRequest'=>$travelRequest, 'allRequest'=>$totalRequest, 'cID'=>$totalExpenseCode, 
                        'otherCurrency'=>$otherCurrencies, 'dYearonly'=>$dYearonly, 'dTotal'=>$dTotal, 'getallAccountcode'=>$getallAccountcode, 'getallUnits'=>$getallUnits, 
                'getallUsers'=>$getallUsers, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('accountsetting', $values);
        } else {
             $this->load->view('noaccesstoview');
        }
    }
    
    
    
    public function travelrequest(){
      
        $title = "Travel Request :: ALL CHEQUES";
       
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 5 || $getApprovalLevel == 3) {
            $this->load->model('primary');
            $getallresult = $this->primary->getonlytravles();
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['getallresult' => $getallresult, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('alltravelrequest', $values);
        }
        
        
    }
    
    
     public function travelrequestall(){
      
        $title = "Travel Request :: PENDING CHEQUES PAYMENTS";
       
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 5 || $getApprovalLevel == 3) {
            $getallresult = $this->generalmd->getdresult("*", "cash_newrequestdb", "enumType", "travel");
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['getallresult' => $getallresult, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('alltravelrequest', $values);
        }
        
        
    }
    
    
    public function fromprocurement(){
        
        $title = "Procurement Request :: PENDING PROCUREMENT CHEQUES";
       
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 5 || $getApprovalLevel == 3) {
            $this->load->model('primary');
            $getallresult = $this->primary->getonlyprocurement();
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['getallresult' => $getallresult, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('alltravelrequest', $values);
        }
    }
    
    
    
    
    
    public function procurementall(){
      
        $title = "Procurement Request :: PENDING CHEQUES PAYMENTS";
       
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 5 || $getApprovalLevel == 3) {
            $getallresult = $this->generalmd->getdresult("*", "cash_newrequestdb", "from_app_id", "3");
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['getallresult' => $getallresult, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('alltravelrequest', $values);
        }
        
        
    }
    
    
    
     public function numberofdays(){
       $this->load->model('primary');
        $title = "1 - 30 days :: PENDING CHEQUES PAYMENTS";
       
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 5 || $getApprovalLevel == 3) {
            $getallresult = $this->primary->onetothrithydays();
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['getallresult' => $getallresult, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('alltravelrequest', $values);
        }
        
        
    }
    
    
    public function thirtytosixtydays(){
       $this->load->model('primary');
        $title = "30 - 60 days :: PENDING CHEQUES PAYMENTS";
       
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 5 || $getApprovalLevel == 3) {
            $getallresult = $this->primary->thirtyonetosixtydays();
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['getallresult' => $getallresult, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('alltravelrequest', $values);
        }
        
        
    }
    
    
    
    
    public function onetwentydays(){
       $this->load->model('primary');
        $title = "61 - 120 days :: PENDING CHEQUES PAYMENTS";
       
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 5 || $getApprovalLevel == 3) {
            $getallresult = $this->primary->sixtyonetoonetwenty();
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['getallresult' => $getallresult, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('alltravelrequest', $values);
        }
        
        
    }
    
    
    
    public function abovesixmonth(){
        
        $this->load->model('primary');
        $title = "Above 6(Six) Months :: PENDING CHEQUES PAYMENTS";
       
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 5 || $getApprovalLevel == 3) {
            $getallresult = $this->primary->abovesixmonths();
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['getallresult' => $getallresult, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('alltravelrequest', $values);
        }
    }
    
    
    
    
    public function oneyear(){
        
        $this->load->model('primary');
        $title = "One(1) Year :: PENDING CHEQUES PAYMENTS";
       
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 5 || $getApprovalLevel == 3) {
            $getallresult = $this->primary->oneyear();
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['getallresult' => $getallresult, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('alltravelrequest', $values);
        }
    }
    
    

}

// End of Class Home
