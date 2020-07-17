
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
                                <p class="category"> </span></p>
                            </div>


                            <div class="card-content">
                                 <table class="table table-responsive table-striped">
										<tr>
										<td>&nbsp;</td>
										<td><b>Date Created</b></td>
										<td><b>Request Title</b></td>
										<td><b>Logistics Cost</b></td>
										<td><b>Flight Name</b></td>
										<td><b>Flight Amount</b></td>
										<td style="width:200"><b>Flight Details</b></td>
										<td><b>Status</b></td>
										<td style="width:200px"><b>Action</b></td>
										</tr>
                               <?php
                                if($getFlightRequest){
                                   foreach($getFlightRequest as $get){
                                      $id = $get->id; 
                                      $dateCreated = $get->dateCreated; 
                                      $request_ID = $get->request_ID;
                                      $flight_Amount = $get->flight_Amount;
                                      $flight_Details = $get->flight_Details;
                                      $Status = $get->Status;
                                      $flightName = $get->flightName;
                                      
                                      $CurrencyType = $this->travelmodel->getCurrency($request_ID);
                                      
                                      if($CurrencyType == 'naira'){
                                                    $newCurrency = '<span>&#8358;</span>';
                                                }else if($CurrencyType == 'dollar'){
                                                    $newCurrency = '<span>&#x0024;</span>';
                                                }else if($CurrencyType == 'euro'){
                                                    $newCurrency = '<span>&#8364;</span>';
                                                }else if($CurrencyType == 'pounds'){
                                                    $newCurrency = '<span>&#163;</span>';
                                                }else if($CurrencyType == 'yen'){
                                                    $newCurrency = '<span>&#165;</span>';
                                                }else if($CurrencyType == 'singaporDollar'){
                                                    $newCurrency = '<span>S&#x0024;</span>';
                                                }else if($CurrencyType == 'AED'){
                                                    $newCurrency = '<span>(AED)</span>';
                                                }else if($CurrencyType == 'rupee'){
                                                    $newCurrency = '<span>&#8377;</span>';
                                                }else{
                                                   
                                                    if($CurrencyType != ""){
                                                      $newCurrency = @$this->generalmd->getsinglecolumnfromotherdb("curr_symbol", "currencies", "curr_abrev", $CurrencyType); 
                                                    }else if($CurrencyType == "null" || $CurrencyType == ""){
                                                        $newCurrency =  '<span>&#8358;</span>';
                                                    }else{
                                                        $newCurrency =  '<span>&#8358;</span>';
                                                    }
                                                    
                                                }
                                      
                                   
                                   
                                    $title = "Travel Expense for ".ucwords($this->travelmodel->flightStaffemail($request_ID));
                                  ?>
                                 
                                     <tr>
                                         <?php
                                         if($flight_Amount == 0 || $flight_Amount == ""){
                                             echo "<td>&nbsp;</td>";
                                         }else{
                                           echo "<td><input type='checkbox' name='dflightCheck[]' id='dflightCheck' value='$id'/></td>";  
                                         }
                                         
                                         ?>
                                         <td><?php echo $dateCreated; ?></td>
                                         <td><?php echo  $title; ?></b></td>
                                         
                                         <td><?php echo $newCurrency. @number_format($this->travelmodel->getTravelAmount($request_ID), 2); ?></td>
                                         <td><?php echo $flightName; ?></td>
                                         <td><?php echo @number_format($flight_Amount, 2); ?></td>
                                         <td><?php echo $flight_Details; ?></td>
                                         <td><?php echo $Status; ?></td>
                                         <td><button data-id="<?php echo $request_ID; ?>" onClick="toggle_visibility('popup-box')" class="btn btn-xs btn-success viewFlight">View</button>&nbsp;<a href="<?php echo base_url(); ?>travels/addflightrequestX00000/<?php echo $id; ?>/<?php echo $request_ID; ?>/<?php echo urlencode($title); ?>"><button class="btn btn-xs btn-danger">Add</button></a>
										 <button class="btn btn-xs btn-info">N/A</button>
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
                               <div class="btn btn-sm btn-primary" id="batchpayment">Batch Payment</div>
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
            $(document).ready(function () {

             var table = $('#flightmake');
        var oTable = table.DataTable({
            "order": [[0, "desc" ]]
           
        });  


            });
        </script>                 
        <?php echo $footer; ?>
