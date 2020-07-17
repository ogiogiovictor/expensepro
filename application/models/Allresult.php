<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Allresult extends CI_Model{
	
	public function __construct(){
		parent::__construct();
                $this->db2 = $this->load->database('assetmanagement', TRUE);
	}
	
	/***** This controller returns all users ******/
  
        
   public function getalltaxresult(){
        $q = "SELECT * FROM cash_govtlevies_vat";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function calucatevatresult($vat, $vatactnumber, $vatPercent, $vattext){
		$q = "UPDATE cash_govtlevies_vat SET  `vat`= '$vat', `account_vat`= '$vatactnumber', `vat_percentage` = '$vatPercent'  WHERE vattext = '$vattext'";
		$this->db->query($q);
                return TRUE;
	}
        
        
        
      public function getallwitholdingtaxresult(){
        $q = "SELECT * FROM cash_govtlevies_withold";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
        
    
    
     public function calucatewitholdtaxresult($details, $witholding, $actwitholdnumber, $witholdingtaxPercent, $withholdtext){
		$q = "INSERT into cash_govtlevies_withold (detailsDesc, withold_tax, account_withold_tax, witholdtax_percentage, withold_tax_text) VALUES(?, ?, ?, ?, ?)";
		$insertDB = $this->db->query($q, [$details, $witholding, $actwitholdnumber, $witholdingtaxPercent, $withholdtext]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
    } 
    
  
    
   //Get the Category Type
    public function getgroupname($id){
        $q = "SELECT * FROM cash_groupicu WHERE icuid= ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
     public function getallgroups(){
        $q = "SELECT * FROM cash_groupicu";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    //Get the Category Type
    public function getuserName($id){
        $q = "SELECT * FROM cash_usersetup WHERE id= ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
    
    public function getindivilduallimit(){
        $q = "SELECT * FROM individual_icu_limit";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function getvatpercent($vat){
        $q = "SELECT vat_percentage FROM cash_govtlevies_vat WHERE vattext= ?";
        
        $run_q = $this->db->query($q, [$vat]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->vat_percentage;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    public function getwitholdtax($id){
        $q = "SELECT witholdtax_percentage FROM cash_govtlevies_withold WHERE id= ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->witholdtax_percentage;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
  
  public function addgovtlevies($addTotal, $mainAount, $vatcharge, $witholdingtax, $sessionID){
		$q = "INSERT into cash_vatandwithold (vatwht_requestID, vatwht_amount, tax, withold, byWho, date) VALUES(?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$addTotal, $mainAount, $vatcharge, $witholdingtax, $sessionID]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}   
    
        
    public function uploadaccounts($codeName, $codeNumber){
		$q = "INSERT into codeact (codeName,  codeNumber) VALUES(?, ?)";
		$insertDB = $this->db->query($q, [$codeName, $codeNumber]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
        
        
     //Get the Category Type
    public function myallrequest($email){
        //$q = "SELECT * FROM cash_newrequestdb WHERE sessionID = '$email' AND approvedHOD ='$email' || approvedICU='$email' || paidRequest='$email' ORDER BY id DESC LIMIT 1000";
        $q = "SELECT * FROM cash_newrequestdb WHERE sessionID = '$email' AND approvals='8' ||  paidRequest='$email'  ORDER BY id DESC LIMIT 1000";
        //$q = "SELECT * FROM cash_newrequestdb WHERE sessionID = '$email' AND paidRequest='$email'  ORDER BY id DESC LIMIT 1000";
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }    
    
    
    
    //Get the Category Type
    public function pendingrequest($email){
       // $q = "SELECT * FROM cash_newrequestdb WHERE sessionID = '$email' AND pendingHOD='$email' || pendingICU='$email' ORDER BY id DESC LIMIT 1000";
         $q = "SELECT * FROM cash_newrequestdb WHERE sessionID = '$email' AND approvals='1' || sessionID = '$email' AND approvals='2' || sessionID = '$email' AND approvals='3'  ORDER BY id DESC LIMIT 1000";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }    
    
    
     //Get the Category Type
    public function cancelledrequest($email){
        $q = "SELECT * FROM cash_newrequestdb WHERE sessionID = '$email' AND rejectedHOD='$email' || rejectedICU='$email' ORDER BY id DESC LIMIT 1000";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }    
    
    
    
    
     public function gettherequestid($id){
        $q = "SELECT f_requestID FROM cash_fileupload WHERE fid = ?";
        
        $run_q = $this->db->query($q, [$id]);
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->f_requestID;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
   
    public function deletedImage($id) {
    $this->db->where('fid', $id);
    $this->db->delete('cash_fileupload');
    return TRUE;
    }
    
    
    
     public function getimagename($id){
        $q = "SELECT imgUrl FROM maintenance_assets WHERE id= ?";
        
        $run_q = $this->db2->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->imgUrl;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function getExpenseID($id){
        $q = "SELECT requestID FROM cash_newrequest_expensedetails WHERE exid = ?";
        
        $run_q = $this->db->query($q, [$id]);
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->requestID;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    public function deleteExpenseDetails($id) {
    $this->db->where('exid', $id);
    $this->db->delete('cash_newrequest_expensedetails');
    return TRUE;
    }
    
    
      public function getmysessionresult($email){
        $q = "SELECT * FROM  cash_usersetup WHERE email = '$email'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     //Get the Category Type
    public function requesteralternative($requesterEmail){
        $q = "SELECT alternativeEmail FROM cash_usersetup WHERE email = '$requesterEmail'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->alternativeEmail;
            }
        }
        
        else{
            return "";
        }
    }
    
    
    
    public function allrequestindb($table, $column) {
        //$q = "SELECT count($column) as tcount FROM $table WHERE nPayment IN('1','2')";
        $q = "SELECT count($column) as tcount FROM $table";
      
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->tcount;
            }
        } else {
            return FALSE;
        }
    }
    
    
    public function tcount($table, $column) {
        $q = "SELECT count($column) as tcount FROM $table";
      
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->tcount;
            }
        } else {
            return FALSE;
        }
    }
    
    
    
    public function tcountpetteycash($table, $column, $type) {
        $q = "SELECT count($column) as tcount FROM $table WHERE nPayment = '$type'" ;
      
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->tcount;
            }
        } else {
            return FALSE;
        }
    }
    
    
    public function tcountcheque($table, $column, $type) {
        $q = "SELECT count($column) as tcount FROM $table WHERE nPayment = '$type'" ;
      
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->tcount;
            }
        } else {
            return FALSE;
        }
    }
    
    
    public function tcountravel($table, $column) {
        $q = "SELECT count($column) as tcount FROM $table WHERE enumType = 'travel'";
      
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->tcount;
            }
        } else {
            return FALSE;
        }
    }
    
    
     public function procurementR($table, $column) {
        $q = "SELECT count($column) as tcount FROM $table WHERE from_app_id = '3'";
      
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->tcount;
            }
        } else {
            return FALSE;
        }
    }
    
    
    
    
    public function unpaidcheque($table, $column) {
        $q = "SELECT count($column) as unpaid FROM $table WHERE nPayment = '2' AND approvals ='3' AND dICUwhoapproved !=''";
      
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->unpaid;
            }
        } else {
            return FALSE;
        }
    }
    
    
     public function paidcheque($table, $column) {
        $q = "SELECT count($column) as unpaid FROM $table WHERE nPayment = '2' AND approvals ='8' AND dCashierwhopaid !=''";
      
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->unpaid;
            }
        } else {
            return FALSE;
        }
    }
    
    
     public function mergingCheque($value){
        $q = "SELECT id, Amount, SUM(Amount) AS totalSum FROM account_payable WHERE id IN ($value)";
        $run_q = $this->db->query($q);
        
        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->totalSum;
            }
        } else {
            return FALSE;
        }
    }
    
    
     public function mergedwithand($column, $table, $wherecluase, $valueone, $wherecluasetwo, $valuetwo) {
      
        $q = "SELECT $column FROM $table WHERE $wherecluase = '".$valueone."' AND  $wherecluasetwo = '".$valuetwo."'"; 
       
        $run_q = $this->db->query($q);

         if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
    public function updateaccountpaymentcheque($chequeID){  
     $update = "UPDATE account_payable SET `bankStatement`='yes' WHERE `id` IN ('$chequeID')";
       $this->db->query($update);
        return TRUE;
	  
    }
    
    
    public function mergeCheck($chequeID){  
     $update = "UPDATE cheque_merged SET `bankStatement`='yes', acount_payable_status='1' WHERE `id` IN ('$chequeID')";
       $this->db->query($update);
        return TRUE;
	  
    }
    
    
} // End of Class Prediction extends CI_Model