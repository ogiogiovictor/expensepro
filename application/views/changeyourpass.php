
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
	                                <h4 class="title">PASSWORD RESET</h4>
	                                <p class="category"></p>
	                            </div>
								
                                    <p id="errorme"></p>			
	                            <div class="card-content table-responsive">
	                               
                                       
                                        <form name="processemailchecks" id="processemailchecks" enctype="multipart/form-data" method="POST" onSubmit="return false;"> 
                                         
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <span id="bankerror">Email Address</span>
                                                <input type="text" name="emailAddress" id="emailAddress" placeholder="Enter email address" class="form-control" />
                                            </div>
                                            </div>
                                                
                                        
                                        
                                         
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span id="errorCase"></span>
                                                <input type="submit" name="sendpassReset" id="sendpassReset" value="Change Passoword" class="btn btn-sm btn-facebook btn-google" />
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