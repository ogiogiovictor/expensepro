
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
                                <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">MAKE PAYMENT :: EXPENSE PRO</span><i class="fa fa-bus" style="color:white" aria-hidden="true"></i></h4>
                                <p class="category"> </span></p>
                            </div>


                            <div class="card-content">
                               
                                    <?php
                                        if($getResult){
                                           
                                            foreach($getResult as $get){
                                                $id = $get->id; 
                                                $batchTitle = $get->batchTitle; 
                                                $sumlID = $get->sumlID;
                                                $batchAmount = $get->batchAmount;
                                                $batchedBy = $get->batchedBy;
                                                $batchCode = $get->batchCode;
                                                $dateBatched = $get->dateBatched;
                                                $batchAmountactual = @number_format($get->batchAmount, 2);
                                                $agency = $get->agency;
                                                $flight = $get->type;
                                           
                                            }
                                           
                                        }
                                        
                                    ?>
                                
                                <form name="batingpayment" id="batingpayment" method="POST" onSubmit="return false;">
                                    <div id="batchError"></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Batched Code</label>
                                                <input style="background-color:gainsboro" readonly type="text" name="batchCode" id="batchCode" value="<?php echo $batchCode; ?>" class="form-controls" />
                                            </div>
	                                </div>
                                    
                                     <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Batched Title</label>
                                                <input readonly style="background-color:gainsboro" type="text" name="batchtitle" id="batchtitle" value="<?php echo $batchTitle; ?>" class="form-controls" />
                                            </div>
	                                </div>
                                    
                                     <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Batched Amount</label>
                                                <input readonly type="text" name="batchedAmount" id="batchedAmount" value="<?php echo $batchAmount; ?>" class="form-controls" style="background-color:gainsboro" />
                                            </div>
	                                </div>
                                    
                                    
                                     <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date Batched</label>
                                                <input readonly style="background-color:gainsboro" type="text" name="batchedDate" id="batchedDate" value="<?php echo $dateBatched; ?>" class="form-controls" />
                                            </div>
	                             </div>
                                    
                                    
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Agency</label>
                                                <input readonly style="background-color:gainsboro" type="text" name="agency" id="agency" value="<?php echo $agency; ?>" class="form-controls" />
                                            </div>
	                             </div>
                                    
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <input readonly style="background-color:gainsboro" type="text" name="flight" id="flight" value="<?php echo $flight; ?>" class="form-controls" />
                                            </div>
	                             </div>
                                    
                                    
                                     <?php
                                         /*   $gethod = $this->adminmodel->getalluserwithhodid();
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
                                          * 
                                          */
                                       ?>
                                    
                                    
                                     <!--<div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">1st Level Approval (HOD)</label>
                                                    <select class="form-control" data-style="btn-default" name="dhod" id="dhod" data-live-search="true">
                                                        <option value="">Select HOD</option>
                                                        <?php //echo $hod; ?>
                                                    </select>
                                                </div>
                                    </div> -->
                                    
                                    
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
                                    
                                     <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Select Payee</label>
                                                <select name="vendor" id="vendor" class="form-control">
                                                        <option value="">Choose Payee</option>
                                                        <?php echo $myvendors; ?>
                                                    </select>
                                            </div>
	                             </div>
                                    
                                    
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Comment</label>
                                            <textarea class="form-control" name="comment" id="comment"></textarea>
                                            </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <input type="hidden" value="<?php echo $id; ?>" name="batchedId" id="batchedId"/>
                                        <input type="hidden" value="<?php echo $sumlID; ?>" name="batchflightID" id="batchflightID"/>
                                        
                                        <center><input id="paynowbatched" name="paynowbatched" type="submit" value="Send For Payment" class="btn btn-sm btn-danger"/></center>
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
        
       
    
        <?php echo $footer; ?>
