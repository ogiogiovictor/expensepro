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
	                                <h4 class="title">My Expenses</h4>
	                                <p class="category">All paid Cash/Request</p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
	                                <table class="table table-condensed table-hover" id="hodall">
	                                    <thead class="text-primary">
	                                    	<th>Date</th>
	                                    	<th style="width:200px">Description of Item</th>
	                                    	<th>Account Code</th>
	                                    	<th>Unit</th>
						<th>Requester</th>
                                                <th>Beneficiary</th>
                                                <th>Amount</th>
                                                <th>Approved By</th>
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
                                                $dCashierwhopaid= $get->dCashierwhopaid;
                                                $dUnit= $get->dUnit;
                                                 $sessionID = $get->sessionID;
                                                $benName = $get->benName;
									
												 
						 /*
						 APPROVAL LEVEL
						 pending = 0, Awaiting HOD approval = 1, Awaiting ICU Approval
						 */
						if($approvals == 0){
                                                     $newapproval = "Pending";
						 }else if($approvals == 1){
                                                     $newapproval = "<span style='color:red'>Awaiting HOD Approval</span>";
						 }else if($approvals == 2){
                                                     $newapproval = "<span style='color:blue'>Awaiting ICU Approval</span>";
						 }else if($approvals == 3){
                                                     $newapproval = "<span style='color:indigo'>Awaiting Payment</span>";
						 }else if($approvals == 4){
                                                     $newapproval = "<span style='color:green'>Ready for Collection</span>";
						 }else if($approvals == 5){
                                                     $newapproval = "<span style='color:red'>Not Approved By HOD</span>";
						 }else if($approvals == 6){
                                                     $newapproval = "<span style='color:grey'>Reject by ICU</span>";
						 }else if($approvals == 7){
                                                     $newapproval = "<span style='color:indigo'>Cheque Sent for Signature</span>";
						 }else if($approvals == 8){
                                                     $newapproval = "<span style='color:green'>Signed & Ready for Collection</span>";
						 }else if($approvals == 11){
                                                     $newapproval = "<span style='color:brown'>Closed</span>";
						 }
					         
                                                 $randomString = random_string('alnum', 30);
                                                 
                                                 //Get the Code
                                                         $mergeCode = "";
                                                         $getexCode = $this->mainlocation->getCodefromexpense($id);
                                                         if($getexCode){
                                                             foreach($getexCode as $get){
                                                                 $xCode = $get->ex_Code;
                                                                 $xxCode = $this->mainlocation->nameCode($get->ex_Code);
                                                                 
                                                                 $mergeCode .= $xCode.'<br/> '.$xxCode;
                                                             }
                                                         }
						?>
										 
										 
	                                     <tr>
                                            <td><?php echo $dateCreated; ?></td>
                                            <td><?php echo $ndescriptOfitem; ?></td>
                                            <td><?php echo $mergeCode; ?></td>
                                             <td><?php echo $this->mainlocation->getdunit($dUnit); ?></td>
					    <td><?php echo $sessionID; ?></td>
                                             <td><?php echo $benName; ?></td>
                                            <td><?php echo $dAmount; ?></td>
                                            <td><?php echo  $dCashierwhopaid ?></td>
                                                                                        
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
                
       <script>
    
  $(document).ready(function() {
    $('#hodall').DataTable( {
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf']
    });
});
</script>                  
                
   <?php echo $footer; ?>