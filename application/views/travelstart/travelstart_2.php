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

                    <div class="col-md-7 col-md-offset-3 bgback">  
                        <!--<span class="pull-right"><small><?php //echo date('Y-m-d H:i:s'); ?></small></span>-->
                        <div class="card">
                            
                            <div class="card-content">
                                 <div class="card-header text-center" data-background-color="blue">
                                     <center><div class="mymainform"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">TBS :: TRAVELLING LOGISTICS</span></span>&nbsp;<i class="fa fa-ship" aria-hidden="true"></i></div></center>
                            <!--<center><small class="mycoustomalert">Note:please make sure you fill all fields</small> </center>-->
                             </div>
                          <br/>
                          
                          <div class="myMessage">
                           <form name="travelStartForm" id="travelStartForm" enctype="multipart/form-data" method="POST" onSubmit="return false;">
                            
                            <div class="dtabs">

                                <ul class="tabs">
                                    <li class="tab-link current" data-tab="tab-1"><b>REQUEST INFORMATION</b></li>
                                    <li class="tab-link" data-tab="tab-2"><b>LOCAL TRANSPORT</b></li>
                                </ul>

                                <div id="tab-1" class="tab-content current">
                                          <span id="message"></span>
                                 
                                    <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Staff ID <small>(numeric only)<span class="errorRed">*</span></small></label>
                                                    <input placeholder="" type="number" class="form-controls" name="staffID" id="staffID" />
                                                    <span class="errorNo"></span>
                                                </div>
                                            </div>
                                        
                                         <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Beneficiary Name<span class="errorRed">*(<small>ready only</small>)</span></label>
                                                    <input placeholder="" type="text" readonly class="form-controls" name="benName" id="benName" />
                                                    <span class="errorName"></span>
                                                </div>
                                            </div>
                                        
                                         <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Beneficiary Email<span class="errorRed">* (<small>ready only</small>)</span></label>
                                                    <input placeholder="" type="text" readonly class="form-controls" name="benEmail" id="benEmail" />
                                                    <span class="errorEmail"></span>
                                                </div>
                                            </div>
                                    </div>
                                
                                
                             <?php 
                                $getcat = $this->mainlocation->getalllocation();
                                    if ($getcat) { 
                                        $aloc = "";
                                        foreach ($getcat as $get) {
                                            $id = $get->id;
                                            $locationName = $get->locationName;
                                            $aloc .= "<option  value=\"$id\">" . $locationName . '</option>';
                                            }
                                        }
                                   
                            ?>
                                    
                             <div class="row">        
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">User Location<span class="errorRed">*</span></label>
                                        <select class="form-controls" name="UserLocation" id="UserLocation">
                                            <option value="">Select</option>
                                             <?php echo $aloc; ?>
                                        </select>
                                        <span class="errorLocation"></span>
                                    </div>
                                 </div>
                                
                                 
                                 <?php
                                    $getunit = $this->mainlocation->getallunit();

                                    if ($getunit) {
                                        $dunit = "";
                                        foreach ($getunit as $get) {
                                            $id = $get->id;
                                            $unitName = $get->unitName;
                                            $dunit .= "<option  value=\"$id\">" . $unitName . '</option>';
                                        }
                                    }
                                 ?>
                                 
                                 
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Unit<span class="errorRed">*</span></label>
                                        <select class="form-controls" name="UserUnit" id="UserUnit">
                                            <option value="">Select Unit</option>
                                            <?php echo $dunit; ?>
                                        </select>
                                        <span class="errorUnit"></span>
                                    </div>
                                </div>
                                 
                                 
                                
                                  <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Type<span class="errorRed">*</span></label>
                                        <!--<input placeholder="" type="text" class="form-controls" name="destination" id="destination" />-->
                                        <select class="form-controls" name="destination" id="destination">
                                            <option value="">Select Type</option>
                                            <option value="local">Local</option>
                                            <option value="foreign">Foreign</option>
                                        </select>
                                        <span class="errorDestin"></span>
                                    </div>
                                 </div>

                            </div>
                           
                            
                             <div class="row">
                                 
                                  <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Trip Period<span class="errorRed">*</span></label>
                                        <input type="number" class="form-controls" name="triperiod" id="triperiod" placeholder=""/>
                                        <span class="errorTrip"></span>
                                    </div>
                                </div>
                                 
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Start Date<span class="errorRed">*</span></label>
                                        <input type="text" placeholder="" class="form-controls datepicker" name="sDate" id="sDate" />
                                        <span class="serror"></span>
                                    </div>
                                 </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Returned Date<span class="errorRed">*</span></label>
                                        <input type="text" class="form-controls datepicker" name="rDate" id="rDate" placeholder=""/>
                                         <span class="rerror"></span>
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
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">HOD Email<span class="errorRed">*</span></label>
                                         <select class="form-controls" name="hodEmail" id="hodEmail" data-live-search="true">
                                            <option value="">Select HOD</option>
                                              <?php echo $hod; ?>
                                        </select>
                                         <span class="errorHOD"></span>
                                    </div>
                                </div>
                                    
                                   <div class="col-md-6">  
                                       <div class="form-group label-floating">
                                        <label class="control-label">Logistics<span class="errorRed">*</span></label>
                                         <select class="form-controls" name="logistics" id="logistics">
                                            <option value="">Select Method</option>
                                             <option value="perdiem">Per Diem</option>
                                              <option value="hotel">Hotel</option>
                                        </select>
                                         <span class="errorLog"></span>
                                    </div>
                                 </div>
                           </div>         
                                    
                                    
                          <div class="row">        
                                <div class="col-md-7">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Purpose</label>
                                        <textarea class="form-controls" rows="4" cols=10" name="purpose" id="purpose"></textarea>
                                    <span class="errorPurpose"></span>
                                    </div>
                                     
                                 </div>
                              
                              <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Upload(optional)</label><br/>
                                        <div class="mainupload">
                                         <input type="file" name="UploadingFile[]" id="UploadingFile[]" multiple /><span id="val"></span>
                                         <small><span class="errorGreen">you can select multiple files at once</span></small>
                                        </div>
                                    </div> 
                                    
                                   
                                     
                              </div>
                        </div>
                                    
                          <!-- PER DIEM DETAILS --> 
                         <div class="row perdiemTravels" style="display:none">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Bank Name</label>
                                        <input  type="text" class="form-controls" name="bankName" id="bankName" />
                                    </div>
                                 </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Account Number</label>
                                        <input type="number" class="form-controls" name="acctNum" id="acctNum" />
                                    </div>
                                </div>

                         </div>
                        
                        
                        <?php
                           $getHotel = $this->travelmodel->getallhotels();

                                if ($getHotel) {
                                    $dHotel = "";
                                    foreach ($getHotel as $getH) {
                                            $id = $getH->id;
                                            $hotelName = $getH->HotelName;
                                            $hotelAddress = $getH->sAddress;
                                            $dHotel .= "<option  value=\"$id\">".$hotelName." - " . $hotelAddress . '</option>';
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
                                        <th style="width:15%">Date</th>
                                       <th style="width:10%"><button title="Add More" type="button" name="add" class="btn btn-success btn-xs add"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></th>
                                    </tr>
                                    
                                    <tr>
                                        <td><select name="tFromlocation[]" required id="tFromlocation" class="form-controls tFromlocation"><option value="">Select From</option><?php echo $dLocationow; ?></select></td>
                                        <td><select name="tTolocation[]" required id="tTolocation" class="form-controls tTolocation"><option value="">Select To</option><?php echo $dLocationow; ?></select></td>
                                        <td><input type="text" required name="exDate[]" id="exDate" placeholder="dddd-mm-dd" class="form-controls newdatelog" value="<?php echo date('Y-m-d'); ?>"/></td>
                                        <td><button type="type" title="Remove" name="remove" class="btn btn-danger btn-xs remove"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td></tr>
                                     </tr>
                                    </table>
                                </div><!-- END OF TAB TWO LOCATION INFORMATION -->
                                
                        
                                
                       <!-- END OF THE FORM BUTTON -->
                                  
                            <div class="row">  
                                 <div class="col-md-12">
                                     <center><div class="mainError"></div></center>
                                     <input type="hidden" name="sLevel" id="sLevel"/>
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

    <script type="text/javascript">       
        $(document).ready(function(){
            
            

                $('ul.tabs li').click(function(){
                        var tab_id = $(this).attr('data-tab');

                        $('ul.tabs li').removeClass('current');
                        $('.tab-content').removeClass('current');

                        $(this).addClass('current');
                        $("#"+tab_id).addClass('current');
                });
                
                $(document).on('click', '.add', function () {
                    var html = "";
                    html += "<tr>";
                    html += "<td><select name='tFromlocation[]' required id='tFromlocation'  class='form-controls tFromlocation'><option value=''>Select From</option><?php echo $dLocationow; ?></select></td>";
                    html += "<td><select name='tTolocation[]' required id='tTolocation' class='form-controls tTolocation'><option value=''>Select To</option><?php echo $dLocationow; ?></select></td>";
                    html += "<td><input type='text' required name='exDate[]' id='exDate' placeholder='dddd-mm-dd' class='form-controls newdatelog' value='<?php echo date('Y-m-d'); ?>'/></td>";
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
               

        });
     </script>
        <?php echo $footer; ?>
