
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="<?php echo base_url(); ?>assets/img/sidebar-1.jpg">

        <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
        -->
        <?php echo $sidebar; ?>

    </div>

     <script>
            
            var rpp = <?php echo $rrp; ?>;
            var last = <?php echo $last; ?>;

    </script>

    <script src="<?php echo base_url(); ?>public/javascript/travelall.js"></script> 
       
        
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
                                <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">ALL REQUEST :: TRAVELLING LOGISTICS REQUEST</span></span>&nbsp;<i class="fa fa-bus" aria-hidden="true"></i></h4>
                                <p class="category"> </span></p>
                            </div>


                            <div class="card-content">
                           
                            <div style="float:right">
                            <form style="margin-right:10px" class="form-inline">
                                <div class="row">
                                    <div class="">
                                        <label for="inputPassword6">Search</label>
                                    <input type="text" id="searchAll" class="form-controls mx-sm-3" />
                                    </div>
                                </div>
                                </form>
                        </div>
                        <hr/>
                                <div id="results_box"></div> 
                                <div id="pagination_controls"></div>  
                                <script> request_page(1); </script>
                                

                            </div>
                        </div>
                    </div>

                    <!-- End of Request Details with Status -->
                            <!-- POP UP BOX HERE -->
                                   <div id="popup-box" class="popup-position">
                                       <div id="popup-wrapper">
                                           <div id="popup-container">
                                               <span class="pull-right"><a href="javascript:void(0)" onClick="toggle_visibility('popup-box');">close</a></span>
                                               <span id="eloaddformerror"></span>
                                               <span id="loaddepdetails"></span>
                                           </div>
                                       </div>
                                   </div>
                                   <!-- END OF POP UP BOX -->
                    <!-- Inside Content Ends Here -->


                </div>


            </div>
        </div>
        <!-- Main Outer Content Ends  Here --> 
                      
        <?php echo $footer; ?>
