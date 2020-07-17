
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
                                    <h4 class="title">&nbsp;&nbsp;DATABASE TABLES</h3>
                                    
                                    
                                </div>
                       
                            <div class="addform" style="margin-top:10px; padding:10px">
                               
                              <?php
                               if($getSet){
                                   echo "<table class='table table-responsive table-hovered'><tr><th>Table Name</th><th>Action</th></tr>";
                                   foreach($getSet as $value){
                                        foreach($value as $get){
                                            echo "<tr><td>$get</td><td><a href='".base_url()."framework/legit/settings/nr/codebase/settingsc/getTabdetails/$get'>View</a>"
                                                    . "&nbsp;&nbsp; <a href='".base_url()."framework/legit/settings/nr/codebase/settingsc/expenseprodrop/$get'>Drop</a></td></tr>";
                                        }
                                   }
                               }
                               echo "</table>";
                              ?>
                            </div>
                            <hr/>
                            
                            
                            
                             <div class="card-content">
                                <div  id="dynamicload">
                                   
                                    <!-- Beginnin of Form -->
                                 <span id="hotelMsg"></span>
                                    <div>
                                        
                                       two
                                    </div>
                                    
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
      