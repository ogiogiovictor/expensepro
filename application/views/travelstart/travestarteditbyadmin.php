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
                        <!--<span class="pull-right"><small><?php //echo date('Y-m-d H:i:s'); ?></small></span>-->
                        <div class="card">
                            
                            <div class="card-content">
                                 <div class="card-header text-center" data-background-color="blue">
                                     <center><div class="mymainform"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white"><a href="<?php echo base_url(); ?>travels/xdmds_xn">TBS :: TRAVELLING LOGISTICS :: UPDATE REQUEST</a></span></span>&nbsp;<i class="fa fa-ship" aria-hidden="true"></i></div></center>
                            <!--<center><small class="mycoustomalert">Note:please make sure you fill all fields</small> </center>-->
                             </div>
                          <br/>
                          
                          <?php
                            if($getresult){
                                foreach($getresult as $getme){
                                    $travel_ID = $getme->id;
                                    $csrf = $getme->csrf;
                                    $csrvalid = $getme->csrvalid;
                                    $staffID = $getme->staffID;
                                    $staffName = $getme->staffName;
                                    $staffEmail = $getme->staffEmail;
                                    $warefofficer = $getme->warefofficer;
                                    $staffEmail = $getme->staffEmail;
                                    $location = $getme->location;
                                    $unit = $getme->unit;
                                    $hodEmail = $getme->hodEmail;
                                    $eBank = $getme->eBank;
                                    $eAccount = $getme->eAccount;
                                    $salaryClass = $getme->salaryClass;
                                    $comment = $getme->comment;
                                    $sTotal = $getme->sTotal;
                                }
                            }
                          ?>
                          <div class="myMessage">
                           <form name="travelStartFormEdit" id="travelStartFormEdit" enctype="multipart/form-data" method="POST" onSubmit="return false;">
                            
                            <div class="dtabs">

                                <ul class="tabs">
                                    <li class="tab-link current" data-tab="tab-1"><b>REQUEST INFORMATION</b></li>
                                    <li class="tab-link" data-tab="tab-2"><b>TRIP / LOCAL TRANSPORT</b></li>
                                </ul>

                                <div id="tab-1" class="tab-content current">
                                          <span id="message"></span>
                                 
                                    <div class="row">
                                       
                                       <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Staff ID</label>
                                                    <input type="number" style="background-color:#e0e2e5" readonly="" value="<?php echo $staffID; ?>" class="form-controls" name="staffID" id="staffID" />
                                                    
                                                </div>
                                        </div>    
                                        
                                         <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Beneficiary Name</label>
                                                    <input placeholder="" type="text" value="<?php echo $staffName; ?>" style="background-color:#e0e2e5" readonly class="form-controls" name="benName" id="benName" />
                                                    <span class="errorName"></span>
                                                </div>
                                            </div>
                                        
                                         <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Beneficiary Email</label>
                                                    <input placeholder=""  style="background-color:#e0e2e5" value="<?php echo $staffEmail; ?>" type="text" readonly class="form-controls" name="benEmail" id="benEmail" />
                                                    <span class="errorEmail"></span>
                                                </div>
                                            </div>
                                    </div>
                                
                             
                                    
                       
                                    
                           <div class="row">        
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Warefare Officer</label>
                                        <input  type="text" readonly class="form-controls" name="warefoffice" id="warefoffice" value="<?php echo $warefofficer; ?>"/>
                                         <span class="errorWarefare"></span>
                                    </div>
                                </div>
                               
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">HOD Email</label>
                                        <input  type="text" readonly class="form-controls" name="hodEmail" id="hodEmail" value="<?php echo $hodEmail; ?>"/>
                                         <span class="errorHOD"></span>
                                    </div>
                                </div>
                               
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Total Amount </label>
                                        <input  type="text"  readonly class="form-controls" name="sTotal" id="sTotal" value="<?php echo @number_format($sTotal); ?>"/>
                                    </div>
                                 </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Salary Class</label>
                                        <input type="text" class="form-controls" name="sClass" id="sClass" value="<?php echo $salaryClass; ?>" />
                                    </div>
                                </div>
                               
                               
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Comment </label>
                                        <textarea class="form-controls" name="textme" id="textme"></textarea>
                                    </div>
                                </div>
                               
                               <?php
                               /* if($comment !=""){
                                    echo "<div class='col-md-12'>
                                    <div class='form-group label-floating'>
                                        <label class='control-label'>Comments</label>
                                        <textarea class='form-control' readonly>$comment</textarea>
                                    </div>
                                </div>";
                                }else{
                                    echo "";
                                }
                                
                                */
                               ?>
                              
                           </div>         
                                    
                       
                        
                        
                      
                      </div><!-- END OF TAB ONE REQUEST INFORMATOIN-->
                            
                                
                            <div id="tab-2" class="tab-content">
                                <table class="table table-bordered" id="item_table">
                                    <tr>
                                        <th style="width:1%"></td>
                                        <th style="width:20%">From</th>
                                        <th style="width:20%">To</th>
                                        <!--<th style="width:15%">StartDate</th>
                                        <th style="width:15%">End Date</th>-->
                                        <th style="width:15%">Logistics</th>
                                        <th style="width:15%">Days</th>
                                        <th style="width:15%">Amount</th>
                                         <th style="width:15%">Total</th>
                                           <th style="width:15%">Transport</th>
                                       <!--<th style="width:10%"><button title="Add More" type="button" name="add" class="btn btn-success btn-xs add"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></th>-->
                                    </tr>
                                    
                                    
                                    <?php 
                                    $getTravelexpense = $this->travelmodel->gettravelexpenses($travel_ID);
                                    if($getTravelexpense){
                                        foreach($getTravelexpense as $tr){
                                            $tid = $tr->tid;
                                            $tid_travelStart_ID = $tr->travelStart_ID;
                                            $tFrom = $tr->tFrom;
                                            $tTo = $tr->tTo;
                                            $exsDate = $tr->exsDate;
                                            $exrDate = $tr->exrDate;
                                            $logistics = $tr->logistics;
                                            $purpose = $tr->purpose;
                                            $diff = $tr->diff;
                                            $amount = $tr->amount;
                                            $sTotal = $tr->sTotal;
                                            $amountLocal = $tr->amountLocal;
                                            
                                            $fromName = $this->mainlocation->getdLocation($tFrom);
                                            $tToName = $this->mainlocation->getdLocation($tTo);
                                            if($logistics == 'perdiem'){
                                               $mylog = 'Per Diem'; 
                                            }else if($logistics == 'hotel'){
                                                 $mylog = 'Hotel';
                                            }
                                        ?>    
                                    
                                    
                                    <tr>
                                     <td>
                                       <input type="hidden" name="exid[]" id="exid" class="form-control" value="<?php echo $tid; ?>"/>
                                    </td>
                                        <td><select readonly name="tFromlocation[]" required id="tFromlocation" class="form-controls">
                                                <option value="<?php echo $tFrom; ?>"><?php echo $fromName; ?></option>
                                                    <?php echo $dLocation; ?>
                                            </select>
                                        </td>
                                        <td><select readonly name="tTolocation[]" required id="tTolocation" class="form-controls">
                                                <option value="<?php echo $tTo; ?>"><?php echo $tToName; ?></option>
                                                    <?php echo $dLocation; ?>
                                                </select>
                                        </td>
                                       
                                        <td><select readonly name="logistics[]" required id="logistics" class="form-controls">
                                                <option value="<?php echo $logistics; ?>"><?php echo $mylog; ?></option>
                                                <option value="perdiem">Per Diem</option>
                                                <option value="hotel">Hotel</option>
                                            </select>
                                        </td>
                                        <td><input type="text" readonly required name="exrDate[]" id="exrDate" placeholder="dddd-mm-dd" class="form-controls newdatelog" value="<?php echo $diff; ?>"/></td>
                                         <td><input type="text" readonly required name="exrDate[]" id="exrDate" placeholder="dddd-mm-dd" class="form-controls newdatelog" value="<?php echo $amount; ?>"/></td>
                                         <td><input type="text" readonly required name="exrDate[]" id="exrDate" placeholder="dddd-mm-dd" class="form-controls newdatelog" value="<?php echo $sTotal; ?>"/></td>
                                        <td><input type="text" readonly required name="exrDate[]" id="exrDate" placeholder="dddd-mm-dd" class="form-controls newdatelog" value="<?php echo $amountLocal; ?>"/></td>
                                        <!--<td><button type="type" title="Remove" name="remove" class="btn btn-danger btn-xs remove"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td></tr>-->
                                     </tr>
                                     
                                     <?php
                                        }
                                    }
                                    ?>
                                    </table>
                                </div><!-- END OF TAB TWO LOCATION INFORMATION -->
                                
                        
                                
                       <!-- END OF THE FORM BUTTON -->
                                  
                            <div class="row">  
                                 <div class="col-md-12">
                                     <center><div class="mainError"></div></center>
                                     <input type="hidden" name="travelID" id="travelID" value="<?php echo $travel_ID; ?>"/>
                                     <input type="hidden" name="sLevel" id="sLevel" value="<?php echo $salaryClass; ?>"/>
                                     <input type="hidden" name="control_csrf" id="control_csrf" value="<?php echo $csrf; ?>" />
                                     <input type="hidden" name="csrf_valid" id="csrf_valid" value="<?php echo $csrvalid; ?>" />
                                     <center> <div> <button class="btn btn-danger btn-xs" type="submit" class="withfromexpensepro" id="withfromexpensepro"><i class="fa fa-bus" aria-hidden="true"></i> &nbsp;REJECT TRAVEL REQUEST</button>  </div></center>
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
                    html += "<td><select name='tFromlocation[]' required id='tFromlocation'  class='form-controls tFromlocation'><option value=''>Select From</option><?php //echo $dLocationow; ?></select></td>";
                    html += "<td><select name='tTolocation[]' required id='tTolocation' class='form-controls tTolocation'><option value=''>Select To</option><?php //echo $dLocationow; ?></select></td>";
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
