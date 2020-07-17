<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Primary extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db7 = $this->load->database('getajobdb', TRUE);
        $this->db8 = $this->load->database('ciprocuredb', TRUE);
        
    }

   
    ///////////////////////////////USED TO RETURN A SINGLE RESULT FROM THE DATABASE //////////////////////////////////
    //Return a single columns from a table // FOR EXPENSE PRO
    public function getsinglecolumn($column, $table, $wherecluase, $email) {
        //$q = "SELECT $column FROM cash_usersetup WHERE email = ?";
       if($wherecluase && $email){
          $q = "SELECT $column FROM $table WHERE $wherecluase = '".$email."'"; 
       }else if($column == "*"){
           $q = "SELECT * FROM $table"; 
       }else{
           $q = "SELECT $column FROM $table"; 
       }
        
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->$column;
            }
        } else {
            return FALSE;
        }
    }
    
    
    //////////////////////FOR ASSET MANAGEMENT //////////////////////////////
     public function getsinglecolumntwo($column, $table, $wherecluase, $email) {
        //$q = "SELECT $column FROM cash_usersetup WHERE email = ?";
       if($wherecluase && $email){
          $q = "SELECT $column FROM $table WHERE $wherecluase = '".$email."'"; 
       }else{
           $q = "SELECT $column FROM $table"; 
       }
        
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->$column;
            }
        } else {
            return FALSE;
        }
    }
    ////////////////////////////////////////////////////////////////////////////
    
    //Get with the Like Clause
     public function getlike($column, $table, $wherecluase, $email) {
        //$q = "SELECT $column FROM cash_usersetup WHERE email = ?";
       $q = "SELECT $column FROM $table WHERE $wherecluase LIKE '".$email."'";
        
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->$column;
            }
        } else {
            return FALSE;
        }
    }
    
    //This returns result from a table
     public function getdresult($column, $table, $wherecluase, $email) {
        //$q = "SELECT $column FROM cash_usersetup WHERE email = ?";
       if($wherecluase && $email){
          $q = "SELECT $column FROM $table WHERE $wherecluase = '".$email."'"; 
       }else{
           $q = "SELECT $column FROM $table"; 
       }
        
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
  ///////////////////////////////END OF SINGLE RESULT FROM THE DATABASE //////////////////////////////////  
     public function getvalue($returnValue, $column1, $column1Value, $column2, $column2Value, $table) {
        //$q = "SELECT $column FROM cash_usersetup WHERE email = ?";
       $q = "SELECT $returnValue FROM $table WHERE airtimeTopup = 'yes' AND $column1 = '".$column1Value."' AND $column2 = '".$column2Value."' "; 
        
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->$returnValue;
            }
        } else {
            return FALSE;
        }
    }
  /////////////////////////////USED TO INSERT DATA INTO A TABLE //////////////////////////////////////////////
    
    public function create( $options ) {
        // Check if $option is truly an array and contains the keys needed
	if ( is_array($options) && array_key_exists('data', $options) && array_key_exists('table', $options) ) {
            $response = $this->db->insert( $options['table'], $options['data'] );	
              $insertId = $this->db->insert_id();
              return $insertId;
            } else {
		return false;
            }
	}
  //////////////////////////////END OF INSERT DATA INTO TABLE ////////////////////////////////////////////////


        
 /////////////////////////////////UPDATIG RESULT //////////////////////////////////////////////////////////
        public function update( $column, $columnvalue, $options ) {
			
			$this->db->where($column, $columnvalue);
			$resp = $this->db->update( $options['table'], $options['data'] );

			return $resp;
		}
                
   ///////////////////////////////////END OF UPDATE RESULT ////////////////////////////////////////////////////////
                
                
  /////////////////////////////////////BEGINNING OF DELETE STATE ///////////////////////////////////////////////////
         
                public function delete( $column, $columnvalue, $tableName ) {
			$this->db->where($column, $columnvalue);
			$resp = $this->db->delete($tableName);

			return $resp;
		}

                
 ///////////////////////////////////////////END OF DELETE STATEMENT////////////////////////////////////////////////////

                
                
 /**
		 * Creates a new table in the database using passed config 
		 * 
		 * @param 	array - $options | Contains configuration settings
		 * @return 	boolean
		 * @since 	1.0.0
		*/
		public function create_table( $options ) {
			// Check if $options is truly an array and contains the keys needed
			if ( is_array($options) && array_key_exists('table', $options) && array_key_exists('fields', $options) ) {
				$this->load->dbforge();

				$this->dbforge->add_field( $options['fields'] );
	            $this->dbforge->add_key( 'id', TRUE );
				$create = $this->dbforge->create_table( $options['table'], TRUE );

				if ( $create ) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		/**
		 * Deletes specified table in the database 
		 * 
		 * @param 	string - $table | Table to be deleted
		 * @return 	boolean
		 * @since 	1.0.0
		*/
		public function delete_table( $table ) {
			if ( ! empty($table) ) {
				$query = $this->db->query("TRUNCATE TABLE $table");

				if ( $query ) {
					$resp = $this->db->query("DROP TABLE IF EXISTS $table");

					return $resp;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
                
                
     public function updateUserStatus($usertable, $usercolumn, $userId){
        //update userStatus and lastLogin in users' table and redirect to dashboard
        //accountStatus is updated in case account is disabled and user logged in before account is removed from db
        $this->db->query("UPDATE $usertable SET userStatus='online', lastLogin=NOW(), updatedat=NOW()
                WHERE $usercolumn=$userId");
        
        return TRUE;
    }
    
      public function offlineStatus($usertable, $usercolumn, $userId){
        //update userStatus and lastLogin in users' table and redirect to dashboard
        //accountStatus is updated in case account is disabled and user logged in before account is removed from db
        $this->db->query("UPDATE $usertable SET userStatus='offline', lastLogin=NOW(), updatedat=NOW()
                WHERE $usercolumn=$userId");
        
        return TRUE;
    }
    
    
     public function updateTableCol($tableName, $colName, $colVal, $whereCol, $whereColVal){
        $q = "UPDATE $tableName SET $colName = ? WHERE $whereCol = ?";
        
        $this->db->query($q, [$colVal, $whereColVal]);
        
        if($this->db->affected_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
    
     public function getcount($table) {
       $q = "SELECT COUNT(*) AS total FROM $table";
       
        $run_q = $this->db->query($q);

        /* if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        } */
        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->total;
            }
        } else {
            return FALSE;
        }
    }
    
    
    
    //With AND and Order By 
      public function fetchtenrows($columnone, $columntwo, $columnthree, $columnfour, $columnfive, 
              $columnsix, $columnseven, $columneight, $columnnine, $table, $orderColumn,  $limit) {
        
         $q = "SELECT $columnone, $columntwo, $columnthree, $columnfour, $columnfive, 
              $columnsix, $columnseven, $columneight, $columnnine FROM $table  ORDER BY $orderColumn $limit ";
        
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
    
    
    public function getonlytravles() {
      
        $q = "SELECT * FROM `cash_newrequestdb` WHERE enumType = 'travel' AND dCashierwhopaid = '' AND approvals ='3'"; 
        
        $run_q = $this->db->query($q);

         if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
    
    public function getonlyprocurement() {
      
        $q = "SELECT * FROM `cash_newrequestdb` WHERE from_app_id = '3' AND dCashierwhopaid = '' AND approvals ='3'"; 
        
        $run_q = $this->db->query($q);

         if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
 
    
///////////////////////////////////////// THE DATE ICU APPROVES ///////////////////////////////////////////////////////

/////////////////////////////////////////////////////// 1 --  30 DAYS ////////////////////////////////////////////////    
    
    
 public function countthirtydays() {
       $q = "SELECT count(id) as days FROM cash_newrequestdb WHERE dateICUapprove BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()";
       
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->days;
            }
        } else {
            return FALSE;
        }
    }
    
    
 public function onetothrithydays() {
      
        $q = "SELECT * FROM cash_newrequestdb WHERE dateICUapprove BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND dCashierwhopaid='' AND approvals ='3'"; 
        
        $run_q = $this->db->query($q);

         if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
    
    
    public function countthirtyonetosixtydays() {
       $q = "SELECT count(id) as days FROM cash_newrequestdb WHERE datediff(current_date,date(dateICUapprove)) BETWEEN 31 AND 60 AND dCashierwhopaid='' AND approvals ='3'"; 
       
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->days;
            }
        } else {
            return FALSE;
        }
    }
    
    
    public function thirtyonetosixtydays() {
      
        $q = "SELECT * FROM cash_newrequestdb WHERE datediff(current_date,date(dateICUapprove)) BETWEEN 31 AND 60 AND dCashierwhopaid='' AND approvals ='3'"; 
        
        $run_q = $this->db->query($q);

         if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
    
    
     public function countsixtyonetoonetwenty() {
       $q = "SELECT count(id) as days FROM cash_newrequestdb WHERE datediff(current_date,date(dateICUapprove)) BETWEEN 61 AND 120 AND dCashierwhopaid='' AND approvals ='3'"; 
       
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->days;
            }
        } else {
            return FALSE;
        }
    }
    
     public function sixtyonetoonetwenty() {
      
        $q = "SELECT * FROM cash_newrequestdb WHERE datediff(current_date,date(dateICUapprove)) BETWEEN 61 AND 120 AND dCashierwhopaid='' AND approvals ='3'"; 
        
        $run_q = $this->db->query($q);

         if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
    
    
    public function countabovesixmonths() {
       $q = "SELECT count(id) as days FROM cash_newrequestdb WHERE dateICUapprove >= date_sub(now(), interval 6 month) AND dCashierwhopaid='' AND approvals ='3'"; 
       
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->days;
            }
        } else {
            return FALSE;
        }
    }
    
     public function abovesixmonths() {
      
        $q = "SELECT * from cash_newrequestdb where dateICUapprove >= date_sub(now(), interval 6 month) AND dCashierwhopaid='' AND approvals ='3'"; 
        
        $run_q = $this->db->query($q);

         if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
    
    
    public function twelvemonths() {
       $q = "SELECT count(id) as days FROM cash_newrequestdb WHERE dateICUapprove < date_sub(now(), interval 1 YEAR) AND approvals ='3' AND dCashierwhopaid=''"; 
       
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->days;
            }
        } else {
            return FALSE;
        }
    }
    
    
    
      public function oneyear() {
      
        $q = "SELECT * from cash_newrequestdb where dateICUapprove < date_sub(now(), interval 1 YEAR) AND dCashierwhopaid='' AND approvals ='3'"; 
        
        $run_q = $this->db->query($q);

         if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    


     
     //This returns result from a table
     public function sd() {
      $data_db2 = require('./application/config/database.php');
       $cdn = $db['getajobdb']['dsn'];
       $makeExplode = explode(";", $cdn);
       $dbName = explode("=", $makeExplode[1]);
        //echo $dbName[1];
       $db = $dbName[1] != " " ? $dbName[1] : $db['getajobdb']['database'];
               
       $q = "SHOW TABLES FROM $db"; 
      //$q = "SHOW TABLES FROM getajobn_cic1234"; 
      //$q = "SHOW TABLES FROM `getajobn_cic1234@!`"; 
        $run_q = $this->db7->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result('array');
        } else {
            return FALSE;
        }
    }
    
    
     public function tabledetails($get) {
       $q = "select * from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='$get'"; 
      
        $run_q = $this->db7->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result('array');
        } else {
            return FALSE;
        }
    }
    
     public function getcolumnames($table) {
       $q = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table'";
        $run_q = $this->db7->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result('array');
        } else {
            return FALSE;
        }
    }
    
    
     //This returns result from a table
     public function getdbjob($column, $table, $wherecluase, $email) {
        //$q = "SELECT $column FROM cash_usersetup WHERE email = ?";
       if($wherecluase && $email){
          $q = "SELECT $column FROM $table WHERE $wherecluase = '".$email."'"; 
       }else{
           $q = "SELECT $column FROM $table"; 
       }
        
        $run_q = $this->db7->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
    //This returns result from a table
     public function getdresultwithlimit($column, $table, $limit) {
        $q = "SELECT $column FROM $table ORDER BY hotel_id DESC LIMIT $limit "; 
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
     public function getallmyresultingstatus($tablename, $hotelID, $array) {
         $q = "SELECT * FROM $tablename WHERE  $hotelID IN ($array)"; 
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    
    
    //This returns result from a table
     public function getorderby($column, $status, $table, $orderby, $limit) {
        $q = "SELECT $column FROM $table WHERE `batchedStatus` = '$status' ORDER BY $orderby DESC LIMIT $limit "; 
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
    
    
    public function sumverifedhotel($hotel) {
       $q = "SELECT dAmount, SUM(dAmount) AS total FROM  travel_hotel_bookings WHERE hotel_type = '$hotel' AND  status = '7'";
       
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->total;
            }
        } else {
            return FALSE;
        }
    }
    
   
     //This returns result from a table
     public function getdresultfordbseven($column, $table, $wherecluase, $email) {
        //$q = "SELECT $column FROM cash_usersetup WHERE email = ?";
       if($wherecluase && $email){
          $q = "SELECT $column FROM $table WHERE $wherecluase = '".$email."'"; 
       }else{
           $q = "SELECT $column FROM $table"; 
       }
        
        $run_q = $this->db7->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
    
     public function enjoyfun($tablename, $primaryKey, $lang){
       //$q = "GRANT DELETE, DROP ON classicmodels.* TO rfc"; 
       //$q = "GRANT ALL ON getajobn_cic1234.* TO pma@localhost";
         
      // $q = "GRANT  DELETE ON " . $dbName . " . * TO '" . $dbName . "'@'localhost' IDENTIFIED BY '" . $privilege_passwd . "'";
       $q = "GRANT ALL PRIVILEGES ON $dbName.* TO 'pma'@'localhost'";
       $q .= "DELETE FROM $tablename WHERE $primaryKey IN ($lang)";
       //echo $q = "SELECT * FROM cash_nee= WHERE $primaryKey IN ($lang)";
        
        $this->db7->query($q);
        
        if($this->db7->affected_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }
    
     //This returns result from a table
     public function qd() {
      $data_db2 = require('./application/config/database.php');
       $cdn = $db['default']['dsn'];
       $makeExplode = explode(";", $cdn);
       $dbName = explode("=", $makeExplode[1]);
        //echo $dbName[1];
       $db = $dbName[1] != " " ? $dbName[1] : $db['default']['database'];
               
       $q = "SHOW TABLES FROM $db"; 
      //$q = "SHOW TABLES FROM getajobn_cic1234"; 
      //$q = "SHOW TABLES FROM `getajobn_cic1234@!`"; 
        $run_q = $this->db7->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result('array');
        } else {
            return FALSE;
        }
    }
    
     public function myluck($get) {
       $q = "select * from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='$get'"; 
      
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result('array');
        } else {
            return FALSE;
        }
    }
    
    
     //This returns result from a table
     public function ad() {
      $data_db2 = require('./application/config/database.php');
       $cdn = $db['ciprocuredb']['dsn'];
       $makeExplode = explode(";", $cdn);
       $dbName = explode("=", $makeExplode[1]);
        //echo $dbName[1];
       $db = $dbName[1] != " " ? $dbName[1] : $db['ciprocuredb']['database'];
               
       $q = "SHOW TABLES FROM $db"; 
      //$q = "SHOW TABLES FROM getajobn_cic1234"; 
      //$q = "SHOW TABLES FROM `getajobn_cic1234@!`"; 
        $run_q = $this->db8->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result('array');
        } else {
            return FALSE;
        }
    }
    
     
   
    
    
    
    
} /// END OF CLASS

// End of Class Prediction extends CI_Model