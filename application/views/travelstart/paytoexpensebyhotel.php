
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
                                                $batchedid = $get->id; 
                                                $batchTitle = $get->batchTitle; 
                                                $sumlID = $get->sumlID;
                                                $batchAmount = $get->batchAmount;
                                                $batchedBy = $get->batchedBy;
                                                $batchCode = $get->batchCode;
                                                $dateBatched = $get->dateBatched;
                                                $batchAmountactual = @number_format($get->batchAmount, 2);
                                           
                                            }
                                           
                                        }
                                        
                                    ?>
                                
                                <form name="batingpayment" id="batingpayment" method="POST" enctype="multipart/form-data" onSubmit="return false;">
                                    <div id="batchError"></div>
                                    
                                      <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Batched Title</small></label>
                                                <textarea readonly name="batchtitle" id="batchtitle" class="form-control" style="background-color:gainsboro"><?php echo $batchTitle; ?></textarea>
                                            
                                            </div>
	                                </div>
                                    
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Batched Code</small></label>
                                                <input style="background-color:gainsboro" readonly type="text" name="batchCode" id="batchCode" value="<?php echo $batchCode; ?>" class="form-controls" />
                                            </div>
	                                </div>
                                    
                                   
                                     <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Batched Amount</small></label>
                                                <input style="background-color:gainsboro" type="text" name="batchedAmount" readonly id="batchedAmount" value="<?php echo $batchAmount; ?>" class="form-controls" />
                                            </div>
	                                </div>
                                    
                                    
                                     <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date Batched</small></label>
                                                <input readonly style="background-color:gainsboro" type="text" name="batchedDate" id="batchedDate" value="<?php echo $dateBatched; ?>" class="form-controls" />
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
                                    
                                    
                                     <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">1st Level Approval (HOD)</label>
                                                    <select class="form-control" data-style="btn-default" name="dhod" id="dhod" data-live-search="true">
                                                        <option value="">Select HOD</option>
                                                        <?php echo $hod; ?>
                                                    </select>
                                                </div>
                                    </div>
                                    
                                    
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
                                    
                                    
                                    <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Account Group</label>
                                                    <select name="daccountant" id="daccountant" class="form-control">
                                                        <option value="0">Select</option>
                                                        <?php echo $dnewacc ?>
                                                    </select>
                                                </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Select Payee</label>
                                                    <select name="vendor" id="vendor" class="form-control">
                                                        <option value="">Choose Payee</option>
                                                        <?php echo $myvendors; ?>
                                                    </select>
                                                    <!--<input type="text" class="form-control" name="benName" id="benName" />-->
                                                </div>
                                     </div>
                                    
                                    
                                    <?php
                                          $getCurrencies = $this->generalmd->getdresultfromprocure("*", "currencies", "", "");  
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
                                    
                                      <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Currency Type</label>
                                                    <select name="dCurrencyType" id="dCurrencyType" class="form-control">
                                                        <option value="NGN">Select</option>
                                                        <?php echo $allcurrency; ?>
                                                    </select>
                                                </div>
                                            </div>
                                    
                                    
                                     <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Select Code</label>
                                                    <select name="expenseCode" id="vendor" class="form-control">
                                                        <option value="">Choose Expense Code</option>
                                                        <?php echo $accountCode; ?>
                                                    </select>
                                                    <!--<input type="text" class="form-control" name="benName" id="benName" />-->
                                                </div>
                                     </div>
                                    
                                    
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Comment</label>
                                            <textarea class="form-control" name="comment" id="comment"></textarea>
                                            </div>
                                    </div>
                                    
                                    
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Upload Document</label>
                                            <input type="file" style="display:block" name="upfile[]" id="upfile[]" multiple />
                                            </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                          <input type="hidden" value="<?php echo $sumlID; ?>" name="sumID" id="sumID"/>
                                        <input type="hidden" value="<?php echo $doexplode; ?>" name="doexplode" id="doexplode"/>
                                        <input type="hidden" value="<?php echo $getHotelName; ?>" name="getHotelName" id="getHotelName"/>
                                        
                                        
                                        <input type="hidden" value="<?php echo $batchedid; ?>" name="batchedId" id="batchedId"/>
                                        <center><input id="paynowbatched" name="paynowbatched" type="submit" value="Send For Approval" class="btn btn-sm btn-danger"/></center>
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
