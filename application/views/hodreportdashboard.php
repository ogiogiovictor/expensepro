<style type="text/css">
    .maincanvascontent{
        width:330px;
        height:auto;
    }
</style>
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


                        <div class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header" data-background-color="orange">
                                                <i class="material-icons">explore</i>
                                            </div>
                                            <div class="card-content">
                                                <p class="category">Total Request</p>
                                                <h3 class="title"><a href="<?php echo base_url(); ?>supports/totoalrequestperunit"><?php echo $getCount; ?></a></h3>
                                                <a href="<?php echo base_url(); ?>supports/pendingrequestbyunit/<?php echo $getmyUnit; ?>"> <?php echo $awaitingCount; ?>(Pending)</a>
                                            </div>
                                            <div class="card-footer">
                                                <div class="stats">
                                                    <i class="material-icons text-danger">warning</i> <a href="#pablo"><?php echo $getUnitName; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header" data-background-color="green">
                                                <i class="material-icons">store</i>
                                            </div>
                                            <div class="card-content">
                                                <p class="category">Approved Request</p>
                                                <h3 class="title"><?php echo $getapprovingCount = $getapprovingCount != "" ? $getapprovingCount : "0"; ?></h3>
                                            </div>
                                            <div class="card-footer">
                                                <div class="stats">
                                                    <i class="material-icons">date_range</i> Total Approved Request
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header" data-background-color="red">
                                                <i class="material-icons">info_outline</i>
                                            </div>
                                            <div class="card-content">
                                                <p class="category">Rejected Request</p>
                                                <h3 class="title"><?php echo $getrejectCountnow; ?></h3>
                                            </div>
                                            <div class="card-footer">
                                                <div class="stats">
                                                    <i class="material-icons">local_offer</i>Total Rejected Request
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div style="padding:25px" class="card-header" data-background-color="blue">
                                                <span style="font-size:30px">&#8358;</span>
                                            </div>
                                            <div class="card-content">
                                                <p class="category">Total Expense</p>
                                                <h3 class="title">
                                                    <?php 
                                                $newAmount = 0;
                                                if($dTotal){
                                                    
                                                    foreach($dTotal as $amt){
                                                        $totalAmount = $amt->dAmount;
                                                        
                                                        if($totalAmount){
                                                            $newAmount += $totalAmount;
                                                        }
                                                    }
                                                }
                                                
                                                echo "<a href=".base_url()."supports/getapprovedrequest/$getmyUnit>".@number_format($newAmount, 2)." </a>";
                                                ?></h3>
                                            </div>
                                            <div class="card-footer">
                                                <div class="stats">
                                                    <i class="material-icons">update</i> Approved Amount
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header" data-background-color="red">
                                                <h6 class="title">EXPENSE PER USER</h6>
                                            </div>
                                            
                                            <div class="card-content maincanvascontent">
                                                <canvas id="mycanvashod"></canvas>
                                            </div>
                                            
                                            
                                            <div class="card-footer">
                                                <div class="stats">
                                                    <i class="material-icons">access_time</i> Ongoing
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="card">
                                           <div class="card-header" data-background-color="red">
                                                <h4 class="title">SEARCH REPORT</h4>
                                                <p class="category">All reports are based on the Unit</p>
                                            </div>
                                            <div class="card-content">
                                                
                                                <p class="resultpage">
                                                     <div id="resultpage"></div>
                                                <form class="form-horizontal" name="catmaintform"  method="POST" action="http://localhost/moneybook/supports/gethodreportfordepartment">
                                                              <div class="col-md-4">
                                                                    <div class="form-group">
                                                                    <label class="control-label label-floating">From Date</label>
                                                                    <input placeholder="From Date" type="text" class="form-control datepicker" name="dateCreatedfrom" id="dateCreatedfrom" />
                                                                    </div>
                                                              </div>
                                                                
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                    <label class="control-label label-floating">To Date</label>
                                                                    <input placeholder="To Date" type="text" class="form-control datepicker" name="dateCreatedTo" id="dateCreatedTo" />
                                                                    </div>
                                                              </div>
                                                                
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                    <label class="control-label label-floating">Select Status</label>
                                                                    <select name="dUnit" id="status" name="status" class="form-control">
                                                                        <option value="">Select Status</option>
                                                                        <option value="1">Pending</option>
                                                                        <option value="4">Approved</option>
                                                                        <option value="5">Rejected</option>
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                              <div class="col-md-12">
                                                                    <input type="button" data-background-color="red" class="btn-block btn-lg btn-google" name="searchReportbyhod" id="searchReportbyhod" value="Search Report" />
                                                                    
                                                              </div>
                                                                
                                                                  
                                                            </form>
                                            </p>
                                                
                                            </div>
                                            <br/>
                                            <!--<div class="card-footer">
                                                <div class="stats">
                                                    <i class="material-icons">access_time</i> Ongoing
                                                </div>
                                            </div>-->

                                        </div>
                                    </div>

                                    <!--<div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header card-chart" data-background-color="red">
                                                <div class="ct-chart" id="completedTasksChart"></div>
                                            </div>
                                            <div class="card-content">
                                                <h4 class="title">Yearly Graphical Representation</h4>
                                                <p class="category">displays yearly graphical representation</p>
                                            </div>
                                            <div class="card-footer">
                                                <div class="stats">
                                                    <i class="material-icons">access_time</i> ongoing
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                                    
                                    
                                    
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="card card-nav-tabs">
                                            <div class="card-header" data-background-color="purple">
                                                <div class="nav-tabs-navigation">
                                                    <div class="nav-tabs-wrapper">
                                                        <span class="nav-tabs-title">Tasks:</span>
                                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                                            <li class="active">
                                                                <a href="#profile" data-toggle="tab">
                                                                    <i class="material-icons">bug_report</i>
                                                                   By Location
                                                                    <div class="ripple-container"></div></a>
                                                            </li>
                                                            <li class="">
                                                                <a href="#messages" data-toggle="tab">
                                                                    <i class="material-icons">code</i>
                                                                    Request Per Staff
                                                                    <div class="ripple-container"></div></a>
                                                            </li>
                                                            <li class="">
                                                                <a href="#settings" data-toggle="tab">
                                                                    <i class="material-icons">cloud</i>
                                                                   By Account Code
                                                                    <div class="ripple-container"></div></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-content">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="profile">
                                                        
                                                        <p>

                                                             <table class="table table-hover">
                                                    <thead class="text-warning">
                                                    <th>ID</th>
                                                    <th>Location</th>
                                                    <th>Abbrev</th>
                                                    <th>&nbsp;</th>
                                                    </thead>
                                                    <tbody>                       
                                                        <?php
                                                        if ($getallLocationwhereunitisprocurement) {
                                                           // var_dump($getallLocationwhereunitisprocurement);
                                                            foreach ($getallLocationwhereunitisprocurement as $get) {
                                                                $locationID = $get->id;
                                                                $locationName = $get->locationName;
                                                                $abbr = $get->abbr;
                                                                
                                                              
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $locationID; ?></td>
                                                                    <td><?php echo $locationName; ?></td>
                                                                    <td><?php echo $abbr; ?></td>
                                                                    <td><a href="<?php echo base_url(); ?>supports/sameunitdifflocale/<?php echo $locationID; ?>/<?php echo $getmyUnit; ?> "<button class="btn btn-google btn-xs">View</button></a></td>
                                                                </tr>

                                                            </tbody>

                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </table>  
                                                        

                                                        </p>

                                                    </div>
                                                    <div class="tab-pane" id="messages">
                                                        <table class="table table-hover">
                                                    <thead class="text-warning">
                                                    <th>ID</th>
                                                    <th>Staff Name</th>
                                                    <th>Total Request</th>
                                                    <th>&nbsp;</th>
                                                    </thead>
                                                    <tbody>                       
                                                        <?php
                                                        $totalAmount = "";
                                                        if ($getallStaffinmyUnit) {
                                                            foreach ($getallStaffinmyUnit as $get) {
                                                                $id = $get->id;
                                                                $fname = $get->fname;
                                                                $lname = $get->lname;
                                                                $email = $get->email;
                                                                $dUnit = $get->dUnit;
                                                                
                                                                $getmyCountRequest = $this->cashiermodel->getallrequestforstaff($email, $dUnit);
                                                                if($getmyCountRequest !== FALSE){
                                                                   $getTotalCount = count($getmyCountRequest); 
                                                                }else{
                                                                   $getTotalCount = '0'; 
                                                                }
                                                                
                                                                
                                                               
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $id; ?></td>
                                                                    <td><?php echo $fname." ".$lname; ?></td>
                                                                    <td><?php echo $getTotalCount; ?></td>
                                                                    <td><a href="<?php echo base_url(); ?>supports/requestperstaff/<?php echo $email; ?>"><button class="btn btn-primary btn-xs">View</button></a></td>
                                                                </tr>

                                                            </tbody>

                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </table>  
                                                        
                                                    </div>
                                                    
                                                    
                                                    <div class="tab-pane" id="settings">
                                                        <table class="table">
                                                            <tbody>
                                                               
                                                               Job Order goes here (ongoing - Asset Management App)
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="card">
                                            <div class="card-header" data-background-color="orange">
                                                <h4 class="title">Latest Request</h4>
                                                <p class="category">All Locations</p>
                                            </div>

                                            <div class="card-content table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="text-warning">
                                                    <th>ID</th>
                                                    <th>Date</th>
                                                    <th>Title</th>
                                                    <th>Amount</th>
                                                     <th>Status</th>
                                                    </thead>
                                                    <tbody>                       
                                                        <?php
                                                        if ($getfourresults) {
                                                            foreach ($getfourresults as $get) {
                                                                $lid = $get->id;
                                                                $ndescriptOfitem = $get->ndescriptOfitem;
                                                                $dateCreated = $get->dateCreated;
                                                                $dAmount = $get->dAmount;
                                                                $approvals = $get->approvals;
                                                                
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
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $lid; ?></td>
                                                                    <td><?php echo $dateCreated; ?></td>
                                                                    <td><?php echo $ndescriptOfitem; ?></td>
                                                                    <td><?php echo @number_format($dAmount, 2); ?></td>
                                                                     <td><?php echo $newapproval; ?></td>
                                                                </tr>

                                                            </tbody>

                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </table>  

                                            </div>
                                        </div>
                                    </div>
                                </div>
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
           $(function  () {
                $('#hodall').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['excel', 'pdf']
                            //buttons: [ 'colvis' ]
                });
            });

        </script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
<!--<script src="<?php echo base_url(); ?>public/chartjs/src/chart.js"></script>-->
<script src="<?php echo base_url(); ?>public/javascript/appscharthod.js"></script>
<?php echo $footer; ?>