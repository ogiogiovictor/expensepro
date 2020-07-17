
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
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">MAKE HOTEL PAYMENT PAYMENT :: EXPENSE PRO</span><i class="fa fa-bus" style="color:white" aria-hidden="true"></i></h4>
                                <p class="category"> </span></p>
                            </div>


                            <div class="card-content">
                               
                                    <?php
                                        if($getResult){
                                           
                                            foreach($getResult as $get){
                                                $rID = $get->rID; 
                                                $dateCreated = $get->dateCreated; 
                                                $requestID = $get->requestID;
                                                $title = $get->title;
                                                $currency = $get->currency;
                                                $nPayment = $get->nPayment;
                                                $approvals = $get->approvals;
                                                $paidAmount = $get->paidAmount;
                                                $retiredAmount = $get->retiredAmount;
                                                $myBalance = $get->myBalance;
                                                $hod = $get->hod;
                                                $icu = $get->icu;
                                                $dgroup = $get->dgroup;
                                                $userID = $get->userID;
                                                $userEmail = $get->userEmail;
                                                $userName = $get->userName;
                                                $dType = $get->dType;
                                                $clocation = $get->clocation;
                                                $cUnit = $get->cUnit;
                                                $icuSeen = $get->icuSeen;
                                                $dICUwhoconfirmed = $get->dICUwhoconfirmed;
                                                $dhodwhoapproves = $get->dhodwhoapproves;
                                                
                                            }
                                           
                                        }
                                        
                                        $addTitle = $title. " -  ". "(Reimbursement)";
                                    ?>
                                
                                <form name="batingpayment" id="batingpayment" method="POST" onSubmit="return false;">
                                    <div id="batchError"></div>
                                    
                                      <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <textarea readonly name="dTitle" id="dTitle" class="form-control" style="background-color:gainsboro"><?php echo $addTitle; ?></textarea>
                                            
                                            </div>
	                                </div>
                                    
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input style="background-color:gainsboro" readonly type="text" name="dDate" id="dDate" value="<?php echo $dateCreated; ?>" class="form-controls" />
                                            </div>
	                                </div>
                                    
                                   
                                     <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Beneficiary</label>
                                                <input readonly style="background-color:gainsboro" type="text" name="dBeneficiary" id="dBeneficiary" value="<?php echo $userName; ?>" class="form-controls" />
                                            </div>
	                                </div>
                                    
                                    
                                     <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input readonly style="background-color:gainsboro" type="text" name="dEmail" id="dEmail" value="<?php echo $userEmail; ?>" class="form-controls" />
                                            </div>
	                             </div>
                                    
                                    
                                    
                                     <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Paid Amount</label>
                                                    <input readonly style="background-color:gainsboro" type="text" name="dAmountPaid" id="dAmountPaid" value="<?php echo $paidAmount; ?>" class="form-controls" />
                                                </div>
                                    </div>
                                    
                                     <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Retired Amount</label>
                                                    <input readonly style="background-color:gainsboro" type="text" name="dRetiredAmount" id="dRetiredAmount" value="<?php echo $retiredAmount; ?>" class="form-controls" />
                                                </div>
                                    </div>
                                    
                                     <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Balance</label>
                                                    <input readonly style="background-color:gainsboro" type="text" name="dBalance" id="dBalance" value="<?php echo $myBalance; ?>" class="form-controls" />
                                                </div>
                                    </div>
                                    
                                    
                                      <?php
                                        /*    $getaccount = $this->adminmodel->getaccountants();

                                            if ($getaccount) {
                                                $dnewacc = "";
                                                foreach ($getaccount as $get) {

                                                    $gid = $get->gid;
                                                    $accountgroupName = $get->accountgroupName;

                                                    $dnewacc .= "<option  value=\"$gid\">" . $accountgroupName . '</option>';
                                                }
                                            }
                                         
                                         */
                                    ?>
                                    
                                   
                                      <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Verified By</label>
                                                <input readonly style="background-color:gainsboro" type="text" name="dVerified" id="dVerified" value="<?php echo $dICUwhoconfirmed; ?>" class="form-controls" />
                                            </div>
	                             </div>
                                    
                                     <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Location</label>
                                                <input type="text" readonly style="background-color:gainsboro" name="dLocation" id="dLocation" value="<?php echo $clocation; ?>" class="form-controls" />
                                            </div>
	                             </div>
                                    
                                    <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Unit</label>
                                                <input readonly style="background-color:gainsboro" type="text" name="dUnit" id="dUnit" value="<?php echo $cUnit; ?>" class="form-controls" />
                                            </div>
	                             </div>
                                    
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">
                                            Do you want a cashier to pay the specific amount
                                            if yes, select the cashier else do nothing.</div>
                                    </div>
                                    
                                  <!--  <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Account Group</label>
                                                    <select  name="daccountant" id="daccountant" class="form-controls">
                                                        <option value="0">Select</option>
                                                        <?php //echo $dnewacc ?>
                                                    </select>
                                                </div>
                                    </div> -->
                                    
                                    
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
                                    
                                    
                                     <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Cashier</label>
                                                    <select  name="dCashier" id="dCashier" class="form-controls">
                                                        <option value="">Select</option>
                                                        <?php echo $acc ?>
                                                    </select>
                                                </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="">Comment</label>
                                            <textarea class="form-control" name="dcomment" id="dcomment"></textarea>
                                         </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <span class="myError"></span>
                                        <input type="hidden" value="<?php echo $dgroup; ?>" name="daccountgroup" id="daccountgroup"/>
                                        <input type="hidden" value="<?php echo $dICUwhoconfirmed; ?>" name="dICUwhoconfirmed" id="dICUwhoconfirmed"/>
                                        <input type="hidden" value="<?php echo $dhodwhoapproves; ?>" name="myhodwhoapproves" id="myhodwhoapproves"/>
                                        <input type="hidden" value="<?php echo $rID; ?>" name="mainID" id="mainID"/>
                                         <input type="hidden" value="<?php echo $hod; ?>" name="dhod" id="dhod"/>
                                        <input type="hidden" value="<?php echo $requestID; ?>" name="dRequestID" id="dRequestID"/>
                                        <input type="hidden" value="<?php echo $icuSeen; ?>" name="icuhaseen" id="icuhaseen"/>
                                        <input type="hidden" value="<?php echo $currency; ?>" name="dCurrency" id="dCurrency"/>
                                        
                                       <center><input id="paytoexpensepronow" name="paytoexpensepronow" type="submit" value="Mark For Payment" class="btn btn-sm btn-danger"/></center> 
                                    </div>
                                    
                                
                                </form>
                                
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
         $(document).ready(function() {
            $('#hodall').DataTable( {
            dom: 'Bfrtip',
            buttons: ['excel', 'pdf']
            });
         });
         </script>
    
        <?php echo $footer; ?>
