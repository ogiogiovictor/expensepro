
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
                                               
	                                    	<th>Count</th>
                                                <th>Unit</th>
	                                    	<th style="width:250px; padding-left:5px; padding-right:5px;">Vendor Name</th>
                                                <th>Amount</th>
						<th>Type</th>
                                                <th>Status</th>
                                                <th style="width:200px">Action</th>
	                                    </thead>
	                                    <tbody>
                                                
                                                
	                                     <?php
                                                if($getallVendors){  
                                                    foreach($getallVendors as $get){ 
                                                        $id = $get->IDS;
                                                        $benName = $get->benName;
                                                        $Amount = $get->Amount;
                                                        $approvals = $get->approvals;
                                                        $dCount = $get->dCount;
                                                        $dUnit = $get->dUnit;
                                                        $from_app_id  = $get->from_app_id;
                                                        $CurrencyType = $get->CurrencyType;
                                                        
                                                         $nPayment = $this->mainlocation->getpaymentType($get->nPayment);
                                                        
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
                                                        
                                                    
                                             ?>
                                       
                                                <tr>
                                                     <td><?php echo $dCount; ?></td>
                                                   <td><?php echo  $this->generalmd->getuserAssetLocation("unitName", "cash_unit", "id", $dUnit);; ?></td>
                                                    <td><?php echo $vendor; ?></td>
                                                    <td><?php echo $newCurrency. @number_format($Amount); ?></td>
                                                     <td><?php echo $nPayment; ?></td>
                                                    <td><?php echo $newapproval; ?></td>
                                                    <td><a href="<?php echo base_url(); ?>vendors/getdetails/<?php echo $id; ?>" class="btn btn-sm btn-danger">View</a></td>
                                                   
                                                </tr>
					
                                           <?php
                                           
                                              }
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