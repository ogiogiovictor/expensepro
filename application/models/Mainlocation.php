<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Mainlocation extends CI_Model{
	
	public function __contruct(){
		parent::__contruct();
	}
	
	/***** This controller returns all users ******/
	 public function checklocalation($locale){
        $q = "SELECT * FROM  cash_location WHERE locationName = ?";
        
        $run_q = $this->db->query($q, [$locale]);
        
        if($run_q->num_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }
	
	
	// function insert Menu into the database
	public function insertnewlocation($dlocation){
		$q = "INSERT into cash_location (locationName) VALUES(?)";
		$insertDB = $this->db->query($q, [$dlocation]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
        
        
        
        
////////////////////////////////////BEGINNING OF PAYMENT MODE SETUP/////////////////////////////////////////////////
        
        /***** This controller returns all users ******/
	 public function checkpayment($payment){
        $q = "SELECT * FROM  cash_paymentmode WHERE paymentType = ?";
        
        $run_q = $this->db->query($q, [$payment]);
        
        if($run_q->num_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }
	
	

	public function insertnewpayment($payment){
		$q = "INSERT into cash_paymentmode (paymentType) VALUES(?)";
		$insertDB = $this->db->query($q, [$payment]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
        
 //////////////////////////////////END OF PAYMENT MODE SETUUP //////////////////////////////////////////////////
     
   public function checkdaccess($access){
        $q = "SELECT * FROM cash_accesslevel WHERE accesstype = ?";
        
        $run_q = $this->db->query($q, [$access]);
        
        if($run_q->num_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }
	
	

        public function insertnewaccess($daccess){
		$q = "INSERT into cash_accesslevel (accesstype) VALUES(?)";
		$insertDB = $this->db->query($q, [$daccess]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}

///////////////////////////////////////////BEGINNING OF ACCESS MODE /////////////////////////////////////
	
 
        
        
  ////////////////////////////////////PROGRAMMING USER CREATE SETUP /////////////////////////////////////
        
    public function getallaccess(){
        $q = "SELECT * FROM cash_accesslevel";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function getalllocation(){
        $q = "SELECT * FROM cash_location";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }

    
      public function getallunit(){
        $q = "SELECT * FROM cash_unit";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function checkemail($email){
        $q = "SELECT * FROM cash_usersetup WHERE email = ?";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function addNewuser($fname, $lname, $email, $sAccess, $sLocation){
		$q = "INSERT into cash_usersetup (`fname`, `lname`, `email`, `accessLevel`, `uLocation`, `dateCreated`) VALUES(?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$fname, $lname, $email, $sAccess, $sLocation]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
    
////////////////////////////////////END OF USER CREATE SETUP ////////////////////////////////////////////
        

//////////////////////////////////PROGRAMMING NEW REQUEST FORM /////////////////////////////////////////
        
         public function getallpayment(){
        $q = "SELECT * FROM  cash_paymentmode";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function getallhod(){
        $q = "SELECT * FROM cash_usersetup WHERE accessLevel = '2'";  //2 Stands for HOD
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function getallicu(){
        $q = "SELECT * FROM cash_usersetup WHERE accessLevel = '3'";  //2 Stands for HOD
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function getallaccount(){
        $q = "SELECT * FROM cash_usersetup WHERE accessLevel = '4'";  //2 Stands for HOD
      
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
	
    
      public function getActCode($cat){
        $q = "SELECT * FROM codeact WHERE codeNumber = ?";
        
        $run_q = $this->db->query($q, [$cat]);
        
        if($run_q->num_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function getVendorName($cat){
        $q = "SELECT * FROM vendorsTable WHERE actNo = ?";
        
        $run_q = $this->db->query($q, [$cat]);
        
        if($run_q->num_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }
	
    
     public function insertcat($name, $actNo){
		$q = "INSERT into vendorsTable (vendorName, actNo) VALUES(?, ?)";
		$insertDB = $this->db->query($q, [$name, $actNo]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
        
        
       public function insertcatActCode($actName, $actCode, $category){
		$q = "INSERT into codeact (codeName, codeNumber, category) VALUES(?, ?, ?)";
		$insertDB = $this->db->query($q, [$actName, $actCode, $category]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
        
    
     public function getallcategoryfromdb(){
        $q = "SELECT * FROM cash_dCategory";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
	
	
	
	public function insertRequest($descItem, $dateCreated, $paymentType, $dhod, $dicu, $dcashier="", $origName, $newfileName, $sessionID, $approvals, $linkOnDisk, $Amount, $getLocation, $dUnit, $benEmail, $benName, $mimeType="", $ext="", $daccountant="", $dtransfer=""){
		$q = "INSERT into cash_newrequestdb (ndescriptOfitem, dateCreated, nPayment, hod, icus, cashiers, origFileName, newFileName, sessionID, approvals,  linkOnDisk, dAmount, dLocation, dUnit, benEmail, benName, mimeType, ext, dAccountgroup, dBankTransfergroup, dateRegistered) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$descItem, $dateCreated, $paymentType, $dhod, $dicu, $dcashier, $origName, $newfileName, $sessionID, $approvals, $linkOnDisk, $Amount, $getLocation, $dUnit, $benEmail, $benName, $mimeType, $ext, $daccountant, $dtransfer]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
	
	
	
///////////////////////////////////////////////////SUPER ADMIN ONLY GETS ALL REQUEST FROM THE DATABASE/////////////////////////////////////////	
	public function getallresultfromnewrequest(){
        $q = "SELECT * FROM cash_newrequestdb ORDER BY id DESC LIMIT 200";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
	
///////////////////////////////////////////////////END SUPER ADMIN ONLY GETS ALL REQUEST FROM THE DATABASE/////////////////////////////////////////	



	
	public function getdexactresultfromdb($id){
        $q = "SELECT * FROM cash_newrequestdb WHERE id = ? ORDER BY id DESC";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
	
	
	
	///////////////////////////////////////////////////GETS ALL RESULT BASED ON SESSION EMAIL/////////////////////////////////////////	
	public function getdetailsofrequestwithsession($email){
        $q = "SELECT * FROM cash_newrequestdb WHERE sessionID = '$email' AND approvals NOT IN ('11') AND enumType = 'expense' ORDER BY id DESC LIMIT 10000";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
	
///////////////////////////////////////////////////END OF GETS ALL RESULTS BASED ON SESSION EMAIL/////////////////////////////////////////	

 ////////////////////////////////// END OF NEW REQUEST FORM ////////////////////////////////////////////////
	
	 public function getUserdetails($id){
        $q = "SELECT * FROM cash_usersetup WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
	
    
    //Get the Category Type
    public function getdcategoryname($id){
        $q = "SELECT * FROM cash_dcategory WHERE id= ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->categoryName;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     //Get the Category Type
    public function getpaymentType($id){
        $q = "SELECT * FROM cash_paymentmode WHERE id= ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->paymentType;
            }
        }
        
        else{
            return FALSE;
        }
    }
	
    
      //Get the Category Type
    public function getapprovallevel($email){
        $q = "SELECT * FROM cash_usersetup WHERE email= ?";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->accessLevel;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
   //Get the Category Type
    public function gethodmyrequest($email){
        $q = "SELECT * FROM cash_newrequestdb WHERE hod= ?";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->hod;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function getmydetailsenttome($email){
        $q = "SELECT * FROM cash_newrequestdb WHERE hod = ? AND approvals = '1' ORDER BY id DESC LIMIT 500";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
      //Get the Category Type
    public function geticuapproval($email){
        $q = "SELECT * FROM cash_newrequestdb WHERE icus = ? AND approvals = '2'";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
      //Get the Category Type
    public function getaccoutpayment($email){
        $q = "SELECT * FROM cash_newrequestdb WHERE cashiers = ? AND approvals = '3'";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
       //Get the Category Type
    public function getmainaccount(){
        $q = "SELECT * FROM cash_newrequestdb WHERE approvals = '3' AND dICUwhoapproved != ''";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
        //Get the Category Type for ICU
    public function getallfromicutogetgoing(){
        $q = "SELECT * FROM cash_newrequestdb WHERE approvals = '2' || approvals = '1'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
         //Get the Category Type for ICU
    public function getallfromicutogetgoingicuhead($email){
        $q = "SELECT * FROM cash_newrequestdb WHERE approvals = '2' || approvals = '1' AND hod='$email' ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     
	

    //Get the Category Type
    public function getdLocation($locID){
        $q = "SELECT * FROM cash_location WHERE id= ?";
        
        $run_q = $this->db->query($q, [$locID]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->locationName;
            }
        }
        
        else{
            return FALSE;
        }
    }
    

    
 ///////////////////////////////////UPDATE NEW REQUEST APPROVAL //////////////////////////////////////////////////////
 
	public function updaterequestbyhod($approve, $dComment, $acceptrequestID, $sessionID, $whomaderequest){
		$q = "UPDATE cash_newrequestdb SET  `approvals`= '$approve', `addComment`= '$dComment', `hodwhoapprove` = '$sessionID' , `approvedHOD` = '$whomaderequest', `dateHODapprove` = NOW(), `pendingHOD` = '' WHERE id = '$acceptrequestID'";
		$this->db->query($q);
                return $acceptrequestID;
	}
        
        
        public function updaterequestbyhodwhoreject($approve, $dComment, $acceptrequestID, $sessionID, $whosendit){
		 $q = "UPDATE cash_newrequestdb SET  `approvals`= '$approve', `addComment`= '$dComment', `rejectedHOD` = '$whosendit',`hodwhoreject` = '$sessionID', `pendingHOD` = '', `dateRejected` = NOW() WHERE id = '$acceptrequestID'";
		$this->db->query($q);
                return $acceptrequestID;
	}
        
        
        public function dapprovalforequest($acceptrequestID, $dComment, $sessionID){
		$q = "INSERT into cash_approvalreques (newrequesID, comment, sessionID, dateApproved) VALUES(?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$acceptrequestID, $dComment, $sessionID]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
        
        
        
         public function icucommentforrejection($icurejectrequestID, $fullcomment, $sessionID){
		 $q = "UPDATE cash_approvalreques SET  `icuComment`= '$fullcomment', `sessionID`= '$sessionID' WHERE `newrequesID` = '$icurejectrequestID'";
		$this->db->query($q);
                return $icurejectrequestID;
    }
    
    
         public function icucommentforrejectrequest($icurejectrequestID, $fullcomment, $sessionID){
		$q = "INSERT into cash_approvalreques (newrequesID, icuComment, sessionID, dateApproved) VALUES(?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$icurejectrequestID, $fullcomment, $sessionID]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
        
    
    public function updaterequestbyicu($approve, $icuacceptrequestID, $sessionID, $whomaderequest){
		$q = "UPDATE cash_newrequestdb SET  `approvals`= '$approve', `dICUwhoapproved`= '$sessionID', `approvedICU`= '$whomaderequest', `dateICUapprove` = NOW(), `approvedHOD`= ''  WHERE id = '$icuacceptrequestID'";
		$this->db->query($q);
                return $icuacceptrequestID;
    }
    
    
    public function rejectedrequstbyicu($approve, $icurejectrequestID, $sessionID, $whomaderequest){
		$q = "UPDATE cash_newrequestdb SET  `approvals`= '$approve', `dICUwhorejectedrequest`= '$sessionID', `rejectedICU`= '$whomaderequest', `approvedHOD`= '', `dateRejected` = NOW()  WHERE id = '$icurejectrequestID'";
		$this->db->query($q);
                return $icurejectrequestID;
    }
        
   
     public function getuserSessionEmail($email){
        $q = "SELECT * FROM cash_usersetup WHERE email = ?";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function insertmakepayment($assetID, $paidTo, $dDate, $sessionID, $uid, $tillID, $tillType, $cashierEmail){
		$q = "INSERT into cash_accounttable (requestID, paidTo, datePaid, sessionEmail, sessionID, acc_TillID, acc_ntillType, acc_cashiersTillEmail, dateSent) VALUES(?, ?, ?, ?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$assetID, $paidTo, $dDate, $sessionID, $uid, $tillID, $tillType, $cashierEmail]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
    }
    
    
    
     public function chequesentforpayment($transactID, $paidTo, $dDate, $sessionID, $uid, $chequeNo, $type, $dBank){
		$q = "INSERT into cash_accounttable (requestID, paidTo, datePaid, sessionEmail, sessionID, chequeNo, type, Bank) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
		$insertDB = $this->db->query($q, [$transactID, $paidTo, $dDate, $sessionID, $uid, $chequeNo, $type, $dBank]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
    }
    
    public function updatewithtillname($assetID, $getTillName){
		$q = "UPDATE cash_newrequestdb SET  `ntillName`= '$getTillName' WHERE id = '$assetID'";
		$this->db->query($q);
                return $assetID;
    }       
        
   public function dcashierwhopays($assetID, $sessionID, $approve, $tillID, $tillType, $cashierEmail, $dDate, $madeprequestemail){
		 $q = "UPDATE cash_newrequestdb SET  `dCashierwhopaid`= '$sessionID', `approvals`= '$approve', `newrequest_tillID` = '$tillID', `ntillType` = '$tillType', `cashiersTillEmail` = '$cashierEmail', `datepaid` = '$dDate', `paidRequest` = '$madeprequestemail', `approvedICU` = ''   WHERE id = '$assetID'";
		$this->db->query($q);
                return $assetID;
    }   
    
    
    
     public function daccountwhopays($chequeID, $sessionID, $approve, $partAmount="", $chequeDate, $madeprequestemail=""){
	       $q = "UPDATE cash_newrequestdb SET  `dCashierwhopaid`= '$sessionID', `approvals`= '$approve', `partPay`= '$partAmount', `datepaid` = '$chequeDate', `paidRequest` = '$madeprequestemail' WHERE id = '$chequeID'";
		$this->db->query($q);
                return $chequeID;
    }   
    
    
     //Get the Category Type
    public function getdunit($id){
        $q = "SELECT * FROM cash_unit WHERE id= ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->unitName;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function emailownerrequest($id){
        $q = "SELECT id, sessionID FROM cash_newrequestdb WHERE id = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->sessionID;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
     //Get the Category Type
    public function descriptionofitem($id){
        $q = "SELECT id, sessionID, ndescriptOfitem FROM cash_newrequestdb WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->ndescriptOfitem;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
      //Get the Category Type
    public function getbenefiaciaryName($id){
        $q = "SELECT id, benName FROM cash_newrequestdb WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->benName;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function getrequestStatus($id){
        $q = "SELECT id, approvals FROM cash_newrequestdb WHERE id = ? AND nPayment = '1' || nPayment = '2'";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->approvals;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
      //Get the Category Type
    public function allicumember($id){
        $q = "SELECT id, icus FROM cash_newrequestdb WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->icus;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
       //Get the Category Type
    public function getemailoficusmembers($id){
        $q = "SELECT id, fname, lname, email FROM cash_usersetup WHERE accessLevel = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
              
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
       //Get Cashiers Result
    public function getnewrequestbycashier($email){
        //$q = "SELECT * FROM cash_newrequestdb WHERE dCashierwhopaid = ? AND cashiertillRequest = '0' || cashiertillRequest = '3'";
        //$q = "SELECT * FROM cash_newrequestdb WHERE ntillType='primary' AND dCashierwhopaid = ? || cashiertillRequest = '3' AND cashiertillRequest = '0'";
        $q = "SELECT * FROM cash_newrequestdb WHERE ntillType='primary' AND dCashierwhopaid = '$email' AND cashiertillRequest = '0' || cashiertillRequest = '3'";
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
              
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function addnewRegisteredUser($fName, $lname, $semailAddress, $hasspass, $sLocation, $sUnit, $accessLevel, $randomString){
		$q = "INSERT into cash_usersetup (`fname`, `lname`, `email`, `password`, `uLocation`, `dUnit`, `accessLevel`, `activationstring`, `dateCreated`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$fName, $lname, $semailAddress, $hasspass, $sLocation, $sUnit, $accessLevel, $randomString]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
        
     
        
            //Get Cashiers Result
    public function cashgroup($dAccountgroup){
        $q = "SELECT userid FROM cash_groupaccount WHERE gid = ?";
        
        $run_q = $this->db->query($q, [$dAccountgroup]);
        
        if($run_q->num_rows() > 0){
             foreach($run_q->result() as $get){
                return $get->userid;
            }
              
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
              //Get Cashiers Result
    public function icugroupdisplay($dicudisplay){
        $q = "SELECT userid FROM cash_groupicu WHERE icuid = '$dicudisplay'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
             foreach($run_q->result() as $get){
                return $get->userid;
            }
              
        }
        
        else{
            return FALSE;
        }
    }
    
    
       //Get the Category Type
    public function getaccountresult($id){
       //$q = "SELECT * FROM cash_newrequestdb WHERE  dAccountgroup = ? AND approvals != '4'";
       $q = "SELECT * FROM cash_newrequestdb WHERE dAccountgroup = ? AND nPayment = '2' AND dICUwhoapproved != '' AND approvals = '3' AND approvals !='4' AND dCashierwhopaid = '' ORDER BY id desc LIMIT 5000";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
        //Get the Category Type
    public function icuusercanaccessit($id){
       //$q = "SELECT * FROM cash_newrequestdb WHERE  dAccountgroup = ? AND approvals != '4'";
       $q = "SELECT * FROM cash_newrequestdb WHERE icus = ? AND approvals = '2' AND approvals !='4' ORDER BY id DESC";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function dcashiersdetailsfromsuperaccount($email){
        $q = "SELECT * FROM cash_newrequestdb WHERE dCashierwhopaid = ? ORDER BY id DESC LIMIT 3000";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
   
   public function getallgroups(){
        $q = "SELECT * FROM cash_groupaccount";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function getallrequeastforreimbursement($dEmail){
        $q = "SELECT * FROM cash_newrequestdb WHERE cashiers = ? AND cashiertillRequest ='1' || cashiertillRequest ='2'  || cashiertillRequest ='3'";
        
        $run_q = $this->db->query($q, [$dEmail]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    /*
     *public function insertAdvanceRequest($dateCreated, $dCurrencyType, $userGenCode, $descItem, $benName, $dUnit, $paymentType, $dComment, $dhod, $dicu, $dcashier="", $daccountant="", $sessionID, $approvals, $uLocation, $fullname, $sessionEmail){
		$q = "INSERT into cash_newrequestdb (dateCreated, CurrencyType, userCode, ndescriptOfitem, benName, dUnit, nPayment, requesterComment,  hod, icus, cashiers, dAccountgroup, sessionID, approvals, dLocation, fullname, pendingHOD, dateRegistered) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$dateCreated,  $dCurrencyType, $userGenCode, $descItem, $benName, $dUnit, $paymentType, $dComment, $dhod, $dicu, $dcashier, $daccountant, $sessionID, $approvals, $uLocation, $fullname, $sessionEmail]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
    }
     */
    public function insertAdvanceRequest($dateCreated, $dCurrencyType, $userGenCode, $descItem, $benName, $dUnit, $paymentType, $dComment, $dhod, $dicu, $dcashier="", $daccountant="", $sessionID, $approvals, $uLocation, $fullname, $sessionEmail){
		$q = "INSERT into cash_newrequestdb (`dateCreated`, `CurrencyType`, `userCode`, `ndescriptOfitem`, `benName`, `dUnit`, `nPayment`, `requesterComment`,  `hod`, `icus`, `cashiers`, `dAccountgroup`, `sessionID`, `approvals`, `dLocation`, `fullname`, `pendingHOD`, `dateRegistered`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, ["$dateCreated", "$dCurrencyType", "$userGenCode", "$descItem", "$benName", "$dUnit", "$paymentType", "$dComment", "$dhod", "$dicu", "$dcashier", "$daccountant", "$sessionID", "$approvals", "$uLocation", "$fullname", "$sessionEmail"]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
    }
    
    
    
    public function expensedetailsfromdb($exLocation, $exPayee, $exDetailofpayment, $exAmount, $exCode, $exDate, $insertedFileId){
   //public function expensedetailsfromdb($exLocation[$i], $exPayee[$i], $exDetailofpayment[$i], $exAmount[$i], $exCode[$i], $exDate[$i], $insertedFileId){
		$q = "INSERT into cash_newrequest_expensedetails (ex_Location, ex_Payee, ex_Details, ex_Amount,  ex_Code, ex_Date, requestID) VALUES(?, ?, ?, ?, ?, ?, ?)";
		$insertDB = $this->db->query($q, [$exLocation, $exPayee, $exDetailofpayment, $exAmount, $exCode, $exDate, $insertedFileId]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			//return $insertId;
                        return $insertedFileId;
		} else {
			
			return FALSE;	
		}
		
    }
    
 
    
 public function expensedetailsfromdbadvancerequest($data){
        if ( $this->db->insert('cash_newrequest_expensedetails', $data) ){
            return true;
        }
        return false; 
    }
  
    
    
 public function inserfileupload($origFilename, $newFilename, $ext, $mimeType){
		$q = "INSERT into cash_fileupload (origFilename, newFilename, ext, mimeType) VALUES(?, ?, ?, ?)";
		$insertDB = $this->db->query($q, [$origFilename, $newFilename, $ext, $mimeType]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			//return $insertId;
                        return $insertId;
		} else {
			
			return FALSE;	
		}
		
    }
    
    
  ////////////////////////////////////////////////TRANSACT STATMENT IN CODEIGNITER//////////////////////////////////////
    
    
    private $file = 'cash_fileupload';   // files    
    
    function save_files_info($files, $insertedFileId) {
        //start db traction
        $this->db->trans_start();
        //file data
        $file_data = array();
        foreach ($files as $file) {
            $file_data[] = array(
                'newFilename' => $file['file_name'],
                'origFilename' => $file['orig_name'],
                'ext' => $file['file_type'],
                'mimeType' => $file['file_ext'],
                'f_requestID'=> $insertedFileId,
                'dateUploaded' => date('Y-m-d H:i:s')
            );
        }
        
         $this->db->insert_batch($this->file, $file_data);
        //complete the transaction
        $this->db->trans_complete();
        //check transaction status
        if ($this->db->trans_status() === FALSE) {
            foreach ($files as $file) {
                $file_path = $file['full_path'];
                //delete the file from destination
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            
            //rollback transaction
            $this->db->trans_rollback();
            return FALSE;
        } else {
            //commit the transaction
            $this->db->trans_commit();
            return TRUE;
        }
    }
    
////////////////////////////////////////////////END OF TRANSACT STATING IN CODEIGNITER//////////////////////////////////
    
    
     public function addnewfile($newFilename, $origFilename, $ext, $mimeType, $f_requestID){
		$q = "INSERT into cash_fileupload (`newFilename`, `origFilename`, `ext`, `mimeType`, `f_requestID`, `dateUploaded`) VALUES(?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$newFilename, $origFilename, $ext, $mimeType, $f_requestID]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
    
        
 
    public function updateTotalAmount($sumall, $insertedFileId){
		$q = "UPDATE cash_newrequestdb SET  `dAmount`= '$sumall' WHERE id = '$insertedFileId'";
		$this->db->query($q);
                return $insertedFileId;
    }
    
    
    
  //RETURN THE USER LIMIT FROM THE ICU LIMIT TABLE
     //Get the Category Type
    public function geticulimitofuser($getUserID, $groupIDinICU){
        $q = "SELECT * FROM individual_icu_limit WHERE icu_userID= ? AND dGroupID = ?";
        
        $run_q = $this->db->query($q, [$getUserID, $groupIDinICU]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->limitAmount;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
   
    
    //GET ALL THE RESULT WHERE THE ICU WHO APPROVED
          //Get the Category Type
    public function getallicurequestandapprovedbyme($email){
       //$q = "SELECT * FROM cash_newrequestdb WHERE  dAccountgroup = ? AND approvals != '4'";
       $q = "SELECT * FROM cash_newrequestdb WHERE dICUwhoapproved = ? ORDER BY id DESC LIMIT 1000";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //GET ALL THE RESULT WHERE THE ICU WHO APPROVED
          //Get the Category Type
    public function getallicurequestawaitingorapproved(){
       //$q = "SELECT * FROM cash_newrequestdb WHERE  dAccountgroup = ? AND approvals != '4'";
       $q = "SELECT * FROM cash_newrequestdb WHERE dICUwhoapproved != '' || dICUwhorejectedrequest != '' ORDER BY id DESC LIMIT 20000";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
  //Get the Category Type
    public function getdTillname($sessionID){
        $q = "SELECT tillName FROM tillbalances WHERE cashierEmail = ? AND tillType = 'primary'";
        
        $run_q = $this->db->query($q, [$sessionID]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->tillName;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
       //Get Cashiers Result
    public function getnewrequestbycashiersecondary($email){
       // $q = "SELECT * FROM cash_newrequestdb WHERE ntillType='secondary' AND cashiertillRequest = '0' || cashiertillRequest = '3' AND dCashierwhopaid = ?";
        $q = "SELECT * FROM cash_newrequestdb WHERE ntillType='secondary' AND cashiertillRequest IN ('0', '3') AND dCashierwhopaid = ?";
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
              
        }
        
        else{
            return FALSE;
        }
    } 
    
    
    
    //Get the Category Type
    public function getdTillnameforsecondary($sessionID){
        $q = "SELECT tillName FROM tillbalances WHERE cashierEmail = ? AND tillType = 'secondary'";
        
        $run_q = $this->db->query($q, [$sessionID]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->tillName;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     //Get the Category Type
    public function getallchequeforsignature(){
        $q = "SELECT * FROM account_payable WHERE approval = '0' AND bankStatement = 'no' AND tillName !='' ORDER BY id DESC LIMIT 5000";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
             
        }
        
        else{
            return FALSE;
        }
    }
    
    
      //Get the Category Type
    public function getallresultwithingroup($group){
        $q = "SELECT * FROM account_payable WHERE approval = '0' AND bankStatement = 'no' AND icuhaseen = 'yes' AND accountGroup = '$group' ORDER BY id DESC LIMIT 5000";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
             
        }
        
        else{
            return FALSE;
        }
    }
    
  
    
    public function approvedrequestbyhod($email){
        $q = "SELECT * FROM cash_newrequestdb WHERE hod = ? ORDER BY id DESC LIMIT 2000";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function getallrequestfrommyprimaytill($email){
        $q = "SELECT * FROM cash_newrequestdb WHERE dCashierwhopaid = ? AND ntillType = 'primary' ORDER BY id DESC LIMIT 4000";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function getallrequestfrommysecondarytill($email){
        $q = "SELECT * FROM cash_newrequestdb WHERE dCashierwhopaid = ? AND ntillType = 'secondary' ORDER BY id DESC LIMIT 4000";
        
        $run_q = $this->db->query($q, [$email]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function disablehide($disabled, $approval, $hideID){
		$q = "UPDATE cash_newrequestdb SET  `refID_edited`= '$disabled', `approvals`= '$approval' WHERE id = '$hideID'";
		$this->db->query($q);
                return TRUE;
    }
    
    
       public function updatenewrequest($hideID, $insertedFileId){
		$q = "UPDATE cash_newrequestdb SET  `refID_image`= '$hideID', `refID_edited`= '$hideID' WHERE id = '$insertedFileId'";
		$this->db->query($q);
                return TRUE;
    }
  
    
     public function getallaccounts(){
        $q = "SELECT * FROM codeact";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
  
      public function thecashierwhoapprovebyadmin(){
        $q = "SELECT * FROM cash_newrequestdb WHERE dCashierwhopaid != '' ORDER BY id DESC LIMIT 2000";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    public function thecashierwhoapprove($sessionemail){
        $q = "SELECT * FROM cash_newrequestdb WHERE dCashierwhopaid = ? ORDER BY id DESC LIMIT 2000";
        
        $run_q = $this->db->query($q, [$sessionemail]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function nameCode($codeName){
        $q = "SELECT * FROM codeact WHERE codeNumber = ? ";
        
        $run_q = $this->db->query($q, [$codeName]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->codeName;
            }
              
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function getdBank($id){
        $q = "SELECT * FROM cash_accounttable WHERE requestID = ? ";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->Bank;
            }
              
        }
        
        else{
            return FALSE;
        }
    }
    
     public function chequeNocashier($id){
        $q = "SELECT * FROM cash_accounttable WHERE requestID = ? ";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->accountNobyCashier;
            }
              
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function getChequeNofromacct($id){
        $q = "SELECT * FROM cash_accounttable WHERE requestID = ? ";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->chequeNo;
            }
              
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function getCodefromexpense($id){
        $q = "SELECT * FROM cash_newrequest_expensedetails WHERE requestID = ? ";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
             return $run_q->result();
              
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
      public function getallcheques(){
       $q = "SELECT * FROM account_payable WHERE type = 'cheque'  ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function updateothertable($transactID, $chequeDate, $sessionID){
		$q = "UPDATE cash_newrequest_expensedetails SET `datepaid`= '$chequeDate', `sess` = '$sessionID', `approved` = 'yes', `approved_status` = '1'  WHERE requestID = '$transactID'";
		$this->db->query($q);
                return TRUE;
    }
    
    
    
    public function getcashierandaccount($icuacceptrequestID){
       $q = "SELECT cashiers, dAccountgroup FROM cash_newrequestdb WHERE id = ? ";
        
        $run_q = $this->db->query($q, [$icuacceptrequestID]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function dactivator($id, $activationCode){
       $q = "SELECT * FROM cash_usersetup WHERE id = ? AND activationstring = ?";
        
        $run_q = $this->db->query($q, [$id, $activationCode]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $result){
		$emailadds = $result->email; 
                }
		return $emailadds;
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
       public function myactivationishere($activateAccount, $changetoone){
		$q = "UPDATE cash_usersetup SET `activation`= '$changetoone' WHERE email = '$activateAccount'";
		$this->db->query($q);
                return TRUE;
    }
    
    
  public function getfromthechequesignaturerequest($id){
        $q = "SELECT * FROM cash_accounttable WHERE id = ? ORDER BY id DESC";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function getallchequeswithzeroapproval($generateStatement, $getUserLocation){
       //$q = "SELECT * FROM account_payable WHERE dBank = '$generateStatement' AND userEmail = '$sEmail' AND bankStatement = 'no' ORDER BY id DESC";
       $q = "SELECT * FROM account_payable WHERE `Location` ='$getUserLocation' AND dBank = '$generateStatement' AND bankStatement = 'no' ORDER BY id DESC";
         
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function getchequerequestbycashier($sEmail){
       $q = "SELECT * FROM account_payable WHERE paidTo = '$sEmail' ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
	
    
    
      public function getfrequestid($sEmail, $id){
       $q = "SELECT fmrequestID FROM account_payable WHERE paidTo = '$sEmail' AND id= '$id' ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
              foreach($run_q->result() as $get){
                return $get->fmrequestID;
            }
        }
        
        else{
            return FALSE;
        }
    }
	
    
    
    public function getdreimbursement($ids){
        //$q = "SELECT * FROM cash_newrequestdb WHERE id = ? cashiertillRequest ='1' || cashiertillRequest ='2'  || cashiertillRequest ='3'";
        $q = "SELECT * FROM cash_newrequestdb WHERE id = ?";
        
        $run_q = $this->db->query($q, [$ids]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function getidresultfromchequedb($id){
        $q = "SELECT * FROM  account_payable WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
   public function getdetailsofcheque($id, $approval, $group){
        $q = "SELECT * FROM cash_newrequestdb WHERE id = ? AND approvals = ? AND dAccountgroup = ? ORDER BY id DESC";
        
        $run_q = $this->db->query($q, [$id, $approval, $group]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    } 
   
    
    
     public function dopartpayment($chequeID, $randomNumpartPay, $partialPayAmount, $dUserID, $getBank, $chequeNo="", $sessionID){
		$q = "INSERT into partPayment (newcash_ID, mdfive, partAmount, userRequestID, newBank, chequeNonew, paidBy, datepaid) VALUES(?, ?, ?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$chequeID, $randomNumpartPay, $partialPayAmount, $dUserID, $getBank, $chequeNo, $sessionID]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
    } 
    
    
      public function allpartpay($sessionID){
        $q = "SELECT * FROM cash_newrequestdb WHERE partPay != '' AND dCashierwhopaid = '$sessionID' LIMIT 20";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function allpartpayforadmin(){
        $q = "SELECT * FROM cash_newrequestdb WHERE partPay != dAmount AND partPay NOT IN ('0.00') AND nPayment = '2' ";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function getpartpaydetails($id, $amount, $email){
        $q = "SELECT * FROM account_payable WHERE fmrequestID = ? AND Amount = ? AND paidByAcct = ? ORDER BY id DESC";
        
        $run_q = $this->db->query($q, [$id, $amount, $email]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    } 
    
    
    public function newrequestpaytable($requestID, $newBalance="", $dUserID="", $newBank="", $newChequeNo="", $sessionEmail="", $newAmountopay="", $rand=""){
        $this->db->trans_begin();
          
        $this->db->query("UPDATE cash_newrequestdb SET partPay='$newBalance' WHERE id='$requestID'");
        $this->db->query("UPDATE account_payable SET partpayAmount='$newBalance' WHERE fmrequestID ='$requestID'");
        $this->db->query("INSERT into partPayment (newcash_ID, partAmount, userRequestID, newBank, chequeNonew, paidBy, mdfive, datepaid) VALUES(".$requestID.", ".$newAmountopay.", ".$dUserID.", '".$newBank."', '".$newChequeNo."' , '".$sessionEmail."', '".$rand."',  NOW())");

        if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
        }else{
                $this->db->trans_commit();
        }
    }
    
    
     public function getnewreaultforallview($id, $approval){
        $q = "SELECT * FROM cash_newrequestdb WHERE id = ? AND approvals = ? LIMIT 1";
        
        $run_q = $this->db->query($q, [$id, $approval]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function getpaymentresultoraccountpayable($fmrequestID){
        $q = "SELECT * FROM account_payable WHERE fmrequestID = ? LIMIT 1";
        
        $run_q = $this->db->query($q, [$fmrequestID]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function getpaypaymentfromdb($id){
        $q = "SELECT * FROM partPayment WHERE newcash_ID = ? ";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     //Get the Category Type
    public function returnformrequest($id){
        $q = "SELECT approvals FROM cash_newrequestdb WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->approvals;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function getallresultbutanarray($id){
        $q = "SELECT * FROM cash_newrequestdb WHERE id = ? AND dCashierwhopaid = '' ORDER BY id ASC";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result_array();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
     //Get the Category Type
    public function getbenName($benName){
        $q = "SELECT * FROM cash_newrequestdb WHERE benName= ?";
        
        $run_q = $this->db->query($q, [$benName]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->benName;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    public function updaterequestbyhodbyadmin($approve, $dComment, $acceptrequestID, $sessionID){
		$q = "UPDATE cash_newrequestdb SET  `approvals`= '$approve', `addComment`= '$dComment', `hodadmin` = '$sessionID' WHERE id = '$acceptrequestID'";
		$this->db->query($q);
                return $acceptrequestID;
	}
        
        
        
      public function emptyuserCode($rejectrequestID, $userCode){
		$q = "UPDATE cash_newrequestdb SET  `userCode`= '$userCode' WHERE id = '$rejectrequestID'";
		$this->db->query($q);
                return $rejectrequestID;
	}
        
  
        
     public function checkCode($userCode, $assetID){
        $q = "SELECT userCode FROM  cash_newrequestdb WHERE userCode = ? AND id= ?";
        
        $run_q = $this->db->query($q, [$userCode, $assetID]);
        
        if($run_q->num_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }
        
    
  
    //Get HOD / ICU Comment
    public function dhodcomment($id){
        $q = "SELECT sessionID FROM cash_approvalreques WHERE newrequesID = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
             foreach($run_q->result() as $get){
                return $get->sessionID;
            }
              
        }
        
        else{
            return "";
        }
    }  
    
    
    
    //Get HOD / ICU Comment
    public function dicucomment($id){
        $q = "SELECT comment FROM cash_approvalreques WHERE newrequesID = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
             foreach($run_q->result() as $get){
                return $get->comment;
            }
              
        }
        
        else{
            return "";
        }
    }  
    
    
    
    //Get HOD / ICU Comment
    public function getallcommentresult($id){
        $q = "SELECT * FROM cash_approvalreques WHERE newrequesID = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
             return $run_q->result();
              
        }
        
        else{
            return "";
        }
    }  
    
    
    
    /***** This controller returns all users ******/
	 public function getalltitles(){
        $q = "SELECT * FROM  titles ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
       if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    /***** This controller returns all users ******/
	 public function checkfortitle($title){
        $q = "SELECT * FROM  titles WHERE titleName = ?";
        
        $run_q = $this->db->query($q, [$title]);
        
        if($run_q->num_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    // function insert Menu into the database
	public function insertintotitles($dtitle, $SessionName){
		$q = "INSERT into titles (titleName, sessionID) VALUES(?, ?)";
		$insertDB = $this->db->query($q, [$dtitle, $SessionName]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
        
        
        
         //Get HOD / ICU Comment
    public function getoldImages($id){
        $q = "SELECT refID_image FROM cash_newrequestdb WHERE id = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
             foreach($run_q->result() as $get){
                return $get->refID_image;
            }
              
        }
        
        else{
            return "";
        }
    }  
        
    
    
    
         //Get the Category Type
    public function getresultbyID($value){
        $q = "SELECT COUNT(requestID) AS 'actID', `ex_Amount`, SUM(ex_Amount) AS 'Total', ex_Code as dCode FROM cash_newrequest_expensedetails WHERE requestID ='$value' GROUP BY ex_Code";

        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
    //Get the Category Type
    public function getdgroupaccount($id){
        $q = "SELECT * FROM cash_groupaccount WHERE gid= ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->accountgroupName;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function updatemdfiveid($md5ID, $createdby, $insertedFileId){
		$q = "UPDATE cash_newrequestdb SET  `md5_id`= '$md5ID', `auditTrail`='$createdby' WHERE id = '$insertedFileId'";
		$this->db->query($q);
                return $insertedFileId;
    }   
    
    
    public function closedresult($id){
        $q = "SELECT * FROM cash_newrequestdb WHERE id = ? AND refID_edited = 'disabed' ORDER BY id DESC";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    public function getdexactresultfromdbwaitingapproval($id, $mdID){
        $q = "SELECT * FROM cash_newrequestdb WHERE id = '$id' AND md5_id = '$mdID' AND refID_edited !='disabed'  ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function getdexactresultfromdbrejectedrequest($id){
        $q = "SELECT * FROM cash_newrequestdb WHERE id = ? AND approvals = '5' || approvals = '6' || approvals = '12' ORDER BY id DESC";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function changemycashier($id, $mdID, $sessionID){
        $q = "SELECT id, ndescriptOfitem, cashiers, icus, sessionID, approvals, nPayment, dAmount, dLocation, dUnit FROM cash_newrequestdb WHERE id = '$id' AND md5_id = '$mdID' AND sessionID = '$sessionID' AND approvals IN ('2', '3')";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
  
    
     //Get the Category Type
    public function getuserapprovaldetails($postID, $sessionID){
        $q = "SELECT approvals FROM cash_newrequestdb WHERE id= ? AND sessionID = ? AND approvals = '1' || approvals = '2'";
        
        $run_q = $this->db->query($q, [$postID, $sessionID]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->approvals;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    public function changemyrequestderails($changemyicu, $changemycashier, $postID, $sessionID){
		$q = "UPDATE cash_newrequestdb SET  `icus`= '$changemyicu', `cashiers` = '$changemycashier'  WHERE id = '$postID' AND sessionID = '$sessionID'";
		$this->db->query($q);
                return $changemycashier;
    }   
    
    
    
     
    public function getmytilldetailsall($id, $tillName, $cashierID, $cashierEmail){
        $q = "SELECT * FROM tillbalances WHERE id = ? AND tillName = ? AND cahsierTillID = ? AND cashierEmail = ? ";
        
        $run_q = $this->db->query($q, [$id, $tillName, $cashierID, $cashierEmail]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    /***** This controller returns all users ******/
	public function getallactivateduser(){
        $q = "SELECT * FROM cash_usersetup WHERE activation = '1'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
      //Get HOD / ICU Comment
    public function generalcomment($id){
        $q = "SELECT comment FROM cash_approvalreques WHERE newrequesID = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
             foreach($run_q->result() as $get){
                return $get->comment;
            }
              
        }
        
        else{
            return "";
        }
    }  
    
    
    
    public function editrejectedrequest($id, $mdid, $approvals){
        $q = "SELECT * FROM cash_newrequestdb WHERE id = '$id' AND md5_id ='$mdid' AND approvals = '$approvals' ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function thecashierwhoistopay($email){
        $q = "SELECT * FROM cash_newrequestdb WHERE cashiers ='$email' ORDER BY id DESC LIMIT 2000";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function addtoaccountpayable($type, $acctGroup, $getTillName, $myurl, $getUserLocation, $getUserUnit, $appID, $transactID, $makedpaymebnt, $dUserID, $mainAount, $approval, $requesterEmail, $payee, $sessionID, $chequeNo, $getBank, $partAmount="", $chequeDate){
		$q = "INSERT into account_payable (type, accountGroup, tillName, app_urL, Location, unit, app_ID, fmrequestID, accountPayableID, userID, Amount, approval, requesterEmail, paidTo, paidByAcct, chequeNo, dBank, partpayAmount, dateSent, datePaid) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
		$insertDB = $this->db->query($q, [$type, $acctGroup, $getTillName, $myurl, $getUserLocation, $getUserUnit, $appID, $transactID, $makedpaymebnt, $dUserID, $mainAount, $approval, $requesterEmail, $payee, $sessionID, $chequeNo, $getBank, $partAmount, $chequeDate]);
		
		if($this->db->affected_rows($insertDB) > 0){
			$insertId = $this->db->insert_id();
			
			return $insertId;
		} else {
			
			return FALSE;	
		}
		
	}
        
        
         //Get the Category Type
    public function getpaymentnow($dAccountgroup){
       //$q = "SELECT * FROM cash_newrequestdb WHERE  dAccountgroup = ? AND approvals != '4'";
       $q = "SELECT * FROM cash_newrequestdb  WHERE dICUwhoapproved != '' AND dAccountgroup = '$dAccountgroup' AND approvals = '3' AND nPayment ='2'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
      //Get the Category Type
    public function allchequesforprintout($id){
       //$q = "SELECT * FROM cash_newrequestdb WHERE  dAccountgroup = ? AND approvals != '4'";
       $q = "SELECT * FROM cash_newrequestdb WHERE dAccountgroup = ? AND nPayment = '2' AND dCashierwhopaid !='' ORDER BY id desc LIMIT 5000";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function getpaidto($id){
        $q = "SELECT paidTo FROM cash_accounttable WHERE requestID = ? ";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->paidTo;
            }
              
        }
        
        else{
            return FALSE;
        }
    }
  
    
          //Get the Category Type
    public function mycodevalue($value){
        $q = "SELECT * FROM cash_newrequest_expensedetails WHERE requestID IN ($value)";
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
      public function getmyreim($id){
       $q = "SELECT fmrequestID FROM account_payable WHERE id= '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
              foreach($run_q->result() as $get){
                return $get->fmrequestID;
            }
        }
        
        else{
            return FALSE;
        }
    }
	
    
     //Get the Category Type
    public function getmdfive($id){
        $q = "SELECT id, md5_id FROM cash_newrequestdb WHERE id = '$id'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->md5_id;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    public function updatedupdatetrail($updateApprove, $createdby, $acceptrequestID){
		$q = "UPDATE cash_newrequestdb SET  `auditTrail`= CASE WHEN auditTrail = '' THEN '$updateApprove' ELSE CONCAT(`auditTrail`, '$createdby') END WHERE id = '$acceptrequestID'";
		$this->db->query($q);
                return $acceptrequestID;
	}
    
        
     public function updatemanualdate($addTotal, $chequeManualDate){
		$q = "UPDATE account_payable SET  `manualCheckDate`= '$chequeManualDate' WHERE id = '$addTotal'";
		$this->db->query($q);
                return $addTotal;
	}
    
        
  public function getpartpaydetailstoview($id){
        $q = "SELECT * FROM partPayment WHERE newcash_ID = ?";
        
        $run_q = $this->db->query($q, [$id]);
        
        if($run_q->num_rows() > 0){
            return $run_q->result_array();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function allaprtpaymentdetails($id, $amount){
        $q = "SELECT * FROM cash_newrequestdb WHERE id = $id AND dAmount = $amount AND dCashierwhopaid != '' AND partPay != $amount AND partPay NOT IN ('')";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    } 
    
    
    
     public function partpayforotherlocation($location){
        $q = "SELECT * FROM cash_newrequestdb WHERE partPay != dAmount AND partPay NOT IN ('') AND nPayment = '2' AND dLocation ='$location' ";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
        //Get Cashiers Result
    public function cashierstillwithtype($email, $tillname){
        //$q = "SELECT * FROM cash_newrequestdb WHERE dCashierwhopaid = ? AND cashiertillRequest = '0' || cashiertillRequest = '3'";
        //$q = "SELECT * FROM cash_newrequestdb WHERE ntillType='primary' AND dCashierwhopaid = ? || cashiertillRequest = '3' AND cashiertillRequest = '0'";
        $q = "SELECT * FROM cash_newrequestdb WHERE ntillName='$tillname' AND ntillType='primary' AND dCashierwhopaid = '$email' AND cashiertillRequest IN ('0', '3')";
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
              
        }
        
        else{
            return FALSE;
        }
    }
    
    
      public function procutabledetailsprocu($get) {
        $db6 = $this->load->database('ciprocuredb', TRUE);
       echo $q = "SELECT * from INFORMATION_SCHEMA.COLUMNS WHERE `TABLE_NAME`='$get'"; 
      
       $run_q = $db6->query($q);
      
        if ($run_q->num_rows() > 0) {
            return $run_q->result('array');
        } else {
            return FALSE;
        }
    }
    
    
    public function procudrop($get) {
      
       $this->db6 = $this->load->database('ciprocuredb', TRUE);
        
       $query = "DROP TABLE `$get`"; 
      
       $run_q = $this->db6->query($query);
       return TRUE;
       
    }
    
    
    
     public function expensedrop($get) {
      
       $query = "DROP TABLE `$get`"; 
      
       $run_q = $this->db->query($query);
       return TRUE;
       
    }
    
    
    
    public function updatebymd($approve, $acceptrequestID, $sessionID){
		$q = "UPDATE cash_newrequestdb SET  `approvals`= '$approve', `mgtapproved` = '$sessionID'  WHERE id = '$acceptrequestID'";
		$this->db->query($q);
                return $acceptrequestID;
	}
        
        
      //Get the Amount from the lang Checkbox
    public function getallresultbysql($sql){
        $q = "SELECT * FROM cash_newrequestdb WHERE $sql";
        //$q = "SELECT * FROM cash_newrequestdb WHERE signature = '$sessionEmail' ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
      //Get the Amount from the lang Checkbox
    public function allresultlimit(){
        $q = "SELECT * FROM cash_newrequestdb ORDER BY id DESC LIMIT 50";
        //$q = "SELECT * FROM cash_newrequestdb WHERE signature = '$sessionEmail' ORDER BY id DESC";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
        
   
  
   public function updateconvertedcurrency($chequeID, $CurrencyAmount, $converstionRate){
		echo $q = "UPDATE cash_newrequestdb SET  `convertedAmount`= '$CurrencyAmount', `convertion_rate`= '$converstionRate' WHERE id = '$chequeID'";
		$this->db->query($q);
                return $chequeID;
    }   
    
    
    
    
    public function requestaddinfo($approve, $icurejectrequestID, $commentfromicu, $sessionID){
		$q = "UPDATE cash_newrequestdb SET  `approvals`= '$approve',  `addComment`= '$commentfromicu', `returned_by`='$sessionID'  WHERE id = '$icurejectrequestID'";
		$this->db->query($q);
                return $icurejectrequestID;
    }
    
    
    
} // End of Class Prediction extends CI_Model