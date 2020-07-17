<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Adminmodel extends CI_Model{
	
	public function __contruct(){
		parent::__contruct();
	}
	
	/***** This controller returns all users ******/
    
     //Get the Category Type
    public function getadminonly(){
        $q = "SELECT * FROM cash_newrequestdb";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
	
   
   public function getdUnit($unit){
        $q = "SELECT * FROM cash_unit WHERE unitName = ?";
        
        $run_q = $this->db->query($q, [$unit]);
        
        if($run_q->num_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }
	
  
    
  public function inserttoUnit($category){
		$q = "INSERT into cash_unit (unitName) VALUES(?)";
		$insertDB = $this->db->query($q, [$category]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
        
  
     //Get the Category Type
    public function searchresultdetails($sessionID, $startDateall, $endDateall){
        $q = "SELECT * FROM cash_newrequestdb WHERE `dCashierwhopaid` = '$sessionID' AND `datepaid` >= '$startDateall' AND `datepaid` <='$endDateall' ";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function postadvancesearchresult($sessionID, $startDateall, $endDateall, $dacctCode){
        $sql = "SELECT * FROM  cash_newrequest_expensedetails WHERE sess = '$sessionID' AND ex_Code = '$dacctCode' AND `datepaid` >= '$startDateall' AND `datepaid` <='$endDateall' ";
        
        $run_q = $this->db->query($sql);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
      //Get the Category Type
    public function postadvancesearchresultwithall($sessionID, $startDateall, $endDateall){
        $sql = "SELECT * FROM  cash_newrequest_expensedetails WHERE sess = '$sessionID' AND `datepaid` >= '$startDateall' AND `datepaid` <='$endDateall' ORDER BY ex_Code ";
        
        $run_q = $this->db->query($sql);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     //Get the Category Type
    public function searchresultdetailsbyadmin($startDateall, $endDateall){
        $q = "SELECT * FROM cash_newrequestdb WHERE `datepaid` >= '$startDateall' AND `datepaid` <='$endDateall' ORDER By dCashierwhopaid DESC ";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
      //Get the Category Type
    public function searchresultdetailsbycategory($sessionID, $catStartDate, $catEndDate, $itemCat){
        $q = "SELECT * FROM cash_newrequestdb WHERE `dCashierwhopaid` = '$sessionID' AND `nCategory` = '$itemCat' AND `datepaid` >= '$catStartDate' AND `datepaid` <='$catEndDate' ";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
       //Get the Category Type
    public function getbygroupgroupbycategory($datefromsummary, $dateendsummary){
         ////SELECT COUNT(id), `nCategory`, SUM(dAmount) AS 'Total' FROM cash_newrequestdb GROUP BY nCategory
       // $q = "SELECT COUNT(id) AS 'id', `nCategory`, SUM(dAmount) AS 'Total' FROM cash_newrequestdb WHERE `datepaid` >= '$datefromsummary' AND `datepaid` <='$dateendsummary' GROUP BY nCategory";
        $q = "SELECT COUNT(requestID) AS 'actID', `ex_Amount`, SUM(ex_Amount) AS 'Total', ex_Code as dCode FROM cash_newrequest_expensedetails WHERE datepaid >='$datefromsummary' AND datepaid <='$dateendsummary'  GROUP BY ex_Code";

        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    /////////////////////group account for creating accout group /////////////////////////////
     public function getgroupaccount($group){
        $q = "SELECT * FROM cash_groupaccount WHERE accountgroupName = ?";
        
        $run_q = $this->db->query($q, [$group]);
        
        if($run_q->num_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }
    
     public function insertToaccountgroup($dGroup){
		$q = "INSERT into cash_groupaccount (accountgroupName) VALUES(?)";
		$insertDB = $this->db->query($q, [$dGroup]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
        
     
       //Get the Category Type
    public function getaccountants(){
        $q = "SELECT * FROM cash_groupaccount";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    } 
    
    
       //Get the Category Type
    public function getreimbursementrequest(){
        $q = "SELECT * FROM cash_groupaccount WHERE gid='1' || gid='2' || gid='6'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    } 

    ////////////////////////////////BEGINNING OF BANK ALERT ///////////////////////////
     public function getbankallert($group){
        $q = "SELECT * FROM bankalert WHERE bankAlertgroup = ?";
        
        $run_q = $this->db->query($q, [$group]);
        
        if($run_q->num_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function insertbankgroup($dGroup){
		$q = "INSERT into bankalert (bankAlertgroup) VALUES(?)";
		$insertDB = $this->db->query($q, [$dGroup]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
   
        
       //Get the Category Type
    public function getallbankalert(){
        $q = "SELECT * FROM bankalert";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    } 

    
    
    //Get the Category Type
    public function getuserID($email){
        $q = "SELECT id, email FROM cash_usersetup WHERE email= ?";
        
        $run_q = $this->db->query($q, [$email]);
        
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
    public function getCashierEmail($id){
        $q = "SELECT id, email FROM cash_usersetup WHERE id= ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->email;
            }
        }
        
        else{
            return FALSE;
        }
    }

    
    
    
    public function tilrequest($tillsDate, $tilleDate, $tillAmount, $sseionEmail, $sessionID, $approve){
		$q = "INSERT into cashierstill (sDate, eDate, tillAmount, cashierEmail, cashierID, approval, dateSent) VALUES(?, ?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$tillsDate, $tilleDate, $tillAmount, $sseionEmail, $sessionID, $approve]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
        
    
        
    //Get the Current till Amount
    public function currenttillamount($email){
        $q = "SELECT * FROM tillbalances WHERE cashierEmail = ? AND tillType = 'primary' LIMIT 1";
        
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

    
    
     //Get the Current till Amount
    public function tillLimit($email){
        $q = "SELECT * FROM tillbalances WHERE cashierEmail = ? AND tillType = 'primary' LIMIT 1";
        
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
    public function getdtillamount($id){
        $q = "SELECT * FROM cashierstill WHERE id = ? LIMIT 1";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->tillAmount;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    //Get the Current till Amount
    public function getTillresult($id){
        $q = "SELECT * FROM account_payable WHERE id = ? ORDER BY id DESC LIMIT 1";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }

    
   //Get the Category Type
    public function currentillbalance($email){
        $q = "SELECT * FROM tillbalances WHERE cashierEmail = ? AND tillType = 'primary' LIMIT 1";
        
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
    public function getcurrentillExpenses($email){
        $q = "SELECT tillExpense FROM tillbalances WHERE cashierEmail = ? AND tillType = 'primary' LIMIT 1";
        
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
    public function gettillexpenses($email){
        $q = "SELECT * FROM tillbalances WHERE cashierEmail = ? LIMIT 1";
        
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
    
    
     //Get payment amount based on the ID
    public function getpaymentamount($id){
        $q = "SELECT * FROM cash_newrequestdb WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->dAmount;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get payment amount based on the ID
    public function gettheicugroup($id){
        $q = "SELECT * FROM cash_newrequestdb WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->icus;
            }
        }
        
        else{
            return FALSE;
        }
    }
 
    
    
     public function getdhodemailforapproval($id){
        $q = "SELECT * FROM cash_newrequestdb WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->hod;
            }
        }
        
        else{
            return FALSE;
        }
    }
 
    
    
      //Get the Amount from the lang Checkbox
    public function getonlyamount($lang){
        $q = "SELECT id, dAmount FROM cash_newrequestdb WHERE id IN ($lang)";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }

    
    
    public function sendtosuperaccount($getTillName="", $myurl, $getUserLocation, $getUserUnit, $appID, $fmrequestID, $makedpaymebnt="", $sessionID, $sumlang, $partAmount="", $approval, $sseionEmail="", $chequeNo="", $type="", $getBank="", $payee="", $paidByAcct="", $merged="", $vat="", $withold=""){
		$q = "INSERT into account_payable (tillName, app_urL, Location, unit, app_ID, fmrequestID, accountPayableID, userID, Amount, partpayAmount, approval, userEmail, chequeNo, type, dBank, paidTo, paidByAcct, mergedPy, vat, witholdtax, dateSent) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$getTillName, $myurl, $getUserLocation, $getUserUnit, $appID, $fmrequestID, $makedpaymebnt, $sessionID, $sumlang, $partAmount, $approval, $sseionEmail, $chequeNo, $type, $getBank, $payee, $paidByAcct, $merged, $vat, $withold]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
        
        
         public function sendtosuperaccountfromcashier($getTillName="", $myurl, $getUserLocation, $getUserUnit, $appID, $fmrequestID, $makedpaymebnt="", $sessionID, $sumlang, $partAmount="", $approval, $sseionEmail="", $chequeNo="", $type="", $getBank="", $payee="", $paidByAcct=""){
		$q = "INSERT into account_payable (tillName, app_urL, Location, unit, app_ID, fmrequestID, accountPayableID, userID, Amount, partpayAmount, approval, requesterEmail, chequeNo, type, dBank, paidTo, sendbythiscashier, paidByAcct, dateSent) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$getTillName, $myurl, $getUserLocation, $getUserUnit, $appID, $fmrequestID, $makedpaymebnt, $sessionID, $sumlang, $partAmount, $approval, $sseionEmail, $chequeNo, $type, $getBank, $payee, $payee, $paidByAcct]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
   
   /***** UPDATE TILL REQUEST TO 1 ******/
	public function updatecashiertillrequest($update, $value){
		 $update = "UPDATE cash_newrequestdb SET `cashiertillRequest`='$update' WHERE `id`='$value'";
        $this->db->query($update);
        return TRUE;
	}     
   
        
    //Get the Amount from the lang Checkbox
    public function getcashiertill(){
        $q = "SELECT * FROM account_payable WHERE amountPaid = '' AND approval = '0'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    //Get the Amount from the lang Checkbox
    public function getcashierlimit(){
        $q = "SELECT * FROM tillbalances";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function getallcashiers(){
        $q = "SELECT * FROM cash_usersetup WHERE accessLevel = '4'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
       //Get the Amount from the lang Checkbox
    public function checkCashier($id, $tillType){
        $q = "SELECT * FROM tillbalances WHERE cahsierTillID = ? AND tillType = ?";
        
        $run_q = $this->db->query($q, [$id, $tillType]);
        
        if($run_q->num_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }
    
    
      public function addCashier($newtillName, $chooseCashier, $getCashierEmail, $cashierLimit, $sessionEmail, $tillType){
		$q = "INSERT into tillbalances (tillName, cahsierTillID, cashierEmail, cashierTillLimit, addedBy, tillType) VALUES(?, ?, ?, ?, ?, ?)";
		$insertDB = $this->db->query($q, [$newtillName, $chooseCashier, $getCashierEmail, $cashierLimit, $sessionEmail, $tillType]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
    
        
      /***** UPDATE TILL REQUEST TO 1 ******/
	public function approvecashierstill($getTillAmount, $aid, $approval, $session, $datetime){
		 $update = "UPDATE account_payable SET `amountPaid`='$getTillAmount', `approval`='$approval', `paidByAcct`='$session', `datePaid`='$datetime'  WHERE `id`='$aid'";
        $this->db->query($update);
        return TRUE;
	}       
        
        
  public function getcashiertilldetails($cashierID, $tillName){
        $q = "SELECT * FROM tillbalances WHERE cahsierTillID = ? AND tillName = ?";
        
        $run_q = $this->db->query($q, [$cashierID, $tillName]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }  
    
    
     /***** UPDATE TILL REQUEST TO 1 ******/
	public function addTillamounttogeter($cashierID, $tillName, $newtillTotalAmount, $newtillBalance){
		 $update = "UPDATE tillbalances SET `tillAmount`='$newtillTotalAmount', `tillBalance`='$newtillBalance'  WHERE `cahsierTillID`='$cashierID' AND `tillName`='$tillName'";
        $this->db->query($update);
        return TRUE;
	}      
        
        
  public function getallaccountants(){
        $q = "SELECT * FROM cash_usersetup WHERE accessLevel = '7' || accessLevel = '8'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
   }
   
   
    public function getallaccountantspluscashiers(){
        $q = "SELECT * FROM cash_usersetup WHERE accessLevel = '7' || accessLevel = '8' || accessLevel = '4'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
   }
   
   
    public function getalltheicus(){
        $q = "SELECT * FROM cash_usersetup WHERE accessLevel = '3'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
   }
   
   
    public function getallactivatedusers(){
        $q = "SELECT * FROM cash_usersetup WHERE activation = '1'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
   }
   
   
    public function getcashierlevel(){
        $q = "SELECT * FROM cash_accesslevel WHERE id = '4'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
   }
   
   
   
   public function getccesslevel(){
        $q = "SELECT * FROM cash_accesslevel";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
   }
   
   
   
   public function getallgroup(){
        $q = "SELECT * FROM cash_groupaccount";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
   }
   
   
    public function getallicugroup(){
        $q = "SELECT * FROM cash_groupicu";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
   }
   
  //Return the Userid based on the group selected
    //Get the Category Type
    public function getuseridforgroup($dAccountGroup){
        $q = "SELECT userid FROM cash_groupaccount WHERE gid = ?";
        
        $run_q = $this->db->query($q, [$dAccountGroup]);
        
        if($run_q->num_rows() > 0){
           // foreach($run_q->result_array() as $get){
            foreach($run_q->result() as $get){
                //return $get['userid'];
                return $get->userid;
            } 
            
        }
        
        else{
            return FALSE;
        }
    }
 
    
 public function setControlforusers($finalResult, $dAccountGroup){  
    $update = "UPDATE cash_groupaccount SET `userid`='$finalResult'  WHERE `gid`='$dAccountGroup'";
       $this->db->query($update);
        return TRUE;
	  
 }
 
 
  public function setControlforicugroup($finalResult, $dicugroupname){  
    $update = "UPDATE cash_groupicu SET `userid`='$finalResult'  WHERE `icuid`='$dicugroupname'";
       $this->db->query($update);
        return TRUE;
	  
 }
 
 
 public function setascashier($dUser, $dLevel){  
    $update = "UPDATE  cash_usersetup SET `accessLevel`='$dLevel'  WHERE `id`='$dUser'";
       $this->db->query($update);
        return TRUE;
	  
 }
 
 
  public function checkforrequest($sseionEmail, $sessionID, $url){
        $q = "SELECT * FROM account_payable WHERE paidTo = ? AND userID = ? AND app_urL = ? AND approval  = '0'";
        
        $run_q = $this->db->query($q, [$sseionEmail, $sessionID, $url]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
              
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function getyourlimit($email, $getTillType){
        $q = "SELECT * FROM tillbalances WHERE cashierEmail = ? AND tillType = ?";
        
        $run_q = $this->db->query($q, [$email, $getTillType]);
        
        if($run_q->num_rows() > 0){
             foreach($run_q->result() as $get){
                return $get->cashierTillLimit;
            } 
              
        }
        
        else{
            return FALSE;
        }
    }
 
 
   /***** UPDATE TILL BALANCE******/
	public function negativetillbalance($newBalance, $sessionID, $tillID){
		 $update = "UPDATE tillbalances SET `tillBalance`='$newBalance' WHERE `cashierEmail`='$sessionID' AND id='$tillID'";
        $this->db->query($update);
        return TRUE;
	}    
        
     
    
     //Get the Category Type
    public function getallpaymentdetail($adminemail){
        $q = "SELECT * FROM account_payable WHERE paidByAcct = ? ORDER BY id DESC LIMIT 10000";
        
        $run_q = $this->db->query($q, [$adminemail]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
	
    
    
       //Get the Category Type
    public function getuseridprocess($userid){
        $q = "SELECT * FROM cash_usersetup WHERE id = ?";
        
        $run_q = $this->db->query($q, [$userid]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
	
    
    
     public function getreesultoffinalpayment($email){
        $q = "SELECT * FROM cash_newrequestdb WHERE dCashierwhopaid = ? AND ntillType = 'primary'";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
             return $run_q->result();
              
        }
        
        else{
            return FALSE;
        }
    }
   
  
   /***** UPDATE TILL REQUEST TO 1 ******/
	public function updatewithid($newapproval, $seesionName, $value){
		 $update = "UPDATE cash_newrequestdb SET `cashiertillRequest`='$newapproval', `actApprove` = '$seesionName' WHERE `id`='$value'";
        $this->db->query($update);
        return TRUE;
	}   
        
        public function updatewithidforbankst($mainaccountapproval, $newapproval, $seesionName, $value){
	 $update = "UPDATE cash_newrequestdb SET `approvals`='$mainaccountapproval',  `cashiertillRequest`='$newapproval', `actApprove` = '$seesionName' WHERE `id`='$value'";
        $this->db->query($update);
        return TRUE;
	}   
        
      
       //Get the Category Type
    public function getresultbaseonfileuploadID($id){
        $q = "SELECT * FROM cash_fileupload WHERE f_requestID = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
       //Get the Category Type
    public function getexpenseresultdetails($id){
        $q = "SELECT * FROM cash_newrequest_expensedetails WHERE requestID = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
 
 ////////////////////////////////BEGINNING OF BANK ALERT ///////////////////////////
     public function geticugroup($group){
        $q = "SELECT * FROM cash_groupicu WHERE groupName = ?";
        
        $run_q = $this->db->query($q, [$group]);
        
        if($run_q->num_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }
        
    
   public function insertforicugroup($dGroup, $groupLimit){
		$q = "INSERT into cash_groupicu (groupName, groupLimit) VALUES(?, ?)";
		$insertDB = $this->db->query($q, [$dGroup, $groupLimit]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}  
        
        
     public function setUsericulimit($dICUname, $approvalLimit, $dicugroupname){
		$q = "INSERT into individual_icu_limit (icu_userID, limitAmount, dGroupID) VALUES(?, ?, ?)";
		$insertDB = $this->db->query($q, [$dICUname, $approvalLimit, $dicugroupname]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}  
    
        

 //Return the Userid based on the group selected
    //Get the Category Type
    public function getuserforicugroup($dICUGroup){
        $q = "SELECT userid FROM cash_groupicu WHERE icuid = ?";
        
        $run_q = $this->db->query($q, [$dICUGroup]);
        
        if($run_q->num_rows() > 0){
           // foreach($run_q->result_array() as $get){
            foreach($run_q->result() as $get){
                //return $get['userid'];
                return $get->userid;
            } 
            
        }
        
        else{
            return FALSE;
        }
    }
    
    
    //GET CASHIERS TILL DETAILS
     //Get the Category Type
    public function getresultofcashiers($id){
        $q = "SELECT * FROM tillbalances WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
      //Use till post ID to check status
    public function getpoststatusoftillfirstime($postID){
        $q = "SELECT postFirstAmount FROM tillbalances WHERE id = ?";
        
        $run_q = $this->db->query($q, [$postID]);
        
        if($run_q->num_rows() > 0){
             foreach($run_q->result() as $get){
                return $get->postFirstAmount;
            } 
        }
        
        else{
            return "0";
        }
    }
    
    
        //Use till post ID to check status
    public function getcashiersTillLimit($postID){
        $q = "SELECT cashierTillLimit FROM tillbalances WHERE id = ?";
        
        $run_q = $this->db->query($q, [$postID]);
        
        if($run_q->num_rows() > 0){
             foreach($run_q->result() as $get){
                return $get->cashierTillLimit;
            } 
        }
        
        else{
            return "0";
        }
    }
    
    
     /***** UPDATE TILL REQUEST TO 1 ******/
	public function updatefirsttimetillrequest($firsttillamount, $postfisrttime, $SessionEmail, $postID){
		 $update = "UPDATE tillbalances SET `tillAmount`='$firsttillamount', `tillBalance`='$firsttillamount', `postFirstAmount`='$postfisrttime', `filledByfirstTime`='$SessionEmail'  WHERE `id`='$postID'";
        $this->db->query($update);
        return TRUE;
	}       
    
   
        
     public function getresultfromtillbalances($email){
        $q = "SELECT * FROM tillbalances WHERE cashierEmail = ?";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
             return $run_q->result();
              
        }
        
        else{
            return FALSE;
        }
    }
    
    
      public function getresultfromtillbalancesformadmin(){
        $q = "SELECT * FROM tillbalances";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
             return $run_q->result();
              
        }
        
        else{
            return FALSE;
        }
    }
    
   
    
    //Get the Category Type
    public function getcurrenttillbalance($cashierEmail, $tillID){
        $q = "SELECT * FROM tillbalances WHERE cashierEmail = ? AND id = ?";
        
        $run_q = $this->db->query($q, [$cashierEmail, $tillID]);
        
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
    public function getcurrenttillbalanceforadmin($tillID){
        $q = "SELECT * FROM tillbalances WHERE id = ?";
        
        $run_q = $this->db->query($q, [$tillID]);
        
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
    public function getTilltype($lang){
        $q = "SELECT * FROM cash_newrequestdb WHERE id = ?";
        
        $run_q = $this->db->query($q, [$lang]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->ntillType;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
   //Get the Amount from the lang Checkbox
    public function getapprovedcheques(){
        $q = "SELECT * FROM account_payable WHERE approval = '1' ORDER BY id DESC LIMIT 5000";
        //$q = "SELECT * FROM cash_newrequestdb WHERE signature = '$sessionEmail' ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
      //Get the Amount from the lang Checkbox
    public function getnewbycodesearch($catStartDate, $catEndDate){
       // $q = "SELECT * FROM cash_newrequestdb WHERE approvals = '$status' || approvals = '8' AND datepaid >= '$catStartDate' AND datepaid <= '$catEndDate'";
       $q = "SELECT * FROM cash_newrequestdb WHERE  datepaid >= '$catStartDate' AND datepaid <= '$catEndDate' AND approvals IN('4', '8')";
       
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
       //Get the Amount from the lang Checkbox
    public function getdUnits($dUnit, $unitStartDate, $unitEndDate, $sessionID){
        $q = "SELECT * FROM cash_newrequestdb WHERE dUnit = '$dUnit' AND dCashierwhopaid = '$sessionID' AND datepaid >= '$unitStartDate' AND datepaid <= '$unitEndDate' ORDER BY dUnit ASC";
       
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
      //Get the Amount from the lang Checkbox
    public function getalldUnits($unitStartDate, $unitEndDate, $sessionID){
        $q = "SELECT * FROM cash_newrequestdb WHERE  dCashierwhopaid = '$sessionID' AND datepaid >= '$unitStartDate' AND datepaid <= '$unitEndDate' ORDER BY dUnit DESC";
       
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
  
    
    ////////////////////////////////INSERT NEW REQUEST WITH REF ID //////////////////////////////////////////////////
     //$updateRow = $this->adminmodel->sendneweditedrequest($nCategory, $nPayment, $approvals, $Location, $unit, $hod, $icus, $dAmount, $ndescriptOfitem, $dComment, $benName, $benEmail, $hideID);
     public function sendneweditedrequest($userGenCode, $dHOD, $dAccountGroup="", $dcashier="", $newDate, $sessionID, $fullname, $nPayment, $approvals, $Location, $unit, $icus, $dAmount, $ndescriptOfitem, $dComment, $benName, $hideID){
		$q = "INSERT into cash_newrequestdb (userCode, hod, dAccountgroup, cashiers, dateCreated, sessionID, fullname, nPayment, approvals, dLocation, dUnit, icus, dAmount, ndescriptOfitem, addComment, benName, refID_edited, dateRegistered) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$userGenCode, $dHOD, $dAccountGroup, $dcashier, $newDate, $sessionID, $fullname, $nPayment, $approvals, $Location, $unit, $icus, $dAmount, $ndescriptOfitem, $dComment, $benName, $hideID]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
        
        
      
        
    /////////////////////////////////END OF INSERT NEW REQUEST WITH REF ID ////////////////////////////////////////
        
        
  ///////////////////////////////////////////SEARCH MECHANISM BEGINS HERE///////////////////////////////////////////
        
        //Get the Amount from the lang Checkbox
    public function getCoderesult($codeCat){
        $q = "SELECT codeact.codeName, codeact.codeNumber, cash_newrequest_expensedetails.ex_Code, cash_newrequest_expensedetails.requestID FROM codeact INNER JOIN cash_newrequest_expensedetails ON codeact.codeNumber = '$codeCat' AND cash_newrequest_expensedetails.ex_Code = '$codeCat'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
        //Get the Amount from the lang Checkbox
    public function gcodeResultonly($codeNumber){
        $q = "SELECT * FROM cash_newrequest_expensedetails WHERE ex_Code = '$codeNumber'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
      public function getFinalSearchResult($codeID, $catStartDate, $catEndDate){
        // SELECT cash_newrequestdb.*, cash_accounttable.* FROM cash_newrequestdb INNER JOIN cash_accounttable ON cash_newrequestdb.id = '12' AND cash_accounttable.requestID = '12' AND cash_newrequestdb.datepaid >= '2016-09-11' AND cash_accounttable.datePaid <= '2018-09-30'
        $q = "SELECT cash_newrequestdb.*, cash_accounttable.* FROM cash_newrequestdb INNER JOIN cash_accounttable ON cash_newrequestdb.id = '$codeID' AND cash_accounttable.requestID = '$codeID' AND cash_newrequestdb.datepaid >= '$catStartDate' AND cash_accounttable.datePaid <= '$catEndDate'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
 
    
        //Get the Amount from the lang Checkbox
    public function checkinResult($getRequestedID, $sessionID, $catStartDate, $catEndDate){
        $q = "SELECT * FROM cash_newrequestdb WHERE id IN ($getRequestedID) AND dCashierwhopaid ='$sessionID' AND datepaid >= '$catStartDate' AND datepaid <= '$catEndDate' ";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
       //Get the Amount from the lang Checkbox
    public function getbycodesearch($codeCat, $catStartDate, $catEndDate, $sessionID){
        //SELECT COUNT(ex_Code) AS 'actCode', COUNT(requestID) AS 'titleNo', `ex_Amount`, SUM(ex_Amount) AS 'Total', requestID as requestID, ex_Code as mActCod, sess AS dEmail FROM cash_newrequest_expensedetails WHERE sess = 'account@c-ileasing.com' GROUP BY ex_Code
        //SELECT COUNT(ex_Code) AS 'actCode', COUNT(requestID) AS 'titleNo', `ex_Amount`, SUM(ex_Amount) AS 'Total', requestID as requestID, ex_Code as mActCod, sess AS dEmail FROM cash_newrequest_expensedetails WHERE sess = 'account@c-ileasing.com' AND datepaid >='2017-06-34' AND datepaid <='2017-06-34' GROUP BY ex_Code
        $q = "SELECT COUNT(ex_Code) AS 'actCode', COUNT(requestID) AS 'titleNo', `ex_Amount`, SUM(ex_Amount) AS 'Total', requestID as requestID, ex_Code as mActCod, sess AS dEmail FROM cash_newrequest_expensedetails WHERE ex_Code = '$codeCat' AND sess = '$sessionID' AND datepaid >='$catStartDate' AND datepaid <='$catEndDate' GROUP BY ex_Code";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
      public function getbycodesearchbyadmin($codeCat, $catStartDate, $catEndDate){
        //SELECT COUNT(ex_Code) AS 'actCode', COUNT(requestID) AS 'titleNo', `ex_Amount`, SUM(ex_Amount) AS 'Total', requestID as requestID, ex_Code as mActCod, sess AS dEmail FROM cash_newrequest_expensedetails WHERE sess = 'account@c-ileasing.com' GROUP BY ex_Code
        //SELECT COUNT(ex_Code) AS 'actCode', COUNT(requestID) AS 'titleNo', `ex_Amount`, SUM(ex_Amount) AS 'Total', requestID as requestID, ex_Code as mActCod, sess AS dEmail FROM cash_newrequest_expensedetails WHERE sess = 'account@c-ileasing.com' AND datepaid >='2017-06-34' AND datepaid <='2017-06-34' GROUP BY ex_Code
        $q = "SELECT COUNT(ex_Code) AS 'actCode', COUNT(requestID) AS 'titleNo', `ex_Amount`, SUM(ex_Amount) AS 'Total', requestID as requestID, ex_Code as mActCod, sess AS dEmail FROM cash_newrequest_expensedetails WHERE ex_Code = '$codeCat' AND datepaid >='$catStartDate' AND datepaid <='$catEndDate' GROUP BY ex_Code";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
        
  //////////////////////////////////////////END OF SEARCH MECHANISM ENDS HERE////////////////////////////////////////
   //Get the Current till Amount
    public function gettilltypestatus($id){
        $q = "SELECT * FROM tillbalances WHERE id = ? LIMIT 1";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->tillType;
            }
        }
        
        else{
            return FALSE;
        }
    }

    
    
    
   public function addbankaccountnameandnumber($acctName, $bankName, $actNumber, $address1, $state, $sessionEmail){
		$q = "INSERT into newbank (accountName, bankName, bankNumber, address, state, addedBy) VALUES(?, ?, ?, ?, ?, ?)";
		$insertDB = $this->db->query($q, [$acctName, $bankName, $actNumber, $address1, $state, $sessionEmail]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}  
    
   
        
   public function getallBanks(){
        $q = "SELECT * FROM newbank";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
   }
   
   
   
    //Get the Category Type
    public function getBankName($no){
        $q = "SELECT * FROM newbank WHERE bankNumber = ?";
        
        $run_q = $this->db->query($q, [$no]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->bankName;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    //Get the Category Type
    public function getpreparedcheques($userid){
        $q = "SELECT * FROM account_payable WHERE id = ?";
        
        $run_q = $this->db->query($q, [$userid]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
  
    
    
   public function updateBankstatementoYes($value, $ssession){  
    $update = "UPDATE account_payable SET `bankStatement`='yes', approval='1', paidByAcct='$ssession' WHERE `id`='$value'";
       $this->db->query($update);
        return TRUE;
	  
 }
 
 
 
  public function updatecashiertocheque($daccountant, $sessionEmail, $sendformID){  
    $update = "UPDATE account_payable SET `accountGroup`='$daccountant', hasentbycashier='yes' WHERE `id`='$sendformID'";
       $this->db->query($update);
        return TRUE;
	  
 }
 
 
 
  public function updatechequerequest($hasentbycashier, $type, $sessionEmail, $dateprepared, $cheQueNo, $dBank, $sentID){  
    $update = "UPDATE account_payable SET `approval`='1', `hasentbycashier`='$hasentbycashier', `type`='$type',  `paidByAcct`='$sessionEmail', `userEmail`='$sessionEmail', `chequeNo`='$cheQueNo', `dBank`='$dBank'  WHERE `id`='$sentID'";
       $this->db->query($update);
        return TRUE;
	  
 }
 
 
 public function insertamountdetails($dateprepared, $userID, $Amount, $tillBalance, $newtillBalance, $tillName, $dPayee, $sessionEmail, $fmrequestID){
		$q = "INSERT into tillhistory (datePrepared, userID, dAmount, dAmountTillBalance, newTillBalance, tillName, dPayee, whoApproved, requestID, dateApproved) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$dateprepared, $userID, $Amount, $tillBalance, $newtillBalance, $tillName, $dPayee, $sessionEmail, $fmrequestID]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
}  
        
 

//Get the Category Type
    public function getthebankNumber($id){
        $q = "SELECT dBank FROM account_payable WHERE id= ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->dBank;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
 
      public function getthefmrequestID($id){
        $q = "SELECT fmrequestID FROM account_payable WHERE id= ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->fmrequestID;
            }
        }
        
        else{
            return FALSE;
        }
    }
   
    
    
    
     //Get the Category Type
    public function getdresultsbank($no){
        $q = "SELECT * FROM newbank WHERE bankNumber = ?";
        
        $run_q = $this->db->query($q, [$no]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
 
   public function updaterandomString($randomString, $passwordReset, $count, $passwordResetDate, $email){
     $update = "UPDATE cash_usersetup SET `randomString`='$randomString', `passwordReset`='$passwordReset', `passwordCount`='$count', `passwordlastdatereset`='$passwordResetDate' WHERE `email`='$email'";
        $this->db->query($update);
        return TRUE;
	}       
    
    
     //Get the Category Type
    public function runchangepass($id, $uemail, $passwordrest, $passcount, $randomstring){
        $q = "SELECT * FROM cash_usersetup WHERE id = ? AND email = ? AND passwordReset = ? AND passwordCount = ? AND randomString = ?";
        
        $run_q = $this->db->query($q, [$id, $uemail, $passwordrest, $passcount, $randomstring]);
        
        if($run_q->num_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
   public function updateresetpass($hasspass, $newpasswordCount, $passwordlastdatereset, $randomString, $ids, $uemail){  
    $update = "UPDATE cash_usersetup SET `password`='$hasspass', `passwordCount`='$newpasswordCount',  `passwordlastdatereset`='$passwordlastdatereset', `randomString`='$randomString' WHERE `id`='$ids' AND `email`='$uemail'";
       $this->db->query($update);
        return TRUE;
	  
 }
 
 
 //Get the Category Type
    public function getonlyhodlevel(){
        $q = "SELECT * FROM cash_accesslevel WHERE id = '2'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
    
    
     //Get the Category Type
    public function getuseridashod($dAccountGroup){
        $q = "SELECT * FROM cash_accesslevel WHERE id = '$dAccountGroup'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
           // foreach($run_q->result_array() as $get){
            foreach($run_q->result() as $get){
                //return $get['userid'];
                return $get->userID;
            } 
            
        }
        
        else{
            return FALSE;
        }
    }
    
    public function setHODcontrol($finalResult, $dhodgroup){  
     $update = "UPDATE cash_accesslevel SET `userID`='$finalResult'  WHERE `id`='$dhodgroup'";
       $this->db->query($update);
        return TRUE;
	  
 }
 
 
 //Get the Category Type
    public function getalluserwithhodid(){
        $q = "SELECT * FROM cash_accesslevel WHERE id = '2'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
             foreach($run_q->result() as $get){
                //return $get['userid'];
                return $get->userID;
            } 
        }
        
        else{
            return FALSE;
        }
    }
    
 
    
      //Get the Category Type
    public function maderequestbyme($id){
        $q = "SELECT sessionID FROM cash_newrequestdb WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
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
    public function myuniqueappid($id){
        $q = "SELECT from_app_id FROM cash_newrequestdb WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->from_app_id;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function assetrequestid($id){
        $q = "SELECT apprequestID FROM cash_newrequestdb WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->apprequestID;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
      public function runrejection($id, $approve, $sessionID, $comment=""){
        $this->db2 = $this->load->database('assetmanagement', TRUE);
        $this->db2->trans_begin();
        $myAudit = "<br/>Rejected By ". $sessionID. " ". date('Y-m-d');
        $this->db2->query("UPDATE maintenance SET status='$approve', rejectedBy='$sessionID' WHERE id='$id'");
         $this->db2->query("UPDATE maintenance SET `auditTrail`= CASE WHEN auditTrail = '' THEN '$comment' ELSE CONCAT(`auditTrail`, '$myAudit') END WHERE `id` = '$id'  ");
         
        if ($this->db2->trans_status() === FALSE){
                $this->db2->trans_rollback();
        }else{
                $this->db2->trans_commit();
        }
    }
    
    
    public function documentrejection($id, $approve, $sessionID, $comment=""){
        $this->db2 = $this->load->database('assetmanagement', TRUE);
        $this->db2->trans_begin();
        $myAudit = "<br/>Rejected By ". $sessionEmail. " ". date('Y-m-d');
        $this->db2->query("UPDATE document_amount_approval SET status='$approve', rejectedBy='$sessionID' WHERE id='$id'");
         $this->db2->query("UPDATE document_amount_approval SET `audit`= CASE WHEN audit = '' THEN '$comment' ELSE CONCAT(`audit`, '$myAudit') END WHERE `id` = '$id'  ");
         
        if ($this->db2->trans_status() === FALSE){
                $this->db2->trans_rollback();
        }else{
                $this->db2->trans_commit();
        }
    }
    
    
    public function runassetmaintenance($id, $approve, $sessionEmail, $comment=""){
        $this->db2 = $this->load->database('assetmanagement', TRUE);
        $this->db2->trans_begin();
        $myAudit = "<br/>Payment Invoice Approved By ". $sessionEmail. " ". date('Y-m-d');
        $this->db2->query("UPDATE maintenance SET `status`='$approve', `approvedBy-requisition`='$sessionEmail' WHERE `id`='$id'");
        $this->db2->query("UPDATE maintenance SET `auditTrail`= CASE WHEN auditTrail = '' THEN '$myAudit' ELSE CONCAT(`auditTrail`, '$myAudit') END WHERE `id` = '$id'  ");
        //$this->db2->query("INSERT into maintenance_comments (mid, comments, userID) VALUES('$id', '$comment ".$this->session->id." )");
         
        if ($this->db2->trans_status() === FALSE){
                $this->db2->trans_rollback();
        }else{
                $this->db2->trans_commit();
        }
    }
    
    public function runassetmaintenanceforicu($id, $approve, $sessionEmail, $comment=""){
        $this->db2 = $this->load->database('assetmanagement', TRUE);
        $this->db2->trans_begin();
        $myAudit = "<br/>Payment Invoice Approved By ". $sessionEmail. " ". date('Y-m-d');
        $this->db2->query("UPDATE maintenance SET `status`='$approve', `verifiedBy-requisition`='$sessionEmail' WHERE `id`='$id'");
        $this->db2->query("UPDATE maintenance SET `auditTrail`= CASE WHEN auditTrail = '' THEN '$myAudit' ELSE CONCAT(`auditTrail`, '$myAudit') END WHERE `id` = '$id'  ");
        //$this->db2->query("INSERT into maintenance_comments (mid, comments, userID) VALUES('$id', '$comment ".$this->session->id." )");
         
        if ($this->db2->trans_status() === FALSE){
                $this->db2->trans_rollback();
        }else{
                $this->db2->trans_commit();
        }
    }
    
    
   public function paymaintenancevendor($ids, $dStatus, $fullname){
        $this->db2 = $this->load->database('sysmanager', TRUE);
        $this->db2->trans_begin();
        $myAudit = "<br/>Payment Invoice Approved By ". $this->session->email. " ". date('Y-m-d');
        $this->db2->query("UPDATE maintenances SET `maint_status`='$dStatus', `account_name_payment` = '$fullname',  `maint_payment_remark` = '$myAudit' WHERE `maint_id` IN($ids)");
        //$this->db2->query("UPDATE maintenance SET `auditTrail`= CASE WHEN auditTrail = '' THEN '$myAudit' ELSE CONCAT(`auditTrail`, '$myAudit') END WHERE `id` = '$id'  ");
      
        if ($this->db2->trans_status() === FALSE){
                $this->db2->trans_rollback();
        }else{
                $this->db2->trans_commit();
        }
    }
    
    
     public function documentation($id, $approve, $sessionEmail, $comment=""){
        $this->db2 = $this->load->database('assetmanagement', TRUE);
        $this->db2->trans_begin();
        $myAudit = "<br/>Payment Invoice Approved By ". $sessionEmail. " ". date('Y-m-d');
        $this->db2->query("UPDATE document_amount_approval SET `status`='$approve', `paymentHOD`='$sessionEmail' WHERE `id`='$id'");
        $this->db2->query("UPDATE document_amount_approval SET `audit`= CASE WHEN audit = '' THEN '$comment' ELSE CONCAT(`audit`, '$myAudit') END WHERE `id` = '$id'  ");
       
        if ($this->db2->trans_status() === FALSE){
                $this->db2->trans_rollback();
        }else{
                $this->db2->trans_commit();
        }
    }
    
     public function documentationicu($id, $approve, $sessionEmail, $comment=""){
        $this->db2 = $this->load->database('assetmanagement', TRUE);
        $this->db2->trans_begin();
        $myAudit = "<br/>Payment Invoice Approved By ". $sessionEmail. " ". date('Y-m-d');
        $this->db2->query("UPDATE document_amount_approval SET `status`='$approve', `paymentICU`='$sessionEmail' WHERE `id`='$id'");
        $this->db2->query("UPDATE document_amount_approval SET `audit`= CASE WHEN audit = '' THEN '$comment' ELSE CONCAT(`audit`, '$myAudit') END WHERE `id` = '$id'  ");
       
        if ($this->db2->trans_status() === FALSE){
                $this->db2->trans_rollback();
        }else{
                $this->db2->trans_commit();
        }
    }
    
    
      public function documentationaccount($id, $approve, $sessionEmail, $comment=""){
        $this->db2 = $this->load->database('assetmanagement', TRUE);
        $this->db2->trans_begin();
        $myAudit = "<br/>Payment Invoice Approved By ". $sessionEmail. " ". date('Y-m-d');
        $this->db2->query("UPDATE document_amount_approval SET `status`='$approve', `paymentACCOUNT`='$sessionEmail' WHERE `id`='$id'");
        $this->db2->query("UPDATE document_amount_approval SET `audit`= CASE WHEN audit = '' THEN '$comment' ELSE CONCAT(`audit`, '$myAudit') END WHERE `id` = '$id'  ");
       
        if ($this->db2->trans_status() === FALSE){
                $this->db2->trans_rollback();
        }else{
                $this->db2->trans_commit();
        }
    }
    
    
    public function runassetmaintenances($id, $approve, $sessionID){
     $this->db2 = $this->load->database('assetmanagement', TRUE);
		 $update = "UPDATE maintenance_assets SET approve='$approve' , secondLevelapproval='$sessionID'" 
                ."WHERE id='$id'";
        $this->db2->query($update);
        return TRUE;
	}
	
     public function updateicuhead($dicugroup, $dUsernam){  
     $update = "UPDATE  cash_groupicu SET `icuHead`='$dUsernam'  WHERE `icuid`='$dicugroup'";
       $this->db->query($update);
        return TRUE;
	  
     }

     
     
      //Get the Category Type
    public function getHODICUpriv($id){
        $q = "SELECT icuHead FROM cash_groupicu WHERE icuHead = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->icuHead;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
      //Get the Category Type
    public function gethodgroup($hodid){
        $q = "SELECT icuid FROM cash_groupicu WHERE icuHead = ?";
        
        $run_q = $this->db->query($q, [$hodid]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->icuid;
            }
        }
        
        else{
            return FALSE;
        }
    }
 
    
    
      //Get the Category Type
    public function getalluserforthatgroup($groupID){
        $q = "SELECT * FROM individual_icu_limit WHERE dGroupID = ?";
        
        $run_q = $this->db->query($q, [$groupID]);
        
        if($run_q->num_rows() > 0){
           return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function getalluserinicu(){
        $q = "SELECT * FROM individual_icu_limit";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
           return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function hodhaschangeyourlimit($userLimit, $transID){  
     $update = "UPDATE individual_icu_limit SET `limitAmount`='$userLimit'  WHERE `id`='$transID'";
       $this->db->query($update);
        return TRUE;
	  
     }

     
     
     
        //Get the Amount from the lang Checkbox
    public function hodgetnewbycodesearch($status, $catStartDate, $catEndDate, $sessionID){
        $q = "SELECT * FROM cash_newrequestdb WHERE approvals = '$status' AND hodwhoapprove = '$sessionID' AND datepaid >= '$catStartDate' AND datepaid <= '$catEndDate' ORDER BY dUnit ASC";
        //$q = "SELECT * FROM cash_newrequestdb WHERE signature = '$sessionEmail' ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
 
  
      //Get the Amount from the lang Checkbox
    public function hodrejectgetnewbycodesearch($status, $catStartDate, $catEndDate, $sessionID){
        $q = "SELECT * FROM cash_newrequestdb WHERE approvals = '$status' AND hodwhoreject = '$sessionID' AND datepaid >= '$catStartDate' AND datepaid <= '$catEndDate' ORDER BY dUnit ASC";
        //$q = "SELECT * FROM cash_newrequestdb WHERE signature = '$sessionEmail' ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
   
    
   //Get the Category Type
    public function getmypaymentcode($id, $email){
        $q = "SELECT userCode FROM cash_newrequestdb WHERE id='$id' AND sessionID = '$email'";
        
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

    
    
    
      
    
    
     //Get the Category Type
    public function getchangeforadmin($id){
        $q = "SELECT adminOnly FROM cash_groupicu WHERE adminOnly = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->adminOnly;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    //Get the Category Type
    public function getsuperadminonly($hodid){
        $q = "SELECT icuid FROM cash_groupicu WHERE adminOnly = ?";
        
        $run_q = $this->db->query($q, [$hodid]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->icuid;
            }
        }
        
        else{
            return FALSE;
        }
    }
   
    
       //Get the Category Type
    public function getaccoutpayment($mySessionEmail, $dAccountgroup){
       //$q = "SELECT * FROM cash_newrequestdb WHERE  dAccountgroup = ? AND approvals != '4'";
       $q = "SELECT * FROM cash_newrequestdb  WHERE hodwhoapprove != '' AND dCashierwhopaid =''  AND dICUwhoapproved != '' AND cashiers = '$mySessionEmail' || dAccountgroup = '$dAccountgroup' AND approvals = '3'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    /******** This controller Username and Create a Session with it ********/
	 public function getUsername($email){
        $q = "SELECT fname, lname FROM cash_usersetup WHERE `email` = '$email'";
        
        $run_q = $this->db->query($q, [$email]);
		
		if($run_q->num_rows() > 0){
           foreach($run_q->result() as $get){
                    $fname = $get->fname;
                    $lname = $get->lname;
                    
                return $fname." ".$lname;
				//return TRUE;
            }
        }else{
			return FALSE;
		}
    }
    
    
    
      //Get the Amount from the lang Checkbox
    public function getcashiersarch($status, $catStartDate, $catEndDate, $sessionID){
        $q = "SELECT * FROM cash_newrequestdb WHERE approvals = '$status' AND dCashierwhopaid = '$sessionID' AND datepaid >= '$catStartDate' AND datepaid <= '$catEndDate'";
       
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
  
    
     //Get the Amount from the lang Checkbox
    public function getcodebycashierstatus($status, $catStartDate, $catEndDate){
        $q = "SELECT * FROM cash_newrequestdb WHERE approvals = '$status' AND datepaid >= '$catStartDate' AND datepaid <= '$catEndDate' ORDER BY dUnit ASC";
        //$q = "SELECT * FROM cash_newrequestdb WHERE signature = '$sessionEmail' ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
   //Get the Amount from the lang Checkbox
    public function getallfieldsfromexpensetable($cashiersactStartDatee, $cashiersactEndDate){
        $q = "SELECT * FROM cash_newrequest_expensedetails WHERE sess !='' AND datepaid >= '$cashiersactStartDatee' AND datepaid <= '$cashiersactEndDate' ORDER BY exid DESC";
        //$q = "SELECT * FROM cash_newrequestdb WHERE signature = '$sessionEmail' ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    //Get the Amount from the lang Checkbox
    public function getcashairsresult($cashiersactStartDatee, $cashiersactEndDate, $sessionID){
        $q = "SELECT * FROM cash_newrequest_expensedetails WHERE sess = '$sessionID' AND datepaid >= '$cashiersactStartDatee' AND datepaid <= '$cashiersactEndDate' ORDER BY exid DESC";
        //$q = "SELECT * FROM cash_newrequestdb WHERE signature = '$sessionEmail' ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    //Get the Category Type
    public function getLocation($id){
        $q = "SELECT id, sessionID, dLocation FROM cash_newrequestdb WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->dLocation;
            }
        }
        
        else{
            return FALSE;
        }
    } 
    
    
     //Get the Category Type
    public function getmyUnit($id){
        $q = "SELECT id, sessionID, dUnit FROM cash_newrequestdb WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
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
    public function getaccountgroup(){
        //$q = "SELECT * FROM cash_groupaccount WHERE gid IN ('1', '2','3', '6')";
        $q = "SELECT * FROM cash_groupaccount";
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    } 
    
    
     //Get the Category Type
    public function getdICUHead(){
        $q = "SELECT icuHead FROM cash_groupicu";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->icuHead;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
} // End of Class Prediction extends CI_Model