
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
                            
                            
                            <!-- Inside Content Begins  Here -->
                             
                         <!-- Beginning of Request Details with Status -->
                        
                    <div class="col-md-8 col-md-offset-2">     
                        <div class="card">
                                <div class="card-header text-center" data-background-color="blue">
                                    <h4 class="title">&nbsp;&nbsp;SETUP UNIT ACCOUNT CODE</h3>
                                    
                                </div>
                       
                            <div class="addform" style="margin-top:10px; padding:10px">
                               
                                <form method="post" id="setupCode" name="setupCode" onsubmit="return false;">
                                     <?php 
                                    if ($accountCode) { 
                                        $allact = "";
                                        foreach ($accountCode as $get) {
                                            $codeid = $get->codeid;
                                            $codeName = $get->codeName;
                                            $codeNumber = $get->codeNumber;
                                            $allact .= "<option  value='$codeid'> " . $codeName . ' - ' . $codeNumber . '</option>';
                                            }
                                        }
                                   
                                     ?>
                                      <label></label>
                                      <select name="codeaccountname" id="codeaccountname" class="mySelect">
                                          <option value="">Select Account Code</option>
                                          <?php echo $allact; ?>
                                      </select>
                                     
                                      <button class="btn btn-sm btn-primary" id="addAccount" name="addAccount">Add</button>
                                      <span id="showError"></span>
                                  </form>
                            </div>
                            <hr/>
                            
                            
                            
                             <div class="card-content">
                                <div  id="dynamicload">
                                   
                                    <!-- Beginnin of Form -->
                                 <span id="hotelMsg"></span>
                                    <div>
                                        
                                        <table class="table table-responsive table-bordered table-striped table-hover">
                                            <tr>
                                                <th>ID</th>
                                                 <th>Code Name</th>
                                                <th>Code Number</th>
                                                <th>Budget Amount </th>
<!--                                                <th>Added By</th>-->
                                            </tr>
                                       
                                      <?php
                                        if($allCodes){
                                            foreach($allCodes as $get){
                                                $hid = $get->id;
                                                $codeName = $get->codeName;
                                                $codeNumber = $get->codeNumber;
                                                $unit = $get->unit;
                                                $addBy = $get->addBy;
                                               
                                          ?>
                                            <tr>
                                                
                                                <td><?php echo $hid; ?></td>
                                                <td><?php echo $codeName; ?></td>
                                                <td><?php echo $codeNumber; ?></td>
                                                <td><?php echo @number_format($this->generalmd->getsinglecolumnwithand("amount", "unitaccountcode_budget_setup", "unit", $unit, "codeNumber", $codeNumber), 2); ?> </td>
<!--                                                <td><?php e//cho $addBy; ?></td>-->
                                            </tr>
                                         <?php       
                                            }
                                        }
                                      ?>
                                        </table>
                                    </div>
                                    
                                    <!-- End of Form -->
                                    
                                </div>
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