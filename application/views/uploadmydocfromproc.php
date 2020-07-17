
	<div class="wrapper">
	    <div class="sidebar" data-color="blue" data-image="<?php echo base_url(); ?>assets/img/sidebar-1.jpg">

			<!--
		        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
                        colors : #113c7f, #5e82bb
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


                            <?php
                            $cashiersid = $_SESSION['email'];
                            $adminEmail = $_SESSION['email'];
                            
                            if ($getallresult) {
                                $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
                                foreach ($getallresult as $get) {
                                    $mainid = $get->id;
                                    $dateCreated = $get->dateCreated;
                                    $ndescriptOfitem = $get->ndescriptOfitem;
                                    $nPayment = $get->nPayment;
                                    $approvals = $get->approvals;
                                    $dhod = $get->hod;
                                    $icus = $get->icus;
                                    $cashiers = $get->cashiers;
                                    $sessionID = $get->sessionID;
                                    $dateRegistered = $get->dateRegistered;
                                    $dAmount = $get->dAmount;
                                    $dLocation = $get->dLocation;
                                    $dUnit = $get->dUnit;
                                    $addComment = $get->addComment;
                                    $dICUwhoapproved = $get->dICUwhoapproved;
                                    $benName = $get->benName;
                                    $benEmail = $get->benEmail;
                                    $dLocation = $get->dLocation;
                                    $requesterComment = $get->requesterComment;
                                    $refID_edited = $get->refID_edited;
                                    $dAccountgroup = $get->dAccountgroup;
                                    $partPay = $get->partPay;
                                    $hodwhoapprove = $get->hodwhoapprove;
                                    $hodwhoreject = $get->hodwhoreject;
                                    $dICUwhorejectedrequest = $get->dICUwhorejectedrequest;
                                    $dCashierwhopaid = $get->dCashierwhopaid;
                                    $dCashierwhorejected = $get->dCashierwhorejected;
                                    $apprequestID = $get->apprequestID;
                                    $from_app_id = $get->from_app_id;
                                                
                                    if($partPay !="" && $partPay < $dAmount){
                                      $newpartpay =  @number_format($partPay);
                                    }else{
                                      $newpartpay = @number_format($dAmount)."NGN";
                                    }	
                                    if($nPayment == 1){
                                        $value = "Petty Cash";
                                        $newbutton = "<option value='$nPayment'>$value</option>";
                                    }else{
                                        $value = "Cheque Requistion";
                                        $newbutton = "<option value='$nPayment'>$value</option>";
                                    }
                                    
                                   
                                    
                                     $vendor = is_numeric($benName) ? $this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "id", $benName) : $benName; 
                                } // End of for each
                            }
                            ?>
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
                                                    Request Details : UPLOAD YOUR DOCUMENT
                                                    <div class="ripple-container"></div></a>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </div>
                            </div> <!-- End of card-header -->

                          
                            <div class="card-content">
                                <div class="tab-content">

                                    <div class="tab-pane active" id="profile">
                                        
                                      
                                        
                                        <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <!--<label class="control-label">Date</label>-->
                                                    <input placeholder="Date" type="text" class="form-control datepicker" value="<?php echo $dateCreated; ?>" disabled />
                                                    </div>
	                                </div>
                                        
                                         <div class="col-md-8">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Title</label>
                                                    <input type="text" class="form-control" value="<?php echo $ndescriptOfitem; ?>" disabled/>
                                                    </div>
	                                </div>
                                        
                                        
                                        <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label class="control-label">Payee Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $vendor; ?>" disabled  />
                                                    </div>
	                                </div>
                                        
                                        <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label class="control-label">Prepared By</label>
                                                    <input type="text" class="form-control" value="<?php echo $sessionID; ?>" disabled  />
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
                                        
                                         <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label class="control-label">Amount </label>
                                                     <input type="text" class="form-control" value="<?php echo @number_format($dAmount, 2); ?>" disabled  />
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
                                             <div class="col-md-3">
                                                    <div class="form-group">
                                                    <label class="control-label">Payment Method</label>
                                                    <select disabled name="paymentType" id="paymentType" class="form-control">
                                                        <?php echo $newbutton; ?>
                                                        <?php echo $pay; ?>
                                                    </select>
                                                    </div>
	                                        </div>
                                        
                                        
                                        
                                        
                                       
                                      
                                     
                                      
                                        
                                        
                                        <<div class="col-md-12">
                                           <div style="font-size:20px; font-weight: bolder">Upload Attachment</div>
                                           <h6><spn style="color:red">After Uploading Your Document, Send Request Back To ICU</span></h6>
                                       <form  id="uploadForm" name="uploadForm" enctype="multipart/form-data" method="POST" onSubmit="return false;">

                                               <input type="file" style="display:block" name="upfile[]" id="upfile[]" multiple /><br/>
                                               <input type="hidden" value="<?php echo $mainid; ?>" name="fileIDupload" id="fileIDupload" />
                                               <input  class="btn btn-xs btn-danger" type="submit" value="upload File" id="pushforupload">
                                               <br/><br/>
                                               <?php
                                               if($approvals == 15){
                                                 echo "<input  class='btn btn-xs btn-primary' type='submit' name='sendtoicu' id='sendtoicu' value='Send To ICU' />";  
                                               }
                                               ?>
                                               
                                           </form>
                                           
                                       </div>
                                        
                                        
                                    </div> <!-- <div class="tab-pane active" id="profile"> -->

                                    
                                    
                                    


                                </div>
                            </div>
                        <!--</form>-->

                        </div>
                        
                      
             
                         
                    </div>
                    <!-- End of Request Details with Status -->

                   


                    <!-- Inside Content Ends Here -->


                </div>
                        
                        
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                
                
                
   <?php echo $footer; ?>
 
 
<script type="text/javascript">
   $(document).ready(function () {
                
                $('#pushforupload').click(function (e) {
                    e.preventDefault();
                    var requestID = $('#fileIDupload').val();
                    //alert(requestID);
                    var dataString = new FormData(document.getElementById('uploadForm'));
                   
                    if(requestID == "" ){
                       toastr.error('Important Variable To Process Page Missing, Contact Administrator');
                    }else{
                        
                       toastr.info('Uploading File Please Wait, Please wait...');

                        $.ajax({
                            type: "POST",
                            url: GLOBALS.appRoot + "draft/upoadFiles",
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
                
                
                
////////////////////////////////////////////////////////// SUBMIT REQUEST TO ICU //////////////////////////////////////////////
  $('#sendtoicu').click(function (e) {
                    e.preventDefault();
                    var requestID = $('#fileIDupload').val();
                    var dataString = new FormData(document.getElementById('uploadForm'));
                   
                    if(requestID === "" ){
                       toastr.error('Important Variable To Process Page Missing, Contact Administrator');
                    }else{
                        
                       toastr.info('Sending Request To ICU, Please wait...');

                        $.ajax({
                            type: "POST",
                            url: GLOBALS.appRoot + "draft/sendtoicu",
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
                                   setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/index/"} , 100);
                                  
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