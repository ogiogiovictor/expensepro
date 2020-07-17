
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
                            
                            
                         
                         
                         <div class="col-md-12">
	                        <div class="card">
	                           <div class="card-header" data-background-color="blue">
	                                <h4 class="title">Request For My Approval</h4>
	                                <p class="category">All Latest Request Awaiting Approval</p>
	                            </div>
                                    
                                    
                                    <div class="row">
                                        <div class="col-md-3">
                                            
                                           <div style="margin-left:20px; margin-top:5px; width:250px; padding:5px; border:1px solid whitesmoke">
                                                <form class="form-inline" role="form" action="<?php echo base_url().'accounts/searchunpaidcheques'; ?>" method="POST">

                                                    <br/>
                                                    <span style="color:blue">Search Parameter : ID, Amount, Benficiary, Requester, Email, Amount </span><br/>

                                                    <select style="width:200px"  name="searchcriteria" class="form-controls">
                                                        <option value="">Select Criteria</option>
                                                        <option value="id">ID</option>
                                                        <option value="fullname">Requester Name</option>
                                                        <option value="benName">Beneficiary Name</option>
                                                        <option value="dAmount">Amount</option>
                                                        <option value="sessionID">Email</option>
                                                    </select>
                                                    <br/>
                                                     <input style="width:200px" name="search" placeholder="" type="text" class="form-controls"  id="search">
                                                     <br/>
                                                     <button type="submit" class="btn btn-xs btn-facebook">Go</button>

                                                <!--<button style="margin-top:30px" type="submit" class="btn btn-sm btn-facebook">Go</button>-->
                                                </form>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="col-md-3">
                                            
                                            <div style="margin-left:20px; margin-top:5px; width:250px; padding:5px; border:1px solid whitesmoke">
                                                <form class="form-inline" role="form" action="<?php echo base_url().'accounts/searchunpaidchequesm'; ?>" method="GET">

                                                    <br/>
                                                    <span style="color:blue">Search Parameter : Month / Year </span><br/>

                                                    <select style="width:200px"  name="dyear" id="dyear" class="form-controls">
                                                        <option value="">Select Year</option>
                                                        <option value="2017">2017</option>
                                                        <option value="2018">2018</option>
                                                        <option value="2019">2019</option>
                                                        <option value="2020">2020</option>
                                                    </select>
                                                    <br/>
                                                    <?php
                                                      /* echo "<select name=month>";
                                                            for($i=0;$i<=11;$i++){
                                                            $month=date('F',strtotime("first day of -$i month"));
                                                            echo "<option value=$month>$month</option> ";
                                                            }
                                                            echo "</select>";
                                                       * 
                                                       */
                                                     ?>
                                                  
                                                    <select style="width:200px"  name="dmonth" id="dmonth" class="form-controls">
                                                       <option value="">Select Month</option>
                                                       <option value="01">January</option>
                                                       <option value="02">February</option>
                                                       <option value="03">March</option>
                                                       <option value="04">April</option>
                                                       <option value="05">May</option>
                                                       <option value="06">June</option>
                                                       <option value="07">July</option>
                                                       <option value="08">August</option>
                                                       <option value="09">September</option>
                                                       <option value="10">October</option>
                                                       <option value="11">November</option>
                                                       <option value="12">December</option>
                                                    </select>
                                                    
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
                                                     <select style="width:200px"  name="dUnit" id="dUnit" class="form-controls">
                                                       <option value="">Select Unit</option>
                                                       <?php echo $dunit; ?>
                                                    </select>
                                                    
                                                    <select style="width:200px"  name="searchrange" id="searchrange" class="form-controls">
                                                        <option value="">Select Range</option>
                                                        <option value="1000, 50000">1000 - 50,000</option>
                                                        <option value="50000, 500000">50,000 - 500,000</option>
                                                        <option value="500000, 5000000">500,000 - 5,000,000</option>
                                                        <option value="5000000, 10000000">5,000,000 - 10,000,000</option>
                                                        <option value="10000000, 30000000">10,000,000 - 30,000,000</option>
                                                        <option value="30000000, 60000000">30,000,000 - 60,000,000</option>
                                                        <option value="60000000, 100000000">60,000,000 - 100,000,000</option> 
                                                    </select>
                                                     
                                                     <button type="submit" class="btn btn-xs btn-facebook">Go</button>

                                                <!--<button style="margin-top:30px" type="submit" class="btn btn-sm btn-facebook">Go</button>-->
                                                </form>
                                            </div>
                                            
                                        </div>
                                        
                                        
                                        
                                        <div class="col-md-3">
                                             <div style="margin-left:20px; margin-top:5px; width:250px; padding:5px; border:1px solid whitesmoke">
                                                <form class="form-inline" role="form" action="<?php echo base_url().'accounts/searchunpaidchequesms'; ?>" method="POST">

                                                    <br/>
                                                    <span style="color:blue">Search Range : By Range(Amount) </span><br/>

                                                    <select style="width:200px"  name="searchrange" id="searchrange" class="form-controls">
                                                        <option value="">Select Range</option>
                                                        <option value="1000, 50000">1000 - 50,000</option>
                                                        <option value="50000, 500000">50,000 - 500,000</option>
                                                        <option value="500000, 5000000">500,000 - 5,000,000</option>
                                                        <option value="5000000, 10000000">5,000,000 - 10,000,000</option>
                                                        <option value="10000000, 30000000">10,000,000 - 30,000,000</option>
                                                        <option value="30000000, 60000000">30,000,000 - 60,000,000</option>
                                                        <option value="60000000, 100000000">60,000,000 - 100,000,000</option> 
                                                    </select>
                                                    <br/>
                                                    
                                                     <button type="submit" class="btn btn-xs btn-facebook">Go</button>

                                                <!--<button style="margin-top:30px" type="submit" class="btn btn-sm btn-facebook">Go</button>-->
                                                </form>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="col-md-3">
                                            <!--four -->
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <span style="clear:both"></span>
					<?php
                                        echo @$message = $this->session->flashdata('data_name');
                                        ?>
	                            <div class="card-content">
                                        <center><span id="icuacceptrequest"></span></center>
                                        
                                        <span style="font-size:20px; font-weight:bold">
                                        <?php 
                                        echo "Search Result:  ". $fdyear. "-". $dMonth. "  ". $dUnit;
                                        ?>
                                        </span>
	                                <table class="table table-responsive table-bordered table-hover" id="trickaccount">
	                                    <thead class="text-primary">
                                               
	                                    	<th>ID</th>
                                                <th>Date</th>
	                                    	<th style="width:250px; padding-left:5px; padding-right:5px;">Description of Item</th>
                                                <th>Requester</th>
                                                <th>Location</th>
                                                <th>Amount</th>
						<th>Date(ICU)</th>
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
							 $sessionID = $get->sessionID;
							 $dateRegistered = $get->dateRegistered;
                                                         $dAmount = $get->dAmount;
                                                         $dLocation = $get->dLocation;
                                                         $partPay = $get->partPay;
                                                         $benName = $get->benName;
                                                         $dAccountgroup = $get->dAccountgroup;
                                                         $ChecknPayment = $get->nPayment;
                                                         $fullname = $get->fullname;
                                                         $CurrencyType = $get->CurrencyType;
                                                         $dateICUapprove = $get->dateICUapprove;
                                                         $from_app_id = $get->from_app_id;
                                                
                                                        if($partPay !="" && $partPay != "0" && $partPay < $dAmount){
                                                           $newAmount = @number_format($partPay, 2)." <br/>Part Payment";
                                                          }else{
                                                           $newAmount = @number_format($dAmount, 2);
                                                        }	
                                                        
                                                if($CurrencyType == 'naira'){
                                                    $newCurrency = '<span>&#8358;</span>';
                                                }else if($CurrencyType == 'dollar'){
                                                    $newCurrency = '<span>&#x0024;</span>';
                                                }else if($CurrencyType == 'euro'){
                                                    $newCurrency = '<span>&#8364;</span>';
                                                }else if($CurrencyType == 'pounds'){
                                                    $newCurrency = '<span>&#163;</span>';
                                                }else if($CurrencyType == 'yen'){
                                                    $newCurrency = '<span>&#165;</span>';
                                                }else if($CurrencyType == 'singaporDollar'){
                                                    $newCurrency = '<span>S&#x0024;</span>';
                                                }else if($CurrencyType == 'AED'){
                                                    $newCurrency = '<span>(AED)</span>';
                                                }else if($CurrencyType == 'rupee'){
                                                    $newCurrency = '<span>&#8377;</span>';
                                                }else{
                                                   
                                                    if($CurrencyType != ""){
                                                      $newCurrency = @$this->generalmd->getsinglecolumnfromotherdb("curr_symbol", "currencies", "curr_abrev", $CurrencyType); 
                                                    }else if($CurrencyType == "null" || $CurrencyType == ""){
                                                        $newCurrency =  '<span>&#8358;</span>';
                                                    }else{
                                                        $newCurrency =  '<span>&#8358;</span>';
                                                    }
                                                    
                                                }
                                            
                                                /* if($approvals == 0){
                                                     $newapproval = "Pending";
						 }else if($approvals == 1){
                                                     $newapproval = "<span style='color:red'>Awaiting HOD Approval</span>";
						 }else if($approvals == 2){
                                                     $newapproval = "<span style='color:blue'>Awaiting ICU Approval</span>";
						 }else if($approvals == 3){
                                                     $newapproval = "<span style='color:indigo'>Awaiting Payment</span>";
						 }else if($approvals == 4){
                                                     $newapproval = "<span style='color:green'>Ready for Collection</span>";
						 }else if($approvals == 5){
                                                     $newapproval = "<span style='color:red'>Not Approved By HOD</span>";
						 }else if($approvals == 6){
                                                     $newapproval = "<span style='color:grey'>Reject by ICU</span>";
						 }else if($approvals == 7){
                                                     $newapproval = "<span style='color:indigo'>Cheque Sent for Signature</span>";
						 }else if($approvals == 8){
                                                     $newapproval = "<span style='color:green'>Signed & Ready for Collection</span>";
						 }else if($approvals == 11){
                                                     $newapproval = "<span style='color:brown'>Closed</span>";
						 }else if($approvals == 12){
                                                     $newapproval = "<span style='color:brown'>Rejected By Accounts</span>";
						 }
                                                 
                                                 * 
                                                 */
                                                  $newapproval = $this->generalmd->getsinglecolumn("name", "approval_type", "approval_type",  $approvals);
                                                  
						 // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod) 
                                                  // approve = 3(approved by hod) approve = 4 (paid) 
                                                
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
                                                
                                                 <tr>
                                            <td><?php echo $id; ?></td>
                                             <td><?php echo $dateCreated; ?></td>
                                             <td style="padding-left:5px; padding-right:5px;"><a href="<?php echo base_url(); ?>home/approvaldetails/<?php echo $id; ?>/<?php echo $md5_id; ?>/<?php echo $newrandomString; ?>"><?php echo $ndescriptOfitem; ?></a>
                                               <br/>
                                               <?php 
                                                 echo $vendor = $vendor !='' ? "<small style='color:red'>(VENDOR: ". ucwords($vendor) . ")</small>" : ''; 
                                            
                                               ?>
                                             </td>
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
                                            <td><small class="badge badge-danger"><?php echo get_timeago(strtotime($dateICUapprove)); ?></small></td>
                                             <td><?php echo $newapproval; ?></td>
                                            <td>
                                             <?php
                                             if ($getApprovalLevel == 7 && $approvals == 3 && ($CurrencyType == 'naira' || $CurrencyType == 'NGN')) {
                                                echo "<span title='Approve' class='btn btn-xs btn-success' onClick='approvecheques($id, $dAccountgroup, $dAmount)'><i class='material-icons'>check</i></span>";
                                             }
                                            ?>
                                                
                                                
                                             <?php
                                             if ($getApprovalLevel == 7 && $approvals == 3) {
                                                //echo "<span title='Approve' class='btn btn-xs btn-success' onClick='approvecheques($id, $dAccountgroup, $dAmount)'><i class='material-icons'>check</i></span>";
                                                
                                                echo "
                                               <a href='".base_url()."paycheques/preparecheque/$id/$md5_id/$approvals/$newrandomString' title='Prepare Cheque'><span title='Cheque Preparation' class='btn btn-xs btn-warning' >C</span></a>"
                                                        . "&nbsp;<input type='submit' title='Reject' name='theaccountantrejectedit' data-id='$id' class='theaccountantrejectedit btn btn-xs btn-danger disposebox'  value='X' class='btn btn-xs btn-danger'/>";
                                            }else{
                                                echo "";
                                            }
                                           
                                            ?>
                                                
                                                
                                                
                                                
                                                
                                             <?php
                                           if ($getApprovalLevel == 7  && $approvals == 3){
                                               echo "<span title='print' class='btn btn-xs btn-default' onClick='printchequerequests($id)'><i class='material-icons'>print</i></span>"; 
                                           }else{
                                               echo "";
                                           }
                                           ?>
                                           <?php
                                           if($approvals !== '4' || $approvals == '7'){
                                              echo "<a title='view' href='".base_url()."home/approvaldetails/$id/$md5_id/$newrandomString'><span class='btn btn-xs btn-facebook'><i class='material-icons'>insert_drive_file</i></span></a>";
                                            
                                           }else{
                                           echo "";
                                           }
                                           
                                           ?>
                                                
                                               <?php
                                           if ($getApprovalLevel == 7 ){
                                             //  echo "<a href='".base_url()."checkbook/index/$id/$md5_id/$approvals/$newrandomString' title='Print Cheque Book'><span title='Print Cheque Book' class='btn btn-xs btn-info' >P</span></a>"; 
                                           }else{
                                              // echo "";
                                           }
                                           ?>
                                            </td>
                                                
                                             
                                              <?php } ?>

                                         <?php } ?>	
						
                                            </tbody>
                                            
                                        </table>
                                        
                                        <center><?php echo $paginationLinks; ?></center>

	                            </div>
	                        </div>
	                    </div>
						
                       <!-- End of Request Details with Status -->
                         
                          <div id="disposebox">
                                <p id="myacctputalert"></p>
                           </div> 
                                
                                
                            <!-- Inside Content Ends Here -->
                            
	                </div>
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                
                
   <script>
    
  $(document).ready(function() {
     $('#trickaccount').DataTable( {
        dom: 'Bfrtip',
        paging:   'false',
        buttons: ['excel', 'pdf']
    });
    
        
});
</script>  
   <?php echo $footer; ?>