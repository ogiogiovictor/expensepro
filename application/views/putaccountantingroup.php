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
                                    <h4 class="title"><i class="material-icons">room</i>&nbsp;&nbsp;ACCOUNT GROUP SETUP</h3>
                                    <p class="category">Setup for group account</p>
                                    <span id="showError"></span>
                                </div>
                        <div class="pull-right" style="margin-right:20px">
                                <button class="btn btn-xs btn-facebook"  id="addCode">ADD</button>
                                <a href="<?php echo base_url(); ?>"><button class="btn btn-xs btn-danger" >Close</button></a>
                            </div>
                            <div style="clear:both"></div> 
                            
                            <div id="open">
                                <?php
                                $table = "";
                               $getaccount = $this->adminmodel->getaccountants();
                                $returnEmail = "";
                                if($getaccount){
                                    echo "<table class='table table-striped table-responsive'><tr><th>S/N</th><th>Group Name</th> <th>UserID</th></tr>";
                                    foreach($getaccount as $get){
                                      $gid = $get->gid;
                                      $accountgroupName = $get->accountgroupName;
                                      $userid = $get->userid;
                                     
                                    echo  "<tr><td>$gid</td><td>$accountgroupName</td><td>$userid</td></tr>";
                                    }
                                }
                                
                                
                                ?>
                                
                            </table>
                                
                            </div>
                            
                            
                             <div class="card-content">
                                <div class="closing" id="mainformclick">
                                   
                                    <!-- Beginnin of Form -->
                                    
                                     <form name="forAccount" id="forLocale" method="POST" onSubmit="return false;">
	                                   
                                         
                                    <?php 
                                        $getcat = $this->adminmodel->getallaccountantspluscashiers();
                                                
                                            if ($getcat) { 
                                                $acc = "";
                                                foreach ($getcat as $get) {

                                                    $id = $get->id;
                                                    $email = $get->email;
                                                    $fname = $get->fname;
                                                    $lname = $get->lname;
                                                    $acc .= "<option  value=\"$id\">" . $fname. ' '. $lname . '</option>';
                                                     }
                                                 }
                                    ?>
                                         
                                        <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Select Accountant</label>
                                                    <select class="form-control" name="dAccountName" id="dAccountName">
                                                        <option>Select Accountant</option>
                                                        <?php echo $acc; ?>    
                                                    </select>
                                                    </div>
	                                </div>
                                         
                                         
                                          <?php 
                                        $getallgroup = $this->adminmodel->getallgroup();
                                                
                                            if ($getallgroup) { 
                                                $agroupd = "";
                                                foreach ($getallgroup as $get) {

                                                    $gid = $get->gid;
                                                    $accountgroupName = $get->accountgroupName;
                                                    $agroupd .= "<option  value=\"$gid\">" . $accountgroupName . '</option>';
                                                 }
                                                 
                                         }
                                    ?>
                                          <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Select Group</label>
                                                    <select class="form-control" name="dAccountGroup" id="dAccountGroup">
                                                        <option>Select Group</option>
                                                        <?php echo $agroupd; ?>    
                                                    </select>
                                                    </div>
	                                    </div>
                                         
                                         
                                         
                                                                                  
                                          <div class="col-md-12">
                                              <center><input id="addtogroup" type="submit" class="btn btn-primary" value="Add" /></center>
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