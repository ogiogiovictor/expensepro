
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
                         
                         <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">Approved Request</h4>
	                                <p class="category">All Approved Request</p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
	                                <table class="table table-condensed" id="mydata">
	                                    <thead class="text-primary">
	                                    	<th>Date</th>
	                                    	<th style="width:200px">Description of Item</th>
                                                 <th>Payee</th>
						<th>Payment Method</th>
                                                <th>Amount</th>
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
                                                $refID_edited= $get->refID_edited;
						$partPay = $get->partPay;
                                                $benName = $get->benName;
                                                $md5_id = $get->md5_id;
                                                $CurrencyType = $get->CurrencyType;
                                                
                                                
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
                                                
                                                
                                            if($partPay !="0.00" && $partPay < $dAmount){
                                               $dAmount =  @number_format($partPay, 2);
                                               $dAmount .= "<br/><small>Part Payment</small>";
                                              }else{
                                               $dAmount = @number_format($dAmount, 2);
                                            }						 
						 /*
						 APPROVAL LEVEL
						// approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod) 
                                                  // approve = 3(approved by hod) approve = 4 (paid for cashiers only)
						 */
                                                $newapproval = "";
						 if($approvals == 0){
                                                     $newapproval = "Draft";
						 }else{
                                                     $newapproval = "";
						 }
                                                 // approvals = 11 then it is disabled inline
                                                 $randomString = random_string('alnum', 30);
						?>
										 
										 
	                                     <tr>
                                            <td><?php echo $dateCreated; ?></td>
                                            <td><?php echo $ndescriptOfitem; ?></td>
                                             <td><?php echo $benName; ?></td>
					    <td><?php echo $nPayment; ?></td>
                                            <td><?php echo @$newCurrency. $dAmount; ?></td>
                                            <td><?php echo  $newapproval ?></td>
                                           <td class="text-primary">
                                            <?php
                                            if($approvals == 0){
                                           echo '<a href="'.base_url().'draft/draftedit/'.$id.'/'.$md5_id.'/'.$approvals.'"><button type="button" rel="tooltip" title="Edit Draft" class="btn btn-xs btn-danger">
                                                     <i class="material-icons">edit</i>
                                                </button></a>';
                                            }else{
                                                echo "";
                                            }
                                             ?>
                                           </td>
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