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
                         
                         <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">Report</h4>
	                                <p class="category">Please make sure you select a Date Range</p>
	                            </div>
                                    
                                    
                                     <?php 
                                               $getcat = $this->mainlocation->getallaccounts();
                                               
                                                 if ($getcat) { 
                                                $acountCode = "";
                                                foreach ($getcat as $get) {

                                                    $codeid = $get->codeid;
                                                    $codeName = $get->codeName;
                                                    $codeNumber = $get->codeNumber;
                                                    $acountCode .= "<option  value=\"$codeNumber\">" . $codeName . '</option>';
                                                     }
                                                 }
                                   
                                           ?>
								
                                 <?php
                                       if($getApprovalLevel == 4 || $getApprovalLevel == 6 || $getApprovalLevel == 7){
                                       echo "			
	                            <div class='card-content'>
                                        <form name='maintform'  method='POST'  onsubmit='return false;'>
                                           <div class='col-md-4'>
                                                    <div class='form-group'>
                                                    <h4>Search By Acct Code</h4>
                                                    <label class='control-label'>Select Account Code</label>
                                                    <select name='dacctCode' id='dacctCode' class='form-control'>
                                                        <option>Select Account Code</option>
                                                        <option value='all'>All</option>
                                                         $acountCode;
                                                    </select>
                                                      Start Date<input placehoder='yyyy-mm-dd' type='text' name='startDateall' id='startDateall' class='form-control datepicker' />
                                                      End Date<input type='text' name='endDateall' id='endDateall' placehoder='yyyy-mm-dd' class='form-control datepicker' />
                                                    
                                                    <input type='submit' value='Search' id='searchbydate' name='searchbydate' class='btn btn-sm btn-google'/>
                                                    <!--<input type='submit' value='Export' id='searchbydate' name='exportoexcel' class='btn btn-sm btn-secondary'/>-->
                                                    </div>
	                                        </div>
                                        </form>";
                                       }
                                  ?>
                                    
                                      <?php
                                       if($getApprovalLevel == 6 || $getApprovalLevel == 4){
                                       echo "<form name='catmaintform'  method='POST' action=''  onsubmit='return false;'>
                                           <div class='col-md-4'>
                                                    <div class='form-group'>
                                                    <h4>Search By Status</h4>
                                                    <label class='control-label'>Select Status</label>
                                                    <select name='status' id='status' class='form-control'>
                                                        <option value=''>Select Status</option>
                                                        <option value='4'>Approved</option>
                                                        <!--<option value='3'>Pending</option>-->
                                                    </select>
                                                      Start Date<input type='text' placehoder='yyyy-mm-dd' name='catStartDate' id='catStartDate' class='form-control datepicker' />
                                                      End Date <input type='text'  placehoder='yyyy-mm-dd' name='catEndDate' id='catEndDate' class='form-control datepicker' />
                                                      <input type='submit' value='Search' id='catsearchbydate' name='catsearchbydate' class='btn btn-sm btn-facebook'/>
                                                    </div>
	                                        </div>
                                        </form>";
                                        }
                                        ?>
                                    
                                    
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
                                      <?php
                                       if($getApprovalLevel == 4){
                                       echo "<form name='catmaintform'  method='POST' action=''  onsubmit='return false;'>
                                           <div class='col-md-4'>
                                                    <div class='form-group'>
                                                    <h4>Search By Unit</h4>
                                                    <label class='control-label'>Select Status</label>
                                                    <select name='dUnit' id='dUnit' class='form-control'>
                                                        <option value=''>Select Unit</option>
                                                        $dunit
                                                    </select>
                                                      Start Date<input type='text' placehoder='yyyy-mm-dd' name='unitStartDate' id='unitStartDate' class='form-control datepicker' />
                                                      End Date <input type='text'  placehoder='yyyy-mm-dd' name='unitEndDate' id='unitEndDate' class='form-control datepicker' />
                                                      <input type='submit' value='Search' id='searchbyUnit' name='searchbyUnit' class='btn btn-sm btn-facebook'/>
                                                    </div>
	                                        </div>
                                        </form>";
                                        }
                                        ?>
                                        
                                        
                                       <?php
                                       if($getApprovalLevel == 6){
                                        echo "<form name='getsummary'  method='POST' action=''  onsubmit='return false;'>
                                           <div class='col-md-4'>
                                                    <div class='form-group'>
                                                    <h4>Summary/Group Account</h4>
                                                      Start Date<input type='text' placehoder='yyyy-mm-dd' name='datefromsummary' id='datefromsummary' class='form-control datepicker' />
                                                      End Date <input type='text' placehoder='yyyy-mm-dd' name='dateendsummary' id='dateendsummary' class='form-control datepicker' />
                                                      <input type='submit' value='Search' id='summarybygroup' name='summarybygroup' class='btn btn-sm btn-danger'/>
                                                    </div>
	                                        </div>
                                        </form>";
                                       }else{
                                           echo "";
                                       }       
                                      ?>

                                    
                                    
                                  <?php 
                                                $getunit = $this->mainlocation->getallunit();
                                                
                                                 if ($getunit) { 
                                                $actdunit = "";
                                                foreach ($getunit as $get) {

                                                    $id = $get->id;
                                                    $unitName = $get->unitName;
                                                    $actdunit .= "<option  value=\"$id\">" . $unitName . '</option>';
                                                     }
                                                 }
                                   
                                           ?>
                                      <?php
                                       if($getApprovalLevel == 7 || $getApprovalLevel == 8){
                                       echo "<form name='catmaintform'  method='POST' action=''  onsubmit='return false;'>
                                           <div class='col-md-4'>
                                                    <div class='form-group'>
                                                    <h4>Search By Unit</h4>
                                                    <label class='control-label'>Select Status</label>
                                                    <select name='dUnit' id='dUnit' class='form-control'>
                                                        <option value=''>Select Unit</option>
                                                        <option value='all'>All</option>
                                                        $actdunit
                                                    </select>
                                                      Start Date<input type='text' placehoder='yyyy-mm-dd' name='unitStartDate' id='unitStartDate' class='form-control datepicker' />
                                                      End Date <input type='text'  placehoder='yyyy-mm-dd' name='unitEndDate' id='unitEndDate' class='form-control datepicker' />
                                                      <input type='submit' value='Search' id='actsearchbyUnit' name='actsearchbyUnit' class='btn btn-sm btn-facebook'/>
                                                    </div>
	                                        </div>
                                        </form>";
                                        }
                                        ?>
                                    
                                    
                                   
	                            </div>
                                    
                                    <!-- BEGINNING OF SEARCH RESULT -->
                                    
                                    <div  class="card-content">
                                        <div id="results"></div>
                                    </div>
                                    <!-- END OF SEARCH RESULT -->
                                    
                                    
	                        </div>
	                    </div>
						
                         <!-- End of Request Details with Status -->
                         
                                
                                
                                
                            <!-- Inside Content Ends Here -->
                            
                            
	                </div>
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                
 <script>   
  $(document).ready(function() {
    $('#hodall').DataTable({
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf']
    });
});
</script>    
                
   <?php echo $footer; ?>