<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');
class Home extends CI_Controller {

	/**
	 * Name : Ogiogio Victor
	 * Phone : 07038807891
	 */
    
    public function __construct() {
        parent::__construct(); 
		
		
        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle'=>$pageTitle];
        $this->load->view('header', $values);
	$this->gen->checkLogin();
      
    }   
    
    
	public function index()
	{
            $title = "MONEY BOOK Pro :: HOMEPAGE";
	
	
        //$get all Reesult 
	$getallresult = $this->mainlocation->getdetailsofrequestwithsession($_SESSION['email']);
		
	//Get Session Details
	$getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
         $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
         //Get second level approval ID
	 $getLevelApprove = $this->users->getSecondlevelapproval($_SESSION['id']);
         
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getLevelApprove'=>$getLevelApprove, 'getApprovalLevel'=>$getApprovalLevel, 'getSessionDetails'=>$getSessionDetails, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('home', $values);
			
	}
        
        
        public function newrequest(){
            
            $title = "Expense Pro :: NEW REQUEST";
            $menu = $this->load->view('menu', '', TRUE);
             $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('newrequestpettypro', $values);
        }
		
        
        
        public function myapproval(){
			
	$title = "Petty Cash :: MY APPROVAL";
	$getallresult = "";
            //$get all Reesult 
            //$getallresult = $this->mainlocation->getallresultfromnewrequest();
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
            
            if($getApprovalLevel == 6){ // This is HOD
                
                $getallresult = $this->mainlocation->getallresultfromnewrequest();
                
            }  else if($getApprovalLevel == 1){ // This is HOD
                
                $getallresult = $this->mainlocation->getmydetailsenttome($mySessionEmail);
                
            } else if($getApprovalLevel == 2){ // This is HOD
                
                $getallresult = $this->mainlocation->getmydetailsenttome($mySessionEmail);
                
            } else if($getApprovalLevel == 3){ // This is ICU
                
                $geticuID = $this->adminmodel->getuserID($mySessionEmail);
                //$getallresult = $this->mainlocation->geticuapproval($getApprovalLevel); //getallfromicutogetgoing
                $getallresultfromthisfirst = $this->mainlocation->getallfromicutogetgoing();
                
                if($getallresultfromthisfirst){
                    
                    foreach($getallresultfromthisfirst as $get){
                        $icus = $get->icus;
                    
                   $checkgroupfromresult = $this->mainlocation->icugroupdisplay($icus);
                   //var_dump($checkgroupfromresult);
                   
                   $kaboom = explode(",", $checkgroupfromresult);
                   
                    if(in_array($geticuID, $kaboom)){
                         
                         $getallresult = $this->mainlocation->icuusercanaccessit($icus);
                         //var_dump($getallresult);
                     }
                     
                   } // End of foreach($getallresultfromthisfirst as $get){
                    
                }
            }else if($getApprovalLevel == 4){ // This is Cashier
                
                $getallresult = $this->mainlocation->getaccoutpayment($mySessionEmail);
                
            }else if($getApprovalLevel == 5){ // This is Admin
                
                //$getallresult = $this->adminmodel->getadminonly();
                $getallresult = $this->mainlocation->getmydetailsenttome($mySessionEmail);
                
            }else if($getApprovalLevel == 7){ // This is accountant
                //Return the ID of the accoutant
                $getAccountID = $this->adminmodel->getuserID($mySessionEmail);
                
                //get all the groups accoutn from the datatbase
                $getallgroupdaccount = $this->mainlocation->getmainaccount();
                
                //var_dump($getallgroupdaccount);
                if($getallgroupdaccount){
                    foreach ($getallgroupdaccount as $get){
                          $dAccountgroup = $get->dAccountgroup;
                   
                   //Use the result to check if the userid is in the array
                    $checkcash_groupaccount = $this->mainlocation->cashgroup($dAccountgroup);
                    
                    $kaboom = explode(",", $checkcash_groupaccount);
                    
                     if(in_array($getAccountID, $kaboom)){
                         
                         $getallresult = $this->mainlocation->getaccountresult($dAccountgroup);
                         //var_dump($getallresult);
                     }
                }
                
             }
            }else {
                $getallresult = "";
            }
             
			
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('myapprovalawaiting', $values);
		
        }
	
        public function requestforpayment(){
            $title = "Petty Cash Pro :: CHEQUE SIGNING AND FINAL APPROVAL";
	$getallresult = "";
            //$get all Reesult 
            //$getallresult = $this->mainlocation->getallresultfromnewrequest();
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
            $getUserids = $this->adminmodel->getuserID($_SESSION['email']);
            if($getApprovalLevel == 8 || $getApprovalLevel == 6 || $getApprovalLevel == 7 || $getApprovalLevel == 5){ // This is HOD
                
                //$getUserid = $this->mainlocation->cashgroup($dAccountgroup);
                
                $getallresults = $this->mainlocation->getallchequeforsignature();
                if($getallresults){
                    foreach ($getallresults as $get){
                        $accountGroup = $get->accountGroup;
                        
                        $getUserid = $this->mainlocation->cashgroup($accountGroup);
                        $nums = explode(',', $getUserid);
                         if(in_array($getUserids, $nums)){
                              $getallresult = $this->mainlocation->getallresultwithingroup($accountGroup);
                         }else if(!in_array($getUserids, $nums) && $getApprovalLevel == 6  || $getApprovalLevel == 5){
                             $getallresult = $this->mainlocation->getallchequeforsignature();
                         }
                         
                         
                    }
                    
                }
                
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('chequerequestapproval', $values);
            }else{
                //redirect(base_url());
                echo "You don't have permission to view this page.";
            }
        }
       
        
        public function approvedbymeicu(){
            
            
            $title = "Petty Cash :: MY APPROVAL";
            $getallresult = "";
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            
            if($getApprovalLevel == 3){
                
            $getallresult = $this->mainlocation->getallicurequestandapprovedbyme($mySessionEmail);
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('myapprovedrequestbyicu', $values);
            }else{
                redirect(base_url());
            }
        }
        
        
        
           public function allicurequest(){
            
            
            $title = "Petty Cash :: ALL ICU REQUEST";
            $getallresult = "";
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            
            if($getApprovalLevel == 3){
                
            $getallresult = $this->mainlocation->getallicurequestawaitingorapproved();
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('icuthisallrequest', $values);
            }else{
                redirect(base_url());
            }
        }
        
        
        
	public function mysuperaccount(){
			
	$title = "Petty Cash Pro :: MY APPROVAL";
			
            //$get all Reesult 
            //$getallresult = $this->mainlocation->getallresultfromnewrequest();
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
             if($getApprovalLevel == 8 || $getApprovalLevel == 6 || $getApprovalLevel == 5){
            
            $getResult = $this->mainlocation->getallgroups();
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getResult'=>$getResult, 'getApprovalLevel'=>$getApprovalLevel, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('superaccounting', $values);
            
             }else{
                 redirect(base_url());
             }
		
        }
        
        public function cashiertill(){
			
	$title = "Expense Pro :: MY APPROVAL";
			
            //$get all Reesult 
            //$getallresult = $this->mainlocation->getallresultfromnewrequest();
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
            if($getApprovalLevel == 8 || $getApprovalLevel == 6){	
                
            $gettillrequest = $this->adminmodel->getapprovedcheques();
            //$gettillrequest = $this->adminmodel->getapprovedcheques($mySessionEmail); //For future reference
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'gettillrequest'=>$gettillrequest, 'getApprovalLevel'=>$getApprovalLevel, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('cashiertilling', $values);
            
            }else{
                redirect(base_url());
            }
		
        }
        
        
         public function cashierlimit(){
			
	$title = "Expense Pro :: MY APPROVAL";
			
            //$get all Reesult 
            //$getallresult = $this->mainlocation->getallresultfromnewrequest();
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
            if($getApprovalLevel == 8 || $getApprovalLevel == 6 || $getApprovalLevel == 5){	
                
            $gettillrequest = $this->adminmodel->getcashierlimit();
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'gettillrequest'=>$gettillrequest, 'getApprovalLevel'=>$getApprovalLevel, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('cashierslimit', $values);
            
            }else{
                redirect(base_url());
            }
		
        }
        
        
        public function allcashiers(){
            $getprops = $this->adminmodel->getallcashiers();
	
                if(empty($getprops)){
                        $data = [];
                }// End of if
                else{
                   foreach($getprops as $get){
                      $id = $get->id;
                      $email = $get->email;
                      $fname = $get->fname;
                      $lname = $get->lname;

                        $data[] = ['id'=>$id, 'email'=>$email, 'fname'=>$fname, 'lname'=>$lname];
                        }
                }// End of Else
                $json = ['ci' => $data];
        
             $this->output->set_content_type('application/json')->set_output(json_encode($json));
        }
        
        
	public function approvaldetails($id){
            
            
           // if(!$id){
            // redirect(base_url());   
           // }else{
            $title = "Petty Cash Pro :: APPROVAL DETAILS";
          
            //$get all Reesult 
            $getallresult = $this->mainlocation->getdexactresultfromdb($id);
            if($getallresult != FALSE){
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('myapprovaldetails', $values);
            }else{
                echo "<h3>No such item exist in our Record</h3>";
            }
            
           // }
			
        }
        
       public function report(){
          
           $title = "Expense Pro :: REPORT";
	 $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
	if($getApprovalLevel == 4 || $getApprovalLevel == 6 || $getApprovalLevel == 5 || $getApprovalLevel == 7 || $getApprovalLevel == 8 ){
        //$get all Reesult 
	$getallresult = $this->mainlocation->getdetailsofrequestwithsession($_SESSION['email']);
			
	//Get Session Details
	$getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
         
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getSessionDetails'=>$getSessionDetails, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('report', $values);
        }else{
            redirect(base_url());
        }
       }
       
    
       
   /////////////////////////BEGINNING OF MY TILL ///////////////////////////////////////
     public function mytill(){
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            if($getApprovalLevel == 4 ){
            
        
            $title = "Expense Pro :: MY TILL";
            
            $getResult = $this->mainlocation->getnewrequestbycashier($_SESSION['email']);
            //var_dump($getResult);
            $sendTillName = $this->mainlocation->getdTillname($_SESSION['email']);
            
            $menu = $this->load->view('menu', '', TRUE);
             $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sendTillName'=>$sendTillName, 'getResult'=> $getResult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('cashierstill', $values);
            
            }else{
                redirect(base_url());
            }
        }
       
     
    public function addcashierLimit(){
        $sessionEmail = $_SESSION["email"];
        $data = [];
		if(isset($_POST['chooseCashier']) && isset($_POST['cashierLimit']) && isset($_POST['tillName']) ){
			
		// Declaring put putting all variables in Values
		$chooseCashier = $this->input->post('chooseCashier', TRUE);
                $cashierLimit = $this->input->post('cashierLimit', TRUE);
                $tillType = $this->input->post('tillType', TRUE);
                $tillName = $this->input->post('tillName', TRUE);
		$tillName = str_replace(' ', '', $tillName); 
                //Check if cashier is already in the database
                $checkCahsier = $this->adminmodel->checkCashier($chooseCashier, $tillType);
                
                //Use casier ID to return Email
                $getCashierEmail = $this->adminmodel->getCashierEmail($chooseCashier);
                
                //var_dump($checkCahsier);
		if($chooseCashier == "" || $cashierLimit == "" || $tillName == ""  ){
                    $data = ['errmsg'=> 'Please enter a Cashier and add Limit'];  // Please make sure asset Name , Cost and Date purchased is not empty
		} else 
                    if($checkCahsier ==  TRUE && $tillType == 'primary'){
                    
                    $data = ['errmsg'=> 'Cashier is already has a primary till'];
                }else 
                    if($checkCahsier ==  TRUE && $tillType == 'secondary'){
                    
                    $data = ['errmsg'=> 'Cashier is already has a secondary till'];
                }
                else{
                    
                       $addRand = random_string('alnum', '6');
                       $newtillName = $tillName.'_'.$addRand;
			// Insert into the Database;  $aCost, $fassetID, $refNo, $sessionID
			$addCasheir = $this->adminmodel->addCashier($newtillName, $chooseCashier, $getCashierEmail, $cashierLimit, $sessionEmail, $tillType);
				
			$data = ['msg'=> 'Cashier Successfully Added']; // 'Asset is now Schedule for Maintenance.'
			
			}  // End of Else { 
		
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }    
    
    
   public function paymentdetails(){ 
        $title = "Petty Cash Pro :: Account Details";
         $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         if($getApprovalLevel == 7 || $getApprovalLevel == 8 ){
         
         $getallresult = $this->adminmodel->getallpaymentdetail($_SESSION['email']);
         
         $menu = $this->load->view('menu', '', TRUE);
         $sidebar = $this->load->view('sidebar', '', TRUE);
         $footer = $this->load->view('footer', '', TRUE);
         $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
         $this->load->view('paymentdetails', $values);
         
         
        }else{
            redirect(base_url());
        }
   }   
   
   
   
   public function cashiersallUsers(){
			
	$title = "Expense Pro :: MY APPROVAL";
			
            //$get all Reesult 
            //$getallresult = $this->mainlocation->getallresultfromnewrequest();
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
             if($getApprovalLevel == 8 || $getApprovalLevel == 6){	
                 
            $getallResult = $this->adminmodel->getallcashiers();
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getallResult'=>$getallResult, 'getApprovalLevel'=>$getApprovalLevel, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('allcashiersuser', $values);
            
             }else{
                 redirect(base_url());
             }
		
        }
        
        
        
  
    public function dviewcashierstransaction($email){
			
	$title = "Petty Cash Pro :: MY APPROVAL";
			
            //$get all Reesult 
            //$getallresult = $this->mainlocation->getallresultfromnewrequest();
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
             if($getApprovalLevel == 8 || $getApprovalLevel == 6 || $getApprovalLevel == 5){	
                 
            $getallResult = $this->mainlocation->dcashiersdetailsfromsuperaccount($email);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getallResult'=>$getallResult, 'getApprovalLevel'=>$getApprovalLevel, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('allviewalltransaction', $values);
            
             }else{
                 redirect(base_url());
             }
		
        }
        
        
        
   public function getalltheaccountantingrou($ids){
      
       		
            $title = "Petty Cash Pro :: MY APPROVAL";
			
            //$get all Reesult 
            //$getallresult = $this->mainlocation->getallresultfromnewrequest();
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
             if($getApprovalLevel == 8 || $getApprovalLevel == 6 || $getApprovalLevel == 5){
            
               $urlids = $ids;
            // $ids = explode(",", $ids);
            //Get the IDs and 
        /*    foreach($ids as $key => $value) {
                
               $allSelected[] = $value;
               
            $getusersingroup = $this->adminmodel->getuseridprocess($value);
          
            }
          */  
            $getResult = $this->mainlocation->getallgroups();
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'urlids'=>$urlids, 'getApprovalLevel'=>$getApprovalLevel, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('allaccountatndetails', $values);
            
             }else{
                 redirect(base_url());
             }
   }
   
   
   public function forsuperaccountanteditcashier($id){
              $title = "Expense Pro :: MY APPROVAL";
			
            //$get all Reesult 
            //$getallresult = $this->mainlocation->getallresultfromnewrequest();
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
            if($getApprovalLevel == 8 || $getApprovalLevel == 6){	
                
            $gettillrequest = $this->adminmodel->getresultofcashiers($id);
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'gettillrequest'=>$gettillrequest, 'getApprovalLevel'=>$getApprovalLevel, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('cashiertilldetails', $values);
            
            }else{
                redirect(base_url());
            } 
   }
   
   
  ////////////////////////////////////////////////MY SECONDARY TILL ///////////////////////////////////////////////////////////////////
   
    /////////////////////////BEGINNING OF MY TILL ///////////////////////////////////////
     public function secondarytill(){
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            if($getApprovalLevel == 4 ){
            
        
            $title = "Petty Cash Pro :: SECONDARY TILL";
            
            $getResult = $this->mainlocation->getnewrequestbycashiersecondary($_SESSION['email']);
            
            $sendTillName = $this->mainlocation->getdTillnameforsecondary($_SESSION['email']);
            
            $menu = $this->load->view('menu', '', TRUE);
             $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sendTillName'=>$sendTillName, 'getResult'=> $getResult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('secondarycashierstill', $values);
            
            }else{
                redirect(base_url());
            }
        }
   
   
 ///////////////////////////////////////////////// END OF SCEONDARY TILL ///////////////////////////////////////////////
 
 
        public function viewmyrequest($id){
            $getallresult = $this->mainlocation->getdexactresultfromdb($id);
            $getEmail = $this->adminmodel->maderequestbyme($id);
           if($getallresult == "" || $getallresult == FALSE || $getEmail !== $_SESSION['email']){
               redirect(base_url());
           }else{
            $title = "Petty Cash Pro - View Details :: HOMEPAGE";
	
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            
            $useidtogetname = $this->mainlocation->descriptionofitem($id);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel,  'useidtogetname'=>$useidtogetname, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('viewrequestdetails', $values);
           }
        }
        
        
         public function editejectedrequest($id){
             $getallresult = $this->mainlocation->getdexactresultfromdb($id);
             $getEmail = $this->adminmodel->maderequestbyme($id);
           if($getallresult == "" || $getallresult == FALSE || $getEmail !== $_SESSION['email']){
               redirect(base_url());
           }else{
            $title = "Petty Cash Pro - Edit Details :: HOMEPAGE";
	
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
           
            $useidtogetname = $this->mainlocation->descriptionofitem($id);
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel,  'useidtogetname'=>$useidtogetname, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('editrejectedrequestfinal', $values);
           }
        }
        
   
     
       public function hodapprovalrequest()
	{
            $title = "Expense Pro :: HOMEPAGE";
	
	
        //$get all Reesult 
	$getallresult = $this->mainlocation->approvedrequestbyhod($_SESSION['email']);
	
         $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
          if($getApprovalLevel == 2 || $getApprovalLevel == 5  || $getApprovalLevel == 6){
         
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('allhodrequest', $values);
          }else{
              redirect(base_url());
          }
			
	}    
        
        
        
         public function myexpensesprimarytill()
	{
            
             $title = "Petty Cash Pro:: My Primary Till Expenses";
        //$get all Reesult 
            $getallresult = $this->mainlocation->getallrequestfrommyprimaytill($_SESSION['email']);
            
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            if($getApprovalLevel == 4){
         
           
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('myexpensesprimarytill', $values);
            }else{
                redirect(base_url());
            }
			
	}    
        
        
        
         public function myexpensessecondarytill()
	{
            $title = "Expense Pro :: HOMEPAGE";
	
	
        //$get all Reesult 
            $getallresult = $this->mainlocation->getallrequestfrommysecondarytill($_SESSION['email']);
            
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            if($getApprovalLevel == 4){
         
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('myexpensesprimarytill', $values);
            }else{
                redirect(base_url());
            }
			
	}    
        
  
    public function printoutcheques(){
        $title = "Petty Cash :: MY APPROVAL";
	$getallresult = "";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            if($getApprovalLevel == 4 || $getApprovalLevel == 6 || $getApprovalLevel == 7 || $getApprovalLevel == 8){
            
                if($getApprovalLevel == 4 ||  $getApprovalLevel == 7){
                $getallresult = $this->mainlocation->thecashierwhoapprove($_SESSION['email']);
                }else if($getApprovalLevel == 8 ||  $getApprovalLevel == 6){
                    $getallresult = $this->mainlocation->thecashierwhoapprovebyadmin();
                }else{
                    $getallresult = "";
                }
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('readyforprinting', $values);
        }else{
            redirect(base_url());
        }
    }    
        
   
    
    public function allcheques()
	{
            $title = "Petty Cash Pro :: ALL CHEQUES";
	
	
            //$get all Reesult 
            $getallresult = $this->mainlocation->getallcheques();
            //Get Session Details
            $getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
             $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
             if($getApprovalLevel == 7 ||  $getApprovalLevel == 6 || $getApprovalLevel == 8){
         
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getSessionDetails'=>$getSessionDetails, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('allchequesrequest', $values);
             }
			
	}
        
        
        
  public function generatebankstatement(){
      
            $title = "MONEY BOOK PRO :: BANK STATEMENT";
	
            //Get Session Details
            $getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
             $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
            if($getApprovalLevel == 7 ||  $getApprovalLevel == 6 || $getApprovalLevel == 8){
         
                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getSessionDetails'=>$getSessionDetails, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
                $this->load->view('generateBankstatement', $values);
             }else{
                 echo "You do not have permission to view this page";
             }
  }      
  
  
  
   public function getthebanksyouwanttoprint($dbanknumber){
      
            $title = "MONEY BOOK PRO :: BANK STATEMENT";
	
             //$get all Reesult 
            $getallresult = $this->mainlocation->getallchequeswithzeroapproval($dbanknumber, $_SESSION['email']);
            //Get Session Details
            $getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
             $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
            if($getApprovalLevel == 7 ||  $getApprovalLevel == 6 || $getApprovalLevel == 8){
                
               
                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getallresult'=>$getallresult, 'getSessionDetails'=>$getSessionDetails, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
                $this->load->view('dchequesuwanttoprint.php', $values);
             }else{
                 echo "You do not have permission to view this page";
             }
  }      
  
  
   public function getStatementresulet($generateStatement){
      
            $title = "MONEY BOOK PRO :: BANK STATEMENT";
		
            //$get all Reesult 
            $getallresult = $this->mainlocation->getallchequeswithzeroapproval($generateStatement, $_SESSION['email']);
            
            //Get Session Details
            $getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
             $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
            if($getApprovalLevel == 7 ||  $getApprovalLevel == 6 || $getApprovalLevel == 8){
         
                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getSessionDetails'=>$getSessionDetails, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
                $this->load->view('generateStatementforBank', $values);
             }else{
                 echo "You do not have permission to view this page";
             }
  }      
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function myrequest(){
       
       	
            $title = "Petty Cash Pro :: MY APPROVAL";
			
            //$get all Reesult 
            //$getallresult = $this->mainlocation->getallresultfromnewrequest();
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
        if($getApprovalLevel == 4){
        
        //$getallresult = $this->mainlocation->getallrequeastforreimbursement($mySessionEmail);
        $getallresult = $this->mainlocation->getchequerequestbycashier($mySessionEmail);
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
        $this->load->view('pendingmyreimbursement', $values);
          
        
        }else{
                 
            redirect(base_url());
       }
   }
   
   
   
    public function viewmyrequestforeimbursement($id){
       
       	
            $title = "Money Book Pro :: MY CASH REIMBURSEMENT";
			
            //$get all Reesult 
            //$getallresult = $this->mainlocation->getallresultfromnewrequest();
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            //$gethodrequestonly = $this->mainlocation->gethodmyrequest($_SESSION['email']);
        if($getApprovalLevel == 4 || $getApprovalLevel == 7 || $getApprovalLevel == 8 || $getApprovalLevel == 6){
        
        //$getallresult = $this->mainlocation->getallrequeastforreimbursement($mySessionEmail);
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'ids'=>$id, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
        $this->load->view('pendingmyreimbursementviewrequest', $values);
          
        
        }else{
                 
            redirect(base_url());
       }
   }
   
   
   
     public function sendtoaccountbycashier($id){
       
       	
            $title = "Money Book Pro :: MY CASH REIMBURSEMENT";
			
            //$get all Reesult 
            //$getallresult = $this->mainlocation->getallresultfromnewrequest();
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
          
        if($getApprovalLevel == 4){
        
        $getallresult = $this->mainlocation->getidresultfromchequedb($id);
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getallresult'=>$getallresult, 'getApprovalLevel'=>$getApprovalLevel, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
        $this->load->view('sendchequetoaccount', $values);
          
        
        }else{
                 
            redirect(base_url());
       }
   }
   
   
   
   public function allgeneratebankstatement(){
       
         $title = "MONEY BOOK PRO :: ALL BANK STATEMENT";
	
            //Get Session Details
            $getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
             $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
            if($getApprovalLevel == 7 ||  $getApprovalLevel == 6 || $getApprovalLevel == 8){
                
               
             //$get all Reesult 
            $getallresult = $this->mainlocation->getallcheques();
            
                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getallresult'=>$getallresult, 'getSessionDetails'=>$getSessionDetails, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
                $this->load->view('bankstatementall', $values);
             }else{
                 echo "You do not have permission to view this page";
             }
   }
    
   
  public function preparenewcheque($id, $approval, $group){
      $title = "MONEY BOOK PRO :: CHEQUE PREPARATION";
       //Get Session Details
            $getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
             $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
             
	  //var_dump($getChequeresult);
            if($getApprovalLevel == 7 ||  $getApprovalLevel == 6 || $getApprovalLevel == 8){
         
           
             //Get result from the database
             $getChequeresult = $this->mainlocation->getdetailsofcheque($id, $approval, $group);
             if($getChequeresult){
                 foreach($getChequeresult as $get){
                     $newid = $get->id;
                     $approval = $get->approvals;
                     $dAmount = $get->dAmount;
                     $dAccountgroup = $get->dAccountgroup;
                 }
                    if($approval == 3){
                        $menu = $this->load->view('menu', '', TRUE);
                        $sidebar = $this->load->view('sidebar', '', TRUE);
                        $footer = $this->load->view('footer', '', TRUE);
                        $values = ['title' => $title, 'getChequeresult'=>$getChequeresult, 'getApprovalLevel'=>$getApprovalLevel, 'getSessionDetails'=>$getSessionDetails, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
                        $this->load->view('preparechequeforsigning.php', $values);
                      }else{
                          echo "Please wait for other approvals to be completed";
                      }
                }else{
                    echo "You can't change the url, Please see the administrator";
                }
                
             }else{
                 echo "You do not have permission to view this page";
             }
  } 
  
  
  
  
  public function confirmchequerequestnownow (){
     
     $data = [];
     if(isset($_POST['chequeID'])){
         
        $chequeDate = $this->input->post('chequeDate', TRUE);
        $payee = $this->input->post('payee', TRUE);
        $mainAount = $this->input->post('mainAount', TRUE);
        $partAmount = $this->input->post('partAmount', TRUE) ? $this->input->post('partAmount', TRUE) : "";
        $getBank = $this->input->post('getBank', TRUE);
        $chequeNo = $this->input->post('chequeNo', TRUE);
        $chequeID = $this->input->post('chequeID', TRUE);
        
        $vatcharge = $this->input->post('vatcharge', TRUE);
        $witholdingtax = $this->input->post('witholdingtax', TRUE);
        $witholdtax = "";
        
         if($chequeDate == "" || $getBank == "" || $chequeNo == "" || $chequeNo == "" || $chequeID == ""){
           $data = ['warr'=>'Please make sure all fields are field<br/>'];  
         }else
         
         if($partAmount > $mainAount){
            $data = ['warr'=>'Part Payment cannot be greater than amount<br/>'];    
         }else{
         
         //Use the AssetID to get the Amount
         $getpaymentAmount = $this->adminmodel->getpaymentamount($chequeID);
         
          // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod)
         //approve = 3(approved by ICu), approve = 4 (Cheque Ready for Collection) , approve = 5(Rejected)
         // approve == 7 (Cheque sent for signature)
         $approve = '7';
         $sessionID = $_SESSION['email'];
         $getSessEmail = $this->mainlocation->getuserSessionEmail($sessionID);
             if($getSessEmail){
                foreach($getSessEmail as $get){
                     $uid = $get->id;
                     $fname = $get->fname;
                     $lname = $get->lname;
                     $fullname = $fname.' '.$lname;
                }
            }
          $type = "cheque";                                    //($assetID, $paidTo, $dDate, $sessionID, $uid, $tillID, $tillType, $cashierEmail);
         $makedpaymebnt = $this->mainlocation->chequesentforpayment($chequeID, $payee, $chequeDate, $sessionID, $uid, $chequeNo, $type, $getBank);
         
         
         //This is for summary report and i will like to have an idea of what it does
         $updateothernewrequestable = $this->mainlocation->updateothertable($chequeID, $chequeDate, $sessionID);
         //Use the Request ID to Update the Table
         $updatrequestTable = $this->mainlocation->daccountwhopays($chequeID, $sessionID, $approve, $partAmount, $chequeDate);
         
          //Use the asset ID to return the Email of the Person that sends the request
         $getEmailofOwner = $this->mainlocation->emailownerrequest($chequeID);
         
         //The Description of Item
         $getDescription = $this->mainlocation->descriptionofitem($chequeID);
         
         
         ///////////////////BEGINNING INSTALLING INTO SUPER ACCOUNTANT ////////////////////////////////
          $myurl = mycustom_url();
          $appID = "01"; // 01 === PETTY CASH  02 == MAINTENANCE
          $getUserLocation = $this->users->getLocationEmail($_SESSION['email']);
          $getUserUnit = $this->users->getUnit($_SESSION['email']);
          $dUserID = $this->adminmodel->getuserID($_SESSION['email']);
          $approval = "0";
          $getTillName = ""; 
          
          if($vatcharge !== ""){
              
              $getvatpercent = $this->allresult->getvatpercent($vatcharge);
              //Calculate the VAT by multiplying with the amount
              $vatAmount = $mainAount * $getvatpercent;
          }
          
          if($witholdingtax !== ""){
              $getwitholdtax = $this->allresult->getwitholdtax($witholdingtax);
              $witholdtax = $mainAount * $getwitholdtax;
          }
          
          $addTotal = $this->adminmodel->sendtosuperaccount($getTillName, $myurl, $getUserLocation, $getUserUnit, $appID, $chequeID, $makedpaymebnt, $dUserID, $getpaymentAmount, $partAmount, $approval, $_SESSION['email'], $chequeNo, $type, $getBank, $payee, $sessionID, "", $vatAmount, $witholdtax);
          
          //Add tax levies
          $addLevies = $this->allresult->addgovtlevies($addTotal, $mainAount, $vatcharge, $witholdingtax, $sessionID);
         
           //$partialPayAmount = $partAmount != "" ? $partAmount : "";
          //Part Payment Begins Here
           if($partAmount != ""){
            $partialPayAmount =  $partAmount;
            $doPartpayment = $this->mainlocation->dopartpayment($chequeID, $partialPayAmount, $dUserID, $getBank, $chequeNo, $sessionID);
           }else{
               $doPartpayment = "";
           }
                
         //////////////////END OF INSTALLING INTO SUPER ACCOUNTANT ///////////////////////////////////
          
             ////////////////***************DO WORK FOR ASSET MGT *************************////////////////////////////
         //Return the from_app_id NOTE: Asset Mgt is "2"
          $fromAssetmgt = $this->adminmodel->myuniqueappid($chequeID);
           //Return the request id to update the maintenance table
          $returnupdateIDforacccest = $this->adminmodel->assetrequestid($chequeID);
         if($fromAssetmgt == 2){
             $assetsessionID = $this->session->id;
             $assetsessionEmail = $this->session->email;
             $hComment = "approved by ". $assetsessionEmail;
             $Assetapproval = '10';
             $assetResult =  $this->adminmodel->runassetmaintenance($returnupdateIDforacccest, $Assetapproval, $assetsessionID, $hComment);
         }
         ////////////////***************END OF DO WORK FOR ASSET MGT *************************////////////////////////////
         
         
         if($makedpaymebnt && $updatrequestTable){
             $data = ['msg'=>'Cheque Successfully successfully prepared for signature<br/>'];
         }
         
        }
     }
     $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
   
 
 public function allpartpayments(){
     
      $title = "MONEY BOOK PRO :: CHEQUE PART PAYMENT";
       //Get Session Details
       $getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
       $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
        $sessionID = $_SESSION['email'];
	  //var_dump($getChequeresult);
       if($getApprovalLevel == 7 ||  $getApprovalLevel == 6 || $getApprovalLevel == 8){
           
            if($getApprovalLevel == 7){
             $getallPartpayment = $this->mainlocation->allpartpay($sessionID);
            }else if($getApprovalLevel == 6 || $getApprovalLevel == 8){
              $getallPartpayment = $this->mainlocation->allpartpayforadmin();  
            }else{
                $getallPartpayment = "";
            }
           
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getallPartpayment'=>$getallPartpayment, 'getApprovalLevel'=>$getApprovalLevel, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
            $this->load->view('dpartpaymentsforaccounts', $values);
            }else{
                //redirect(base_url());
                echo "You don't have permission to view this page.";
            }
 }
 
 
 public function completepay($id, $amount, $email){
     
       $title = "MONEY BOOK PRO :: CHEQUE PREPARATION";
       //Get Session Details
            $getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
             $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
             
	  //var_dump($getChequeresult);
            if($getApprovalLevel == 7 ||  $getApprovalLevel == 6 || $getApprovalLevel == 8){
         
           
             //Get result from the database
             $getChequeresult = $this->mainlocation->getpartpaydetails($id, $amount, $email);
             if($getChequeresult){
              $menu = $this->load->view('menu', '', TRUE);
              $sidebar = $this->load->view('sidebar', '', TRUE);
              $footer = $this->load->view('footer', '', TRUE);
              $values = ['title' => $title, 'getChequeresult'=>$getChequeresult, 'getApprovalLevel'=>$getApprovalLevel, 'getSessionDetails'=>$getSessionDetails, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
              $this->load->view('completehalfpayment', $values);
             }else{
                 echo "No result found in our records";
             }
                  
                
             }else{
                 echo "You do not have permission to view this page";
             }
 }
 
 
 public function dblancetopay(){
      $data = [];
     if(isset($_POST['formIDforpartpay']) && isset($_POST['newAmountopay'])){
         
        $newAmountopay = $this->input->post('newAmountopay', TRUE);
        $formIDforpartpay = $this->input->post('formIDforpartpay', TRUE);
        $paypaybalance = $this->input->post('paypaybalance', TRUE);
        $aAmount = $this->input->post('aAmount', TRUE);
        $userID = $this->input->post('userID', TRUE);
        $appurL = $this->input->post('appurL', TRUE);
        $newChequeNo = $this->input->post('newChequeNo', TRUE);
        $newBank = $this->input->post('newBank', TRUE);
        $balancepay = $this->input->post('balancepay', TRUE);
        
        //Use the id to return the amount, partpay, dCashierwhopay, approvals
        $getDetails = $this->mainlocation->getdexactresultfromdb($formIDforpartpay);
        if($getDetails){
            foreach($getDetails as $get){
                $dAmount = $get->dAmount;
                $partPay = $get->partPay;
                $approvals = $get->approvals;
                $dCashierwhopaid = $get->dCashierwhopaid;
                
                 //Do programming login, continues
                $newBalance = $partPay + $newAmountopay;
                $dUserID = $this->adminmodel->getuserID($_SESSION['email']);
            }
            
            if($newAmountopay > $partPay){
                $data = ['warr'=>'You cannot post amount greater than than the balance<br/>'];
            }else if ($paypaybalance !== $partPay){
                //Do programming login, continues
                 $data = ['warr'=>'You need to see the administrator, Balances do not agree in our database<br/>'];
            }else if($newBalance > $dAmount){
                $data = ['warr'=>'You cannot post that amount please check your balance.<br/>'];
            }else{
               $sessionEmail = $_SESSION['email'];
                //Use the New balance to update various tables new_request{{MAIN TABLE}}
                $updatenewrequest = $this->mainlocation->newrequestpaytable($formIDforpartpay, $newBalance, $dUserID, $appurL, $newBank, $newChequeNo, $sessionEmail, $newAmountopay);
                
                //uSE THE SAME VALUES TO UPDATE account_payable table in a transaction SQL
                
                //Now use the Same table to inser values into partpayment table and complete the transaction SQL
                if($updatenewrequest !== FALSE){
                    $data = ['msg'=>'Payment Successfully Made, Please wait...<br/>'];
                }
               
            }
        }
         
     }
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
 }
 
 
 public function viewreqeuestdetails($id, $approval){
      $title = "MONEY BOOK PRO :: CHEQUE PREPARATION";
      
      //Get Session Details
      $getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
      $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
      
     if($getApprovalLevel == 5 || $getApprovalLevel == 3 || $getApprovalLevel == 4 || $getApprovalLevel == 7 || $getApprovalLevel == 2 || $getApprovalLevel == 1 ||  $getApprovalLevel == 6 || $getApprovalLevel == 8){
         
            $getChequeresult = $this->mainlocation->getnewreaultforallview($id, $approval);
            
             if($getChequeresult){
              $menu = $this->load->view('menu', '', TRUE);
              $sidebar = $this->load->view('sidebar', '', TRUE);
              $footer = $this->load->view('footer', '', TRUE);
              $values = ['title' => $title, 'getChequeresult'=>$getChequeresult, 'getApprovalLevel'=>$getApprovalLevel, 'getSessionDetails'=>$getSessionDetails, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
              $this->load->view('viewalldetails', $values);
             }else{
                 echo "No result found in our records";
             }
     } else{
         echo "You do not have permission to view this page";
     }
 }
 
 
 
    public function govementlevies(){
        echo "Page Coming Soon";
    }
 
    
     public function csvUploadingnow() {

        $data = [];

        //validate whether uploaded file is a csv file
        $checkCsvType = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

        //Checks to see if the file is set and uploaded
        if (!empty($_FILES['file']["name"]) && in_array($_FILES['file']['type'], $checkCsvType)) {


            if (is_uploaded_file($_FILES["file"]["tmp_name"]) && $_FILES["file"]["size"] > 0) {


                //Open uploaded csv file in read only mode
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

                //skip first line
                fgetcsv($csvFile);


                //parse data from csv file line by line
                while (($row = fgetcsv($csvFile, 1000, ",")) !== FALSE) {


                    $insertingAllitems = $this->allresult->uploadaccounts($row[0], $row[1]);
                    //uploadfurniturefittingsnocode($AssetName, $type, $category, $location, $department, $PurchaseDate,  $effDate, $assetCost, $statusApproval, $sessID)

                    if ($insertingAllitems) {
                        //close opened csv file
                        $data = ['status' => 2, 'msg' => 'Assets Successfully Uploaded']; // Item Succesfully Uploaded;
                    } else {

                        $data = ['status' => 3, 'msg' => 'Error Uploading Content, Please Check your internet']; // Error Uploading Content. Please make sure the items are not more than 100,000 per upload 
                    }
                } // End of While Loop parsing File

                fclose($csvFile);
            } // End of If the File is Uploaded if($filename=$_FILES["file"]["tmp_name"]){

            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } // End of  if(isset($_FILES['file']["name"])){
        else {
            $data = ['status' => 1, 'msg' => 'Please upload a valid CSV file']; // Not a Valid CSV File
        } // Not a CSV File 
    }

    
    public function loadform(){
             $menu = $this->load->view('menu', '', TRUE);
              $sidebar = $this->load->view('sidebar', '', TRUE);
              $footer = $this->load->view('footer', '', TRUE);
              $values = ['sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
        $this->load->view('loadimportform', $values);
    }
 
    
    
    public function allapprovedrequest(){
      
        $title = "MONEY BOOK Pro :: HOMEPAGE";
        //$get all Reesult 
	//$getallresult = $this->mainlocation->getdetailsofrequestwithsession($_SESSION['email']);
			
	//Get Session Details
	$getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
        
        $getallresult = $this->allresult->myallrequest($_SESSION['email']);
        
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getSessionDetails'=>$getSessionDetails, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
        $this->load->view('approvedrequest', $values);
    }
    
    
    
     public function myawaitingapprovalpending(){
      
        $title = "MONEY BOOK Pro :: HOMEPAGE";
        //$get all Reesult 
	//$getallresult = $this->mainlocation->getdetailsofrequestwithsession($_SESSION['email']);
		
	//Get Session Details
	$getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
        
        $getallresult = $this->allresult->pendingrequest($_SESSION['email']);
       // $getallresult2 = $this->allresult->icurejectallmypending($_SESSION['email']);
        
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getSessionDetails'=>$getSessionDetails, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
        $this->load->view('awaitingapprovalicuhod', $values);
        
    }
    
    
    public function cancelrejected(){
      
        $title = "MONEY BOOK Pro :: HOMEPAGE";
        //$get all Reesult 
	//$getallresult = $this->mainlocation->getdetailsofrequestwithsession($_SESSION['email']);
		
	//Get Session Details
	$getSessionDetails =  $this->users->checkUserSession($_SESSION['email']);
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
        
        $getallresult = $this->allresult->cancelledrequest($_SESSION['email']);
       // $getallresult2 = $this->allresult->icurejectallmypending($_SESSION['email']);
        
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getSessionDetails'=>$getSessionDetails, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
        $this->load->view('cancelledrequest', $values);
        
    }
    
    
    
     public function myapprovalads(){
			
            $title = "Petty Cash :: MY APPROVAL";
            $getallresult = "";
        
            $mySessionEmail = $_SESSION['email'];
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
            
           if($getApprovalLevel == 6){ // This is HOD
                
               $getallresult = $this->mainlocation->getmydetailsenttome($mySessionEmail);
              
                $menu = $this->load->view('menu', '', TRUE);
                $sidebar = $this->load->view('sidebar', '', TRUE);
                $footer = $this->load->view('footer', '', TRUE);
                $values = ['title' => $title, 'getApprovalLevel'=>$getApprovalLevel, 'getallresult'=>$getallresult, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
                $this->load->view('myapprovalawaiting', $values);
             
            }else{
                redirect(base_url());
            }
			
           
		
        }
        
    
} // End of Class Home
