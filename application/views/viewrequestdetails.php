
	<div class="wrapper">
	    <div class="sidebar" data-color="blue" data-image="<?php echo base_url(); ?>assets/img/sidebar-1.jpg">

			<!--
		        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
                        colors : #113c7f, #5e82bb
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


                            <?php
                            $cashiersid = $_SESSION['email'];
                            $adminEmail = $_SESSION['email'];
                            
                            if ($getallresult) {
                                $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
                                foreach ($getallresult as $get) {
                                    $mainid = $get->id;
                                    $dateCreated = $get->dateCreated;
                                    $ndescriptOfitem = $get->ndescriptOfitem;
                                    $nPayment = $get->nPayment;
                                    $approvals = $get->approvals;
                                    $dhod = $get->hod;
                                    $icus = $get->icus;
                                    $cashiers = $get->cashiers;
                                    $sessionID = $get->sessionID;
                                    $dateRegistered = $get->dateRegistered;
                                    $dAmount = $get->dAmount;
                                    $dLocation = $get->dLocation;
                                    $dUnit = $get->dUnit;
                                    $addComment = $get->addComment;
                                    $dICUwhoapproved = $get->dICUwhoapproved;
                                    $benName = $get->benName;
                                    $benEmail = $get->benEmail;
                                    $dLocation = $get->dLocation;
                                    $requesterComment = $get->requesterComment;
                                    $refID_edited = $get->refID_edited;
                                    $dAccountgroup = $get->dAccountgroup;
                                    $partPay = $get->partPay;
                                    $hodwhoapprove = $get->hodwhoapprove;
                                    $hodwhoreject = $get->hodwhoreject;
                                    $dICUwhorejectedrequest = $get->dICUwhorejectedrequest;
                                    $dCashierwhopaid = $get->dCashierwhopaid;
                                    $dCashierwhorejected = $get->dCashierwhorejected;
                                    $apprequestID = $get->apprequestID;
                                    $from_app_id = $get->from_app_id;
                                    $sageRef = $get->sageRef;
                                                
                                    if($partPay !="" && $partPay < $dAmount){
                                      $newpartpay =  @number_format($partPay);
                                    }else{
                                      $newpartpay = @number_format($dAmount)."NGN";
                                    }	
                                    if($nPayment == 1){
                                        $value = "Petty Cash";
                                        $newbutton = "<option value='$nPayment'>$value</option>";
                                    }else{
                                        $value = "Cheque Requistion";
                                        $newbutton = "<option value='$nPayment'>$value</option>";
                                    }
                                    
                                    if($icus == 1){
                                        $newgroup = "ICU GROUP 1 - LAGOS";
                                        $buttons = "<option value='$icus'>$newgroup</option>";
                                    }else if($icus == 2){
                                         $newgroup = "ICU GROUP 2 - PH";
                                        $buttons = "<option value='$icus'>$newgroup</option>";
                                    }else if($icus == 3){
                                         $newgroup = "ICU GROUP 3 - ABUJA";
                                        $buttons = "<option value='$icus'>$newgroup</option>";
                                    }else if($icus == 4){
                                         $newgroup = "ICU GROUP 4 - DELTA";
                                        $buttons = "<option value='$icus'>$newgroup</option>";
                                    }
                                    
                                   if($from_app_id == '3'){
                                                    $vendor = $this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "USER_ID", $benName);
                                                    }else if($from_app_id == '0' && is_numeric($benName)){
                                                          $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($from_app_id == '0' && !is_numeric($benName)){
                                                         $vendor =  $benName;
                                                    }else if($from_app_id == '5'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($from_app_id == '6'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($from_app_id == '8'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else{
                                                        $vendor =  $benName;
                                                    }
                                     
                                } // End of for each
                            }
                            ?>
                    <!-- Inside Content Begins  Here -->

                    <!-- Beginning of Request Details with Status -->

                    <div class="col-md-10 col-md-offset-1">     
                        <div class="card card-nav-tabs">

                            <div class="card-header" data-background-color="blue">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <span class="nav-tabs-title">ACTION:</span>
                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                            <li class="active">
                                                <a href="#profile" data-toggle="tab">
                                                    <i class="material-icons">bug_report</i>
                                                    Request Details
                                                    <div class="ripple-container"></div></a>
                                            </li>
                                            <li class="">
                                                <a href="#messages" data-toggle="tab">
                                                    <i class="material-icons">code</i>
                                                    Expense Details
                                                    <div class="ripple-container"></div></a>
                                            </li>
                                            <li class="">
                                                <a href="#settings" data-toggle="tab">
                                                    <i class="material-icons">cloud</i>
                                                    Attachment
                                                    <div class="ripple-container"></div></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div> <!-- End of card-header -->

                        <form name="mainrequestformadvanceform" id="mainrequestformadvanceform" enctype="multipart/form-data" method="POST" onSubmit="return false;">
	                     <?php 
                                if($sageRef){
                                    echo "<span style='font-size:15px; color:red; font-weight:bold'>$sageRef</span>";
                                }else{
                                    echo "";
                                }
                             ?>
                            <div class="card-content">
                                <div class="tab-content">

                                    <div class="tab-pane active" id="profile">
                                        
                                        <div class="col-md-12" style="color:green">
                                            
                                            
                                            <?php 
                                                if($hodwhoapprove !== ""){
                                                  echo '<b>Approvals:</b> '.$hodwhoapprove;
                                                }
                                                if($dICUwhoapproved !== ""){
                                                  echo ", ". $dICUwhoapproved;
                                                }
                                                if($dCashierwhopaid !== ""){
                                                  echo ", ". $dCashierwhopaid;
                                                }
                                            
                                            ?>
                                            
                                            <span style="color:red">
                                             <?php 
                                                if($hodwhoreject !== ""){
                                                  echo '<b>Rejection:</b> '.$hodwhoreject;
                                                }
                                                if($dICUwhorejectedrequest !== ""){
                                                  echo ", ". $dICUwhorejectedrequest;
                                                }
                                                if($dCashierwhorejected !== ""){
                                                  echo ", ". $dCashierwhorejected;
                                                }
                                                
                                            ?>
                                            </span>     
                                            
                                            
                                                 
	                                </div>
                                        
                                        
                                        
                                        <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <!--<label class="control-label">Date</label>-->
                                                    <input placeholder="Date" type="text" class="form-control datepicker" value="<?php echo $dateCreated; ?>" disabled />
                                                    </div>
	                                </div>
                                        
                                         <div class="col-md-8">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Title</label>
                                                    <input type="text" class="form-control" value="<?php echo $ndescriptOfitem; ?>" disabled/>
                                                    </div>
	                                </div>
                                        
                                        
                                        <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label class="control-label">Payee Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $vendor; ?>" disabled  />
                                                    </div>
	                                </div>
                                        
                                        <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label class="control-label">Prepared By</label>
                                                    <input type="text" class="form-control" value="<?php echo $sessionID; ?>" disabled  />
                                                    </div>
	                                </div>
                                        
                                        
                                          <?php 
                                                $getunit = $this->mainlocation->getallunit();
                                                
                                                 if ($getunit) { 
                                                $dunit = "";
                                                foreach ($getunit as $get) {

                                                    $id = $get->id;
                                                    $unitName = $get->unitName;
                                                    $dunit .= "<option  value=\"$id\">" . $unitName . '</option>';
                                                     }
                                                 }
                                   
                                           ?>
                                        
                                         <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label class="control-label">Select Unit</label>
                                                    <select disabled name="dUnit" id="dUnit" class="form-control">
                                                        <option><?php echo $this->mainlocation->getdunit($dUnit); ?> </option>
                                                        <?php echo $dunit; ?>
                                                    </select>
                                                    </div>
	                                        </div>
                                        
                                           
                                      <?php 
                                                $getpayment = $this->mainlocation->getallpayment();

                                                 if ($getpayment) { 
                                                $pay = "";
                                                foreach ($getpayment as $get) {

                                                    $id = $get->id;
                                                    $paymentType = $get->paymentType;
                                                    $pay .= "<option  value=\"$id\">" . $paymentType . '</option>';
                                                     }
                                                 }
                                   
                                        ?>
                                             <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label class="control-label">Payment Method</label>
                                                    <select disabled name="paymentType" id="paymentType" class="form-control">
                                                        <?php echo $newbutton; ?>
                                                        <?php echo $pay; ?>
                                                    </select>
                                                    </div>
	                                        </div>
                                        
                                        
                                        
                                        
                                         <?php 
                                                $gethod = $this->adminmodel->getalluserwithhodid();
                                                $kaboom = explode(",", $gethod);
                                                $hod = "";
                                                foreach($kaboom as $key=> $value){
                                                   $getallemail = $this->users->getresultwithid($value); 
                                                   
                                                   if($getallemail){
                                                       foreach($getallemail as $get){
                                                       $newid = $get->id;
                                                       $fname = $get->fname;
                                                       $lname = $get->lname;
                                                       $email = $get->email;
                                                       $hod .= "<option  value=\"$email\">" . $fname." ". $lname. " >> ".$email . '</option>';
                                                       }
                                                   }
                                                    
                                                } 
                                              
                                           ?>
                                          
                                        <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">1st Level Approval (HOD)</label>
                                                    <select disabled class="form-control" data-style="btn-default" name="dhod" id="dhod" data-live-search="true">
                                                        <option><?php echo $dhod; ?></option>
                                                        <?php echo $hod; ?>
                                                    </select>
                                                    </div>
	                                 </div>
                                        
                                      
                                       <?php 
                                                $geticu = $this->adminmodel->getallicugroup();

                                                if ($geticu) { 
                                                $icu = "";
                                                foreach ($geticu as $get) {

                                                    $icuid = $get->icuid;
                                                    $groupName = $get->	groupName;
                                                    $icu .= "<option  value=\"$icuid\">" . $groupName . '</option>';
                                                     }
                                                 }
                                            
                                           ?>
                                        
                                      <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">2nd Level Approval (ICU)</label>
                                                    <select disabled name="dicu" id="dicu" class="form-control">
                                                       <?php echo $buttons; ?>
                                                       <?php echo $icu; ?>
                                                    </select>
                                                    </div>
	                                 </div>
                                        
                                        
                                        
                                        <!---------THE ACCOUNTANT AND CASHIERS ---------------------->
                                        
                                         <?php 
                                                $getcashier = $this->mainlocation->getallaccount();
                                                
                                                 if ($getcashier) { 
                                                $acc = "";
                                                foreach ($getcashier as $get) {

                                                    $id = $get->id;
                                                    $email = $get->email;
                                                    $fname = $get->fname;
                                                    $lname = $get->lname;
                                                    $acc .= "<option  value=\"$email\">" . $fname." ". $lname. " >> ".$email . '</option>';
                                                     }
                                                 }
                                   
                                           ?>
                                        
                                        <?php
                                       
                                    if($cashiers == null || $cashiers == 'null'){
                                         echo "";
                                    }else{
                                        echo "<div class='col-md-4'>
                                                    <div class='form-group'>
                                                    <label class='control-label'>3rd Level Approval (Cashier)</label>
                                                    <select  disabled name='dcashier' id='dcashier' class='form-control'>
                                                        <option>$cashiers</option>
                                                        $acc;
                                                    </select>
                                                    </div>
	                                 </div>";
                                    }
                                
                                    ?>
                                        
                                        
                                        
                                        
                                         <!---  FOR ACCOUNT BANK ALERT -->
                                        <?php 
                                          $getaccount = $this->adminmodel->getaccountants();
                                                
                                                 if ($getaccount) { 
                                                $dnewacc = "";
                                                foreach ($getaccount as $get) {

                                                    $gid = $get->gid;
                                                    $accountgroupName = $get->accountgroupName;
                                                    
                                                    $dnewacc .= "<option  value=\"$gid\">" . $accountgroupName . '</option>';
                                                     }
                                                 }
                                   
                                           ?>
                                        
                                         <?php
                                         $buttonsaccount = "";
                                    
                                    if($dAccountgroup == 1 || $dAccountgroup == '1'){
                                        $newaccountgroup = "Account Group-Lagos";
                                        $buttonsaccount = "<option value='$dAccountgroup'>$newaccountgroup</option>";
                                    }else if($dAccountgroup == 2 || $dAccountgroup == '2'){
                                         $newaccountgroup = "Account Group - PH";
                                        $buttonsaccount = "<option value='$dAccountgroup'>$newaccountgroup</option>";
                                    }else if($dAccountgroup == 3){
                                         $newaccountgroup = "Account Group-Abuja";
                                        $buttonsaccount = "<option value='$dAccountgroup'>$newaccountgroup</option>";
                                    }else if($dAccountgroup == 10){
                                        $newaccountgroup = "Admin Float - Lagos HQ";
                                        $buttonsaccount = "<option value='$dAccountgroup'>$newaccountgroup</option>";
                                    }else if($dAccountgroup == 6){
                                        $newaccountgroup = "Account Group - Lagos Mainland";
                                        $buttonsaccount = "<option value='$dAccountgroup'>$newaccountgroup</option>";
                                    }
                                    
                                         if($dAccountgroup != 0 || $dAccountgroup != '0'){
                                          
                                        echo "<div class='col-md-4'>
                                                <div class='form-group'>
                                                    <label class='control-label'>3rd Level Approval (Account)</label>
                                                    <select disabled name='daccountant' id='daccountant' class='form-control'>
                                                        $buttonsaccount
                                                         $dnewacc
                                                    </select>
                                                </div>
	                                 </div>";
                                        }else{
                                            echo "";
                                            }
                                        ?>
                                        
                                         <div class="col-md-12">
                                                    <div class="form-group">
                                                    <label class="control-label">My Comment</label>
                                                    <input type="text" class="form-control" value="<?php echo $requesterComment; ?>" />
                                                    </div>
                                         </div>
                                        <!--------- END OF THE ACCOUNTANT AND THE CASHIERS ----------->
                                        
                                         <div class="col-md-12">
                                                    <div class="form-group">
                                                    <label class="control-label">Approval Comments</label><hr/>
                                                     <?php
                                        // THIS IS THE COMMENT SECTION
                                              $comment = "";
                                       $hodCommenting = @$this->mainlocation->getallcommentresult($mainid);
                                        if($hodCommenting){
                                           foreach($hodCommenting as $get){
                                               $newquestID = $get->newrequesID;
                                               $maincomment = $get->comment;
                                               $sessionID = $get->sessionID;
                                               
                                               
                                              $comment .= "<br/><br/>Comments : ";
                                              $comment .= $maincomment;
                                             //  $mainTable .=  "<table class='table table-responsive table-bordered'><tr><th>HOD Comment</th><th>ICU Comment</td></th>";
                                               //<b>HOD Comment</b><br/> ". $HODcomment . "<br/><b>ICU</b><br>". $icuComment;
                                                 //$mainTable .=  "<tr><td>$HODcomment</td><td>$icuComment</td></tr></table>";
                                               
                                           }
                                           
                                        }    
                                        
                                      echo $comment;
                                      echo"<hr/>";
                                      echo "<h5 style='color:red'>Additional Comment: <br/>". $addComment . "</h5>";
                                        
                                        ?>
                                                    </div>
	                                 </div>
                                        
                                        
                                    </div> <!-- <div class="tab-pane active" id="profile"> -->

                                    
                                    
                                    
                                       
                                        
                                     
                                        

                                    <div class="tab-pane" id="messages">
                                      <div class="card-content table-responsive">
                                      
                                           <div class="col-md-12">
                                            <?php
                                           
                                           $getexpensedetails = $this->adminmodel->getexpenseresultdetails($mainid);
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

                                                              echo "<tr><td>$ex_Details</td><td>$ex_Code  $getCodeName</td><td>$ex_Amount</td><td>$ex_Date</td></tr>";
                                                          }
                                                          echo "</table></div>";
                                                      }
                                                
                                           ?>
                                         </div>
                                      </div>   
                                    </div>



                                    <div class="tab-pane" id="settings">
                                        <small style="color:red"> Note: Make sure your images names has no special characters<br/></small>
                                        <div class="col-md-12">
                                           
                                            <?php
                                            //Get all the old images
                                            if($from_app_id == 0 || $from_app_id == "" || $from_app_id == 8){
                                                $oldImage = "";
                                                $getoldImages = $this->mainlocation->getoldImages($mainid);

                                                if($getoldImages !== ""){

                                                    $getoldimages = $this->adminmodel->getresultbaseonfileuploadID($getoldImages);
                                                    if($getoldimages){

                                                        foreach($getoldimages as $getold){
                                                        $fidold = $getold->fid;
                                                        $f_requestIDold = $getold->f_requestID;
                                                        $newFilenameold = $getold->newFilename;
                                                        $origFilenameold = $getold->origFilename;

                                                         echo $newImage = '<a target="_blank" href=' . base_url() . 'public/documents/' . $origFilenameold . '>' . $newFilenameold . '</a><br/>';
                                                        }
                                                    } else {
                                                        echo "";
                                                    }
                                                }
                                            }
                                            ?>
                                            
                                            <?php
                                             if($from_app_id == 0 || $from_app_id == "" || $from_app_id == "8"){
                                                $newImage = "";
                                                $getattachementid = $this->adminmodel->getresultbaseonfileuploadID($mainid);

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
                                                } else {
                                                    echo "No Attachement";
                                                }
                                             }
                                            ?>
                                            
                                            
                                            <?php
                                           /***************************FOR ASSET MANAGEMENT ***************************/
                                           $AssetImage = "";
                                            if($apprequestID && $apprequestID !== "" && $from_app_id == '2' || $from_app_id == 2){
                                            $getImageName = $this->allresult->getimagename($apprequestID);
                                            echo $AssetImage = '<br/><a target="_blank" href="http://c-iprocure.com/asset/document/vendors/'.$getImageName.'">' . $getImageName . '</a><br/>';
                                           
                                            }
                                             /***************************FOR ASSET MANAGEMENT ***************************/  
                                            ?>
                                            
                                            <?php
                                             /***************************FOR PROCUREMENT ***************************/
                                            if($from_app_id == 3){
                                               
                                                $otherImages = "";
                                                //$file_url = "";
                                                $getformprocurement = $this->adminmodel->getresultbaseonfileuploadID($mainid);
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
                                            
                                          
	                                 </div>
                                        
                                        
                                        
                                        <hr/>
                                        
                                    </div>




                                </div>
                            </div>
                        <!--</form>-->

                        </div>
                        
                      
                </form>
                         
                    </div>
                    <!-- End of Request Details with Status -->

                   


                    <!-- Inside Content Ends Here -->


                </div>
                        
                        
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                
                
                
   <?php echo $footer; ?>