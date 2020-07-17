<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//require_once ('functions.php');
require_once (dirname(__FILE__) . "/Maincontroller.php");

class Userexpense extends CI_Controller {

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
        $title = "EXPENSE PRO :: EXPENSE BY YEAR";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        
        if($getApprovalLevel == 2){
        //get the Unit where user is
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        $getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
       $dYearonly = $this->cashiermodel->getamountbyunits($getmyUnit);
        
       $dYearpettycash = $this->cashiermodel->getbypettycash($getmyUnit);
         
       $dYearCheque = $this->cashiermodel->getbycheque($getmyUnit);
       
       $currencyType = $this->reportmodel->getbyohtercurrencies($getmyUnit);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'currencyType'=>$currencyType, 'dYearCheque'=>$dYearCheque, 'dYearpettycash'=>$dYearpettycash, 'getmyUnit'=> $getmyUnit, 'getApprovalLevel' => $getApprovalLevel, 'dYearonly' => $dYearonly, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('yearsummary/expensebyunits', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }

  
    public function getmoredetails($unitID, $year){
        
        $title = "EXPENSE PRO :: EXPENSE BY YEAR";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //get the Unit where user is
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        
        if($getApprovalLevel == 2 && $unitID == $getmyUnit){
            
        //$getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
        $dYearonly = $this->cashiermodel->getunityearbymonth($getmyUnit, $year);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'year'=>$year, 'getmyUnit'=> $getmyUnit, 'getApprovalLevel' => $getApprovalLevel, 'dYearonly' => $dYearonly, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('yearsummary/expensebyunitspermonths', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }
    
    
    
    public function getmoredetailsbytransact($unitID, $year, $month){
        
        $title = "EXPENSE PRO :: EXPENSE BY MONTH";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //get the Unit where user is
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        
        if($getApprovalLevel == 2 && $unitID == $getmyUnit){
            
        //$getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
        $getallResult = $this->cashiermodel->bymonthexpense($getmyUnit, $year, $month);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'year'=>$year, 'month' =>$month, 'getmyUnit'=> $getmyUnit, 'getApprovalLevel' => $getApprovalLevel, 'getallResult' => $getallResult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('yearsummary/expensemonthtransact', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }
    
    
    
    public function getmoredetailsbypetty($unitID, $year){
        
        $title = "EXPENSE PRO :: EXPENSE BY YEAR";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //get the Unit where user is
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        
        if($getApprovalLevel == 2 && $unitID == $getmyUnit){
            
        //$getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
        $dYearonly = $this->cashiermodel->getunityearbymonthbutpetty($getmyUnit, $year);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'year'=>$year, 'getmyUnit'=> $getmyUnit, 'getApprovalLevel' => $getApprovalLevel, 'dYearonly' => $dYearonly, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('yearsummary/expensebyunitspermonthspettycash', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }
    
    
    
    
     public function getmoredetailsbytransactbypetteyallone($unitID, $year, $month){
        
        $title = "EXPENSE PRO :: EXPENSE BY MONTH";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //get the Unit where user is
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        
        if($getApprovalLevel == 2 && $unitID == $getmyUnit){
            
        //$getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
        $getallResult = $this->cashiermodel->bymonthexpenseforpetty($getmyUnit, $year, $month);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'year'=>$year, 'month' =>$month, 'getmyUnit'=> $getmyUnit, 'getApprovalLevel' => $getApprovalLevel, 'getallResult' => $getallResult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('yearsummary/expensemonthtransact', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }
    
    
    
    
    public function getmoredetailsbycheque($unitID, $year){
        
        $title = "EXPENSE PRO :: EXPENSE BY YEAR";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //get the Unit where user is
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        
        if($getApprovalLevel == 2 && $unitID == $getmyUnit){
            
        //$getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
        $dYearonly = $this->cashiermodel->getunityearbymonthbutcheque($getmyUnit, $year);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'year'=>$year, 'getmyUnit'=> $getmyUnit, 'getApprovalLevel' => $getApprovalLevel, 'dYearonly' => $dYearonly, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('yearsummary/expensebyunitspermonthscheque', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }
    
   
    
    
     public function getmoredetailsbytransactbychequeonly($unitID, $year, $month){
        
        $title = "EXPENSE PRO :: EXPENSE BY MONTH";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //get the Unit where user is
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        
        if($getApprovalLevel == 2 && $unitID == $getmyUnit){
            
        //$getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
        $getallResult = $this->cashiermodel->bymonthexpenseforcheque($getmyUnit, $year, $month);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'year'=>$year, 'month' =>$month, 'getmyUnit'=> $getmyUnit, 'getApprovalLevel' => $getApprovalLevel, 'getallResult' => $getallResult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('yearsummary/expensemonthtransact', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }
 
    
    
   /*******************************************ICU ACCESS FOR THE YEAR ********************************************/
    
     public function icubudget() {
        $title = "EXPENSE PRO :: EXPENSE BY YEAR";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        
        if($getApprovalLevel == 3 || $getApprovalLevel == 6 || $getApprovalLevel == 6){
        //get the Unit where user is
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        $getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
        $dYearonly = $this->cashiermodel->getamountbyunits($getmyUnit);
        
        $dYearpettycash = $this->cashiermodel->getbypettycash($getmyUnit);
         
       $dYearCheque = $this->cashiermodel->getbycheque($getmyUnit);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'dYearCheque'=>$dYearCheque, 'dYearpettycash'=>$dYearpettycash, 'getmyUnit'=> $getmyUnit, 'getApprovalLevel' => $getApprovalLevel, 'dYearonly' => $dYearonly, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('yearsummary/expensebyunits', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }
   /******************************************END OFICU ACCESS FOR THE YEAR *******************************************/ 
    
    
      public function generalreportssearch($id) {
        $old = ini_set('memory_limit', '8192M');
        $this->load->model('primary');
        checklist();
        $title = "Expense Pro :: REPORT";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        
        $sessionID = $this->session->id;
        $getmenuAccess = $this->generalmd->getsinglecolumn("userid", "main_menu", "id", $id);
        $checkAccess = Maincontroller::haveAccess($sessionID, $getmenuAccess);
        
       // if ($getApprovalLevel == 3 || $getApprovalLevel == 6 || $getApprovalLevel == 5 || $getApprovalLevel == 7) {
        if($checkAccess == TRUE || $getApprovalLevel == 2){
             //$getallUsers = $this->cashiermodel->getmyuserfulldetals();
             $getallUnits = $this->mainlocation->getallunit();
             $getallAccountcode = $this->cashiermodel->getallaccountcodesforsummary();
             
             $dTotal = $this->cashiermodel->getallrequestfromunit();
             $dYearonly = $this->reportmodel->getamountbyyear();
             $otherCurrencies = $this->reportmodel->othercurrencies();
             
             
             ////////////////****************** GENERAL REPORTING *******************/////////////////////////////////
             $totalRequest = $this->allresult->allrequestindb("cash_newrequestdb", "id");
             $totalExpenseCode = $this->allresult->tcount("codeact", "codeid");
             $travelRequest = $this->allresult->tcountravel("cash_newrequestdb", "id");
             $fromProcurement  = $this->allresult->procurementR("cash_newrequestdb", "id");
             //////////////******************** END OF GENERAL REPORTING **************/////////////////////////////
                         
             
             ////////////******************** AGEING *************************///////////////////////////////////
            $thirtydays = $this->primary->countthirtydays();
            $thirtyonetosixty = $this->primary->countthirtyonetosixtydays();
            $sixtyonetoonetwenty = $this->primary->countsixtyonetoonetwenty();
            $abovesixmonth = $this->primary->countabovesixmonths();
            $twelvemonth = $this->primary->twelvemonths();
            ////////////******************** END OF AGEING *************************/////////////////////////////
            
            $petteycash = $this->allresult->tcountpetteycash("cash_newrequestdb", "id", "1");
             $chequerequestonly = $this->allresult->tcountcheque("cash_newrequestdb", "id", "2");
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            //'getallUsers'=>$getallUsers,
            $values = ['title' => $title, 'pc'=>$petteycash, 'ch'=>$chequerequestonly, 'thirtydays'=>$thirtydays, 'twelvemonth'=>$twelvemonth, 'abovesixmonth'=>$abovesixmonth, 'sixtyonetoonetwenty'=>$sixtyonetoonetwenty, 'thirtyonetosixty'=>$thirtyonetosixty, 'fromP'=>$fromProcurement, 'travelRequest'=>$travelRequest, 'allRequest'=>$totalRequest, 'cID'=>$totalExpenseCode, 'otherCurrency'=>$otherCurrencies, 'dYearonly'=>$dYearonly, 'dTotal'=>$dTotal, 'getallAccountcode'=>$getallAccountcode, 'getallUnits'=>$getallUnits,  'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('reports/generalreporting', $values);
        } else {
             $this->load->view('noaccesstoview');
        }
    }
    
    
    
    /*********************************MONTHS *****************************************/
     public function getmonthdetails($year){
        
        $title = "EXPENSE PRO :: EXPENSE BY YEAR";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        
        if($getApprovalLevel == 3 || $getApprovalLevel == 5 || $getApprovalLevel == 6 || $getApprovalLevel == 7 ){
            
        //$getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
        $dYearonly = $this->reportmodel->getunityearbymonth($year);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'year'=>$year, 'getApprovalLevel' => $getApprovalLevel, 'dYearonly' => $dYearonly, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('yearsummary/generalexpensebymonth', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }
    
   /**********************************EXPENSE BY MONTH PER UNIT *************************************************/
    
     public function gettransactformonthandyear($year, $month){
        
        $title = "EXPENSE PRO :: EXPENSE BY MONTH";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        
        if($getApprovalLevel == 3 || $getApprovalLevel == 5 || $getApprovalLevel == 6 || $getApprovalLevel == 7){
            
        //$getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
        $getallResult = $this->reportmodel->byunitmonthyear($year, $month);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'year'=>$year, 'month' =>$month, 'getApprovalLevel' => $getApprovalLevel, 'getallResult' => $getallResult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('yearsummary/expensebyunitmonth', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }
    
    public function getunpaidexpense($year, $month){
        
        $title = "EXPENSE PRO :: EXPENSE BY MONTH";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        
        if($getApprovalLevel == 3 || $getApprovalLevel == 5 || $getApprovalLevel == 6 || $getApprovalLevel == 7){
            
        //$getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
        $getallResult = $this->reportmodel->byunitunpaid($year, $month);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'year'=>$year, 'month' =>$month, 'getApprovalLevel' => $getApprovalLevel, 'getallResult' => $getallResult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('yearsummary/expenseunpaid', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }
    
    
     public function picktransactions($unitID, $year, $month){
        
        $title = "EXPENSE PRO :: EXPENSE BY MONTH";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //get the Unit where user is
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        
        if($getApprovalLevel == 3 || $getApprovalLevel == 5 || $getApprovalLevel == 6 || $getApprovalLevel == 7){
            
        //$getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
        $getallResult = $this->reportmodel->bytransactionforunits($unitID, $year, $month);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'year'=>$year, 'month' =>$month, 'unitID'=> $unitID, 'getApprovalLevel' => $getApprovalLevel, 'getallResult' => $getallResult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('yearsummary/transactionbyunits', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }
    
    
     public function pickunpaidtransactions($unitID, $year, $month){
        
        $title = "EXPENSE PRO :: EXPENSE BY MONTH";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //get the Unit where user is
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        
        if($getApprovalLevel == 3 || $getApprovalLevel == 5 || $getApprovalLevel == 6 || $getApprovalLevel == 7){
            
        //$getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
        $getallResult = $this->reportmodel->byunpaidtrans($unitID, $year, $month);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'year'=>$year, 'month' =>$month, 'unitID'=> $unitID, 'getApprovalLevel' => $getApprovalLevel, 'getallResult' => $getallResult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('yearsummary/transactionbyunits', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }
    
     public function currencytypeinsideyear($year){
        
        $title = "EXPENSE PRO :: EXPENSE BY MONTH";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        
        if($getApprovalLevel == 3 || $getApprovalLevel == 5 || $getApprovalLevel == 6 || $getApprovalLevel == 7){
            
        //$getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
        $getallResult = $this->reportmodel->getcurrencytypeforall($year);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'year'=>$year, 'getApprovalLevel' => $getApprovalLevel, 'getallResult' => $getallResult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('yearsummary/forcurrencytypes', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }
    
    
    
    public function currencyTransact($currency, $year){
        
        $title = "EXPENSE PRO :: EXPENSE BY MONTH";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //get the Unit where user is
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        
        if($getApprovalLevel == 3 || $getApprovalLevel == 5 || $getApprovalLevel == 6 || $getApprovalLevel == 7){
            
        //$getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
        $getallResult = $this->reportmodel->currencybytransact($currency, $year);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'year'=>$year,  'getApprovalLevel' => $getApprovalLevel, 'getallResult' => $getallResult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('yearsummary/transactionbycurrency', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }
    
    
    
     public function sortbymonthandcurrency($year){
        
        $title = "EXPENSE PRO :: EXPENSE BY YEAR";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        
        if($getApprovalLevel == 3 || $getApprovalLevel == 5 || $getApprovalLevel == 6 || $getApprovalLevel == 7 ){
            
        //$getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
        $dYearonly = $this->reportmodel->sortbymonthandcurrency($year);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'year'=>$year, 'getApprovalLevel' => $getApprovalLevel, 'dYearonly' => $dYearonly, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('yearsummary/yearsummary', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }
    
    
    
     public function obtaindetailsbymonthyearcurrency($year, $month, $currency){
        
        $title = "EXPENSE PRO :: EXPENSE BY MONTH";
        
        //$get approval Level
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //get the Unit where user is
        $getmyUnit = $this->cashiermodel->getdUnit($_SESSION['email']);
        
        if($getApprovalLevel == 3 || $getApprovalLevel == 5 || $getApprovalLevel == 6 || $getApprovalLevel == 7){
            
        //$getmyCountRequest = $this->cashiermodel->getallstaffamountspent($getmyUnit);
        
        $getallResult = $this->reportmodel->getcurrmonthyear($year, $month, $currency);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'year'=>$year,  'getApprovalLevel' => $getApprovalLevel, 'getallResult' => $getallResult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('yearsummary/transactionbycurrency', $values);
        }else{
           $this->load->view('noaccesstoview'); 
        }
    }
    
}

// End of Class Home
