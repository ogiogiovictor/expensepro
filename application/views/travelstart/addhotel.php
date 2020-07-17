
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
                            
                            
                            <!-- Inside Content Begins  Here -->
                             
                         <!-- Beginning of Request Details with Status -->
                        
                    <div class="col-md-8 col-md-offset-2">     
                        <div class="card">
                                <div class="card-header text-center" data-background-color="blue">
                                    <h4 class="title">&nbsp;&nbsp;SETUP HOTEL</h3>
                                    
                                </div>
                       
                            <div class="addform" style="margin-top:10px; padding:10px">
                               
                                <form method="post" id="addHotel" name="addHotel" onsubmit="return false;">
                                     <input type="text"  style="width:90px" id="hName" name="hName" placeholder="Enter Name" />
                                     
                                      <label></label>
                                      <input type="text" style="width:100px" type="text" id="hotelEmail" name="hotelEmail" placeholder="Hotel Email" />
                                      &nbsp;
                                      
                                     <?php 
                                    $getdestination = $this->mainlocation->getalllocation();
                                    if ($getdestination) { 
                                        $adestination = "";
                                        foreach ($getdestination as $get) {
                                            $destinationid = $get->id;
                                            $destination = $get->locationName;
                                            $adestination .= "<option  value=\"$destinationid\">" . $destination . '</option>';
                                            }
                                        }
                                   
                                     ?>
                                      <label></label>
                                      <select name="hLocation" id="hLocation" class="">
                                          <option value="">Location</option>
                                          <?php echo $adestination; ?>
                                      </select>
                                     
                                      &nbsp;
                                      <label></label>
                                      <input type="number"  style="width:90px" id="hotelCost" name="hotelCost" placeholder="Hotel Cost" />
                                      &nbsp;
                                      <label></label>
                                      <input type="number"  style="width:90px" id="hAmount" name="hAmount" placeholder="Other Amount" /><hr/>
                                      &nbsp;
                                      <label></label>
                                      <input type="text" style="width:140px" type="text" id="haddress" name="haddress"  placeholder="Enter Address"/>
                                      &nbsp;
                                     
                                      <label></label>
                                      <input type="text" style="width:100px" type="text" id="cPerson" name="cPerson" placeholder="Contact Person" />
                                      &nbsp;
                                      <hr/>
                                      <input type="hidden" name="hotelid" value=true>
                                       <span id="showError"></span>
                                      <center><button class="btn btn-sm btn-primary" id="perHotel" name="perHotel">Add</button></center>
                                  </form>
                            </div>
                            <hr/>
                            
                            
                            
                             <div class="card-content">
                                <div  id="dynamicload">
                                   
                                    <!-- Beginnin of Form -->
                                 <span id="hotelMsg"></span>
                                    <div>
                                        
                                        <table class="table table-responsive table-bordered table-striped table-hover">
                                            <tr>
                                                <th>Hotel Name</th>
                                                 <th>Location</th>
                                                <th>Hotel Cost</th>
                                                <th>Other Cost</th>
                                                <th>Address </th>
                                                <th>Contact</th>
                                            </tr>
                                       
                                      <?php
                                        if($getHotel){
                                            foreach($getHotel as $get){
                                                $hid = $get->id;
                                                $hloc = $get->tLocation;
                                                $sAmount = $get->sAmount;
                                                $sAddress = $get->sAddress;
                                                $sContactPerson = $get->sContactPerson;
                                                $addeBy = $get->addeBy;
                                                $HotelName = $get->HotelName;
                                                $hotel_cost = $get->hotel_cost;
                                                
                                                
                                          ?>
                                            <tr>
                                                <td><?php echo $HotelName; ?></td>
                                                <td><?php echo $this->mainlocation->getdLocation($hloc); ?></td>
                                                <td><?php echo $hotel_cost; ?></td>
                                                 <td><?php echo $sAmount; ?></td>
                                                <td><?php echo $sAddress; ?> </td>
                                                <td><?php echo $sContactPerson; ?></td>
                                            </tr>
                                         <?php       
                                            }
                                        }
                                      ?>
                                        </table>
                                    </div>
                                    
                                    <!-- End of Form -->
                                    
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
                
                
                
   <?php echo $footer; ?>