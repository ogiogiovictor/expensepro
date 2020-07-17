
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
                                        <h4 class="title">PART PARTMENT DETAILS</h4> 
                                        <?php 
                                         echo $title = $this->generalmd->getsinglecolumn("ndescriptOfitem", "cash_newrequestdb", "id", $myid);
                                         ?>
	                            </div>
						 		
								
	                            <div class="card-content table-responsive table-condensed">
	                                <table class="table table-striped table-hover table-bordered" id="hodall">
	                                    <thead class="text-primary">
	                                    	<!--<th>ID</th>-->
                                                <th>Date Paid</th>
                                                <th>Requester</th>
	                                    	<th style="width:150px">Description of Item</th>
                                                <th>Location</th>
                                                <th>Unit</th>
						<th>Amount</th>
                                                <th>Paid By</th>
                                                <th>Days Spent</th>
                                                <th>Action</th>
	                                    </thead>
	                                    <tbody>
	                                     
						<?php if ($getallresult) { ?>
                                                
                                                
					<?php
                                           foreach ($getallresult as $get) {
                                                $id = $get['nid'];
                                                $newcash_ID = $get['newcash_ID'];
						$mdfive = $get['mdfive'];
						$partAmount = $get['partAmount'];
						$userRequestID = $get['userRequestID'];
						$newBank = $get['newBank'];
						$chequeNonew = $get['chequeNonew'];
						$bankStatementpp = $get['bankStatementpp'];
						$paidBy = $get['paidBy'];
						$datepaid = $get['datepaid'];
                                                $status = $get['status'];
                                                
                                                $requester = $this->generalmd->getsinglecolumn("sessionID", "cash_newrequestdb", "id", $newcash_ID);
                                                $title = $this->generalmd->getsinglecolumn("ndescriptOfitem", "cash_newrequestdb", "id", $newcash_ID);
                                                $dLocation = $this->generalmd->getsinglecolumn("dLocation", "cash_newrequestdb", "id", $newcash_ID);
                                                $dUnit = $this->generalmd->getsinglecolumn("dUnit", "cash_newrequestdb", "id", $newcash_ID);
                                                $CurrencyType = $this->generalmd->getsinglecolumn("CurrencyType", "cash_newrequestdb", "id", $newcash_ID);
                                                
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
                                             <!--<td><?php //echo $id; ?></td>-->     
                                            <td><?php echo $datepaid; ?></td>
                                            <td><?php echo $requester; ?></td>
                                            <td><a href=""><?php echo $title; ?></a></td>
                                           
                                            <td>
                                                <?php
                                                if(is_numeric($dLocation)){
                                                     echo $this->mainlocation->getdLocation($dLocation);
                                                }else{
                                                    echo $dLocation;
                                                } 
                                                ?>
                                            </td>
                                            <td><?php 
                                            if(is_numeric($dUnit)){
                                               echo $this->mainlocation->getdunit($dUnit); 
                                            }else{
                                                echo $dUnit;
                                            }  
                                             ?></td>
                                             <td style="font-weight:bold; color:green"><?php echo $newCurrency. @number_format($partAmount, 2); ?></td>
                                           
                                            <td><?php echo $paidBy; ?></td>
                                            <td><?php echo get_timeago(strtotime($datepaid)); ?></td>
                                            <td> <?php
                                           if (($getApprovalLevel == 4  || $getApprovalLevel == 7  ||  $getApprovalLevel == 6) && $status == 0){
                                               echo "<a href='".base_url()."checkbook/paypartpaymentnow/$newBank/$newcash_ID/$id'><span title='Print Cheque Front' class='btn btn-xs btn-info' >F</span></a>&nbsp;"; 
                                           }else{
                                               echo "";
                                           }
                                           
                                           if ($getApprovalLevel == 4  ||  $getApprovalLevel == 7  ||  $getApprovalLevel == 6 && $status == "0"){
                                               echo "<a href='#' data-id='$newcash_ID' title='Print Cheque Back' class='btn btn-xs btn-danger putbackforcheque disposebox'>B</a>&nbsp;"; 
                                           }else{
                                               echo "";
                                           }
                                           
                                           if ($getApprovalLevel == 4  ||  $getApprovalLevel == 7  ||  $getApprovalLevel == 6 && $status == "0"){
                                               echo "<a href='#' onClick='printchequerequests($newcash_ID)'  title='Print' class='btn btn-xs btn-success'>P</a>&nbsp;"; 
                                           }else{
                                               echo "";
                                           }
                                           ?></td>
                                            </tr>
											
                                            <?php } ?>

                                         <?php } ?>	
                                            					
	                                    </tbody>
	                                </table>

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
    $('#hodall').DataTable( {
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf']
    });
});
</script>                     
                
   <?php echo $footer; ?>