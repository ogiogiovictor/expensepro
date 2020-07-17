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
                                                 $dCashierwhopaid = $get->dCashierwhopaid;
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
                                               $dAmount =  @number_format($partPay, 2)."NGN";
                                               $dAmount .= "<br/><small>Part Payment</small>";
                                              }else{
                                               $dAmount = @number_format($dAmount, 2)."NGN";
                                            }						 
						 /*
						 APPROVAL LEVEL
						// approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod) 
                                                  // approve = 3(approved by hod) approve = 4 (paid for cashiers only)
						 */
                                            $newapproval = "";
						 if($approvals == 0){
                                                     $newapproval = "Pending";
						 }else if($approvals == 1){
                                                     $newapproval = "<span style='color:red'>Approved</span>";
						 }else if($approvals == 2){
                                                     $newapproval = "<span style='color:blue'>Approved</span>";
						 }else if($approvals == 3){
                                                     $newapproval = "<span style='color:indigo'>Awaiting Payment</span>";
						 }else if($approvals == 4 && $dCashierwhopaid == ""){
                                                     $newapproval = "<span style='color:green'>Ready for Collection</span>";
						 }else if($approvals == 4 && $dCashierwhopaid != ""){
                                                     $newapproval = "<span style='color:green'> Cash Paid by by ".$this->adminmodel->getUsername($dCashierwhopaid)."</span>";
						 }else if($approvals == 5){
                                                     $newapproval = "<span style='color:red'>Not Approved By HOD</span>";
						 }else if($approvals == 6){
                                                     $newapproval = "<span style='color:grey'>Reject by ICU</span>";
						 }else if($approvals == 7){
                                                     $newapproval = "<span style='color:indigo'>Cheque Sent for Signature</span>";
						 }else if($approvals == 8 && $dCashierwhopaid == ""){
                                                     $newapproval = "<span style='color:green'>Signed & Ready for Collection</span>";
						 }else if($approvals == 8 && $dCashierwhopaid != ""){
                                                     $newapproval = "<span style='color:green'>Cheque Paid by ".$this->adminmodel->getUsername($dCashierwhopaid)."</span>";
						 }else if($approvals == 11){
                                                     $newapproval = "<span style='color:brown'>Closed</span>";
						 }else if($approvals == 12){
                                                     $newapproval = "<span style='color:red'>Rejected by Account</span>";
						 }
					         
                                                 // approvals = 11 then it is disabled inline
                                                 $randomString = random_string('alnum', 30);
						?>
										 
										 
	                                     <tr>
                                            <td><?php echo $dateCreated; ?></td>
                                            <td><?php echo $ndescriptOfitem; ?></td>
                                             <td><?php echo $benName; ?></td>
					    <td><?php echo $nPayment; ?></td>
                                            <td><?php echo $newCurrency. $dAmount; ?></td>
                                            <td style="width:200px"><?php echo  $newapproval ?></td>
                                           <td class="text-primary">
                                            <?php
                                             if($approvals == 1 || $approvals == 2 || $approvals == 3 || $approvals == 4){
                                               echo '<a href="'.base_url().'home/viewmyrequest/'.$id.'/'.$dAmount.'/'.$randomString.'"><button type="button" rel="tooltip" title="View" class="btn btn-xs btn-success">
                                                    <i class="material-icons">panorama</i>
                                                </button></a>';
                                            }else if($approvals == 8 ){
                                               echo '<a href="'.base_url().'home/viewmyrequest/'.$id.'/'.$dAmount.'/'.$randomString.'"><button type="button" rel="tooltip" title="View" class="btn btn-xs btn-success">
                                                    <i class="material-icons">panorama</i>
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