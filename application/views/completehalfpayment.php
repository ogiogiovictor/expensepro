
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
                         
                         <div class="col-md-8">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">BALANCE PAYMENT</h4>
	                                <p class="category">Note: You cannot pay beyond the balance
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          
                                        </p>
	                            </div>
								
                                    <p id="errorme"></p>			
	                            <div class="card-content table-responsive">
                                        
                                        <?php
                                            if($getChequeresult){
                                                
                                                foreach($getChequeresult as $get){
                                                     $nid = $get->id;
                                                     $Amount = $get->dAmount;
                                                     $partpayAmount = $get->partPay;
                                                     $paidByAcct = $get->dCashierwhopaid;
                                                     $ndescriptOfitem = $get->ndescriptOfitem;
                                                     $userID = $get->sessionID;
                                                     //$app_urL = $get->app_urL;
                                                     $dateCreated = $get->dateCreated;
                                                     //$chequeNo = $get->chequeNo;
                                                     //$dBank = $get->dBank;
                                                     $type = $get->nPayment;
                                                     
                                                     $balancepay = $Amount - $partpayAmount;
                                                }
                                            }

                                        ?>
	                               
                                        <form name="startpartpayment" id="startpartpayment" enctype="multipart/form-data" method="POST" onSubmit="return false;"> 
                                         
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Date Created</label>
                                                    <input type="text" class="form-control" readonly value="<?php echo $dateCreated; ?>" name="datepaid" id="datepaid"  />
                                                    </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Title</label>
                                                    <input type="text" class="form-control" readonly name="nDescription" id="nDescription" value="<?php echo $ndescriptOfitem; ?>" disabled  />
                                                    </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Type</label>
                                                    <input type="text" class="form-control" readonly name="type" id="type" value="<?php echo $this->mainlocation->getpaymentType($type); ?>"  disabled />
                                                    </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Actual Amount</label>
                                                    <input type="text" class="form-control" readonly value="<?php echo $Amount; ?>" name="aAmount" id="aAmount"  />
                                                    </div>
                                            </div>
                                           
                                             <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Part Payment(Amount Paid)</label>
                                                    <input type="text" class="form-control" readonly value="<?php echo $partpayAmount; ?>" name="paypaybalance" id="paypaybalance"  />
                                                    </div>
                                            </div>
                                            
                                             <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Balance</label>
                                                    <input type="text" class="form-control" readonly value="<?php echo $balancepay; ?>" name="balancepay" id="balancepay"  />
                                                    </div>
                                            </div>
                                            
                                        
                                        <!--<div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Cheque Number(#)</label>
                                                    <input type="text" class="form-control" disabled value="" name="chequeNo" id="chequeNo"  />
                                                    </div>
                                            </div>
                                            
                                         <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Bank</label>
                                                    <input type="text" class="form-control" disabled value="" name="chequeNo" id="chequeNo"  />
                                                    </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Paid By</label>
                                                    <input type="text" class="form-control" disabled value="" name="chequeNo" id="chequeNo"  />
                                                    </div>
                                            </div> -->
                                            
                                            
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
                                        
                                        <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Select Bank</label>
                                                    <select class="form-control" id="newBank" name="newBank"> 
                                                        <option value="">Select Bank</option>
                                                        <?php echo $dBank; ?>
                                                    </select>
                                                    </div>
	                                </div>
                                            
                                            
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                  <label class="control-label">New Cheque No</label>
                                                    <input type="text" class="form-control"  name="newChequeNo" id="newChequeNo"  />
                                                    </div>
                                            </div>
                                            
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Amount</label>
                                                    <input type="text" class="form-control"  name="newAmountopay" id="newAmountopay"  />
                                                    </div>
                                            </div>
                                           
                                            
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span id="errorbalance"></span>
                                                <input type="hidden" name="requestID" id="requestID"  value="<?php echo $nid; ?>"/>
                                                <input type="hidden" name="userID" id="userID"  value="<?php echo $userID; ?>"/>
                                                <input type="hidden" name="userID" id="userID"  value="<?php echo $userID; ?>"/>
                                                <input type="submit" name="partpaymentbalance" id="partpaymentbalance" value="Confirm" class="btn btn-sm btn-facebook btn-google" />
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