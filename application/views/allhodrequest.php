	<div class="wrapper">
	    <div class="sidebar" data-color="blue" data-image="<?php echo base_url(); ?>assets/img/sidebar-1.jpg">

			<!--
		        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
                        colors : #113c7f, #5e82bb
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
                         
                         <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">My Approved Request</h4>
	                                <p class="category">All request approved by me</p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
	                                <table class="table table-condensed table-hover" id="mydata">
	                                    <thead class="text-primary">
	                                    	<th>ID</th>
                                                <th style="padding-right:10px">Date</th>
	                                    	<th style="width:200px; padding-left:10px">Description of Item</th>
						<th>Requester</th>
                                                <th>Payment Method</th>
                                                <th>Amount</th>
                                                <th>Payee</th>
						<th>Status</th>
                                                <th>Action</th>
	                                    </thead>
	                                    <tbody>
	                                     
                                             <?php if ($getallresult) { ?>
					  <?php
                                             foreach ($getallresult as $get) {
						$id = $get->id;
						$dateCreated = $get->dateCreated;
						$ndescriptOfitem = $get->ndescriptOfitem;
						$nPayment = $this->mainlocation->getpaymentType($get->nPayment);
						$approvals = $get->approvals;
						$hod = $get->hod;
						$icus = $get->icus;
						$cashiers = $get->cashiers;
						$sessionID = $get->sessionID;
						$dateRegistered = $get->dateRegistered;
                                                $dAmount= $get->dAmount;
						$partPay = $get->partPay;
                                                $fullname = $get->fullname;
                                                $benName = $get->benName;
                                                $CurrencyType = $get->CurrencyType;
                                                $whichapp = $get->from_app_id;
                                                 
                                                
                                            if($partPay !="0.00" && $partPay < $dAmount){
                                               $dAmount =  @number_format($partPay)."NGN";
                                               $dAmount .= "<br/><small>Part Payment</small>";
                                              }else{
                                               $dAmount = @number_format($dAmount);
                                            }
                                            
                           if($CurrencyType == 'naira'){
                                                    $newCurrency = '<span>&#8358;</span>';
                                                }else if($CurrencyType == 'dollar'){
                                                    $newCurrency = '<span>&#x0024;</span>';
                                                }else if($CurrencyType == 'euro'){
                                                    $newCurrency = '<span>&#8364;</span>';
                                                }else if($CurrencyType == 'pounds'){
                                                    $newCurrency = '<span>&#163;</span>';
                                                }else if($CurrencyType == 'yen'){
                                                    $newCurrency = '<span>&#165;</span>';
                                                }else if($CurrencyType == 'singaporDollar'){
                                                    $newCurrency = '<span>S&#x0024;</span>';
                                                }else if($CurrencyType == 'AED'){
                                                    $newCurrency = '<span>(AED)</span>';
                                                }else if($CurrencyType == 'rupee'){
                                                    $newCurrency = '<span>&#8377;</span>';
                                                }else{
                                                   
                                                    if($CurrencyType != ""){
                                                      $newCurrency = @$this->generalmd->getsinglecolumnfromotherdb("curr_symbol", "currencies", "curr_abrev", $CurrencyType); 
                                                    }else if($CurrencyType == "null" || $CurrencyType == ""){
                                                        $newCurrency =  '<span>&#8358;</span>';
                                                    }else{
                                                        $newCurrency =  '<span>&#8358;</span>';
                                                    }
                                                    
                                                }               
                                                    

                                                  $newapproval = $this->generalmd->getsinglecolumn("name", "approval_type", "approval_type",  $approvals);
						
					         
                                                 $randomString = random_string('alnum', 60);
                                                 
                                                 if($whichapp == '3'){
                                                    $vendor = $this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "USER_ID", $benName);
                                                    }else if($whichapp == '0' && is_numeric($benName)){
                                                          $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($whichapp == '0' && !is_numeric($benName)){
                                                         $vendor =  $benName;
                                                    }else if($whichapp == '5'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($whichapp == '6'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($whichapp == '8'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else{
                                                        $vendor =  $benName;
                                                    }
						?>
										 
										 
	                                     <tr>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $dateCreated; ?></td>
                                            <td style="padding-left:10px"><?php echo $ndescriptOfitem; ?></td>
                                            <td><?php echo $fullname; ?></td>
					    <td><?php echo $nPayment; ?></td>
                                            <td><?php echo $newCurrency.$dAmount; ?></td>
                                             <td style="padding-right:10px"><?php echo $vendor; ?></td>
                                            <td><?php echo  $newapproval ?></td>
                                            <td><a href="<?php echo base_url(); ?>home/viewreqeuestdetails/<?php echo $id; ?>/<?php echo $approvals; ?>/<?php echo $randomString; ?>"><button class='btn btn-xs btn-facebook'>View</button></a></td>
                                            
                                            
	                                    </tr>
											
					<?php } ?>

                                         <?php } ?>	
											
	                                    </tbody>
	                                </table>

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