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

                    <div class="col-md-4">     

                        <form name="setupBudgetparams" id="setupBudgetparams" method="POST">
                            <!-- Inside Content Begins  Here -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title"><span class="tastkform"><span style="color:white">BUDGET SETUP</span></span></h4>

                                    </div>


                                    <div class="card-content">

                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Select Unit</label>
                                                <?php
                                                $mUnit = "";
                                                $getUnit = $this->generalmd->getdresult("*", "cash_unit", "", "");
                                                foreach ($getUnit as $get) {
                                                    $Loid = $get->id;
                                                    $unitName = $get->unitName;

                                                    $mUnit .= "<option value='$Loid'>$unitName</option>";
                                                }
                                                ?>
                                                <select class="form-controls dType" name="selectUnit" id="selectUnit" data-live-search="true">
                                                    <option value="">Select Unit</option>
                                                    <?php echo $mUnit; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Year</label>
                                                <input type="text" value="<?php echo date('Y'); ?>"  class="form-controls" name="year" id="year" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Month In Year</label>
                                                <input type="text" value="12"  class="form-controls" name="monthinyear" id="monthinyear" />
                                            </div>
                                        </div>



                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Amount</label>
                                                <input type="text"   class="form-controls newdatelog" name="amount" id="amount" />
                                            </div>
                                        </div>



                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Comments</label>
                                                <textarea class="form-control" name="comments" id="comments" row="15"></textarea>
                                            </div>
                                        </div>
                                        
                                        <?php
                                        if($getLevelApprove == 6 || $getLevelApprove == 7 || $getLevelApprove == 5 ){
                                           echo "<center><button class='btn btn-sm btn-danger' id='setup_budget'>Setup Now</button></center>"; 
                                        }else{
                                            echo "";
                                        }
                                        ?>
                                     

                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- End of Request Details with Status -->

                    </div>   



                    <div class="col-md-8">     

                        <form name="batchedHotel" id="batchedHotel" method="POST" action="<?php echo base_url(); ?>travelstart/hotelbeingbatched">
                            <!-- Inside Content Begins  Here -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title"><span class="tastkform"><span style="color:white">LATEST YEARLY BUDGET</span></span></h4>

 <!--<span><a class="category btn btn-xs btn-success" href="<?php echo base_url(); ?>travels/hotelbygroup" >VIEW HOTELS</a></span>
     &nbsp;&nbsp;&nbsp;
     <span><a class="category btn btn-xs btn-danger" href="<?php echo base_url(); ?>travels/rejectedhotelrequest">REJECTED REQUEST</a></span>
                                        -->

                                    </div>

                                    <div class="card-content">
                                        <div class="table-responsive" style="height:410px; overflow: scroll">
                                            <table class="table table-responsive table-bordered table-hovered" >
                                                <thead>
                                                    <tr>
                                                        <th><b>Unit</b></th> 
                                                        <th><b>Year</b></th>
                                                        <th><b>Amount</b></th>
                                                    </tr>
                                                </thead>

                                                <tbody id="contract_list" >

                                                    <?php
                                                    if ($getMonthlyBudget) {
                                                        foreach ($getMonthlyBudget as $get) {
                                                            ?>

                                                            <tr>
                                                                <td><a href="<?php echo base_url(); ?>budget/item_account_code/<?php echo $get->unit."/".$get->year; ?>"><?php echo $this->generalmd->getsinglecolumn("unitName", " cash_unit", "id", $get->unit); ?></a></td>
                                                                <td><?php echo $get->year; ?></td>
                                                                <td><?php echo @number_format($get->total, 2); ?></td>
                                                               
                                                              
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
                        </form>

                        <!-- End of Request Details with Status -->

                    </div>   









                    <div class="col-md-12">    
                        <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title"><span class="tastkform"><span style="color:white">BUDGET BREAKDOWN YEAR/MONTH</span></span></h4>
                            </div>


                            <div class="card-content">
                                <table class="table table-responsive table-hover table-striped table-bordered" >
                                    <thead>
                                        <tr>
                                            <th><b>ID</b></th>
                                            <th><b>Year</b></th>
                                            <th><b>Unit</b></th>
                                            <!--<th><b>Months</b></th>-->
                                             <th><b>Total Budget</b></th>
<!--                                            <th><b>monthly_budget_lock</b></th>-->
                                            <th><b>Action</b></th>
                                        </tr>
                                    </thead>

                                    <tbody id="contract_list" >

                                        <?php
                                        if ($getYearlyBudget) {
                                            foreach ($getYearlyBudget as $get) {
                                                ?>

                                                <tr>
                                                    <td><?php echo $get->unitaccountcode_id; ?></td>
                                                    <td><?php echo $get->year; ?></td>
                                                    <td><?php echo $this->generalmd->getsinglecolumn("unitName", " cash_unit", "id", $get->unit); ?></td>
                                                    <td><span style="font-weight: bolder"><?php echo @number_format($get->total); ?></span></td>
                                             
                                                    <td>
                                                       
                                                        <a style="cursor:pointer" title="View Monthly Budget Breakdown" href="<?php echo base_url(); ?>budget/viewmonths/<?php echo $get->year?>/<?php echo $get->unit; ?>"><span class="fa fa-picture-o"></span></a>
                                                    </td>
                                                </tr>


                                                <?php
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div><!-- <div class="card-content"> -->



                        </div>

                    </div>


                </div>
            </div>
            <!-- Main Outer Content Ends  Here -->
            <script src="<?php echo base_url(); ?>public/javascript/budget_settings.js"></script>
            <script type="text/javascript">
                $(document).ready(function () {

                    $(document).on('click', '.newdatelog', function () {
                        $(this).datepicker({
                            //dateFormat: 'yy-mm-d',
                            format: 'yyyy-mm-dd',
                            weekStart: 1,
                            color: 'red'
                        });
                    });



                });
            </script>
            <?php echo $footer; ?>
