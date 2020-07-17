
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
	                                <h4 class="title">Prepared Cheques</h4>
	                                <p class="category">Only Cheques you have prepared shows here</p>
	                            </div>
								
                                    <p id="errorme"></p>			
	                            <div class="card-content table-responsive">
                                        <form name="chequepost[]" id="chequepost" onsubmit="return false;">
	                                <table class="table">
	                                    <thead class="text-primary">
                                            <tr>    
                                                <th>Select</th>
                                                <th>Date Confirmed</th>
                                                 <th>Cheque No</th>
                                                <th>Bank</th>
                                                <th>Amount</th>
                                                <!--<th>Till Name</th>-->
                                                <th>Bank Statement</th>
                                                <th>Payee Name</th>
                                                <!--<th>Act/No</th>-->
                                                 <th>Action</th>
                                            </tr>
                                            
	                                    </thead>
	                                    <tbody>
	                                     
                                                <?php 
                                                if($getallresult){
                                                    foreach($getallresult as $get){
                                                        $id = $get->id;
                                                        $userID = $get->userID;
                                                        $dateSent = $get->dateSent;
                                                        $Amount = $get->Amount;
                                                        $fmrequestID = $get->fmrequestID;
                                                        $approval = $get->approval;
                                                        $unit = $get->unit;
                                                        $Location = $get->Location;
                                                        $chequeNo = $get->chequeNo;
                                                        $tillName = $get->tillName;
                                                        $dBank = $get->dBank;
                                                        $bankStatement = $get->bankStatement;
                                                        $paidTo = $get->paidTo;
                                                        $partPay = $get->partpayAmount;
                                                
                                                        if($partPay !="" && $partPay < $Amount){
                                                            $newAmount = $partPay;
                                                        }else{
                                                            $newAmount = $Amount;
                                                        }
                                                        
                                                   $from_app_id = $this->generalmd->getuserAssetLocation("from_app_id", "cash_newrequestdb", "id", $fmrequestID);
                                                   
                                                   $CurrencyType = $this->generalmd->getuserAssetLocation("CurrencyType", "cash_newrequestdb", "id", $fmrequestID);
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
                                                
                                                   
                                                   if($from_app_id == '3'){
                                                    $vendor = $this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "USER_ID", $paidTo);
                                                    }else if($from_app_id == '0' && is_numeric($paidTo)){
                                                          $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $paidTo);
                                                    }else if($from_app_id == '0' && !is_numeric($paidTo)){
                                                         $vendor =  $paidTo;
                                                    }else if($from_app_id == '5'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $paidTo);
                                                    }else if($from_app_id == '6'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $paidTo);
                                                    }else if($from_app_id == '8'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $paidTo);
                                                    }else{
                                                        $vendor =  $paidTo;
                                                    }
                                                   
                                                ?>
								 
										 
	                                     <tr>
                                             <td>
                                                 <input type="checkbox" value="<?php echo $id; ?>" name="dChecking[]" id="dChecking" />
                                               <?php
                                                if($tillName == ""){
                                                    echo $fmrequestID;
                                                }else{
                                                    echo "<span class='badge badge-danger'>N/A</span>";
                                                }
                                               ?>
                                                 
                                             </td>
                                            <td><?php echo $dateSent; ?></td>
                                             <td><?php echo $chequeNo; ?></td>
                                            <td><?php echo $this->adminmodel->getBankName($dBank); ?></td>
                                            <td><?php echo $CurrencyType. @number_format($newAmount, 2); ?></td>
                                             <!--<td><?php// echo $tillName; ?></td>-->
                                            <td><?php echo $bankStatement; ?></td>
                                            <td><?php echo $vendor; ?></td>
                                            <!--<td><?php //echo $dBank; ?></td>-->
                                            <td> <?php
                                           if ($getApprovalLevel == 7  ||  $getApprovalLevel == 6){
                                               echo "<a href='".base_url()."checkbook/index/$dBank/$fmrequestID'><span title='Print Cheque Front' class='btn btn-xs btn-info' >F</span></a>&nbsp;&nbsp;"
                                                       . "<a href='#' data-id='$fmrequestID' title='Print Cheque Back' class='btn btn-xs btn-danger putbackforcheque disposebox'>B</a>&nbsp;&nbsp;"
                                                       . "<a href='#' data-id='$fmrequestID' title='Change Payee' class='btn btn-xs btn-success changepayee disposebox'>C</a>"; 
                                           }else{
                                               echo "";
                                           }
                                           ?></td>
                                            
                                            </tr>
						
                                            <?php
                                               }
                                             }
                                            ?>
	                                    </tbody>
	                                </table>
                                        </form>    
                                        <div id="generateStatementnow">
                                            <span id="bankerror"></span>
                                            
                                         <input type="submit" class="btn btn-google btn-sm" value="Geneate Bank Statement" id="generateNow" name="generateNow" /> 
                                         &nbsp;&nbsp;&nbsp;
                                        
                                          <input type="submit" class="btn btn-facebook btn-sm" value="Merge Check" id="mergeC" name="mergeC" /> 
                                        </div>
                                        
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
                
                
  <script src="<?php echo base_url(); ?>public/javascript/mergeCheck.js" />              
   <?php echo $footer; ?>