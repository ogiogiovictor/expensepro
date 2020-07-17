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
                         
                         <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">All Verified Request</h4>
	                                <p class="category">All Latest Request verified by you</p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
	                                <table class="table table-hover table-striped" id="mydata">
	                                    <thead class="text-primary">
	                                    	<th>ID</th>
	                                    	<th>Date Created</th>
	                                    	<th style="width:200px">Description of Item</th>
                                                <th>Department</th>
						<th>Payment Method</th>
                                                <th>Amount</th>
                                                <th>Approved</th>
                                                <th>Rejected</th>
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
                                                         $dAmount = $get->dAmount;
                                                         $dLocation = $get->dLocation;
                                                         $dUnit = $get->dUnit;
                                                         $addComment = $get->addComment;
                                                         $dICUwhoapproved = $get->dICUwhoapproved;
                                                         $dICUwhorejectedrequest = $get->dICUwhorejectedrequest;
                                                         $partPay = $get->partPay;
                                                         $CurrencyType = $get->CurrencyType;
                                                
                                                    if($partPay !="" && $partPay < $dAmount){
                                                       $dAmount =  number_format($partPay)."NGN";
                                                       $dAmount .= "<br/><small>Part Payment</small>";
                                                      }else{
                                                       $dAmount = number_format($dAmount);
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
                                                        	
                                                        
						 // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod) 
                                                  // approve = 3(approved by hod) approve = 4 (paid) 
                                                                                                 
						?>
                                                 <?php 
                                                   $newrandomString = random_string('alnum', 20);
                                                ?>
										 
										 
	                                     <tr>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $dateCreated; ?></td>
                                            <td><a href="#"><?php echo $ndescriptOfitem; ?></a></td>
                                            <td><?php echo $this->mainlocation->getdunit($dUnit); ?></td>
                                            <td><?php echo $nPayment; ?></td>
                                            <td><?php echo $newCurrency.$dAmount; ?></td>
                                            <td><?php echo $dICUwhoapproved; ?></td>
                                            <td><?php echo $dICUwhorejectedrequest; ?></td>
                                            <td><a href="<?php echo base_url(); ?>home/viewreqeuestdetails/<?php echo $id; ?>/<?php echo $approvals; ?>/<?php echo $newrandomString; ?>"><button class='btn btn-xs btn-facebook'>View</button></a></td>
                                            
                                           
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