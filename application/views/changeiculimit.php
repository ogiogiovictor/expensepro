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
                                    <h4 class="title">ICU INDIVIDUAL LIMIT</h3>
                                    <p class="category"></p>
                                    <span id="showError"></span>
                                </div>
                        <div class="pull-right" style="margin-right:20px">
                                
                            </div>
                            <div style="clear:both"></div> 
                            <table class="table table-responsive table-striped">
                                
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Limit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                         
                                <?php
                               if($getresultfromGroup){
                                   foreach($getresultfromGroup as $get){
                                       $id = $get->id;
                                       $icu_userID = $get->icu_userID;
                                       $limitAmount = $get->limitAmount;
                                       $dGroupID = $get->dGroupID;
                                
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $this->adminmodel->getCashierEmail($icu_userID); ?></td>
                                        <td><?php echo @number_format($limitAmount); ?></td>
                                        <td><a href="<?php echo base_url(); ?>setup/editiculimit/<?php echo $id; ?>/<?php echo $dGroupID; ?>/<?php echo $getdHOdgroup; ?>/<?php echo $icu_userID; ?>/<?php echo $limitAmount; ?>"><i class="material-icons">launch</i></a>&nbsp;&nbsp;&nbsp;<a href=""></a></td>
                                    </tr>
                                </tbody>
                                
                            
                            <?php
                                   }
                               }
                            ?>
                            </table>
                        </div>
                    </div>
                         <!-- End of Request Details with Status -->
                         
                                
                                
                                
                            <!-- Inside Content Ends Here -->
                            
                            
	                </div>
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                
                
                
   <?php echo $footer; ?>