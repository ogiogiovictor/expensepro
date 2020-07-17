
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
	                                <h4 class="title">VENDORS</h4>
                                       
	                            </div>
				
	                            <div class="card-content table-responsive table-condensed">
                                        <span id="icuacceptrequest"></span>
	                                <table class="table" id="reqeustapproval">
	                                    <thead class="text-primary">
                                               
	                                    	<th>ID</th>
                                                <th>Date</th>
	                                    	<th style="width:250px; padding-left:5px; padding-right:5px;">Description of Item</th>
                                                <th>Requester</th>
                                                <th>Beneficiary</th>
                                                <th>Location</th>
                                                <th>Amount</th>
						<th>Status</th>
	                                    </thead>
	                                    <tbody>
	                                     
						<?php if ($getallRequest) { ?>
						<?php
                                                $sumall = "";
                                                    foreach ($getallRequest as $get) {
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
                                                         $dUnit = $get->dUnit;
                                                
                                                        if($partPay != "0.00" && $partPay < $dAmount){
                                                           $newAmount = @number_format($partPay, 2)." <br/>Part Payment";
                                                          }else{
                                                           $newAmount = @number_format($dAmount, 2);
                                                        }	
                                                       
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
                                                 $dAmount = 0;
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
                                             <td>
                                                 <?php echo $dateCreated; ?>
                                             </td>
                                            <td style="padding-left:5px; padding-right:5px;"><a href="<?php echo base_url(); ?>home/viewreqeuestdetails/<?php echo $id; ?>/<?php echo $approvals; ?>/<?php echo $newrandomString; ?>"><?php echo $ndescriptOfitem; ?></a></td>
                                            <td><?php echo $fullname; ?></td>
                                            <td><?php echo $vendor; ?></td>
                                            
                                            <td><?php
                                                if(is_numeric($dLocation)){
                                                     echo $this->mainlocation->getdLocation($dLocation);
                                                }else{
                                                    echo $dLocation;
                                                }
                                            ?>
                                            </td>
                                            
                                            <td><?php echo $newCurrency.$newAmount; ?></td>
                                            <td><?php echo $newapproval; ?></td>
                                           
                                            </tr>
											
						 <?php } ?>

                                         <?php } ?>	
						
                                           
	                                    </tbody>
	                                </table>
                                       
                                        
                                         
	                            </div>
	                        </div>
	                    </div>
						
                      
                            
	                </div>
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                        
 <script>
   $(document).ready(function(){
       
        var table = $('#reqeustapproval');
        var oTable = table.DataTable({
            "order": [[0, "desc" ]]
           
        });  
        
        
    });
</script>                            
                               
             
   <?php echo $footer; ?>