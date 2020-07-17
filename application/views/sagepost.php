
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
	                                <h4 class="title">Sage Post</h4>
	                                <p class="category">Request with Code</p>
	                            </div>
								
								
	                            <div class="card-content">
	                                <table class="table table-responsive table-hover" id="hodall">
	                                    <thead class="text-primary">
	                                    	<th>ID</th>
                                                <th>Request Title</th>
                                                <th>Location</th>
                                                <th>Unit</th>
                                                <th>Requester</th>
                                                <th>Code</th>
                                                <th>Code Name</th>
                                                <th>Amount</th>
                                                <th>Beneficiary Name</th>
	                                    </thead>
	                                    <tbody>
	                                     
					<?php 
                                        if($getallresult){
                                         
                                              $getwithCode = $this->mainlocation->mycodevalue($getallresult);
                                             $sum = 0;
                                              foreach($getwithCode as $get){
                                                  $exid = $get->exid;
                                                  $requestID = $get->requestID;
                                                  $ex_Code = $get->ex_Code;
                                                  $ex_Amount = (int)$get->ex_Amount;
                                                  $sess = $get->sess;
                                                  $getDescript = $this->mainlocation->descriptionofitem($requestID);
                                                  $getBen = $this->mainlocation->getbenefiaciaryName($requestID);
                                                  $requester = $this->adminmodel->maderequestbyme($requestID);
                                                  
                                                  $getLocale = $this->adminmodel->getLocation($requestID);
                                                  $getUnit = $this->adminmodel->getmyUnit($requestID);
                                                  
                                                  $dLocation = $this->mainlocation->getdLocation($getLocale);
                                                  $dUnit = $this->mainlocation->getdunit($getUnit);
                                                  
                                                  $getUsername = $this->adminmodel->getUsername($requester);
                                                  $getCodeName = $this->mainlocation->nameCode($ex_Code);
                                                 // $xxCode = $this->mainlocation->nameCode($get->ex_Code);
                                                  if($ex_Amount){
                                                      $sum += $ex_Amount;
                                                  }
                                                 
                                                 echo  $table = '<tr><td><b>'.$exid.'</b></td><td><b>'.$getDescript.'</b></td><td><b>'.$dLocation.'</b></td><td><b>'.$dUnit.'</b></td><td><b>'.$requester.'</b></td><td><b>'.$ex_Code.'</b></td><td><b>'.$getCodeName.'</b></td><td><b>'.@number_format($ex_Amount, 2).'</b></td><td><b>'.$getBen.'</b></td></tr>';
                                              }
                                        
                                        
                                        }
                                        ?>
                                            <center><span style="font-size:23px; font-weight: bold">Total Amount</span>&nbsp;&nbsp;<div class="btn btn-success btn-sm"><?php echo @number_format($sum, 2); ?></div></center>
                                           
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
                
                    <script>
    
  $(document).ready(function() {
    $('#hodall').DataTable({
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf']
    });
});
</script>   
                
   <?php echo $footer; ?>