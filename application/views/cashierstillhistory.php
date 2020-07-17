
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
                                        <h4 class="title">Till History </h4>
                                        
	                                <p class="category">Reimbursement and Added Amount</p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
	                                
                                        <table class="table table-responsive table-hover table-striped" id="">
                                                <thead class="text-primary">
                                                    <th>ID</th>
                                                    <th>Date Paid</th>
                                                    <th>Till Name</th>
                                                    <th>Cashier Email</th>
                                                    <th>New Amount</th>
                                                    <th>Till Balance</th>
                                                    <th>New Balance</th>
                                                     <th>Approved By</th>
                                                     
                                                
                                                </thead>
                                                <tbody>
                                                  <?php if ($gettillrequest) { ?>
                                               <?php
                                                    foreach ($gettillrequest as $get) {
							 $id = $get->id;
                                                         $datePrepared = $get->datePrepared;
                                                         $tillName = $get->tillName;
                                                         $dPayee = $get->dPayee;
                                                         $dAmount = $get->dAmount;
                                                         $dAmountTillBalance = $get->dAmountTillBalance;
                                                         $newTillBalance = $get->newTillBalance;
                                                         $whoApproved = $get->whoApproved;
                                                         $dateApproved = $get->dateApproved;
                                                        
                                                ?> 
                                                <tr>
                                           <td><?php echo $id; ?></td>
                                           <td><?php echo $dateApproved; ?></td>
                                           <td><?php echo $tillName; ?></td>
                                           <td><?php echo $dPayee; ?></td>
                                          <td class="btn btn-xs btn-danger"><?php echo @number_format($dAmount, 2); ?></td>
                                          <td><?php echo @number_format($dAmountTillBalance, 2); ?></td>
                                          <td><?php echo @number_format($newTillBalance, 2); ?></td>
                                          <td class="btn btn-xs btn-success"><?php echo $whoApproved; ?></td>
                                         
                                         
                                                </tr>
                                             <?php } ?>

                                         <?php } ?>
                                                </tbody>
                                                </table>
                                          <hr/>

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