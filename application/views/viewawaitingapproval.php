
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
                            
                             <?php
                if ($mid) {
                    foreach ($mid as $get) {
                        $id = $get->id;
                        $aid = $get->aid;
                        $parts = $get->parts;
                        $estimatedCost = $get->estimatedCost;
                        $qty = $get->qty;
                        $dRegistered = $get->dRegistered;
                        $scheduleDate = $get->scheduleDate;
                        //$vendorName = $this->category->dvendorName($get->vendorName);
                        $vendorName = $get->vendorName;
                        $sessID = $get->sessID;
                        $warrantyreason = $get->warrantyreason;
                        $dreasonID = $get->dreasonID;
                        $createdbyEmail = $get->createdbyEmail;
                        $allocatedlastestuser = $this->assets->dgetAllocatedUser($get->aid);
                    }
                }
                ?>
                            <!-- Inside Content Begins  Here -->
                             
                         <!-- Beginning of Request Details with Status -->
                        
                    <div class="col-md-8 col-md-offset-2">     
                        <div class="card">
                                <div class="card-header text-center" data-background-color="blue">
                                    <h4 class="title">&nbsp;&nbsp;JOB ORDER DETAILS</h3>
                                    <p class="category">Asset Name : <?php echo $this->assets->getAssetName($aid); ?></p>
                                     <span id="showError"></span>
                                </div>
                       
                             <div class="card-content">
                                <div class="">
                                   
                                    <!-- Beginnin of Form -->
                                    
                                     <form name="requestApproval" id="requestApproval" method="POST" onSubmit="return false;">
	                                   
                                                <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Asset Name</label>
                                                      <input type="text" disabled class="form-control"  id="aName" name="aName" value="<?php echo $this->assets->getAssetName($aid); ?><?php echo " "; ?><?php echo $allocatedlastestuser; ?>">
                                                    </div>
	                                        </div>
                                         
                                                 <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Estimated Cost</label>
                                                     <input type="text" disabled class="form-control"  id="estCost" name="estCost" value="<?php echo $estimatedCost; ?>">
                                                    </div>
	                                        </div>
                                         
                                         
                                           <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Prepare By</label>
                                                    <textarea disabled class="form-control" col="4" row="10"><?php echo $createdbyEmail; ?></textarea>
                                                     <!--<input type="text" disabled class="form-control"  id="estCost" name="estCost" value="<?php //echo $createdbyEmail; ?>">-->
                                                    </div>
	                                        </div>
                                         
                                         
                                          <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Problem</label>
                                                     <input type="text" disabled class="form-control"  id="dparts" name="dparts" value="<?php echo $parts; ?>">
                                                    </div>
	                                        </div>
                                         
                                         
                                        
                                         
                                         <?php
                                        $checkdetailforvendor = $this->assets->checkvendortoapprove($vendorName);
                                        if ($checkdetailforvendor) {
                                            foreach ($checkdetailforvendor as $gett) {
                                                $vendorid = $gett->id;
                                                $aid = $gett->aid;
                                                $vendorA = $gett->vendorA;
                                                $vendorAName = $this->assets->dvendorName($gett->vendorA);
                                                $vendorAprice = $gett->vendorAprice;
                                                $vendorFileA = $gett->vendorFileA;

                                                $vendorB = $gett->vendorB;
                                                $vendorBName = $this->assets->dvendorName($gett->vendorB);
                                                $vendorBprice = $gett->vendorBprice;
                                                $vendorFileB = $gett->vendorFileB;

                                                $vendorC = $gett->vendorC;
                                                $vendorCName = $this->assets->dvendorName($gett->vendorC);
                                                $vendorCprice = $gett->vendorCprice;
                                                $vendorFileC = $gett->vendorFileC;
                                            }
                                        }
                                        ?>
                                                                                  
                                          <div class="row">
                                    <div class="col-md-12">
                                        <label class="col-sm-12">Vendors Price List: Select only one</label>
                                        <table class="table table-hover table-striped">
                                            <tr>

                                                <td>


                                                    <label>
                                                        <input type="radio" name="vendorchoice" id="vendorchoice" value="<?php echo $vendorA; ?>" />
                                                        <span style="color:red"><?php echo $vendorAName; ?> -  <?php echo $vendorAprice; ?></span>
                                                    </label>
                                                    &nbsp;&nbsp;
                                                    <label>
                                                        <input type="radio" name="vendorchoice" id="vendorchoice" value="<?php echo $vendorB; ?>" />
                                                        <span style="color:red"><?php echo $vendorBName; ?> -  <?php echo $vendorBprice; ?></span>
                                                    </label>

                                                    &nbsp;&nbsp;
                                                    <label>
                                                        <input type="radio" name="vendorchoice" id="vendorchoice" value="<?php echo $vendorC; ?>" />
                                                        <span style="color:red"><?php echo $vendorCName; ?> -  <?php echo $vendorCprice; ?></span>
                                                    </label>


                                                </td></tr>
                                        </table>

                                    </div>
                                    
                                    
                                   
                                    <div class="col-md-12">
                                        <?php 
                                    if($warrantyreason != ""){
                                        echo '<div style="padding:20px"><label><span style="color:red">NOTICE!!! </span>&nbsp;&nbsp;&nbsp;&nbsp;<br/>   ASSET UNDER WARRANTY   -   Reason:&nbsp;&nbsp;&nbsp;&nbsp;   '.$warrantyreason.'</label></div>';
                                    }else{
                                        echo "";
                                    }
                                    
                                    ?>
                                    </div>
                                    
                                              
                                   <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-responsive">
                                                <tr> 
                                                    <td>Vendor A Profoma Invoice : <br/><?php echo $vendorAName; ?> : <?php echo $vendorAprice; ?></td>
                                                    <td>Vendor B Profoma Invoice :  <br/><?php echo $vendorBName; ?> :  <?php echo $vendorBprice; ?></td>
                                                    <td>Vendor C Profoma Invoice:  <br/><?php echo $vendorCName; ?>: : <?php echo $vendorCprice; ?></td>
                                                </tr>
                                                
                                                <?php
                                                    $baseUrl = base_url();
                                                    if($baseUrl == 'https://c-iprocure.com/asset'){
                                                        $newUrl = 'https://c-iprocure.com/asset/';
                                                    }else{
                                                       $newUrl = 'http://localhost/assetmanagement/'; 
                                                    }
                                                ?>
                                                <tr> 
                                                    <td><a href="<?php echo $newUrl; ?>document/vendors/<?php echo $vendorFileA; ?>"><img src="<?php echo $newUrl; ?>document/vendors/<?php echo $vendorFileA; ?>"  width="150px" class="img-responsive"/></a></td>
                                                    <td><a href="<?php echo $newUrl; ?>document/vendors/<?php echo $vendorFileB; ?>"><img src="<?php echo $newUrl; ?>document/vendors/<?php echo $vendorFileB; ?>" width="150px" class="img-responsive" /></a></td>
                                                    <td><a href="<?php echo $newUrl; ?>document/vendors/<?php echo $vendorFileC; ?>"><img src="<?php echo $newUrl; ?>document/vendors/<?php echo $vendorFileC; ?>"  width="150px" class="img-responsive" /></a></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>    
                                    
                                    <div class="col-md-12">
                                           
                                                <label>Comment</label>
                                                <input type="text" class="form-control" id="recomm" name="recomm"/>
                                                
                                        </div>
                                    
                                    
                                      <div class="col-md-12">
                                          <span id="maintError"></span><br/>
                                                    <center><input type="hidden" value="<?php echo $aid; ?>" name="assetID" id="assetID">
                                                    <input type="hidden" value="<?php echo $id; ?>" name="theID" id="theID">
                                                     <input type="hidden" value="<?php echo $dreasonID; ?>" name="dreasonID" id="dreasonID"> 
                                                    <input type="hidden" value="<?php echo $scheduleDate; ?>" name="schDate" id="schDate">
                                                    <button onclick="approvemant(<?php echo $aid; ?>)" type="button"  class="btn btn-info btn-info btn-sm">
                                                        Approve</button>

                                                    <button onclick="notapprove(<?php echo $aid; ?>)"  type="button" class="btn btn-danger btn-danger btn-sm">Reject</button></center>
                                      </div>
                                    
                                    
                                </div>
                                           
                                     </form>

                                    
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