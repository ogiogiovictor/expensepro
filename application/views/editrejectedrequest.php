
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
                            
                         
                         <!-- Beginning of Request Details with Status -->
                         
                         <div class="col-md-8">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">Title: <?php echo $useidtogetname; ?></h4>
                                        <p class="category"><small>You can only edit the ones in asterisks (*)</small></p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
	                               <?php if ($getallresult) { ?>
					  <?php
                                             foreach ($getallresult as $get) {
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
                                                $Location = $get->dLocation;
                                                $unit = $get->dUnit;
                                                $addComment = $get->addComment;
                                                $benEmail = $get->benEmail;
                                                $benName = $get->benName;
                                                $adCashierwhopaid = $get->dCashierwhopaid;
                                                $dICUwhoapproved = $get->dICUwhoapproved;
                                                $dICUwhorejectedrequest = $get->dICUwhorejectedrequest;
                                                $nPaymentType = $get->nPayment;
                                                $dAccountgroup = $get->dAccountgroup;
                                                $dAccountgroup = $get->dAccountgroup;
                                                
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
						 }
                                                
                                          ?>
                                        
                                        <span><?php echo $newapproval; ?></span><br/>
                                        
                                        <form name="dEditRequest" id="dEditRequest" method="POST" action="" onSubmit="return false;"/>
                                        <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Date<span style="color:red">*</span></label>
                                                    <input value="<?php echo $dateCreated; ?>" id="newDate" name="newDate" type="text" class="form-control datepicker" />
                                                    </div>
	                                </div>
                                        
                                        <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Title<span style="color:red">*</span></label>
                                                    <input value="<?php echo $ndescriptOfitem; ?>" id="ndescriptOfitem" name="ndescriptOfitem" type="text" class="form-control" />
                                                    </div>
	                                </div>
                                        
                                        <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Location</label>
                                                    <input value="<?php echo $this->mainlocation->getdLocation($Location); ?>" disabled type="text" class="form-control" />
                                                    </div>
	                                </div>
                                        
                                         <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Unit</label>
                                                    <input value="<?php echo $this->mainlocation->getdunit($unit); ?>" disabled type="text" class="form-control" />
                                                    </div>
	                                </div>
                                        
                                        
                                        
                                        
                                        <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Payment Type</label>
                                                    <input value="<?php echo $nPayment; ?>" disabled type="text" class="form-control" />
                                                    </div>
	                                </div>
                                        
                                        
                                         <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Amount<span style="color:red">*</span></label>
                                                    <input value="<?php echo $dAmount; ?>" id="dAmount" name="dAmount" type="text" class="form-control" />
                                                    </div>
	                                </div>
                                        
                                        <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">HOD</label>
                                                    <input value="<?php echo $hod; ?>" id="dHOD" name="dHOD"  type="text" class="form-control" />
                                                    </div>
	                                </div>
                                        
                                        <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Comment<span style="color:red">*</span></label>
                                                    <input value="<?php echo $addComment; ?>"  name="dComment" id="dComment" type="text" class="form-control" />
                                                    </div>
	                                </div>
                                        
                                        <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Payee Name <span style="color:red">*</span></label>
                                                    <input value="<?php echo $benName; ?>"  name="benName" id="benName" type="text" class="form-control" />
                                                    </div>
	                                </div>
                                        
                                        <?php
                                        if($nPaymentType == '1'){ 
                                            echo "<div class='col-md-3'>
                                                    <div class='form-group label-floating'>
                                                    <label class='control-label'>Cashier</label>
                                                    <input value='$cashiers'  name='dcashier' id='dcashier' type='text' class='form-control' />
                                                    </div>
	                                </div>";
                                        }else{
                                        echo "<div class='col-md-3'>
                                                    <div class='form-group label-floating'>
                                                    <label class='control-label'>Account Group</label>
                                                    <input value='$dAccountgroup'  name='dAccountGroup' id='dAccountGroup' type='text' class='form-control' />
                                                    </div>
	                                </div>";
                                        
                                        }
                                                 
                                        ?>
                                        
                                        <!--
                                        <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Beneficiary Email <span style="color:red">*</span></label>
                                                    <input value="<?php //echo $benEmail; ?>" name="benEmail" id="benEmail" type="text" class="form-control" />
                                                    </div>
	                                </div> -->
                                        
                                        
                                         <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <input type="hidden" name="hideID" id="hideID" value="<?php echo $id; ?>" />
                                                   <input class="btn btn-sm btn-primary" type="text" value="submit" name="EditButton" id="EditButton"/>
                                                   <span id="insurerror"></span>
                                                    </div>
	                                </div>
                                        
                                        
                                        
                                        <?php } ?>
                                        

                                         <?php } ?>	
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