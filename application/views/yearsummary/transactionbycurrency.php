
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
	                                <h4 class="title">Transactions</h4>
                                        <p class="category">Currency transaction</b></p>
	                            </div>
								
								
	                            <div class="card-content">
	                               
	                                <table class="table table-responsive table-condensed" id="cashierrequest">
	                                    <thead class="text-primary">
	                                    	<th>ID</th>
                                                <th>Date Created</th>
	                                    	<th style="width:200px">Description of Item</th>
	                                    	<th>Location</th>
                                                <th>Unit</th>
                                                <th>Payment</th>
                                                <th>Amount</th>
                                                <th>Requester</th> 
                                                <th>Beneficiary's Name</th>
                                                <th>Paid By</th>
                                                
	                                    </thead>
                                            <tbody> <?php if ($getallResult) { ?>
                                               <?php
                                                    foreach ($getallResult as $get) {
							$id = $get->id;
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
                                                        $dUnit = $get->dUnit;
                                                        $datePaid = $get->datepaid;
                                                        $benName = $get->benName;
                                                        $benEmail = $get->benEmail;
                                                        $fullname = $get->fullname;
                                                        $dCashierwhopaid = $get->dCashierwhopaid;
                                                        $CurrencyType = $get->CurrencyType;
                                                        
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
                                                    <td style="width:5px"><?php echo $id; ?></td>
                                                    <td style="width:5px"><?php echo $dateCreated; ?></td>
                                                    <td style="width:30px"><?php echo $ndescriptOfitem; ?></td>
                                                    <td style="width:10px"><?php 
                                                    if(is_numeric($dLocation)){
                                                      echo $this->mainlocation->getdLocation($dLocation);  
                                                    }else{
                                                        echo $dLocation;
                                                    }
                                                     ?></td> 
                                                    <td style="width:10px"><?php echo $this->cashiermodel->bringmyunits($dUnit); ?></td>
                                                     <td style="width:10px"><?php echo $nPayment; ?></td>
                                                    <td style="width:10px"><?php echo $newCurrency.@number_format($dAmount, 2); ?></td>
                                                    <td style="width:10px"><?php echo $fullname; ?></td>
                                                    <td style="width:10px"><?php echo $benName; ?></td>
                                                    <td style="width:10px"><?php echo $dCashierwhopaid; ?></td>
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
        var table = $('#cashierrequest');
        var oTable = table.DataTable({
            "order": [[0, "desc" ]]
           
        });
        
    
        
    });
</script>                       
                
   <?php echo $footer; ?>