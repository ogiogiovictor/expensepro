<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Maintenance extends CI_Model{
	
	public function __construct(){
		parent::__construct();
                $this->db2 = $this->load->database('assetmanagement', TRUE);
	}
	

       public function auditTrailblast($approved, $recomm, $setupfromjson){
		$q = "UPDATE maintenance_assets SET "
                        . "`auditTrail`= CASE WHEN auditTrail = '' THEN '$approved' ELSE CONCAT(`auditTrail`, '$approved'),
                          `comments`= CASE WHEN comments = '' THEN '$recomm' ELSE CONCAT(`comments`, '$recomm')"
                        . "END WHERE id = '$setupfromjson'";
		$this->db2->query($q);
                return $setupfromjson;
	}
        

    public function updateTableCol($tableName, $colName, $colVal, $whereCol, $whereColVal){
        $q = "UPDATE $tableName SET $colName = ? WHERE $whereCol = ?";
        
        $this->db2->query($q, [$colVal, $whereColVal]);
        
        if($this->db->affected_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }

        
     public function fromaintenance($column, $table, $wherecluase, $email) {
             //$q = "SELECT $column FROM cash_usersetup WHERE email = ?";
        if ($wherecluase && $email) {
            $q = "SELECT $column FROM $table WHERE $wherecluase = '" . $email . "'";
        } else if ($column == "*") {
            $q = "SELECT * FROM $table";
        } else {
            $q = "SELECT $column FROM $table";
        }

        $run_q = $this->db2->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
       
    
     public function maintenancepayee($column, $table, $wherecluase, $email) {
        //$q = "SELECT $column FROM cash_usersetup WHERE email = ?";
        if ($wherecluase && $email) {
            $q = "SELECT $column FROM $table WHERE $wherecluase = '" . $email . "'";
        } else {
            $q = "SELECT $column FROM $table";
        }

        $run_q = $this->db2->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->$column;
            }
        } else {
            return FALSE;
        }
    }
    
     public function create($options) {
        // Check if $option is truly an array and contains the keys needed
        if (is_array($options) && array_key_exists('data', $options) && array_key_exists('table', $options)) {
            $response = $this->db2->insert($options['table'], $options['data']);
            $insertId = $this->db2->insert_id();
            return $insertId;
        } else {
            return false;
        }
    }
    
    
} // End of Class Prediction extends CI_Model