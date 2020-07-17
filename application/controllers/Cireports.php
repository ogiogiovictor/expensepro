<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class Cireports extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();


        $pageTitle = "C&I :: Expense Pro Setup";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        $this->gen->checkLogin();
    }

    public function index() {
        echo "We don't know";
    }

    public function icureport() {
        $title = "EXPENSE PRO :: ICU REPORT";
        //Get second level approval ID
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 5 || $getApprovalLevel == 7) {

            //Get Session Details
            $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);



            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('reports/icureport', $values);
        } else {
            redirect(base_url());
        }
    }

    public function cashiersreport() {
        $title = "EXPENSE PRO :: ICU REPORT";
        //Get second level approval ID
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 6 || $getApprovalLevel == 4) {

            //Get Session Details
            $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);



            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('reports/cashiersreport', $values);
        } else {
            redirect(base_url());
        }
    }

    public function cashiersreportbyactcode() {
        $title = "EXPENSE PRO :: ICU REPORT";
        //Get second level approval ID
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 6 || $getApprovalLevel == 4) {

            //Get Session Details
            $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('reports/cashiersreportwithactcode', $values);
        } else {
            redirect(base_url());
        }
    }

    public function icureportrejected() {
        $title = "EXPENSE PRO :: ICU REPORT";
        //Get second level approval ID
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 5) {

            //Get Session Details
            $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);



            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('reports/icureportrejected', $values);
        } else {
            redirect(base_url());
        }
    }

    public function mxdy_myds00k() {

        $title = "EXPENSE PRO :: ICU REPORT";
        //Get second level approval ID
           $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

            $allRequest =  $this->mainlocation->allresultlimit();
           
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'allRequest' =>$allRequest, 'getApprovalLevel' => $getApprovalLevel,  'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('reports/fullreport', $values);
       
    }

    public function projectsearch() {
        ini_set('memory_limit', '-1');
         $title = "EXPENSE PRO :: ICU REPORT";
        //Get second level approval ID
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);


        if (isset($_SERVER['QUERY_STRING']) && trim($_SERVER['QUERY_STRING']) != '') {
            $expsql = '';
            $firstExplode = explode('&', $_SERVER['QUERY_STRING']);
            foreach ($firstExplode as $expItem) {
                $secExp = explode('=', trim($expItem));
                if (isset($secExp[1]) && trim($secExp[0]) != 'url' && trim($secExp[0]) != 'modroute' && trim($secExp[0]) != '_token') {
                    //$explode_exp1 = explode('_', trim($secExp[0]));

                    if (trim($secExp[1]) == 'id') {
                        $expsql .= (trim($secExp[1]) != '') ? '`' . $secExp[0] . '` = "' . str_replace('+', ' ', $secExp[1]) . '" AND ' : '';
                    } elseif ($secExp[0] === 'dateCreated') {
                        $expsql .= (trim($secExp[1]) != '') ? 'DATE(`' . substr($secExp[0], 0) . '`) >= ' . '"' . str_replace('+', ' ', $secExp[1]) . '" AND ' : '';
                    } elseif ($secExp[0] === 'dateRegistered') {
                        $expsql .= (trim($secExp[1]) != '') ? 'DATE(`' . substr($secExp[0], 0) . '`) <= ' . '"' . str_replace('+', ' ', $secExp[1]) . '" AND ' : '';
                    } else if ($secExp[0] === 'dAmount') {
                        $expsql .= (trim($secExp[1]) != '') ? '`' . $secExp[0] . '` = "' . str_replace('+', ' ', $secExp[1]) . '" AND ' : '';
                    }else if ($secExp[0] === 'datepaid') {
                        $expsql .= (trim($secExp[1]) != '') ? '`' . $secExp[0] . '` = "' . str_replace('+', ' ', $secExp[1]) . '" AND ' : '';
                    } else if ($secExp[0] === 'cashiers') {
                        $expsql .= (trim($secExp[1]) != '') ? '`' . $secExp[0] . '` = "' . str_replace('%40', '@', $secExp[1]) . '" AND ' : '';
                    } else
                        $expsql .= (trim($secExp[1]) != '') ? '`' . $secExp[0] . '` like ' . '"%' . str_replace('+', ' ', $secExp[1]) . '%" AND ' : '';
                } else {
                    $expsql .= "";
                }
            }
            
            
             $formatexpsql = substr($expsql, 0, -4);
             
             echo $formatexpsql;
             return;
            //$allRequest = DB::table("trips")->whereRaw(DB::raw($formatexpsql))->get();
            $allRequest =  $this->mainlocation->getallresultbysql($formatexpsql);
            
            
        }else {
            $allRequest = '';
        }
        
       // if(count($allRequest) > 0){
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'allRequest' => $allRequest, 'getApprovalLevel' => $getApprovalLevel,  'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('reports/fullreport', $values);  
       // }
        
    }

    /////////////////////////////////////////END OF THE OTHER POINT OF VIEW FOR SEARCHING  ////////////////////////////
}

// End of Class
