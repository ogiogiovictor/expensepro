
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
                         
                         <div class="col-md-8">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
                                        <h4 class="title">Edit Cashier Only </h4>
                                        
	                                <p class="category">Edit My Request Details</p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
	                                
                                           <?php if ($getResult) { ?>
                                               <?php
                                                    foreach ($getResult as $get) {
							 $id = $get->id;
                                                         $ndescriptOfitem = $get->ndescriptOfitem;
                                                         $cashiers = $get->cashiers;
                                                         $icus = $get->icus;
                                                         $sessionID = $get->sessionID;
                                                         $approvals = $get->approvals;
                                                         $nPayment = $get->nPayment;
                                                         $dAmount = $get->dAmount;
                                                         $dLocation = $get->dLocation;
                                                         $dUnit = $get->dUnit;
                                                         
                                                         if($nPayment == 1){
                                                             $nPayment = "Petty Cash";
                                                         }else{
                                                            $nPayment = "Cheque"; 
                                                         }
                                                         
                                                         if($approvals == 1){
                                                             $newapprovals = "Awaiting HOD Approval";
                                                         }else if($approvals == 2){
                                                            $newapprovals = "Approved By HOD";
                                                         }else{
                                                            $newapprovals = "Check with IT Unit: Error Request"; 
                                                         }
                                                         
                                                         if($icus == 1){
                                                             $newicuvalues = "ICU GROUP 1 - LAGOS";
                                                         }else if($approvals == 2){
                                                             $newicuvalues = "ICU GROUP 2 - PH";
                                                         }else if($approvals == 3){
                                                             $newicuvalues = "ICU GROUP 3 - ABUJA";
                                                         }else if($approvals == 2){
                                                             $newicuvalues = "ICU GROUP 4 - LAGOS MAINLAND";
                                                         }else{
                                                            $newicuvalues = ""; 
                                                         }
                                                     
                                                ?> 
                                              
                                             <?php } ?>
                                        

                                         <?php } ?>
                                        
                                        <form name="changemyrequestdetials" id="changemyrequestdetials" enctype="multipart/form-data" method="POST" onSubmit="return false;">
	                                    
	                                        <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Request Title</label>
                                                    <input type="text" value="<?php echo $ndescriptOfitem;  ?>" class=" form-control" disabled>
                                                    </div>
	                                        </div>
                                            
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Prepared By</label>
                                                    <input type="text" disabled value="<?php echo $sessionID;  ?>" disabled class=" form-control">
                                                    </div>
	                                    </div>
                                            
                                              <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Payment Type</label>
                                                    <input type="text" disabled value="<?php echo $nPayment;  ?>" disabled class=" form-control">
                                                    </div>
	                                        </div>
                                            
                                            
                                             <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Approval</label>
                                                    <input type="text" disabled value="<?php echo $newapprovals;  ?>" disabled class=" form-control">
                                                    </div>
	                                     </div>
                                            
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Amount</label>
                                                    <input type="text" disabled value="<?php echo $dAmount;  ?>" disabled class=" form-control">
                                                    </div>
	                                     </div>
                                            
                                             <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Location</label>
                                                    <input type="text" disabled value="<?php echo $this->mainlocation->getdLocation($dLocation);  ?>" disabled class=" form-control">
                                                    </div>
	                                     </div>
                                            
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Unit</label>
                                                    <input type="text" disabled value="<?php echo $this->mainlocation->getdunit($dUnit);  ?>" disabled class=" form-control">
                                                    </div>
	                                     </div>
                                            
                                            
                                            <?php 
                                                $getcashier = $this->mainlocation->getallaccount();
                                                
                                                 if ($getcashier) { 
                                                $acc = "";
                                                foreach ($getcashier as $get) {

                                                    $cashierid = $get->id;
                                                    $email = $get->email;
                                                    $fname = $get->fname;
                                                    $lname = $get->lname;
                                                    $acc .= "<option  value=\"$email\">" . $fname." ". $lname. " >> ".$email . '</option>';
                                                     }
                                                 }
                                   
                                           ?>
                                            
                                             <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><span style='color:red'>Select Cashier</span></label>
                                                    <select class="form-control" name="changemycashier" id="changemycashier">
                                                        <option value="<?php echo $cashiers; ?>" ><?php echo $cashiers; ?></option>
                                                        <?php echo $acc; ?>
                                                    </select>
                                                    </div>
	                                        </div>
                                            
                                            
                                            
                                            
                                            
                                            <span id="cashierError"></span>
                                             <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                        <input type="hidden" value="<?php echo $approvals; ?>" id="approveID" name="approveID" />
                                                        <input type="hidden" value="<?php echo $id; ?>" id="postID" name="postID" />
                                                        <input type="hidden" value="<?php echo $sessionID; ?>" id="sessionID" name="sessionID" />
                                                        <center><button class="btn btn-sm btn-danger" id="changedcashierbysupport">Submit</button></center>
                                                    </div>
	                                     </div>
                                            
                                            
                                        </form>
                                              

	                            </div>
	                        </div>
	                    </div>
						
                        
                            
                            
	                </div>
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                
                
                
   <?php echo $footer; ?>