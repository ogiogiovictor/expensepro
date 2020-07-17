
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
                                    <p class="category">Yearly Departmental Expense</p>
                                    <span id="showError"></span>
                            </div>

                            <div class="card-content">
                                <div class="">

                                    <!-- Beginnin of Form -->

                                    <table class="table table-responsive table-striped table-responsive">
                                        <tr>
                                            <th>Request</th>
                                            <th>Year</th>
                                            <th>Amount</th>
                                        </tr>
                                        <?php
                                        if ($dYearonly) {

                                            foreach ($dYearonly as $yget) {
                                                $RequestCount = $yget->RequestCount;
                                                $TotalSUM = number_format($yget->TotalSUM, 2);
                                                $YEAR = $yget->YEAR;
                                                ?>       

                                                <tr>
                                                    <td><?php echo $RequestCount; ?></td>
                                                    <th><a href="<?php echo base_url(); ?>userexpense/getmoredetails/<?php echo $getmyUnit ?>/<?php echo $YEAR; ?>"><?php echo $YEAR; ?></a></th>
                                                    <th><a href="<?php echo base_url(); ?>userexpense/getmoredetails/<?php echo $getmyUnit ?>/<?php echo $YEAR; ?>">&#8358;<?php echo $TotalSUM; ?></a></th>
                                                </tr>

                                        <?php
                                    }
                                }
                                ?>


                                    </table>


                                    <div style="font-weight: bold; font-size:20px; margin-top:30px"><center>BREAKDOWN BY PAYMENT TYPES</center></div>
                                    <hr/>
                                    <table class="table table-condensed table-responsive table-striped">
                                        <tr>
                                            <th><center><span style="font-size:20px;">Petty Cash</span></center></th>
                                        </tr>
                                    </table>
                                    
                                    
                                    <table class="table table-responsive table-bordered">
                                        <tr>
                                            <th>Request</th>
                                            <th>Year</th>
                                            <th>Amount</th>
                                        </tr>
                                        
                                        <?php
                                            if ($dYearpettycash) {
                                                foreach ($dYearpettycash as $yget) {
                                                    $pettyCount = $yget->RequestCount;
                                                    $PettySum = number_format($yget->TotalSUM, 2);
                                                    $PettyYear = $yget->YEAR;        
                                        ?>   
                                        
                                        <tr>
                                            <td>(<?php echo $pettyCount; ?>)</td>
                                            <td><a target="_blank" href="<?php echo base_url(); ?>userexpense/getmoredetailsbypetty/<?php echo $getmyUnit ?>/<?php echo $PettyYear; ?>"><?php echo $PettyYear; ?></a></td>
                                            <td><a target="_blank" href="<?php echo base_url(); ?>userexpense/getmoredetailsbypetty/<?php echo $getmyUnit ?>/<?php echo $PettyYear; ?>">&#8358;<?php echo $PettySum; ?></a></td>
                                         </tr>

                                        <?php
                                    }
                                }
                                ?>
                                </table>
                                    <hr/>

                                    
                                    
                                    <table class="table table-condensed table-responsive table-striped">
                                        <tr>
                                            <th><center><span style="font-size:20px;">Cheque</span></center></th>
                                        </tr>
                                    </table>
                                    
                                    
                                     <table class="table table-responsive table-bordered">
                                        <tr>
                                            <th>Request</th>
                                            <th>Year</th>
                                            <th>Amount</th>
                                        </tr>
                                        
                                        <?php
                                            if ($dYearCheque) {
                                                foreach ($dYearCheque as $yget) {
                                                    $chequeCount = $yget->RequestCount;
                                                    $ChequeSum = number_format($yget->TotalSUM, 2);
                                                    $ChequeYear = $yget->YEAR;        
                                        ?>   
                                        
                                        <tr>
                                            <td>(<?php echo $chequeCount; ?>)</td>
                                            <td><a target="_blank" href="<?php echo base_url(); ?>userexpense/getmoredetailsbycheque/<?php echo $getmyUnit ?>/<?php echo $ChequeYear; ?>"><?php echo $ChequeYear; ?></a></td>
                                            <td><a target="_blank" href="<?php echo base_url(); ?>userexpense/getmoredetailsbycheque/<?php echo $getmyUnit ?>/<?php echo $ChequeYear; ?>">&#8358;<?php echo $ChequeSum; ?></a></td>
                                         </tr>

                                        <?php
                                    }
                                }
                                ?>
                                </table>
                                    <hr/>

                                        
                                    
                                     <table class="table table-condensed table-responsive table-striped">
                                        <tr>
                                            <th><center><span style="font-size:20px;">Other Currencies</span></center></th>
                                        </tr>
                                    </table>
                                   
                                   
                                     <table class="table table-responsive table-bordered">
                                        <tr>
                                            <th>Request</th>
                                            <th>Year</th>
                                            <th>Currency</th>
                                            <th>Amount</th>
                                        </tr>
                                        
                                        <?php
                                            if ($currencyType) {
                                                foreach ($currencyType as $yget) {
                                                    $chequeCount = $yget->RequestCount;
                                                    $ChequeSum = number_format($yget->TotalSUM, 2);
                                                    $ChequeYear = $yget->YEAR; 
                                                    $CurrencyType = $yget->CurrencyType;  
                                                    
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
                                                    $newCurrency = '<span>&#8358;</span>';
                                                }
                                        ?>   
                                        
                                        <tr>
                                            <td>(<?php echo $chequeCount; ?>)</td>
                                            <td><?php echo $ChequeYear; ?></td>
                                            <td><?php echo $CurrencyType; ?></td>
                                            <td><?php echo $newCurrency; ?><?php echo $ChequeSum; ?></td>
                                         </tr>

                                        <?php
                                    }
                                }
                                ?>
                                </table>
                                   
                                    <hr/>
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