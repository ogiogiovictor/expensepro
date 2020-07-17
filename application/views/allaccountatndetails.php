
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
	                                <h4 class="title">Group Levels</h4>
	                                <p class="category">All Accouts Group</p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
	                               
                                         <table class="table table-condensed">
	                                    <thead class="text-primary">
	                                    	<th style="width:200px">User Name</th>
                                                <th>Email</th>
                                                <th>Location</th>
                                                <th>Unit</th>
                                                <th>Last Login</th>
                                                <th>View Transaction</th>
	                                    </thead>
                                            <tbody> 
                                                <?php
                                                $ids = explode(",", $urlids);
                                                foreach($ids as $key => $value) {
                
                                                $allSelected[] = $value;

                                                $getusersingroup = $this->adminmodel->getuseridprocess($value);
                                                
                                                ?>
                                                <?php if ($getusersingroup) { ?>
                                               
                                               <?php
                                                    
                                                    foreach ($getusersingroup as $get) {
							 $id = $get->id;
                                                         $fname = $get->fname;
                                                         $lname = $get->lname;
                                                         $email = $get->email;
                                                         $dUnit = $get->dUnit;
                                                         $uLocation = $get->uLocation;
                                                         $lastlogin = $get->lastlogin;
                                                         $newrand = random_string('alnum', 40);
                                                       
                                                ?> 
                                                <tr>
                                                    <td><?php echo $fname.' '.$lname; ?></td>
                                                    <td><?php echo $email; ?></td>
                                                    <td><?php echo $this->mainlocation->getdLocation($uLocation); ?></td>
                                                    <td><?php echo $this->mainlocation->getdunit($dUnit); ?></td>
                                                    <td><?php echo $lastlogin; ?></td>
                                                    <td><a href="<?php echo base_url(); ?>home/dviewcashierstransaction/<?php echo $email; ?>/<?php echo $newrand;  ?>" class="btn btn-primary btn-xs">View Transact</a></td>
                                                </tr>
                                            <?php } ?>
                                                
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