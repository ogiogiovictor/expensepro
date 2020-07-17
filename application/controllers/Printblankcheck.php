<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

//require_once('PHPMailerAutoload.php');
class Printblankcheck extends CI_Controller {

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
        $this->load->model('generalmd');

        //$this->load->library('PHPMailerfunction');
        $this->load->model('accountmodel');
        $putNewSession = $this->users->checkUserSession($_SESSION['email']);
        if ($putNewSession === FALSE) {
            redirect(base_url() . "nopriveledge");
        }
    }
    
    
    public function index() {}
    
    public function newprint($id){
        $title = "EXPENSE PRO :: BANK STATEMENT";

        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        if ($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 8) {

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('blankcheck', $values);
        } else {
            echo "You do not have permission to view this page";
        }
    }
    
    
    
    public function processcheque(){
        $data  = [];
       if(isset($_POST['myBank'])){
           
           $myBank = $this->input->post('myBank');
           $dAmount = $this->input->post('dAmount');
           $beneficiary = $this->input->post('beneficiary');
           $date = $this->input->post('date');
           
           //Check Dimension
            $getBankchq_name = $this->generalmd->getsinglecolumn("chq_name", "newbank", "bankNumber", $myBank);
            $chq_date = $this->generalmd->getsinglecolumn("chq_date", "newbank", "bankNumber", $myBank);
            $chq_amount_words = $this->generalmd->getsinglecolumn("chq_amount_words", "newbank", "bankNumber", $myBank);
            $chq_amount = $this->generalmd->getsinglecolumn("chq_amount", "newbank", "bankNumber", $myBank);
           
           if($myBank == "" || $dAmount == "" || $beneficiary == "" || $date == ""){
               $data = ['status'=>1, 'msg'=>'Please fill out all fields'];
           }else{
               
                $datarray = [];
                $datarray['chequeDate'] = $date;
                $datarray['bank'] = $myBank;
                $datarray['beneficiary'] = $beneficiary;
                $datarray['amount'] = $dAmount;
                //$datarray['amount_in_words'] = numberTowords($dAmount);
                
                $datarray['chq_name'] = $getBankchq_name;
                $datarray['chq_date'] = $chq_date;
                $datarray['chq_amount_words'] = $chq_amount_words;
                $datarray['chq_amount'] = $chq_amount;
                 $datarray['sessionid'] = $this->session->id;
                
                
                $options = array(
                    'table' => 'outside_expensepro',
                    'data' => $datarray
                );

                
                $insertedFileId = $this->generalmd->create($options);
                
                if($insertedFileId){
                     $data = ['status'=>2, 'msg'=>'Successfully Updated',  'id' =>$insertedFileId];
                }else{
                     $data = ['status'=>3, 'msg'=>'Error Update Cheque, Please try again'];
                }

           }
           
       }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    public function loadCheque($id){
       
         //Check Dimension
            $getBankchq_name = $this->generalmd->getsinglecolumn("chq_name", "outside_expensepro", "id", $id);
            $chq_date = $this->generalmd->getsinglecolumn("chq_date", "outside_expensepro", "id", $id);
            $chq_amount_words = $this->generalmd->getsinglecolumn("chq_amount_words", "outside_expensepro", "id", $id);
            $chq_amount = $this->generalmd->getsinglecolumn("chq_amount", "outside_expensepro", "id", $id);
            
            $vendor = $this->generalmd->getsinglecolumn("beneficiary", "outside_expensepro", "id", $id);
            $newAmount = $this->generalmd->getsinglecolumn("amount", "outside_expensepro", "id", $id);
            
         //Get Details of the ID
            $value = ['chqName' => $getBankchq_name, 'chqDate' => $chq_date, 'chqWords' => $chq_amount_words,
                'chqAmount' => $chq_amount, 'payeeName' => $vendor, 'actualAmount' => $newAmount];
            $this->load->view('checkbook', $value);
    }
    
}

// End of Class Home
