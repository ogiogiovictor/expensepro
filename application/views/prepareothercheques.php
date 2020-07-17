
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
	                                <h4 class="title">PREPARE CHEQUE</h4>
	                                <p class="category"></p>
	                            </div>
								
                                    <p id="errorme"></p>			
	                            <div class="card-content table-responsive">
	                               
                                        <?php
                                        if($getResult){
                                            
                                            foreach($getResult as $get){
                                                $actid = $get->id;
                                                $Amount = $get->Amount;
                                                $userID = $get->userID;
                                                $requesterEmail = $get->requesterEmail;
                                                $paidTo = $get->paidTo;
                                            }
                                        }
                                        ?>
                                        <form name="preparecashiercheques" id="preparecashiercheques" enctype="multipart/form-data" method="POST" onSubmit="return false;"> 
                                         
                                          
                                                
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <span id="bankerror">Payee</span>
                                                <input type="text" name="dPayee" id="dPayee" value="<?php echo $paidTo; ?>" disabled  class="form-control" />
                                            </div>
                                            </div>
                                                
                                                
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <span id="bankerror">Amount</span>
                                                <input type="text" name="dAmount" id="dAmount" value="<?php echo $Amount; ?>" disabled  class="form-control" />
                                            </div>
                                            </div>
                                            
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                    <span id="bankerror">Date</span>
                                                    <input type="text" class="form-control datepicker" name="dateprepared" id="dateprepared" placeholder="yyyy-mm-dd"  />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <span id="bankerror">Cheque #Number</span>
                                                <input type="text" name="cheQueNo" id="cheQueNo" class="form-control" />
                                            </div>
                                         </div>
                                                
                                            <?php 
                                                $getbank = $this->adminmodel->getallBanks();

                                                if ($getbank) { 
                                                $dBank = "";
                                                foreach ($getbank as $get) {

                                                    $id = $get->id;
                                                    $bankName = $get->bankName;
                                                    $bankNumber = $get->bankNumber;
                                                    $dBank .= "<option  value=\"$bankNumber\">" . $bankName . '</option>';
                                                     }
                                                 }
                                            
                                           ?>
                                        
                                        <div class="col-md-12">
                                                    <div class="form-group">
                                                    <label class="control-label">Select Bank</label>
                                                    <select class="form-control" id="dBank" name="dBank"> 
                                                        <option value="">Select Bank</option>
                                                        <?php echo $dBank; ?>
                                                    </select>
                                                    </div>
	                                </div>
                                        
                                        
                                         
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span id="errorCase"></span>
                                                <input type="hidden" name="sentID" id="sentID" value="<?php echo $actid; ?>" />
                                                <input type="hidden" name="dAmount" id="dAmount" value="<?php echo $Amount; ?>"/>
                                                 <input type="hidden" name="dPayee" id="dPayee" value="<?php echo $requesterEmail; ?>"/>
                                                <input type="submit" name="chequeforcashier" id="chequeforcashier" value="Prepare Cheque" class="btn btn-sm btn-facebook btn-google" />
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