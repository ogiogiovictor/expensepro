
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
                                        <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">ALL REQUEST</span></span>&nbsp;<i class="fa fa-bus" aria-hidden="true"></i><a onClick="window.histroy.back()"><span class="pull-right btn btn-xs btn-danger"></span></a></h4>
                                        <p class="category"> </span></p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
                                        
                                         <table class="table table-responsive table-hover table-bordered" id="reqeustapproval">
                                                <thead class="text-primary">
                                                    <th>ID</th>
                                                    <th>date</th>
                                                    <th>Title</th>
                                                    <th>Location</th>
                                                    <th>Unit</th>
                                                     <th>Amount</th>
                                                    <th>Prepared By</th>
                                                    <th>Date paid</th>
                                                    <th>Type</th>
                                                
                                                </thead>
                                                <tbody>
                                                  <?php if ($dRequest) { ?>
                                               <?php
                                                    foreach ($dRequest as $get) {
							 $id = $get->id;
                                                         $ndescriptOfitem = $get->ndescriptOfitem;
                                                         $dLocation = $get->dLocation;
                                                         $dateCreated = $get->dateCreated;
                                                         $dUnit = $get->dUnit;
                                                         $location = $get->dLocation;
                                                         $unit = $get->dUnit;
                                                         $dAmount = $get->dAmount;
                                                         $sessionID = $get->sessionID;
                                                         $datepaid = $get->datepaid;
                                                         $enumType = $get->enumType;   
                                                ?> 
                                                <tr>
                                                <td><?php echo $id; ?></td>
                                                 <td><?php echo $dateCreated; ?></td>
                                                <td><?php echo $ndescriptOfitem; ?></td>
                                                <td><?php echo $this->mainlocation->getdLocation($location); ?></td>
                                                <td><?php echo $this->mainlocation->getdunit($unit); ?></td>
                                                <td><?php echo @number_format($dAmount, 2); ?></td>
                                                 <td><?php echo $sessionID; ?></td>
                                                 <td><?php echo $datepaid; ?></td>
                                                 <td><?php echo $enumType; ?></td>
                                               
                                                </tr>
                                             <?php } ?>

                                         <?php } ?>
                                                </tbody>
                                                </table>
                                          <hr/>
                                             
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
   $(document).ready(function(){
       
      /*  var table = $('#reqeustapproval');
        var oTable = table.DataTable({
            "order": [[0, "desc" ]]
           
        });  
        */
        
        
        $('#reqeustapproval').DataTable( {
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf'],
        "order": [[0, "desc" ]]
         });
         
         
    
        
    });
</script>                 
        <?php echo $footer; ?>
