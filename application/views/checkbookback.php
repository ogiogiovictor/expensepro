<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>CheckBook</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"/>
  </head>
  
  <style>
      body {
                background-color:white !important;
              
            }
      .checksize{
          margin:0px auto;
          width:600px;
          height:300px;
          margin-top:30px;
             
      }
      
      
      .benName{
          font-size:20px;
         font-weight:bold;
         padding-top:60px;
         padding-left:10px;
         
         
      }
      
      
      
       @page { size: auto;  margin: 1mm; } 
  </style>
  <body>
   
    <div class="checksize">
        
        <div class="benName"><?php echo $chqBack; ?> </div>
       
    </div>
      
  </body>
</html>
