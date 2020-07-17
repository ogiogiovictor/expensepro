<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title; ?></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.3.3/jQuery.print.min.js"></script>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   
    <style type="text/css">
        
        body {
    background-color:white !important;
    padding:30px;
        }
        .content{
            width: 900px;
            border: 1px solid lightgray;
            margin: 0px auto;
            height:1150px;
            padding:40px;
            
        }
        .bottom_aligner {
            position: fixed;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 1rem;
            background-color: #efefef;
            text-align: center;
        }
       @page { size: auto;  margin: 1mm; } 
    </style>
    <script>
        $(function() {
        
        $('.print').on('click', function() { // select print button with class "print," then on click run callback function
        $.print(".content"); // inside callback function the section with class "content" will be printed
        
         });
      });
    </script>    
  </head>
  <body>
      <div style="text-align:right"> <button type="button" class="print btn btn-xs btn-instagram"> <i class='material-icons'>print</i>Print</button></div>
 <div id="output" class="content">     
     
     <p>
     <center> <img width="120px" src="<?php echo base_url(); ?>public/images/ci-logo.png" /><br/>
            <h2>C&I LEASING PLC</h2></center>
     </p>
<?php
$getfirstnumber = $somenumber;
$getFirst =  substr($getfirstnumber, 0, 2);

$dBankNumber = $this->adminmodel->getthebankNumber($getFirst);

$theBankName = $this->adminmodel->getBankName($dBankNumber);
$returnResult = $this->adminmodel->getdresultsbank($dBankNumber);
if($returnResult){
    foreach($returnResult as $get){
        $bkid = $get->id;
        $state = $get->state;
        $address = $get->address;
    }
}
?>

<div style="clear:both;"></div>
    
<div style="margin-top:20px; margin-bottom: 20px;">
<?php echo date("F jS, Y"); ?><br/><br/>
<span>The Branch Manager</span><br/>
<b><?php echo $theBankName; ?></b> <br/>
<?php echo @$address; ?><br/>
<?php echo @$state; ?>.<br/>
</div>
 
<br/>
<p style="font-weight:bold"><u>ATTENTION : The Operation Manager</u></p>

Dear Sir/Madam,<br/>
<center><u><p style="font-size:18px; margin-top:20px; margin-bottom: 20px;  font-family: Arial Black;">CONFIRMATION OF CHEQUE(S) ISSUED ON CURRENT ACCOUNT NO: <?php echo $dBankNumber ?></p></u></center>
     
     <div class="mainContent" style="text-align:justify; padding:10px;">
        We hereby confirm that cheques(s) issued with the underlisted details was/were issues by us:-
        <br/><br/>
        <table class="table table-bordered table-responsive table-striped">
            <tr>
            <th>Cheque No</th>
            <th>Beneficiary</th>
            <th>Amount</th>
            </tr>
            
            <?php
            $ssession = $_SESSION['email'];
            $thenumber = explode(",", $somenumber);
            foreach($thenumber as $value) {

            $allSelected[] = $value;

           $getusersingroup = $this->adminmodel->getpreparedcheques($value); 
           
           //Update the result of bank Statement generated to yes
           $thisupdate = $this->adminmodel->updateBankstatementoYes($value, $ssession);
          
           ?>
            
             <?php if ($getusersingroup) { ?>
            
             
            <?php //var_dump($getallresult);
            $i = ""; $totalSum = 0;
            foreach($getusersingroup as $get){
                $id = $get->id;
                $chequeNo = $get->chequeNo;
                $paidTo = $get->paidTo;
                $Amount = $get->Amount;
                $partPay = $get->partpayAmount;
                                                
                 if($partPay !="" && $partPay < $Amount){
                      $newAmount = $partPay;
                  }else{
                     $newAmount = $Amount;
                 }
                
                if($Amount){
                    $totalSum += $newAmount;
                }
              
           ?>
            <tr>
                <td><?php echo $chequeNo; ?></td>
                <td><?php echo $paidTo; ?></td>
                <td><?php echo $newAmount; ?></td>
            </tr>
            
       <?php } ?>
                                                
       <?php } ?>

       <?php } ?>
            
            <?php
            $sumlang = "";
            $somenumber = explode(",", $somenumber);
            if($somenumber){
                foreach($somenumber as $key => $value) {
                     
                $getlangID = $this->adminmodel->getpreparedcheques($value);
               
                        if($getlangID){

                         foreach($getlangID as $get){
                             $id = $get->id;
                             $Amount = $get->Amount;
                             $partPay = $get->partpayAmount;
                                                
                            if($partPay !="" && $partPay < $Amount){
                                 $newAmount = $partPay;
                             }else{
                                $newAmount = $Amount;
                            }

                             ////////SUM AMOUNT 
                                 if($Amount){
                                     $sumlang += $newAmount;
                                 } 

                             }

                          }
                 
                 }
                 }
                 
                ?>
            
              <?php
            /*
          $mainaccountapproval = '8';
          $newthenumber = explode(",", $somenumber);
          if($newthenumber){
          foreach($newthenumber as $key => $value) {
              
               $getlangID = $this->adminmodel->getthefmrequestID($value);
               $newapproval = '2';  
               $allSelected[] = $value;
               
               //Update record where the id = $value
          $runUpdatefornewrequest = $this->adminmodel->updatewithidforbankst($mainaccountapproval, $newapproval, $ssession, $getlangID);
               
             }
          }
             
             */
            ?>
            
          </table>  
        <div style="text-align: right; border-top: 1px;"><b>TOTAL</b> <span style="font-size:20px; font-weight: bold; border:1px solid lightsteelblue; padding:7px; background-color: whitesmoke;"><?php echo number_format(@$sumlang, "2"); ?></span></div> 
     </div>
     
     <p style="maring-top:30px;">
       Yours faithfully,<br/>
       
       <b>For C & I LEASING PLC</b>
     </p>
     
     <br/><br/><br/>
     <br/><br/>
     
     <span style="text-align:left; border-top-color:black; border-top-style:groove; width:30px;">Authorised Signatory </span>   <span style="text-align:right; margin-left:500px; border-top-color:black; border-top-style:groove; width:30px;">Authorised Signatory </span><br/>
     <div  class="bottom_aligner">
         <center> <small>LEASING HOUSE
                 2, C&I Leasing Drive Off Bisola Durosimi Etti Way Lekki Phase 1 Lagos Email: info@c-ileasing.com, Website: www.c-ileasing.com</small></center>
     </div>
     
 </div>
  </body>
</html>