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
	                                <h4 class="title">My Cash Reimbursement Details</h4>
	                                <p class="category">All Reimbursement Request</p>
	                            </div>
								
								
	                            <div class="card-content">
	                                <table class="table table-responsive table-striped table-hover" id="hodall">
	                                    <thead>
	                                    	<th>Title</th>
                                                <th>Location/Unit</th>
                                                <th>HOD(Apprd)</th>
                                                <th>ICU(Apprd)</th>
                                                <th>Prepared By</th>
                                                <th>Amount</th>
                                                <th>Beneficiary Name</th>
                                                <th>Date Paid</th>
	                                    </thead>
	                                    <tbody>
	                                <?php
                                            //Implode comma to the array
                                            $ids = explode(",",  $ids);

                                             foreach($ids as $key => $value) {

                                             $getresult = $this->mainlocation->getdreimbursement($value);
                                             //var_dump($getresult);
                                            
                                            ?>
					<?php if ($getresult) { ?>
					 <?php
                                            foreach ($getresult as $get) {
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
                                               $dLocation = $this->mainlocation->getdLocation($get->dLocation);
                                                $dUnit = $this->mainlocation->getdunit($get->dUnit);
                                                $addComment = $get->addComment;
                                                $benEmail = $get->benEmail;
                                                $benName = $get->benName;
                                                $adCashierwhopaid = $get->dCashierwhopaid;
                                                $dICUwhoapproved = $get->dICUwhoapproved;
                                                $dICUwhorejectedrequest = $get->dICUwhorejectedrequest;
                                                $newrequest_tillID = $this->adminmodel->gettilltypestatus($get->newrequest_tillID);
						$hodwhoapprove = $get->hodwhoapprove;
						 $datepaid = $get->datepaid;
						?>
                                               			 
										 
	                                     <tr>
                                            <td><?php echo $ndescriptOfitem; ?></td>
                                            <td><?php echo $dLocation; ?> / <?php echo $dUnit; ?></td>
                                            <td><?php echo $hodwhoapprove; ?></td>
                                            <td><?php echo $dICUwhoapproved; ?></td>
                                            <td><?php echo $adCashierwhopaid; ?></td>
                                             <td><?php echo $dAmount; ?></td>
                                            <td><?php echo $benName; ?></td>
                                            <td><?php echo $datepaid; ?></td>
                                            </tr>
											
					<?php } ?>

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
                
 <script>
    
  $(document).ready(function() {
    $('#hodall').DataTable( {
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf']
    });
});
</script>                       
                
   <?php echo $footer; ?>