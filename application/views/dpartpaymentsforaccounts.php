
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
	                                <h4 class="title">ALL PART PAYMENT</h4>
                                            <p>pending part payment</p>
	                            </div>
								
                                    <p id="errorme"></p>			
	                            <div class="card-content table-responsive table-condensed">
	                                <table class="table table-condensed" id="mydatahome" >
	                                    <thead class="text-primary">
	                                    	<th>ID</th>
	                                    	<th>Date</th>
                                                <th>Description</th>
                                                <th>Requester</th>
                                                <th>Beneficiary</th>
                                                <th>Location</th>
                                                <th>Actual Amount</th>
	                                    	<th>Paid Amount</th>
                                                <th>Balance</th>
                                                <th style="width:120px">Action</th>
	                                    </thead>
	                                    <tbody>
	                                     
						<?php if ($getallPartpayment) { ?>
						<?php
                                                    foreach ($getallPartpayment as $get) {
                                                         $id = $get->id;
                                                         $dateCreated = $get->dateCreated;
							 $partPay = $get->partPay;
							 $dAmount = $get->dAmount;
							 $ndescriptOfitem = $get->ndescriptOfitem;
							 $dCashierwhopaid = $get->dCashierwhopaid;
                                                         $approvals = $get->approvals;
                                                         $sessionID = $get->sessionID;
                                                         $dLocation = $get->dLocation;
                                                         $fullname = $get->fullname;
                                                         $CurrencyType = $get->CurrencyType;
                                                          $benName = $get->benName;
                                                           $from_app_id = $get->from_app_id;
                                                          
                                                           if ($from_app_id == 3 || $from_app_id == '3') {
                                                                $vendors = @$this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "USER_ID", $get->benName);
                                                            }else if($from_app_id == 8){
                                                                 $vendors = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $get->benName);
                                                            }else if($from_app_id == '0' && is_numeric($get->benName)){
                                                               $vendors = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $get->benName);
                                                            }else if($from_app_id == '0' && !is_numeric($get->benName)){
                                                                $vendors =  $get->benName;
                                                            }else {
                                                               $vendors = $get->benName;
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
                                                        }else{
                                                           $newCurrency = '<span>&#8358;</span>';
                                                        }
                                                         
                                                         $balance = $dAmount - $partPay;
                                                ?>
                                                			 
	                                     <tr>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $dateCreated; ?></td>
                                            <td style="padding-left:5px; padding-right:5px;" ><a href=""><a href="<?php echo base_url(); ?>home/viewreqeuestdetails/<?php echo $id; ?>/<?php echo $ndescriptOfitem; ?>"><?php echo $ndescriptOfitem; ?></a></a></td>
                                            <td><?php echo $fullname; ?></td>
                                             <td><?php echo $vendors; ?></td>
                                            <td><?php
                                                if(is_numeric($dLocation)){
                                                     echo $this->mainlocation->getdLocation($dLocation);
                                                }else{
                                                    echo $dLocation;
                                                }
                                            ?></td>  
                                            <td style="color:green; font-weight:bolder"><?php echo $newCurrency. @number_format($dAmount, 2); ?></td>
                                            <td style="color:blue;  font-weight:bold"><?php echo $newCurrency. @number_format($partPay, 2); ?></td>
                                            <td style="color:red;  font-weight:bold"><?php echo $newCurrency. @number_format($balance, 2); ?></td>
                                             <td>
                                                <?php
                                                $randomString = random_string('alnum', 60);
                                            if($dAmount !== $partPay ){
                                            echo "<a href='".base_url()."home/completepay/$id/$dAmount/$dCashierwhopaid/$randomString' class='btn btn-xs btn-success' title='Confirm Payment'>C</a>&nbsp;&nbsp;"
                                                    . "<a href='".base_url()."paycheques/partpaymentdetails/$id'><button class='btn btn-xs btn-facebook'>V</button></a><span title='print' class='btn btn-xs btn-default' onClick='printchequerequests($id)'>P</span>";
                                              }
                                                ?>
                                             </td>
                                             </tr>			
					<?php } ?>

                                         <?php } ?>	
											
	                                    </tbody>
	                                </table>

	                            </div>
	                        </div>
	                    </div>
						
                         <!-- End of Request Details with Status -->
                         
                                
                                
                                
                            <!-- Inside Content Ends Here -->
                            
                            
	                </div>
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                
 <script>
   $(document).ready(function(){
        var table = $('#mydatahome');
        var oTable = table.DataTable({
            "order": [[0, "desc" ]]
           
        });
  
    });
</script>                 
                
   <?php echo $footer; ?>