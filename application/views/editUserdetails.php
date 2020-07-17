
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
	                                <h4 class="title">EDIT USER DETAILS</h4>
	                                <p class="category">User Details Preference <span class="btn btn-xs btn-google pull-right"><a href="<?php echo base_url(); ?>action/disableduser">Back</a></span></p>
	                            </div>
								
                                    <p id="errorme"></p>			
	                            <div class="card-content table-responsive">
	                               
                                        <form name="bankselected" id="bankselected" enctype="multipart/form-data" method="POST" onSubmit="return false;"> 
                                         <?php 
                                               
                                                if ($detailsresult) { 
                                                foreach ($detailsresult as $get) {
                                                         $id = $get->id;
                                                         $fname = $get->fname;
                                                         $lname = $get->lname;
                                                         $email = $get->email;
                                                         $dUnit = $get->dUnit;
                                                         $passwordCount = $get->passwordCount;
                                                         $accessLevel = $get->accessLevel;
                                                         $uLocation = $get->uLocation;
                                                         $activation = $get->activation;
                                                         $activationstring = $get->activationstring;
                                                         $userStatus = $get->userStatus;
                                                         $lastlogin = $get->lastlogin;
                                                         $user_agent = $get->user_agent;
                                                         $user_ip = $get->user_ip;
                                                         $dateCreated = $get->dateCreated;
                                                         if($accessLevel == 1){
                                                             $newaL = "USER";
                                                         }else if($accessLevel == 2){
                                                             $newaL = "HOD";
                                                         }else if($accessLevel == 3){
                                                             $newaL = "ICU";
                                                         }else if($accessLevel == 4){
                                                             $newaL = "CASHIER";
                                                         }else if($accessLevel == 5){
                                                             $newaL = "ADMIN";
                                                         }else if($accessLevel == 6){
                                                             $newaL = "SUPER ADMIN";
                                                         }else if($accessLevel == 7){
                                                             $newaL = "ACCOUNT";
                                                         }else if($accessLevel == 8){
                                                             $newaL = "SUPER ACCOUNT";
                                                         }
                                                   
                                                     }
                                                 }
                                            
                                           ?>
                                        
                                        <div class="col-md-3">
                                                   <div class="form-group">
                                                    <label class="control-label">First Name</label>
                                                    <input type="text" value="<?php echo $fname; ?>" disabled class="form-control" name="fName" id="fName" />
                                                    </div>
	                                </div>
                                            
                                       <div class="col-md-3">
                                                   <div class="form-group">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text" value="<?php echo $lname; ?>" disabled class="form-control" name="fName" id="fName" />
                                                    </div>
	                                </div>
                                            
                                            
                                       <div class="col-md-3">
                                                   <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                    <input type="text" value="<?php echo $email; ?>" disabled class="form-control" name="fName" id="fName" />
                                                    </div>
	                                </div>
                                            
                                       <div class="col-md-3">
                                                   <div class="form-group">
                                                    <label class="control-label">Unit</label>
                                                    <input type="text" value="<?php echo $this->mainlocation->getdunit($dUnit); ?>" disabled class="form-control" name="fName" id="fName" />
                                                    </div>
	                                </div>
                                            
                                        <div class="col-md-3">
                                                   <div class="form-group">
                                                    <label class="control-label">Password Count</label>
                                                    <input type="text" value="<?php echo $passwordCount; ?>" disabled class="form-control" name="fName" id="fName" />
                                                    </div>
	                                </div>
                                            
                                         <div class="col-md-3">
                                                   <div class="form-group">
                                                    <label class="control-label">Access Level</label>
                                                    <input type="text" value="<?php echo $newaL; ?>" disabled class="form-control" name="fName" id="fName" />
                                                    </div>
	                                </div>
                                            
                                         <div class="col-md-3">
                                                   <div class="form-group">
                                                    <label class="control-label">Location</label>
                                                    <input type="text" value="<?php echo $this->mainlocation->getdLocation($uLocation); ?>" disabled class="form-control" name="fName" id="fName" />
                                                    </div>
	                                </div>
                                            
                                         <div class="col-md-3">
                                                   <div class="form-group">
                                                    <label class="control-label">Status</label>
                                                    <input type="text" value="<?php echo $activation; ?>" disabled class="form-control" name="fName" id="fName" />
                                                    </div>
	                                </div>
                                            
                                        
                                        <div class="col-md-3">
                                                   <div class="form-group">
                                                    <label class="control-label">Last Login</label>
                                                    <input type="text" value="<?php echo $lastlogin; ?>" disabled class="form-control" name="fName" id="fName" />
                                                    </div>
	                                </div>
                                            
                                        <div class="col-md-3">
                                                   <div class="form-group">
                                                    <label class="control-label">User ip</label>
                                                    <input type="text" value="<?php echo $user_ip; ?>" disabled class="form-control" name="fName" id="fName" />
                                                    </div>
	                                </div>
                                        
                                       <div class="col-md-3">
                                                   <div class="form-group">
                                                    <label class="control-label">Date Register</label>
                                                    <input type="text" value="<?php echo $dateCreated; ?>" disabled class="form-control" name="fName" id="fName" />
                                                    </div>
	                                </div>
                                        
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span id="activationError"></span>
                                                <!--<input type="submit" name="editUserdetial" id="editUserdetial" value="Submit" class="btn btn-sm btn-facebook btn-google" />-->
                                                <input type="hidden" name="hiddenID" id="hiddenID" value="<?php echo $id; ?>" />
                                                &nbsp;&nbsp;&nbsp;<input type="submit" name="resendEmailActivation" id="resendEmailActivation" value="Resend Activation Email" class="btn btn-sm btn-facebook btn-facebook" />
                                                &nbsp;&nbsp;&nbsp;<input type="submit" name="resendpasswordreset" id="resendpasswordreset" value="Resend Password Reset" class="btn btn-sm btn-warning" />
                                                 &nbsp;&nbsp;&nbsp;<input type="submit" name="resendpasswordreset" id="resendpasswordreset" value="Enable Request" class="btn btn-sm btn-warning" />
                                            </div>
	                                </div>
                                        </form>   

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