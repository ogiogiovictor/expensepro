
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
                                    <h4 class="title"><span class="tastkform"><span style="color:white">EDIT REQUEST ( <?php echo $mID; ?> ) </span></span></h4>
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
                                            $icashier = $get->cashiers;
                                            $dAccountgroup = $get->dAccountgroup;
                                            $CurrencyType = $get->CurrencyType;
                                            $requesterComment = $get->requesterComment;
                                            $from_app_id = $get->from_app_id;
                                            $unitName = $this->generalmd->getsinglecolumn("unitName", "cash_unit", "id", $dUnit);
                                            $dAccountgroupName = $this->generalmd->getsinglecolumn("accountgroupName", "cash_groupaccount", "gid", $dAccountgroup);
                                        }
                                        
                                        //$this->generalmd->getsinglecolumn("paymentType", "cash_paymentmode", "id", $nPayment)
                                    }
                                    ?>
                                    
                                    <form method="POST" name="pushForm" id="pushForm" onsubmit="return false">
                                    <div><b>Description:</b></div>
                                    <input class="form-controls" type="text" value="<?php echo $ndescriptOfitem; ?>" id="ndescription" name="ndescription" />
                                    
                                    <div><b>Unit</b></div>
                                    <?php 
                                    $units = $this->generalmd->getdresult("*", "cash_unit", "", "");
                                    if($units){
                                        echo "<select class='form-controls' name='unitName' id='unitName'>";
                                         echo "<option selected value='$dUnit'>$unitName</option>";
                                        foreach($units as $get){
                                            echo "<option value='$get->id'>$get->unitName</option>";
                                        }
                                        echo "</select>";
                                    }
                                    ?>
                                    
                                     <div><b>HOD</b></div>
                                    <?php 
                                    $hod = $this->generalmd->getdresult("*", "cash_usersetup", "accessLevel", "2");
                                    if($hod){
                                        echo "<select class='form-controls' name='hod' id='hod'>";
                                         echo "<option selected value='$dhod'>$dhod</option>";
                                        foreach($hod as $get){
                                            echo "<option value='$get->email'>$get->fname >> $get->email</option>";
                                        }
                                        echo "</select>";
                                    }
                                    ?>
                                     
                                     <?php
                                        if($nPayment == 1){
                                            echo " <div><b>Cashier</b></div>";
                                            $cashier = $this->generalmd->getdresult("*", "cash_usersetup", "accessLevel", "3");
                                            if($cashier){
                                             echo "<select class='form-controls' name='cashier' id='cashier'>";
                                             echo "<option selected value='$icashier'>$icashier</option>";
                                                foreach($cashier as $get){
                                                    echo "<option value='$get->email'>$get->fname >> $get->email</option>";
                                                }
                                            echo "</select>";
                                            }
                                        
                                        }else if($nPayment == 2){
                                            echo " <div><b>Account Group</b></div>";
                                            $accountGroup = $this->generalmd->getdresult("*", "cash_groupaccount", "", "");
                                            if($accountGroup){
                                            echo "<select class='form-controls' name='accountGroup' id='accountGroup'>";
                                            echo "<option selected value='$dAccountgroup'>$dAccountgroupName</option>";
                                                foreach($accountGroup as $get){
                                                    echo "<option value='$get->gid'>$get->accountgroupName</option>";
                                                }
                                            echo "</select>";
                                            }
                                        }else{
                                            echo "";
                                        }
                                     ?>
                                  
                                  
                                    <div><b>Currency Type</b></div>
                                     <?php 
                                        $currency = $this->generalmd->getdresult("*", "currencytype", "", "");
                                        if($currency){
                                            echo "<select class='form-controls' name='curencyType' id='curencyType'>";
                                             echo "<option selected value='$CurrencyType'>$CurrencyType</option>";
                                            foreach($currency as $get){
                                                echo "<option value='$get->id'>$get->name</option>";
                                            }
                                            echo "</select>";
                                        }
                                    ?>
                                    
                                
                                    <div><b>Beneficiary:</b></div>
                                     <?php
                                        if($nPayment == 1 && ($from_app_id == 8 || $from_app_id == 0)){
                                            
                                       echo "<input class='form-controls' type='text' value='$benName' id='benName' name='benName' />";
                                    
                                        }else if($nPayment == 2 && ($from_app_id == 8 || $from_app_id == 0)){
                                            $vendorName = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                            $getallvendors =  $this->maintenance->fromaintenance("*", "maintenance_workshop", "unitID", $dUnit);
                                            if($getallvendors){
                                            echo "<select readonly disable class='form-controls' name='benName' id='benName'>";
                                            echo "<option selected value='$benName'>$vendorName</option>";
                                                foreach($getallvendors as $get){
                                                    echo "<option value='$get->id'>$get->workshop_name</option>";
                                                }
                                            echo "</select>";
                                            }
                                        }else{
                                            echo "";
                                        }
                                     ?>
                                    
                                    <div><b>Comment:</b></div> 
                                    <textarea id="comment" style="height:50px" name="comment" class="form-controls"><?php echo $requesterComment; ?></textarea>
                                    
                                    <input type="hidden" value="<?php echo $nPayment; ?>" name="nPayment" id="nPayment"/>
                                    <input type="hidden" value="<?php echo $mID; ?>" name="a_requestID" id="a_requestID"/>
                                    <input type="hidden" value="<?php echo $unit; ?>" name="a_unit" id="a_unit"/>
                                    <input type="hidden" value="<?php echo $md5; ?>" name="a_md5" id="a_md5"/><hr/>
                                    <input  id="editrequest" type="submit" value="FINISH" class="btn-xs btn-primary" />
                                        
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
                                            
                                              <li>
                                                <a href="#addfiles" data-toggle="tab">
                                                    <i class="material-icons">code</i>
                                                    UPLOAD FILE
                                                    <div class="ripple-container"></div></a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div> <!-- End of card-header -->

                            

                                <div class="card-content">
                                    <div class="tab-content">


                                        <div class="tab-pane active" id="messages">

                                            <div style="color:red">Note Important!! If you want to edit and expense item, please delete the 
                                            expense item first, then re-add it for us to re-calculate your budget.</div> 

                                            <div class="card-content table-responsive">

                                                <form name="codeForm" id="codeForm" enctype="multipart/form-data" method="POST" onsubmit="return false;">
                                                <table class="table table-bordered" id="item_table">
                                                    
                                                    <tr>
                                                        <th style="width:35%">Expense Details</th>
                                                        <th style="width:20%">Amount</th>
                                                        <th style="width:25%">Expense Code</th>
                                                        <th style="width:5%">Active</th>
                                                    </tr>
                                                    <tr>
                                                        <td><textarea name="exDetailofpayment" id="exDetailofpayment" placeholder="Payment Details" class="form-controls exDetailofpayment"></textarea></td>
                                                        <td><input type="number" required name="exAmount" id="exAmount" placeholder="Amount" class="form-controls exAmount" min="0"/></td>
                                                        <td><select name="exCode" required id="exCode" placeholder="Code" class="form-controls exCode"><option value="">Select Code</option><?php echo $fillSelect; ?></select></td>
                                                        
                                                        <td>
                                                            <input type="hidden" value="<?php echo $mID; ?>" name="requestID" id="requestID"/>
                                                            <input type="hidden" value="<?php echo $unit; ?>" name="unit" id="unit"/>
                                                            <input type="hidden" value="<?php echo $md5; ?>" name="md5" id="md5"/>
                                                            <button style="cursor: pointer" type="submit" title="ADD" id="savemyass" name="savemyass" class="btn-danger btn-sm add"><i class="fa fa-save"></i></button>

                                                        </td></tr>
                                                    </tr>
                                                    
                                                </table>
                                                </form>   
                                                <!-- End of add more expense details -->
                                                <hr/>
                                                <table class="table table-responsive table-hover table-striped table-bordered" >
                                                    <thead>
                                                        <tr>
                                                            <th><b>ID</b></th>
                                                            <th><b>Expense Details</b></th>
                                                            <th><b>Code Item</b></th>
                                                            <th><b>Amount</b></th>
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
                                            </div>   
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                        <div class="tab-pane" id="addfiles">
                                            
                                           <form id="sendingAttachment" name="sendingAttachment" enctype="multipart/form-data" method="POST" onSubmit="return false;">

                                           <div class="card-content table-responsive">
                                                    <small><span style="color:red">Upload multiples files at once</span></small><br/>    
                                                    <label><span>Upload Attachment</span></label>
                                                    <input type="file" style="display:block" name="upfile[]" id="upfile[]" multiple />
                                                    
                                                    <input type="hidden" value="<?php echo $mID; ?>" name="requestID" id="arequestID"/>
                                                    <input type="hidden" value="<?php echo $unit; ?>" name="unit" id="unit"/>
                                                    <input type="hidden" value="<?php echo $md5; ?>" name="md5" id="md5"/>
                                         
                                                    <input type="submit" id="uploadingFiles" class="btn btn-danger btn-sm" value="Upload File" />
                                              
                                            </div>  
                                           </form>
                                           
                                            
                                             <hr/>
                                                <table class="table table-responsive table-hover table-striped table-bordered" >
                                                    <thead>
                                                        <tr>
                                                            <th><b>ID</b></th>
                                                            <th><b>File Name</b></th>
                                                            <th><b>Action</b></th>
                                                        </tr>
                                                    </thead>
                                                    
                                                   

                                                    <tbody id="contract_list" >
                                                        
                                                     <?php
                                                        if($all_files){
                                                            foreach($all_files as $iget){
                                                             
                                                                
                                                                ?>
                                                        
                                                         <tr>
                                                            <td><?php echo $iget->fid ?></td>
                                                            <td><a target="_blank" href="<?php echo base_url(); ?>public/documents/<?php echo $iget->origFilename; ?>"><?php echo $iget->newFilename ?></a></td>
                                                            <td><span class="fa fa-trash"></span></td>
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

                                } else if (data.status == 200) {
                                    let newHtml, html;
                                    let hplace = document.getElementById("contract_list");
                                    html = '<tr><td>%mid%</td><td>%expendetails%</td><td>%expensecode%</td><td>%amount%</td><td>%action%</td></tr>';
                                    newHtml = html.replace('%mid%', data.exID);
                                    newHtml = newHtml.replace('%expendetails%', exDetailofpayment);
                                    newHtml = newHtml.replace('%expensecode%', exCode);
                                    newHtml = newHtml.replace('%amount%', exAmount);
                                    newHtml = newHtml.replace('%action%', "<span style='cursor: pointer'  id='" + data.exID + "' class='fa fa-trash-o makeusdelete'></span>");
                                    hplace.insertAdjacentHTML('afterbegin', newHtml);
                                    toastr.success("Expense item Inserted Successfully", {timeOut: 150000});
                                     setTimeout(function () { window.location.reload(1) });
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


            
                
                
              $("#editrequest").click(function (e) {
                   var a_requestID = $('#a_requestID').val();
                   var a_unit = $('#a_unit').val();
                   var a_md5 = $('#a_md5').val();
                   
                   var ndescription = $('#ndescription').val();
                   var unitName = $('#unitName').val();
                   var hod = $('#hod').val();
                   var cashier = $('#cashier').val();
                   var accountGroup = $('#accountGroup').val();
                   var curencyType = $('#curencyType').val();
                   var benName = $('#benName').val();
                   var comment = $('#comment').val();
                 
                   var process_edit = GLOBALS.appRoot + "postrequest/edit_request_first";
                    toastr.info("Updating Request Item, Please Wait...", {timeOut: 150000});
                        $.post(process_edit, $('#pushForm').serialize(), function (data) {
                            if (data.status == 200) {
                                toastr.success("Request Successfully Updated", {timeOut: 150000});
                                 setTimeout(function () {
                                        window.top.location = GLOBALS.appRoot + "home/"
                                    }, 1000);
                            } else if (data.status == 400) {
                                toastr.error(data.msg, {timeOut: 150000});
                            }else if (data.status == 401) {
                                toastr.error(data.msg, {timeOut: 150000});
                            }
                        });
                    
                });
                


            });
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#editrequest").show();
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
        
        <script>
      $(document).ready(function () {
         $('#uploadingFiles').click(function (e) {
                    e.preventDefault();
                    var requestID = $('#requestID').val();
                    var unit = $('#unit').val();
                    
                    var dataString = new FormData(document.getElementById('sendingAttachment'));
                    if(requestID == "" || unit == "" ){
                       toastr.error('Important Variable To Process Page Missing, Contact Administrator');
                    }else{
                        
                       toastr.info('Uploading File Please Wait, Please wait...');

                        $.ajax({
                            type: "POST",
                            url: GLOBALS.appRoot + "postrequest/upoadFiles",
                            data: dataString,
                            contentType: false,
                            processData: false,
                            cache: false,
                            dataType: 'JSON',

                            success: function (data) {
                                if (data.status == 401) {
                                    toastr.error(data.msg, {timeOut: 150000});
                                } else if (data.status == 402) {
                                    toastr.error(data.msg, {timeOut: 150000});
                                }else if (data.status == 200) {
                                   toastr.success(data.msg, {timeOut: 150000});
                                   setTimeout(function () { window.location.reload(1) });
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
              });
        </script>


<?php echo $footer; ?>