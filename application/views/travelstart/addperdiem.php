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
                                    <h4 class="title">&nbsp;&nbsp;SETUP PERDIEM</h3>
                                    <p class="category"> </p>
                                    <span id="showError"></span>
                                </div>
                       
                            <div class="addform" style="margin-top:10px; padding:10px">
                                <form method="post" id="addperdiemform" name="addperdiemform" onsubmit="return false;">
                                     <?php 
                                    $getdestination = $this->mainlocation->getalllocation();
                                    if ($getdestination) { 
                                        $adestination = "";
                                        foreach ($getdestination as $get) {
                                            $destinationid = $get->id;
                                            $destination = $get->locationName;
                                            $adestination .= "<option  value=\"$destinationid\">" . $destination . '</option>';
                                            }
                                        }
                                   
                                     ?>
                                      <label>Location</label>
                                      <select name="pLocation" id="pLocation">
                                          <option value="">Select Location</option>
                                          <?php echo $adestination; ?>
                                      </select>
                                      &nbsp;
                                      <label>Salary Class</label>
                                      <select  name="sClass" id="sClass">
                                          <option>M-N</option>
                                          <option>O-P</option>
                                          <option>Q-R</option>
                                          <option>S-U</option>
                                          <option>V-Y</option>
                                      </select>
                                      &nbsp;
                                      <label>Amount</label>
                                      <input style="width:80px" type="number" id="perdiemAmount" name="perdiemAmount" />
                                      &nbsp;
                                      <label>Currency</label>
                                      <select  name="sCurrency" id="sCurrency">
                                          <option>Naira</option>
                                          <option>Euro</option>
                                          <option>Dollar</option>
                                      </select>
                                      &nbsp;
                                      <input type="hidden" name="addPerdiem" value=true>
                                      <button class="btn btn-xs btn-primary" id="perdiemAdd" name="perdiemAdd">Add</button>
                                  </form>
                            </div>
                            <hr/>
                            
                            
                             <div class="card-content">
                                <div  id="dynamicload">
                                   
                                    <!-- Beginnin of Form -->
                                 <span id="perdiemMsg"></span>
                                    <div>
                                        <table class="table table-responsive table-striped table-hover table-bordered">
                                            <tr><td style="width:180px"><b>Location</b></td>
                                                <td style="width:80px"><b>Class</b></td>
                                                <td style="width:80px"><b>Amount</b></td>
                                                <td style="width:80px"><b>Currency</b></td><td>&nbsp;</td></tr>
                                        </table>
                                        <table id="loadingperdiem" class="table table-responsive table-striped table-hover table-bordered">
                                            <tr id="perdiemCollect" class="perdiemCollect"></tr>
                                        </table>
                                        <div id="listperdiem"></div>
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
                
                
                
   <?php echo $footer; ?>