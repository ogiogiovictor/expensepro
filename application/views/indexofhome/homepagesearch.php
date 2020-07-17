
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
	                                <h4 class="title">SEARCHED RESULT</h4>
	                                <p class="category">My Request</p>
	                            </div>
				
                                   <div style="float:right; margin-right:30px">
                                        <form class="form-inline" role="form" action="<?php echo base_url().'home/makemysessionsearch'; ?>" method="POST">
                                        <div class="form-group">
                                            Search: <input name="addsearch" placeholder="Search By ID, Title, Amount " type="text" class="form-controls" id="addsearch">
                                            <small class="text-danger"><center>press the enter key</center></small>
                                        </div>
                                        <!--<button style="margin-top:30px" type="submit" class="btn btn-sm btn-facebook">Go</button>-->
                                        </form>
                                       
                                    </div>
                                    <div style="clear:both"></div>
								
	                            <div class="card-content table-responsive">
	                                <table class="table table-responsive table-striped table-hover">
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
                                                        $dCashierwhopaid = $get->dCashierwhopaid;
                                                $dCashierwhorejected = $get->dCashierwhorejected;
                                                
                                               $newapproval = $this->generalmd->getsinglecolumn("name", " approval_type", "approval_type", $approvals);
                                            
                                               $newCurrency = $this->generalmd->getsinglecolumn("currencySymbol", " currencytype", "name", $CurrencyType);
                                               $defaultCurrency = $this->generalmd->getsinglecolumnwithand("currencySymbol", " currencytype", "name", $CurrencyType, 'defaultCurrency', 1);
                                              $newCurrency = $newCurrency != '' ? $newCurrency : $defaultCurrency;         
                                              
                                                
                                            if($partPay !="0.00" && $partPay < $dAmount){
                                               $dAmount = "<span style='color:red; font-weight:bold'>". $newCurrency. @number_format($partPay) ."</span>";
                                               $dAmount .= "<br/><span style='color:red; font-weight:bold'><small>(Part Payment)</small></span>";
                                              }else{
                                               $dAmount = $newCurrency. @number_format($dAmount, 2);
                                            }	

						                               
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
                                            <td><?php echo $dAmount; ?></td>
                                            <td><?php echo $newapproval; ?></td>
                                            <!--<td><?php //echo $dICUwhorejectedrequest; ?></td>-->
                                             <td><a href="<?php echo base_url(); ?>home/viewmyrequest/<?php echo $id; ?>/<?php echo $approvals; ?>/<?php echo $newrandomString; ?>"><button class='btn btn-xs btn-facebook'>View</button></a></td>
                                            
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
 