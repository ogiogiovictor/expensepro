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

                    <div class="col-md-12">    
                        <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title"><span class="tastkform"><span style="color:white">MONTHLY BUDGET BREAKDOWN</span></span></h4>
                            </div>


                            <div class="card-content" id="settings">
                               
                                <table id="mydata" class="table table-responsive table-hover table-bordered" >
                                    <thead>
                                        <tr>
                                            <th><b>ID</b></th>
                                            <th><b>Unit</b></th>
                                            <th><b>Year</b></th>
                                            <th><b>Months</b></th>
                                            <th><b>Total Budget</b></th>
                                             <th><b>Action</b></th>
                                            <!--<th><b>monthly Budget Lock</b></th>
                                             <th><b>monthly Expense</b></th>
                                              <th><b>Balance</b></th>
                                            <th><b>Status</b></th>
                                            <th><b>Action</b></th>-->
                                        </tr>
                                    </thead>

                                    <tbody id="contract_list" >

                                        <?php
                                        if ($getMonthlyBudget) {
                                            $sum = 0;
                                            $expense = 0;
                                            
                                            foreach ($getMonthlyBudget as $get) {
                                               /* $monthlyExpenseNaira = $this->generalmd->monthlyBudgetExpenseNairaonlySum($unit, $year, $get->month);
                                                $monthlyExpeneSumOtherCurrency = $this->generalmd->monthlyBudgetExpenseOthersonlySum($unit, $year, $get->month);
                                                
                                                $expense = $monthlyExpenseNaira + $monthlyExpeneSumOtherCurrency; */
                                                
                                                ?>

                                                <tr>
                                                    <td><?php echo $get->unitaccountcode_id; ?></td>
                                                     <td><?php echo $this->generalmd->getsinglecolumn("unitName", " cash_unit", "id", $get->unit); ?></td>
                                                    <td><?php echo $get->year; ?></td>
                                                    <td><?php echo $this->generalmd->getsinglecolumn("name", " month_in_year", "id", $get->month); ?></td>
                                                     <td><?php echo @number_format($get->total, 2); ?></td>
                                                     <td><a href="<?php echo base_url(); ?>budget/viewbyaccountcode/<?php echo $get->year; ?>/<?php echo $get->month; ?>/<?php echo $get->unit; ?> "><span class="fa fa-picture-o"></span></a></td>
                                                     
                                                     <!--<td><input style="width:150px" name="budget[]" id="budget" type="number" value="<?php //echo $get->amount; ?>" class="form-controls budget" /></td>-->
                                                    
                                                    
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
            <script type="text/javascript">
                $(document).ready(function () {

                    $("#settings").on("change keyup keydown paste propertychange bind mouseover", function () {
                        calculateTotalSum();
                    });


                    function calculateTotalSum() {
                        var sum = 0;

                        $(".budget").each(function () {
                            if (this.value.length !== "") {
                                var budget = $(this).closest("tr").find(".budget").val();
                                sum += parseFloat(Number(budget).toFixed(2));
                            }
                        });

                        $('#totalUnitCost').html(sum);
                    }

                });
            </script>


            <script>
                
            var changeMonthlyBudget = "http://localhost:8080/expenseprov2/budget/changemonthlyvalues/";
       
                $('.saveMonthly').click(function (e) {
                    var savemonthid = $(this).attr('id');
                    var budget = $(this).closest("tr").find(".budget").val();

                    if (!savemonthid || !budget) {
                        toastr.error("Important Variable to Render Page Is Missing and make sure you have a value monthly", {timeOut: 150000});
                    } else {
                        toastr.info("Saving New Value, Please wait...", {timeOut: 150000});
                        $.post(changeMonthlyBudget, {savemonthid: savemonthid, budget: budget}, function (data) {
                            if (data.status === 200) {
                                toastr.success("Monthly Budget Successfully Changed", {timeOut: 150000});
                                setTimeout(function () {
                                    window.location.reload(1);
                                });
                            } else if (data.warr) {
                                toastr.error("Error Processing Request", {timeOut: 150000});
                            }
                        });
                    }

                });

            </script>
            <?php echo $footer; ?>
