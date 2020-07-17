<style type="text/css">
    .basicstyle{
        font-size:25px;
        font-weight: bold;
        padding:15px;
    }
    ul.tabs{
        margin: 0px;
        padding: 0px;
        list-style: none;
    }
    ul.tabs li{
        background: none;
        color: #222;
        display: inline-block;
        padding: 10px 15px;
        cursor: pointer;
    }

    ul.tabs li.current{
        background: #ededed;
        color: #222;
    }

    .tab-content{
        display: none;
        background: #ededed;
        padding: 15px;
    }

    .tab-content.current{
        display: inherit;
    }
</style>
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
                                <h4 class="title">Report</h4>
                                <p class="category">Please make sure you select a Date Range</p>
                            </div>

                          
                            <div class="card-content">  


                                <div class="dtabs">

                                    <ul class="tabs">
                                        <li class="tab-link current" data-tab="tab-1"><b>MAJOR REPORTING</b></li>
                                        <li class="tab-link" data-tab="tab-2"><b>GRAPHICAL ILLUSTRATOR</b></li>
                                        <li class="tab-link" data-tab="tab-3"><b>BUDGETING</b></li>
                                        <li class="tab-link" data-tab="tab-4"><b></b></li>
                                    </ul>

                              
                                    <div id="tab-1" class="tab-content current">

                                     <form name="postRequest" method="GET" action="<?php echo base_url(); ?>Cireports/projectsearch">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" name="id" placeholder="Request ID" class="form-controls"/>
                                            </div>

                                            <div class="col-md-3">
                                                <input type="text" name="ndescriptOfitem" placeholder="Description/Title" class="form-controls"/>
                                            </div>
                                            
                                            <?php
                                            $curr_value = "";
                                            $getCurrency =  $this->generalmd->getdresult("*", "currencytype", "",  "");
                                            foreach($getCurrency as $get){
                                                $name = $get->name;
                                                $currSymbol = $get->currencySymbol;
                                                $curr_value .= "<option value='$name'>$name</option>";
                                            }
                                            ?>
                                            <div class="col-md-3">
                                                <select class="form-controls" name="CurrencyType">
                                                    <option value="">Select Currency </option>
                                                     <?php echo $curr_value; ?>
                                                </select>
                                              
                                            </div>

                                             <?php
                                            $petty_value_cash = "";
                                            $getPayMode =  $this->generalmd->getdresult("*", "cash_paymentmode", "",  "");
                                            foreach($getPayMode as $get){
                                                $pid = $get->id;
                                                $paymentType = $get->paymentType;
                                                $petty_value_cash .= "<option value='$pid'>$paymentType</option>";
                                            }
                                            ?>
                                            <div class="col-md-3">
                                                <select class="form-controls" name="nPayment">
                                                    <option value="">Select Payment Mode </option>
                                                     <?php echo $petty_value_cash; ?>
                                                </select>
                                            </div>

                                        </div>


                                         <?php
                                            $mstatus = "";
                                            $getApproval =  $this->generalmd->getdresult("*", "approval_type", "",  "");
                                            foreach($getApproval as $get){
                                                $payid = $get->id;
                                                $sname = $get->name;
                                                $approval_type = $get->approval_type;
                                                $mstatus .= "<option value='$approval_type'>$sname</option>";
                                            }
                                         ?>
                                        
                                        
                                        
                                        <div class="row" style="margin-top:10px">
                                            <div class="col-md-3">
                                                <select class="form-controls" name="approvals">
                                                    <option value="">Select Approval Type </option>
                                                     <?php echo $mstatus; ?>
                                                </select>
                                            </div>

                                            
                                            
                                            <div class="col-md-3">
                                                <input type="text" name="dAmount"  placeholder="Amount" class="form-controls"/>
                                            </div>
                                            
                                            
                                            <?php
                                            $mLocation = "";
                                            $getLocation =  $this->generalmd->getdresult("*", "cash_location", "",  "");
                                            foreach($getLocation as $get){
                                                $Loid = $get->id;
                                                $locationName = $get->locationName;
                                                $abbr = $get->abbr;
                                                $mLocation .= "<option value='$Loid'>$locationName</option>";
                                            }
                                          ?>
                                            <div class="col-md-3">
                                                 <select class="form-controls" name="dLocation">
                                                    <option value="">Select Location </option>
                                                     <?php echo $mLocation; ?>
                                                </select>
                                            </div>
                                            
                                            
                                            <?php
                                            $mUser = "";
                                            $getAllUsers =  $this->generalmd->getdresult("*", "cash_usersetup", "accessLevel",  4);
                                            
                                            foreach($getAllUsers as $get){
                                                $Uid = $get->id;
                                                $name = $get->fname." ". $get->lname;
                                                $email = $get->email;
                                                $mUser .= "<option value='$email'>$name</option>";
                                            }
                                          ?>

                                            <div class="col-md-3">
                                                 <select class="form-controls" name="cashiers">
                                                    <option value="">Select Cashier </option>
                                                     <?php echo $mUser; ?>
                                                </select>
                                            </div>

                                        </div>

                                        
                                         <?php
                                            $mGroup = "";
                                            $getAllGroup =  $this->generalmd->getdresult("*", "cash_groupaccount", "",  "");
                                            
                                            foreach($getAllGroup as $get){
                                                $gid = $get->gid;
                                                $accountgroupName = $get->accountgroupName;
                                                $userid = $get->userid;
                                                $mGroup .= "<option value='$gid'>$accountgroupName</option>";
                                            }
                                          ?>

                                        <div class="row" style="margin-top:10px">
                                            <div class="col-md-3">
                                                <select class="form-controls" name="dAccountgroup">
                                                    <option value="">Select Account Group </option>
                                                     <?php echo $mGroup; ?>
                                                </select>
                                            </div>
                                            

                                            <div class="col-md-3">
                                                <input type="text" name="sessionID"  placeholder="Email" class="form-controls"/>
                                            </div>

                                            <div class="col-md-3">
                                                <input type="text" name="benName"  placeholder="Beneficiary" class="form-controls"/>
                                            </div>

                                            
                                             <?php
                                            $mApp = "";
                                            $getWhichApp =  $this->generalmd->getdresult("*", "application_ID", "",  "");
                                            
                                            foreach($getWhichApp as $get){
                                                $appid = $get->appID;
                                                $applicationName = $get->applicationName;
                                                $mApp .= "<option value='$appid'>$applicationName</option>";
                                            }
                                          ?>
                                            <div class="col-md-3">
                                              <select class="form-controls" name="from_app_id">
                                                    <option value="">Which Application</option>
                                                     <?php echo $mApp; ?>
                                                </select>
                                            </div>

                                        </div>


                                        <div class="row" style="margin-top:10px">
                                            <div class="col-md-3">
                                                <input type="text" name="enumType" placeholder="Travel Request Only" class="form-controls"/>
                                            </div>

                                            <div class="col-md-3">
                                                <input type="text" name="sageRef" placeholder="Sage Reference" class="form-controls"/>
                                            </div>

                                            <div class="col-md-3">
                                                <input type="text" name="dateCreated" placeholder="Start Date" class="form-controls"/>
                                            </div>

                                            <div class="col-md-3">
                                                <input type="text" name="dateRegistered" placeholder="End Date" class="form-controls"/>
                                            </div>

                                        </div>


                                        <div class="row" style="margin-top:10px">
                                            <div class="col-md-3">
                                                <input type="text" name="apprequestID" placeholder="Application ID" class="form-controls"/>
                                            </div>

                                            <div class="col-md-3">
                                                <input type="text" name="datepaid"  placeholder="Date Paid" class="form-controls"/>
                                            </div>

                                            <div class="col-md-3">
                                                <input type="submit" value="Submit" class="btn btn-xs btn-danger"/>
                                            </div>



                                        </div>

                                         </form>

                                        <div style="margin-bottom:50px"></div><hr/>
                                        
                                        
                                        <div class="table-responsive">
                                        <table class="table table-bordered table-responsive table-hover" id="hodall" style="font-size: 12px">
	                                    <thead class="text-primary">
                                               
	                                    	<th>ID</th>
                                                <th>Date</th>
	                                    	<th style="width:250px; padding-left:5px; padding-right:5px;">Description of Item</th>
                                                <th>Requester</th>
                                                <th>Location</th>
                                                 <th>Unit</th>
                                                <th>Amount </th>
                                                <th>Part Payment</th>
                                                <th>Sage-Ref</th>
						<th>Status</th>
                                               
	                                    </thead>
	                                    <tbody>
                                                
                                                <?php
                                                    $amount = "";
                                                    if($allRequest){   
                                                    foreach($allRequest as $get){
                                                    $getCurrency =  $this->generalmd->getsinglecolumn("currencySymbol", "currencytype", "name",  $get->CurrencyType);
                                                    
                                                    $sumepartpay = $this->generalmd->sumepartpay($get->id);
                                                    $poNumber = $get->po_number;
                                                    if($poNumber != ''){
                                                       $poNumber = "PO Number". $poNumber; 
                                                    }else{
                                                        $poNumber = "";
                                                    }
//                                                    if($sumepartpay){
//                                                       $amount = $sumepartpay; 
//                                                    }else{
//                                                       $amount = $get->dAmount;
//                                                    }
                                                ?>
                                                
                                                <tr>
                                                 <td><?php echo $get->id; ?></td>
                                                <td><?php echo $get->dateCreated; ?></td>
	                                    	<th style="width:250px; padding-left:5px; padding-right:5px;">
                                                    <a href="<?php echo base_url(); ?>home/viewreqeuestdetails/<?php echo $get->id; ?>/<?php echo $get->approvals; ?>/<?php echo $get->md5_id; ?>"><?php echo $get->ndescriptOfitem; ?></a>
                                                    <br/><span style="font-weight: bolder; color:red"><?php echo $poNumber; ?></span>
                                                </th>
                                                <td><?php echo $this->generalmd->getsinglecolumn("fname", "cash_usersetup", "email",  $get->sessionID) .' '. $this->generalmd->getsinglecolumn("lname", "cash_usersetup", "email",  $get->sessionID); ?></td>
                                                <td><?php echo $this->generalmd->getsinglecolumn("locationName", "cash_location", "id",  $get->dLocation); ?></td>
                                                  <td><?php echo $this->generalmd->getsinglecolumn("unitName", "cash_unit", "id",  $get->dUnit); ?></td>
                                                <td><?php echo $getCurrency. @number_format($get->dAmount, 2); ?></td>
                                                 <td><?php echo $getCurrency. @number_format($sumepartpay, 2); ?></td>
                                                <td><?php echo $get->sageRef; ?></td>
                                                 <td><?php echo $this->generalmd->getsinglecolumn("name", "approval_type", "approval_type",  $get->approvals); ?></td>
                                                </tr>
                                                
                                                 <?php
                                                    }
                                                   }
                                                ?>
                                            </tbody>
                                       </table>
                                        </div>

                                    </div><!--  <div id="tab-1" class="tab-content"> -->


                                     <div id="tab-2" class="tab-content">

                                        TAB CONTENT 2
                                    </div>

                                    <div id="tab-3" class="tab-content">
                                        TAB CONTENT 3
                                    </div>






                                    <div id="tab-4" class="tab-content">
                                        TAB CONTENT 4                                   
                                    </div>

                                </div><!-- END OF TABBED CONTENT     -->



                            </div>
                       
                            <!-- BEGINNING OF SEARCH RESULT -->

                            <div  class="card-content">
                               
                                  
                            </div>
                            <!-- END OF SEARCH RESULT -->


                        </div>
                    </div>

                    <!-- End of Request Details with Status -->




                    <!-- Inside Content Ends Here -->


                </div>
            </div>
        </div>
        <!-- Main Outer Content Ends  Here -->  

        <script>
            $(function () {
                $('#hodall').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['excel', 'pdf']
                            //buttons: [ 'colvis' ]
                });

                $('ul.tabs li').click(function () {
                    var tab_id = $(this).attr('data-tab');

                    $('ul.tabs li').removeClass('current');
                    $('.tab-content').removeClass('current');

                    $(this).addClass('current');
                    $("#" + tab_id).addClass('current');
                });


            });

        </script> 

        <?php echo $footer; ?>
