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
                                    <h4 class="title"><i class="material-icons">device_hub</i>&nbsp;&nbsp;ADD BANK / ACCOUNT NUMBER</h3>
                                    <p class="category">Setup banks and account number</p>
                                     <span id="showError"></span>
                                </div>
                                
                                
                                
                       
                             <div class="pull-right" style="margin-right:20px">
                                <button class="btn btn-xs btn-facebook"  onClick="toggle_visibility('addbank')">ADD BANK</button>
                                <a href="<?php echo base_url(); ?>"><button class="btn btn-xs btn-danger" >Close</button></a>
                            </div>
                            <div style="clear:both"></div> 
                            
                             <div id="listresult">
                                <?php
                                 $getbank = $this->adminmodel->getallBanks();
                                if($getbank){
                                    echo "<table class='table table-striped table-responsive'><tr><th>Bank Name</th><th>Account Number</th> <th>Full Address</th></tr>";
                                    foreach($getbank as $get){
                                         $id = $get->id;
                                         $bankName = $get->bankName;
                                         $accountName = $get->accountName;
                                         $bankNumber = $get->bankNumber;
                                         $address = $get->address;
                                         $state = $get->state;
                                     
                                     echo "<tr><td>$bankName<br/><small style='color:red'>$accountName</small></td><td>$bankNumber</td><td>$address $state</td></tr>";
                                    }
                                }
                                
                                echo "</table>";
                                ?>
                                
                            </div>
                            
                            
                             <div class="card-content">
                                <div class="" id="addbank" style="display:none">
                                   
                                    <!-- Beginnin of Form -->
                                    
                                     <form name="addBankaccout" id="addBankaccout" method="POST" onSubmit="return false;">
	                                   
                                                <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">BANK NAME</label>
                                                      <input type="text" name="bankName" id="bankName" class="form-control" />
                                                    </div>
	                                        </div>
	                                        
	                                        
	                                         <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Account Name</label>
                                                      <input type="text" name="acctName" id="acctName" class="form-control" />
                                                    </div>
	                                        </div>
                                         
                                          <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Acct Number</label>
                                                      <input type="text" name="actNumber" id="actNumber" class="form-control" />
                                                    </div>
	                                        </div>
                                         
                                         
                                          <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Address</label>
                                                      <input type="text" name="address1" id="address1" class="form-control" />
                                                    </div>
	                                        </div>
                                         
                                         
                                          <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">State</label>
                                                      <input type="text" name="state" id="state" class="form-control" />
                                                    </div>
	                                        </div>
                                         
                                         
                                                                                  
                                          <div class="col-md-12">
                                              <span id="insurerror"></span>
                                              <center><input id="addBankandactno" type="submit" value="Add Bank" class="btn btn-primary" /></center>
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