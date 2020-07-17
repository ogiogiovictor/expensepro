<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class Maintenance extends CI_Controller {

	/**
	 * Name : Ogiogio Victor
	 * Phone : 07038807891
	 */
    
   
    
	public function index()
	{
            $title = "TBS Expense Pro :: HOMEPAGE";
	
            $this->load->view('maintenance');
			
	}
        
        
   
} // End of Class Home
