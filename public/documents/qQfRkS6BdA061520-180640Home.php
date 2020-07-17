<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
require_once (dirname(__FILE__) . "/Maincontroller.php");

class Home extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();


        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        //$this->load->model("datatablemodels"); 
        $this->gen->checkLogin();
        
        $this->gen->mainSetting();
        $this->load->model('maintenance');
    }

    public function index() {
        //$this->load->driver('cache');
        //$this->cache->clean();

        //$this->output->cache(0);

        $title = "EXPENSE PRO :: HOMEPAGE";
        
        $this->load->library('pagination');
        $columns = array("id", "sageRef", "cashiers", "dateCreated", "hod", "CurrencyType", "ndescriptOfitem", "partPay", 
            "nPayment", "dAmount", "icus", "dCashierwhopaid", "refID_edited", "dateRegistered", "approvals", "sessionID", "dUnit",
            "md5_id", "apprequestID", "CurrencyType", "from_app_id", "dCashierwhorejected", "dICUwhorejectedrequest", "dICUwhoapproved");
        $getTotalCount = $this->generalmd->count_with_where_nocolumn_name("cash_newrequestdb", "sessionID", $this->session->email);

        $config = [];
        $config['base_url'] = base_url() . 'home/index';
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
        //columns_specific_result($table_name, $limit, $offset, $column_name, $type, $type2 = "")
        $data = $this->generalmd->columns_specific_resultother("cash_newrequestdb", $config['per_page'], $page, $columns, $this->session->email);
        //print_r($data);
        $dataLink = $this->pagination->create_links();
        
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        //Get second level approval ID
        $getLevelApprove = $this->users->getSecondlevelapproval($_SESSION['id']);

        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'paginationLinks'=>$dataLink, 'getLevelApprove' => $getLevelApprove, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails,  'getallresult' => $data, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('home', $values);
    }

    ////////////////////////////////////////////START OF INDEX2 WITH SERVER SIDE PROGRAMMING //////////////////////////////

    public function homeindex() {
        $title = "EXPENSE PRO :: HOMEPAGE";

        //$get all Reesult 
        $getallresult = $this->mainlocation->getdetailsofrequestwithsession($_SESSION['email']);

        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        //Get second level approval ID
        $getLevelApprove = $this->users->getSecondlevelapproval($_SESSION['id']);

        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getLevelApprove' => $getLevelApprove, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('indexofhome/homeseverside', $values);
    }


    
    
    //////////////////////////////////////////////END OF INDEX 2 WITH SERVER SIDE PROGRAMMING/////////////////////////////       
    public function newrequest() {
        $allact = "";
        $title = "Expense Pro :: NEW REQUEST";
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        
        $sessemail = $_SESSION['email'];
        //Get the Unit the user belongs to
        $userUnit = $this->generalmd->getuserAssetLocation("dUnit", "cash_usersetup", "email", $sessemail);
               
        $getallaccounts = $this->generalmd->getaccountcodefromdb("unitaccountcode", "unit", $userUnit);
        
        //$getallaccounts = $this->mainlocation->getallaccounts();
        $this->gen->mainSetting();
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
        //$getCurrencies = $this->generalmd->getdresultfromprocure("*", "currencies", "", "");
        $getCurrencies = $this->generalmd->getdresult("*", "currencytype", "", "");
         //////////////////////VENDORS FROM MAINTENANCE PORTAL ////////////////////////////
          $allVendors = "";
        
        //$getVendors = $this->generalmd->getdresultfromprocure("*", "vendors", "", "");
        $getallvendors =  $this->maintenance->fromaintenance("*", "maintenance_workshop", "unitID", $userUnit);
        if ($getallvendors) {
               
                foreach ($getallvendors as $get) {
                    $mainID = $get->id;
                    $wkName = $get->workshop_name;
                    $allVendors .= "<option  value='$mainID'>$wkName</option>";
                }
                //return $allact;
            }
         //////////////////////END OF VENDORS FROM MAINTENANCE PORTAL ////////////////////////////
        
        
        $values = ['title' => $title, 'myvendors'=>$allVendors, 'getCurrencies'=>$getCurrencies, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer, 'fillSelect' => $allact];
        $this->load->view('newrequestpettypro', $values);
        //$this->load->view('newrequest', $values);
    }

    public function myapproval() {
      
        ini_set('max_execution_time', 0); 
        $this->load->driver('cache');
        $this->cache->clean();
        $this->output->cache(0);
        $this->load->model('primary');
        $title = "Petty Cash :: MY APPROVAL";
        $getallresult = "";
        //$get all Reesult 
        //$getallresult = $this->mainlocation->getallresultfromnewrequest();
        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
        //$getHeadICU = $this->adminmodel->getHODICUpriv($_SESSION['id']);   //$getHeadICU == $_SESSION['id']

        $getHeadICU = $this->adminmodel->getdICUHead();


        $getAccessRegister = $this->gen->haveAccess($_SESSION['id'], $getHeadICU);

        $gethotelResult = "";
        if ($getApprovalLevel == 6) { // This is HOD
            //$old = ini_set('memory_limit', '8192M'); 
            $getallresult = $this->mainlocation->getallresultfromnewrequest();
        } else if ($getApprovalLevel == 1) { // This is USer
            $getallresult = $this->mainlocation->getmydetailsenttome($mySessionEmail);
        } else if ($getApprovalLevel == 2) { // This is HOD
            $getallresult = $this->mainlocation->getmydetailsenttome($mySessionEmail);
            $gethotelResult = $this->generalmd->getresultwithand("*", " travel_hotel_bookings", "hod", $this->session->email, 
                    "status", '6');
        } else if ($getApprovalLevel == 3 && $getAccessRegister == TRUE) {
            $gethotelResult = "";
            //$getallresult = $this->mainlocation->getallfromicutogetgoing(); 
            $getallresult = $this->mainlocation->getallfromicutogetgoingicuhead($_SESSION['email']);
        } else if ($getApprovalLevel == 3) { // This is ICU
            $geticuID = $this->adminmodel->getuserID($mySessionEmail);
            //$getallresult = $this->mainlocation->geticuapproval($getApprovalLevel); //getallfromicutogetgoing
            $getallresultfromthisfirst = $this->mainlocation->getallfromicutogetgoing();
            
            if ($getallresultfromthisfirst) {

                foreach ($getallresultfromthisfirst as $get) {
                    $icus = $get->icus;

                    $checkgroupfromresult = $this->mainlocation->icugroupdisplay($icus);
                    //var_dump($checkgroupfromresult);

                    $kaboom = explode(",", $checkgroupfromresult);

                    if (in_array($geticuID, $kaboom)) {

                        $getallresult = $this->mainlocation->icuusercanaccessit($icus);
                        //var_dump($getallresult);
                    }
                } // End of foreach($getallresultfromthisfirst as $get){
            }
            $gethotelResult = "";
            //$gethotelResult = $this->primary->getdresult("*", " travel_hotel_bookings", "status", '7');
        } else if ($getApprovalLevel == 4) { // This is Cashier
            $gethotelResult = "";
            $getallresult = $this->mainlocation->getaccoutpayment($mySessionEmail);
          
        } else if ($getApprovalLevel == 5) { // This is Admin
            //$getallresult = $this->adminmodel->getadminonly();
            $getallresult = $this->mainlocation->getmydetailsenttome($mySessionEmail);
        } else if ($getApprovalLevel == 7) { // This is accountant
            //Return the ID of the accoutant
            $getAccountID = $this->adminmodel->getuserID($mySessionEmail);

            //get all the groups accoutn from the datatbase
            $getallgroupdaccount = $this->mainlocation->getmainaccount();

            //var_dump($getallgroupdaccount);
            if ($getallgroupdaccount) {
                foreach ($getallgroupdaccount as $get) {
                    $dAccountgroup = $get->dAccountgroup;

                    //Use the result to check if the userid is in the array
                    $checkcash_groupaccount = $this->mainlocation->cashgroup($dAccountgroup);

                    $kaboom = explode(",", $checkcash_groupaccount);

                    if (in_array($getAccountID, $kaboom)) {

                        $getallresult = $this->mainlocation->getaccountresult($dAccountgroup);
                        //var_dump($getallresult);
                    }
                }
            }
        } else {
            $getallresult = "";
        }

        
        /* FOR MD AN CFO ONLY */
        $CFOMD_RESULT = "";
        $cfo = $this->generalmd->getsinglecolumn("userID", "cash_accesslevel", "id", 9);
        $md = $this->generalmd->getsinglecolumn("userID", "cash_accesslevel", "id", 10);
      
        if($_SESSION['id'] == $cfo){
            $CFOMD_RESULT = $this->generalmd->getdresult("*", "cash_newrequestdb", "approvals", 14);
        }else if($_SESSION['id'] == $md){
            $CFOMD_RESULT = $this->generalmd->getdresult("*", "cash_newrequestdb", "approvals", 13);
        }
        /* END OF FOR MD AND CFO ONLY */
        
        $totalCostAll = 0;
       
        /* BUDGETING SECTION */
        $yearlyBudget = $this->generalmd->alltimeyearBudget($this->session->dUnit, date('Y'));
        $monthlyBudget = $this->generalmd->withthreevaluesresult("*", "unitaccountcode_budget_setup", "unit", $this->session->dUnit, 'month', date('m'), 'year', date('Y'));
        
        //ONLY SUM
         $monthlyExpeneSum = $this->generalmd->monthlyBudgetExpenseNairaonlySum($this->session->dUnit, date('Y'), date('m'));
         $monthlyExpeneSumOtherCurrency = $this->generalmd->monthlyBudgetExpenseOthersonlySum($this->session->dUnit, date('Y'), date('m'));
            
         
        $monthlyBudgetExpense = $this->generalmd->monthlyBudgetExpenseNaira($this->session->dUnit, date('Y'), date('m'));
        $monthlyBudgetExpenseOthers = $this->generalmd->monthlyBudgetExpenseOthers($this->session->dUnit, date('Y'), date('m'));
        
        $yearExpenseNaira = $this->generalmd->yearlyExpenseNaira($this->session->dUnit, date('Y'));
        $yearExpenseOtherCurrency = $this->generalmd->yearlyExpenseOtherCurrency($this->session->dUnit, date('Y'));
        /* END OF BUDGETING SECTION */
         
        $totalCostAll = (int)$monthlyExpeneSum + (int)$monthlyExpeneSumOtherCurrency;
        $totalYearExpense = $yearExpenseNaira + $yearExpenseOtherCurrency;
        $myUnit = $this->session->dUnit;
        
        //Quotation Access
        $divMD = "";
        $ajaxurl = "";
        $quotationAccessMD = $this->gen->check_menu_access(14);
        $quotationAccessED = $this->gen->check_menu_access(15);
        $quotationAccessAGM = $this->gen->check_menu_access(18);
        $quotationAccessSUPPLYCHAIN = $this->gen->check_menu_access(19);
        $quotationAccessEDMARINE = $this->gen->check_menu_access(20);
        if($quotationAccessMD == true){
            $divMD = "<div class='col-md-12'>
	                        <div class='card'>
	                            <div class='card-header' data-background-color='purple'>
	                                <h4 class='title'>QUOTATION AWAITING APPROVAL</h4>
	                                <p class='category'>Quotation from Procurement Portal awaiting approval</p>
	                            </div>
                               
                                    <div class='card-content table-responsive table-bordered'>
                                        <div class='pogeneration'></div>
                                       
                                    </div>
                                </div>
                          </div>";
            $ajaxurl = "https://c-iprocure.com/scp/api/quote/readmd.php";
        }else if($quotationAccessED == true){
             $divMD = "<div class='col-md-12'>
	                        <div class='card'>
	                            <div class='card-header' data-background-color='purple'>
	                                <h4 class='title'>QUOTATION AWAITING APPROVAL</h4>
	                                <p class='category'>Quotation from Procurement Portal awaiting approval</p>
	                            </div>
                                    
                                    
                                    <div class='card-content table-responsive table-bordered'>
                                        <div class='pogeneration'></div>
                                       
                                    </div>
                                </div>
                          </div>";
            $ajaxurl = "https://c-iprocure.com/scp/api/quote/readed.php";
        }else if($quotationAccessAGM == true){ // I am HOD
            $divMD = "<div class='col-md-12'>
	                        <div class='card'>
	                            <div class='card-header' data-background-color='purple'>
	                                <h4 class='title'>QUOTATION AWAITING APPROVAL (AGM)</h4>
	                                <p class='category'>Quotation from Procurement Portal awaiting approval</p>
	                            </div>
                                    
                                    
                                    <div class='card-content table-responsive table-bordered'>
                                        <div class='pogeneration'></div>
                                       
                                    </div>
                                </div>
                          </div>";
            $ajaxurl = "https://c-iprocure.com/scp/api/quote/readagm.php"; 
        }else if($quotationAccessSUPPLYCHAIN == true){ // I am HOD
            $divMD = "<div class='col-md-12'>
	                        <div class='card'>
	                            <div class='card-header' data-background-color='purple'>
	                                <h4 class='title'>QUOTATION AWAITING APPROVAL (SUPLLY CHAIN)</h4>
	                                <p class='category'>Quotation from Procurement Portal awaiting approval</p>
	                            </div>
                                    
                                    
                                    <div class='card-content table-responsive table-bordered'>
                                        <div class='pogeneration'></div>
                                       
                                    </div>
                                </div>
                          </div>";
            $ajaxurl = "https://c-iprocure.com/scp/api/quote/readghscm.php"; 
        }else if($quotationAccessEDMARINE == true){
            $divMD = "<div class='col-md-12'>
	                        <div class='card'>
	                            <div class='card-header' data-background-color='purple'>
	                                <h4 class='title'>QUOTATION AWAITING APPROVAL (MARINE)</h4>
	                                <p class='category'>Quotation from Procurement Portal awaiting approval</p>
	                            </div>
                                    
                                    
                                    <div class='card-content table-responsive table-bordered'>
                                        <div class='pogeneration'></div>
                                       
                                    </div>
                                </div>
                          </div>";
            $ajaxurl = "https://c-iprocure.com/scp/api/quote/readedmarine.php"; 
        } 
            
            
        $quoteforhod = "";
         if($getApprovalLevel == 2){ // I am HOD
            $ajaxurls = "https://c-iprocure.com/scp/api/quote/readhod.php"; 
            
            $ch = curl_init();
            curl_setopt ($ch, CURLOPT_URL, $ajaxurls);
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
            $contents = curl_exec($ch);
            if (curl_errno($ch)) {
//                echo curl_error($ch);
//            echo "\n<br />";
//            $contents = '';
            }else{
                curl_close($ch);
            }
            
            //print_r($contents);
            $jsondecode = json_decode($contents, true);
            $content = $jsondecode["records"];
           
            $data = [];
            if($contents){
                 foreach($content as $get){
                   //echo $email = $get['hod']. "<br/>";
                    if($get['hod'] == $_SESSION['email']){
                        //$data['records'] =  $get['hod'];
                       // $data['records'] =  $get['batchid'];
                        $data['records'] = 
                            array(
                            'hod' => $get['hod'],
                            'batchid' => $get['batchid'],
                            'bidder' => $get['bidder'],
                            'names' => $get['names'],
                            'openmarket' => $get['openmarket'],
                            'subject' => $get['subject'],
                            'curr_abrev' => $get['curr_abrev'],
                            'total' => $get['total'],
                            'biddatetime' => $get['biddatetime'],
                            'reason' => $get['reason'],
                           'audit' => $get['audit'],
                            'status' => $get['status'],
                       );
                    }
                  
                }
               // print_r($data);
              $quoteforhod =  $data; // print_r($data);
            }
          
        } 
        /*
        if($getApprovalLevel == 2){ // I am HOD
            $ajaxurls = "https://c-iprocure.com/scp/api/quote/readhod.php"; 
            $json = file_get_contents($ajaxurls);
            
            $jsondecode = json_decode($json, true);
            $content = $jsondecode["records"];
            //print_r($json);
            //return;
            $data = [];
            if($json){
                foreach($content as $get){
                   //echo $email = $get['hod']. "<br/>";
                    if($get['hod'] == $_SESSION['email']){
                        //$data['records'] =  $get['hod'];
                       // $data['records'] =  $get['batchid'];
                        $data['records'] = 
                            array(
                            'hod' => $get['hod'],
                            'batchid' => $get['batchid'],
                            'bidder' => $get['bidder'],
                            'names' => $get['names'],
                            'openmarket' => $get['openmarket'],
                            'subject' => $get['subject'],
                            'curr_abrev' => $get['curr_abrev'],
                            'total' => $get['total'],
                            'biddatetime' => $get['biddatetime'],
                            'reason' => $get['reason'],
                           'audit' => $get['audit'],
                            'status' => $get['status'],
                       );
                    }
                  
                }
                
               $quoteforhod =  $data; // print_r($data);
            }
           
        } 
        */
        
        
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'quoteforhod' => $quoteforhod,   'md_url' => $ajaxurl, 'divMD' =>$divMD, 'myUnit' => $myUnit,  'totalYearExpense' => $totalYearExpense, 'totalCostAll' =>$totalCostAll, 'monthlyExpeneSumOtherCurrency' =>$monthlyExpeneSumOtherCurrency, 'monthlyExpeneSum'=>$monthlyExpeneSum,  'monthlyBudgetExpenseOthers' => $monthlyBudgetExpenseOthers,  "monthlyBudgetExpense" =>$monthlyBudgetExpense, "yearlyBudget" =>$yearlyBudget, "monthlyBudget" => $monthlyBudget,  "CFOMD_RESULT" => $CFOMD_RESULT, 'gethotelResult'=>$gethotelResult, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('myapprovalawaiting', $values);
    }

    public function requestforpayment($id="") {
        $title = "Petty Cash Pro :: CHEQUE SIGNING AND FINAL APPROVAL";
        $getallresult = "";
        //$get all Reesult 
        //$getallresult = $this->mainlocation->getallresultfromnewrequest();
        $mySessionEmail = $_SESSION['email'];
        $icusessionID = $_SESSION['id'];

        $myCashierApproval = $this->users->cashiersReimbursement();
        $whowillapproveICU = $this->gen->haveAccess($_SESSION['id'], $myCashierApproval);

        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
        $getUserids = $this->adminmodel->getuserID($_SESSION['email']);
        
         $sessionID = $this->session->id;
        $getmenuAccess = $this->generalmd->getsinglecolumn("userid", "main_menu", "id", $id);
        $checkAccess = Maincontroller::haveAccess($sessionID, $getmenuAccess);
        
        
       // if ($getApprovalLevel == 3 || $getApprovalLevel == 6 || $getApprovalLevel == 7 || $getApprovalLevel == 5 || $icusessionID = 242 || $icusessionID = 108) { // This is HOD
          
         if($id == ""){
             $this->load->view('noaccesstoview');
         }else if($checkAccess == TRUE){
            $getallresults = $this->mainlocation->getallchequeforsignature();
            if ($getallresults) {
                foreach ($getallresults as $get) {
                    $accountGroup = $get->accountGroup;

                    $getUserid = $this->mainlocation->cashgroup($accountGroup);
                    $nums = explode(',', $getUserid);
                    if (in_array($getUserids, $nums)) {
                        $getallresult = $this->mainlocation->getallresultwithingroup($accountGroup);
                    } else if (!in_array($getUserids, $nums) && $getApprovalLevel == 6 || $getApprovalLevel == 5 || $whowillapproveICU == TRUE) {
                        $getallresult = $this->mainlocation->getallchequeforsignature();
                    }
                }
            }

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('chequerequestapproval', $values);
        } else {
            $this->load->view('noaccesstoview');
        }
    }

    public function approvedbymeicu() {


        $title = "Petty Cash :: MY APPROVAL";
        $getallresult = "";
        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 3) {

            $getallresult = $this->mainlocation->getallicurequestandapprovedbyme($mySessionEmail);

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('myapprovedrequestbyicu', $values);
        } else {
            redirect(base_url());
        }
    }

    public function allicurequest() {


        $title = "Petty Cash :: ALL ICU REQUEST";
        $this->load->library('pagination');
        $getallresult = "";
        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        $columns = array("id", "sageRef", "dateCreated", "CurrencyType", "ndescriptOfitem", "partPay", "nPayment", "dAmount", "approvals", "sessionID", "dUnit", "dICUwhorejectedrequest", "dICUwhoapproved");
        $getTotalCount = $this->generalmd->count_with_where_nocolumn_name("cash_newrequestdb", "approvals", "3");

        $config = [];
        $config['base_url'] = base_url() . 'home/allicurequest';
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
        //columns_specific_result($table_name, $limit, $offset, $column_name, $type, $type2 = "")
        $data = $this->generalmd->columns_specific_result("cash_newrequestdb", $config['per_page'], $page, $columns, $type, $type2);
        //print_r($data);
        $dataLink = $this->pagination->create_links();
        //$getTotalCount = $this->generalmd->columns_specific_result("cash_newrequestdb", $columns, "dICUwhoapproved", "dICUwhorejectedrequest");


        if ($getApprovalLevel == 3 || $getApprovalLevel == 6) {

            //$getallresult = $this->mainlocation->getallicurequestawaitingorapproved();

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['getallresult' => $data, 'pageLink' => $dataLink, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('icuthisallrequest', $values);
        } else {
            $this->load->view('noaccesstoview');
        }
    }

    public function mysuperaccount() {

        $title = "Petty Cash Pro :: MY APPROVAL";

        //$get all Reesult 
        //$getallresult = $this->mainlocation->getallresultfromnewrequest();
        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
        if ($getApprovalLevel == 8 || $getApprovalLevel == 6 || $getApprovalLevel == 5) {

            $getResult = $this->mainlocation->getallgroups();
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getResult' => $getResult, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('superaccounting', $values);
        } else {
            redirect(base_url());
        }
    }

    public function cashiertill() {

        $title = "Expense Pro :: MY APPROVAL";

        //$get all Reesult 
        //$getallresult = $this->mainlocation->getallresultfromnewrequest();
        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
        if ($getApprovalLevel == 8 || $getApprovalLevel == 6) {

            $gettillrequest = $this->adminmodel->getapprovedcheques();
            //$gettillrequest = $this->adminmodel->getapprovedcheques($mySessionEmail); //For future reference

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'gettillrequest' => $gettillrequest, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('cashiertilling', $values);
        } else {
            redirect(base_url());
        }
    }

    public function cashierlimit() {

        $title = "Expense Pro :: MY APPROVAL";

        //$get all Reesult 
        //$getallresult = $this->mainlocation->getallresultfromnewrequest();
        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
        if ($getApprovalLevel == 6 || $getApprovalLevel == 5 || $_SESSION['id'] == 84) {

            $gettillrequest = $this->adminmodel->getcashierlimit();

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'gettillrequest' => $gettillrequest, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('cashierslimit', $values);
        } else {
            redirect(base_url());
        }
    }

    public function allcashiers() {
        $getprops = $this->adminmodel->getallcashiers();

        if (empty($getprops)) {
            $data = [];
        }// End of if
        else {
            foreach ($getprops as $get) {
                $id = $get->id;
                $email = $get->email;
                $fname = $get->fname;
                $lname = $get->lname;

                $data[] = ['id' => $id, 'email' => $email, 'fname' => $fname, 'lname' => $lname];
            }
        }// End of Else
        $json = ['ci' => $data];

        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    public function approvaldetails($id, $mdID) {
        //$this->load->model('maintenance');
        $sessionID = "";
        $hod = "";
        $cashiers = "";
        $title = "Petty Cash Pro :: APPROVAL DETAILS";
        $getApprovalLevelforaccess = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //TRAVEL START ADDED HERE 
        $this->load->model('travelmodel');

        $mySession = $_SESSION['email'];
        $whowillseeandapprove = $this->mainlocation->getdexactresultfromdbwaitingapproval($id, $mdID);
        if ($whowillseeandapprove) {
            foreach ($whowillseeandapprove as $get) {
                $approvals = $get->approvals;
                $hod = $get->hod;
                $cashiers = $get->cashiers;
                $icus = $get->icus;
                $dAccountgroup = $get->dAccountgroup;
                $sessionID = $get->sessionID;
                $nPayment = $get->nPayment;
            }
        }
        $this->load->model('primary');
        $accgroupPH = $this->cashiermodel->actgrouporthaourt() ? $this->cashiermodel->actgrouporthaourt() : "";
        $getuseridfromherePH = $this->gen->haveAccess($_SESSION['id'], $accgroupPH);

        $accgroupABJ = $this->cashiermodel->actgroupabuja() ? $this->cashiermodel->actgroupabuja() : "";
        $getuseridfromhereABJ = $this->gen->haveAccess($_SESSION['id'], $accgroupABJ);

        $accgroupMUSHIC = $this->cashiermodel->actgroupmushin() ? $this->cashiermodel->actgroupmushin() : "";
        $getuseridfromhereMUSHIC = $this->gen->haveAccess($_SESSION['id'], $accgroupMUSHIC);

        $accgroupADMINFLOAT = $this->cashiermodel->getadminfloat() ? $this->cashiermodel->getadminfloat() : "";
        $getuseridfromadmin = $this->gen->haveAccess($_SESSION['id'], $accgroupADMINFLOAT);
        
        
        
        if ($mySession == $sessionID || $mySession == $hod || $mySession == $cashiers ||
                $getApprovalLevelforaccess == 3 || $getApprovalLevelforaccess == 7 && $nPayment == '2' || $getApprovalLevelforaccess == 6 || $getuseridfromherePH || $getuseridfromhereABJ || $getuseridfromhereMUSHIC || $getuseridfromadmin) {
            //$get all Reesult 
            $getallresult = $this->mainlocation->getdexactresultfromdbwaitingapproval($id, $mdID);
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

            if ($getallresult != FALSE) {
                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title, 'getallresult' => $getallresult, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
                $this->load->view('myapprovaldetails', $values);
            } else {
                echo "<h5>You may not have access to view that request, or request may have been approved before. please contact IT Department</h5>";
            }
        } else {
            $this->load->view('noaccesstoview');
        }
    }

    public function report() {

        $title = "Expense Pro :: REPORT";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 4 || $getApprovalLevel == 3 || $getApprovalLevel == 6 || $getApprovalLevel == 5 || $getApprovalLevel == 8) {
            //$get all Reesult 
            //Get Session Details
            $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);


            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('reporttype', $values);
        } else {
            redirect(base_url());
        }
    }

    /////////////////////////BEGINNING OF MY TILL ///////////////////////////////////////
    public function mytill() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 4) {


            $title = "Expense Pro :: MY TILL";

            $getResult = $this->mainlocation->getnewrequestbycashier($_SESSION['email']);
            //var_dump($getResult);
            $sendTillName = $this->mainlocation->getdTillname($_SESSION['email']);

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sendTillName' => $sendTillName, 'getResult' => $getResult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('cashierstill', $values);
        } else {
            redirect(base_url());
        }
    }

    public function addcashierLimit() {
        $sessionEmail = $_SESSION["email"];
        $data = [];
        if (isset($_POST['chooseCashier']) && isset($_POST['cashierLimit']) && isset($_POST['tillName'])) {

            // Declaring put putting all variables in Values
            $chooseCashier = $this->input->post('chooseCashier', TRUE);
            $cashierLimit = $this->input->post('cashierLimit', TRUE);
            $tillType = $this->input->post('tillType', TRUE);
            $tillName = $this->input->post('tillName', TRUE);
            $tillName = str_replace(' ', '', $tillName);
            //Check if cashier is already in the database
            $checkCahsier = $this->adminmodel->checkCashier($chooseCashier, $tillType);

            //Use casier ID to return Email
            $getCashierEmail = $this->adminmodel->getCashierEmail($chooseCashier);

            //var_dump($checkCahsier);
            if ($chooseCashier == "" || $cashierLimit == "" || $tillName == "") {
                $data = ['errmsg' => 'Please enter a Cashier and add Limit'];  // Please make sure asset Name , Cost and Date purchased is not empty
            } else
            if ($checkCahsier == TRUE && $tillType == 'primary') {

                $data = ['errmsg' => 'Cashier is already has a primary till'];
            } else
            if ($checkCahsier == TRUE && $tillType == 'secondary') {

                $data = ['errmsg' => 'Cashier is already has a secondary till'];
            } else {

                $addRand = random_string('alnum', '6');
                $newtillName = $tillName . '_' . $addRand;
                // Insert into the Database;  $aCost, $fassetID, $refNo, $sessionID
                $addCasheir = $this->adminmodel->addCashier($newtillName, $chooseCashier, $getCashierEmail, $cashierLimit, $sessionEmail, $tillType);

                $data = ['msg' => 'Cashier Successfully Added']; // 'Asset is now Schedule for Maintenance.'
            }  // End of Else { 
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function paymentdetails() {
        $title = "Petty Cash Pro :: Account Details";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 7 || $getApprovalLevel == 8) {

            $getallresult = $this->adminmodel->getallpaymentdetail($_SESSION['email']);

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('paymentdetails', $values);
        } else {
            redirect(base_url());
        }
    }

    public function cashiersallUsers() {

        $title = "Expense Pro :: MY APPROVAL";

        //$get all Reesult 
        //$getallresult = $this->mainlocation->getallresultfromnewrequest();
        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
        if ($getApprovalLevel == 8 || $getApprovalLevel == 6) {

            $getallResult = $this->adminmodel->getallcashiers();
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getallResult' => $getallResult, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('allcashiersuser', $values);
        } else {
            redirect(base_url());
        }
    }

    public function dviewcashierstransaction($email) {

        $title = "Petty Cash Pro :: MY APPROVAL";

        //$get all Reesult 
        //$getallresult = $this->mainlocation->getallresultfromnewrequest();
        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
        if ($getApprovalLevel == 8 || $getApprovalLevel == 6 || $getApprovalLevel == 5 || $_SESSION['id'] == 84) {

            $getallResult = $this->mainlocation->dcashiersdetailsfromsuperaccount($email);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getallResult' => $getallResult, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('allviewalltransaction', $values);
        } else {
            redirect(base_url());
        }
    }

    public function getalltheaccountantingrou($ids) {


        $title = "Petty Cash Pro :: MY APPROVAL";

        //$get all Reesult 
        //$getallresult = $this->mainlocation->getallresultfromnewrequest();
        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
        if ($getApprovalLevel == 8 || $getApprovalLevel == 6 || $getApprovalLevel == 5) {

            $urlids = $ids;
            // $ids = explode(",", $ids);
            //Get the IDs and 
            /*    foreach($ids as $key => $value) {

              $allSelected[] = $value;

              $getusersingroup = $this->adminmodel->getuseridprocess($value);

              }
             */
            $getResult = $this->mainlocation->getallgroups();
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'urlids' => $urlids, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('allaccountatndetails', $values);
        } else {
            redirect(base_url());
        }
    }

    public function forsuperaccountanteditcashier($id) {
        $title = "Expense Pro :: MY APPROVAL";

        //$get all Reesult 
        //$getallresult = $this->mainlocation->getallresultfromnewrequest();
        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
        if ($getApprovalLevel == 8 || $getApprovalLevel == 6 || $getApprovalLevel == 5 || $_SESSION['id'] == 84) {

            $gettillrequest = $this->adminmodel->getresultofcashiers($id);

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'gettillrequest' => $gettillrequest, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('cashiertilldetails', $values);
        } else {
            redirect(base_url());
        }
    }

    ////////////////////////////////////////////////MY SECONDARY TILL ///////////////////////////////////////////////////////////////////
    /////////////////////////BEGINNING OF MY TILL ///////////////////////////////////////
    public function secondarytill() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 4) {


            $title = "Petty Cash Pro :: SECONDARY TILL";

            $getResult = $this->mainlocation->getnewrequestbycashiersecondary($_SESSION['email']);

            $sendTillName = $this->mainlocation->getdTillnameforsecondary($_SESSION['email']);

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sendTillName' => $sendTillName, 'getResult' => $getResult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('secondarycashierstill', $values);
        } else {
            redirect(base_url());
        }
    }

    ///////////////////////////////////////////////// END OF SCEONDARY TILL ///////////////////////////////////////////////

    public function viewmyrequest($id) {
        $getallresult = $this->mainlocation->getdexactresultfromdb($id);
        $getEmail = strtolower($this->adminmodel->maderequestbyme($id));
        if ($getEmail != strtolower($_SESSION['email'])) {
            redirect(base_url());
        } else {
            $title = "Petty Cash Pro - View Details :: HOMEPAGE";

            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

            $useidtogetname = $this->mainlocation->descriptionofitem($id);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'useidtogetname' => $useidtogetname, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('viewrequestdetails', $values);
        }
    }

    public function editejectedrequest($id = "", $mdid = "", $approvals = "") {

        $checkApproval = $approvals;
        $whichApp = @$this->generalmd->getsinglecolumn("apprequestID", "cash_newrequestdb", "id", $id);
        if ($checkApproval != 5 && $checkApproval != 6 && $checkApproval != 12) {
            //if ($checkApproval != 5 || $checkApproval != 6 || $checkApproval != 12) {
            echo "You cannot perform that operation. You request needs to be rejected before you can edit it.";
        } //else if ($whichApp != "" ) {
            //echo "You cannot edit this request please visit The Application you used in raising the request"; }
         else {

            $getallresult = $this->mainlocation->editrejectedrequest($id, $mdid, $checkApproval);
            $getEmail = $this->adminmodel->maderequestbyme($id);
            if ($getallresult == "" || $getallresult == FALSE || $getEmail !== $_SESSION['email']) {
                redirect(base_url());
            } else {
                $title = "Petty Cash Pro - Edit Details :: HOMEPAGE";

                $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

                $useidtogetname = $this->mainlocation->descriptionofitem($id);

                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'useidtogetname' => $useidtogetname, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
                $this->load->view('editrejectedrequestfinal', $values);
            }
        }
    }

    public function hodapprovalrequest() {
        $title = "Expense Pro :: HOMEPAGE";


        //$get all Reesult 
        $getallresult = $this->mainlocation->approvedrequestbyhod($_SESSION['email']);

        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 2 || $getApprovalLevel == 5 || $getApprovalLevel == 6) {

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('allhodrequest', $values);
        } else {
            redirect(base_url());
        }
    }

    public function myexpensesprimarytill() {

        $title = "Petty Cash Pro:: My Primary Till Expenses";
        //$get all Reesult 
        $getallresult = $this->mainlocation->getallrequestfrommyprimaytill($_SESSION['email']);

        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 4) {

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('myexpensesprimarytill', $values);
        } else {
            redirect(base_url());
        }
    }

    public function myexpensessecondarytill() {
        $title = "Expense Pro :: HOMEPAGE";


        //$get all Reesult 
        $getallresult = $this->mainlocation->getallrequestfrommysecondarytill($_SESSION['email']);

        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 4) {

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('myexpensesprimarytill', $values);
        } else {
            redirect(base_url());
        }
    }

    public function printoutcheques() {
        $title = "Petty Cash :: MY APPROVAL";
        $getallresult = "";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 4 || $getApprovalLevel == 6 || $getApprovalLevel == 7 || $getApprovalLevel == 8 || $getApprovalLevel == 5) {

            if ($getApprovalLevel == 4) {
                $getallresult = $this->mainlocation->thecashierwhoistopay($_SESSION['email']);
            } else if ($getApprovalLevel == 7) {
                $getAccountID = $this->adminmodel->getuserID($_SESSION['email']);
                //get all the groups accoutn from the datatbase
                $getallgroupdaccount = $this->mainlocation->getmainaccount();

                //var_dump($getallgroupdaccount);
                if ($getallgroupdaccount) {
                    foreach ($getallgroupdaccount as $get) {
                        $dAccountgroup = $get->dAccountgroup;

                        //Use the result to check if the userid is in the array
                        $checkcash_groupaccount = $this->mainlocation->cashgroup($dAccountgroup);

                        $kaboom = explode(",", $checkcash_groupaccount);

                        if (in_array($getAccountID, $kaboom)) {

                            $getallresult = $this->mainlocation->allchequesforprintout($dAccountgroup);
                            //var_dump($getallresult);
                        }
                    }
                }
            } else if ($getApprovalLevel == 8 || $getApprovalLevel == 6) {
                $getallresult = $this->mainlocation->thecashierwhoapprovebyadmin();
            } else {
                $getallresult = "";
            }

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('readyforprinting', $values);
        } else {
            redirect(base_url());
        }
    }

    public function allcheques() {

        $this->load->library('pagination');
        $title = "Petty Cash Pro :: ALL CHEQUES";
        //$getTotalCount = $this->generalmd->count_with_where_nocolumn_name("cash_newrequestdb","nPayment", "2");
        $getTotalCount = $this->generalmd->count_with_where_nocolumn_name("account_payable", "type", "cheque");

        $config = [];
        $config['base_url'] = base_url() . 'home/allcheques';
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
        $data = $this->generalmd->fetch("account_payable", $config['per_page'], $page, "type", "cheque");
        $dataLink = $this->pagination->create_links();

        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 7 || $getApprovalLevel == 6) {

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $mainsearchform = $this->load->view('mainsearchform', '', TRUE);
            $values = ['getallresult' => $data, 'mainsearchform'=>$mainsearchform, 'pageLink' => $dataLink, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('allchequesrequest', $values);
        }
    }

    public function searchcheque() {
        $title = "Petty Cash Pro :: ALL CHEQUES";
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $search = $this->input->post('search', TRUE);

        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $dataLink = "";
        if (isset($search) && !empty($search)) {
            $data = $this->generalmd->search_result("account_payable", $search);
            $values = ['getallresult' => $data, 'pageLink' => $dataLink, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('allchequesrequest', $values);
        } else {
            redirect('home/allcheques');
        }
    }

    public function generatebankstatement() {

        $title = "EXPENSE PRO :: BANK STATEMENT";

        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 8) {

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('generateBankstatement', $values);
        } else {
            echo "You do not have permission to view this page";
        }
    }

    public function getthebanksyouwanttoprint($dbanknumber) {

        $title = "EXPENSE PRO :: BANK STATEMENT";
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $getUserLocation = $this->users->getLocationEmail($_SESSION['email']);

        //$get all Reesult 
        $getallresult = $this->mainlocation->getallchequeswithzeroapproval($dbanknumber, $getUserLocation);


        if ($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 8) {


            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('dchequesuwanttoprint.php', $values);
        } else {
            echo "You do not have permission to view this page";
        }
    }

    public function getStatementresulet($generateStatement) {

        $title = "EXPENSE PRO :: BANK STATEMENT";

        //$get all Reesult 
        $getallresult = $this->mainlocation->getallchequeswithzeroapproval($generateStatement, $_SESSION['email']);

        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 8) {

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('generateStatementforBank', $values);
        } else {
            echo "You do not have permission to view this page";
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function myrequest() {


        $title = "Petty Cash Pro :: MY APPROVAL";

        //$get all Reesult 
        //$getallresult = $this->mainlocation->getallresultfromnewrequest();
        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
        if ($getApprovalLevel == 4) {

            //$getallresult = $this->mainlocation->getallrequeastforreimbursement($mySessionEmail);
            $getallresult = $this->mainlocation->getchequerequestbycashier($mySessionEmail);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('pendingmyreimbursement', $values);
        } else {

            redirect(base_url());
        }
    }

    public function viewmyrequestforeimbursement($id) {


        $title = "EXPENSE PRO :: MY CASH REIMBURSEMENT";

        //$get all Reesult 
        //$getallresult = $this->mainlocation->getallresultfromnewrequest();
        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
        if ($getApprovalLevel == 4 || $getApprovalLevel == 7 || $getApprovalLevel == 8 || $getApprovalLevel == 6) {

            //$getallresult = $this->mainlocation->getallrequeastforreimbursement($mySessionEmail);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'ids' => $id, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('pendingmyreimbursementviewrequest', $values);
        } else {

            redirect(base_url());
        }
    }

    public function sendtoaccountbycashier($id) {


        $title = "EXPENSE PRO :: MY CASH REIMBURSEMENT";

        //$get all Reesult 
        //$getallresult = $this->mainlocation->getallresultfromnewrequest();
        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 4) {

            $getallresult = $this->mainlocation->getidresultfromchequedb($id);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getallresult' => $getallresult, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('sendchequetoaccount', $values);
        } else {

            redirect(base_url());
        }
    }

    public function allgeneratebankstatement() {

        $title = "EXPENSE PRO :: ALL BANK STATEMENT";

        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 6) {


            //$get all Reesult 
            $getallresult = $this->mainlocation->getallcheques();

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('bankstatementall', $values);
        } else {
            echo "You do not have permission to view this page";
        }
    }

    public function preparenewcheque($id, $approval, $group) {
        $title = "MONEY BOOK PRO :: CHEQUE PREPARATION";
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        //var_dump($getChequeresult);
        if ($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 8) {


            //Get result from the database
            $getChequeresult = $this->mainlocation->getdetailsofcheque($id, $approval, $group);
            if ($getChequeresult) {
                foreach ($getChequeresult as $get) {
                    $newid = $get->id;
                    $approval = $get->approvals;
                    $dAmount = $get->dAmount;
                    $dAccountgroup = $get->dAccountgroup;
                }
                if ($approval == 3) {
                    $menu = $this->load->view('menu', '', TRUE);
                    $sidebar = $this->load->view('sidebar', '', TRUE);
                    $footer = $this->load->view('footer', '', TRUE);
                    $values = ['title' => $title, 'getChequeresult' => $getChequeresult, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
                    $this->load->view('preparechequeforsigning.php', $values);
                } else {
                    echo "Please wait for other approvals to be completed";
                }
            } else {
                echo "You can't change the url, Please see the administrator";
            }
        } else {
            echo "You do not have permission to view this page";
        }
    }

    public function allpartpayments() {
         ini_set('max_execution_time', 0); 
         $this->load->driver('cache');
        $this->cache->clean();
        $this->output->cache(0);
        
        $title = "MONEY BOOK PRO :: CHEQUE PART PAYMENT";
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $sessionID = $_SESSION['email'];

        $checkforaccess = $this->generalmd->getsinglecolumn("userIds", "access_gen", "id", "11");
        $whichAcess = $this->gen->haveAccess($_SESSION['id'], $checkforaccess);

        if ($getApprovalLevel == 6 || $whichAcess == TRUE) {

            //GET you location.
            $getmyLocation = $this->generalmd->getsinglecolumn("uLocation", "cash_usersetup", "id", $_SESSION['id']);

            if ($getApprovalLevel == 7 && $whichAcess == TRUE) {

                $getallPartpayment = $this->mainlocation->allpartpayforadmin();
                //$getallPartpayment = $this->mainlocation->partpayforotherlocation($getmyLocation);
            } else if ($getApprovalLevel == 4 && $whichAcess == TRUE) {
                //Use your location to return all request
                $getallPartpayment = $this->mainlocation->partpayforotherlocation($getmyLocation);
            } else if ($getApprovalLevel == 6) {
                $getallPartpayment = $this->mainlocation->allpartpayforadmin();
                //$getallPartpayment = $this->mainlocation->partpayforotherlocation($getmyLocation);
            }



            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getallPartpayment' => $getallPartpayment, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('dpartpaymentsforaccounts', $values);
        } else {
            //redirect(base_url());
            $this->load->view('noaccesstoview');
        }
    }

    public function completepay($id, $amount, $email) {

        $title = "MONEY BOOK PRO :: CHEQUE PREPARATION";
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        //var_dump($getChequeresult);
        if ($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 4) {


            //Get result from the database
            //$getChequeresult = $this->mainlocation->getpartpaydetails($id, $amount, $email);
            $getChequeresult = $this->mainlocation->allaprtpaymentdetails($id, $amount);
            if ($getChequeresult) {
                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title, 'getChequeresult' => $getChequeresult, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
                $this->load->view('completehalfpayment', $values);
            } else {
                echo "No result found in our records";
            }
        } else {
            echo "You do not have permission to view this page";
        }
    }

    public function dblancetopay() {
        $data = [];
        if ($this->input->is_ajax_request()) {

            $newAmountopay = $this->input->post('newAmountopay', TRUE);
            $requestID = $this->input->post('requestID', TRUE);
            $paypaybalance = $this->input->post('paypaybalance', TRUE);
            $aAmount = $this->input->post('aAmount', TRUE);
            $userID = $this->input->post('userID', TRUE);
            $newChequeNo = $this->input->post('newChequeNo', TRUE);
            $newBank = $this->input->post('newBank', TRUE);
            $balancepay = $this->input->post('balancepay', TRUE);

            //Use the id to return the amount, partpay, dCashierwhopay, approvals
            $getDetails = $this->mainlocation->getdexactresultfromdb($requestID);
            if ($getDetails) {
                foreach ($getDetails as $get) {
                    $dAmount = $get->dAmount;
                    $partPay = $get->partPay;
                    $approvals = $get->approvals;
                    $dCashierwhopaid = $get->dCashierwhopaid;

                    //Do programming login, continues
                    $newBalance = $partPay + $newAmountopay;
                    $dUserID = $this->adminmodel->getuserID($_SESSION['email']);
                }

                if ($newAmountopay > $balancepay) {
                    $data = ['warr' => 'You cannot post amount greater than than the balance<br/>'];
                } else if ($paypaybalance !== $partPay) {
                    //Do programming login, continues
                    $data = ['warr' => 'You need to see the administrator, Balances do not agree in our database<br/>'];
                } else if ($newBalance > $dAmount) {
                    $data = ['warr' => 'You cannot post that amount please check your balance.<br/>'];
                } else {
                    $sessionEmail = $_SESSION['email'];
                    $randNum = random_string('alnum', 15);
                    //Use the New balance to update various tables new_request{{MAIN TABLE}}
                    $updatenewrequest = $this->mainlocation->newrequestpaytable($requestID, $newBalance, $dUserID, $newBank, $newChequeNo, $sessionEmail, $newAmountopay, $randNum);

                    //uSE THE SAME VALUES TO UPDATE account_payable table in a transaction SQL
                    //Now use the Same table to inser values into partpayment table and complete the transaction SQL
                    if ($updatenewrequest !== FALSE) {
                        $data = ['msg' => 'Payment Successfully Made, Please wait...<br/>'];
                    }
                }
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function viewreqeuestdetails($id, $approval) {
        $title = "MONEY BOOK PRO :: CHEQUE PREPARATION";

        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 5 || $getApprovalLevel == 3 || $getApprovalLevel == 4 || $getApprovalLevel == 7 || $getApprovalLevel == 2 || $getApprovalLevel == 1 || $getApprovalLevel == 6 || $getApprovalLevel == 8) {

            $getChequeresult = $this->mainlocation->getnewreaultforallview($id, $approval);

            if ($getChequeresult) {
                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title, 'getChequeresult' => $getChequeresult, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
                $this->load->view('viewalldetails', $values);
            } else {
                echo "No result found in our records";
            }
        } else {
            echo "You do not have permission to view this page";
        }
    }

    public function govementlevies() {
        echo "Page Coming Soon";
    }

    public function csvUploadingnow() {

        $data = [];

        //validate whether uploaded file is a csv file
        $checkCsvType = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

        //Checks to see if the file is set and uploaded
        if (!empty($_FILES['file']["name"]) && in_array($_FILES['file']['type'], $checkCsvType)) {


            if (is_uploaded_file($_FILES["file"]["tmp_name"]) && $_FILES["file"]["size"] > 0) {


                //Open uploaded csv file in read only mode
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

                //skip first line
                fgetcsv($csvFile);


                //parse data from csv file line by line
                while (($row = fgetcsv($csvFile, 1000, ",")) !== FALSE) {


                    $insertingAllitems = $this->allresult->uploadaccounts($row[0], $row[1]);
                    //uploadfurniturefittingsnocode($AssetName, $type, $category, $location, $department, $PurchaseDate,  $effDate, $assetCost, $statusApproval, $sessID)

                    if ($insertingAllitems) {
                        //close opened csv file
                        $data = ['status' => 2, 'msg' => 'Assets Successfully Uploaded']; // Item Succesfully Uploaded;
                    } else {

                        $data = ['status' => 3, 'msg' => 'Error Uploading Content, Please Check your internet']; // Error Uploading Content. Please make sure the items are not more than 100,000 per upload 
                    }
                } // End of While Loop parsing File

                fclose($csvFile);
            } // End of If the File is Uploaded if($filename=$_FILES["file"]["tmp_name"]){

            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } // End of  if(isset($_FILES['file']["name"])){
        else {
            $data = ['status' => 1, 'msg' => 'Please upload a valid CSV file']; // Not a Valid CSV File
        } // Not a CSV File 
    }

    public function loadform() {
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('loadimportform', $values);
    }

    public function allapprovedrequest() {

        $title = "MONEY BOOK Pro :: HOMEPAGE";
        //$get all Reesult 
        //$getallresult = $this->mainlocation->getdetailsofrequestwithsession($_SESSION['email']);
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        $getallresult = $this->allresult->myallrequest($_SESSION['email']);

        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('approvedrequest', $values);
    }

    public function myawaitingapprovalpending() {

        $title = "MONEY BOOK Pro :: HOMEPAGE";
        //$get all Reesult 
        //$getallresult = $this->mainlocation->getdetailsofrequestwithsession($_SESSION['email']);
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        $getallresult = $this->allresult->pendingrequest($_SESSION['email']);
        // $getallresult2 = $this->allresult->icurejectallmypending($_SESSION['email']);

        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('awaitingapprovalicuhod', $values);
    }

    public function cancelrejected() {

        $title = "MONEY BOOK Pro :: HOMEPAGE";
        //$get all Reesult 
        //$getallresult = $this->mainlocation->getdetailsofrequestwithsession($_SESSION['email']);
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        $getallresult = $this->allresult->cancelledrequest($_SESSION['email']);
        // $getallresult2 = $this->allresult->icurejectallmypending($_SESSION['email']);

        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('cancelledrequest', $values);
    }

    public function myapprovalads() {

        $title = "Petty Cash :: MY APPROVAL";
        $getallresult = "";

        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 6) { // This is HOD
            $getallresult = $this->mainlocation->getmydetailsenttome($mySessionEmail);
             $gethotelResult = "";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'gethotelResult'=>$gethotelResult, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('myapprovalawaiting', $values);
        } else {
            redirect(base_url());
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function accountsummary($id) {


        $title = "Petty Cash Pro :: SUMMARY";

        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 4) {

            //$getallresult = $this->mainlocation->getallrequeastforreimbursement($mySessionEmail);
            $getallresult = $this->mainlocation->getfrequestid($mySessionEmail, $id);

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'id' => $id, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('accountsummary', $values);
        } else {

            redirect(base_url());
        }
    }

    public function mypaymentcode() {
        $sessionEmail = $_SESSION["email"];
        $data = [];
        if (isset($_POST['reqid'])) {

            // Declaring put putting all variables in Values
            $reqid = $this->input->post('reqid', TRUE);

            //var_dump($checkCahsier);
            if ($reqid == "") {
                $data = ['errmsg' => 'Important variable to process request is missing. See Administrator'];  // Please make sure asset Name , Cost and Date purchased is not empty
            } else {

                //Use ID and Session Email to get Payment Code
                $getPaymentCode = $this->adminmodel->getmypaymentcode($reqid, $sessionEmail);
                $getDescription = $this->mainlocation->descriptionofitem($reqid);
                $getAmount = $this->cashiermodel->getdAmountfromUser($reqid);
                if ($getPaymentCode != "") {

                    $messageicu = "<p>Your Payment Code is $getPaymentCode </p>";
                    $messageicu .= " with the following description $getDescription";
                    $messageicu .= " and $getAmount";
                    $messageicu .= "<hr/>";

                    $messageicu .= "<br/>&copy; C & I Leasing PLC, 2017";

                    $config = array(
                        'mailtype' => "html",
                    );

                    $this->email->initialize($config);
                    $this->email->from("expensepro@c-iprocure.com", 'TBS EXPENSE PRO');
                    $this->email->to($sessionEmail);
                    $this->email->subject('YOUR PAYMENT CODE');
                    $this->email->message($messageicu);
                    $this->email->send();
                }else{
                    //Generate New Payment Code
                    $getPaymentCode = generateRandomCode(4, 15);
                    //Update the Record
                    $updateCode = $this->generalmd->paymentCode($getPaymentCode, $reqid);
                }
                $data = ['msg' => "Your Payment Code is <span style='color:red; font-size:30; font-weight:bolder; background-color:lightblue'>$getPaymentCode</span>"]; // 'Asset is now Schedule for Maintenance.'
            }  // End of Else { 
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    ///////////////////////////////////TEST TO BE DELETED LATER FOR ALL CHEQUE IF NOT WORKING //////////////////////// 
    public function datatables() {
        $title = "Petty Cash Pro :: ALL CHEQUES";


        //$get all Reesult 
        $getallresult = $this->mainlocation->getallcheques();
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 8 || $getApprovalLevel == 5) {

            $getpaidBy = $this->datatablemodels->getfullusers();


            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getpaidBy' => $getpaidBy, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('allchequesrequest2', $values);
        } else {
            echo "You do have have access to view this page. Please contact Administrator";
        }
    }

    public function chequeall() {
        $fetch_data = $this->datatablemodels->makeDatabase();

        $data = [];
        $randomString = random_string('alnum', 60);
        foreach ($fetch_data as $row) {
            $sub_array = array();

            $sub_array[] = $row->datePaid;
            $sub_array[] = $this->accounting->descriptionofitema($row->fmrequestID);
            $sub_array[] = $row->Amount;
            //$sub_array[] = $row->requesterEmail;
            $sub_array[] = $row->paidTo;
            $sub_array[] = $row->paidByAcct;
            $tillName = $row->tillName;
            $approvals = $this->mainlocation->returnformrequest($row->fmrequestID);
            //$sub_array[] =  "<a href='".base_url()."home/viewreqeuestdetails/$row->fmrequestID'><button class='btn btn-xs btn-facebook'>View</button></a>";
            //$approvals = $this->mainlocation->returnformrequest($row->fmrequestID);
            /* $sub_array[] = $row->tillName;
              $sub_array[] = $row->mergedPy;
              $sub_array[] = $row->paidByAcct;
              $sub_array[] = $this->mainlocation->returnformrequest($row->fmrequestID);
              $sub_array[] = $row->id; */

            if ($tillName == "") {
                $sub_array[] = "<a href='" . base_url() . "home/viewreqeuestdetails/$row->fmrequestID/$approvals/$randomString'><button class='btn btn-xs btn-facebook'>View</button></a>";
            } else if ($row->mergedPy === "merged" && $tillName == "") {
                $sub_array[] = "<a href='" . base_url() . "home/viewmyrequestforeimbursement/$row->fmrequestID/$approvals/$randomString'><button class='btn btn-xs btn-facebook'>Open</button></a>";
            } else {
                $sub_array[] = "<a href='" . base_url() . "home/viewmyrequestforeimbursement/$row->fmrequestID/$approvals/$randomString'><button class='btn btn-xs btn-facebook'>View</button></a>";
            }


            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->datatablemodels->getAll_data(),
            "recordsFiltered" => $this->datatablemodels->get_data_filtered(),
            "data" => $data
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    ///////////////////////////////////TEST TO BE DELETED LATER FOR ALL CHEQUE IF NOT WORKING //////////////////////// 
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function sagepost($id, $requesterEmail) {
        $title = "Petty Cash Pro :: SAGE POST";

        $mySessionEmail = $_SESSION['email'];
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 4) {

            $getallresult = $this->mainlocation->getfrequestid($mySessionEmail, $id);

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'id' => $id, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('sagepost', $values);
        } else if ($getApprovalLevel == 6) {
            $getallresult = $this->mainlocation->getfrequestid($requesterEmail, $id);

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'id' => $id, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('sagepost', $values);
        } else {

            redirect(base_url());
        }
    }

    public function searchchequebyicu() {
        $title = "Petty Cash Pro :: ALL CHEQUES";
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $search = $this->input->post('addsearch', TRUE);

        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $dataLink = "";
        if (isset($search) && !empty($search)) {
            $data = $this->generalmd->search_result_byicu("cash_newrequestdb", $search);
            $values = ['getallresult' => $data, 'pageLink' => $dataLink, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('icuthisallrequest', $values);
        } else {
            redirect('home/allicurequest');
        }
    }

    public function advancedit($id = "") {
        $title = "PALL REQUEST";
        //Get Session Details
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 6) {

            $getallresult = $this->generalmd->getdresult("*", "cash_newrequestdb", "id", $id);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('adancedit', $values);
        } else {
            $this->load->view("noaccesstoview");
        }
    }

    public function advancepackedit() {
        $data = [];
        if ($this->input->is_ajax_request()) {

            $dateCreated = $this->input->post('dateCreated', TRUE);
            $descItem = $this->db->escape_str($this->input->post('descItem', TRUE));
            $benName = $this->db->escape_str($this->input->post('benName', TRUE));
            $dUnit = $this->input->post('dUnit', TRUE);
            $paymentType = $this->input->post('paymentType', TRUE);
            $dComment = $this->db->escape_str($this->input->post('dComment', TRUE));
            $dhod = $this->input->post('dhod', TRUE);
            $dCurrencyType = $this->input->post('dCurrencyType', TRUE);
            $hideID = $this->input->post('hideID', TRUE);

            $dcashier = $this->input->post('dcashier', TRUE) ? $this->input->post('dcashier', TRUE) : "";
            $daccountant = $this->input->post('daccountant', TRUE) ? $this->input->post('daccountant', TRUE) : "";

            $datarray = [];
            $datarray['dateCreated'] = $dateCreated;

            $datarray['ndescriptOfitem'] = $descItem;
            $datarray['benName'] = $benName;
            $datarray['dUnit'] = $dUnit;
            $datarray['nPayment'] = $paymentType;
            $datarray['requesterComment'] = $dComment;
            $datarray['hod'] = $dhod;

            if ($paymentType == 1) {
                $datarray['cashiers'] = $dcashier;
            } else {
                $datarray['dAccountgroup'] = $daccountant;
            }

            $options = array(
                'table' => 'cash_newrequestdb',
                'data' => $datarray
            );

            $getapprovals = $this->generalmd->getsinglecolumn("approvals", "cash_newrequestdb", "id", $hideID);
            if ($getapprovals == 4 || $getapprovals == 8) {
                $data = ['status' => 0, 'msg' => 'You Cannot Edit That Request, Check the Status'];
            } else {
                $saveDate = $this->generalmd->update("id", $hideID, $options);

                $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
                if ($getApprovalLevel != 6) {
                    $mysession = $_SESSION['email'];
                    $updatedBy = "<b>Updated Fields : </b>" . $dateCreated . " " . $descItem . " " . $benName . " " . $dComment . " " . $dhod . " " . $dcashier . " " . $dCurrencyType . " " . $daccountant;
                    $createdby = "<hr/>Update By $mysession, time: " . date('Y-m-d H:i:s') . "<br>" . $updatedBy;
                    $updateAuditTrail = $this->mainlocation->updatedupdatetrail($updatedBy, $createdby, $hideID);
                }

                $data = ['status' => 1, 'msg' => 'Request Successfully Sent, Please wait you will be redirected'];
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
     public function makemysessionsearch() {
        $title = "Petty Cash Pro :: ALL CHEQUES";
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $search = $this->input->post('addsearch', TRUE);

        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $dataLink = "";
        if (isset($search) && !empty($search)) {
             
            $data = $this->generalmd->mysessionsearch("cash_newrequestdb", $search, "sessionID", $this->session->email);
            
            $values = ['getallresult' => $data, 'pageLink' => $dataLink, 'title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('indexofhome/homepagesearch', $values);
        } else {
            redirect('home');
        }
    }
    
    
    
    
    public function pushcontentatback(){
         $data = [];
        if(isset($_POST['dChequeBack']) && isset($_POST['chequeID'])){
            
            $dChequeBack = $this->input->post('dChequeBack', TRUE);
            $chequeID = nl2br($this->input->post('chequeID', TRUE));
            
            //Update the Cheque back
            $updateColumn = $this->generalmd->updateTableCol("account_payable", "chequeBack", $dChequeBack, "fmrequestID", $chequeID);
            if($updateColumn){
               $data = ["status" => 200];  
            }
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    
    public function printerback($id){
        if ($id == "") {
            echo "Important Variables Missing, Please try again";
        } else {

            $getChequeBack = $this->generalmd->getsinglecolumn("chequeBack", "account_payable", "fmrequestID", $id);
           
            //Get Details of the ID
            $value = ['chqBack' => $getChequeBack];
            $this->load->view('checkbookback', $value);
        }
    
        
    }


    public function updatepayeetoanother(){
        $data = [];
        if(isset($_POST['payeeL'])){
            
            $payeeL = $this->input->post('payeeL', TRUE);
            $requestID = $this->input->post('requestID', TRUE);
            //Update the Cheque back
            $updateColumn = $this->generalmd->updateTableCol("cash_newrequestdb", "benName", $payeeL, "id", $requestID);
            $updateColumn2 = $this->generalmd->updateTableCol("account_payable", "paidTo", $payeeL, "fmrequestID", $requestID);

            if($updateColumn2){
               $data = ["status" => 200];  
            }
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    
    public function mergedcheck(){
      
       // if(isset($_POST['checkmerge'])){
           
            $checkmerge = $this->input->post('checkmerge');
            if($checkmerge){
              
                $getFirst = $checkmerge[0];
                $adExplode = implode(",", $checkmerge);
                $thechequeSum = $this->allresult->mergingCheque($adExplode);
               
               //$adExplode = explode(",", $checkmerge);
              /* foreach($checkmerge as $key => $value){
                   //Use the ID to loop through and return the amount
                   echo $value;
                   echo "<br/>";
                  
               } */
                
              //Use the first array to return the result
              $getBank = $this->generalmd->getsinglecolumn("dBank", "account_payable", "id", $getFirst);
              $payeeName = $this->generalmd->getsinglecolumn("paidTo", "account_payable", "id", $getFirst);

              //Insert into merged table
              $datarray = [];
              $datarray['acount_payable_ids'] = $adExplode;
              $datarray['acount_payable_sumTotal'] = $thechequeSum;
              $datarray['acount_payable_bank'] = $getBank;
               $datarray['payee_or_bank'] = $payeeName;
              $datarray['acount_payable_date'] = date('Y-m-d H:i:s');
              $datarray['acount_payable_status'] = 0;
              $datarray['acount_payable_mergedBy'] = $this->session->id;
              
              $options = array(
			'table' => 'cheque_merged',
			'data'  => $datarray
		   );

               $insertedFileId = $this->generalmd->create( $options );
                   
               $update_account_payable = $this->allresult->updateaccountpaymentcheque($adExplode);
                  
                   
              $data = ["result"=>$thechequeSum, "mainID" =>$insertedFileId];
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        
       // }
     
    }

    
    
    
    public function mergedCheckd($mergedID){
        $title = "EXPENSE PRO :: BANK STATEMENT";
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $getUserLocation = $this->users->getLocationEmail($_SESSION['email']);

        //$get all Reesult 
        //$getallresult = $this->generalmd->getdresult("*", "cheque_merged", "id", $mergedID);
        $getallresult = $this->allresult->mergedwithand("*", "cheque_merged", "id", $mergedID, "acount_payable_status", 0);

        if ($getApprovalLevel == 7 || $getApprovalLevel == 6) {
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $getallresult, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('mergedChecked', $values);
        } else {
            echo "You do not have permission to view this page";
        }
    }
    
    
    
    
     public function pushcontentatbackformergecheque(){
         $data = [];
        if(isset($_POST['dChequeBack']) && isset($_POST['chequeID'])){
            
            $dChequeBack = $this->input->post('dChequeBack', TRUE);
            $chequeID = nl2br($this->input->post('chequeID', TRUE));
            
            //Update the Cheque back
            $updateColumn = $this->generalmd->updateTableCol("cheque_merged", "chequeBack", $dChequeBack, "id", $chequeID);
            if($updateColumn){
               $data = ["status" => 200];  
            }
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    public function printerbackmerge($id){
        if ($id == "") {
            echo "Important Variables Missing, Please try again";
        } else {

            $getChequeBack = $this->generalmd->getsinglecolumn("chequeBack", "cheque_merged", "id", $id);
           
            $update_account_payable = $this->allresult->mergeCheck($mergedID);
        
            //Get Details of the ID
            $value = ['chqBack' => $getChequeBack];
            $this->load->view('checkbookback', $value);
        }
    
        
    }
 
    
    
    public function changedbank(){
        
        $data = [];
        if(isset($_POST['id'])){
            
            $mainID = $this->input->post('id', TRUE);
            $getChequeBack = $this->generalmd->getsinglecolumn("acount_payable_bank", "cheque_merged", "id", $mainID);
           
            $getactualbankName = $this->adminmodel->getBankName($getChequeBack);
            $updateColumn = $this->generalmd->updateTableCol("cheque_merged", "payee_or_bank", $getactualbankName, "id", $mainID);
            if($updateColumn){
               $data = ["status" => 200];  
            }
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    public function rejectquoteforprocurement(){
       
        $data = [];
        if(isset($_POST['id'])){
            $session = $_SESSION['email'];
            $quoteID = $this->input->post('id', TRUE);
            $reason = "Quotation Rejection From Expensepro";
            
            $updateQuote = $this->generalmd->rejectquotation(3, $session, $reason, $quoteID);
            if($updateQuote){
               $data = ["status" => 200, "msg" => "Quote Successfully Rejected"];  
            }
        }
      
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    public function approvequotation(){
        //md, wisdom, alex =  2
        //AGM, HOD  = 1 
        //Group HEAD Supply Chain =4
        
        
      $data = [];
        if(isset($_POST['id'])){
            $session = $_SESSION['email'];
            $quoteID = $this->input->post('id', TRUE);
            $reason = "Quotation Approved From Expensepro";
            
            $quotationAccessMD = $this->gen->check_menu_access(14);
            $quotationAccessED = $this->gen->check_menu_access(15);
            $quotationAccessAGM = $this->gen->check_menu_access(18);
            $quotationAccessEDMARINE = $this->gen->check_menu_access(20);
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $quotationAccessSUPPLYCHAIN = $this->gen->check_menu_access(19);
            if($quotationAccessMD == true){
                 $updateQuote = $this->generalmd->approvequotation(2, $session, $reason, $quoteID);  //
            }else if($quotationAccessED == true){
                 $updateQuote = $this->generalmd->approvequotation(2, $session, $reason, $quoteID);  //
            }else if($quotationAccessEDMARINE == true){
                 $updateQuote = $this->generalmd->approvequotation(2, $session, $reason, $quoteID);  
            }else if($quotationAccessSUPPLYCHAIN == true){
                 $updateQuote = $this->generalmd->approvequotationsupplychain(4, $session, $reason, $quoteID);  //
            }else if($getApprovalLevel == 2 || $quotationAccessAGM == true){
                 $updateQuote = $this->generalmd->approvequotationhod(1, $session, $reason, $quoteID);  //
            }
           
            if($updateQuote){
               $data = ["status" => 200, "msg" => "Quote Successfully Approved"];  
            }
        }
      
        $this->output->set_content_type('application/json')->set_output(json_encode($data));  
    }
    
    
    
}

// End of Class Home
