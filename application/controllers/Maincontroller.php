<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class Maincontroller extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    
    public static $SMS_SENDER = "Cileasing";
    public static $RESPONSE_TYPE = 'json';
    public static $SMS_USERNAME = 'cileasinginfotech@gmail.com';
    public static $SMS_PASSWORD = 'flower12345';
   
    
    
    public function __construct() {
        parent::__construct();


        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        $this->gen->checkLogin();
        $this->gen->mainSetting();

        $this->load->model('maintenance');
        $this->load->helper('text');
    }

/////////////////////////// MAIN CONTROLLER IS A COUSTOM CONTROLLER YOU CAN EXTEND ///////////////////////////

    protected function automatedLoop($sessionID, $getResult) {
        $gid = "";
        if ($getResult) {
            foreach ($getResult as $value) {
                $userid = $value->userid;
                $explode = explode(",", $userid);
                if (in_array($sessionID, $explode)) {
                    $gid .= $value->gid . ",";
                }
            }
            //Removing the last comman in the loop
            //$gid = rtrim($gid,',');
            //$gid = substr($gid, 0, -1);
            // $gid =  mb_substr($gid, 0, -1);
            $gid = mb_substr($gid, 0, -1);
            return $gid;
        }
    }

    public static function haveAccess($sess_id, $returnIDs) {

        $finalResult = explode(",", $returnIDs);

        if (in_array($sess_id, $finalResult)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    
    public static function initiateSmsActivation($phone_number, $message) {
        $isError = 0;
        $errorMessage = true;

        // $key = [ 'username' => self::$SMS_SENDER,  'password' => self::$SMS_PASSWORD];
       //  print_r($key);
       
        //Preparing post parameters
        $postData = array(
                    'username' => self::$SMS_USERNAME,
                    'password' => self::$SMS_PASSWORD,
                    'message' => $message,
                    'sender' => self::$SMS_SENDER,
                    'mobiles' => $phone_number,
                    'response' => self::$RESPONSE_TYPE
        );

      
       // $url = "http://portal.bulksmsnigeria.com/api/";
        $url = "http://portal.nigeriabulksms.com/api/"; 

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));


        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        //get response
        $output = curl_exec($ch);


        //Print error if any

        if (curl_errno($ch)) {
            $isError = true;
            $errorMessage = curl_error($ch);
        }
        curl_close($ch);



        if($output){
            return $output;
        }else{
            return "";
        }
      
    }
    
    
    
    
}

// End of Class Home
