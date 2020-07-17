<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once('PHPMailerAutoload.php');
class Dashboard extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();
        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        $this->gen->checkLogin();
        $this->load->model('primary');

    }

    public function index() {
      $json = [];
      //Get the result count from the database
      $getResult = $this->primary->getdresult("*", "cash_newrequestdb", "", "");
      
      $json = ['count'=>count($getResult)];
      $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    public function win(){
        $json = [];
      //Get the result count from the database
      $getResult = $this->primary->getdresult("*", "cash_newrequestdb", "", "");
      $count = count($getResult);
      $json = [$count];
      $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

}

// End of Class Home
