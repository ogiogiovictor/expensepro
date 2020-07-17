
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
                                    <h4 class="title"><i class="material-icons">device_hub</i>&nbsp;&nbsp;CATEGORY MODE SETUP</h3>
                                    <p class="category">All category Setup is done within this portion</p>
                                     <span id="showError"></span>
                                </div>
                       
                             <div class="card-content">
                                <div class="">
                                   
                                    <!-- Beginnin of Form -->
                                    
                                     <form name="accessme" id="accessme" method="POST" onSubmit="return false;">
	                                   
                                                <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Enter Category Name</label>
                                                      <input type="text" name="categoryName" id="categoryName" class="form-control" />
                                                    </div>
	                                        </div>
                                         
                                         
                                                                                  
                                          <div class="col-md-12">
                                              <center><input id="createCategory" type="submit" class="btn btn-primary" /></center>
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