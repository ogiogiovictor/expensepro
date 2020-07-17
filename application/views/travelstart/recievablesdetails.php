
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
                                <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">FLIGHT DETAILS FOR <?php echo strtoupper($this->travelmodel->flightStaffemail($mainID)); ?> </span></span>&nbsp;<i class="fa fa-bus" aria-hidden="true"></i></h4>
                                <p class="category"> </span></p>
                            </div>


                            <div class="card-content">

                                <?php
                                if ($dDetials) {
                                    echo "<table class='table table-responsive'><tr><td><b>Date</b></td><td><b>Staff ID</b></td><td><b>Staff Name</b></td><td><b>Unit</b></td><td><b>Location</b></td></tr>";
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
                                        $CurrencyType = $get->dCurrency;
                                        $SUMAmount = $get->sTotal;

                                       if($CurrencyType == 'naira'){
                                                    $newCurrency = '<span>&#8358;</span>';
                                                }else if($CurrencyType == 'dollar'){
                                                    $newCurrency = '<span>&#x0024;</span>';
                                                }else if($CurrencyType == 'euro'){
                                                    $newCurrency = '<span>&#8364;</span>';
                                                }else if($CurrencyType == 'pounds'){
                                                    $newCurrency = '<span>&#163;</span>';
                                                }else if($CurrencyType == 'yen'){
                                                    $newCurrency = '<span>&#165;</span>';
                                                }else if($CurrencyType == 'singaporDollar'){
                                                    $newCurrency = '<span>S&#x0024;</span>';
                                                }else if($CurrencyType == 'AED'){
                                                    $newCurrency = '<span>(AED)</span>';
                                                }else if($CurrencyType == 'rupee'){
                                                    $newCurrency = '<span>&#8377;</span>';
                                                }else{
                                                   
                                                    if($CurrencyType != ""){
                                                      $newCurrency = @$this->generalmd->getsinglecolumnfromotherdb("curr_symbol", "currencies", "curr_abrev", $CurrencyType); 
                                                    }else if($CurrencyType == "null" || $CurrencyType == ""){
                                                        $newCurrency =  '<span>&#8358;</span>';
                                                    }else{
                                                        $newCurrency =  '<span>&#8358;</span>';
                                                    }
                                                    
                                                }

                                        echo "<tr><td>$dateCreated</td><td>S$staffID</td><td>$staffName</td><td>$unit</td><td><b style=''>$location</b></td></tr>";
                                    }
                                    echo "</table>";
                                } else {
                                    echo "No Result";
                                }
                                ?>
                               <hr/>
                                <center><span style="background-color:#e8eaed; font-weight: bold; font-size:18px; padding:10px">LOGISTICS COST</span></center><br/>
                                
                                    <table class="table" id="item_table" style="background-color:whitesmoke">
                                        <tr>
                                            <th style="width:1%">ID</th>
                                            <th style="width:10%">From</th>
                                            <th style="width:10%">To</th>
                                            <th style="width:8%">Start Date</th>
                                            <th style="width:8%">End Date</th>
                                            <th style="width:8%">Type</th>
                                            <th style="width:2%">Days Approved</th>
                                            <th style="width:8%">Perdeim Amount</th>
                                            <th style="width:7%">Transport</th>
                                            <th style="width:9%">Total Amount</th>

                                        </tr>
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
                                                <td>$tid</td>
                                                <td>$tFrom</td>
                                                <td>$tTo</td>
                                                <td>$exsDate</td>
                                                <td>$exrDate</td>
                                                <td>$logistics</td>
                                                <td>$diff</td>
                                                <td>$amount</td>
                                                <td>$amountLocal</td>
                                                <td>$sumeTotal</td>
                                                
                                               
                                        </tr>";
                                            }
                                            echo "<table class='table table-responsive table-bordered'>
                                         
                                     </table><br/>";
                                            ?>
                                        <?php } ?>
                                    </table>
                                
                                <hr/>
                                <?php 
                                $sumHertzAmount = "";
                                    $getResult = $this->travelmodel->hertzAmount($id);
                                    if($getResult){
                                        foreach($getResult as $h){
                                            $HertzAmount = $h->HertzAmount;
                                            if($HertzAmount){
                                                $sumHertzAmount += $HertzAmount;
                                            }
                                        }
                                    }
                                ?>
                                
                                 <?php 
                                $Ahotel = "";
                                    $getResult = $this->travelmodel->hotelCost($id);
                                    if($getResult){
                                        foreach($getResult as $h){
                                            $amountHotel = $h->hotelAmount;
                                            if($amountHotel){
                                                $Ahotel += $amountHotel;
                                            }
                                        }
                                    }
                                ?>
                                
                                <?php
                                  $flightCost = $this->travelmodel->flightCost($id);
                                  $grandTotal = $SUMAmount + $flightCost + $Ahotel + $sumHertzAmount;
                                ?>
                                <span style="background-color:#e8eaed; font-weight: bold; font-size:18px; padding:10px">SUMMARY</span><br/>
                                <br/><table class="table table-bordered table-responsive table-striped" style="width:300px">
                                    <tr>
                                        <th>Total Logistics Cost</th>
                                        <td><span style="color:red; font-weight: bold"><?php echo $newCurrency. @number_format($SUMAmount, 2); ?></span></td>
                                    </tr>
                                    <tr>
                                        <th>Flight Cost</th>
                                        <td><span style="color:red; font-weight: bold"><?php echo @number_format($flightCost, 2); ?></span></td>
                                    </tr>
                                    <tr>
                                        <th>Hotel Cost</th>
                                        <td><span style="color:red; font-weight: bold"><?php echo @number_format($Ahotel, 2); ?></span></td>
                                    </tr>
                                    <tr>
                                        <th>Hertz Cost</th>
                                        <td><span style="color:red; font-weight: bold"><?php echo @number_format($sumHertzAmount, 2); ?></span></td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Grand Total</th>
                                        <td><span style="color:red; font-weight: bold"><?php echo @number_format($grandTotal, 2); ?></span></td>
                                    </tr>
                                </table>
                                
                                <hr/>
                                 <div>ATTACHMENT </div>
                                 <?php
                                 $newImage = "";
                                 $getallattachment = $this->travelmodel->gettravelUpload($mainID);
                                 if($getallattachment){
                                     foreach($getallattachment as $travl){
                                        $imageID =  $travl->imageID;
                                        $travelID =  $travl->travelID;
                                        $origName =  $travl->origName;
                                        $newName =  $travl->newName;
                                        $ext =  $travl->ext;
                                        $mime =  $travl->mime;
                                        $status =  $travl->status;
                                        
                                       echo $newImage = '<a target="_blank" href=' . base_url() . 'public/travels/'.$staffEmail.'/' . $origName . '>' . $newName . '</a><br/>';
                                                   
                                     }
                                  }
                                 ?>
                                 <hr/>
                                 <div>FLIGHT TICKET </div>
                                 <?php
                                 $getFlight = $this->travelmodel->getFlightattachment($mainID);
                                 if($getFlight){
                                     foreach($getFlight as $FL){
                                         $sfid = $FL->sfid;
                                         $flightID = $FL->flightID;
                                         $origNameFL = $FL->origName;
                                         $newNameFL = $FL->newName;
                                         $ext = $FL->ext;
                                     echo $newImage = '<a target="_blank" href=' . base_url() . 'public/travels/flights/' . $newNameFL . '>' . $origNameFL . '</a><br/>';
                                     }
                                 }
                                 ?>
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
