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

                        <form name="recievableBudget" id="recievableBudget"  onsubmit="return false;">
                            <!-- Inside Content Begins  Here -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title"><span class="tastkform"><span style="color:white">RECIEVABLE BUDGET SETUP</span></span></h4>

                                    </div>


                                    <div class="card-content">

                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Year</label>
                                                <input disabled="" style="background-color: lightgrey" type="text" value="<?php echo date('Y'); ?>"  class="form-controls" name="year" id="year" />
                                                <input  style="background-color: lightgrey" type="hidden" value="<?php echo date('Y'); ?>"  class="form-controls" name="iyear" id="iyear" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Unit</label>
                                                <select id="unit" name="unit" class="form-controls">
                                                    <option value="">Select Unit</option>
                                                <?php
                                                    $unit = $this->generalmd->getdresult("*", "cash_unit", "", "");
                                                    if($unit){
                                                        foreach($unit as $get){
                                                           echo "<option value='$get->id'>$get->unitName</option>";  
                                                        }
                                                       
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>

                                        
                                         <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Select Month</label>
                                                <?php
                                                $dMonth = "";
                                                $get_all_month = $this->generalmd->getdresult("*", "month_in_year", "", "");
                                                if($get_all_month){
                                                    foreach ($get_all_month as $get) {
                                                    $mid = $get->id;
                                                    $mName = $get->name;

                                                    $dMonth .= "<option value='$mid'>$mName</option>";
                                                } 
                                                }
                                               
                                                ?>
                                                <!-- class="mySelect" -->
                                                <select class="form-controls" name="iselectMonth" id="iselectMonth" data-live-search="true">
                                                    <option value="">Select month</option>
                                                    <?php echo $dMonth; ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        

                                       <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Select Account Item</label>
                                                <?php
                                                $acCode = "";
                                                // $get_account_code = $this->generalmd->getdresult("*", "codeact", "", "");
                                                $get_account_code = $this->generalmd->getdresult("*", "codeact", "", "");
                                                if($get_account_code){
                                                    foreach ($get_account_code as $get) {
                                                    $codeid = $get->codeid;
                                                    $codeName = $get->codeName;
                                                    $codeNumber = $get->codeNumber;

                                                    $acCode .= "<option value='$codeNumber'>$codeName - $codeNumber</option>";
                                                } 
                                                }
                                               
                                                ?>
                                                <!-- class="mySelect" -->
                                                <select class="form-controls mySelect" name="iselectActCode" id="iselectActCode" data-live-search="true">
                                                    <option value="">Select Item</option>
                                                    <?php echo $acCode; ?>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Amount</label>
                                                <input type="text"   class="form-controls newdatelog" name="iamount" id="iamount" />
                                            </div>
                                        </div>




                                        <center><button class="btn btn-sm btn-danger" id="item_recivable">Setup REVENUE</button></center>

                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- End of Request Details with Status -->

                    </div>   



                    <div class="col-md-8">     

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">
                                        <span class="tastkform" style="color:white">
                                            <span style="color:white">ALL REVENUE BUDGET</span>
                                           S</span>
                                    </h4>


                                </div>

                                <div class="card-content">
                                    <div class="table-responsive" style="height:410px; overflow: scroll">
                                        <table  class="table table-responsive table-bordered table-hovered" >
                                            <thead>
                                                <tr>
                                                    <th><b>id</b></th> 
                                                    <th><b>Unit</b></th>
                                                    <th><b>Month</b></th>
                                                    <th><b>Year</b></th>
                                                    <th><b>Code Number</b></th>
                                                    <th><b>Amount</b></th>
                                                    <th><b>Action</b></th>
                                                </tr>
                                            </thead>

                                            <tbody id="contract_list" >

                                                <?php 
                                                $sum = 0;
                                                    if($recivableBudget){
                                                        foreach($recivableBudget as $get){
                                                            $d  = $get->id;
                                                            $unit  = $get->unit;
                                                            $month  = $get->month;
                                                            $year  = $get->year;
                                                            $codeNumber  = $get->codeNumber;
                                                            $amount  = $get->amount;
                                                            
                                                            $sum += $amount;
                                                 ?>
                                                
                                                
                                                <tr>
                                                    <td><?php echo $d; ?></td>
                                                    <td><?php echo @$this->generalmd->getsinglecolumn("unitName", "cash_unit", "id", $unit); ?></td>
                                                    <td><?php echo @$this->generalmd->getsinglecolumn("name", "month_in_year", "id", $month); ?></td>
                                                    
                                                    <td><?php echo $year; ?></td>
                                                     <td><?php echo $codeNumber; ?></td>
                                                    <td><b><?php echo @number_format($amount, 2); ?></b></td>
                                                    <td><span><i class="fa fa-edit"></i></span></td>
                                                </tr>
                                                
                                                
                                                
                                                <?php
                                                        }
                                                        
                                                    }
                                                ?>
                                                
                                                <tr>
                                                    <td colspan="5">Total</td>
                                                    <td><b><?php echo @number_format($sum, 2); ?></b></td>
                                                    <td></td>
                                                </tr>
                                                

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- End of Request Details with Status -->

                    </div>   










                </div>
            </div>

            <!-- Main Outer Content Ends  Here -->
            <script type="text/javascript">
                $(document).ready(function () {

                    $('#item_recivable').click(function (e) {

                        var pushBudget_Item = "http://localhost:8080/expenseprov2/budget/setup_recievable/";
                        const iyear = document.querySelector('#iyear');
                        const unit = document.querySelector('#iunit');
                        const iamount = document.querySelector('#iamount');
                        const iselectMonth = document.querySelector('#iselectMonth');
                        

                        if (iamount == "" || unit == "") {
                            toastr.info("Please select all fields", {timeOut: 150000});
                        } else {

                            $.post(pushBudget_Item, $('#recievableBudget').serialize(), function (data) {
                                if (data.status === 200) {
                                    toastr.success("Recievable Budget Successfully Setup", {timeOut: 150000});
                                   setTimeout(function () {
                                        window.location.reload(1);
                                    });
                                   
                                } else if (data.status == 300) {
                                    toastr.error(data.msg, {timeOut: 1500000});
                                }else if (data.status == 400) {
                                    toastr.error("Error Processing Request", {timeOut: 150000});
                                }else{
                                   toastr.error("Ooop! Something Went Wrong, Please Try Again Later", {timeOut: 150000}); 
                                }
                            });
                        }

                    });

                });
            </script>
<?php echo $footer; ?>
