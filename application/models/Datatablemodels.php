<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Datatablemodels extends CI_Model{
	
    
/////////////////////////////////////ANOTHER DATA TABLE SERVER SIDE EXAMPLE /////////////////////////////////////////////

      var  $chequeTable = "account_payable";
      var $columns = array("id", "datePaid", "Amount", "paidByAcct", "paidTo", "fmrequestID", "unit",  "tillName", "mergedPy");  
      var $column_order = array(null, null, "Amount", "paidByAcct", null, "unit");
            
    public function getpaidby(){
        
       $this->db->select($this->columns);
       $this->db->from($this->chequeTable);
          
            /*********IF CONDITION FOR SEARCH **************/
            if(isset($_POST["search"]["value"])){
                
                $this->db->like("Amount", $_POST["search"]["value"]);
                $this->db->or_like("paidByAcct", $_POST["search"]["value"]);
                //$this->db->or_like("requesterEmail", $_POST["search"]["value"]);
                $this->db->or_like("unit", $_POST["search"]["value"]);
            }
            /*********END IF CONDITION FOR SEARCH **************/ 
             /*********IF CONDITION FOR ORDER **************/
              if(isset($_POST["order"])){
                 $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']); 
              }else{
                  $this->db->order_by("id", "ASC");
              }
             /*********END OFIF CONDITION FOR ORDER **************/
    }



       public function makeDatabase(){
            $this->getpaidby();
            if($_POST["length"] != -1){
                $this->db->limit($_POST["length"], $_POST["start"]);
            }
            $query = $this->db->get();
            return $query->result();
        }
        

         public function get_data_filtered(){
            $this->getpaidby();
            $query = $this->db->get();
            return $query->num_rows();
        }

         public function getAll_data(){
            $this->db->select("*");
            $this->db->from($this->chequeTable);
            return $this->db->count_all_results();
        }
       

//////////////////////////////////END OF ANOTHER DATA TABLE SERVER SIDE EXAMPLE /////////////////////////////////////////        
             
        
  //SHOW ASSETS WHERE approve  = 0;
	public function getfullusers(){
        $q = "SELECT * FROM cash_usersetup WHERE activation = '1' AND accessLevel='7'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
   //Get the Amount from the lang Checkbox
    public function getrejectedrequest($cashiersactStartDatee, $cashiersactEndDate){
        $q = "SELECT * FROM cash_newrequestdb WHERE approvals = '5' || approvals = '6'  || approvals = '12' AND dateRejected >= '$cashiersactStartDatee' AND dateRejected <= '$cashiersactEndDate'";
        //$q = "SELECT * FROM cash_newrequestdb WHERE signature = '$sessionEmail' ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    

  ////////////////////////////////////////////////PAID TO /////////////////////////////////////////////////////
    
    //Get the Category Type
    public function getpaidTo($id){
        $q = "SELECT requestID, paidTo FROM cash_accounttable WHERE requestID= ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->paidTo;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function getpostid($tillID){
        $q = "SELECT postFirstAmount FROM tillbalances WHERE id= ?";
        
        $run_q = $this->db->query($q, [$tillID]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->postFirstAmount;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function allpostedvalue($tillID){
        $q = "SELECT addnewamount FROM tillbalances WHERE id= ?";
        
        $run_q = $this->db->query($q, [$tillID]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->addnewamount;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function gettillbalance($tillID){
        $q = "SELECT tillBalance FROM tillbalances WHERE id= ?";
        
        $run_q = $this->db->query($q, [$tillID]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->tillBalance ;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
      public function gettilllimit($tillID){
        $q = "SELECT cashierTillLimit FROM tillbalances WHERE id= ?";
        
        $run_q = $this->db->query($q, [$tillID]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->cashierTillLimit ;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    public function addnewmount($fullAmount, $allposteed, $tillID){  
    $update = "UPDATE tillbalances SET `tillBalance`='$fullAmount', `addnewamount`='$allposteed' WHERE `id`='$tillID'";
       $this->db->query($update);
        return TRUE;
	  
    }
 
 
 
    public function addtillhistory($date, $addAmount, $tillName, $cashieremail, $email){
		$q = "INSERT into tillhistory (datePrepared, dAmount, tillName, dPayee, whoApproved, dateApproved) VALUES(?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$date, $addAmount, $tillName, $cashieremail, $email]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
        
    
 ////////////////////////////////////////////END OF PAID TO ///////////////////////////////////////////////////
        
} // End of Class Prediction extends CI_Model