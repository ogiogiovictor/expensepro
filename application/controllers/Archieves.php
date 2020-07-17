<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
require_once (dirname(__FILE__) . "/Maincontroller.php");

class Archieves extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();

        $this->load->model('archievesmodel');
        $this->load->model('maintenance');
        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        $this->gen->checkLogin();

        $putNewSession = $this->users->checkUserSession($_SESSION['email']);
        if ($putNewSession === FALSE) {
            redirect("https://c-iprocure.com/moneybook/nopriveledge");
        }
    }

    public function index($id="") {
        $title = "Petty Cash Pro :: ALL REQUEST";

        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        //$ITsupports = $this->cashiermodel->getitsupport() ? $this->cashiermodel->getitsupport() : "";
        //$ifcheckITSUPPORT = $this->gen->haveAccess($_SESSION['id'], $ITsupports);
         $sessionID = $this->session->id;
        $getmenuAccess = $this->generalmd->getsinglecolumn("userid", "main_menu", "id", $id);
        $checkAccess = Maincontroller::haveAccess($sessionID, $getmenuAccess);

        //if ($getApprovalLevel == 5 || $getApprovalLevel == 6 || $getApprovalLevel == 7 || $getApprovalLevel == 3 || $ifcheckITSUPPORT == TRUE) {
        if($id == ""){
            $this->load->view('noaccesstoview');
        }else if($checkAccess == TRUE){
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('archieverequest', $values);
        } else {
            $this->load->view('noaccesstoview');
        }
    }

    public function allarchievesrequest() {
        
                 
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $fetch_data = $this->archievesmodel->makeDatabase();
        $apprequestID = "";
        $getNumber = "";
        $data = [];
        $randomString = random_string('alnum', 60);
        foreach ($fetch_data as $row) {
            $sub_array = array();
            
            if($row->from_app_id == '3'){
              $apprequestID = explode(",", $row->apprequestID);
              $getNumber = $this->archievesmodel->getponumber($apprequestID[0]);
            }
            $sageRef = $row->sageRef != '' ? "<small style='color:red'> VENDOR: " .$row->sageRef. "</small>" :  '';
            $ipoNumber = $getNumber != '' ? "<small style='color:red'> PO NUMBER: " .$getNumber. "</small>" :  '';
            $sub_array[] = $row->id;
            //$sub_array[] = $row->dateCreated. "<br/>". "<span class='badge badge-danger'>".get_timeago(strtotime($row->dateCreated)) ."</span>";
            $sub_array[] = $row->dateCreated;
            $sub_array[] = $this->adminmodel->getUsername($row->sessionID);
            $sub_array[] = "<span style='color:blue'>" . $row->ndescriptOfitem . "</span><br>". $sageRef. "<br> <b>". $ipoNumber. "</b>";

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

                if ($CurrencyType != "") {
                    $newCurrency = @$this->generalmd->getsinglecolumnfromotherdb("curr_symbol", "currencies", "curr_abrev", $CurrencyType);
                } else if ($CurrencyType == "null" || $CurrencyType == "") {
                    $newCurrency = '<span>&#8358;</span>';
                } else {
                    $newCurrency = '<span>&#8358;</span>';
                }
            }

            $from_app_id = $row->from_app_id;

            $sub_array[] = $newCurrency . @number_format($row->dAmount, 2);
            
            
          /*  if($from_app_id == '3'){
                $sub_array[] = $this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "USER_ID", $row->benName);
            }else if($from_app_id == '0' && is_numeric($row->benName)){
                $sub_array[] = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $row->benName);
            }else if($from_app_id == '0' && !is_numeric($row->benName)){
                $sub_array[] =  $row->benName;
            }else if($from_app_id == '5'){
                $sub_array[] = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $row->benName);
            }else if($from_app_id == '6'){
                $sub_array[] = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $row->benName);
            }else if($from_app_id == '8'){
                 $sub_array[] = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $row->benName);
            }else{
                $sub_array[] =  $row->benName;
           }
           * 
           */
            
          
            if ($from_app_id == 3 || $from_app_id == '3') {
                $sub_array[] = @$this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "USER_ID", $row->benName);
            }else if($from_app_id == 8){
                 $sub_array[] = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $row->benName);
            }else if($from_app_id == '0' && is_numeric($row->benName)){
                $sub_array[] = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $row->benName);
            }else if($from_app_id == '0' && !is_numeric($row->benName)){
                $sub_array[] =  $row->benName;
            }else {
                $sub_array[] = $row->benName;
            }
           
            
            
            $approvals = $row->approvals;
            $md5_id = $row->md5_id;


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
            }else if ($approvals == 13) {
                $sub_array[] = "<span style='color:brown'>With MD</span>";
            }else if ($approvals == 14) {
                $sub_array[] = "<span style='color:brown'>With ED/CFO</span>";
            }else if ($approvals == 15) {
                $sub_array[] = "<span style='color:brown'>Requesting Additional Info</span>";
            }



            $sub_array[] = "<a href='" . base_url() . "home/viewreqeuestdetails/$row->id/$approvals/$randomString'><button title='Full Details' class='btn btn-xs btn-facebook'>V</button></a>";
            if ($getApprovalLevel == 6) {
                $sub_array[] = "<a href='" . base_url() . "home/approvaldetails/$row->id/$md5_id/$randomString'><button title='Request Details' class='btn btn-xs btn-danger'>R</button></a>";
                $sub_array[] = "<a href='" . base_url() . "home/advancedit/$row->id/$md5_id/$randomString'><button title='Request Details' class='btn btn-xs btn-success'>E</button>"
                        . "&nbsp;</a><a href='" . base_url() . "API/Settings/forecedelete/$row->id/$md5_id'><button title='Delete' class='btn btn-xs btn-primary'>D</button></a>";
                //$sub_array[] = "";
            } else if($sessionID == 75){
                
               $sub_array[] = "<a href='" . base_url() . "home/advancedit/$row->id/$md5_id/$randomString'><button title='Request Details' class='btn btn-xs btn-success'>E</button>";
               $sub_array[] = "<a href=''></a>";
             //   $sub_array[] = "<a href=''></a>";
              //  $sub_array[] = "<a href=''></a>";
               
            }else{
                $sub_array[] = "<a href=''></a>";
                $sub_array[] = "<a href=''></a>";
              //  $sub_array[] = "<a href=''></a>";
               // $sub_array[] = "<a href=''></a>";
            }

            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->archievesmodel->getAll_data(),
            "recordsFiltered" => $this->archievesmodel->get_data_filtered(),
            "data" => $data
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function closedrequest($id) {


        // if(!$id){
        // redirect(base_url());   
        // }else{
        $title = "Petty Cash Pro :: APPROVAL DETAILS";

        //$get all Reesult 
        $getallresult = $this->mainlocation->closedresult($id);
        if ($getallresult != FALSE) {
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('closedetails', $values);
        } else {
            echo "<h3>No such item exist in our Record</h3>";
        }
    }

}

// End of Class Home
