
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
                         
                         <div class="col-md-8">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">MERGED PAYMENT SUMMARY DETAILS</h4>
	                                <p class="category">Please note make sure that the payment you want to merge has same beneficiary</p>
	                            </div>
								
                                    <p id="errorme"></p>
                                    <form name="mergingpayment" id="mergingpayment" onsubmit="return false;">
	                            <div class="card-content table-responsive">
                                        
                                        <?php
                                       
                                        $explodeArray = explode(",", $variables);
                                       
                                        $totalSum = ""; $joinbenName = "";
                                         echo "<table class='table table-responsive'><tr><th>Description</th><th>Beneficiary</th><th>Amount</th></tr>";
                                         foreach($explodeArray as $key => $values){
                                             
                                             $allSelected[] = $values;
                                             
                                             $getResult = $this->mainlocation->getdexactresultfromdb($values);
                                             
                                              if($getResult){
                                                
                                                  foreach($getResult as $get){
                                                      $id = $get->id;
                                                      $benName = $get->benName;
                                                      $dAmount = $get->dAmount;
                                                      $ndescriptOfitem = $get->ndescriptOfitem;
                                                      
                                                      
                                                      if($dAmount){
                                                          $totalSum += $dAmount;
                                                      }
                                                      if($benName){
                                                          $joinbenName .= $benName;
                                                      }
                                                   
                                                    echo "<tr><td><input type='text' value='$ndescriptOfitem' disabled id='ndesc'name='ndesc' /></td><td><input type='text' value='$benName' disabled id='benName' name='benName' /></td><td><input type='text' value='$dAmount' disabled id='ndesc'name='ndesc' /></td></tr>";     
                                                  }
                                                 
                                                  
                                              }
                                         }
                                                                                          
                                         
                                       echo "</table>"
                                        ?>
                                        
                                   
                                  
                                 <?php
                                
                                echo "<div style='font-size:20px'> <b>Total:</b> <input type='text' hidden value='$totalSum' name='mainAmount' id='mainAmount'/><input type='text' hidden value='$joinbenName' name='jointbenName' id='jointbenName'/><input type='text' disabled value='$totalSum' name='mainAount' id='mainAount'/></div><br/>";
                                ?>
                                        
                                <div>
                                                <center><small>((Only check VAT / WITHOLDING TAX where applicable ))</small></center><br/>
                                                <input type="checkbox" name="vatcharge"  checked id="vatcharge" value="vat" /> <small> Exclusive VAT (5%)</small>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            
                                                <?php
                                                    $whold = "";
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
                                                ?>
                                                <label>Witholding Tax</lable>
                                                
                                                <select name="witholdingtax"  id="witholdingtax">
                                                    <option value="">Select</option>
                                                    <?php echo $whold; ?>
                                                </select>
                                            </div>
                                        
                                        
                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label">Date</label>
                                                    <input type="text" name="chequeDate" id="chequeDate"  value="<?php echo date('Y-m-d'); ?>" hidden class="form-control"/>
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
                                                    $dBank .= "<option  value=\"$bankNumber\">" . $bankName . '</option>';
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
                                                <input type="hidden" name="chequeID" id="chequeID" value="<?php echo $variables; ?>" />
                                                <input type="hidden" name="payee" id="payee" value="<?php echo $controllerbenName; ?>" />
                                               <?php
                                                if($controllerbenName === $benName){
                                                  echo  "<input type='submit' name='mergingpaymentnow' id='mergingpaymentnow' value='Prepare Cheque' class='btn btn-sm btn-facebook btn-google' />";
                                                }else{
                                                    echo "";
                                                }
                                                ?>
                                               </div>
	                          </div>

                                        
                                        
	                            </div>
                                </form>
                                    
	                        </div>
	                    </div>
						
                         <!-- End of Request Details with Status -->
                         
                                
                               
                                
                            <!-- Inside Content Ends Here -->
                            
                            
	                </div>
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                
                
                
   <?php echo $footer; ?>