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
         /* font-size:20px;
         font-weight:bold;
         padding-top:98px;
         padding-left:10px;
         position:absolute;
         */
         <?php  echo $chqName; ?>
         
      }
      
      .chequedateprinted{
         /*  float:left;
          position:absolute;
          padding-top:100px;
          padding-left:535px;
          font-size:15px;
          font-weight:bold;
          */
          
          <?php echo $chqDate; ?>
          
      }
      
      .amountinWord{
        /* padding-top:180px;
         padding-left:45px;
         position:absolute;
         font-size:15px;
         font-weight:bold;
         max-width:390px;
         */
         
          <?php echo $chqWords; ?>
        
      }
      
      .amountinfigure{
        /* padding-top:180px;
         padding-left:535px;
         position:absolute;
         font-size:15px;
         font-weight:bold;
         */
          <?php echo $chqAmount; ?>
      }
      
       @page { size: auto;  margin: 1mm; } 
  </style>
  <body>
   
    <div class="checksize">
        
        <div class="benName"><?php echo $payeeName; ?> </div>
        <div class="chequedateprinted"> <?php echo date('d-m-Y'); ?></div>
        
        <div style="clear:both"></div>
        <?php
       /* $numintext = "";
        $numside = 0;
        foreach(explode('.', $actualAmount) as $side){
            $numside++;
            $numintext .= $side > 0 ? numberTowords($side).' ' : ' ';
            $numintext .= ($numside == 1) ? ' naira ' : '';
            $numintext .= ($numside == 2 && $side > 0) ? ' Kobo Only ' : '';
        } */
        ?>
        
        <?php
            $koboValue =  "";
             $kobothens = "";
            $explodeasArray = explode('.', $actualAmount);
            $firstAmountinNaira =  $explodeasArray[0];
            $secondAmountinNaira = $explodeasArray[1];
            if($secondAmountinNaira > 0){
             $koboValue = $secondAmountinNaira;  
             $kobothens = "<i id='showmoneyinkobo'></i> Kobo Only";
            }else{
                $koboValue = "";
                $kobothens = "";
            }
            
        ?>
      
        <div class="amountinWord" style='color:blue'> <i id="showmoney"></i> Naira Only  <?php echo $kobothens; ?> </div>
        <!--<div class="amountinWord" style='color:blue'>  <?= $numintext ?></div>-->
        <div class="amountinfigure"> <?php echo @number_format($actualAmount, 2); ?></div>
         
        <!--
        <div class="nameofpayee"><b><?php echo $payeeName; ?></b> <span class="dateofcheque">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                
                    <?php echo date('Y-m-d'); ?></span></div>
        
        <div style="clear:both"></div>
        
        
        <div class="moneyinwords" style="font-weight:bolder; font-size:15px">
         
         <i id="showmoney" style='color:blue'></i>
        </div>
        
        <div class="digits" style="font-size:15px;"><?php //echo @number_format($actualAmount, 2); ?></div>
        
        -->
        
    </div>
  </body>
</html>
<script src="<?php echo base_url(); ?>public/javascript/main.js"></script>
<script type="text/javascript">
       var newnumber = numberToEnglish(<?php echo $firstAmountinNaira; ?>);
        var kobovalue = numberToEnglish(<?php echo $secondAmountinNaira; ?>);
       //var newnumber = numToWords(<?php echo $actualAmount; ?>)
       //alert(newnumber);
       $('#showmoney').html(newnumber);
       $('#showmoneyinkobo').html(kobovalue);
       //numberToEnglish(<?php //echo $dAmount; ?>);
       //numToWords(8323728);
     </script>