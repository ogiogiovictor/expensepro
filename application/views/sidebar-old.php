 <?php
    $dgetheadersession =  $this->users->checkUserSession($_SESSION['email']);			 
	if($dgetheadersession ){
	foreach($dgetheadersession as $get){
	$id = $get->id;
	$fname = $get->fname;
	$lname = $get->lname;
	$email = $get->email;
	$accessLevel = $get->accessLevel;
	$uLocation = $get->uLocation;
	$activation = $get->activation;
	$userStatus = $get->userStatus;
	$lastlogin = $get->lastlogin;
        	}
	}

?>

			<div class="logo">
				<a href="#" class="simple-texts">
					<center>TBS - EXPENSE PRO
                                            <!--<div style="font-size:12px; color:grey;"><?php //echo $_SESSION['email']; ?></div>-->
                                             <div style="font-size:12px; color:grey;"><?php echo ucfirst($fname)." ". ucfirst($lname); ?></div>
                                       </center>
				</a>
                           
			</div>
                         
<!--

<ul>
    <li class="<?php //echo active_link('home'); ?>"><a href="<?php //echo site_url('home'); ?>">Home</a></li>
    <li class="<?php //echo active_link('about'); ?>"><a href="<?php //echo site_url('about'); ?>">About</a></li>
</ul>
- See more at: https://arjunphp.com/manage-highlight-active-link-page-codeigniter/#sthash.dDamABkp.dpuf
-->
                       

	    	<div class="sidebar-wrapper">
	            <ul class="nav">
	                <li class="<?php echo active_link('home'); ?>">
	                    <a href="<?php echo site_url('home'); ?>">
	                        <i class="material-icons">apps</i>
	                        <p>HOME</p>
	                    </a>
	                </li>
                        
                   
                       
                        <hr/>
                        <li style="font-weight:bold; font-size:18px; margin-left:30px">MY REQUEST</li>
                        <?php 
                        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']); 
                        //Get second level approval ID
                         $getLevelApprove = $this->users->getSecondlevelapproval($_SESSION['id']);
                        ?>
                      <?php 
                       if($getApprovalLevel == 1 || $getApprovalLevel == 2 || $getApprovalLevel == 3 || $getApprovalLevel == 6 || $getApprovalLevel == 8 || $getApprovalLevel == 4 || $getApprovalLevel == 7 || $getApprovalLevel == 5){
                            echo "<li>
	                    <a href='".base_url()."home/myawaitingapprovalpending'>
	                       <i class='material-icons'>info</i>
	                        <p>Pending</p>
	                    </a>
	                </li>
	                
	                <li>
	                    <a href='".base_url()."home/allapprovedrequest'>
	                        <i class='material-icons'>check_circle</i>
	                        <p>Approved</p>
	                    </a>
	                </li>  
	                
	                <li>
	                    <a href='".base_url()."home/cancelrejected'>
	                        <i class='material-icons'>cancel</i>
	                        <p>Rejected</p>
	                    </a>
	                </li>"; 
                       }
                      ?>
                        <li style="font-weight:bold; font-size:18px; margin-left:30px">APPROVALS</li>
                    <?php 
                    
                    if($getApprovalLevel == 6){    
                     echo "<li>
	                    <a href='".base_url()."home/myapprovalads'>
	                        <i class='material-icons'>person</i>
	                        <p>Request for Approval</p>
	                    </a>
	                </li>
	                
	                <li>
	                    <a href='".base_url()."action/disableduser'>
	                        <i class='material-icons'>account_circle</i>
	                        <p>Registered Users</p>
	                    </a>
	                </li>
                        
                    
                        <li>
                            <a href='".base_url()."home/cashierlimit'>
                                <i class='material-icons'>trending_up</i>
                              Create Till
                          </a>
                         </li>";
                      }else if($getApprovalLevel == 8){    
                     echo "<li>
	                    <a href='".base_url()."home/myapproval'>
	                        <i class='material-icons'>person</i>
	                        <p>Request for Approval</p>
	                    </a>
	                </li>
                        <li class='".active_link('home/requestforpayment')."'>
	                    <a href='".base_url()."home/requestforpayment'>
	                        <i class='material-icons'>recent_actors</i>
	                        <p>Cashier's Request</p>
	                    </a>
	                </li>
                        
                        <li>
                            <a href='".base_url()."home/cashierlimit'>
                                <i class='material-icons'>trending_up</i>
                              Create Till
                          </a>
                         </li>
                         
                        <!--<li>
                            <a href='".base_url()."home/cashiersallUsers'>
                                <i class='material-icons'>monetization_on</i>
                                 Cashiers
                            </a>
                        </li>-->
                        
                        <!--<li>
	                    <a href='".base_url()."home/mysuperaccount'>
	                       <i class='material-icons'>business</i>
	                        <p>Group Level(Acct)</p>
	                    </a>
	                </li>-->
                        <!--<li>
                            <a href='".base_url()."home/report'>
                                <i class='material-icons'>schedule</i>
                                  <p>Report</p>
                            </a>
                        </li>-->
                        <!--<li>
                           <a href='".base_url()."home/cashiertill'>
                                <i class='material-icons'>settings_input_antenna</i>
                                  Paid Cheques
                                </a>
                        </li>-->
                        <!--<li>
	                    <a href='".base_url()."home/datatables'>
	                        <i class='material-icons'>album</i>
	                        <p>Archives</p>
	                    </a>
	                </li>-->
                        ";
                      }else if($getApprovalLevel == 5){    
                     echo "<li>
	                    <a href='".base_url()."home/myapproval'>
	                        <i class='material-icons'>person</i>
	                        <p>Request for Approval</p>
	                    </a>
	                </li>
                        <!--<li class='".active_link('home/cashierlimit')."'>
	                    <a href='".base_url()."home/cashierlimit'>
	                        <i class='material-icons'>recent_actors</i>
	                        <p>Cashiers Till</p>
	                    </a>
	                </li>-->
                        
                        <!--<li>
                            <a href='".base_url()."home/cashiersallUsers'>
                                <i class='material-icons'>monetization_on</i>
                                 Cashiers
                            </a>
                        </li>-->
                        <!--<li>
	                    <a href='".base_url()."home/mysuperaccount'>
	                       <i class='material-icons'>business</i>
	                        <p>Group Level(Acct)</p>
	                    </a>
	                </li>-->
                        
                        <li>
	                    <a href='".base_url()."home/hodapprovalrequest'>
	                        <i class='material-icons'>album</i>
	                        <p>All Request</p>
	                    </a>
	                </li>
	                <li>
	                    <a href='".base_url()."action/disableduser'>
	                        <i class='material-icons'>account_circle</i>
	                        <p>Registered Users</p>
	                    </a>
	                </li>";
                      }else if($getApprovalLevel == 4){
                      
                      echo "<li>
	                    <a href='".base_url()."home/myapproval'>
	                        <i class='material-icons'>person</i>
	                        <p>Request for Approval</p>
	                    </a>
	                </li>
	                
                        <li>
	                    <a href='".base_url()."home/myrequest'>
	                       <i class='material-icons'>mouse</i>
	                        <p>My Reimbursement</p>
	                    </a>
	                </li>
                        <li>
	                    <a href='".base_url()."home/mytill'>
	                       <i class='material-icons'>local_atm</i>
	                        <p>My Till</p>
	                    </a>
	                </li>";
                      
                      }else if($getApprovalLevel == 3){
                           echo "<li>
	                    <a href='".base_url()."home/myapproval'>
	                        <i class='material-icons'>person</i>
	                        <p>Request for Approval</p>
	                    </a>
                            </li>
                            
                            <li>
	                    <a href='".base_url()."travels/oooOOOflight_NOW67482h2O'>
	                       <i class='material-icons'>rotate_90_degrees_ccw</i>
	                        <p>Flights</p>
	                    </a>
                            </li>
                            
                            
                            <li>
	                    <a href='".base_url()."home/allicurequest'>
	                        <i class='material-icons'>rotate_90_degrees_ccw</i>
	                        <p>Approved Request</p>
	                    </a>
                            </li>
                            ";
                      }else if($getApprovalLevel == 2){
                          echo "<li>
	                    <a href='".base_url()."home/myapproval'>
	                        <i class='material-icons'>person</i>
	                        <p>Request for Approval</p>
	                    </a>
	                </li>";
                      }else if($getApprovalLevel == 7){
                          echo "<li>
	                    <a href='".base_url()."accounts/index'>
	                        <i class='material-icons'>person</i>
	                        <p>Request for Approval</p>
	                    </a>
	                </li>
	                
                        <li>
	                    <a href='".base_url()."home/allcheques'>
	                        <i class='material-icons'>style</i>
	                        <p>All Cheques</p>
	                    </a>
	                </li>
                       <!-- <li>
	                    <a href='".base_url()."home/printoutcheques'>
	                       <i class='material-icons'>print</i>
	                        <p>Printout Cheque</p>
	                    </a>
	                </li>-->"; 
                          
                      }else if($getApprovalLevel == 1){
                           echo "<li>
	                    <a href='".base_url()."home/myapproval'>
	                        <i class='material-icons'>person</i>
	                        <p>Request for Approval</p>
	                    </a>
	                </li>";
                      }else{
                          echo "";
                      }
                     ?>  
                    
                    <!--ASSET MANAGEMENT APPROVALS BEGINS HERE -->
                  
                    <!--END OF ASSET MANAGEMENT APPROVALS BEGINS HERE -->
                     
                   <?php 
                  /* $getassetmaintenance = $this->generalmd->getuserAssetLocation("userIDs", "access_gen", "id", "10");
                   $myassetomaintenance = $this->gen->haveAccess($_SESSION['id'], $getassetmaintenance);
                   if($myassetomaintenance == TRUE){
                          
                            echo" <li>
                                  <a href='".base_url()."assetmgt/joborder'>
                                      <i class='material-icons'>chrome_reader_mode</i>
                                      <p>Asset Maintenance</p>
                                  </a>
                              </li>";
                            }else{
                            echo "";
                          }
                   * 
                   */
                      ?>
                    
                     <?php 
                         if($getApprovalLevel == 2){
                          
                       echo"
                        <li>
	                    <a href='".base_url()."home/hodapprovalrequest'>
	                        <i class='material-icons'>album</i>
	                        <p>Approved Request</p>
	                    </a>
	                </li>
                        ";
                                }
                      ?>

                    <?php 
                    $icusessionID = $_SESSION['id'];
                        
                        if( $icusessionID == 84 ||  $icusessionID == 83){
                          
                       echo"
                        <li>
	                    <a href='".base_url()."home/cashierlimit'>
	                        <i class='material-icons'>recent_actors</i>
	                        <p>Create Till(Cashiers)</p>
	                    </a>
	                </li>
                        ";
                       }
                    ?>
                    
                    <?php 
                         if($getApprovalLevel == 4){
                          
                       echo"
                        
                        <!--<li>
                            <a href='".base_url()."home/report'>
                                <i class='material-icons'>schedule</i>
                                  <p>Report</p>
                            </a>
                        </li>-->
                        ";
                                }
                      ?>
                      
                    
                       
                   
                     
                      <?php 
                      //<a href='".base_url()."travels/xdmds_xn'>
                       $getTravelAccess = $this->users->getUsertravelstartaccess();
                       $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
                        if($getApprovalLevel == 6 || $whichAcess == TRUE){
                            echo " <li>
                            <a href='".base_url()."travels/Dxk_udYz'>
                                 <i class='material-icons'>bubble_chart</i>
                                  <p>Travel Start</p>
                            </a>
                        </li>";
                        }else{
                             echo "<li>
                            <a href='".base_url()."travels/xdmds_xn'>
                                 <i class='material-icons'>bubble_chart</i>
                                  <p>Travel Start</p>
                            </a>
                        </li>";
                        }
                       
                     ?>
                     
                    
                     
                   
                    
                     
                     <?php
                     $myRecievables = $this->users->getRecievables();
                       $whichRecivable = $this->gen->haveAccess($_SESSION['id'], $myRecievables);
                       if($getApprovalLevel == 6 || $whichRecivable == TRUE || $getApprovalLevel == 2){
                            echo " <li>
                            <a href='".base_url()."recieveables'>
                                 <i class='material-icons'>bubble_chart</i>
                                  <p>Retirement</p>
                            </a>
                        </li>";
                        }
                     ?>
                     
                  
                     
                      <?php 
                         echo "
                             <li>
                                 <a href='".base_url()."vendors/index'>
                                     <i class='material-icons'>album</i>
                                     <p>Vendor Management</p>
                                 </a>
                             </li>
                             ";
                           
                    ?>
                    
                    
                     <?php
                      $getResult = $this->generalmd->getdresult("*", "main_menu", "menu_place", "1");
                      $sessionID = $this->session->id;
                       
                      foreach($getResult as $get){
                          $userid = $get->userid;
                          $menu_id = $get->id;
                          $doexplode = explode(",", $userid);
                          if(in_array($sessionID, $doexplode)){
                              echo "
                             <li>
                                  <a href='".base_url()."$get->menu_link/$menu_id'>
                                     <i class='material-icons'>$get->menu_icon</i>
                                     <p>$get->Name</p>
                                 </a>
                             </li>
                             ";
                          }
                      }
                     
                     ?>
                     
                      <?php 
                     $accgroupHERTZ = $this->cashiermodel->actgrouphertz() ? $this->cashiermodel->actgrouphertz() : "";
                     $mySession = trim($_SESSION['id']);
                     $getuseridfromhereHERTZ = $this->gen->haveAccess($mySession, $accgroupHERTZ);
                        if($mySession == 97){
                         // if($getuseridfromhereHERTZ == TRUE){
                            echo "
                             <li>
                                 <a href='".base_url()."paycheques/paychequehertz'>
                                     <i class='material-icons'>album</i>
                                     <p>Pay Cheques(HERTZ)</p>
                                 </a>
                             </li>
                             ";
                           }else {
                            echo "";
                        }
                    ?>
                     
                     
                     
                     
                     
	            </ul>
	    	</div>
                    
                    
		