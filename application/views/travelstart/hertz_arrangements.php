
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
                                <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">PENDING HERTZ PAYMENT </span></span>&nbsp;<i class="fa fa-bus" aria-hidden="true"></i></h4>
                                <p class="category"> </span></p>
                            </div>


                            <div class="card-content">
                                 <table class="table table-responsive table-striped" id="flightmake">
                                     <thead>
                                         <td style="width:2%">&nbsp;</td>
                                         <td style="width:20%"><b>Hertz Transport</b></td>
                                         <td style="width:5%"><b>Form</b></td>
                                         <td style="width:5%"><b>To</b></td>
                                         <td style="width:10%"><b>Start Date</b></td>
                                         <td style="width:10%"><b>End Date</b></td>
                                         <td style="width:5%"><b>Days</b></td>
                                         <td style="width:15%"><b>Amount Local</b></td>
                                         <td style="width:20%"><b>Action</b></td>
                                     </thead>
                               <?php
                                if($gethotellarrange){
                                   foreach($gethotellarrange as $get){
                                      $tid = $get->tid; 
                                      $travelStart_ID = $get->travelStart_ID; 
                                      $tFrom = $get->tFrom;
                                      $tTo = $get->tTo;
                                      $amount = $get->amount;
                                      $diff = $get->diff;
                                      $sTotal = $get->sTotal;
                                      $amountLocal = $get->amountLocal;
                                      $exCode = $get->exCode;
                                      $exsDate = $get->exsDate;
                                      $exrDate = $get->exrDate;
                                      $logistics = $get->logistics;
                                      $purpose = $get->purpose;
                                      $hotelID = $get->hotelID;
                                      $approval = $get->approval;
                                      $hotel_payment = $get->hotel_payment;
                                      $days_Spent = $get->days_Spent;
                                      $amountSpent = $get->amountSpent;
                                      $balance = $get->balance;
                                      $processedBy = $get->processedBy;
                                      $dHertz = $get->dHertz;
                                     
                                      $getHotelNameandAddress = $this->travelmodel->dHotelname($hotelID);
                                      $getHotelAmount = $this->travelmodel->dHotelClass($hotelID);
                                      
                                    $title = " ".ucwords($this->travelmodel->flightStaffemail($travelStart_ID));
                                  ?>
                                 
                                     <tr>
                                         <?php
                                         if($amountLocal == '0'){
                                             echo "<td>&nbsp;</td>";
                                         }else{
                                           echo "<td><input type='checkbox' name='dHotelpayment[]' id='dHotelpayment' value='$tid'/></td>";  
                                         }
                                         
                                         ?>
                                         <td><?php echo $title; ?></td>
                                         <td><?php echo  $this->mainlocation->getdLocation($tFrom); ?></b></td>
                                          <td><?php echo  $this->mainlocation->getdLocation($tTo); ?></b></td>
                                          <td><?php echo $exsDate; ?></td>
                                         <td><?php echo $exrDate; ?></td>
                                         <td><?php echo $diff; ?></td>
                                         <td><?php echo $amountLocal; ?></td>
                                         
                                          <td>
                                              <button data-id="<?php echo $tid; ?>" onClick="toggle_visibility('popup-box')" class="btn btn-xs btn-success viewHotels" onClick="return false;">View</button>
                                          <!--<a href="<?php echo base_url(); ?>travels/addHertzPaymentX0OOo/<?php echo $tid; ?>/<?php echo $dHertz; ?>/<?php echo urlencode($title); ?>"><button class="btn btn-xs btn-danger">Add</button></a> -->
                                          <a class="btn btn-xs btn-danger" href="<?php echo base_url(); ?>travels/addHertzPaymentX0OOo/<?php echo $tid; ?>/<?php echo urlencode($title); ?>">Add</a>
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
                                <div class="showError"></div>
                                <!--<input class="btn btn-sm btn-primary"  type="submit" name="batchpaymentforhotels" value="Batch Payment" /> -->
                               
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

             var table = $('#flightmake');
        var oTable = table.DataTable({
            "order": [[0, "desc" ]]
           
        });  


            });
        </script>                 
        <?php echo $footer; ?>
