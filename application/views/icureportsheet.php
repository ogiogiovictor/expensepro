
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
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header" data-background-color="green">
                                                EXPENSE BY DATE -<small> (What would you like to print ?)</small>
                                            </div>
                                            <div class="card-content">
                                                <?php
                                                if ($getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 5) {
                                                    echo "<div class='alert alert-danger'>
                                                     <a href='" . base_url() . "cireports/icureport'><span> <i class='material-icons'>line_style</i>  APPROVED REQUEST</span></a>
                                                 </div>";
                                                }
                                                ?>

                                                <?php
                                                if ($getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 5) {
                                                    echo "<div class='alert alert-primary'>
                                                     <a href='" . base_url() . "cireports/icureportrejected'><span> <i class='material-icons'>line_style</i> REJECTED REQUEST </span></a>
                                                 </div>";
                                                }
                                                ?>
                                            </div>
                                            <div class="card-footer">
                                                <div class="stats">
                                                    <i class="material-icons">access_time</i> Total Cost Value (Approved)
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header" data-background-color="blue">
                                                <h4 class="title">GRAPH</h4>
                                                <p class="category">Different Graphical Representation</p>
                                            </div>

                                            <div class="card-content">
                                               <!-- <canvas id="mycanvas"></canvas> -->
                                                <a target="_blank" title="Bar Chart" href="<?php echo base_url(); ?>supports/barchartgraph"><img src="<?php echo base_url(); ?>public/images/barchart.svg"  style="width:100px"/></a>
                                                <a target="_blank" title="Pie Chart" href="#"><img src="<?php echo base_url(); ?>public/images/images.png"  style="width:100px"/></a>
                                            </div>
                                        </div>
                                    </div>


                                </div>




                                <div class="row">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="card card-nav-tabs">
                                            <div class="card-header" data-background-color="purple">
                                                <div class="nav-tabs-navigation">
                                                    <div class="nav-tabs-wrapper">
                                                        <span class="nav-tabs-title">Tasks:</span>
                                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                                            <li class="active">
                                                                <a href="#profile" data-toggle="tab">
                                                                    <i class="material-icons">code</i>
                                                                    Expense by Accout Code
                                                                    <div class="ripple-container"></div></a>
                                                            </li>

                                                            <li class="">
                                                                <a href="#usermove" data-toggle="tab">
                                                                    <i class="material-icons">cloud</i>
                                                                    Expense by User
                                                                    <div class="ripple-container"></div></a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-content">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="profile">
                                                        <table class="table table-responsive" id="othersme">
                                                            <thead class="text-primary">
                                                               <!--<th>ID</th>
                                                               <th>Count</th>-->
                                                            <th>CODE</th>
                                                            <th>CODE NAME</th>
                                                            <th>AMOUNT</th>
                                                            </thead>
                                                            <tbody>

                                                                <?php
                                                                if ($getallAccountcode) {
                                                                    foreach ($getallAccountcode as $cd) {
                                                                        $requestID = $cd->requestID;
                                                                        $request = $cd->request;
                                                                        $exAmount = $cd->ex_Amount;
                                                                        $total = $cd->total;
                                                                        $ex_Code = $cd->ex_Code;
                                                                        ?>
                                                                        <tr>
                                                                            <!--<td><?php //echo $requestID;  ?></td> 
                                                                             <td><?php //echo $request;  ?></td>-->
                                                                            <td><?php echo $ex_Code; ?></td>
                                                                            <td><a href="<?php echo base_url(); ?>supports/getcodesupport/<?php echo $requestID; ?>"><?php echo $this->mainlocation->nameCode($ex_Code); ?> </a></td>
                                                                            <td><?php echo @number_format($total, 2); ?></td>
                                                                        </tr>

                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>

                                                    </div>


                                                    <!----- EXPENSE BY USER TAB ------>
                                                    <div class="tab-pane active" id="usermove">

                                                        <div class="card-content table-responsive">
                                                            <table class="table table-responsive" id="hodall">
                                                                <thead class="text-primary">

      <!--<th>ID</th>-->
                                                                <th>Count</th>
                                                                <th>USER NAME</th>
                                                                <th>AMOUNT</th>
                                                                </thead>
                                                                <tbody>
<?php
if ($getallUsers) {
    foreach ($getallUsers as $user) {
        $id = $user->id;
        $email = $user->sessionID;
        $myRequest = $user->myRequest;
        $total = $user->total;
        ?>

                                                                            <tr>
                                                                               <!-- <td><?php //echo $id; ?></td> -->
                                                                                <td><?php echo $myRequest; ?></td>
                                                                                <td><a href="<?php echo base_url(); ?>supports/getuserrequestdetails/<?php echo $email; ?>"><?php echo $this->adminmodel->getUsername($email); ?></a></td>
                                                                                <td><?php echo @number_format($total, 2); ?></td>
                                                                            </tr>

        <?php
    }
}
?>
                                                                </tbody>
                                                            </table>

                                                        </div>

                                                    </div>

                                                    <!----- END OF EXPENSE BY USER TAB ------>


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-12">
                                        <div class="card">
                                            <div class="card-header" data-background-color="blue">
                                                <h4 class="title">Expense by Unit</h4>
                                                <p class="category">All Unit</p>
                                            </div>

                                            <div class="card-content table-responsive">
                                                <table class="table table-responsive" id="units">
                                                    <thead class="text-primary">
                                                       <!--<th>COUNT</th> -->
                                                    <th>UNIT NAME</th>
                                                    <th>AMOUNT</th>
                                                    </thead>
                                                    <tbody>

                                            <?php
                                            if ($dTotal) {

                                                foreach ($dTotal as $getAll) {
                                                    $reqID = $getAll->id;
                                                    $reqCount = $getAll->count;
                                                    $mainUnit = $getAll->dUnit;
                                                    $sumAll = $getAll->totalprice;
                                                    ?>
                                                                <tr>
                                                                    <!--<td><?php //echo $reqCount; ?></td> -->
                                                                    <td><a href="<?php echo base_url(); ?>supports/getapprovedrequest/<?php echo urlencode($mainUnit); ?>"><?php echo $this->mainlocation->getdUnit($mainUnit); ?></a></td>
                                                                    <td><?php echo @number_format($sumAll, 2); ?></td>
                                                                </tr>

                                                    <?php
                                                }
                                            }
                                            ?>
                                                </table>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- EXPENSE BY USER WAS REMOVED FROM HERE -->

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

            $(document).ready(function () {
                $('#hodall, #othersme, #units').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['excel', 'pdf']
                });
            });
        </script>    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
        <!--<script src="<?php echo base_url(); ?>public/chartjs/src/chart.js"></script>-->
        <script src="<?php echo base_url(); ?>public/javascript/appschart.js"></script>
<?php echo $footer; ?>