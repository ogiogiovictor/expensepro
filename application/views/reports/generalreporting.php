
<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="<?php echo base_url(); ?>assets/img/sidebar-1.jpg">

        <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
        -->

        <?php echo $sidebar; ?>

    </div>


    <div class="main-panel">

        <style type="text/css">
            .changeoption{
                border: 1px solid lightgrey;
                padding-left:10px;
                padding-right:10px;
                box-shadow: 0 15px 20px rgba(0, 0, 0, 0.3); 
                transition:all 0.3s ease;
                margin-left:20px;

            }
            .firstall{
                padding-top:10px;

            }
            .changeoption a:hover{
                color:red;
            }
        </style>

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
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header" data-background-color="blue">
                                                <h4 class="title">YEAR SUMMARY</h4>
                                                <p class="category">Summary (Naira Transactions Only)</p>
                                            </div>

                                            <div class="card-content">
                                               <!-- <canvas id="mycanvas"></canvas> -->

                                                <div>
                                                    <canvas id="bar-chart-grouped" width="800" height="350"></canvas>
                                                </div>



                                                <table class="">
                                                    <tr>
                                                        <td style="width:80%">
                                                            <table class="table table-responsive table-bordered table-hover table-striped">
                                                                <tr>
                                                                    <th>Request</th>
                                                                    <th>Year</th>
                                                                    <th>Paid Expense<br/><small>(Amount)</small></th>
                                                                    <th>Approved Request<br/><small>(Awaiting Payment)</small></th>
                                                                    <th>Total</th>
                                                                </tr>
                                                                <?php
                                                                if ($dYearonly) {

                                                                    foreach ($dYearonly as $yget) {
                                                                        $RequestCount = $yget->RequestCount;
                                                                        $TotalSUM = $yget->TotalSUM;
                                                                        $YEAR = $yget->YEAR;

                                                                        $dYearonlybutawaitingicu = $this->reportmodel->getawaitingapprovalicuonly($YEAR);
                                                                        $total = $TotalSUM + $dYearonlybutawaitingicu;
                                                                        ?>   
                                                                        <tr>
                                                                            <th><?php echo $RequestCount; ?></th>
                                                                            <th><a href="<?php echo base_url(); ?>userexpense/getmonthdetails/<?php echo $YEAR; ?>"><?php echo $YEAR; ?></a></th>
                                                                            <th><?php echo "&#8358;" . @number_format($TotalSUM, 2); ?></th>
                                                                            <th><?php echo "&#8358;" . @number_format($dYearonlybutawaitingicu, 2); ?></th>
                                                                            <th><?php echo "&#8358;" . @number_format($total, 2); ?></th>
                                                                        </tr>

        <?php
    }
}
?>


                                                            </table>
                                                        </td>

                                                        <td style="width:20%">

                                                            <div class="changeoption">
<?php
if ($getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 5 || $getApprovalLevel == 7 || $getApprovalLevel == 2) {
    echo " <a href='" . base_url() . "cireports/icureport'><div class='firstall'> APPROVED REQUEST</div></a>
                                                                 ";
}
?>

                                                                <?php
                                                                if ($getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 5 || $getApprovalLevel == 7) {
                                                                    echo "
                                                                     <a href='" . base_url() . "cireports/icureportrejected'><div class='firstall'>REJECTED REQUEST </div></a>
                                                                 ";
                                                                }
                                                                ?>



                                                                <?php
                                                                if ($getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 5 || $getApprovalLevel == 7) {
                                                                    echo "
                                                                     <a target='_blank' href='" . base_url() . "Archieves/index'><div class='firstall'>ARCHIEVE</div></a>
                                                                 ";
                                                                }
                                                                ?>

                                                                <a target='_blank' href="<?php echo base_url(); ?>cireports/mxdy_myds00k"><div class='firstall'>GENERAL</div></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>

<!--<a target="_blank" title="Bar Chart" href="<?php echo base_url(); ?>supports/barchartgraph"><img src="<?php echo base_url(); ?>public/images/barchart.svg"  style="width:100px"/></a>
<a target="_blank" title="Pie Chart" href="#"><img src="<?php echo base_url(); ?>public/images/images.png"  style="width:100px"/></a>-->
                                            </div>
                                        </div>
                                    </div>


                                </div>



                                <div class="row">


                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header" data-background-color="orange">
                                                <!--<i class="material-icons">explore</i>-->
                                                <i class="fa fa-bar-chart-o"></i>
                                            </div>
                                            <div class="card-content">
                                                <p class="category">Total Request</p>
                                                <h3 class="title"><a href="<?php echo base_url(); ?>Archieves/index"><span id="trequest"><?php echo $allRequest; ?></span></a></h3>
                                            </div>
                                            <div class="card-footer">
                                                <div class="stats">
                                                    <i class="material-icons text-danger">warning</i> <a href="#pablo" title="Total Petty Cash">PC: <?php echo $pc; ?></a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <i class="material-icons text-success">info</i> <a href="#pablo" title="Total Cheque">CH: <?php echo $ch; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>







                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header" data-background-color="green">
                                                <!--<i class="material-icons">store</i>-->
                                                <i class="fa fa-wpforms"></i>
                                            </div>
                                            <div class="card-content">
                                                <p class="category">Expense Code</p>
                                                <h3 class="title"><?php echo $cID; ?></h3>
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
                                                <!--<i class="material-icons">info_outline</i>-->
                                                <i class="fa fa-fighter-jet"></i>
                                            </div>
                                            <div class="card-content">
                                                <p class="category">Travel Start</p>
                                                <h3 class="title"><a href="<?php echo base_url(); ?>accounts/travelrequest"><?php echo $travelRequest; ?></a></h3>
                                            </div>
                                            <div class="card-footer">
                                                <div class="stats">
                                                    <i class="material-icons">local_offer</i>Flight Request
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header" data-background-color="blue">

                                                <i class="fa fa-ticket"></i>
                                            </div>
                                            <div class="card-content">
                                                <p class="category">Procurement</p>
                                                <h3 class="title"><a href="<?php echo base_url(); ?>accounts/fromprocurement"><?php echo $fromP; ?></a></h3>
                                            </div>
                                            <div class="card-footer">
                                                <div class="stats">
                                                    <i class="material-icons">update</i> Request From Procurement
                                                </div>
                                            </div>
                                        </div>
                                    </div>







                                </div><!--  <div class="row"> -->   





                                <!-- ////////////////////////////////  AGEING FOR DIFFERENT MONTHS //////////////////////////////////////// -->

                                <!--                                
                                                                <div class="row">
                                                                    
                                                                 <div class="col-lg-2 col-md-4 col-sm-6">
                                                                        <div class="card card-stats">
                                                                            
                                                                            <div class="card-content">
                                                                                <p class="category">1 - 30 (DAYS)</p>
                                                                                <h3 class="title"><a href="<?php echo base_url(); ?>accounts/numberofdays"><?php echo $thirtydays; ?></a></h3>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                    <div class="col-lg-2 col-md-4 col-sm-6">
                                                                        <div class="card card-stats">
                                                                            
                                                                            <div class="card-content">
                                                                                <p class="category">31 - 60 (DAYS)</p>
                                                                                <h3 class="title"><a href="<?php echo base_url(); ?>accounts/thirtytosixtydays"><?php echo $thirtyonetosixty; ?></a></h3>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                    <div class="col-lg-2 col-md-4 col-sm-6">
                                                                        <div class="card card-stats">
                                                                            
                                                                            <div class="card-content">
                                                                                <p class="category">61 - 120 (DAYS)</p>
                                                                                <h3 class="title"><a href="<?php echo base_url(); ?>accounts/onetwentydays"><?php echo $sixtyonetoonetwenty; ?></a></h3>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                    <div class="col-lg-2 col-md-4 col-sm-6">
                                                                        <div class="card card-stats">
                                                                            
                                                                            <div class="card-content">
                                                                                <p class="category">Above 6 months</p>
                                                                                <h3 class="title"><a href="<?php echo base_url(); ?>accounts/abovesixmonth"><?php echo $abovesixmonth; ?></a></h3>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-lg-2 col-md-4 col-sm-6">
                                                                        <div class="card card-stats">
                                                                            
                                                                            <div class="card-content">
                                                                                <p class="category">Above year</p>
                                                                                <h3 class="title"><a href="<?php echo base_url(); ?>accounts/oneyear"><?php echo $twelvemonth; ?></a></h3>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                    <div class="col-lg-2 col-md-4 col-sm-6">
                                                                        <div class="card card-stats">
                                                                            
                                                                            <div class="card-content">
                                                                                <p class="category">By Units</p>
                                                                                <h3 class="title">pending</h3>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>-->


                                <!-- ////////////////////////////////  END OF AGEING FOR DIFFERENT MONTHS //////////////////////////////////////// -->




                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="card card-nav-tabs">
                                            <div class="card-header" data-background-color="blue">
                                                <div class="nav-tabs-navigation">
                                                    <div class="nav-tabs-wrapper">
                                                        <span class="nav-tabs-title">Currency:</span>
                                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                                            <li class="active">
                                                                <a href="#profile" data-toggle="tab">
                                                                    <i class="material-icons">code</i>
                                                                    Others Currencies
                                                                    <div class="ripple-container"></div></a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-content">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="profile">
                                                        <table class="table table-responsive" id="">
                                                            <thead class="text-primary">

                                                            <th>COUNT</th>
                                                            <th>YEAR</th>
                                                            <!--<th>AMOUNT</th>-->
                                                            </thead>
                                                            <tbody>

<?php
if ($otherCurrency) {
    foreach ($otherCurrency as $cd) {
        $RequestCount = $cd->RequestCountng;
        $TotalSUM = $cd->TotalSUMng;
        $YEARng = $cd->YEARng;
        ?>
                                                                        <tr>
                                                                            <td><?php echo $RequestCount; ?></td>
                                                                            <td><a href="<?php echo base_url(); ?>userexpense/currencytypeinsideyear/<?php echo $YEARng; ?>"><?php echo $YEARng; ?> </a></td>
                                                                            <!--<td><?php echo @number_format($TotalSUM, 2); ?></td>-->
                                                                        </tr>

                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>

                                                    </div>

                                                </div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>-->

        <script>

            
     $.ajax({
        type: 'GET',
        //url: "https://c-iprocure.com/expensepro/budget/unitBudgetGraph",
        url: "http://localhost:8080/expenseprov2/budget/unitBudgetGraph",
        dataType: "html"
    }).done(function(data){
        var response = jQuery.parseJSON(data);

        new Chart(document.getElementById("bar-chart-grouped"), {
                type: 'bar',
                data: {
//      labels: ["ICT", "HR", "OUT", "HERZ"],
//     labels: GLOBALS.appRoot + "budget/unitBudgetGraph",
                    labels: response.label,
                    datasets: [
                        {
                            label: "Budget",
                            backgroundColor: "#3e95cd",
                            //data: [133, 221, 783, 2478]
                             data: response.budget
                        }, {
                            label: "Expense",
                            backgroundColor: "#cc0000",
                            //data: [408, 547, 675, 734]
                            data: response.expense
                        }
                    ]
                },
                options: {
                    title: {
                        display: true,
                        text: response.yearmont + ' Monthly Budget/Expense'
                       // text: response.yearmont + ' Yearly Budget/Expense'
                    }
                }
            });
            
       
    }).fail(function(){
        console.log('req failed');
    });
    
    
   </script>



<!--        <script src="<?php echo base_url(); ?>public/javascript/appschart.js"></script>
 <script src="<?php echo base_url(); ?>public/javascript/api.js"></script>-->
<?php echo $footer; ?>