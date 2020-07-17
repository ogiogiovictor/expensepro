<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class Recieveables extends CI_Controller {

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
        $this->load->model("accountrecievable"); 
        $this->gen->checkLogin();
    }

  

    public function index($id) {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //$myRecievables = $this->users->getRecievables();
        //$whichRecivable = $this->gen->haveAccess($_SESSION['id'], $myRecievables);
        //if ($getApprovalLevel == 6 || $whichRecivable == TRUE || $getApprovalLevel == 2) {
        $recievableAccess = $this->generalmd->getsinglecolumn("userid", "main_menu", "id",  $id);
        $whichRecivable = $this->gen->haveAccess($_SESSION['id'], $recievableAccess);
       
        if($id == ""){
             $this->load->view('noaccesstoview');
        }
        if($id && $whichRecivable){
            $title = "Expense Pro :: ACCOUNT RECIEVEABLE";
            
            if($getApprovalLevel == 3){ // ICU has not seen
                 $getResult = $this->accountrecievable->getrecievablewaiting();
            }else if($getApprovalLevel == 7){ //Account can See
                 $getResult = $this->accountrecievable->accounttoseethis();
            }else if($getApprovalLevel == 6){
                 $getResult = $this->accountrecievable->admintoseeall();
            }else if($getApprovalLevel == 4 && $whichRecivable == TRUE){
                $getResult = $this->accountrecievable->accounttoseethis();
            }else{
               $getResult = $this->travelmodel->sentomeforreibursement($_SESSION['email']); 
            }
           
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getResult'=>$getResult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('accountrecievable/mainrecievable', $values);
        } else {
            $this->load->view('noaccesstoview');
        }
    }
    
    
    
     public function reciViewXdetails($id=""){
       
        if(empty($id)){
           
            echo "Important Variable to render this page is missing";
        }else{
            //Use the ID to return the results;
              // Use id to return travelID
        $getDetails = $this->travelmodel->gettravelresult($id);
         
        $title = "TBS: Transport Details - Expense Pro";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'mainID'=>$id, 'dDetials' => $getDetails,  'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('travelstart/recievablesdetails', $values);
        }
    }

  
    public function makepaymentoexpensepro($id =""){
        if($id == ""){
            $this->load->view('noaccesstoview');
        }else{
             $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
              $myRecievables = $this->users->getRecievables();
              $whichRecivable = $this->gen->haveAccess($_SESSION['id'], $myRecievables);
        
             if($getApprovalLevel == 7 || $getApprovalLevel == 6 || $whichRecivable == TRUE){
                 
                $title = "Make Payment To Expense Pro";
                $getResult = $this->accountrecievable->reimbursementresulting($id);
               
                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title, 'getResult' => $getResult, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
                $this->load->view('travelstart/reimburseme', $values); 
         
             }else{
                $this->load->view('noaccesstoview');
             }
        }
    }
    
}// End of Class Home
