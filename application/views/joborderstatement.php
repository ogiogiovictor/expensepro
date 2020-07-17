
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


                    <!-- Beginning of Request Details with Status -->

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title">Asset Maintenance </h4>
                                <p class="category">Awaiting Approval</p>
                            </div>


                            <div class="card-content table-responsive">
                                <table class="table table-condensed table-hover" id="mydata">
                                    <thead class="text-primary">
                                    <th>Date</th>
                                    <th style="width:200px">Asset Name</th>
                                    <th>Estimated Cost</th>
                                    <th>Problem</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                    </thead>
                                    <tbody>

                                        <?php if ($getAllAcess) { ?>
                                            <?php
                                            foreach ($getAllAcess as $get) {

                                                $id = $get->id;
                                                $aid = $get->aid;
                                                $assetName = $this->assets->getAssetName($get->aid);
                                                $datePurchase = $this->assets->datePurchase($get->aid);
                                                $vendorID = $get->vendorName;
                                                $vendorName = $this->assets->dvendorName($get->approveVendorID);
                                                $parts = $get->parts;
                                                $estimatedCost = number_format($get->estimatedCost);
                                                $qty = $get->qty;
                                                $recommendation = $get->recommendation;
                                                $scheduleDate = $get->scheduleDate;
                                                //$approveName = $this->users->getUsernamewithID($get->approve);
                                                $approve = $get->approve;
                                                //$secondLevelapproval = $this->users->getUsernamewithID($get->secondLevelapproval);
                                                $actualCost = number_format($get->actualCost);
                                                $approveBy = $get->approveBy;
                                                //$disposedStatus = $get->disposedStatus;
                                                $allocatedlastestuser = $this->assets->dgetAllocatedUser($get->aid);


                                                $imgUrl = $get->imgUrl;


                                                if ($imgUrl) {
                                                    $imgUrlview = "<a target='_blank'  href='http://localhost/assetmgt/document/$imgUrl'>Invoice</a>";
                                                } else {
                                                    $imgUrlview = '';
                                                }
                                                //Get Result from Maintenance Base on ID



                                                if ($approve == 1 AND $getLevelApprove == 1) {
                                                  
                                                    $getStatus = "<a class=\"btn btn-fill btn-info btn-primary btn-xs\">Approved</a>";
                                                } else if ($approve == "0" AND $getLevelApprove == 2) {
                                                    $getStatus = "<a style='color:red'>Pending Job Order</a>";
                                                }else if ($approve == 4 && $getLevelApprove == 2) {
                                                $getStatus = "<a class=\"btn btn-fill btn-danger btn-xs\">Pending Requestion</a>";
                                                 } 
                                                ?>
                                                <?php 
                                                $randomString = random_string('alnum', 95);
                                                ?>
                                                <tr>
                                                    <td><?php echo $scheduleDate; ?></td>
                                                    <td><?php 
                                                    if ($getLevelApprove == 2 && $approve == 4) {
                                                     echo "<a style=\"cursor:pointer\" class=\"dparts\" data-toggle=\"modal\" href=\"#myModal\" data-id=\"$partsUsed\">$assetName. '-'. $allocatedlastestuser</a>";
                                                    }else{
                                                       echo $assetName. "-". $allocatedlastestuser; 
                                                    }
                                                     ?>
                                                    </td>
                                                    <td><?php echo $estimatedCost; ?></td>
                                                    <td><?php echo $parts; ?></td>
                                                    <td><?php echo $getStatus; ?></td>
                                                    <td>
                                                    <?php
                                                    if($approve == 4){
                                                     echo "<span><i style='cursor:pointer' data-id='$id' onClick='document.getElementById('acctbox') title='Approve' class='material-icons btn-circle-sm customizealert'>check_circle</i>&nbsp;&nbsp;$imgUrlview</span>";
                                                    }else{
                                                      echo "<a href='".base_url()."assetmgt/viewawaitingapproval/$id/$assetName/$randomString'><button type='button' id='myBtn' title='View' class='btn btn-fill btn-info btn-facebook btn-xs myBtn'>View</button></a>"; 
                                                    }
                                                    ?>
                                                    </td>


                                                </tr>

                                                <?php }  ?>

                                                <?php }  ?>	

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