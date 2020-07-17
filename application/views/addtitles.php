
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
                                    <h4 class="title">&nbsp;&nbsp;ADD TITLE</h3>
                                    <p class="category">All titles</p>
                                    <span id="showError"></span>
                                </div>
                       
                            <div class="pull-right" style="margin-right:20px">
                                <button class="btn btn-xs btn-facebook"  id="addCode">ADD</button>
                                <a href="<?php echo base_url(); ?>"><button class="btn btn-xs btn-danger" >Close</button></a>
                            </div>
                            <div style="clear:both"></div> 
                            
                            
                             <div id="open">
                                <?php
                                 $getcat = $this->mainlocation->getalltitles();
                                
                                if($getcat){
                                    echo "<table class='table table-striped table-responsive'><tr><th>S/N</th><th>Title</th><th>Created By</th></tr>";
                                    foreach($getcat as $get){
                                      $id = $get->id;
                                       $titleName = $get->titleName;
                                      $sessionID = $get->sessionID;
                                       
                                     echo "<tr><td>$id</td><td>$titleName</td><td>$sessionID</td></tr>";
                                    }
                                }
                                
                                echo "</table>";
                                ?>
                                
                            </div>
                            
                            
                             <div class="card-content">
                                <div class="closing" id="mainformclick">
                                   
                                    <!-- Beginnin of Form -->
                                    
                                     <form name="forLocale" id="forLocale" method="POST" onSubmit="return false;">
	                                   
                                                <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Enter Title</label>
                                                    <input type="text" name="dtitle" id="dtitle" class="form-control" />
                                                    </div>
	                                        </div>
                                         
                                         
                                                                                  
                                          <div class="col-md-12">
                                              <center><input id="addNewtitle" type="submit" class="btn btn-primary" /></center>
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