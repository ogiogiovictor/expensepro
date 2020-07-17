
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
	                                <h4 class="title">Till History : <?php echo $tillname; ?></h4>
	                                <p class="category">Amount Collected :: <?php echo $_SESSION['email']; ?></p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
                                        <span id="errorme"></span>
                                        <table class="table table-responsive table-hover table-condensed" id="mydata">
                                                <thead class="text-primary">
                                                    
                                                    <th>Date</th>
                                                    <th>Payee</th>
                                                    <th>Till Name</th>
                                                    <!--<th>Request ID</th>-->
                                                    <th>Amount</th>
                                                    <th>Approved By</th>
                                                </thead>
                                                <tbody>
                                                  <?php if ($sendTillHistory) { ?>
                                               <?php
                                                    foreach ($sendTillHistory as $get) {
							 $id = $get->id;
                                                         $datePrepared = $get->	datePrepared;
                                                         $userID = $get->userID;
                                                         $dAmount = $get->dAmount;
                                                         $tillName = $get->tillName;
                                                         $dPayee = $get->dPayee;
                                                         $whoApproved = $get->whoApproved;
                                                         $requestID = $get->requestID;
                                                         $dateApproved = $get->dateApproved;
                                                        
                                                          
                                                ?> 
                                                <tr>
                                            
                                            <td><?php echo $datePrepared; ?></td>
                                            <td><?php echo $dPayee; ?></td>
                                            <td><?php echo $tillName; ?></td>
                                            <!--<td><?php // echo $requestID; ?></td>-->
                                            <td><?php echo @number_format($dAmount, 2); ?></td>
                                             <td><?php echo $whoApproved; ?></td>
                                            
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