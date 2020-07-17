
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
                                <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">REJECTED REQUEST (HOTEL)</span></span>&nbsp;<i class="fa fa-bus" aria-hidden="true"></i></h4>
                            </div>


                            <div class="card-content">
                                 <table class="table table-responsive table-striped" id="">
                                     <thead>
                                         
                                         <td style="width:10%"><b>Type</b></td>
                                         <td style="width:30%"><b>Hotel Name</b></td>
                                         <td style="width:15%"><b>User Name</b></td>
                                        
                                        <td style="width:15%"><b>Period</b></td>
                                        <!--<td style="width:10%"><b>Reason</b></td>-->
                                        <td style="width:10%"><b>Hotel Cost</b></td>
                                        <td style="width:10%"><b>Days Spent</b></td>
                                        <td style="width:10%"><b>Amount</b></td>
                                         <td style="width:15%"><b>Status</b></td>
                                         <td style="width:20%"><b>Action</b></td>
                                     </thead>
                               <?php
                                if($getrejectedhotels){ 
                                   foreach($getrejectedhotels as $get){
                                      $hotel_id = $get->hotel_id; 
                                      $destinations = $get->destinations; 
                                      $hotel_type = $get->hotel_type;
                                      $getHotelNameandAddress = $this->travelmodel->dHotelname($hotel_type);
                                      $user_email = $get->user_email;
                                      $reasons = $get->reasons;
                                      $dateRejected = $get->dateRejected;
                                      $dayspent = $get->dayspent;
                                      $totalAmount = $get->totalAmount;
                                       $dAmount = $get->dAmount;
                                      $type = $get->type;
                                      $status = $get->status;
                                      
                                      $destinations = str_replace("_", " - ", $get->destinations);
                                      
                                      $statusWord = $this->primary->getsinglecolumn("name", "status", "id", $status);
                                      $color = ["facebook", "danger", "success", "primary", "teal", "secondary"];
                                      $chooseColors = $color[rand(0, 5)];
                                      
                                      if($status){
                                          $nStatus = "<span class='btn-xs btn-$chooseColors'>$statusWord</span>";
                                      }else{
                                          $nStatus = "nill"; 
                                      }
                                    
                                  ?>
                                 
                                     <tr>
                                        
                                         <td><?php echo $type; ?></td>
                                         <td><?php echo $getHotelNameandAddress; ?></td>
                                         <td><?php echo $user_email; ?></td> 
                                        
                                         <td><?php echo $destinations; ?></td> 
                                        <!--<td><?php //echo $reasons; ?></td>-->
                                         <td><?php echo $dAmount; ?></td> 
                                        <td><?php echo $dayspent; ?></td> 
                                         
                                          <td><?php echo @number_format($totalAmount, 2); ?></td>
                                         <td><?php echo $nStatus; ?></td>
                                         <td>
                                             <a href="<?php echo base_url(); ?>travels/xmyHo4444mdsktel/<?php echo $hotel_id ?>" class="btn btn-xs btn-primary">Edit</a>
                                              <a href="<?php echo base_url(); ?>travels/xmyHo4444mdsktel/<?php echo $hotel_id ?>" class="btn btn-xs btn-danger">Audit</a>
                                         
                                         </td>
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
