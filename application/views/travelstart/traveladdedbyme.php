
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="<?php echo base_url(); ?>assets/img/sidebar-1.jpg">

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
                    

                    <!-- Inside Content Begins  Here -->
                         <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
                                        <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">FLIGHT REQUEST</span></span>&nbsp;<i class="fa fa-bus" aria-hidden="true"></i><a href="<?php echo base_url(); ?>travels/index"><span class="pull-right btn btn-xs btn-danger">MAKE REQUEST</span></a></h4>
                                        <p class="category"> </span></p>
	                            </div>
								
								
	                            <div class="card-content">
                                        
                                         <table class="table table-striped" id="reqeustapproval">
                                                <thead class="text-primary">
                                                    <th>Date Created</th>
                                                    <th>Staff ID</th>
                                                    <th>Staff Name </th>
                                                    <th>Unit</th>
                                                    <!--<th>Payment Type</th>-->
                                                    <th>Total Amount</th>
                                                    <!--<th>Prepared By</th>-->
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                
                                                </thead>
                                                <tbody>
                                                  <?php if ($totalflightrquest) { ?>
                                               <?php
                                                    foreach ($totalflightrquest as $get) {
							 $id = $get->id;
                                                         $dateCreated = $get->dateCreated;
                                                         $staffID = $get->staffID;
                                                         $csrf = $get->csrf;
                                                         $staffName = $get->staffName;
                                                         $staffEmail = $get->staffEmail;
                                                         $location = $get->location;
                                                         $unit = $get->unit;
                                                         $paymentType = $this->mainlocation->getpaymentType($get->paymentType);
                                                         $sTotal = $get->sTotal;
                                                         $approval = $get->approval;
                                                         $preparedBy = $get->preparedBy;
                                                         $sReimbursement = $get->sReimbursement;
                                                         
                                                         // Approval = 0 "pending" // Approval = 1 "Awaiting HOD"
                                                         // Approval = 2 "Rejected" // Approval = 3 "In Account"
                                                         // Approval = 4 "paid" // Approval = 0 "pending"
                                                         
                                                        /* if($approval == 0){
                                                             $newApproval = "pending";
                                                         }else if($approval == 1){
                                                             $newApproval = "Awaiting HOD Approval";
                                                         }else if($approval == 2){
                                                             $newApproval = "<div class='btn btn-danger btn-xs'>Rejected</div>";
                                                         }else if($approval == 3){
                                                             $newApproval = "In Process[HOD||ICU]";
                                                         }else if($approval == 4){
                                                             $newApproval = "In Account";
                                                         }else if($approval == 5){
                                                             $newApproval = "Paid";
                                                         }
                                                         */
                                                         /* 
                                                          reimbursement 
                                                          * 1 - pending retirement
                                                          * 2 - check with HOD - There is a Balance -- send it to the HOD
                                                          * 3 - Check with ICU - No Balance carry it with the hod
                                                          * 5 - Check with Account
                                                          * 
                                                          */
                                                          $getBalance = $this->generalmd->getuserAssetLocation("myBalance", "cash_recievable_retirement", "requestID", $id);
                                                         
                                                         if($getBalance !== FALSE && $getBalance == 0){
                                                            $dRetirement = "<span class='btn btn-xs btn-default'>Done</span>";   
                                                         }else if($sReimbursement == 0 && $approval == 2){
                                                            $dRetirement = "<span class='btn btn-xs btn-danger'>Rejected</span>"; 
                                                         }else if($sReimbursement == 1 && $approval == 5){
                                                            $dRetirement = "<span class='btn btn-xs btn-danger'>Pending retirement</span>"; 
                                                         }else if($sReimbursement == 2 && $approval == 5){
                                                             $dRetirement = "<span style='color:red'>Retirement (Check with HOD)</span>";  
                                                         }else if($sReimbursement == 3  && $approval == 5){
                                                             $dRetirement = "<span style='color:green'>Retirement (Check with ICU)</span>";  
                                                         }else if($sReimbursement == 4  && $approval == 5){
                                                             $dRetirement = "<span style='color:green'>Retirement (Check with Account)</span>";  
                                                         }else if($sReimbursement == 0 && $approval == 0){
                                                             $dRetirement = "<span style='color:green'>Warefare Officer</span>";  
                                                         }else if($sReimbursement == 0 && $approval == 1){
                                                             $dRetirement = "<span style='color:green'>Check With HOD</span>";  
                                                         }else if($sReimbursement == 0 && $approval == 3){
                                                             $dRetirement = "<span style='color:green'>Check With ICU</span>";  
                                                         }else if($sReimbursement == 0 && $approval == 4){
                                                             $dRetirement = "<span style='color:green'>Check With Account</span>";  
                                                         }else if($sReimbursement == 6){
                                                             $dRetirement = "<span style='color:green'>Completed[Check with Account]</span>";  
                                                         }
                                                         
                                                         
                                                ?> 
                                                <tr>
                                                <td><?php echo $dateCreated; ?></td>
                                                 <td><?php echo "S".$staffID; ?></td>
                                                <td><b><?php echo $staffName; ?></b></td>
                                                <td><?php echo $unit; ?></td>
                                                <!--<td><?php //echo $paymentType; ?></td>-->
                                                <td><b><?php echo @number_format($sTotal, 2); ?></b></td>
                                                <!--<td><?php //echo $preparedBy; ?></td>-->
                                                <!--<td><?php //echo $newApproval; ?></td>-->
                                                <td><?php echo $dRetirement; ?></td>
                                                <td>
                                                 <?php 
                                               /*  if($approval == 2){
                                                   echo "<a href=".base_url()."travels/enmdit_mdsrnds_d/$csrf><button class='btn btn-xs btn-danger'>Edit</button></a>";
                                                    
                                                 }else {
                                                     echo "<a class='btn btn-xs btn-success' href=".base_url()."travels/viewsourcedetailXO/$id/$csrf/$staffEmail/$staffName>View</a>";
                                                 }
                                                */
                                                 if($approval !== 2){
                                                   echo "<a class='btn btn-xs btn-success' href=".base_url()."travels/viewsourcedetailXO/$id/$csrf/$staffEmail/$staffName>View</a>";
                                                    
                                                 }else {
                                                     echo "";
                                                 }
                                                 ?>
                                                    <?php 
                                                 if($sReimbursement == 1){
                                                   echo "<a href=".base_url()."travels/myretirement/$id/$csrf/$staffEmail/$staffName><button class='btn btn-xs btn-info'>Retire</button></a>";
                                                    
                                                 }else {
                                                     echo "";
                                                 }
                                                
                                                 ?>
                                                    
                                                </td>

                                               
                                                </tr>
                                             <?php } ?>

                                         <?php }else{ ?>
                                                
                                                <?php
                                                echo "No Pending Request";
                                                  }
                                                ?>
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
<script>
   $(document).ready(function(){
       
        var table = $('#reqeustapproval');
        var oTable = table.DataTable({
            "order": [[0, "desc" ]]
           
        });  
        
        /*
        $('#reqeustapproval').DataTable( {
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf'],
        "order": [[0, "desc" ]]
         });
         
         */
    
        
    });
</script>                 
        <?php echo $footer; ?>
