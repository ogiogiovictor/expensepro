
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
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">ADD FLIGHT TICKET</span></span>&nbsp;<i class="fa fa-bus" aria-hidden="true"></i></h4>
                                <p class="category"> </span></p>
                            </div>


                            <div class="card-content">
                               
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
                                                $tFrom = $get->tFrom;
                                                $tTo = $get->tTo;
                                            }
                                        }
                                        
                                    ?>
                                
                                 <div class="myMessage">
                                    <form name="flightForm" id="flightForm" enctype="multipart/form-data" method="POST" onSubmit="return false;">
                                    
                                        <div class="message">
                                            
                                                    <div class="col-md-12">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Staff Name<span class="errorRed">* (<small>ready only</small>)</span></label>
                                                            <input placeholder="" type="text" value="<?php echo @$this->generalmd->getsinglecolumn("staffName", "travelstart", "id", $travelStart_ID); ?>" style="background-color:#e0e2e5" readonly class="form-controls" name="dateCreated" id="dateCreated" />
                                                          
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">From<span class="errorRed">* (<small>ready only</small>)</span></label>
                                                            <input placeholder=""  style="background-color:#e0e2e5" value="<?php echo @$this->generalmd->getsinglecolumn("locationName", "cash_location", "id", $tFrom); ?>" type="text" readonly class="form-controls" name="title" id="title" />
                                                           
                                                        </div>
                                                    </div>
                                            
                                                     <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">To<span class="errorRed">* (<small>ready only</small>)</span></label>
                                                            <input placeholder=""  style="background-color:#e0e2e5" value="<?php echo @$this->generalmd->getsinglecolumn("locationName", "cash_location", "id", $tTo); ?>" type="text" readonly class="form-controls" name="title" id="title" />
                                                           
                                                        </div>
                                                    </div>
                                            
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Start Date<span class="errorRed">* (<small>ready only</small>)</span></label>
                                                            <input placeholder=""  style="background-color:#e0e2e5" value="<?php echo $exsDate; ?>" type="text" readonly class="form-controls" name="title" id="title" />
                                                           
                                                        </div>
                                                    </div>
                                            
                                                     <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">End Date<span class="errorRed">* (<small>ready only</small>)</span></label>
                                                            <input placeholder=""  style="background-color:#e0e2e5" value="<?php echo $exrDate; ?>" type="text" readonly class="form-controls" name="title" id="title" />
                                                           
                                                        </div>
                                                    </div>
                                            
                                                   
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Flight Agency</label>
                                                            <select class="form-controls" name="flightAgency" id="flightAgency">
                                                                <option value="">Select Agency</option>
                                                                <option value="travel-paddy">Travel Paddy</option>
                                                                <option value="travel-start">Travel Start</option>
                                                                 <option value="travel-beta">Travel Beta</option>
                                                            </select>
                                                            
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
                                            
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Select HOD</label>
                                                            <select class="form-controls" name="hodtoaprove" id="hodtoaprove">
                                                               <option value="">Select HOD</option>
                                                                <?php echo $hod; ?>
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                            
                                            
                                            
                                                     <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Flight Name</label>
                                                            <input placeholder="" type="text" class="form-controls" name="flightName" id="flightName" />
                                                            
                                                        </div>
                                                    </div>
                                            
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Flight Amount</label>
                                                            <input placeholder="" type="text" class="form-controls" name="flightAmount" id="flightAmount" />
                                                            
                                                        </div>
                                                    </div>
                                            
                                            
                                                    <div class="col-md-12">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Flight Details</label>
                                                            <textarea class="form-control" name="flightDetails" id="flightDetails"></textarea>
                                                            
                                                        </div>
                                                    </div>
                                            
                                            
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Upload Attachment</label>
                                                           <input type="file" class="form-control" name="myAttachment[]" id="myAttachment" multiple/>
                                                        </div>
                                                    </div>
                                            
                                            
                                                    <div class="col-md-12">
                                                        <span id="flyError"></span>
                                                        <input type="hidden" name="flightID" id="flightID" value="<?php echo $id; ?>" />
                                                        <input type="hidden" name="travelID" id="travelID" value="<?php echo $travelStart_ID; ?>" />
                                                        <center><button class="btn btn-sm btn-danger" id="addFlightCost">Add Flight Cost</button></center>
                                                    </div>
                                            
                                            
                                        
                                        </div>
                                        
                                        
                                    </form>
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
