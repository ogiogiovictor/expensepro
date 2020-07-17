
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
                                <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">MY BATCHED FLIGHT</span></span>&nbsp;<i class="fa fa-bus" aria-hidden="true"></i></h4>
                                
                            </div>


                            <div class="card-content">
                                <span class="spanError"></span>
                                 <table class="table table-responsive table-striped">
                                    <tr>
					<td>&nbsp;</td>
					<td><b>Batched Title</b></td>
					<td><b>Batch Code</b></td>
					<td><b>Amount</b></td>
					<td><b>Type</b></td>
					<td><b>Batched By</b></td>
                                        <td><b>Date</b></td>
                                        <td><b>Status</b></td>
				    </tr>
                               <?php
                                if($getResult){
                                   foreach($getResult as $get){
                                      $id = $get->id; 
                                      $batchTitle = $get->batchTitle; 
                                      $sumlID = $get->sumlID;
                                      $batchAmount = $get->batchAmount;
                                      $batchedBy = $get->batchedBy;
                                      $batchCode = $get->batchCode;
                                      $dateBatched = $get->dateBatched;
                                      $batchedStatus = $get->batchedStatus;
                                      $type = $get->type;
                                      
                                  ?>
                                 
                                     <tr>
                                        
                                          
                                         <td>&nbsp;</td>
                                         <td><?php echo  $batchTitle; ?></b></td>
                                         <td><?php echo $batchCode; ?></td>
                                         <td><?php echo @number_format($batchAmount, 2); ?></td>
                                         <td><?php echo $type; ?></td>
                                         <td><?php echo $batchedBy; ?></td>
                                         <td><?php echo $dateBatched; ?></td>
                                         <td><a href="<?php echo base_url();?>travels/paynow/<?php echo $id; ?>"><span class="btn btn-xs btn-danger">Send For Payment</span></a></td>
                                        
                                     </tr>
                                    
                                 <?php
                                 
                                 }
                               ?>
                                     
                                  <?php
                                 
                                 }else {
                               ?>
                                     
                                <?php
                                echo "No Record Found";
                                 }
                                 
                                 ?>
                                
                                 </table>
                               
                            </div>
                        </div>
                    </div>

                    <!-- End of Request Details with Status -->

                   
                                   
                                   
                </div>


            </div>
        </div>
        <!-- Main Outer Content Ends  Here --> 
        <script>
            $(document).ready(function () {

             var table = $('#flightmake');
        var oTable = table.DataTable({
            "order": [[0, "desc" ]]
           
        });  


            });
        </script>                 
        <?php echo $footer; ?>
