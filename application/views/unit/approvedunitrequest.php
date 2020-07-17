
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
                                        <h4 class="title"><?php  echo $this->mainlocation->getdUnit($getmyUnit); ?></h4> 
                                        
                                        <!--<a href="<?php echo base_url(); ?>"><div class="pull-right">Back</div></a>-->
                                       
                                        <p class="category">All Request&nbsp;&nbsp;<a class="btn btn-primary" onClick="window.history.back()">Back</a></p>
                                       
	                            </div>
						 		
								
	                            <div class="card-content table-responsive">
	                                <table class="table table-condensed table-hover" id="hodall">
	                                    <thead class="text-primary">
                                                <th>ID</th>
	                                    	<th>Date Created</th>
                                                <th>Requester</th>
	                                    	<th style="width:150px">Description of Item</th>
                                                
                                                <th>Unit</th>
                                                 <th>Method</th>
                                                
                                                <th>Amount</th>
                                                <th style="width:200px;">Status</th>
                                               
                                             <th>&nbsp;</th>
	                                    </thead>
	                                    <tbody>
	                                     
						<?php $newAmount = "";
                                                if ($getallresult) { ?>
                                                
                                                
						<?php
                                                    foreach ($getallresult as $get) {
                                                         $id = $get->id;
                                                         $md5_id = $get->md5_id;
							 $dateCreated = $get->dateCreated;
							 $ndescriptOfitem = $get->ndescriptOfitem;
							 $nPayment = $this->mainlocation->getpaymentType($get->nPayment);
                                                         $PaymentType = $get->nPayment;
							 $approvals = $get->approvals;
							 $hod = $get->hod;
							 $icus = $get->icus;
							 $cashiers = $get->cashiers;
							 $sessionID = $get->sessionID;
							 $dateRegistered = $get->dateRegistered;
                                                         $dAmount = $get->dAmount;
                                                         $dLocation = $get->dLocation;
                                                         $addComment = $get->addComment;
                                                         $dCashierwhopaid = $get->dCashierwhopaid;
                                                         $dUnit = $get->dUnit;
                                                         $partPay = $get->partPay;
                                                         $benName = $get->benName;
                                                         $fullname = $get->fullname;
                                                
                                                       
                                                        $getpaidTo = $this->datatablemodels->getpaidTo($id) != '' ?  $this->datatablemodels->getpaidTo($id) : $benName;
                                                        
                                                        if($approvals == 0){
                                                     $newapproval = "Draft";
						 }else if($approvals == 1){
                                                     $newapproval = "<span style='color:red'>Awaiting HOD Approval</span>";
						 }else if($approvals == 2){
                                                     $newapproval = "<span style='color:blue'>Awaiting ICU Approval</span>";
						 }else if($approvals == 3){
                                                     $newapproval = "<span style='color:indigo'>Awaiting Payment</span>";
						 }else if($approvals == 4 && $dCashierwhopaid == ""){
                                                     $newapproval = "<span style='color:green'>Ready for Collection</span>";
						 }else if($approvals == 4 && $dCashierwhopaid != ""){
                                                     $newapproval = "<span style='color:green'> Cash Paid by by ".$this->adminmodel->getUsername($dCashierwhopaid)."</span>";
						 }else if($approvals == 5){
                                                     $newapproval = "<span style='color:red'>Not Approved By HOD</span>";
						 }else if($approvals == 6){
                                                     $newapproval = "<span style='color:grey'>Rejected by ICU</span>";
						 }else if($approvals == 7){
                                                     $newapproval = "<span style='color:indigo'>Cheque Sent for Signature</span>";
						 }else if($approvals == 8  && $dCashierwhopaid == ""){
                                                     $newapproval = "<span style='color:green'>Signed & Ready for Collection</span>";
						 }else if($approvals == 8 && $dCashierwhopaid != ""){
                                                     $newapproval = "<span style='color:green'>Cheque Paid by ".$this->adminmodel->getUsername($dCashierwhopaid)."</span>";
						 }else if($approvals == 11){
                                                     $newapproval = "<span style='color:brown'>Closed</span>";
						 }else if($approvals == 12){
                                                     $newapproval = "<span style='color:red'>Rejected by Accounts</span>";
						 }
						 
                                                 
                                                        if($dAmount){
                                                            $newAmount += $dAmount;
                                                        }
                                                
						?>
                                                 <?php 
                                                   $newrandomString = random_string('alnum', 20);
                                                ?>
										 
										 
	                                     <tr>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $dateCreated; ?></td>
                                             <td><?php echo $fullname; ?></td>
                                            <td><?php echo $ndescriptOfitem; ?></td>
                                            
                                            <td>
                                                <?php
                                                if(is_numeric($dUnit)){
                                                     echo $this->mainlocation->getdUnit($dUnit);
                                                }else{
                                                    echo $dUnit;
                                                }
                                                ?>
                                            </td>
                                             <td><?php echo $nPayment; ?></td>
                                            <td><?php echo @number_format($dAmount, 2); ?></td>
                                            <td style="width:200px;"><?php echo $newapproval; ?></td>
                                            <td> <?php
                                             $randomString = random_string('alnum', 60);
                                             
                                          /*  if ($getApprovalLevel == 6 || $getApprovalLevel == 1) {
                                                echo "<span class='btn btn-sm btn-primary' onClick='printchequerequestswithmaintenance($id)'><i class='material-icons'>print</i></span>";
                                            }
                                            */
                                           ?>
                                           <?php
                                           if($getApprovalLevel == 6 || $getApprovalLevel == 1 && $approvals !== '4'){
                                              echo "<a title='view' href='".base_url()."home/viewreqeuestdetails/$id/$approvals/$randomString'><span class='btn btn-xs btn-google'><i class='material-icons'>insert_drive_file</i></span></a>";
                                            
                                           }else{
                                           echo "";
                                           }
                                           
                                           ?>
                                                
                                           
                                           <?php
                                           if($getApprovalLevel == 1 &&$PaymentType == 2 && $approvals == '3'){
                                              echo " <a title='Change Cheque Payment Location' href=".base_url()."supports/changelocation/$id/$randomString><span class='btn btn-xs btn-primary'><i class='material-icons'>edit_location</i></span></a>
                                            
                                            ";
                                            
                                           }else{
                                           echo "";
                                           }
                                           
                                           ?>
                                                
                                           <?php
                                           if($getApprovalLevel == 1 && $PaymentType == 1 && $approvals == '3'){
                                              echo '<a href="'.base_url().'supports/editsupportcashier/'.$id.'/'.$md5_id.'/'.$sessionID.'">
                                                    <button type="button" rel="tooltip" title="Edit Cashier" class="btn btn-xs btn-success">
                                                   
                                                    <i class="material-icons">check_box</i> </button></a>';
                                            
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
                                        <span class="btn btn-sm btn-pinterest">Total: <?php echo @number_format($newAmount, 2); ?></span>
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
    $('#hodall, #othersme').DataTable( {
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf']
    });
});
</script>                       
                
   <?php echo $footer; ?>