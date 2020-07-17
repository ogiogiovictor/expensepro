
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
                                        <h4 class="title">PENDING RETIREMENT</h4> 
                                        <p class="category">(Account Recievable)</p>
                                       
	                            </div>
						 		
								
	                            <div class="card-content table-responsive">
                                        <div id="errorMe"></div>
	                                <table class="table table-condensed table-hover" id="mydata">
	                                    <thead class="text-primary">
                                                <th>ID</th>
	                                    	<th>Date Created</th>
	                                    	<th style="width:150px">Description of Item</th>
                                                <th>Amount Collected</th>
                                                <th>Amount Retired</th>
                                                <th>Balance</th>
                                                <th>Beneficiary</th>
                                                <th>Status</th>
                                                <th style="width:100px">&nbsp;</th>
	                                    </thead>
	                                    <tbody>
	                                     
						<?php if ($getResult) { ?>
                                                
                                                
						<?php
                                                    foreach ($getResult as $get) {
                                                         $id = $get->rID;
                                                         $dateCreated = $get->dateCreated;
							 $requestID = $get->requestID;
							 $title = $get->title;
                                                         $CurrencyType = $get->currency;
							 $nPayment = $get->nPayment;
							 $approvals = $get->approvals;
							 $paidAmount = $get->paidAmount;
							 $retiredAmount = $get->retiredAmount;
							 $myBalance = $get->myBalance;
							 $hod = $get->hod;
                                                         $icu = $get->icu;
                                                         $dgroup = $get->dgroup;
                                                         $userID = $get->userID;
                                                         $userEmail = $get->userEmail;
                                                         $userName = $get->userName;
                                                         $auditTrail = $get->auditTrail;
                                                         $dateConfirmed = $get->dateConfirmed;
                                                         $clocation = $get->clocation;
                                                         $cUnit = $get->cUnit;
                                                         $dType = $get->dType;   
                                                         $icuSeen = $get->icuSeen;   
                                                         
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
                                                        
                                                        if($approvals == 0){
                                                            $newapproval = "<span class='btn btn-xs btn-default'>pending</span>";
                                                        }else if($approvals == 1){
                                                             $newapproval = "<span class='btn btn-xs btn-success'>Sent for Reimbursement</span>";
                                                            
                                                        }else if($approvals == 2){
                                                             $newapproval = "<span class='btn btn-xs btn-secondary'>With HOD</span>";
                                                        }else if($approvals == 3){
                                                            $newapproval = "<span class='btn btn-xs btn-danger'>with ICU</span>";
                                                        }else if($approvals == 4){
                                                            $newapproval = "<span class='btn btn-xs btn-danger'>with Account</span>";
                                                        }else if($approvals == 5){
                                                            $newapproval = "<span class='btn btn-xs btn-danger'>Rejected</span>";
                                                        }else if($approvals == 6){
                                                            $newapproval = "<span class='btn btn-xs btn-danger'>Paid</span>";
                                                        }
						?>
                                             			 
	                                     <tr>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $dateCreated; ?></td>
                                             <td><?php echo $title; ?></td>
                                            <td><?php echo $newCurrency. @number_format($paidAmount, 2); ?></td>
                                            <td><?php echo $newCurrency. @number_format($retiredAmount, 2); ?></td>
                                            <td><?php echo  @number_format($myBalance, 2); ?></td>
                                            <td><?php echo $userName; ?></td>
                                            <td><?php echo $newapproval; ?></td>
                                            <td> 
                                                <a href="<?php echo base_url(); ?>recieveables/reciViewXdetails/<?php echo $requestID; ?>"><button class="btn-xs btn-warning"><i class="fa fa-picture-o"></i></button></a>
                                                <?php
                                                if($myBalance < 0 &&  $approvals != 2 && $getApprovalLevel == 7){
                                                    echo "<a href='".base_url()."recieveables/makepaymentoexpensepro/$id'><button title='Make Payment' class='btn btn-xs btn-danger'>P</button></a>";
                                                }
                                                ?>
                                                
                                                 <?php
                                                if($myBalance < 0 &&  $approvals != 2 && $getApprovalLevel == 4){
                                                    echo "<a href='".base_url()."recieveables/makepaymentoexpensepro/$id'><button title='Make Payment' class='btn btn-xs btn-danger'>P</button></a>";
                                                }
                                                ?>
                                                
                                                <?php
                                                if($myBalance < 0 &&  $approvals != 6 && $getApprovalLevel == 6){
                                                    echo "<a href='".base_url()."recieveables/makepaymentoexpensepro/$id'><button title='Make Payment' class='btn btn-xs btn-success'>P</button></a>";
                                                }
                                                ?>
                                                <?php
                                                if($paidAmount == $retiredAmount && $approvals != 2 && $approvals != 1 && $getApprovalLevel == 7){
                                                echo "<button onClick='buildconfirmation($requestID)' class='btn btn-xs btn-danger' title='Confirm Request'>C</button>";
                                                }
                                                ?>
                                                
                                                <?php
                                                if($icuSeen == 'no' && $getApprovalLevel == 3){
                                                echo "<button title='Verify Request' onClick='verifyRequest($requestID)' class='btn btn-xs btn-primary' '>V</button>";
                                                }
                                                ?>
                                                
                                                <?php
                                                if($approvals == 2 && $getApprovalLevel == 2 || $getApprovalLevel == 5){
                                                echo "<button title='Approve Request' onClick='verifyforhod($requestID)' class='btn btn-xs btn-primary' '><i class='fa fa-check'></i></button>";
                                                }
                                                ?>
                                                
                                                <?php
                                                if($icuSeen == 'no' && $getApprovalLevel == 6){
                                                echo "<button title='Verify Request' onClick='verifyRequest($requestID)' class='btn btn-xs btn-primary' '>V</button>";
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