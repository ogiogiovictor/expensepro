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
                                        <h4 class="title">PAY CHEQUE</h4> 
                                        
                                        <!--<a href="<?php echo base_url(); ?>"><div class="pull-right">Back</div></a>-->
                                       
                                        <p class="category">Cheque processing platform <br/>
                                            <a href="<?php echo base_url(); ?>paycheques/mytransactionformaint" class="btn btn-sm btn-pinterest">View Transactions</a>
                                            
                                            </p>
                                       
	                            </div>
						 		
								
	                            <div class="card-content table-responsive">
	                                <table class="table table-condensed table-hover" id="mydata">
	                                    <thead class="text-primary">
	                                    	<th>Date Created</th>
	                                    	<th style="width:150px">Description of Item</th>
                                                <th>Location</th>
                                                <th>Unit</th>
						<th>Method</th>
                                                <th>Amount</th>
                                                <th>Payee</th>
                                               
                                             <th>&nbsp;</th>
	                                    </thead>
	                                    <tbody>
	                                     
						<?php if ($getallresult) { ?>
                                                
                                                
						<?php
                                                    foreach ($getallresult as $get) {
                                                         $id = $get->id;
                                                         $md5_id = $get->md5_id;
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
                                                         $addComment = $get->addComment;
                                                         $addComment = $get->addComment;
                                                         $dCashierwhopaid = $get->dCashierwhopaid;
                                                         $dUnit = $get->dUnit;
                                                         $partPay = $get->partPay;
                                                         $benName = $get->benName;
                                                
                                                       
                                                        $getpaidTo = $this->datatablemodels->getpaidTo($id) != '' ?  $this->datatablemodels->getpaidTo($id) : $benName;
                                                                
						 
                                                                                                 
						?>
                                                 <?php 
                                                   $newrandomString = random_string('alnum', 20);
                                                ?>
										 
										 
	                                     <tr>
                                            <td><?php echo $dateCreated; ?></td>
                                            <td><?php echo $ndescriptOfitem; ?></td>
                                            <td>
                                                <?php
                                                if(is_numeric($dLocation)){
                                                     echo $this->mainlocation->getdLocation($dLocation);
                                                }else{
                                                    echo $dLocation;
                                                }
                                                ?>
                                            </td>
                                            <td><?php 
                                            if(is_numeric($dUnit)){
                                               echo $this->mainlocation->getdunit($dUnit); 
                                            }else{
                                                echo $dUnit;
                                            }
                                             ?></td>
                                            <td><?php echo $nPayment; ?></td>
                                            <td><?php echo @number_format($dAmount, 2); ?></td>
                                            <td><?php echo $benName; ?></td>
                                            <td> <?php
                                             $randomString = random_string('alnum', 60);
                                             
                                            if ($getApprovalLevel == 6 || $getApprovalLevel == 1) {
                                                echo "<span class='btn btn-sm btn-primary' onClick='printchequerequestswithmaintenance($id)'><i class='material-icons'>print</i></span>";
                                            }
                                            
                                            if ($getuseridfromhere && $getApprovalLevel == 1) {
                                                echo "<input type='submit' title='Reject' name='theaccountantrejectedit' data-id='$id' class='theaccountantrejectedit btn btn-sm btn-danger disposebox'  value='X' class='btn btn-xs btn-danger'/>";
                                            }
                                            
                                            
                                            if ($getApprovalLevel == 6 || $getApprovalLevel == 1) {
                                                echo "<a href='".base_url()."paycheques/adminmaintenanceapprovaluser/$id/$md5_id/$approvals/$randomString' title='Approve' class='btn btn-sm btn-success'><i class='material-icons'>check</i></a>";
                                            }
                                           
                                           ?>
                                           <?php
                                           if($getApprovalLevel == 6 || $getApprovalLevel == 1 && $approvals !== '4'){
                                              echo "<a title='view' href='".base_url()."home/approvaldetails/$id/$md5_id/$approvals/$randomString'><span class='btn btn-xs btn-google'><i class='material-icons'>insert_drive_file</i></span></a>";
                                            
                                           }else{
                                           echo "";
                                           }
                                           
                                           ?>
                                           
                                            
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
                         
                             <div id="disposebox">
                                <p id="myacctputalert"></p>
                            </div> 
                            
                                
                            <!-- Inside Content Ends Here -->
                            
                            
	                </div>
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                
                
                
   <?php echo $footer; ?>