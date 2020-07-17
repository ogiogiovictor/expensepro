
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

                    <div class="col-lg-8 col-md-12">
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
                                        </ul>
                                    </div>
                                </div>
                            </div>


                            <!-- BEGINNING OF TAB CONTENT -->
                            <?php
                            $cashiersid = $_SESSION['email'];
                            $adminEmail = $_SESSION['email'];
                            
                            if ($getallresult) {
                                $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
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
                                    $dLocation = $get->dLocation;
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
                                    
                                    
                                    
                                    if($partPay !="" && $partPay < $dAmount){
                                      $newpartpay =  @number_format($partPay);
                                    }else{
                                      $newpartpay = @number_format($dAmount)."NGN";
                                    }			
                                } // End of for each
                            }
                            ?>

                            <form name="accessme" id="accessme" method="POST" onSubmit="return false;">
                                <div class="card-content">

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="profile">



                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Date Created</label>
                                                    <input type="text" value="<?php echo $dateCreated; ?>"  disabled name="dateCreated" id="dateCreated" class="form-control" />
                                                </div>
                                            </div>
                                            <?php
                                                if(is_numeric($dLocation)){
                                                     $getLocale =  $this->mainlocation->getdLocation($dLocation);
                                                }else{
                                                    $getLocale =  $dLocation;
                                                }
                                            ?>

                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Location</label>
                                                    <input type="text" value="<?php echo $getLocale; ?>"  disabled name="dLocation" id="dLocation" class="form-control" />
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
                                                    <input type="text" value="<?php echo $dAmount; ?>"  disabled name="dAmount" id="description" class="form-control" />
                                                </div>
                                            </div>


                                            <!--<div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Amount Paid</label>
                                                    <input type="text" value="<?php //echo $newpartpay; ?>"  disabled name="payPartment" id="payPartment" class="form-control" />
                                                </div>
                                            </div>-->
                                            <?php if(is_numeric($dUnit)){
                                                    $getDepartment =  $this->mainlocation->getdunit($dUnit); 
                                                }else{
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


                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Beneficiary Name</label>
                                                    <input type="text" value="<?php echo $benName; ?>"  disabled name="benName" id="benName" class="form-control" />
                                                </div>
                                            </div>


                                            <!--<div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Beneficiary Email</label>
                                                    <input type="text" value="<?php //echo $benEmail; ?>"  disabled name="benEmail" id="benEmail" class="form-control" />
                                                </div>
                                            </div>-->

                                            <?php
                                            $getSessEmail = $this->mainlocation->getuserSessionEmail($sessionID);
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
                                            
                                            
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Comments</label>
                                                    <input type="text" value="<?php echo @$requesterComment; ?>"  disabled name="requesterComment" id="requesterComment" class="form-control" />
                                                </div>
                                            </div>


                                            <hr/>   


                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Expense Details</label>
                                                    <?php
                                                    $getexpensedetails = $this->adminmodel->getexpenseresultdetails($id);
                                                    //print_r($getexpensedetails);
                                                    if ($getexpensedetails) {
                                                        echo "<div class='card-content table-responsive'><table class='table table-responsive table-hover table-striped table-bordered'>"
                                                        . "<tr><td><b>Details</b></td><td><b>Accout Code</b></td><td><b>Amount</b></td><td><b>Date</b></td></tr>";
                                                        foreach ($getexpensedetails as $extdetals) {
                                                            $exid = $extdetals->exid;
                                                            $requestID = $extdetals->requestID;
                                                            $ex_Details = $extdetals->ex_Details;
                                                            $ex_Amount = $extdetals->ex_Amount;
                                                            $ex_Code = $extdetals->ex_Code;
                                                            $ex_Date = $extdetals->ex_Date;
                                                            
                                                            $getCodeName = $this->mainlocation->nameCode($ex_Code);
                                                            
                                                            echo "<tr><td>$ex_Details</td><td>$ex_Code  $getCodeName</td><td>$ex_Amount</td><td>$ex_Date</td></tr>";
                                                        }
                                                        echo "</table></div>";
                                                    }
                                                    ?>
                                                    
                                                    <?php 
                                                     $newrandomString = random_string('alnum', 60);
                                                    
                                                    if(is_numeric($refID_edited) && $refID_edited !== "disabled"){
                                                    echo '<center><span class="btn btn-xs btn-info"><a target="_blank" href='.base_url().'home/approvaldetails/'.$refID_edited.'/'.$newrandomString.'>View Close Request</a></span></center>';
                                                    }else{
                                                        echo "";
                                                    }
                                                    ?>
                                                </div>
                                            </div>              




                                            <?php
                                            if ($getApprovalLevel == 3) {
                                                echo "<div class='col-md-12'>
                                                    <div class='form-group label-floating'>
                                                    <label class='control-label'>First Level Approval</label>
                                                    
                                                      <input type='text' value='$hod'  disabled name='hodapproval' id='hodapproval' class='form-control' />
                                                    </div>
						</div>";
                                            } elseif ($getApprovalLevel == 4 || $getApprovalLevel == 5 || $getApprovalLevel == 7 || $getApprovalLevel == 6) {

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
                                            
                                            if($getoldImages !== ""){
                                                
                                                $getoldimages = $this->adminmodel->getresultbaseonfileuploadID($getoldImages);
                                                if($getoldimages){
                                                    
                                                    foreach($getoldimages as $getold){
                                                    $fidold = $getold->fid;
                                                    $f_requestIDold = $getold->f_requestID;
                                                    $newFilenameold = $getold->newFilename;
                                                    
                                                     echo $newImage = '<a target="_blank" href=' . base_url() . 'public/documents/' . $newFilenameold . '>' . $newFilenameold . '</a><br/>';
                                                    }
                                                } else {
                                                    echo "";
                                                }
                                            }
                                            ?>
                                            
                                            <?php
                                            $newImage = "";
                                            $getattachementid = $this->adminmodel->getresultbaseonfileuploadID($id);
//print_r($getattachementid);
                                            if ($getattachementid) {


                                                foreach ($getattachementid as $file) {
                                                    $fid = $file->fid;
                                                    $f_requestID = $file->f_requestID;
                                                    $origFilename = $file->origFilename;
                                                    $newFilename = $file->newFilename;
                                                    $ext = $file->ext;
                                                    $mimeType = $file->mimeType;

                                                    /*
                                                      if ($ext == "image/jpeg" || $ext == "image/jpg" || $ext == "image/png" || $ext == "image/gif") {
                                                      $newImage = '<img src="'.base_url().'public/documents/'.$newFilename.'" />';
                                                      }
                                                      if ($ext == "application/pdf") {
                                                      //$newImage = '<iframe name="myiframe" id="myiframe" src="'.base_url().''.$linkOnDisk.'">';
                                                      $newImage = '<embed src='.base_url().'public/documents/'.$newFilename.' width="600" height="375" type="application/pdf">';
                                                      }

                                                      if ($ext == "text/plain") {
                                                      //$newImage = '<iframe name="myiframe" id="myiframe" src="'.base_url().''.$linkOnDisk.'">';
                                                      $newImage = '<a href='.base_url().'public/documents/'.$newFilename.'>'.$newFilename.'</a>';
                                                      }
                                                     */
                                                    echo $newImage = '<a target="_blank" href=' . base_url() . 'public/documents/' . $origFilename . '>' . $newFilename . '</a><br/>';
                                                }
                                            } else {
                                                echo "";
                                            }
                                            ?>
                                            
                                            <?php
                                           $AssetImage = "";
                                            if($apprequestID && $apprequestID !== "" && $from_app_id == '2' || $from_app_id == 2){
                                            $getImageName = $this->allresult->getimagename($apprequestID);
                                            echo $AssetImage = '<a target="_blank" href="http://localhost/assetmgt/document/vendors/'.$getImageName.'">' . $getImageName . '</a><br/>';
                                           
                                            }
                                            ?>
                                            
                                            <?php
                                            if($apprequestID){
                                               echo "<a target ='_blank' href='http://localhost/assetmgt/joborderrequestition/".@$apprequestID."/@$adminEmail'><br/><span class='btn btn-xs btn-danger'>View Job Order</span></a>"; 
                                            }else{
                                                echo "";
                                            }
                                               
                                            ?>
                                        </div>



                                        <div class="tab-pane" id="settings">


                                            <?php
                                            if($getApprovalLevel == 1 && $hod == $_SESSION['email']){
                                               echo "<div class='col-md-12 forcommentdisplay'>
                                                    <div class='form-group label-floating'>
                                                    <label class='control-label'>Add Comment</label>
                                                      <textarea class='form-control' name='dComment' id='dComment' cols='5' rows='5'></textarea>
                                                   </div>
						</div>"; 
                                                
                                            }else if ($getApprovalLevel == 2) {
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


                    <!-- Inside Content Ends Here -->


                </div>
            </div>
        </div>
        <!-- Main Outer Content Ends  Here -->  



        <?php echo $footer; ?>