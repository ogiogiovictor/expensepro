<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Users extends CI_Model{
	
	public function __contruct(){
		parent::__contruct();
	}
	
	/***** This controller returns all users ******/
	public function checkUserSession($dseesion){
        $q = "SELECT * FROM cash_usersetup WHERE email = ?";
        
        $run_q = $this->db->query($q, [$dseesion]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    /***** This controller returns all users ******/
	public function getajobsession($userid){
        $q = "SELECT * FROM staffdata WHERE id = ?";
        
        $run_q = $this->db->query($q, [$userid]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function getforcompay($comp){
        $q = "SELECT * FROM companies WHERE id = ? AND client='2'";
        
        $run_q = $this->db->query($q, [$comp]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function getstaffdetails($staffID){
        $q = "SELECT * FROM staffdata_mgmt WHERE staff_id = ?";
        
        $run_q = $this->db->query($q, [$staffID]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
	

    
  // returns hasspassword
      public function gethasspass($validateEmail){
          $q = "SELECT password from cash_usersetup WHERE email=? AND activation='1'";
          $query = $this->db->query($q, [$validateEmail]);
          
          if($query->num_rows() == 1){
             foreach($query->result() as $result){
				$hassPass = $result->password; 
			 }
			 
			  return $hassPass;
          }else{
              return FALSE;
          }     
          
      }
	  
      
      public function storevalue($loginvalue) {
        $query = "SELECT id, email, fname, lname, uLocation, dUnit from cash_usersetup WHERE email=? AND activation='1'";
        $runQ = $this->db->query($query, [$loginvalue]);
        if ($runQ->num_rows() === 1) {
            // Get the userid and the user randCode from the database as session values
            foreach ($runQ->result() as $gotten) {
                $userId = $gotten->id;
                //$randCode = $gotten->randCode;
            }
            //update user's userStatus(online/offline) and lastLogin 
            $this->userOnlineStatus($userId);

           // $data = ['userId' => $userId, 'randCode' => $randCode];
            return $userId;
        } else {
            return FALSE;
        }
    }
// End of getUserid
    

  
public function userOnlineStatus($userId) {
        $update = "UPDATE cash_usersetup SET userStatus='online', lastlogin=NOW()"
                ."WHERE id=$userId AND activation='1'";
        $this->db->query($update);
        return TRUE;
    
    }
    
 
    // returns hasspassword
      public function getLocationEmail($email){
          $q = "SELECT uLocation from cash_usersetup WHERE email=? AND activation='1'";
          $query = $this->db->query($q, [$email]);
          
          if($query->num_rows() == 1){
             foreach($query->result() as $result){
				$localtion = $result->uLocation; 
			 }
			 
			  return $localtion;
          }else{
              return FALSE;
          }     
          
      }
      
      
 	    // returns hasspassword
      public function getUnit($email){
          $q = "SELECT dUnit from cash_usersetup WHERE email=? AND activation='1'";
          $query = $this->db->query($q, [$email]);
          
          if($query->num_rows() == 1){
             foreach($query->result() as $result){
				$department = $result->dUnit; 
			 }
			 
			  return $department;
          }else{
              return FALSE;
          }     
          
      }
      
      
  /***** Function logout User *****/
	 public function updateipaddress($id, $userip){
        $q = "UPDATE cash_usersetup SET user_ip='$userip' WHERE id = ?";
        $this->db->query($q, [$id]);
    }
	
    
   
    
        // returns hasspassword
      public function getuseremail($id){
          $q = "SELECT email from cash_usersetup WHERE id='$id' AND activation='1'";
          $query = $this->db->query($q);
          
          if($query->num_rows() > 0){
             foreach($query->result() as $result){
		return $result->email; 
                //return $dEmail;
                }
		 //return $dEmail;
          }else{
              return FALSE;
          }     
          
      }
      
      
       public function storevalue2($loginvalue) {
        $query = "SELECT id, email, fname, lname, uLocation, dUnit from cash_usersetup WHERE email=?";
        $runQ = $this->db->query($query, [$loginvalue]);
        if ($runQ->num_rows() === 1) {
            // Get the userid and the user randCode from the database as session values
            foreach ($runQ->result() as $gotten) {
                $userId = $gotten->id;
                //$randCode = $gotten->randCode;
            }
            //update user's userStatus(online/offline) and lastLogin 
            $this->userOnlineStatus($userId);

           // $data = ['userId' => $userId, 'randCode' => $randCode];
            return $userId;
        } else {
            return FALSE;
        }
    }
    
       // returns hasspassword
      public function getdreamiladdress($email){
          $q = "SELECT email from cash_usersetup WHERE email=? AND activation='1'";
          $query = $this->db->query($q, [$email]);
          
          if($query->num_rows() == 1){
             foreach($query->result() as $result){
		$dEmail = $result->email; 
                return $dEmail;
                }
		
          }else{
              return FALSE;
          }     
          
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
    
    
    
      /***** This controller returns all users ******/
	public function getallusersfromdb(){
        $q = "SELECT * FROM cash_usersetup";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
      // returns activation
   public function getmystatusid($newid){
        $q = "SELECT id, activation FROM cash_usersetup WHERE id= ?";
        
        $run_q = $this->db->query($q, [$newid]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->activation;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
  public function updatenewvalue($newvalue, $newid){
        $update = "UPDATE cash_usersetup SET `activation` ='$newvalue' WHERE `id` ='$newid'";
        $this->db->query($update);
        return $newvalue;
    
    }
    
     public function getSecondlevelapproval($id){
        $q = "SELECT id, adminApprove FROM cash_usersetup WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
		
		if($run_q->num_rows() > 0){
           foreach($run_q->result() as $get){
                return $get->adminApprove;
				//return TRUE;
            }
        }else{
			return FALSE;
		}
    }
	
    
    
      //Get the Category Type
    public function getUsertravelstartaccess(){
        $q = "SELECT userIDs FROM access_gen WHERE `id` = '1'";
        
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
    public function mainflightdetails(){
        $q = "SELECT userIDs FROM access_gen WHERE `id` = '3'";
        
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
    public function gethotellaccess(){
        $q = "SELECT userIDs FROM access_gen WHERE `id` = '4'";
        
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
    public function getHertz(){
        $q = "SELECT userIDs FROM access_gen WHERE `id` = '5'";
        
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
    public function getRecievables(){
        $q = "SELECT userIDs FROM access_gen WHERE `id` = '6'";
        
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
    public function getcashiersrequest(){
        $q = "SELECT userIDs FROM access_gen WHERE `id` = '7'";
        
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
    
    
      public function gethasspass2($validateEmail){
          $q = "SELECT password from cash_usersetup WHERE email=? ";
          $query = $this->db->query($q, [$validateEmail]);
          
          if($query->num_rows() == 1){
             foreach($query->result() as $result){
				$hassPass = $result->password; 
			 }
			 
			  return $hassPass;
          }else{
              return FALSE;
          }     
          
      }
      
      
    
       //Get the Category Type
    public function cashiersReimbursement(){
        $q = "SELECT userIDs FROM access_gen WHERE `id` = '8'";
        
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
    
    
    public function delete_category($category_id) {
        $this->db->where('md5_id', $category_id);
        $this->db->delete('cash_newrequestdb');
    }
    
    public function delete_secondtable($tablename, $primaryKey, $category_id) {
        $this->db->where_in($primaryKey, $category_id);
        $this->db->delete($tablename);
    }
    
    
    
       //Get the Category Type
    public function getCountone(){
        $q = "SELECT count(id) AS totalCount FROM cash_newrequestdb";
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
    
    
    
    
    
} // End of Class Prediction extends CI_Model