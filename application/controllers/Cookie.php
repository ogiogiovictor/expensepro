<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class Cookie extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('travelmodel');

        $pageTitle = "C&I :: Expense Pro :: Travel Start";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        //$this->load->model("datatablemodels"); 
        $this->gen->checkLogin();
    }

    public function index() {

            $title = "EXPENSE PRO :: COOKIE POLICY";

            //Get Session Details
            $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);


            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/cookie', $values);
        
    }

    ////////////////////////////////////////////START OF INDEX2 WITH SERVER SIDE PROGRAMMING //////////////////////////////


    
}// End of Class Home
