
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
                                            $approvals = $this->generalmd->getsinglecolumn("name", "approval_type", "id", $get->approvals);
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
                                    
                                    <div><b>Status:</b></div>
                                    <?php echo $approvals; ?>
                                    <div style="border:1px solid lightgray; margin-top: 5px; margin-bottom: 5px"></div>
                                </div>

                            </div>

                        </div>




                    </div>



                    <!-- Inside Content Begins  Here -->

                    <!-- Beginning of Request Details with Status -->

                    <div class="col-md-4">     
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

                           
                                <div class="card-content">
                                    <div class="tab-content">


                                        <div class="tab-pane active" id="messages">

                                            <div class="card-content table-responsive">

                                                <table class="table table-responsive table-hover table-bordered" >
                                                    <thead>
                                                        <tr>
                                                            <th><b>ID</b></th>
                                                            <th><b>Expense Details</b></th>
                                                            <th><b>Code Item</b></th>
                                                            <th><b>Amount</b></th>
                                                            <th><b>Date</b></th>
                                                            
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


                                    </div>
                                </div>
                                <!--</form>-->

                        </div>

                    </div>
                    <!-- End of Request Details with Status -->




                    
                    
                    
                    <div class="col-md-4">     
                        <div class="card card-nav-tabs">

                            <div class="card-header" data-background-color="blue">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <span class="nav-tabs-title">ACTION:</span>
                                        <ul class="nav nav-tabs" data-tabs="tabs">

                                            <li class="active">
                                                <a href="#messages" data-toggle="tab">
                                                    <i class="material-icons">code</i>
                                                    UPLOAD FILE
                                                    <div class="ripple-container"></div></a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div> <!-- End of card-header -->

                            <form  id="codeFormUpload" name="codeFormUpload" enctype="multipart/form-data" method="POST" onSubmit="return false;">

                                <div class="card-content">
                                    <div class="tab-content">


                                        <div class="tab-pane active" id="messages">
                                             <div style="color:red">GOOD JOB:: Final Step!! If you have a file to upload, click on 
                                             the file upload button below and click save. If not just click finish</div> 
                                            
                                            <div class="card-content table-responsive">
                                                    <div class="">
                                                    <small><span style="color:red">Upload multiples files at onces</span></small><br/>    
                                                    <label><span>Upload Attachment</span></label>
                                                    <input type="file" style="display:block" name="upfile[]" id="upfile[]" multiple />
                                                    
                                                    <input type="hidden" value="<?php echo $mID; ?>" name="requestID" id="requestID"/>
                                                    <input type="hidden" value="<?php echo $unit; ?>" name="unit" id="unit"/>
                                                    <input type="hidden" value="<?php echo $md5; ?>" name="md5" id="md5"/>
                                         
                                                    <input type="submit" id="uploadingFiles" class="btn btn-danger btn-sm" value="Upload File" />
                                                </div>
                                            </div>   
                                        </div>
                                        
                                        
                                         <hr/>
                                                <table class="table table-responsive table-hover table-bordered" >
                                                    <thead>
                                                        <tr>
                                                            <th><b>ID</b></th>
                                                            <th><b>File Name</b></th>
                                                           
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
                                                            
                                                         </tr>
                                                        
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                       
                                                    </tbody>
                                                
                                                    
                                                </table>


                                    </div>
                                </div>
                           </form>

                        </div>

                          <div class="row">
                                <div class="col-md-12">
                                    <div id="showError"></div><span id="loader"></span>
                                    
                                    <form id="continueprocess" onsubmit="return false">
                                         <input type="hidden" value="<?php echo $mID; ?>" name="a_requestID" id="a_requestID"/>
                                         <input type="hidden" value="<?php echo $unit; ?>" name="a_unit" id="a_unit"/>
                                         <input type="hidden" value="<?php echo $md5; ?>" name="a_md5" id="a_md5"/>
                                         <input  id="finishprocess" type="submit" value="FINISH" class="btn btn-primary wpsc_buy_button" />
                                     </form>
                                   
                                  
                                </div> 
                            </div>

                    </div>
                    
                     
                    <!-- Inside Content Ends Here -->


                </div>
            </div>
        </div>
        <!-- Main Outer Content Ends  Here --> 

        <script type="text/javascript">
            $(document).ready(function () {
                
                $('#uploadingFiles').click(function (e) {
                    e.preventDefault();
                    var requestID = $('#requestID').val();
                    var unit = $('#unit').val();
                    var exAmount = $('#exAmount').val(); 
                    
                    var dataString = new FormData(document.getElementById('codeFormUpload'));
                    if(requestID == "" || unit == "" || exAmount == "" ){
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

        <script type="text/javascript">
            $(document).ready(function () {
                $("#finishprocess").show();
            });
        </script>
        
        
        <script type="text/javascript">
            $(document).ready(function () {
                 $('#finishprocess').click(function (e) {
                   var a_requestID = $('#a_requestID').val();
                   var a_unit = $('#a_unit').val();
                   var a_md5 = $('#a_md5').val();
             
                   var processforfileupload = GLOBALS.appRoot + "postrequest/finishproocess"
                   if(a_requestID == ""  || a_unit == ""){
                       toastr.success("No Unit, No Request ID Contact Administrator", {timeOut: 150000});
                    }else{
                         toastr.info("Completing Request, Please wait.....", {timeOut: 150000});
                        $.post(processforfileupload, {a_requestID: a_requestID, a_unit: a_unit, a_md5: a_md5 }, function (data) {
                            if (data.status == 200) {
                                toastr.success("Thank You. Request Successfully Completed", {timeOut: 150000});
                                setTimeout(function () {
                                        window.top.location = GLOBALS.appRoot + "home/" 
                                    }, 1000);
                            } else if (data.status == 400) {
                                toastr.error("Error Processing Request", {timeOut: 150000});
                            }
                        });
                    }
                 });
            });
        </script>
        
        
        
       

<?php echo $footer; ?>