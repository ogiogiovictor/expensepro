
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
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">HERTZ TRANSPORT FOR :: <?php echo $maintitle; ?></span></span>&nbsp;<i class="fa fa-bus" aria-hidden="true"></i></h4>
                                <p class="category"> </span></p>
                            </div>


                            <div class="card-content">
                               
                                    <?php
                                        if($getHertz){
                                            foreach($getHertz as $get){
                                                $id = $get->tid; 
                                                $travelStart_ID = $get->travelStart_ID; 
                                                $tFrom = $get->tFrom;
                                                $tTo = $get->tTo;
                                                $amountLocal = $get->amountLocal;
                                                $dHertz = $get->dHertz;
                                                $approval = $get->approval;
                                                $exsDate = $get->exsDate;
                                                $exrDate = $get->exrDate;
                                                $logistics = $get->logistics;

                                                $title = " ".ucwords($this->travelmodel->flightStaffemail($travelStart_ID));
                                                
                                            }
                                        }
                                        
                                    ?>
                                
                                 <div class="myMessage">
                                    <form name="addTransForm" id="addTransForm" enctype="multipart/form-data" method="POST" onSubmit="return false;">
                                    
                                        <div class="message">
                                            
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">From<span class="errorRed">* (<small>ready only</small>)</span></label>
                                                            <input placeholder="" type="text" value="<?php echo $this->mainlocation->getdLocation($tFrom); ?>" style="background-color:#e0e2e5" readonly class="form-controls" name="dateCreated" id="dateCreated" />
                                                          
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">To<span class="errorRed">* (<small>ready only</small>)</span></label>
                                                            <input placeholder=""  style="background-color:#e0e2e5" value="<?php echo $this->mainlocation->getdLocation($tTo); ?>" type="text" readonly class="form-controls" name="title" id="title" />
                                                           
                                                        </div>
                                                    </div>
                                            
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Start Date<span class="errorRed">* (<small>ready only</small>)</span></label>
                                                            <input placeholder="" type="text" value="<?php echo $exsDate; ?>" style="background-color:#e0e2e5" readonly class="form-controls" name="logCost" id="logCost" />
                                                            
                                                        </div>
                                                    </div>
                                            
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">End Date<span class="errorRed">* (<small>ready only</small>)</span></label>
                                                            <input placeholder="" type="text" value="<?php echo $exrDate; ?>" style="background-color:#e0e2e5" readonly class="form-controls" name="logCost" id="logCost" />
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Logistics</label>
                                                            <input style="background-color:#e0e2e5" readonly value="<?php echo $logistics; ?>" type="text" class="form-controls" name="flightAmount" id="flightAmount" />
                                                            
                                                        </div>
                                                    </div>
                                            
                                            
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Hertz Amount</label>
                                                            <input  type="text" class="form-controls" name="hertAmount" id="hertAmount" />
                                                            
                                                        </div>
                                                    </div>
                                            
                                                                                       
                                            
                                                    <div class="col-md-12">
                                                        <span id="flyError"></span>
                                                        <input type="hidden" name="transportID" id="transportID" value="<?php echo $id; ?>" />
                                                        <center><button class="btn btn-sm btn-danger" id="addHertzCost">Add Transport</button></center>
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
