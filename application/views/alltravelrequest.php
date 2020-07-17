
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
	                                <h4 class="title"><?php echo $title; ?></h4>
                                        <?php
                                            if(current_url() == "http://localhost/expensepro/accounts/travelrequest"){
                                                echo " <p class='category'>All Request &nbsp;&nbsp;&nbsp;<a href=".base_url()."accounts/travelrequestall><span class='btn btn-xs btn-danger'>View All</span></a></p>"; 
                                            }else if(current_url() == "http://localhost/expensepro/accounts/fromprocurement"){
                                               echo " <p class='category'>All Request &nbsp;&nbsp;&nbsp;<a href=".base_url()."accounts/procurementall><span class='btn btn-xs btn-danger'>View All</span></a></p>"; 
                                            }else{
                                               echo ""; 
                                            }
                                            
                                         ?>
                                       
                                       
	                            </div>
				
	                            <div class="card-content table-responsive table-condensed">
                                        <span id="icuacceptrequest"></span>
	                                <table class="table" id="reqeustapproval">
	                                    <thead class="text-primary">
                                               
	                                    	<th>ID</th>
                                                <th>Date</th>
	                                    	<th style="width:250px; padding-left:5px; padding-right:5px;">Description of Item</th>
                                                <th>Requester</th>
                                                <th>Location</th>
                                                <th>Amount</th>
						<th>Status</th>
                                                <th style="width:200px">Action</th>
	                                    </thead>
	                                    <tbody>
	                                     
						<?php if ($getallresult) { ?>
						<?php
                                                $sumall = "";
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
                                                         $partPay = $get->partPay;
                                                         $benName = $get->benName;
                                                         $refID_edited = $get->refID_edited;
                                                         $dAccountgroup = $get->dAccountgroup;
                                                         $ChecknPayment = $get->nPayment;
                                                         $fullname = $get->fullname;
                                                         $CurrencyType = $get->CurrencyType;
                                                         $dateHODapprove = $get->dateHODapprove;
                                                         $dateICUapprove = $get->dateICUapprove;
                                                         $dCashierwhopaid = $get->dCashierwhopaid;
                                                
                                                        if($partPay !="" && $partPay != "0" && $partPay < $dAmount){
                                                           $newAmount = @number_format($partPay, 2)." <br/>Part Payment";
                                                          }else{
                                                           $newAmount = @number_format($dAmount, 2);
                                                        }	
                                                       
                                                        if($getApprovalLevel == 7 && $dCashierwhopaid =='' && $approvals == 3){
                                                            $timeAgo =  get_timeago(strtotime($dateICUapprove));;
                                                        }else if($getApprovalLevel == 5 && $dCashierwhopaid =='' && $approvals == 3){
                                                            $timeAgo =  get_timeago(strtotime($dateICUapprove));;
                                                        }else if($getApprovalLevel == 6 && $dCashierwhopaid =='' && $approvals == 3){
                                                            $timeAgo =  get_timeago(strtotime($dateICUapprove));;
                                                        }else{
                                                             $timeAgo = '';
                                                        }
                                                        
                                                        
                                                        
                                                if($CurrencyType == 'naira'){
                                                    $newCurrency = '<span>&#8358;</span>';
                                                }else if($CurrencyType == 'dollar'){
                                                    $newCurrency = '<span>&#x0024;</span>';
                                                }else if($CurrencyType == 'euro'){
                                                    $newCurrency = '<span>&#8364;</span>';
                                                }else if($CurrencyType == 'pounds'){
                                                    $newCurrency = '<span>&#163;</span>';
                                                }else if($CurrencyType == 'yen'){
                                                    $newCurrency = '<span>&#165;</span>';
                                                }else if($CurrencyType == 'singaporDollar'){
                                                    $newCurrency = '<span>S&#x0024;</span>';
                                                }else if($CurrencyType == 'AED'){
                                                    $newCurrency = '<span>(AED)</span>';
                                                }else if($CurrencyType == 'rupee'){
                                                    $newCurrency = '<span>&#8377;</span>';
                                                }else{
                                                   
                                                    if($CurrencyType != ""){
                                                      $newCurrency = @$this->generalmd->getsinglecolumnfromotherdb("curr_symbol", "currencies", "curr_abrev", $CurrencyType); 
                                                    }else if($CurrencyType == "null" || $CurrencyType == ""){
                                                        $newCurrency =  '<span>&#8358;</span>';
                                                    }else{
                                                        $newCurrency =  '<span>&#8358;</span>';
                                                    }
                                                    
                                                }
                                            
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
						 }else if($approvals == 12){
                                                     $newapproval = "<span style='color:brown'>Rejected By Accounts</span>";
						 }
						 // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod) 
                                                  // approve = 3(approved by hod) approve = 4 (paid) 
                                                 
                                                 if($dAmount){
                                                     $sumall += $dAmount;
                                                 }else{
                                                     $sumall = "";
                                                 }
                                                                                                 
						?>
                                                 <?php 
                                                   $newrandomString = random_string('alnum', 60);
                                                ?>
										 
										 
	                                     
                                             <?php 
                                            /* if($getApprovalLevel == 6 || $getApprovalLevel == 7 || $getApprovalLevel == 8){
                                                 
                                           
                                              echo "<td><input type='checkbox' name='mergepayment[]' id='mergepayment[]' value='$id' /></td>";
                                               
                                             }else{
                                                 echo "";
                                             } */
                                             ?>
                                             <tr>
                                            <td><?php echo $id; ?></td>
                                             <td>
                                                 <?php echo $dateCreated; ?><br/>
                                             <small class="badge badge-danger"><?php echo $timeAgo; ?></small>
                                             </td>
                                            <td style="padding-left:5px; padding-right:5px;"><a href="<?php echo base_url(); ?>home/approvaldetails/<?php echo $id; ?>/<?php echo $md5_id; ?>/<?php echo $newrandomString; ?>"><?php echo $ndescriptOfitem; ?></a></td>
                                            <td><?php echo $fullname; ?></td>
                                            <td><?php
                                                if(is_numeric($dLocation)){
                                                     echo $this->mainlocation->getdLocation($dLocation);
                                                }else{
                                                    echo $dLocation;
                                                }
                                            ?>
                                            </td>
                                            
                                            <td><?php echo $newCurrency.$newAmount; ?></td>
                                            <td><?php echo $newapproval; ?></td>
                                            <td>
                                           <?php  
                                            if ($getApprovalLevel == 7 && $approvals == 3){
                                                echo "<span title='Approve' class='btn btn-xs btn-success' onClick='approvecheques($id, $dAccountgroup, $dAmount)'><i class='material-icons'>check</i></span>
                                                      <input type='submit' title='Reject' name='theaccountantrejectedit' data-id='$id' class='theaccountantrejectedit btn btn-xs btn-danger disposebox'  value='X' class='btn btn-xs btn-danger'/>";
                                            }
                                           ?>
                                           
                                           <?php
                                           if (($getApprovalLevel == 7  || $getApprovalLevel == 6) && $approvals == 3){
                                               echo "<span title='print' class='btn btn-xs btn-default' onClick='printchequerequests($id)'><i class='material-icons'>print</i></span>
                                               <a href='".base_url()."paycheques/preparecheque/$id/$md5_id/$approvals/$newrandomString' title='Prepare Cheque'><span title='Cheque Preparation' class='btn btn-xs btn-warning' >C</span></a>"; 
                                               
                                           }
                                           ?>
                                          
                                         <?php
                                           if($approvals !== '4' || $approvals == '7'){
                                              echo "<a title='view' href='".base_url()."home/approvaldetails/$id/$md5_id/$newrandomString'><span class='btn btn-xs btn-facebook'><i class='material-icons'>insert_drive_file</i></span></a>";
                                            
                                           }else{
                                           echo "";
                                           }
                                           
                                           ?>
                                                
                                       
                                     </td>
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
 <script>
   $(document).ready(function(){
     
    $('#reqeustapproval').DataTable( {
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf']
    });
        
        
    });
</script>                            
                
             
   <?php echo $footer; ?>