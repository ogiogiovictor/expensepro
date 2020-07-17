
	<div class="wrapper">
	    <div class="sidebar" data-color="blue" data-image="<?php echo base_url(); ?>public/assets/img/sidebar-1.jpg">

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
                            
                            
                            <!-- Inside Content Begins  Here -->
                                <!-- with icons and horizontal -->
                        <ul class="nav nav-pills nav-pills-icons nav-pills-primary" role="tablist">
                               
                                <li class="active">
                                        <a href="<?php echo base_url(); ?>home/newrequest">
                                                <i class="material-icons">dashboard</i>
                                               New Request
                                        </a>
                                </li>
                                
                                
                               
                             
                             <?php 
                                 if($getApprovalLevel == 6){
                                echo "<li>
                                        <a href='".base_url()."action/disableduser'>
                                                <i class='material-icons'>accessibility</i>
                                                All Users
                                        </a>
                                </li>";
                                 }else{
                                    echo "";
                                 }
                             ?>
                                
                            <?php 
                                 if($getApprovalLevel == 8){
                                echo "<li>
                                        <a href='".base_url()."home/printoutcheques'>
                                               <i class='material-icons'>print</i>
                                                 Printout Cheque
                                        </a>
                                </li>
                                ";
                                 }
                             ?>
                                
                                
                                <?php 
                               
                               if($getApprovalLevel == 6){
                               echo "<li>
                                        <a href='".base_url()."home/printoutcheques'>
                                               <i class='material-icons'>print</i>
                                                 Printout Cheque
                                        </a>
                                </li>
                                
                                <li>
                                        <a href='".base_url()."home/generatebankstatement'>
                                               <i class='material-icons'>account_balance</i>
                                                Bank Confirmation
                                        </a>
                                </li><li>
                                        <a href='".base_url()."home/allpartpayments'>
                                              <i class='material-icons'>business</i>
                                               Part Payment
                                        </a>
                                </li>
                                <li>
                                        <a href='".base_url()."home/allgeneratebankstatement'>
                                               <i class='material-icons'>receipt</i>
                                                All Bank Confirmation
                                        </a>
                                </li><li>
                                        <a href='".base_url()."home/govementlevies'>
                                                <i class='material-icons'>insert_chart</i>
                                                Govt Levies
                                        </a>
                                </li>";
                                }else{
                                    
                                    echo "";
                                }
                               ?>
                                
                                
                        </ul>
                                
                                
                        <hr/>        
                         <!-- Beginning of Request Details with Status -->
                         
                         <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">My Request</h4>
	                                <p class="category">Latest Request and Status Update</p>
	                            </div>
								
								
	                            <div class="card-content table-responsive table-condensed">
                                        <span id="pCodeStatus"></span>
	                                <table class="table table-condensed table-striped" id="homeserverside">
	                                    <thead class="text-primary">
                                                <tr>
                                                    <th style="width:50px">Id</th>
                                                    <th>Date</th>
                                                    <th style="width:200px">Description of Item</th>
                                                    <th>Payment Method</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
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
                      var dataTable = $('#homeserverside').DataTable({
                          "processing" : true,
                          "serverSide" : true,
                          "order" : [],
                          "ajax" : {
                              url:"<?php echo base_url(). 'homeserverside/myrequestisent'; ?>",
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