
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
                                        <h4 class="title">Till Details </h4>
                                        
	                                <p class="category">Edit Till Information</p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
	                                
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
                                                         $addedBy = $get->addedBy;
                                                         $tillType = $get->tillType;
                                                         
                                                         if($cashierIDdetails){
                                                             foreach($cashierIDdetails as $get){
                                                                $fname = $get->fname;
                                                                $lname= $get->lname;
                                                                
                                                                $fullname = $fname." ". $lname;
                                                             }
                                                            $randomString = random_string('alnum', 25); 
                                                         }
                                                         
                                                ?> 
                                              
                                             <?php } ?>
                                        

                                         <?php } ?>
                                        
                                        <form name="mainrequestform" id="mainrequestform" enctype="multipart/form-data" method="POST" onSubmit="return false;">
	                                    
	                                        <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Till Name</label>
                                                    <input type="text" value="<?php echo $tillName;  ?>" name="dTillName" id="dTillName" class=" form-control" disabled>
                                                    </div>
	                                        </div>
                                            
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Casher Name</label>
                                                    <input type="text" disabled value="<?php echo $fullname;  ?>" name="cashierName" id="cashierName" class=" form-control">
                                                    </div>
	                                        </div>
                                            
                                            
                                             <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Casher Email</label>
                                                    <input type="text"  disabled value="<?php echo $cashierEmail;  ?>" name="cashierEmail" id="cashierEmail" class=" form-control">
                                                    </div>
	                                        </div>
                                            
                                            
                                             <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Till Amount</label>
                                                    <input type="text"  disabled value="<?php echo $tillAmount;  ?>" name="tillAmount" id="tillAmount" class=" form-control">
                                                    </div>
	                                      </div>
                                            
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Till Balance</label>
                                                    <input type="text"  disabled value="<?php echo $tillBalance;  ?>" name="tillBalance" id="tillBalance" class=" form-control">
                                                    </div>
	                                     </div>
                                            
                                            
                                             <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Till Expense</label>
                                                    <input type="text"  disabled value="<?php echo $tillExpense;  ?>" name="tillExpense" id="tillExpense" class=" form-control">
                                                    </div>
	                                     </div>
                                            
                                            
                                            
                                             <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Till Limit</label>
                                                    <input type="text"  disabled value="<?php echo $cashierTillLimit;  ?>" name="tillLimit" id="tillLimit" class=" form-control">
                                                    </div>
	                                     </div>
                                            
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Added By</label>
                                                    <input type="text"  disabled value="<?php echo $addedBy;  ?>" name="addedBy" id="addedBy" class=" form-control">
                                                    </div>
	                                     </div>
                                            
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Till Type</label>
                                                    <input type="text"  disabled value="<?php echo $tillType;  ?>" name="tillType" id="tillType" class=" form-control">
                                                    </div>
	                                     </div>
                                            
                                            
                                             <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Add First Time Amount</label>
                                                    <input type="text" id="firsttillamount" name="firsttillamount" class=" form-control">
                                                    </div>
	                                     </div>
                                            
                                            <span id="showError"></span>
                                             <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                        <input type="hidden" value="<?php echo $id; ?>" id="postID" name="postID" />
                                                        <center><button class="btn btn-xs btn-primary postfirstAmount">Add First Amount</button></center>
                                                    </div>
	                                     </div>
                                            
                                            
                                        </form>
                                              

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