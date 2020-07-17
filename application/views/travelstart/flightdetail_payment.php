
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
                                <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">PROCESS FLIGHT PAYMENT</span></span>&nbsp;<i class="fa fa-bus" aria-hidden="true"></i></h4>
                                <p class="category"> </span></p>
                            </div>


                            <div class="card-content">
                               
                                    <?php
                                        if($getFlightRequest){
                                            foreach($getFlightRequest as $get){
                                                $id = $get->id; 
                                                $batchTitle = $get->batchTitle; 
                                                $sumlID = $get->sumlID;
                                                $batchAmount = $get->batchAmount;
                                                $batchedBy = $get->batchedBy;
                                                $batchCode = $get->batchCode;
                                                $dateBatched = $get->dateBatched;
                                                $batchedStatus = $get->batchedStatus;
                                                $type = $get->type;
                                               
                                            }
                                        }
                                        
                                    ?>
                                
                                 <div class="myMessage">
                                    <form name="flightForm" id="flightForm" enctype="multipart/form-data" method="POST" onSubmit="return false;">
                                    
                                        <div class="message">
                                            
                                                    <div class="col-md-12">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Date<span class="errorRed">* (<small>ready only</small>)</span></label>
                                                            <input placeholder="" type="text" value="<?php echo $dateBatched; ?>" style="background-color:#e0e2e5" readonly class="form-controls" name="dateCreated" id="dateCreated" />
                                                          
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Batch Name<span class="errorRed">* (<small>ready only</small>)</span></label>
                                                            <input placeholder=""  style="background-color:#e0e2e5" value="<?php echo $batchTitle; ?>" type="text" readonly class="form-controls" name="title" id="title" />
                                                           
                                                        </div>
                                                    </div>
                                            
                                                     <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Batch Code<span class="errorRed">* (<small>ready only</small>)</span></label>
                                                            <input placeholder=""  style="background-color:#e0e2e5" value="<?php echo $batchCode; ?>" type="text" readonly class="form-controls" name="title" id="title" />
                                                           
                                                        </div>
                                                    </div>
                                            
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Total Amount<span class="errorRed">* (<small>ready only</small>)</span></label>
                                                            <input placeholder=""  style="background-color:#e0e2e5" value="<?php echo $batchAmount; ?>" type="text" readonly class="form-controls" name="title" id="title" />
                                                           
                                                        </div>
                                                    </div>
                                            
                                                     <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Status<span class="errorRed">* (<small>ready only</small>)</span></label>
                                                            <input placeholder=""  style="background-color:#e0e2e5" value="<?php echo $batchedStatus; ?>" type="text" readonly class="form-controls" name="title" id="title" />
                                                           
                                                        </div>
                                                    </div>
                                            
                                            <br/><hr/>
                                            <h5>OTHER DETAILS REQUIRED FOR PROCESSING PAYMENT</h5>
                                            
                                                 <div class="col-md-12">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Comments</label>
                                                            <textarea name="dcomment" id="dcomment" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                            
                                            
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Sage Ref (if any)</label>
                                                             <input placeholder="" type="text" class="form-controls" name="flightName" id="flightName" />
                                                        </div>
                                                    </div>
                                            
                                                  
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Payee</label>
                                                            <select class="form-controls" name="flightAgency" id="flightAgency">
                                                                <option value="">Select Agency</option>
                                                                <option value="travel-paddy">Travel Paddy</option>
                                                                <option value="travel-start">Travel Start</option>
                                                                 <option value="travel-beta">Travel Beta</option>
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                     
                                            
                                          
                                            
                                                    <div class="col-md-12">
                                                        <span id="flyError"></span>
                                                        <input type="hidden" name="flightID" id="flightID" value="<?php echo $sumlID; ?>" />
                                                        <center><button class="btn btn-sm btn-success" id="addFlightCost">Send For Payment</button></center>
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
        <script>
            $(document).ready(function () {




            });
        </script>                 
        <?php echo $footer; ?>
