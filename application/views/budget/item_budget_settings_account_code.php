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
                                            <th><b>CodeName</b></th>
                                             <th><b>CodeNumber</b></th>
                                            <th><b>Amount</b></th>
                                            <th style="color:"><b>Expense</b></th>
                                        </tr>
                                    </thead>

                                    <tbody id="contract_list" >

                                        <?php
                                        if ($yearlyItemBudget) {
                                           
                                            foreach ($yearlyItemBudget as $get) {
                                                 $monthExpense = $this->generalmd->monthlyexpenseperunit($get->codeNumber, $get->unit, $get->month, $get->year)
         
                                                ?>

                                                <tr>
                                                    <td><?php echo $get->unitaccountcode_id; ?></td>
                                                     <td><?php echo $this->generalmd->getsinglecolumn("unitName", " cash_unit", "id", $get->unit); ?></td>
                                                    <td><?php echo $get->year; ?></td>
                                                    <td><?php echo $this->generalmd->getsinglecolumn("name", " month_in_year", "id", $get->month); ?></td>
                                                    <td><?php echo $get->codeName; ?></td>
                                                    <td><?php echo $get->codeNumber; ?></td>
                                                    <td><?php echo @number_format($get->amount, 2); ?></td> 
                                                   <td><?php echo @number_format($monthExpense, 2); ?></td> 
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
         
            <?php echo $footer; ?>
