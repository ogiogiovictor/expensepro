
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
                         
                   
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <!-- <div style="line-height: 0px" class="card-header" data-background-color="orange">
                                <i class="fa fa-bar-chart-o" ></i>
                            </div>-->
                            <div class="card-content">
                                <p class="category"><small> <span style="color:red">YE: (<?php echo @number_format($totalYearExpense, 2); ?>)</span> &nbsp; &nbsp;Year Budget</small></p>
                                <h3 class="title"><a href="<?php echo base_url(); ?>budget/viewmonths/<?php echo date('Y'); ?>/<?php echo $myUnit; ?>">
                                        <small>YB:
                                    <?php echo $yearlyBudget != "" ? @number_format($yearlyBudget, 2) : "<small style='color:red'>No Budget</small>"; ?>
                                        </small></a></h3>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                     <?php
                    $mbudget = "<small style='color:red'>No Budget</small>";
                    $sum = 0;
                    if ($monthlyBudget) {

                        foreach ($monthlyBudget as $get) {
                            $mamount = $get->amount;
                           // $mcurrency = $this->generalmd->getsinglecolumn("currencySymbol", " currencytype", "name", $get->currency);
                            $month = $get->month;
                            $sum += $mamount;
                        }
                        $mbudget = $mamount != "" ? @number_format($sum, 2) : '<small>No Budget</small>';
                    }
                    ?>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="green">
                                <i class="fa fa-wpforms"></i>
                            </div>
                            <div class="card-content">
                                <p class="category"><small><?php echo $this->generalmd->getsinglecolumn("name", "  month_in_year", "id", date('m')); ?> Budget</small></p>
                                <h3 class="title"><small><a href="<?php echo base_url(); ?>budget/viewbyaccountcode/<?php echo date('Y'); ?>/<?php echo date('m'); ?>/<?php echo $myUnit; ?>"><?php echo $mbudget; ?></a></small></h3>
                            </div>
                        </div>
                    </div>
                    
                     <?php
                    $mBudExpense = "<small style='color:red'>No Expense</small>";
                    $mBudExpense = 0;
                    if ($monthlyBudget) {

                        foreach ($monthlyBudgetExpense as $get) {
                            $mExid = $get->id;
                            $BudgettotalCost = $get->totalCost;
                        }
                        $mBudExpense = $BudgettotalCost != "" ? $BudgettotalCost : 0;
                    }
                    ?>
                    
                    <?php
                    $mOtherBudExpense = 0;
                    if ($monthlyBudgetExpenseOthers) {

                        foreach ($monthlyBudgetExpenseOthers as $get) {
                            $moExid = $get->id;
                            $BudgetOtotalCost = $get->totalCost;
                        }
                        $mOtherBudExpense = $BudgetOtotalCost !="" ? $BudgetOtotalCost : 0;
                    }
                    ?>
                    
                     <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="red">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="card-content">
                                <p class="category"><small><?php echo $this->generalmd->getsinglecolumn("name", "  month_in_year", "id", date('m')); ?> Expense</small></p>
                                <h3 class="title"><small><?php echo @$currency . @number_format($totalCostAll, 2); ?></small></h3>
                            </div>

                        </div>
                    </div>
                    
                    
                     <?php
                    $monthlyBalance = @$sum - @$totalCostAll;
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="blue">
                                <i class="fa fa-ticket"></i>
                            </div>
                            <div class="card-content">
                                <p class="category"><small>Difference</small></p>
                                <h3 class="title"><small><?php echo @number_format($monthlyBalance, 2); ?></small></h3>
                            </div>
                        </div>
                    </div>


                    
                     <!--End of Card Box -->
                    
                    
                    
                    
                         
                         <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">Request For My Approval</h4>
	                                <p class="category">All Latest Request Awaiting Approval</p>
	                            </div>
				
	                            <div class="card-content table-responsive table-condensed">
                                        <span id="icuacceptrequest"></span>
	                                <table class="table" id="reqeustapproval">
	                                    <thead class="text-primary">
                                               
	                                    	<th>ID</th>
                                                <th>Date</th>
	                                    	<th style="width:250px; padding-left:5px; padding-right:5px;">Description of Item</th>
                                                <th>Requester</th>
                                                <th>Location</th>
                                                <th>Amount</th>
						<th>Status</th>
                                                <th style="width:200px">Action</th>
	                                    </thead>
	                                    <tbody>
	                                     
						<?php if ($getallresult) { ?>
						<?php
                                                $sumall = "";
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
                                                         $partPay = $get->partPay;
                                                         $benName = $get->benName;
                                                         $refID_edited = $get->refID_edited;
                                                         $dAccountgroup = $get->dAccountgroup;
                                                         $ChecknPayment = $get->nPayment;
                                                         $fullname = $get->fullname;
                                                         $CurrencyType = $get->CurrencyType;
                                                         $dateHODapprove = $get->dateHODapprove;
                                                         $dateICUapprove = $get->dateICUapprove;
                                                          $from_app_id = $get->from_app_id;
                                                
                                                        if($partPay != "0.00" && $partPay < $dAmount){
                                                           $newAmount = @number_format($partPay, 2)." <br/>Part Payment";
                                                          }else{
                                                           $newAmount = @number_format($dAmount, 2);
                                                        }	
                                                       
                                                        if($getApprovalLevel == 1){
                                                            $timeAgo = get_timeago(strtotime($dateCreated));
                                                        }elseif($getApprovalLevel == 2){
                                                            $timeAgo = get_timeago(strtotime($dateCreated));
                                                        }else if($getApprovalLevel == 3){
                                                            $timeAgo = get_timeago(strtotime($dateHODapprove));
                                                        }else if($getApprovalLevel == 4){
                                                            $timeAgo = get_timeago(strtotime($dateICUapprove));
                                                        }else if($getApprovalLevel == 7){
                                                            $timeAgo = get_timeago(strtotime($dateICUapprove));
                                                        }else if($getApprovalLevel == 6){
                                                            $timeAgo = get_timeago(strtotime($dateICUapprove));
                                                        }else{
                                                             $timeAgo = get_timeago(strtotime($dateCreated));
                                                        }
                                                        
                                                        
                                                        
                                                $newCurrency = $this->generalmd->getsinglecolumn("currencySymbol", " currencytype", "name", $CurrencyType);
                                                $defaultCurrency = $this->generalmd->getsinglecolumnwithand("currencySymbol", " currencytype", "name", $CurrencyType, 'defaultCurrency', 1);
                                                $newCurrency = $newCurrency != '' ? $newCurrency : $defaultCurrency;

                                                $newapproval = $this->generalmd->getsinglecolumn("name", " approval_type", "approval_type", $approvals);
                                            
                                            
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
                                                    
                                                                                                 
						?>
                                                 <?php 
                                                   $newrandomString = random_string('alnum', 60);
                                                ?>
										 
										 
	                                     
                                             <?php 
                                            /* if($getApprovalLevel == 6 || $getApprovalLevel == 7 || $getApprovalLevel == 8){
                                                 
                                           
                                              echo "<td><input type='checkbox' name='mergepayment[]' id='mergepayment[]' value='$id' /></td>";
                                               
                                             }else{
                                                 echo "";
                                             } */
                                             ?>
                                             <tr>
                                            <td><?php echo $id; ?></td>
                                             <td>
                                                 <?php echo $dateCreated; ?><br/>
                                             <small class="badge badge-danger"><?php echo $timeAgo; ?></small>
                                             </td>
                                            <td style="padding-left:5px; padding-right:5px;"><a href="<?php echo base_url(); ?>home/approvaldetails/<?php echo $id; ?>/<?php echo $md5_id; ?>/<?php echo $newrandomString; ?>"><?php echo $ndescriptOfitem; ?></a></td>
                                            <td><?php echo $fullname; ?></td>
                                            <td><?php
                                                if(is_numeric($dLocation)){
                                                     echo $this->mainlocation->getdLocation($dLocation);
                                                }else{
                                                    echo $dLocation;
                                                }
                                            ?>
                                            </td>
                                            
                                            <td><?php echo $newCurrency.$newAmount; ?></td>
                                            <td> <small class="badge badge-danger"><?php echo $newapproval; ?></small></td>
                                            <td>
                                           <?php  
                                            if($getApprovalLevel == 1 || $getApprovalLevel == 5 || $hod == $_SESSION['email'] && $approvals == '1'){
                                          echo "<input type='hidden' value='$id' name='acceptrequestID' id='acceptrequestID' />
                                           <input type='hidden' value='$hod' name='hodEmail' id='hodEmail' />
                                           <button title='Approve' name='processApprovalnothod' id='processApprovalnothod' class='btn btn-xs btn-success' onClick='processApprovalwithhod($id)'><i class='material-icons'>check</i></button>
                                           <!--<input type='submit'  onClick='processApprovalwithhod($id)' name='processApprovalnothod' id='processApprovalnothod' value='ccc' class='btn btn-xs btn-primary' />-->
                                           <button title='Reject' name='rejectrequestID' data-id='$id' class='rejectrequestID btn btn-xs btn-danger disposebox'>X</button>
                                           <!--<input type='submit'  name='rejectrequestID' data-id='$id' class='rejectrequestID btn btn-xs btn-warning disposebox' value='Reject' class='btn btn-xs btn-danger' />-->";
                                            }else if($getApprovalLevel == 2 && $refID_edited != "disabed" && $approvals != '2' && $approvals !='3' && $approvals !='4' && $approvals !='7' && $approvals !='8'){
                                         echo "<input type='hidden' value='$id' name='acceptrequestID' id='acceptrequestID'/>
                                           <input type='hidden' value='$hod' name='hodEmail' id='hodEmail'/>
                                           <button title='Approve' name='processApprovalwithhod' id='processApprovalwithhod' class='btn btn-xs btn-success' onClick='processApprovalwithhod($id)'><i class='material-icons'>check</i></button>
                                           <!--<input type='submit'  onClick='processApprovalwithhod($id)'  id='processApprovalwithhod' name='processApprovalwithhod' value='Approve' class='btn btn-xs btn-primary'/>-->
                                           <button title='Reject' name='rejectrequestID' data-id='$id' class='rejectrequestID btn btn-xs btn-danger disposebox'>X</button>
                                           <!--<input type='submit'  name='rejectrequestID' data-id='$id' class='rejectrequestID btn btn-xs btn-warning disposebox' value='Reject' class='btn btn-xs btn-danger'/>-->";
                                         }else if ($getApprovalLevel == 3 && $approvals == '2'){
                                             
                                               if($from_app_id == 3){
                                                   echo "
                                                <input type='hidden' value='$id' name='icuacceptrequestID' id='icuacceptrequestID' />
                                                    <input type='hidden' value='$id' name='icurejectrequestID' id='icurejectrequestID' />
                                                        <input type='hidden' value='$icus' name='groupIDinICU' id='groupIDinICU' />
                                                        <input type='hidden' value='$dAmount' name='mainAmount' id='mainAmount' />
                                                      <input type='submit' onClick='icuapprovefunction($id, $icus, $dAmount)' id='icuprocessApprovalbuttoninside' name='icuprocessApprovalbuttoninside'  value='Approve' class='btn btn-xs btn-primary' />
                                                      <span id='icurejecttrequest'></span>
                                                      <input type='submit' name='icudorejection' id='$id' class='rejectrequestIDICU btn btn-xs btn-danger disposebox' value='Request-Add-Info' title='Request Additional Information' class='btn btn-xs btn-danger' />";
                                                       
                                               }else{
                                                echo "
                                                <input type='hidden' value='$id' name='icuacceptrequestID' id='icuacceptrequestID' />
                                                    <input type='hidden' value='$id' name='icurejectrequestID' id='icurejectrequestID' />
                                                        <input type='hidden' value='$icus' name='groupIDinICU' id='groupIDinICU' />
                                                        <input type='hidden' value='$dAmount' name='mainAmount' id='mainAmount' />
                                                      <input type='submit' onClick='icuapprovefunction($id, $icus, $dAmount)' id='icuprocessApprovalbuttoninside' name='icuprocessApprovalbuttoninside'  value='Approve' class='btn btn-xs btn-primary' />
                                                      <span id='icurejecttrequest'></span>
                                                      <input type='submit' name='icudorejection' id='$id' class='rejectrequestIDICU btn btn-xs btn-warning disposebox' value='Reject' class='btn btn-xs btn-danger' />";
                                               }
                                                      
                                            }else{
                                                echo "";
                                            }
                                           ?>
                                           
                                           
                                            <?php
                                                if ($getApprovalLevel == 7 && $CurrencyType == 'naira' || $CurrencyType == 'NGN') {
                                                    echo "<span title='Approve' class='btn btn-xs btn-success' onClick='approvecheques($id, $dAccountgroup, $dAmount)'><i class='material-icons'>check</i></span>";
                                                }
                                                        
                                             ?>
                                                        
                                            <?php
                                                if ($getApprovalLevel == 7) {
                                                    echo "<input type='submit' title='Reject' name='theaccountantrejectedit' data-id='$id' class='theaccountantrejectedit btn btn-xs btn-danger disposebox'  value='X' class='btn btn-xs btn-danger'/>";
                                                 }
                                                        
                                            ?>
                                           
                                           <?php
                                           if ($getApprovalLevel == 7  || $getApprovalLevel == 6){
                                               echo "<span title='print' class='btn btn-xs btn-default' onClick='printchequerequests($id)'><i class='material-icons'>print</i></span>
                                               <a href='".base_url()."paycheques/preparecheque/$id/$md5_id/$approvals/$newrandomString' title='Prepare Cheque'><span title='Cheque Preparation' class='btn btn-xs btn-warning' >C</span></a>"; 
                                               
                                           }
                                           ?>
                                           <!--<input type="submit"  name="rejectrequestID" data-id='<?php echo $id; ?>' class="rejectrequestID btn btn-xs btn-warning" onClick="document.getElementById('disposebox').style.display = 'block'" value='Reject later' class='btn btn-xs btn-danger' />-->
                                           <!--<a title="view" href="<?php echo base_url(); ?>home/approvaldetails/<?php echo $id; ?>/<?php echo $newrandomString; ?>"><span class="btn btn-xs btn-google"><i class="material-icons">insert_drive_file</i></span></a>-->
                                           <?php
                                           if($approvals !== '4' || $approvals == '7'){
                                              echo "<a title='view' href='".base_url()."home/approvaldetails/$id/$md5_id/$newrandomString'><span class='btn btn-xs btn-facebook'><i class='material-icons'>insert_drive_file</i></span></a>";
                                            
                                           }else{
                                           echo "";
                                           }
                                           
                                           ?>
                                                
                                           <?php
                                           if($getApprovalLevel == 4 && $ChecknPayment == 2 && $approvals !== '4' || $approvals == '7'){
                                              echo "<a title='Change Location of Payment' href='".base_url()."location/changelocation/$id/$newrandomString'><span class='btn btn-xs btn-primary'><i class='material-icons'>edit_location</i></span></a>";
                                            
                                           }else{
                                           echo "";
                                           }
                                           
                                           ?>   
                                                
                                             <?php
                                           if($getApprovalLevel == 6 && $ChecknPayment == 2 && $approvals == '3'){
                                              echo " <a title='Change Cheque Payment Location' href=".base_url()."supports/changelocation/$id><span class='btn btn-xs btn-primary'><i class='material-icons'>edit_location</i></span></a>
                                            
                                            ";
                                            
                                           }else{
                                           echo "";
                                           }
                                           
                                           ?>    
                                                
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
                                        <?php 
                                             if($getApprovalLevel == 6){
                                               // echo "<span id='mergeErrors'></span><buttonn id='makemergedpaymentrequest' class='btn btn-xs btn-danger'>Merge Payment</button>";
                                             }else{
                                               //  echo "";
                                             }
                                         ?>
                                        
                                         
	                            </div>
	                        </div>
	                    </div>
						
                        
                                <!-- Hotel Management Starts HEre -->
                                
                                
                                
                      <?php
                    if($CFOMD_RESULT){
                  ?>      
                  
            <!-- Main Outer Content Begins Here --> 
	        <div class="content">
	            <div class="container-fluid">
	                <div class="row">
                                
                         <!-- Beginning of Request Details with Status -->
                         
                         <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="red">
	                                <h4 class="title">AWAITING PAYMENT REQUEST</h4>
	                                <p class="category">List of Request Awaiting Payment Approval</p>
	                            </div>
                                    
                                    
                                      <div class="card-content table-responsive table-condensed">
                                        <span id="hotelrequestmessage"></span>
	                                <table class="table" id="mydata">
	                                    <thead class="text-primary">
                                               
	                                    	<th>ID</th>
                                                <th>Date</th>
	                                    	<th style="width:250px; padding-left:5px; padding-right:5px;">Description of Item</th>
                                                <th>Requester</th>
                                                <th>Location</th>
                                                <th>Amount</th>
						<th>Status</th>
                                                <th style="width:200px">Action</th>
	                                    </thead>
	                                    <tbody>
                                                
                                               <?php
                                               $newAmount = 0.00;
                                                foreach($CFOMD_RESULT as $iget){
                                                    $cid = $iget->id;
                                                    $cmd5_id = $iget->md5_id;
                                                    $cdateCreated = $iget->dateCreated;
						    $cndescriptOfitem = $iget->ndescriptOfitem;
                                                    $csessionID = $iget->sessionID;
                                                    $cnPayment = $this->mainlocation->getpaymentType($iget->nPayment);
                                                    $cdAmount = $iget->dAmount;
                                                    $cdLocation = $iget->dLocation;
                                                    $cpartPay = $iget->partPay;
                                                    $cbenName = $iget->benName;
                                                    $cdAccountgroup = $iget->dAccountgroup;
                                                    $dateICUapprove = $iget->dateICUapprove;
                                                    $cfullname = $iget->fullname;
                                                    $cdLocation = $iget->dLocation;
                                                    $cfrom_app_id = $iget->from_app_id;
                                                     $cCurrencyType = $iget->CurrencyType;
                                                            
                                                    $capprovals = $this->generalmd->getsinglecolumn("name", "approval_type", "approval_type",  $iget->approvals);
                                                   
                                                     if($cpartPay != "0.00" && $cpartPay < $cdAmount){
                                                           $newAmount = @number_format($cpartPay, 2)." <br/>Part Payment";
                                                          }else{
                                                           $newAmount = @number_format($cdAmount, 2);
                                                        }	
                                                       
                                                    $cnewrandomString = random_string('alnum', 60);
                                                    
                                                    
                                                    if($cCurrencyType == 'naira'){
                                                    $cnewCurrency = '<span>&#8358;</span>';
                                                }else if($cCurrencyType == 'dollar'){
                                                    $cnewCurrency = '<span>&#x0024;</span>';
                                                }else if($cCurrencyType == 'euro'){
                                                    $cnewCurrency = '<span>&#8364;</span>';
                                                }else if($cCurrencyType == 'pounds'){
                                                    $cnewCurrency = '<span>&#163;</span>';
                                                }else if($cCurrencyType == 'yen'){
                                                    $cnewCurrency = '<span>&#165;</span>';
                                                }else if($cCurrencyType == 'singaporDollar'){
                                                    $cnewCurrency = '<span>S&#x0024;</span>';
                                                }else if($cCurrencyType == 'AED'){
                                                    $cnewCurrency = '<span>(AED)</span>';
                                                }else if($cCurrencyType == 'rupee'){
                                                    $cnewCurrency = '<span>&#8377;</span>';
                                                }else{
                                                   
                                                    if($cCurrencyType != ""){
                                                      $cnewCurrency = @$this->generalmd->getsinglecolumnfromotherdb("curr_symbol", "currencies", "curr_abrev", $cCurrencyType); 
                                                    }else if($cCurrencyType == "null" || $cCurrencyType == ""){
                                                        $cnewCurrency =  '<span>&#8358;</span>';
                                                    }else{
                                                        $cnewCurrency =  '<span>&#8358;</span>';
                                                    }
                                                    
                                                }
                                                
                                                    
                                                    if($cfrom_app_id == '3'){
                                                    $ivendor = $this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "USER_ID", $cbenName);
                                                    }else if($cfrom_app_id == '0' && is_numeric($cbenName)){
                                                          $ivendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $cbenName);
                                                    }else if($cfrom_app_id == '0' && !is_numeric($cbenName)){
                                                         $ivendor =  $cbenName;
                                                    }else if($cfrom_app_id == '5'){
                                                        $ivendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $cbenName);
                                                    }else if($cfrom_app_id == '6'){
                                                        $ivendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $cbenName);
                                                    }else if($cfrom_app_id == '8'){
                                                        $ivendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $cbenName);
                                                    }else{
                                                        $ivendor =  $cbenName;
                                                    }
                                                ?>    
                                                
                                                
                                        <tr>
                                          <td><?php echo $cid; ?></td>
                                             <td>
                                                 <?php echo $cdateCreated; ?><br/>
                                             <small class="badge badge-danger"><?php echo $timeAgo = get_timeago(strtotime($dateICUapprove)); ?></small>
                                             </td>
                                             
                                            <td style="padding-left:5px; padding-right:5px;"><a href="<?php echo base_url(); ?>home/approvaldetails/<?php echo $cid; ?>/<?php echo $cmd5_id; ?>/<?php echo $cnewrandomString; ?>"><?php echo $cndescriptOfitem; ?></a>
                                           <br/>
                                            <?php
                                            echo $ivendor = $ivendor !='' ? "<small style='color:red'>(VENDOR: ".ucwords($ivendor) . ")</small>" : ''; 
                                            ?>
                                            </td>
                                            <td><?php echo $cfullname; ?></td>
                                            <td><?php
                                                if(is_numeric($cdLocation)){
                                                     echo $this->mainlocation->getdLocation($cdLocation);
                                                }else{
                                                    echo $cdLocation;
                                                }
                                            ?>
                                            </td>
                                            
                                            <td><?php echo $cnewCurrency.$newAmount; ?></td>
                                            <td><span style="color:red"><?php echo $capprovals; ?></span></td>
                                            <td>
                                            
                                            <?php 
                                            echo 
                                           "<button title='Approve For Payment' name='processwithmd' id='processwithmd' class='btn btn-xs btn-success' onClick='processwithmd($cid)'><i class='material-icons'>check</i></button>
                                           <button title='Reject' name='rejectrequestID' data-id='$cid' class='rejectrequestID btn btn-xs btn-danger disposebox'>X</button>";
                                            ?>
                                           <?php
                                           
                                           echo "<a title='view' href='".base_url()."home/viewreqeuestdetails/$cid/$iget->approvals/$cnewrandomString'><span class='btn btn-xs btn-facebook'><i class='material-icons'>insert_drive_file</i></span></a>";
                                           ?>
                                            </td>
                                        </tr>
                                            
                                        <?php
                                                }
                                                ?>
                                                
                                            </tbody>
                                        </table>
                                </div>
                         
                             
                            
                         </div>
                         
                        </div>
                    </div>
                    
                </div>
                </div>
            
            
            <?php
            
                    }else{
                        echo "";
                    }
               ?>
                    
                 
            
            <div class="content">
                 <div class="container-fluid">
                     <div class="row">
                         
                         <?php echo $divMD; ?>
                        
                        <!--<div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="purple">
	                                <h4 class="title">QUOTATION AWAITING APPROVAL</h4>
	                                <p class="category">Quotation from Procurement Portal awaiting approval</p>
	                            </div>
                                    
                                    
                                    <div class="card-content table-responsive table-bordered">
                                        <div class="pogeneration"></div>
                                    </div>
                                </div>
                        </div>-->
                         
                     </div>
                 </div>
               
            </div>
            
             <!-- End of Request Details with Status -->
             
             
             
             
             
             
             
  <!------------------------------  THIS IS FOR HOD ONLY -------------------------------------------------------- ---->
  
   <div class="content">
                 <div class="container-fluid">
                     <div class="row">
                         
                         <?php
                             if($quoteforhod){
                         ?>
                        
                        <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="purple">
	                                <h4 class="title">QUOTATION AWAITING APPROVAL (HOD)</h4>
	                                <p class="category">Quotation from Procurement Portal awaiting approval</p>
	                            </div>
                                    
                                    
                                    <div class="card-content table-responsive table-bordered">
                                        <table class="table table-responsive table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Vendor Name</th>
                                                    <th>Item Description</th>
                                                    <th>Amount</th>
                                                    <th>Audit</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead><tbody>
                                        <?php
                                            foreach($quoteforhod as $get){
                                             
                                        ?>
                                            <tr>
                                              <td style="width:10%"><?php echo $get['batchid']; ?></td>
                                              <td style="width:15%"><?php echo $get['names']; ?></td>
                                              <td style="width:20%"><?php echo $get['subject']; ?></td>
                                              <td style="width:10%"><?php echo $get['curr_abrev']; ?> <?php echo $get['total']; ?></td>
                                               <td style="width:35%"><?php echo $get['audit']; ?></td>
                                               <td style="width:10%">
                                                <span title="Approve Quote" style="cursor:pointer" onClick="approvequotes(<?php echo $get['batchid']; ?>)" class="btn-xs btn-success"><i class="fa fa-check" aria-hidden="true"></i></span>&nbsp;
                                                <span title="Cancel Quote" style="cursor:pointer" onClick="rejectquotes(<?php echo $get['batchid']; ?>)" class="btn-xs btn-danger"><i class="fa fa-times" aria-hidden="true"></i></span> &nbsp;
                                                <span title="View Quote" onClick="toggle_visibility('popup-box')"  style="cursor:pointer" quoteid="<?php echo $get['batchid']; ?>"  class="getallquotesdetals btn-xs btn-primary"><i class="fa fa-picture-o"></i></span>
                                                   
                                               </td>
                                                </tr>     
                                        
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                        </table>
                                        
                                    </div>
                                </div>
                        </div>
                         
                       <?php
                             }
                       ?>
                         
                     </div>
                 </div>
               
            </div>
            
  
  
 <!-- /////////////////////////////// END OF THIS IS FOR HOD ONLY /////////////////////////////////////////////////-->
                         
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
            
           <!--
           https://c-iprocure.com/scp/api/quote/readed.php
https://c-iprocure.com/scp/api/quote/readmd.php
 -->
        
                                    
 <script>
   firstload();
   function firstload(){
    $('.pogeneration').append('<div style="text-align:center;"><img src="https://c-iprocure.com/expensepro/public/images/giphy.gif" style="width:300px"/></div>');
    var outputVar = '';
     $.ajax({
        type: "GET",
        //url: "https://c-iprocure.com/scp/api/quote/readed.php",
        url: "<?php echo $md_url; ?>",
        dataType: "json",
        timeout: 60000,
        success: _loadingposuccess,
        error: _loadingpofailure,
    });
    }
    
    function _loadingposuccess(data) {
        if (typeof data !== 'object' || !isArray(data.records)) {
            console.log("Unexpected server response: Status - " + status + " returnedData - " + JSON.stringify(data));
            $('.pogeneration').html("<p class='alert alert-danger'>There was a problem loading all request, please try again, or check your internet");
            return;
        }
        if (data.records.length) {
            outputVar = '<table id="procurement" class="table table-responsive table-hover table-bordered"><thead><th style="width:10%"><b>ID</b></th><th style="width:10%"><b>Vendor Name</b></th><th style="width:25%"><b>Item Description</b></th><th style="width:15%"><b>Amount</b></th><th style="width:25%"><b>Audit</b></th><th style="width:15%"><b>Action</b></th></thead><tbody>';
          for (var idx = data.records.length - 1; idx >= 0; --idx) {
           
                outputVar += '<tr><td>' + data.records[idx].batchid + '</td><td>' + data.records[idx].names + '</td> <td>' + data.records[idx].subject + '</td><td><b>' + data.records[idx].curr_abrev + ' ' + converto_number(data.records[idx].total) + '</b></td><td>' + data.records[idx].audit + '</td><td>\n\
                    <span title="Approve Quote" style="cursor:pointer" onClick=approvequote(\'' + data.records[idx].batchid + '\') class="btn-xs btn-success"><i class="fa fa-check" aria-hidden="true"></i></span>&nbsp; \n\
                    <span title="Cancel Quote" style="cursor:pointer" onClick=rejectquote(\'' + data.records[idx].batchid + '\') class="btn-xs btn-danger"><i class="fa fa-times" aria-hidden="true"></i></span> &nbsp; \n\
                    <span title="View Quote" onClick=quoteview(\''+ data.records[idx].batchid +'\') style="cursor:pointer" quoteid='+data.records[idx].batchid+'  class="getallquotesdetals btn-xs btn-primary"><i class="fa fa-picture-o"></i></span></td></tr>';
            }
            outputVar += '</tbody></table>';
            $('.pogeneration').html(outputVar);
        } else {
            $('.pogeneration').html("<p style='color:red'>No Quote Found");
        }
    }


   function approvequote(id){
    var action = GLOBALS.appRoot + "home/approvequotation";
    if(id == ""){
       alert("Important variable to process page missing, Please contact Administrator");
       return;
      }else{
          
           $.post(action, {id: id}, function (data){ 
             if(data.status == 200){
                 //$('#errorCase').html(data.msg).addClass('errorGreen')
                 alert(data.msg);
                 firstload()
             }
           
        });
        
      }
    }
    
   function rejectquote(id){
    var action = GLOBALS.appRoot + "home/rejectquoteforprocurement";
    if(id == ""){
       alert("Important variable to process page missing, Please contact Administrator");
       return;
      }else{
          
           $.post(action, {id: id}, function (data){ 
             if(data.status == 200){
                 //$('#errorCase').html(data.msg).addClass('errorGreen')
                 alert(data.msg);
                 firstload()
             }
           
        });
        
      }
    }
    
    
    
   function quoteview(id){
    $('.pogeneration').html("loading po details, please wait");
      //https://c-iprocure.com/scp/api/quote/read_all.php?id=81545183320200420
        $.ajax({
           type: "GET",
           url: "https://c-iprocure.com/scp/api/quote/readed_all.php?id="+id+" ",
           dataType: "json",
           timeout: 60000,
           success: _loadingpodetails,
           error: _loadingpofailure,
       });
       
       //fetchfiles(id);

    }
  
    function _loadingpodetails(data) {
          $('.pogeneration').html("Getting data from procurement portal, please wait..");
        var qoutputVar = '';
        if (typeof data !== 'object' || !isArray(data.records)) {
            console.log("Unexpected server response: Status - " + status + " returnedData - " + JSON.stringify(data));
            $('.pogeneration').html("<p class='alert alert-danger'>There was a problem loading all request, please try again, or check your internet");
            return;
        }
        if (data.records.length) {
            var sum = 0;
            $('.pogeneration').html("loading po details for"+ data.batchid);
            qoutputVar = '<table id="procurement" class="table table-responsive table-hover table-bordered"><thead><th style="width:10%"><b>ID</b></th><th style="width:10%"><b>Date</b></th><th style="width:20%"><b>Vendor Name</b></th><th style="width:10%"><b>Category</b></th><th style="width:20%"><b>Item Description</b></th><th style="width:5%"><b>Qty</b></th>\n\
                <th style="width:10%"><b>Amount</b></th><th style="width:10%"><b>Total</b></th></thead><tbody>';
          for (var i = data.records.length - 1; i >= 0; --i) {
                sum += Number(data.records[i].total);
                qoutputVar += '<tr><td>' + data.records[i].batchid + '</td><td>' + data.records[i].biddatetime + '</td> <td>' + data.records[i].names + '</td> <td>' + data.records[i].ItemDescription + '</td> <td>' + data.records[i].subject + '</td> <td>' + data.records[i].quantity + '</td>\n\
                    <td>' + data.records[i].curr_abrev + ' ' + converto_number(data.records[i].bidamount) + '</td><td><b>' + data.records[i].total + '</b></td></tr>';
             fetchfiles(data.records[i].batchid);
            }
            qoutputVar += '<tr><td colspan="7"><b>Total</b></td><td><b>'+ converto_number(sum) + '</b></td></tr><span class="btn btn-sm btn-primary pull-right" onClick="goBack()">Go Back</span></tbody></table><div class="allfiles"></div>';
            $('.pogeneration').html(qoutputVar);
           
        } else {
            $('.pogeneration').html("<p style='color:red'>No Quote Found");
        }
    }
  
  
  
  const fetchfiles = (id) => {
   var xid = 0;
   axios.get("https://c-iprocure.com/scp/api/quote/readed_file.php?id="+id+" ")
        .then(response => {
            //const files = response.filex;
            console.log(response.data.records);
            const files = response.data.records.map((file, index) => {
                    console.log(file.filex);
                    const mfile = file.filex;
                    if(mfile && mfile !== 'undefined'){
                        xid =  xid + 1; 
                        $('.allfiles').prepend('<a target="_blank" href="https://c-iprocure.com/scp/user_data/'+ mfile +'">Attachment '+ xid +'</a>' + "<br/>"); 
                    }
                });
          
        })
      .catch(error => console.log(error.message));
     }
  
  
  
   function goBack(){
     $('.pogeneration').append('<div style="text-align:center;"><img src="https://c-iprocure.com/expensepro/public/images/giphy.gif" style="width:300px"/></div>');
     firstload();
    }
  
  
  
  
    
   function converto_number(number){
      return $.number(number);
    }
    
    function _loadingpofailure(error) {
          $('.pogeneration').html('<font style="color:red">We couldnot pull data from procurement, please try later</font> ');
           $('.pogeneration').append(error.responseText);
        console.log("Error: request - " + error.responseText);
       }
     
 </script>
 
 
 
 
 
                                 
 <script>
   $(document).ready(function(){
       
        var table = $('#reqeustapproval');
        var oTable = table.DataTable({
            "order": [[0, "desc" ]]
           
        });  
        
        
    });
</script>   

<script>
   $(document).ready(function(){
       
       $('#procurement').DataTable({
           dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ]
       });
  
    });
</script>  

<script>
    //Posting Cashiers payment
    $('.getallquotesdetals').click(function(e){
	 var quoteid = $(this).attr('quoteid');
         if(quoteid === ""){
             alert("Important Variable to render this page is missing, please refresh");
         }else{
             
              $.ajax({
                type: "GET",
                url: "https://c-iprocure.com/scp/api/quote/readed_all.php?id="+quoteid+" ",
                dataType: "json",
                timeout: 60000,
                success: _loadingpodetialsforhod,
                error: _loadingpofailure,
            });
       
           
          }
    });
    
      function _loadingpodetialsforhod(data) {
          $('#putoption').html("Getting data from procurement portal, please wait..");
        var qoutputVar = '';
        if (typeof data !== 'object' || !isArray(data.records)) {
            console.log("Unexpected server response: Status - " + status + " returnedData - " + JSON.stringify(data));
            $('#putoption').html("<p class='alert alert-danger'>There was a problem loading all request, please try again, or check your internet");
            return;
        }
        if (data.records.length) {
            var sum = 0;
            $('#putoption').html("loading po details for"+ data.batchid);
            qoutputVar = '<div class="table-responsive"><table id="procurement" class="table table-responsive table-hover table-bordered"><thead><th style="width:10%"><b>ID</b></th><th style="width:10%"><b>Date</b></th><th style="width:20%"><b>Vendor Name</b></th><th style="width:10%"><b>Category</b></th><th style="width:20%"><b>Item Description</b></th><th style="width:5%"><b>Qty</b></th>\n\
                <th style="width:10%"><b>Amount</b></th><th style="width:10%"><b>Total</b></th></thead><tbody>';
          for (var i = data.records.length - 1; i >= 0; --i) {
                sum += Number(data.records[i].total);
                qoutputVar += '<tr><td>' + data.records[i].batchid + '</td><td>' + data.records[i].biddatetime + '</td> <td>' + data.records[i].names + '</td> <td>' + data.records[i].ItemDescription + '</td> <td>' + data.records[i].subject + '</td> <td>' + data.records[i].quantity + '</td>\n\
                    <td>' + data.records[i].curr_abrev + ' ' + converto_number(data.records[i].bidamount) + '</td><td><b>' + data.records[i].total + '</b></td></tr>';
             fetchfiles(data.records[i].batchid);
            }
            qoutputVar += '<tr><td colspan="7"><b>Total</b></td><td><b>'+ converto_number(sum) + '</b></td></tr></tbody></table></div><div class="allfiles"></div>';
            $('#putoption').html(qoutputVar);
           
        } else {
            $('#putoption').html("<p style='color:red'>No Quote Found");
        }
    }
    
    
    
  function approvequotes(id){
    var action = GLOBALS.appRoot + "home/approvequotation";
    if(id == ""){
       alert("Important variable to process page missing, Please contact Administrator");
       return;
      }else{
          
           $.post(action, {id: id}, function (data){ 
             if(data.status == 200){
                 //$('#errorCase').html(data.msg).addClass('errorGreen')
                 alert(data.msg);
                setTimeout(function(){ window.location.reload(1); });
             }
           
        });
        
      }
    }
    
   function rejectquotes(id){
    var action = GLOBALS.appRoot + "home/rejectquoteforprocurement";
    if(id == ""){
       alert("Important variable to process page missing, Please contact Administrator");
       return;
      }else{
          
           $.post(action, {id: id}, function (data){ 
             if(data.status == 200){
                 //$('#errorCase').html(data.msg).addClass('errorGreen')
                 alert(data.msg);
                 setTimeout(function(){ window.location.reload(1); });
             }
           
        });
        
      }
    }
    
    
</script>
                
             
   <?php echo $footer; ?>