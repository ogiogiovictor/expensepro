<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Accountrecievable extends CI_Model {

    public function __construct() {
        parent::__construct();
        //$this->db3 = $this->load->database('getajobdb', TRUE);
    }

    /*     * *** This controller returns all users ***** */

    public function getrecievablewaiting() {
        $q = "SELECT * FROM cash_recievable_retirement WHERE `approvals` = '3' AND icuSeen = 'no' AND retiredAmount !=''";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
     public function accounttoseethis() {
        $q = "SELECT * FROM cash_recievable_retirement WHERE `approvals` = '4' AND icuSeen = 'yes' AND retiredAmount !=''";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
     public function admintoseeall() {
        $q = "SELECT * FROM cash_recievable_retirement WHERE retiredAmount !=''";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    public function withcashreimbursementdetails($id) {
         $q = "SELECT rID, icuSeen FROM cash_recievable_retirement WHERE rID = '$id' AND icuSeen ='yes'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach($run_q->result() as $get){
				return $get->icuSeen;
			}
        } else {
            return FALSE;
        }
    }
	
	
	 public function reimbursementresulting($id) {
         $q = "SELECT * FROM cash_recievable_retirement WHERE rID = '$id' AND icuSeen ='yes'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
				
        } else {
            return FALSE;
        }
    }

    
    
     public function checkhaseen($mainID) {
        echo $q = "SELECT * FROM cash_recievable_retirement WHERE rID = '$id' AND icuSeen ='yes'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
     public function gethodusingID($id) {
         $q = "SELECT hodEmail FROM travelstart WHERE id = '$id'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
              foreach ($run_q->result() as $get) {
                return $get->hodEmail;
            }
        } else {
            return FALSE;
        }
    }

  

}

// End of Class Prediction extends CI_Model