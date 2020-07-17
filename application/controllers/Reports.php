<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class Reports extends CI_Controller {

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

    public function mainsearch() {
        $sessionID = $_SESSION['email'];
        $output = '';
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if (isset($_POST['startDateall']) && isset($_POST['endDateall']) && isset($_POST['dacctCode'])) {

            $startDateall = $this->input->post('startDateall', TRUE);
            $endDateall = $this->input->post('endDateall', TRUE);
            $dacctCode = $this->input->post('dacctCode', TRUE);

            if ($startDateall !== "" && $endDateall !== "" && $dacctCode !== "") {

                if ($getApprovalLevel == 4 || $getApprovalLevel == 7 || $getApprovalLevel == 5 || $getApprovalLevel == 8 || $getApprovalLevel == 3 || $getApprovalLevel == 2) {

                    if ($dacctCode == 'all') {
                        $getResult = $this->adminmodel->postadvancesearchresultwithall($sessionID, $startDateall, $endDateall);
                    } else {
                        $getResult = $this->adminmodel->postadvancesearchresult($sessionID, $startDateall, $endDateall, $dacctCode);
                    }
                }
                $newStatus = "";
                //var_dump($getResult);
                if ($getResult) {
                    //$newStatus = '';
                    $sumamount = '';
                    $output = '<table class="table table-striped" id="hodall"><tr><th>Date Paid</th><th>Request Title</th><th>Details</th><th>Amount</th><th>Code</th><th>Beneficiary Name</th><th>Paid By</th><th>Status</th></tr>';
                    foreach ($getResult as $get) {
                        $exid = $get->exid;
                        $requestID = $get->requestID;
                        $ex_Details = $get->ex_Details;
                        $ex_Amount = $get->ex_Amount;
                        $ex_Code = $get->ex_Code;
                        $ex_Date = $get->ex_Date;
                        $datepaid = $get->datepaid;
                        $sess = $get->sess;


                        $getStatus = $this->mainlocation->getrequestStatus($requestID);


                        if ($getStatus == 4) {
                            $newStatus = "Approved";
                        } else if ($getStatus == 3) {
                            $newStatus = "Pending";
                        } else if ($getStatus == 7 || $getStatus == 8) {
                            $newStatus = "Approved";
                        }
                        $output .= '<tr><td>' . $datepaid . '</td><td>' . $this->mainlocation->descriptionofitem($requestID) . '</td><td>' . $ex_Details . '</td><td>' . $ex_Amount . '</td><td>' . $ex_Code . '</td><td>' . $this->mainlocation->getbenefiaciaryName($requestID) . '</td><td>' . $sess . '</td><td>' . $newStatus . '</td></tr>';

                        if ($ex_Amount) {
                            $sumamount += $ex_Amount;
                        }
                    }
                    $output .= '</table><div><b>Total : ' . number_format($sumamount) . '</b><br/>Date Range: ' . $startDateall . ' - ' . $endDateall . '</div> ';
                    echo $output;
                }
            }
        }
    }

// End of Main Search 

    public function categorymainsearchothernotused() {
        $sessionID = $_SESSION['email'];
        $output = "";
        if (isset($_POST['catStartDate']) && isset($_POST['catEndDate']) && isset($_POST['acctCode'])) {

            $catStartDate = $this->input->post('catStartDate', TRUE);
            $catEndDate = $this->input->post('catEndDate', TRUE);
            $codeCat = $this->input->post('acctCode', TRUE);

            if ($catStartDate !== "" && $catEndDate !== "" && $codeCat !== "") {

                // $getResult = $this->adminmodel->searchresultdetailsbycategory($sessionID, $catStartDate, $catEndDate, $codeCat); 
                $getresultfromCode = $this->adminmodel->getCoderesult($codeCat);
                // print_r($getresultfromCode);
                if ($getresultfromCode) {
                    foreach ($getresultfromCode as $gent) {
                        $requestID = $gent->requestID;
                        $exCode = $gent->ex_Code;
                        $codeNumber = $gent->codeNumber;
                    }
                }

                //Use the Code to return result from the cash_newrequest_expensedetails
                $getnewResult = @$this->adminmodel->gcodeResultonly($exCode);
                print_r($getnewResult);
                $output = '<table class="table table-striped"><tr><th>Date Created</th><th>Description</th><th>Amount</th><th>Location</th><th>Unit</th><th>Paid To</th><th>Date Paid</th><th>Cashier</th></th><th>Account Code</th></tr>';
                if ($getnewResult) {

                    foreach ($getnewResult as $get) {
                        $getRequestedID = $get->requestID;
                        $ex_Amount = $get->ex_Amount;

                        $getResult = $this->adminmodel->checkinResult($getRequestedID, $sessionID, $catStartDate, $catEndDate);

                        print_r($getResult);
                        if ($getResult) {
                            $sumamount = '';

                            foreach ($getResult as $get) {
                                $id = $get->id;
                                $dateCreated = $get->dateCreated;
                                $ndescriptOfitem = $get->ndescriptOfitem;
                                $dAmount = $get->dAmount;
                                $dLocation = $get->dLocation;
                                $dUnit = $get->dUnit;
                                $benName = $get->benName;
                                $datepaid = $get->datepaid;
                                $dCashierwhopaid = $get->dCashierwhopaid;

                                $getCodeName = $this->mainlocation->nameCode($exCode);

                                $output .= '<tr><td>' . $dateCreated . '</td><td>' . $ndescriptOfitem . '</td><td>' . $dAmount . '</td><td>' . $this->mainlocation->getdLocation($dLocation) . '</td><td>' . $this->mainlocation->getdunit($dUnit) . '</td><td>' . $benName . '</td><td>' . $datepaid . '</td><td>' . $dCashierwhopaid . '</td><td>' . $getCodeName . '</td></tr>';

                                if ($dAmount) {
                                    $sumamount += $dAmount;
                                } // End of If Amount
                            } // End of Foreach Result  foreach($getResult as $get){
                        } // End of  if($getResult){
                    } // End of foreach($getnewResult as $get){
                    //<b>Total : '.number_format($sumamount).'</b>
                    $output .= '<table><div></div> ';
                    echo $output;
                }
            }
        }
    }

// End of Main Search Category

    public function summaryresult() {
        $sessionID = $_SESSION['email'];
        $output = '';
        if (isset($_POST['datefromsummary']) && isset($_POST['dateendsummary'])) {

            $datefromsummary = $this->input->post('datefromsummary', TRUE);
            $dateendsummary = $this->input->post('dateendsummary', TRUE);

            if ($datefromsummary !== "" && $dateendsummary !== "") {

                $getResult = $this->adminmodel->getbygroupgroupbycategory($datefromsummary, $dateendsummary);
                //var_dump($getResult);
                if ($getResult) {
                    //SELECT `nCategory`, SUM(dAmount) AS 'Total' FROM cash_newrequestdb GROUP BY nCategory
                    //SELECT COUNT(id), `nCategory`, SUM(dAmount) AS 'Total' FROM cash_newrequestdb GROUP BY nCategory
                    $output = '<table class="table table-striped"><tr><th>Total Request</th><th>Account Group</th><th>Total Amount</th></tr>';
                    foreach ($getResult as $get) {
                        $id = $get->actID;
                        $exAmount = $get->ex_Amount;
                        $Total = $get->Total;
                        $dCode = $get->dCode;

                        $output .= '<tr><td>' . $id . '</td><td>' . $dCode . ' ' . $this->mainlocation->nameCode($dCode) . '</td><td>' . number_format($Total) . '</td></tr>';
                    }
                    $output .= '<table>';
                    echo $output;
                    echo "<div><br/><small>Date Range: From: $datefromsummary  To:  $dateendsummary</small></div>";
                }
            }
        }
    }

// End of Main Search Category
    ////////////////////////////////////////THIS IS THE OTHER POINT OF VIEW FOR SEARCHING///////////////////////////////

    public function categorymainsearch() {
        $sumamount = "";
        $sessionID = $_SESSION['email'];
        $output = "";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if (isset($_POST['catStartDate']) && isset($_POST['catEndDate']) && isset($_POST['status'])) {

            $catStartDate = $this->input->post('catStartDate', TRUE);
            $catEndDate = $this->input->post('catEndDate', TRUE);
            $status = $this->input->post('status', TRUE);

            if ($catStartDate !== "" && $catEndDate !== "" && $status !== "") {

                if ($getApprovalLevel == 4 || $getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 5) {
                    //$getresultfromCode = $this->adminmodel->getnewbycodesearch($status, $catStartDate, $catEndDate);
                    $getresultfromCode = $this->adminmodel->getnewbycodesearch($catStartDate, $catEndDate);
                }

                $output = '<div class="table table-responsive table-condensed"><table class="table table-striped table-hover" id="hodall"><thead><th>ID</th><th>Date Paid</th><th>Request Title</th><th>Requester</th><th>Location</th><th>Unit</th><th>Amount</th><th>Type</th>'
                        . '<th>Payee Name</th><th>Account<br/> Codes</th><th>Status</th><th>Paid By</th><th>Date Created</th></thead><tbody>';
                if ($getresultfromCode) {

                    foreach ($getresultfromCode as $get) {
                        $id = $get->id;
                        $dateCreated = $get->dateCreated;
                        $ndescriptOfitem = $get->ndescriptOfitem;
                        $sessionID = $get->sessionID;
                        $nPayment = $get->nPayment;
                        $nPaymentType = $this->mainlocation->getpaymentType($get->nPayment);
                        $approvals = $get->approvals;
                        $partPay = $get->partPay;
                        $dAmount = $get->dAmount;
                        $dLocation = $get->dLocation;
                        $dUnit = $get->dUnit;
                        $cashiers = $get->cashiers;
                        $datepaid = $get->datepaid;
                        $benName = $get->benName;
                        $dCashierwhopaid = $get->dCashierwhopaid;
                        $CurrencyType = $get->CurrencyType;
                        
                        
                        if ($approvals == 4 || $approvals == 8) {
                            $newStatus = "Approved";
                        } else if ($approvals == 3) {
                            $newStatus = "Pending";
                        } else {
                            $newStatus = "";
                        }
                        
                        if($CurrencyType == 'naira'){
                            $nairaSign = "&#8358;"; 
                         }else if($CurrencyType == 'dollar'){
                            $nairaSign = "&#36;"; 
                         }else if($CurrencyType == 'euro'){
                            $nairaSign = "&#8364;"; 
                         }else if($CurrencyType == 'pounds'){
                            $nairaSign = "&#163;"; 
                         }else if($CurrencyType == 'yen'){
                            $nairaSign = "&#165;"; 
                         }else{
                            $nairaSign = "&#8358;";
                         }
                         
                          if($partPay !="0" && $partPay < $dAmount){
                               $dAmounts = "<span style='color:red; font-weight:bold'>". $nairaSign. $partPay ."</span>";
                               $dAmounts .= "<br/><span style='color:red; font-weight:bold'><small>(Part Payment)</small></span>";
                          }else{
                                $dAmounts = $nairaSign. @number_format($dAmount, 2);
                         }	
                                            
                                            
                        if ($dAmount) {
                            $sumamount += $dAmount;
                        }

                        //Use the ID to return the result from the account code table
                        $getResultCode = $this->generalmd->getdresult("*", "cash_newrequest_expensedetails", "requestID", $id);
                        
                        $joinAll = "";
                        if($getResultCode){
                            foreach($getResultCode as $dCode){
                                $exCode = $dCode->ex_Code;
                                $exAmount = $dCode->ex_Amount;
                                
                                $joinAll .="<table class='table table-bordered'><tr><td>$exCode</td><td>$exAmount</td></tr></table>";
                            }
                        }
                        
                        $output .= '<tr><td width="5%">' . $id . '</td><td width="5%">' . $datepaid . '</td><td width="50%"><a href="">' . $ndescriptOfitem . '</a></td><td width="10%">' . $this->adminmodel->getUsername($sessionID) . '</td><td width="10%">' . $this->mainlocation->getdlocation($dLocation) . '</td><td width="10%">' . $this->mainlocation->getdunit($dUnit) . '</td><td width="5%"> ' .$dAmounts . '</td><td>'.$nPaymentType.'</td> <td width="5%">' . $benName . '</td>  <td>'.$joinAll.'</td > <td width="5%">' . $newStatus . '</td><td width="10%">' . $dCashierwhopaid . '</td><td>'.$dateCreated.'</td></tr><tbody>';
                    }
                }



                $output .= '<table><div></div></div>';

                echo $output;
                echo '<div><br/><b>Total : ' . @number_format(@$sumamount, 2) . '</b><br/><small>Date Range: From: ' . $catStartDate . '  To:  ' . $catEndDate . '</small></div>';
            }
        }
    }

// End of Main Search Category

    public function exportsearch() {
        
        $this->load->driver('cache');
        $this->cache->clean();
        $this->output->cache(0);
        ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
        
        if (empty($_POST['catStartDate']) || empty($_POST['catEndDate']) || empty($_POST['status'])) {
            //echo "<script>alert('Please select all fields')</script>";
            redirect('cireports/icureport', 'refresh');
        } else {
            //if (isset($_POST['catStartDate']) && isset($_POST['catEndDate']) && isset($_POST['status']) ) {

            $catStartDate = $this->input->post('catStartDate', TRUE);
            $catEndDate = $this->input->post('catEndDate', TRUE);
            $status = $this->input->post('status', TRUE);

            $this->load->library("excel");
            $object = new PHPExcel();

            $object->setActiveSheetIndex(0);
            //$table_columns = array("ID", "Date", "Request Title", "Requester", "Location", "Unit", "CurrencyType", "Amount", "Type", "Payee Name", "Status", "Paid By", "Date Paid", "Account Code", "Code Total Amount");
            
            $table_columns = array("ID", "Date", "Request Title", "Requester", "Location", "Unit", "CurrencyType", "Amount", "Type", "Payee Name", "Status", "Paid By", "Date Paid", "PO Number", "Account Code");
            
            $column = 0;

            foreach ($table_columns as $field) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
            }

            $employee_data = $this->adminmodel->getnewbycodesearch($catStartDate, $catEndDate);

            $excel_row = 2;
            foreach ($employee_data as $row) {

                if ($row->approvals == 8 || $row->approvals == 4) {
                    $newStatus = "Approved";
                } else {
                    $newStatus = "";
                }
                if($row->CurrencyType == 'naira'){
                   $nairaSign = "naira"; 
                }else if($row->CurrencyType == 'dollar'){
                   $nairaSign = "dollar"; 
                }else if($row->CurrencyType == 'euro'){
                   $nairaSign = "euro"; 
                }else if($row->CurrencyType == 'pounds'){
                   $nairaSign = "pounds"; 
                }else if($row->CurrencyType == 'yen'){
                   $nairaSign = "yen"; 
                }else{
                   $nairaSign = "naira";
                }
                $apprequestID = "";
                $getNumber = "";
                
                $this->load->model('maintenance');
                $this->load->model('archievesmodel');
                if($row->from_app_id == '3'){
                    $vendor = $this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "USER_ID", $row->benName);
                   
                    $apprequestID = $row->apprequestID;
                   
                    $explodeArray = explode(",", $apprequestID);
                    $getFirstvalue = $explodeArray[0];
                    $getNumber = $this->archievesmodel->getponumber($getFirstvalue);
              
                }else if($row->from_app_id == '0' && is_numeric($row->benName)){
                    $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $row->benName);
                }else if($row->from_app_id == '0' && !is_numeric($row->benName)){
                    $vendor =  $row->benName;
                }else if($row->from_app_id == '5'){
                    $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $row->benName);
                }else if($row->from_app_id == '6'){
                    $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $row->benName);
                }else if($row->from_app_id == '8'){
                    $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $row->benName);
                }else{
                    $vendor =  $row->benName;
                    $getNumber = "";
                }
                                    
                 //Use the ID to return the result from the account code table
                 //$getResultCode = $this->generalmd->getdresult("*", "cash_newrequest_expensedetails", "requestID", $row->id);
                   
                 $getResultCode = $this->generalmd->groupconcatxcode($row->id);
                 //SELECT requestID, GROUP_CONCAT(ex_Code) as dCode, SUM(ex_Amount) as total FROM `cash_newrequest_expensedetails` WHERE requestID IN (SELECT id FROM cash_newrequestdb) GROUP BY requestID
                      /*  $joinAll = "";
                       // $joinAmount = "";
                        if($getResultCode){
                            foreach($getResultCode as $dCode){
                                $exCode = $dCode->ex_Code;
                                $exAmount = $dCode->ex_Amount;
                               //$joinAll .= "$exCode ";
                                //$joinAmount .= "$exAmount ";
                            }
                            $joinAll .= ",".$exCode ;
                        } */
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->id);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->dateCreated);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->ndescriptOfitem);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $this->adminmodel->getUsername($row->sessionID));
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $this->mainlocation->getdlocation($row->dLocation));
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $this->mainlocation->getdunit($row->dUnit));
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $nairaSign);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, @number_format($row->dAmount, 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row,  $this->mainlocation->getpaymentType($row->nPayment, 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $vendor);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $newStatus);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row->dCashierwhopaid);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->datepaid);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, "'".$getNumber); //$row->po_number
                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $getResultCode);
                //$object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $joinAmount);
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

    public function dunimainsearch() {
        $sessionID = $_SESSION['email'];
        $output = "";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if (isset($_POST['unitStartDate']) && isset($_POST['unitEndDate']) && isset($_POST['dUnit'])) {

            $unitStartDate = $this->input->post('unitStartDate', TRUE);
            $unitEndDate = $this->input->post('unitEndDate', TRUE);
            $dUnit = $this->input->post('dUnit', TRUE);

            if ($unitStartDate !== "" && $unitEndDate !== "" && $dUnit !== "") {

                if ($getApprovalLevel == 4 || $getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 8 || $getApprovalLevel == 2) {
                    $getresultfromCode = $this->adminmodel->getdUnits($dUnit, $unitStartDate, $unitEndDate, $sessionID);
                }

                $output = '<table class="table table-striped"><tr><th>Request Title</th><th>Unit</th><th>Amount</th><th>Ben Name</th><th>Status</th><th>Paid By</th></tr>';
                if ($getresultfromCode) {
                    $sumamount = "";
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
                        if ($approvals == 4) {
                            $newStatus = "Approved";
                        } else if ($approvals == 3) {
                            $newStatus = "Pending";
                        }

                        if ($dAmount) {
                            $sumamount += $dAmount;
                        }

                        $output .= '<tr><td>' . $ndescriptOfitem . '</td><td>' . $this->mainlocation->getdunit($dUnit) . '</td><td>' . @number_format($dAmount) . '</td><td>' . $benName . '</td><td>' . $newStatus . '</td><td>' . $dCashierwhopaid . '</td></tr>';
                    }
                }



                $output .= '<table><div></div> ';

                echo $output;
                echo '<div><br/><b>Total : ' . @number_format($sumamount) . '</b><br/><small>Date Range: From: ' . $unitStartDate . '  To:  ' . $unitEndDate . '</small></div>';
            }
        }
    }

// End of Main Search Category

    public function actdunimainsearch() {
        $sessionID = $_SESSION['email'];
        $output = "";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if (isset($_POST['unitStartDate']) && isset($_POST['unitEndDate']) && isset($_POST['dUnit'])) {

            $unitStartDate = $this->input->post('unitStartDate', TRUE);
            $unitEndDate = $this->input->post('unitEndDate', TRUE);
            $dUnit = $this->input->post('dUnit', TRUE);

            if ($unitStartDate !== "" && $unitEndDate !== "" && $dUnit !== "") {

                if ($getApprovalLevel == 4 || $getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 8 || $getApprovalLevel == 2) {

                    if ($dUnit == 'all') {
                        $getresultfromCode = $this->adminmodel->getalldUnits($unitStartDate, $unitEndDate, $sessionID);
                    } else {
                        $getresultfromCode = $this->adminmodel->getdUnits($dUnit, $unitStartDate, $unitEndDate, $sessionID);
                    }
                }

                $output = '<table class="table table-striped"><tr><th>Request Title</th><th>Unit</th><th>Amount</th><th>Ben Name</th><th>Status</th><th>Paid By</th></tr>';
                $newStatus = "";
                if ($getresultfromCode) {
                    $sumamount = "";
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
                        if ($approvals == 4) {
                            $newStatus = "Approved";
                        } else if ($approvals == 3) {
                            $newStatus = "Pending";
                        } else if ($approvals == 7 || $approvals == 8) {
                            $newStatus = "Approved";
                        }

                        if ($dAmount) {
                            $sumamount += $dAmount;
                        }

                        $output .= '<tr><td>' . $ndescriptOfitem . '</td><td>' . $this->mainlocation->getdunit($dUnit) . '</td><td>' . @number_format($dAmount) . '</td><td>' . $benName . '</td><td>' . $newStatus . '</td><td>' . $dCashierwhopaid . '</td></tr>';
                    }
                }



                $output .= '<table><div></div> ';

                echo $output;
                echo '<div><br/><b>Total : ' . @number_format($sumamount) . '</b><br/><small>Date Range: From: ' . $unitStartDate . '  To:  ' . $unitEndDate . '</small></div>';
            }
        }
    }

// End of Main Search Category

    public function hodcategorymainsearch() {
        $sessionID = $_SESSION['email'];
        $output = "";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if (isset($_POST['hodcatStartDate']) && isset($_POST['hodcatEndDate']) && isset($_POST['hodstatus'])) {

            $hodcatStartDate = $this->input->post('hodcatStartDate', TRUE);
            $hodcatEndDate = $this->input->post('hodcatEndDate', TRUE);
            $hodstatus = $this->input->post('hodstatus', TRUE);

            if ($hodcatStartDate !== "" && $hodcatEndDate !== "" && $hodstatus !== "") {

                if ($getApprovalLevel == 2 || $getApprovalLevel == 3) {

                    if ($hodstatus == "approved") {
                        $getresultfromCode = $this->adminmodel->hodgetnewbycodesearch($hodstatus, $hodcatStartDate, $hodcatEndDate, $sessionID);
                    } else if ($hodstatus == "reject") {
                        $getresultfromCode = $this->adminmodel->hodrejectgetnewbycodesearch($hodstatus, $hodcatStartDate, $hodcatEndDate, $sessionID);
                    }
                }

                $output = '<table class="table table-striped"><tr><th>Request Title</th><th>Unit</th><th>Amount</th><th>Ben Name</th><th>Status</th><th>Paid By</th></tr>';
                $sumamount = "";
                if ($getresultfromCode) {

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
                        if ($approvals == 4) {
                            $newStatus = "Approved";
                        } else if ($approvals == 3) {
                            $newStatus = "Pending";
                        }

                        if ($dAmount) {
                            $sumamount += $dAmount;
                        }

                        $output .= '<tr><td>' . $ndescriptOfitem . '</td><td>' . $this->mainlocation->getdunit($dUnit) . '</td><td>' . @number_format($dAmount) . '</td><td>' . $benName . '</td><td>' . $newStatus . '</td><td>' . $dCashierwhopaid . '</td></tr>';
                    }
                }



                $output .= '<table><div></div> ';

                echo $output;
                echo '<div><br/><b>Total : ' . $sumamount . '</b><br/><small>Date Range: From: ' . $hodcatStartDate . '  To:  ' . $hodcatEndDate . '</small></div>';
            }
        }
    }

// End of Main Search Category
    /////////////////////////////////////////END OF THE OTHER POINT OF VIEW FOR SEARCHING  ////////////////////////////
///////////////////////////////////////////////////////CASHIERJ'S VIEW ONLY ////////////////////////////////////////

    public function cashiersearch() {
        $sumamount = 0;
        $sessionID = $_SESSION['email'];
        $output = "";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if (isset($_POST['startDate']) && isset($_POST['endDate'])) {

            $cashiersStartDate = $this->input->post('startDate', TRUE);
            $cashiersEndDate = $this->input->post('endDate', TRUE);

            if ($cashiersStartDate !== "" && $cashiersEndDate !== "") {

               $getresultfromCode = $this->accounting->paychequenow($cashiersStartDate, $cashiersEndDate, $sessionID);

                $output = '<table class="table table-responsive table-striped table-hover" id="hodall"><thead><th><b>Request Title</b></th><th><b>Unit</b></th><th><b>Type</b></th><th><b>Payee</b></th><th><b>Amount</b></th><th><b>Code</b></th><th><b>Code Name</b></th><th><b>Date Paid</b></th><th><b>Paid By</b></th></thead><tbody>';
                if ($getresultfromCode) {
                        $requestID = array();
                         foreach ($getresultfromCode as $getss) {
                            $requestID[] = $getss->requestID;
                         }
                     }
                     //print_r($requestID);
                     //lets impode
                     $impolde = implode(',', $requestID);
                     
                     //Loop through the ones that are cheques
                    $getChequeresult = $this->accounting->getonlycheques($impolde); 
                    
                    //print_r($getChequeresult);
                    
                    if($getChequeresult){
                         $newid = array();
                        foreach($getChequeresult as $now){
                            $newid[] = $now->id;
                        }
                    }
                    
                    $twoimpolde = implode(',', $newid);
                    //Use the ID to run another IN SQL
                    $getAllresult = $this->accounting->getcashexpensedetails($twoimpolde);
                    //var_dump($getAllresult);
                    if($getAllresult){
                         foreach ($getAllresult as $who) {
                            $nrequestID = $who->requestID;
                            $nex_Amount = $who->ex_Amount;
                            $nex_Code = $who->ex_Code;
                            $ndatepaid = $who->datepaid;
                            $nsess = $who->sess;
                            
                            $getnPayment = $this->accounting->getnPaymentType($nrequestID);
                            $nPayment = $this->mainlocation->getpaymentType($getnPayment);
                            
                            $myUnitpool = $this->accounting->returnmyunit($nrequestID);
                            $getdUnit = $this->mainlocation->getdunit($myUnitpool);
                            
                            $getbenefiaciaryNameforuser = $this->mainlocation->getbenefiaciaryName($nrequestID);
                            
                           $output .= '<tr><td>' . $this->mainlocation->descriptionofitem($nrequestID) . '</td><td>' . $getdUnit . '</td><td>' . $nPayment . '</td><td>' . $getbenefiaciaryNameforuser . '</td><td>' . $nex_Amount . '</td><td>' . $nex_Code . '</td><td>' . $this->mainlocation->nameCode($nex_Code) . '</td><td>' . $ndatepaid . '</td><td>' . $nsess . '</td></tr>';  
                         }
                    }
                    
                     //$output .= '<tr><td>' . $requestID . '</td><td>' . "nPayment" . '</td><td>' . $ex_Amount . '</td><td>' . $ex_Code . '</td><td>' . $datepaid . '</td><td>' . $sess . '</td></tr><tbody>';
                  //  }
               // }

             
                $output .= '</tbody></table>';

                echo $output;
                //echo '<div><br/><b>Total : ' . number_format($sumamount) . '</b><br/><small>Date Range: From: ' . $cashiersStartDate . '  To:  ' . $cashiersEndDate . '</small></div>';
            }
        }
    }

// End of Main Search Category

    public function exportcashieronly() {

        if (empty($_POST['cashiersStartDate']) || empty($_POST['cashiersEndDate']) || empty($_POST['status'])) {
            echo "<script>alert('Please select all fields')</script>";
            redirect('home/report', 'refresh');
        } else {
            //if (isset($_POST['catStartDate']) && isset($_POST['catEndDate']) && isset($_POST['status']) ) {

            $cashiersStartDate = $this->input->post('cashiersStartDate', TRUE);
            $cashiersEndDate = $this->input->post('cashiersEndDate', TRUE);
            $status = $this->input->post('status', TRUE);

            $this->load->library("excel");
            $object = new PHPExcel();

            $object->setActiveSheetIndex(0);
            $table_columns = array("Request Title", "Requester", "Location", "Unit", "Amount", "Payee Name", "Status", "Paid By");

            $column = 0;

            foreach ($table_columns as $field) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
            }

            $sessionID = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

            if ($getApprovalLevel == 6) {
                $employee_data = $this->adminmodel->getcodebycashierstatus($status, $cashiersStartDate, $cashiersEndDate);
            } else if ($getApprovalLevel == 4) {
                $employee_data = $this->adminmodel->getcashiersarch($status, $cashiersStartDate, $cashiersEndDate, $sessionID);
            }


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

//////////////////////////////////////////////////////END OF CASHIERS VIEW ONLY//////////////////////////////////////        


    public function actcashiersearch() {
        $sumamount = 0;
        $sessionID = $_SESSION['email'];
        $output = "";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if (isset($_POST['cashiersactStartDate']) && isset($_POST['cashiersactEndDate']) && isset($_POST['status'])) {

            $cashiersactStartDatee = $this->input->post('cashiersactStartDate', TRUE);
            $cashiersactEndDate = $this->input->post('cashiersactEndDate', TRUE);
            $status = $this->input->post('status', TRUE);

            if ($cashiersactStartDatee !== "" && $cashiersactEndDate !== "" && $status !== "") {

                if ($getApprovalLevel == 6) {
                    $getresultfromCode = $this->adminmodel->getallfieldsfromexpensetable($cashiersactStartDatee, $cashiersactEndDate);
                } else if ($getApprovalLevel == 4) {
                    $getresultfromCode = $this->adminmodel->getcashairsresult($cashiersactStartDatee, $cashiersactEndDate, $sessionID);
                }

                $output = '<table class="table table-responsive table-striped table-hover" id="hodall"><thead><th>Request Title</th><th>Location</th><th>Expense Details</th><th>Act Code</th><th>Amount</th><th>Payee</th><th>Date Paid</th><th>Paid By</th></thead><tbody>';
                if ($getresultfromCode) {

                    foreach ($getresultfromCode as $get) {
                        $exid = $get->exid;
                        $requestID = $get->requestID;
                        $ex_Details = $get->ex_Details;
                        $ex_Amount = $get->ex_Amount;
                        $ex_Code = $get->ex_Code;
                        $ex_Date = $get->ex_Date;
                        $datepaid = $get->datepaid;
                        $sess = $get->sess;

                        if ($ex_Amount) {
                            $sumamount += $ex_Amount;
                        }

                        $output .= '<tr><td>' . $this->mainlocation->descriptionofitem($requestID) . '</td><td>' . $this->mainlocation->getdlocation($this->adminmodel->getLocation($requestID)) . '</td><td>' . $this->mainlocation->nameCode($ex_Code) . '</td><td>' . $ex_Code . '</td><td>' . $ex_Amount . '</td><td>' . $this->mainlocation->getbenefiaciaryName($requestID) . '</td><td>' . $datepaid . '</td><td>' . $sess . '</td></tr><tbody>';
                    }
                }



                $output .= '<table><div></div> ';

                echo $output;
                echo '<div><br/><b>Total : ' . number_format(@$sumamount) . '</b><br/><small>Date Range: From: ' . $cashiersactStartDatee . '  To:  ' . $cashiersactEndDate . '</small></div>';
            }
        }
    }

// End of Main Search Category 

    public function rejectedactcashiersearch() {
        $sumamount = 0;
        $sessionID = $_SESSION['email'];
        $output = "";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        if (isset($_POST['catStartDaterejected']) && isset($_POST['catEndDaterejected']) && isset($_POST['status'])) {

            $catStartDaterejected = $this->input->post('catStartDaterejected', TRUE);
            $catEndDaterejected = $this->input->post('catEndDaterejected', TRUE);
            $status = $this->input->post('status', TRUE);

            if ($catStartDaterejected !== "" && $catEndDaterejected !== "" && $status !== "") {

                //<!-- Rejection includes 5, 6, 12 -->    
                if ($getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 5) {
                    $getresultfromCode = $this->datatablemodels->getrejectedrequest($catStartDaterejected, $catEndDaterejected);
                }

                $output = '<table class="table table-striped"><tr><th>Date Created</th><th>Description</th><th>Amount</th><th>Location</th><th>Unit</th><th>Payee</th><th>Date Rejected</th><th>Status</th><th>Rejected By</th></th></tr>';
                if ($getresultfromCode) {

                    foreach ($getresultfromCode as $get) {
                        $id = $get->id;
                        $dateCreated = $get->dateCreated;
                        $ndescriptOfitem = $get->ndescriptOfitem;
                        $sessionID = $get->sessionID;
                        $nPayment = $get->nPayment;
                        $approvals = $get->approvals;
                        $dAmount = $get->dAmount;
                        $dLocation = $get->dLocation;
                        $dUnit = $get->dUnit;
                        $cashiers = $get->cashiers;
                        $dateRejected = $get->dateRejected;
                        $benName = $get->benName;
                        $dCashierwhorejected = $get->dCashierwhorejected;
                        $dICUwhorejectedrequest = $get->dICUwhorejectedrequest;
                        $hodwhoreject = $get->hodwhoreject;


                        if ($hodwhoreject != "") {
                            $justReject = $hodwhoreject;
                        } else
                        if ($dICUwhorejectedrequest != "") {
                            $justReject = $dICUwhorejectedrequest;
                        } else
                        if ($dCashierwhorejected != "") {
                            $justReject = $dCashierwhorejected;
                        } else {
                            $justReject = "";
                        }


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
                            $newapproval = "<span style='color:grey'>Rejected by ICU</span>";
                        } else if ($approvals == 7) {
                            $newapproval = "<span style='color:indigo'>Cheque Sent for Signature</span>";
                        } else if ($approvals == 8) {
                            $newapproval = "<span style='color:green'>Signed & Ready for Collection</span>";
                        } else if ($approvals == 11) {
                            $newapproval = "<span style='color:brown'>Closed</span>";
                        } else if ($approvals == 12) {
                            $newapproval = "<span style='color:red'>Rejected by Accounts</span>";
                        }




                        if ($dAmount) {
                            $sumamount += $dAmount;
                        }


                        $output .= '<tr><td>' . $dateCreated . '</td><td>' . $ndescriptOfitem . '</td><td>' . $dAmount . '</td><td>' . $this->mainlocation->getdLocation($dLocation) . '</td><td>' . $this->mainlocation->getdunit($dUnit) . '</td><td>' . $benName . '</td><td>' . $dateRejected . '</td><td>'.$newapproval.'</td><td><span style="color:red">' . $justReject . ' </span></td></tr>';
                    }
                }

                $output .= '<table><div></div> ';

                echo $output;
                echo '<div><br/><b>Total : ' . number_format($sumamount) . '</b><br/><small>Date Range: From: ' . $catStartDaterejected . '  To:  ' . $catEndDaterejected . '</small></div>';
            }
        }
    }

// End of Main Search Category 
}

// End of Class
