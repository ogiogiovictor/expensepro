
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
	                                <h4 class="title">Account Summary</h4>
	                                <p class="category">Summary Request</p>
	                            </div>
								
								
	                            <div class="card-content">
	                                <table class="table table-responsive table-hover" id="hodall">
	                                    <thead class="text-primary">
	                                    	<th>ex_Code</th>
                                                <th>Code Name</th>
						<th>ex_Amount</th>
	                                    </thead>
	                                    <tbody>
	                                     
					<?php 
                                        if($getallresult){
                                            $sume = 0;
                                            
                                              $getResultbyID = $this->accounting->getresultbyID($getallresult);
                                             // print_r($getResultbyID);
                                              
                                              foreach($getResultbyID as $get){
                                                  $actID = $get->actID;
                                                  $ex_Amount = $get->ex_Amount;
                                                  $Total = $get->Total;
                                                  $dCode = $get->dCode;
                                                  
                                                  $getCodeName = $this->mainlocation->nameCode($dCode);
                                                  if($Total){
                                                      $sume += $Total;
                                                  }
                                                 echo  $table = '<tr><td><b>'.$dCode.'</b></td><td><b>'.$getCodeName.'</b></td><td><b>'.@number_format($Total).'</b></td></tr>';
                                              }
                                        
                                        
                                        }
                                        ?>
                                           
	                                    </tbody>
	                                </table>
                                         <?php echo  "<div class='btn btn-danger'><b>Total Amount :</b> ". "<b>".@number_format($sume); "</b></div>" ?>
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
    
  $(document).ready(function() {
    $('#hodall').DataTable({
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf']
    });
});
</script>   
                
   <?php echo $footer; ?>