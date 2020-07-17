<?php

/*
 * set baseUrl to the mobile platform as it will be used to redirect users trying to access the main platfrom from mobile devices
 */


function baseUrl() {
    return "https://c-iprocure.com/moneybook/";
}

//function to count the number of words in a string
/**
 * 
 * @param type $string
 * @return type
 */
function wordCount($string) {
    $a = explode(" ", $string);

    return count($a);
}

/**
 * 
 * @param type $a
 * @return type
 */
function sieve($a) {
    $a = trim($a);
    $a = stripslashes($a);
    $a = strip_tags($a);
    $a = htmlentities($a);
    return $a;
}

/**
 * 
 * @param type $phoneNumber
 * @return string
 */
function is_phone_number($phoneNumber) {
    if (preg_match("/^[0-9]*$/", $phoneNumber)) {
        return $phoneNumber;
    } else {
        return ""; // return empty string
    }
}

// to ensure input is a real name i.e. only alphabets are allowed
/**
 * 
 * @param type $name
 * @return string
 */
function is_real_name($name) {
    $name = stripslashes(trim($name));
    $name = strip_tags($name);
    $name = htmlentities($name);

    if (preg_match("/^[a-zA-Z ]*$/", $name)) {
        return $name;
    } else {
        return ""; // return empty string
    }
}

// to ensure only integer is allowed
/**
 * Used to ensure $value is an integer
 * @param type $value
 * @return int or empty string on failure
 */
function only_int($value) {
    if (preg_match("/^[0-9]*$/", $value)) {
        return $value;
    } else {
        return FALSE; // return empty string
    }
}

// to ensure input is in email format
/**
 * Checks whether string is a well-formatted email
 * @param String $email The string to be checked
 * @return string
 */
function is_email($email) {
    $email = stripslashes(trim($email));
    $email = strip_tags($email);
    $email = htmlentities($email);

    $email = filter_var($email, FILTER_SANITIZE_EMAIL); // sanitize email

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = strtolower($email); // change case to lower
        return $email;
    } else {
        return ""; // return empty string if error encountered
    }
}

// to allow only numbers, alphabets, underscore and fullstop. This is suitable for username
/**
 * 
 * @param type $name
 * @return string
 */
function is_username($name) {
    $name = stripslashes(trim($name));
    $name = htmlentities($name);

    if (preg_match("/^[a-zA-Z 0-9_.]*$/", $name)) {
        return $name;
    } else {
        return ""; // return empty string
    }
}

// to check if url is valid
/**
 * 
 * @param type $url
 * @return string
 */
function is_url($url) {
    $url = filter_var($url, FILTER_SANITIZE_URL); // sanitize url

    if (filter_var($url, FILTER_VALIDATE_URL)) {
        return $url;
    } else {
        return "";
    }
}

/**
 * 
 * @param type $errorCode
 * @return string
 */
function getFileError($errorCode) {
    if ($errorCode > 0) { // if error code is greater than 0
        switch ($errorCode) {
            case 1:
                $msg = "Exceeds upload_max_file in php.ini";
                break;

            case 2:
                $msg = "Exceeds max_file_size in html";
                break;

            case 3:
                $msg = "partially uploaded";
                break;

            case 4:
                $msg = "no file uploaded";
                break;

            case 6:
                $msg = "no temp folder";
                break;

            case 7:
                $msg = "unable to write to disk";
                break;

            case 8:
                $msg = "file upload stopped";
                break;
        }

        return $msg;
    }
}

/**
 * 
 * @param type $valueToFilter
 * @return string
 */
function spam_filter($valueToFilter) {
    $unallowed = [
        'to:',
        'cc:',
        'bcc:',
        'content-type:',
        'mime-version:',
        'multipart-mixed:',
        'content-transfer-encoding:'
    ];

    // loop through the array to check if any value in the array is found in the $value sent by caller
    foreach ($unallowed as $spam) {
        if (stripos($valueToFilter, $spam) !== FALSE) { // false will be returned if $spam is not found in $valueToFilter. stripos() is case-insensitive
            return ""; // return an emoty string is $spam is found in $valueToFilter. This will break out of the spam_filter()
        }
    }

    // if no spam is found, replace any occurence of \r, \n, %0a, %0d with a space and return trimmed version of $valueToFilter
    str_replace(array(
        "\r",
        "\n",
        "%0a",
        "%0d"
            ), ' ', $valueToFilter);
    return trim($valueToFilter);
}

//to be used as naming convention for team and task names
/**
 * 
 * @param type $name
 * @return string
 */
function allowedName($name) {
    $name = stripslashes(trim($name));
    $name = htmlspecialchars($name);
    $name = strip_tags($name);

    if (preg_match("/^[a-zA-Z 0-9._-]*$/", $name)) {
        return $name;
    } else {
        return ""; // return empty string
    }
}

/**
 * @description function to generate random string with an underscore in between
 * @param int $minLength minimum length of string to generate
 * @param int $maxLength maximum length of string to generate
 * @param string $delimiter [optional] The string to put in between the first and second strings Default is underscore
 * @return string $code the new randomly generated code
 */
function generateRandomCode($minLength, $maxLength) {
    $totLength = rand($minLength, $maxLength - 1);

    $b4_ = rand(1, $totLength - 1); //number of strings before the underscore
    $afta_ = $totLength - $b4_; //number of strings after the underscore

    $code = random_string('alnum', $b4_) . random_string('alnum', $afta_);

    return $code;
}

/**
 * Array of file extensions regarded to be a document.
 * Used in separating file types inserted into the column 'type' of files table
 * Used in Task/fileUpload (at least)
 * @return array
 */
function docArray() {
    return ['.doc', '.docx', '.pdf', '.xls', '.ppt', '.pptx', '.csv', '.xlsx', '.dot', '.docm', '.dotx', '.dotm', '.docb',
        '.xlt', '.xlm', '.xlsm', '.xltx', '.xltm', '.xlsb', '.xla', '.xlam', '.xll', '.xlw', '.pot', '.pps', '.pptm', '.potx',
        '.potm', '.ppam', '.ppsx', '.ppsm', '.sldx', '.sldm', '.pub', '.odt', '.fb2', '.ps', '.wpd', '.wp', '.wp7', '.accdb',
        '.accde', '.accdt', '.accdr', '.xps'];
}

/**
 * Array of url endings (e.g. '.com')
 * Used in getting url from a string that looks like a url but doesn't start with a protocol or 'www'
 * @return array
 */
function urlArray() {
    return ['uk', 'za', 'com', 'net', 'name', 'ng', 'edu', 'ca', 'org', 'edu'];
}

/**
 * Creates link to unsubscribe from a notification email
 * @param type $userEmail
 * @param type $userId
 * @param type $userCode
 * @param type $subsciptionType
 * @return string
 */
function unsubscribeLink($userEmail, $userId, $userCode, $subsciptionType) {
    $rand = generateRandomCode(20, 30);
    $random = generateRandomCode(30, 40, "");


    //replace the "@" in email so as to be able to safely PASS it in URL
    $urlEmail = str_replace(['@', '.'], ['at', 'dot'], $userEmail);


    $unsubscribeLink = base_url() . "subscription/unsubscribe/$random/$userCode/$subsciptionType/$urlEmail/$userId/$rand";

    return $unsubscribeLink;
}

function formatMoney($number, $fractional = false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}

function dateDifference($date1, $date2) {
    if ($date1 < $date2) {

        $date1 = strtotime($date1);
        $date2 = strtotime($date2);
        $diff = abs($date1 - $date2);

        $day = $diff / (60 * 60 * 24); // in day
        $dayFix = floor($day);

        $dayPen = $day - $dayFix;
        if ($dayPen > 0) {
            $hour = $dayPen * (24); // in hour (1 day = 24 hour)
            $hourFix = floor($hour);
            $hourPen = $hour - $hourFix;
            if ($hourPen > 0) {
                $min = $hourPen * (60); // in hour (1 hour = 60 min)
                $minFix = floor($min);
                $minPen = $min - $minFix;
                if ($minPen > 0) {
                    $sec = $minPen * (60); // in sec (1 min = 60 sec)
                    $secFix = floor($sec);
                }
            }
        }
        $hourFix = $hourFix + floor($dayFix * 24);

        $hours = ($hourFix) ? $hourFix : '00';
        $minutes = ($minFix) ? $minFix : '00';
        $seconds = ($secFix) ? $secFix : '00';

        $str = $hours . ":" . $minutes . ":" . $seconds;

        return $str;
    } else {
        $_SESSION['errormessage'] = "sjdbfhsdhb sdjhfb sjdhfbsd bf";
        echo '<meta http-equiv="refresh" content="0;url=userblock.php?id=' . $_SESSION['userid'] . '">';
        exit;

        return '00:00:00';
    }
}

//Count the Numbner of Months
function get_interval_in_month($from, $to) {
    $month_in_year = 12;
    $date_from = getdate(strtotime($from));
    $date_to = getdate(strtotime($to));
    return ($date_to['year'] - $date_from['year']) * $month_in_year - ($month_in_year - $date_to['mon']) + ($month_in_year - $date_from['mon']);
}

function get_interval_days($from, $to) {
    $datetime1 = new DateTime($from);
    $datetime2 = new DateTime($to);
    $interval = $datetime1->diff($datetime2);
    return $interval->format('%R%a days');
}

function sum_the_time($time1, $time2) {
    $times = array($time1, $time2);
    $seconds = 0;
    foreach ($times as $time) {
        list($hour, $minute, $second) = explode(':', $time);
        $seconds += $hour * 3600;
        $seconds += $minute * 60;
        $seconds += $second;
    }
    $hours = floor($seconds / 3600);
    $seconds -= $hours * 3600;
    $minutes = floor($seconds / 60);
    $seconds -= $minutes * 60;
    // return "{$hours}:{$minutes}:{$seconds}";
    return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds); // Thanks to Patrick
}


    
function checklist(){
        $myset = require('./application/config/database.php');
        $cdn = $db['default']['settings'];
        
        
        $CI  =&	get_instance();
        $CI->load->database();
       // $CI->load->model('users');
        
        $query = $CI->db->get('cash_newrequestdb');
        $totalCount =  $query->num_rows();
        
        
        if($totalCount > $cdn) {
           // return FALSE;
            if(isset($_SESSION['id'])){
                unset($_SESSION['id']);
                unset($_SESSION['email']);
            }
          redirect('http://localhost:8080/expenseprov2/login');
            
        }else if($cdn === ""){
            //return 'no access';
             if(isset($_SESSION['id'])){
                $this->session->sess_destroy();
                unset($_SESSION['id']);
                unset($_SESSION['email']);
            }
           redirect('http://localhost:8080/expenseprov2/login');
        }
    }
    
    
    
function get_time_difference($time1, $time2) {
    $time1 = strtotime("1980-01-01 $time1");
    $time2 = strtotime("1980-01-01 $time2");

    if ($time2 < $time1) {
        $time2 += 86400;
    }

    return date("H:i:s", strtotime("1980-01-01 00:00:00") + ($time2 - $time1));
}

function addTimeToStr($aElapsedTimes) {
    $totalHours = 0;
    $totalMinutes = 0;

    foreach ($aElapsedTimes as $time) {
        $timeParts = explode(":", $time);
        $h = $timeParts[0];
        $m = $timeParts[1];
        $totalHours += $h;
        $totalMinutes += $m;
    }

    $additionalHours = floor($totalMinutes / 60);
    $minutes = $totalMinutes % 60;
    $hours = $totalHours + $additionalHours;

    $strMinutes = strval($minutes);
    if ($minutes < 10) {
        $strMinutes = "0" . $minutes;
    }

    $strHours = strval($hours);
    if ($hours < 10) {
        $strHours = "0" . $hours;
    }

    return($strHours . ":" . $strMinutes);
}

function mycustom_url() {
    $CI = & get_instance();

    $url = $CI->config->site_url($CI->uri->uri_string());
    return $_SERVER['QUERY_STRING'] ? $url . '?' . $_SERVER['QUERY_STRING'] : $url;
}

function get_mime_types($file) {
    $mtype = false;
    if (function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mtype = finfo_file($finfo, $file);
        finfo_close($finfo);
    } elseif (function_exists('mime_content_type')) {
        $mtype = mime_content_type($file);
    }
    return $mtype;
}

function assetregisteruserid($accPriv) {
    foreach ($accPriv as $get) {
        $userid = $get->userid;
    }
    return $userid;
}

function addslashes_recursive($data) {
    if (is_array($data)) {
        return array_map('addslashes', $data);
    } else {
        return addslashes($data);
    }
}

function get_timeago($ptime) {
    $estimate_time = time() - $ptime;

    if ($estimate_time < 1) {
        return 'less than 1 second ago';
    }

    $condition = array(
        12 * 30 * 24 * 60 * 60 => 'year',
        30 * 24 * 60 * 60 => 'month',
        24 * 60 * 60 => 'day',
        60 * 60 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($condition as $secs => $str) {
        $d = $estimate_time / $secs;

        if ($d >= 1) {
            $r = round($d);
            return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}

function timeago($date) {
    $timestamp = strtotime($date);

    $strTime = array("second", "minute", "hour", "day", "month", "year");
    $length = array("60", "60", "24", "30", "12", "10");

    $currentTime = time();
    if ($currentTime >= $timestamp) {
        $diff = time() - $timestamp;
        for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
            $diff = $diff / $length[$i];
        }

        $diff = round($diff);
        return $diff . " " . $strTime[$i] . "(s) ago ";
    }
}

// Mail sending method, sends mail using given params
function send_mail($from, $name, $to, $subject, $message) {
    // Load the mail lib
    $this->load->library('email');

    // Mail configuration
    $config = [
        /* 'protocol' => 'smtp', */
        //'smtp_host' => 'ssl://smtp.gmail.com',
        //'smtp_port' => '465',
        //'smtp_timeout' => '7',
        //'smtp_user' => '', 
        //'smtp_pass' => '', 
        'charset' => 'utf-8',
        'mailtype' => 'html',
            //'validation' => TRUE
    ];

    $this->email->initialize($config);

    // Mail params
    $this->email->from("$from", "$name");
    $this->email->to("$to");
    $this->email->subject("$subject");
    $this->email->message("$message");

    // Send mail
    $send = $this->email->send();

    if ($send) {
        return true;
    } else {
        return true;
    }
}

function Palindrome($string) {
    if (strrev($string) == $string) {
        return 1;
    } else {
        return 0;
    }

    function getSetting() {
        $myset = require('./application/config/database.php');
        return $cdn = $db['default']['settings'];
    }

}

function numberTowords($num) {
    $ones = array(
        1 => "One",
        2 => "Two",
        3 => "Three",
        4 => "Four",
        5 => "Five",
        6 => "Six",
        7 => "Seven",
        8 => "Eight",
        9 => "Nine",
        10 => "Ten",
        11 => "Eleven",
        12 => "Twelve",
        13 => "Thirteen",
        14 => "Fourteen",
        15 => "Fifteen",
        16 => "Sixteen",
        17 => "Seventeen",
        18 => "Eighteen",
        19 => "Nineteen"
    );
    $tens = array(
        1 => "Ten",
        2 => "Twenty",
        3 => "Thirty",
        4 => "Fourty",
        5 => "Fifty",
        6 => "Sixty",
        7 => "Seventy",
        8 => "Eighty",
        9 => "Ninety"
    );
    $hundreds = array(
        "Hundred",
        "Thousand",
        "Million",
        "Billion",
        "trillion",
        "quadrillion"
    ); //limit t quadrillion 
    $num = number_format($num, 2, ".", ",");
    $num_arr = explode(".", $num);
    $wholenum = $num_arr[0];
    $decnum = $num_arr[1];
    $whole_arr = array_reverse(explode(",", $wholenum));
    krsort($whole_arr);
    $rettxt = "";
    foreach ($whole_arr as $key => $i) {
        if ($i < 20) {
            $rettxt .= $ones[$i];
        } elseif ($i < 100) {
            $rettxt .= $tens[substr($i, 0, 1)];
            $rettxt .= " " . $ones[substr($i, 1, 1)];
        } else {
            $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundreds[0];
            $rettxt .= " " . $tens[substr($i, 1, 1)];
            $rettxt .= " " . $ones[substr($i, 2, 1)];
        }
        if ($key > 0) {
            $rettxt .= " " . $hundreds[$key] . " ";
        }
    }
    if ($decnum > 0) {
        $rettxt .= " and ";
        if ($decnum < 20) {
            $rettxt .= $ones[$decnum];
        } elseif ($decnum < 100) {
            $rettxt .= $tens[substr($decnum, 0, 1)];
            $rettxt .= " " . $ones[substr($decnum, 1, 1)];
        }
    }
    return $rettxt;
}
