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
                <h3>Cheque Requests</h3></center>
            <?php
            $maintitle = "";
            $ptitle = "";
            if ($getallresult) {
                foreach ($getallresult as $get) {
                    $id = $get->id;
                    $dateCreated = $get->dateCreated;
                    $ndescriptOfitem = $get->ndescriptOfitem;
                    $nPayment = $this->mainlocation->getpaymentType($get->nPayment);
                    $approvals = $get->approvals;
                    $hod = $get->hod;
                    $icus = $get->icus;
                    $cashiers = $get->cashiers;
                    $sessionID = $get->sessionID;
                    $dateRegistered = $get->dateRegistered;
                    $dAmount = $get->dAmount;
                    $refID_edited = $get->refID_edited;
                    $addComment = $get->addComment;
                    $dICUwhoapproved = $get->dICUwhoapproved;
                    $dCashierwhopaid = $get->dCashierwhopaid;
                    $fullname = $get->fullname;
                    $dUnit = $get->dUnit;
                    $benName = $get->benName;
                    $dLocation = $get->dLocation;
                    $requesterComment = $get->requesterComment;
                    $partPay = $get->partPay;
                    $hodwhoapprove = $get->hodwhoapprove;
                    $dAccountgroup = $get->dAccountgroup;
                    $CurrencyType = $get->CurrencyType;
                    $from_app_id = $get->from_app_id;
                    $sageRef = $get->sageRef;
                    
                   if($from_app_id == '3'){
                                                    $vendor = $this->generalmd->getsinglecolumnfromotherdb("name", "vendors", "USER_ID", $benName);
                                                    }else if($from_app_id == '0' && is_numeric($benName)){
                                                          $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($from_app_id == '0' && !is_numeric($benName)){
                                                         $vendor =  $benName;
                                                    }else if($from_app_id == '5'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($from_app_id == '6'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else if($from_app_id == '8'){
                                                        $vendor = $this->maintenance->maintenancepayee("workshop_name", "maintenance_workshop", "id", $benName);
                                                    }else{
                                                        $vendor =  $benName;
                                                    }
                    $accountNumber = $from_app_id == 3 ? $this->generalmd->getsinglecolumnfromotherdb("bank", "vendors", "USER_ID", $benName) : "";
                    $bankNameID = $from_app_id == 3 ? $this->generalmd->getsinglecolumnfromotherdb("bankname", "vendors", "USER_ID", $benName) : "";
                    $getBankName = $from_app_id == 3 ? $this->generalmd->getsinglecolumnfromotherdb("bank_name", "bank", "bank_id", $bankNameID) : "";
                    
                    if($accountNumber && $getBankName){
                       $procureBankName = $getBankName. " ". $accountNumber;  
                    }else{
                        $procureBankName = "";
                    }
                    
                    if($from_app_id == 3){
                        $newrequestComment = $procureBankName;
                    }else {
                        $newrequestComment = $requesterComment; 
                    }
                    
                    if ($partPay != "0.00" && $partPay < $dAmount) {
                        $maintitle = "Amount Paid :";
                        $dAmount = number_format($partPay, 2);
                        $dAmount .= "<span style='color:red'><small> (Part Payment)</small></span>";
                        $ptitle = "<br/><center><span style='color:red'><small>Please note kindly complete payment as you have only paid the amount indicated as part payment</small></span></center>";
                    } else {
                        $maintitle = "Total Amount :";
                        $dAmount = number_format($dAmount, 2);
                    }
                    // $dAmount = number_format($get->dAmount);
                    
                    if($CurrencyType == 'naira'){
                         $newCurrency = '<span>&#8358;</span>';
                    }else if($CurrencyType == 'dollar'){
                         $newCurrency = '<span>&#x0024;</span>';
                    }else if($CurrencyType == 'euro'){
                         $newCurrency = '<span>&#8364;</span>';
                    }else if($CurrencyType == 'pounds'){
                          $newCurrency = '&#163;';
                    }else if($CurrencyType == 'yen'){
                          $newCurrency = '&#165;';
                    }else if($CurrencyType == 'singaporDollar'){
                        $newCurrency = 'S&#x0024;';
                    }else if($CurrencyType == 'AED'){
                        $newCurrency = '(AED)';
                    }else if($CurrencyType == 'rupee'){
                      $newCurrency = '<span>&#8377;</span>';
                     }else{
                        $newCurrency = '&#8358;';
                    }
                                                        
                                                   

                    if ($approvals == 0) {
                        $newapproval = "Pending";
                    } else if ($approvals == 1) {
                        $newapproval = "<span style='color:red'>Awaiting HOD Approval</span>";
                    } else if ($approvals == 2) {
                        $newapproval = "<span style='color:blue'>Awaiting ICU Approval</span>";
                    } else if ($approvals == 3) {
                        $newapproval = "<span style='color:indigo'>Awaiting Payment</span>";
                    } else if ($approvals == 4) {
                        $newapproval = "<span style='color:green'>Ready for Collection</span>";
                    } else if ($approvals == 5) {
                        $newapproval = "<span style='color:red'>Not Approved By HOD</span>";
                    } else if ($approvals == 6) {
                        $newapproval = "<span style='color:grey'>Reject by ICU</span>";
                    } else if ($approvals == 7) {
                        $newapproval = "<span style='color:indigo'>Cheque Sent for Signature</span>";
                    } else if ($approvals == 8) {
                        $newapproval = "<span style='color:green'>Signed & Ready for Collection</span>";
                    } else if ($approvals == 11) {
                        $newapproval = "<span style='color:brown'>Closed</span>";
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
                    padding:5px;
                    font-size:12px;
                }      
            </style>


            <p id="contentnow">
                <span>Request Details: <span style="color:red; font-size:18px; font-weight:bold; float:right"><?php echo @$sageRef; ?></span></span>

            <table id="tablecenter" border="1px">
                <tr>
                    <td><b><div style="padding:3px; width:100px">Request Title:</div></b></td>
                    <td><div style="padding:3px; width:200px"><?php echo $ndescriptOfitem; ?></div></td>
                    <td><b><div style="padding:3px; width:100px">Request ID:</div></b></td>
                    <td><div style="padding:3px; width:200px"><?php echo $id; ?></div></td>
                </tr>

                <tr>
                    <td><b><div style="padding:3px">Prepared By:</div></b></td>
                    <td><div style="padding:3px"><?php echo $fullname; ?></div></td>
                    <td><b><div style="padding:3px">Date Created:</div></b></td>
                    <td><div style="padding:3px"><?php echo $dateCreated; ?></div></td>
                </tr>

                <?php
                    if($dCashierwhopaid == ""){
                        $newCashier = $this->mainlocation->getdgroupaccount($dAccountgroup);
                    }else{
                        $newCashier = $dCashierwhopaid;
                    }
                
                ?>

                <tr>
                    <td><b><div style="padding:3px">Status:</div></b></td>
                    <td><div style="padding:3px"><?php echo $newapproval; ?></div></td>
                    <td style="width:200px"><b><div style="padding:3px">Approvals:</div></b></td>
                    <td style="width:200px"><div style="padding:3px"><?php echo $hodwhoapprove . ', ' . $dICUwhoapproved . ',' . $newCashier; ?></div></td>
                </tr>

                <tr>
                    <td><b><div style="padding:3px">Payee:</div></b></td>
                    <td><div style="padding:3px"><?php echo $vendor; ?></div></td>
                    <td style="width:200px"><b><div style="padding:3px">Comment:</div></b></td>
                    <!--<td style="width:200px"><div style="padding:3px"><?php //echo $requesterComment; ?></div></td>-->
                    <td style="width:200px"><div style="padding:3px"><?php echo $newrequestComment; ?></div></td>
                    
                </tr>


                <tr>
                    <td><b><div style="padding:3px">Location:</div></b></td>
                    <td><div style="padding:3px"><?php 
                        if(is_numeric($dLocation)){
                           echo $this->mainlocation->getdLocation($dLocation); 
                        }else{
                            echo $dLocation;
                        }
                     ?></div></td>
                    <td style="width:200px"><b><div style="padding:3px">Unit:</div></b></td>
                    <td style="width:200px"><div style="padding:3px"><?php 
                     if(is_numeric($dUnit)){
                             echo $this->mainlocation->getdunit($dUnit); 
                        }else{
                            echo $dUnit;
                        }
                      ?></div></td>
                </tr>

                <?php
                $getdBank = $this->mainlocation->getdBank($id)
                ?>
                <tr>
                    <td><b><div style="padding:3px">Bank(For Cashier use only):</div></b></td>
                    <td><div style="padding:3px"><?php //echo $getdBank; //echo $this->adminmodel->getBankName($getdBank); ?> </div></td>
                    <td style="width:200px"><b><div style="padding:3px">Cheque No:</div></b></td>
                    <td style="width:200px"><div style="padding:3px"><?php echo $this->mainlocation->getChequeNofromacct($id); ?></div></td>
                </tr>
                
                <?php
                $getTravelID = $this->travelmodel->getTravelID($id);
                $geteBank = $this->travelmodel->geteBank($getTravelID);
                $geteAccount = $this->travelmodel->geteAccount($getTravelID);
                if($getTravelID){
                    echo '<tr>
                    <td><b><div style="padding:3px">Bank:</div></b></td>
                    <td><div style="padding:3px"> '.$geteBank.' </div></td>
                    <td style="width:200px"><b><div style="padding:3px">Account No:</div></b></td>
                    <td style="width:200px"><div style="padding:3px"> '.$geteAccount.' </div></td>
                </tr>';
                }else{
                    echo "";
                }
                ?>

            </table>

        </p> 




<?php
$getexpensedetails = $this->adminmodel->getexpenseresultdetails($id);

if ($getexpensedetails) {
    echo "<p id='contentnow'><span>Expense Details</span><table id='tablecenter' border='1px'>"
    . "<tr><td><div style='padding:3px'><b>Details</b></div></td><td><div style='padding:3px'><b>Code</b></div></td><td><div style='padding:10px'><b>Amount</b></div></td><td><div style='padding:10px'><b>Date</b></div></td></tr>";
    foreach ($getexpensedetails as $extdetals) {
        $exid = $extdetals->exid;
        $requestID = $extdetals->requestID;
        $ex_Details = $extdetals->ex_Details;
        $ex_Amount = $extdetals->ex_Amount;
        $ex_Code = $extdetals->ex_Code;
        $ex_Date = $extdetals->ex_Date;

        $ex_Amount = @number_format($ex_Amount, 2);
        // Use Code to get the name of the payment
        $getNameCode = $this->mainlocation->nameCode($extdetals->ex_Code);

        echo "<tr><td><div style='padding-left:3px'>$ex_Details</div></td><td><div style='padding-left:3px'>$ex_Code $getNameCode</div></td><td><div style='padding-left:3px'>$ex_Amount</div></td><td><div style='padding-left:3px'>$ex_Date</div></td></tr>";
    }
    echo "</table></p>"
    . "
                 <p><table id='tablecenter' border='1px'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                 $maintitle $newCurrency $dAmount $ptitle</strong></table></p>";
}
?>

        <center><p style="margin-top:40px; text-align: right">

            <div style="border-top: 1px solid black; width:200px">Authorized Signature</div>
            </p>
        </center>
    </div>

</body>
</html>