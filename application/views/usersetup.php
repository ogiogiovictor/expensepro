
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
                                    <h4 class="title"><i class="material-icons">perm_identity</i>&nbsp;&nbsp;USER MODE SETUP</h3>
                                    <p class="category">This determine which access level the user is placed in</p>
                                    <span id="showError"></span>
                                </div>
                       
                             <div class="card-content">
                                <div class="">
                                   
                                    <!-- Beginnin of Form -->
                                    
                                    <form name="createUser" id="createUser" method="POST" onSubmit="return false;">
	                                   
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">First Name</label>
                                                    <input name="fname" id="fname" type="text" class="form-control" required /> 
                                                    </div>
	                                        </div>
                                         
                                         
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Last Name</label>
                                                    <input name="lname" id="lname" type="text" class="form-control"  required/> 
                                                    </div>
	                                        </div>
                                         
                                         
                                                <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Email Address</label>
                                                   <input name="email" id="email" type="email" class="form-control" required />  
                                                    </div>
	                                        </div>
                                         
                                   <?php 
                                        $getallaccess = $this->mainlocation->getallaccess();

                                         if ($getallaccess) { 
                                        $cat = "";
                                        foreach ($getallaccess as $get) {

                                            $id = $get->id;
                                            $accesstype = $get->accesstype;
                                            $cat .= "<option  value=\"$id\">" . $accesstype . '</option>';
                                             }
                                         }
                                   
                                    ?>
                                        
                                         <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Access Level</label>
                                                    <select class="form-control" name="sAccess" id="sAccess">
                                                        <option>Select Access Level</option>
                                                        <?php echo $cat; ?>
                                                    </select>
                                                    </div>
	                                        </div>
                                         
                                
                                 <?php 
                                        $getlocation = $this->mainlocation->getalllocation();

                                         if ($getlocation) { 
                                        $cat2 = "";
                                        foreach ($getlocation as $get) {

                                            $id = $get->id;
                                            $locationName = $get->locationName;
                                            $cat2 .= "<option  value=\"$id\">" . $locationName . '</option>';
                                             }
                                         }
                                   
                                    ?>
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Location</label>
                                                    <select class="form-control" name="sLocation" id="sLocation">
                                                        <option>Select Location</option>
                                                        <?php echo  $cat2; ?>
                                                    </select>
                                                    </div>
	                                        </div>
                                                                                  
                                          <div class="col-md-12">
                                              <center><input id="postCreateUser"  type="submit" class="btn btn-primary" /></center>
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