
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
                                        <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">LOCATION DETAILS</span></span>&nbsp;<i class="fa fa-bus" aria-hidden="true"></i><a onClick="window.histroy.back()"><span class="pull-right btn btn-xs btn-danger"></span></a></h4>
                                        <p class="category"> </span></p>
	                            </div>
								
								
	                            <div class="card-content table-responsive">
                                        
                                         <table class="table table-responsive table-hover table-bordered" id="reqeustapproval">
                                                <thead class="text-primary">
                                                    <th>ID</th>
                                                    <th>From </th>
                                                    <th>To</th>
                                                    <th>Days</th>
                                                    <th>Purpose</th>
                                                    <th>Total</th>
                                                     <th>Local Transport</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Logistics</th>
                                                
                                                </thead>
                                                <tbody>
                                                  <?php if ($detailsnow) { ?>
                                               <?php
                                                    foreach ($detailsnow as $get) {
							 $travelStart_ID = $get->travelStart_ID;
                                                         $tFrom = $get->tFrom;
                                                         $tTo = $get->tTo;
                                                         $diff = $get->diff;
                                                         $purpose = $get->purpose;
                                                         $sTotal = $get->sTotal;
                                                         $amountLocal = $get->	amountLocal;
                                                         $exsDate = $get->exsDate;
                                                         $exrDate = $get->exrDate;
                                                         $logistics = $get->logistics;
                                                ?> 
                                                <tr>
                                                <td><?php echo $travelStart_ID; ?></td>
                                                 <td><?php echo $tFrom; ?></td>
                                                <td><?php echo $tTo; ?></td>
                                                <td><?php echo $diff; ?></td>
                                                <td><?php echo $purpose; ?></td>
                                                <td><?php echo $sTotal; ?></td>
                                                 <td><?php echo $amountLocal; ?></td>
                                                 <td><?php echo $exsDate; ?></td>
                                                 <td><?php echo $exrDate; ?></td>
                                                  <td><?php echo $logistics; ?></td>
                                               
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
       
        var table = $('#reqeustapproval');
        var oTable = table.DataTable({
            "order": [[0, "desc" ]]
           
        });  
        
        /*
        $('#reqeustapproval').DataTable( {
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf'],
        "order": [[0, "desc" ]]
         });
         
         */
    
        
    });
</script>                 
        <?php echo $footer; ?>
