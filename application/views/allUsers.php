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
                                        <h4 class="title">All Users</h4>
                                        
	                                <p class="category">Perform User Operation</p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
	                                
                                        <table class="table table-responsive table-hover table-condensed" id="mydata">
                                                <thead class="text-primary">
                                                    <th>ID</th>
                                                     <th>Full Name</th>
                                                    <th>Email </th>
                                                    <th>A.Status</th>
                                                    <th>P.Count</th>
                                                    <th>Status</th>
                                                     <th>Action</th>
                                                
                                                </thead>
                                                <tbody>
                                                  <?php if ($getallresult) { ?>
                                               <?php
                                                    foreach ($getallresult as $get) {
							 $id = $get->id;
                                                         $fname = $get->fname;
                                                         $lname = $get->lname;
                                                         $email = $get->email;
                                                         $dUnit = $get->dUnit;
                                                         $passwordCount = $get->passwordCount;
                                                         $accessLevel = $get->accessLevel;
                                                         $uLocation = $get->uLocation;
                                                         $activation = $get->activation;
                                                         $activationstring = $get->activationstring;
                                                         $userStatus = $get->userStatus;
                                                         $lastlogin = $get->lastlogin;
                                                         $user_agent = $get->user_agent;
                                                         $dateCreated = $get->dateCreated;
                                                         
                                                         if($activation == 1){
                                                             $newstatus = "<a href=''>Enabled</a>";
                                                         }else{
                                                            $newstatus = "<a href=''>Disabled</a>";
                                                         }
                                                         
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
                                                         
                                                ?> 
                                                <tr>
                                                    <td><?php echo $id; ?></td>
                                                    <td><?php echo $fname." ".$lname; ?></td>
                                                    <td><?php echo $email; ?> </td>
                                                    <td><?php echo $newstatus; ?></td>
                                                    <td><?php echo $passwordCount; ?></td>
                                                    <td><?php echo $newAccessLevel; ?></td>
                                                    <td>
                                                        <?php
                                                        if($activation == 0){
                                                        echo "<button class='btn btn-xs btn-warning activatStatus' data-id='$id'>Activate</button>";
                                                        }else{
                                                        echo "<button class='btn btn-xs btn-facebook activatStatus' data-id='$id'>Disable</button>";  
                                                        }
                                                         ?>
                                                        <a href="<?php echo base_url(); ?>admininistrator/editUser/<?php echo $id; ?>/<?php echo $activationstring; ?>"><button class="btn btn-xs btn-google">Edit</button></a>
                                    
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