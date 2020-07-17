
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
                                
                                 <center><span style="background-color:#e8eaed; font-weight: bold; font-size:18px; padding:10px">Per diem Recalculation</span></center><br/>
                                 <form id="travelXperdiem" name="travelXperdiem" enctype="multipart/form-data" method="POST" onSubmit="return false;"> <table class="table table-bordered" id="item_table">
                                    <tr>
                                       <th style="width:4%">ID</th>
                                       <th style="width:12%">From</th>
                                       <th style="width:12%">To</th>
                                       <th style="width:10%">Start Date</th>
                                       <th style="width:10%">End Date</th>
                                       <th style="width:4%">Days</th>
                                       <th style="width:8%">Type</th>
                                       <th style="width:7%">Perdeim Amount</th>
                                       
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
                                                <input type='text' style='background-color:#eff0f2' readonly name='diff[]' id='diff' value='$diff' class='form-controls'/>
                                                </td>
                                                
                                                <td>
                                                <input type='text' style='background-color:#eff0f2' readonly name='logistics[]' id='logistics' value='$logistics' class='form-controls logistics'/>
                                                </td>
                                                <td>
                                                <input type='text' name='amount[]' id='amount' value='$amount' class='form-controls exAmount'/>
                                                </td>
                                               
                                        </tr>";
                                                      
                                     }
                                     
                                     echo "<table class='table table-responsive table-bordered'>
                                         <tr>
                                         
                                          <td class='pull-right'>
                                          
                                          <b><span>Total Perdiem:</b> </span> <span id='sumAmount'></span> 
                                          <div id='suminput'></div>
                                          </td>
                                         </tr>
                                     </table><br/>
                                     <input type='hidden' id='travelID' name='travelID' value='$tid' />
                                     <input type='hidden' id='mainID' name='mainID' value='$travelStart_ID' />
                                     
                                      <div id='travelError'></div><span id='flyError'></span>       
                                     <button class='btn btn-sm btn-danger pull-right smallbutton' id='recalculate_perdiems'>Re-Calculate</button>";
                                         
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

$('#recalculate_perdiems').click(function(){
    
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
    //var sumboth = (first) + (total);
    
    var mainID = $('#mainID').val(); 
    
    
    var travelID = $('#tid').val();
    var amount = $('#amount').val();
    //var sTotal = $('#sTotal').val();
   
    var dataString = new FormData(document.getElementById('travelXperdiem')); //postArticles
    
    //}else{
       $('#recalculate_perdiems').hide();
        var r = confirm("Total Perdiem :: " + total + " The Perdiem will be adjusted based on the number of days!");
          if (r == true) {
            $('.smallbutton').hide();
            $('#flyError').html('<img src="http://localhost/moneybook/public/images/me.gif" style="width:300px"/>');
            $('#travelError').hide();  
             $.ajax({
                type: "POST",
                url: GLOBALS.appRoot + "travelstart/processfightsperdiemreXXXXXXXXX_xxxxxxxxxx0000/" + total,
                data: dataString,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'JSON',
                
                success: function (data) {
                    if (data.status == 0) {
                      $('#flyError').html(data.msg).addClass('alert alert-danger');
                    }else if(data.status == 1){
                      $('#flyError').html(data.msg).addClass('alert alert-success'); 
                     setTimeout(function(){window.top.location= GLOBALS.appRoot + "travels/Dxk_udYz/"} , 1000); 
                    }
                },
            error: function (data) {
              $('#recalculate_perdiems').show();
              $('#travelError').html("General Error, Please Try Again").addClass('alert alert-danger'); 
              $('#flyError').hide();
              
             }
            });
        }else {
            alert("No Action was performed");
             $('#recalculate_perdiems').show();
        }
        
        
   // }
    //alert(paymentType);
});
</script>
   <?php echo $footer; ?>