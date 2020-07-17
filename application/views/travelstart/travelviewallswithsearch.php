
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
                                <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">ALL REQUEST :: TRAVELLING LOGISTICS REQUEST</span></span>&nbsp;<i class="fa fa-bus" aria-hidden="true"></i></h4>
                                <p class="category"> </span></p>
                            </div>


                            <div class="card-content">
                                
                                <form action="<?php echo base_url(); ?>travels/xvL_dsviewal_search" method="GET" name="formGet">
                                       
                                        
                                         <table>
                                            <tr>
                                                <td>  <b>Travel ID::</b> &nbsp;&nbsp;&nbsp;
                                                    <input class="form-controls" placeholder="Travel ID" type="text" name="id" id="id" />
                                                 </td>
                                                 
                                                   <td>
                                                       <b>Start Date: </b> <input class="datepicker form-controls" placeholder="Start Date" type="text" name="startDate" id="startDate" />
                                                  
                                                 </td>
                                                 
                                                  <td>  <b>End Date</b> &nbsp;&nbsp;&nbsp;
                                                    <input class="form-controls" placeholder="End Date" type="text" name="endDate" id="endDate" />
                                                 </td>
                                                 
                                                 
                                                 <td>  <b>&nbsp;</b> &nbsp;&nbsp;&nbsp;
                                                    <button type="submit" class="btn-danger btn-xs">Search Travel</button>
                                                 </td>
                                              
                                                 
                                                 
                                            </tr>
                                            
                                          
                                        </table>
                                        
                                        <hr/>
                                        
                                        
                                    </form>   

                                <table class="table table-responsive table-hover" id="reqeustapproval">
                                    <thead class="text-primary">
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Staff ID</th>
                                    <th>Staff Name </th>
                                    <th>Location</th>
                                    <th>Unit</th>
                                    <th>Total Amount</th>
                                     
                                    <th>Perdiem</th>
                                    <th>Hotel</th>
                                    <th>Transport</th>
                                    
                                    <th>Treated By By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <!--<th>Action</th>-->

                                    </thead>
                                    <tbody>
                                        <?php if ($totalflightrquest) { ?>
                                            <?php
                                            foreach ($totalflightrquest as $get) {
                                                $id = $get->id;
                                                $csrf = $get->csrf;
                                                $dateCreated = $get->dateCreated;
                                                $staffID = $get->staffID;
                                                $staffName = $get->staffName;
                                                $location = $get->location;
                                                $CurrencyType = $get->dCurrency;
                                                $unit = $get->unit;
                                                $paymentType = $this->mainlocation->getpaymentType($get->paymentType);
                                                $sTotal = $get->sTotal;
                                                $approval = $get->approval;
                                                $warefofficer = $get->warefofficer;
                                                $approvedBy = $get->approvedBy;
                                                $preparedBy = $get->preparedBy;

                                                // Approval = 0 "pending" // Approval = 1 "Awaiting HOD"
                                                // Approval = 2 "Rejected" // Approval = 3 "In Account"
                                                // Approval = 4 "paid" // Approval = 0 "pending"

                                                if ($approval == 0) {
                                                    $newapprovals = "<span style='color:indigo'>Pending</span>";
                                                } else if ($approval == 1) {
                                                    $newapprovals = "<span style='color:red'>Awaiting Approval</span>";
                                                } else if ($approval == 2) {
                                                    $newapprovals = "<span style='color:grey'>Rejected</span>";
                                                } else if ($approval == 3) {
                                                    $newapprovals = "<span style='color:blue'>Awaiting Payment</span>";
                                                } else if ($approval == 4) {
                                                    $newapprovals = "<span style='color:cyan'>Paid</span>";
                                                } else {
                                                    $newapprovals = "pending";
                                                }


                                                $approvals = $this->travelmodel->getnewStatus($id);


                                                if ($approvals == 0) {
                                                    $newapproval = "Pending";
                                                } else if ($approvals == 1) {
                                                    $newapproval = "<span style='color:red'>Awaiting HOD Approval</span>";
                                                } else if ($approvals == 2) {
                                                    $newapproval = "<span style='color:blue'>Awaiting ICU Approval</span>";
                                                } else if ($approvals == 3) {
                                                    $newapproval = "<span style='color:indigo'>Awaiting Payment</span>";
                                                } else if ($approvals == 4) {
                                                    $newapproval = "<span style='color:green'>Ready for Collection</span>";
                                                } else if ($approvals == 5) {
                                                    $newapproval = "<span style='color:red'>Not Approved By HOD</span>";
                                                } else if ($approvals == 6) {
                                                    $newapproval = "<span style='color:grey'>Reject by ICU</span>";
                                                } else if ($approvals == 7) {
                                                    $newapproval = "<span style='color:indigo'>Cheque Sent for Signature</span>";
                                                } else if ($approvals == 8) {
                                                    $newapproval = "<span style='color:green'>Signed & Ready for Collection</span>";
                                                } else if ($approvals == 11) {
                                                    $newapproval = "<span style='color:brown'>Closed</span>";
                                                } else if ($approvals == 12) {
                                                    $newapproval = "<span style='color:brown'>Rejected By Accounts</span>";
                                                } else {
                                                    $newapproval = "<span style='color:skyblue'>pending</span>";
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
                                                
                                                ?> 
                                                <tr>
                                                     <td><?php echo  $id; ?></td>
                                                    <td><?php echo  $dateCreated; ?></td>
                                                    <td><?php echo $staffID; ?></td>
                                                    <td><?php echo $staffName; ?>
                                                       <br/> <small style="color:red"><?php echo $preparedBy; ?></small>
                                                    </td>
                                                    <td><?php echo $location; ?></td>
                                                    <td><?php echo $unit; ?></td>

                                                    <td><?php echo $newCurrency. $sTotal ?></td>
                                                    
                                                    <td><?php echo $this->primary->getsinglecolumn("amount", " travelstart_expense", "travelStart_ID", $id); ?></td>
                                                     <td><?php echo $this->primary->getsinglecolumn("amountLocal", " travelstart_expense", "travelStart_ID", $id); ?></td>
                                                    <td><?php echo $this->primary->getsinglecolumn("amount", " travelstart_expense", "travelStart_ID", $id); ?></td>
                                                    
                                                    
                                                    <td><?php echo $approvedBy; ?></td>

                                                    <td><?php echo $newapproval; ?></td>
                                                    <td>
                                                        <a class="viewFlight btn btn-xs btn-primary" data-id="<?php echo $id; ?>" onClick="toggle_visibility('popup-box')" >
                                                        <span style="cursor: pointer"><i class="fa fa-picture-o"></i></span>&nbsp;&nbsp;</a>
                                                        
                                                        <?php
                                                        if ($approvals == 1) {
                                                           echo '<a href="'.base_url().'travels/xvD__dmsk938d/'.$id.'/'.$staffID.'/'.$csrf.'">
                                                            <button type="button" rel="tooltip" title="Edit" class="btn btn-xs btn-danger">
                                                              <i class="material-icons">edit</i>
                                                          </button>
                                                          </a>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <!--<td><button class="btn btn-xs btn-primary">View</button></td>-->


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
                            <!-- POP UP BOX HERE -->
                                   <div id="popup-box" class="popup-position">
                                       <div id="popup-wrapper">
                                           <div id="popup-container">
                                               <span class="pull-right"><a href="javascript:void(0)" onClick="toggle_visibility('popup-box');">close</a></span>
                                               <span id="eloaddformerror"></span>
                                               <span id="loaddepdetails"></span>
                                           </div>
                                       </div>
                                   </div>
                                   <!-- END OF POP UP BOX -->
                    <!-- Inside Content Ends Here -->


                </div>


            </div>
        </div>
        <!-- Main Outer Content Ends  Here --> 
        <script>
            $(document).ready(function () {

                var table = $('#reqeustapproval');
                var oTable = table.DataTable({
                     dom: 'Bfrtip',
                      buttons: ['excel', 'pdf'],
                    "order": [[0, "desc"]]

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
