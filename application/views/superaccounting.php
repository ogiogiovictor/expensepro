
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
	                                <h4 class="title">Group Levels </h4>
	                                <p class="category">Accounts Group</p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
	                               
                                         <table class="table">
	                                    <thead class="text-primary">
	                                    	<th>S/N</th>
	                                    	<th style="width:200px">Group Name</th>
                                                <th>Users</th>
                                                <th>Action</th>
                                                
	                                    </thead>
                                            <tbody> <?php if ($getResult) { ?>
                                               <?php
                                               
                                                    foreach ($getResult as $get) {
							 $id = $get->gid;
                                                         $accountgroupName = $get->accountgroupName;
                                                         $userid = ltrim($get->userid, '0,');
                                                         
                                                        $newrand = random_string('alnum', 40);
                                                ?> 
                                                <tr>
                                                    <td><?php echo $id; ?></td>
                                                    <td><?php echo $accountgroupName; ?></td>
                                                    <td><?php echo "S".$userid; ?></td>
                                                    <td><a class="btn btn-xs btn-primary" href="<?php echo base_url(); ?>home/getalltheaccountantingrou/<?php echo $userid; ?>/<?php echo $newrand; ?>">View Users</a></td>
                                                </tr>
                                            <?php } ?>

                                         <?php } ?>
                                            </tbody>
                                            
                                           </table> 

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