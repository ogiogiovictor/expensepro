
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
	                                <h4 class="title">PAY CHEQUE</h4>
	                                <p class="category">Note: Transfer/Cheque Payment</p>
	                            </div>
								
                                    <p id="errorme"></p>			
	                            <div class="card-content table-responsive">
                                        
                                        <?php
                                            if($getallresult){
                                                
                                                foreach($getallresult as $get){
                                                     $transactionid = $get->id;
                                                     $dAmount = $get->dAmount;
                                                     $dAccountgroup = $get->dAccountgroup;
                                                     $cashiers = $get->cashiers;
                                                     $benName = $get->benName;
                                                     $ndescriptOfitem = $get->ndescriptOfitem;
                                                     $nPayment = $get->nPayment;
                                                }
                                            }

                                        ?>
	                               
                                        <form name="chequepreparation" id="chequepreparation" enctype="multipart/form-data" method="POST" onSubmit="return false;"> 
                                          
                                              <div class="col-md-12">
                                                    <div class="form-group">
                                                    <label class="control-label">Request Title</label>
                                                    <input type="text" class="form-control" value="<?php echo $ndescriptOfitem; ?>" disabled name="itemdescription" id="itemdescription"  />
                                                    </div>
                                            </div>
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Date</label>
                                                    <input type="text" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>" disabled name="chequeDate" id="chequeDate"  />
                                                    </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Payee</label>
                                                    <input type="text" class="form-control" name="payee" id="payee" value="<?php echo $benName; ?>" disabled  />
                                                    </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Actual Amount</label>
                                                    <input type="text" class="form-control" name="mainAount" id="mainAount" value="<?php echo $dAmount; ?>"  disabled />
                                                    </div>
                                            </div>
                                            <hr/>
                                             <div class="col-md-12"><i style='color:red'>Please confirm if you really want to pay this  cheque</i></div>
                                           
                                         <!-- <div class="col-md-12">
                                                    <div class="form-group">
                                                    <label class="control-label">Enter Payment Code</label>
                                                    <input type="text" class="form-control" name="paymentCode" id="paymentCode"  />
                                                    </div>
                                            </div> -->
                                        
                                      
                                            
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span id="insurerror"></span>
                                                <input type="hidden" name="transactID" id="transactID" value="<?php echo $transactionid; ?>" />
                                                <input type="hidden" name="acctGroup" id="acctGroup" value="<?php echo $dAccountgroup; ?>" />
                                                <input type="hidden" name="dcashierwhosentit" id="dcashierwhosentit" value="<?php echo $cashiers; ?>" />
                                                <input type="hidden" name="nPaymentTypes" id="nPaymentTypes" value="<?php echo $nPayment; ?>" />
                                                <input type="hidden" name="dAmount" id="dAmount" value="<?php echo $dAmount; ?>" />
                                                <input type="hidden" name="payee" id="payee" value="<?php echo $benName; ?>" />
                                                
                                                <input type="submit" name="notcashieradminconfirmpay" id="notcashieradminconfirmpay" value="Confirm" class="btn btn-sm btn-facebook btn-google" />
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