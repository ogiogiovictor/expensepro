<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Archievesmodel extends CI_Model{
	
      public function __construct() {
        parent::__construct();
        $this->db4 = $this->load->database('ciprocuredb', TRUE);
    }
    
/////////////////////////////////////ANOTHER DATA TABLE SERVER SIDE EXAMPLE /////////////////////////////////////////////

      var  $chequeTable = "cash_newrequestdb";
      var $columns = array("id",  "dateCreated", "fullname", "ndescriptOfitem", "nPayment", "dAmount", "dLocation", "sessionID", "benName",  "approvals", "CurrencyType", "md5_id", "from_app_id", "sageRef", "po_number", "apprequestID");  
      var $column_order = array("id", "dateCreated", "fullname", "ndescriptOfitem", "nPayment", null, "dLocation", "sessionID", "CurrencyType", "sageRef", "po_number", "apprequestID");
            
    public function getpaidby(){
       $this->db->where('approvals !=', '11'); 
       $this->db->select($this->columns);
       $this->db->from($this->chequeTable);
          
            /*********IF CONDITION FOR SEARCH **************/
            if(isset($_POST["search"]["value"])){
                
                $this->db->like("id", $_POST["search"]["value"]);
                $this->db->or_like("ndescriptOfitem", $_POST["search"]["value"]);
                $this->db->or_like("nPayment", $_POST["search"]["value"]);
                $this->db->or_like("dLocation", $_POST["search"]["value"]);
                $this->db->or_like("sessionID", $_POST["search"]["value"]);
                $this->db->or_like("benName", $_POST["search"]["value"]);
            }
            /*********END IF CONDITION FOR SEARCH **************/ 
             /*********IF CONDITION FOR ORDER **************/
              if(isset($_POST["order"])){
                 $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']); 
              }else{
                  $this->db->order_by("id", "DESC");
              }
             /*********END OFIF CONDITION FOR ORDER **************/
    }



       public function makeDatabase(){
            $this->getpaidby();
            if($_POST["length"] != -1){
                $this->db->limit($_POST["length"], $_POST["start"]);
            }
            $query = $this->db->get_where();
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
    
        
        
        
        public function areyouascashier($email){
        
        $q = "SELECT email, accessLevel FROM cash_usersetup WHERE email= ? AND accessLevel = '4'";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->accessLevel;
            }
        }
        
        else{
            return FALSE;
        }
      }
      
      
      
      public function whatypeoftillareumanaging($newcashier){
        
        $q = "SELECT cashierEmail, tillType FROM tillbalances WHERE cashierEmail= ?";
        
        $run_q = $this->db->query($q, [$newcashier]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->tillType;
            }
        }
        
        else{
            return FALSE;
        }
      }
        
  
       public function newcashierwithid($email){
        
        $q = "SELECT email, id FROM cash_usersetup WHERE email= ?";
        
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
        
      
      public function newchasierintill($newcashier, $oldchashieremail, $tillType, $tillbalance, $emailwhochangeit){
		$q = "INSERT into tillchangecashier (newcashier, oldchashieremail, tillType, tillbalance, emailwhochangeit, dateChanged) VALUES(?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$newcashier, $oldchashieremail, $tillType, $tillbalance, $emailwhochangeit]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	} 
        
      public function updatenewchasierintill($getnewcashierID, $newcashier, $tillType, $tillID){
		$q = "UPDATE tillbalances SET  `cahsierTillID`= '$getnewcashierID', `tillType`= '$tillType', `cashierEmail` = '$newcashier'  WHERE id = '$tillID'";
		$this->db->query($q);
                return $tillID;
    }   
    
    
     public function getponumber($ponumber){
        
        $q = "SELECT order_no FROM `purch_order_details` where po_detail_item IN ($ponumber)";
        
        $run_q = $this->db4->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->order_no;
            }
        }
        
        else{
            return FALSE;
        }
      }
      
      
  
    
    
} // End of Class Prediction extends CI_Model