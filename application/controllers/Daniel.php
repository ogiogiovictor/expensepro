<?php

@session_start();

include 'include/connect.php';


$username = $_POST['username'];

$password = $_POST['password'];

//$pass=md5($password);
$res = mysql_query("select * from members_table where
username='$username' and password='$password'");
$row = mysql_num_rows($res);

if ($row == "0") {
    echo "invalid Username/password";
} else {
    $row = mysql_fetch_array($res);
    $status = $row['status'];
    $email = $row['email_verify'];
    if ($email == '1') {
        if ($status != '1') {
            echo "Your account Is Inactive.Please contact Your administrator";
        } else {
            $sitedata = mysql_fetch_array(mysql_query("select * from admin_settings
where admin_settings_id='1'"));
            $opt_verify = $sitedata['otp_verification'];
            if ($opt_verify == 'on') {
                $otp_verification = $row['otp_verification'];
                $verificationCode = $row['otp_verification_code'];
                if ($otp_verification == 0 && $verificationCode != 0) {
                    $phone = $row['telephone'];
                    $username = "thefundcycle";
//API Key
                    $APIKey = "D09F16885A70D69537230B820F881A4D";
//Mime mode
                    $dataformat = "xml";
//Derivative URL
                    $APIUrl = "https://smsprime.com/api.module/$username/$dataformat";
//Compute a signature for the user by concatenating the username and the api key
                    $signature = md5($username . $APIKey);
//Build an xml request for method send, with an auxillary instruction to get the balance
                    $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
                            <Request>
                            <header>
                            <auth>
                            <signature>$signature</signature>
                            </auth>
                            </header>
                            <body>
                            <auxillary>
                            <balance>1</balance>
                            </auxillary>
                            <method>send</method>
                            <parameters>
                            <type>default</type>
                            <destination>$phone</destination>
                            <source>TFC</source>
                            <header>optional header</header>
                            <shortmessage>Welcome to thefundcycle here is your Verification code:
                            $verificationCode</shortmessage>
                            <group>optional group name</group>
                            </parameters>
                            </body>
                            </Request>";
//Use CURL to post
//You could as well easily use fsockopen and its family of functions
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $APIUrl);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $result = curl_exec($ch);
                    $result = simplexml_load_string($result);
                    $statusCode = $result->statusCode;
                    $statusText = $result->statusText;
                    if ($statusCode == 200) {
                        $id = $row['member_id'];
                        $date = date("Y-m-d H:i:s");
                        $ip = $_SERVER['REMOTE_ADDR'];
                        mysql_query("insert into
login_info(user,ip_address,access_date)values('$id','$ip','$date')");
                        $_SESSION['otp_status'] = true;
                        $_SESSION['userid_temp'] = $row['member_id'];
                        $_SESSION['post_spon_temp'] = $row['username'];
                        echo 'Phone Verification';
                        die();
                    } else {
                        $_SESSION['otp_status'] = true;
                        echo $statusText . '. [Error code#' . $statusCode . ']';
                        die();
                    }
                }
            }
            $id = $row['member_id'];
            $date = date("Y-m-d H:i:s");
            $ip = $_SERVER['REMOTE_ADDR'];
            mysql_query("insert into
login_info(user,ip_address,access_date)values('$id','$ip','$date')");
            $_SESSION['userid'] = $row['member_id'];
            $_SESSION['post_spon'] = $row['username'];
            echo "success";
        }
    } else {
        echo "Your account not verify.Please Check your E-mail verification link!";
    }
}
?>