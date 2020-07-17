
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
                                    
                                    
                                    <div class="col-lg-2 col-md-4 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-content">
                                                <p class="category">Total Request</p>
                                                <h3 class="title"><a href="<?php echo base_url(); ?>Archieves/index"><span id="trequest"><?php echo $allRequest; ?></span></a></h3>
                                               
                                            </div>
                                             &nbsp;<span style="color:red"><small>PC : <?php echo $pc; ?></small> &nbsp;&nbsp;  
                                                     <small>Ch : <?php echo $ch; ?></small></span>
                                        </div>
                                    </div>
                                    
                                    
                                     <div class="col-lg-2 col-md-4 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-content">
                                                <p class="category">Unpaid</p>
                                                <h3 class="title"><a href="<?php echo base_url(); ?>accounts/index"><span id="trequest"><?php echo $upaidCheques; ?></span></a></h3>
                                                
                                            </div>
                                           
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    <div class="col-lg-2 col-md-4 col-sm-6">
                                        <div class="card card-stats">
                                            
                                            <div class="card-content">
                                                <p class="category">Paid</p>
                                                <h3 class="title"><a href="<?php echo base_url(); ?>home/allcheques"><?php echo $paidCheques; ?></h3></a>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-lg-2 col-md-4 col-sm-6">
                                        <div class="card card-stats">
                                           
                                            <div class="card-content">
                                                <p class="category">Expense Code</p>
                                                <h3 class="title"><a href=""><?php echo $cID; ?></a></h3>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    <div class="col-lg-2 col-md-4 col-sm-6">
                                        <div class="card card-stats">
                                            
                                            <div class="card-content">
                                                <p class="category">Travel Start</p>
                                                <h3 class="title"><a href="<?php echo base_url(); ?>accounts/travelrequest"><?php echo $travelRequest; ?></a></h3>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-lg-2 col-md-4 col-sm-6">
                                        <div class="card card-stats">
                                            
                                            <div class="card-content">
                                                <p class="category">Procurement</p>
                                                <h3 class="title"><a href="<?php echo base_url(); ?>accounts/fromprocurement"><?php echo $fromP; ?></a></h3>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    
                                     
                                    
                                    
                                </div><!--  <div class="row"> -->   
                                
                                
                                
                                
                                <!-- ////////////////////////////////  AGEING FOR DIFFERENT MONTHS //////////////////////////////////////// -->
                                
                                
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
                                                <p class="category">Above 1year</p>
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
                                    
                                </div>
                                
                               
                                 <!-- ////////////////////////////////  END OF AGEING FOR DIFFERENT MONTHS //////////////////////////////////////// -->
                                
                                
                                
                                

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header" data-background-color="blue">
                                                <h4 class="title">YEAR SUMMARY</h4>
                                                <p class="category">Summary (Naira Transactions Only)</p>
                                            </div>
                                            
                                            <div class="card-content">
                                               <!-- <canvas id="mycanvas"></canvas> -->
                                               
                                                            <table class="table table-responsive table-bordered table-hover table-striped">
                                                                <tr>
                                                                    <th>Request</th>
                                                                    <th>Year</th>
                                                                    <th>Paid Expense<br/><small>(Amount)</small></th>
                                                                    <th>Approved Request<br/><small>(Awaiting Payment)</small></th>
                                                                    <th>Total</th>
                                                                </tr>
                                                                <?php
                                                                
                                                                    if($dYearonly){
                                                                        
                                                                        foreach($dYearonly as $yget){
                                                                            $RequestCount = $yget->RequestCount;
                                                                            $TotalSUM = $yget->TotalSUM;
                                                                            $YEAR = $yget->YEAR;
                                                                            
                                                                            $dYearonlybutawaitingicu = $this->reportmodel->getawaitingapprovalicuonly($YEAR);
                                                                            $total = $TotalSUM + $dYearonlybutawaitingicu;
                                                                           
                                                                ?>   
                                                                 <tr>
                                                                    <th><?php echo $RequestCount;  ?></th>
                                                                    <th><a href="<?php echo base_url(); ?>userexpense/getmonthdetails/<?php echo $YEAR; ?>"><?php echo $YEAR;  ?></a></th>
                                                                    <th><?php echo "&#8358;".@number_format($TotalSUM, 2);  ?></th>
                                                                    <th><?php echo "&#8358;".@number_format($dYearonlybutawaitingicu, 2);  ?></th>
                                                                    <th><?php echo "&#8358;".@number_format($total, 2);  ?></th>
                                                                </tr>
                                                                
                                                                <?php
                                                                            
                                                                        }
                                                                        
                                                                    }
                                                                    
                                                                ?>
                                                                
                                                                
                                                            </table>
                                                       
                                                     
                                                <!--<a target="_blank" title="Bar Chart" href="<?php echo base_url(); ?>supports/barchartgraph"><img src="<?php echo base_url(); ?>public/images/barchart.svg"  style="width:100px"/></a>
                                                <a target="_blank" title="Pie Chart" href="#"><img src="<?php echo base_url(); ?>public/images/images.png"  style="width:100px"/></a>-->
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

            $(document).ready(function () {
                $('#hodall, #othersme, #units').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['excel', 'pdf']
                });
            });
        </script>   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
        <script src="<?php echo base_url(); ?>public/javascript/appschart.js"></script>
         <script src="<?php echo base_url(); ?>public/javascript/api.js"></script>
<?php echo $footer; ?>