
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
	                                <h4 class="title">All Verified Request</h4>
	                                <p class="category">All Latest Request verified by you</p>
	                            </div>
				
                                    <center>
                                        <form class="form-inline" role="form" action="<?php echo base_url().'home/searchchequebyicu'; ?>" method="POST">
                                        <div class="form-group">
                                            <input name="addsearch" placeholder="Search By ID, Sage Reference, Title and Description " type="text" class="form-controls" id="addsearch">
                                        </div>
                                        <button style="margin-top:30px" type="submit" class="btn btn-sm btn-facebook">Go</button>
                                        </form>
                                        <span style="color:red">Search Parameter : ID, Title and Amount </span>
                                         <div style="color:blue; font-weight:bold">STATUS :: Green == "Approved" , Red == "Rejected" </div>
                                    </center>
								
	                            <div class="card-content table-responsive">
	                                <table id="hodall" class="table table-responsive table-striped table-hover">
	                                    <thead class="text-primary">
	                                    	<th>ID</th>
                                                <th>Date Created</th>
	                                    	<th style="width:200px">Description of Item</th>
                                                <th>Sage Reference</th>
						<th>Payment Method</th>
                                                <th>Amount</th>
						
                                                <th>Status</th>
                                                 <!--<th>Rejected</th>-->
                                                  <th>Action</th>
	                                    </thead>
	                                    <tbody>
	                                     
						<?php if ($getallresult) { ?>
						<?php
                                                $newstatusaction = "";
                                                    foreach ($getallresult as $get) {
                                                         $id = $get->id;
							 $dateCreated = $get->dateCreated;
							 $ndescriptOfitem = $get->ndescriptOfitem;
							 $nPayment = $this->mainlocation->getpaymentType($get->nPayment);
							 $approvals = $get->approvals;
							 
							 $sessionID = $get->sessionID;
							 $sageRef = $get->sageRef;
                                                         $dAmount = $get->dAmount;
                                                         $dUnit = $get->dUnit;
                                                       
                                                         $dICUwhoapproved = $get->dICUwhoapproved;
                                                         $dICUwhorejectedrequest = $get->dICUwhorejectedrequest;
                                                          $partPay = $get->partPay;
                                                        $CurrencyType = $get->CurrencyType;
                                                        
                                                        if($dICUwhoapproved){
                                                            $newstatusaction = "<span style='color:green'>$dICUwhoapproved</span>";
                                                        }else if($dICUwhorejectedrequest){
                                                            $newstatusaction = "<span style='color:red'>$dICUwhorejectedrequest</span>";
                                                        }else if ($dICUwhoapproved && $dICUwhorejectedrequest){
                                                            $newstatusaction = "<span style='color:#af0f57'>See Administration</span>";  
                                                        }else if($approvals == 5){
                                                             $newstatusaction = "<span style='color:#936811'>Not Approved By HOD</span>";  
                                                        }else if($approvals == 6){
                                                            $newapproval = "<span style='color:grey'>Reject by ICU</span>";
                                                	 }else{
                                                             $newapproval = "<span style='color:grey'></span>"; 
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
                                                
                                                     if($partPay !="0.00" && $partPay < $dAmount){
                                                    $newAmount = "<span style='color:red; font-weight:bold'>". $newCurrency. @number_format($partPay, 2) ."</span>";
                                                    $newAmount .= "<br/><span style='color:red; font-weight:bold'><small>(Part Payment)</small></span>";
                                                }else{
                                                    $newAmount = $newCurrency. @number_format($dAmount, 2);
                                                }	

						 // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod) 
                                                  // approve = 3(approved by hod) approve = 4 (paid) 
                                                                                                 
						?>
                                                 <?php 
                                                   $newrandomString = random_string('alnum', 60);
                                                ?>
										 
										 
	                                     <tr>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $dateCreated; ?></td>
                                            <td><a href="#"><?php echo $ndescriptOfitem; ?></a></td>
                                            <td><?php echo $sageRef; ?></td>
                                            <td><?php echo $nPayment; ?></td>
                                            <td><?php echo $newAmount; ?></td>
                                            <td><?php echo $newstatusaction; ?></td>
                                            <!--<td><?php //echo $dICUwhorejectedrequest; ?></td>-->
                                             <td><a href="<?php echo base_url(); ?>home/viewreqeuestdetails/<?php echo $id; ?>/<?php echo $approvals; ?>/<?php echo $newrandomString; ?>"><button class='btn btn-xs btn-facebook'>View</button></a></td>
                                            
                                            </tr>
											
					<?php } ?>

                                         <?php } ?>	
											
	                                    </tbody>
	                                </table>
                                        
                                          <center><?php echo $pageLink; ?></center>

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
    $('#hodall').DataTable({
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf'],
         order: [[0, "desc" ]]
        //buttons: [ 'colvis' ]
    });
});
</script>            
<script>
  /* $(document).ready(function(){
        var table = $('#hodall');
        var oTable = table.DataTable({
            "order": [[0, "desc" ]]
           
        });
    });  */
</script>  
   <?php echo $footer; ?>
 