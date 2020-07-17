
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
	                                <h4 class="title">Cheque Request at a Glance</h4>
	                                <p class="category">Request at one time</p>
	                            </div>
								
                                    <p id="errorme"></p>			
	                            <div class="card-content table-responsive">
	                                <table class="table table-condensed table-hover" id="mydata">
	                                    <thead class="text-primary">
	                                    	<th>Request ID</th>
                                                <th>Beneficiary</th>
                                                <th>Prepared By</th>
                                                <th>Date Sent</th>
                                                <th>Bank</th>
                                                <th>Cheque No</th>
                                                <th>Type</th>
                                                <th>Till</th>
                                                <th>Signatory</th>
	                                    </thead>
	                                    <tbody>
	                                     
						<?php 
                                                 
                                                if($getresult){
                                                    var_dump($getresult);
                                                    foreach($getresult as $get){
                                                        $requestID = $get->requestID;
                                                       $paidTo = $get->paidTo;
                                                       $sessionEmail = $get->sessionEmail;
                                                       $datePaid = $get->datePaid;
                                                       $Bank = $get->Bank;
                                                       $chequeNo = $get->chequeNo;
                                                       $type = $get->type;
                                                       
                                                       
                                                
                                                ?>
										 
	                                     <tr>
                                            <td><?php echo $requestID; ?></td>
                                            <td><?php echo $paidTo; ?></td>
                                            <td><?php echo $sessionEmail; ?></td>
                                            <td><?php echo $datePaid; ?></td>
                                            <td><?php echo $Bank; ?></td>
                                            <td><?php echo $chequeNo; ?></td>
                                             </tr>
                                            
				<?php    
                                    }
                                         }
                                   ?>
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