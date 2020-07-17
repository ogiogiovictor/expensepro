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
                                    <h4 class="title"><i class="material-icons">room</i>&nbsp;&nbsp;SETUP ICU HEAD</h3>
                                    <p class="category"></p>
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
                                $getuserasICU = $this->adminmodel->getallicugroup();
                                $returnEmail = "";
                                if($getuserasICU){
                                    echo "<table class='table table-striped table-responsive'><tr><th>S/N</th><th>GroupName</th> <th>ICU HEAD</th></tr>";
                                    foreach($getuserasICU as $get){
                                      $icuid = $get->icuid;
                                      $groupName = $get->groupName;
                                      $icuHead = $get->icuHead;
                                      $changeHead = $get->adminOnly;
                                     
                                    echo  "<tr><td>$icuid</td><td>$groupName</td><td>$icuHead</td></tr>";
                                    }
                                }
                                
                                
                                ?>
                                
                            </table>
                                
                            </div>
                            
                            
                             <div class="card-content">
                                <div class="closing" id="mainformclick">
                                   
                                    <!-- Beginnin of Form -->
                                    
                                     <form name="forAccount" id="forICUheadsetup" method="POST" onSubmit="return false;">
	                                   
                                         
                                    <?php 
                                        $getuseraswithICU = $this->adminmodel->getalltheicus();
                                                
                                            if ($getuseraswithICU) { 
                                                $acc = "";
                                                foreach ($getuseraswithICU as $get) {

                                                    $id = $get->id;
                                                    $email = $get->email;
                                                    $fname = $get->fname;
                                                    $lname = $get->lname;
                                                    $acc .= "<option  value=\"$id\">" . $fname. ' '. $lname . '</option>';
                                                     }
                                                 }
                                    ?>
                                         
                                        <div class="col-md-12">
                                                    <div class="form-group">
                                                    <label class="control-label">Select User</label>
                                                    <select class="form-control" name="dUsernam" id="dUsernam">
                                                        <option value="">Select user</option>
                                                        <?php echo $acc; ?>    
                                                    </select>
                                                    </div>
	                                </div>
                                         
                                         
                                         <?php 
                                        $getallgroup = $this->adminmodel->getallicugroup();
                                                
                                            if ($getallgroup) { 
                                                $agroupd = "";
                                                foreach ($getallgroup as $get) {

                                                    $icuid = $get->icuid;
                                                    $groupName = $get->groupName;
                                                    $agroupd .= "<option  value=\"$icuid\">" . $groupName . '</option>';
                                                     }
                                                 }
                                    ?>
                                          <div class="col-md-12">
                                                    <div class="form-group">
                                                    <label class="control-label">Select ICU Group</label>
                                                    <select class="form-control" name="dicugroup" id="dicugroup">
                                                        <option value="">Select Group</option>
                                                        <?php echo $agroupd; ?>    
                                                    </select>
                                                    </div>
	                                    </div>
                                         
                                         
                                         
                                                                                  
                                          <div class="col-md-12">
                                              <center><input id="addicuhead" type="submit" class="btn btn-primary" value="Add" /></center>
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