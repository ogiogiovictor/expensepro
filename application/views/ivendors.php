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
                        
                    <div class="col-md-12">     
                        <div class="card">
                                <div class="card-header text-center" data-background-color="red">
                                    <h4 class="title">ALL BENEFICIARY / VENDORS</h3>
                                    
                                </div>
                       
                         
                            <hr/>
                            
                            
                            
                             <div class="card-content">
                                <div  id="load_data"></div>
                                <div  id="load_data_message"></div>
                                <span id="disposebox"></span>
                            </div>
                           
                            
                            
                        </div>
                    </div>
                         <!-- End of Request Details with Status -->
                       
                            
	                </div>
	            </div>
	        </div>
            <!-- Main Outer Content Ends  Here -->  
                
 <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>              
 <script>
    $(document).ready(function(){
        
        var limit = 10;
        var start = 0;
        var action  = "inactive";
      
        function load_vendors(limit, start){
            
            $.ajax({
                url : GLOBALS.appRoot+"accountcode/loadmorevendors",
                method : "POST",
                data: {limit:limit, start:start},
                cache: false,
                success: function (data){
                    $('#load_data').append(data);
                    if(data == ''){
                          $('#load_data_message').html("<button class='btn btn-xs btn-danger'>No Data \n\
                            Found</button>");
                            action = 'active';
                    }else{
                         $('#load_data_message').html("<button class='btn btn-xs btn-danger'>Please wait.....</button>");
                         action = 'inactive'; 
                    }
                }
                
            })
        }
        
        
        if(action == 'inactive'){
           action = 'active';
           load_vendors(limit, start);
        }
        
      $(parent.window.document).scroll(function() {
    alert("bottom!");
});
    
        $(window).scroll(function(){;
            if($(window).scrollTop())
            {
                alert('mission accomplished');
            }
        });
      
       $(window).scroll(function(){
            if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive'){  
                action = 'active';
                start = start + limit;
                setTimeout(function(){
                 load_vendors(limit, start);
                }, 1000);
            }
        });
        
        
    }); 
    
  
 </script>
   <?php echo $footer; ?>