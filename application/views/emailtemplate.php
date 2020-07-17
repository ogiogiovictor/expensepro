<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Petty Cash Pro</title>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .mainContainer{
            width:400px;
            border: 1px solid lightgrey;
            height:350px;
            margin:0px auto;
            -webkit-box-shadow: 5px 6px 5px 0px rgba(29,10,107,0.35);
            -moz-box-shadow: 5px 6px 5px 0px rgba(29,10,107,0.35);
            box-shadow: 5px 6px 5px 0px rgba(29,10,107,0.35);
            margin-top:50px;
            background-image: url("https://c-iprocure.com/pettycash/public/images/bg.png");
            padding:10px;
            color:grey;
            word-wrap: break-word;
        }
        
        .btn {
            background: #3498db;
            background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
            background-image: -moz-linear-gradient(top, #3498db, #2980b9);
            background-image: -ms-linear-gradient(top, #3498db, #2980b9);
            background-image: -o-linear-gradient(top, #3498db, #2980b9);
            background-image: linear-gradient(to bottom, #3498db, #2980b9);
            -webkit-border-radius: 28;
            -moz-border-radius: 28;
            border-radius: 2px;
            font-family: Arial;
            color: #ffffff;
            font-size: 22px;
            padding: 1px 2px 1px 2px;
            text-decoration: none;
            width:70px;
            font-size:15px;
          }
    </style>
  </head>
  <body>
   

    <div class="mainContainer">
        
        <h3><center><span style="color:blue">Petty Cash Pro Activation</span></center></h3><hr/>
        
        <p><?php echo $topheader; ?></p>
        <a href="<?php echo $link; ?>"><center><p class="btn">Click Here</p></center></a>
    <p>Or copy and paste the link below on your browser</p>
    <p><?php echo $linkraw; ?></p>
        <img src="https://c-iprocure.com/pettycash/public/images/ci-logo.png"  width="50px" style="float:right;"/>
    </div>
      
      <div>
         
          <footer style="padding-top:10px; color:grey">
              <center>&copy 2017 C & Ileasing PLC</center>
          </footer>
      </div>
    
    
  </body>
</html>