
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
                         
                         <div class="col-md-6">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                               <h4 class="title">PAY CHEQUE</h4>
	                                <p class="category">Note: cheque payment</p>
	                            </div>
								
                                    <p id="errorme"></p>			
	                            <div class="card-content table-responsive">
                                        
                                        <?php
                                              if($getallresult){
                                                
                                                foreach($getallresult as $get){
                                                     $transactionid = $get->id;
                                                     $dAmount = $get->dAmount;
                                                     $dAccountgroup = $get->dAccountgroup;
                                                     $benName = $get->benName;
                                                     $ndescriptOfitem = $get->ndescriptOfitem;
                                                     $from_app_id = $get->from_app_id;
                                                     $CurrencyType = $this->generalmd->getsinglecolumn("currencySymbol", " currencytype", "name", $get->CurrencyType);
                                                     $currency = $get->CurrencyType;
                                                      
                                                      if($from_app_id == '3'){
                                                    $vendor = $this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "USER_ID", $benName);
                                                    }else if($from_app_id == '0' && is_numeric($benName)){
                                                          $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($from_app_id == '0' && !is_numeric($benName)){
                                                         $vendor =  $benName;
                                                    }else if($from_app_id == '5'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($from_app_id == '6'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($from_app_id == '8'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else{
                                                        $vendor =  $benName;
                                                    }
                                                }
                                            }

                                        ?>
	                               
                                        <form name="chequepreparation" id="chequepreparation" enctype="multipart/form-data" method="POST" onSubmit="return false;"> 
                                          
                                            <div>
                                             <!--  <center><small>((Only check VAT / WITHOLDING TAX where applicable ))</small></center><br/>
                                                <input type="checkbox" name="vatcharge"  checked id="vatcharge" value="vat" /> <small> Exclusive VAT (5%)</small>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            -->
                                                <?php
                                                 /*   $whold = "";
                                                    $getTaxresult = $this->allresult->getallwitholdingtaxresult();
                                                    if($getTaxresult){
                                                        foreach($getTaxresult as $get){
                                                           $withold_tax = $get->withold_tax;
                                                           $witholdtax_percentage = $get->witholdtax_percentage;
                                                           $withold_tax_text = $get->withold_tax_text;
                                                           $account_withold_tax = $get->account_withold_tax;
                                                           $detailsDesc = $get->detailsDesc;
                                                           $id = $get->id;
                                                           
                                                           $whold .= "<option value='$id'>$detailsDesc</option>";
                                                        }
                                                    }
                                                  
                                                  */
                                                ?>
                                               <!-- <label>Witholding Tax</lable>
                                                
                                                <select name="witholdingtax"  id="witholdingtax">
                                                    <option value="">Select</option>
                                                    <?php //echo $whold; ?>
                                                </select>
                                                -->
                                            </div>
                                            
                                            <div>
                                                <center><small>((Currency - <?php echo $CurrencyType. @number_format($dAmount,2); ?> ))</small></center>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                    <div class="form-group">
                                                    <label class="control-label">Request Title</label>
                                                    <input type="text" class="form-control" value="<?php echo $ndescriptOfitem; ?>" disabled name="itemdescription" id="itemdescription"  />
                                                    </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Cheque Date</label>
                                                    <input type="text" value="<?php echo date('Y-m-d'); ?>" class="form-control datepicker" name="chequeManualDate" id="chequeManualDate"  />
                                                    </div>
                                             </div>
                                            
                                            
                                            <!--<div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Date</label>
                                                    <input type="text" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>" disabled name="chequeDate" id="chequeDate"  />
                                                    </div>
                                            </div>-->
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Payee</label>
                                                    <input type="text" class="form-control" name="payee" id="payee" value="<?php echo $vendor; ?>" disabled  />
                                                    <input type="hidden" class="form-control" name="payee" id="payee" value="<?php echo $vendor; ?>"  />
                                                    </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Actual Amount</label>
                                                    <input type="text" class="form-control" name="mainAount" id="mainAount" value="<?php echo $dAmount; ?>"  disabled />
                                                    <input type="hidden" class="form-control" name="mainAount" id="mainAount" value="<?php echo $dAmount; ?>" />
                                                    </div>
                                            </div>
                                            
                                            <?php 
                                                if($currency == 'naira' || $currency == 'NGN'){
                                                 echo "<hr/>";   
                                                }else{
                                                   echo '<div class="col-md-12">
                                                    <div class="form-group">
                                                    <label class="control-label">Conversion Rate</label>
                                                    <input type="text" class="form-control" name="CurrencyAmount" id="CurrencyAmount"   />
                                                     <input type="hidden" class="form-control" name="CurrencyType" id="CurrencyType" value="'.$currency.'"  />
                                                    </div>
                                            </div>';
                                                }
                                            ?>
                                            
                                           
                                            
                                             <div class="col-md-12"><b>Amount in Words:</b><br/>(<i  id="showmoney" style='color:blue'></i>)</div>
                                             
                                             <div class="col-md-12" style="font-weight:bold; color:red"><i>Note: If you are not paying Full Payment Enter part payment Amount, else just fill other 
                                                    form details and leave the part payment blank</i></div>
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Part Payment(Amount)</label>
                                                    <input type="text" class="form-control" name="partAmount" id="partAmount"  />
                                                    </div>
                                            </div>
                                           
                                            <?php 
                                                $getbank = $this->adminmodel->getallBanks();

                                                if ($getbank) { 
                                                $dBank = "";
                                                foreach ($getbank as $get) {

                                                    $id = $get->id;
                                                    $bankName = $get->bankName;
                                                    $bankNumber = $get->bankNumber;
                                                    $address = $get->address;
                                                    $dBank .= "<option  value=\"$bankNumber\">" . $bankName . ' - '.$bankNumber. ' - '.$address. '</option>';
                                                     }
                                                 }
                                            
                                           ?>
                                        
                                        <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Select Bank</label>
                                                    <select class="form-control" id="getBank" name="getBank"> 
                                                        <option value="">Select Bank</option>
                                                        <?php echo $dBank; ?>
                                                    </select>
                                                    </div>
	                                </div>
                                        
                                        <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Cheque Number(#)</label>
                                                    <input type="text" class="form-control" name="chequeNo" id="chequeNo"  />
                                                    </div>
                                            </div>
                                            
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span id="insurerror"></span>
                                                <input type="hidden" name="transactID" id="transactID" value="<?php echo $transactionid; ?>" />
                                                <input type="hidden" name="acctGroup" id="acctGroup" value="<?php echo $dAccountgroup; ?>" />
                                                <input type="submit" name="confirmchequepay" id="confirmchequepay" value="Confirm" class="btn btn-sm btn-facebook btn-google" />
                                            </div>
	                                </div>
                                        </form>   

	                            </div>
	                        </div>
	                    </div>
						
                         <!-- End of Request Details with Status -->
                         
                                
                                
                                
                            <!-- Inside Content Ends Here -->
                            
                            
	                </div>
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                
                
                
   <?php echo $footer; ?>
 <script type="text/javascript">
       var newnumber = numberToEnglish(<?php echo $dAmount; ?>);
       //alert(newnumber);
       $('#showmoney').html(newnumber);
       //numberToEnglish(<?php //echo $dAmount; ?>);
       //numToWords(8323728);
     </script>