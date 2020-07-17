<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9 no-js" lang="en"><![endif]-->
<!--[if gt IE 9 | !IE]><!-->
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>C&I Money Book</title>
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
           TBS - EXPENSE PRO
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

      <div id="homeBgImg" data-bg-img="<?php echo base_url(); ?>public-other/media/lagosci.jpg"></div> <!-- #homeBgImg -->

      <div id="" class="bg-black" ></div> <!-- #homeBgOverlay -->

      <div class="align-inner align-middle">
        <div class="container">
          <div class="home-row row">
            <div class="home-left-col col-sm-6">
              <!--<h1 class="text-animate section-title">Hello! Welcome to Money Book cash transaction app</h1>

              <p class="text-lead wow fadeInUp">Design to help you raise request, manage cashier's till and cheque requistion, plus much more</p>-->
              <div class="btn-wrap">
                <!--<a class="btn btn-lg btn-theme-2 wow bounceIn" data-wow-delay=".2s" data-smooth-scroll="true" href="#download">Get The App <span class="icon ti-arrow-circle-down"></span></a>-->
               <!-- <a class="btn btn-lg btn-default wow bounceIn" data-wow-delay=".2s" data-smooth-scroll="true" href="#service">Learn More <span class="icon ti-arrow-circle-down"></span></a> -->
              </div>
            </div> <!-- .home-left-col -->
            
             <div id="register" class="home-form-col col-sm-6 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2">
              <div class="panel panel-theme-2 wow fadeInUp">
                <div class="panel-heading">
                  <h5>Registration</h5>
                </div>

                <div class="panel-body">
                    <span id="reg_error"></span>
                  <form role="form" id="mainRegFom" action="" method="post"  class="form home-subscribe-form form-lite" onsubmit="return false;">
                    <fieldset class="row">
                      
                      <div class="form-group col-xs-6">
                        <label for="homeSubscribeEmail1">Firstname</label>
                        <input  name="fName" placeholder="First Name" class="form-username form-control" id="fName">
                      </div>
                        
                        <div class="form-group col-xs-6">
                        <label for="homeSubscribeEmail1">Lastname</label>
                        <input type="text" name="lname" placeholder="Last Name" class="form-username form-control" id="lname">
                      </div>
                        
                         <?php 
                                                $getcat = $this->mainlocation->getalllocation();
                                                
                                                 if ($getcat) { 
                                                $aloc = "";
                                                foreach ($getcat as $get) {

                                                    $id = $get->id;
                                                    $locationName = $get->locationName;
                                                    $aloc .= "<option  value=\"$id\">" . $locationName . '</option>';
                                                     }
                                                 }
                                   
                                           ?>
                      <div class="form-group col-xs-6">
                        <label for="homeSubscribeEmail1">Location</label>
                        <select class="form-control" id="sLocation" name="sLocation">
                                                            <option>Selection Location</option>
                                                            <?php echo $aloc; ?>
                          </select>
                      </div>
                        
                         <?php 
                                                $getunit = $this->mainlocation->getallunit();
                                                
                                                 if ($getunit) { 
                                                $dunit = "";
                                                foreach ($getunit as $get) {

                                                    $id = $get->id;
                                                    $unitName = $get->unitName;
                                                    $dunit .= "<option  value=\"$id\">" . $unitName . '</option>';
                                                     }
                                                 }
                                   
                                           ?>
                        <div class="form-group col-xs-6">
                        <label for="homeSubscribeEmail1">Unit</label>
                        <select class="form-control" id="sUnit" name="sUnit">
                                                            <option>Selection Unit</option>
                                                            <?php echo $dunit; ?>
                                                        </select>
                      </div>
                        
                        
                        <div class="form-group col-xs-12">
                        <label for="homeSubscribeEmail1">Email</label>
                        <input type="text" name="semailAddress" placeholder="Email Address" class="form-username form-control" id="semailAddress">
                      </div>

                         <div class="form-group col-xs-6">
                        <label for="homeSubscribeEmail1">Password</label>
                        <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="password">
                      </div>
                        
                         <div class="form-group col-xs-6">
                        <label for="homeSubscribeEmail1">Confirm Password</label>
                        <input type="password" name="confPassword" placeholder="Password..." class="form-password form-control" id="confPassword">
                      </div>
                      
                      <div class="form-group col-xs-12">
                          
                        <button class="btn btn-block btn-sm btn-theme-2" id="register">Register</button>
                      </div>

                      <div class="col-xs-12" id="mainbuttonaccount">
                          <span class="form-notify help-block"><span class="icon ti-lock"></span> Already have an account - <a href="<?php echo base_url() ?>">Login</a></span>
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

  
  

</body>


</html>