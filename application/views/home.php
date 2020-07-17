
	<div class="wrapper">
	    <div class="sidebar" data-color="blue" data-image="<?php echo base_url(); ?>public/assets/img/sidebar-1.jpg">

			<!--
		        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
                        colors : #113c7f, #5e82bb
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
                                <!-- with icons and horizontal -->
                        <ul class="nav nav-pills nav-pills-icons nav-pills-primary" role="tablist">
                               
                                <li class="active">
                                        <a href="<?php echo base_url(); ?>home/newrequest">
                                                <i class="material-icons">dashboard</i>
                                               New Request
                                        </a>
                                </li>
                                
                                <li>
                                    <a href="<?php echo base_url(); ?>documents/index">
                                     
                                      <i class="material-icons">ballot</i>
                                      My Document
                                    </a>
                                </li>
                                
                                <!--<li>
                                    <a href="<?php echo base_url(); ?>home/newrequest">
                                      <i class="material-icons">collections</i>
                                      Shared Document
                                    </a>
                                </li>-->
                                
                                
                               
                             
                             <?php 
                                 if($getApprovalLevel == 6 || $getApprovalLevel == 5){
                                echo "<li>
                                        <a href='".base_url()."action/disableduser'>
                                                <i class='material-icons'>accessibility</i>
                                                All Users
                                        </a>
                                </li>";
                                 }else{
                                    echo "";
                                 }
                             ?>
                                
                            <?php 
                           /* $getAsset = $this->generalmd->getuserAssetLocation("contratMgt", "cash_usersetup", "id", $this->session->id);
                                 if($getAsset == 1){
                                echo "<li>
                                        <a href='".base_url()."assetmgt/index'>
                                               <i class='material-icons'>assessment</i>
                                                 Asset Management
                                        </a>
                                </li>
                                ";
                                 }
                            * 
                            */
                             ?>
                                
                                
                            <?php 
                            $checkforaccess = $this->generalmd->getsinglecolumn("userIds", "access_gen", "id", "11");
                            $whichAcess = $this->gen->haveAccess($_SESSION['id'], $checkforaccess);
                                 if($whichAcess == TRUE){
                                echo "<li>
                                         <a href='".base_url()."home/generatebankstatement'>
                                               <i class='material-icons'>account_balance</i>
                                                Bank Confirmation
                                        </a>
                                </li>
                                <li>
                                        <a href='".base_url()."home/allpartpayments'>
                                              <i class='material-icons'>business</i>
                                               Part Payment
                                        </a>
                                </li>
                                ";
                                 }
                             ?>
                                
                                
                                
                                <?php 
                               
                               if($getApprovalLevel == 6){
                               echo "<li>
                                        <a href='".base_url()."home/printoutcheques'>
                                               <i class='material-icons'>print</i>
                                                 Printout Cheque
                                        </a>
                                </li>
                                
                                <li>
                                        <a href='".base_url()."home/generatebankstatement'>
                                               <i class='material-icons'>account_balance</i>
                                                Bank Confirmation
                                        </a>
                                </li>
                                <li>
                                        <a href='".base_url()."home/allpartpayments'>
                                              <i class='material-icons'>business</i>
                                               Part Payment
                                        </a>
                                </li>
                                <!--<li>
                                        <a href='".base_url()."home/allgeneratebankstatement'>
                                               <i class='material-icons'>receipt</i>
                                                All Bank Confirmation
                                        </a>
                                </li><li>
                                        <a href='".base_url()."home/govementlevies'>
                                                <i class='material-icons'>insert_chart</i>
                                                Govt Levies
                                        </a>
                                </li>-->";
                                }else if($getApprovalLevel == 3){
                                    echo "
                                    <li>
                                        <a href='".base_url()."userexpense/generalreportssearch'>
                                            <i class='material-icons'>schedule</i>
                                              <p>General Report</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href='".base_url()."recieveables'>
                                             <i class='material-icons'>bubble_chart</i>
                                              <p>Retirement</p>
                                        </a>
                                    </li>";
                                    
                                }else{
                                    
                                    echo "";
                                }
                               ?>
                                
                                
                                 
                                
                                
                        </ul>
                                
                                
                        <hr/>        
                         <!-- Beginning of Request Details with Status -->
                         
                         <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">My Request</h4>
	                                <p class="category">Latest Request and Status Update</p>
	                            </div>
								
                                  <div style="float:right; margin-right:30px">
                                        <form class="form-inline" role="form" action="<?php echo base_url().'home/makemysessionsearch'; ?>" method="POST">
                                        <div class="form-group">
                                            Search: <input name="addsearch" placeholder="Search By ID, Title, Amount " type="text" class="form-control" id="addsearch">
                                            <small class="text-danger"><center>press the enter key</center></small>
                                        </div>
                                        <!--<button style="margin-top:30px" type="submit" class="btn btn-sm btn-facebook">Go</button>-->
                                        </form>
                                       
                                  </div>
                                    <div style="clear:both"></div>
	                            <div class="card-content table-responsive table-condensed">
                                        <span id="pCodeStatus"></span>
	                                <table class="table table-responsive tablesaw-sortable-head table-striped table-hover" id="">
                                        <!--<table class="table table-striped" id="mydatahome">-->
	                                    <thead class="text-primary">
	                                    	<th style="width:40px">Id</th>
                                                <th>Date</th>
	                                    	<th style="width:200px;">Description of Item</th>
						<th>Payment Method</th>
                                                <th>Amount</th>
						<th style="width:50px">Status</th>
                                                <th>Action</th>
	                                    </thead>
	                                    <tbody>
	                                     
                                             <?php if ($getallresult) { ?>
					  <?php
                                             foreach ($getallresult as $get) {
						$id = $get->id;
						$dateCreated = $get->dateCreated;
						$ndescriptOfitem = $get->ndescriptOfitem;
						$nPayment = $this->mainlocation->getpaymentType($get->nPayment);
						$approvals = $get->approvals;
						$hod = $get->hod;
						$icus = $get->icus;
						$cashiers = $get->cashiers;
						$sessionID = $get->sessionID;
						$dateRegistered = $get->dateRegistered;
                                                $dAmount= $get->dAmount;
                                                $refID_edited= $get->refID_edited;
						$partPay = $get->partPay;
                                                $newPayment = $get->nPayment;
                                                $md5_id = $get->md5_id;
                                                $dCashierwhopaid = $get->dCashierwhopaid;
                                                $dCashierwhorejected = $get->dCashierwhorejected;
                                                $CurrencyType = $get->CurrencyType;
                                                $whichapp = $get->from_app_id;
                                                $apprequestID = $get->apprequestID;
                                                $dunit = $get->dUnit;
                                                
                                              
                                                if($CurrencyType == 'naira'){
                                                    $newCurrency = '<span>&#8358;</span>';
                                                }else if($CurrencyType == 'dollar'){
                                                    $newCurrency = '<span>&#x0024;</span>';
                                                }else if($CurrencyType == 'euro'){
                                                    $newCurrency = '<span>&#8364;</span>';
                                                }else if($CurrencyType == 'pounds'){
                                                    $newCurrency = '<span>&#163;</span>';
                                                }else if($CurrencyType == 'yen'){
                                                    $newCurrency = '<span>&#165;</span>';
                                                }else if($CurrencyType == 'singaporDollar'){
                                                    $newCurrency = '<span>S&#x0024;</span>';
                                                }else if($CurrencyType == 'AED'){
                                                    $newCurrency = '<span>(AED)</span>';
                                                }else if($CurrencyType == 'rupee'){
                                                    $newCurrency = '<span>&#8377;</span>';
                                                }else{
                                                   
                                                    if($CurrencyType != ""){
                                                      $newCurrency = @$this->generalmd->getsinglecolumnfromotherdb("curr_symbol", "currencies", "curr_abrev", $CurrencyType); 
                                                    }else if($CurrencyType == "null" || $CurrencyType == ""){
                                                        $newCurrency =  '<span>&#8358;</span>';
                                                    }else{
                                                        $newCurrency =  '<span>&#8358;</span>';
                                                    }
                                                    
                                                }
                                                        
                                                       
                                                
                                            if($partPay !="0.00" && $partPay < $dAmount){
                                               $dAmount = "<span style='color:red; font-weight:bold'>". $newCurrency. @number_format($partPay) ."</span>";
                                               $dAmount .= "<br/><span style='color:red; font-weight:bold'><small>(Part Payment)</small></span>";
                                              }else{
                                               $dAmount = $newCurrency. @number_format($dAmount, 2);
                                            }	
                                            
                                           
                                                        
						 /*
						 APPROVAL LEVEL
						// approve = 0(pending),  approve = 1(awaiting approval), approve = 2(approved by hod) 
                                                  // approve = 3(approved by hod) approve = 4 (paid for cashiers only)
						 */
                                            
                                                 $newapproval = $this->generalmd->getsinglecolumn("name", "approval_type", "approval_type",  $approvals);
                                              
                                                   
						/* if($approvals == 0){
                                                     $newapproval = "Draft";
						 }else if($approvals == 1){
                                                     $newapproval = "<span style='color:red'>Awaiting HOD Approval</span>";
						 }else if($approvals == 2){
                                                     $newapproval = "<span style='color:blue'>Awaiting ICU Approval</span>";
						 }else if($approvals == 3){
                                                     $newapproval = "<span style='color:indigo'>Awaiting Payment</span>";
						 }else if($approvals == 4 && $dCashierwhopaid == ""){
                                                     $newapproval = "<span style='color:green'>Ready for Collection</span>";
						 }else if($approvals == 4 && $dCashierwhopaid != ""){
                                                     $newapproval = "<span style='color:green'> Cash Paid by by $dCashierwhopaid</span>";
						 }else if($approvals == 5){
                                                     $newapproval = "<span style='color:red'>Not Approved By HOD</span>";
						 }else if($approvals == 6){
                                                     $newapproval = "<span style='color:grey'>Rejected by ICU</span>";
						 }else if($approvals == 7){
                                                     $newapproval = "<span style='color:indigo'>Cheque Sent for Signature</span>";
						 }else if($approvals == 8  && $dCashierwhopaid == ""){
                                                     $newapproval = "<span style='color:green'>Signed & Ready for Collection</span>";
						 }else if($approvals == 8 && $dCashierwhopaid != ""){
                                                     $newapproval = "<span style='color:green'>Cheque Paid by $dCashierwhopaid</span>";
						 }else if($approvals == 11){
                                                     $newapproval = "<span style='color:brown'>Closed</span>";
						 }else if($approvals == 12){
                                                     $newapproval = "<span style='color:red'>Rejected by $dCashierwhorejected</span>";
						 }
					         */
                                                 // approvals = 11 then it is disabled inline
                                                 $randomString = random_string('alnum', 30);
						?>
										 
										 
	                                     <tr>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $dateCreated; ?></td>
                                            <td><?php echo strip_slashes($ndescriptOfitem); ?></td>
					    <td><?php echo $nPayment; ?></td>
                                            <td><?php echo $dAmount; ?></td>
                                            <td><?php echo  $newapproval ?></td>
                                           <td>
                                            <?php
                                            
                                            if($approvals == 0 || $approvals == 5 || $approvals == 6 || $approvals == 10){ 
                                              echo '<a href="'.base_url().'postrequest/editrequest/'.$id.'/'.$dunit.'/'.$md5_id.'">
                                                  <button type="button" rel="tooltip" title="Edit Request" class="btn-xs btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                 </button>
                                                </a>
                                                <a href="'.base_url().'draft/uploaddocuments/'.$id.'/'.$md5_id.'/'.$sessionID.'">
                                                    <button type="button" rel="tooltip" title="Upload" class="btn-xs btn-primary">
                                                   <i class="fa fa-upload" style="color:white"></i></button></a>
                                               
                                                <a href="'.base_url().'home/viewmyrequest/'.$id.'/'.$randomString.'">
                                                   <button type="button" rel="tooltip" title="View Request" class="btn-xs btn-primary">
                                                    <i class="fa fa-file-image-o"></i></button></a>';  
                                            }else if($approvals == 1){
                                                 echo '<a href="'.base_url().'postrequest/editrequest/'.$id.'/'.$dunit.'/'.$md5_id.'">
                                                  <button type="button" rel="tooltip" title="Edit Request" class="btn-xs btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                 </button>
                                                </a>
                                                <a href="'.base_url().'draft/uploaddocuments/'.$id.'/'.$md5_id.'/'.$sessionID.'">
                                                    <button type="button" rel="tooltip" title="Upload" class="btn-xs btn-primary">
                                                   <i class="fa fa-upload" style="color:white"></i></button></a>
                                               
                                                <a href="'.base_url().'home/viewmyrequest/'.$id.'/'.$randomString.'">
                                                   <button type="button" rel="tooltip" title="View Request" class="btn-xs btn-primary">
                                                    <i class="fa fa-file-image-o"></i></button></a>'; 
                                            }else if($approvals == 2){
                                                 echo '<a href="'.base_url().'draft/uploaddocuments/'.$id.'/'.$md5_id.'/'.$sessionID.'">
                                                    <button type="button" rel="tooltip" title="Upload" class="btn-xs btn-danger">
                                                   <i class="fa fa-upload" style="color:white"></i></button></a>
                                               
                                                <a href="'.base_url().'home/viewmyrequest/'.$id.'/'.$randomString.'">
                                                   <button type="button" rel="tooltip" title="View Request" class="btn-xs btn-danger">
                                                    <i class="fa fa-file-image-o"></i></button></a>'; 
                                            }else if($approvals == 3){
                                                echo '<a href="'.base_url().'home/viewmyrequest/'.$id.'/'.$randomString.'">
                                                   <button type="button" rel="tooltip" title="View Request" class="btn-xs btn-secondary">
                                                    <i class="fa fa-file-image-o"></i></button></a>'; 
                                            }else if($approvals == 4 || $approvals == 8){
                                                 echo '<a href="'.base_url().'home/viewmyrequest/'.$id.'/'.$randomString.'">
                                                   <button type="button" rel="tooltip" title="View Request" class="btn-xs btn-info">
                                                    <i class="fa fa-file-image-o"></i></button></a>';  
                                            }else{
                                                  echo '<a href="'.base_url().'home/viewmyrequest/'.$id.'/'.$randomString.'">
                                                   <button type="button" rel="tooltip" title="View Request" class="btn-xs btn-success">
                                                    <i class="fa fa-file-image-o"></i></button></a>';  
                                            }
                                            
                                            
                                            ?>
                                               
                                         
                                               
                                             <?php
                                             if($approvals == '15'){
                                                    echo '<a href="'.base_url().'draft/uploaddocumentsfromproc/'.$id.'/'.$md5_id.'/'.$sessionID.'">
                                                    <button type="button" rel="tooltip" title="Upload" class="btn-xs btn-danger">
                                                   <i class="fa fa-upload" style="color:white"></i></button></a>';
                                             }
                                             ?>
                                               
                                               
                                            <?php
                                             if($newPayment == '1' & $approvals == '3'){
                                                 echo "<button title='Send Payment Code' class='btn-xs btn-secondary sendpaymentCode' id='$id'><i class='fa fa-usd'></i></button>";
                                             }
                                             ?>
                                               
                                               
                                               
                                             <?php
                                           /*  if($sessionID == $_SESSION['email'] && ($approvals == 2 || $approvals == 3) && $newPayment == 1){
                                                echo '<a href="'.base_url().'changecashier/changemycashier/'.$id.'/'.$md5_id.'/'.$sessionID.'">
                                                    <button type="button" rel="tooltip" title="Edit Cashier or ICU" class="btn-warning">
                                                    <i class="fa fa-external-link"></i> </button></a>';
                                            }else{
                                                echo "";
                                            }
                                            * 
                                            */
                                             ?>
                                               
                                            
                                               
                                              <?php
                                              /* if($approvals == '2' && ($whichapp == 0 || $whichapp == 8 || $whichapp == 9)){
                                                 echo '<a title="Upload" class="btn-primary" href="'.base_url().'draft/uploaddocuments/'.$id.'/'.$md5_id.'/'.$sessionID.'">
                                                    
                                                   <i class="fa fa-upload" style="color:white"></i></a>';
                                             }
                                               * 
                                               */
                                             
                                             ?>
                                               
                                               
                                             <?php
                                             /* if($approvals == '1' && ($whichapp == 0 || $whichapp == 8)){
                                                 echo '<a href="'.base_url().'draft/editrequestforwaitingapproval/'.$id.'/'.$md5_id.'/'.$approvals.'/'.$sessionID.'">
                                                     <button type="button" rel="tooltip" title="Edit Request" class="btn-danger">
                                                      <i class="fa fa-edit"></i></button></a>
                                                   <a href="'.base_url().'draft/uploaddocuments/'.$id.'/'.$md5_id.'/'.$sessionID.'">
                                                    <button type="button" rel="tooltip" title="Upload" class="btn-primary">
                                                   <i class="fa fa-upload" style="color:white"></i></button></a>';
                                             }else if($approval == '0'){
                                              
                                              echo "<a href="'.base_url().'draft/draftedit/'.$id.'/'.$md5_id.'/'.$approvals.'">
                                                     <button type="button" rel="tooltip" title="Edit Draft" class="btn-danger">
                                                    <i class="fa fa-edit"></i></button></a>
                                              <a href="'.base_url().'home/editejectedrequest/'.$id.'/'.$md5_id.'/'.$approvals.'">
                                                  <button type="button" rel="tooltip" title="Edit Request" class="btn-danger">
                                                    <i class="fa fa-edit"></i>
                                                 </button></a>";
                                              }
                                             */
                                             ?>
                                               
                                              <?php
                                             /*if($newPayment == 1 && $approvals == 3 && $sessionID == $_SESSION['email']){
                                                echo '<a href="'.base_url().'supports/editcashier/'.$id.'/'.$md5_id.'/'.$sessionID.'">
                                                    <button type="button" rel="tooltip" title="Edit Cashier" class="btn btn-xs btn-success">
                                                   
                                                    <i class="material-icons">check_box</i> </button></a>';
                                            }else{
                                                echo "";
                                            }
                                              
                                              */
                                             ?>
                                           </td>
	                                    </tr>
											
					<?php } ?>

                                         <?php } ?>	
											
	                                    </tbody>
	                                </table>
                                        
                                        
                                        <center><?php echo $paginationLinks; ?></center>
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
   $(document).ready(function(){
        var table = $('#mydatahome');
        var oTable = table.DataTable({
            "order": [[0, "desc" ]]
           
        });
        
    
        
    });
</script>              
                
   <?php echo $footer; ?>