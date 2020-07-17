
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

                    <!-- Beginning of Request Details with Status -->

                    <div class="col-md-10 col-md-offset-1">     
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
                                            <li class="">
                                                <a href="#messages" data-toggle="tab">
                                                    <i class="material-icons">code</i>
                                                    Expense Details
                                                    <div class="ripple-container"></div></a>
                                            </li>
                                            <li class="">
                                                <a href="#settings" data-toggle="tab">
                                                    <i class="material-icons">cloud</i>
                                                    Attachment
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
                                                    <input placeholder="Date" type="text" class="form-control datepicker" name="dateCreated" id="dateCreated" />
                                                    </div>
	                                </div>
                                        
                                         <div class="col-md-8">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Title</label>
                                                    <input type="text" class="form-control" name="descItem" id="descItem" />
                                                    </div>
	                                </div>
                                        
                                        <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <!--<label class="control-label">Beneficiary Name</label>-->
                                                    <label class="control-label">Payee</label>
                                                    <input type="text" name="benName" id="benName" class="form-control">
                                                    </div>
	                                </div>
                                        
                                         <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Payee Act Number</label>
                                                    <input type="text" class="form-control" name="payeeActno" id="payeeActno" />
                                                    </div>
	                                </div>
                                      
                                        
                                        <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Payee Email</label>
                                                    <input type="email" name="benEmail" id="benEmail" class="form-control">
                                                    </div>
	                                </div>
                                        
                                        
                                         
                                        <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Comment</label>
                                                    <input type="text" class="form-control" name="dComment" id="dComment" />
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
                                        
                                         <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Select Unit</label>
                                                    <select name="dUnit" id="dUnit" class="form-control">
                                                        <option>Select Unit</option>
                                                        <?php echo $dunit; ?>
                                                    </select>
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
                                                        <option>Select Payment Method</option>
                                                        <?php echo $pay; ?>
                                                    </select>
                                                    </div>
	                                        </div>
                                        
                                       
                                        
                                         <?php 
                                                $gethod = $this->mainlocation->getallhod();
                                                
                                                 if ($gethod) { 
                                                $hod = "";
                                                foreach ($gethod as $get) {

                                                    $id = $get->id;
                                                    $email = $get->email;
                                                    $fname = $get->fname;
                                                    $lname = $get->lname;
                                                    $hod .= "<option  value=\"$email\">" . $fname." ". $lname. " >> ".$email . '</option>';
                                                     }
                                                 }
                                   
                                           ?>
                                         
                                         <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">1st Level Approval (HOD)</label>
                                                    <select name="dhod" id="dhod" class="form-control">
                                                        <option>Select HOD</option>
                                                        <?php echo $hod; ?>
                                                    </select>
                                                    </div>
	                                 </div>
                                        
                                      
                                       <?php 
                                                $geticu = $this->adminmodel->getallicugroup();

                                                if ($geticu) { 
                                                $icu = "";
                                                foreach ($geticu as $get) {

                                                    $icuid = $get->icuid;
                                                    $groupName = $get->	groupName;
                                                    $icu .= "<option  value=\"$icuid\">" . $groupName . '</option>';
                                                     }
                                                 }
                                            
                                           ?>
                                        
                                      <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">2nd Level Approval (ICU)</label>
                                                    <select name="dicu" id="dicu" class="form-control">
                                                        <option>Select ICU</option>
                                                       <?php echo $icu; ?>
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
                                                    $acc .= "<option  value=\"$email\">" . $fname." ". $lname. " >> ".$email . '</option>';
                                                     }
                                                 }
                                   
                                           ?>
                                         <div class="col-md-4" id="mycashtoremove">
                                                    <div class="form-group">
                                                    <label class="control-label">3rd Level Approval (Cashier)</label>
                                                    <select name="dcashier" id="dcashier" class="form-control">
                                                        <option value="null">Select Cashier</option>
                                                        <?php echo $acc; ?>
                                                    </select>
                                                    </div>
	                                 </div>
                                        
                                        
                                        
                                        
                                         <!---  FOR ACCOUNT BANK ALERT -->
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
                                        
                                        <div class="col-md-4" id="mychequaccout">
                                                    <div class="form-group">
                                                    <label class="control-label">3rd Level Approval (Cashier)</label>
                                                    <select name="daccountant" id="daccountant" class="form-control">
                                                        <option value="0">Select</option>
                                                        <?php echo $dnewacc ?>
                                                    </select>
                                                    </div>
	                                 </div>
                                        
                                        
                                        <!--------- END OF THE ACCOUNTANT AND THE CASHIERS ----------->
                                        
                                        
                                        
                                        
                                        
                                    </div> <!-- <div class="tab-pane active" id="profile"> -->



                                    <div class="tab-pane" id="messages">
                                      <div class="card-content table-responsive">
                                        <table class="table" id="employee_table">
                                            <b><span>Total Amount:</span> <span id="sumAmount"></span></b>
                                           <span id="suminput"></span>
                                            <tbody>
                                                <tr>
                                                    
                                                    <td>
                                                        <input type="text" name="exDetailofpayment[]" id="exDetailofpayment" placeholder="Payment Details" class="form-control"/>
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="text" name="exAmount[]" id="exAmount" placeholder="Amount" class="form-control exAmount"/>
                                                    </td>
                                                    
                                                    <td>
                                                        
                                                  
                                        
                                                        <input type="text" name="exCode[]" id="exCode" placeholder="Code" class="form-control"/>
                                                    </td>
                                                    
                                                     <td>
                                                        <input type="date" name="exDate[]" id="exDate" placeholder="Date" class="form-control"/>
                                                    </td>
                                                    
                                                    
                                                    <td class="td-actions text-right">
                                                       <button class="btn btn-xs btn-primary" onclick="add_row();">Add More</button>
                                                       <!-- <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                            <i class="material-icons">close</i>
                                                        </button>-->
                                                    </td>
                                                </tr>
                                               
                                            </tbody>
                                        </table>
                                      </div>   
                                    </div>



                                    <div class="tab-pane" id="settings">
                                        
                                        <div class="col-md-12">
                                                    <div class=""><br/>
                                                    <label><span>Upload Attachment</span></label>
                                                    <input type="file"  style="display:block" name="upload_file1" id="upload_file1" multiple />
                                                    </div>
                                            
                                                    <div id="moreImageUpload"></div>
                                                    <div style="clear:both;"></div>
                                                    <div id="moreImageUploadLink" style="display:none;">
                                                        <a href="javascript:void(0);" id="attachMore">Attach another file</a>
                                                    </div>
                                                    
	                                 </div>
                                        
                                        <div class="col-md-12">
                                              <p id="showError"></p><span id="loader"></span>
                                              <center> <input id="processingsave" type="submit" value="SAVE" class="btn btn-info" />
                                                  <input id="processnewrequestadvance" type="submit" value="SEND" class="btn btn-primary" /></center>
	                                 </div>
                                       
                                        
                                        <hr/>
                                        
                                    </div>




                                </div>
                            </div>
                        </form>

                        </div>
                    </div>
                    <!-- End of Request Details with Status -->




                    <!-- Inside Content Ends Here -->


                </div>
            </div>
        </div>
        <!-- Main Outer Content Ends  Here -->  


        <?php echo $footer; ?>