<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class Travels extends CI_Controller {

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


        //Use session to return relevant information
        $getUserDetails = $this->travelmodel->getUseremailfromgetajob($_SESSION['email']);
        if ($getUserDetails) {
            $title = "EXPENSE PRO :: TRAVE START";


            //$get all Reesult 
            $getallresult = $this->mainlocation->getdetailsofrequestwithsession($_SESSION['email']);

            //Get Session Details
            $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

            $mycustomcsrf = generateRandomCode(8, 50);

            //Send the result to view if staff ID exist
            //Note if a staff has email in stafftable but id missing in staff_mgt table the staff will not see any information
           
            $iamastaff = $this->travelmodel->gotogetoajob($getUserDetails);

            $getdestination = $this->mainlocation->getalllocation();
            if ($getdestination) {
                $adestination = "";
                foreach ($getdestination as $get) {
                    $destinationid = $get->id;
                    $destination = $get->locationName;
                    $adestination .= "<option  value='$destinationid'> " . $destination . '</option>';
                }
            }

            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'iamastaff' => $iamastaff, 'mycustomcsrf' => $mycustomcsrf, 'dLocationow' => $adestination, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/travelstart', $values);
        } else {
            echo "You are not a staff, please see I.T";
        }
    }

    ////////////////////////////////////////////START OF INDEX2 WITH SERVER SIDE PROGRAMMING //////////////////////////////



    public function addperdiem() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $getTravelAccess = $this->users->getUsertravelstartaccess();
        $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
        if ($getApprovalLevel == 6 || $whichAcess == TRUE) {
            $title = "Expense Pro :: ADD PER DIEM";
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/addperdiem', $values);
        } else {
            $this->load->view('noaccessview', $values);
        }
    }

    public function addhotel() {
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $getTravelAccess = $this->users->getUsertravelstartaccess();
        $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
        if ($getApprovalLevel == 6 || $whichAcess == TRUE) {
            $title = "Expense Pro :: ADD HOTEL";
            //get all the result
            $getHotel = $this->travelmodel->getallhotels();
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getHotel' => $getHotel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/addhotel', $values);
        } else {
            $this->load->view('noaccessview', $values);
        }
    }

    public function Dxk_udYz() {
        
        $getTravelAccess = $this->users->getUsertravelstartaccess();
        $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
        if($whichAcess == TRUE){
            $title = "TBS: Travel Logistics - Expense Pro";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);

        $totalflightrquest = $this->travelmodel->flightrequest();
        if($totalflightrquest){
            $doCount = count($totalflightrquest);
        }else{
            $doCount = 0;
        }
        
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'myCount' => $doCount, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('travelstart/travelstartadmin', $values);
        }else{
          $this->load->view('noaccesstoview');  
        }
        
    }

    public function xvL_dsviewal() {
        $getTravelAccess = $this->travelmodel->viewalltravelstart();
        $title = "TBS: Travel Logistics - Expense Pro";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
		
        $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);

        $last = "";
        $result_per_page = "";
        $getCount = "";
        $this->load->model('primary');


        $totalflightrquest = "";
       /*  if($whichAcess == TRUE){
                //$totalflightrquest = $this->travelmodel->getwareflight($_SESSION['email']);
                $totalflightrquest = $this->travelmodel->adminflightrequest();
          }else if($getApprovalLevel == 6){
                 $totalflightrquest = $this->travelmodel->adminflightrequest();
		    // $totalflightrquest = $this->travelmodel->allflightrequest($_SESSION['email']);
            }else{
                $totalflightrquest = $this->travelmodel->getwareflight($_SESSION['email']);
            }
            
            */
        if($whichAcess == TRUE){
            
         $totalflightrquest = $this->travelmodel->gettravelrequest();
          
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);

        $values = ['title' => $title, 'totalflightrquest'=>$totalflightrquest, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        
        //$this->load->view('travelstart/travelviewalls', $values);
        $this->load->view('travelstart/travelviewallswithsearch', $values);
        }else{
            echo "You do not have access to this page";
        }
      
    }




    public function xdmds_xn() {
        $getTravelAccess = $this->users->getUsertravelstartaccess();
        $title = "TBS: Travel Logistics - Expense Pro";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);

        $totalflightrquest = $this->travelmodel->myflightrequest($_SESSION['email']);
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'totalflightrquest' => $totalflightrquest, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('travelstart/traveladdedbyme.php', $values);
    }

    public function enmdit_mdsrnds_d($csrf) {
        $title = "Edit Travel Request";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        $getdestination = $this->mainlocation->getalllocation();
        if ($getdestination) {
            $adestination = "";
            foreach ($getdestination as $get) {
                $destinationid = $get->id;
                $destination = $get->locationName;
                $adestination .= "<option  value='$destinationid'> " . $destination . '</option>';
            }
        }

        //$getresult = $this->travelmodel->getcsrfdetails($csrf, $_SESSION['email']);
        $getresult = $this->travelmodel->getcsrfdetails($csrf);
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, '$csrf' => $csrf, 'dLocation' => $adestination, 'getresult' => $getresult, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('travelstart/travestartedit', $values);
    }

    public function processformedit() {
        $data = [];
        if (isset($_POST['control_csrf']) && isset($_POST['logistics']) && isset($_POST['hodEmail']) && isset($_POST['staffID'])) {

            // Declaring put putting all variables in Values
            $staffID = $this->input->post('staffID', TRUE);
            $benName = $this->input->post('benName', TRUE);
            $benEmail = $this->input->post('benEmail', TRUE);
            $travelID = $this->input->post('travelID', TRUE);

            $sDate = $this->input->post('exsDate', TRUE);
            $rDate = $this->input->post('exrDate', TRUE);
            $hodEmail = $this->input->post('hodEmail', TRUE);
            $logistics = $this->input->post('logistics', TRUE);
            $purpose = $this->input->post('purpose', TRUE);
            $bankName = $this->input->post('bankName', TRUE);
            $acctNum = $this->input->post('acctNum', TRUE);
            $dHotels = $this->input->post('dHotels', TRUE);
            $control_csrf = $this->input->post('control_csrf', TRUE);
            $csrf_valid = $this->input->post('csrf_valid', TRUE);
            $warefoffice = $this->input->post('warefoffice', TRUE);
            $sLevel = $this->input->post('sLevel', TRUE);
            $sLevel = preg_replace("/[^a-zA-Z]+/", "", $sLevel);
            $sessEmail = $this->session->email;
            $sessID = $this->session->id;
            $dateCreated = date('Y-m-s');
            $totalAmount = "";

            $approval = '0';
            $approvedBy = "";
            $insertedFileId = $this->travelmodel->travelupdate($approval, $approvedBy, $dateCreated, $warefoffice, $bankName, $acctNum, $totalAmount, $staffID, $control_csrf, $travelID);

            $auditTrail = "<hr/>Edited by " . $sessEmail . "time -" . date('y-m-d H:i:s');
            $auditnow = $this->travelmodel->travelsUpdateaudit($auditTrail, $travelID);

            if ($insertedFileId) {

                for ($i = 0; $i < count($_POST["tTolocation"]); $i++) {
                    $exid = $_POST['exid'][$i];
                    $tFromlocation = $_POST['tFromlocation'][$i];
                    $tTolocation = $_POST['tTolocation'][$i];
                    $exsDate = $_POST['exsDate'][$i];
                    $exrDate = $_POST['exrDate'][$i];
                    $purpose = $_POST['purpose'][$i];
                    $logistics = $_POST['logistics'][$i];
                    $purpose = preg_replace("/[^a-z A-Z 0-9]+/", " ", $purpose);

                    //$getsDay = date('d', strtotime($exsDate));
                    //$getrDay = date('d', strtotime($exrDate));
                    //$totalDay = $getrDay - $getsDay;
                    
                    $getsDay = strtotime($exsDate);
                    $getrDay = strtotime($exrDate);
                    if($getsDay > $getrDay){
                        $totalDay = $getsDay - $getrDay;
                    }else{
                        $totalDay = $getrDay - $getsDay;
                    }
                            
                    $totalDay = floor($totalDay / (60*60*24));
                             
                    
                    $session = $_SESSION['email'];
                    if ($logistics == 'perdiem') {
                        $getforSalaryLevel = $this->travelmodel->myperdiemclasslevel($sLevel, $tTolocation);
                    } else if ($logistics == 'hotel') {
                        $getforSalaryLevel = $this->travelmodel->dHotelClass($dHotels);
                    }
                    $fullAmount = $getforSalaryLevel * $totalDay;
                    $inserpushUpdate = $this->travelmodel->updatetraveExpense($tFromlocation, $tTolocation, $exsDate, $exrDate, $purpose, $logistics, $totalDay, $getforSalaryLevel, $fullAmount, $session, $exid);

                    $data = ['status' => 3, 'msg' => "<center><div class='cont-success center'><i style='font-size:80px; color:green' class='fa fa-smile-o success-icon'></i><p class='congrats'>Thank You!</p><p class='congratsTxt'>Your request has been sent successfully sent, We Will get back to you as soon as we verify your records.</p><div><a href='http://localhost/moneybook/travels/index' class='btn btn-large main-bg'>Go Back</a></div></div></center>"];
                } //  for($i = 0; $i < count($_POST["tTolocation"]); $i++){
            } // if($insertedFileId){
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function getdetalsofsearch() {
        ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
        $sumamount = "";
        $sessionID = $_SESSION['email'];
        $output = "";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($sessionID);

        if (isset($_POST['start']) && isset($_POST['end']) && isset($_POST['dex']) && isset($_POST['unit']) && isset($_POST['status'])) {
            $start = $this->input->post('start', TRUE);
            $end = $this->input->post('end', TRUE);
            $dex = $this->input->post('dex', TRUE);
            $unit = $this->input->post('unit', TRUE);
            $status = $this->input->post('status', TRUE);
            //$status = explode(",", $status); 
            //$status = implode(",", $status); 
            if($status == "approved"){
                $newStatus = [4,8];
                $newStatus = implode("','", $newStatus);
            }else if($status == "rejected"){
                 $newStatus = [5,6,12];
                $newStatus = implode("','", $newStatus);
            }else if($status == "awaiting"){
                $newStatus = [1,2,3];
                $newStatus = implode("','", $newStatus);
            }

            if ($unit == 'all' && $dex == 'both' && $start != "" && $end != "") {
                $data = $this->travelmodel->getallunitbydate($start, $end, $newStatus);
            } else if ($unit != 'all' && $dex == 'both' && $start != "" && $end != "") {
                $data = $this->travelmodel->getbymyunit($unit, $start, $end, $newStatus);
            } else if ($unit == 'all' && $dex != 'both' && $start != "" && $end != "") {
                $data = $this->travelmodel->getbymyunitbytypenum($dex, $start, $end, $newStatus);
            } else if ($unit != 'all' && $dex != 'both' && $start != "" && $end != "") {
                //$data = $this->travelmodel->getunitbyenumtype($unit, $dex, $start, $end, $newStatus);
                $data = $this->travelmodel->getunitbyenumtype($unit, $dex, $start, $end, $newStatus);
            }

            if ($data) {
                $output = '<hr/><table class="table table-striped"><tr><th>ID</th><th>Unit</th><th>Amount</th><th>Type</th><th>Status</th></tr>';
                foreach ($data as $get) {
                    $id = $get->id;
                    $dUnit = $get->dUnit;
                    $dAmount = $get->dAmount;
                    $enumType = $get->enumType;
                    $approvals = $get->approvals;

                    if ($approvals == 0) {
                        $newapproval = "Pending";
                    } else if ($approvals == 1) {
                        $newapproval = "<span style='color:red'>Awaiting HOD Approval</span>";
                    } else if ($approvals == 2) {
                        $newapproval = "<span style='color:blue'>Awaiting ICU Approval</span>";
                    } else if ($approvals == 3) {
                        $newapproval = "<span style='color:indigo'>Awaiting Payment</span>";
                    } else if ($approvals == 4) {
                        $newapproval = "<span style='color:green'>Ready for Collection</span>";
                    } else if ($approvals == 5) {
                        $newapproval = "<span style='color:red'>Not Approved By HOD</span>";
                    } else if ($approvals == 6) {
                        $newapproval = "<span style='color:grey'>Reject by ICU</span>";
                    } else if ($approvals == 7) {
                        $newapproval = "<span style='color:indigo'>Cheque Sent for Signature</span>";
                    } else if ($approvals == 8) {
                        $newapproval = "<span style='color:green'>Paid</span>";
                    } else if ($approvals == 11) {
                        $newapproval = "<span style='color:brown'>Closed</span>";
                    } else if ($approvals == 12) {
                        $newapproval = "<span style='color:brown'>Rejected By Accounts</span>";
                    }

                    if ($dAmount) {
                        $sumamount += $dAmount;
                    }
                    $output .= '<tr><td>' . $id . '</td><td><a href="'.base_url().'travelstart/getunitdetails/'.$unit.'/'.$start.'/'.$end.'/'.$dex.'">' . $this->mainlocation->getdunit($dUnit) . '</a></td><td>' . $dAmount . '</td><td>' . $enumType . '</td><td>' . $newapproval . '</td></tr>';
                }
            }

            $output .= '<table>';

            echo $output;
            echo '<div><br/><b>Total : ' . @number_format(@$sumamount, 2) . '</b><br/><small>Date Range: From: ' . $start . '  To:  ' . $end . '</small></div>';
        } //  if (isset($_POST['start']) && isset($_POST['end']) && isset($_POST['dex']) && isset($_POST['unit'])) {
    }
    
    
    
    public function getexpenseCode(){
        
        $sumamount = "";
        $sessionID = $_SESSION['email'];
        $output = "";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($sessionID);

        if (isset($_POST['ex_start']) && isset($_POST['ex_end']) && isset($_POST['aCode'])) {
            $start = $this->input->post('ex_start', TRUE);
            $end = $this->input->post('ex_end', TRUE);
            $aCode = $this->input->post('aCode', TRUE);
            
            if($aCode == 'all'){
                $getallAccountcode = $this->travelmodel->getallaccountscode($start, $end);
            }else if($aCode != 'all'){
                $getallAccountcode = $this->travelmodel->getbydCode($aCode, $start, $end); 
            }
            
             if ($getallAccountcode) {
                $output = '<hr/><table class="table table-striped"><tr><th>CODE NAME</th><th>Amount</th></tr>';
                foreach ($getallAccountcode as $cd) {
                    $requestID = $cd->requestID;
                    $request = $cd->request;
                    $exAmount = $cd->ex_Amount;
                    $total = $cd->total;
                    $ex_Code = $cd->ex_Code;
                   
                    
                    $output .= '<tr><td><a href="'.base_url().'travels/xxudin_ddxxsuind000OO5t/'.$ex_Code.'/'.$start.'/'.$end.'">' .$this->mainlocation->nameCode($ex_Code). ' - '.$ex_Code.'</a></td><td>' .@number_format($total, 2). '</td></tr>';
                }
            }
            
            $output .= '</table>';

            echo $output;
            if($aCode != 'all'){
            echo '<div><br/><b>Total : ' . @number_format(@$total, 2) . '</b><br/><small>Date Range: From: ' . $start . '  To:  ' . $end . '</small></div>';
            }else{
                echo "";
            }
            
        }
    }
    
    
    
    public function xxudin_ddxxsuind000OO5t($code, $start, $end){
         $title = "EXPENSE PRO :: ICU REPORT";
	 //Get second level approval ID
	 $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
        if($getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 7 || $getApprovalLevel == 2 || $getApprovalLevel == 5){ 
       
        $getWtransact = $this->travelmodel->getTransactID($code, $start, $end);
         
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'start'=>$start, 'end'=>$end, 'getWtransact'=>$getWtransact, 'dCode'=>$code, 'getApprovalLevel'=>$getApprovalLevel, 'sidebar' => $sidebar, 'menu'=>$menu, 'footer'=>$footer];
        $this->load->view('reports/searchdetails', $values);
        }else{
            redirect(base_url());
        }
    }
    
    
    
    
    //STAFF SECTION
     public function staffSearchme(){
        
        $sumamount = "";
        $sessionID = $_SESSION['email'];
        $output = "";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($sessionID);

        if (isset($_POST['userEmail']) && isset($_POST['sf_start']) && isset($_POST['ef_end']) && isset($_POST['dexs'])) {
            $sf_start = $this->input->post('sf_start', TRUE);
            $ef_end = $this->input->post('ef_end', TRUE);
            $dexs = $this->input->post('dexs', TRUE);
            $userEmail = $this->input->post('userEmail', TRUE);
            
           
            $getTravelDetgails = $this->travelmodel->getstafftravels($userEmail, $sf_start, $ef_end, $dexs);
            
            
             if ($getTravelDetgails) {
                $output = '<hr/><table class="table table-striped"><tr><th>Date</th><th>Title</th><th>Amount</th><th>Beneficiary</th><th>Prepared By</th><th>Action</th></tr>';
                foreach ($getTravelDetgails as $cd) {
                    $id = $cd->id;
                    $dateCreated = $cd->dateCreated;
                    $ndescriptOfitem = $cd->ndescriptOfitem;
                    $approvals = $cd->approvals;
                    $dAmount = $cd->dAmount;
                    $sessionID = $cd->sessionID;
                    $datepaid = $cd->datepaid;
                    $fullname = $cd->fullname;
                   
                   // $output .= '<tr><td><a href="'.base_url().'travels/xxudin_ddxxsuind000OO5t/'.$ex_Code.'/'.$start.'/'.$end.'">' .$this->mainlocation->nameCode($ex_Code). ' - '.$ex_Code.'</a></td><td>' .@number_format($total, 2). '</td></tr>'; 
                    $output .= '<tr><td>'.$dateCreated.'</td><td>'.$ndescriptOfitem.'</td><td>'.$dAmount.'</td><td>'.$fullname.'</td><td>'.$sessionID.'</td><td><a href="'.base_url().'travels/getviewXo/'.$id.'" class="btn btn-xs btn-primary">View</a></td></tr>';
                }
            }
            
            $output .= '</table>';

            echo $output;
           
            //echo '<div><br/><b>Total : ' . @number_format(@$total, 2) . '</b><br/><small>Date Range: From: ' . $start . '  To:  ' . $end . '</small></div>';
            
            
        }else{
            echo "No Result Found";
        }
    }
    

    public function getviewXo($id){
      if($id == ""){
         echo "Important Variable to render this page is missing"; 
      }else{
            // Use id to return travelID
         $getTravelID = $this->travelmodel->getTravelID($id);
         
         //Use travelID to return result
         $returnTravelResult = $this->travelmodel->gettravelexpenses($getTravelID);
        
           
        $title = "TBS: Transport Details - Expense Pro";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'detailsnow' => $returnTravelResult, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('travelstart/transportdetails', $values);
      }
    }
    
    
    
    public function rejectwarefareOfficer(){
        $data = [];
        
        if(isset($_POST["mainID"])){
            $mainID = $this->input->post('mainID', TRUE);
            $dComment = $this->input->post('addComment', TRUE);
            $sessionID = $_SESSION["email"];
           //  $getenumType = $this->travelmodel->getnumType($rejectrequestID);
         // if enumType == travel, then return the travelID
        // if($getenumType == 'travel'){
          // Use the travel ID to update the request in travel Start
          //$getTravelID = $this->travelmodel->getTravelID($mainID);
          //Run Travel ID Update change status to 
          $reject = "2";
          $doUpdate = $this->travelmodel->makedoUpdate($reject, $mainID, $sessionID);
          $comment = "<hr/>Rejected By $sessionID   Comments: $dComment   time ". date('y-m-s H:i:s');
          $doauditTrail = $this->travelmodel->runauditTrail($comment, $mainID);
          $updateCommentonly = $this->travelmodel->addCommentswarefare($dComment, $mainID);
          $data = ['status'=>1, 'msg'=>'Successfully Rejected'];
        // }
        }else{
             $data = ['status'=>2, 'msg'=>'Important Variable Missing'];
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
   
    
    
    public function myretirement($id="", $csrf="", $staffEmail="", $staffName=""){
       
        if(empty($id) || empty($csrf) || empty($staffEmail)){
           
            echo "Important Variable to render this page is missing";
        }else{
            //Use the ID to return the results;
              // Use id to return travelID
        $getTravelID = $this->travelmodel->getretirementresults($id, $csrf, $staffEmail);
         
        $title = "TBS: Transport Details - Expense Pro";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'dDetials' => $getTravelID, 'staffName'=> $staffName, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('travelstart/retirementdetails', $values);
        }
    }
    
    
    public function oooOOOflight_NOW67482h2O(){
         $getTravelAccess = $this->users->mainflightdetails();
         $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
         $title = "EXPENSE PRO :: PENDING TRAVEL FLIGHTS";
	 //Get second level approval ID
	 $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
         $getSupervisorsAccess = $this->travelmodel->onlysupervisors();
         $forhodonlys = $this->gen->haveAccess($_SESSION['id'], $getSupervisorsAccess);
         
         if($getApprovalLevel == 6 || $whichAcess == TRUE || $forhodonlys == TRUE || $getApprovalLevel == 3){
            $title = "TBS: Transport Details - Expense Pro";
            
            if($getApprovalLevel == 6){
               $getFlightRequest = $this->generalmd->getallforadmin();  
            }else if($whichAcess == TRUE && $forhodonlys != TRUE && $getApprovalLevel != 6){
             $getFlightRequest = $this->generalmd->withthreevaluesresult("*", "travelstart_expense", "processFlight", "yes", "hodwhoapprove", "", "icuwhoapprove", "");
            }else if($forhodonlys == TRUE){
               $getFlightRequest = $this->generalmd->withthreevaluesresult("*", "travelstart_expense", "processFlight", "yes", "sentTohod", $this->session->email, "hodwhoapprove", "");  
            }else if($getApprovalLevel == 3){
                $getFlightRequest = $this->travelmodel->getallflightbyicu();  
                
            }else{
               $getFlightRequest = ""; 
            }
           
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'forhodonlys'=>$forhodonlys, 'whichAcess'=>$whichAcess, 'getFlightRequest' => $getFlightRequest, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/flightrequest', $values);
         }else{
               $this->load->view('noaccesstoview');
         }
    }
    
    
    
    public function addflightrequestX00000($id){
         $getTravelAccess = $this->users->mainflightdetails();
         $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
         $title = "EXPENSE PRO :: ICU REPORT";
	 //Get second level approval ID
	 $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         $getFlightRequest = $this->generalmd->withthreevaluesresult("*", "travelstart_expense", "tid", $id,  "processFlight", "yes", "hodwhoapprove", "");
         if(($getApprovalLevel == 6 || $whichAcess == TRUE) && $getFlightRequest){
            $title = "TBS: Transport Details - Expense Pro";
            //$getFlightRequest = $this->travelmodel->getflightrequestshite($id, $request);
            
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            //$thenewmantle = preg_replace("(['%20 +'])", ' ', $maintle);
            $values = ['title' => $title, 'getFlightRequest' => $getFlightRequest, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/flightrequest_details', $values);
         }else{
               $this->load->view('noaccesstoview');
         }
    }
    
    
    
    public function UUUUUUUx0dsl123854mybatchedrequest(){
            $getTravelAccess = $this->users->mainflightdetails();
            $title = "TBS: Transport Details - Expense Pro";
            $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
            //Get second level approval ID
	    $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);   
            if($whichAcess == TRUE){
                $getResult = $this->travelmodel->getbybatchrequest();
            }else if ($getApprovalLevel == 6){
                $getResult = $this->travelmodel->getallbatch();
            }else{
                $getResult = "";
            }
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getResult' => $getResult, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/batchAll', $values);
         
    }
    
    
    public function batchedetailsXXXuds0o($sumID){
        $getTravelAccess = $this->users->mainflightdetails();
        $title = "TBS: Transport Details - Expense Pro";
        $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
        //Get second level approval ID
	$getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        
        if($getApprovalLevel == 6 || $whichAcess == TRUE ){
            
            $getResult = $this->travelmodel->getbatchedetails($sumID);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getResult' => $getResult, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/batchedetails', $values); 
            
        }
         
    }
    
   
    
    public function makexu_pay09iewo732938ment_mdj($id){
         $this->load->model('maintenance');
         $getTravelAccess = $this->users->mainflightdetails();
        $title = "TBS: Transport Details - Expense Pro";
        $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
        //Get second level approval ID
	$getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        
         $sessemail = $_SESSION['email'];
        //Get the Unit the user belongs to
        $userUnit = $this->generalmd->getuserAssetLocation("dUnit", "cash_usersetup", "email", $sessemail);
        $allVendors = "";
        if($getApprovalLevel == 6 || $whichAcess == TRUE ){
            
            $getResult = $this->travelmodel->getbatchresultbyid($id);
            
            $getallvendors =  $this->maintenance->fromaintenance("*", "maintenance_workshop", "unitID", $userUnit);
            if ($getallvendors) {

                    foreach ($getallvendors as $get) {
                        $mainID = $get->id;
                        $wkName = $get->workshop_name;
                        $allVendors .= "<option  value='$mainID'>$wkName</option>";
                    }
                    //return $allact;
                }
            
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'myvendors'=>$allVendors, 'getResult' => $getResult, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/paytoexpensepro', $values); 
            
        }
    }
    
    
    
    
     public function hotelbygroup(){
        $this->load->model('primary');
       $getTravelAccess = $this->users->gethotellaccess();
       $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
       $title = "EXPENSE PRO :: HOTELL ACCESS";
       //Get second level approval ID
       $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
         if($getApprovalLevel == 6 || $whichAcess == TRUE){
            $title = "TBS: Hotel Management";
            $gethotellarrange = $this->travelmodel->gethotelbygroup();
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'gethotellarrange' => $gethotellarrange, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/hotel_group', $values);
         }else{
               $this->load->view('noaccesstoview');
         }
    }
    
    
    
    
    
    
    public function xmyHo4444mdsktel($ids){
       
        $this->load->model('primary');
       $getTravelAccess = $this->users->gethotellaccess();
       $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
       $title = "EXPENSE PRO :: HOTELL ACCESS";
       //Get second level approval ID
       $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
         if($getApprovalLevel == 6 || $whichAcess == TRUE){
            $title = "TBS: Transport Details - Expense Pro";
            //$gethotellarrange = $this->primary->getallmyresultingstatus("travel_hotel_bookings", "status", "6, 7,8");
            $gethotellarrange = $this->primary->getallmyresultingstatus("travel_hotel_bookings", "hotel_id", $ids);
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
           
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title,  'gethotellarrange' => $gethotellarrange, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/hotel_arrangements', $values);
         }else{
               $this->load->view('noaccesstoview');
        
      }
    }
    
    
    
    public function addhoteltostaff(){
        $this->load->model('primary');
       $getTravelAccess = $this->users->gethotellaccess();
       $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
       $title = "EXPENSE PRO :: HOTELL ACCESS";
       //Get second level approval ID
       $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
         if($getApprovalLevel == 6 || $whichAcess == TRUE){
            $title = "TBS: Transport Details - Expense Pro";
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $gethotel = $this->primary->getdresult("*", "travel_hotel", "", "");
            $gethoteldetails = $this->primary->getdresultwithlimit("*", "travel_hotel_bookings",  5);
            $values = ['title' => $title, 'hoteldetails'=>$gethoteldetails, 'allHotel'=>$gethotel, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/addnewhotel', $values);
         }else{
               $this->load->view('noaccesstoview');
         }
    }
    
    
    
    public function fjorHertz009X_10mins(){
       $getTravelAccess = $this->users->getHertz();
       $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
       $title = "EXPENSE PRO :: HOTELL ACCESS";
       //Get second level approval ID
       $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
         if($getApprovalLevel == 6 || $whichAcess == TRUE){
            $title = "TBS: Transport Details - Expense Pro";
            
            if($getApprovalLevel == 6){
                 $gethotellarrange = $this->travelmodel->getforHertzsforadmin();
            }else{
               $gethotellarrange = $this->travelmodel->getforHertzs($_SESSION['email']); 
            }
                
                 
                 
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'gethotellarrange' => $gethotellarrange, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/hertz_arrangements', $values);
         }else{
               $this->load->view('noaccesstoview');
         }
    }
    
    
    
     public function addHertzPaymentX0OOo($id, $maintle){
         $getTravelAccess = $this->users->getHertz();
         $dHertz = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
         $title = "EXPENSE PRO :: HERTZ PAYMENT";
	 //Get second level approval ID
	 $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
         if($getApprovalLevel == 6 || $dHertz == TRUE){
            $title = "TBS: Transport Details - Expense Pro";
            $getHertz = $this->travelmodel->getHertzValu($id);
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $thenewmantle = preg_replace("(['%20 +'])", ' ', $maintle);
            $values = ['title' => $title, 'maintitle'=>$thenewmantle,  'getHertz' => $getHertz, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/hertz_transport', $values);
         }else{
               $this->load->view('noaccesstoview');
         }
    }
    
    
    
    
     public function viewsourcedetailXO($id="", $csrf="", $staffEmail="", $staffName=""){
       
        if(empty($id) || empty($csrf) || empty($staffEmail)){
           
            echo "Important Variable to render this page is missing";
        }else{
            //Use the ID to return the results;
              // Use id to return travelID
        $getTravelID = $this->travelmodel->getretirementresults($id, $csrf, $staffEmail);
         
        $title = "TBS: Transport Details - Expense Pro";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'dDetials' => $getTravelID, 'staffName'=> $staffName, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('travelstart/viewsourcedetails', $values);
        }
    }
    
    
    /*
     public function XX00ooBatch(){
         $getTravelAccess = $this->users->mainflightdetails();
         $getTravelAccessHotel = $this->users->gethotellaccess();
         
         $whichFlight = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
         $whichHotel = $this->gen->haveAccess($_SESSION['id'], $getTravelAccessHotel);
         $title = "EXPENSE PRO :: PENDING TRAVEL FLIGHTS";
	 //Get second level approval ID
	 $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
         if($getApprovalLevel == 6 || $whichFlight == TRUE || $whichHotel == TRUE){
            $title = "TBS: Transport Details - Expense Pro";
            $getResult = $this->travelmodel->getmybatchedrequest($_SESSION['email']);
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getResult' => $getResult, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/flight_batch', $values);
         }else{
               $this->load->view('noaccesstoview');
         }
    }
     * 
     */
    
    
    
    public function processflightonly(){
        $data = [];
        
        if(isset($_POST["mainID"]) && isset($_POST["processdFlight"])){
            $mainID = $this->input->post('mainID', TRUE);
            $processdFlight = $this->input->post('processdFlight', TRUE);
            $sessionID = $_SESSION["email"];
            $addflightdetails = $this->travelmodel->addflightrequest($mainID);
           
            $updateAprovaltofour = $this->travelmodel->updatemyapprovalforflight($mainID);
              
            $getStaffName = $this->travelmodel->flightStaffemail($mainID);
            $fromLocation = $this->travelmodel->fromLocation($mainID);
            $toLocation = $this->travelmodel->toLocation($mainID);
            
            $fromLocation = $this->mainlocation->getdLocation($fromLocation);
            $toLocation = $this->mainlocation->getdLocation($toLocation);
            
          $comment = "<hr/>Flight Instruction Sent By $sessionID   time ". date('y-m-s H:i:s');
          $doauditTrail = $this->travelmodel->runauditTrail($comment, $mainID);
          
           $message = "<div>Dear AWELE AWELEKAUME ASHI, </div>";
           $message .= "<div>Kindly process flight information for $getStaffName traveling from $fromLocation to $toLocation location(s)</div>";
           $message .= "<hr/>";
           $message .= "<div>Warefare Comment: $comment</div><br/>";
           $message .= "<br/>This is an automated email please do not reply<p><br/>";

                    $config = array(
                        'mailtype' => "html",
                    );

            $this->email->initialize($config);
            $this->email->from('info@c-ileasing.com', 'TBS TRAVEL START');
            $this->email->to('ho.frontdesk@c-ileasing.com');
            $this->email->cc('victor.ogiogio@c-ileasing.com, awelekaume.ashi@c-ileasing.com, oladejo.lasisi@c-ileasing.com');
            $this->email->subject('TRAVEL REQUEST FOR FLIGHT');
            $this->email->message($message);
            $this->email->send();
                    
                    
          $data = ['status'=>1, 'msg'=>'Flight Instruction Successfully Sent'];
          
        }else{
             $data = ['status'=>2, 'msg'=>'Important Variable Missing'];
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    public function xvD__dmsk938d($id, $staffID, $csrf){
        $title = "Edit Travel Request";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);

        $getdestination = $this->mainlocation->getalllocation();
        if ($getdestination) {
            $adestination = "";
            foreach ($getdestination as $get) {
                $destinationid = $get->id;
                $destination = $get->locationName;
                $adestination .= "<option  value='$destinationid'> " . $destination . '</option>';
            }
        }

        //$getresult = $this->travelmodel->getcsrfdetails($csrf, $_SESSION['email']);
        $getresult = $this->travelmodel->getcsrfdetails($csrf);
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, '$csrf' => $csrf, 'dLocation' => $adestination, 'getresult' => $getresult, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('travelstart/travestarteditbyadmin', $values);
    }
    
    
      public function rejectwarefareOfficerbothinexpensepro(){
        $data = [];
        
        if(isset($_POST["travelID"])){
            $travelID = $this->input->post('travelID', TRUE);
            $textme = $this->input->post('textme', TRUE);
            $sessionID = $_SESSION["email"];
            $benEmail = $this->input->post('benEmail', TRUE);
            
          $reject = "2";
          $doUpdate = $this->travelmodel->makedoUpdate($reject, $travelID, $sessionID);
          $comment = "<hr/>Rejected By $sessionID   Comments: $textme   time ". date('y-m-s H:i:s');
          $doauditTrail = $this->travelmodel->runauditTrail($comment, $travelID);
          $updateCommentonly = $this->travelmodel->addCommentswarefare($textme, $travelID);
         
          //Use the Travel Start ID to return the expense Pro ID
          $getExpenseproID = $this->travelmodel->getexpenseproid($travelID);
        
          if($getExpenseproID){
           $approve = '5';
           $updateApprove = $this->mainlocation->updaterequestbyhodwhoreject($approve, $textme, $getExpenseproID, $sessionID, $benEmail);
            //Insert all approval in this table approvalnewrequest
           $updateApprove = $this->mainlocation->dapprovalforequest($getExpenseproID, $textme, $sessionID);
           //Audit Trail
         $updatedBy = "WareFare Officer Rejected - $sessionID, Comment :- $textme <br/> time: ". date('Y-m-d H:i:s'). "<hr/>";
          
         $createdby = "<br/>Rejected By Warefare Officer - $sessionID, Comment :- $textme <br/> time: ". date('Y-m-d H:i:s'). "<hr/>";
         $updateAuditTrail= $this->mainlocation->updatedupdatetrail($updatedBy, $createdby, $getExpenseproID);
          }
          
          if($updateCommentonly){
                      
                $message = "<p> Your request on Travel Start Has been Reject.</p>";
                $message .= "<p> Request Title: Travel Start For  '".$benEmail."' With Expense Pro ID : $getExpenseproID has been rejected by $sessionID</p>";
                $message .= "<p>Kindly Raise another request</p>";
                             
                $fromEmail = "expensepro@c-iprocure.com";
                
                $config = array(
                    'mailtype' => "html",
                );
                
                $this->email->initialize($config);
                $this->email->from($fromEmail, 'TBS EXPENSE PRO:: TRAVEL REQUEST REVERSAL'); 
                $this->email->to($benEmail);
                $this->email->cc('seun.owolabi@c-ileasing.com');
                $this->email->subject('YOUR TRAVEL REQUEST HAS BEEN REJECT'); 
                $this->email->message($message); 
                $this->email->send();
         
              } 
          //Send a mail to the person who made the request
           $data = ['status'=>1, 'msg'=>'Successfully Rejected'];
          
        // }
        }else{
             $data = ['status'=>2, 'msg'=>'Important Variable Missing'];
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
   
    
    
    public function sendpaymentflight(){
         $getTravelAccess = $this->users->mainflightdetails();
         $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
         $title = "EXPENSE PRO :: PENDING FLIGHTS PAYMENTS";
	 //Get second level approval ID
	 $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
         $getSupervisorsAccess = $this->travelmodel->onlysupervisors();
         $forhodonlys = $this->gen->haveAccess($_SESSION['id'], $getSupervisorsAccess);
         
         if($getApprovalLevel == 6 || $whichAcess == TRUE){
            $title = "TBS: Transport Details - Expense Pro";
            
            $getFlightRequest = $this->travelmodel->forbatchpayment();
            
           
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'whichAcess'=>$whichAcess, 'getFlightRequest' => $getFlightRequest, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/flightbatchpayment', $values);
         }else{
               $this->load->view('noaccesstoview');
         }
    }
    
    
    
    
     public function sendpaymentflightdetails($id){
         $getTravelAccess = $this->users->mainflightdetails();
         $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
         $title = "EXPENSE PRO :: PENDING FLIGHTS PAYMENTS";
	 //Get second level approval ID
	 $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
         $getSupervisorsAccess = $this->travelmodel->onlysupervisors();
         $forhodonlys = $this->gen->haveAccess($_SESSION['id'], $getSupervisorsAccess);
         
         if($getApprovalLevel == 6 || $whichAcess == TRUE){
            $title = "TBS: Transport Details - Expense Pro";
            
            $getFlightRequest = $this->travelmodel->batchinrequest($id);
            
           
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'whichAcess'=>$whichAcess, 'getFlightRequest' => $getFlightRequest, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/flightbatchpaymentsplitted', $values);
         }else{
               $this->load->view('noaccesstoview');
         }
    }
    
    
    public function bookflightexternal(){
        
         $getTravelAccess = $this->users->mainflightdetails();
         $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
         $title = "EXPENSE PRO :: ICU REPORT";
	 //Get second level approval ID
	 $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
       
         if($getApprovalLevel == 6 || $whichAcess == TRUE){
            $title = "TBS: Transport Details - Expense Pro";
            //$getFlightRequest = $this->travelmodel->getflightrequestshite($id, $request);
            
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            //$thenewmantle = preg_replace("(['%20 +'])", ' ', $maintle);
             $getdestination = $this->mainlocation->getalllocation();
            if ($getdestination) {
                $adestination = "";
                foreach ($getdestination as $get) {
                    $destinationid = $get->id;
                    $destination = $get->locationName;
                    $adestination .= "<option  value='$destinationid'> " . $destination . '</option>';
                }
            }
            
            $values = ['title' => $title, 'dLocationow' => $adestination,  'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/flightrequest_details_external', $values);
         }else{
               $this->load->view('noaccesstoview');
         }
        
    }
    
    
    public function allfightrequest(){
        
        $getTravelAccess = $this->users->mainflightdetails();
         $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
         $title = "EXPENSE PRO :: PENDING FLIGHTS PAYMENTS";
	 //Get second level approval ID
	 $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
       
         if($getApprovalLevel == 6 || $whichAcess == TRUE){
            $title = "TBS:ALL FLIGHT REQUEST - Expense Pro";
         
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            
            ///////////////////////////////BEGINNING OF FETCH API /////////////////////////
            
            $totaldata = "";
            $this->load->model('primary');
            $getCount = $this->primary->getcount("travelstart_expense");
            //Here we have the total row count
            $totaldata = $getCount;
            //Specify how many results per page
            $result_per_page = 10;
            //This tells us the page number of our last page
            $last = ceil($totaldata / $result_per_page);

            //This makes sure $last cannot be less than 1
            if ($last < 1) {
                $last = 1;
            }

            
            /////////////////////////////END OF FETCH API ////////////////////////////////
            $values = ['title' => $title, 'last' => $last, 'rrp' => $result_per_page,  'whichAcess'=>$whichAcess,  'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/allflightrequest', $values);
         }else{
               $this->load->view('noaccesstoview');
         }
    }
    
    
    
    public function paginationparser() {
        //Make the script run only if there is a page number posted to this script
        $data = [];
        if (isset($_POST['pn'])) {
            $rpp = $this->input->post('rpp', TRUE);
            $last = $this->input->post('last', TRUE);
            $pn = $this->input->post('pn', TRUE);

            $rpp = preg_replace('#[^0-9]#', '', $rpp);
            $last = preg_replace('#[^0-9]#', '', $last);
            $pn = preg_replace('#[^0-9]#', '', $pn);

            //This makes sure the page number isn't below 1 or more than our last page
            if ($pn < 1) {
                $pn = 1;
            } else if ($pn > $last) {
                $pn = $last;
            }
            $this->load->model('primary');
            //This set the range of rows to query for the choosen $pn
            $limit = 'LIMIT ' . ($pn - 1) * $rpp . ',' . $rpp;
            //This is your query again, it is for grabbing just one page worth of rows by applying $limit
            $getResult = $this->primary->fetchtenrows("tid", "travelStart_ID", "tFrom", "tTo", "exsDate", "exrDate", "processFlight", "hodwhoapprove", "icuwhoapprove", "travelstart_expense", "tid", $limit);
           //print_r($getResult);
           if($getResult){
                foreach($getResult as $get){
                    $tid = $get->tid;
                    $dateCreated = $this->primary->getsinglecolumn("dateCreated", "travelstart", "id", $get->travelStart_ID);
                    $travelStart_ID = is_numeric($this->primary->getsinglecolumn("staffName", "travelstart", "id", $get->travelStart_ID)) ? $this->primary->getsinglecolumn("staffName", "travelstart", "id", $get->travelStart_ID) : $get->travelStart_ID;
                    $tFrom = $this->primary->getsinglecolumn("locationName", "cash_location", "id", $get->tFrom);
                    $tTo = $this->primary->getsinglecolumn("locationName", "cash_location", "id", $get->tTo);
                    $exsDate = $get->exsDate;
                    $exrDate = $get->exrDate;
                    $processFlight = $get->processFlight;
                    $hodwhoapprove = $get->hodwhoapprove;
                    $icuwhoapprove = $get->icuwhoapprove;
                    
                     $data[] = ["tid" => $tid, "dateCreated"=>$dateCreated, "travelStart_ID" => $travelStart_ID, "tFrom" => $tFrom, "tTo" => $tTo, "exsDate" => $exsDate,  "exrDate" => $exrDate,
                         "processFlight" => $processFlight, "hodwhoapprove" => $hodwhoapprove, "icuwhoapprove" => $icuwhoapprove];
                }
                
              
            }
            
           
            //$data = $getResult;
            //$json['ci'] = $getAssets;
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    


    public function paginationparsertravel() {
        $this->load->model('primary');
        //Make the script run only if there is a page number posted to this script
        $data = [];
        if (isset($_POST['pn'])) {
            $rpp = $this->input->post('rpp', TRUE);
            $last = $this->input->post('last', TRUE);
            $pn = $this->input->post('pn', TRUE);

            $rpp = preg_replace('#[^0-9]#', '', $rpp);
            $last = preg_replace('#[^0-9]#', '', $last);
            $pn = preg_replace('#[^0-9]#', '', $pn);

            //This makes sure the page number isn't below 1 or more than our last page
            if ($pn < 1) {
                $pn = 1;
            } else if ($pn > $last) {
                $pn = $last;
            }

            //This set the range of rows to query for the choosen $pn
            $limit = 'LIMIT ' . ($pn - 1) * $rpp . ',' . $rpp;
            //This is your query again, it is for grabbing just one page worth of rows by applying $limit
            $getResult = $this->primary->fetchtenrows("id", "dateCreated", "staffID", "staffName",
             "staffEmail", "unit", "sTotal", "location", "approval", "travelstart", "id", $limit);
            $data = $getResult;
            //$data['ci'] = $getResult;
            //$json['ci'] = $getAssets;
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    


    public function searchforcontent(){
        $data = [];
        if(isset($_POST['dopost'])){

            //Use the post result to search for staff Name
            $postSearch = $this->input->post('dopost', TRUE);
           
            //Query the staff name from the database and send back the result
            $getdResult = $this->travelmodel->getdstaffname($postSearch);
            $data = $getdResult;
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
        
    }


    public function getallpayee(){
       $this->load->model('maintenance'); 
        $data = [];

        $getallvendors =  $this->maintenance->fromaintenance("*", "maintenance_workshop", "", "");
        $data =  $getallvendors;
        

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    public function getiftypestaff(){
        $this->load->model('primary');
        if(isset($_POST['dtypeValue'])){
            $dtypeValue = $this->input->post('dtypeValue', TRUE);
            
            if($dtypeValue == "staff"){
               $data["result"] = $this->primary->getdresult("*", "cash_usersetup", "", "");
            }else if($dtypeValue == "not-staff"){
               $data["result"] = "";
            }
            
             $this->output->set_content_type('application/json')->set_output(json_encode($data));
            
        }
    }
    
    
    public function bookhotel(){
        
        $data = [];
        //var_dump($_POST);
         if(isset($_POST['emailAddress'])){
             $emailAddress = $this->input->post('emailAddress', TRUE);
             $dType = $this->input->post('dType', TRUE);
             $whichhotel = $this->input->post('whichhotel', TRUE);
             $hFrom = $this->input->post('hFrom', TRUE);
             $hTo = $this->input->post('hTo', TRUE);
             $dReason = $this->input->post('dReason', TRUE);
             $dhod = $this->input->post('dhod', TRUE);
             
             
             
             if($emailAddress == "" || $dType == "" || $whichhotel == "" || $hFrom == "" || $dReason == "" || $dhod == ""){
                  $data = ["status" => 401];
             }else{
                 
                $getsDay = strtotime($hFrom);
                $getrDay = strtotime($hTo);
                    if($getsDay > $getrDay){
                        $totalDay = $getsDay - $getrDay;
                    }else{
                        $totalDay = $getrDay - $getsDay;
                    }
                            
                    $totalDay = floor($totalDay / (60*60*24));
                    
                   
                 $destination = $hFrom ." _ ". $hTo;
                 $datarray = [];
		 $datarray['type'] = $dType;
                  $datarray['dateCreated'] = date('Y-m-d H:i:s');
                 $datarray['user_email'] = $emailAddress;
                 $datarray['hotel_type'] = $whichhotel;
                 $datarray['destinations'] = $destination;
                 $datarray['reasons'] = $dReason;
                 $datarray['hod'] = $dhod;
                 $datarray['addedBy'] = $this->session->id;
                 $datarray['dayspent'] = $totalDay;
                  $datarray['status'] = 6;
                 $datarray['dAmount'] = $this->generalmd->getuserAssetLocation("hotel_cost", "travel_hotel", "id", $whichhotel);
                 $datarray['totalAmount'] = $totalDay *  $datarray['dAmount'];
                 $datarray['auditTrail'] = "<tr><td>Created By</td> <td>".$this->session->email."</td> <td>".date('Y-m-d H:i:s')."</td></tr>";
                 
                 $options = array(
			'table' => 'travel_hotel_bookings',
			'data'  => $datarray
		   );

		  $insertedFileId = $this->generalmd->create( $options );
                 
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
                    $this->email->from("expensepro@c-iprocure.com", 'TBS EXPENSE PRO:: HOTEL APPROVAL');
                    $this->email->cc($_SESSION['email']);
                    $this->email->to($dhod);
                    $this->email->subject('PENDING HOTEL APPROVAL');
                    $this->email->message($message);
                    $this->email->send();
                  } 
                  
                  
                  if($insertedFileId){
                      $data = ["status" => 200];
                  }else{
                       $data = ["status" => 400];
                  }
                 
             }
         }
        
         $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    
   
    public function viewallbatch(){
        $this->load->model('primary');
       $getTravelAccess = $this->users->gethotellaccess();
       $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
       $title = "EXPENSE PRO :: PAYMENTS";
       //Get second level approval ID
       $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
         if($getApprovalLevel == 6 || $whichAcess == TRUE){
            $title = "TBS: Transport Details - Expense Pro";
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            //$getallpayments = $this->primary->getdresult("*", "batchedflights", "", "");
            $getallpayments = $this->primary->getorderby("*", "pending", "batchedflights", "id", "200");
            $values = ['title' => $title, 'getallpayments'=>$getallpayments, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/pendingbatchpayment', $values);
         }else{
               $this->load->view('noaccesstoview');
         }
    }
    
    
    
    
    public function rejectedhotelrequest(){
        $this->load->model('primary');
       $getTravelAccess = $this->users->gethotellaccess();
       $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
       $title = "EXPENSE PRO :: REJECTED HOTELL ACCESS";
       //Get second level approval ID
       $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
         
         if($getApprovalLevel == 6 || $whichAcess == TRUE){
            $title = "TBS: Hotel Management";
            //$gethotellarrange = $this->travelmodel->gethotelbygroup();
            $getrejectedhotels = $this->primary->getdresult("*", "travel_hotel_bookings", "status", "5");
            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
            $menu = $this->load->view('menu', '', TRUE);
            $sidebar = $this->load->view('sidebar', '', TRUE);
            $footer = $this->load->view('footer', '', TRUE);
            $values = ['title' => $title, 'getrejectedhotels' => $getrejectedhotels, 'getApprovalLevel' => $getApprovalLevel, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
            $this->load->view('travelstart/hotel_group_rejected', $values);
         }else{
               $this->load->view('noaccesstoview');
         }
    } 
    
    
  
    
    
 ////////////////////////////////////////// New function account Code ///////////////////////////////////////
    public function getaccountcode() {
        $sumamount = "";
        $sessionID = $_SESSION['email'];
        $output = "";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($sessionID);

        if (isset($_POST['start']) && isset($_POST['end']) && isset($_POST['unit']) && isset($_POST['status'])) {
            $start = $this->input->post('start', TRUE);
            $end = $this->input->post('end', TRUE);
            $unit = $this->input->post('unit', TRUE);
            $status = $this->input->post('status', TRUE);
            $currency = $this->input->post('currency', TRUE);
            
            
            //Select all the request that have been approved based on the unit and the period
            
            //group the ID to check in cash_newrequestID
            
            
            if($status == "approved"){
                $newStatus = [4,8];
                $newStatus = implode("','", $newStatus);
            }else if($status == "rejected"){
                 $newStatus = [5,6,12];
                $newStatus = implode("','", $newStatus);
            }else if($status == "awaiting"){
                $newStatus = [1,2,3];
                $newStatus = implode("','", $newStatus);
            }

            //SELECT GROUP_CONCAT(id) as unitID FROM cash_newrequestdb WHERE dUnit ='8' AND `datepaid` >= '2019-02-19' AND `datepaid` <= '2019-06-19' AND `approvals` IN('4')
                    
            $data = $this->travelmodel->getaccountcodeonly($unit, $start, $end, $newStatus);
            
            //Send it to cash_new request and use th in array
            $getResult = $this->travelmodel->getcash_secondtable("cash_newrequest_expensedetails", $data);
            
            

            if ($getResult) {
                $sumamount = 0;
                $output = '<hr/><table class="table table-striped"><tr><th>ID</th><th>Unit</th><th>Code</th><th>Amount</th><th>Details</th></tr>';
                foreach ($getResult as $get) {
                    $code = $get->ex_Code;
                    $dCount = $get->accountCode;
                    $total = $get->Total;
                    $requestID = $get->requestID;
                   
                    

                    if ($total) {
                        $sumamount += $total;
                    }
                    $output .= '<tr><td>' . $dCount . '</td><td><a href="'.base_url().'travelstart/getunitdetails/'.$unit.'/'.$start.'/'.$end.'">' . $this->mainlocation->getdunit($unit) . '</a></td><td>' . $code . '</td><td>' . @number_format($total, 2) . '</td><td>View</td></tr>';
                }
            }

            $output .= '<table>';

            echo $output;
            echo '<div><br/><b>Total : ' . @number_format(@$sumamount, 2) . '</b><br/><small>Date Range: From: ' . $start . '  To:  ' . $end . '</small></div>';
            
    
            
            
            
        } //  if (isset($_POST['start']) && isset($_POST['end']) && isset($_POST['dex']) && isset($_POST['unit'])) {
    }
    
   
    
    public function exportoexcel(){
        
         $this->load->driver('cache');
        $this->cache->clean();
        $this->output->cache(0);
        ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
        
         $start = $this->input->post('acc_start', TRUE);
            $end = $this->input->post('acc_end', TRUE);
            $unit = $this->input->post('acc_unit', TRUE);
            $status = $this->input->post('acc_status', TRUE);
           
            if($status == "approved"){
                $newStatus = [4,8];
                $newStatus = implode("','", $newStatus);
            }else if($status == "rejected"){
                 $newStatus = [5,6,12];
                $newStatus = implode("','", $newStatus);
            }else if($status == "awaiting"){
                $newStatus = [1,2,3];
                $newStatus = implode("','", $newStatus);
            }

         /////////////////////////////////////PREPARING DOWNLOAD //////////////////////////////////////////////////////
          
                
            $data = $this->travelmodel->getaccountcodeonly($unit, $start, $end, $newStatus);
            
            $this->load->library("excel");
            $object = new PHPExcel();

            $object->setActiveSheetIndex(0);
            //requestID, sess, ex_Code,  COUNT(ex_Code) as accountCode, SUM(ex_Amount) as Total 
            $table_columns = array("requestID", "sess", "ex_Code", "Description", "accountCode", "Total");

            $column = 0;

            foreach ($table_columns as $field) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
            }
          
             
              //Send it to cash_new request and use th in array
            $employee_data = $this->travelmodel->getcash_secondtable("cash_newrequest_expensedetails", $data);
            
            $excel_row = 2;
           
              foreach ($employee_data as $row) {
                
                $checkInt =  is_numeric($row->ex_Code) ?  $this->generalmd->getsinglecolumn("codeName", "codeact", "codeNumber", $row->ex_Code) 
                        : preg_replace("([0-9]+)", "", $row->ex_Code);
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->requestID);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->sess);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2,  $excel_row, $row->ex_Code);
                 $object->getActiveSheet()->setCellValueByColumnAndRow(3,  $excel_row, $checkInt);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->accountCode);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->Total);
               
                $excel_row++;
                  
              }
              
               $object->setActiveSheetIndex(0);

            $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            // Sending headers to force the user to download the file
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="C&IReport_' . date('dMy') . '.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            
    /////////////////////////////////////// END OF DOWNLOAD /////////////////////////////////////////////////////
           
            
    }
    
   
    
    public function xvL_dsviewal_search() {
        
        $getTravelAccess = $this->travelmodel->viewalltravelstart();
        $title = "TBS: Searched Result - Travel Logistics - Expense Pro";
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //Get Session Details
        $getSessionDetails = $this->users->checkUserSession($_SESSION['email']);
		
        $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);

          $id = $this->input->get('id', TRUE);
          $startDate = $this->input->get('startDate', TRUE);
          $endDate = $this->input->get('endDate', TRUE);
        
        /* if($id === "" && $startDate === "" && $endDate == ""){
             echo "Please enter a search term";
             return;
         }
         */
        $totalflightrquest = "";
        if($id){
         $totalflightrquest = $this->travelmodel->gettravelrequestwithid($id);   
        }else if($startDate && $endDate){
             $totalflightrquest = $this->travelmodel->gettraveldetailstartend($startDate, $endDate);  
        }else if($startDate){
          $totalflightrquest = $this->travelmodel->gettraveldetailstart($startDate);     
        }else{
             $totalflightrquest = $this->travelmodel->gettravelrequest();   
        }
       
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);

        $values = ['title' => $title, 'totalflightrquest'=>$totalflightrquest, 'getApprovalLevel' => $getApprovalLevel, 'getSessionDetails' => $getSessionDetails, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        
        //$this->load->view('travelstart/travelviewalls', $values);
        $this->load->view('travelstart/travelviewallswithsearch', $values);
        
      
    }
    
    
    
    
    
}// End of Class Home
