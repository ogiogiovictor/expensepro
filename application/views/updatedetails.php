
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
                         
                         <div class="col-md-6">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">UPDATE RECORD</h4>
	                                <p class="category"></p>
	                            </div>
								
                                    <p id="errorme"></p>			
	                            <div class="card-content table-responsive">
	                               
                                        <?php
                                            if($getRequest){
                                                foreach($getRequest as $get){
                                                    $uid = $get->id;
                                                    $uemail = $get->email;
                                                    $fname = $get->fname;
                                                    $lname = $get->lname;
                                                    $dUnit = $get->dUnit;
                                                    $uLocation = $get->uLocation;
                                                    $alternativeEmail = $get->alternativeEmail;
                                                    $phone = $get->phone; 
                                                }
                                            }
                                       ?>
                                       
                                        <form name="processemailchecks" id="processemailchecks" enctype="multipart/form-data" method="POST" onSubmit="return false;"> 
                                            <div class="requireError"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <span id="bankerror">First Name</span>
                                                    <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>" class="form-control" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <span id="bankerror">Last Name</span>
                                                    <input type="text" name="lname" id="lname" value="<?php echo $lname; ?>" class="form-control" />
                                                </div>
                                            </div>
                                            
                                            
                                            <?php 
                                            $allLocation = "";
                                                if($getLocale){
                                                    foreach($getLocale as $getloc){
                                                        $unitID = $getloc->id;
                                                        $locationName = $getloc->locationName;
                                                        
                                                        $allLocation .= "<option value='$unitID'>$locationName</option>";
                                                    }
                                                }
                                            ?>
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                    <span id="bankerror">Select Location</span>
                                                    <select class="form-control" name="fLocation" id="fLocation">
                                                        <option value="<?php echo $uLocation; ?>"><?php echo $this->mainlocation->getdLocation($uLocation); ?></option>
                                                        <?php echo $allLocation; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                          
                                            
                                              <?php 
                                            $allUnit = "";
                                                if($getUnit){
                                                    foreach($getUnit as $getunit){
                                                        $idUnit = $getunit->id;
                                                        $unitName = $getunit->unitName;
                                                        
                                                        $allUnit .= "<option value='$idUnit'>$unitName</option>";
                                                    }
                                                }
                                            ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <span id="bankerror">Select Unit</span>
                                                    <select class="form-control" name="fUnit" id="fUnit">
                                                        <option value="<?php echo $dUnit; ?>"><?php echo $this->mainlocation->getdunit($dUnit); ?></option>
                                                        <?php echo $allUnit; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            
                                           
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <span id="bankerror">Primary Email</span>
                                                   <input type="text" name="mainEmail" id="mainEmail" value="<?php echo $email; ?>" disabled class="form-control" /> 
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <span id="bankerror">Alternative Email</span>
                                                   <input type="text" name="altEmail" id="altEmail" value="<?php echo @$alternativeEmail; ?>" class="form-control" /> 
                                                </div>
                                            </div>
                                            
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                    <span id="bankerror">Phone Number</span>
                                                   <input type="number" name="phoneNum" id="phoneNum" value="<?php echo @$phone; ?>" class="form-control" /> 
                                                </div>
                                            </div>
                                            
                                         
                                         
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span id="errorCase"></span>
                                                 <input type="hidden" name="pEmail" id="pEmail" value="<?php echo $email; ?>" class="form-control" /> 
                                                <input type="submit" name="updateProfileRecord" id="updateProfileRecord" value="Update Profile" class="btn btn-sm btn-facebook" />
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