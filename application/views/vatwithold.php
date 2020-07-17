
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
                                    <h4 class="title"><i class="material-icons">device_hub</i>&nbsp;&nbsp;Value Added Tax(VAT) </h3>
                                   
                                    <p class="category">Setup Vat and Withoding Tax</p>
                                     <span id="showError"></span>
                                </div>
                            <div class="pull-right" style="margin-right:20px">
                                <button class="btn btn-xs btn-facebook"  onClick="toggle_visibility('addTax')">Add VAT</button>
                                <a href="<?php echo base_url(); ?>"><button class="btn btn-xs btn-danger" >Back</button></a>
                            </div>
                            <div style="clear:both"></div> 
                            
                            <div id="listresult">
                                <?php
                                $getTaxresult = $this->allresult->getalltaxresult();
                                if($getTaxresult){
                                    echo "<table class='table table-striped table-responsive'><tr><th>Details</th><th>VAT Percent</th> <th>VAT by %100</th><th>VAT Account</th></tr>";
                                    foreach($getTaxresult as $get){
                                        $id = $get->id;
                                        $vat = $get->vat;
                                        $percentage = $get->vat_percentage;
                                        $accountVat = $get->account_vat;
                                     
                                     echo "<tr><td>VAT</td><td>$vat</td><td>$percentage</td><td>$accountVat</td></tr>";
                                    }
                                }
                                
                                echo "</table>";
                                ?>
                                
                            </div>
                            
                            
                            <div class="card-content">
                                <div class="" style="display:none" id="addTax">
                                   
                                    <!-- Beginnin of Form -->
                                    
                                     <form name="vatwitholdtax" id="vatwitholdtax" method="POST" onSubmit="return false;">
	                                   
                                        
                                         <center><h2>STATUTORY CHARGES</h2></center>
                                        <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>VAT % <small>(will be calculated base on 100%)</small></label>
                                                      <input type="number" name="vat" number="vat" id="vat" class="form-control" />
                                                    </div>
	                                </div>
                                         
                                         
                                          <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>ACCOUNT NO VAT% <small>(will be calculated base on 100%)</small></label>
                                                      <input type="text" name="vatactnumber"  id="vat" class="form-control" />
                                                    </div>
	                                  </div>
                                         
                                       
                                                                                  
                                          <div class="col-md-12">
                                              <span id="insurerror"></span>
                                              <center><input id="addgovlevies" type="submit" value="Submit" class="btn btn-primary" /></center>
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