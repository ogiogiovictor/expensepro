<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9 no-js" lang="en"><![endif]-->
<!--[if gt IE 9 | !IE]><!-->
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>C&I Expense Pro</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">
  <!--<link rel="icon" href="assets/img/favicon.ico">-->
  <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic'>
  <link rel='stylesheet' href='<?php echo base_url(); ?>public-other/assets/css/bootstrap.min.css'>
  <link rel='stylesheet' href='<?php echo base_url(); ?>public-other/assets/css/vendor.css'>

  <!--
    edit to
    theme-1.css
    theme-2.css
    theme-3.css
    theme-4.css
    theme-5.css
    theme-6.css
  -->
  <link rel='stylesheet' href='<?php echo base_url(); ?>public-other/assets/css/theme-4.css' id="theme">

  <link rel='stylesheet' href='<?php echo base_url(); ?>public-other/assets/css/custom.css'>
  <script src='<?php echo base_url(); ?>public-other/assets/js/modernizr-2.8.3.min.js'></script>
</head>

<body>

  <div class="page-loader">
    <div class="spinner">
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
    </div>
  </div> <!-- .page-loader -->

 

  <header id="siteHeader" class="site-header site-header-fixed-top">
    <nav id="siteNavbar" class="navbar navbar-default navbar-fixed-top site-navbar-from-light-fg">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle-icon navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon ti-layout-grid3-alt"></span>
          </button>

          <a class="navbar-brand" href="#">
            <!--<img class="navbar-brand-media-light" src="assets/img/site-header-logo-light.png" alt="">-->
            TBS-EXPENSE PRO
            <div style="font-size:12px;"> Cash Transaction Register</div>
            <!--<img class="navbar-brand-media-dark" src="assets/img/site-header-logo-dark.png" alt="">-->
          </a>
        </div> <!-- .navbar-header -->

        <div class="collapse navbar-collapse" id="navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a  href="<?php echo base_url(); ?>login">Home</a></li>
            <li><a  href="<?php echo base_url(); ?>howorks">How it works</a></li>
            <li><a href="<?php echo base_url(); ?>register">Register</a></li>
          </ul>
        </div> <!-- .navbar-collapse -->
      </div>
    </nav>
  </header> <!-- .site-header -->

  <div class="main">
    <div id="home" class="home-section home-hero align-outer bg-theme-1">

      

      <div id="homeBgImg" data-bg-img="<?php echo base_url(); ?>public-other/media/newImages/20.jpg"></div> <!-- #homeBgImg -->
      
      <div id="" class="bg-black"></div> <!-- #homeBgOverlay  <div id="homeBgOverlay" class="bg-black" data-opacity=".6"> -->

      <div class="align-inner align-middle">
        <div class="container">
          <div class="home-row row">
            <div class="home-left-col col-sm-6">
                <span class="text-animate section-title">OUR SOLUTION</span><br/>

             <h1>TBS-EXPENSE PRO
  <span class="typer" id="main" data-words="Approval System,Till Management,Cheque Management,Part Payment, TravelStart" data-colors="white" data-delay="100" data-deleteDelay="1000"></span>
  <span class="cursor" data-owner="main"></span>
</h1>
                 <!--<span class="typer text-lead wow fadeInUp" id="main" data-words="Approval System,Till Management,Cheque Management,TravelStart, And lots more.." data-colors="white" data-delay="100" data-deleteDelay="1000">Let the Easter eggs
                     <span class="cursor" data-owner="main"></span>
                 </span>-->
                
             <span class="text-lead wow fadeInUp"> And lots more..</span>
              <div class="btn-wrap">
               <!-- <a class="btn btn-lg btn-theme-2 wow bounceIn" data-wow-delay=".2s" data-smooth-scroll="true" href="#download">HAPPY EASTER <span class="icon ti-arrow-circle-down"></span></a>-->
                <!--<img src="<?php echo base_url(); ?>public-other/media/newImages/ci.jpg" style="width:100px" />-->
                <!-- <a class="btn btn-lg btn-default wow bounceIn" data-wow-delay=".2s" data-smooth-scroll="true" href="#service">Learn More <span class="icon ti-arrow-circle-down"></span></a> -->
              </div>
            </div> <!-- .home-left-col -->
            
            
            

            <div id="slogin" class="home-form-col col-sm-6 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2">
              <div class="panel panel-theme-2 wow fadeInUp">
                <div class="panel-heading">
                  <h5>Login Credentials</h5>
                </div>

                <div class="panel-body">
                  <form id="mainLogin" class="form home-subscribe-form form-lite" action="" method="post" onsubmit="return false;">
                    <fieldset class="row">
                      
                      <div class="form-group col-xs-12">
                        <label for="homeSubscribeEmail1">Email</label>
                        <input type="email" required name="email" placeholder="Email Address" class="form-username form-control" id="email">
                      </div>
                        
                        <div class="form-group col-xs-12">
                        <label for="homeSubscribeEmail1">Password</label>
                        <input type="password" required autocomplete="off" name="password" placeholder="Password" class="form-password form-control" id="password">
                      </div>

                      <!--<div class="form-group col-xs-12">
                        <div class="checkbox">
                          <label for="agree">
                            <input id="agree" name="agree" type="checkbox"> <a href="#" class="popup-inline" data-mfp-src="#termsOfService">Remember me</a>
                          </label>
                        </div>
                      </div>-->

                      <div class="form-group col-xs-12">
                           <span id="ci_error"></span>
                        <button class="btn btn-block btn-lg btn-theme-2" id="btnloginauthenticate">Login</button>
                      </div>

                      <div class="col-xs-12" id="forgotpassme">
                        <span class="form-notify help-block"><span class="icon ti-lock"></span> Forgot password? <a href="<?php echo base_url(); ?>login/forgetyourpassword" id="forgot" style="text-align: right; color:grey">Click here</a></span>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div> <!-- .home-form-col -->
            
            
            
            
          </div>
        </div>
      </div>
    </div> <!-- #home-->

   

    
    
    
    
    

  </div>



  <script src='<?php echo base_url(); ?>public-other/assets/js/jquery-1.11.3.min.js'></script>
  <script src='<?php echo base_url(); ?>public-other/assets/js/bootstrap.min.js'></script>
  <script src='<?php echo base_url(); ?>public-other/assets/js/vendor.js'></script>
  <script src='<?php echo base_url(); ?>public-other/assets/js/main.js'></script>
  <script src='<?php echo base_url(); ?>public-other/assets/js/map.js'></script>
  <script src='<?php echo base_url(); ?>public-other/assets/js/home.js'></script>
  <script src='<?php echo base_url(); ?>public-other/assets/js/scripts.js'></script>
  <script src='<?php echo base_url(); ?>public-other/assets/js/validation.js'></script>
  <script src='<?php echo base_url(); ?>public-other/assets/js/typer.js'></script>

  
  

</body>


</html>