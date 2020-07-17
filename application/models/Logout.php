<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Logout extends CI_Model{
	
	public function __contruct(){
		parent::__contruct();
	}
	
	/***** This controller returns all users ******/
	 public function destroyall($email){
        $q = "UPDATE cash_usersetup SET userStatus='offline', lastlogin=NOW() WHERE email = ?";
        $this->db->query($q, [$email]);
    }
	

	
} // End of Class Prediction extends CI_Model