<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
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
                                    <h4 class="title">&nbsp;&nbsp;ADD PAYEE</h3>
                                    
                                </div>
                       
                            <div class="addform" style="margin-top:10px; padding:10px">
                               
                               
                                
                                <form method="post" id="setupCode" name="setupCode" onsubmit="return false;">
                                   
                                      <label class="control-label">Name</label>
                                      <input type="text" name="vendorName" id="vendorName" />
                                      <label class="control-label">Email</label>
                                      <input type="text" name="vendorEmail" id="vendorEmail" />
                                       <label class="control-label">Phone</label>
                                      <input type="text" name="vendorPhone" id="vendorPhone" />
                                      <br/>
                                      
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

                                        <label class="control-label">Select Unit</label>
                                           <select name="dUnit" id="dUnit">
                                             <option value="">Select Unit</option>
                                                <?php echo $dunit; ?>
                                           </select>
                                                
                                    
                                       <label class="control-label">Vendor Address</label>
                                      <input type="text" name="vendorPhone" name="vendorAddress" id="vendorAddress" placeholder="Add Address"/>
                                     
                                      
                                      
                                      <span id="showError"></span>    
                                      <button class="btn btn-sm btn-primary" id="addVendor" name="addVendor">Add</button></center>
                                      
                                  </form>
                            </div>
                            <hr/>
                            
                            
                            
                             <div class="card-content">
                                <div  id="dynamicload">
                                   
                                    <!-- Beginnin of Form -->
                                 <span id="hotelMsg"></span>
                                    <div>
                                        
                                        <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="reqeustapproval">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Vendor Name</th>
                                                <th>Vendor Email</th>
                                                <th>Vendor Phone</th>
                                                <th>Unit </th>
                                                <th>Added By</th>
                                            </tr>
                                             </thead>
                                                <tbody>
                                       
                                      <?php
                                        if($allUnitVendors){
                                            foreach($allUnitVendors as $get){
                                                $hid = $get->id;
                                                $unitID = $get->unitID;
                                                $vendor = $get->workshop_name;
                                                $address = $get->workshop_address;
                                                $phone = $get->workshop_phone;
                                                $email = $get->workshop_email;
                                                 $addedBy = $get->addedBy;
                                               
                                          ?>
                                            <tr>
                                                <td><?php echo $hid; ?></td>
                                                <td><?php echo $vendor; ?></td>
                                                <td><?php echo $email; ?></td>
                                                 <td><?php echo $phone; ?></td>
                                                <td><?php echo $this->generalmd->getuserAssetLocation("unitName", "cash_unit", "id", $unitID); ?> </td>
                                                <td><?php echo $addedBy; ?></td>
                                            </tr>
                                         <?php       
                                            }
                                        }
                                      ?>
                                             </tbody>
                                        </table>
                                        </div>
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
                
 <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>              
 <script>
     
     $(document).ready(function(){
       
        var table = $('#reqeustapproval');
        var oTable = table.DataTable({
            "order": [[0, "desc" ]]
           
        });  
        
    });
     //This section deals search by date and account officer and category
  $('#addVendor').click(function () {
      
          var vendorName = $('#vendorName').val();
          var vendorEmail = $('#vendorEmail').val();
          var vendorPhone = $('#vendorPhone').val();
          var vendorAddress = $('#vendorAddress').val();
          var dUnit = $('#dUnit').val();
          
          
        if(vendorName =="" || vendorPhone ==""){
            toastr.warning('Vendor Name and Phone Number is Required')
         }else if(vendorEmail =="" || vendorPhone ==""){
            toastr.warning('Vendor Email is Required')
         }else if(dUnit ==""){
            toastr.warning('Please Select Unit')
         }else{
             $('#results').html('Loading Result, Please wait.....');
            $.ajax({
               url : GLOBALS.appRoot + "accountcode/addvendorinmaintenance",
               method : "POST",
               data: {vendorName: vendorName, dUnit:dUnit, vendorEmail : vendorEmail, vendorPhone : vendorPhone, vendorAddress: vendorAddress},
               dataType : "JSON",
               success : function (data){
                   if(data.status == '1'){
                      toastr.success('Vendor Successfully Added');
                       setTimeout(function () { window.location.reload(1); }, 1000);
                   }else if(data.status == '2'){
                       toastr.warning('Vendor Already Exist');  
                   }else if(data.status == '3'){
                       toastr.warning('Enter a Valid Phone Number');  
                   }else if(data.status == '4'){
                       toastr.warning('Enter a Valid Email Address'); 
                   }else if(data.status == '5'){
                       toastr.warning(data.msg); 
                   }else if(data.status == '6'){
                       toastr.warning(data.msg); 
                   }else{
                       toastr.info('Error Adding Vendor, Please Try Again');   
                   }
               }
            });
        }
});
 </script>
   <?php echo $footer; ?>