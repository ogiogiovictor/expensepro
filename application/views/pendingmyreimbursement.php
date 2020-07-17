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
	                                <table class="table table-condensed table-hover" id="hodall">
	                                    <thead class="text-primary">
	                                    	<th>Date Sent</th>
                                                <th>Send By</th>
	                                    	<th>Till Name</th>
                                                <th>Source</th>
						<!--<th style="width:100px">RequestID</th>-->
                                                <th>Amount</th>
						<th>Status</th>
                                                <th>Action</th>
	                                    </thead>
	                                    <tbody>
	                                     
					<?php if ($getallresult) { ?>
					 <?php
                                            foreach ($getallresult as $get) {
						 $id = $get->id;
						 $dateSent = $get->dateSent;
						 $tillName = $get->tillName;
						 $approvals = $get->approval;
						 $app_ID = $get->app_ID;
						 $fmrequestID = $get->fmrequestID;
						 $Amount = $get->Amount;
                                                 $requesterEmail = $get->requesterEmail;
						 $hasentbycashier = $get->hasentbycashier;
                                                 $paidTo = $get->paidTo;
                                                    if($app_ID == '01'){
                                                        $source = "petty cash";
                                                    }
                                                    if($hasentbycashier == 'no'){
                                                        $newapproval = "<span class=''>Pending</span>";
                                                    }else if($hasentbycashier == "yes"){
                                                        $newapproval = "<span class=''>Awaiting Payment</span>";
                                                    }else if($hasentbycashier == 'paid'){
                                                        $newapproval = "<span class=''>Cheque Paid</span>";
                                                    }else {
                                                        $newapproval = "";
                                                    }                      
						?>
                                                <?php 
                                                    $newrandomString = random_string('alnum', 20);
                                                ?>
										 
										 
	                                     <tr>
                                            <td><?php echo $dateSent; ?></td>
                                             <td><?php echo $paidTo; ?></td>
                                            <td><a href="#"><?php echo $tillName; ?></a></td>
                                            <td><?php echo $source; ?></td>
                                            <!--<td style="width:100px"><?php // echo $fmrequestID; ?></td>-->
                                            <td><b><?php echo number_format($Amount); ?></b></td>
                                            <td><?php echo $newapproval; ?></td>
                                            <td><a href="<?php echo base_url(); ?>home/viewmyrequestforeimbursement/<?php echo $fmrequestID; ?>/<?php echo $newrandomString; ?>"><button class="btn btn-xs btn-secondary">View</button></a> 
                                               
                                                 <a href="<?php echo base_url(); ?>home/accountsummary/<?php echo $id; ?>/<?php echo $newrandomString; ?>"><button class="btn btn-xs btn-facebook">Summary</button></a>
                                                <?php
                                                if($hasentbycashier == "yes" || $hasentbycashier == "paid"){
                                                echo "";
                                                }else{
                                                   echo "<a href='".base_url()."home/sendtoaccountbycashier/$id/$newrandomString'><button class='btn btn-xs btn-google'>Send to Accountant</button></a>"; 
                                                }
                                                  ?>
                                                  
                                                   <a href="<?php echo base_url(); ?>home/sagepost/<?php echo $id; ?>/<?php echo $fmrequestID; ?>/<?php echo $newrandomString; ?>"><button class="btn btn-xs btn-info">Sage Post</button></a>
                                                  <span title='print' class='btn btn-xs btn-default cashiersreimbursement' data-id='<?php echo $id; ?>/<?php echo $fmrequestID; ?>'><i class='material-icons'>print</i></span>
                                            </td>
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
                
    <script>
    
  $(document).ready(function() {
    $('#hodall').DataTable( {
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf'],
        "order": [[0, "desc" ]]
    });
    });
  </script>             
                
   <?php echo $footer; ?>