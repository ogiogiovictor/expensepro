
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
                                 <?php
                                    if($whichAcess == TRUE && $forhodonlys != TRUE){
                                        echo " <p class='category'><a href='".base_url()."travels/UUUUUUUx0dsl123854mybatchedrequest'<button class='btn btn-xs btn-danger'>View Batch</button></a>"
                                                . "<a href='".base_url()."travels/sendpaymentflight'<button class='btn btn-xs btn-success'>Send Payment</button></a>&nbsp;"
                                                . "<a href='".base_url()."travels/bookflightexternal'<button class='btn btn-xs btn-primary pull-right'>Book Flight(external)</button></a>"
                                                . "<a href='".base_url()."travels/allfightrequest'<button class='btn btn-xs btn-info'>All Flight Request</button></a></p>";
                                    }
                                  ?>
                               
                            </div>


                            <div class="card-content">
                                <span class="spanError"></span>
                                 <table class="table table-responsive table-striped">
                                    <tr>
                                        <td><b>Travel Agent</b></td>
                                        <td><b>Name</b></td>
					<td><b>From</b></td>
                                        <td><b>To</b></td>
                                        <td><b>Days</b></td>
					<td><b>Flight Name</b></td>
					<td><b>Flight Amount</b></td>
					<td style="width:200"><b>Flight Details</b></td>
					<td style="width:150"><b>Treated By</b></td>
					<td style="width:200px"><b>Action</b></td>
                                    </tr>
                               <?php
                                if($getFlightRequest){
                                   foreach($getFlightRequest as $get){
                                      $id = $get->tid; 
                                      $travelStart_ID = $get->travelStart_ID; 
                                      $tFrom = $get->tFrom;
                                      $tTo = $get->tTo;
                                      $sTotal = $get->sTotal;
                                      $diff = $get->diff;
                                      $amountLocal = $get->amountLocal;
                                      $HertzAmount = $get->HertzAmount;
                                      $hotelAmount = $get->hotelAmount;
                                      $daySpent_inHotel = $get->daySpent_inHotel;
                                      $exsDate = $get->exsDate;
                                      $exrDate = $get->exrDate;
                                      $logistics = $get->logistics;
                                      $flightprocessBy = $get->flightprocessBy;
                                      $hodwhoapprove = $get->hodwhoapprove;
                                      $icuwhoapprove = $get->icuwhoapprove;
                                      $staffType = $get->staffType;
                                      
                                      if($staffType == "staff"){
                                          $staffName = @$this->generalmd->getsinglecolumn("staffName", "travelstart", "id", $travelStart_ID);
                                      }else{
                                          $staffName = $travelStart_ID;
                                      }
                                      
                                      $CurrencyType = $this->travelmodel->getCurrency($travelStart_ID);
                                      
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
                                   
                                    //$title = "Travel Expense for ".ucwords($this->travelmodel->flightStaffemail($request_ID));
                                    
                                    //$newtitle = urlencode($title);
                                  ?>
                                 
                                     <tr>
                                         <?php
                                            /* if($addedBy != $_SESSION['email']){
                                                echo "<td>&nbsp;</td>";
                                            }else if($getFlightRequest == 6){
                                                echo "<td><input type='checkbox' name='dflightCheck[]' id='dflightCheck' value='$id'/>$id</td>";   
                                            }else{
                                              echo "<td><input type='checkbox' name='dflightCheck[]' id='dflightCheck' value='$id'/></td>";  
                                            }
                                         */
                                         ?>
                                          <td>
                                             <?php echo @$this->generalmd->getsinglecolumn("travel_agency", " flight_request", "flightID", $id); ?>
                                          </td>
                                         <td>
                                         <?php echo @$staffName; ?><br/>
                                             <small class="text-danger"><?php echo $newCurrency. @number_format($this->travelmodel->getTravelAmount($travelStart_ID), 2); ?></small>
                                         </td>
                                         <td>
                                             <?php echo @$this->generalmd->getsinglecolumn("locationName", "cash_location", "id", $tFrom); ?><br/>
                                             <small class="text-success"><?php echo  $exsDate; ?></small>
                                         </td>
                                         <td><?php echo @$this->generalmd->getsinglecolumn("locationName", "cash_location", "id", $tTo); ?><br/>
                                             <small class="text-success"> <?php echo  $exrDate; ?></small>
                                         </td>
                                         <td><span class="badge badge-primary"><?php echo  $diff; ?></span></b></td>
                                         
                                         <td><?php echo @$this->generalmd->getsinglecolumn("flightName", " flight_request", "flightID", $id); ?></td>
                                         <td><?php echo @$this->generalmd->getsinglecolumn("flight_Amount", " flight_request", "flightID", $id); ?></td>
                                         <td><?php echo @$this->generalmd->getsinglecolumn("flight_Details", " flight_request", "flightID", $id); ?></td>
                                         <td><?php echo @$this->generalmd->getsinglecolumn("addedBy", " flight_request", "flightID", $id); ?></td>
                                         <td><button data-id="<?php echo $travelStart_ID; ?>" onClick="toggle_visibility('popup-box')" class="btn btn-xs btn-success viewFlight">View</button>&nbsp;
                                         <?php
                                         if($flightprocessBy == "" && $whichAcess == TRUE && $forhodonlys != TRUE && $icuwhoapprove != TRUE){
                                              echo "<a href='".base_url()."travels/addflightrequestX00000/$id/'><button class='btn btn-xs btn-danger'>Add</button></a>
                                          <button onClick='notapplication($id)' class='btn btn-xs btn-info'>N/A</button>";
                                         }else if($forhodonlys == TRUE && $hodwhoapprove == "" && $flightprocessBy != ""){
                                              echo "<button onClick='approveflight($id)' class='btn btn-xs btn-primary'>Approve</button>"
                                                      . "<button onClick='notapplication($id)' class='btn btn-xs btn-info'>N/A</button>";
                                         }else if($getApprovalLevel == '3' && $icuwhoapprove == ""){
                                              echo "<button onClick='verifyflight($id)' class='btn btn-xs btn-danger'>Verify</button>"
                                                      . "<button onClick='notapplication($id)' class='btn btn-xs btn-info'>N/A</button>";
                                         }else{
                                             echo "";
                                         }
                                        
                                         ?>
                                         
					 
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
                                <?php
                                    if($whichAcess == TRUE){
                                      // echo "<div class='btn btn-sm btn-primary' id='batchpayment'>Batch Payment</div>"; 
                                    }
                                ?>
                               
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

                var table = $('#reqeustapproval');
                    var oTable = table.DataTable({
                        "order": [[0, "desc" ]]

                    });  


            });
        </script>                 
        <?php echo $footer; ?>
