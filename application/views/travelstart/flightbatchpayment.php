
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
                                <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">PENDING FLIGHT PAYMENT</span></span>&nbsp;<i class="fa fa-bus" aria-hidden="true"></i></h4>
                                
                               
                            </div>


                            <div class="card-content">
                                <span class="spanError"></span>
                                 <table class="table table-responsive table-striped">
                                     
                                    <tr>
                                        <td><b>Travel Agent</b></td>
                                        <td><b> Flight Name</b></td>
					<td><b>Flight Amount</b></td>
                                        <td><b>Action</b></td>
                                    </tr>
                                      
                               <?php
                                if($getFlightRequest){
                                   foreach($getFlightRequest as $get){
                                      $id = $get->allid; 
                                      $flightName = $get->flightName; 
                                      $flightID = $get->flightID;
                                      $flight_Amount = $get->flight_Amount;
                                      $travel_agency = $get->travel_agency;
                                      $totalSum  = $get->totalSum;
                                      
                                   
                                  ?>
                                 
                                     <tr>
                                     <td><span class="badge badge-primary"><?php echo $travel_agency; ?></span></b></td>
                                         
                                         <td> <?php echo $flightName; ?></td>
                                         <td><?php echo @number_format($totalSum, 2); ?></td>
                                        
                                         <td><a href="<?php echo base_url(); ?>travels/sendpaymentflightdetails/<?php echo $id; ?>"><span class="badge badge-danger">View</span></a></td>
                                       
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
                                <div class="showError"></div>
                               
                               
                            </div>
                        </div>
                    </div>

                    <!-- End of Request Details with Status -->

                    <!-- Inside Content Ends Here -->
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
                                   
                                   
                                   
                                   
                </div>


            </div>
        </div>
        <!-- Main Outer Content Ends  Here --> 
        <script>
   $(document).ready(function(){
      
    });
</script>                 
        <?php echo $footer; ?>
