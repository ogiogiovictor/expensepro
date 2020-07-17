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

                    <div class="col-md-4">     

                        <form name="bookhotelNOW" id="bookhotelNOW" method="POST">
                            <!-- Inside Content Begins  Here -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title"><span class="tastkform"><span style="color:white">BOOK HOTEL</span></span></h4>
                                       
                                    </div>

                                    
                                    <div class="card-content">

                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Type</label>
                                               
                                               <select class="form-controls dType" name="dType" id="dType" data-live-search="true">
                                                   <option value="">Select Type</option>
                                                   <option value="staff">Staff</option>
                                                   <option value="not-staff">Non Staff</option>
                                               
                                               </select>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-12 label-floating">
                                             <div class="form-group">
                                             <label class="control-label">Name OR Email</label>
                                              <span id="pickemail" style="color:red">Please choose a type</span>
                                              <!--<input type="text" class="form-controls" name="emailAddress" id="emailAddress" />-->
                                                </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Which Hotel</label>
                                                <?php
                                                    if($allHotel){
                                                        $all = "";
                                                        foreach($allHotel as $hT){
                                                            $hotelID = $hT->id;
                                                            $hotelName = $hT->HotelName;
                                                            $dAmount = $hT->sAmount;
                                                            $sAddress = $hT->sAddress;
                                                            $all .= "<option value='$hotelID'>$hotelName  $sAddress</option>";
                                                        }
                                                    }
                                                ?>
                                               <select class="form-controls dType" name="whichhotel" id="whichhotel" data-live-search="true">
                                                   <option value="">Select Hotel</option>
                                                   <?php echo $all; ?>
                                               </select>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">From</label>
                                                    <input type="text" class="form-controls newdatelog" name="hFrom" id="hFrom" />
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">To</label>
                                                    <input type="text" class="form-controls newdatelog" name="hTo" id="hTo" />
                                            </div>
                                        </div>
                                        
                                        
                                        <?php
                                            $gethod = $this->adminmodel->getalluserwithhodid();
                                            $kaboom = explode(",", $gethod);
                                            $hod = "";
                                            foreach ($kaboom as $key => $value) {
                                                $getallemail = $this->users->getresultwithid($value);

                                                if ($getallemail) {
                                                    foreach ($getallemail as $get) {
                                                        $newid = $get->id;
                                                        $fname = $get->fname;
                                                        $lname = $get->lname;
                                                        $email = $get->email;
                                                        $hod .= "<option  value=\"$email\">" . $fname . " " . $lname . " >> " . $email . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                         <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Select HOD</label>
                                                  <select class="form-control mySelect" data-style="btn-default" name="dhod" id="dhod" data-live-search="true">
                                                        <option value="">Select HOD</option>
                                                        <?php echo $hod; ?>
                                                    </select>
                                            </div>
                                        </div>
                                        
                                         <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Reason</label>
                                                <textarea class="form-control" name="dReason" id="dReason" row="15"></textarea>
                                                </div>
                                        </div>

                                        <center><button class="btn btn-sm btn-danger" id="bookmenow">Book Now</button></center>

                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- End of Request Details with Status -->

                    </div>   
                    
                    
                    
                    <div class="col-md-8">     

                        <form name="batchedHotel" id="batchedHotel" method="POST" action="<?php echo base_url(); ?>travelstart/hotelbeingbatched">
                            <!-- Inside Content Begins  Here -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title"><span class="tastkform"><span style="color:white">LATEST BOOKINGS</span></span></h4>
                                        <!--<p class="category btn btn-xs btn-danger"><a href="<?php echo base_url(); ?>travels/xmyHo4444mdsktel">VIEW HOTELS</a></p>-->
                                       
                                            <span><a class="category btn btn-xs btn-success" href="<?php echo base_url(); ?>travels/hotelbygroup" >VIEW HOTELS</a></span>
                                            &nbsp;&nbsp;&nbsp;
                                            <span><a class="category btn btn-xs btn-danger" href="<?php echo base_url(); ?>travels/rejectedhotelrequest">REJECTED REQUEST</a></span>
                                       
                                    </div>

                                    <div class="card-content">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Type</th> 
                                                    <th>Email</th>
                                                    <th>Destination</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                      
                                                <tbody id="contract_list">
                                                  
                                                <?php
                                                    if($hoteldetails){
                                                        foreach($hoteldetails as $get){
                                                            $id = $get->hotel_id;
                                                            $type = $get->type;
                                                            $Htype = $get->hotel_type;
                                                            $user_email = $get->user_email;
                                                            $hod = $get->hod;
                                                            $destinations = $get->destinations;
                                                            $status = $this->primary->getsinglecolumn("name", "status", "id", $get->status);
                                                 ?>
                                                  <tr>
                                                        <td><?php echo $id; ?></td>
                                                        <td><?php echo $type; ?> </td>
                                                        <td>
                                                            <?php echo $user_email; ?><br/>
                                                            <small style="color:red"><?php echo $this->generalmd->getsinglecolumn("HotelName", " travel_hotel", "id", $Htype); ?></small>
                                                        </td>
                                                        <td><?php echo str_replace('_', '-', $destinations); ?></td>
                                                        <td><?php echo $status; ?></td>
                                                    </tr>
                                               
                                                
                                                <?php
                                                  }
                                                    }
                                                ?>
                                              </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- End of Request Details with Status -->

                    </div>   
                    
                    
                    
                    
                    
                    
                    
                </div>


            </div>
        </div>
        <!-- Main Outer Content Ends  Here -->
        <script src="<?php echo base_url(); ?>public/javascript/bookhotel.js"></script>
            <script type="text/javascript">
            $(document).ready(function () {
        
          $(document).on('click', '.newdatelog', function () {
                    $(this).datepicker({
                        //dateFormat: 'yy-mm-d',
                        format: 'yyyy-mm-dd',
                        weekStart: 1,
                        color: 'red'
                    });
                });



            });
        </script>
        <?php echo $footer; ?>
