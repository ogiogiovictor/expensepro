<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Cashiermodel extends CI_Model{
	
	public function __contruct(){
		parent::__contruct();
	}
	
	/***** This controller returns all users ******/
  
   
        
          //Get the Category Type
    public function getalldetailsinlocation($getUserLocation){
       //$q = "SELECT * FROM cash_newrequestdb WHERE  dAccountgroup = ? AND approvals != '4'";
       $q = "SELECT * FROM cash_newrequestdb WHERE dLocation = '$getUserLocation' AND approvals ='3' AND nPayment='2'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
  
    
    public function getuserlocation($sessionEmail){
        $q = "SELECT uLocation FROM cash_usersetup WHERE email= '$sessionEmail'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->uLocation;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
      //Get the Category Type
    public function chequereadyprepare($id, $md5_id, $approvals){
       //$q = "SELECT * FROM cash_newrequestdb WHERE  dAccountgroup = ? AND approvals != '4'";
       $q = "SELECT * FROM cash_newrequestdb WHERE id = '$id' AND md5_id ='$md5_id' AND approvals='$approvals'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function getdgrouphebelongs($getAccountID, $dAccountgroup){
        $q = "SELECT gid, userid FROM cash_groupaccount WHERE userid IN ($getAccountID) AND gid='$dAccountgroup'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->gid;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
       //Get the Category Type
    public function getpaidbyme($sessionEmail){
       $q = "SELECT * FROM account_payable WHERE paidByAcct = '$sessionEmail' ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
      //Get the Category Type
    public function getpaidbymeadmin(){
       $q = "SELECT * FROM account_payable ORDER BY id DESC LIMIT 20";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
 ///////////////////////////////////////////SHOW BASED ON ACCOUNT GROUP /////////////////////////////////////////////////
    
     public function actgrouporthaourt(){
        $q = "SELECT userid FROM cash_groupaccount WHERE gid='2'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->userid;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
         //Get the Category Type
    public function getbygroupid(){
       $q = "SELECT * FROM cash_newrequestdb WHERE dAccountGroup = '2' AND approvals='3' AND npayment = '2'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function actgroupabuja(){
        $q = "SELECT userid FROM cash_groupaccount WHERE gid='3'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->userid;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
         //Get the Category Type
    public function getbygroupidabj(){
       $q = "SELECT * FROM cash_newrequestdb WHERE dAccountGroup = '3' AND approvals='3' AND npayment = '2'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
//////////////////////////////////////////END OF BASED GROUP ACCOUNTP //////////////////////////////////////////////////
    
    
          //Get the Category Type
    public function editrejectedrequestawait($id, $mdid, $sessionID){
       $q = "SELECT * FROM cash_newrequestdb WHERE id = '$id' AND md5_id ='$mdid' AND sessionID='$sessionID' AND approvals='1'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
    ///////////////////////////////////////////////ACCOUNT GROUP MUSHIN //////////////////////////////////////////////
    
     public function actgroupmushin(){
        $q = "SELECT userid FROM cash_groupaccount WHERE gid='6'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->userid;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
       //Get the Category Type
    public function getbygroupidmushin(){
       $q = "SELECT * FROM cash_newrequestdb WHERE dAccountGroup = '6' AND approvals='3' AND npayment = '2'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    //////////////////////////////////////////////END OF ACCOUNT GROUP MUSHIN ///////////////////////////////////////
    
     public function getdapprovals($id){
        $q = "SELECT approvals FROM cash_newrequestdb WHERE id='$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->approvals;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function getadminfloat(){
        $q = "SELECT userID FROM cash_accesslevel WHERE id='1'";
        
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
    
    
      //Get the Category Type
    public function getmaintenancenotpetty($sessionEmail){
       $q = "SELECT * FROM cash_newrequestdb WHERE cashiers = '$sessionEmail' AND approvals='3' AND npayment = '1'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function getitsupport(){
        $q = "SELECT approvedUser FROM cash_location WHERE id='2'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->approvedUser;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     //Get the Category Type
    public function getphandenugu(){
       $q = "SELECT * FROM cash_newrequestdb WHERE dLocation = '2' || dLocation = '8' || dLocation = '3' || dLocation = '6'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
         //Get the Category Type
    public function getdUnit($email){
       //$q = "SELECT * FROM cash_newrequestdb WHERE  dAccountgroup = ? AND approvals != '4'";
       $q = "SELECT * FROM cash_usersetup WHERE email = '$email'";
        
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
    public function draftreport($email){
        $q = "SELECT * FROM cash_newrequestdb WHERE sessionID = '$email' AND approvals ='0' ORDER BY id DESC LIMIT 1000";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }    
    
    
      //Get the Category Type
    public function unitcount($getmyUnit){
       $q = "SELECT count(id) as totalCount FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals NOT IN ('11', '0') ORDER BY id DESC";
         
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
           foreach($run_q->result() as $get){
                return $get->totalCount;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
      //Get the Category Type
    public function getdresult($getmyUnit){
       $q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals NOT IN ('11', '0') ORDER BY id DESC";
         
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
  
    
       //Get the Category Type
    public function getapprovedrequest($getmyUnit){
       //$q = "SELECT * FROM cash_newrequestdb WHERE  dUnit = '$getmyUnit' AND approvals='4' || dUnit = '$getmyUnit' AND approvals='8'  ";
        $q = "SELECT * FROM cash_newrequestdb WHERE  dUnit = '$getmyUnit' AND approvals='4' || dUnit = '$getmyUnit' AND approvals='8'  ";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function getrejectedrequest($getmyUnit){
       $q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals='5' || dUnit = '$getmyUnit' AND approvals='6' || dUnit = '$getmyUnit' AND approvals='12'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
      //Get the Category Type
    public function awaitingrequest($getmyUnit){
       $q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals='1' || dUnit = '$getmyUnit' AND approvals='2' || dUnit = '$getmyUnit' AND approvals='3'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
       //Get the Category Type
    public function getmyLocation($email){
       //$q = "SELECT * FROM cash_newrequestdb WHERE  dAccountgroup = ? AND approvals != '4'";
       $q = "SELECT * FROM cash_usersetup WHERE email = '$email'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
             foreach($run_q->result() as $get){
                return $get->uLocation;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     //Get the Category Type
    public function getsameunitbutnotlocation($getmyUnit, $getmyLocation){
       $q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND dLocation != '$getmyLocation'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
      //Get the Category Type
    public function limitedresults($getmyUnit){
       $q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' ORDER by id DESC LIMIT 4";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
      //Get the Category Type
    public function getallStaffinUnit($getmyUnit){
       $q = "SELECT * FROM cash_usersetup WHERE dUnit = '$getmyUnit' ORDER by id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
      //Get the Category Type
    public function getmyrequstbasedonmyemail($myemail){
     $q = "SELECT * FROM cash_newrequestdb WHERE sessionID = '$myemail' AND approvals != '5'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
      //Get the Category Type
    public function getourlocation(){
       $q = "SELECT * FROM cash_location";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
      //Get the Amount from the lang Checkbox
    public function getresultbyrequest($status, $catStartDate, $catEndDate){
         $q = "SELECT * FROM cash_newrequestdb WHERE approvals IN ($status) AND dateCreated >= '$catStartDate' AND dateCreated <= '$catEndDate' ORDER BY id DESC";
      
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
      //Get the Category Type
    public function getpaymentCode($id){
       //$q = "SELECT * FROM cash_newrequestdb WHERE  dAccountgroup = ? AND approvals != '4'";
       $q = "SELECT * FROM cash_newrequestdb WHERE id = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
             foreach($run_q->result() as $get){
                return $get->userCode;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function getpaymentType($id){
       //$q = "SELECT * FROM cash_newrequestdb WHERE  dAccountgroup = ? AND approvals != '4'";
       $q = "SELECT * FROM cash_newrequestdb WHERE id = '$id'";
        
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
    
    
     public function getdAmountfromUser($id){
       //$q = "SELECT * FROM cash_newrequestdb WHERE  dAccountgroup = ? AND approvals != '4'";
       $q = "SELECT * FROM cash_newrequestdb WHERE id = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
             foreach($run_q->result() as $get){
                return $get->dAmount;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
  
    
      //Get the Category Type
    public function getadminfloatfromgroup(){
       $q = "SELECT * FROM cash_newrequestdb WHERE dAccountgroup = '10' AND approvals='3' AND npayment = '2'";
       //$q = "SELECT * FROM cash_newrequestdb WHERE dAccountgroup = '7' AND approvals='3' AND npayment = '2'"; // LocalHost
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
   
    
      //Get the Category Type
    public function getTotoalAmount($getmyUnit){
       //$q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals='4' OR approvals='8'";
       $q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals = '4' || dUnit = '$getmyUnit' AND approvals = '8' ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     //Get the Category Type
    public function getsearchResulthod($getmyUnit, $dateCreatedfrom, $dateCreatedTo, $status){
       //$q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals= '1' || approvals= '2' || approvals= '3' AND dateCreated >= '$dateCreatedfrom' AND dateCreated <= '$dateCreatedTo'";
       $q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals IN ('1', '2', '3') AND dateCreated >= '$dateCreatedfrom' AND dateCreated <= '$dateCreatedTo'";
       
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     
     //Get the Category Type
    public function getcashieraccountapproved($getmyUnit, $dateCreatedfrom, $dateCreatedTo){
       //$q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals='4' OR approvals='8'";
         $q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals IN ('4', '8') AND dateCreated >= '$dateCreatedfrom' AND dateCreated <= '$dateCreatedTo'";
       // $q = "SELECT * FROM cash_newrequestdb WHERE (dateCreated >= '$dateCreatedfrom' AND dateCreated <= '$dateCreatedTo') AND dUnit = '$getmyUnit' AND approvals IN ($status)";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function getrejectedrequestbyhod($getmyUnit, $dateCreatedfrom, $dateCreatedTo, $status){
       //$q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals='4' OR approvals='8'";
        $q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals IN ('5', '6', '12) AND dateCreated >= '$dateCreatedfrom' AND dateCreated <= '$dateCreatedTo'";
       // $q = "SELECT * FROM cash_newrequestdb WHERE (dateCreated >= '$dateCreatedfrom' AND dateCreated <= '$dateCreatedTo') AND dUnit = '$getmyUnit' AND approvals IN ($status)";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
   
    
     public function getmypaymentType($id){
       //$q = "SELECT * FROM cash_newrequestdb WHERE  dAccountgroup = ? AND approvals != '4'";
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
    
 
     public function editcashiersonly($id, $mdID, $sessionID){
        $q = "SELECT id, ndescriptOfitem, cashiers, icus, sessionID, approvals, nPayment, dAmount, dLocation, dUnit FROM cash_newrequestdb WHERE id = '$id' AND md5_id = '$mdID' AND sessionID = '$sessionID' AND approvals = '3'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
   public function updatemycashier($changemycashier, $postID, $sessionID){
		$q = "UPDATE cash_newrequestdb SET `cashiers` = '$changemycashier'  WHERE id = '$postID' AND sessionID = '$sessionID'";
		$this->db->query($q);
                return $changemycashier;
    }   
    
  
     public function deleteExpenses($id) {
    $this->db->where('exid', $id);
    $this->db->delete('cash_newrequest_expensedetails');
    return TRUE;
    }
    
 
   
    
      public function getallrequestforstaff($email, $getmyUnit){
        $q = "SELECT * FROM cash_newrequestdb WHERE sessionID = '$email' AND dUnit = '$getmyUnit' AND approvals NOT IN ('11') ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
       public function getallrequestforstaffthatareapproved($email, $getmyUnit){
        $q = "SELECT * FROM cash_newrequestdb WHERE sessionID = '$email' AND dUnit = '$getmyUnit' AND approvals IN ('4', '8') ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
  
    
       //Get the Category Type
    public function getsameLocation($getmyUnit, $getmyLocation){
       $q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND dLocation = '$getmyLocation'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    public function getbobousers(){
        $q = "SELECT * FROM cash_usersetup WHERE activation = '1'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
      //Get the Category Type
    public function getallrequestfromunit(){
       //$q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals='4' OR approvals='8'";
       $q = "SELECT id,  COUNT(id) as count,  dUnit, SUM(dAmount) as totalprice FROM cash_newrequestdb WHERE approvals IN ('4', '8') GROUP BY dUnit";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return "";
        }
    }
    
    
      //Get the Category Type
    public function getallaccountcodesforsummary(){
       //$q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals='4' OR approvals='8'";
       $q = "SELECT requestID, COUNT(requestID) as request, ex_Amount, SUM(ex_Amount) as total, `ex_Code` FROM cash_newrequest_expensedetails WHERE `sess` !='' GROUP BY ex_Code";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return "";
        }
    }
    
    
    
     //Get the Category Type
    public function getmyuserfulldetals(){
       //$q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals='4' OR approvals='8'";
       $q = "SELECT id, `sessionID`, COUNT(sessionID) as myRequest, `dAmount`, SUM(dAmount) as total FROM cash_newrequestdb WHERE approvals IN ('4', '8') GROUP BY sessionID";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return "";
        }
    }
    
    
      public function getallstaffamountspent($getmyUnit){
        $q = "SELECT sessionID, dAmount, SUM(dAmount) as myTotal FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND approvals IN ('4', '8') GROUP BY sessionID";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
   
      //Get the Category Type
    public function getallmyrequstnow($email){
       $q = "SELECT * FROM cash_newrequestdb WHERE sessionID = '$email' AND approvals IN ('4', '8')";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
        //Get the Category Type
    public function getamountbyyear(){
        $q = "SELECT count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(dateCreated) YEAR FROM cash_newrequestdb WHERE dCashierwhopaid != '' AND approvals IN('4', '8') GROUP BY YEAR(dateCreated)";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
       //Get the Category Type
    public function getamountbyunits($getmyUnit){
       $q = "SELECT count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(dateCreated) YEAR FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4', '8') AND CurrencyType IN ('naira', 'NGN','') GROUP BY YEAR(dateCreated)";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
      //Get the Category Type
    public function getunityearbymonth($getmyUnit, $year){
       //$q = "SELECT count(*) AS SalesCount, SUM(dAmount) AS TotalSUM, YEAR(datepaid) YEAR, MONTH(datepaid) Month FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4', '8') GROUP BY YEAR(datepaid), MONTH(datepaid)";
       $q = "select count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(dateCreated) YEAR, MONTH(dateCreated) Month from cash_newrequestdb where extract(YEAR from dateCreated) = $year AND dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4', '8') AND CurrencyType IN ('naira', '') GROUP BY YEAR(dateCreated), MONTH(dateCreated)";
       $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
  public function bringmyunits($unitID){
        $q = "SELECT unitName FROM  cash_unit WHERE id='$unitID'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->unitName;
            }
        }
        
        else{
            return FALSE;
        }
    }
      
   
    
     //Get the Category Type
    public function bymonthexpense($getmyUnit, $year, $month){ 
       //$q = "select count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(datepaid) YEAR, MONTH(datepaid) Month from cash_newrequestdb where extract(YEAR from datepaid) = $year AND dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4', '8') GROUP BY YEAR(datepaid), MONTH(datepaid)";
       $q = "SELECT * FROM cash_newrequestdb WHERE MONTH(dateCreated) = $month AND YEAR(dateCreated) = $year AND dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4', '8') AND CurrencyType IN ('naira', '')";
       $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
       //Get the Category Type
    public function getbypettycash($getmyUnit){
       $q = "SELECT count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(dateCreated) YEAR FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4') GROUP BY YEAR(dateCreated)";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
  
       //Get the Category Type
    public function getbycheque($getmyUnit){
       $q = "SELECT count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(dateCreated) YEAR FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('8') AND CurrencyType IN ('naira', 'NGN', '') GROUP BY YEAR(dateCreated)";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
   
    
      //Get the Category Type
    public function getunityearbymonthbutpetty($getmyUnit, $year){
       //$q = "SELECT count(*) AS SalesCount, SUM(dAmount) AS TotalSUM, YEAR(datepaid) YEAR, MONTH(datepaid) Month FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4', '8') GROUP BY YEAR(datepaid), MONTH(datepaid)";
       $q = "select count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(dateCreated) YEAR, MONTH(dateCreated) Month from cash_newrequestdb where extract(YEAR from dateCreated) = $year AND dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4') GROUP BY YEAR(dateCreated), MONTH(dateCreated)";
       $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function bymonthexpenseforpetty($getmyUnit, $year, $month){ 
       //$q = "select count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(datepaid) YEAR, MONTH(datepaid) Month from cash_newrequestdb where extract(YEAR from datepaid) = $year AND dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4', '8') GROUP BY YEAR(datepaid), MONTH(datepaid)";
       $q = "SELECT * FROM cash_newrequestdb WHERE MONTH(dateCreated) = $month AND YEAR(dateCreated) = $year AND dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4')";
       $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
       //Get the Category Type
    public function getunityearbymonthbutcheque($getmyUnit, $year){
       //$q = "SELECT count(*) AS SalesCount, SUM(dAmount) AS TotalSUM, YEAR(datepaid) YEAR, MONTH(datepaid) Month FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4', '8') GROUP BY YEAR(datepaid), MONTH(datepaid)";
       $q = "select count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(dateCreated) YEAR, MONTH(dateCreated) Month from cash_newrequestdb where extract(YEAR from dateCreated) = $year AND dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('8') AND CurrencyType IN ('naira', 'NGN', '') GROUP BY YEAR(dateCreated), MONTH(dateCreated)";
       $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     //Get the Category Type
    public function bymonthexpenseforcheque($getmyUnit, $year, $month){ 
       //$q = "select count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(datepaid) YEAR, MONTH(datepaid) Month from cash_newrequestdb where extract(YEAR from datepaid) = $year AND dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4', '8') GROUP BY YEAR(datepaid), MONTH(datepaid)";
       $q = "SELECT * FROM cash_newrequestdb WHERE MONTH(dateCreated) = $month AND YEAR(dateCreated) = $year AND dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('8') AND CurrencyType IN ('naira', 'NGN', '')";
       $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
     
    
    
     public function actgrouphertz(){
        $q = "SELECT userid FROM cash_groupaccount WHERE gid='11'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->userid;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
           //Get the Category Type
    public function getbygroupidhertz(){
       $q = "SELECT * FROM cash_newrequestdb WHERE dAccountGroup = '11' AND approvals='3' AND npayment = '2'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
       //Get the Category Type
    public function getbygroupid_latest($accountGroup, $approval, $paymentType){
       $q = "SELECT * FROM cash_newrequestdb WHERE dAccountGroup IN($accountGroup) AND approvals='$approval' AND npayment = '$paymentType'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
} // End of Class Prediction extends CI_Model