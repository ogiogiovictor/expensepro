
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
                                                $auditTrail = $get->auditTrail;
                                                $md5 = $get->md5_id;
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
                                            <li class="">
                                                <a href="#messages" data-toggle="tab">
                                                    <i class="material-icons">code</i>
                                                    Expense Details
                                                    <div class="ripple-container"></div></a>
                                            </li>
                                           <!-- <li class="">
                                                <a href="#settings" data-toggle="tab">
                                                    <i class="material-icons">cloud</i>
                                                    Attachment
                                                    <div class="ripple-container"></div></a>
                                            </li>-->
                                        </ul>
                                    </div>
                                </div>
                            </div> <!-- End of card-header -->

                        <form name="mainrequestformadvanceform" id="mainrequestformadvanceform" enctype="multipart/form-data" method="POST" onSubmit="return false;">
	                              
                            <div class="card-content">
                                <div class="tab-content">

                                    <div class="tab-pane active" id="profile">
                                        
                                        <div class="col-md-12" style="color:green">
                                             <span id="genmessag"></span>
                                            
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
                                                    <select name="dicu" id="dicu" class="form-control">
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
                                       <?php
                                            if($nPaymentType == 2){
                                                
                                                echo "<div class='col-md-4'>
                                                    <div class='form-group'>
                                                    <label class='control-label'>Currency Type</label>
                                                    <select name='currencyType' id='currencyType' class='form-control'>
                                                       
                                                       <option value='$CurrencyType'>$CurrencyType</option>
                                                       <option value='naira'>Naira(&#8358;)</option>
                                                       <option value='dollar'>Dollar (&#x0024;)</option>
                                                       <option value='euro'>Euro (&#8364;)</option>
                                                       <option value='pounds'>Pounds (&#163;)</option>
                                                       <option value='yen'>Japanese Yen (&#165;)</option>
                                                       <option value='singaporDollar'>Singapore Dollar (S&#x0024;)</option>
                                                       <option value='AED'>(AED)</option>
                                                        
                                                    </select>
                                                    </div>
	                                 </div>";
                                            }else {
                                                echo "";
                                            }
                                        
                                        ?>
                                        
                                        
                                        
                                          
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">HOD Comment (readonly)</label>
                                           <input style="background-color:#002a80; color:white; padding:3px" type="text" class="form-control" readonly value="<?php echo $addComment; ?>"/>
                                           
                                        </div>
	                            </div>
                                        
                                        
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Audit Trail</label><br/>
                                            <div style="background-color:#cad2d3; padding:10px"><?php echo $auditTrail; ?></div>
                                        </div>
	                            </div>
                                        
                                    </div> <!-- <div class="tab-pane active" id="profile"> -->
                                    
                                  
                                    <div class="tab-pane" id="messages">
                                       
                                      <div class="card-content">
                                           <b><span>Total Amount:</span> <span id="sumAmount" class="btn btn-xs btn-success"></span></b>
                                           <span id="suminput"></span></button>
                                        <table class="table table-condensed" id="item_table">
                                           <tr style="background-color:#F3F3F3">
                                                <th>&nbsp;</th>
                                                <th style="width:40%">Expense Details</th>
                                                <th style="width:15%">Amount</th>
                                                <th style="width:25%">Expense Code</th>
                                                <th style="width:15%">Date</th>
                                                <th style="width:5%">&nbsp;</th>
                                            </tr>
                                                 <!--<button class='btn btn-xs btn-primary' onclick='add_row()'>Add More</button>-->
                                            <?php 
                                                        $getallaccounts = $this->mainlocation->getallaccounts();

                                                       if ($getallaccounts) { 
                                                        $allact = "";
                                                        foreach ($getallaccounts as $get) {

                                                            $codeid = $get->codeid;
                                                            $codeName = $get->codeName;
                                                            $codeNumber	 = $get->codeNumber;
                                                            $allact .= "<option  value=\"$codeNumber\"> ".$codeName.' - '.$codeNumber . '</option>';
                                                             }
                                                         } 
                                                  ?>      
                                           <?php 
                                           $getexpensedetails = $this->adminmodel->getexpenseresultdetails($processid);
                                          
                                                
                                                if ($getexpensedetails) { 
                                                  
                                                    foreach ($getexpensedetails as $extdetals) {
                                                         $exid = $extdetals->exid;
                                                         $requestID = $extdetals->requestID;
                                                         $ex_Details = $extdetals->ex_Details;
                                                         $ex_Amount = $extdetals->ex_Amount;
                                                         $ex_Code = $extdetals->ex_Code;
                                                         $ex_Date = $extdetals->ex_Date;
                                                         
                                                         $getCodeName = $this->mainlocation->nameCode($ex_Code);
                                                echo "<tr>
                                                    <td>
                                                        <input type='hidden' name='exid[]' id='exid' value='$exid' class='form-control'/>
                                                    </td>
                                                    <td>
                                                        <textarea name='exDetailofpayment[]' id='exDetailofpayment' class='form-control'>$ex_Details</textarea>
                                                    </td>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <td>
                                                        <input type='text' name='exAmount[]' id='exAmount' value='$ex_Amount' placeholder='Amount' class='form-control exAmount'/>
                                                    </td>
                                                    
                                                    <td>
                                                        <div class='col-md-12'>
                                                                   <div class=''>
                                                                   <select name='exCode[]' id='exCode' placeholder='Code' class='form-control' class='form-control'>
                                                                       <option>$getCodeName $ex_Code</option>
                                                                        $allact;
                                                                   </select>
                                                                   </div>
                                                        </div>
                                        
                                                    </td>
                                                    
                                                     <td>
                                                        <input type='text' name='exDate[]' id='exDate' value='$ex_Date' placeholder='dddd-mm-dd' class='form-control datepicker'/>
                                                    </td>
                                                    
                                                    <td><button type='type' name='remove' class='btn btn-danger btn-sm remove' onClick='removeexpense($exid)'><i class='material-icons'>cancel</i></button></td>
                                                    
                                                </tr>";
                                               
                                                    }
                                                   ?>
                                             <?php } ?>
                                             
                                                 <?php } ?>
                                            
                                             <?php } ?>
                                           
                                            
                                        </table>
                                      </div>   
                                    </div>



                                    <div class="tab-pane" id="settings">
                                         <small style="color:red"> Note: Make sure you rename your images, no special characters are allowed<br/></small>
                                        <span id="errormsg"></span>
                                         
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
                                                    $orgFilenameold = $getold->origFilename;
                                                    
                                                     echo $newImage = '<a target="_blank" href=' . base_url() . 'public/documents/' . $orgFilenameold . '>' . $newFilenameold . '</a><br/>';
                                                    }
                                                } else {
                                                    echo "";
                                                }
                                            }
                                            ?>
                                         <?php
                                            $newImage = "";
                                            $getattachementid = $this->adminmodel->getresultbaseonfileuploadID($processid);
                                            
                                            if ($getattachementid) {

                                                foreach ($getattachementid as $file) {
                                                    $fid = $file->fid;
                                                    $f_requestID = $file->f_requestID;
                                                    $origFilename = $file->origFilename;
                                                    $newFilename = $file->newFilename;
                                                    $ext = $file->ext;
                                                    $mimeType = $file->mimeType;

                                                    echo $newImage = "<a target='_blank' href='". base_url()."public/documents/$origFilename'>$newFilename</a> &nbsp;&nbsp; - <a href='#' onClick='deleteImage($fid)'>Delete</a><br/>";
                                                   
                                                }
                                            } else {
                                                echo "No Attachement";
                                            }
                                            ?>
                                        <div class="col-md-12">
                                                    <div class=""><br/>
                                                    <label><span>Upload Attachment</span></label>
                                                    <!--<input type="file" style="display:block" name="upload_file1" id="upload_file1" multiple />-->
                                                    
                                                    <input type="file" style="display:block" name="upfile[]" id="upfile[]" multiple />
                                                    
                                                    </div>
                                            
                                                    <div id="moreImageUpload"></div>
                                                    <div style="clear:both;"></div>
                                                    <div id="moreImageUploadLink" style="display:none;">
                                                        <a href="javascript:void(0);" id="attachMore">Attach another file</a>
                                                    </div>
                                                    
	                                 </div>
                                        <hr/>
                                        <div class="col-md-12">
                                             <!--<p id="showError"></p><span id="loader"></span>-->
                                           
                                              <!--<center> <input id="processingsave" type="submit" value="SAVE" class="btn btn-info" />-->
                                              
                                                  <!--<input id="processnewrequestadvance" type="submit" value="SEND" class="btn btn-primary" /></center>-->
	                                 </div>
                                       
                                        
                                        <hr/>
                                        
                                    </div>




                                </div>
                            </div>
                        <!--</form>-->

                        </div>
                        
                         <div class="row">
                             <div class="col-md-12">
                                 <div id="showError"></div><span id="loader"></span>
                                 <input type="hidden" name="hideID" id="hideID" value="<?php echo $processid; ?>" />
                                  <input type="hidden" name="hashmd5id" id="hashmd5id" value="<?php echo $md5; ?>" />
                                 <input type="hidden" name="auditTrailRequest" id="auditTrailRequest" value="<?php echo $auditTrail; ?>" />
                                 <input id="processeditrequest" type="submit" value="SEND" class="btn btn-primary" />
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