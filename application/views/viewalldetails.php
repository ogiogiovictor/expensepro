
	<div class="wrapper">
	    <div class="sidebar" data-color="blue" data-image="<?php echo base_url(); ?>assets/img/sidebar-1.jpg">

			<!--
		        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

		        Tip 2: you can also add an image using data-image tag
		    -->

			<?php echo $sidebar; ?>
                    
		</div>

	    <div class="main-panel">
			
                <!-- Navigation Begins Here -->
                    <?php echo $menu; ?>
                 <!-- Navigation Ends Here -->
                
                
                
            <!-- Main Outer Content Begins Here --> 
	        <div class="content">
	            <div class="container-fluid">
	                <div class="row">
                                
                         <!-- Beginning of Request Details with Status -->
                         
                         <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">REQUEST DETAILS</h4>
	                                <p class="category">Status of Request
                                            &nbsp;&nbsp;&nbsp;
                                            <?php 
                                            $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
                                            if($getApprovalLevel == 7 ||  $getApprovalLevel == 6 || $getApprovalLevel == 8){
                                            echo "<a href=".base_url()."home><span class='btn-xs btn-warning'>Back</span></a>";
                                            }else{
                                                echo "";
                                            }
                                            ?>
                                        </p>
	                            </div>
								
                                    <p id="errorme"></p>			
	                            <div class="card-content table-responsive">
                                        
                                        <?php
                                            if($getChequeresult){
                                                
                                                foreach($getChequeresult as $get){
                                                $id = $get->id;
						$dateCreated = $get->dateCreated;
						$ndescriptOfitem = $get->ndescriptOfitem;
						$nPayment = $this->mainlocation->getpaymentType($get->nPayment);
						$approvals = $get->approvals;
						$hod = $get->hod;
						$icus = $get->icus;
						$cashiers = $get->cashiers;
						$sessionID = $get->sessionID;
						$dateRegistered = $get->dateRegistered;
                                                $dAmount= $get->dAmount;
                                                $refID_edited= $get->refID_edited;
						$partPay = $get->partPay;
                                                $dICUwhoapproved = $get->dICUwhoapproved;
                                                $dCashierwhopaid = $get->dCashierwhopaid;
                                                $dICUwhorejectedrequest = $get->dICUwhorejectedrequest;
                                                $fullname = $get->fullname;
                                                $benName = $get->benName;
                                                $cashiertillRequest = $get->cashiertillRequest;
                                                $ntillType = $get->ntillType;
                                                $refID_edited = $get->refID_edited;
                                                $requesterComment = $get->requesterComment;
                                                $dUnit = $get->dUnit;
                                                $dLocation = $get->dLocation;
                                                $auditTrail = $get->auditTrail;
                                                $userCode = $get->userCode;
                                                $whichapp = $get->from_app_id;
                                                $apprequestID = $get->apprequestID;
                                                
                                                if($whichapp == '3'){
                                                    $vendor = $this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "USER_ID", $benName);
                                                    }else if($whichapp == '0' && is_numeric($benName)){
                                                          $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($whichapp == '0' && !is_numeric($benName)){
                                                         $vendor =  $benName;
                                                    }else if($whichapp == '5'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($whichapp == '6'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($whichapp == '8'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else{
                                                        $vendor =  $benName;
                                                    }
                                    
                                                if($partPay != ""){
                                                $balance = $dAmount - $partPay;
                                                }else{
                                                $balance = $dAmount - $dAmount; 
                                                }
                                                
                                                if($partPay =="" && $approvals == 7 || $approvals == 8 || $approvals == 4){
                                                    $partPay = $dAmount;
                                                }
                                                
                                                $approvals = $this->generalmd->getsinglecolumn("name", "approval_type", "approval_type",  $approvals);
                                                  
                                               
                                                }
                                            }

                                        ?>
	                               
                                         <center><h3>REQUEST DETAILS</h3></center>
                                         <div style="padding:30px">
                                            <table class="table table-bordered" border="1px" cellspacing="2px">
                                                <tr>
                                                    <td><b>Request Title</b></td><td><?php echo $ndescriptOfitem; ?></td>
                                                    <td><b>Request ID</b></td><td><?php echo $id; ?></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td><b>Prepared By</b></td><td><?php echo $fullname; ?></td>
                                                    <td><b>Created Date</b></td><td><?php echo $dateCreated; ?></td>
                                                </tr>
                                                
                                                 <tr>
                                                    <td><b>Status</b></td><td><?php echo $approvals; ?></td>
                                                    <td><b>Approvals</b></td>
                                                    <td style="width:300px"><?php echo $hod; ?>,<br/>
                                                    <?php echo $dICUwhoapproved; ?>,
                                                    <?php echo $dCashierwhopaid; ?>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td><b>Payee</b></td><td><?php echo $vendor; ?></td>
                                                    <td><b>Comment</b></td><td><?php echo $requesterComment; ?></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td><b>Location</b></td><td><?php echo $this->mainlocation->getdLocation($dLocation); ?></td>
                                                    <td><b>Department</b></td><td><?php echo $this->mainlocation->getdunit($dUnit); ?></td>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <td><b>Comment By</b></td><td><?php echo @$this->mainlocation->dhodcomment($id); ?></td>
                                                    <td><b>Comment</b></td><td><?php echo @$this->mainlocation->dicucomment($id); ?></td>
                                                </tr>
                                                
                                            </table>
                                         </div>
                                         
                                         
                                        
                                           <div class="col-md-12">
                                               <center><h4>EXPENSE DETAILS</h4></center>
                                         </div>
                                         
                                         <div class="col-md-12">
                                            <?php
                                           $getexpensedetails = $this->adminmodel->getexpenseresultdetails($id);
                                           if ($getexpensedetails) {
                                                          echo "<div class='card-content table-responsive'><table class='table table-responsive table-hover table-striped table-bordered'>"
                                                          . "<tr><td><b>Details</b></td><td><b>Accout Code</b></td><td><b>Amount</b></td><td><b>Date</b></td></tr>";
                                                          foreach ($getexpensedetails as $extdetals) {
                                                              $exid = $extdetals->exid;
                                                              $requestID = $extdetals->requestID;
                                                              $ex_Details = $extdetals->ex_Details;
                                                              $ex_Amount = $extdetals->ex_Amount;
                                                              $ex_Code = $extdetals->ex_Code;
                                                              $ex_Date = $extdetals->ex_Date;

                                                              $getCodeName = $this->mainlocation->nameCode($ex_Code);

                                                              echo "<tr><td>$ex_Details</td><td>$ex_Code  $getCodeName</td><td>".@number_format($ex_Amount)."</td><td>$ex_Date</td></tr>";
                                                          }
                                                          echo "</table></div>";
                                                      }
                                           ?>
                                         </div>
                                         
                                         <div class="col-md-12">
                                             <?php
                                             $dateSent = ""; $dBank= ""; $type= ""; $bankStatement= ""; $chequeNo ="";
                                             $paidByAcct = ""; $Amount ="";  $partpayAmount =""; $acBalance ="";
                                             $vat = ""; $witholdtax = "";
                                             $getfulldetails = $this->mainlocation->getpaymentresultoraccountpayable($id);
                                             if($getfulldetails){
                                                 foreach($getfulldetails as $get){
                                                     $nid = $get->id;
                                                     $Amount = $get->Amount;
                                                     $partpayAmount = $get->partpayAmount;
                                                     $paidByAcct = $get->paidByAcct;
                                                     $fmrequestID = $get->fmrequestID;
                                                     $userID = $get->userID;
                                                     $app_urL = $get->app_urL;
                                                     $dateSent = $get->dateSent;
                                                     $chequeNo = $get->chequeNo;
                                                     $dBank = $get->dBank;
                                                     $type = $get->type;
                                                     $vat = $get->vat;
                                                     $witholdtax = $get->witholdtax;
                                                     $bankStatement = $get->bankStatement;
                                                     if($partpayAmount == "" || $partpayAmount ==0){
                                                     $acBalance = 0;
                                                     }else{
                                                      $acBalance = $Amount - $partpayAmount;
                                                     }
                                                 }
                                                 
                                             }
                                             ?>
                                         </div>
                                           
                                         <?php
                                            if($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 8 ){
                                                
                                               echo "<center><h4>ACCOUNT USE ONLY</h4></center><div style='padding:30px'><table class='table table-bordered'>
                                                   <tr><td><b>Bank</b></td><td>$dBank</td><td><b>Cheque No</b></td><td>$chequeNo</td></tr>
                                                   <tr><td><b>Total Amount</b></td><td>$Amount</td><td><b>Paid By</b></td><td>$paidByAcct</td></tr>
                                                   <tr><td><b>VAT</b></td><td>$vat</td><td><b>Witholding Tax</b></td><td>$witholdtax</td></tr>
                                                     </table></div>";
                                            }
                                         ?>
                                       
                                        
                                         
                                         
                                        
                                         
                                          <div class="col-md-12">
                                             <?php
                                             if($getApprovalLevel == 6 || $getApprovalLevel == 7 || $getApprovalLevel == 5 || $getApprovalLevel == 3 || $getApprovalLevel == 1){
                                                $printRequest = "";
                                                 $getpartpayment = $this->mainlocation->getpaypaymentfromdb($id);
                                                 if($getpartpayment){
                                                     echo "<h4>PART PAYMENT</h4><div class='card-content table-responsive'><table class='table table-responsive table-hover table-striped table-bordered'>"
                                                             . "<tr><td><b>Bank</b></td><td><b>Cheque No</b></td><td><b>Amount</b></td><td><b>Date</b></td><td><b>Statment</b></td><td><b>Action</b></td></tr>";
                                                     foreach($getpartpayment as $get){
                                                         $newBank = $get->newBank;
                                                         $partAmount = $get->partAmount;
                                                         $userRequestID = $get->userRequestID;
                                                         $chequeNonew = $get->chequeNonew;
                                                         $bankStatementpp = $get->bankStatementpp;
                                                         $paidBy = $get->paidBy;
                                                         $datepaid = $get->datepaid;
                                                         $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
                                                         if($getApprovalLevel == 7 ||  $getApprovalLevel == 6 ||  $getApprovalLevel == 8){
                                                             $printRequest = "<button class=' btn-xs btn-default'>Print</button>";
                                                         }
                                                      echo "<tr><td>$newBank</td><td>$chequeNonew</td><td>$partAmount</td><td>$datepaid</td><td>$bankStatementpp</td> <td>$printRequest</td></tr>";
                                                     }
                                                      echo "</table></div>";
                                                 }else{
                                                     echo "No Part Payment";
                                                 }
                                             }
                                             ?>
                                         </div>
                                         
                                         
                                                                                 
                                         <div class="col-md-12">
                                             <?php
                                             
                                             if($whichapp == 0 || $whichapp == "" || $whichapp == 8){
                                                    $newImage = "";
                                                    $AssetImage = "";
                                                    echo "<h4>Attachment</h4>";
                                                    $getattachementid = $this->adminmodel->getresultbaseonfileuploadID($id);
                                                    if ($getattachementid) {
                                                        foreach ($getattachementid as $file) {
                                                            $fid = $file->fid;
                                                            $f_requestID = $file->f_requestID;
                                                            $origFilename = $file->origFilename;
                                                            $newFilename = $file->newFilename;
                                                            $ext = $file->ext;
                                                            $mimeType = $file->mimeType;
                                                            
                                                            echo $newImage = '<a target="_blank" href=' . base_url() . 'public/documents/' . $origFilename . '>' . $newFilename . '</a><br/>';
                                                        }
                                                        
                                                        
                                                      if($whichapp == '9'){
                                                          echo $AssetImage = '<a target="_blank" href="https://sys.c-ileasing.com/storage/app/public/uploads/'.$origFilename.'">' . $newFilename . '</a><br/>'; 
                                                        }
                                                        
                                                        
                                                    } else {
                                                        echo "No Attachement";
                                                    }
                                             }
                                             
                                            
                                            ?>
                                             
                                              <?php
                                             /***************************FOR PROCUREMENT ***************************/
                                            if($whichapp == 3){
                                               
                                                $otherImages = "";
                                                //$file_url = "";
                                                $getformprocurement = $this->adminmodel->getresultbaseonfileuploadID($id);
                                                if($getformprocurement){
                                                foreach($getformprocurement as $procure){
                                                    $pfid = $procure->fid;
                                                    $pf_requestID = $procure->f_requestID;
                                                    $porigFilename = $procure->origFilename;
                                                    $pnewFilename = $procure->newFilename;
                                                    $pext = $procure->ext;
                                                    $pmimeType = $procure->mimeType;
                                                    
                                                     echo $newImage = '<a target="_blank" href="https://c-iprocure.com/scp/user_data/' . $pnewFilename . '">' . $pnewFilename . '</a><br/>';
                                                }
                                                }
                                                
                                            }
                                             /***************************END OF  PROCUREMENT ***************************/
                                            ?>
                                             
                                             
                                             <?php
                                           /***************************FOR ASSET MANAGEMENT ***************************/
                                           $AssetImage = "";
                                            if($whichapp == 2){
                                            $getImageName = $this->allresult->getimagename($apprequestID);
                                            echo $AssetImage = '<a target="_blank" href="https://c-iprocure.com/assets/document/vendors/'.$getImageName.'">' . $getImageName . '</a><br/>';
                                           
                                            }
                                            ?>
                                            
                                            <?php
                                            if($whichapp == 2){
                                               echo "<a target ='_blank' href='".base_url()."/assetmgt/joborderdetails/".@$apprequestID."/$hod'><br/><span class='btn btn-xs btn-danger'>View History</span></a>"; 
                                            }else{
                                                echo "";
                                            }
                                              /***************************FOR ASSET MANAGEMENT ***************************/  
                                            ?>
                                             
                                             
                                             
                                             <?php
                                            //Get all the old images
                                            $oldImage = "";
                                            $getoldImages = $this->mainlocation->getoldImages($id);
                                            
                                            if($getoldImages !== ""){
                                                
                                                $getoldimages = $this->adminmodel->getresultbaseonfileuploadID($getoldImages);
                                                if($getoldimages){
                                                    
                                                    foreach($getoldimages as $getold){
                                                    $fidold = $getold->fid;
                                                    $f_requestIDold = $getold->f_requestID;
                                                    $newFilenameold = $getold->newFilename;
                                                    $oldFilenameold = $getold->origFilename;
                                                    
                                                     echo $newImage = '<a target="_blank" href=' . base_url() . 'public/documents/' . $oldFilenameold . '>' . $newFilenameold . '</a><br/>';
                                                    }
                                                } else {
                                                    echo "";
                                                }
                                            }
                                            ?>
                                             
                                             
                                             <?php
                                               
                                             echo "<button class='btn btn-danger'>Audit Trail </button><hr/>";
                                             
                                             echo $auditTrail;
                                             
                                             ?>
                                             
                                             <?php
                                             $ITsupports = $this->cashiermodel->getitsupport() ? $this->cashiermodel->getitsupport() : "";
                                            $ifcheckITSUPPORT = $this->gen->haveAccess($_SESSION['id'], $ITsupports);
                                            
                                            if($ifcheckITSUPPORT || $getApprovalLevel == 6 || $getApprovalLevel == 5){
                                                echo "<button class='btn btn-success'>$userCode</button>";
                                            }
                                             
                                             ?>
                                             
                                         </div>
                                         
                                         
                                         
	                            </div>
	                        </div>
	                    </div>
						
                         <!-- End of Request Details with Status -->
                         
                                
                                
                                
                            <!-- Inside Content Ends Here -->
                            
                            
	                </div>
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                
                
                
   <?php echo $footer; ?>