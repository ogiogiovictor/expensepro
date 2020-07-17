<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class Icuonly extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();

        $this->load->model('archievesmodel');
        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        $this->gen->checkLogin();
        $this->load->model('icumodelonly');
        $putNewSession = $this->users->checkUserSession($_SESSION['email']);
        if ($putNewSession === FALSE) {
            redirect("https://c-iprocure.com/moneybook/nopriveledge");
        }
    }

    public function index() {
        redirect(base_url());
    }

    public function allarchievesrequest() {
        $fetch_data = $this->icumodelonly->makeDatabase();

        $data = [];
        $randomString = random_string('alnum', 60);
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $sub_array[] = $row->id;
            $sub_array[] = $row->dateCreated;
             //$sub_array[] = $this->adminmodel->getUsername($row->sessionID);
            $sub_array[] = "<span style='color:blue'>".$row->ndescriptOfitem. "</span>";
            $sub_array[] = $this->mainlocation->getdunit($row->dUnit);
            $sub_array[] = $this->mainlocation->getpaymentType($row->nPayment);
            $sub_array[] = @number_format($row->dAmount, 2);
            $sub_array[] = $row->dICUwhoapproved;
            $sub_array[] = $row->dICUwhorejectedrequest;
            $approvals = $row->approvals;
            $sub_array[] = "<a href='" . base_url() . "home/viewreqeuestdetails/$row->id/$approvals/$randomString'><button class='btn btn-xs btn-facebook'>View</button></a>";
                                         
            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->archievesmodel->getAll_data(),
            "recordsFiltered" => $this->archievesmodel->get_data_filtered(),
            "data" => $data
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    
    

}

// End of Class Home
