
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
                                        <h4 class="title">Change Till User </h4>
                                        
	                                <p class="category">Change Till User</p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
	                                
                                           <?php if ($gettilldetails) { ?>
                                               <?php
                                                    foreach ($gettilldetails as $get) {
							 $id = $get->id;
                                                         $tillName = $get->tillName;
                                                         $cahsierTillID = $get->cahsierTillID;
                                                         $cashierEmail = $get->cashierEmail;
                                                         $tillAmount = $get->tillAmount;
                                                         $tillBalance = $get->tillBalance;
                                                         $tillExpense = $get->tillExpense;
                                                         $tillType = $get->tillType;
                                             
                                                ?> 
                                              
                                             <?php } ?>
                                        

                                         <?php } ?>
                                        
                                        <form name="changemyrequestdetials" id="changemyrequestdetials" enctype="multipart/form-data" method="POST" onSubmit="return false;">
	                                    
	                                        <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Till Name</label>
                                                    <input type="text" value="<?php echo $tillName;  ?>" class=" form-control" readonly>
                                                    </div>
	                                        </div>
                                            
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Till Type</label>
                                                    <input type="text" disabled value="<?php echo $tillType;  ?>" readonly class=" form-control">
                                                    </div>
	                                    </div>
                                            
                                              <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Cashier ID</label>
                                                    <input type="text" disabled value="<?php echo $cahsierTillID;  ?>" disabled class=" form-control">
                                                    </div>
	                                        </div>
                                            
                                            
                                             <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Cashier Email</label>
                                                    <input type="text" disabled value="<?php echo $cashierEmail;  ?>" disabled class=" form-control">
                                                    </div>
	                                     </div>
                                            
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Till Amount</label>
                                                    <input type="text" disabled value="<?php echo @number_format($tillAmount);  ?>" disabled class=" form-control">
                                                    </div>
	                                     </div>
                                            
                                             <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Till Balance</label>
                                                    <input type="text" disabled value="<?php echo @number_format($tillBalance);  ?>" disabled class=" form-control">
                                                    </div>
	                                     </div>
                                            
                                            
                                            <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Till Expense</label>
                                                    <input type="text" disabled value="<?php echo @number_format($tillExpense);  ?>" disabled class=" form-control">
                                                    </div>
	                                     </div>
                                            
                                            
                                            <?php 
                                                $getcashier = $this->mainlocation->getallactivateduser();
                                                
                                                 if ($getcashier) { 
                                                $acc = "";
                                                foreach ($getcashier as $get) {

                                                    $cashierid = $get->id;
                                                    $email = $get->email;
                                                    $fname = $get->fname;
                                                    $lname = $get->lname;
                                                    $acc .= "<option  value=\"$email\">" . $fname." ". $lname. " >> ".$email . '</option>';
                                                     }
                                                 }
                                   
                                           ?>
                                            
                                             <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Change Till User</label>
                                                    <select class="form-control" name="newcashier" id="newcashier">
                                                        <option value="" >&nbsp;</option>
                                                       <?php echo $acc; ?>
                                                    </select>
                                                    </div>
	                                     </div>
                                            
                                            
                                             <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Change Till Type</label>
                                                    <select class="form-control" name="tillType" id="tillType">
                                                        <option value="">&nbsp;</option>
                                                         <option value="primary">Primary</option>
                                                        <option value="secondary">secondary</option>
                                                    </select>
                                                    </div>
	                                     </div>
                                            
                                            
                                            
                                            <span id="tillError"></span>
                                             <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                        <input type="hidden" value="<?php echo $sessionID; ?>" id="idwhochangeit" name="idwhochangeit" />
                                                        <input type="hidden" value="<?php echo $sessionEmail; ?>" id="emailwhochangeit" name="emailwhochangeit" />
                                                        <input type="hidden" value="<?php echo $cashierEmail; ?>" id="oldchashieremail" name="oldchashieremail" />
                                                        <input type="hidden" value="<?php echo $tillBalance; ?>" id="tillbalance"  name="tillbalance" />
                                                         <input type="hidden" value="<?php echo $id; ?>" id="tillID"  name="tillID" />
                                                        <center><button class="btn btn-xs btn-primary nowchangetonewcashier">Submit</button></center>
                                                    </div>
	                                     </div>
                                            
                                            
                                        </form>
                                              

	                            </div>
	                        </div>
	                    </div>
						
                        
                            
                            
	                </div>
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                
                
                
   <?php echo $footer; ?>