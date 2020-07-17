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
                                    <h4 class="title"><i class="material-icons">room</i>&nbsp;&nbsp;ADD USER TO HOD GROUP</h3>
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
                                $getuserasHOD = $this->adminmodel->getonlyhodlevel();
                                $returnEmail = "";
                                if($getuserasHOD){
                                    echo "<table class='table table-striped table-responsive'><tr><th>S/N</th><th>Name</th> <th>UserID</th></tr>";
                                    foreach($getuserasHOD as $get){
                                      $id = $get->id;
                                      $accesstype = $get->accesstype;
                                      $userID = $get->userID;
                                     
                                    echo  "<tr><td>$id</td><td>$accesstype</td><td>$userID</td></tr>";
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
                                        $getuserasHOD = $this->adminmodel->getallactivatedusers();
                                                
                                            if ($getuserasHOD) { 
                                                $acc = "";
                                                foreach ($getuserasHOD as $get) {

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
                                                    <select class="form-control mySelect" name="dUsernam" id="dUsernam" data-live-search="true">
                                                        <option value="">Select user</option>
                                                        <?php echo $acc; ?>    
                                                    </select>
                                                    </div>
	                                </div>
                                         
                                         
                                          <?php 
                                        $getallgroup = $this->adminmodel->getonlyhodlevel();
                                                
                                            if ($getallgroup) { 
                                                $agroupd = "";
                                                foreach ($getallgroup as $get) {

                                                     $gid = $get->id;
                                                    $accesstype = $get->accesstype;
                                                    $userID = $get->userID;
                                                    $agroupd .= "<option  value=\"$gid\">" . $accesstype . '</option>';
                                                 }
                                                 
                                         }
                                    ?>
                                          <div class="col-md-12">
                                                    <div class="form-group">
                                                    <label class="control-label">Select HOD Group</label>
                                                    <select class="form-control" name="dhodgroup" id="dhodgroup">
                                                        <option value="">Select Group</option>
                                                        <?php echo $agroupd; ?>    
                                                    </select>
                                                    </div>
	                                    </div>
                                         
                                         
                                         
                                                                                  
                                          <div class="col-md-12">
                                              <center><input id="addusertohod" type="submit" class="btn btn-primary" value="Add" /></center>
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