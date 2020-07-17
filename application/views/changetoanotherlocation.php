
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
                            
                            
                            <!-- Inside Content Begins  Here -->
                             
                         <!-- Beginning of Request Details with Status -->
                        
                    <div class="col-md-8 col-md-offset-2">     
                        <div class="card">
                                <div class="card-header text-center" data-background-color="blue">
                                    <h4 class="title"><i class="material-icons">room</i>&nbsp;&nbsp;CHANGE LOCATION</h3>
                                    <p class="category">Please note if you change the location, you will not see request anymore</p>
                                    <span id="showError"></span>
                                </div>
                       
                            
                            <div style="clear:both"></div> 
                            
                            
                            
                             <div class="card-content">
                                <div>
                                   
                                    <!-- Beginnin of Form -->
                                    
                                     <form name="forAccount" id="forLocale" method="POST" onSubmit="return false;">
                                         <span class="processingError"></span>    
                                         
                                    <?php 
                                    $newGroup = "";
                                          if ($getResult) { 
                                                foreach ($getResult as $get) {

                                                    $id = $get->id;
                                                    $ndescriptOfitem = $get->ndescriptOfitem;
                                                    $nPayment = $get->nPayment;
                                                    $approvals = $get->approvals;
                                                    $dAmount = $get->dAmount;
                                                    $dLocation = $get->dAmount;
                                                    $dAccountgroup = $get->dAccountgroup;
                                                    
                                                       if($approvals == 0){
                                                     $newapproval = "Pending";
						 }else if($approvals == 1){
                                                     $newapproval = "<span style='color:red'>Awaiting HOD Approval</span>";
						 }else if($approvals == 2){
                                                     $newapproval = "<span style='color:blue'>Awaiting ICU Approval</span>";
						 }else if($approvals == 3){
                                                     $newapproval = "<span style='color:indigo'>Awaiting Payment</span>";
						 }else if($approvals == 4){
                                                     $newapproval = "<span style='color:green'>Ready for Collection</span>";
						 }else if($approvals == 5){
                                                     $newapproval = "<span style='color:red'>Not Approved By HOD</span>";
						 }else if($approvals == 6){
                                                     $newapproval = "<span style='color:grey'>Reject by ICU</span>";
						 }else if($approvals == 7){
                                                     $newapproval = "<span style='color:indigo'>Cheque Sent for Signature</span>";
						 }else if($approvals == 8){
                                                     $newapproval = "<span style='color:green'>Signed & Ready for Collection</span>";
						 }else if($approvals == 11){
                                                     $newapproval = "<span style='color:brown'>Closed</span>";
						 }else if($approvals == 12){
                                                     $newapproval = "<span style='color:brown'>Rejected By Accounts</span>";
						 }
                                                        
                                                        
                                                        if($nPayment == 1){
                                                            $newType = "Cash";
                                                        }else{
                                                            $newType = "Cheque";
                                                        }
                                                        
                                                        if($dAccountgroup == 1){
                                                            $newGroup = "Account Group-Lagos";
                                                        }else if($dAccountgroup == 2){
                                                             $newGroup = "Account Group - PH";
                                                        }else if($dAccountgroup == 3){
                                                             $newGroup = "Account Group-Abuja";
                                                        }else if($dAccountgroup == 4){
                                                             $newGroup = "Account Group-Warri";
                                                        }else if($dAccountgroup == 5){
                                                             $newGroup = "Account Group-Delta";
                                                        }
                                                        
                                                     }
                                                 }
                                    ?>
                                         
                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                            <label class="control-label" style="font-size:30px">Request Details</label><br/>
                                            <p>Description of Item : <?php echo $ndescriptOfitem; ?></p> 
                                            <p>Payment Type : <?php echo $newType; ?></p> 
                                            <p>Amount : <?php echo @number_format($dAmount); ?></p> 
                                            <p>Group: <?php echo $newGroup; ?></p> 
                                            <p>Approval: <span class="btn btn-sm btn-danger"><?php echo $newapproval; ?></span></p> 
                                            </div>
	                                </div>
                                         
                                         
                                          <?php 
                                        $getgetaccountants = $this->adminmodel->getaccountants();
                                                
                                            if ($getgetaccountants) { 
                                                $cash = "";
                                                foreach ($getgetaccountants as $get) {

                                                    $gid = $get->gid;
                                                    $accountgroupName = $get->accountgroupName;
                                                    $cash .= "<option  value=\"$gid\">" . $accountgroupName . '</option>';
                                                     }
                                                 }
                                    ?>
                                          <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Select Group Location</label>
                                                    <select class="form-control" name="groupName" id="groupName">
                                                        <option>&nbsp;</option>
                                                        <?php echo $cash; ?>    
                                                    </select>
                                                    </div>
	                                    </div>
                                         
                                         
                                         
                                                                                  
                                          <div class="col-md-12">
                                              <input type="hidden"  name="locationchanging" id="locationchanging" value="<?php echo  $id; ?>"/>
                                              <center><input id="changelocationnow" type="submit" class="btn btn-primary" value="Change" /></center>
	                                 </div>
                                         
                                           
                                     </form>

                                    
                                    <!-- End of Form -->
                                    
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