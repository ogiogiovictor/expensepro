
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


                        <div class="content">
                            <div class="container-fluid">
                               
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="card">
                                           <div class="card-header" data-background-color="blue">
                                                <h4 class="title">BAR CHART</h4>
                                                <p class="category">Based on Unit / Expenses</p>
                                            </div>
                                            <div class="card-content">
                                                <canvas id="mycanvas"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                
                                </div>
                                
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
    $('#hodall, #othersme, #units').DataTable( {
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf']
    });
});
</script>    
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
<!--<script src="<?php echo base_url(); ?>public/chartjs/src/chart.js"></script>-->
<script src="<?php echo base_url(); ?>public/javascript/appschart.js"></script>
<?php echo $footer; ?>