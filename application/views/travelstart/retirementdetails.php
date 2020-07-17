
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


                    <!-- Inside Content Begins  Here -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">FLIGHT DETAILS FOR <?php echo strtoupper($staffName); ?> :: PENDING RETIREMENT</span></span>&nbsp;<i class="fa fa-bus" aria-hidden="true"></i></h4>
                                <p class="category"> </span></p>
                            </div>


                            <div class="card-content">

                                <?php
                                if ($dDetials) {
                                    echo "<table class='table table-responsive'><tr><td><b>Date</b></td><td><b>Staff ID</b></td><td><b>Staff Name</b></td><td><b>Unit</b></td><td><b>Total Amount</b></td></tr>";
                                    foreach ($dDetials as $get) {
                                        $id = $get->id;
                                        $dateCreated = $get->dateCreated;
                                        $staffID = $get->staffID;
                                        $csrf = $get->csrf;
                                        $staffName = $get->staffName;
                                        $staffEmail = $get->staffEmail;
                                        $location = $get->location;
                                        $unit = $get->unit;
                                        $paymentType = $this->mainlocation->getpaymentType($get->paymentType);
                                        $sTotal = @number_format($get->sTotal, 2);
                                        $approval = $get->approval;
                                        $preparedBy = $get->preparedBy;
                                        $sReimbursement = $get->sReimbursement;
                                        $dCurrency = $get->dCurrency;
                                        $SUMAmount = $get->sTotal;
                                        $hodEmail = $get->hodEmail;

                                        if ($dCurrency == 'naira' || $dCurrency == 'NGN') {
                                            $newCurr = '&#8358;';
                                        }else{
                                            $newCurr = '';
                                        }

                                        echo "<tr><td>$dateCreated</td><td>S$staffID</td><td>$staffName</td><td>$unit</td><td><b style='color:red'>$newCurr$sTotal</b></td></tr>";
                                    }
                                    echo "</table>";
                                } else {
                                    echo "No Result";
                                }
                                ?>
                                <hr/>
                                <center><span style="background-color:#e8eaed; font-weight: bold; font-size:18px; padding:10px">RETIREMENT BREAKDOWN</span></center><br/>
                                <form id="retireX" name="retireX" enctype="multipart/form-data" method="POST" onSubmit="return false;">
                                    <table class="table" id="item_table">
                                        <tr>
                                            <th style="width:1%">&nbsp;</th>
                                            <th style="width:10%">From</th>
                                            <th style="width:10%">To</th>
                                            <th style="width:8%">Start Date</th>
                                            <th style="width:8%">End Date</th>
                                            <th style="width:8%">Type</th>
                                            <th style="width:2%">Days Approved</th>
                                            <th style="width:8%">Perdeim Amount</th>
                                            <th style="width:7%">Transport</th>
                                            <th style="width:9%">Total Amount</th>
                                            <th style="width:4%">Days Spent</th>
                                            <th style="width:7%">Amount Spent</th>

                                        </tr>
                                         <?php
                                            $getaccount = $this->adminmodel->getaccountants();

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
                                         /*   $getcashier = $this->mainlocation->getallaccount();

                                            if ($getcashier) {
                                                $acc = "";
                                                foreach ($getcashier as $get) {

                                                    $id = $get->id;
                                                    $email = $get->email;
                                                    $fname = $get->fname;
                                                    $lname = $get->lname;
                                                    $acc .= "<option  value=\"$email\">$email</option>";
                                                    //$acc .= "<option  value=\"$email\">" . $fname . " " . $lname . " - " . $email . "</option>";
                                                }
                                            }
                                          
                                          */
                                            ?>
                                        
                                        
                                        <?php
                                        $sumeTotal = 0;
                                        $getravelexpense = $this->travelmodel->gettravelexpenses($id);
                                        if ($getravelexpense) {
                                            foreach ($getravelexpense as $tr) {
                                                $tid = $tr->tid;
                                                $travelStart_ID = $tr->travelStart_ID;
                                                $tFrom = $this->mainlocation->getdLocation($tr->tFrom);
                                                $tTo = $this->mainlocation->getdLocation($tr->tTo);
                                                $amount = $tr->amount;
                                                $amountLocal = $tr->amountLocal;
                                                $exsDate = $tr->exsDate;
                                                $exrDate = $tr->exrDate;
                                                $logistics = $tr->logistics;
                                                $purpose = $tr->purpose;
                                                $diff = $tr->diff;
                                                $sTotal = $tr->sTotal;
                                                $allHotels = $this->travelmodel->getallhotels();

                                                $sumeTotal = $sTotal + $amountLocal;

                                                echo "<tr>
                                                <td>
                                                <input type='hidden' name='tid[]' id='tid' value='$tid' class='form-controls'/>
                                                </td>
                                                <td>
                                                <input style='background-color:#eff0f2' type='text' readonly name='tFrom[]' id='tFrom' value='$tFrom' class='form-controls'/>
                                                </td>
                                                <td>
                                                <input type='text' style='background-color:#eff0f2' readonly name='tTo[]' id='tTo' value='$tTo' class='form-controls'/>
                                                </td>
                                                </td>
                                                <td>
                                                <input type='text' style='background-color:#eff0f2' readonly name='exsDate[]' id='exsDate' value='$exsDate' class='form-controls'/>
                                                </td>
                                                <td>
                                                <input type='text' style='background-color:#eff0f2' readonly name='exrDate[]' id='exrDate' value='$exrDate' class='form-controls'/>
                                                </td>
                                                
                                                
                                                <td>
                                                <input type='text' style='background-color:#eff0f2' readonly name='logistics[]' id='logistics' value='$logistics' class='form-controls logistics'/>
                                                </td>
                                                
                                                <td>
                                                <input type='text' style='background-color:#eff0f2' readonly name='diff[]' id='diff' value='$diff' class='form-controls'/>
                                                </td>
                                                
                                                <td>
                                                <input type='text' readonly style='background-color:#eff0f2' name='amount[]' id='amount' value='$amount' class='form-controls'/>
                                                </td>
                                                <td>
                                                <input type='text' readonly style='background-color:#eff0f2' name='transportLocal[]' id='transportLocal' value='$amountLocal' class='form-controls'/>
                                                </td>
                                                <td>
                                                <input type='text' readonly style='background-color:#eff0f2' name='sumTotal[]' id='sumTotal' value='$sumeTotal' class='form-controls'/>
                                                </td>
                                                <td>
                                                <input type='text' name='daysActual[]' id='daysActual' value='' class='form-controls'/>
                                                </td>
                                                <td>
                                                <input type='text' name='amountSpent[]' id='amountSpent' value='' class='form-controls exAmount'/>
                                                </td>
                                               
                                        </tr>";
                                            }
                                            echo "<table class='table table-responsive table-bordered'>
                                         <tr>
                                         
                                          <td>
                                          
                                          <b><span>Upload Attachment</b> 
                                          <input type='file' name='fileUpload[]' id='fileUpload' multiple/>
                                          </td>
                                          
                                          <td>
                                          
                                          <table>
                                           <tr>
                                           <td colspan='2'><b><span>How do you want to be paid<br/>(only if you have a balance)</b></td>
                                           </tr>
                                           
                                            <tr>
                                            <td>  
                                         <select name='daccountant' id='daccountant' class='form-control'>
                                              <option value='0'>Select</option>
                                              $dnewacc
                                           </select>
                                           </td>
                                           
                                            <td>
                                           &nbsp;
                                            </td>
                                            </tr>
                                          </table>
                                         
                                           

                                          </td>
                                          
                                          <td class='pull-right'>
                                          
                                          <b><span>Total Retirement:</b> </span> <span id='sumAmount'></span> 
                                          <div id='suminput'></div>
                                          </td>
                                         </tr>
                                     </table><br/>
                                     <input type='hidden' id='mainID' name='mainID' value='$id' />
                                     <input type='hidden' id='myhodallowed' name='myhodallowed' value='$hodEmail' />
                                    
                                     <div id='travelError'></div><span id='flyError'></span>       
                                     <center><button class='btn btn-sm btn-danger smallbutton' id='retiremycash'>RETIRE</button></center>";
                                            ?>
                                        <?php } ?>
                                    </table></form>
                            </div>
                        </div>
                    </div>

                    <!-- End of Request Details with Status -->

                    <!-- Inside Content Ends Here -->


                </div>


            </div>
        </div>
        <!-- Main Outer Content Ends  Here --> 
        <script>
            $(document).ready(function () {

                /*************************************CASH RETIREMENT ******************************************/
                $('#retiremycash').click(function () {
                    var mainID = $('#mainID').val();
                    var tid = $('#tid').val();
                    var daysActual = $('#daysActual').val();
                    var amountSpent = $('#amountSpent').val();
                    var sumTotal = $('#sumTotal').val();
                    var sumall = $('#sumall').val();
                    var daccountant = $('#daccountant').val();
                    var myhodallowed = $('#myhodallowed').val();
                    
                    //var mainTotalAmount = $('#totalAmount').val();
                    alert("Your Total Retirement is " + sumall);
                    var dataString = new FormData(document.getElementById('retireX')); //postArticles
                    //alert(mainID);
                    if(mainID == "" || tid == "" || amountSpent == ""){
                        alert("Please enter an amount");
                    }else{
                         $('#flyError').html("Processing Request, Please Wait.....");
                        $.ajax({
                        type: "POST",
                        url: GLOBALS.appRoot + "travelstart/reimbursementrequest",
                        processData: false,
                        cache: false,
                        contentType: false,
                        data: dataString,
                        dataType: "json",
                        timeout: 600000,
                        success: function (data) {
                             if (data.status === 1) {
                                    $('#retiremycash').attr('disabled', true);
                                    $('#flyError').html(data.msg);
                                     setTimeout(function () {
                                        window.top.location = GLOBALS.appRoot + "travels/xdmds_xn/"
                                    }, 100);
                                } else if (data.status === 0) {
                                    $('#retiremycash').attr('disabled', false);
                                    $('#flyError').html(data.msg).addClass('errorRed');
                                } 
                        },
                        error: function () {
                            $('#flyError').html("Error Processing Request, Please Try Again..");
                            $('#retiremycash').attr('disabled', false);
                        }
                    });
                       
                        
                    } 
                    
                    //retireX -- FORM NAME
                });



                /*************************************CASH RETIREMENT ******************************************/

            });
        </script>                 
        <?php echo $footer; ?>
