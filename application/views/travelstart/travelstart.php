<style type="text/css">
    ul.tabs{
        margin: 0px;
        padding: 0px;
        list-style: none;
    }
    ul.tabs li{
        background: none;
        color: #222;
        display: inline-block;
        padding: 10px 15px;
        cursor: pointer;
    }

    ul.tabs li.current{
        background: #ededed;
        color: #222;
    }

    .tab-content{
        display: none;
        background: #ededed;
        padding: 15px;
    }

    .tab-content.current{
        display: inherit;
    }
</style>
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

                    <!-- Beginning of Request Details with Status<div class="col-md-6 col-md-offset-3 bgback"> -->

                    <div class="col-md-10 col-md-offset-1 bgback">  
                        <!--<span class="pull-right"><small><?php //echo date('Y-m-d H:i:s');   ?></small></span>-->
                        <div class="card">

                            <div class="card-content">
                                <div class="card-header text-center" data-background-color="blue">
                                    <center><div class="mymainform"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white"><a href="<?php echo base_url(); ?>travels/xdmds_xn">TBS :: TRAVELLING LOGISTICS</a></span></span>&nbsp;<i class="fa fa-ship" aria-hidden="true"></i></div></center>
                           <!--<center><small class="mycoustomalert">Note:please make sure you fill all fields</small> </center>-->
                                </div>
                                <br/>

                                <?php
                                if ($iamastaff) {
                                    foreach ($iamastaff as $getme) {
                                        $getajobID = $getme->id;
                                        $staffID = $getme->staff_id;
                                        $sname = $getme->name;
                                        $location = $getme->business_branch;
                                        $unit = $getme->unit;
                                        $SalaryLevel = $getme->salary_level;
                                    }
                                } 
                                ?>

                                <?php
                                //$staffID = preg_replace("([S])", "", $staffID);
                                ?>
                                <div class="myMessage">
                                    <form name="travelStartForm" id="travelStartForm" enctype="multipart/form-data" method="POST" onSubmit="return false;">

                                        <div class="dtabs">

                                            <ul class="tabs">
                                                <li class="tab-link current" data-tab="tab-1"><b>REQUEST INFORMATION</b></li>
                                                <li class="tab-link" data-tab="tab-2"><b>TRIP / LOCAL TRANSPORT</b></li>
                                                <li class="tab-link" data-tab="tab-3"><b>ATTACHMENT</b></li>
                                            </ul>

                                            <div id="tab-1" class="tab-content current">
                                                <span id="message"></span>

                                                <div class="row">
                                                    <?php
                                                    if ($getApprovalLevel == 6) {

                                                        echo "<div class='col-md-4'>
                                                <div class='form-group label-floating'>
                                                    <label class='control-label'>Staff ID <small>(numeric only)<span class='errorRed'>*</span></small></label>
                                                    <input type='number'  class='form-controls' name='staffID' id='staffID' value=''/>
                                                    <span class='errorNo'></span>
                                                </div>
                                            </div>";
                                                    } else {
                                                        echo "<div class='col-md-4'>
                                                <div class='form-group label-floating'>
                                                    <label class='control-label'>Staff ID<small>(numeric only)<span class='errorRed'>*</span></small></label>
                                                    <input type='number' value='" . @$staffID . "' class='form-controls' name='staffID' id='staffID' />
                                                    <span class='errorNo'></span>
                                                </div>
                                            </div>";
                                                    }
                                                    ?>


                                                    <div class="col-md-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Beneficiary Name<span class="errorRed">*(<small>ready only</small>)</span></label>
                                                            <input placeholder="" type="text" value="<?php echo @$sname; ?>" style="background-color:#e0e2e5" readonly class="form-controls" name="benName" id="benName" />
                                                            <span class="errorName"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Beneficiary Email<span class="errorRed">* (<small>ready only</small>)</span></label>
                                                            <input placeholder=""  style="background-color:#e0e2e5" value="<?php echo @$_SESSION['email']; ?>" type="text" readonly class="form-controls" name="benEmail" id="benEmail" />
                                                            <span class="errorEmail"></span>
                                                        </div>
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

                                                <div class="row">        
                                                    <div class="col-md-3">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Warefare Officer<span class="errorRed">*</span></label>
                                                            <select class="form-controls" name="warefoffice" id="warefoffice" data-live-search="true">
                                                                <option value="">Select</option>
                                                                <!--<option value="seun.owolabi@c-ileasing.com">Seun Owolabi</option>-->
                                                                <option value="awelekaume.ashi@c-ileasing.com">Awelekaume Ashi</option>
                                                                <!--<option value="oluwatoyin.ajigbo@c-ileasing.com">Oluwatoyin Ajigbo</option>
                                                                <option value="monica.chukwuka@c-ileasing.com">Monica Chukwuka</option>-->

                                                            </select>
                                                            <span class="errorWarefare"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">HOD Email<span class="errorRed">*</span></label>
                                                            <select class="form-controls" name="hodEmail" id="hodEmail" data-live-search="true">
                                                                <option value="">Select HOD</option>
                                                                <?php echo $hod; ?>
                                                            </select>
                                                            <span class="errorHOD"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Bank Name <span style="color:red">(optional)</span></label>
                                                            <input  type="text" class="form-controls" name="bankName" id="bankName" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Account Number <span style="color:red">(optional)</span></label>
                                                            <input type="number" class="form-controls" name="acctNum" id="acctNum" />
                                                        </div>
                                                    </div>

                                                    <!--<div class="col-md-6">  
                                                            <div class="form-group label-floating">
                                                             <label class="control-label">Logistics<span class="errorRed">*</span></label>
                                                              <select class="form-controls" name="logistics" id="logistics">
                                                                 <option value="">Select Method</option>
                                                                  <option value="perdiem">Per Diem</option>
                                                                   <option value="hotel">Hotel</option>
                                                             </select>
                                                              <span class="errorLog"></span>
                                                         </div>
                                                      </div>-->
                                                </div>         




                                                <?php
                                                $getHotel = $this->travelmodel->getallhotels();

                                                if ($getHotel) {
                                                    $dHotel = "";
                                                    foreach ($getHotel as $getH) {
                                                        $id = $getH->id;
                                                        $hotelName = $getH->HotelName;
                                                        $hotelAddress = $getH->sAddress;
                                                        $dHotel .= "<option  value=\"$id\">" . $hotelName . " - " . $hotelAddress . '</option>';
                                                    }
                                                }
                                                ?>
                                                <!-- HOTEL DETAILS --> 
                                                <div class="row hoteldetails" style="display: none">
                                                    <div class="col-md-12">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Hotels</label>
                                                            <select class="form-controls" name="dHotels" id="dHotels">
                                                                <option value="">Select Hotel</option>
                                                                <?php echo $dHotel; ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div><!-- END OF TAB ONE REQUEST INFORMATOIN-->


                                            <div id="tab-2" class="tab-content">
                                                <table class="table table-bordered" id="item_table">
                                                    <tr>
                                                        <th style="width:20%">From</th>
                                                        <th style="width:20%">To</th>
                                                        <th style="width:15%">StartDate</th>
                                                        <th style="width:15%">End Date</th>
                                                        <th style="width:15%">Purpose</th>
                                                        <th style="width:15%">Logistics</th>
                                                        <th style="width:10%"><button title="Add More" type="button" name="add" class="btn btn-success btn-xs add"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></th>
                                                    </tr>

                                                    <tr>
                                                        <td><select name="tFromlocation[]" required id="tFromlocation" class="form-controls"><option value="">Select From</option><?php echo $dLocationow; ?></select></td>
                                                        <td><select name="tTolocation[]" required id="tTolocation" class="form-controls"><option value="">Select To</option><?php echo $dLocationow; ?></select></td>
                                                        <td><input type="text" required name="exsDate[]" id="exsDate" placeholder="dddd-mm-dd" class="form-controls newdatelog" value="<?php echo date('Y-m-d'); ?>"/></td>
                                                        <td><input type="text" required name="exrDate[]" id="exrDate" placeholder="dddd-mm-dd" class="form-controls newdatelog" value="<?php echo date('Y-m-d'); ?>"/></td>
                                                        <td><textarea type="text" required name="purpose[]" id="purpose"  class="form-controls"></textarea></td>
                                                        <td><select name="logistics[]" required id="logistics" class="form-controls"><option value="">Select</option><option value="perdiem">Per Diem</option><option value="hotel">Hotel</option></select></td>
                                                        <td><button type="type" title="Remove" name="remove" class="btn btn-danger btn-xs remove"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td></tr>
                                                    </tr>
                                                </table>
                                            </div><!-- END OF TAB TWO LOCATION INFORMATION -->

                                          
                                            <div id="tab-3" class="tab-content">
                                                <input type="file" multiple name="upfile" id="upfile" onchange="upFiles(this.files)" />
                                                <div id="message"></div>
                                            </div>
                                          

                                            <!-- END OF THE FORM BUTTON -->

                                            <div class="row">  
                                                <div class="col-md-12">
                                                    <center><div class="mainError"></div></center>
                                                    <input type="hidden" name="sLevel" id="sLevel" value="<?php echo @$SalaryLevel; ?>"/>
                                                    <input type="hidden" name="control_csrf" id="control_csrf" value="<?php echo @$mycustomcsrf; ?>" />
                                                    <input type="hidden" name="csrf_valid" id="csrf_valid" value="<?php echo md5(uniqid(rand(15, 100), true)); ?>" />
                                                    <center> <div> <button class="btn btn-primary btn-xs" type="submit" class="nowSubmit" id="nowSubmit"><i class="fa fa-bus" aria-hidden="true"></i> &nbsp;SUBMIT</button>  </div></center>
                                                </div>

                                            </div>



                                        </div><!-- END OF TABBED CONTENT     -->

                                    </form>
                                </div><!-- END OF myMessage  ID -->
                            </div>  <!-- Endo of Card Content -->   

                        </div>


                    </div>
                    <!-- End of Request Details with Status -->




                    <!-- Inside Content Ends Here -->


                </div>


            </div>
        </div>
        <!-- Main Outer Content Ends  Here --> 
    <!--<script src="<?php //echo base_url(); ?>public/javascript/purejs/uploadoc.js"></script>-->
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
                    html += "<td><select name='logistics[]' required id='logistics' class='form-controls'><option value=''>Select</option><option value='perdiem'>Per Diem</option><option value='hotel'>Hotel</option></select></td>";
                    html += "<td><button type='type' name='remove' class='btn btn-danger btn-xs remove'><i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
                    $('#item_table').append(html);
                });

                $(document).on('click', '.remove', function () {
                    var r = confirm("Are you sure you want to remove the location. Please make sure no location is selected before you remove");
                    if (r == true) {

                        /* $('#tFromlocation').each(function () {
                         $(this).val('');
                         });
                         
                         $('#tTolocation').each(function () {
                         $(this).val('');
                         });
                         
                         $('#exDate').each(function () {
                         $(this).val('');
                         });  */

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
