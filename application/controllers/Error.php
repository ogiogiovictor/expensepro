<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class Error extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();

        
        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        //$this->load->model("datatablemodels"); 
        $this->gen->checkLogin();
    }

    public function index() {
        $this->load->view("error404");
    }

    ////////////////////////////////////////////START OF INDEX2 WITH SERVER SIDE PROGRAMMING //////////////////////////////

    
}

// End of Class Home
