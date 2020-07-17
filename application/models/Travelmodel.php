<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Travelmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db3 = $this->load->database('getajobdb', TRUE);
    }

    /*     * *** This controller returns all users ***** */

    public function getcicompany() {
        $q = "SELECT id FROM companies WHERE client = '2'";

        $run_q = $this->db3->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function gotogetoajob($staffID) {
        $q = "SELECT `id`, `business_branch`, `unit`, `staff_id`, `name`, `salary_level` FROM staffdata_mgmt WHERE `staff_id` = '$staffID' AND `cid` IN (select `id` from companies where `client`= '2') AND `status` IN ('1', '4', '7', '6') order by name asc";

        $run_q = $this->db3->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function getstaffemailfromgetajob($staffID) {
        $q = "SELECT `email_address` FROM staffdata WHERE `staff_id` = '$staffID'";

        $run_q = $this->db3->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->email_address;
            }
        } else {
            return FALSE;
        }
    }

    public function addmyflightrequest($staffID, $warefoffice, $benName, $benEmail, $business_branch, $unit, $hodEmail, $control_csrf, $csrf_valid, $bankName, $acctNum, $sLevel, $sessEmail, $auditTrail) {
        $q = "INSERT into travelstart (staffID, warefofficer, staffName, staffEmail, location, unit, hodEmail, csrf, csrvalid, eBank, eAccount, salaryClass, preparedBy, auditTrail, dateregistered)"
                . "VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $insertDB = $this->db->query($q, [$staffID, $warefoffice, $benName, $benEmail, $business_branch, $unit,
            $hodEmail, $control_csrf, $csrf_valid, $bankName, $acctNum, $sLevel, $sessEmail, $auditTrail]);

        if ($this->db->affected_rows($insertDB) > 0) {
            $insertId = $this->db->insert_id();

            return $insertId;
        } else {

            return FALSE;
        }
    }

    public function addperdiem($pLocation, $perdiemAmount, $sClass, $sCurrency, $adddby) {
        $q = "INSERT into perdiem_data (pLocation, pAmount, pSalaryClass, pCurrency, addedBy)VALUES(?, ?, ?, ?, ?)";
        $insertDB = $this->db->query($q, [$pLocation, $perdiemAmount, $sClass, $sCurrency, $adddby]);

        if ($this->db->affected_rows($insertDB) > 0) {
            $insertId = $this->db->insert_id();

            return $insertId;
        } else {

            return FALSE;
        }
    }

    public function getallperdiems() {
        $q = "SELECT * FROM perdiem_data";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function myperdiemclasslevel($sLevel, $destination) {
        $q = "SELECT `pAmount` FROM perdiem_data WHERE `pSalaryClass` LIKE '%$sLevel%' AND pLocation = '$destination'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->pAmount;
            }
        } else {
            return FALSE;
        }
    }

    public function dHotelClass($hotelID) {
        $q = "SELECT `sAmount` FROM travel_hotel WHERE `id` = '$hotelID'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->sAmount;
            }
        } else {
            return FALSE;
        }
    }

    public function addHotel($hEmail, $hName, $hLocation, $hcost, $hAmount, $haddress, $cPerson, $adddby) {
        $q = "INSERT into travel_hotel(hotelEmail, HotelName, tLocation, hotel_cost, sAmount, sAddress, sContactPerson, addeBy)VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $insertDB = $this->db->query($q, ["$hEmail", "$hName", "$hLocation", "$hcost", "$hAmount", "$haddress", "$cPerson", $adddby]);

        if ($this->db->affected_rows($insertDB) > 0) {
            $insertId = $this->db->insert_id();

            return $insertId;
        } else {

            return FALSE;
        }
    }

    public function getallhotels() {
        $q = "SELECT * FROM travel_hotel";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function addlocationamthr($pushRecords, $totalDay, $fullAmount, $tFromlocation, $tTolocation, $exsDate, $exrDate, $getforSalaryLevel, $purpose, $logistics, $exCode) {
        $q = "INSERT into travelstart_expense (`travelStart_ID`, `diff`, `sTotal`, `tFrom`, `tTo`, `exsDate`, `exrDate`, `amount`, `purpose`,  `logistics`, `exCode`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertDB = $this->db->query($q, ["$pushRecords", "$totalDay", "$fullAmount", "$tFromlocation", "$tTolocation", "$exsDate", "$exrDate", "$getforSalaryLevel", "$purpose", "$logistics", "$exCode"]);

        if ($this->db->affected_rows($insertDB) > 0) {
            $insertId = $this->db->insert_id();

            return $pushRecords;
        } else {

            return FALSE;
        }
    }

    public function addimageUpload($fname, $newName, $ext, $mimeType, $pushRecords) {
        $q = "INSERT into travestart_uploads (`newName`, `origName`, `ext`, `mime`, `travelID`) VALUES(?, ?, ?, ?, ?)";
        $insertDB = $this->db->query($q, [$fname, $newName, $ext, $mimeType, $pushRecords]);

        if ($this->db->affected_rows($insertDB) > 0) {
            $insertId = $this->db->insert_id();

            return $insertId;
        } else {

            return FALSE;
        }
    }

    public function flightrequest() {
        $q = "SELECT * FROM travelstart WHERE `approval` = '0' AND `approvedBy` = ''";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
	
	
    public function adminflightrequest() {
        $q = "SELECT * FROM travelstart";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
     public function getwareflight($email) {
        $q = "SELECT * FROM travelstart WHERE approvedBy = '$email'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
	

    public function allflightrequest($session) {
        $q = "SELECT * FROM travelstart WHERE `approvedBy` = '$session'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function mychecktraveldetails($tcrs, $id) {
        $q = "SELECT * FROM  travelstart WHERE `csrf` = '$tcrs' AND id = '$id'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->id;
            }
        } else {
            return FALSE;
        }
    }

    public function getmoredetails($getresult) {
        $q = "SELECT * FROM  travelstart WHERE `id` = '$getresult'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    //Get the Category Type
    public function gettravelexpenses($id) {
        $q = "SELECT * FROM travelstart_expense WHERE travelStart_ID = '$id'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function dHotelname($hotelID) {
        $q = "SELECT * FROM travel_hotel WHERE `id` = '$hotelID'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                $hName = $get->HotelName;
                $hAddress = $get->sAddress;
                return $hName . " - " . $hAddress;
            }
        } else {
            return FALSE;
        }
    }

    public function getUseremailfromgetajob($staffEmail) {
        $q = "SELECT `staff_id` FROM staffdata WHERE `email_address` = '$staffEmail' AND status='1' AND del='0'";

        $run_q = $this->db3->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->staff_id;
            }
        } else {
            return FALSE;
        }
    }

    public function getmorestaffdetails($staffID) {
        $q = "SELECT `business_branch`, `unit`  FROM staffdata_mgmt WHERE `staff_id` = '$staffID'";

        $run_q = $this->db3->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function updatetypepayment($paymentType, $sTotal, $dcashier, $dCurrencyType, $daccountant, $approval, $sessionEmail, $dComment, $mainID) {
        $update = "UPDATE travelstart SET `paymentType`='$paymentType', `sTotal`='$sTotal', `dCashier`='$dcashier', `dCurrency`='$dCurrencyType', `dAccountgroup`='$daccountant', `approval`='$approval' , `approvedBy`='$sessionEmail', `comment`=" . $this->db->escape($dComment) . " WHERE `id`='$mainID'";
        $this->db->query($update);
        return TRUE;
    }

    public function pushtravelUpdate($travel_ID, $amount_Local, $add_Hotel, $ex_Hertz, $ex_ProcessFlight, $sessionEmail) {
        $update = "UPDATE travelstart_expense SET `amountLocal`='$amount_Local', `hotelID`='$add_Hotel', `dHertz`='$ex_Hertz', `processFlight`='$ex_ProcessFlight',  `approval`='$sessionEmail' WHERE `tid`='$travel_ID'";
        $this->db->query($update);
        return TRUE;
    }

    public function addtoExpensedetails($travel_ID, $totalAmount, $ex_Detailofpayment, $exCode, $dateCreated) {
        $q = "INSERT into cash_newrequest_expensedetails (`requestID`, `ex_Amount`, `ex_Details`, `ex_Code`, `ex_Date`) VALUES(?, ?, ?, ?, ?)";
        $insertDB = $this->db->query($q, [$travel_ID, $totalAmount, $ex_Detailofpayment, $exCode, $dateCreated]);

        if ($this->db->affected_rows($insertDB) > 0) {
            $insertId = $this->db->insert_id();

            return $insertId;
        } else {

            return FALSE;
        }
    }

    public function updatetravelcolum($travel, $newRecords, $insertedFileId) {
        $update = "UPDATE cash_newrequestdb SET `enumType`='$travel', `travelID`='$newRecords' WHERE `id`='$insertedFileId'";
        $this->db->query($update);
        return TRUE;
    }
	
	 public function addfromreimbursement($two, $insertedFileId) {
        $update = "UPDATE cash_recievable_retirement SET  `approvals`='$two' WHERE `rID`='$insertedFileId'";
        $this->db->query($update);
        return TRUE;
    }
	
    public function adforthenew($dreimbursement, $insertedFileId) {
        $update = "UPDATE cash_newrequestdb SET `reimbursement`='$dreimbursement' WHERE `id`='$insertedFileId'";
        $this->db->query($update);
        return TRUE;
    }

    public function getnumType($rejectrequestID) {
        $q = "SELECT `enumType` FROM cash_newrequestdb WHERE `id` = '$rejectrequestID'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->enumType;
            }
        } else {
            return FALSE;
        }
    }

    public function getTravelID($rejectrequestID) {
        $q = "SELECT `travelID` FROM cash_newrequestdb WHERE `id` = '$rejectrequestID'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->travelID;
            }
        } else {
            return FALSE;
        }
    }

    public function makedoUpdate($approval, $getTravelID, $sessionID) {
        $update = "UPDATE travelstart SET `approval`='$approval', `approval-rejectfromexpensepro`='$sessionID' WHERE `id`='$getTravelID'";
        $this->db->query($update);
        return TRUE;
    }

    public function deletefromexpensepro($rejectrequestID) {
        $update = "DELETE FROM cash_newrequestdb WHERE `id`='$rejectrequestID'";
        $this->db->query($update);
        return TRUE;
    }

    public function deletefromcashexpensedetails($rejectrequestID) {
        $update = "DELETE FROM cash_newrequest_expensedetails WHERE `requestID`='$rejectrequestID'";
        $this->db->query($update);
        return TRUE;
    }

    public function runauditTrail($comment, $rejectrequestID) {
        $q = "UPDATE travelstart SET  `auditTrail`= CASE WHEN auditTrail = '' THEN '$comment' ELSE CONCAT(`auditTrail`, '$comment') END WHERE id = '$rejectrequestID'";
        $this->db->query($q);
        return $rejectrequestID;
    }

    public function myflightrequest($session) {
        //$q = "SELECT * FROM travelstart WHERE `staffEmail` = '$session' || `preparedBy` ='$session' ";
        $q = "SELECT * FROM travelstart WHERE `staffEmail` = '$session' ";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function getcsrfdetails($csrf) {
        //$q = "SELECT * FROM travelstart WHERE `csrf`='$csrf' AND `staffEmail` = '$email'";
        $q = "SELECT * FROM travelstart WHERE `csrf`='$csrf'";
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function travelupdate($approval, $approvedBy, $dateCreated, $warefoffice, $bankName, $acctNum, $totalAmount, $staffID, $control_csrf, $travelID) {
        $update = "UPDATE travelstart SET `approval`='$approval', `approvedBy`='$approvedBy', `dateCreated`='$dateCreated', `warefofficer`='$warefoffice', `eBank`='$bankName', `eAccount`='$acctNum', `sTotal`='$totalAmount' WHERE `staffID`='$staffID' AND `csrf` = '$control_csrf' AND `id` = '$travelID'";
        $this->db->query($update);
        return $control_csrf;
    }

    // Update Travelling Expenses
    public function updatetraveExpense($tFromlocation, $tTolocation, $exsDate, $exrDate, $purpose, $logistics, $totalDay, $getforSalaryLevel, $fullAmount, $session, $exid) {
        $update = "UPDATE travelstart_expense SET `tFrom`='$tFromlocation', `tTo`='$tTolocation', `exsDate`='$exsDate', `exrDate`='$exrDate', "
                . "`purpose`='$purpose', `logistics`='$logistics', `diff`='$totalDay', `amount`='$getforSalaryLevel', `sTotal`='$fullAmount', `approval`='$session' WHERE `tid`='$exid'";
        $this->db->query($update);
        return $update;
    }

    public function travelsUpdateaudit($auditTrail, $mainID) {
        $q = "UPDATE travelstart SET  `auditTrail`= CASE WHEN auditTrail = '' THEN '$auditTrail' ELSE CONCAT(`auditTrail`, '$auditTrail') END WHERE id = '$mainID'";
        $this->db->query($q);
        return $mainID;
    }

    public function getallunitbydate($start, $end, $status) {
        $q = "SELECT * FROM cash_newrequestdb WHERE `datepaid` >= '$start' AND `datepaid` <= '$end' AND `approvals` IN('$status')";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function getbymyunit($unit, $start, $end, $status) {
        $q = "SELECT * FROM cash_newrequestdb WHERE `dUnit`='$unit' AND `datepaid` >= '$start' AND `datepaid` <= '$end' AND `approvals` IN('$status')";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function getbymyunitbytypenum($dex, $start, $end, $status) {
        $q = "SELECT * FROM cash_newrequestdb WHERE `enumType`='$dex' AND `datepaid` >= '$start' AND `datepaid` <= '$end' AND `approvals` IN('$status')";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function getunitbyenumtype($unit, $dex, $start, $end, $status) {
        //$q = "SELECT * FROM cash_newrequestdb WHERE `dUnit`='$unit' AND `enumType`='$dex' AND `datepaid` >= '$start' AND `datepaid` <= '$end' AND `approvals` IN('$status')";
        $q = "SELECT id, dUnit, enumType, datepaid, SUM(dAmount) as dAmount, approvals FROM cash_newrequestdb WHERE `dUnit`='$unit' AND `enumType`='$dex' AND `datepaid` >= '$start' AND `datepaid` <= '$end' AND `approvals` IN('$status') GROUP BY dUnit";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function tryperdiemPush($travel_ID, $totalAmount, $d_Amount) {
        $update = "UPDATE travelstart_expense SET `amount`='$d_Amount', `sTotal`='$totalAmount' WHERE `tid`='$travel_ID'";
        $this->db->query($update);
        return TRUE;
    }

    //Get the Category Type
    public function getallaccountscode($start, $end) {
        //$q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals='4' OR approvals='8'";
        $q = "SELECT requestID, COUNT(requestID) as request, ex_Amount, SUM(ex_Amount) as total, `ex_Code` FROM cash_newrequest_expensedetails WHERE `sess` !='' AND `datepaid` >= '$start' AND `datepaid` <= '$end' GROUP BY ex_Code";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return "";
        }
    }

    //Get the Category Type
    public function getbydCode($accountCode, $start, $end) {
        //$q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals='4' OR approvals='8'";
        $q = "SELECT requestID, COUNT(requestID) as request, ex_Amount, SUM(ex_Amount) as total, `ex_Code` FROM cash_newrequest_expensedetails WHERE `ex_Code` = $accountCode AND `sess` !='' AND `datepaid` >= '$start' AND `datepaid` <= '$end' GROUP BY ex_Code";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return "";
        }
    }

    public function getTransactID($code, $start, $end) {
        // $q = "SELECT requestID, COUNT(requestID) as request, ex_Amount, SUM(ex_Amount) as total, `ex_Code` FROM cash_newrequest_expensedetails WHERE `ex_Code` = $accountCode AND `sess` !='' AND `datepaid` >= '$start' AND `datepaid` <= '$end' GROUP BY ex_Code";
        //$q = "SELECT * FROM cash_newrequest_expensedetails WHERE `ex_Code` = $code AND `sess` !='' AND `datepaid` >= '$start' AND `datepaid` <= '$end'";
        $q = "SELECT requestID, ex_Amount, SUM(ex_Amount) as total, `ex_Code`, datepaid, ex_Details FROM cash_newrequest_expensedetails WHERE `ex_Code` = $code AND `sess` !='' AND `datepaid` >= '$start' AND `datepaid` <= '$end' GROUP BY requestID";


        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return "";
        }
    }

    public function getstafftravels($userEmail, $sf_start, $ef_end, $dexs) {
        $q = "SELECT * FROM cash_newrequestdb WHERE `sessionID`='$userEmail' AND `datepaid` >= '$sf_start' AND `datepaid` <= '$ef_end' AND `enumType` ='$dexs' AND `approvals` IN ('4', '8')";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    //@1234Leasing Password for wifi  --  !234567890
    public function getunitinfoassearched($unit, $start, $end, $dex) {
        $q = "SELECT * FROM cash_newrequestdb WHERE `dUnit`='$unit' AND `datepaid` >= '$start' AND `datepaid` <= '$end' AND `enumType` = '$dex'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function addCommentswarefare($dComment, $mainID) {
        $q = "UPDATE travelstart SET `comment`= '$dComment' WHERE id = '$mainID'";
        $this->db->query($q);
        return TRUE;
    }

    public function doreimbursement($getTravelID) {
        $q = "UPDATE travelstart SET `sReimbursement`= '1' WHERE id = '$getTravelID'";
        $this->db->query($q);
        return TRUE;
    }

    public function getretirementresults($id, $csrf, $sEmail) {
        $q = "SELECT * FROM  travelstart WHERE `id` = '$id' AND `csrf`='$csrf' AND `staffEmail` = '$sEmail'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function addmyhotels($mainID, $travel_ID, $add_Hotel) {
        $q = "INSERT into hotel_payment(`mainID`, `travelID`, `hotelID`, `dateCreated`) VALUES(?, ?, ?, NOW())";
        $insertDB = $this->db->query($q, [$mainID, $travel_ID, $add_Hotel]);

        if ($this->db->affected_rows($insertDB) > 0) {
            $insertId = $this->db->insert_id();

            return $insertId;
        } else {

            return FALSE;
        }
    }

    public function getHotelzeroID($travel_ID) {
        //$q = "SELECT * FROM travelstart WHERE `csrf`='$csrf' AND `staffEmail` = '$email'";
        $q = "SELECT * FROM hotel_payment WHERE `hotelID`='$travel_ID'";
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->hotelID;
            }
        } else {
            return FALSE;
        }
    }

    public function deleterecords($travel_ID, $zero) {
        $update = "DELETE FROM hotel_payment WHERE `travelID`='$travel_ID' AND `hotelID`='$zero'";
        $this->db->query($update);
        return TRUE;
    }

    public function addflightrequest($getTravelID) {
        $q = "INSERT into flight_request(`request_ID`, `dateCreated`) VALUES(?, NOW())";
        $insertDB = $this->db->query($q, [$getTravelID]);

        if ($this->db->affected_rows($insertDB) > 0) {
            $insertId = $this->db->insert_id();

            return $insertId;
        } else {

            return FALSE;
        }
    }

    public function insercashrecievables($dateCreated, $paymentType, $id, $title, $staffName, $dCurrency, $dAccountgroup, $staffID, $staffEmail, $location, $unit, $sTotal) {
        $q = "INSERT into cash_recievable_retirement(`dateCreated`, `nPayment`, `requestID`, `title`, `userName`, `currency`, `dgroup`, `userID`, `userEmail`, `clocation`, `cUnit`, `paidAmount`, `dType`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'travel')";
        $insertDB = $this->db->query($q, [$dateCreated, $paymentType, $id, $title, $staffName, $dCurrency, $dAccountgroup, $staffID, $staffEmail, $location, $unit, $sTotal]);

        if ($this->db->affected_rows($insertDB) > 0) {
            $insertId = $this->db->insert_id();

            return $insertId;
        } else {

            return FALSE;
        }
    }

    public function getTravelAmount($mainID) {
        $q = "SELECT `sTotal` FROM  travelstart WHERE `id` = '$mainID'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->sTotal;
            }
        } else {
            return FALSE;
        }
    }

    public function timetoreimburse($retiredAmount, $Dbalance, $auditTrail, $daccountant, $myhodallowed, $approvalStatus, $mainID) {
        $q = "UPDATE cash_recievable_retirement SET `retiredAmount`= '$retiredAmount', `myBalance`='$Dbalance', `auditTrail`='$auditTrail', `dgroup`='$daccountant', `hod`='$myhodallowed', `approvals`='$approvalStatus'   WHERE requestID = '$mainID'";
        $this->db->query($q);
        return TRUE;
    }

    public function runtravelupdate($mainID) {
        $q = "UPDATE travelstart SET `sReimbursement`= '2' WHERE id = '$mainID'";
        $this->db->query($q);
        return TRUE;
    }
    
     public function runtravemyupdate($retirementintravelstart, $mainID) {
        $q = "UPDATE travelstart SET `sReimbursement`= '$retirementintravelstart' WHERE id = '$mainID'";
        $this->db->query($q);
        return TRUE;
    }

    public function loopmodeltravel($daysActual, $amountSpent, $newfillBalance, $tid) {
        $q = "UPDATE travelstart_expense SET `days_Spent`= '$daysActual', `amountSpent`= '$amountSpent', `balance`= '$newfillBalance' WHERE tid = '$tid'";
        $this->db->query($q);
        return TRUE;
    }

    public function getallfightrequest() {
        $q = "SELECT * FROM  flight_request WHERE `status` = 'pending'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function flightStaffemail($idrequest) {
        $q = "SELECT `staffName` FROM travelstart WHERE `id` = '$idrequest'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->staffName;
            }
        } else {
            return FALSE;
        }
    }

    public function flightStaffName($idrequest) {
        $q = "SELECT `staffEmail` FROM travelstart WHERE `id` = '$idrequest'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->staffEmail;
            }
        } else {
            return FALSE;
        }
    }

    public function getCurrency($mainID) {
        $q = "SELECT `dCurrency` FROM  travelstart WHERE `id` = '$mainID'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->dCurrency;
            }
        } else {
            return FALSE;
        }
    }

    public function getflightrequestshite($id, $request) {
        $q = "SELECT * FROM  flight_request WHERE `id` = '$id' AND `request_ID`= '$request'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    

    public function addflightattachement($fname, $newName, $ext, $mimeType, $requestID, $mflightID) {
        $q = "INSERT into flight_attachement (`origName`, `newName`, `ext`, `mime`, `flightID`, `travelID`) VALUES(?, ?, ?, ?, ?, ?)";
        $insertDB = $this->db->query($q, [$fname, $newName, $ext, $mimeType, $requestID, $mflightID]);

        if ($this->db->affected_rows($insertDB) > 0) {
            $insertId = $this->db->insert_id();

            return $insertId;
        } else {

            return FALSE;
        }
    }

    public function bringFlightAmount($id) {
        $q = "SELECT * FROM flight_request WHERE `id` = '$id'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            //foreach($run_q->result() as $get){
            return $run_q->result();

            // }
        } else {
            return FALSE;
        }
    }

    public function mybatchedRequest($dAgency, $sumlang, $batchCode, $sessionEmail, $lang, $batchTitle) {
        $q = "INSERT into batchedflights(`agency`, `batchAmount`, `batchCode`, `batchedBy`, `sumlID`, `batchTitle`) VALUES(?, ?, ?, ?, ?, ?)";
        $insertDB = $this->db->query($q, [$dAgency, $sumlang, $batchCode, $sessionEmail, $lang, $batchTitle]);

        if ($this->db->affected_rows($insertDB) > 0) {
            $insertId = $this->db->insert_id();

            return $insertId;
        } else {

            return FALSE;
        }
    }

    public function getbybatchrequest() {
        $q = "SELECT * FROM batchedflights WHERE `type` = 'flight' AND `batchedStatus`='pending'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function getallbatch() {
        $q = "SELECT * FROM batchedflights WHERE `batchedStatus` = 'pending'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    /*     * *** UPDATE TILL REQUEST TO 1 ***** */

    public function changebatchstatus($updates, $value) {
        $update = "UPDATE flight_request SET `Status`='$updates' WHERE `id`='$value'";
        $this->db->query($update);
        return TRUE;
    }

    
        public function getbatchedetails($sumID){
            $q = "SELECT * FROM flight_request WHERE id IN($sumID)";

            $run_q = $this->db->query($q);

            if ($run_q->num_rows() > 0) {
                return $run_q->result();
            } else {
                return FALSE;
            }
        }
        
        
        public function getbatchresultbyid($id) {
        $q = "SELECT * FROM batchedflights WHERE `id`='$id' AND `batchedStatus`='pending'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    
     public function expensedetailstravles($exDetailofpayment, $exAmount, $exCode, $exDate, $insertedFileId){
		$q = "INSERT into cash_newrequest_expensedetails (ex_Details, ex_Amount,  ex_Code, ex_Date, requestID) VALUES(?, ?, ?, ?, ?)";
		$insertDB = $this->db->query($q, [$exDetailofpayment, $exAmount, $exCode, $exDate, $insertedFileId]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
    }
       
    
     public function updatebatchsent($batchedId) {
        $update = "UPDATE batchedflights SET `batchedStatus`='sent' WHERE `id`='$batchedId'";
        $this->db->query($update);
        return TRUE;
    }
    
    
     public function updatcashbatchCode($travel, $batchCode, $batchID, $insertedFileId) {
        $update = "UPDATE cash_newrequestdb SET `enumType`='$travel', `travelBatchCode`='$batchCode', `batchedID` = '$batchID'  WHERE `id`='$insertedFileId'";
        $this->db->query($update);
        return TRUE;
    }
    
     public function gethotelpayment() {
        $q = "SELECT * FROM  travelstart_expense WHERE `logistics` = 'hotel' AND `hotel_payment`= 'no' AND `hotelStatus` = '0' ORDER BY hotelID DESC";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    
     public function getforHertzs($email) {
        $q = "SELECT * FROM  travelstart_expense WHERE `dHertz` = 'yes' AND `approval`='$email'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
      public function getforHertzsforadmin() {
        $q = "SELECT * FROM  travelstart_expense WHERE `dHertz` = 'yes'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
    
     //Get the Category Type
    public function getmytravelexpensebyhotel($id) {
        $q = "SELECT * FROM travelstart_expense WHERE tid = ?";

        $run_q = $this->db->query($q, [$id]);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
     public function changehotelstatus($updates, $value) {
        $update = "UPDATE travelstart_expense SET `hotelStatus`='$updates' WHERE `tid`='$value'";
        $this->db->query($update);
        return TRUE;
    }
    
    
    
     public function mybatchedHotel($sumlang, $batchCode, $sessionEmail, $lang, $batchTitle, $type) {
        $q = "INSERT into batchedflights(`batchAmount`, `batchCode`, `batchedBy`, `sumlID`, `batchTitle`, `type`) VALUES(?, ?, ?, ?, ?, ?)";
        $insertDB = $this->db->query($q, [$sumlang, $batchCode, $sessionEmail, $lang, $batchTitle, $type]);

        if ($this->db->affected_rows($insertDB) > 0) {
            $insertId = $this->db->insert_id();

            return $insertId;
        } else {

            return FALSE;
        }
    }
        
    
    
      //Get the Category Type
    public function gethotellID($id) {
        $q = "SELECT hotelID FROM travelstart_expense WHERE tid = ?";

        $run_q = $this->db->query($q, [$id]);

        if ($run_q->num_rows() > 0) {
           foreach ($run_q->result() as $get) {
                return $get->hotelID;
            }
        } else {
            return FALSE;
        }
    }
    
    
    
     public function getHertzValu($id) {
        $q = "SELECT * FROM  travelstart_expense WHERE `tid` = '$id' AND `dHertz`= 'yes'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
  
    
     public function addHertztrans($hertAmount, $transportID){
        $q = "UPDATE travelstart_expense SET `HertzAmount`= '$hertAmount' WHERE `tid` = '$transportID'";
        $this->db->query($q);
        return TRUE;
    }
    
    
    //Get the Category Type
    public function batchmerequest($batchedId) {
        $q = "SELECT type FROM batchedflights WHERE id = '$batchedId'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
           foreach ($run_q->result() as $get) {
                return $get->type;
            }
        } else {
            return FALSE;
        }
    }
    
    
    
    
      //Get the Category Type
    public function flightCost($id) {
        $q = "SELECT flight_Amount FROM flight_request WHERE request_ID = ?";

        $run_q = $this->db->query($q, [$id]);

        if ($run_q->num_rows() > 0) {
           foreach ($run_q->result() as $get) {
                return $get->flight_Amount;
            }
        } else {
            return "0";
        }
    }
    
    
     //Get the Category Type
    public function hertzAmount($id) {
        $q = "SELECT * FROM  travelstart_expense WHERE travelStart_ID = ?";

        $run_q = $this->db->query($q, [$id]);

        if ($run_q->num_rows() > 0) {
           return $run_q->result();
        } else {
            return "0";
        }
    }
    
    
      //Get the Category Type
    public function hotelCost($id) {
        $q = "SELECT * FROM  travelstart_expense WHERE travelStart_ID = ?";

        $run_q = $this->db->query($q, [$id]);

        if ($run_q->num_rows() > 0) {
           return $run_q->result();
        } else {
            return "0";
        }
    }
    
    
    
     public function makemyupdateforhotel($Main_dAmount, $Ddiff, $MainID){
        $update = "UPDATE travelstart_expense SET `hotelAmount`='$Main_dAmount', `daySpent_inHotel`='$Ddiff'  WHERE `tid`='$MainID'";
        $this->db->query($update);
        return TRUE;
    }
    
     public function paymentemthods(){
        $q = "SELECT * FROM  cash_paymentmode";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    public function gettravelresult($id) {
        $q = "SELECT * FROM travelstart WHERE `id` = '$id'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
    
     public function getbatchID($id) {
        $q = "SELECT `batchedID` FROM cash_newrequestdb WHERE `id` = '$id'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->batchedID;
            }
        } else {
            return FALSE;
        }
    }
    
    
     public function allbatchresult($getBatchID) {
        $q = "SELECT * FROM batchedflights WHERE `id` = '$getBatchID'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
    
    public function mybatchimages($sumFlightID){
        $q = "SELECT * FROM flight_attachement WHERE `flightID` IN ($sumFlightID)";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
    public function gettravelUpload($id) {
        $q = "SELECT * FROM travestart_uploads WHERE travelID='$id'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
     public function getFlightattachment($id) {
        $q = "SELECT * FROM  flight_attachement WHERE flightID='$id'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
    
    public function oneidtostatus($dataID){
        $update = "UPDATE  cash_recievable_retirement SET `approvals`='1'  WHERE `requestID`='$dataID'";
        $this->db->query($update);
        return TRUE;
    }
    
    public function completeretirement($dataID){
        $update = "UPDATE  travelstart SET `sReimbursement`='3'  WHERE `id`='$dataID'";
        $this->db->query($update);
        return TRUE;
    }
    
     public function makeicuverifyfirsto($sessionID, $dataID){
        $update = "UPDATE  cash_recievable_retirement SET `icuSeen`='yes', `approvals`='4', `dICUwhoconfirmed` ='$sessionID'  WHERE `requestID`='$dataID'";
        $this->db->query($update);
        return TRUE;
    }
	
	 public function addrecievabledetails($dRequestID, $dcomment, $maindBalance, $sessionEmail, $insertedFileId){
        $q = "INSERT into cash_recievable_breakdown (travelID, exDetails_descript, dAmount, approvedBy, expenseproID)VALUES(?, ?, ?, ?, ?)";
        $insertDB = $this->db->query($q, [$dRequestID, $dcomment, $maindBalance, $sessionEmail, $insertedFileId]);

        if ($this->db->affected_rows($insertDB) > 0) {
            $insertId = $this->db->insert_id();

            return $insertId;
        } else {

            return FALSE;
        }
    }
	
	
	 public function getnewStatus($id) {
        $q = "SELECT approvals FROM  cash_newrequestdb WHERE `travelID` = '$id'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->approvals;
            }
        } else {
            return FALSE;
        }
    }

    
    
    
     //Get the Category Type
    public function whoaddsflight($id) {
        $q = "SELECT addedBy FROM flight_request WHERE id = $id";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
           foreach ($run_q->result() as $get) {
                return $get->addedBy;
            }
        } else {
            return "";
        }
    }
    
    
    
     public function updaterequestnotapply($mID, $SessionEmail){
        $update = "UPDATE flight_request SET `status`='not applicable', `addedBy`='$SessionEmail' WHERE `request_ID`='$mID'";
        $this->db->query($update);
        return TRUE;
    }
    
     public function getmybatchedrequest() {
        $q = "SELECT * FROM batchedflights WHERE type = 'flight' AND batchedStatus = 'pending'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
     public function doyouretirment($benEmail){
        $q = "SELECT requestID FROM  cash_recievable_retirement WHERE `userEmail` = '$benEmail' AND `retiredAmount` = ''";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->requestID;
            }
        } else {
            return FALSE;
        }
    }
    
    
    
     public function fromLocation($id){
        $q = "SELECT tFrom FROM  travelstart_expense WHERE `travelStart_ID` = '$id'";
        
        $run_q = $this->db->query($q, [$id]);
		
		if($run_q->num_rows() > 0){
           foreach($run_q->result() as $get){
                    $tFrom = $get->tFrom;
                    return $tFrom;
		
            }
        }else{
                return FALSE;
		}
    }
    
    
     public function toLocation($id){
        $q = "SELECT tTo FROM  travelstart_expense WHERE `travelStart_ID` = '$id'";
        
        $run_q = $this->db->query($q, [$id]);
		
		if($run_q->num_rows() > 0){
           foreach($run_q->result() as $get){
                    $tTo = $get->tTo;
                return $tTo;
            }
        }else{
            return FALSE;
            }
        }
        
        
    public function updatemyapprovalforflight($mainID){
        $update = "UPDATE travelstart SET `approval`='4' WHERE `id`='$mainID'";
        $this->db->query($update);
        return TRUE;
    }
    
    
     public function getretiredbalance($dataID) {
        $q = "SELECT `retiredAmount` FROM  cash_recievable_retirement WHERE `requestID` = '$dataID'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->retiredAmount;
            }
        } else {
            return "";
        }
    }
    
    
    
     //Get the Category Type
    public function viewalltravelstart(){
        $q = "SELECT userIDs FROM access_gen WHERE `id` = '9'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->userIDs;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     //Get the Category Type
    public function getexpenseproid($id){
        $q = "SELECT id FROM cash_newrequestdb WHERE `travelID` = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->id;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function geteAccount($id){
        $q = "SELECT eAccount FROM travelstart WHERE `id` = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->eAccount;
            }
        }
        
        else{
            return "";
        }
    }
    
    
      //Get the Category Type
    public function geteBank($id){
        $q = "SELECT eBank FROM travelstart WHERE `id` = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->eBank;
            }
        }
        
        else{
            return "";
        }
    }
    
    
    
     public function retirementdetails($id) {
        $q = "SELECT * FROM cash_recievable_retirement WHERE requestID = '$id'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
     public function sentomeforreibursement($email) {
        $q = "SELECT * FROM cash_recievable_retirement WHERE `approvals` = '2' AND `hod` = '$email' AND icuSeen = 'no' AND retiredAmount !=''";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
     public function makehodverify($approvals, $sessionID, $dataID){
        $update = "UPDATE  cash_recievable_retirement SET `approvals`='$approvals', `dhodwhoapproves`='$sessionID' WHERE `requestID`='$dataID' AND `hod` = '$sessionID'";
        $this->db->query($update);
        return TRUE;
    }
    
    
     public function updateresultfortravel($approvals, $dataID){
        $update = "UPDATE travelstart SET `sReimbursement`='$approvals' WHERE `id`='$dataID'";
        $this->db->query($update);
        return TRUE;
    }
    
    
    /*
     //Get the Category Type
    public function getrequestIDfortravel($dataID){
        $q = "SELECT requestID FROM cash_recievable_retirement WHERE `requestID` = '$dataID'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->requestID;
            }
        }
        
        else{
            return "";
        }
    }
    */
    
    
     public function insertToexpensepro($dateCreated, $dCurrencyType, $userGenCode, $descItem, $benName, $dUnit, $paymentType, $dComment, $dhod, $dicu, $dcashier="", $daccountant="", $sessionID, $approvals, $uLocation, $fullname, $sessionEmail, $dICUwhoconfirmed, $myhodwhoapproves){
		$q = "INSERT into cash_newrequestdb (`dateCreated`, `CurrencyType`, `userCode`, `ndescriptOfitem`, `benName`, `dUnit`, `nPayment`, `requesterComment`,  `hod`, `icus`, `cashiers`, `dAccountgroup`, `sessionID`, `approvals`, `dLocation`, `fullname`, `pendingHOD`, `dICUwhoapproved`, `hodwhoapprove`, `dateRegistered`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, ["$dateCreated", "$dCurrencyType", "$userGenCode", "$descItem", "$benName", "$dUnit", "$paymentType", "$dComment", "$dhod", "$dicu", "$dcashier", "$daccountant", "$sessionID", "$approvals", "$uLocation", "$fullname", "$sessionEmail", "$dICUwhoconfirmed", "$myhodwhoapproves"]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
    }
    
    
     public function changesreimbursement($two, $insertedFileId) {
        $update = "UPDATE travelstart SET  `sReimbursement`='$two' WHERE `id`='$insertedFileId'";
        $this->db->query($update);
        return TRUE;
    }
    
    
     //Get the Category Type
    public function onlysupervisors(){
        $q = "SELECT userID FROM cash_accesslevel WHERE `id` = '2'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->userID;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function getallflightbyicu() {
        $q = "SELECT * FROM travelstart_expense WHERE hodwhoapprove !='' AND icuwhoapprove=''";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
     public function forbatchpayment() {
        //$q = "SELECT * FROM travelstart_expense WHERE hodwhoapprove !='' AND icuwhoapprove !='' ORDER BY agency";
         //$q = "SELECT * FROM flight_request WHERE status ='' ORDER BY travel_agency";
         $q = "SELECT id, GROUP_CONCAT(id) AS allid,  flightName, flightID, flight_Amount, travel_agency, SUM(flight_Amount) as totalSum FROM flight_request WHERE status = 'sent' GROUP BY travel_agency";
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
     public function batchinrequest($ids) {
         $q = "SELECT * FROM flight_request WHERE id IN($ids) AND status = 'sent'";
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    public function groupbatchamount($ids) {
         $q = "SELECT id, travel_agency, GROUP_CONCAT(id) AS dIds, flight_Amount, SUM(flight_Amount) as TOTAL FROM `flight_request` where id IN($ids) AND Status = 'sent'";
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
     public function updatemybatch($status, $ids) {
        $update = "UPDATE flight_request SET `Status`='$status' WHERE `id` IN($ids)";
        $this->db->query($update);
        return TRUE;
    }
    
    
     public function forexternalflight($agency, $hodtoaprove, $flightprocessBy, $approval, $exCode, $diff, $staffName, $tFromlocation, $tTolocation, $exsDate, $exrDate, $purpose, $processFlight, $staffType) {
        $q = "INSERT into travelstart_expense (`agency`, `sentTohod`, `flightprocessBy`, `approval`, `exCode`, `diff`, `travelStart_ID`, `tFrom`, `tTo`, `exsDate`, `exrDate`, `purpose`, `processFlight`, `staffType`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertDB = $this->db->query($q, ["$agency", "$hodtoaprove", "$flightprocessBy", "$approval", "$exCode", "$diff", "$staffName", "$tFromlocation", "$tTolocation", "$exsDate", "$exrDate", "$purpose", "$processFlight", "$staffType"]);

        if ($this->db->affected_rows($insertDB) > 0) {
            $insertId = $this->db->insert_id();

            return $insertId;
        } else {

            return FALSE;
        }
    }

    

    public function getdstaffname($staffName) {
        $q = "SELECT * FROM travelstart WHERE `staffName` LIKE '%$staffName%'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }


    
    
     public function updatebatchhotel($hotelidArray, $batchCode, $batchedDate, $email) {
        $update = "UPDATE travel_hotel_bookings SET `status`='13', `batchCode` = '$batchCode', `dateBatched`='$batchedDate', `batchedBy`='$email' WHERE `hotel_id` IN($hotelidArray)";
        $this->db->query($update);
        return TRUE;
    }
    
     public function gettoalsum($hotelidArray) {
       $q = "SELECT SUM(sAmount) AS total FROM travel_hotel WHERE `id` IN ($hotelidArray)";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->total;
            }
        } else {
            return FALSE;
        }
    }
    
    
    
    
    public function getsumfromhotel($hotelidArray) {
       $q = "SELECT SUM(totalAmount) AS total FROM  travel_hotel_bookings WHERE `hotel_id` IN ($hotelidArray)";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->total;
            }
        } else {
            return FALSE;
        }
    }

    
    
    
    
     public function gethotelbygroup() {
        $q = "SELECT GROUP_CONCAT(hotel_id) as goID,  COUNT(hotel_type) as dcount, hotel_type, SUM(totalAmount) as total, status FROM `travel_hotel_bookings` WHERE status IN('6','7', '8') GROUP BY hotel_type";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    
    
    public function updatehotelid($array) {
        $update = "UPDATE travel_hotel_bookings SET `status`='9' WHERE `hotel_id` IN ($array)";
        $this->db->query($update);
        return TRUE;
    }
    
     public function rejectupdatehotelid($array) {
        $update = "UPDATE travel_hotel_bookings SET `status`='5' WHERE `hotel_id` IN ($array)";
        $this->db->query($update);
        return TRUE;
    }
    
     public function batchedbystatus($id) {
        $update = "UPDATE batchedflights SET `batchedStatus`='verified' WHERE `id` = ($id)";
        $this->db->query($update);
        return TRUE;
    }
    
    public function rejectedbatched($id) {
        $update = "UPDATE batchedflights SET `batchedStatus`='rejected' WHERE `id` = ($id)";
        $this->db->query($update);
        return TRUE;
    }
    
    
    
     public function getaccountcodeonly($unit, $start, $end, $status) {
      //$q = "SELECT id, dUnit, enumType, datepaid, SUM(dAmount) as dAmount, approvals FROM cash_newrequestdb WHERE `dUnit`='$unit' AND `enumType`='$dex' AND `datepaid` >= '$start' AND `datepaid` <= '$end' AND `approvals` IN('$status') GROUP BY dUnit";
      $q = "SELECT GROUP_CONCAT(id) as unitID FROM cash_newrequestdb WHERE dUnit ='$unit' AND `datepaid` >= '$start' AND `datepaid` <= '$end' AND `approvals` IN('$status')";
       
       $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->unitID;
            }
        }
        
        else{
            return FALSE;
        }
        
    }
    
    
    
      public function getcash_secondtable($table, $array) {
        //$q = "SELECT * FROM $table WHERE `requestID ` IN ($array)";
        $q = "SELECT requestID, sess, ex_Code,  COUNT(ex_Code) as accountCode, SUM(ex_Amount) as Total FROM `$table` where requestID IN($array) GROUP BY ex_Code";
        
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
    
    
 //////////////////////////////////////////////////// NEW TRAVEL REQUEST MODEL ///////////////////////////////////////
    
     public function gettravelrequest() {
        $q = "SELECT * FROM travelstart ORDER BY id DESC LIMIT 10";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
      public function gettravelrequestwithid($id) {
        $q = "SELECT * FROM travelstart WHERE id = '$id'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
      public function gettraveldetailstart($start) {
        $q = "SELECT * FROM travelstart WHERE dateCreated >= '$start'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
     public function gettraveldetailstartend($start, $end) {
        $q = "SELECT * FROM travelstart WHERE dateCreated >= DATE('$start') AND dateregistered <= DATE('$end')";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
/////////////////////////////////////////////////// END OF NEW TRAVEL REQUEST MODEL//////////////////////////////////
   
     public function getallstaffdata() {
        //$q = "SELECT * FROM staffdata WHERE status='1' AND del='0'";
       $q = "SELECT * FROM staffdata_mgmt WHERE `cid` IN (select `id` from companies where `client`= '2') AND `status` IN ('1', '4', '7', '6') order by name desc";
        $run_q = $this->db3->query($q);

       if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
      public function getemployment($sid) {
        //$q = "SELECT * FROM staffdata WHERE status='1' AND del='0'";
       $q = "SELECT * FROM employment WHERE `sid` = '$sid'";
        $run_q = $this->db3->query($q);

       if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
     public function geteducation($sid) {
        //$q = "SELECT * FROM staffdata WHERE status='1' AND del='0'";
       $q = "SELECT * FROM education WHERE `sid` = '$sid'";
        $run_q = $this->db3->query($q);

       if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
       public function getguarantor($sid) {
        //$q = "SELECT * FROM staffdata WHERE status='1' AND del='0'";
       $q = "SELECT * FROM guarantor WHERE `sid` = '$sid'";
        $run_q = $this->db3->query($q);

       if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    

}

// End of Class Prediction extends CI_Model