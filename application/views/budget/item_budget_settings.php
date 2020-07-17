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

                        <form name="itembudgetitem" id="itembudgetitem"  onsubmit="return false;">
                            <!-- Inside Content Begins  Here -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title"><span class="tastkform"><span style="color:white">ITEM BUDGET SETUP</span></span></h4>

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
                                                <input disabled="" style="background-color: lightgrey" type="text" value="<?php echo $this->generalmd->getsinglecolumn("unitName", "cash_unit", "id", $unit); ?>"  class="form-controls" name="unit" id="unit" />
                                                <input style="background-color: lightgrey" type="hidden" value="<?php echo $unit; ?>" class="form-controls" name="iunit" id="iunit" />
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
                                                 $get_account_code = $this->generalmd->getdresult("*", "codeact", "", "");
                                                //$get_account_code = $this->generalmd->getdresult("*", "unitaccountcode", "unit", $unit);
//                                                if($get_account_code){
//                                                    foreach ($get_account_code as $get) {
//                                                    $codeid = $get->actID;
//                                                    $codeName = $get->codeName;
//                                                    $codeNumber = $get->codeNumber;
//
//                                                    $acCode .= "<option value='$codeid'>$codeName - $codeNumber</option>";
//                                                } 
//                                                }
                                                
                                                 if($get_account_code){
                                                    foreach ($get_account_code as $get) {
                                                    $codeid = $get->codeid;
                                                    $codeName = $get->codeName;
                                                    $codeNumber = $get->codeNumber;

                                                    $acCode .= "<option value='$codeid'>$codeName - $codeNumber</option>";
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


                                        <button class='btn btn-sm btn-danger' id='item_account_budget'>Setup Now</button>
                                       

                                       

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
                                            <span style="color:white">BUDGET FOR <?php echo strtoupper($this->generalmd->getsinglecolumn("unitName", "cash_unit", "id", $unit)); ?></span>
                                            
                                            </span>
                                    </h4>


                                </div>

                                <div class="card-content">
                                    <div class="table-responsive" style="height:410px; overflow: scroll">
                                        <table  class="table table-responsive table-bordered table-hovered" >
                                            <thead>
                                                <tr>
                                                    <th><b>id</b></th> 
                                                    <th><b>Month</b></th>
                                                    <th><b>Year</b></th>
                                                    <th><b>Account Item</b></th>
                                                    <th><b>Account Code</b></th>
                                                    <th><b>Amount</b></th>
                                                    <th><b>Action</b></th>
                                                </tr>
                                            </thead>

                                            <tbody id="contract_list" >

                                                <?php 
                                                $sum = 0;
                                                    if($yearlyItemBudget){
                                                        foreach($yearlyItemBudget as $get){
                                                            $unitaccountcode_id  = $get->unitaccountcode_id;
                                                            $acctID  = $get->acctID;
                                                            $codeName  = $get->codeName;
                                                            $codeNumber  = $get->codeNumber;
                                                            $amount  = $get->amount;
                                                            $year  = $get->year;
                                                            $unit  = $get->unit;
                                                            $month  = $get->month;
                                                            $sum += $amount;
                                                 ?>
                                                
                                                
                                                <tr>
                                                    <td><?php echo $acctID; ?></td>
                                                     <td><?php echo @$this->generalmd->getsinglecolumn("name", "month_in_year", "id", $month); ?></td>
                                                    <td><?php echo $year; ?></td>
                                                    <td><?php echo $codeName; ?></td>
                                                    <td><?php echo $codeNumber; ?></td>
                                                    <td><b><?php echo @number_format($amount, 2); ?></b></td>
                                                    <td>
                                                        <?php
                                                        if($getLevelApprove == 6){
                                                         ?>
                                                        
                                                        <a title="Edit Budget" style="cursor:pointer" href="<?php echo base_url(); ?>budget/edit_account_code/<?php echo $unitaccountcode_id; ?> "><span><i class="fa fa-edit"></i></span></a>
                                                        <?php
                                                        }
                                                        ?>
                                                        
                                                        <a title="Add To Budget" style="cursor:pointer" href="<?php echo base_url(); ?>budget/add_account_code/<?php echo $unitaccountcode_id; ?> "><span><i class="fa fa-adn"></i></span></a>
                                                       <span title="Delete Budget" style="cursor:pointer" class="deletingBudget" id="<?php echo $unitaccountcode_id; ?>"><i class="fa fa-trash"></i></span>
                                                    
                                                    </td>
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

                    var deleteBudget = "http://localhost:8080/expenseprov2/budget/deletebudget/";
                    $('.deletingBudget').click(function (e) {
                        var deleteID = $(this).attr('id'); 
                        if(deleteID == ""){
                          toastr.info("Important Variable ", {timeOut: 150000});
                        }else{
                          
                          $.post(deleteBudget, {deleteID: deleteID}, function (data) {
                                if (data.status === 200) {
                                    toastr.success("Budget Successfully Deleted", {timeOut: 150000});
                                      setTimeout(function () { window.location.reload(1) });
                                    
                                }else{
                                   toastr.error("Ooop! Something Went Wrong, Please Try Again Later", {timeOut: 150000}); 
                                }
                            });
                            
                        }
                    });
                    
                    
                    
                    
                    
                    
                    $('#item_account_budget').click(function (e) {

                        var pushBudget_Item = "http://localhost:8080/expenseprov2/budget/setupitemcode/";
                        const iyear = document.querySelector('#iyear');
                        const iunit = document.querySelector('#iunit');
                        const iselectActCode = document.querySelector('#iselectActCode');
                        const iamount = document.querySelector('#iamount');
                        const iselectMonth = document.querySelector('#iselectMonth');
                        

                        if (iselectActCode == "" || iamount == "" || iselectMonth == "") {
                            toastr.info("Please select all fields", {timeOut: 150000});
                        } else {

                            $.post(pushBudget_Item, $('#itembudgetitem').serialize(), function (data) {
                                if (data.status === 200) {
                                    toastr.success("Item Budget Successfully Setup", {timeOut: 150000});
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
