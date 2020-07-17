
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
                                            <a onClick ="window.history.back()"class="btn btn-sm btn-pinterest">Back</a></p>
                                       
	                            </div>
						 		
								
	                            <div class="card-content table-responsive">
	                                <table class="table table-condensed table-hover" id="hodall">
	                                    <thead class="text-primary">
	                                    	<th>Id</th>
                                                <th>Date Paid</th>
                                                <th>Requester</th>
	                                    	<th style="width:150px">Description of Item</th>
                                                <th>Location</th>
                                                <th>Unit</th>
						<th>Method</th>
                                                <th>Amount</th>
                                                <th>Payee</th>
                                                
                                                 <th>&nbsp;</th>
	                                    </thead>
	                                    <tbody>
	                                     
						<?php if ($getallresult) { ?>
                                                
                                                
						<?php
                                                    foreach ($getallresult as $get) {
                                                        $id = $get->id;
                                                         $md5_id = $get->md5_id;
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
                                                         $addComment = $get->addComment;
                                                         $partPay = $get->partPay;
                                                         $benName = $get->benName;
                                                         $refID_edited = $get->refID_edited;
                                                         $dAccountgroup = $get->dAccountgroup;
                                                         $ChecknPayment = $get->nPayment;
                                                         $datepaid = $get->datepaid;
                                                         $dUnit = $get->dUnit;
                                                         $fullname = $get->fullname;
                                                                                    
						?>
                                               			 
	                                     <tr>
                                             <td><?php echo $id; ?></td>     
                                            <td><?php echo $datepaid; ?></td>
                                            <td><?php echo $fullname; ?></td>
                                            <td><?php echo $ndescriptOfitem; ?></td>
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
                                            <td><?php echo $nPayment; ?></td>
                                            <td><?php echo @number_format($dAmount, 2); ?></td>
                                            <td><?php echo $benName; ?></td>
                                            
                                            <td>
                                               <?php
                                                $accgroupADMINFLOAT = $this->cashiermodel->getadminfloat() ? $this->cashiermodel->getadminfloat() : "";
       
                                                // Get Uuser Access and determin Which view to load
                                                $getuseridfromhere = $this->gen->haveAccess($_SESSION['id'], $accgroupADMINFLOAT);
                                               $randomString = random_string('alum', 16);
                                           if($getApprovalLevel == 6 || $getuseridfromhere){
                                              echo "<a title='view' href='".base_url()."home/approvaldetails/$id/$md5_id/$approvals/$randomString'><span class='btn btn-xs btn-google'><i class='material-icons'>insert_drive_file</i></span></a>";
                                            
                                           }else{
                                           echo "";
                                           }
                                           
                                           ?>
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
        buttons: ['excel', 'pdf']
    });
});
</script>                     
                
   <?php echo $footer; ?>