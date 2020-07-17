
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
                                
                         <!-- Beginning of Request Details with Status -->
                         
                         <div class="col-md-6">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">CHEQUE PRINTING (OTHERS)</h4>
	                                <p class="category">Generate Cheques for same Banks</p>
	                            </div>
								
                                    <p id="errorme"></p>			
	                            <div class="card-content table-responsive">
	                               
                                        <form name="bankselected" id="bankselected" enctype="multipart/form-data" method="POST" onSubmit="return false;"> 
                                         <?php 
                                                $getbank = $this->adminmodel->getallBanks();

                                                if ($getbank) { 
                                                $dBank = "";
                                                foreach ($getbank as $get) {

                                                    $id = $get->id;
                                                    $bankName = $get->bankName;
                                                    $accountName = $get->accountName;
                                                    $bankNumber = $get->bankNumber;
                                                    $address = $get->address;
                                                    $state = $get->state;
                                                    $dBank .= "<option  value=\"$bankNumber\">" . $bankName . '  '.$accountName. ' - '.$bankNumber.'- '. $address . $state .'</option>';
                                                     }
                                                 }
                                            
                                           ?>
                                        
                                       <div class="col-md-12">
                                                 
                                                    <label class="control-label">Date</label>
                                                    <input type="date" class="form-controls" id="date" name="date" />
                                       </div>
                                           
                                        <div class="col-md-12">
                                                  <label class="control-label">Select Bank</label>
                                                    <select class="form-controls" id="myBank" name="myBank"> 
                                                        <option value="">Select Bank</option>
                                                        <?php echo $dBank; ?>
                                                    </select>
	                                </div>
                                            
                                            
                                          <div class="col-md-12">
                                                 <label class="control-label">Beneficiary Name</label>
                                                  <input type="text" class="form-controls" id="beneficiary" name="beneficiary" />
                                           </div>
                                            
                                            
                                         <div class="col-md-12">
                                                 <label class="control-label">Amount</label>
                                                  <input type="text" class="form-controls" id="dAmount" name="dAmount" />
                                           </div>
                                        
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span id="bankerror"></span>
                                                <input type="submit" name="addCheck" id="addCheck" value="SAVE" class="btn btn-sm btn-facebook btn-google" />
                                            </div>
	                                </div>
                                        </form>   

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
<script>
    var action = GLOBALS.appRoot + "printblankcheck/processcheque";
    
    $('#addCheck').click(function(e){
         $('#addCheck').hide();
        var myBank = $('#myBank').val();
        var dAmount = $('#dAmount').val();
        var beneficiary = $('#beneficiary').val();
        var date = $('#date').val();

       if(myBank == "" || dAmount == "" || beneficiary == "" || date == ""){
             toastr.error("Please fill out all fields",  {timeOut: 150000});
             $('#addCheck').show();
           return;
       }else{

           $.post(action, {myBank: myBank, dAmount: dAmount, beneficiary: beneficiary, date: date}, function (data) {
                 if (data.status === 2) {
                      $('#addCheck').hide();
                      toastr.error(data.msg,  {timeOut: 150000});
                   setTimeout(function(){window.top.location= GLOBALS.appRoot + "printblankcheck/loadCheque/" + data.id} , 2000);
                }else if (data.status === 1) {
                     toastr.error(data.msg,  {timeOut: 150000});
                      $('#addCheck').show();
                }else{
                     toastr.error(data.msg,  {timeOut: 150000});
                      $('#addCheck').show();
                }
            });
       }

    });
 
</script>