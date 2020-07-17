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
                                        <h4 class="title">Set Till Limit 
                                            <?php
                                            if($getApprovalLevel == 8 || $getApprovalLevel == 6 || $getApprovalLevel == 5 || $_SESSION['id'] == 84){
                                            echo "<span class=\"btn btn-xs btn-warning btn-hover pull-right addCashier\" onClick=\"toggle_visibility('popup-box')\">Add</span>";
                                            }else{
                                                echo "";
                                            }
                                             ?>
                                        </h4>
                                        
	                                <p class="category">set till limit for all cashiers</p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
	                                
                                        <table class="table table-responsive table-hover table-condensed" id="mydata">
                                                <thead class="text-primary">
                                                    <th>Till Name</th>
                                                    <th>User Name </th>
                                                    <th>User Email</th>
                                                    <th>Til Limit</th>
                                                    <th>Till Balance</th>
                                                    <th>Till Type</th>
                                                    <th>Action</th>
                                                
                                                </thead>
                                                <tbody>
                                                  <?php if ($gettillrequest) { ?>
                                               <?php
                                                    foreach ($gettillrequest as $get) {
							 $id = $get->id;
                                                         $tillName = $get->tillName;
                                                         $cashierID = $get->cahsierTillID;
                                                         $cashierIDdetails = $this->mainlocation->getUserdetails($get->cahsierTillID);
                                                         $cashierEmail = $get->cashierEmail;
                                                         $tillAmount = $get->tillAmount;
                                                         $tillBalance = $get->tillBalance;
                                                         $tillExpense = $get->tillExpense;
                                                         $cashierTillLimit = $get->cashierTillLimit;
                                                         $tillType = $get->tillType;
                                                         
                                                         if($cashierIDdetails){
                                                             foreach($cashierIDdetails as $get){
                                                                $fname = $get->fname;
                                                                $lname= $get->lname;
                                                                
                                                                $fullname = $fname." ". $lname;
                                                             }
                                                            $randomString = random_string('alnum', 25); 
                                                         }
                                                         
                                                         if($tillType == 'primary'){
                                                             $newtillType = "<span class='btn btn-xs btn-danger'>'$tillType'</span>";
                                                         }else if($tillType == 'secondary'){
                                                              $newtillType = "<span class='btn btn-xs btn-warning'>'$tillType'</span>";
                                                         }else {
                                                              $newtillType = "";
                                                         }
                                                     
                                                          $newrand = random_string('alnum', 16);
                                                ?> 
                                                <tr>
                                                    <td><a href="<?php echo base_url(); ?>home/dviewcashierstransaction/<?php echo $cashierEmail; ?>/<?php echo $newrand; ?>/<?php echo $tillName; ?>"><?php echo $tillName; ?></a></td>
                                            <td><?php echo $fullname; ?></td>
                                            <td><a href="<?php echo base_url(); ?>general/checktillhistory/<?php echo $cashierEmail; ?>/<?php echo $tillName; ?>"><?php echo $cashierEmail; ?></a></td>
                                            <td><?php echo @number_format($cashierTillLimit, 2); ?></td>
                                            <td><?php echo @number_format($tillBalance, 2); ?></td>
                                            <td><?php echo $newtillType; ?></td>
                                            <td><a href="<?php echo base_url(); ?>home/forsuperaccountanteditcashier/<?php echo $id; ?>/<?php echo $tillName; ?>/<?php echo $randomString; ?>"><button class="btn btn-xs btn-facebook">Edit</button></a>&nbsp;&nbsp;&nbsp;
                                             <?php
                                               if($getApprovalLevel == 6){
                                                //echo "<a href=".base_url()."changecashier/index/$id/$tillName/$cashierID/$cashierEmail><button title='Change Cashier' class='btn btn-xs btn-google'> CH</button></a>";
                                               }
                                               ?>
                                               
                                               <?php
                                               if($getApprovalLevel == 5 || $getApprovalLevel == 6 || $getApprovalLevel == 8 || $_SESSION['id'] == 84){
                                                echo "<a href=".base_url()."changecashier/addmoney/$id/$tillName/$cashierID/$cashierEmail><button title='Add Amount to Cashier' class='btn btn-xs btn-info'>Add</button></a>";
                                               }
                                               ?>
                                               
                                            </td>
                                                </tr>
                                             <?php } ?>

                                         <?php } ?>
                                                </tbody>
                                                </table>
                                          <hr/>

	                            </div>
	                        </div>
	                    </div>
						
                         <!-- End of Request Details with Status -->
                         
                                  <!-- POP UP BOX HERE -->
                                   <div id="popup-box" class="popup-position">
                                       <div id="popup-wrapper">
                                           <div id="popup-container">
                                               <span class="pull-right"><a href="javascript:void(0)" onClick="toggle_visibility('popup-box');">close</a></span>
                                               <span id="eloaddformerror"></span>
                                               <span id="loaddepdetails"></span>
                                           </div>
                                       </div>
                                   </div>
                                   <!-- END OF POP UP BOX -->
                                
                                
                            <!-- Inside Content Ends Here -->
                            
                            
	                </div>
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                
                
                
   <?php echo $footer; ?>