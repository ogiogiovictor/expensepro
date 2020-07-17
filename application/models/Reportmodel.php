<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reportmodel extends CI_Model{
	
	public function __contruct(){
		parent::__contruct();
	}
	
	/***** This controller returns all users ******/
  
     
    //Get the Category Type
    public function getamountbyyear(){
        $q = "SELECT count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(dateCreated) YEAR FROM cash_newrequestdb WHERE dCashierwhopaid != '' AND approvals IN('4', '8') AND `CurrencyType` IN ('naira', 'NGN', '') GROUP BY YEAR(dateCreated)";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function getawaitingapprovalicuonly($year){
        //$q = "SELECT SUM(dAmount) AS TotalSUMicu, YEAR(dateCreated) YEARICU FROM cash_newrequestdb WHERE approvals IN('3') GROUP BY YEAR(dateCreated)";
        $q = "SELECT SUM(dAmount) AS TotalSUMicu, YEAR(dateCreated) YEARICU FROM cash_newrequestdb WHERE YEAR(dateCreated) = $year AND approvals IN('3') AND `CurrencyType` IN ('naira', 'NGN', '') ";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->TotalSUMicu;
            }
            
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     //Get the Category Type
    public function getunityearbymonth($year){
       //$q = "SELECT count(*) AS SalesCount, SUM(dAmount) AS TotalSUM, YEAR(datepaid) YEAR, MONTH(datepaid) Month FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4', '8') GROUP BY YEAR(datepaid), MONTH(datepaid)";
       $q = "SELECT count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(dateCreated) YEAR, MONTH(dateCreated) Month from cash_newrequestdb where extract(YEAR from dateCreated) = $year AND dCashierwhopaid != '' AND approvals IN('4', '8') AND `CurrencyType` IN ('naira', 'NGN', '') GROUP BY YEAR(dateCreated), MONTH(dateCreated)";
      
       $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
      //Get the Category Type
    public function getyearawaitingrequest($month, $year){
        //$q = "SELECT count(*) AS RequestCount, SUM(dAmount) AS TotalSUMicu, YEAR(dateCreated) YEARICU,  MONTH(dateCreated) Month FROM cash_newrequestdb WHERE extract(YEAR from dateCreated) = $year AND approvals IN('3') GROUP BY YEAR(dateCreated), MONTH(dateCreated)";
        $q = "SELECT count(*) AS RequestCount, SUM(dAmount) AS TotalSUMicu, YEAR(dateCreated) YEARICU,  MONTH(dateCreated) Month FROM cash_newrequestdb WHERE extract(MONTH from dateCreated) = $month  AND extract(YEAR from dateCreated) = $year AND approvals IN('3') AND `CurrencyType` IN ('naira', 'NGN' '') GROUP BY YEAR(dateCreated), MONTH(dateCreated)";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->TotalSUMicu;
            }
            
        }
        
        else{
            return "";
        }
    }
    
    
    
     //Get the Category Type
    public function byunitmonthyear($year, $month){ 
       $q = "SELECT count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(dateCreated) YEAR, MONTH(dateCreated) Month, dUnit FROM cash_newrequestdb WHERE MONTH(dateCreated) = $month AND YEAR(dateCreated) = $year AND dCashierwhopaid != '' AND approvals IN('4', '8') AND `CurrencyType` IN ('naira', 'NGN', '') GROUP BY dUnit, Month";
       $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function byunitunpaid($year, $month){ 
       $q = "SELECT count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(dateCreated) YEAR, MONTH(dateCreated) Month, dUnit FROM cash_newrequestdb WHERE MONTH(dateCreated) = $month AND YEAR(dateCreated) = $year AND  approvals IN('3') AND `CurrencyType` IN ('naira', 'NGN', '') GROUP BY dUnit, Month";
       $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    //Get the Category Type
    public function bytransactionforunits($getmyUnit, $year, $month){ 
       //$q = "select count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(datepaid) YEAR, MONTH(datepaid) Month from cash_newrequestdb where extract(YEAR from datepaid) = $year AND dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4', '8') GROUP BY YEAR(datepaid), MONTH(datepaid)";
       $q = "SELECT * FROM cash_newrequestdb WHERE MONTH(dateCreated) = $month AND YEAR(dateCreated) = $year AND dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4', '8') AND `CurrencyType` IN ('naira', 'NGN', '')";
       $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function byunpaidtrans($getmyUnit, $year, $month){ 
       //$q = "select count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(datepaid) YEAR, MONTH(datepaid) Month from cash_newrequestdb where extract(YEAR from datepaid) = $year AND dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4', '8') GROUP BY YEAR(datepaid), MONTH(datepaid)";
       $q = "SELECT * FROM cash_newrequestdb WHERE MONTH(dateCreated) = $month AND YEAR(dateCreated) = $year AND dUnit = '$getmyUnit' AND approvals IN('2', '3') AND `CurrencyType` IN ('naira', 'NGN', '')";
       $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
      //Get the Category Type
    public function othercurrencies(){
        $q = "SELECT count(*) AS RequestCountng, SUM(dAmount) AS TotalSUMng, YEAR(dateCreated) YEARng FROM cash_newrequestdb WHERE dCashierwhopaid != '' AND approvals IN('4', '8') AND CurrencyType NOT IN ('naira', 'NGN', '') GROUP BY YEAR(dateCreated)";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function getcurrencytypeforall($year){ 
       $q = "SELECT count(*) AS RequestCounted, SUM(dAmount) AS TotalSUMed, YEAR(dateCreated) YEARed, CurrencyType FROM cash_newrequestdb WHERE YEAR(dateCreated) = $year AND dCashierwhopaid != '' AND approvals IN('4', '8') AND CurrencyType NOT IN ('naira', 'NGN', 'null', '') GROUP BY CurrencyType, YEARed";
       $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    //Get the Category Type
    public function currencybytransact($currency, $year){ 
       //$q = "select count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(datepaid) YEAR, MONTH(datepaid) Month from cash_newrequestdb where extract(YEAR from datepaid) = $year AND dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4', '8') GROUP BY YEAR(datepaid), MONTH(datepaid)";
       $q = "SELECT * FROM cash_newrequestdb WHERE YEAR(dateCreated) = $year AND dCashierwhopaid != '' AND approvals IN('4', '8') AND `CurrencyType` = '$currency'";
       $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    //Get the Category Type
    public function sortbymonthandcurrency($year){ 
       //$q = "select count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(datepaid) YEAR, MONTH(datepaid) Month from cash_newrequestdb where extract(YEAR from datepaid) = $year AND dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4', '8') GROUP BY YEAR(datepaid), MONTH(datepaid)";
       $q = "SELECT count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(dateCreated) YEAR, MONTH(dateCreated) Month, `CurrencyType` from cash_newrequestdb where extract(YEAR from dateCreated) = $year AND dCashierwhopaid != '' AND approvals IN('4', '8') AND CurrencyType NOT IN ('naira', 'NGN', '') GROUP BY CurrencyType, YEAR(dateCreated), MONTH(dateCreated)";
       $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    //Get the Category Type
    public function getcurrmonthyear($year, $month, $currency){ 
       //$q = "select count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(datepaid) YEAR, MONTH(datepaid) Month from cash_newrequestdb where extract(YEAR from datepaid) = $year AND dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('4', '8') GROUP BY YEAR(datepaid), MONTH(datepaid)";
       $q = "SELECT * FROM cash_newrequestdb WHERE MONTH(dateCreated) = $month AND YEAR(dateCreated) = $year AND CurrencyType = '$currency' AND dCashierwhopaid != '' AND approvals IN('4', '8') AND `CurrencyType` NOT IN ('naira', 'NGN', '')";
       $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
   
    
     //Get the Category Type
    public function getbyohtercurrencies($getmyUnit){
       $q = "SELECT count(*) AS RequestCount, SUM(dAmount) AS TotalSUM, YEAR(dateCreated) YEAR, CurrencyType FROM cash_newrequestdb WHERE dUnit = '$getmyUnit' AND dCashierwhopaid != '' AND approvals IN('8') AND CurrencyType NOT IN ('naira', 'NGN', '') GROUP BY YEAR(dateCreated), CurrencyType";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
} // End of Class Prediction extends CI_Model