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

                        <form name="nowAdd" id="nowAdd"  onsubmit="return false;">
                            
                            <?php
                               if($editItem){
                                   foreach($editItem as $get){
                                       $unitaccountcode_id  = $get->unitaccountcode_id;
                                       $acctID  = $get->acctID;
                                       $codeName  = $get->codeName;
                                       $codeNumber  = $get->codeNumber;
                                       $iunit  = $get->unit;
                                       $year  = $get->year;
                                       $amount  = $get->amount;
                                       $month = $get->month;
                                   }
                               }
                            ?>
                            
                            <!-- Inside Content Begins  Here -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title"><span class="tastkform"><span style="color:white">ADD TO BUDGET FOR <br/><small style="color:white"><?php echo $codeName; ?></small> </span></span></h4>

                                    </div>


                                    <div class="card-content">

                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Year</label>
                                                <input readonly style="background-color: lightgrey" type="text" value="<?php echo $year ?>"  class="form-controls" name="year" id="year" />
                                     
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Unit</label>
                                                <input disabled="" style="background-color: lightgrey" type="text" value="<?php echo $this->generalmd->getsinglecolumn("unitName", "cash_unit", "id", $iunit); ?>"  class="form-controls" name="unit" id="unit" />
                                                <input  type="hidden" value="<?php echo $iunit; ?>" class="form-controls" name="iunit" id="iunit" />
                                            </div>
                                        </div>

                                        
                                         <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Select Month</label>
                                                 <input disabled="" style="background-color: lightgrey" type="text" value="<?php echo $this->generalmd->getsinglecolumn("name", "month_in_year", "id", $month); ?>"  class="form-controls" name="unit" id="unit" />
                                                <input style="background-color: lightgrey" type="hidden" value="<?php echo $month; ?>" class="form-controls" name="month" id="month" />
                                               
                                            </div>
                                        </div>
                                        
                                        

                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Account Code</label>
                                               <input disabled="" style="background-color: lightgrey" type="text" value="<?php echo $codeName; ?>"  class="form-controls" name="codeName" id="codeName" />
                                                <input style="background-color: lightgrey" type="hidden" value="<?php echo $codeNumber; ?>" class="form-controls" name="codeNumber" id="codeNumber" />
                                               
                                            </div>
                                        </div>




                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Current Budget Amount (<?php echo @number_format($amount, 2); ?>)</label>
                                                <input type="text" style="background-color: lightgrey" readonly value="<?php echo $amount; ?>"   class="form-controls newdatelog" name="iamount" id="iamount" />
                                                <input type="hidden" value="<?php echo $id; ?>"   class="form-controls newdatelog" name="id" id="id" />
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Add Amount</label>
                                                <input type="text"   class="form-controls newdatelog" name="add_amount" id="add_amount" />
                                            </div>
                                        </div>


                                         <?php
                                        if($getLevelApprove == 6 || $getLevelApprove == 7 || $getLevelApprove == 5 ){
                                           echo "<center><button class='btn btn-sm btn-danger' id='add_to_budget'>ADD</button></center>"; 
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
                    
                        
                        
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">
                                        <span class="tastkform" style="color:white">
                                            <span style="color:white">BREAKDOWN FOR <?php echo $codeName; ?></span>
                                            
                                            </span>
                                    </h4>


                                </div>

                                <div class="card-content">
                                    <div class="table-responsive" style="height:410px; overflow: scroll">
                                        <table  class="table table-responsive table-bordered table-hovered" >
                                            <thead>
                                                <tr>
                                                    <th><b>Date</b></th> 
                                                     <th><b>id</b></th> 
                                                    <th><b>Unit</b></th>
                                                    <th><b>Month</b></th>
                                                    <th><b>Year</b></th>
                                                    <th><b>Account Code</b></th>
                                                    <th><b>Previous Amount</b></th>
                                                     <th><b>New Amount</b></th>
                                                    <th><b>Total</b></th>
                                                </tr>
                                            </thead>

                                            <tbody id="contract_list" >

                                                <?php 
                                                $sum = 0;
                                                    if($breakdownItem){
                                                        foreach($breakdownItem as $get){
                                                            $id  = $get->id;
                                                            $date_added  = $get->date_added;
                                                            $unicode_id  = $get->unicode_id;
                                                            $amount  = $get->amount;
                                                            $unit  = $get->unit;
                                                            $year  = $get->year;
                                                            $month  = $get->month;
                                                            $codeNumber  = $get->codeNumber;
                                                            $added_amount  = $get->added_amount;
                                                            $sum = $added_amount + $amount;
                                                 ?>
                                                
                                                
                                                <tr>
                                                    <td><?php echo $date_added; ?></td>
                                                     <td><?php echo $id; ?></td>
                                                    
                                                     <td><?php echo $this->generalmd->getsinglecolumn("unitName", "cash_unit", "id", $unit); ?></td>
                                                    <td><?php echo $this->generalmd->getsinglecolumn("name", "month_in_year", "id", $month); ?></td>
                                                    <td><?php echo $year; ?></td>
                                                    <td><?php echo $codeNumber; ?></td>
                                                    <td><b><?php echo @number_format($amount, 2); ?></b></td>
                                                     <td><b><?php echo @number_format($added_amount, 2); ?></b></td>
                                                    <td><b><?php echo @number_format($sum, 2) ; ?></b></td>
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
                    
                    









                </div>
            </div>

            <!-- Main Outer Content Ends  Here -->
            <script type="text/javascript">
                $(document).ready(function () {

                    $('#add_to_budget').click(function (e) {

                        var pushBudget_Item = "http://localhost:8080/expenseprov2/budget/add_main_budget/";
                        const id = document.querySelector('#id').value;
                        const amount = document.querySelector('#iamount').value;
                        const unit = document.querySelector('#iunit').value;
                        const year = document.querySelector('#year').value;
                        const add_amount = document.querySelector('#add_amount').value;
                        const month = document.querySelector('#month').value;
                        const codeNumber = document.querySelector('#codeNumber').value;
                        
                        if (add_amount == "" ) {
                            toastr.info("Please select all fields", {timeOut: 150000});
                            return;
                        } else {

                            $.post(pushBudget_Item, $('#nowAdd').serialize(), function (data) {
                                if (data.status === 200) {
                                    toastr.success("Item Budget Successfully Edited", {timeOut: 150000});
//                                     setTimeout(function () {
//                                        window.top.location = GLOBALS.appRoot + "budget/item_account_code/" + unit+ "/" + year;
//                                    }, 1000);
                                    
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
