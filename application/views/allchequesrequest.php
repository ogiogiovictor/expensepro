
	<div class="wrapper">
	    <div class="sidebar" data-color="blue" data-image="<?php echo base_url(); ?>assets/img/sidebar-1.jpg">

			<!--
		        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
                        colors : #113c7f, #5e82bb
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
                            
                            
                         
                         
                         <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">ALL CHEQUES REQUEST</h4>
	                                <p class="category">All request that are cheques</p>
	                            </div>
						
                                    
                                      <?php echo $mainsearchform; ?>
                                    
                                    <!--                                    
                                    <center>
                                        <form class="form-inline" role="form" action="<?php echo base_url().'home/searchcheque'; ?>" method="POST">
                                        <div class="form-group">
                                            <input name="search" placeholder="Search By ID, Amount and Vendor " type="text" class="form-controls" id="search">
                                        </div>
                                        <button style="margin-top:30px" type="submit" class="btn btn-sm btn-facebook">Go</button>
                                        </form>
                                        <span style="color:red">Search Parameter : ID, Amount, Vendor, Requester </span>
                                    </center>
                                    -->
                                    <?php
                                        echo @$message = $this->session->flashdata('data_name');
                                        ?>
                                    
                                    <span style="clear:both"></span>
	                            <div class="card-content table-responsive table-condensed">
	                                <table class="table table-hover table-striped"><!-- id="mydatahome" -->
	                                    <thead class="text-primary">
                                                <!--<th style="width:10%">ID</th>-->
                                                 <th>ID</th>
                                                <th>Date Created</th>
                                                <th>Date Approved</th>
                                                <th style="width:200px">Request Title</th>
                                                <th>Location</th>
                                                <th >Unit</th>
                                                <th>Amount paid</th>
                                                <th>Requested By</th>
                                                <th>Beneficiary</th>
                                                <th>Paid By</th>
                                                <th>Action</th>
                                                
                                                
                                                  
	                                    </thead>
	                                    <tbody>
	                                     
                                             <?php if ($getallresult) { ?>
					  <?php
                                          $requestTitle = "";
                                             foreach ($getallresult as $get) {
						$id = $get->id;
                                                $chequeNo = $get->chequeNo;
                                                $paidTo = $get->paidTo;
                                                $Amount = $get->Amount;	 
                                                $datePaid = $get->datePaid;
                                                $dBank = $get->dBank;
                                                $tillName = $get->tillName;
                                                $requesterEmail = $this->generalmd->getsinglecolumn("fullname", "cash_newrequestdb", "sessionID", $get->requesterEmail);
                                                $Location = $this->generalmd->getsinglecolumn("Location", "account_payable", "Location", $get->Location);
                                                $unit = $this->generalmd->getsinglecolumn("unit", "account_payable", "unit", $get->unit);
                                                $paidByAcct = $get->paidByAcct;
                                                $partPay = $get->partpayAmount;
                                                $fmrequestID = $get->fmrequestID;
                                                $approvals = $this->mainlocation->returnformrequest($fmrequestID);
                                                $descriptionofitem = $this->mainlocation->descriptionofitem($fmrequestID);
                                                $mergedPy = $get->mergedPy;
                                                $CurrencyType = $this->accounting->getcurrType($get->fmrequestID);
                                                $sageRef = $this->generalmd->getsinglecolumn("sageRef", "cash_newrequestdb", "id", $fmrequestID);
                                                
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
                                                    $newAmount = "<span style='color:red; font-weight:bold'>". $newCurrency. @number_format($partPay, 2) ."</span>";
                                                    $newAmount .= "<br/><span style='color:red; font-weight:bold'><small>(Part Payment)</small></span>";
                                                }else{
                                                    $newAmount = $newCurrency. @number_format($Amount, 2);
                                                }
						 
                                                 $randomString = random_string('alnum', 60);
                                                 
                                                 if($tillName != ""){
                                                    $requestTitle = $tillName;
                                                    $tillID = "Till";
                                                     $dateCreatednow = "PC";
                                                }else{
                                                    $requestTitle = $this->accounting->descriptionofitema($fmrequestID);
                                                     $dateCreatednow = $this->generalmd->getuserAssetLocation("dateCreated", "cash_newrequestdb", "id", $fmrequestID);
                                                     $tillID = $fmrequestID;
                                                }
                                                
                                                $sageRef = $sageRef !='' ? "<small style='color:red'>($sageRef)</small>" : '';
						?>
										 
										 
	                                     <tr>
                                            <td><?php echo $tillID; ?></td>
                                             <td><?php echo $dateCreatednow; ?></td>
                                              <td><?php echo $datePaid; ?></td>
                                            <td style="width:250px"><a href=""><?php echo $requestTitle ?></a>
                                                <br/><?php echo $sageRef; ?>
                                            </td>
                                            <td style="width:"><?php echo $this->generalmd->getsinglecolumn("locationName", "cash_location", "id", $Location); ?></td>
                                            <td style="width:"><?php echo $this->generalmd->getsinglecolumn("unitName", " cash_unit", "id", $unit); ?></td>
                                            <td><?php echo $newAmount; ?></td>
                                            <td style="width:"><?php echo $requesterEmail; ?></td>
                                            <td style="width:"><?php echo $paidTo; ?></td>
                                             <td><?php echo $paidByAcct; ?></td>
                                             <td style="width:120px">
                                             <?php
                                             if($tillName == ""){
                                              echo "<a href='".base_url()."home/viewreqeuestdetails/$fmrequestID/$approvals/$randomString'><button class='btn btn-xs btn-facebook' title='View Details'>V</button></a>"
                                                      . "<a href='".base_url()."paycheques/partpaymentdetails//$fmrequestID/$approvals/$randomString'><button class='btn btn-xs btn-success' title='View Part Payment'> <i class='material-icons'>monetization_on</i></button></a>";
                                            
                                             }else if($mergedPy === "merged" && $tillName == ""){
                                              echo "<a href='".base_url()."home/viewmyrequestforeimbursement/$fmrequestID/$approvals/$randomString'><button class='btn btn-xs btn-facebook'>Open</button></a>";
                                            
                                             }else{
                                             echo "<a href='".base_url()."home/viewmyrequestforeimbursement/$fmrequestID/$approvals/$randomString'><button class='btn btn-xs btn-facebook'>View</button></a>";
                                             }
                                             ?>
                                            
                                             </td>
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
   $(document).ready(function(){
        var table = $('#mydatahome');
        var oTable = table.DataTable({
            "order": [[0, "desc" ]]
           
        });
        
    
        
    });
</script>                 
                
   <?php echo $footer; ?>