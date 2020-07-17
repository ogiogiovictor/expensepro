
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
                                    <h4 class="title"><i class="material-icons">device_hub</i>&nbsp;&nbsp;ACCOUNTS CODE SETUP</h3>
                                    <p class="category">Setup for all accounts</p>
                                     <span id="showError"></span>
                                </div>
                            
                            <div class="pull-right" style="margin-right:20px">
                                <button class="btn btn-xs btn-facebook"  id="addCode">ADD ACCOUNT CODE</button>
                                <a href="<?php echo base_url(); ?>"><button class="btn btn-xs btn-danger" >Close</button></a>
                            </div>
                            <div style="clear:both"></div> 
                            
                            <div id="open" style="height:500px; overflow-y: scroll">
                                <?php
                                 $getallaccounts = $this->mainlocation->getallaccounts();
                                if($getallaccounts){
                                    echo "<table class='table table-striped table-responsive'><tr><th>ID</th><th>Category</th><th>Account Name</th> <th>Code Number</th><th>Action</th></tr>";
                                    foreach($getallaccounts as $get){
                                        $codeid = $get->codeid;
                                        $category = $get->category;
                                        $codeName = $get->codeName;
                                        $codeNumber = $get->codeNumber;
                                     
                                     echo "<tr><td>$codeid</td><td>$category</td><td>$codeName</td><td>$codeNumber</td><td><a href='#'><span class='fa fa-edit'></span></a></td></tr>";
                                    }
                                }
                                
                                echo "</table>";
                                ?>
                                
                            </div>
                       
                             <div class="card-content">
                                <div class="closing" id="mainformclick">
                                   
                                    <!-- Beginnin of Form -->
                                    
                                     <form name="accessme" id="accessme" method="POST" onSubmit="return false;">
	                                   
                                         
                                          <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Select Unit</label>
                                                <?php
                                                $mt = "";
                                                if($allCategory){
                                                   foreach ($allCategory as $get) {
                                                    $id = $get->id;
                                                    $group_name = $get->group_name;

                                                    $mt .= "<option value='$group_name'>$group_name</option>";
                                                    } 
                                                }
                                                
                                                ?>
                                                <select class="form-controls dType" name="Accountcategory" id="Accountcategory" data-live-search="true">
                                                    <option value="">Select Account Category</option>
                                                    <?php echo $mt; ?>
                                                </select>
                                            </div>
                                        </div>

                                         
                                                <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Enter Account Name</label>
                                                      <input type="text" name="actName" id="actName" class="form-control" />
                                                    </div>
	                                        </div>
                                         
                                          <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Acct Number</label>
                                                      <input type="text" name="actCode" id="actCode" class="form-control" />
                                                    </div>
	                                        </div>
                                         
                                         
                                                                                  
                                          <div class="col-md-12">
                                              <center><input id="createAccout" type="submit" class="btn btn-primary" /></center>
	                                 </div>
                                         
                                           
                                     </form>

                                    
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