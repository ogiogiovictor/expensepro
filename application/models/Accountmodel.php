<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Accountmodel extends CI_Model{
	
    
/////////////////////////////////////ANOTHER DATA TABLE SERVER SIDE EXAMPLE /////////////////////////////////////////////

      var  $chequeTable = "cash_newrequestdb";
      var $columns = array("id",  "dateCreated", "fullname", "ndescriptOfitem", "nPayment", "dAmount", "dLocation", "sessionID", "benName",  "approvals", "CurrencyType", "md5_id", "dAccountgroup");  
      var $column_order = array("id", "dateCreated", "fullname", "ndescriptOfitem", "nPayment", null, "dLocation", "sessionID", "CurrencyType");
            
    public function getpaidby(){
       //$q = "SELECT * FROM cash_newrequestdb WHERE dAccountgroup = ? AND nPayment = '2' AND dICUwhoapproved != '' AND approvals = '3' AND approvals !='4' AND dCashierwhopaid = '' ORDER BY id desc LIMIT 5000";
       
      /* $this->db->where('dCashierwhopaid =', ''); 
       $this->db->where('approvals !=', '4'); 
       $this->db->where('approvals =', '3'); 
       $this->db->where('dICUwhoapproved !=', ''); 
       $this->db->where('nPayment =', '2'); 
       $this->db->where('dAccountgroup =', '1'); 
       $this->db->select($this->columns);
       $this->db->from($this->chequeTable);
       * 
       */
          
            /*********IF CONDITION FOR SEARCH **************/
            if(!empty($_POST["search"]["value"])){
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



       public function makeDatabase($dAccountgroup){
            $this->getpaidby();
            if($_POST["length"] != -1){
                $this->db->limit($_POST["length"], $_POST["start"]);
            }
            //$this->db->where('dCashierwhopaid =', ''); 
            //$this->db->where('approvals !=', '4'); 
            $this->db->where('approvals =', '3'); 
            //$this->db->where('dICUwhoapproved !=', ''); 
            $this->db->where('nPayment =', '2'); 
            $this->db->where('dAccountgroup =', $dAccountgroup); 
            $this->db->select($this->columns);
            //$this->db->from($this->chequeTable);
            $query = $this->db->get($this->chequeTable);
            //return $query->result(); 
             if($query->num_rows() > 0){
                return $query->result();
                }

                else{
                    return FALSE;
                }
        
        }
        

         public function get_data_filtered($dAccountgroup){
             $this->getpaidby();
            //$this->db->where('dCashierwhopaid =', ''); 
            //$this->db->where('approvals !=', '4'); 
            $this->db->where('approvals =', '3'); 
            //$this->db->where('dICUwhoapproved !=', ''); 
            $this->db->where('nPayment =', '2'); 
            $this->db->where('dAccountgroup =', $dAccountgroup); 
            $this->db->select($this->columns); 
            $query = $this->db->get($this->chequeTable);
            
           
            return $query->num_rows();
        }

         public function getAll_data(){
            $this->db->select("*");
             
            $this->db->from($this->chequeTable);
            return $this->db->count_all_results();
        }
       

//////////////////////////////////END OF ANOTHER DATA TABLE SERVER SIDE EXAMPLE /////////////////////////////////////////        
    
        
      
} // End of Class Prediction extends CI_Model