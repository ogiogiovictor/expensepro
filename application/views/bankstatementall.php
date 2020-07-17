
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
	                                <h4 class="title">BANK STATEMENT - ALL</h4>
	                                <p class="category"></p>
	                            </div>
								
                                    <p id="errorme"></p>			
	                            <div class="card-content table-responsive">
                                        <form name="chequepost[]" id="chequepost" onsubmit="return false;">
	                                <table class="table" id="mydata">
	                                    <thead class="text-primary">
                                            <tr>    
                                                <th>Select</th>
                                                <th>Date Confirmed</th>
                                                 <th>Cheque No</th>
                                                <th>Bank</th>
                                                <th>Amount</th>
                                                <th>Till Name</th>
                                                  <th>Pay To</th>
                                                <th>Bank Statement</th>
                                              
                                            </tr>
                                            
	                                    </thead>
	                                    <tbody>
	                                     
                                                <?php 
                                                if($getallresult){
                                                    foreach($getallresult as $get){
                                                        $id = $get->id;
                                                        $userID = $get->userID;
                                                        $dateSent = $get->dateSent;
                                                        $Amount = $get->Amount;
                                                        $fmrequestID = $get->fmrequestID;
                                                        $approval = $get->approval;
                                                        $unit = $get->unit;
                                                        $Location = $get->Location;
                                                        $chequeNo = $get->chequeNo;
                                                        $tillName = $get->tillName;
                                                        $dBank = $get->dBank;
                                                        $bankStatement = $get->bankStatement;
                                                        $paidTo = $get->paidTo;
                                                        
                                                        if($bankStatement == 'no'){
                                                            $newresult = "<span class='btn btn-xs btn-danger'>$bankStatement</span>";
                                                        }else{
                                                             $newresult = "<span class='btn btn-xs btn-primary'>$bankStatement</span>";
                                                        }
                                                        
                                                   
                                                ?>
								 
										 
	                                     <tr>
                                                 <td><input type="checkbox" value="<?php echo $id; ?>" name="dChecking" id="dChecking" /></td>
                                            <td><?php echo $dateSent; ?></td>
                                             <td><?php echo $chequeNo; ?></td>
                                            <td><?php echo $this->adminmodel->getBankName($dBank); ?></td>
                                            <td><?php echo $Amount; ?></td>
                                             <td><?php echo $tillName; ?></td>
                                            <td><?php echo $paidTo; ?></td>
                                            <td><?php echo $newresult; ?></td>
                                            </td>
						
                                            <?php
                                               }
                                             }
                                            ?>
	                                    </tbody>
	                                </table>
                                        </form>    
                                        <div id="generateStatementnow">
                                            <span id="bankerror"></span>
                                            
                                         <input type="submit" class="btn btn-google btn-sm" value="Geneate Bank Statement" id="generateNow" name="generateNow" />   
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