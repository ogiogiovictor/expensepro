
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
                                                    <th style="width:2%">ID</th>
                                                    <th style="width:10%">Date</th>
                                                      <th style="width:10%">Fullname</th>
                                                    <th style="font-weight: bold; color: red; border:1px solid grey; width:30%; padding-left:15px; padding-right: 15px;">Request Title</th>
                                                    <th>Amount paid</th>
                                                  
                                                    <th style="width:20%">Beneficiary</th>
                                                    <th style="width:10%; padding-right:14px;">Status</th>
                                                    <th>Action</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
	                                    </thead>
	                                   
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
                
                
            <script type="text/javascript" language="javascript">
                $(document).ready(function(){
                    load_data();
                    function load_data(is_category){
                      var dataTable = $('#allcheques').DataTable({
                          "processing" : true,
                          "serverSide" : true,
                          "order" : [],
                          "ajax" : {
                              url:"<?php echo base_url(). 'archieves/allarchievesrequest'; ?>",
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