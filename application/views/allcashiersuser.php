
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
	                                <h4 class="title">Cashiers</h4>
                                        <p class="category">All Cashiers<span class="btn btn-xs btn-google pull-right"><a href="<?php echo base_url(); ?>home">Home</a></span></p>
	                            </div>
								
								
	                            <div class="card-content table-bordered">
	                               
	                                <table class="table table-condensed">
	                                    <thead class="text-primary">
	                                    	<th>Name of Cashier</th>
	                                    	<th style="width:200px">Cashier Email</th>
                                                <th>Access Level</th>
	                                    	<th>Location</th>
                                                <th style="width:100px">Unit</th>
                                                <th>Transactions</th>
                                                
	                                    </thead>
                                            <tbody> <?php if ($getallResult) { ?>
                                               <?php
                                                   $newaccessLevel = "";
                                                    foreach ($getallResult as $get) {
							 $id = $get->id;
                                                         $fname = $get->fname;
                                                         $lname = $get->lname;
                                                         $email = $get->email;
                                                         $accessLevel = $get->accessLevel;
                                                         $activation = $get->activation;
                                                         $uLocation = $get->uLocation;
                                                         $dUnit = $get->dUnit;
                                                         
                                                         if($accessLevel === '4'){
                                                             $newaccessLevel =  "cashier";
                                                         }
                                                         
                                                         $newrand = random_string('alnum', 16);
                                                         
                                                ?> 
                                                
                                                
                                                
                                                <tr>
                                                    <td><?php echo $fname.' '.$lname; ?></td>
                                                    <td><?php echo $email; ?></td>
                                                    <td><?php echo $newaccessLevel; ?></td>
                                                    <td><?php echo $this->mainlocation->getdLocation($uLocation); ?></td>
                                                    <td><?php echo $this->mainlocation->getdunit($dUnit); ?></td>
                                                    <td><a class="btn btn-xs btn-primary" href="<?php echo base_url(); ?>home/dviewcashierstransaction/<?php echo $email; ?>/<?php echo $newrand; ?>">View All</a></td>
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