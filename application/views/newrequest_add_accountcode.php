
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

        <style type="text/css">
            .wpsc_buy_button{
                display:none;
            } 
        </style>

        <!-- Main Outer Content Begins Here --> 
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-4">     

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title"><span class="tastkform"><span style="color:white">REQUEST ( <?php echo $mID; ?> ) </span></span></h4>
                                </div>


                                <div class="card-content">

                                    <?php
                                    if ($all_request) {
                                        foreach ($all_request as $get) {
                                            $ndescriptOfitem = $get->ndescriptOfitem;
                                            $nPayment = $get->nPayment;
                                            $dAmount = $get->dAmount != "" ? $get->dAmount : 0.00;
                                            $dLocation = $get->dLocation;
                                            $dUnit = $get->dUnit;
                                            $dhod = $get->hod;
                                            $fullname = $get->fullname;
                                            $benName = $get->benName;
                                        }
                                    }
                                    ?>
                                    <div><b>Description:</b></div>
                                    <?php echo $ndescriptOfitem; ?>
                                    <div style="border:1px solid lightgray; margin-top: 5px; margin-bottom: 5px"></div>

                                    <div><b>Payment Type:</b></div>
                                    <?php echo $this->generalmd->getsinglecolumn("paymentType", "cash_paymentmode", "id", $nPayment); ?>
                                    <div style="border:1px solid lightgray; margin-top: 5px; margin-bottom: 5px"></div>

                                    <div><b>Amount:</b></div>
                                    <?php echo @number_format($dAmount, 2); ?>
                                    <div style="border:1px solid lightgray; margin-top: 5px; margin-bottom: 5px"></div>

                                    <div><b>Location:</b></div>
                                    <?php echo $this->generalmd->getsinglecolumn("locationName", "cash_location", "id", $dLocation); ?>
                                    <div style="border:1px solid lightgray; margin-top: 5px; margin-bottom: 5px"></div>

                                    <div><b>Unit:</b></div>
                                    <?php echo $this->generalmd->getsinglecolumn("unitName", "cash_unit", "id", $dUnit); ?>
                                    <div style="border:1px solid lightgray; margin-top: 5px; margin-bottom: 5px"></div>

                                    <div><b>HOD:</b></div>
                                    <?php echo $dhod; ?>
                                    <div style="border:1px solid lightgray; margin-top: 5px; margin-bottom: 5px"></div>

                                    <div><b>Created By:</b></div>
                                    <?php echo $fullname; ?>
                                    <div style="border:1px solid lightgray; margin-top: 5px; margin-bottom: 5px"></div>

                                    <div><b>Beneficiary:</b></div>
                                    <?php echo $benName; ?>
                                    <div style="border:1px solid lightgray; margin-top: 5px; margin-bottom: 5px"></div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div id="showError"></div><span id="loader"></span>
                                    
                                    <form id="continueprocess" onsubmit="return false">
                                         <input type="hidden" value="<?php echo $mID; ?>" name="a_requestID" id="a_requestID"/>
                                         <input type="hidden" value="<?php echo $unit; ?>" name="a_unit" id="a_unit"/>
                                         <input type="hidden" value="<?php echo $md5; ?>" name="a_md5" id="a_md5"/>
                                         <input  id="processforupload" type="submit" value="CONTINUE" class="btn btn-primary wpsc_buy_button" />
                                         
                                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input  id="process_refresh" type="submit" value="REFRESH" class="btn btn-info wpsc_buy_button" />
                                    </form>
                                   
                                  
                                </div> 
                            </div>

                        </div>




                    </div>



                    <!-- Inside Content Begins  Here -->

                    <!-- Beginning of Request Details with Status -->

                    <div class="col-md-8">     
                        <div class="card card-nav-tabs">

                            <div class="card-header" data-background-color="blue">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <span class="nav-tabs-title">ACTION:</span>
                                        <ul class="nav nav-tabs" data-tabs="tabs">

                                            <li class="active">
                                                <a href="#messages" data-toggle="tab">
                                                    <i class="material-icons">code</i>
                                                    Expense Details
                                                    <div class="ripple-container"></div></a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div> <!-- End of card-header -->

                            <form name="codeForm" id="codeForm" enctype="multipart/form-data" method="POST" onSubmit="return false;">

                                <div class="card-content">
                                    <div class="tab-content">


                                        <div class="tab-pane active" id="messages">

                                            <div style="color:red">Note Important!! Make sure you add your expense item details before you click the continue button. Please note each 
                                                item will be allowed based on set budget for your department</div> 

                                            <div class="card-content table-responsive">

                                                <table class="table table-bordered" id="item_table">
                                                    <tr>
                                                        <th style="width:35%">Expense Details</th>
                                                        <th style="width:20%">Amount</th>
                                                        <th style="width:25%">Expense Code</th>
                                                        <th style="width:15%">Date</th>
                                                        <th style="width:5%">Active</th>
                                                    </tr>
                                                    <tr>
                                                        <td><textarea name="exDetailofpayment" id="exDetailofpayment" placeholder="Payment Details" class="form-control exDetailofpayment"></textarea></td>
                                                        <td><input type="number" required name="exAmount" id="exAmount" placeholder="Amount" class="form-control exAmount" min="0"/></td>
                                                        <td><select name="exCode" required id="exCode" placeholder="Code" class="form-control exCode"><option value="">Select Code</option><?php echo $fillSelect; ?></select></td>
                                                        <td><input type="text" required name="exDate" id="exDate" placeholder="dddd-mm-dd" class="form-control newdatelog" value="<?php echo date('Y-m-d'); ?>"/></td>
                                                        <td>
                                                            <input type="hidden" value="<?php echo $mID; ?>" name="requestID" id="requestID"/>
                                                            <input type="hidden" value="<?php echo $unit; ?>" name="unit" id="unit"/>
                                                            <input type="hidden" value="<?php echo $md5; ?>" name="md5" id="md5"/>
                                                            <button style="cursor: pointer" type="submit" title="Save" id="savemyass" name="savemyass" class="btn-danger btn-sm save"><i class="fa fa-save"></i></button>

                                                        </td></tr>
                                                    </tr>
                                                </table>
                                                <!-- End of add more expense details -->
                                                <hr/>
                                                <table class="table table-responsive table-hover table-striped table-bordered" >
                                                    <thead>
                                                        <tr>
                                                            <th><b>ID</b></th>
                                                            <th><b>Expense Details</b></th>
                                                            <th><b>Code Item</b></th>
                                                            <th><b>Amount</b></th>
                                                            <th><b>Date</b></th>
                                                            <th><b>Action</b></th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="contract_list" >

                                                        <?php
                                                        if ($all_request_expense) {
                                                            $sum = 0;
                                                            foreach ($all_request_expense as $get) {
                                                                $iAmount = $get->ex_Amount;
                                                                $sum += $iAmount;
                                                                ?>

                                                                <tr>
                                                                    <td><?php echo $get->exid; ?></td>
                                                                    <td><?php echo $get->ex_Details; ?></td>
                                                                    <td><?php echo $get->ex_Code; ?></td>
                                                                    <td><?php echo $get->ex_Amount; ?></td>
                                                                    <td><?php echo $get->ex_Date; ?></td>
                                                                    <td><span style="cursor: pointer" id="<?php echo $get->exid; ?>" class="fa fa-trash-o makeusdelete"></span></td>
                                                                </tr>


                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                        <tr>
                                                            <td colspan="3"><b>Total</b></td>
                                                            <td><b><?php echo @number_format($sum, 2); ?></b></td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr>

                                                    </tbody>

                                                </table>
                                                <div id="breakdown"></div>
                                            </div>   
                                        </div>


                                    </div>
                                </div>
                                <!--</form>-->

                        </div>

                        <!--<div class="row">
                            <div class="col-md-12">
                                <div id="showError"></div><span id="loader"></span>
                                <input  id="processcontinuebutton" type="submit" value="CONTINUE" class="btn btn-primary wpsc_buy_button" />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </div> 
                        </div>-->

                        </form>

                    </div>
                    <!-- End of Request Details with Status -->




                    <!-- Inside Content Ends Here -->


                </div>
            </div>
        </div>
        <!-- Main Outer Content Ends  Here --> 

        <script type="text/javascript">
            $(document).ready(function () {


                $('#savemyass').click(function (e) {

                    e.preventDefault();
                    var exDetailofpayment = $('#exDetailofpayment').val();
                    var exAmount = $('#exAmount').val();
                    var exCode = $('#exCode').val();
                    var exDate = $('#exDate').val();
                    var requestID = $('#requestID').val();
                    var md5 = $('#md5').val();
                    var unit = $('#unit').val();

                    var dataString = new FormData(document.getElementById('codeForm'));


                    if (requestID == "") {
                        toastr.error('Important Variable To Process Page Missing, Contact Administrator');
                    }
                    if (md5 == "" || unit == "") {
                        toastr.error('Parameters Unit Error, Please Contact Administrator, You raise another request');
                    } else if (exDetailofpayment == "") {
                        $('#showError').html("Please enter expense details").addClass("alert alert-danger");
                        toastr.error('Please enter expense details');
                    } else if (exAmount == "") {
                        $('#showError').html("Please enter amount").addClass("alert alert-danger");
                        toastr.error('Please enter amount');
                    } else if (exCode == "") {
                        $('#showError').html("Please Select Item Code").addClass("alert alert-danger");
                        toastr.error('Please Select Item Code');
                    } else if (exDate == "") {
                        $('#showError').html("Date Cannot be empty").addClass("alert alert-danger");
                        toastr.info('Date Cannot be empty');
                    } else {

                        toastr.info('Processing Request, Please wait...');

                        $.ajax({
                            type: "POST",
                            url: GLOBALS.appRoot + "postrequest/add_item_code",
                            data: dataString,
                            contentType: false,
                            processData: false,
                            cache: false,
                            dataType: 'JSON',

                            success: function (data) {
                                if (data.status == 400) {
                                    toastr.error("We cannot process your request at the moment, please try later", {timeOut: 150000});
                                } else if (data.status == 424) {
                                    toastr.error(data.msg, {timeOut: 150000});
                                } else if (data.status == 425) {
                                    toastr.error(data.msg, {timeOut: 150000});
                                    $('#breakdown').html(`<p style='background-color:red; color:whitesmote; border:1px solid grey'>
                                        <div>BREAKDOWN ERROR</div>
                                         <div><b>Budget: &nbsp;</b> ${data.budget}</div> 
                                         <div><b>Previous Expense:  &nbsp;</b>${data.previous_expense}</div> 
                                         <div><b>Current Amount:  &nbsp;</b>${data.current_amount}</div>
                                         <div><b>Exchange Rate:  &nbsp;</b>${data.exchange_rate}</div> 
                                         <div><b>Total Expense:  &nbsp;</b>${data.total_expense}</div> 
                                         <div style='color:red; border:2px solid grey'><b>${data.md}</b></div> 
                                        </p>`);
                                } else if (data.status == 200) {
                                    let newHtml, html;
                                    let hplace = document.getElementById("contract_list");
                                    html = '<tr><td>%mid%</td><td>%expendetails%</td><td>%expensecode%</td><td>%amount%</td><td>%date%</td><td>%action%</td></tr>';
                                    newHtml = html.replace('%mid%', data.exID);
                                    newHtml = newHtml.replace('%expendetails%', exDetailofpayment);
                                    newHtml = newHtml.replace('%expensecode%', exCode);
                                    newHtml = newHtml.replace('%amount%', exAmount);
                                    newHtml = newHtml.replace('%date%', exDate);
                                    newHtml = newHtml.replace('%action%', "<span style='cursor: pointer'  id='" + data.exID + "' class='fa fa-trash-o makeusdelete'></span>");
                                    hplace.insertAdjacentHTML('afterbegin', newHtml);
                                    toastr.success("Expense item Inserted Successfully", {timeOut: 150000});
                                    
                                    makemebelieve();
                
                                } else {
                                    toastr.error("We cannot process your request at the moment, please try later", {timeOut: 150000});
                                }
                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                toastr.warning(' Error Processing Request, please try again or check your internet...');

                            }

                        });






                    }

                });



                $('#process_refresh').click(function (e) {
                    setTimeout(function () {
                        window.location.reload(1);
                    });

                });


                $('.makeusdelete').click(function (e) {
                    var requestID = $(this).attr('id');
                    
                    var deleteRequest = GLOBALS.appRoot + "postrequest/deleterequest"
                    if (!requestID) {
                        toastr.error("Important Variable to Render Page Is Missing", {timeOut: 150000});
                    } else {

                        toastr.info("Deleting Expense Item", {timeOut: 150000});
                        $.post(deleteRequest, {requestID: requestID}, function (data) {
                            if (data.status == 200) {
                                toastr.success("Item Successfully Deleted", {timeOut: 150000});
                                setTimeout(function () { window.location.reload(1) });
                            } else if (data.status == 400) {
                                toastr.error("Error Processing Request", {timeOut: 150000});
                            }else if (data.status == 401) {
                                toastr.error(data.msg, {timeOut: 150000});
                            }
                        });
                    
                      }
                });


              $("#processforupload").click(function (e) {
                   var a_requestID = $('#a_requestID').val();
                   var a_unit = $('#a_unit').val();
                   var a_md5 = $('#a_md5').val();
             
                   var processforfileupload = GLOBALS.appRoot + "postrequest/processforfileupload"
                   if(a_requestID == ""  || a_unit == ""){
                       toastr.success("No Unit, No Request ID Contact Administrator", {timeOut: 150000});
                    }else{
                         toastr.info("Process and Preparing Request For HOD, Please wait.....", {timeOut: 150000});
                        $.post(processforfileupload, {a_requestID: a_requestID, a_unit: a_unit, a_md5: a_md5 }, function (data) {
                            if (data.status == 200) {
                                toastr.success("Successfully Process, Do You want to Upload Files", {timeOut: 150000});
                                setTimeout(function () {
                                        window.top.location = GLOBALS.appRoot + "postrequest/makefileupload/" + data.id + "/" + data.unit + "/" + data.md5
                                    }, 1000);
                            } else if (data.status == 400) {
                                toastr.error("Error Processing Request", {timeOut: 150000});
                            } else if (data.status == 401) {
                                toastr.error(data.msg, {timeOut: 300000});
                            }
                        });
                    }
                    
                    
                });


            });
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#processforupload").show();
                $("#process_refresh").show();
            });
        </script>
        
        <script>
            
            function makemebelieve(){
                 $('.makeusdelete').click(function (e) {
                    var requestID = $(this).attr('id');
                    
                    var deleteRequest = GLOBALS.appRoot + "postrequest/deleterequest"
                    if (!requestID) {
                        toastr.error("Important Variable to Render Page Is Missing", {timeOut: 150000});
                    } else {

                        toastr.info("Deleting Expense Item", {timeOut: 150000});
                        $.post(deleteRequest, {requestID: requestID}, function (data) {
                            if (data.status == 200) {
                                toastr.success("Item Successfully Deleted", {timeOut: 150000});
                                setTimeout(function () { window.location.reload(1) });
                            } else if (data.status == 400) {
                                toastr.error("Error Processing Request", {timeOut: 150000});
                            }else if (data.status == 401) {
                                toastr.error(data.msg, {timeOut: 150000});
                            }
                        });
                    
                      }
                });
            }
        </script>


<?php echo $footer; ?>