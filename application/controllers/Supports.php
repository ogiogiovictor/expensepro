<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
require_once (dirname(__FILE__) . "/Maincontroller.php");
//require_once('PHPMailerAutoload.php');
class Supports extends CI_Controller {

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

    public function getphenugu($id="") {
      

        $this->load->library('pagination');
        
        $title = "EXPENSE PRO :: HOMEPAGE";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
       
        $sessionID = $this->session->id;
        $getmenuAccess = $this->generalmd->getsinglecolumn("userid", "main_menu", "id", $id);
        $checkAccess = Maincontroller::haveAccess($sessionID, $getmenuAccess);
        
         if($id == ""){
             $this->load->view('noaccesstoview');
         }else if($checkAccess == TRUE){
           $totalCount = $this->generalmd->totalenuguphresult();
          
           foreach($totalCount as $count){
               $dcount = $count->dCount;
           }
          
            
              $columns = array("id", "sageRef", "cashiers", "dateCreated", "hod", "CurrencyType", "ndescriptOfitem", "partPay", 
            "nPayment", "dAmount", "icus", "dCashierwhopaid", "refID_edited", "dateRegistered", "approvals", "sessionID", "dUnit",
            "md5_id", "apprequestID", "CurrencyType", "from_app_id", "dLocation", "addComment", "benName", "fullname", "dCashierwhorejected", "dICUwhorejectedrequest", "dICUwhoapproved");
        //$getTotalCount = $this->generalmd->count_with_where_nocolumn_name("cash_newrequestdb", "sessionID", $this->session->email);
             // $getTotalCount = count($getallresult);
        $config = [];
        $config['base_url'] = base_url() . 'support/getphenugu/4';
        $config['total_rows'] = $dcount;
        $config['per_page'] = 5;
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
        
        $data = $this->generalmd->columsfromph("cash_newrequestdb", $config['per_page'], $page, $columns);
        //print_r($data);
        $dataLink = $this->pagination->create_links();
        
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            //'getallresult' => $getallresult,
            $values = ['title' => $title, 'getallresult' => $data, 'paginationLinks'=>$dataLink, 'getApprovalLevel' => $getApprovalLevel, 'ifcheckITSUPPORT'=>$checkAccess,  'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            //$this->load->view('support/supportrequest', $values);
             $this->load->view('support/ph-enugu', $values);
        } else {
            $this->load->view('noaccesstoview');
        }
    }
    
    

    public function mydraftrequest() {

        $title = "MONEY BOOK Pro :: HOMEPAGE";
        //$get all Reesult 
        //$getallresult = $this->mainlocation->getdetailsofrequestwithsession($_SESSION['email']);
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        $getallresult = $this->cashiermodel->draftreport($_SESSION['email']);

        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('mydraftrequestonly', $values);
    }

    public function hodreport($id="") {

        $title = "Expense Pro :: REPORT";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $sessionID = $this->session->id;
         $getmenuAccess = $this->generalmd->getsinglecolumn("userid", "main_menu", "id", $id);
        $checkAccess = Maincontroller::haveAccess($sessionID, $getmenuAccess);
        if ($checkAccess == TRUE) {

            //Use email to return Unit

            $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);

            $getmyLocation = $this->cashiermodel->getmyLocation($_SESSION['email']);

            //$totalunitresult = $this->cashiermodel->getdresult($getmyUnit);
            $totalunitresult = $this->cashiermodel->unitcount($getmyUnit);
           // $getCount = count($totalunitresult);

            $dTotal = $this->cashiermodel->getTotoalAmount($getmyUnit);
            
            $getrejectCountnow = "";

            $getUnitName = $this->mainlocation->getdunit($getmyUnit);

            //Get all approved Request based on the Unit
            $getapprovedCount = $this->cashiermodel->getapprovedrequest($getmyUnit);
            $getapprovingCount = count($getapprovedCount);
            
            //Get all approved Request based on the Unitawaiting request
            $getawaitingrequest = $this->cashiermodel->awaitingrequest($getmyUnit);
            $awaitingCount = count($getawaitingrequest);
            
            //Get all approved Request based on the Unit
             $getrejectedCount = $this->cashiermodel->getrejectedrequest($getmyUnit);
            
            if($getrejectCountnow !== ""){
            $getrejectCountnow = count($getrejectedCount);
            }else{
              $getrejectCountnow = "0";  
            }

            //Check same Unit but not same location
            $getotherLocation = $this->cashiermodel->getsameunitbutnotlocation($getmyUnit, $getmyLocation);
            $locationcount = count($getotherLocation);

            $getfourresults = $this->cashiermodel->limitedresults($getmyUnit);

            $getallStaffinmyUnit = $this->cashiermodel->getallStaffinUnit($getmyUnit);

            $getallLocationwhereunitisprocurement = $this->cashiermodel->getourlocation();

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getmyLocation'=>$getmyLocation,  'awaitingCount'=>$awaitingCount, 'getmyUnit'=>$getmyUnit, 'dTotal' => $dTotal, 'getallLocationwhereunitisprocurement' => $getallLocationwhereunitisprocurement, 'getallStaffinmyUnit' => $getallStaffinmyUnit, 'getfourresults' => $getfourresults, 'locationcount' => $locationcount, 'getapprovingCount' => $getapprovingCount, 'getapprovedCount' => $getapprovedCount, 'getrejectCountnow' => $getrejectCountnow, 'getUnitName' => $getUnitName, 'getCount' => $getCount, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('hodreportdashboard', $values);
        } else {
             $this->load->view('noaccesstoview');
            //redirect(base_url());
        }
    }

    // End of Main Search Category
    public function gethodreportfordepartment() {

        if (empty($_POST['dateCreatedfrom']) || empty($_POST['dateCreatedTo']) || empty($_POST['status'])) {
            echo "<script>alert('Please select all fields')</script>";
            redirect('supports/hodreport', 'refresh');
        } else {
            //if (isset($_POST['catStartDate']) && isset($_POST['catEndDate']) && isset($_POST['status']) ) {

            $dateCreatedfrom = $this->input->post('dateCreatedfrom', TRUE);
            $dateCreatedTo = $this->input->post('dateCreatedTo', TRUE);
            $status = $this->input->post('status', TRUE);
            $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
            
            $this->load->library("excel");
            $object = new PHPExcel();

            $object->setActiveSheetIndex(0);
            $table_columns = array("Request Title", "Requester", "Location", "Unit", "Amount", "Payee Name", "Status", "Paid By");

            $column = 0;

            foreach ($table_columns as $field) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
            }
            
             if ($status == '1') {
                    // 1, 2, 3 for pending request 
                    $employee_data = $this->cashiermodel->getsearchResulthod($getmyUnit, $dateCreatedfrom, $dateCreatedTo, $status);
                }else if($status == '4'){
                     // 4, 8 for Approved Request Cashier / Accountant
                    $employee_data = $this->cashiermodel->getcashieraccountapproved($getmyUnit, $dateCreatedfrom, $dateCreatedTo, $status);
                }else if($status == '5'){
                     // 5, 6 Rejected
                    $employee_data = $this->cashiermodel->getrejectedrequestbyhod($getmyUnit, $dateCreatedfrom, $dateCreatedTo, $status);
                }else {
                    $employee_data = "";
                
                }

            //print_r($employee_data);
            $excel_row = 2;
            foreach ($employee_data as $row) {

                if ($row->approvals == 8 || $row->approvals == 4) {
                    $newStatus = "Approved";
                } else {
                    $newStatus = "";
                }
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->ndescriptOfitem);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $this->adminmodel->getUsername($row->sessionID));
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $this->mainlocation->getdlocation($row->dLocation));
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $this->mainlocation->getdunit($row->dUnit));
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->dAmount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->benName);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $newStatus);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->dCashierwhopaid);
                $excel_row++;
            }

//               $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
//               header('Content-Type: application/vnd.ms-excel');
//               header('Content-Disposition: attachment;filename="Employee Data.xls"');
//               $object_writer->save('php://output');
//               
            $object->setActiveSheetIndex(0);

            $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            // Sending headers to force the user to download the file
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="C&IReport_' . date('dMy') . '.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        }
    }

    public function getmoresearchresults() {
        $sessionID = $_SESSION['email'];
        $output = "";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if (isset($_POST['dateCreatedfrom']) && isset($_POST['dateCreatedTo']) && isset($_POST['status'])) {

            $dateCreatedfrom = $this->input->post('dateCreatedfrom', TRUE);
            $dateCreatedTo = $this->input->post('dateCreatedTo', TRUE);
            $status = $this->input->post('status', TRUE);
            $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
            if ($dateCreatedfrom !== "" && $dateCreatedTo !== "" && $status !== "") {

                if ($getApprovalLevel == 2 && $status == '1') {
                    // 1, 2, 3 for pending request 
                    $getresultfromCode = $this->cashiermodel->getsearchResulthod($getmyUnit, $dateCreatedfrom, $dateCreatedTo, $status);
                }else if($getApprovalLevel == 2 && $status == '4'){
                     // 4, 8 for Approved Request Cashier / Accountant
                    $getresultfromCode = $this->cashiermodel->getcashieraccountapproved($getmyUnit, $dateCreatedfrom, $dateCreatedTo, $status);
                }else if($getApprovalLevel == 2 && $status == '5'){
                     // 5, 6 Rejected
                    $getresultfromCode = $this->cashiermodel->getrejectedrequestbyhod($getmyUnit, $dateCreatedfrom, $dateCreatedTo, $status);
                }else {
                    $getresultfromCode = "";
                
                }
                   

                $output = '<table class="table table-striped" id="mydata">
                        <thead class="text-primary">
                        <th>Request Title</th><th>Unit</th><th>Amount</th><th>Status</th><th>Paid By</th>
                        </thead><tbody>';
                if ($getresultfromCode) {
                    $sumamount = 0;
                    foreach ($getresultfromCode as $get) {
                        $id = $get->id;
                        $ndescriptOfitem = $get->ndescriptOfitem;
                        $nPayment = $get->nPayment;
                        $approvals = $get->approvals;
                        $dAmount = $get->dAmount;
                        $dLocation = $get->dLocation;
                        $dUnit = $get->dUnit;
                        $cashiers = $get->cashiers;
                        $datepaid = $get->datepaid;
                        $benName = $get->benName;
                        $dCashierwhopaid = $get->dCashierwhopaid;

                        if ($approvals == 0) {
                            $newapproval = "Pending";
                        } else if ($approvals == 1) {
                            $newapproval = "<span style='color:red'>Awaiting HOD Approval</span>";
                        } else if ($approvals == 2) {
                            $newapproval = "<span style='color:blue'>Awaiting ICU Approval</span>";
                        } else if ($approvals == 3) {
                            $newapproval = "<span style='color:indigo'>Awaiting Payment</span>";
                        } else if ($approvals == 4) {
                            $newapproval = "<span style='color:green'>Ready for Collection</span>";
                        } else if ($approvals == 5) {
                            $newapproval = "<span style='color:red'>Not Approved By HOD</span>";
                        } else if ($approvals == 6) {
                            $newapproval = "<span style='color:grey'>Reject by ICU</span>";
                        } else if ($approvals == 7) {
                            $newapproval = "<span style='color:indigo'>Cheque Sent for Signature</span>";
                        } else if ($approvals == 8) {
                            $newapproval = "<span style='color:green'>Signed & Ready for Collection</span>";
                        } else if ($approvals == 11) {
                            $newapproval = "<span style='color:brown'>Closed</span>";
                        } else if ($approvals == 12) {
                            $newapproval = "<span style='color:brown'>Rejected By Accounts</span>";
                        }

                        if ($dAmount) {
                            $sumamount += $dAmount;
                        }

                        $output .= '<tr><td>' . $ndescriptOfitem . '</td><td>' . $this->mainlocation->getdunit($dUnit) . '</td><td>' . @number_format($dAmount) . '</td><td>' . $newapproval . '</td><td>' . $dCashierwhopaid . '</td></tr>';
                    }
                }



                $output .= '</tbody></table><div></div> ';
                

                echo $output;
                echo '<div><br/><b>Total : ' . @number_format($sumamount) . '</b><br/><small>Date Range: From: ' . $dateCreatedfrom . '  To:  ' . $dateCreatedTo . '</small></div>';
            }
        }
    }

    
    
    
      public function editcashier($id, $mdID, $sessionID){
          
          $title = "Expense Pro: Change Cashier";
          $getUserDetails = $this->cashiermodel->editcashiersonly($id, $mdID, $sessionID);
          $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
          
          if($getUserDetails){
              
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title,  'getResult'=> $getUserDetails, 'getApprovalLevel'=>$getApprovalLevel, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('changecashieronly', $values);
             
          }else{
              echo "You cannot perform that operation. Please contact IT Department Or ICU";
          }
        }
        
        
   
         public function updatedcashiersonly(){
            
            $data = [];
            if(isset($_POST['postID']) && isset($_POST['approveID']) && isset($_POST['sessionID']) ){
                
                $postID = $this->input->post('postID', TRUE);
                $approveID = $this->input->post('approveID', TRUE);
                $sessionID = $this->input->post('sessionID', TRUE);
                $changemycashier = $this->input->post('changemycashier', TRUE);
                
                $getapproveIDetails = $this->mainlocation->getuserapprovaldetails($postID, $sessionID);
                if($postID == "" || $approveID == ""){
                   $data = ['msgError' => 'Important variable to process request is missing, please Contact IT'];   
                }else if($getapproveIDetails == FALSE){
                   $data = ['msgError' => 'You can only change details if you request is awaiting approval or HOD has approved request'];  
                }else{
                   
                    //Run Update for the required filed only
                    $updatedrequest = $this->cashiermodel->updatemycashier($changemycashier, $postID, $sessionID);
                    $data = ['msg' => 'Request Successfully Updated. please wait while we sync data'];
                }
            }else{
               $data = ['msgError' => 'Error processing request, please try again later'];     
            }
            
              $this->output->set_content_type('application/json')->set_output(json_encode($data));
            
        }
        


  public function changelocation($id){
             $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
             
              $ITsupports = $this->cashiermodel->getitsupport() ? $this->cashiermodel->getitsupport() : "";
             $ifcheckITSUPPORT = $this->gen->haveAccess($_SESSION['id'], $ITsupports);
        
            if($getApprovalLevel == 6  || $ifcheckITSUPPORT){
            
            $title = "Expense Pro :: CHANGE LOCATION";
            
            $getResult = $this->mainlocation->getdexactresultfromdb($id);
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getResult'=>$getResult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('changetoanothotherlocationsupport', $values);
            
            }else{
                $this->load->view('noaccesstoview');
            }
        }

        
        
        
         public function editsupportcashier($id, $mdID, $sessionID){
          
          $title = "Expense Pro: Change Cashier";
          $getUserDetails = $this->cashiermodel->editcashiersonly($id, $mdID, $sessionID);
          $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
          
          if($getUserDetails){
              
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title,  'getResult'=> $getUserDetails, 'getApprovalLevel'=>$getApprovalLevel, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('changecashieronlysupport', $values);
             
          }else{
              echo "You cannot perform that operation. Please contact IT Department Or ICU";
          }
        }
        
   
        
        
        
       public function totoalrequestperunit() {

        $title = "EXPENSE PRO :: HOMEPAGE";
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        $getmyLocation = $this->cashiermodel->getmyLocation($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
             
        if ($getmyUnit && $getApprovalLevel == '2') {

            $totalunitresult = $this->cashiermodel->getdresult($getmyUnit);
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getmyUnit'=>$getmyUnit, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $totalunitresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('unit/totalunitrequest', $values);
        } else {
            $this->load->view('noaccesstoview');
        }
    }
    
    
    
    
     public function getapprovedrequest($unit="") {

        $title = "EXPENSE PRO :: HOMEPAGE";
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        $getmyLocation = $this->cashiermodel->getmyLocation($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
             
        if ($getmyUnit == $unit && $getApprovalLevel == '2' || $getApprovalLevel == '6' || $getApprovalLevel == '5') {

            //$totalunitresult = $this->cashiermodel->getdresult($getmyUnit);
            $totalunitresult = $this->cashiermodel->getTotoalAmount($unit);
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getmyUnit'=>$getmyUnit, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $totalunitresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('unit/approvedunitrequest', $values);
        } else {
            $this->load->view('noaccesstoview');
        }
    }
    
    
      public function requestperstaff($email) {

        $title = "EXPENSE PRO :: HOMEPAGE";
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        $getmyLocation = $this->cashiermodel->getmyLocation($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
             
        if ($getmyUnit) {

            //$totalunitresult = $this->cashiermodel->getdresult($getmyUnit);
            $totalunitresult = $this->cashiermodel->getallrequestforstaff($email, $getmyUnit);
            
            $approvedrequestonly = $this->cashiermodel->getallrequestforstaffthatareapproved($email, $getmyUnit);
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'approvedrequestonly'=>$approvedrequestonly, 'email'=>$email, 'getmyUnit'=>$getmyUnit, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $totalunitresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('unit/perstaff.php', $values);
        } else {
            $this->load->view('noaccesstoview');
        }
    }
    
   public function pendingrequestbyunit($unit) {

        $title = "EXPENSE PRO :: HOMEPAGE";
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        $getmyLocation = $this->cashiermodel->getmyLocation($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
             
        if ($getmyUnit && $getApprovalLevel == '2') {

            $totalunitresult = $this->cashiermodel->awaitingrequest($getmyUnit);
           
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getmyUnit'=>$getmyUnit, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $totalunitresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('unit/totalunitrequest', $values);
        } else {
            $this->load->view('noaccesstoview');
        }
    }  
       
    
  public function sameunitdifflocale($location, $unit) {

        $title = "EXPENSE PRO :: HOMEPAGE";
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        $getmyLocation = $this->cashiermodel->getmyLocation($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
             
        if ($getmyUnit) {

           $totalunitresult = $this->cashiermodel->getsameLocation($getmyUnit, $location);
           
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getmyUnit'=>$getmyUnit, 'getApprovalLevel' => $getApprovalLevel, 'getallresult' => $totalunitresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('unit/bylocation', $values);
        } else {
            $this->load->view('noaccesstoview');
        }
    }     
    
  
    
    
    
    
    
    
     public function icureportdesktop() {

        $title = "Expense Pro :: REPORT";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 3 || $getApprovalLevel == 6 || $getApprovalLevel == 5) {

             $getallUsers = $this->cashiermodel->getmyuserfulldetals();
             $getallUnits = $this->mainlocation->getallunit();
             $getallAccountcode = $this->cashiermodel->getallaccountcodesforsummary();
             
             $dYearonly = $this->cashiermodel->getamountbyyear();
             
             $dTotal = $this->cashiermodel->getallrequestfromunit();
             
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'dTotal'=>$dTotal, 'dYearonly'=>$dYearonly, 'getallAccountcode'=>$getallAccountcode, 'getallUnits'=>$getallUnits, 'getallUsers'=>$getallUsers, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('reports/icureportsheet', $values);
        } else {
             $this->load->view('noaccesstoview');
        }
    }
    
    
    
     public function getuserrequestdetails($email) {

        $title = "Expense Pro :: GRAPH REPORT";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 3 || $getApprovalLevel == 6 || $getApprovalLevel == 5) {

             $dTotal = $this->cashiermodel->getallmyrequstnow($email);
             
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'email'=>$email, 'myRequest'=>$dTotal, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('unit/allmytransaction', $values);
        } else {
             $this->load->view('noaccesstoview');
        }
    }
    
    
    
    public function getgraphresult() {

        $json = [];
       
        $getresult = $this->cashiermodel->getallrequestfromunit();
        if ($getresult) {
            foreach ($getresult as $get) {
                 $mainUnit = $get->dUnit;
                 $sumAll = $get->totalprice;
                
                  $data[] = ['unitName' => $this->mainlocation->getdUnit($mainUnit), 'sumAmount' => $sumAll];
                }
                    
           //$json['ci'] = $data;
             
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    
     public function getgraphresultforhodreport() {

        $json = [];
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        //$getresult = $this->cashiermodel->getallStaffinUnit($getmyUnit);
       
        $getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
                 if($getmyCountRequest){
                     foreach($getmyCountRequest as $countme){
                            $sessionID = $countme->sessionID;
                            $myTotal = $countme->myTotal;
                            
                            $data[] = ['myRequest' =>$this->adminmodel->getUsername($sessionID), 'sumAmount' =>$myTotal];
                        }
                        //
                         
                 
             
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    
      public function barchartgraph() {

        $title = "Expense Pro :: REPORT";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if ($getApprovalLevel == 3 || $getApprovalLevel == 6 || $getApprovalLevel == 5 || $getApprovalLevel == 7) {

             $getallUsers = $this->cashiermodel->getmyuserfulldetals();
             $getallUnits = $this->mainlocation->getallunit();
             $getallAccountcode = $this->cashiermodel->getallaccountcodesforsummary();
             
             $dTotal = $this->cashiermodel->getallrequestfromunit();
             
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'dTotal'=>$dTotal, 'getallAccountcode'=>$getallAccountcode, 'getallUnits'=>$getallUnits, 'getallUsers'=>$getallUsers, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('reports/graphs/barchart', $values);
        } else {
             $this->load->view('noaccesstoview');
        }
    }
    
    
    
    public function getcodesupport($id){
        echo "Still under construction"; 
    }
    
    
}

// End of Class Home
