

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
            
             
            .transferform {
                display:none;
            }

            .mainform {
                display: block;
            }
 
        </style>

        <!-- Main Outer Content Begins Here --> 
        <div class="content">
            <div class="container-fluid">
                <div class="row">


                    <!-- Inside Content Begins  Here -->

                    <!-- Beginning of Request Details with Status -->

                    <div class="col-md-10 col-md-offset-1 mainform">     
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
                                           
                                        </ul>
                                    </div>
                                </div>
                            </div> <!-- End of card-header -->

                            <form name="mainrequestformadvanceform" id="mainrequestformadvanceform" enctype="multipart/form-data" method="POST" onSubmit="return false;">
                                
                                <div class="card-content">
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="profile">
                                            
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <!--<label class="control-label">Date</label>-->
                                                    <input placeholder="Date"  type="text" value="<?php echo date('Y-m-d'); ?>" class="form-control" readonly name="dateCreated" id="dateCreated" />
                                                    <!--<input placeholder="Date"  type="text" value="<?php echo date('Y-m-d'); ?>" class="form-control datepicker" name="dateCreated" id="dateCreated" />-->
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Title</label>
                                                    <input type="text" class="form-control" name="descItem" id="descItem" />
                                                  
                                                </div>
                                            </div>


                                          

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
                                                       /* $cur_abbrev = $get->curr_abrev;
                                                        $curr_symbol = $get->curr_symbol;
                                                        $currency = $get->currency; */
                                                        $name = $get->name;
                                                        $id = $get->id;
                                                        $allcurrency .= "<option  value='$name'> " . $name . '</option>';
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



                                    </div>
                                </div>
                                <!--</form>-->

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div id="showError"></div><span id="loader"></span>
                                <input  id="processnewrequestadvance" type="submit" value="SAVE" class="btn btn-primary wpsc_buy_button" />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <!--<input  id="processdraft" type="submit" value="SAVE" class="btn btn-danger wpsc_buy_button" />-->
                            </div> 
                        </div>

                        </form>

                    </div>
                    <!-- End of Request Details with Status -->
<!-- //////////////////////////////////////////////////// END OF THE FIRST COTENT/////////////////////////////////////-->
                 

                    








<!-- //////////////////////////////////////////END OF SECOND FORM/////////////////////////////////////////////////-->

             <div class="col-md-10 col-md-offset-1 transferform">     
                        <div class="card card-nav-tabs">

                            <div class="card-header" data-background-color="red">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <span class="nav-tabs-title">ACTION:</span>
                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                            <li class="active">
                                                <a href="#profile" data-toggle="tab">
                                                    <i class="material-icons">bug_report</i>
                                                    BANK TRANSFER
                                                    <div class="ripple-container"></div></a>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </div>
                            </div> <!-- End of card-header -->

                            <form name="processbanktransfer" id="processbanktransfer"  onSubmit="return false;">
                                
                                <div class="card-content">
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="profile">
                                            
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <!--<label class="control-label">Date</label>-->
                                                    <input placeholder="Date"  type="text" value="<?php echo date('Y-m-d'); ?>" class="form-control" readonly name="tr_dateCreated" id="tr_dateCreated" />
                                                    <!--<input placeholder="Date"  type="text" value="<?php echo date('Y-m-d'); ?>" class="form-control datepicker" name="dateCreated" id="dateCreated" />-->
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Description of Transfer</label>
                                                    <input type="text" class="form-control" name="descriptionOftransfer" id="descriptionOftransfer" />
                                                  
                                                </div>
                                            </div>
                                            

                                             <?php
                                            $onlyhod = $this->generalmd->getdresult("*", "cash_usersetup", "", "");

                                            if ($onlyhod) {
                                                $onlydhod = "";
                                                foreach ($onlyhod as $get) {

                                                    $id = $get->id;
                                                    $hodEmail = $get->email;
                                                    $onlydhod .= "<option  value=\"$hodEmail\">" . $hodEmail . '</option>';
                                                }
                                            }
                                            ?>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">1st Level Approval (HOD)</label>
                                                    <select class="form-control mySelect" data-style="btn-default" name="tr_dhod" id="tr_dhod" data-live-search="true">
                                                        <option value="">Select HOD</option>
                                                        <?php echo $onlydhod; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Select Unit</label>
                                                    <select name="tr_dUnit" id="tr_dUnit" class="form-control">
                                                        <option value="">Select Unit</option>
                                                        <?php echo $dunit; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                             <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Select Payee</label>
                                                    <select name="tr_vendor" id="tr_vendor" class="form-control">
                                                        <option value="">Choose Payee</option>
                                                        <option value="abuja_account">Abuja Account</option>
                                                        <option value="portharcourt_account">PortHarcout Account</option>
                                                         <option value="mailand_account">Mainland Account</option>
                                                    </select>
                                                    <!--<input type="text" class="form-control" name="benName" id="benName" />-->
                                                </div>
                                            </div>

                                            
                                            
                                            <hr/><br/><br/>
                                            
                                            <?php
                                             $getAllAccountsCodes = $this->generalmd->getdresult("*", "unitaccountcode", "", "");
                                              if ($getAllAccountsCodes) {
                                                $ballact = "";
                                                foreach ($getAllAccountsCodes as $get) {
                                                    //$codeid = $get->codeid;
                                                    $codeName = $get->codeName;
                                                    $codeNumber = $get->codeNumber;
                                                    $ballact .= "<option  value='$codeNumber'> " . $codeName . ' - ' . $codeNumber . '</option>';
                                                }
                                                //return $allact;
        }
                                             ?>
                                            <div class="col-md-12">
                                                <h4>EXPENSE DETAILS</h4>
                                            <table class="table-bordered">
                                                    <tr>
                                                        <th style="width:40%">Expense Details</th>
                                                        <th style="width:15%">Amount</th>
                                                        <th style="width:25%">Expense Code</th>
                                                        <th style="width:15%">Date</th>
                                                    </tr>
                                                    <tr>
                                                        <td><textarea name="tr_exDetailofpayment" id="tr_exDetailofpayment" placeholder="Payment Details" class="form-control exDetailofpayment"></textarea></td>
                                                        <td><input type="number" required name="tr_exAmount" id="tr_exAmount" placeholder="Amount" class="form-control exAmount" min="0"/></td>
                                                        <td><select name="tr_exCode" required id="tr_exCode" placeholder="Code" class="form-control exCode"><option value="">Select Code</option><?php echo $ballact; ?></select></td>
                                                        <td><input type="text" required name="tr_exDate" id="tr_exDate" placeholder="dddd-mm-dd" class="form-control newdatelog" value="<?php echo date('Y-m-d'); ?>"/></td>
                                                       </tr>
                                                    </tr>
                                             </table>
                                                
                                                
                                          <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Upload File</label>
                                                    <input type="file" name="tr_uploadFile" id="tr_uploadFile" />
                                                  
                                                </div>
                                            </div>
                                            
                                            </div>

                                         

                                        </div> <!-- <div class="tab-pane active" id="profile"> -->



                                    </div>
                                </div>
                             
                        </div>

                 
                 
                        <div class="row">
                            <div class="col-md-12">
                                <div id="showError"></div><span id="loader"></span>
                                <input  id="processbanktransferBtn" type="submit" value="PROCESS TRANSFER" class="btn btn-danger " />
                               
                            </div> 
                        </div>
                 
                 
                       


                        </form>

                    </div>
<!-- //////////////////////////////////////////END OF SECOND FORM/////////////////////////////////////////////////-->
                 

    








                </div>
            </div>
        </div>
        <!-- Main Outer Content Ends  Here --> 
        
        
        
        
        
        
        
        
        
        
       
       
            
        <script type="text/javascript">
            $(document).ready(function () {
                
                $('#paymentType').change(function (e){
                    e.preventDefault();
                    var paymentType = $('#paymentType').val();
                    if(paymentType == 3){
                        $('.transferform').show();
                        $('.mainform').hide();
                        //setTimeout(function () {window.top.location = GLOBALS.appRoot + "postrequest/banktransfer/" + paymentType }, 5);
                    }
                });
                
                
                $('#processbanktransferBtn').click(function (e) {
                    
                    e.preventDefault();
                    var tr_dateCreated = $('#tr_dateCreated').val();
                    var descriptionOftransfer = $('#descriptionOftransfer').val();
                    var tr_dhod = $('#tr_dhod').val();
                    var tr_dUnit = $('#tr_dUnit').val();
                    var tr_vendor = $('#tr_vendor').val();
                    var tr_exDetailofpayment = $('#tr_exDetailofpayment').val();
                    var tr_exAmount = $('#tr_exAmount').val();
                    var tr_exCode = $('#tr_exCode').val();
                    var tr_exDate = $('#tr_exDate').val();
                    var tr_uploadFile = $('#tr_uploadFile').val();
                    
                    if(descriptionOftransfer == "" || tr_dhod == "" || tr_dUnit == "" || tr_vendor == "" || 
                          tr_exDetailofpayment == "" || tr_exAmount == "" || tr_exCode == "" ){
                         toastr.error('Please make sure all fields are fields with document uploaded');  
                    }else{
                       toastr.info('Processing request, please wait....');  
                       var dataString = new FormData(document.getElementById('processbanktransfer'));
                       
                        $.ajax({
                            type: "POST",
                            url: GLOBALS.appRoot + "postrequest/ibanktransfer",
                            data: dataString,
                            contentType: false,
                            processData: false,
                            cache: false,
                            dataType: 'JSON',

                            success: function (data) {
                                if (data.status == 200) {
                                     toastr.success(data.msg);
                                     alert("successful");
                                      setTimeout(function () {
                                        window.top.location = GLOBALS.appRoot + "postrequest/allbankrequest/34"
                                    }, 1000);
              
                                     
                                } else {
                                     toastr.error(data.msg);
                              
                                }
                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                               toastr.warning(' Error Processing Request, please try again or check your internet...');
                               
                            }

                        });
                        
                    }
                    
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

                    ///////////////////////// END OF PROCESSING FORM VARIABLE FOR EXPENSE DETAILS //////////////////////////////
                    var dataString = new FormData(document.getElementById('mainrequestformadvanceform')); //postArticles

                   if(paymentType == 3){
                        $('#showError').html("You cannot process bank transafer on this form").addClass("alert alert-danger");
                         toastr.error('Please Payee Name cannot be empty');
                         
                   }else if (paymentType == 1 && benName == "") {
                        $('#showError').html("Please Payee Name cannot be empty").addClass("alert alert-danger");
                         toastr.error('Please Payee Name cannot be empty');
                    }else if(paymentType == 2 && vendor == ""){
                      $('#showError').html("Please Select Vendor").addClass("alert alert-danger");
                      toastr.error('Please Select Vendor');
                    }else if (dateCreated == "" || dateCreated == "0000-00-00") {
                        $('#showError').html("Please Select Date For Request").addClass("alert alert-danger");
                        toastr.error('Please Select Date For Request');
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
                    }else if (dcashier == "null" && daccountant == "0") {
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
                            url: GLOBALS.appRoot + "postrequest/index",
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
                                        window.top.location = GLOBALS.appRoot + "postrequest/add_expense_code/" + data.id + "/" + data.dUnit + "/" + data.md5
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