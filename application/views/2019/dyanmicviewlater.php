<style type="text/css">
    .reportAlter{
        display:none;
    }
    .displayme{
        display:inline;
    }
</style>
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
                                        <h4 class="title">PAY CHEQUE</h4> 
                                        
                                        <!--<a href="<?php echo base_url(); ?>"><div class="pull-right">Back</div></a>-->
                                       
                                        <p class="category">Cheque processing platform <br/>
                                            <a onClick ="window.history.back()"class="btn btn-sm btn-pinterest">Back</a>
                                            <a id="bringmeout" class="btn btn-sm btn-success">Report</a>
                                        </p>
                                       
	                            </div>
				
                                    <!-- BEGINNING OF REPORT SECTION -->
                                    <div class="col-md-12 reportAlter">	
                                        <div class="form-group">
                                            <form name="exportchques"  method="POST" action="https://c-iprocure.com/expensepro/chequexport/getmyreport">
                                                <div><b>Search Report by Date Paid</b></div>
                                                Start Date &nbsp;<input type="text" placehoder="yyyy-mm-dd" name="startDate" id="startDate" class="datepicker" />
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                End Date &nbsp;<input type="text"  placehoder="yyyy-mm-dd" name="endDate" id="endDate" class=" datepicker" />
                                                <input type="submit" value="Search" id="payChequebranch" name="payChequebranch" class="btn btn-sm btn-facebook"/>
                                            </form>
                                        </div>
	                              </div>
                                     <!-- END OF REPORT SECTION -->
	                            <div class="card-content table-responsive result">
	                                <table class="table table-condensed table-hover" id="hodall">
	                                    <thead class="text-primary">
	                                    	<th>Id</th>
                                               <th>Date</th>
	                                    	<th style="width:200px">Description of Item</th>
                                                 <th>Payee</th>
						<th>Payment Method</th>
                                                <th>Amount</th>
						<th>Paid By</th>
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
						$hod = $get->hod;
						$icus = $get->icus;
						$cashiers = $get->cashiers;
						$sessionID = $get->sessionID;
						$dateRegistered = $get->dateRegistered;
                                                $dAmount= $get->dAmount;
                                                $refID_edited= $get->refID_edited;
						 $partPay = $get->partPay;
                                                 $benName = $get->benName;
                                                 $dCashierwhopaid = $get->dCashierwhopaid;
                                                 $CurrencyType = $get->CurrencyType;
                                                 $hash = $get->md5_id;
                                                 
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
                                               $dAmount = $newCurrency." ". @number_format($partPay, 2);
                                               $dAmount .= "<br/><small>Part Payment</small>";
                                              }else{
                                               $dAmount = $newCurrency. " ". @number_format($dAmount, 2);
                                            }				
                                             
                                            // approvals = 11 then it is disabled inline
                                            $randomString = random_string('alnum', 30);
                                                 
					?>
                                               			 
	                                     <tr>
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $dateCreated; ?></td>
                                                <td><?php echo $ndescriptOfitem; ?></td>
                                                 <td><?php echo $benName; ?></td>
                                                <td><?php echo $nPayment; ?></td>
                                                <td><?php echo $newCurrency. $dAmount; ?></td>
                                                <td style="width:200px"><?php echo  $dCashierwhopaid ?></td>
                                                
                                              <td class="text-primary">
                                              <span title='print' class='btn btn-xs btn-default' onClick="printchequerequests(<?php echo $id; ?>)"><i class='material-icons'>print</i></span>
                                              <a target="_blank" href="<?php echo base_url(); ?>/home/viewreqeuestdetails/<?php echo $id; ?>/<?php echo $approvals; ?>/<?php echo $hash; ?>"><i class="btn btn-sm btn-success">V</i></span>
                                              </a>
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
    
  $(document).ready(function() {
    $('#hodall').DataTable( {
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf'],
        "order": [[0, "desc" ]]
    });
    
    $('#bringmeout').click(function(){
        //$('.reportAlter').addClass('displayme');
        $('.reportAlter').toggle();
    });
    
      //This section deals search by date and account officer and category
      $('#payChequebranch').click(function () {
          
          var startDate = $('#startDate').val();
          var endDate = $('#endDate').val();

            if(startDate =="" || endDate ==""){
                alert("Please enter a Start and End Date");
             }else{
                 $('#results').html('Loading Result, Please wait.....');
                $.ajax({
                   url : GLOBALS.appRoot + "reports/cashiersearch",
                   method : "POST",
                   data: {startDate: startDate, endDate : endDate},
                   dataType : "text",
                   success : function (data){
                       $('.result').html(data);
                   }
                });
            }
    });

});
</script>                     
                
   <?php echo $footer; ?>