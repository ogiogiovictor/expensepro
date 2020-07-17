
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
                                <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">BATCHED RESULTS </span><i class="fa fa-bus" style="color:white" aria-hidden="true"></i></h4>
                                <p class="category"> </span></p>
                            </div>


                            <div class="card-content">
                               
                                    <?php
                                        if($getResult){
                                            echo "<table class='table table-responsive table-hover' id='hodall'><thead class='text-primary'><th>ID</th><th>Batch Title</th><th>Batch Amount</th><th>Batch Code</th><th>Agency</th><th>Action</th></thead>";
                                            foreach($getResult as $get){
                                                $id = $get->id; 
                                                $batchTitle = $get->batchTitle; 
                                                $sumlID = $get->sumlID;
                                                $batchAmount = $get->batchAmount;
                                                $batchedBy = $get->batchedBy;
                                                $batchCode = $get->batchCode;
                                                $dateBatched = $get->dateBatched;
                                                $batchAmountactual = @number_format($get->batchAmount, 2);
                                                $agency = $get->agency;
                                             echo "<tr><td>$id</td><td>$batchTitle</td><td>$batchAmountactual</td><td>$batchCode</td><td style='font-weight:bold'>$agency</td><td><a href='".base_url()."travels/makexu_pay09iewo732938ment_mdj/$id'><button class='btn btn-xs btn-danger'>Pay</button></a><a href='".base_url()."travels/batchedetailsXXXuds0o/$sumlID'><button class='btn btn-xs btn-success'>View</button></a></td></tr>";
                                            }
                                            echo "</table>";
                                        }
                                        
                                    ?>
                                
                                
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
