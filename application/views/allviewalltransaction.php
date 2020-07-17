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
	                                <h4 class="title">Transactions</h4>
                                        <p class="category">All transaction<a href="<?php echo base_url(); ?>home"><span class="btn btn-xs btn-google pull-right">Home</span></a></p>
	                            </div>
								
								
	                            <div class="card-content">
	                               
	                                <table class="table table-responsive table-condensed" id="hodall">
	                                    <thead class="text-primary">
	                                    	<th>ID</th>
						<th>Date Created</th>	                                    	
						<th style="width:200px">Description of Item</th>
	                                    	<th>Location</th>
                                                <th>Payment</th>
                                                <th>Amount</th>
                                                <th style="width:100px">Unit</th> 
                                                <th>Beneficiary's Name</th>
                                                <th>Date Paid</th>
                                                <th>Paid By</th>
                                                
	                                    </thead>
                                            <tbody> <?php if ($getallResult) { ?>
                                               <?php
                                                    foreach ($getallResult as $get) {
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
                                                        $datePaid = $get->datepaid;
                                                        $benName = $get->benName;
                                                        $benEmail = $get->benEmail;
                                                        $dCashierwhopaid = $get->dCashierwhopaid;
                                                ?> 
                                                
                                                
                                                
                                                <tr>
                                                    <td><?php echo $id; ?></td>
                                                    <td><?php echo $dateCreated; ?></td>
                                                    <td><?php echo $ndescriptOfitem; ?></td>
                                                    <td><?php 
                                                    if(is_numeric($dLocation)){
                                                      echo $this->mainlocation->getdLocation($dLocation);  
                                                    }else{
                                                        echo $dLocation;
                                                    }
                                                     ?></td> 
                                                    <td><?php echo $nPayment; ?></td>
                                                    <td><?php echo $dAmount; ?></td>
                                                    <td><?php 
                                                    if(is_numeric($dUnit)){
                                                      echo $this->mainlocation->getdunit($dUnit); 
                                                    }else{
                                                        echo $dUnit;
                                                    }
                                                     ?></td>
                                                    <td><?php echo $benName; ?></td>
                                                    <td><?php echo $datePaid; ?></td>
                                                    <td><?php echo $dCashierwhopaid; ?></td>
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
   $(document).ready(function(){
      /*  var table = $('#cashierrequest');
        var oTable = table.DataTable({
            "order": [[0, "desc" ]]
           
        });
        */
    $('#hodall').DataTable( {
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf'],
        "order": [[0, "desc" ]]
    });
    
        
    });
</script>          
                
   <?php echo $footer; ?>