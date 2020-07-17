
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
	                                <h4 class="title">Generate Receipt </h4>
                                        <a href="<?php echo base_url(); ?>"><div class="pull-right">Back</div></a>
                                       
	                                <p class="category">generate receipt for printout</p>
                                       
	                            </div>
						 		
								
	                            <div class="card-content table-responsive">
	                                <table class="table table-condensed table-hover" id="mydata">
	                                    <thead class="text-primary">
	                                    	<th>Date Created</th>
	                                    	<th style="width:150px">Description of Item</th>
                                                <th style="width:200px">Account Code</th>
                                                <th>Unit</th>
						<th>Method</th>
                                                <th>Amount</th>
                                                <?php
                                                if($getApprovalLevel == 4 || $getApprovalLevel == 6){
                                                   echo " <th>Payee</th>";
                                                }
                                                ?>
						<th>Approved By</th>
                                             <th>&nbsp;</th>
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
                                                         $dAmount = $get->dAmount;
                                                         $dLocation = $get->dLocation;
                                                         $addComment = $get->addComment;
                                                         $addComment = $get->addComment;
                                                         $dCashierwhopaid = $get->dCashierwhopaid;
                                                         $dUnit = $get->dUnit;
                                                         $partPay = $get->partPay;
                                                         $benName = $get->benName;
                                                
                                                        if($partPay !="0.00" && $partPay < $dAmount){
                                                            $newAmount = @number_format($partPay). "<br/><span style='color:red'>part payment</span>";
                                                        }else{
                                                            $newAmount = $dAmount;
                                                        }
                                                      
                                                        
                                                        $getpaidTo = $this->datatablemodels->getpaidTo($id) != '' ?  $this->datatablemodels->getpaidTo($id) : $benName;
                                                                
						 // approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod) 
                                                  // approve = 3(approved by hod) approve = 4 (paid) 
                                                         
                                                    //Get the Code
                                                         $mergeCode = "";
                                                         $getexCode = $this->mainlocation->getCodefromexpense($id);
                                                         if($getexCode){
                                                             foreach($getexCode as $get){
                                                                 $xCode = $get->ex_Code;
                                                                 $xxCode = $this->mainlocation->nameCode($get->ex_Code);
                                                                 
                                                                 $mergeCode .= $xCode.' '.$xxCode;
                                                             }
                                                         }
                                                                                                 
						?>
                                                 <?php 
                                                   $newrandomString = random_string('alnum', 20);
                                                ?>
										 
										 
	                                     <tr>
                                            <td><?php echo $dateCreated; ?></td>
                                            <td><?php echo $ndescriptOfitem; ?></td>
                                            <td><?php echo $mergeCode; ?></td>
                                            <td><?php 
                                            if(is_numeric($dUnit)){
                                               echo $this->mainlocation->getdunit($dUnit); 
                                            }else{
                                                echo $dUnit;
                                            }
                                             ?></td>
                                            <td><?php echo $nPayment; ?></td>
                                            <td><?php echo $newAmount; ?></td>
                                            
                                             <?php
                                                if($getApprovalLevel == 4 || $getApprovalLevel == 6){
                                                   echo " <td>$getpaidTo</td>";
                                                }
                                                ?>
                                            
                                            <td><?php echo $dCashierwhopaid; ?></td>
                                            <td> <?php
                                             $randomString = random_string('alnum', 60);
                                             
                                            /*if($getApprovalLevel == 5){
                                                echo "<a href='".base_url()."home/viewreqeuestdetails/$id/$approvals/$randomString'><button class='btn btn-xs btn-facebook'>View</button></a>";
                                            } */
                                           ?>
                                            <span title='print' class='btn btn-xs btn-default' onClick="printchequerequests(<?php echo $id; ?>)"><i class='material-icons'>print</i></span>
                                           
                                            </td>
                                            <?php
                                            //if($approvals !== '5'){
                                            //echo "<td><a href='".base_url()."'home/approvaldetails/$id/$newrandomString/$ndescriptOfitem'><span class='btn btn-xs btn-facebook'>View</span></a></td>";
	                                    //}
                                             ?>
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
                
                
                
   <?php echo $footer; ?>