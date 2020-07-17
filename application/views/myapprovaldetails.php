
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

                    <div class="col-lg-9 col-md-12">
                        <div class="card card-nav-tabs">


                            <div class="card-header" data-background-color="blue">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <span class="nav-tabs-title">Approval Details:</span>
                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                            <li class="active">
                                                <a href="#profile" data-toggle="tab">
                                                    <i class="material-icons">chrome_reader_mode</i>
                                                    Request Details
                                                    <div class="ripple-container"></div></a>
                                            </li>
                                            <li class="">
                                                <a href="#messages" data-toggle="tab">
                                                    <i class="material-icons">attachment</i>
                                                    Attachment
                                                    <div class="ripple-container"></div></a>
                                            </li>
                                            <li class="">
                                                <a href="#settings" data-toggle="tab">
                                                    <i class="material-icons">comment</i>
                                                    Approval
                                                    <div class="ripple-container"></div></a>
                                            </li>
                                            
                                            <li class="">
                                                <a href="#monthlybudget" data-toggle="tab">
                                                    <i class="material-icons">attachment</i>
                                                    Budget
                                                    <div class="ripple-container"></div></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                            <!-- BEGINNING OF TAB CONTENT -->
                            <?php
                            $cashiersid = $_SESSION['email'];
                            $adminEmail = $_SESSION['email'];

                            if ($getallresult) {

                                foreach ($getallresult as $get) {
                                    $id = $get->id;
                                    $dateCreated = $get->dateCreated;
                                    $ndescriptOfitem = $get->ndescriptOfitem;
                                    $nPayment = $get->nPayment;
                                    $approvals = $get->approvals;
                                    $hod = $get->hod;
                                    $icus = $get->icus;
                                    $cashiers = $get->cashiers;
                                    $sessionID = $get->sessionID;
                                    $dateRegistered = $get->dateRegistered;
                                    $dAmount = $get->dAmount;

                                    $dUnit = $get->dUnit;
                                    $addComment = $get->addComment;
                                    $dICUwhoapproved = $get->dICUwhoapproved;
                                    $benName = $get->benName;
                                    $benEmail = $get->benEmail;
                                    $dLocation = $get->dLocation;
                                    $addComment = $get->addComment;
                                    $refID_edited = $get->refID_edited;
                                    $dAccountgroup = $get->dAccountgroup;
                                    $partPay = $get->partPay;
                                    $apprequestID = $get->apprequestID;
                                    $from_app_id = $get->from_app_id;
                                    $dCashierwhopaid = $get->dCashierwhopaid;
                                    $requesterComment = $get->requesterComment;
                                    $userCode = $get->userCode;
                                    $CurrencyType = $get->CurrencyType;
                                    $travelID = $get->travelID;
                                    $enumType = $get->enumType;
                                    $sageRef = $get->sageRef;
                                    $hotelID = $get->hotelID;
                                    $hotelName = $get->hotelName;


                                    $newCurrency = $this->generalmd->getsinglecolumn("currencySymbol", " currencytype", "name", $CurrencyType);
                                    $defaultCurrency = $this->generalmd->getsinglecolumnwithand("currencySymbol", " currencytype", "name", $CurrencyType, 'defaultCurrency', 1);
                                    $newCurrency = $newCurrency != '' ? $newCurrency : $defaultCurrency;

                                    $newapproval = $this->generalmd->getsinglecolumn("name", " approval_type", "approval_type", $approvals);




                                    if ($partPay != "0.00" && $partPay < $dAmount) {
                                        $newpartpay = @number_format($partPay);
                                    } else {
                                        $newpartpay = @number_format($dAmount) . "NGN";
                                    }


                                    if ($from_app_id == '3') {
                                        $vendor = $this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "USER_ID", $benName);
                                    } else if ($from_app_id == '0' && is_numeric($benName)) {
                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                    } else if ($from_app_id == '0' && !is_numeric($benName)) {
                                        $vendor = $benName;
                                    } else if ($from_app_id == '5') {
                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                    } else if ($from_app_id == '6') {
                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                    } else if ($from_app_id == '8') {
                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                    } else {
                                        $vendor = $benName;
                                    }
                                } // End of for each
                            }
                            ?>

                            <form name="accessme" id="accessme" method="POST" onSubmit="return false;">
                                <div class="card-content">

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="profile">

                                            <?php
                                            if ($sageRef !== "") {
                                                echo "<div class='col-md-12'><center style='font-weight:bold; color:red; font-size:20px'>Sage Reference: $sageRef</center></div>";
                                            } else {
                                                echo "";
                                            }
                                            ?>

                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Date Created</label>
                                                    <input type="text" value="<?php echo $dateCreated; ?>"  disabled name="dateCreated" id="dateCreated" class="form-control" />
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Payee Name</label>
                                                    <input type="text" value="<?php echo $vendor; ?>"  disabled name="benName" id="benName" class="form-control" />
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Description of Item</label>
                                                    <input type="text" value="<?php echo $ndescriptOfitem; ?>"  disabled name="description" id="description" class="form-control" />
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Amount</label>
                                                    <input type="text" value="<?php echo $newCurrency ?><?php echo @number_format($dAmount, 2); ?>"  disabled name="dAmount" id="description" class="form-control" />
                                                </div>
                                            </div>


                                            <!--<div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Amount Paid</label>
                                                    <input type="text" value="<?php //echo $newpartpay;   ?>"  disabled name="payPartment" id="payPartment" class="form-control" />
                                                </div>
                                            </div>-->
                                            <?php
                                            if (is_numeric($dUnit)) {
                                                $getDepartment = $this->mainlocation->getdunit($dUnit);
                                            } else {
                                                $getDepartment = $dUnit;
                                            }
                                            ?>

                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Unit</label>
                                                    <input type="text" value="<?php echo $getDepartment; ?>"  disabled name="dUnit" id="description" class="form-control" />
                                                </div>
                                            </div> 





                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Payment Mode</label>
                                                    <input type="text" value="<?php echo $this->mainlocation->getpaymentType($nPayment); ?>"  disabled name="paymentMode" id="paymentMode" class="form-control" />
                                                </div>
                                            </div>


                                            <?php
                                            if (is_numeric($dLocation)) {
                                                $getLocale = $this->mainlocation->getdLocation($dLocation);
                                            } else {
                                                $getLocale = $dLocation;
                                            }
                                            ?>

                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Location</label>
                                                    <input type="text" value="<?php echo $getLocale; ?>"  disabled name="dLocation" id="dLocation" class="form-control" />
                                                </div>
                                            </div>

                                            <!--<div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Beneficiary Email</label>
                                                    <input type="text" value="<?php //echo $benEmail;   ?>"  disabled name="benEmail" id="benEmail" class="form-control" />
                                                </div>
                                            </div>-->

                                            <?php
                                            $getSessEmail = @$this->mainlocation->getuserSessionEmail($sessionID);
                                            if ($getSessEmail) {

                                                foreach ($getSessEmail as $get) {
                                                    $uid = $get->id;
                                                    $fname = $get->fname;
                                                    $lname = $get->lname;
                                                }
                                                $fullname = $fname . " " . $lname;
                                            }
                                            ?>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Prepared By</label>
                                                    <input type="text" value="<?php echo $fullname; ?>"  disabled name="preparedBy" id="preparedBy" class="form-control" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Cashier</label>
                                                    <input type="text" value="<?php echo $cashiers; ?>"  disabled name="dCashier" id="dCashier" class="form-control" />
                                                </div>
                                            </div>


                                            <?php
                                            $getAccountGroup = ($dAccountgroup != '' || $dAccountgroup != 'null' ) ? $this->primary->getsinglecolumn("accountgroupName", "cash_groupaccount", "gid", $dAccountgroup) :
                                                    'not applicable'
                                            ?>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Account Group</label>
                                                    <input type="text" value="<?php echo $getAccountGroup; ?>"  disabled name="accountGroup" id="accountGroup" class="form-control" />
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Comments</label
                                                    <textarea row="10" disabled name="requesterComment" id="requesterComment" class="form-control"><?php echo @$requesterComment; ?></textarea>
                                                    <!--<input type="text" value="<?php //echo @$requesterComment;   ?>"  disabled name="requesterComment" id="requesterComment" class="form-control" />-->
                                                </div>
                                            </div>


                                            <?php
                                            if ($getApprovalLevel == 6 && $nPayment == 1 && $userCode != "") {
                                                echo "<div class='col-md-12'>
                                                <div class='form-group label-floating'>
                                                    <label class='control-label'>Payment Code</label>
                                                    <input type='text' value='$userCode'  disabled name='PaymentCode' id='PaymentCode' class='form-control' />
                                                </div>
                                            </div>";
                                            }
                                            ?>


                                            <hr/>   


                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Expense Details</label>
                                                    <?php
                                                    $getexpensedetails = $this->adminmodel->getexpenseresultdetails($id);
                                                    //print_r($getexpensedetails);
                                                    if ($getexpensedetails) {
                                                        $sumAmount = 0;
                                                      
                                                        echo "<div class='card-content table-responsive'><table class='table table-responsive table-hover table-bordered'>"
                                                        . "<tr><td><b>Details</b></td><td><b>Accout Code</b></td><td><b>Amount</b></td></tr>";
                                                        foreach ($getexpensedetails as $extdetals) {
                                                            $budgetBalance = 0;
                                                            $exid = $extdetals->exid;
                                                            $requestID = $extdetals->requestID;
                                                            $ex_Details = $extdetals->ex_Details;
                                                            $ex_Amount = $extdetals->ex_Amount;
                                                            $ex_Code = $extdetals->ex_Code;
                                                            $ex_Date = $extdetals->ex_Date;
                                                            $dUnit = $extdetals->dUnit;
                                                            
                                                            $year =  date("Y", strtotime($ex_Date));
                                                            $month =  date("m", strtotime($ex_Date));
                                                            $getCodeName = $this->mainlocation->nameCode($ex_Code);
                                                            //$getBudget = $this->generalmd->monthlybudgetexpense($ex_Code, $dUnit, $month, $year);
                                                            
                                                            //$budgetExpense = $this->generalmd->monthlyexpenseperunit($ex_Code, $dUnit, $month, $year);
                                                            
                                                            //$budgetBalance = $getBudget - ($budgetExpense + $ex_Amount);
                                                            
                                                           $sumAmount += $ex_Amount;
                                                          
                                                           
                                                            echo "<tr><td>$ex_Details</td><td>$ex_Code  $getCodeName</td><td><b>" . @number_format($ex_Amount, 2) . "</b></td></tr>";
                                                        }
                                                        echo "<tr><td colspan='2'>Total Amount</td><td><b>".number_format($sumAmount, 2)."</b></td><tr></table></div>";
                                                    }
                                                    ?>

                                                    <!--/***********  TRAVEL EXPENSE FOR TRAVEL START ******************/ -->

                                                    <?php
                                                    if ($travelID !== 0 && $enumType == 'travel') {
                                                        //Use the TravelID to return Result

                                                        $getmyTravels = $this->travelmodel->gettravelexpenses($travelID);
                                                        if ($getmyTravels) {
                                                            echo "<div class='btn btn-primary'><center>TRAVEL DETAILS BREAKDOWN</center></div>";
                                                            echo "<table class='table table-responsive table-bordered'><tr><th>FROM</th><th>TO</th><th>START DATE</th><th>END DATE</th><th>PERDIEM</th><th>DAYS</th><th>TRANSPORT</th></tr>";
                                                            foreach ($getmyTravels as $trv) {
                                                                $travelStart_ID = $trv->travelStart_ID;
                                                                $tFrom = $this->mainlocation->getdLocation($trv->tFrom);
                                                                $tTo = $this->mainlocation->getdLocation($trv->tTo);
                                                                $perDiem = $trv->amount;
                                                                $Days = $trv->diff;
                                                                $sTotal = $trv->sTotal;
                                                                $amountLocal = $trv->amountLocal;
                                                                $exsDate = $trv->exsDate;
                                                                $exrDate = $trv->exrDate;
                                                                $logistics = $trv->logistics;
                                                                $purpose = $trv->purpose;

                                                                echo "<tr><td>$tFrom</td><td>$tTo</td><td>$exsDate</td><td>$exrDate</td><td>$perDiem</td><td>$Days</td><td>$amountLocal</td></tr>";
                                                            }

                                                            echo "</table>";
                                                        }
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>



                                                    <?php
                                                    ////////////////// HOTEL BREAKDOWN ////////////////////////

                                                    if ($hotelName && $hotelName != "") {
                                                        // $explodeHotelID = explode(",", $hotelID);
                                                        $explodeHotelID = $this->primary->getallmyresultingstatus("travel_hotel_bookings", "hotel_id", $hotelID);
                                                        echo "<div class='btn btn-primary'><center>HOTEL DETAILS BREAKDOWN FOR $hotelName</center></div>";
                                                        echo "<table class='table table-striped table-responsive table-bordered'><tr><th>User Name</th><th>DATE</th><th>DAYS SPENT</th><th>HOTEL AMOUNT</th><th>TOTAL</th><th>PROCESSED BY</th></tr>";
                                                        foreach ($explodeHotelID as $trv) {
                                                            $hotel_id = $trv->hotel_id;
                                                            $type = $trv->type;
                                                            $user_email = $trv->user_email;
                                                            $hotel_type = $trv->hotel_type;
                                                            $destinations = $trv->destinations;
                                                            $reasons = $trv->reasons;
                                                            $addedBy = $trv->addedBy;
                                                            $status = $trv->status;
                                                            $dateCreated = $trv->dateCreated;
                                                            $hotel_code = $trv->hotel_code;
                                                            $getHotelNameandAddress = $this->travelmodel->dHotelname($hotel_type);
                                                            $getHotelAmount = $this->travelmodel->dHotelClass($hotel_type);
                                                            $dAmount = $trv->dAmount;
                                                            $dayspent = $trv->dayspent;
                                                            $totalAmount = $trv->totalAmount;

                                                            $replaceme = str_replace("_", " - ", $destinations);
                                                            $userName = $this->generalmd->getsinglecolumn("fname", " cash_usersetup", "id", $addedBy);

                                                            echo "<tr><td>$user_email</td><td>$replaceme</td><td>$dayspent</td><td>$dAmount</td><td>$totalAmount</td><td>$userName</td></tr>";
                                                        }

                                                        echo "</table>";
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>



                                                    <?php
                                                    $getBankDetails = $this->travelmodel->gettravelresult($travelID);
                                                    if ($getBankDetails) {
                                                        foreach ($getBankDetails as $dbm) {
                                                            $eBank = $dbm->eBank;
                                                            $eAccount = $dbm->eAccount;

                                                            echo "<br/><span class='btn btn-md btn-danger'>Bank: $eBank" . ' -  ' . "      Account Number : $eAccount</span>";
                                                        }
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>

                                                    <!--/*********** END OF TRAVEL EXPENSE FOR TRAVEL START ******************/ -->

                                                    <?php
                                                    $newrandomString = random_string('alnum', 60);

                                                    if ($getApprovalLevel == 2 && is_numeric($refID_edited) && $refID_edited !== "disabled") {
                                                        echo '<center><span class="btn btn-xs btn-info"><a target="_blank" href=' . base_url() . 'archieves/closedrequest/' . $refID_edited . '/' . $newrandomString . '>View Close Request</a></span></center>';
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>
                                                </div>
                                            </div>              




                                            <?php
                                            $accgroupADMINFLOAT = $this->cashiermodel->getadminfloat() ? $this->cashiermodel->getadminfloat() : "";
                                            $getuseridfromhere = $this->gen->haveAccess($_SESSION['id'], $accgroupADMINFLOAT);

                                            if ($getApprovalLevel == 3) {
                                                echo "<div class='col-md-12'>
                                                    <div class='form-group label-floating'>
                                                    <label class='control-label'>First Level Approval</label>
                                                    
                                                      <input type='text' value='$hod'  disabled name='hodapproval' id='hodapproval' class='form-control' />
                                                    </div>
						</div>";
                                            } else if ($getApprovalLevel == 4 || $getApprovalLevel == 5 || $getApprovalLevel == 7 || $getApprovalLevel == 6 || $getuseridfromhere) {

                                                echo "<div class='col-md-12'>
                                                    <div class='form-group label-floating'>
                                                    <label class='control-label'>First Level Approval</label>
                                                    
                                                      <input type='text' value='$hod'  disabled name='hodapproval' id='hodapproval' class='form-control' />
                                                    </div>
						</div>
                                                
                                                 <div class='col-md-12'>
                                                    <div class='form-group label-floating'>
                                                    <label class='control-label'>Verified By</label>
                                                    
                                                      <input type='text' value='$dICUwhoapproved'  disabled name='icuwhoverified' id='icuwhoverified' class='form-control' />
                                                    </div>
						</div>
                                                   
                                                 <div class='col-md-12'>
                                                    <div class='form-group label-floating'>
                                                    <label class='control-label'>Paid By</label>
                                                    
                                                      <input type='text' value='$dCashierwhopaid'  disabled name='icuwhoverified' id='cashierwhopaid' class='form-control' />
                                                    </div>
						</div>";
                                            } else {
                                                echo "";
                                            }
                                            ?>





                                        </div>




                                        <div class="tab-pane" id="messages">
                                            <!---- OLD IMAGES -->
                                            <?php
//Get all the old images
                                            $oldImage = "";
                                            $getoldImages = $this->mainlocation->getoldImages($id);

                                            if ($getoldImages !== "") {

                                                $getoldimages = $this->adminmodel->getresultbaseonfileuploadID($getoldImages);
                                                if ($getoldimages) {

                                                    foreach ($getoldimages as $getold) {
                                                        $fidold = $getold->fid;
                                                        $f_requestIDold = $getold->f_requestID;
                                                        $newFilenameold = $getold->newFilename;
                                                        $oldFilenameold = $getold->origFilename;

                                                        echo $newImage = '<a target="_blank" href=' . base_url() . 'public/documents/' . $oldFilenameold . '>' . $newFilenameold . '</a><br/>';
                                                    }
                                                } else {
                                                    echo "";
                                                }
                                            }
                                            ?>

                                            <?php
                                            /*                                             * *************************FOR EXPENSE PRO ************************** */
                                            $mycustom = mycustom_url();

                                            if ($from_app_id == "0" || $from_app_id == "" || $from_app_id == "8") {

                                                $newImage = "";
                                                $getattachementid = $this->adminmodel->getresultbaseonfileuploadID($id);
                                                if ($getattachementid) {
                                                    foreach ($getattachementid as $file) {
                                                        $fid = $file->fid;
                                                        $f_requestID = $file->f_requestID;
                                                        $origFilename = $file->origFilename;
                                                        $newFilename = $file->newFilename;
                                                        $ext = $file->ext;
                                                        $mimeType = $file->mimeType;

                                                        echo $newImage = '<a target="_blank" href=' . base_url() . 'public/documents/' . $origFilename . '>' . $newFilename . '</a><br/>';
                                                    }

                                                    if ($from_app_id == '9') {
                                                        echo $AssetImage = '<a target="_blank" href="https://sys.c-ileasing.com/storage/app/public/uploads/' . $origFilename . '">' . $newFilename . '</a><br/>';
                                                    }
                                                }
                                            }

                                            /*                                             * *************************FOR END OF EXPENSE PRO ************************** */
                                            ?>

                                            <?php
                                            /*                                             * *************************FOR ASSET MANAGEMENT ************************** */
                                            $AssetImage = "";
                                            if ($from_app_id == '2' || $from_app_id == 2) {
                                                $getImageName = $this->allresult->getimagename($apprequestID);
                                                echo $AssetImage = '<a target="_blank" href="https://c-iprocure.com/assets/document/vendors/' . $getImageName . '">' . $getImageName . '</a><br/>';
                                            }
                                            ?>

                                            <?php
                                            if ($apprequestID && $from_app_id == 2) {
                                                echo "<a target ='_blank' href='" . base_url() . "/assetmgt/joborderdetails/" . @$apprequestID . "/$hod'><br/><span class='btn btn-xs btn-danger'>View History</span></a>";
                                            } else {
                                                echo "";
                                            }
                                            /*                                             * *************************FOR ASSET MANAGEMENT ************************** */
                                            ?>


                                            <?php
                                            /*                                             * *************************FOR PROCUREMENT ************************** */
                                            if ($from_app_id == "3") {

                                                $otherImages = "";
                                                //$file_url = "";
                                                $getformprocurement = $this->adminmodel->getresultbaseonfileuploadID($id);
                                                if ($getformprocurement) {
                                                    foreach ($getformprocurement as $procure) {
                                                        $pfid = $procure->fid;
                                                        $pf_requestID = $procure->f_requestID;
                                                        $porigFilename = $procure->origFilename;
                                                        $pnewFilename = $procure->newFilename;
                                                        $pext = $procure->ext;
                                                        $pmimeType = $procure->mimeType;

                                                        echo $newImage = '<a target="_blank" href="https://c-iprocure.com/scp/user_data/' . $pnewFilename . '">' . $pnewFilename . '</a><br/>';
                                                    }
                                                }
                                            }
                                            /*                                             * *************************END OF  PROCUREMENT ************************** */
                                            ?>


                                            <?php
                                            /*                                             * *********************BATCHED REQUEST FOR EXPENSE PRO ******************** */
                                            //Use the Request ID to return the Batch ID
                                            $getBatchID = $this->travelmodel->getbatchID($id);
                                            $newImageno = "";
                                            if ($getBatchID) {
                                                //Use the batchID to return the batched IDs
                                                $myBatches = $this->travelmodel->allbatchresult($getBatchID);
                                                if ($myBatches) {
                                                    foreach ($myBatches as $batchme) {
                                                        $sumFlightID = $batchme->sumlID;
                                                        $batchtype = $batchme->type;

                                                        if ($sumFlightID && $batchtype == 'flight') {
                                                            $getInFlightIds = $this->travelmodel->mybatchimages($sumFlightID);
                                                            foreach ($getInFlightIds as $imgbatch) {
                                                                $sfid = $imgbatch->sfid;
                                                                $flightID = $imgbatch->flightID;
                                                                $origName = $imgbatch->origName;
                                                                $newName = $imgbatch->newName;
                                                                $ext = $imgbatch->ext;
                                                                $mime = $imgbatch->mime;

                                                                echo $newImage = '<a target="_blank" href=' . base_url() . 'public/travels/flights/' . $newName . '>' . $origName . '</a><br/>';
                                                            }
                                                        }
                                                    }
                                                }
                                            }


                                            /*                                             * *********************BATCHED REQUEST FOR EXPENSE PRO ******************** */
                                            ?>


                                        </div>



                                        <div class="tab-pane" id="settings">


                                            <?php
                                            if ($getApprovalLevel == 1 && $hod == $_SESSION['email']) {
                                                echo "<div class='col-md-12 forcommentdisplay'>
                                                    <div class='form-group label-floating'>
                                                    <label class='control-label'>Add Comment</label>
                                                      <textarea class='form-control' name='dComment' id='dComment' cols='5' rows='5'></textarea>
                                                   </div>
						</div>";
                                            } else if ($getApprovalLevel == 2) {
                                                echo "<div class='col-md-12 forcommentdisplay'>
                                                    <div class='form-group label-floating'>
                                                    <label class='control-label'>Add Comment</label>
                                                      <textarea class='form-control' name='dComment' id='dComment' cols='5' rows='5'></textarea>
                                                   </div>
						</div>";
                                            } else if ($getApprovalLevel == 3) {
                                                echo "<div class='col-md-12'>
                                                    <div class='form-group label-floating'>
                                                    <label class='control-label'>HOD Comment</label>
                                                      <textarea class='form-control' disabled cols='5' rows='5'>$addComment</textarea>
                                                   </div>
						</div>
                                                <div class='col-md-12 forcommentdisplayforicuonly'>
                                                    <div class='form-group label-floating'>
                                                    <label class='control-label'>ICU Comment</label>
                                                      <textarea class='form-control' id='commentfromicu'  name='commentfromicu'  cols='2' rows='2'></textarea>
                                                   </div>
						</div>";
                                            } else if ($getApprovalLevel == 4 || $getApprovalLevel == 5 || $getApprovalLevel == 7 || $getApprovalLevel == 6) {
                                                echo "<div class='col-md-12'>
                                                    <div class='form-group label-floating'>
                                                    <label class='control-label'>HOD Comment</label>
                                                      <textarea class='form-control' disabled cols='5' rows='5'>$addComment</textarea>
                                                   </div>
						</div>";
                                            }
                                            ?>



                                            <?php
                                            if ($getApprovalLevel == 1 && $hod == $_SESSION['email'] && $approvals == '1') {
                                                echo "<div class='col-md-6'>
                                                    <div class='form-group label-floating'>
                                                        <input type='hidden' value='$id' name='acceptrequestID' id='acceptrequestID' />
                                                        <input type='hidden' value='$hod' name='hodEmail' id='hodEmail' />
                                                      <input type='submit'  name='processApproval' id='processApproval' value='Approve' class='btn btn-sm btn-primary' />
                                                      <span id='acceptrequest'></span>
                                                    </div>
						</div>
                                                <div class='col-md-6'>
                                                    <div class='form-group label-floating'>
                                                        <input type='hidden' value='$id' name='rejectrequestID' id='rejectrequestID' />
                                                        <input type='hidden' value='$hod' name='hodEmail' id='hodEmail' />
                                                            <span id='rejectrequest'></span>
                                                      <input type='submit' name='dorejection' id='dorejection'  value='Reject' class='btn btn-sm btn-danger' />
                                                      <input type='submit' name='processRejection' id='processRejection' value='OK' class='btn btn-sm btn-google notshowyet'/>
                                                    </div>
						</div>";
                                            } else if ($getApprovalLevel == 2 && $refID_edited != "disabed" && $approvals == '1') {

                                                echo "<div class='col-md-6'>
                                                    <div class='form-group label-floating'>
                                                        <input type='hidden' value='$id' name='acceptrequestID' id='acceptrequestID' />
                                                        <input type='hidden' value='$hod' name='hodEmail' id='hodEmail' />
                                                      <input type='submit'  name='processApproval' id='processApproval' value='Approve' class='btn btn-sm btn-primary' />
                                                      <span id='acceptrequest'></span>
                                                    </div>
						</div>
											
						<div class='col-md-6'>
                                                    <div class='form-group label-floating'>
                                                        <input type='hidden' value='$id' name='rejectrequestID' id='rejectrequestID' />
                                                        <input type='hidden' value='$hod' name='hodEmail' id='hodEmail' />
                                                            <span id='rejectrequest'></span>
                                                      <input type='submit' name='dorejection' id='dorejection'  value='Reject' class='btn btn-sm btn-danger' />
                                                      <input type='submit' name='processRejection' id='processRejection' value='OK' class='btn btn-sm btn-google notshowyet'/>
                                                    </div>
						</div>";
                                            } else if ($getApprovalLevel == 3 && $approvals == '2') {

                                                if ($from_app_id == 3) {

                                                    echo "<div class='col-md-6'>
                                                    <div class='form-group label-floating'>
                                                        <input type='hidden' value='$id' name='icuacceptrequestID' id='icuacceptrequestID' />
                                                        <input type='hidden' value='$icus' name='groupIDinICU' id='groupIDinICU' />
                                                        <input type='hidden' value='$dAmount' name='mainAmount' id='mainAmount' />
                                                            
                                                            <span id='icuacceptrequest'></span>
                                                      <center><input type='submit' id='icuprocessApproval' name='icuprocessApproval'  value='Approve Request' class='btn btn-sm btn-primary' /></center>
                                                    </div>
						</div>
                                                <div class='col-md-6'>
                                                    <div class='form-group label-floating'>
                                                        <input type='hidden' value='$id' name='icurejectrequestID' id='icurejectrequestID' />
                                                            <span id='icurejecttrequest'></span>
                                                      <center>
                                                      <input type='submit' name='icudorejection' id='icudorejection'  value='Request-Add-Info' title='Request Additional Information' class='btn btn-sm btn-danger' />
                                                      <input type='submit' id='icurejectApproval' name='icurejectApproval'  value='OK' class='btn btn-sm btn-danger notshowyet' /></center>
                                                    </div>
						</div>";
                                                } else {

                                                    echo "<div class='col-md-6'>
                                                    <div class='form-group label-floating'>
                                                        <input type='hidden' value='$id' name='icuacceptrequestID' id='icuacceptrequestID' />
                                                        <input type='hidden' value='$icus' name='groupIDinICU' id='groupIDinICU' />
                                                        <input type='hidden' value='$dAmount' name='mainAmount' id='mainAmount' />
                                                            
                                                            <span id='icuacceptrequest'></span>
                                                      <center><input type='submit' id='icuprocessApproval' name='icuprocessApproval'  value='Approve Request' class='btn btn-sm btn-primary' /></center>
                                                    </div>
						</div>
                                                <div class='col-md-6'>
                                                    <div class='form-group label-floating'>
                                                        <input type='hidden' value='$id' name='icurejectrequestID' id='icurejectrequestID' />
                                                            <span id='icurejecttrequest'></span>
                                                      <center>
                                                      <input type='submit' name='icudorejection' id='icudorejection'  value='Reject Request' class='btn btn-sm btn-danger' />
                                                      <input type='submit' id='icurejectApproval' name='icurejectApproval'  value='OK' class='btn btn-sm btn-danger notshowyet' /></center>
                                                    </div>
						</div>";
                                                }
                                            } else if ($getApprovalLevel == 4 && $approvals == '3' && $nPayment == '1') {
                                                echo "<div class='col-md-12'>
                                                    <div class='form-group label-floating'>
                                                        <input type='hidden' value='$nPayment' name='paymentTypes' id='paymentTypes' /> 
                                                        <input type='hidden' value='$id' name='cashierwhopay' id='cashierwhopay' />
                                                        <input type='hidden' value='$cashiersid' name='cashierEmailTill' id='cashierEmailTill' />
                                                            <span id='cashiererrorpay'></span>
                                                      <center>
                                                      <a href='#' data-id='$id' class='forinsurance btn btn-sm btn-danger' name='cashierpay' onClick=\"toggle_visibility('popup-box')\"> Confirm payment </a>
                                                      
                                                       </center>
                                                      
                                                    </div>
						</div>";
                                            } else if ($getApprovalLevel == 7 || $getApprovalLevel == 8 && $approvals == '3') {
                                                echo "<div class='col-md-12'>
                                                    <div class='form-group label-floating'>
                                                        <input type='hidden' value='$id' name='cashierwhopay' id='cashierwhopay' />
                                                            <span id='cashiererrorpay'></span>
                                                      <center>
                                                      <!--<a href='#' data-id='$id' class='fordaccountant btn btn-sm btn-facebook' name='cashierpay' onClick=\"toggle_visibility('popup-box')\"> Prepare Cheque and send for Signature</a>-->
                                                      <!--<a href='" . base_url() . "home/preparenewcheque/$id/$approvals/$dAccountgroup/$newrandomString' class='fordaccountant btn btn-sm btn-danger' name='fortheAccountant'> Pay Cheque</a>--></center>
                                                    </div>
						</div>";
                                            } else if ($getApprovalLevel == 6) {
                                                echo "<div class='col-md-12'>
                                                    <div class='form-group label-floating'>
                                                       <input type='hidden' value='$id' name='acceptrequestID' id='acceptrequestID' />
                                                        <input type='hidden' value='$hod' name='hodEmail' id='hodEmail' />
                                                      <!--<input type='submit'  name='adminprocessApproval' id='adminprocessApproval' value='HOD Approve' class='btn btn-sm btn-primary' />-->
                                                      <span id='acceptrequest'></span><br/>
                                                      
                                                      <!--  ICU VERIFICATION BEGINS HERE
                                                      <input type='hidden' value='$id' name='icuacceptrequestID' id='icuacceptrequestID' />
                                                        <input type='hidden' value='$icus' name='groupIDinICU' id='groupIDinICU' />
                                                        <input type='hidden' value='$dAmount' name='mainAmount' id='mainAmount' /><br/>
                                                            
                                                       <span id='icuacceptrequest'></span>
                                                      <input type='submit' id='icuprocessApprovalforadmin' name='icuprocessApprovalforadmin'  value='Verify Request' class='btn btn-sm btn-facebook' />
                                                      <br/>
                                                      -->
                                                      
                                                    </div>
						</div>";
                                            } else {
                                                echo "";
                                            }

                                            /* if($getApprovalLevel == 6){
                                              if($nPayment == '2' || $nPayment == 2){
                                              echo " <input type='hidden' value='$id' name='cashierwhopay' id='cashierwhopay' />
                                              <span id='cashiererrorpay'></span>
                                              <!--<a href='#' data-id='$id' class='fordaccountant btn btn-sm btn-danger' name='cashierpay' onClick=\"toggle_visibility('popup-box')\"> Prepare Cheque</a>-->
                                              <a href='".base_url()."home/preparenewcheque/$id/$approvals/$dAccountgroup/$newrandomString' class='fordaccountant btn btn-sm btn-danger' name='fortheAccountant'> Prepare Cheque</a>
                                              ";
                                              }else{
                                              echo "<!  MAKE PAYMENT BEGINS HERE-->
                                              <input type='hidden' value='$id' name='cashierwhopay' id='cashierwhopay' />
                                              <input type='hidden' value='$cashiersid' name='cashierEmailTill' id='cashierEmailTill' />
                                              <span id='cashiererrorpay'></span>
                                              <a href='#' data-id='$id' class='forinsuranceadmin btn btn-sm btn-danger' name='cashierpay' onClick=\"toggle_visibility('popup-box')\"> Pay Cash</a>

                                              <br/>";
                                              }
                                              }
                                             */
                                            ?>
                                            <?php
                                            if ($getApprovalLevel == 5) {
                                                echo "<br/><center><a class='btn btn-primary btn-xs' onClick='window.history.back();'>Back</a></center>";
                                            } else {
                                                echo "";
                                            }
                                            ?>

                                            <?php
                                            if ($getApprovalLevel == 4 && $approvals == '3' && $nPayment == '1') {
                                                echo "<center><a href='#' data-id='$id' class='btn btn-sm btn-info rejectPay disposebox' name='rejectPay'>Reject</a></center>";
                                            }
                                            ?>

                                        </div>
                                        
                                        
                                        
                                        <div class="tab-pane" id="monthlybudget">
                                           <?php
                                          
                                           $year = date('Y');
                                           $month = date('m');
                                           $monthName = $this->generalmd->getsinglecolumn("name", "month_in_year", "id", date('m'));
                                            echo "<h6><center>Budgeted Items for month of $monthName</center></h6>";
                                           $getBudgetResult = $this->generalmd->foryearunitmonth($year, $dUnit, $month);
                                           
                                           if($getBudgetResult){
                                               echo "<table class='table table-responsive table-bordered'><tr><th>ID</th><th>Unit</th><th>Code Name</th><th>Code Number</th><th>Budget</th><th><span style='color:red'>Expense</span></th><th>Month</th><th>Year</th></tr>";
                                               foreach($getBudgetResult as $budt){
                                                           $bugetunit = $this->generalmd->getsinglecolumn("unitName", "cash_unit", "id", $budt->unit);
                                                           $monthBudget = $this->generalmd->getsinglecolumn("name", "month_in_year", "id", $budt->month);
                                                           $monthExpense = $this->generalmd->monthlyexpenseperunit($budt->codeNumber, $budt->unit, $budt->month, $budt->year);
                                                   echo "<tr><td>$budt->unitaccountcode_id</td><td>$bugetunit</td><td>$budt->codeName</td><td>$budt->codeNumber</td><td>". @number_format($budt->amount, 2). "</td><td><span style='color:red'>". @number_format($monthExpense, 2) ."</span></td><td>$monthBudget</td><td>$budt->year</td></tr>";
                                               }
                                               
                                               echo "</table>";
                                           }
                                           ?>
                                            
                                        </div>


                                    </div>
                                </div>
                            </form>	

                            <!-- END OF TAB CONTENT -->




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



        <?php echo $footer; ?>