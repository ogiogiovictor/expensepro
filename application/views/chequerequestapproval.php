
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
	                                <h4 class="title">Cashiers Reimbursement</h4>
	                                <p class="category"></p>
	                            </div>
								
                                    <center><p style="width:300px" id="errorme"></p></center>			
	                            <div class="card-content table-responsive table-condensed">
	                                <table class="table" >
	                                    <thead class="text-primary">
	                                    	<th>ID</th>
	                                    	<th>Date Sent</th>
	                                    	<th>Payee</th>
                                                <th>Location</th>
	                                    	<th>Unit</th>
						<th>Amount</th>
                                                <th>Till Name</th>
						<th>App</th>
                                                <th>Action</th>
	                                    </thead>
	                                    <tbody>
	                                     
						<?php if ($getallresult) { ?>
						<?php
                                                    foreach ($getallresult as $get) {
                                                         $id = $get->id;
							 $app_ID = $get->app_ID;
							 $userID = $get->userID;
							 $Amount = $get->Amount;
							 $fmrequestID = $get->fmrequestID;
							 $app_urL = $get->app_urL;
							 $dateSent = $get->dateSent;
							 $approval = $get->approval;
							 $unit = $get->unit;
                                                         $Location = $get->Location;
                                                         $requesterEmail = $get->requesterEmail;
                                                         $chequeNo = $get->chequeNo;
                                                         $signatory = $get->signatory;
                                                         $tillName = $get->tillName;
                                                         $accountGroup = $get->accountGroup;
                                                         $hasentbycashier = $get->hasentbycashier;
                                                         $paidTo = $get->paidTo;
                                                         $sendbythiscashier = $get->sendbythiscashier;
                                                         $icuhaseen = $get->icuhaseen;
                                                         
                                                         if($app_ID == '01'){
                                                             $newappID = "petty cash";
                                                         }else if($app_ID == '02'){
                                                             $newappID = "maintenance";
                                                         }else{
                                                             $newappID = "";
                                                         }
                                                         
                                                         $getSessEmail = $this->mainlocation->getuserSessionEmail($requesterEmail);
                                                        if($getSessEmail){
                                                           foreach($getSessEmail as $get){
                                                                $uid = $get->id;
                                                                $fname = $get->fname;
                                                                $lname = $get->lname;
                                                                $fullname = $fname.' '.$lname;
                                                           }
                                                       }
                                                                                          
						?>
                                                 <?php 
                                                   $newrandomString = random_string('alnum', 50);
                                                   
                                                   $checkifemail = is_email($paidTo);
                                                   if($checkifemail !== ""){
                                                       $emailtoreturnusername = $this->users->checkUserSession($checkifemail);
                                                       if($emailtoreturnusername){
                                                           foreach($emailtoreturnusername as $get){
                                                               $fname = $get->fname;
                                                               $lname = $get->lname;
                                                               
                                                               $cashierfullname = $fname. " ". $lname;
                                                           }
                                                       }
                                                   }else{
                                                      $cashierfullname = $paidTo;
                                                   }
                                                ?>
										 
										 
	                                     <tr>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $dateSent; ?></td>
                                            <td><?php echo @$cashierfullname; ?></td>
                                            <td><?php echo $this->mainlocation->getdLocation($Location); ?></td>
                                            <td><?php echo $this->mainlocation->getdunit($unit); ?></td>
                                            <td><?php echo @number_format($Amount, 2); ?></td>
                                            <td><?php echo $tillName; ?></td>
                                            <td><?php echo $newappID; ?></td>
                                             <td>
                                                 
                                                 <?php
                                                 $icusessionID = $_SESSION['id'];
                                                 if($getApprovalLevel == 7 || $getApprovalLevel == 6 || $getApprovalLevel == 8 || $icusessionID == 242 || $icusessionID == 85){
                                                    if($tillName !=="" AND $hasentbycashier =='yes'){
                                                    //echo "<a href=".base_url()."action/preparecheque/$id/$Amount/$fmrequestID/$newrandomString><button class='btn btn-xs btn-facebook'>Reimburse Cashier</button></a>";
                                                    echo "<input type='hidden' value='$sendbythiscashier' name='cashiserEmail' id='cashiserEmail'/><span title='approve' class='btn btn-xs btn-success' onClick='reimbursedcashiers($id, $Amount)'><i class='material-icons'>check</i></span>";
                                                       }else{
                                                       echo "";
                                                       }
                                                 }
                                                 ?>
                                                
                                                  <?php
                                                 if($getApprovalLevel == 3 && $icuhaseen != "yes"){
                                                   echo "<span title='verify' class='btn btn-xs btn-danger' onClick='icumustconfirm($id, $Amount)'><i class='material-icons'>check</i></span>";  
                                                 }else {
                                                     echo "";
                                                 }
                                                 ?>
                                                 
                                                 <?php
                                                 if($getApprovalLevel == 6 && $icuhaseen != "yes"){
                                                   echo "<a href=". base_url()."home/sagepost/$id/$sendbythiscashier/$fmrequestID/$newrandomString><button class='btn btn-xs btn-info'>S</button></a>";  
                                                 }else {
                                                     echo "";
                                                 }
                                                 ?>
                                                 
                                               <span title='print' class='btn btn-xs btn-default cashiersreimbursement' data-id='<?php echo $id; ?>/<?php echo $fmrequestID; ?>'><i class='material-icons'>print</i></span>
                                                 <a href="<?php echo base_url(); ?>dprocess/viewdetailsofrequest/<?php echo $fmrequestID; ?>/<?php echo $newrandomString; ?>/<?php echo $newappID; ?>/<?php echo $Amount; ?>"><button class="btn btn-xs btn-google viewdetails" ><i class="material-icons">insert_drive_file</i></button></a>
                                             
                                             </td>
                                                 <!--<button class="btn btn-xs btn-google requestnotapprove" data-id="<?php //echo $id; ?>">Cancel</button>--></td>
											
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