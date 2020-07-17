
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
                                                <th>Date</th>
                                                <th>Bank</th>
                                                <th>IDs</th>
                                                <th>Amount</th>
                                                <th>Payee</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            
	                                    </thead>
	                                    <tbody>
	                                     
                                                <?php 
                                                if($getallresult){
                                                    foreach($getallresult as $get){
                                                        $id = $get->id;
                                                        $acount_payable_ids = $get->acount_payable_ids;
                                                        $acount_payable_sumTotal = $get->acount_payable_sumTotal;
                                                        $acount_payable_bank = $get->acount_payable_bank;
                                                        $acount_payable_date = $get->acount_payable_date;
                                                        $acount_payable_status = $get->acount_payable_status;
                                                        $acount_payable_mergedBy = $get->acount_payable_mergedBy;
                                                        $acount_payee = $get->payee_or_bank;
                                                        $bankStatement = $get->bankStatement;
                                                       
                                                        $makeExplode = explode(',', $acount_payable_ids);
                                                        $makePickfirst = $makeExplode[0];
                                                        
                                                        if($acount_payable_status == 0){
                                                            $acount_payable_status = "<span class='btn-danger'>pending</span>";
                                                        }else{
                                                             $acount_payable_status = "<span class='btn-success'>treated</span>";
                                                        }
                                                        
                                                         $from_app_id = $this->generalmd->getuserAssetLocation("from_app_id", "cash_newrequestdb", "id", $makePickfirst);
                                                   
                                                           if($from_app_id == '3'){
                                                            $vendor = $this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "USER_ID", $acount_payee);
                                                           }else  if(is_numeric($acount_payee) && $from_app_id != '3'){
                                                             $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $acount_payee);
                                                            }else{
                                                                $vendor =  $acount_payee;
                                                            }
                                                   
                                                ?>
								 
										 
	                                     <tr>
                                            
                                            <td><?php echo $acount_payable_date; ?></td>
                                             <td><?php echo $this->adminmodel->getBankName($acount_payable_bank); ?></td>
                                            <td><?php echo $acount_payable_ids; ?></td>
                                            <td><?php echo @number_format($acount_payable_sumTotal, 2); ?></td>
                                            <td><?php echo $vendor; ?></td>
                                            <td><?php echo $acount_payable_status; ?></td>
                                            <td> <?php
                                           if ($getApprovalLevel == 7  ||  $getApprovalLevel == 6 && $bankStatement != "yes"){
                                               echo "<a href='".base_url()."checkbook/mergepayment/$acount_payable_bank/$id'><span title='Print Cheque Front' class='btn btn-xs btn-info' >F</span></a>&nbsp;"; 
                                           }else{
                                               echo "";
                                           }
                                           
                                           if ($getApprovalLevel == 7  ||  $getApprovalLevel == 6){
                                               echo "<a href='#' data-id='$id' title='Print Cheque Back' class='btn btn-xs btn-danger mergebackcheque disposebox'>B</a>&nbsp;&nbsp;"
                                                       . "<a href='#' data-id='$id' title='Change Payee' class='btn btn-xs btn-success usebankinsteadofpayee'>Use Bank</a>"; 
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
                
                
  <script src="<?php echo base_url(); ?>public/javascript/mergeCheckback.js" />              
   <?php echo $footer; ?>