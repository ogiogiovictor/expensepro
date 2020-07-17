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
	                                <h4 class="title">SEND REIMBURSEMENT TO ACCOUNT</h4>
	                                <p class="category">Please make sure you identify with your group location</p>
	                            </div>
								
                                    <p id="errorme"></p>			
	                            <div class="card-content table-responsive">
	                               
                                        <form name="chequetogenerate" id="bankselected" enctype="multipart/form-data" method="POST" onSubmit="return false;"> 
                                          <!---  FOR ACCOUNT BANK ALERT -->
                                        <?php 
                                          $getaccount = $this->adminmodel->getreimbursementrequest();
                                                
                                                 if ($getaccount) { 
                                                $dnewacc = "";
                                                foreach ($getaccount as $get) {

                                                    $gid = $get->gid;
                                                    $accountgroupName = $get->accountgroupName;
                                                    
                                                    $dnewacc .= "<option  value=\"$gid\">" . $accountgroupName . '</option>';
                                                     }
                                                 }
                                   
                                           ?>
                                        
                                        <div class="col-md-12">
                                                    <div class="form-group">
                                                    <label class="control-label">Select Account Group</label>
                                                    <select name="daccountant" id="daccountant" class="form-control">
                                                        <option value="0">Select</option>
                                                        <?php echo $dnewacc ?>
                                                    </select>
                                                    </div>
	                                 </div>
                                        
                                        <?php
                                        
                                        if($getallresult){
                                            
                                            foreach($getallresult as $get){
                                                $id = $get->id;
                                                $Amount  = $get->Amount;
                                            }
                                            
                                        }
                                        
                                        ?>
                                        
                                          <div class="col-md-12">
                                                    <div class="form-group">
                                                    <label class="control-label">Amount</label>
                                                    <input type="text" class="form-control" value="<?php echo $Amount; ?>" disabled=""/>
                                                    </div>
	                                 </div>
                                          
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span id="showcasherror"></span>
                                                <input type="hidden" class="form-control" value="<?php echo $id; ?>" id="sendformID" name="sendformID"/>
                                                <input type="submit" name="sendforreimbursementasforrembursement" id="sendforreimbursementasforrembursement" value="Send for Reimbursement" class="btn btn-sm btn-facebook btn-google" />
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