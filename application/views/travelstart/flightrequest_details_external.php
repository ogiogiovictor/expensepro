
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
                               
                                   
                                
                                 <div class="myMessage">
                                    <form name="flightForm" id="flightForm" enctype="multipart/form-data" method="POST" onSubmit="return false;">
                                    
                                        <div class="message">
                                            
                                                    <div class="col-md-12">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Name<span class="errorRed"></label>
                                                            <input placeholder="" type="text"  class="form-controls" name="name" id="name" />
                                                          
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
                                            
                                            
                                                    <!--<div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Upload Attachment</label>
                                                           <input type="file" class="form-controls" name="myAttachment[]" id="myAttachment" multiple/>
                                                        </div>
                                                    </div>-->
                                            
                                            
                                            
                                            <p><hr/>
                                            <h5>ADD FLIGHT DETAILS <span class="fa fa-plus-square-o"></span></h5>
                                               
                                            <div id="tab-2" class="tab-content">
                                                <table class="table table-bordered" id="item_table">
                                                    <tr>
                                                        <th style="width:20%">From</th>
                                                        <th style="width:20%">To</th>
                                                        <th style="width:15%">StartDate</th>
                                                        <th style="width:15%">End Date</th>
                                                        <th style="width:30%">Purpose</th>
                                                        <th style="width:10%"><button title="Add More" type="button" name="add" class="btn btn-success btn-xs add"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></th>
                                                    </tr>

                                                    <tr>
                                                        <td><select name="tFromlocation[]" required id="tFromlocation" class="form-controls"><option value="">Select From</option><?php echo $dLocationow; ?></select></td>
                                                        <td><select name="tTolocation[]" required id="tTolocation" class="form-controls"><option value="">Select To</option><?php echo $dLocationow; ?></select></td>
                                                        <td><input type="text" required name="exsDate[]" id="exsDate" placeholder="dddd-mm-dd" class="form-controls newdatelog" value="<?php echo date('Y-m-d'); ?>"/></td>
                                                        <td><input type="text" required name="exrDate[]" id="exrDate" placeholder="dddd-mm-dd" class="form-controls newdatelog" value="<?php echo date('Y-m-d'); ?>"/></td>
                                                        <td><textarea type="text" required name="purpose[]" id="purpose"  class="form-controls"></textarea></td>
                                                       
                                                        <td><button type="type" title="Remove" name="remove" class="btn btn-danger btn-xs remove"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td></tr>
                                                    </tr>
                                                </table>
                                            </div><!-- END OF TAB TWO LOCATION INFORMATION -->
                                          
                                            </p>
                                            
                                            
                                            <hr/>
                                               <div class="col-md-12">
                                                        <span id="flyError"></span>
                                                        <center><button class="btn btn-sm btn-danger" id="addFlightexternal">Add Flight Cost</button></center>
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
        <script type="text/javascript">
            $(document).ready(function () {



                $('ul.tabs li').click(function () {
                    var tab_id = $(this).attr('data-tab');

                    $('ul.tabs li').removeClass('current');
                    $('.tab-content').removeClass('current');

                    $(this).addClass('current');
                    $("#" + tab_id).addClass('current');
                });

                $(document).on('click', '.add', function () {
                    var html = "";
                    html += "<tr>";
                    html += "<td><select name='tFromlocation[]' required id='tFromlocation'  class='form-controls tFromlocation'><option value=''>Select From</option><?php echo $dLocationow; ?></select></td>";
                    html += "<td><select name='tTolocation[]' required id='tTolocation' class='form-controls tTolocation'><option value=''>Select To</option><?php echo $dLocationow; ?></select></td>";
                    html += "<td><input type='text' required name='exsDate[]' id='exsDate' placeholder='dddd-mm-dd' class='form-controls newdatelog' value='<?php echo date('Y-m-d'); ?>'/></td>";
                    html += "<td><input type='text' required name='exrDate[]' id='exrDate' placeholder='dddd-mm-dd' class='form-controls newdatelog' value='<?php echo date('Y-m-d'); ?>'/></td>";
                    html += "<td><textarea type='text' required name='purpose[]' id='purpose'  class='form-controls'></textarea></td>";
                    html += "<td><button type='type' name='remove' class='btn btn-danger btn-xs remove'><i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
                    $('#item_table').append(html);
                });

                $(document).on('click', '.remove', function () {
                    var r = confirm("Are you sure you want to remove the location. Please make sure no location is selected before you remove");
                    if (r == true) {

                        $(this).closest('tr').remove();
                    }
                });

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
