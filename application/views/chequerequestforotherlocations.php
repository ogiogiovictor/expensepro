<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="<?php echo base_url(); ?>assets/img/sidebar-1.jpg">

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

                    <!-- Beginning of Request Details with Status -->

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title">PAY CHEQUE</h4> 

<!--<a href="<?php echo base_url(); ?>"><div class="pull-right">Back</div></a>-->

                                <p class="category">Cheque processing platform <br/>
                                    <a href="<?php echo base_url(); ?>paycheques/mytransaction" class="btn btn-sm btn-pinterest">View Transactions</a>

                                </p>

                            </div>


                            <div class="card-content table-responsive">
                                <table class="table table-condensed table-hover" id="mychequerequest">
                                    <thead class="text-primary">
                                    <th>ID</th>
                                    <th>Date Created</th>
                                    <th>Requester</th>
                                    <th style="width:150px">Description of Item</th>
                                    <!--<th>Location</th>-->
                                    <th>Unit</th>
                                    <th>Beneficiary</th>
                                    <th>Amount</th>


                                    <th style="width:250px">&nbsp;</th>
                                    </thead>
                                    <tbody>

                                        <?php if ($getallresult) { ?>


                                            <?php
                                            foreach ($getallresult as $get) {
                                                $id = $get->id;
                                                $md5_id = $get->md5_id;
                                                $dateCreated = $get->dateCreated;
                                                $ndescriptOfitem = $get->ndescriptOfitem;
                                                $nPayment = $this->mainlocation->getpaymentType($get->nPayment);
                                                $approvals = $get->approvals;
                                                $hod = $get->hod;
                                                $icus = $get->icus;
                                                $cashiers = $get->cashiers;
                                                $sessionID = $get->sessionID;
                                                $dateRegistered = $get->dateRegistered;
                                                $dAmount = $get->dAmount;
                                                $dLocation = $get->dLocation;
                                                $addComment = $get->addComment;
                                                $dCashierwhopaid = $get->dCashierwhopaid;
                                                $dUnit = $get->dUnit;
                                                $partPay = $get->partPay;
                                                $benName = $get->benName;
                                                $fullname = $get->fullname;
                                                $nPaymentType = $get->nPayment;
                                                $sageRef = $get->sageRef;
                                                $CurrencyType = $get->CurrencyType;
                                                $from_app_id = $get->from_app_id;
                                                
                                                

                                                $getpaidTo = $this->datatablemodels->getpaidTo($id) != '' ? $this->datatablemodels->getpaidTo($id) : $benName;
                                                $sageRef = $sageRef != '' ? "<small style='color:red'>($sageRef)</small>" : '';

                                                  if($from_app_id == '3'){
                                                    $vendor = $this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "USER_ID", $benName);
                                                    }else if($from_app_id == '0' && is_numeric($benName)){
                                                          $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($from_app_id == '0' && !is_numeric($benName)){
                                                         $vendor =  $benName;
                                                    }else if($from_app_id == '5'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($from_app_id == '6'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($from_app_id == '8'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else{
                                                        $vendor =  $benName;
                                                    }
                                                    

                                                if ($CurrencyType == 'naira') {
                                                    $newCurrency = '<span>&#8358;</span>';
                                                } else if ($CurrencyType == 'dollar') {
                                                    $newCurrency = '<span>&#x0024;</span>';
                                                } else if ($CurrencyType == 'euro') {
                                                    $newCurrency = '<span>&#8364;</span>';
                                                } else if ($CurrencyType == 'pounds') {
                                                    $newCurrency = '<span>&#163;</span>';
                                                } else if ($CurrencyType == 'yen') {
                                                    $newCurrency = '<span>&#165;</span>';
                                                } else if ($CurrencyType == 'singaporDollar') {
                                                    $newCurrency = '<span>S&#x0024;</span>';
                                                } else if ($CurrencyType == 'AED') {
                                                    $newCurrency = '<span>(AED)</span>';
                                                } else if ($CurrencyType == 'rupee') {
                                                    $newCurrency = '<span>&#8377;</span>';
                                                } else {

                                                    if ($CurrencyType != "") {
                                                        $newCurrency = @$this->generalmd->getsinglecolumnfromotherdb("curr_symbol", "currencies", "curr_abrev", $CurrencyType);
                                                    } else if ($CurrencyType == "null" || $CurrencyType == "") {
                                                        $newCurrency = '<span>&#8358;</span>';
                                                    } else {
                                                        $newCurrency = '<span>&#8358;</span>';
                                                    }
                                                }
                                                ?>
                                                <?php
                                                $newrandomString = random_string('alnum', 20);
                                                ?>


                                                <tr>
                                                    <td><?php echo $id; ?></td>
                                                    <td><?php echo $dateCreated; ?></td>
                                                    <td><?php echo $fullname; ?></td>
                                                    <td style="width:250px"><a href=""><?php echo $ndescriptOfitem ?></a>
                                                        <br/><?php echo $sageRef; ?>
                                                    </td>
                                                   <!-- <td>
        <?php
        /* if(is_numeric($dLocation)){
          echo $this->mainlocation->getdLocation($dLocation);
          }else{
          echo $dLocation;
          } */
        ?>
                                                    </td>-->
                                                    <td><?php
                                                    if (is_numeric($dUnit)) {
                                                        echo $this->mainlocation->getdunit($dUnit);
                                                    } else {
                                                        echo $dUnit;
                                                    }
                                                    ?></td>
                                                    <td><?php echo $vendor; ?></td>
                                                    <td><?php echo $CurrencyType . @number_format($dAmount, 2); ?></td>

                                                    <td> <?php
                                                $randomString = random_string('alnum', 60);
                                                ?>

                                                        <a href="<?php echo base_url(); ?>paycheques/preparecheque/<?php echo $id; ?>/<?php echo $md5_id; ?>/<?php echo $approvals; ?>/<?php echo $randomString; ?>" title='Approve' class='btn btn-xs btn-success'><i class='material-icons'>check</i></a>

                                                        <?php
                                                        if ($approvals == '3' && $nPaymentType == '2') {
                                                            echo "<a href='#' data-id='$id' class='btn btn-xs btn-info rejectPay disposebox' name='rejectPay'>X</a>";
                                                        }
                                                        ?>

                                                        <?php
                                                        if ($approvals !== '4') {
                                                            echo "<a title='view' href='" . base_url() . "home/approvaldetails/$id/$md5_id/$approvals/$randomString'><span class='btn btn-xs btn-google'><i class='material-icons'>insert_drive_file</i></span></a>";
                                                        } else {
                                                            echo "";
                                                        }
                                                        ?>
                                                        <span title='print' class='btn btn-xs btn-default' onClick="printchequerequests(<?php echo $id; ?>)"><i class='material-icons'>print</i></span>
                                                        <a title='Change Location of Payment' href="<?php echo base_url(); ?>location/changelocation/<?php echo $id; ?>/<?php echo $newrandomString; ?>"><span class='btn btn-xs btn-primary'><i class='material-icons'>edit_location</i></span></a>


                                                    </td>
                                                        <?php
                                                        //if($approvals !== '5'){
                                                        //echo "<td><a href='".base_url()."'home/approvaldetails/$id/$newrandomString/$ndescriptOfitem'><span class='btn btn-xs btn-facebook'>View</span></a></td>";
                                                        //}
                                                        ?>
                                                </tr>

                                                <?php } ?>

                                            <?php } ?>	

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <!-- End of Request Details with Status -->



                    <!-- POP UP BOX HERE -->
                    <div id="popup-box" class="popup-position">
                        <div id="popup-wrapper">
                            <div id="popup-container">
                                <span class="pull-right"><a href="javascript:void(0)" onClick="toggle_visibility('popup-box');">close</a></span>

                                <span id="eloaddformerror"></span>
                                <span id="putoption"></span>
                            </div>
                        </div>
                    </div>
                    <!-- END OF POP UP BOX -->

                    <div id="disposebox">
                        <p id="myacctputalert"></p>
                    </div> 



                    <!-- Inside Content Ends Here -->


                </div>
            </div>
        </div>
        <!-- Main Outer Content Ends  Here -->  

        <script>
            $(document).ready(function () {
                var table = $('#mychequerequest');
                var oTable = table.DataTable({
                    "order": [[0, "desc"]]

                });



            });
        </script>         

<?php echo $footer; ?>