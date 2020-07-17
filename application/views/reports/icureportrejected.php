<style type="text/css">
    .basicstyle{
        font-size:25px;
        font-weight: bold;
        padding:15px;
    }
 </style>
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
	                                <h4 class="title">Report</h4>
	                                <p class="category">Please make sure you select a Date Range</p>
	                            </div>
                                    
                                  <div class="card-content">  
								
                               
                                      <?php
                                       if($getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 5){
                                       echo "<form name='catmaintform'  method='POST' action='' onSubmit='return false;' >
                                           
                                        <!-- Rejection includes 5, 6, 12 -->
                                            <div class='col-md-12'>
                                                <div>
                                                    <h4>Search By Date(Internal Control Unit)</h4>
                                                    <span class='basicstyle'>Select</span>
                                                    <select name='status' id='status'>
                                                        <option value=''>Select Date</option>
                                                        <option value='5'>Rejected</option>
                                                    </select>
                                                    
                                                      <span class='basicstyle'>Start Date</span><input type='text' placehoder='yyyy-mm-dd' name='catStartDaterejected' id='catStartDaterejected' class='datepicker' />
                                                       <span class='basicstyle'>End Date </span><input type='text'  placehoder='yyyy-mm-dd' name='catEndDaterejected' id='catEndDaterejected' class='datepicker' />
                                                      <input type='submit' value='Submit' id='catsearchbydaterejected' name='catsearchbydaterejected' class='btn btn-sm btn-facebook'/>
                                                     
                                                    </div>
	                                    </div>
                                        </form>";
                                        }
                                        ?>
                                    
                                   
                                    
                                    
                                   
	                            </div>
                                    
                                    <!-- BEGINNING OF SEARCH RESULT -->
                                    
                                    <div  class="card-content">
                                        <div id="results"></div>
                                    </div>
                                    <!-- END OF SEARCH RESULT -->
                                    
                                    
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