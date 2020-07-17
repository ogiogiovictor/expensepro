
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
                                    if($whichAcess == TRUE){
                                        //echo " <p class='category'><a href='".base_url()."travels/XX00ooBatch'<button class='btn btn-xs btn-danger'>View Batch</button></a>";
                                    }
                                  ?>
                               
                            </div>


                            <div class="card-content">
                                <span class="spanError"></span>
                                 <table class="table table-responsive table-striped" id="reqeustapproval">
                                      <thead class="text-primary">
                                    <tr>
                                        <td><b>ID</b></td>
                                        <td><b>Travel Agent</b></td>
                                        <td><b>Name</b></td>
					<td><b>Flight</b></td>
                                        <td><b>Unit</b></td>
                                        <td><b>Flight Amount</b></td>
                                        <td><b>Travel Details</b></td>
					
					<!--<td><b>Action</b></td>-->
                                    </tr>
                                    </thead>
	                            <tbody>
                               <?php
                                if($getFlightRequest){
                                   foreach($getFlightRequest as $get){
                                      $id = $get->id; 
                                      $dateCreated = $get->dateCreated; 
                                      $request_ID = $get->request_ID;
                                      $flightID = $get->flightID;
                                      $dUnit = $get->dUnit;
                                      $flightName = $get->flightName;
                                      $travel_agency = $get->travel_agency;
                                      $flight_Amount = $get->flight_Amount;
                                      $flight_Details = $get->flight_Details;
                                      $Status = $get->Status;
                                      $datePaid = $get->datePaid;
                                      
                                   
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
                                              <?php
                                                $getStatus = $this->generalmd->getuserAssetLocation("icuwhoapprove", "travelstart_expense", "tid", $flightID);
                                                if($getStatus == ""){
                                                    echo "";
                                                }else{
                                                    echo "<input type='checkbox' name='dflightCheck[]' id='dflightCheck' value='$id'/>";
                                                }
                                               ?>
                                              
                                               <?php echo $id; ?>
                                          </td>
                                          
                                          <td><span class="badge badge-primary"><?php echo $travel_agency; ?></span></b></td>
                                         
                                         <td>
                                         <?php echo $this->generalmd->getuserAssetLocation("staffName", "travelstart", "id", $request_ID); ?><br/>
                                             <small class="text-danger"><?php echo $this->generalmd->getuserAssetLocation("locationName", "cash_location", "id", $this->generalmd->getuserAssetLocation("tFrom", "travelstart_expense", "tid", $flightID)); ?></small>
                                             -
                                             <small class="text-danger"><?php echo $this->generalmd->getuserAssetLocation("locationName", "cash_location", "id", $this->generalmd->getuserAssetLocation("tTo", "travelstart_expense", "tid", $flightID)); ?></small>
                                             <br/>
                                             <small class="text-success"><?php echo $this->generalmd->getuserAssetLocation("exsDate", "travelstart_expense", "tid", $flightID); ?></small>
                                             - <small class="text-success"><?php echo $this->generalmd->getuserAssetLocation("exrDate", "travelstart_expense", "tid", $flightID); ?></small>
                                         </td>
                                         <td>
                                             <?php echo $flightName; ?>
                                         </td>
                                         <td>
                                             <?php 
                                                echo $dUnit = $dUnit != 0 ? $this->generalmd->getsinglecolumn("unit", "travelstart", "unit", $dUnit) :
                                                    "<span class='badge badge-danger'>N/A</span>";
                                             ?>
                                          
                                         </td>
                                              
                                         <td><?php echo @number_format($flight_Amount,2); ?></td>
                                         
                                         <td><span><?php echo  $flight_Details; ?></span></td>
                                         
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
                                </tbody>
                                 </table>
                                <div class="showError"></div>
                                <?php
                                    if($whichAcess == TRUE){
                                       echo "<div class='btn btn-sm btn-primary' id='batchpayment'>Batch Payment</div>"; 
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

                    
                 $('#reqeustapproval').DataTable( {
            dom: 'Bfrtip',
            buttons: ['excel', 'pdf']
            });


            });
        </script>                 
        <?php echo $footer; ?>
