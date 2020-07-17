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
	                                <h4 class="title">ALL CHEQUES REQUEST</h4>
	                                <p class="category">All request that are cheques</p>
	                            </div>
					<?php
                                        $paidall = "";
                                            if($getpaidBy){
                                                foreach($getpaidBy as $get){
                                                    $id  = $get->id;
                                                    $paidByAcct = $get->email;
                                                    
                                                    $paidall .= "<option value='$id'>$paidByAcct</option>";
                                                }
                                            }
                                        ?>
								
	                            <div class="card-content">
	                                <table class="table table-responsive table-hover" id="allcheques">
	                                    <thead class="text-primary">
                                                <tr>
                                                    <th>Date</th>
                                                    <th style='width:250px'>Request Title</th>
                                                    <th>Amount paid</th>
                                                    <th style='width:90px'>Beneficiary</th>
                                                    <th style='width:100px'>
                                                        <select class="form-control" name="paidBy" id="paidBy">
                                                            <option value="">Paid By</option>
                                                            <?php echo $paidall; ?>
                                                        </select>
                                                    </th>
                                                    <th>Action</th>
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
                              url:"<?php echo base_url(). 'home/chequeall'; ?>",
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