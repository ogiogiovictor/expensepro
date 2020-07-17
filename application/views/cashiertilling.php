
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
	                                <h4 class="title">Paid Cheques</h4>
	                                <p class="category">All Paid Cheques</p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
                                        <span id="errorme"></span>
                                        <table class="table table-responsive table-hover table-condensed" id="mydata">
                                                <thead class="text-primary">
                                                    
                                                    <th>Date Paid</th>
                                                    <th>Payee</th>
                                                    <th>Bank</th>
                                                    <th>Cheque No</th>
                                                    <th>App</th>
                                                    <th>Amount Paid</th>
                                                    <th>Prepared By</th>
                                                    <th>Details</th>
                                                </thead>
                                                <tbody>
                                                  <?php if ($gettillrequest) { ?>
                                               <?php
                                                    foreach ($gettillrequest as $get) {
							 $id = $get->id;
                                                         $userID = $get->userID;
                                                         $cashierIDdetails = $this->mainlocation->getUserdetails($userID);
                                                         $app_ID = $get->app_ID;
                                                         $Amount = $get->Amount;
                                                         $paidByAcct = $get->paidByAcct;
                                                         $fmrequestID = $get->fmrequestID;
                                                         $paidTo = $get->paidTo;
                                                         $app_urL = $get->app_urL;
                                                         $dateSent = $get->dateSent;
                                                         $datePaid = $get->datePaid;
                                                         $dBank = $get->dBank;
                                                         $chequeNo = $get->chequeNo;
                                                         $Location = $get->Location;
                                                         $signatory = $get->signatory;
                                                         $unit = $get->unit;
                                                         $partPay = $get->partpayAmount;
                                                         $mergedPy = $get->mergedPy;
                                                         $tillName = $get->tillName;
                                                         $approvals = $this->mainlocation->returnformrequest($fmrequestID);
                                                        if($partPay !="" && $partPay < $Amount){
                                                            $newAmount = $partPay. "<br/><span style='color:red'>partpayment</span>";
                                                        }else{
                                                            $newAmount = $Amount;
                                                        }
                                                
                                                         if($cashierIDdetails){
                                                             foreach($cashierIDdetails as $get){
                                                                $fname = $get->fname;
                                                                $lname= $get->lname;
                                                                
                                                                $fullname = $fname." ". $lname;
                                                             }
                                                             
                                                         }
                                                      $randomString = random_string('alnum', 60);    
                                                ?> 
                                                <tr>
                                            
                                            <td><?php echo $dateSent; ?></td>
                                            <td><?php echo $paidTo; ?></td>
                                            <td><?php echo $this->adminmodel->getBankName($dBank); ?></td>
                                            <td><?php echo $chequeNo; ?></td>
                                             <td><?php echo $app_ID; ?></td>
                                             <td><?php echo $newAmount; ?></td>
                                             <td><?php echo $paidByAcct; ?></td>
                                             <td>
                                                 <?php
                                             if($tillName == ""){
                                              echo "<a href='".base_url()."home/viewreqeuestdetails/$fmrequestID/$approvals/$randomString'><button class='btn btn-xs btn-facebook'>View</button></a>";
                                            
                                             }else if($mergedPy === "merged" && $tillName == ""){
                                              echo "<a href='".base_url()."home/viewmyrequestforeimbursement/$fmrequestID/$approvals/$randomString'><button class='btn btn-xs btn-facebook'>Open</button></a>";
                                            
                                             }else{
                                             echo "<a href='".base_url()."home/viewmyrequestforeimbursement/$fmrequestID/$approvals/$randomString'><button class='btn btn-xs btn-facebook'>View</button></a>";
                                             }
                                             ?>
                                             </td>
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