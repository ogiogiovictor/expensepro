<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Assets extends CI_Model{
	
	public function __construct(){
		parent::__construct();
                $this->db2 = $this->load->database('assetmanagement', TRUE);
	}
	
	/***** This controller returns all users ******/
	
	//SHOW ASSETS WHERE approve  = 0;
	public function awaitingapprovalbylocaldept($email){
        $q = "SELECT * FROM maintenance_assets WHERE approve = '0' AND hodEmail = ?";
        
        $run_q = $this->db2->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
	
    
    
    //Dynamic Checking for ID in Asset
	public function getAssetName($aid){
        $q = "SELECT AssetName FROM asset_register WHERE id = ?";
        
        $run_q = $this->db2->query($q, [$aid]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->AssetName;
				//return $get->id;
            }
        }
        
        else{
            return FALSE;
        }
    }
	
    
    public function datePurchase($id){
        $q = "SELECT PurchaseDate FROM asset_register WHERE id = ?";
        
        $run_q = $this->db2->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->PurchaseDate;
				//return $get->id;
            }
        }
        
        else{
            return "";
        }
    }
    
    
    	public function aDescription($id){
        $q = "SELECT AssetDescription FROM asset_register WHERE id = ?";
        
        $run_q = $this->db2->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->AssetDescription;
				//return $get->id;
            }
        }
        
        else{
            return "";
        }
    }
    
    
    public function dvendorName($id){
        $q = "SELECT vendorName FROM  vendors WHERE id = ?";
        
        $run_q = $this->db2->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->vendorName;
				//return $get->id;
            }
        }
        
        else{
            return "";
        }
    }
    
    
    /***** This checks if the ID is in the Mainteancne Table ******/
	 public function getIDforMaintenance($id, $email){
        $q = "SELECT  * FROM  maintenance_assets WHERE id=? AND hodEmail = ? ORDER BY id DESC";
        
        $run_q = $this->db2->query($q, [$id, $email]);
        
        if($run_q->num_rows() > 0){
			return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
	
    
      public function checkvendortoapprove($id){
        $q = "SELECT * FROM  maint_vend WHERE id ='$id'";
        
            $run_q = $this->db2->query($q);

            if($run_q->num_rows() > 0){
                return $run_q->result();
            }

            else{
                return "";
             }
        }
        
        
      public function approvedformaintenance($id, $assetID, $vendorchoice, $approved, $recomm, $sessionID){
		 $data = array(
            'approve' => $approved,
			'recommendation	' => $recomm,
			'approveBy' => $sessionID,
			'aid' => $assetID,
                        'approveVendorID' => $vendorchoice,
			'id' => $id
        );
        $this->db2->where('aid', $assetID);
		$this->db2->where('id', $id);
        $this->db2->update('maintenance_assets', $data);
	return $id;
	}  
        
        
        //Update Status Category
	public function updateinsurcepolicy($wID, $status){
		$q = "UPDATE insurance SET `status`= '$status' WHERE id = '$wID'";
		$this->db2->query($q);
                return $wID;
	}
        
        
         /***** This controller returns all users ******/
	public function getresultwithid($id){
        $q = "SELECT * FROM cash_usersetup WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     
     public function addallComments($theID, $recomm, $sessionID){
		$q = "INSERT into assetcomment (mid, comment, userID, dateComment) VALUES(?, ?, ?, NOW())";
		$insertDB = $this->db2->query($q, [$theID, $recomm, $sessionID]);
		
		if($this->db2->affected_rows($insertDB) > 0){
			$insertId = $this->db2->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
  
        
     public function gettillhistory($email, $tillname){
        $q = "SELECT * FROM tillhistory WHERE dPayee = '$email' AND tillName = '$tillname' ORDER BY id DESC";
        
        $run_q = $this->db->query($q, [$email, $tillname]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }  
    
    
    
    public function dgetAllocatedUser($id){
        $q = "SELECT allocatedlastestuser FROM  asset_register WHERE id = ?";
        
        $run_q = $this->db2->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->allocatedlastestuser;
				//return $get->id;
            }
        }
        
        else{
            return "";
        }
    }
    
    
    
    
     //Dynamic Checking for ID in Asset
	public function myCurrencyType($frequestID){
        $q = "SELECT CurrencyType FROM cash_newrequestdb WHERE id = ?";
        
        $run_q = $this->db->query($q, [$frequestID]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->CurrencyType;
			
            }
        }
        
        else{
            return FALSE;
        }
    }
	
  
    
     //Update Status Category
	public function changeupdateprofile($fname, $lname, $fLocation, $fUnit, $phoneNum, $altEmail, $pEmail){
            $q = "UPDATE cash_usersetup SET `fname`= '$fname', `lname`= '$lname', `uLocation`= '$fLocation', `dUnit`= '$fUnit', `phone`= '$phoneNum', `alternativeEmail`= '$altEmail'  WHERE `email` = '$pEmail'";
            $this->db->query($q);
            return $pEmail;
	}
        
        
        
        public function getmaintenanceresult($id, $email){
        $q = "SELECT * FROM  maintenance_assets WHERE id = ? AND hodEmail = ?";
        
        $run_q = $this->db2->query($q, [$id, $email]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return "";
        }
    }
    
    
    public function runassetmaintenance($dStatus, $accountwhoapprove, $comment="", $accessID){
        $this->db2 = $this->load->database('assetmanagement', TRUE);
        $this->db2->trans_begin();
          
        $this->db2->query("UPDATE maintenance SET status='$dStatus', actwhoapprove='$accountwhoapprove' WHERE id='$accessID'");
        $this->db2->query("INSERT into maintenance_comments (mid, comments) VALUES('$accessID', '$comment')");

        if ($this->db2->trans_status() === FALSE){
                $this->db2->trans_rollback();
        }else{
                $this->db2->trans_commit();
        }
    }
    
    
    
    
    //SHOW ASSETS WHERE approve  = 0;
	public function getvendorsbyunit($dUnit){
        $q = " SELECT GROUP_CONCAT(id) as IDS, from_app_id, CurrencyType, benName, sum(dAmount) as Amount, approvals, count(id) as dCount, dUnit, nPayment 
            FROM `cash_newrequestdb` WHERE approvals = '3' AND nPayment = '2' AND dUnit= ? GROUP BY dUnit, benName, CurrencyType";
        
        $run_q = $this->db->query($q, [$dUnit]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
   
    
    public function getvendorsbyunitforicuaccount(){
        $q = "SELECT GROUP_CONCAT(id) as IDS, from_app_id, CurrencyType, benName, sum(dAmount) as Amount, approvals, count(id) as dCount, dUnit, nPayment 
            FROM `cash_newrequestdb` WHERE approvals = '3' AND nPayment = '2' GROUP BY benName, CurrencyType";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function getallrequestin($id){
        $q = "SELECT * FROM `cash_newrequestdb` WHERE id IN($id)";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
   
        
} // End of Class Prediction extends CI_Model