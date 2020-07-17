
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
                                    
                                    
                                     <?php echo $mainsearchform; ?>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <span style="clear:both"></span>
					<?php
                                        echo @$message = $this->session->flashdata('data_name');
                                        ?>
	                            <div class="card-content">
                                        <center><span id="icuacceptrequest"></span></center>
                                        
                                        <span style="font-size:20px; font-weight:bold">
                                        <?php 
                                       
                                        if($fdyear){
                                             echo "Search Result:  ". @$fdyear. "-". @$dMonth. "  ". @$dUnit;
                                        }else if($oneSecond){
                                             echo "Search Range:  ". @number_format($oneFirst, 2). " - ". @number_format($oneSecond, 2);
                                        }
                                        
                                        ?>
                                        </span>
	                                <table class="table" id="myfulldatatable">
	                                    <thead class="text-primary">
                                               
	                                    	<th>ID</th>
                                                <th>Date</th>
	                                    	<th style="width:250px; padding-left:5px; padding-right:5px;">Description of Item</th>
                                                <th>Requester</th>
                                                <th>Location</th>
                                                 <th>Unit</th>
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
							 $sessionID = $get->sessionID;
							 $dateRegistered = $get->dateRegistered;
                                                         $dAmount = $get->dAmount;
                                                         $dLocation = $get->dLocation;
                                                         $dUnit = $get->dUnit;
                                                         $partPay = $get->partPay;
                                                         $benName = $get->benName;
                                                         $dAccountgroup = $get->dAccountgroup;
                                                         $ChecknPayment = $get->nPayment;
                                                         $fullname = $get->fullname;
                                                         $CurrencyType = $get->CurrencyType;
                                                
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
                                            
                                                 if($approvals == 0){
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
						 // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod) 
                                                  // approve = 3(approved by hod) approve = 4 (paid) 
                                                 
                                                 if($dAmount){
                                                     $sumall += $dAmount;
                                                 }else{
                                                     $sumall = "";
                                                 }
                                                                                                 
						?>
                                                 <?php 
                                                   $newrandomString = random_string('alnum', 60);
                                                ?>
                                                
                                                 <tr>
                                            <td><?php echo $id; ?></td>
                                             <td><?php echo $dateCreated; ?></td>
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
                                            
                                            <td><?php
                                               if(is_numeric($dUnit)){
                                                    echo $getDepartment =  $this->mainlocation->getdunit($dUnit); 
                                                }else{
                                                    echo $getDepartment = $dUnit;
                                                }
                                              
                                            ?>
                                            </td>
                                            
                                            <td><?php echo $newCurrency.$newAmount; ?></td>
                                            <td><?php echo $newapproval; ?></td>
                                            <td>
                                                <?php
                                              echo "<a href='".base_url()."home/viewreqeuestdetails/$id/$approvals/$md5_id'><button class='btn btn-xs btn-facebook' title='View Details'>V</button></a>"
                                               
                                             ?>
                                            </td>
                                                
                                             
                                              <?php } ?>

                                         <?php } ?>	
						
                                            </tbody>
                                            
                                        </table>
                                        <hr/>
                                        <div style="color:black; font-size: 25px; font-weight:bolder">Total Sum: <?php echo @number_format($sumall, 2); ?></div>

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
   $(document).ready(function(){
        var table = $('#myfulldatatable');
        var oTable = table.DataTable({
            "order": [[0, "desc" ]]
           
        });

        
    });
</script>                 
     
   <?php echo $footer; ?>