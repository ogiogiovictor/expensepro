
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

                    <div class="col-md-10 col-md-offset-1">     
                        <div class="card">
                            <div class="card-header text-center" data-background-color="blue">
                                <h4 class="title"><?php echo $year; ?> SUMMARY</h3>
                                    <p class="category">Breakdown By Currency Type</p>
                                    <span id="showError"></span>
                            </div>

                            <div class="card-content">
                                <div class="">

                                    <!-- Beginnin of Form -->
                                    <table class="table table-responsive table-striped table-bordered">
                                        <tr>
                                            <th>Request</th>
                                            <th>Year</th>
                                            <th>Currency</th>
                                            <th>Total<br/><small>(Amount)</small></th>
                                        </tr>
                                        <?php
                                        if ($getallResult) {

                                            foreach ($getallResult as $yget) {
                                                $RequestCounted = $yget->RequestCounted;
                                                $TotalSUMed = $yget->TotalSUMed;
                                                $YEARed = $yget->YEARed;
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
                                                    <th><?php echo $RequestCounted; ?></th>
                                                    <td><a style="cursor:pointer" href="<?php echo base_url(); ?>userexpense/sortbymonthandcurrency/<?php echo $YEARed; ?>"><span style="color:red"><?php echo $YEARed; ?></span></a></td>
                                                    <td><a href="<?php echo base_url(); ?>userexpense/currencyTransact/<?php echo $CurrencyType; ?>/<?php echo $YEARed; ?>"><?php echo $CurrencyType; ?></a></td>
                                                    <td><?php echo $newCurrency.@number_format($TotalSUMed, 2); ?></td>
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