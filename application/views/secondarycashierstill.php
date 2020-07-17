
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
                                        <span>Secondary Till Name: </span><h4 class="title"><?php echo $sendTillName; ?></h4>
                                        <p class="category">&nbsp;<span class="pull-right"> Till Limit - <b><?php echo @number_format($this->tillbalances->tillLimitsecondary($_SESSION['email']));  ?></b></span></p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
                                        <p><b><!--Current Till Amount : 8000 --></b></p>
                                        <hr/>
                                        
                                   <div class="col-md-3">     
                                        <div class="card card-stats">
                                                <div class="card-header" data-background-color="orange">
                                                        <i class="material-icons">brightness_medium</i>
                                                </div>
                                                <div class="card-content">
                                                        <p class="category">Amount Collected (Cummulative)</p>
                                                        <a href="<?php echo base_url(); ?>tillcontroller/amountcollect/<?php echo $sendTillName; ?>"><h6 class="title"><b><small>&#8358;</small><?php echo @number_format($this->tillbalances->currenttillamountsecondary($_SESSION['email']));  ?></b></h6></a>
                                                </div>
                                               
                                        </div>
                                   </div>
                                        
                                   <div class="col-md-3">     
                                        <div class="card card-stats">
                                                <div class="card-header" data-background-color="blue">
                                                        <i class="material-icons">attach_money</i>
                                                </div>
                                                <div class="card-content">
                                                        <p class="category">Total Balance</p>
                                                        <h6 class="title"><b><small>&#x20a6;</small><?php echo @number_format($this->tillbalances->currentillbalancesecondary($_SESSION['email']));  ?></b></h6>
                                                </div>
                                               
                                        </div>
                                   </div>
                                        
                                    <div class="col-md-3">     
                                        <div class="card card-stats">
                                                <div class="card-header" data-background-color="red">
                                                        <i class="material-icons">widgets</i>
                                                </div>
                                            
                                                <?php
                                                 $randomString = random_string('alnum', 35);
                                                $allstring = "primary".$randomString.$title;
                                                ?>
                                            
                                                <div class="card-content">
                                                        <p class="category"> Total Expenses (Cummulative)</p>
                                                        <h6 class="title"><b><small>&#x20a6;</small>
                                                                
                                                           <a href="<?php echo base_url(); ?>home/myexpensessecondarytill/<?php echo $_SESSION['email'];  ?>/<?php echo $allstring; ?>"> <?php 
                                                            echo @number_format($this->tillbalances->getcurrentillExpensessecondary($_SESSION['email'])); 
                                                           /* $whopaid = $this->adminmodel->getreesultoffinalpayment($_SESSION['email']);  
                                                            if($whopaid){
                                                                $expense = "";
                                                                foreach($whopaid as $get){
                                                                    $dAmount = $get->dAmount;
                                                                    
                                                                    if($dAmount){
                                                                        $expense += $dAmount;
                                                                    }
                                                                }
                                                                echo $expense;
                                                            }
                                                            */
                                                            
                                                            ?></a></b></h6>
                                                </div>
                                               
                                        </div>
                                   </div>
                                        
                                        
                                        
                                   <div class="col-md-3">     
                                        <div class="card card-stats" style="padding:10px;">
                                            <!--<span><button id="showmakerequestform" class="btn btn-sm btn-default btn-hover">Make Request</button></span> 
                                            <span><button id="viewtransact" class="btn btn-sm btn-facebook btn-hover">View Transaction</button></span>-->
                                            
                                            <!--<span><a href="" class="btn btn-sm btn-primary btn-hover">Summary</a></span>-->
                                            <span><a href="<?php echo base_url(); ?>home/mytill" class="btn btn-sm btn-warning btn-hover">Switch To primary Till</a></span>
                                        </div>
                                   </div>
                                       
                                       <form name="makerequestformfortill" id="makerequestformfortill" method="POST" onSubmit="return false;">
                                           <span id="errorCharging"></span>
                                            <div class="col-md-8">
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <!--<label class="control-label">Start Date</label>-->
                                                    <input type="text" placeholder="select date" name="tillsDate" id="tillsDate" class="form-control datepicker">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <!--<label class="control-label">End Date</label>-->
                                                    <input type="text" name="tilleDate" placeholder="select date" id="tilleDate" class="form-control datepicker">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-8">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Amount</label>
                                                    <input type="text" name="tillAmount" id="tillAmount" class="form-control">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-8">
                                                 <center><input id="cashierstillrequest" type="submit" value="Make Request" class="btn btn-primary" /></center>
                                                </div>
                                                
                                            </div>
                                        </form>
                                        <hr/><br/><br/><br/><br/>
                                        <hr/>
                                        <!-- Beginning of View Transaction -->
                                         <div class="card-content">
                                             
                                             <table class="table table-striped table-condensed table-hover table-responsive" id="hodall">
                                                <thead class="text-primary">
                                                     <th>&nbsp;</th>
                                                    <th>Date Created</th>
                                                    <th style="width:200px">Description of Item</th>
                                                    <th>Location</th>
                                                    <th>Payment Method</th>
                                                    <th>Amount</th>
                                                     <th>Cashier</th>
                                                     <th>Till Type</th>
                                                
                                                </thead>
                                                <tbody>
                                                 <?php if ($getResult) { ?>
                                               <?php
                                                $totalsum = 0;
                                                    foreach ($getResult as $get) {
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
                                                         $ntillType = $get->ntillType;
                                                         $dAccountgroup = $get->dAccountgroup;
                                                         $dCashierwhopaid = $get->dCashierwhopaid;
                                                         
                                                         if($dAmount){
                                                             $totalsum += $dAmount;
                                                         }
					?>     
                                            <tr>
                                            <td><input type="checkbox" value="<?php echo $id; ?>" name="dChecked[]" id="dChecked" /></td>
                                            <td><?php echo $dateCreated; ?></td>
                                            <td><?php echo $ndescriptOfitem; ?></td>
                                            <td><?php echo $this->mainlocation->getdLocation($dLocation); ?></td>
                                            <td><?php echo $nPayment; ?></td>
                                            <td><b><?php echo number_format($dAmount); ?></b></td>
                                            <td><?php echo $cashiers; ?></td>
                                            <td><?php echo $ntillType; ?></td>
                                            
                                            </tr>
                                            </tbody>
                                        <?php } ?>

                                         <?php } ?>	  						
	                                    
	                                </table>
                                         <hr/>
                                             <?php 
                                             echo "<div style='float:right; font-size:20px; font-weight:bold'>".@number_format($totalsum, 2)."</div>";
                                             ?>
                                          <div>
                                           <button id="makeRequest" class="btn btn-sm btn-danger btn-hover">Reimburse Me!</button>
                                           <span id="showErrorrequest"></span> 
                                          </div>

                                        </div>
                                        
                                        <!-- End of View Transaction -->
                                        
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