                
                <!-- Footer Begins Here -->
          <style type="text/css">
            .cookie-container{
                position: fixed;
                bottom: -100%;
                left:0;
                right:0;
                background:#2f3640;
                color:#f5f6fa;
                padding:10px 32px;
                z-index: 333333;
                transition: 400ms;
                box-shadow: 0 -2px 16px rgba(47, 54, 64, 0);
            }
            
            .cookie-container.active{
                bottom : 0;
            }
            
             .cookie-container a{
                 color:#f5f6fa; 
             }
             .cookie-btn {
                background-color: #113c7f;
                border:0;
                color:#f5f6fa;
                padding:10px 12px;
                font-size: 12px;
                margin-bottom: 16px;
                border-radius: 8px;
                cursor: pointer;
                
             }
        </style>      
        
        
        
        <!--<div class="cookie-container">
            <p>
                "We use cookies to enhance your activities and preferences on our website and to make your visit to the site is efficient.  
                <br/>By browsing our website, you consent to our use of cookies in accordance with our <a href="#">Cookie Policy.</a>"
             
            </p>
            <button class="cookie-btn">Agree</button>
        </div>-->
                
                
                    <footer class="footer">
                        <div class="container-fluid">
                            <nav class="pull-left">
                                <ul>
                                    <li>
                                        <a href="#">
                                            &nbsp;
                                        </a>
                                    </li>

                                </ul>
                            </nav>
                            <p class="copyright pull-right">
                                &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.c-ileasing.com">C & I Leasing PLC</a>, TBS-Expense Pro
                            </p>
                        </div>
                    </footer>
                  <!-- Footer Ends Here -->
                
	    </div>
	</div>

</body>

	<!--   Core JS Files   -->
	<!--<script src="<?php echo base_url(); ?>public/assets/js/jquery1.11.2-min.js" type="text/javascript"></script>-->
       
 <script type="text/javascript">
            const cookieContainer = document.querySelector(".cookie-container");
            const cookieButton = document.querySelector(".cookie-btn");
            
            cookieButton.addEventListener("click", () => { 
               cookieContainer.classList.remove("active");
               localStorage.setItem("cookieBannerDisplayed", true);
            });
            
            setTimeout( () => {
                if(!localStorage.getItem("cookieBannerDisplayed")){
                   cookieContainer.classList.add("active");  
                }
              
            }, 2000);
            
        </script>
        
	<!--  Charts Plugin -->
	<script src="<?php echo base_url(); ?>public/assets/js/chartist.min.js"></script>

	<!--  Notifications Plugin    -->
	<script src="<?php echo base_url(); ?>public/assets/js/bootstrap-notify.js"></script>

	<!--  Google Maps Plugin    -->
	<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>-->

        <!-- Material Dashboard javascript methods -->
	<script src="<?php echo base_url(); ?>public/assets/js/material-dashboard.js"></script>
        
        <!-- Bootstrap Multi Select -->
	<script src="<?php echo base_url(); ?>public/multiselect/js/bootstrap-select.js"></script>
        
        
        <!-- My General Script for Expense Pro  -->
        <script src="<?php echo base_url(); ?>public/javascript/ajax.js"></script>
        <script src="<?php echo base_url(); ?>public/javascript/global.js"></script>
        <script src="<?php echo base_url(); ?>public/javascript/main.js"></script>
        <script src="<?php echo base_url(); ?>public/javascript/general.js"></script>
        <script src="<?php echo base_url(); ?>public/javascript/admin.js"></script>
        <script src="<?php echo base_url(); ?>public/javascript/toggleClass.js"></script>
         <script src="<?php echo base_url(); ?>public/javascript/approval.js"></script>
         <script src="<?php echo base_url(); ?>public/javascript/asset.js"></script>

	<!-- Material Dashboard DEMO methods, don't include it in your project! -->
	<!--<script src="<?php echo base_url(); ?>public/assets/js/demo.js"></script>-->

        <!-- DATE PICKER JS -->
        <script src="<?php echo base_url(); ?>public/assets/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
	 $('.datepicker').datepicker({
		 //dateFormat: 'yy-mm-d',
		 format: 'yyyy-mm-dd',
    	 weekStart:1,
    	 color: 'red'
	 });
	</script>
	
	<!--<script src="<?php echo base_url(); ?>public/javascript/datatablebuttons.js"></script>
        <script src="<?php echo base_url(); ?>public/javascript/datatableflash.js"></script>
        <script src="<?php echo base_url(); ?>public/javascript/makepdfdata.js"></script>-->
        
        
      
         <script type="text/javascript" src="<?php echo base_url(); ?>public/pdfmaker/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/pdfmaker/jszip.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/pdfmaker/pdfmake.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/pdfmaker/vfs_fonts.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/pdfmaker/buttons.html5.min.js"></script>
      <!--
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
      -->
        
        
        <!--<srcipt type="text/javascript"  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.colVis.min.js"></script>--> 
         <!--<script>
        $(document).ready(function(){
             $('#mydata').DataTable({
           dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ]
       });
        })
        </script>-->
        
         <script src="<?php echo base_url(); ?>public/javascript/travels.js"></script>
        
      <script type="text/javascript">
       $('.mySelect').selectpicker({
           style: 'btn-primary',
	          size: 4
	      });
	</script>
        
       
    
</html>
