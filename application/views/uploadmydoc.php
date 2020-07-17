  <!-- Jquery filer css -->
    <link href="<?php echo base_url(); ?>public/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>public/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

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

                        <form name="mainrequestformadvanceform" id="mainrequestformadvanceform" enctype="multipart/form-data" method="POST" onSubmit="return false;">
	                     :    
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
                                        
                                        
                                        
                                        
                                       
                                      
                                     
                                      
                                        
                                        
                                        <!--<div class="col-md-12">
                                           <div style="font-size:20px; font-weight: bolder">Upload Attachment</div>
                                           <h6><spn style="color:red">Please make sure your document has no spaces or special characters
                                                   if not the document will not be uploaded</span></h6>
                                           <form id="upload_form" enctype="multipart/form-data" method="post">
                                               <input type="file" name="file1" id="file1"><br/>
                                               <input type="hidden" value="<?php echo $mainid; ?>" name="fileIDupload" id="fileIDupload" />
                                               <input  class="btn btn-xs btn-danger" type="button" value="upload File" onclick="uploadFile('<?php echo $mainid; ?>')">
                                               <progress id="progressBar" value="0" max="100" style="width: 300px"></progress>
                                               <h3 id="status"></h3>
                                               <p id="loaded_n_total"></p>
                                           </form>
                                       </div>-->
                                        
                                        
                                      <div class="col-md-12">
                                          <form id="upload_form" enctype="multipart/form-data" method="post"> 
                                            <div class="p-20">
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-12 padding-left-0 padding-right-0">
                                                     <input type="file" name="files[]" id="filer_input1" multiple="multiple">
                                           <input type="hidden" name="uploadid" class="uploadid" id="uploadid" value="<?php echo $mainid; ?>" />
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                      </div>
                                        
                                     
                                      
                                    
                                        
                                        
                                    </div> <!-- <div class="tab-pane active" id="profile"> -->

                                    
                                    
                                    


                                </div>
                            </div>
                        <!--</form>-->

                        </div>
                        
                      
                </form>
                         
                    </div>
                    <!-- End of Request Details with Status -->

                   


                    <!-- Inside Content Ends Here -->


                </div>
                        
                        
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                
                
                
   <?php echo $footer; ?>
  
 <!-- Jquery filer js -->
  <script src="<?php echo base_url(); ?>public/assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/plugins/jquery.filer/js/jquery.filer.min.js"></script>
  <!-- page specific js -->
 <script src="<?php echo base_url(); ?>public/assets/pages/jquery.fileuploads.init.js"></script>
 
 
<script type="text/javascript">
    function _(el){
       return document.getElementById(el);
    }
    
    function uploadFile(id){
        //var file = _("file1").files[0];
        var file = _("file1").files[0];
        var fileIDupload = id;
        //alert(fileIDupload);
        //return;
       // var fileIDupload = _("fileIDupload").val();
        //alert(file.name + " | " + file.size+ " | " + file.type);
        //alert(fileIDupload);
       // return;
      /* if(file.type){
        alert("The Server cannot interprete the type of file" + file.type); 
        return;
       }
       */
      if(file.name === ""){
        alert("The Server cannot interprete the type of file" + file.name); 
        return;
       }
        var formdata = new FormData(document.getElementById('upload_form'));
        formdata.append("file1", file);
        formdata.append("fileIDupload", fileIDupload);
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", completeHandler, false);
        ajax.addEventListener("error", errorHandler, false);
        ajax.addEventListener("abort", abortHandler, false);
        ajax.open("POST", GLOBALS.appRoot + "draft/processupload");
        ajax.send(formdata);
    }
    
    function progressHandler(event){
        _("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
        var percent = (event.loaded / event.total) * 100;
        _("progressBar").value = Math.round(percent);
        _("status").innerHTML = Math.round(percent) + " % uploaded... please wait";
    }
    
    function completeHandler(event){
        _("status").innerHTML = event.target.responseText;
        _("progressBar").value = 0;
    }
    
    function errorHandler(event){
        _("status").innerHTML = "Upload Failed";
       
    }
    
    function abortHandler(event){
        _("status").innerHTML = "Upload Aborted";
    }
</script>            