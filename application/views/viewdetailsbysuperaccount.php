
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
                                        <h4 class="title">Request Details</h4> 
	                                <p class="category">Full Information of Request 
                                          
                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          
                                          <a href="<?php echo base_url(); ?>home/requestforpayment"><span class="btn btn-xs btn-info">Back</span></a></p>
	                            </div>
								
                                    <p id="errorme"></p>			
	                            <div class="card-content table-responsive">
	                                <table class="table table-condensed table-hover" id="hodall">
	                                    <thead class="text-primary">
	                                    	<th>ID</th>
                                                <th>Title</th>
                                                <th>Location/Unit</th>
                                                <th>HOD(Apprd)</th>
                                                <th>ICU(Apprd)</th>
                                                <th>Prepared By</th>
                                                <th>Amount</th>
                                                <th>Beneficiary Name</th>
	                                    </thead>
	                                    <tbody>
                                                
                                            <?php
                                            //Implode comma to the array
                                            $implodemyarray = explode(",",  $urlids);

                                             foreach($implodemyarray as $key => $value) {

                                             $getresult = $this->mainlocation->getdexactresultfromdb($value);

                                            
                                            ?>
	                                     <?php
                                                if($getresult){
                                                    
                                                    foreach($getresult as $get){
                                                        
                                                        $id = $get->id;
                                                        $ndescriptOfitem = $get->ndescriptOfitem;
                                                        $dLocation = $get->dLocation;
                                                        $dUnit = $get->dUnit;
                                                        $addComment = $get->addComment;
                                                        $dICUwhoapproved = $get->dICUwhoapproved;
                                                        $dCashierwhopaid = $get->dCashierwhopaid;
                                                        $benName = $get->benName;
                                                        $newrequest_tillID = $this->adminmodel->gettilltypestatus($get->newrequest_tillID);
                                                        $dAmount = $get->dAmount;
                                                        $hodwhoapprove = $get->hodwhoapprove;
                                                   		 
                                            ?>
                                                
                                            <?php
                                                if(is_numeric($dLocation)){
                                                    $nowLocation = $this->mainlocation->getdLocation($get->dLocation);
                                                }else{
                                                    $nowLocation =  $get->dLocation;
                                                }
                                                
                                                
                                                 if(is_numeric($dLocation)){
                                                    $nowUnit = $this->mainlocation->getdunit($get->dUnit);
                                                }else{
                                                    $nowUnit =  $get->dUnit;
                                                }
                                            ?>
	                                     <tr>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $ndescriptOfitem; ?></td>
                                            <td><?php echo $nowLocation; ?> / <?php echo $nowUnit; ?></td>
                                            <td><?php echo $hodwhoapprove; ?></td>
                                            <td><?php echo $dICUwhoapproved; ?></td>
                                            <td><?php echo $dCashierwhopaid; ?></td>
                                             <td><?php echo $dAmount; ?></td>
                                            <td><?php echo $benName; ?></td>
                                            
                                          <?php } ?>
                                                
                                       <?php } ?>

                                         <?php } ?>  
											
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