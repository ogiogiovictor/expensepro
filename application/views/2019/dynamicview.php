<style type="text/css">
    .reportAlter{
        display:none;
    }
    .displayme{
        display:inline;
    }
</style>
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
                                        <h4 class="title">PAY CHEQUE</h4> 
                                        
                                        <!--<a href="<?php echo base_url(); ?>"><div class="pull-right">Back</div></a>-->
                                       
                                        <p class="category">Cheque processing platform <br/>
                                            <a onClick ="window.history.back()"class="btn btn-sm btn-pinterest">Back</a>
                                            <a id="bringmeout" class="btn btn-sm btn-success">Report</a>
                                        </p>
                                       
	                            </div>
				
                                    <!-- BEGINNING OF REPORT SECTION -->
                                    <div class="col-md-12 reportAlter">	
                                        <div class="form-group">
                                            <form name="exportchques"  method="POST" action="https://c-iprocure.com/expensepro/chequexport/getmyreport">
                                                <div><b>Search Report by Date Paid</b></div>
                                                Start Date &nbsp;<input type="text" placehoder="yyyy-mm-dd" name="startDate" id="startDate" class="datepicker" />
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                End Date &nbsp;<input type="text"  placehoder="yyyy-mm-dd" name="endDate" id="endDate" class=" datepicker" />
                                                <input type="submit" value="Search" id="payChequebranch" name="payChequebranch" class="btn btn-sm btn-facebook"/>
                                            </form>
                                        </div>
	                              </div>
                                     <!-- END OF REPORT SECTION -->
	                            <div class="card-content table-responsive result">
	                                <table class="table table-condensed table-hover" id="hodall">
	                                    <thead class="text-primary">
	                                    	<th>Id</th>
                                                <th>Date Paid</th>
	                                    	<th style="width:150px">Description of Item</th>
                                                <th>Location</th>
                                                <th>Unit</th>
						<th>Method</th>
                                                <th>Amount</th>
                                                <th>Payee</th>
                                                <th>Bank</th>
                                                <th>Cheque No</th>
                                                <th>Paid By</th>
                                                 <th>&nbsp;</th>
	                                    </thead>
	                                    <tbody>
	                                     
						<?php if ($getallresult) { ?>
                                                
                                                
						<?php
                                                    foreach ($getallresult as $get) {
                                                         $id = $get->id;
                                                         $app_ID = $get->app_ID;
							 $userID = $get->userID;
							 $Amount = $get->Amount;
							 $paidByAcct = $get->paidByAcct;
							 $fmrequestID = $get->fmrequestID;
							 $accountPayableID = $get->accountPayableID;
							 $datePaid = $get->datePaid;
							 $approval = $get->approval;
							 $unit = $get->unit;
                                                         $Location = $get->Location;
                                                         $requesterEmail = $get->requesterEmail;
                                                         $chequeNo = $get->chequeNo;
                                                         $type = $get->type;
                                                         $dBank = $get->dBank;
                                                         $paidTo = $get->paidTo;
                                                         $accountGroup = $get->accountGroup;
                                                         
                                                         $getStatus = $this->generalmd->getuserAssetLocation("approvals", "cash_newrequestdb", "id", $fmrequestID);
                                                         $hash = $this->generalmd->getuserAssetLocation("md5_id", "cash_newrequestdb", "id", $fmrequestID);
                                                         $currencyType = $this->generalmd->getuserAssetLocation("currencyType", "cash_newrequestdb", "id", $fmrequestID);
                                                                                    
						?>
                                               			 
	                                     <tr>
                                             <td><?php echo $fmrequestID; ?></td>     
                                            <td><?php echo $datePaid; ?></td>
                                            <td><?php echo $this->mainlocation->descriptionofitem($fmrequestID); ?></td>
                                            <td>
                                                <?php
                                                if(is_numeric($Location)){
                                                     echo $this->mainlocation->getdLocation($Location);
                                                }else{
                                                    echo $Location;
                                                }
                                                ?>
                                            </td>
                                            <td><?php 
                                            if(is_numeric($unit)){
                                               echo $this->mainlocation->getdunit($unit); 
                                            }else{
                                                echo $unit;
                                            }
                                             ?></td>
                                            <td><?php echo $type; ?></td>
                                            <td><b><?php echo $currencyType. @number_format($Amount, 2); ?></b></td>
                                            <td><?php echo $paidTo; ?></td>
                                            <td><?php echo $dBank; ?></td>
                                            <td><?php echo $chequeNo; ?></td>
                                            <td><?php echo $paidByAcct; ?></td>
                                            <td>
                                              <span title='print' class='btn btn-xs btn-default' onClick="printchequerequests(<?php echo $fmrequestID; ?>)"><i class='material-icons'>print</i></span>
                                              <a target="_blank" href="<?php echo base_url(); ?>/home/viewreqeuestdetails/<?php echo $fmrequestID; ?>/<?php echo $getStatus; ?>/<?php echo $hash; ?>"><i class="btn btn-sm btn-success">V</i></span>
                                              </a>
                                            </td>
                                            </tr>
											
                                            <?php } ?>

                                         <?php } ?>	
                                            					
	                                    </tbody>
	                                </table>

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
    
  $(document).ready(function() {
    $('#hodall').DataTable( {
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf'],
        "order": [[0, "desc" ]]
    });
    
    $('#bringmeout').click(function(){
        //$('.reportAlter').addClass('displayme');
        $('.reportAlter').toggle();
    });
    
      //This section deals search by date and account officer and category
      $('#payChequebranch').click(function () {
          
          var startDate = $('#startDate').val();
          var endDate = $('#endDate').val();

            if(startDate =="" || endDate ==""){
                alert("Please enter a Start and End Date");
             }else{
                 $('#results').html('Loading Result, Please wait.....');
                $.ajax({
                   url : GLOBALS.appRoot + "reports/cashiersearch",
                   method : "POST",
                   data: {startDate: startDate, endDate : endDate},
                   dataType : "text",
                   success : function (data){
                       $('.result').html(data);
                   }
                });
            }
    });

});
</script>                     
                
   <?php echo $footer; ?>