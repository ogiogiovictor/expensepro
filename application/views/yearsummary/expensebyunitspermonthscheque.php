
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


                    <!-- Inside Content Begins  Here -->

                    <!-- Beginning of Request Details with Status -->

                    <div class="col-md-8 col-md-offset-2">     
                        <div class="card">
                            <div class="card-header text-center" data-background-color="blue">
                                <h4 class="title"><span style="font-size: 20px; font-weight: bold">&#x20A6;</span> &nbsp;DEPARTMENTAL EXPENSE FOR <?php echo $this->cashiermodel->bringmyunits($getmyUnit); ?></h3>
                                    <p class="category">Monthly Expense for Year (PETTY CASH) :-  <?php echo $year; ?></p>
                                    <span id="showError"></span>
                            </div>

                            <div class="card-content">
                                <div class="">

                                    <!-- Beginnin of Form -->
                                    <table class="table table-responsive table-striped table-bordered">
                                        <tr>
                                            <th>Request</th>
                                            <th>Year</th>
                                            <th>Month</th>
                                            <th>Amount</th>
                                        </tr>
                                        <?php
                                        if ($dYearonly) {

                                            foreach ($dYearonly as $yget) {
                                                $RequestCount = $yget->RequestCount;
                                                $TotalSUM = number_format($yget->TotalSUM, 2);
                                                $YEAR = $yget->YEAR;
                                                $Month = $yget->Month;
                                                ?>    
                                        
                                            <?php
                                                   if($Month == 1){
                                                       $newMonth = "January";
                                                   }else if($Month == 2){
                                                       $newMonth = "February";
                                                   }else if($Month == 3){
                                                        $newMonth = "March";
                                                   }else if($Month == 4){
                                                       $newMonth = "April";
                                                   }else if($Month == 5){
                                                        $newMonth = "May";
                                                   }else if($Month == 6){
                                                        $newMonth = "June";
                                                   }else if($Month == 7){
                                                       $newMonth = "July";
                                                   }else if($Month == 8){
                                                       $newMonth = "August";
                                                   }else if($Month == 9){
                                                        $newMonth = "September";
                                                   }else if($Month == 10){
                                                       $newMonth = "October";
                                                   }else if($Month == 11){
                                                       $newMonth = "November";
                                                   }else{
                                                     $newMonth = "December";
                                                   }

                                                ?>
                                                
                                                <tr>
                                                    <th><?php echo $RequestCount; ?></th>
                                                    <td><a href="<?php echo base_url(); ?>userexpense/getmoredetailsbytransactbychequeonly/<?php echo $getmyUnit ?>/<?php echo $YEAR; ?>/<?php echo $Month; ?>"><?php echo $YEAR; ?></a></td>
                                                    <td><a href="<?php echo base_url(); ?>userexpense/getmoredetailsbytransactbychequeonly/<?php echo $getmyUnit ?>/<?php echo $YEAR; ?>/<?php echo $Month; ?>"><?php echo $Month; ?> - <?php echo $newMonth; ?></a></td>
                                                    <td><a href="<?php echo base_url(); ?>userexpense/getmoredetailsbytransactbychequeonly/<?php echo $getmyUnit ?>/<?php echo $YEAR; ?>/<?php echo $Month; ?>">&#8358;<?php echo $TotalSUM; ?></a></td>
                                                </tr>

                                                    <?php
                                                }
                                            }
                                            ?>


                                    </table>
                                    <!-- End of Form -->

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



<?php echo $footer; ?>