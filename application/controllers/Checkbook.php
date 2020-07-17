<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

//require_once('PHPMailerAutoload.php');
class Checkbook extends CI_Controller {

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
    }

    public function index($bank, $id) {
        $this->load->model('maintenance');
        if ($bank == "" || $id == "") {
            echo "Important Variables Missing, Please try again";
        } else {

            $getBankchq_name = $this->generalmd->getsinglecolumn("chq_name", "newbank", "bankNumber", $bank);
            $chq_date = $this->generalmd->getsinglecolumn("chq_date", "newbank", "bankNumber", $bank);
            $chq_amount_words = $this->generalmd->getsinglecolumn("chq_amount_words", "newbank", "bankNumber", $bank);
            $chq_amount = $this->generalmd->getsinglecolumn("chq_amount", "newbank", "bankNumber", $bank);

            $benName = $this->generalmd->getsinglecolumn("benName", "cash_newrequestdb", "id", $id);
            $actualAmount = $this->generalmd->getsinglecolumn("dAmount", "cash_newrequestdb", "id", $id);
            $partPay = $this->generalmd->getsinglecolumn("partPay", "cash_newrequestdb", "id", $id);


            if ($partPay != "" && $partPay != "0" && $partPay < $actualAmount) {
                $newAmount = $partPay;
            } else {
                $newAmount = $actualAmount;
            }

            /* if (is_int($payeeName)) {
              $payeeName = $this->generalmd->getsinglecolumn("benName", "cash_newrequestdb", "id", $id);
              } else {
              $payeeName = $this->generalmd->getsinglecolumn("benName", "cash_newrequestdb", "id", $id);
              } */

            $from_app_id = $this->generalmd->getsinglecolumn("from_app_id", "cash_newrequestdb", "id", $id);

            if ($from_app_id == '3') {
                $vendor = $this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "USER_ID", $benName);
            } else if ($from_app_id == '0' && is_numeric($benName)) {
                $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
            } else if ($from_app_id == '0' && !is_numeric($benName)) {
                $vendor = $benName;
            } else if ($from_app_id == '5') {
                $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
            } else if ($from_app_id == '6') {
                $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
            } else if ($from_app_id == '8') {
                $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
            } else {
                $vendor = $benName;
            }


            //Get Details of the ID
            $value = ['chqName' => $getBankchq_name, 'chqDate' => $chq_date, 'chqWords' => $chq_amount_words,
                'chqAmount' => $chq_amount, 'payeeName' => $vendor, 'actualAmount' => $newAmount];
            $this->load->view('checkbook', $value);
        }
    }

    public function paypartpaymentnow($bank, $id, $pid) {
        $this->load->model('maintenance');
        if ($bank == "" || $id == "") {
            echo "Important Variables Missing, Please try again";
        } else {

            $getBankchq_name = $this->generalmd->getsinglecolumn("chq_name", "newbank", "bankNumber", $bank);
            $chq_date = $this->generalmd->getsinglecolumn("chq_date", "newbank", "bankNumber", $bank);
            $chq_amount_words = $this->generalmd->getsinglecolumn("chq_amount_words", "newbank", "bankNumber", $bank);
            $chq_amount = $this->generalmd->getsinglecolumn("chq_amount", "newbank", "bankNumber", $bank);

            /* $benName = $this->generalmd->getsinglecolumn("benName", "cash_newrequestdb", "id", $id);
              $actualAmount = $this->generalmd->getsinglecolumn("dAmount", "cash_newrequestdb", "id", $id);
              $partPay = $this->generalmd->getsinglecolumn("partPay", "cash_newrequestdb", "id", $id);
             */

            $benName = $this->generalmd->getsinglecolumn("benName", "cash_newrequestdb", "id", $id);
            //$actualAmount = $this->generalmd->getsinglecolumn("dAmount", "cash_newrequestdb", "id", $id);
            $newAmount = $this->generalmd->getsinglecolumn("partAmount", "partpayment", "nid", $pid);



            $from_app_id = $this->generalmd->getsinglecolumn("from_app_id", "cash_newrequestdb", "id", $id);

            if ($from_app_id == '3') {
                $vendor = $this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "USER_ID", $benName);
            } else if ($from_app_id == '0' && is_numeric($benName)) {
                $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
            } else if ($from_app_id == '0' && !is_numeric($benName)) {
                $vendor = $benName;
            } else if ($from_app_id == '5') {
                $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
            } else if ($from_app_id == '6') {
                $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
            } else if ($from_app_id == '8') {
                $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
            } else {
                $vendor = $benName;
            }


            //Get Details of the ID
            $value = ['chqName' => $getBankchq_name, 'chqDate' => $chq_date, 'chqWords' => $chq_amount_words,
                'chqAmount' => $chq_amount, 'payeeName' => $vendor, 'actualAmount' => $newAmount, 'partID' => $pid];
            $this->load->view('checkbook_paypart', $value);
        }
    }

    public function mergepayment($bank, $id) {
        $this->load->model('maintenance');
        if ($bank == "" || $id == "") {
            echo "Important Variables Missing, Please try again";
        } else {

            $getBankchq_name = $this->generalmd->getsinglecolumn("chq_name", "newbank", "bankNumber", $bank);
            $chq_date = $this->generalmd->getsinglecolumn("chq_date", "newbank", "bankNumber", $bank);
            $chq_amount_words = $this->generalmd->getsinglecolumn("chq_amount_words", "newbank", "bankNumber", $bank);
            $chq_amount = $this->generalmd->getsinglecolumn("chq_amount", "newbank", "bankNumber", $bank);

            $benName = $this->generalmd->getsinglecolumn("payee_or_bank", "cheque_merged", "id", $id);
            $actualAmount = $this->generalmd->getsinglecolumn("acount_payable_sumTotal", "cheque_merged", "id", $id);
            $payableids = $this->generalmd->getsinglecolumn("acount_payable_ids", "cheque_merged", "id", $id);
            
            $makeExplode = explode(',', $payableids);
            $makePickfirst = $makeExplode[0];
            
            $from_app_id = $this->generalmd->getuserAssetLocation("from_app_id", "cash_newrequestdb", "id", $makePickfirst);

            if ($from_app_id == '3') {
                $vendor = $this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "USER_ID", $benName);
            } else if (is_numeric($benName) && $from_app_id != '3') {
                $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
            } else {
                $vendor = $benName;
            }

            //Get Details of the ID
            $value = ['chqName' => $getBankchq_name, 'mergedID'=>$id, 'chqDate' => $chq_date, 'chqWords' => $chq_amount_words,
                'chqAmount' => $chq_amount, 'payeeName' => $vendor, 'actualAmount' => $actualAmount];
            $this->load->view('checkbook_merged', $value);
        }
    }

}

// End of Class Home
