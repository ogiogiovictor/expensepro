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
         
        </div> <!-- .navbar-collapse -->
      </div>
    </nav>
  </header> <!-- .site-header -->

  <div class="main">
    <div id="home" class="home-section home-hero align-outer bg-theme-1">

      <div id="homeBgImg" data-bg-img="<?php echo base_url(); ?>public-other/media/blurred-bg-21.jpg"></div> <!-- #homeBgImg -->

      <div id="" class="bg-black"></div> <!-- #homeBgOverlay  <div id="homeBgOverlay" class="bg-black" data-opacity=".6"> -->

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
            
            
            

            <div id="slogin" class="home-form-col col-sm-6 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2">
              <div class="panel panel-theme-2 wow fadeInUp">
                <div class="panel-heading">
                  <h5>Asset Management</h5>
                </div>

                <div class="panel-body">
                  
                    <h6>C & ILeasing Asset Management Application</h6><hr/>
                    <h4>Welcome <?php echo $fname; ?></h4>
                     <small><?php echo $email; ?></small>
                    
                     <form id="mainLogin" class="form home-subscribe-form form-lite" action="" method="post" onsubmit="return false;">
                    <fieldset class="row">
                      
                      
                        <input type="hidden" required name="email" value="<?php echo $email; ?>" id="email">
                        <input type="hidden" required name="id" value="<?php echo $id; ?>"  id="id">
                        <input type="hidden" required name="url" value="<?php echo current_url(); ?>"  id="url">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                
                      <div class="form-group col-xs-12">
                           <span id="ci_error" class="myMessageStatus"></span>
                           <?php 
                                if($haveAccess == 1 && $isLogged == 0){
                                    echo "<button class='btn btn-block btn-lg btn-theme-2' id='btnloginauthenticatenow'>Login Using Expense Pro Pass</button>";
                                }else if($haveAccess == 1 && $isLogged == 1){
                                    echo "<a href='http://localhost/maintenance/company/index' class='btn btn-block btn-lg btn-theme-2'>Click Here</a>";
                                }else{
                                    echo "<span class='glyphicon glyphicon-ok'></span>&nbsp; &nbsp;YOU DO NOT HAVE ACCESS TO USE EXPENSE PASS";
                                }
                           ?>
                        
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

  <script>
       $('#btnloginauthenticatenow').click(function (e) {
           var email = $('#email').val();
           var userid = $('#id').val()
           var url = $('#url').val();
           var csrf_test_name = $("input[name=csrf_test_name]").val();
           var dataString = new FormData(document.getElementById('mainLogin')); //postArticles
           if(email === "" || userid === ""){
               alert("Important Variable are missing. Contact I.T");
           }else{
               $('#btnloginauthenticatenow').html('Authenticating, Please wait &nbsp; <img src="http://localhost/expensepro/public/images/loading.gif" />');
               $.ajax({
                type: "POST",
                url:  "http://localhost/maintenance/login/findoutifexistinexpensepro",
                data: dataString,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'JSON',
                success: function (data) {
                     switch (data.status) {
                        case 4:
                        $('.myMessageStatus').html('<div class="alert alert-success" role="alert"><strong>Login Successful!</strong> '+ data.status +'</div>');
                        $('#btnloginauthenticatenow').hide();
                      //location.assign('http://localhost/maintenance/company/index');
                       window.open('http://localhost/maintenance/company/index', '_blank');
                      
                        break;
                         case 1:
                             $('.myMessageStatus').html('<div class="alert alert-warning" role="alert"><strong>Please enter a valid email address!</strong> '+ data.status +'</div>');
                             $('#btnloginauthenticatenow').show();
                            break;
                         case 2:
                            $('.myMessageStatus').html('<div class="alert alert-danger" role="alert"><strong>Incorrect Login Details, Please try again!</strong> '+ data.status +'</div>');
                             $('#btnloginauthenticatenow').show();
                            break;
                         case 3:
                            $('.myMessageStatus').html('<div class="alert alert-info" role="alert"><strong>You are not activated to use this module please contact admin!</strong> '+ data.status +'</div>');
                             $('#btnloginauthenticatenow').show();
                            break;
                         case 7:
                            $('.myMessageStatus').html('<div class="alert alert-purple" role="alert"><strong>You cannot login based on the request</strong> '+ data.status +'</div>');
                            $('#btnloginauthenticatenow').show();
                           break;
                         case 0:
                            $('.myMessageStatus').html('<div class="alert alert-info" role="alert"><strong>Please make sure all fields are filled!</strong> '+ data.status +'</div>');
                             $('#btnloginauthenticatenow').show();
                            break;
                         case 6:
                            $('.myMessageStatus').html('<div class="alert alert-danger" role="alert"><strong> You not under a company yet. See I.T</div>');
                            break;
                        default:
                             $('.myMessageStatus').html('<div class="alert alert-danger" role="alert"><strong>Wrong Username or password!</strong> '+ data.status +'</div>');
                             $('#btnloginauthenticatenow').show();
                            break;
                    } 
                   
                },
                error: function (data) {
                    $('.myMessageStatus').html('Error Processing Request, please try again or check your internet. If problem persist please contact Administrator').addClass('alert alert-danger');
                    $('#btnloginauthenticatenow').show();
                }
            });
            
           }
       });
      
  </script>
  

</body>


</html>