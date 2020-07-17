
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
                         
                         <div class="col-md-6">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">Report</h4>
	                                <!--<p class="category">Please make sure you select a Date Range</p>-->
	                            </div>
                                    
                                    
                                    
				<div class="card-content">				
                              
                                    <div class="col-md-12">
	                                <h5>What Report Do You Want To Print ?</h5>
	                               <?php
                                        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
                                        ?>
                                       <?php 
                                       if($getApprovalLevel == 6 || $getApprovalLevel == 3){
	                                echo "<div class='alert alert-success'>
                                            <a href='".base_url()."cireports/icureport'><span> <i class='material-icons'>line_style</i> <b> Report Type - </b> Search By Date:: APPROVED REQUEST ONLY(ICU)</span></a>
	                                </div>";
                                       }
                                        ?>
                                        
                                        <?php
                                         if($getApprovalLevel == 6 || $getApprovalLevel == 4){
	                                echo "<div class='alert alert-warning'>
	                                  <a href='".base_url()."cireports/cashiersreport'><span> <i class='material-icons'>settings_brightness</i> <b> Report Type - </b> Search By Date:: APPROVED CASHIERS REQUEST</span></a>
	                                </div>";
                                         }
                                        ?>
                                        
                                        
                                         <?php
                                         if($getApprovalLevel == 6 || $getApprovalLevel == 4){
	                                echo "<div class='alert alert alert-danger'>
	                                  <a href='".base_url()."cireports/cashiersreportbyactcode'><span> <i class='material-icons'>settings_brightness</i> <b> Report Type - </b> Search By Date:: CASHIERS REQUEST WITH ACCOUNT CODE</span></a>
	                                </div>";
                                         }
                                        ?>
	                                
                                        <?php 
                                       if($getApprovalLevel == 6 || $getApprovalLevel == 3){
	                                echo "<div class='alert alert-danger'>
                                            <a href='".base_url()."cireports/icureportrejected'><span> <i class='material-icons'>line_style</i> <b> Report Type - </b> Search By Date:: REJECTED REQUEST ONLY(ICU)</span></a>
	                                </div>";
                                       }
                                        ?>
                                        
                                        
                                        <!--
					
                                         <div class="alert alert-info">
	                                    <button type="button" aria-hidden="true" class="close">×</button>
	                                    <span><b> Info - </b> This is a regular notification made with ".alert-info"</span>
	                                </div>
                                        -->
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
           
<script> 
 $(function() { 
       $('#hodall').DataTable({
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf']
        //buttons: [ 'colvis' ]
    });
  }); 

</script> 
                
   <?php echo $footer; ?>