
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
                        
                    <div class="col-md-8 col-md-offset-2">     
                        <div class="card">
                                <div class="card-header text-center" data-background-color="blue">
                                    <h4 class="title">&nbsp;&nbsp;SETUP CURRENCY</h3>
                                    
                                </div>
                       
                            <div class="addform" style="margin-top:10px; padding:10px">
                               
                                <form method="post" id="addCurrency" name="addCurrency" onsubmit="return false;">
                                     
                                      
                                     <?php 
                                    if ($allCurrency) { 
                                        $currencyappend = "";
                                        foreach ($allCurrency as $get) {
                                            $name = $get->name;
                                            $currencyappend .= "<option  value=\"$get->id\">" . $name . '</option>';
                                            }
                                        }
                                   
                                     ?>
                                      <label></label>
                                      <select name="currencyType" id="currencyType" class="" style="width:150px">
                                          <option value="">Currency Name</option>
                                          <?php echo $currencyappend; ?>
                                      </select>
                                     
<!--                                      &nbsp;
                                      <label></label>
                                      <input type="text"  style="width:150px" id="symbol" name="symbol" placeholder="Currency Symbol" />-->
                                      &nbsp;
                                      <label></label>
                                      <input type="number"  style="width:150px" id="exchange_rate" name="exchange_rate" placeholder="Exchange Rate" /><hr/>
                                    
                                       <span id="showError"></span>
                                      <center><button class="btn btn-sm btn-primary" id="update_currency" name="update_currency">Update</button></center>
                                  </form>
                            </div>
                            <hr/>
                            
                            
                            
                             <div class="card-content">
                                <div  id="dynamicload">
                                   
                                    <!-- Beginnin of Form -->
                                 <span id="hotelMsg"></span>
                                    <div>
                                        
                                        <table class="table table-responsive table-bordered table-striped table-hover">
                                            <tr>
                                                <th>ID</th>
                                                 <th>Name</th>
                                                <th>Currency Symbol</th>
                                                <th>Rate</th>
                                            </tr>
                                       
                                      <?php
                                        if($allCurrency){
                                            foreach($allCurrency as $get){
                                                $id = $get->id;
                                                $name = $get->name;
                                                $currencySumbol = $get->currencySymbol;
                                                $rate = $get->exchange_rate;
                                             
                                                
                                          ?>
                                            <tr>
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $currencySumbol; ?></td>
                                                 <td><?php echo $rate; ?></td>
                                            </tr>
                                         <?php       
                                            }
                                        }
                                      ?>
                                        </table>
                                    </div>
                                    
                                    <!-- End of Form -->
                                    
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
    $('#update_currency').click(function (e) {
        var action = GLOBALS.appRoot + "setup/updateCurrency";
        //var symbol = $('#symbol').val();
        var exchange_rate = $('#exchange_rate').val();
        var currencyType = $('#currencyType').val();
       
        if (exchange_rate === "" || currencyType === "") {
            $('#showError').html("Please make sure all fields are filled").addClass("errorRed");
        } else {
            $('#showError').html("Processing Update, Please wait...");
            $.post(action, {exchange_rate: exchange_rate, currencyType: currencyType}, function (data) {
                if (data.msg) {
                    $('#showError').html(data.msg).addClass("errorGreen");
                    $('#exchange_rate').val('');
                    $('#currencyType').val('');
                  
                    setTimeout(function () {
                        window.location.reload(1);
                    }, 100);
                }
            })
                    .fail(function () {
                        $('#showError').html("Error Loading Data, Please try again").addClass("alert alert-danger");
                    });
        }

    });
</script>      
   <?php echo $footer; ?>