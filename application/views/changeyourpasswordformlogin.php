<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>C & ILeasing PLC</title>

        <!-- CSS -->
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public-other/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public-other/assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public-other/assets/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public-other/assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong><!--Petty Cash --></strong></h1>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                                            <h3>Password Reset Expense Pro <br/><small>Cash Transaction</small> </h3>
                            		<p>Enter Your New Password</p>
                                        <span id="ci_error"></span>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
                                
                            
                                
<!-- ////////////////////////////////////////THIS IS THE FORGOT / RESET PASSWORD /////////////////////////////////-->


                        <div id="forth">
                             <h4 class="title">PASSWORD RESET FORM</h4>
                                    <form name="changingthepass" id="changingthepass" enctype="multipart/form-data" method="POST" onSubmit="return false;"> 
                                           
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">New Password</label>
			                        	<input type="password" name="password1" id="password1" placeholder="New Password" class="form-username form-control">
			                        </div>
                                        
                                                <div class="form-group">
			                    		<label class="sr-only" for="form-username">Confirm Password</label>
			                        	<input type="password" name="password2" id="password2" placeholder="Confirm New Password" class="form-username form-control">
			                        </div>
			                       
                                                 <div>  
                                                    <span id="errorCase"></span>
                                                    <input type="hidden" value="<?php echo $ids; ?>" name="ids" id="ids" />
                                                    <input type="hidden" value="<?php echo $uemail; ?>" name="uemail" id="uemail" />
                                                    <input type="submit" name="resettingthepassword" id="resettingthepassword" value="Reset Password" class="btn btn-sm btn-facebook btn-google" />
                                                </div>
                                                
                                                
			                    </form>
                        </div>

<!--///////////////////////////////////////END OF RESET/FORGOT PASSWORD //////////////////////////////////////// -->
                                
		                    </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="<?php echo base_url(); ?>public-other/assets/js/jquery-1.11.3.min.js"></script>
        <script src="<?php echo base_url(); ?>public-other/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>public-other/assets/js/jquery.backstretch.min.js"></script>
        <script src="<?php echo base_url(); ?>public/javascript/main.js"></script>
        <script src="<?php echo base_url(); ?>public-other/assets/js/scripts.js"></script>
        <script src="<?php echo base_url(); ?>public-other/assets/js/validation.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>