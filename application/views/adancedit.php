
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
                            
                         <?php if ($getallresult) { ?>
					  <?php
                                             foreach ($getallresult as $get) {
						$processid = $get->id;
                                                $md5 = $get->md5_id;
						$dateCreated = $get->dateCreated;
						$ndescriptOfitem = $get->ndescriptOfitem;
						$nPayment = $this->mainlocation->getpaymentType($get->nPayment);
						$approvals = $get->approvals;
						$dhod = $get->hod;
						$icus = $get->icus;
						$cashiers = $get->cashiers;
						$sessionID = $get->sessionID;
						$dateRegistered = $get->dateRegistered;
                                                $dAmount= $get->dAmount;
                                                $Location = $get->dLocation;
                                                $dUnit = $get->dUnit;
                                                $addComment = $get->addComment;
                                                $benEmail = $get->benEmail;
                                                $benName = $get->benName;
                                                $adCashierwhopaid = $get->dCashierwhopaid;
                                                $dICUwhoapproved = $get->dICUwhoapproved;
                                                $dICUwhorejectedrequest = $get->dICUwhorejectedrequest;
                                                $nPaymentType = $get->nPayment;
                                                $dAccountgroup = $get->dAccountgroup;
                                                $hodwhoapprove = $get->hodwhoapprove;
                                                $hodwhoreject = $get->hodwhoreject;
                                                $dICUwhorejectedrequest = $get->dICUwhorejectedrequest;
                                                $dCashierwhopaid = $get->dCashierwhopaid;
                                                $requesterComment = $get->requesterComment;
                                                $dCashierwhorejected = $get->dCashierwhorejected;
                                                $CurrencyType = $get->CurrencyType;
                                              
                                                
                                                
                                                if($approvals == 0){
                                                     $newapproval = "Pending";
						 }else if($approvals == 1){
                                                     $newapproval = "<span class='btn btn-sm btn-primary'>Awaiting HOD Approval</span>";
						 }else if($approvals == 2){
                                                     $newapproval = "<span class='btn  btn-sm btn-facebook'>Awaiting ICU Approval</span>";
						 }else if($approvals == 3){
                                                     $newapproval = "<span class='btn  btn-sm btn-secondary'>Awaiting Payment</span>";
						 }else if($approvals == 4){
                                                     $newapproval = "<span class='btn  btn-sm btn-warning'>Ready for Collection</span>";
						 }else if($approvals == 5){
                                                     $newapproval = "<span class='btn  btn-sm btn-danger'>Not Approved By HOD</span>";
						 }else if($approvals == 6){
                                                     $newapproval = "<span class='btn  btn-sm btn-danger'>Reject by ICU</span>";
						 }else if($approvals == 7){
                                                     $newapproval = "<span class='btn  btn-sm btn-danger'>Cheque Sent for Signature</span>";
						 }else if($approvals == 8){
                                                     $newapproval = "<span class='btn  btn-sm btn-danger'>Signed & Ready for Collection</span>";
						 }else if($approvals == 12){
                                                     $newapproval = "<span class='btn  btn-sm btn-danger'>Rejected by Account</span>";
						 }
                                                 
                                                 
                                      if($nPaymentType == 1){
                                        $value = "Petty Cash";
                                        $newbutton = "<option value='$nPaymentType'>$value</option>";
                                    }else{
                                        $value = "Cheque Requistion";
                                        $newbutton = "<option value='$nPaymentType'>$value</option>";
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
                                                
                                  }
                                  
                            }
                                ?>
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
                                            
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div> <!-- End of card-header -->

                        <form name="mainrequestformadvanceform" id="mainrequestformadvanceform" enctype="multipart/form-data" method="POST" onSubmit="return false;">
	                              
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
                                                    <input placeholder="Date" type="text" class="form-control datepicker" name="dateCreated" id="dateCreated"  value="<?php echo $dateCreated; ?>"/>
                                                    </div>
	                                </div>
                                        
                                         <div class="col-md-8">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Title</label>
                                                    <input type="text" class="form-control" name="descItem" id="descItem" value="<?php echo $ndescriptOfitem; ?>" />
                                                    </div>
	                                </div>
                                        
                                        
                                        <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Payee Name</label>
                                                    <input type="text" class="form-control" name="benName" id="benName"  value="<?php echo $benName; ?>"/>
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
                                        
                                         <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Select Unit</label>
                                                    <select name="dUnit" id="dUnit" class="form-control">
                                                       <option value="<?php echo $dUnit; ?>"><?php echo $this->mainlocation->getdunit($dUnit); ?> </option>
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
                                             <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Payment Method</label>
                                                    <input value="<?php echo $nPaymentType; ?>" type="hidden" name="paymentType" id="paymentType" class="form-control">
                                                    <select  name="paymentType" id="paymentType" class="form-control" disabled>
                                                         <?php echo $newbutton; ?>
                                                        <?php echo $pay; ?>
                                                    </select>
                                                    </div>
	                                        </div>
                                        
                                        
                                        <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Comment</label>
                                                    <input type="text" class="form-control" name="dComment" id="dComment" value="<?php echo $requesterComment; ?>"/>
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
                                                    <select class="form-control" data-style="btn-default" name="dhod" id="dhod" data-live-search="true">
                                                       <option><?php echo $dhod; ?></option>
                                                        <?php echo $hod; ?>
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
                                        if($cashiers == 'null' || $cashiers ==""){
                                         echo "";
                                    }else{
                                        echo "<div class='col-md-4'>
                                                    <div class='form-group'>
                                                    <label class='control-label'>3rd Level Approval (Cashier)</label>
                                                    <select name='dcashier' id='dcashier' class='form-control'>
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
                                    }else if($dAccountgroup == 4){
                                        $newaccountgroup = "Account Group-Warri";
                                        $buttonsaccount = "<option value='$dAccountgroup'>$newaccountgroup</option>";
                                    }else if($dAccountgroup == 6){
                                        $newaccountgroup = "Account Group-Lagos Mainland";
                                        $buttonsaccount = "<option value='$dAccountgroup'>$newaccountgroup</option>";
                                    }else if($dAccountgroup == 10){
                                        $newaccountgroup = "Admin Float";
                                        $buttonsaccount = "<option value='$dAccountgroup'>$newaccountgroup</option>";
                                    }
                                         if($dAccountgroup != 0){
                                        echo "<div class='col-md-4'>
                                                    <div class='form-group'>
                                                    <label class='control-label'>3rd Level Approval (Account)</label>
                                                    <select name='daccountant' id='daccountant' class='form-control'>
                                                        $buttonsaccount
                                                         $dnewacc
                                                    </select>
                                                    </div>
	                                 </div>";
                                        }else{
                                            echo "";
                                            }
                                        ?>
                                        
                                        <!--------- END OF THE ACCOUNTANT AND THE CASHIERS ----------->
                                      
                                        
                                    </div> <!-- <div class="tab-pane active" id="profile"> -->
                                    
                                  


                                </div>
                            </div>
                        <!--</form>-->

                        </div>
                        
                         <div class="row">
                             <div class="col-md-12">
                                 <div id="showError"></div><span id="loader"></span>
                                 <input type="hidden" name="hideID" id="hideID" value="<?php echo $processid; ?>" />
                                 <input type="hidden" name="hashmd5id" id="hashmd5id" value="<?php echo $md5; ?>" />
                                 <input id="proceeadvancedit" type="submit" value="SUBMIT" class="btn btn-primary" />
                             </div> 
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