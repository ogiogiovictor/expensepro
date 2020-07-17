
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="<?php echo base_url(); ?>assets/img/sidebar-1.jpg">

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
                         <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
                                        <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">AWAITING :: TRAVELLING LOGISTICS REQUEST</span></span>&nbsp;<i class="fa fa-bus" aria-hidden="true"></i><a href="<?php echo base_url(); ?>travels/xvL_dsviewal"><span class="pull-right btn btn-xs btn-warning">View All</span></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>travels"><span class="pull-right btn btn-xs btn-danger">Make Request</span></a><a href="<?php echo base_url(); ?>travels/xdmds_xn"><span class="pull-right btn btn-xs btn-success">Flight Request</span></a></h4>
                                        <p class="category">All Request <span style="background-color:red" class="badge"><?php echo $myCount; ?> </span></p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
                                        
                                        <div class="flightloadingrequest"></div>
                                             
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
