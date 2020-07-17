<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Tillbalances extends CI_Model{
	
	public function __contruct(){
		parent::__contruct();
	}
	
	/***** This controller returns all users ******/
    
  
      //Get the Current till Amount
    public function tillLimitsecondary($email){
        $q = "SELECT * FROM tillbalances WHERE cashierEmail = ? AND tillType = 'secondary' LIMIT 1";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->cashierTillLimit;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
  //Get the Current till Amount
    public function currenttillamountsecondary($email){
        $q = "SELECT * FROM tillbalances WHERE cashierEmail = ? AND tillType = 'secondary' LIMIT 1";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->tillAmount;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
  //Get the Category Type
    public function currentillbalancesecondary($email){
        $q = "SELECT * FROM tillbalances WHERE cashierEmail = ? AND tillType = 'secondary' LIMIT 1";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->tillBalance;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
   //Get the Category Type
    public function getcurrenttillexpense($cashierEmail, $tillID){
        $q = "SELECT * FROM tillbalances WHERE cashierEmail = ? AND id = ?";
        
        $run_q = $this->db->query($q, [$cashierEmail, $tillID]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->tillExpense;
            }
        }
        
        else{
            return FALSE;
        }
    }
      
 /***** UPDATE TILL BALANCE******/
	public function additiontillexpense($newBalanceforexpense, $cashierEmail, $tillID){
		 $update = "UPDATE tillbalances SET `tillExpense`='$newBalanceforexpense' WHERE `cashierEmail`='$cashierEmail' AND id='$tillID'";
        $this->db->query($update);
        return TRUE;
	}    
 
   //Get the Category Type
    public function getcurrentillExpensessecondary($email){
        $q = "SELECT tillExpense FROM tillbalances WHERE cashierEmail = ? AND tillType = 'secondary' LIMIT 1";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->tillExpense;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function gettotalamountcollected($dPayee){
        $q = "SELECT * FROM tillhistory WHERE dPayee = ?";
        
        $run_q = $this->db->query($q, [$dPayee]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    } 
    
    
    //Get the Current till Amount
    public function checkidforlocation($id){
        $q = "SELECT approvals FROM cash_newrequestdb WHERE id = ? AND hodwhoapprove != '' AND dICUwhoapproved != ''";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->approvals;
            }
        }
        
        else{
            return FALSE;
        }
    }
        
    
    /***** UPDATE TILL BALANCE******/
	public function changeupdatelocation($groupName, $locationchanging){
		 $update = "UPDATE cash_newrequestdb SET `dAccountgroup`='$groupName' WHERE `id`='$locationchanging'";
        $this->db->query($update);
        return TRUE;
	}    
    
        
        
          //Get the Category Type
    public function tillhistorynow($dPayee, $tillname){
        $q = "SELECT * FROM tillhistory WHERE dPayee = ? AND tillName = ?";
        
        $run_q = $this->db->query($q, [$dPayee, $tillname]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    } 
    
        
} // End of Class Prediction extends CI_Model