
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
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">BATCHED DETAILS </span><i class="fa fa-bus" style="color:white" aria-hidden="true"></i></h4>
                                <p class="category"> </span></p>
                            </div>


                            <div class="card-content">
                                <table class="table table-hover"><tr><th>ID</th><th>Date Created</th><th>Request Title</th><th>Amount</th><th>Details</th><th>Status</th></tr>
                                    <?php
                                        if($getResult){
                                           foreach($getResult as $get){
                                               $id = $get->id;
                                               $dateCreated = $get->dateCreated;
                                               $request_ID = $get->request_ID;
                                               $flight_Amount = $get->flight_Amount;
                                               $flight_Details = $get->flight_Details;
                                               $Status = $get->Status;
                                               $datePaid = $get->datePaid;
                                     ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $dateCreated; ?></td>
                                        <td><?php echo $request_ID; ?></td>
                                        <td><?php echo $flight_Amount; ?></td>
                                        <td><?php echo $flight_Details; ?></td>
                                        <td><?php echo $Status; ?></td>
                                    </tr>
                                    
                                    
                                    
                                    <?php
                                           }
                                        }
                                        
                                    ?>
                                
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
            $('#hodall').DataTable( {
            dom: 'Bfrtip',
            buttons: ['excel', 'pdf']
            });
         });
         </script>
    
        <?php echo $footer; ?>
