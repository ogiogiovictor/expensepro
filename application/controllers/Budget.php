<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
require_once (dirname(__FILE__) . "/Maincontroller.php");

class Budget extends CI_Controller {

    var $id;
    protected $CI;

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();
        $pageTitle = "C&I :: Expense Pro Management - BUDGET";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        $this->gen->checkLogin();
        $this->gen->mainSetting();
        $putNewSession = $this->users->checkUserSession($_SESSION['email']);
        if ($putNewSession === FALSE) {
            redirect(base_url() . "nopriveledge");
        }
        $this->CI = &get_instance();
    }

    public function index($id = "") {

        $checkAcess = $this->gen->check_menu_access($id);
        if ($checkAcess == true) {

            $title = "EXPENSE PRO :: HOMEPAGE";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            //$getYearlyBudget = $this->generalmd->getdresult('*', " yearly_budget", "", "");
            $getYearlyBudget = $this->generalmd->budgetSumItem();
            $year = date('Y');
            $getMonthlyBudget = $this->generalmd->groupbyear($year);

            $getLevelApprove = $this->mainlocation->getapprovallevel($_SESSION['email']);

            $values = ['title' => $title, 'getLevelApprove' => $getLevelApprove, 'menu' => $menu, 'getMonthlyBudget' => $getMonthlyBudget, 'getYearlyBudget' => $getYearlyBudget, 'sidebar' => $sidebar, 'footer' => $footer];
            $this->load->view('budget/budget_settings', $values);
        } else {
            $this->load->view('noaccesstoview');
        }
    }

    public function budgetsetup() {
        $data = [];

        if (isset($_POST['selectUnit'])) {

            $selectUnit = $this->input->post('selectUnit', TRUE);
            $year = $this->input->post('year', TRUE);
            $amount = $this->input->post('amount', TRUE);
            $monthinyear = $this->input->post('monthinyear', TRUE);
            $comments = $this->input->post('comments', TRUE);

            $countifExist = $this->generalmd->getsinglecolumnwithand("unit", "yearly_budget", "unit", $selectUnit, "year", $year);

            if ($selectUnit == "" || $year == "" || $amount == "" || $monthinyear == "") {
                $data = ["status" => 401];
            } else if ($countifExist) {
                $data = ["status" => 402];
            } else {

                $datarray['dateCreated'] = date('Y-m-d H:i:s');
                $datarray['unit'] = $selectUnit;
                $datarray['year'] = $year;
                $datarray['amount'] = $amount;
                $datarray['month_in_year'] = $monthinyear;
                $datarray['comment'] = $comments;
                $datarray['budget_lock'] = "pending";

                $options = array(
                    'table' => 'yearly_budget',
                    'data' => $datarray
                );

                $insertedFileId = $this->generalmd->create($options);

                /*
                  if($insertedFileId){
                  $message = "<p>You have a pending hotel approval </p>";
                  $message .= " Name -  $emailAddress <br/>";
                  $message .= " Date $destination <br/>";
                  $message .= " Date $whichhotel <br/>";
                  $message .= " Login to expensepro to action on request. <br/>";
                  $config = array(
                  'mailtype' => "html",
                  );

                  $this->email->initialize($config);
                  $this->email->from("expensepro@c-iprocure.com", 'TBS EXPENSE PRO:: BUDGET CREATION');
                  $this->email->cc($_SESSION['email']);
                  $this->email->to($dhod);
                  $this->email->subject('BUDGET CREATION');
                  $this->email->message($message);
                  $this->email->send();
                  }
                 */

                if ($insertedFileId) {
                    $data = ["status" => 200, "idata" => $datarray];
                } else {
                    $data = ["status" => 400];
                }
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function locking() {
        $data = [];

        if (isset($_POST['assetid'])) {

            $yID = $this->input->post('assetid', TRUE);
            // $yearBudgetID = $this->generalmd->getsinglecolumn("*", "yearly_budget", "id", $yID);
            $count = $this->generalmd->getsinglecolumn("month_in_year", "yearly_budget", "id", $yID);

            if ($count) {
                for ($i = 1; $i <= $count; $i++) {

                    $yearBudgetID = $this->generalmd->getdresult("*", "yearly_budget", "id", $yID);
                    if ($yearBudgetID) {
                        foreach ($yearBudgetID as $get) {

                            $datarray['dateCreated'] = date('Y-m-d H:i:s');
                            $datarray['year_budget_id'] = $yID;
                            $datarray['year'] = $get->year;
                            $datarray['unit'] = $get->unit;
                            $datarray['amount'] = round($get->amount / $count, 2);
                            $datarray['month'] = $i;
                            $datarray['monthly_budget_lock'] = "open";

                            $options = array(
                                'table' => 'monthly_budget',
                                'data' => $datarray
                            );

                            $insertedFileId = $this->generalmd->create($options);
                        }


                        //update year budget with id to locked
                        $budgetArray['budget_lock'] = "locked";
                        $option = array(
                            'table' => 'yearly_budget',
                            'data' => $budgetArray
                        );
                        $saveDate = $this->generalmd->update("id", $yID, $option);


                        if ($insertedFileId) {
                            $data = ["status" => 200, "idata" => $datarray];
                        } else {
                            $data = ["status" => 400];
                        }
                    }
                }
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function viewmonths($year, $unit) {

        //Check for Budget Access
        $checkAcess = $this->gen->check_menu_access(11);
        $myUnit = $this->session->dUnit;

        if ($checkAcess == false && $unit !== $myUnit) {
            return $this->load->view('noaccesstoview');
        }

        if ($checkAcess == true || $unit === $myUnit) {

            $title = "EXPENSE PRO :: MONTHLY BUDGET BREAKDOWN";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);

            //$monthlyBudgetValue = $this->generalmd->getresultwithand("*", "monthly_budget", "year", $year, "unit", $unit);
            $monthlyBudgetValue = $this->generalmd->getbudgetmonth($year, $unit);

            $values = ['title' => $title, 'year' => $year, 'unit' => $unit, "checkAcess" => $checkAcess, "getMonthlyBudget" => $monthlyBudgetValue, 'menu' => $menu, 'sidebar' => $sidebar, 'footer' => $footer];
            $this->load->view('budget/monthly_budget_settings', $values);
        } else {
            return $this->load->view('noaccesstoview');
        }
    }

    public function changemonthlyvalues() {
        $data = [];

        if (isset($_POST['savemonthid']) && isset($_POST['budget'])) {

            $savemonthid = $this->input->post('savemonthid', TRUE);
            $budget = $this->input->post('budget', TRUE);

            //update year budget with id to locked
            $budgetArray['amount'] = $budget;

            $option = array(
                'table' => 'monthly_budget',
                'data' => $budgetArray
            );
            $saveDate = $this->generalmd->update("id", $savemonthid, $option);


            if ($saveDate) {
                $data = ["status" => 200];
            } else {
                $data = ["status" => 400];
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function unitBudgetGraph() {
        $month = date('m');
        $year = date('Y');

        $data = [];
        $unit = [];
        $amount = [];
        $year_month = [];

        $monthlyexpense = [];
        $sql = $this->generalmd->jsonbudgetexpense();
        if ($sql) {
            $sum = 0;
            foreach ($sql as $get) {
                array_push($unit, $this->generalmd->getsinglecolumn("abbUnit", "cash_unit", "id", $get->unit));

                $monthly_naira = $this->generalmd->monthlyBudgetExpenseNairaonlySum($get->unit, $year, $month);
                $monthly_others = $this->generalmd->monthlyBudgetExpenseOthersonlySum($get->unit, $year, $month);
                $sum = $monthly_naira + $monthly_others;
                array_push($monthlyexpense, $sum);
            }
        }


        $jsonbudgetAmount = $this->generalmd->jsonbudgetamount($year, $month);
        if ($jsonbudgetAmount) {
            foreach ($jsonbudgetAmount as $get) {
                array_push($amount, $get->total);
            }
        }

        $monthName = date('m');
        $monthName = $this->generalmd->getsinglecolumn("name", "month_in_year", "id", $monthName);
        $data['label'] = $unit;
        $data['budget'] = $amount;
        $data['expense'] = $monthlyexpense;
        $data['yearmont'] = [$monthName, $year];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function lockpassmonth() {
        $monthlyLock = $this->generalmd->getdresult("*", "monthly_budget", "", "");
        $getCurrenctMonth = date('m');

        if ($monthlyLock) {
            foreach ($monthlyLock as $get) {
                $currentMonth = $get->month;
                if ($getCurrenctMonth < $currentMonth) {

                    $budgetArray['monthly_budget_lock'] = "locked";

                    $option = array(
                        'table' => 'monthly_budget',
                        'data' => $budgetArray
                    );
                    //$saveDate = $this->generalmd->update("id", $savemonthid, $option);
                    $updateRequest = $this->generalmd->update("month", $getCurrenctMonth, $option);
                }
            }
        }
    }

    public function item_account_code($unitid, $year) {

        $title = "EXPENSE PRO :: ITEM BUDGET BREAKDOWN";
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);

        $getLevelApprove = $this->mainlocation->getapprovallevel($_SESSION['email']);

        // $monthlyBudgetValue = $this->generalmd->getresultwithand("*", "monthly_budget", "year", $year, "unit", $unitid);
        $yearlyItemBudget = $this->generalmd->getresultwithand("*", "unitaccountcode_budget_setup", "year", $year, "unit", $unitid);
        $values = ['title' => $title, 'getLevelApprove' => $getLevelApprove, 'yearlyItemBudget' => $yearlyItemBudget, 'year' => $year, 'unit' => $unitid, 'menu' => $menu, 'sidebar' => $sidebar, 'footer' => $footer];
        $this->load->view('budget/item_budget_settings', $values);
    }

    public function edit_account_code($id = "") {

        if ($id == "") {
            echo "Important parameter to process page missing";
        } else {
            $title = "EXPENSE PRO :: EDIT BUDGET BREAKDOWN";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);

            $getLevelApprove = $this->mainlocation->getapprovallevel($_SESSION['email']);

            $editItem = $this->generalmd->getdresult("*", "unitaccountcode_budget_setup", "unitaccountcode_id", $id);
            $values = ['title' => $title, 'id' => $id, 'getLevelApprove' => $getLevelApprove, 'editItem' => $editItem, 'menu' => $menu, 'sidebar' => $sidebar, 'footer' => $footer];
            $this->load->view('budget/edit_budget_settings', $values);
        }
    }

    public function setupitemcode() {
        $data = [];

        if (isset($_POST['iselectActCode']) && isset($_POST['iamount'])) {

            $selectActCode = $this->input->post('iselectActCode', TRUE);
            $amount = $this->input->post('iamount', TRUE);
            $year = $this->input->post('iyear', TRUE);
            $unit = $this->input->post('iunit', TRUE);
            $iselectMonth = $this->input->post('iselectMonth', TRUE);

            //Get Amount for Yearly Budget
            //$yearBudgetAmount = $this->generalmd->getsinglecolumn("amount", "yearly_budget", "unit", $unit);
            $checksameCode = $this->generalmd->getsinglecolumnwithand("codeNumber", "unitaccountcode_budget_setup", "month", $iselectMonth, "codeNumber", $selectActCode);

            //Get the Sum of all item Budget
            $itemBudgetSum = $this->generalmd->budgetitemsumforyear($unit, $year);

            $addBoth = $itemBudgetSum + $amount;

            if ($checksameCode) {

                $data = ["status" => 300, "msg" => "You have previously add that account item"];
            } else {

                //update year budget with id to locked
                $budgetArray['amount'] = $amount;
                $budgetArray['acctID '] = $selectActCode;
                $budgetArray['unit'] = $unit;
                $budgetArray['year'] = $year;
                $budgetArray['added_by'] = $_SESSION['id'];
                $budgetArray['month'] = $iselectMonth;
                $budgetArray['codeName '] = $this->generalmd->getsinglecolumn("codeName", "codeact", "codeid", $selectActCode);
                $budgetArray['codeNumber '] = $this->generalmd->getsinglecolumn("codeNumber", "codeact", "codeid", $selectActCode);

                $option = array(
                    'table' => 'unitaccountcode_budget_setup',
                    'data' => $budgetArray
                );

                $insertedFileId = $this->generalmd->create($option);


                if ($insertedFileId) {
                    $data = ["status" => 200];
                } else {
                    $data = ["status" => 400];
                }
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function accountcodecategory($id) {
        $checkAcess = $this->gen->check_menu_access($id);
        if ($checkAcess == true) {
            $title = "EXPENSE PRO :: ACCOUNT CODE CATEGORY";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);

            $allCategory = $this->generalmd->getdresult("*", "account_code_group", "", "");

            $values = ['title' => $title, "allCategory" => $allCategory, "checkAcess" => $checkAcess, 'menu' => $menu, 'sidebar' => $sidebar, 'footer' => $footer];
            $this->load->view('budget/account_code_category', $values);
        } else {
            return $this->load->view('noaccesstoview');
        }
    }

    public function postaccountcodecategory() {
        $data = [];

        if (isset($_POST['icategory'])) {

            $icategory = $this->input->post('icategory', TRUE);

            //update year budget with id to locked
            $budgetArray['group_name'] = $icategory;

            $option = array(
                'table' => 'account_code_group',
                'data' => $budgetArray
            );

            $insertedFileId = $this->generalmd->create($option);


            if ($insertedFileId) {
                $data = ["status" => 200];
            } else {
                $data = ["status" => 400];
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function viewbyaccountcode($year, $month, $unit) {
        $title = "EXPENSE PRO :: ITEM BUDGET BREAKDOWN";
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);

        $yearlyItemBudget = $this->generalmd->withthreevaluesresult("*", "unitaccountcode_budget_setup", "year", $year, "month", $month, "unit", $unit);
        $values = ['title' => $title, 'yearlyItemBudget' => $yearlyItemBudget, 'year' => $year, 'unit' => $unit, 'menu' => $menu, 'sidebar' => $sidebar, 'footer' => $footer];
        $this->load->view('budget/item_budget_settings_account_code', $values);
    }

    public function recievable() {

        $title = "EXPENSE PRO :: ITEM RECIEVABLE BUDGET BREAKDOWN";
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);

        $recivableBudget = $this->generalmd->getdresult("*", "recievable_budget_setup", "", "");

        $values = ['title' => $title, 'recivableBudget' => $recivableBudget, 'menu' => $menu, 'sidebar' => $sidebar, 'footer' => $footer];
        $this->load->view('budget/recievable_budget_settings', $values);
    }

    public function setup_recievable() {

        $data = [];

        if (isset($_POST['unit']) && isset($_POST['iamount'])) {

            $amount = $this->input->post('iamount', TRUE);
            $year = $this->input->post('iyear', TRUE);
            $unit = $this->input->post('unit', TRUE);
            $iselectMonth = $this->input->post('iselectMonth', TRUE);
            $iselectActCode = $this->input->post('iselectActCode', TRUE);



            if ($amount == "" || $unit == "" || $iselectActCode == "") {

                $data = ["status" => 300, "msg" => "Please fill out all fields"];
            } else {

                //update year budget with id to locked
                $budgetArray['amount'] = $amount;
                $budgetArray['unit'] = $unit;
                $budgetArray['year'] = $year;
                $budgetArray['added_by'] = $_SESSION['id'];
                $budgetArray['month'] = $iselectMonth;
                $budgetArray['codeNumber'] = $iselectActCode;

                $option = array(
                    'table' => 'recievable_budget_setup',
                    'data' => $budgetArray
                );

                $insertedFileId = $this->generalmd->create($option);


                if ($insertedFileId) {
                    $data = ["status" => 200];
                } else {
                    $data = ["status" => 400];
                }
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function edit_main_budget() {
        $data = [];

        if (isset($_POST['iamount']) && isset($_POST['id'])) {

            $amount = $this->input->post('iamount', TRUE);
            $id = $this->input->post('id', TRUE);

            if ($amount == "" || $id == "") {

                $data = ["status" => 300, "msg" => "Please fill out all fields"];
            } else {

                //update year budget with id to locked
                $budgetArray['amount'] = $amount;
                $option = array(
                    'table' => 'unitaccountcode_budget_setup',
                    'data' => $budgetArray
                );
                $saveDate = $this->generalmd->update("unitaccountcode_id", $id, $option);

                if ($saveDate) {
                    $data = ["status" => 200];
                } else {
                    $data = ["status" => 400];
                }
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    
    
     public function add_account_code($id = "") {

        if ($id == "") {
            echo "Important parameter to process page missing";
        } else {
            $title = "EXPENSE PRO :: ADD BUDGET BREAKDOWN";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);

            $getLevelApprove = $this->mainlocation->getapprovallevel($_SESSION['email']);

            $editItem = $this->generalmd->getdresult("*", "unitaccountcode_budget_setup", "unitaccountcode_id", $id);
            $breakdownItem = $this->generalmd->getdresult("*", "added_budget_reviewed", "unicode_id", $id);
             
            $values = ['title' => $title, 'breakdownItem' => $breakdownItem, 'id' => $id, 'getLevelApprove' => $getLevelApprove, 'editItem' => $editItem, 'menu' => $menu, 'sidebar' => $sidebar, 'footer' => $footer];
            $this->load->view('budget/add_budget_settings', $values);
        }
    }
    
    
    
      public function add_main_budget() {
        $data = [];

        if (isset($_POST['add_amount']) && isset($_POST['id'])) {

            $amount = $this->input->post('iamount', TRUE);
            $id = $this->input->post('id', TRUE);
            $add_amount = $this->input->post('add_amount', TRUE);
            $unit = $this->input->post('iunit', TRUE);
            $year = $this->input->post('year', TRUE);
            $month = $this->input->post('month', TRUE); 
            $codeNumber = $this->input->post('codeNumber', TRUE); 
            
            if ($add_amount == "") {

                $data = ["status" => 300, "msg" => "Please fill out all fields"];
            } else {

                //update year budget with id to locked
                $budgetArray['amount'] = $amount + $add_amount;
                $option = array(
                    'table' => 'unitaccountcode_budget_setup',
                    'data' => $budgetArray
                );
                $saveDate = $this->generalmd->update("unitaccountcode_id", $id, $option);
                
                
                ////////////////////////ADDED BUDGET EXPENSE ///////////////////////////////
                
                 //update year budget with id to locked
                $budgetArray['amount'] = $amount;
                $budgetArray['unit'] = $unit;
                $budgetArray['year'] = $year;
                $budgetArray['added_by'] = $_SESSION['id'];
                $budgetArray['month'] = $month;
                $budgetArray['codeNumber'] = $codeNumber;
                $budgetArray['added_amount'] = $add_amount;
                $budgetArray['total'] = $amount + $add_amount;
                $budgetArray['unicode_id'] = $id;
                $budgetArray['date_added'] = date('Y-m-d H:i:s');
                

                $option = array(
                    'table' => 'added_budget_reviewed',
                    'data' => $budgetArray
                );

                $insertedFileId = $this->generalmd->create($option);
                
                ////////////////////////END OF ADDED BUDGET EXPENSE ////////////////////////

                if ($saveDate) {
                    $data = ["status" => 200];
                } else {
                    $data = ["status" => 400];
                }
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    
    public function deletebudget(){
      $this->load->model('primary');
     $data = [];
      if (isset($_POST['deleteID'])) {
        $deleteID = $this->input->post('deleteID', TRUE);
        
        $delete = $this->primary->delete("unitaccountcode_id", $deleteID, "unitaccountcode_budget_setup");
        $data = ["status" => 200];
      }else{
        
         $data = ["status" => 400];
      }
        
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    
    

}

// End of The Till
