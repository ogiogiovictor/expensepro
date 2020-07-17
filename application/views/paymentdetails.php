
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
	                                <h4 class="title">Approved Cheques</h4>
	                                <p class="category">My Approved Cheques</p>
	                            </div>
								
								
	                            <div class="card-content">
	                                <table class="table table-striped table-condensed table-hover table-responsive" id="hodall">
	                                    <thead class="text-primary">
                                                <th style="width:50px">Request ID</th>
                                                <th>Date Paid</th>
	                                    	<th style="width:250px">Request Title</th>
	                                    	<th>Amount Paid</th>
                                                 <th>Requested By</th>
                                                <th style="width:100px">Beneficiary</th>
                                                <th>Paid By</th>
                                                
	                                    </thead>
	                                    <tbody>
	                                     
					<?php if ($getallresult) { ?>
					<?php
                                        $requestTitle = "";
                                            foreach ($getallresult as $get) {
						$id = $get->id;
						$datePaid = $get->datePaid;
						$Amount = $get->Amount;
                                                $paidBy = $get->paidByAcct;
                                                $paidTo = $get->paidTo;
                                                $approval = $get->approval;
                                                $chequeNo = $get->chequeNo;
                                                $tillName = $get->tillName;
                                                $dBank = $get->dBank;
                                                $requesterEmail = $get->requesterEmail;
                                                $partPay = $get->partpayAmount;
                                                $fmrequestID = $get->fmrequestID;
                                                $tillName = $get->tillName;
                                                $CurrencyType = $this->accounting->getcurrType($get->fmrequestID);
                                              
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
                    
                                                
                                                if($partPay !="" && $partPay < $Amount){
                                                    $newAmount = $partPay."<br/><span style='color:red'>part payment</span>";
                                                }else{
                                                    $newAmount = $Amount;
                                                }
                                                
                                                if($tillName != ""){
                                                    $requestTitle = $tillName;
                                                }else{
                                                    $requestTitle = $this->accounting->descriptionofitema($fmrequestID);
                                                }
                                                
						                                   
					?>
                                        <?php 
                                            $newrandomString = random_string('alnum', 20);
                                        ?>
	                                     <tr>
                                            <td style="width:50px"><?php echo $fmrequestID; ?></td>
                                            <td><?php echo $datePaid; ?></td>
                                            <td style="width:250px"><?php echo $requestTitle; ?></td>
                                            <td><?php echo $newCurrency.$Amount; ?></td>
                                            <td><?php echo $requesterEmail; ?></td>
                                            <td style="width:100px"><?php echo $paidTo; ?></td>
                                            <td><?php echo $paidBy; ?></td>
                                             
                                            
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
    
  $(document).ready(function() {
    $('#hodall').DataTable( {
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf']
    });
});
</script>                
                
   <?php echo $footer; ?>