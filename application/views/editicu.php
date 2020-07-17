
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
                                    <h4 class="title">EDIT USER LIMIT </h3>
                                   
                                    <p class="category">Make sure you change back when neccessary</p>
                                     <span id="showError"></span>
                                </div>
                          
                            
                            
                            <div class="card-content">
                                <div class="">
                                   
                                    <!-- Beginnin of Form -->
                                    
                                     <form name="vatwitholdtax" id="editlimit" method="POST" onSubmit="return false;">
                                         <span id="showError"></span>
                                         <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">User Name</label>
                                                      <input type="text" name="userid" id="userid" class="form-control" disabled value="<?php echo $this->adminmodel->getCashierEmail($icu_userID); ?>"/>
                                                    </div>
	                                        </div>
                                         
                                        <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">User Limit</label>
                                                      <input type="text" name="userLimit" id="userLimit" class="form-control" value="<?php echo $limitAmount; ?>" />
                                                    </div>
	                                 </div>
                                         
                                         <div class="col-md-12">
                                             <input type="hidden" value="<?php echo $id; ?>" name="transID" id="transID"/>
                                              <center><input id="updateLimit" type="submit" class="btn btn-primary" value="Update"/></center>
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