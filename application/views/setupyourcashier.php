
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
                                    <h4 class="title"><i class="material-icons">room</i>&nbsp;&nbsp;SETUP USER LEVEL</h3>
                                    <p class="category">You can setup you level here, whether ICU, Admin, Cashier, HOD and so on...</p>
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
                                 $getuser = $this->adminmodel->getallactivatedusers();
                                if($getuser){
                                    echo "<table class='table table-striped table-responsive'><tr><th>S/N</th><th>Name</th> <th>Email</th><th>Level</th></tr>";
                                    foreach($getuser as $get){
                                      $id = $get->id;
                                      $email = $get->email;
                                      $fname = $get->fname;
                                      $lname = $get->lname;
                                      $accessLevel = $get->accessLevel;
                                      
                                      if($accessLevel == 1){
                                          $newAccessLevel = "<span class='btn btn-xs btn-facebook'>User</span>";
                                      }else if($accessLevel == 2){
                                         $newAccessLevel = "<span class='btn btn-xs btn-instagram'>HOD</span>"; 
                                      }else if($accessLevel == 3){
                                         $newAccessLevel = "<span class='btn btn-xs btn-google'>ICU</span>"; 
                                      }else if($accessLevel == 4){
                                         $newAccessLevel = "<span class='btn btn-xs btn-primary'>CASHIER</span>"; 
                                      }else if($accessLevel == 5){
                                         $newAccessLevel = "<span class='btn btn-xs btn-default'>ADMIN</span>"; 
                                      }else if($accessLevel == 6){
                                         $newAccessLevel = "<span class='btn btn-xs btn-secondary'>SUPER ADMIN</span>"; 
                                      }else if($accessLevel == 7){
                                         $newAccessLevel = "<span class='btn btn-xs btn-warning'>ACCOUNT</span>"; 
                                      }else if($accessLevel == 8){
                                         $newAccessLevel = "<span class='btn btn-xs btn-info'>SUPER ACCOUNT</span>"; 
                                      }
                                     
                                    echo  "<tr><td>$id</td><td>$fname $lname</td><td>$email</td><td>$newAccessLevel</td></tr>";
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
                                        $getcat = $this->adminmodel->getallactivatedusers();
                                                
                                            if ($getcat) { 
                                                $acc = "";
                                                foreach ($getcat as $get) {

                                                    $id = $get->id;
                                                    $email = $get->email;
                                                    $fname = $get->fname;
                                                    $lname = $get->lname;
                                                    $accessLevel = $get->accessLevel;
                                                    $acc .= "<option  value=\"$id\">" . $fname. ' '. $lname . '</option>';
                                                     }
                                                 }
                                    ?>
                                         
                                        <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Select User</label>
                                                    <select class="form-control" name="dUser" id="dUser">
                                                        <option>&nbsp;</option>
                                                        <?php echo $acc; ?>    
                                                    </select>
                                                    </div>
	                                </div>
                                         
                                         
                                          <?php 
                                        $getallgroupcashier = $this->adminmodel->getccesslevel();
                                                
                                            if ($getallgroupcashier) { 
                                                $cash = "";
                                                foreach ($getallgroupcashier as $get) {

                                                    $cid = $get->id;
                                                    $accesstype = $get->accesstype;
                                                    $cash .= "<option  value=\"$cid\">" . $accesstype . '</option>';
                                                     }
                                                 }
                                    ?>
                                          <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Select Cashier Level</label>
                                                    <select class="form-control" name="dLevel" id="dLevel">
                                                        <option>&nbsp;</option>
                                                        <?php echo $cash; ?>    
                                                    </select>
                                                    </div>
	                                    </div>
                                         
                                         
                                         
                                                                                  
                                          <div class="col-md-12">
                                              <center><input id="addcashier" type="submit" class="btn btn-primary" value="Add" /></center>
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