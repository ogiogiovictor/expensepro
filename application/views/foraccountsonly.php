
	<div class="wrapper">
	    <div class="sidebar" data-color="blue" data-image="<?php echo base_url(); ?>assets/img/sidebar-1.jpg">

			<!--
		        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
                        colors : #113c7f, #5e82bb
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
                            
                            
                         
                         
                         <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">ALL REQUEST</h4>
	                                <p class="category">All request </p>
	                            </div>
					
								
	                            <div class="card-content">
	                                <table class="table table-responsive table-hover" id="allcheques">
	                                    <thead class="text-primary">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Date Sent</th>
                                                    <th style="width:250px; padding-left:5px; padding-right:5px;">Description of Item</th>
                                                    <th>Requester</th>
                                                    <th>Location</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th style="width:200px">Action</th>
                                                    
                                                </tr>
	                                    </thead>
	                                   
	                                </table>

	                            </div>
	                        </div>
	                    </div>
						
                       <!-- End of Request Details with Status -->
                         
                          <div id="disposebox">
                                <p id="myacctputalert"></p>
                            </div> 
                                
                                
                            <!-- Inside Content Ends Here -->
                            
	                </div>
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                
                
            <script type="text/javascript" language="javascript">
                $(document).ready(function(){
                    load_data();
                    function load_data(is_category){
                      var dataTable = $('#allcheques').DataTable({
                          "processing" : true,
                          "serverSide" : true,
                          "order" : [],
                          "ajax" : {
                              url:"<?php echo base_url(). 'accounts/processcheques'; ?>",
                              type : "POST",
                              data : {is_category : is_category}
                              
                          }, 
                             "columnDefs" : [{
                                     "targets" : [2],
                                     "orderable" : false,
                             }]
                          
                      });
                    }
                });
            </script>    
   <?php echo $footer; ?>