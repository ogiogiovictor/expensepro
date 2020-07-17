
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
                                    <h4 class="title"><i class="material-icons">attach_money</i>&nbsp;&nbsp;PAYMENT MODE SETUP</h3>
                                    <p class="category">Setup payment Mode Here</p>
                                     <span id="showError"></span>
                                </div>
                       
                             <div class="pull-right" style="margin-right:20px">
                                <button class="btn btn-xs btn-facebook"  id="addCode">ADD</button>
                                <a href="<?php echo base_url(); ?>"><button class="btn btn-xs btn-danger" >Close</button></a>
                            </div>
                            <div style="clear:both"></div> 
                            
                            
                             <div id="open">
                                <?php
                               $getpayment = $this->mainlocation->getallpayment();
                                
                                if($getpayment){
                                    echo "<table class='table table-striped table-responsive'><tr><th>S/N</th><th>Payment Type</th></tr>";
                                    foreach($getpayment as $get){
                                      $id = $get->id;
                                       $paymentType = $get->paymentType;
                                     
                                                                             
                                     echo "<tr><td>$id</td><td>$paymentType</td></tr>";
                                    }
                                }
                                
                                echo "</table>";
                                ?>
                                
                            </div>
                            
                             <div class="card-content">
                                <div class="closing" id="mainformclick">
                                   
                                    <!-- Beginnin of Form -->
                                    
                                     <form name="forpayment" id="forpayment" method="POST" onSubmit="return false;">
	                                   
                                                <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Enter Payment Mode</label>
                                                     <input type="text" name="payment" id="payment" class="form-control" />
                                                    </div>
	                                        </div>
                                         
                                         
                                                                                  
                                          <div class="col-md-12">
                                              <center><input type="submit" id="paymode" class="btn btn-primary" /></center>
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