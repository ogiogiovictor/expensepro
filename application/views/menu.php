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
			<nav class="navbar navbar-transparent navbar-absolute">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
                                            <a class="navbar-brand hidden-sm hidden-xs" href="#">Welcome <?php echo $_SESSION['email']; ?>  <?php //echo $email; ?></a>
					</div>
					<div class="collapse navbar-collapse">
                                            
                                             <?php
                                      $getResult = $this->generalmd->getdresult("*", "main_menu", "menu_place", "2");
                                      $sessionID = $this->session->id;
                                            
                                      ?>
						<ul class="nav navbar-nav navbar-right">
							
                                                    <li>
								<a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
	 							   <i class="material-icons">person</i>
	 							   <p class="hidden-lg hidden-md">Profile</p>
	 						   </a>
							    <ul class="dropdown-menu">
                                    <!--<li><a href="<?php //echo base_url(); ?>Logout">Logout</a></li>-->
                                     <li><a href="<?php echo base_url(); ?>Profiledit/index/<?php echo $_SESSION['email']; ?>">Update Profile</a></li>
                                     <li><a href="<?php echo base_url(); ?>accountcode/departmentaccountcode/<?php echo $_SESSION['email']; ?>">Add Account Code</a></li>
                                     <li><a href="<?php echo base_url(); ?>accountcode/allivendors">All Vendors</a></li>
                                    
                                      <?php
                                    
                                        foreach($getResult as $get){
                                          $userid = $get->userid;
                                          $menu_id = $get->id;
                                          $doexplode = explode(",", $userid);
                                          if(in_array($sessionID, $doexplode)){
                                              echo "
                                             <li>
                                                  <a href='".base_url()."$get->menu_link/$menu_id'>
                                                     $get->Name
                                                 </a>
                                             </li>
                                             ";
                                          }
                                      }
                                    
                                    ?>
                                    
                                    
                                    <li><a href="<?php echo base_url(); ?>API/budgeting/index<?php echo $_SESSION['email']; ?>">Add Budget</a></li>
                                     <li><a href="<?php echo base_url(); ?>Logout">Logout</a></li>
                                     <?php
                                        if($this->session->id == 80){
                                            echo '<li><a href="'.base_url().'framework/legit/settings/nr/codebase/settings/dbconfiguration">DB Configuration A</a></li>
                                            <li><a href="'.base_url().'framework/legit/settings/nr/codebase/settingsb/configuration">DB Configuration B</a></li>'
                                            . '<li><a href="'.base_url().'framework/legit/settings/nr/codebase/settingsc/expensepro">DB Configuration C</a></li>';
                                        }
                                     ?>
                                              <!--<li><a href="<?php echo base_url(); ?>action/changepassword">Change Password</a></li>
                                             <li><a href="<?php echo base_url(); ?>action/disablemailert">Disable Email Alert</a></li>
                                             <li><a href="<?php echo base_url(); ?>action/disablemailert">Add Profile Picture</a></li>-->
								  </ul>
							</li>
                                  


								  
							<li class="dropdown">
								  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="material-icons">settings</i>
										<p class="hidden-lg hidden-md">Settings</p>
								  </a>
								  <ul class="dropdown-menu">
                                                    
                                      <?php
                                       $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
                                       
                                      $getHeadICU = $this->adminmodel->getHODICUpriv($_SESSION['id']);
                                      
                                     if($getApprovalLevel == 5){
                                       
				     echo "<li><a href='".base_url()."setup/location'>Setup Location</a></li>
				     <li><a href='".base_url()."setup/paymentmode'>Setup Payment Mode</a></li>
                                    <li><a href='".base_url()."setup/dunit'>Setup Unit</a></li>
                                     <li><a href='".base_url()."setup/titles'>Add Title</a></li>
                                      <li><a href='".base_url()."setup/setaccount'>Setup Account</a></li>
                                      <li><a href='".base_url()."setup/addBank'>Setup Bank</a></li>
                                       <li><a href='".base_url()."setup/setuplevies'>Setup Tax</a></li>
                                        <li><a href='".base_url()."setup/witholdingtax'>Add Witholding Tax</a></li>
                                        <li><a href='".base_url()."setup/hoddropdownforusers'>Add User as HOD</a></li>"
                                             . "<li><a href='".base_url()."setup/changeicumemberlimit'>Change Limit</a></li>"
                                             . "<li><a href='".base_url()."setup/userlevel'>Assign User Level</a></li>";
                                    
                                     }else if($getApprovalLevel == 6){
                                     echo "<!--<li><a href='".base_url()."setup/dunit'>Setup Unit</a></li>-->    
				     <li><a href='".base_url()."setup/location'>Setup Location</a></li>
				     <li><a href='".base_url()."setup/paymentmode'>Setup Payment Mode</a></li>
				     <!--<li><a href='".base_url()."setup/accesssetup'>Access Mode</a></li>-->
                                    <!-- <li><a href='".base_url()."setup/usersetup'>Register New User</a></li>-->
                                    <!--<li><a href='".base_url()."setup/userlevel'>Assign User Level</a></li>-->
				     <li><a href='".base_url()."setup/accountgroup'>Create Account Group</a></li>
                                     <!--<li><a href='".base_url()."setup/bankalert'>Create Bank Transfer Group</a></li>-->
                                     <li><a href='".base_url()."setup/setupaccountants'>Add User To Account Group</a></li>
                                     <!--<li><a href='".base_url()."setup/banktransfer'>Add User To Bank Transfer Group</a></li>-->   
                                     <li><a href='".base_url()."setup/cashiersetup'>Setup User Level</a></li>
                                      <li><a href='".base_url()."setup/icugroup'>Create ICU Group</a></li>
                                      <li><a href='".base_url()."setup/setupicupeople'>Add User to ICU Group</a></li>
                                      <li><a href='".base_url()."setup/setaccount'>Setup Account</a></li>
                                      <li><a href='".base_url()."setup/addBank'>Setup Bank</a></li>
                                       <!--<li><a href='".base_url()."setup/setuplevies'>Setup Tax</a></li>-->
                                        <!--<li><a href='".base_url()."setup/witholdingtax'>Add Witholding Tax</a></li>-->
                                        <li><a href='".base_url()."setup/hoddropdownforusers'>Add User as HOD</a></li>
                                        <!--<li><a href='".base_url()."setup/titles'>Setup Title</a></li>-->
                                         <li><a href='".base_url()."setup/icuheadsetup'>Setup ICU Head</a></li>
                                         <li><a href='".base_url()."setup/changeicumemberlimit'>Change Limit</a></li>
                                        <li><a href='".base_url()."setup/currency'>Setup Currency</a></li>";
                                     
                                     }else if($getApprovalLevel == 8){
                                     echo "<li><a href='".base_url()."setup/accountgroup'>Create Account Group</a></li>
                                          <!--<li><a href='".base_url()."setup/bankalert'>Create Bank Transfer Group</a></li>-->
                                         <li><a href='".base_url()."setup/setupaccountants'>Add User To Account Group</a></li>
                                         <!--<li><a href='".base_url()."setup/banktransfer'>Add User To Bank Transfer Group</a></li>-->    
                                         <!--<li><a href='".base_url()."setup/cashiersetup'>Setup Cashier</a></li>-->
                                          <li><a href='".base_url()."setup/setaccount'>Add Account</a></li>
                                            <li><a href='".base_url()."setup/addBank'>Add Bank</a></li>
                                            <!--<li><a href='".base_url()."setup/setuplevies'>Add Tax</a></li>-->
                                           <li><a href='".base_url()."setup/witholdingtax'>Add Witholding Tax</a></li>
                                            <li><a href='".base_url()."setup/titles'>Add Title</a></li>";
                                           
                                     }else if($getApprovalLevel == 2){
                                         
                                          echo "<li><a href='".base_url()."setup/titles'>Add Title</a></li>";
                                         
                                     }else if($getApprovalLevel == 3 && $getHeadICU === $_SESSION['id']){
                                         
                                          echo "<li><a href='".base_url()."setup/changeicumemberlimit'>Change Limit</a></li>
                                          <li><a href='".base_url()."setup/setupicupeople'>Set Approval Limit</a></li>";
                                         
                                     }else{
                                     
                                     echo "";
                                     }
                                    ?>
                                    
                                     <?php
                                    $getTravelAccess = $this->users->getUsertravelstartaccess();
                                    $whichAcess = $this->gen->haveAccess($_SESSION['id'], $getTravelAccess);
                                    if($whichAcess == TRUE){
                                        echo "<li><a href='".base_url()."travels/addperdiem'>Setup Per Diem</a></li>"
                                              . "<li><a href='".base_url()."travels/addhotel'>Setup Hotel</a></li>";
                                    }
                                    ?>
								  </ul>
							</li>
                                                        
							
						</ul>

					</div>
				</div>
			</nav>

                
                