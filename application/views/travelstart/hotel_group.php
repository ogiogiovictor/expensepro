
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

                    <form name="batchedHotel" id="batchedHotel" method="POST" action="<?php echo base_url(); ?>travelstart/hotelbeingbatched">
                    <!-- Inside Content Begins  Here -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">PENDING HOTEL PAYMENT</span></span>&nbsp;<i class="fa fa-bus" aria-hidden="true"></i></h4>
                                  <a href="<?php echo base_url(); ?>travels/addhoteltostaff"><p class="category btn btn-xs btn-danger">Add Hotel</p></a>
                                   <a href="<?php echo base_url(); ?>travels/viewallbatch"><p class="category btn btn-xs btn-success">View Batch</p></a>
                            </div>


                            <div class="card-content">
                                 <table class="table table-responsive table-striped" id="">
                                     <thead>
                                         
                                         <td style="width:40%"><b>Hotel Name</b></td>
                                         <td style="width:5%"><b>No of Request</b></td>
                                         <td style="width:10%"><b>Total Amount</b></td>
                                        
                                         <td style="width:15%"><b>Status</b></td>
                                         <td style="width:15%"><b>Action</b></td>
                                     </thead>
                               <?php
                                if($gethotellarrange){ 
                                   foreach($gethotellarrange as $get){
                                      $goID = $get->goID; 
                                      $dCount = $get->dcount; 
                                      $hotel_type = $get->hotel_type;
                                      $getHotelNameandAddress = $this->travelmodel->dHotelname($hotel_type);
                                      $total = $get->total;
                                      $status = $get->status;
                                      
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
                                        
                                         <td><?php echo $getHotelNameandAddress; ?></td>
                                         <td><span class="badge badge-success"><?php echo $dCount; ?></span></td>
                                          <td><?php echo @number_format($total, 2); ?></td>
                                         <td><?php echo $nStatus; ?></td>
                                         <td><a href="<?php echo base_url(); ?>travels/xmyHo4444mdsktel/<?php echo $goID ?>" class="btn btn-xs btn-primary">View</a></td>
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
                </form>

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
