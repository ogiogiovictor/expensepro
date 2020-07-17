<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class Chequexport extends CI_Controller {

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

  
    public function getmyreport() {

        if (empty($_POST['startDate']) || empty($_POST['endDate'])) {
            echo "<script>alert('Please select all fields')</script>";
            redirect('paycheques/payotherchequebranchonly', 'refresh');
        } else {
           
            $cashiersStartDate = $this->input->post('startDate', TRUE);
            $cashiersEndDate = $this->input->post('endDate', TRUE);

            $this->load->library("excel");
            $object = new PHPExcel();

            $object->setActiveSheetIndex(0);
            $table_columns = array("Request Title", "Unit", "Type", "Payee", "Amount", "Code", "Code Name", "Date Paid", "Paid By");

            $column = 0;

            foreach ($table_columns as $field) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
            }

            $sessionID = $_SESSION['email'];
            
            $getresultfromCode = $this->accounting->paychequenow($cashiersStartDate, $cashiersEndDate, $sessionID);
            if ($getresultfromCode) {
                $requestID = array();
                    foreach ($getresultfromCode as $getss) {
                        $requestID[] = $getss->requestID;
                    }
            }
            $impolde = implode(',', $requestID);
            $getChequeresult = $this->accounting->getonlycheques($impolde); 
            
            if($getChequeresult){
                $newid = array();
                    foreach($getChequeresult as $now){
                        $newid[] = $now->id;
                    }
            }
            $twoimpolde = implode(',', $newid);
            $employee_data = $this->accounting->getcashexpensedetails($twoimpolde);
             
            $excel_row = 2;
            foreach ($employee_data as $row) {

                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $this->mainlocation->descriptionofitem($row->requestID));
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $this->mainlocation->getdunit($this->accounting->returnmyunit($row->requestID)));
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $this->mainlocation->getpaymentType($this->accounting->getnPaymentType($row->requestID)));
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $this->mainlocation->getbenefiaciaryName($row->requestID));
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->ex_Amount);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->ex_Code);
                 $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $this->mainlocation->nameCode($row->ex_Code));
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->datepaid);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->sess);
                $excel_row++;
            }
             
            $object->setActiveSheetIndex(0);

            $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            // Sending headers to force the user to download the file
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="C&IReport_' . date('dMy') . '.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        }
    }
 
} // End of Class
