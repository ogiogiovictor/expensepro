
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="<?php echo base_url(); ?>assets/img/sidebar-1.jpg">

        <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
        -->
        <?php echo $sidebar; ?>

    </div>
    
    
    <script>
            
            var rpp = <?php echo $rrp; ?>;
            var last = <?php echo $last; ?>;
            //var nwlink = "<?php //echo $dLink; ?>";
            
            //alert(nwlink);
            
            function request_page(pn){
                var result_box = document.getElementById('results_box');  
                var pagination_controls = document.getElementById('pagination_controls'); 
                //var html_output = "";
               
               result_box.innerHTML = "<center><img style='width:200px' src='http://localhost/expensepro/public/images/meload.gif' /></center>";
               
               var hr = new XMLHttpRequest();
               hr.open("POST", "http://localhost/expensepro/travels/paginationparser", true);
              
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                //hr.setRequestHeader("Content-type", "application/json", true);
                hr.onreadystatechange = function(){
                    if(hr.readyState === 4 && hr.status === 200){
                       
                       var dataArray = JSON.parse(hr.responseText);
                       
                       for(var x=0; x<dataArray.length - 1; x++){
                           result_box.innerHTML = dataArray[x];
                            }
                      
                       var html_output = `<hr/><div style="float:right"><form onClick='return false;' style="margin-right:50px" class="form-inline">
                                            <div class="row">
                                                <div class="">
                                                     <label for="inputPassword6">Search</label>
                                     <input type="text" id="searchAll" class="form-controls mx-sm-3" />
                                                 </div>
                                             </div>
                                            </form></div>
                                            <table class="table table-responsive table-bordered table-hover">
                                                <thead class="text-primary">
                                                    <th>ID</th>
                                                      <th>Date Created</th>   
                                                     <th>User Name</th>
                                                    <th>From </th>
                                                    <th>To</th>
                                                    <th>StartDate</th>
                                                     <th>EndDate</th>
                                                     <th>Approved</th>
                                                     <th>Verified</th>
                                                     <th>Book Flight</th>
                                                      </thead><tbody>`;
                        for(var x = dataArray.length - 1; x >=0;  x--){
                           
                          var bookFlight =  dataArray[x].processFlight === "yes" ? '<span class="btn btn-xs btn-success">'+dataArray[x].processFlight+'</span>' : 
                                  '<span class="btn btn-xs btn-danger">'+dataArray[x].processFlight+'</span>';
                               
                               
                            html_output += "<tr><td>"+ dataArray[x].tid +"</td><td>"+ dataArray[x].dateCreated +"</td><td>"+ dataArray[x].travelStart_ID +"</td>\n\
                                <td>"+ dataArray[x].tFrom +"</td><td>"+ dataArray[x].tTo +"</td><td>"+ dataArray[x].exsDate +"</td><td>"+ dataArray[x].exrDate +"</td>\n\
                                <td>"+ dataArray[x].hodwhoapprove +"</td><td>"+ dataArray[x].icuwhoapprove +"</td><td>"+ bookFlight +"</td></tr>";
                        }
                          html_output += `</tbody></table>`;
                        result_box.innerHTML = html_output;
                    }
                }
                hr.send("rpp="+rpp+"&last="+last+"&pn="+pn);
                
                //Change the Pagination controls
                var paginationCtrls = "";
                // Only if there is more than 1 page worth of result give the user paination controls
                if(last !== 1){
                    if(pn > 1){
                        paginationCtrls +='<center><button class="btn btn-xs btn-primary" onclick="request_page('+(pn-1)+')">&lt;</button>';
                    }
                    paginationCtrls +='&nbsp; &nbsp; &nbsp;<b>Page '+pn+' of '+last+'</b> &nbsp; &nbsp; ';
                    if(pn !== last){
                        paginationCtrls +='<button class="btn btn-xs btn-primary" onclick="request_page('+(pn+1)+')">&gt;</button><center>';
                    }
                }
                pagination_controls.innerHTML = paginationCtrls;
            }
            
        </script>
        
        
        

    <div class="main-panel">

        <!-- Navigation Begins Here -->
        <?php echo $menu; ?>
        <!-- Navigation Ends Here -->


        <!-- Main Outer Content Begins Here --> 
        <div class="content">
            <div class="container-fluid">
                <div class="row">


                    <!-- Inside Content Begins  Here -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title"><i style="color:white; font-size:20px;" class="fa fa-plane" aria-hidden="true"></i> <span class="tastkform"><span style="color:white">ALL FLIGHT</span></span>&nbsp;<i class="fa fa-bus" aria-hidden="true"></i></h4>
                                
                               
                            </div>


                             
                                        <div id="results_box"></div> 
                                        <div id="pagination_controls"></div>  
                                       <script> request_page(1); </script>
                                         <hr/>
                            
                               
                    
                        </div>
                    </div>

                    <!-- End of Request Details with Status -->

                    <!-- Inside Content Ends Here -->
                     <!-- POP UP BOX HERE -->
                                   <div id="popup-box" class="popup-position">
                                       <div id="popup-wrapper">
                                           <div id="popup-container">
                                               <span class="pull-right"><a href="javascript:void(0)" onClick="toggle_visibility('popup-box');">close</a></span>
                                               <span id="eloaddformerror"></span>
                                               <span id="loaddepdetails"></span>
                                           </div>
                                       </div>
                                   </div>
                                   <!-- END OF POP UP BOX -->
                                   
                                   
                                   
                                   
                </div>


            </div>
        </div>
        <!-- Main Outer Content Ends  Here --> 
        <script>
   $(document).ready(function(){
      var output = document.getElementById('searchAll').onclick = function(){
           var searchAll = $('#searchAll').val();
           result_box.innerHTML = "<center><img style='width:200px' src='http://localhost/expensepro/public/images/meload.gif' /></center>";
           
           result_box.innerHTML = searchAll;
      };
      
     
    });
</script>                 
        <?php echo $footer; ?>
