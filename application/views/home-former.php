 <script>
        $(document).ready(function(){
         //$('#mydata').DataTable();
         var dataTable = $('#user_data').DataTable({
             "processing":true,
             "serverSide":true,
             "order":[],
             "ajax":{
                
                url:"<?php echo base_url(). 'databasetablecontroller/fetch_home'; ?>",
                type: "POST"
             },
               
               "columnDefs":[
                    {
                    "targets":[0, 3, 4],
                    "orderable": false
                  }
               ]
                
         });
        });
     </script>

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
                            
                            
                            <!-- Inside Content Begins  Here -->
                                <!-- with icons and horizontal -->
                        <ul class="nav nav-pills nav-pills-icons nav-pills-primary" role="tablist">
                               
                                <li class="active">
                                        <a href="<?php echo base_url(); ?>home/newrequest">
                                                <i class="material-icons">dashboard</i>
                                               New Request
                                        </a>
                                </li>
                                
                                <?php
                                 if($getApprovalLevel == 5){
                                    echo "<li>
                                            <a href='".base_url()."home/report'>
                                                    <i class='material-icons'>schedule</i>
                                                    Report
                                            </a>
                                    </li>";
                                     }else{
                                        echo "";
                                     }
                              ?>
                               
                                <?php 
                                 if($getApprovalLevel == 4){
                                echo "<li>
                                        <a href='".base_url()."home/report'>
                                                <i class='material-icons'>schedule</i>
                                                Report
                                        </a>
                                </li>";
                                 }else{
                                    echo "";
                                 }
                             ?>
                                
                                <?php 
                                 if($getApprovalLevel == 4){
                                echo "<li>
                                        <a href='".base_url()."home/mytill'>
                                                <i class='material-icons'>local_atm</i>
                                                My Till
                                        </a>
                                </li>";
                                 }else{
                                    echo "";
                                 }
                             ?>
                                
                             <?php 
                                 if($getApprovalLevel == 6){
                                echo "<li>
                                        <a href='".base_url()."action/disableduser'>
                                                <i class='material-icons'>accessibility</i>
                                                All Users
                                        </a>
                                </li>";
                                 }else{
                                    echo "";
                                 }
                             ?>
                                
                            <?php 
                                 if($getApprovalLevel == 8){
                                echo "<li>
                                        <a href='".base_url()."home/printoutcheques'>
                                               <i class='material-icons'>print</i>
                                                 Printout Cheque
                                        </a>
                                </li>
                                
                                <li>
                                        <a href='".base_url()."home/generatebankstatement'>
                                               <i class='material-icons'>account_balance</i>
                                                Bank Confirmation
                                        </a>
                                </li><li>
                                        <a href='".base_url()."home/allpartpayments'>
                                              <i class='material-icons'>business</i>
                                               Part Payment
                                        </a>
                                </li>
                                <li>
                                        <a href='".base_url()."home/allgeneratebankstatement'>
                                               <i class='material-icons'>receipt</i>
                                                All Bank Confirmation
                                        </a>
                                </li>
                                <li>
                                        <a href='".base_url()."home/govementlevies'>
                                                <i class='material-icons'>insert_chart</i>
                                                Govt Levies
                                        </a>
                                </li>";
                                 }if($getApprovalLevel == 7){
                                     
                                     echo " <li>
                                        <a href='".base_url()."home/allpartpayments'>
                                              <i class='material-icons'>business</i>
                                               Part Payment
                                        </a>
                                </li>
                                <li>
	                    <a href='".base_url()."home/generatebankstatement'>
	                       <i class='material-icons'>account_balance</i>
	                        <p>Bank Confirmation</p>
	                    </a>
	                </li>";
                                     
                                 }else{
                                    echo "";
                                 }
                             ?>
                                
                                
                                <?php 
                               
                               if($getApprovalLevel == 6){
                               echo "<li>
                                        <a href='".base_url()."home/printoutcheques'>
                                               <i class='material-icons'>print</i>
                                                 Printout Cheque
                                        </a>
                                </li>
                                
                                <li>
                                        <a href='".base_url()."home/generatebankstatement'>
                                               <i class='material-icons'>account_balance</i>
                                                Bank Confirmation
                                        </a>
                                </li><li>
                                        <a href='".base_url()."home/allpartpayments'>
                                              <i class='material-icons'>business</i>
                                               Part Payment
                                        </a>
                                </li>
                                <li>
                                        <a href='".base_url()."home/allgeneratebankstatement'>
                                               <i class='material-icons'>receipt</i>
                                                All Bank Confirmation
                                        </a>
                                </li><li>
                                        <a href='".base_url()."home/govementlevies'>
                                                <i class='material-icons'>insert_chart</i>
                                                Govt Levies
                                        </a>
                                </li>";
                                }else{
                                    
                                    echo "";
                                }
                               ?>
                                
                                <?php 
                                if($getLevelApprove == 2){
                          
                                echo" <li>
                                  <a href='".base_url()."assetmgt/joborder'>
                                      <i class='material-icons'>chrome_reader_mode</i>
                                      <p>Asset</p>
                                  </a>
                              </li>";
                                }
                                ?>
                        </ul>
                                
                                
                        <hr/>        
                         <!-- Beginning of Request Details with Status -->
                         
                         <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">My Request</h4>
	                                <p class="category">Latest Request and Status Update</p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
	                                <table class="table table-condensed" id="user_data">
	                                    <thead class="text-primary">
	                                    	<th>Date</th>
	                                    	<th style="width:200px">Description of Item</th>
						<th>Payment Method</th>
                                                <th>Amount</th>
						<th>Status</th>
                                                <th>Action</th>
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
                                                $refID_edited= $get->refID_edited;
						 $partPay = $get->partPay;
                                                
                                            if($partPay !="" && $partPay < $dAmount){
                                               $dAmount =  number_format($partPay)."NGN";
                                               $dAmount .= "<br/><small>Part Payment</small>";
                                              }else{
                                               $dAmount = number_format($dAmount)."NGN";
                                            }						 
						 /*
						 APPROVAL LEVEL
						// approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod) 
                                                  // approve = 3(approved by hod) approve = 4 (paid for cashiers only)
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
					         
                                                 // approvals = 11 then it is disabled inline
                                                 $randomString = random_string('alnum', 30);
						?>
										 
										 
	                                     <tr>
                                            <td><?php echo $dateCreated; ?></td>
                                            <td><?php echo $ndescriptOfitem; ?></td>
					    <td><?php echo $nPayment; ?></td>
                                            <td><?php echo $dAmount; ?></td>
                                            <td><?php echo  $newapproval ?></td>
                                           <td class="text-primary">
                                            <?php
                                            if($approvals == 5 || $approvals == 6){
                                            echo '<a href="'.base_url().'home/editejectedrequest/'.$id.'/'.$dAmount.'/'.$randomString.'"><button type="button" rel="tooltip" title="Edit" class="btn btn-xs btn-danger">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                                </a>';
                                            }else if($approvals == 1 || $approvals == 2 || $approvals == 3 || $approvals == 4){
                                               echo '<a href="'.base_url().'home/viewmyrequest/'.$id.'/'.$dAmount.'/'.$randomString.'"><button type="button" rel="tooltip" title="View" class="btn btn-xs btn-success">
                                                    <i class="material-icons">panorama</i>
                                                </button></a>';
                                            }else if($approvals == 11 ){
                                               echo '<a href="'.base_url().'home/viewmyrequest/'.$id.'/'.$dAmount.'/'.$randomString.'"><button type="button" rel="tooltip" title="View" class="btn btn-xs btn-success">
                                                    <i class="material-icons">panorama</i>
                                                </button></a>';
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
                         
                                
                                
                                
                            <!-- Inside Content Ends Here -->
                            
                            
	                </div>
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                
                
                
   <?php echo $footer; ?>