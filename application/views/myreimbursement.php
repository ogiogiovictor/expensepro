
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
	                                <h4 class="title">My Cash Reimbursement</h4>
	                                <p class="category">All Reimbursement Request</p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
	                                <table class="table table-condensed" id="mydata">
	                                    <thead class="text-primary">
	                                    	<th>Date Created</th>
	                                    	<th style="width:200px">Description of Item</th>
                                                <th>Location</th>
						<th>Payment Method</th>
                                                <th>Amount</th>
						<th>Status</th>
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
                                                 $cashiertillRequest = $get->cashiertillRequest;
                                                    if($cashiertillRequest == 1){
                                                        $newapproval = "<span class='btn btn-xs btn-info'>Sent</span>";
                                                    }else if($cashiertillRequest == 2){
                                                        $newapproval = "<span class='btn btn-xs btn-facebook'>Approved</span>";
                                                    }else if($cashiertillRequest == 3){
                                                        $newapproval = "<span class='btn btn-xs btn-danger'>Not Approved</span>";
                                                    }                   
						?>
                                                <?php 
                                                    $newrandomString = random_string('alnum', 20);
                                                ?>
										 
										 
	                                     <tr>
                                            <td><?php echo $dateCreated; ?></td>
                                            <td><a href="#"><?php echo $ndescriptOfitem; ?></a></td>
                                            <td><?php echo $this->mainlocation->getdLocation($dLocation); ?></td>
                                            <td><?php echo $nPayment; ?></td>
                                            <td><b><?php echo number_format($dAmount); ?></b></td>
                                            <td><?php echo $newapproval; ?></td>
                                            <?php
                                            //if($approvals !== '5'){
                                            //echo "<td><a href='".base_url()."'home/approvaldetails/$id/$newrandomString/$ndescriptOfitem'><span class='btn btn-xs btn-facebook'>View</span></a></td>";
	                                    //}
                                             ?>
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