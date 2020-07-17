
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
                        
                    <div class="col-md-12">     
                        <div class="card">
                                <div class="card-header text-center" data-background-color="blue">
                                    <h4 class="title">&nbsp;&nbsp;TRAVEL DETAILS</h3>
                                    <span id="showError"></span>
                                </div>
                                
                             <div class="card-content">
                               <?php 
                                //print_r($returnResult)."<br/>";
                                
                                if($returnResult){
                                   foreach($returnResult as $get){
                                       $id = $get->id;
                                       $staffID = $get->staffID;
                                       $staffName = $get->staffName;
                                       $staffEmail = $get->staffEmail;
                                       $location = $get->location;
                                       $unit = $get->unit;
                                       $salaryClass = $get->salaryClass;
                                       $warefofficer = $get->warefofficer;
                                       $preparedBy = $get->preparedBy;
                                       $eBank = $get->eBank;
                                       $eAccount = $get->eAccount;
                                       $hodEmail = $get->hodEmail;
                                       $auditTrail = $get->auditTrail;
                                       $comment = $get->comment;
                                       //$eHotel = @$this->travelmodel->dHotelname($get->eHotel);
                                  ?>
                                 
                                 <div>
                                     <b>Staff ID</b> : <?php echo $staffID; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     <b>Staff Name</b> : <?php echo @ucwords($staffName); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <b>Staff Email</b> : <?php echo @ucwords($staffEmail); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <b>Location</b> : <?php echo $location; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     <b>Unit</b> : <?php echo $unit; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <b>Salary Class</b> : <?php echo $salaryClass; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
                                    <b>Prepared By</b> : <?php echo $preparedBy; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 </div>
                                 <hr/>
                                
                                 <center><span style="background-color:grey; font-weight: bold; font-size:18px; padding:10px">Details/ Local Transportation</span></center><br/>
                                 <form id="travelX" name="travelX" enctype="multipart/form-data" method="POST" onSubmit="return false;"> <table class="table table-bordered" id="item_table">
                                    <tr>
                                       <th style="width:1%">ID</th>
                                       <th style="width:10%">From</th>
                                       <th style="width:10%">To</th>
                                       <th style="width:11%">Start Date</th>
                                       <th style="width:11%">End Date</th>
                                       <th style="width:7%">Type</th>
                                       <th style="width:8%">Perdeim Amount</th>
                                       <th style="width:6%">Days</th>
                                       <th style="width:9%">Amount</th>
                                       <th style="width:8%">Transport</th>
                                        <th style="width:8%">Hotel</th>
                                       <th style="width:8%">Hertz</th>
                                        <th style="width:8%">Flight</th>
                                    </tr>
                                
                                    <?php 
                                        $sume = 0;
                                           $getravelexpense = $this->travelmodel->gettravelexpenses($id);
                                            if ($getravelexpense) { 
                                                  foreach ($getravelexpense as $tr) {
                                                         $tid = $tr->tid;
                                                         $travelStart_ID = $tr->travelStart_ID;
                                                         $tFrom = $this->mainlocation->getdLocation($tr->tFrom);
                                                         $tTo = $this->mainlocation->getdLocation($tr->tTo);
                                                         $amount = $tr->amount;
                                                         $amountLocal = $tr->amountLocal;
                                                         $exsDate = $tr->exsDate;
                                                         $exrDate = $tr->exrDate;
                                                         $logistics = $tr->logistics;
                                                         $purpose = $tr->purpose;
                                                         $diff = $tr->diff;
                                                         $sTotal = $tr->sTotal;
                                                        
                                                         $sume += $sTotal;  
                                                       $allHotels = $this->travelmodel->getallhotels();
                                                       $hotelnow = "";
                                                        if ($allHotels) {
                                                            
                                                                foreach ($allHotels as $getH) {
                                                                    $Hid = $getH->id;
                                                                    $HotelName = $getH->HotelName;
                                                                    $sAddress = $getH->sAddress;
                                                                    $hotelnow .= "<option  value=\"$Hid\">" . $HotelName . ' - '.$sAddress.'</option>';
                                                                }
                                                            }
                                                            
                                                      //$getpayment = $this->mainlocation->getallpayment();
                                                      $getpayment = $this->travelmodel->paymentemthods();
                                                      if ($getpayment) {
                                                      $pay = "";
                                                      foreach ($getpayment as $get) {
                                                          $id = $get->id;
                                                          $paymentType = $get->paymentType;
                                                          $pay .= "<option  value=\"$id\">" . $paymentType . '</option>';
                                                        }
                                                    }
                                                    
                                                    $getcashier = $this->mainlocation->getallaccount();

                                                    if ($getcashier) {
                                                        $acc = "";
                                                        foreach ($getcashier as $get) {

                                                            $id = $get->id;
                                                            $email = $get->email;
                                                            $fname = $get->fname;
                                                            $lname = $get->lname;
                                                            $acc .= "<option  value=\"$email\">" . $fname . " " . $lname . " >> " . $email . '</option>';
                                                        }
                                                    }
                                                    
                                                    
                                                   $getaccount = $this->adminmodel->getaccountants();

                                                   if ($getaccount) {
                                                    $dnewacc = "";
                                                    foreach ($getaccount as $get) {

                                                        $gid = $get->gid;
                                                        $accountgroupName = $get->accountgroupName;

                                                        $dnewacc .= "<option  value=\"$gid\">" . $accountgroupName . '</option>';
                                                    }
                                                }
                                                
                                                
                                                if ($getCurrencies) {
                                                    $allcurrency = "";
                                                    foreach ($getCurrencies as $get) {
                                                        //$codeid = $get->codeid;
                                                        $cur_abbrev = $get->curr_abrev;
                                                        $curr_symbol = $get->curr_symbol;
                                                        $currency = $get->currency;
                                                        $allcurrency .= "<option  value='$cur_abbrev'> " . $curr_symbol . ' - ' . $currency . '</option>';
                                                    }
                                                    //return $allact;
                                                }

                                              //$hotelnow = "";
                                         echo "<tr>
                                                <td>
                                                <input type='text' style='background-color:#eff0f2' readonly name='tid[]' id='tid' value='$tid' class='form-controls'/>
                                                </td>
                                                <td>
                                                <input style='background-color:#eff0f2' type='text' readonly name='tFrom[]' id='tFrom' value='$tFrom' class='form-controls'/>
                                                </td>
                                                <td>
                                                <input type='text' style='background-color:#eff0f2' readonly name='tTo[]' id='tTo' value='$tTo' class='form-controls'/>
                                                </td>
                                                </td>
                                                <td>
                                                <input type='text' style='background-color:#eff0f2' readonly name='exsDate[]' id='exsDate' value='$exsDate' class='form-controls'/>
                                                </td>
                                                <td>
                                                <input type='text' style='background-color:#eff0f2' readonly name='exrDate[]' id='exrDate' value='$exrDate' class='form-controls'/>
                                                </td>
                                                <td>
                                                <input type='text' style='background-color:#eff0f2' readonly name='logistics[]' id='logistics' value='$logistics' class='form-controls logistics'/>
                                                </td>
                                                <td>
                                                <input type='text' style='background-color:#eff0f2' readonly name='amount[]' id='amount' value='$amount' class='form-controls'/>
                                                </td>
                                                <td>
                                                <input type='text' style='background-color:#eff0f2' readonly name='diff[]' id='diff' value='$diff' class='form-controls'/>
                                                </td>
                                                <td>
                                                <input type='text' style='background-color:#eff0f2' readonly name='sTotal[]' id='sTotal' value='$sTotal' class='form-controls'/>
                                                </td>
                                                
                                                <td>
                                                <input type='text'  name='amountLocal[]' id='amountLocal' value='$amountLocal' class='form-controls exAmount'/>
                                                </td>
                                                <td>
                                                <input type='hidden' name'purpose[]' id='purpose' value='$purpose' class='form-controls'/>
                                                <select class='form-controls' name='addHotel[]' id='addHotel'><option val=''>Select</option>$hotelnow</select>
                                                </td>
                                                <td>
                                                <select class='form-controls' name='addHertz[]' id='addHertz'><option val=''>Select</option><option value='yes'>Yes</option><option value='no'>No</option></select>
                                                </td>
                                                 <td>
                                                    <!--<input type='checkbox' value='yes' name='processdFlight[]' id='processdFlight' class='form-controls' style='width:25px'  />-->
                                                     <select class='form-controls' name='processdFlight[]' id='processdFlight'><option val=''>Select</option><option value='yes'>Yes</option><option value='no'>No</option></select>
                                                    
                                                </td>
                                        </tr>";
                                                      
                                     }
                                     
                                     echo "<table class='table table-responsive table-bordered'>
                                         <tr>
                                         <td>
                                         <label class='control-label'>Payment Method</label><br/><select style='width:150px' name='paymentType' id='paymentType' class='form-controls'><option value=''>Select Payment Method</option>$pay</select>
                                         </td>
                                         <td>
                                         <div id='mycashtoremove'><label class='control-label'>3rd Level Approval (Cashier)</label><br/>
                                           <select style='width:150px' name='dcashier' id='dcashier' class='form-controls'><option value='null'>Select Cashier</option>$acc</select>
                                         </div>
                                         <div id='mycurrencyType'>
                                         <label class='control-label'>Select Currency</label>
                                         <select name='dCurrencyType' id='dCurrencyType' class='form-controls' style='width:150px'>
                                         <option value='NGN'>Select Currency</option>
                                         $allcurrency
                                         </select>
                                         </div>
                                         <div id='mychequaccout'>
                                         <label class='control-label'>Account Group</label>
                                         <select name='daccountant' id='daccountant' class='form-controls' style='width:150px'>
                                         <option value='0'>Select</option>
                                          $dnewacc
                                         </select>
                                        </div>
                                         </td>
                                         <td>
                                         <div>
                                         <label class='control-label'>Add Comments</label>
                                         <textarea class='form-control' id='addComment' name='addComment'>$comment</textarea>
                                         </div>
                                         </td>
                                          <td class='pull-right'><span><b>Total Amount: </b><input type='text' value='$sume' id='totalsumvalue' name='totalsumvalue' readonly style='border:1px solid #ffffff'  /></span><br/>
                                          <b><span>Total Transport:</b> </span> <span id='sumAmount'></span> 
                                          <div id='suminput'></div>
                                          </td>
                                         </tr>
                                     </table><br/>
                                     <input type='hidden' id='travelID' name='travelID' value='$tid' />
                                     <input type='hidden' id='mainID' name='mainID' value='$travelStart_ID' />
                                     <input type='hidden' id='location' name='location' value='$location' />
                                     <input type='hidden' id='unit' name='unit' value='$unit' />
                                     <input type='hidden' id='eAccount' name='eAccount' value='$eAccount' />
                                     <input type='hidden' id='eBank' name='eBank' value='$eBank' />
                                     <input type='hidden' id='sName' name='sName' value='$staffName' />
                                     <input type='hidden' id='sEmail' name='sEmail' value='$staffEmail' />
                                      <input type='hidden' id='ePrepared' name='ePrepared' value='$preparedBy' />
                                     <input type='hidden' id='hodEmail' name='hodEmail' value='$hodEmail' />
                                      <div id='travelError'></div><span id='flyError'></span>       
                                     <button class='btn btn-sm btn-success pull-right smallbutton' id='getallamount'>Send</button>
                                     <button class='btn btn-sm btn-danger pull-right rejectbtnButton' id='rejectnowbywarefare'>Reject</button>
                                     <!--<button class='btn btn-sm btn-warning pull-right processflightbyofficer' id='processflightbyofficer'>Flight Only</button>-->";
                                         
                                  ?>
                              <?php } ?>
                            </table></form>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                 
                                 <?php
                                   }
                                   
                                }
                                 ?>
                                   
                                <div style="width:300px; background-color:#e0e2e5; padding:10px">     
                                     <?php 
                                    echo $auditTrail;
                                    ?>
                                </div>
                                 
                                 
                                  <div>  
                                      <h4>ATTACHMENT</h4>
                                     <?php 
                                     if($attahcment){
                                         echo "<a href='https://c-iprocure.com/expensepro/public/travelstart_doc/$attahcment'>Open</a>";
                                     }
                                   
                                    ?>
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
                


 function sumIt() {
    var total = 0, val;
   // $('.exAmount').blur(function () {
        $('.exAmount').each(function() {
          val = $(this).val();
          //if(val != "")
          val = isNaN(val) || $.trim(val) === "" ? 0 : parseFloat(val);
          
          total += val;
        });
    // })
     //$('#sumAmount').html(total.toFixed(2)).toLocaleString();
    $('#sumAmount').html(parseFloat(total).toFixed(2).toLocaleString());
     
    //$('#total_amount').val(Math.round(total));
    $('#suminput').html('<input type="text" name="sumall" id="sumall"  value='+ total +' />');
}
    
    
$(function() {
    
  $("#sumAmount").on("change", function() {
    $("#employee_table input").next()
      .before($("<input />").prop("class","exAmount").val(0))
      .before("<br/>");
    sumIt(); 
    
  });


  $(document).on('input', '.exAmount', sumIt);
  sumIt() // run when loading
});                

$('#getallamount').click(function(){
    
    var first = $('#totalsumvalue').val();
    first = parseInt(first);
    
    var total = 0, val;
   // $('.exAmount').blur(function () {
        $('#sumall').each(function() {
          val = $(this).val();
          //if(val != "")
          val = isNaN(val) || $.trim(val) === "" ? 0 : parseInt(val);
          
          total += val;
        });
     //THIS IS WHERE SUMMATION TAKE PLACE
    var sumboth = (first) + (total);
    var mainID = $('#mainID').val(); 
    
    
    var travelID = $('#tid').val();
    var amountLocal = $('#amountLocal').val();
    var sTotal = $('#sTotal').val();
    var addHotel = $('#addHotel').val();
    var paymentType = $('#paymentType').val();
    var dcashier = $('#dcashier').val();
    var dCurrencyType = $('#dCurrencyType').val();
    var daccountant = $('#daccountant').val();
    var location = $('#location').val();
    var unit = $('#unit').val();
    var eBank = $('#eBank').val();
    var eAccount = $('#eAccount').val();
    var sName = $('#sName').val();
    var sEmail = $('#sEmail').val();
    var ePrepared = $('#ePrepared').val();
    var hodEmail = $('#hodEmail').val();
    var tFrom = $('#tFrom').val();
    var tTo = $('#tTo').val();
    var addHertz = $('#addHertz').val();
    var purpose = $('#purpose').val();
    var addComment = $('#addComment').val();
    //var processdFlight = $("input[name='processdFlight']:checked").val();
    var processdFlight = $('#processdFlight').val();
    var dataString = new FormData(document.getElementById('travelX')); //postArticles
    if(paymentType == ""){
      $('#travelError').html('Please make sure you select payment type').addClass('alert alert-danger');  
    }else if(paymentType == 1 && dcashier == 'null'){
        $('#travelError').html('Please choose a cashier').addClass('alert alert-danger');   
    }else if(paymentType == 2 &&  daccountant == 0 || dCurrencyType == ""){
        $('#travelError').html('Please choose a Currency and Account Group').addClass('alert alert-danger'); 
    }else{
       $('#getallamount').hide();
        var r = confirm("Total Amount :: " + sumboth + " Are you sure you want to approve this request!");
          if (r == true) {
            $('.smallbutton').hide();
            $('#flyError').html('<img src="https://c-iprocure.com/expensepro/public/images/me.gif" style="width:300px"/>');
            $('#travelError').hide();  
             $.ajax({
                type: "POST",
                url: GLOBALS.appRoot + "travelstart/processfights/" + sumboth,
                data: dataString,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'JSON',
                
                success: function (data) {
                    if (data.status == 0) {
                      $('#flyError').html(data.msg).addClass('alert alert-danger');
                    }else if(data.status == 1){
                       $('#flyError').html(data.msg).addClass('alert-danger'); 
                         //setTimeout(function(){window.top.location= GLOBALS.appRoot + "travels/Dxk_udYz"} , 2000);
                    }else if(data.status == 2){
                       $('#flyError').html(data.msg).addClass('alert alert-danger');   
                    }else if(data.status == 3){
                       $('#flyError').html(data.msg).addClass('alert alert-danger');    
                    }else if(data.status == 5){
                      $('#flyError').html(data.msg).addClass('alert alert-success'); 
                      setTimeout(function(){window.top.location= GLOBALS.appRoot + "travels/Dxk_udYz"} , 100);  
                    }
                },
            error: function (data) {
              $('#getallamount').show();
              $('#travelError').html("General Error, Please Try Again").addClass('alert alert-danger'); 
              $('#flyError').hide();
              
             }
            });
        }else {
            alert("No Action was performed");
             $('#getallamount').show();
        }
        
        
    }
    //alert(paymentType);
});


     
</script>
   <?php echo $footer; ?>