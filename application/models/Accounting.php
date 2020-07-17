<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Accounting extends CI_Model{
	
	public function __contruct(){
		parent::__contruct();
	}
	
	/***** This controller returns all users ******/
    
    public function chequesentforpaymenta($id, $getbenName, $sessionID, $uid, $type){
		$q = "INSERT into cash_accounttable (requestID, paidTo, sessionEmail, sessionID, type, datePaid) VALUES(?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$id, $getbenName, $sessionID, $uid, $type]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
    }  
    
    
     public function updateothertablea($id, $datePaid, $sessionID){
		$q = "UPDATE cash_newrequest_expensedetails SET `datepaid`= '$datePaid', `sess` = '$sessionID', `approved` = 'yes', `approved_status` = '1'  WHERE requestID = '$id'";
		$this->db->query($q);
                return TRUE;
    }
    
    
     public function daccountwhopaysa($id, $sessionID, $approve, $datePaid, $madeprequestemail=""){
		$q = "UPDATE cash_newrequestdb SET  `dCashierwhopaid`= '$sessionID', `approvals`= '$approve', `datepaid` = '$datePaid', `paidRequest` = '$madeprequestemail' WHERE id = '$id'";
		$this->db->query($q);
                return $id;
    }   
    
    
    
     //Get the Category Type
    public function emailownerrequesta($id){
        $q = "SELECT id, sessionID FROM cash_newrequestdb WHERE id = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->sessionID;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
  
     //Get the Category Type
    public function descriptionofitema($id){
        $q = "SELECT id, sessionID, ndescriptOfitem FROM cash_newrequestdb WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->ndescriptOfitem;
            }
        }
        
        else{
            return FALSE;
        }
    }
   
    
                                       // $getTillName, $myurl, $getUserLocation, $getUserUnit, $appID, $id, $makedpaymebnt, $dUserID, $getAmount,              $approval, $_SESSION['email'], $getbenName, $sessionID
    public function sendtosuperaccounta($type, $dgroup="", $getTillName="", $myurl, $getUserLocation, $getUserUnit, $appID, $fmrequestID, $makedpaymebnt="", $sessionID, $sumlang, $approval, $sseionEmail="", $payee="", $paidByAcct=""){
		$q = "INSERT into account_payable (type, accountGroup, tillName, app_urL, Location, unit, app_ID, fmrequestID, accountPayableID, userID, Amount, approval, requesterEmail, paidTo, paidByAcct, datePaid) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$type, $dgroup, $getTillName, $myurl, $getUserLocation, $getUserUnit, $appID, $fmrequestID, $makedpaymebnt, $sessionID, $sumlang, $approval, $sseionEmail, $payee, $paidByAcct]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
    }
    
    
    
     public function updaterequestbyhodwhorejecta($approve, $dComment, $acceptrequestID, $sessionID){
		$q = "UPDATE cash_newrequestdb SET  `approvals`= '$approve', `addComment`= '$dComment', `dCashierwhorejected` = '$sessionID', `pendingHOD` = '', `dateRejected` = NOW() WHERE id = '$acceptrequestID'";
		$this->db->query($q);
                return $acceptrequestID;
	}
        
        
        
     public function dapprovalforequesta($acceptrequestID, $dComment, $sessionID){
		$q = "INSERT into cash_approvalreques (newrequesID, comment, sessionID, dateApproved) VALUES(?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$acceptrequestID, $dComment, $sessionID]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
      
        
    
     //Get the Category Type
    public function getdcashierreimbursementemail($id){
        $q = "SELECT sendbythiscashier FROM account_payable WHERE id = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->sendbythiscashier;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    //Get the Category Type
    public function getdcashieriemdateSent($id){
        $q = "SELECT dateSent FROM account_payable WHERE id = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->dateSent;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    //Get the Category Type
    public function getmaincashieriemresult($id){
        $q = "SELECT * FROM account_payable WHERE id = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
           return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
       
    
    
         //Get the Category Type
    public function getresultbyID($value){
        //$q = "SELECT COUNT(requestID) AS 'actID', `ex_Amount`, SUM(ex_Amount) AS 'Total', ex_Code as dCode FROM cash_newrequest_expensedetails WHERE requestID ='$value' GROUP BY ex_Code";
        $q = "SELECT COUNT(requestID) AS 'actID', `ex_Amount`, SUM(ex_Amount) AS 'Total', ex_Code as dCode FROM cash_newrequest_expensedetails WHERE requestID IN ($value) GROUP BY ex_Code";
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
         //Get the Category Type
    public function allmyaccountcode($value){
        $q = "SELECT * FROM cash_newrequest_expensedetails WHERE requestID ='$value' GROUP BY ex_Code";

        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function returnallcodebaseonvalue($id){
        $q = "SELECT ex_Code FROM cash_newrequest_expensedetails WHERE requestID = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
        
    
 public function updatechequerequesta($hasentbycashier, $type, $sessionEmail, $dateprepared, $cashiserEmail, $newamounts, $newid){  
    $update = "UPDATE account_payable SET `approval`='1', `hasentbycashier`='$hasentbycashier', `type`='$type', `datePaid`='$dateprepared',  `paidByAcct`='$sessionEmail', `requesterEmail`='$cashiserEmail' WHERE `id`='$newid' AND `Amount` = '$newamounts'";
       $this->db->query($update);
        return TRUE;
	  
 }
 
 
 
 
  //Get the Category Type
    public function usepostidgetillname($id){
        $q = "SELECT tillName FROM tillbalances WHERE id = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->tillName;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
  
    
  //Get the Category Type
    public function getTillemail($id){
        $q = "SELECT cashierEmail FROM tillbalances WHERE id = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->cashierEmail;
            }
        }
        
        else{
            return FALSE;
        }
    }
 
    
    
 public function insertamountdetails($dateprepared, $firsttillamount, $tillName, $cashiserEmail, $sessionEmail){
		$q = "INSERT into tillhistory (dateApproved, dAmount, tillName, dPayee, whoApproved, datePrepared) VALUES(?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$dateprepared, $firsttillamount, $tillName, $cashiserEmail, $sessionEmail]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
                       
                }
        }
        
        
   public function rundraftupdate($dateCreated, $descItem, $benName, $dUnit, $paymentType, $dComment, $dhod, $dicu, $dcashier, $daccountant, $sessionEmail, $approvals, $uLocation, $fullname, $hideID, $mdID){  
    $update = "UPDATE cash_newrequestdb SET `dateCreated`='$dateCreated', `ndescriptOfitem`='$descItem', `benName`='$benName', `dUnit`='$dUnit',  `nPayment`='$paymentType', `requesterComment`='$dComment', `hod`='$dhod', `icus`='$dicu', `cashiers`='$dcashier', `dAccountgroup`='$daccountant', `sessionID`='$sessionEmail', `approvals`='$approvals', `fullname`='$sessionEmail', `dLocation`='$uLocation', `dateRegistered` = NOW() WHERE `id`='$hideID' AND `md5_id` = '$mdID'";
       $this->db->query($update);
        return $hideID;
	  
 }
 
  public function updateTotalAmount($sumall, $insertedFileId){
		$q = "UPDATE cash_newrequestdb SET  `dAmount`= '$sumall' WHERE id = '$insertedFileId'";
		$this->db->query($q);
                return $insertedFileId;
    }
    
 
 public function expensedetailsfromdbadvancerequest($data, $exid){
        //$this->db->where('exid', $id);
        $this->db->update_batch('cash_newrequest_expensedetails', $data, $exid);
          return true;
        }
 
        
  public function pushUpdate($exid, $exAmount, $exDetailofpayment, $exCode, $exDate){
		$q = "UPDATE cash_newrequest_expensedetails SET ex_Amount = '$exAmount', ex_Details = '$exDetailofpayment', ex_Code = '$exCode', ex_Date = '$exDate' WHERE exid = '$exid'";
		$this->db->query($q);
                return TRUE;
    }      
        
 
    
    
     //Get the Category Type
    public function checkmyid($id){
        $q = "SELECT approval FROM account_payable WHERE id = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->approval;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
      //Get the Category Type
    public function requesterEmailwhosentit($id){
        $q = "SELECT sendbythiscashier FROM account_payable WHERE id = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->sendbythiscashier;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    public function meExist($ex_id){
        $q = "SELECT exid FROM cash_newrequest_expensedetails WHERE exid = '$ex_id'";
         $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return TRUE;
        }
        
        else{
            return "";
        }
    }
    
    
     public function InsertExpenseUpdate($ex_Amount, $ex_Detailofpayment, $ex_Code, $ex_Date, $hideID){
		$q = "INSERT into cash_newrequest_expensedetails (ex_Amount, ex_Details, ex_Code, ex_Date, requestID) VALUES(?, ?, ?, ?, ?)";
		$insertDB = $this->db->query($q, [$ex_Amount, "$ex_Detailofpayment", $ex_Code, $ex_Date, $hideID]);
		   
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
	}
    
    
     public function mypushUpdate($exid, $exAmount, $exDetailofpayment, $exCode, $exDate){
		$q = "UPDATE cash_newrequest_expensedetails SET `ex_Amount` = '".$exAmount."', `ex_Details` = '".$exDetailofpayment."', `ex_Code` = '".$exCode."', `ex_Date` = '".$exDate."' WHERE `exid` = '$exid'";
		$this->db->query($q);
                return TRUE;
    }   
    
    
    
    
      //Get the Category Type
    public function getcurrType($id){
        //$q = "SELECT fmrequestID FROM account_payable WHERE fmrequestID IN (SELECT id FROM cash_newrequestdb WHERE id = '$id')";
        $q = "SELECT CurrencyType FROM cash_newrequestdb WHERE id = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->CurrencyType;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Amount from the lang Checkbox
    public function paychequenow($catStartDate, $catEndDate, $sessionID){
        //$q = "SELECT * FROM cash_newrequestdb WHERE dCashierwhopaid = '$sessionID' AND datepaid >= '$catStartDate' AND datepaid <= '$catEndDate' AND nPayment = '2'";
         $q = "SELECT * FROM cash_newrequest_expensedetails WHERE sess = '$sessionID' AND datepaid >= '$catStartDate' AND datepaid <= '$catEndDate'";
         
         
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
  
    
      //Get the Amount from the lang Checkbox
    public function getonlycheques($id){
       $q = "SELECT DISTINCT id FROM cash_newrequestdb WHERE id IN ($id) AND nPayment = '2'";
              
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
  
    
    //Get the Amount from the lang Checkbox
    public function getcashexpensedetails($id){
         $q = "SELECT * FROM cash_newrequest_expensedetails WHERE requestID IN ($id)";
                  
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function gettypeCheque($id){
        $q = "SELECT * FROM cash_newrequestdb WHERE id = '$id' AND nPayment = '2'";
        
        $run_q = $this->db->query($q);
         if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function getdetailsforchequebranceh($id){
        $q = "SELECT * FROM cash_newrequest_expensedetails WHERE requestID = '$id'";
        
        $run_q = $this->db->query($q);
         if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        else{
            return FALSE;
        }
    }
    
    
    
      //Get the Category Type
    public function getnPaymentType($id){
        //$q = "SELECT fmrequestID FROM account_payable WHERE fmrequestID IN (SELECT id FROM cash_newrequestdb WHERE id = '$id')";
        $q = "SELECT nPayment FROM cash_newrequestdb WHERE id = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->nPayment;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function returnmyunit($id){
        //$q = "SELECT fmrequestID FROM account_payable WHERE fmrequestID IN (SELECT id FROM cash_newrequestdb WHERE id = '$id')";
        $q = "SELECT dUnit FROM cash_newrequestdb WHERE id = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->dUnit;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     //Get the Category Type
    public function checkificuhaseen($id){
        $q = "SELECT icuhaseen FROM account_payable WHERE id = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->icuhaseen;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
      public function confirmtoyes($newid){
		$q = "UPDATE account_payable SET `icuhaseen` = 'yes'  WHERE `id` = '$newid'";
		$this->db->query($q);
                return TRUE;
    }   
    
    
        //Get the Category Type
    public function uploadocument($id, $mdid, $sessionID){
       $q = "SELECT * FROM cash_newrequestdb WHERE id = '$id' AND md5_id ='$mdid' AND sessionID='$sessionID' AND approvals IN ('1', '2','5', '0', '10', '6', '15')";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
} // End of Class Prediction extends CI_Model