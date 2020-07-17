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
            }
            @page { size: auto;  margin: 1mm; } 
        </style>
        <script>
            $(function () {

                $('.print').on('click', function () { // select print button with class "print," then on click run callback function
                    $.print(".content"); // inside callback function the section with class "content" will be printed

                });
            });
        </script>    


    </head>
    <body>
        <div style="text-align:right"> <button type="button" class="print btn btn-xs btn-instagram"> <i class='material-icons'>print</i>Print</button></div>

        <div id="output" class="content">     
            <center><h4>C & I Leasing Plc</h4>
                <h3>Cashier's Cheque Requests</h3></center>
            <?php
                if($fid){
                    
                    $explodearrary = explode(",", $fid);
                    foreach($explodearrary as $key => $value){
                      
                    }
                    
                    
                }
            ?>
            <?php
             if($id){
                
                 $getcashiersEmail = $this->accounting->getdcashierreimbursementemail($id);
                 $ndescriptOfitem = "Petty Cash Reimbursement";
                 $getDateSent = $this->accounting->getdcashieriemdateSent($id);
              
             }
            
            ?>
            
            
            <?php
            $getfullResult = $this->accounting->getmaincashieriemresult($id);
            if($getfullResult){
                
                foreach($getfullResult as $newget){
                        $actid = $newget->id;
                        $accountGroup = $newget->accountGroup;
                        $newapproval = $newget->approval;
                        $unit = $newget->unit;
                        $Location = $newget->Location;
                        
                        if($newapproval == 0){
                            $newapproval = "Pending";
                        }else{
                            $newapproval = "Approved";
                        }
                 }
            }
            
            ?>
            
            
            

            <style type="text/css">
                #contentnow {
                    width: 620px;
                    margin: 0 auto;
                    border: 1px solid black;
                    padding:5px;
                }   

                #tablecenter {
                    width: 620px;
                    margin: 0 auto;
                    padding:0px;
                    font-size:12px;
                }      
            </style>


            <p id="contentnow">
                <span>Request Details</span>

            <table class="table table-condensed"  id="tablecenter" border="1px">
                <tr>
                    <td><b><div style="padding:10px">Request Title:</div></b></td>
                    <td><div style="padding:10px"><?php echo $ndescriptOfitem; ?></div></td>
                    <td><b><div style="padding:10px">Request ID:</div></b></td>
                    <td><div style="padding:10px"><?php echo $id; ?></div></td>
                </tr>

                <tr>
                    <td><b><div style="padding:10px">Prepared By:</div></b></td>
                    <td><div style="padding:10px"><?php echo $getcashiersEmail; ?></div></td>
                    <td><b><div style="padding:10px">Date Created:</div></b></td>
                    <td><div style="padding:10px"><?php echo $getDateSent; ?></div></td>
                </tr>

                <?php
                    if($accountGroup != ""){
                        $newCashier = $this->mainlocation->getdgroupaccount($accountGroup);
                    }else{
                        $newCashier = "";
                    }
                
                    $requesterComment = "";
                ?>

                <tr>
                    <td><b><div style="padding:10px">Status:</div></b></td>
                    <td><div style="padding:10px"><?php echo $newapproval; ?></div></td>
                    <td style="width:200px"><b><div style="padding:10px">Approvals:</div></b></td>
                    <td style="width:200px"><div style="padding:10px"><?php echo $newCashier; ?></div></td>
                </tr>

                <tr>
                    <td><b><div style="padding:10px">Payee:</div></b></td>
                    <td><div style="padding:10px"><?php echo $getcashiersEmail; ?></div></td>
                    <td style="width:200px"><b><div style="padding:10px">Comment:</div></b></td>
                    <td style="width:200px"><div style="padding:10px"><?php echo $requesterComment; ?></div></td>
                </tr>


                <tr>
                    <td><b><div style="padding:10px">Location:</div></b></td>
                    <td><div style="padding:10px"><?php 
                        if(is_numeric($Location)){
                           echo $this->mainlocation->getdLocation($Location); 
                        }else{
                            echo $Location;
                        }
                     ?></div></td>
                    <td style="width:200px"><b><div style="padding:10px">Unit:</div></b></td>
                    <td style="width:200px"><div style="padding:10px"><?php 
                     if(is_numeric($unit)){
                             echo $this->mainlocation->getdunit($unit); 
                        }else{
                            echo $unit;
                        }
                      ?></div></td>
                </tr>

                <?php
                //$getdBank = $this->mainlocation->getdBank($id)
                ?>
                <tr>
                    <td><b><div style="padding:10px">Bank(For Cashier use only):</div></b></td>
                    <td><div style="padding:10px"></div></td>
                    <td style="width:200px"><b><div style="padding:10px">Cheque:</div></b></td>
                    <td style="width:200px"><div style="padding:10px"></div></td>
                </tr>

            </table>

        </p> 



<?php
 echo "<p id='contentnow'><span>Expense Details</span><table class='table table-condensed' id='tablecenter' border='1px'>"
    . "<tr><td><b>Code</b></td> <td><b>Code Name</b></td> <td><b>Amount</b></td></tr>";
?>
<?php
 $sume = ""; $ex_Total = "";
if ($fid) {
    
    //$explodearrary = explode(",", $fid);
    //var_dump($explodearrary);
   // foreach($explodearrary as $key => $value){
    
        //echo $value;
        
    $getResultbyID = $this->accounting->getresultbyID($fid);
    //print_r($getResultbyID);
    $Total = 0;
    foreach ($getResultbyID as $extdetals) {
                $actID = $extdetals->actID;
                $ex_Amount = $extdetals->ex_Amount;
                $Total = $extdetals->Total;
                $dCode = $extdetals->dCode;
                                                  
                $getCodeName = $this->mainlocation->nameCode($dCode);
                    if($Total){
                        $sume += $Total;
                 }

        $ex_Total = @number_format($sume, 2);
        // Use Code to get the name of the payment
        $getNameCode = $this->mainlocation->nameCode($dCode);

        echo "<tr><td>$dCode</td> <td>$getCodeName</td> <td>".@number_format($Total, 2)."</td></tr>";
        
        
         }
   // }
    
    echo "</table></p>"
    . "
                 <p><table id='tablecenter' border='1px'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                 Total Amount: $ex_Total </strong></table></p>";
}
?>

        <center><p style="margin-top:40px; text-align: right">

            <div style="border-top: 1px solid black; width:200px">Authorized Signature</div>
            </p>
        </center>
    </div>

</body>
</html>