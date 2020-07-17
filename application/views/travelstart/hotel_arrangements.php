
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
                                 <table class="table table-responsive table-striped" id="flightmake">
                                     <thead>
                                         <td style="width:2%">ID</td>
                                         <td style="width:15%"><b>User Name</b></td>
                                          <td style="width:10%"><b>Code</b></td>
                                         <td style="width:20%"><b>Hotel</b></td>
                                         <td style="width:10%"><b>Period</b></td>
                                          <td style="width:5%"><b>No-of-Days</b></td>
                                          <td style="width:5%"><b>Hotel Cost</b></td>
                                         <!--<td style="width:10%"><b>Reason</b></td>-->
                                         <td style="width:10%"><b>Total Cost</b></td>
                                        
                                         
                                         <td style="width:15%"><b>Status</b></td>
                                         <!--<td style="width:20%"><b>Action</b></td>-->
                                     </thead>
                               <?php
                                $sum = 0;
                                if($gethotellarrange){ 
                                   foreach($gethotellarrange as $get){
                                      $hotel_id = $get->hotel_id; 
                                      $type = $get->type; 
                                      $user_email = $get->user_email;
                                      $hotel_type = $get->hotel_type;
                                      $destinations = $get->destinations;
                                      $reasons = $get->reasons;
                                      $addedBy = $get->addedBy;
                                      $status = $get->status;
                                      $dateCreated = $get->dateCreated;
                                       $hotel_code = $get->hotel_code;
                                      $getHotelNameandAddress = $this->travelmodel->dHotelname($hotel_type);
                                      $getHotelAmount = $this->travelmodel->dHotelClass($hotel_type);
                                      $dAmount = $get->dAmount;
                                       $dayspent = $get->dayspent;
                                        $totalAmount = $get->totalAmount;
                                      $meExplode = explode("_", $destinations);
                                      $statusWord = $this->primary->getsinglecolumn("name", "status", "id", $status);
                                      $color = ["facebook", "danger", "success", "primary", "teal", "secondary"];
                                      $chooseColors = $color[rand(0, 5)];
                                      
                                      if($totalAmount){
                                          $sum += $totalAmount;
                                      }
                                      
                                      if($status){
                                          $nStatus = "<span class='btn-xs btn-$chooseColors'>$statusWord</span>";
                                      }else{
                                          $nStatus = "nill";
                                      }
                                      
                                     $userName = $this->generalmd->getsinglecolumn("fname", " cash_usersetup", "id", $addedBy)
                                  ?>
                                 
                                     <tr>
                                         <?php
                                         if($statusWord == 'Awaiting Verification'){
                                             echo "<td><input type='checkbox' name='dHotelpayment[]' id='dHotelpayment' value='$hotel_id'/>
                                                   <input type='hidden' name='dID[]' id='dID' value='$hotel_id'/>$hotel_id</td>";  
                                         }else{
                                             echo "<td>$hotel_id</td>"; 
                                         }
                                         
                                         ?>
                                         <td><?php echo $user_email; ?></td>
                                         <td><b><?php echo $hotel_code; ?></b></td>
                                         <td style="width:150px"><?php echo $getHotelNameandAddress; ?></td>
                                         <td>
                                         <?php echo  $meExplode[0]; ?></b>
                                         <?php echo  $meExplode[1]; ?></b>
                                         </td>
                                          <td><?php echo $dayspent; ?></td>
                                           <td><b><?php echo $dAmount; ?></b></td>
                                          <!--<td><?php //echo $reasons; ?></td>-->
                                         <td><?php echo $totalAmount; ?></td>
                                         
                                        
                                         <td><?php echo $nStatus; ?></td>
                                          <!--<td><button data-id="<?php //echo $hotel_id; ?>" onClick="toggle_visibility('popup-box')" class="btn btn-xs btn-success viewHotels" onClick="return false;">View</button></td>-->
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
                                <?php
                               
                                 //$getSUM = $this->primary->sumverifedhotel($hotel_type);
                                ?>
                                <div class="showError"></div>
                                <b><div style="font-size:20px; font-weight:bold; float:right">Approved Amount:  <?php echo @number_format($sum, 2); ?></div></b>
                                <input class="btn btn-sm btn-primary"  type="submit" name="batchpaymentforhotels" value="Batch Payment" />
                               
                            </div>
                        </div>
                    </div>
                </form>

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
            $(document).ready(function () {

        var oTable = $('#flightmake');
         oTable = table.DataTable({
            "order": [[0, "desc" ]]
           
        });  


            });
        </script>                 
        <?php echo $footer; ?>
