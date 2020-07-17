
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


                    <!-- Inside Content Begins  Here -->

                    <!-- Beginning of Request Details with Status -->

                    <div class="col-md-10 col-md-offset-1">     
                        <div class="card card-nav-tabs">

                            <div class="card-header" data-background-color="blue">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <span class="nav-tabs-title">ACTION:</span>
                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                            <li class="active">
                                                <a href="#profile" data-toggle="tab">
                                                    <i class="material-icons">bug_report</i>
                                                    Request Details
                                                    <div class="ripple-container"></div></a>
                                            </li>
                                            <li class="">
                                                <a href="#messages" data-toggle="tab">
                                                    <i class="material-icons">code</i>
                                                    Expense Details
                                                    <div class="ripple-container"></div></a>
                                            </li>
                                            <li class="">
                                                <a href="#settings" data-toggle="tab">
                                                    <i class="material-icons">cloud</i>
                                                    Attachment
                                                    <div class="ripple-container"></div></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div> <!-- End of card-header -->

                            <form name="mainrequestformadvanceform" id="mainrequestformadvanceform" enctype="multipart/form-data" method="POST" onSubmit="return false;">
                                
                                <div class="card-content">
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="profile">
                                            <center><span style="color:red">
                                                    IMPORTANT NOTICE!!!! &nbsp;
                                                    All Units are now required to add their respective PAYEE to their Unit.
                                                    Same process as obtained with the Account Codes. 
                                                    To add a PAYEE to your unit. <b><a href="<?php echo base_url(); ?>accountcode/addvendor/<?php echo $_SESSION['email']; ?>">CLICK HERE</a></b>
                                               </span>
                                            </center>

                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <!--<label class="control-label">Date</label>-->
                                                    <input placeholder="Date"  type="text" value="<?php echo date('Y-m-d'); ?>" class="form-control" readonly name="dateCreated" id="dateCreated" />
                                                    <!--<input placeholder="Date"  type="text" value="<?php echo date('Y-m-d'); ?>" class="form-control datepicker" name="dateCreated" id="dateCreated" />-->
                                                </div>
                                            </div>

                                            <?php
                                            /*
                                              $getTitles = $this->mainlocation->getalltitles();

                                              if ($getTitles) {
                                              $dtitles = "";
                                              foreach ($getTitles as $get) {

                                              $id = $get->id;
                                              $titleName = $get->titleName;
                                              $dtitles .= "<option  value=\"$titleName\">" . $titleName . '</option>';
                                              }
                                              }
                                             */
                                            ?>
                                            <div class="col-md-8">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Title</label>
                                                    <input type="text" class="form-control" name="descItem" id="descItem" />
                                                   <!--<select class="form-control mySelect" name="descItem" id="descItem" data-live-search="true">
                                                       <option>Select Title</option>
                                                    <?php //echo $dtitles; ?>
                                                   </select>-->
                                                </div>
                                            </div>


                                            <!--<div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Payee Name</label>
                                                    <input type="text" class="form-control" name="benName" id="benName" />
                                                </div>
                                            </div>-->


                                            <!--<div class="col-md-4">
                                                       <div class="form-group label-floating">
                                                       <label class="control-label">Payee Act Number</label>
                                                       <input type="text" class="form-control" name="payeeActno" id="payeeActno" />
                                                       </div>
                                           </div>
                                         
                                           
                                           <div class="col-md-4">
                                                       <div class="form-group label-floating">
                                                       <label class="control-label">Payee Email</label>
                                                       <input type="email" name="benEmail" id="benEmail" class="form-control">
                                                       </div>
                                           </div>
                                            -->

                                            


                                            <?php
                                            $getpayment = $this->mainlocation->getallpayment();

                                            if ($getpayment) {
                                                $pay = "";
                                                foreach ($getpayment as $get) {

                                                    $id = $get->id;
                                                    $paymentType = $get->paymentType;
                                                    $pay .= "<option  value=\"$id\">" . $paymentType . '</option>';
                                                }
                                            }
                                            ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Payment Method</label>
                                                    <select name="paymentType" id="paymentType" class="form-control">
                                                        <option value="">Select Payment Method</option>
                                                        <?php echo $pay; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            
                                             <?php
                                            $gethod = $this->adminmodel->getalluserwithhodid();
                                            $kaboom = explode(",", $gethod);
                                            $hod = "";
                                            foreach ($kaboom as $key => $value) {
                                                $getallemail = $this->users->getresultwithid($value);

                                                if ($getallemail) {
                                                    foreach ($getallemail as $get) {
                                                        $newid = $get->id;
                                                        $fname = $get->fname;
                                                        $lname = $get->lname;
                                                        $email = $get->email;
                                                        $hod .= "<option  value=\"$email\">" . $fname . " " . $lname . " >> " . $email . '</option>';
                                                    }
                                                }
                                            }
                                            /*
                                              if ($gethod) {
                                              $hod = "";
                                              foreach ($gethod as $get) {

                                              $id = $get->id;
                                              $email = $get->email;
                                              $fname = $get->fname;
                                              $lname = $get->lname;
                                              $hod .= "<option  value=\"$email\">" . $fname." ". $lname. " >> ".$email . '</option>';
                                              }
                                              }

                                             */
                                            ?>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">1st Level Approval (HOD)</label>
                                                    <select class="form-control mySelect" data-style="btn-default" name="dhod" id="dhod" data-live-search="true">
                                                        <option value="">Select HOD</option>
                                                        <?php echo $hod; ?>
                                                    </select>
                                                </div>
                                            </div>



                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">2nd Level Approval (ICU)</label>
                                                    <select name="dicu" id="dicu" class="form-control">
                                                        <option value="">Select ICU</option>
                                                        <option value="1">ICU Approval</option>
                                                    </select>
                                                </div>
                                            </div>


                                            
                                            <?php
                                            $getunit = $this->mainlocation->getallunit();

                                            if ($getunit) {
                                                $dunit = "";
                                                foreach ($getunit as $get) {

                                                    $id = $get->id;
                                                    $unitName = $get->unitName;
                                                    $dunit .= "<option  value=\"$id\">" . $unitName . '</option>';
                                                }
                                            }
                                            ?>

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="control-label">Comment</label>
                                                    <input type="text" class="form-control" name="dComment" id="dComment" />
                                                    <!--<textarea class="form-control" name="dComment" id="dComment"></textarea>-->
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Select Unit</label>
                                                    <select name="dUnit" id="dUnit" class="form-control">
                                                        <option value="">Select Unit</option>
                                                        <?php echo $dunit; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            






                                           


                                            <!---------THE ACCOUNTANT AND CASHIERS ---------------------->

                                            <?php
                                            $getcashier = $this->mainlocation->getallaccount();

                                            if ($getcashier) {
                                                $acc = "";
                                                foreach ($getcashier as $get) {

                                                    $id = $get->id;
                                                    $email = $get->email;
                                                    $fname = $get->fname;
                                                    $lname = $get->lname;
                                                    $acc .= "<option  value=\"$email\">" . $fname . " " . $lname . " >> " . $email . '</option>';
                                                }
                                            }
                                            ?>
                                            <div style="clear:both"></div>
                                            <div class="col-md-4" id="mycashtoremove">
                                                <div class="form-group">
                                                    <label class="control-label">3rd Level Approval (Cashier)</label>
                                                    <select name="dcashier" id="dcashier" class="form-control">
                                                        <option value="null">Select Cashier</option>
                                                        <?php echo $acc; ?>
                                                    </select>
                                                </div>
                                              
                                            </div>
                                            
                                            <div class="col-md-4" id="mypayeeName">
                                                <div class="form-group">
                                                    <label class="control-label">Payee Name</label>
                                                    <input type="text" class="form-control" name="benName" id="benName" />
                                                </div>
                                            </div>




                                            <!---  FOR ACCOUNT BANK ALERT -->
                                            <?php
                                            $getaccount = $this->adminmodel->getaccountgroup();

                                            if ($getaccount) {
                                                $dnewacc = "";
                                                foreach ($getaccount as $get) {

                                                    $gid = $get->gid;
                                                    $accountgroupName = $get->accountgroupName;

                                                    $dnewacc .= "<option  value=\"$gid\">" . $accountgroupName . '</option>';
                                                }
                                            }
                                            ?>

                                            
                                            
                                            <?php
                                            
                                             if ($getCurrencies) {
                                                    $allcurrency = "";
                                                    foreach ($getCurrencies as $get) {
                                                        //$codeid = $get->codeid;
                                                        $cur_abbrev = $get->curr_abrev;
                                                        $curr_symbol = $get->curr_symbol;
                                                        $currency = $get->currency;
                                                        $allcurrency .= "<option  value='$cur_abbrev'> " . $curr_symbol . ' - ' . $currency . '</option>';
                                                    }
                                                    //return $allact;
                                                }
                                            
                                            ?>
                                            <!-- BEGINNING OF CURRENCY TYPE -->
                                            <div class="col-md-3" id="mycurrencyType">
                                                <div class="form-group">
                                                    <label class="control-label">Select Currency Type</label>
                                                    <select name="dCurrencyType" id="dCurrencyType" class="form-control">
                                                        <option value="NGN">Select</option>
                                                       <?php echo $allcurrency; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- END OF CURRENCY TYPE -->
                                            
                                            
                                            <div class="col-md-3" id="mychequaccout">
                                                <div class="form-group">
                                                    <label class="control-label">3rd Level Approval (Account)</label>
                                                    <select name="daccountant" id="daccountant" class="form-control">
                                                        <option value="0">Select</option>
                                                        <?php echo $dnewacc ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-md-3" id="mysageref">
                                                <div class="form-group">
                                                    <label class="control-label">Sage Reference</label>
                                                     <input type="text" name="sageRef" id="sageRef" class="form-control"/>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3" id="mypayeeNameCheque">
                                                <div class="form-group">
                                                    <label class="control-label">Select Payee</label>
                                                    <select name="vendor" id="vendor" class="form-control">
                                                        <option value="">Choose Payee</option>
                                                        <?php echo $myvendors; ?>
                                                    </select>
                                                    <!--<input type="text" class="form-control" name="benName" id="benName" />-->
                                                </div>
                                            </div>


                                            <!--------- END OF THE ACCOUNTANT AND THE CASHIERS ----------->





                                        </div> <!-- <div class="tab-pane active" id="profile"> -->



                                        <div class="tab-pane" id="messages">
                                            <div class="card-content table-responsive">
                                                <b><span>Total Amount:</span></b> 
                                                <button class="btn btn-sm btn-success"><span id="sumAmount"></span></button>
                                                <span id="suminput"></span>
                                                <!-- Beginning of add more expense details -->
                                                <table class="table table-bordered" id="item_table">
                                                    <tr>
                                                        <th style="width:40%">Expense Details</th>
                                                        <th style="width:15%">Amount</th>
                                                        <th style="width:25%">Expense Code</th>
                                                        <th style="width:15%">Date</th>
                                                        <th style="width:5%"><button title="Add More" type="button" name="add" class="btn btn-success btn-sm add"><span style="font-size: 2em; font-weight:bold" class="glyphicon glyphicon-plus"></span></button></th>
                                                    </tr>
                                                    <tr>
                                                        <td><textarea name="exDetailofpayment[]" id="exDetailofpayment" placeholder="Payment Details" class="form-control exDetailofpayment"></textarea></td>
                                                        <td><input type="number" required name="exAmount[]" id="exAmount" placeholder="Amount" class="form-control exAmount" min="0"/></td>
                                                        <td><select name="exCode[]" required id="exCode" placeholder="Code" class="form-control exCode"><option value="">Select Code</option><?php echo $fillSelect; ?></select></td>
                                                        <td><input type="text" required name="exDate[]" id="exDate" placeholder="dddd-mm-dd" class="form-control newdatelog" value="<?php echo date('Y-m-d'); ?>"/></td>
                                                        <td><button type="type" title="Remove" name="remove" class="btn btn-danger btn-sm remove"><i class="material-icons">cancel</i></button></td></tr>
                                                    </tr>
                                                </table>
                                                <!-- End of add more expense details -->
                                            </div>   
                                        </div>


                                        
                                        <div class="tab-pane" id="settings">

                                            <div class="col-md-12">
                                                <div class=""><br/>
                                                    <small><span style="color:red">Upload multiples files at onces</span></small><br/>    
                                                    <label><span>Upload Attachment</span></label>
                                                    <input type="file" style="display:block" name="upfile[]" id="upfile[]" multiple />
                                                </div>

                                                <div id="moreImageUpload"></div>
                                                <div style="clear:both;"></div>
                                                <div id="moreImageUploadLink" style="display:none;">
                                                    <a href="javascript:void(0);" id="attachMore">Attach another file</a>
                                                </div>

                                            </div>

                                            <div class="col-md-12">
                                                                    
                                            </div>


                                            <hr/>

                                        </div> 




                                    </div>
                                </div>
                                <!--</form>-->

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div id="showError"></div><span id="loader"></span>
                                <input  id="processnewrequestadvance" type="submit" value="SEND" class="btn btn-primary wpsc_buy_button" />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <!--<input  id="processdraft" type="submit" value="SAVE" class="btn btn-danger wpsc_buy_button" />-->
                            </div> 
                        </div>

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
                $(document).on('click', '.add', function () {
                    var html = "";
                    html += "<tr>";
                    //html += "<td><input type='text' name='exDetailofpayment[]' id='exDetailofpayment' placeholder='Payment Details' class='form-control exDetailofpayment'/></td>";
                    html += "<td><textarea name='exDetailofpayment[]' id='exDetailofpayment' placeholder='Payment Details' class='form-control exDetailofpayment'></textarea></td>";
                    html += "<td><input type='number' required name='exAmount[]' id='exAmount' placeholder='Amount' class='form-control exAmount' min='0'/></td>";
                    //html += "<td><select name='exCode[]' required id='exCode' placeholder='Code' class='form-control exCode'><option value=''>Select Code</option><?php //echo $fillSelect; ?></select></td>";
                    html += "<td><select name='exCode[]' required id='exCode' placeholder='Code' class='form-control exCode'><?php echo $fillSelect; ?></select></td>";
                    html += "<td><input type='text' required name='exDate[]' id='exDate' placeholder='dddd-mm-dd' class='form-control newdatelog' value='<?php echo date('Y-m-d'); ?>'/></td>";
                    html += "<td><button type='type' name='remove' class='btn btn-danger btn-sm remove'><i class='material-icons'>cancel</i></button></td></tr>";
                    $('#item_table').append(html);
                });


                $(document).on('click', '.remove', function () {
                    var r = confirm("Please make sure this particular row you want to remove all details, eg. Payment details, amount, select code and date is empty before your remove");
                     if (r == true) {
                    $(this).closest('tr').remove();
                    }
                });

                $(document).on('click', '.newdatelog', function () {
                    $(this).datepicker({
                        //dateFormat: 'yy-mm-d',
                        format: 'yyyy-mm-dd',
                        weekStart: 1,
                        color: 'red'
                    });
                });

               

                $('#processnewrequestadvance').click(function (e) {
                    e.preventDefault();
                    var dateCreated = $('#dateCreated').val();
                    var descItem = $('#descItem').val();
                    var benName = $('#benName').val();
                    var benEmail = $('#benEmail').val();
                    var dUnit = $('#dUnit').val();
                    var itemCat = $('#itemCat').val();
                    var paymentType = $('#paymentType').val();
                    var dComment = $('#dComment').val();
                    var dhod = $('#dhod').val();
                    var dicu = $('#dicu').val();
                    //var payeeActno = $('#payeeActno').val();
                    var dcashier = $('#dcashier').val() != "" ? $('#dcashier').val() : "";
                    var daccountant = $('#daccountant').val() != "" ? $('#daccountant').val() : "";
                    var dCurrencyType = $('#dCurrencyType').val();
                    var sageRef = $('#sageRef').val();
                    var vendor = $('#vendor').val();

                   
                    /////////////////////////PROCESSING FORM VARIABLE FOR EXPENSE DETAILS //////////////////////////////

                    var exDetailofpayment = $('#exDetailofpayment').val();
                    var exAmount = $('#exAmount').val();
                    var exCode = $('#exCode').val();
                    var exDate = $('#exDate').val();
                    var sumall = $('#sumall').val();

                    ///////////////////////// END OF PROCESSING FORM VARIABLE FOR EXPENSE DETAILS //////////////////////////////
                    var dataString = new FormData(document.getElementById('mainrequestformadvanceform')); //postArticles

                    var error = "";

                    $('#exDetailofpayment').each(function () {
                        var count = 1;
                        if ($(this).val() === "") {
                            error += "<p>Please make sure no Expense Details is empty</p>";
                            return false;
                        }
                        count = count + 1;
                    });

                    $('#exAmount').each(function () {
                        var count = 1;
                        if ($(this).val() === "") {
                            error += "<p>Please make sure no amount field is empty</p>";
                            return false;
                        }
                        count = count + 1;
                    });

                    $('#exCode').each(function () {
                        var count = 1;
                        if ($(this).val() === "") {
                            error += "<p>Please make sure no Expense Code is empty</p>";
                            return false;
                        }
                        count = count + 1;
                    });

                   
                    if (paymentType == 1 && benName == "") {
                        $('#showError').html("Please Payee Name cannot be empty").addClass("alert alert-danger");
                         toastr.error('Please Payee Name cannot be empty');
                    }else if(paymentType == 2 && vendor == ""){
                      $('#showError').html("Please Select Vendor").addClass("alert alert-danger");
                      toastr.error('Please Select Vendor');
                    }else if (dateCreated == "" || dateCreated == "0000-00-00") {
                        $('#showError').html("Please Select Date For Request").addClass("alert alert-danger");
                        toastr.error('Please Select Date For Request');
                    } else if (exCode == "" || exDetailofpayment == "" || exDate == ""  || exAmount == "") {
                        $('#showError').html("Expense Code, Expense Details, Date and Amount cannot be empty").addClass("alert alert-danger");
                        toastr.info('Expense Code, Expense Details, Date and Amount cannot be empty');
                    } else if (dUnit == "") {
                        $('#showError').html("Please Select your Unit").addClass("alert alert-danger");
                         toastr.warning('Please Select your Unit');
                    }else if (descItem == "") {
                        $('#showError').html("Please add a Title for the Request").addClass("alert alert-danger");
                         toastr.warning('Please add a Title for the Request');
                    }else if (paymentType == "") {
                        $('#showError').html("Payment Type Cannot be Empty").addClass("alert alert-danger");
                         toastr.warning('Payment Type Cannot be Empty');
                    }else if (dhod == "") {
                        $('#showError').html("You must Select the HOD who will approve the Request").addClass("alert alert-danger");
                        toastr.warning('You must Select the HOD who will approve the Request');
                    }else if (dicu == "") {
                        $('#showError').html("You must Select ICU Approval").addClass("alert alert-danger");
                        toastr.warning('You must Select ICU Approval');
                    }else if (error) {
                        $('#showError').html('<div class="alert alert-danger">' + error + '</div>');
                    } else if (dcashier == "null" && daccountant == "0") {
                        $('#showError').html("Please make sure you are selecting either a cashier or an account group").addClass("alert alert-danger");
                        toastr.info('Please make sure you are selecting either a cashier or an account group');
                    } else {
                        $('#showError').html("Processing Request, Please wait...").addClass("alert alert-danger");
                        $('#showError').html('Uploading Request to our Database, please wait...').addClass('alert alert-warning');
                        $('#showError').append('<img src="https://c-iprocure.com/expensepro/public/images/load.gif"/>');
                        $('#processnewrequestadvance').hide();
                        $('#processdraft').hide();
                        toastr.info('Processing Request, Please wait...');

                        $('.loaderimg').show();
                        $.ajax({
                            type: "POST",
                            url: GLOBALS.appRoot + "newrequest/advancenewrequest",
                            data: dataString,
                            contentType: false,
                            processData: false,
                            cache: false,
                            dataType: 'JSON',

                            success: function (data) {
                                if (data.status == 0) {
                                    $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-warning');
                                     toastr.info(data.msg);
                                    $('#processnewrequestadvance').show();
                                    $('#processdraft').show();
                                } else if (data.status == 1) {
                                     toastr.success(data.msg);
                                    $('#showError').html(data.msg).addClass('alert alert-success');
                                    $('#dateCreated').val('');
                                    $('#fileUpload').val('');
                                    $('#descItem').val('');
                                    $('#itemCat').val('');
                                    $('#paymentType').val('');
                                    $('#dhod').val('');
                                    $('#dicu').val('');
                                    $('#dcashier').val('');
                                    $('#benName').val('');
                                    $('#dAmount').val('');
                                    $('#sageRef').val('');
                                    setTimeout(function () {
                                        window.top.location = GLOBALS.appRoot + "home/"
                                    }, 1000);

                                } else if (data.status == 2) {
                                    $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-secondary');
                                    $('#processnewrequestadvance').show();
                                    $('#processdraft').show();
                                    toastr.info(data.msg);
                                } else if (data.status == 5) {
                                    $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary');
                                    $('#processnewrequestadvance').show();
                                    $('#processdraft').show();
                                    toastr.info(data.msg);
                                } else if (data.status == 3) {
                                    $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary');
                                    $('#processnewrequestadvance').show();
                                    $('#processdraft').show();
                                    toastr.info(data.msg);
                                } else if (data.status == 7) {
                                    $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary');
                                    $('#processnewrequestadvance').show();
                                    $('#processdraft').show();
                                    toastr.info(data.msg);
                                } else if (data.status == 9) {
                                    $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary');
                                    $('#processnewrequestadvance').show();
                                    $('#processdraft').show();
                                    toastr.info(data.msg);
                                } else if (data.status == 6) {
                                    $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary');
                                    $('#processnewrequestadvance').show();
                                    $('#processdraft').show();
                                    toastr.info(data.msg);
                                }else if (data.status == 8) {
                                    $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary');
                                    $('#processnewrequestadvance').show();
                                    $('#processdraft').show();
                                    toastr.info(data.msg);
                                }else if (data.status == 12) {
                                    $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary');
                                    $('#processnewrequestadvance').show();
                                    $('#processdraft').show();
                                    toastr.info(data.msg);
                                }else if (data.status == 17) {
                                    $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary');
                                    $('#processnewrequestadvance').show();
                                    $('#processdraft').show();
                                    toastr.info(data.msg);
                                }
                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                $('#showError').html('<img src="https://c-iprocure.com/expensepro/public/images/round_error.png"/>');
                                $('#showError').append(' Error Processing Request, please try again or check your internet...').addClass('alert alert-danger');
                                toastr.warning(' Error Processing Request, please try again or check your internet...');
                                $('#processnewrequestadvance').show();
                                 $("#processdraft").show();
                                console.log('An Ajax error was thrown.');
                                console.log(XMLHttpRequest);
                                console.log(textStatus);
                                console.log(errorThrown);
                            }

                        });

                    }

                });

            });
        </script>



        <script type="text/javascript">
            $(document).ready(function () {
                $("#processnewrequestadvance").show();
                $("#processdraft").show();
            });
        </script>

        <?php echo $footer; ?>