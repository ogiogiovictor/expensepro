<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('functions.php');
 
class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
       $this->load->view('testing');
    }
 
    
     public function testing(){
        //$filename = "public/documents/Capture.png";
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        echo finfo_file($finfo, "public/documents/now.msg");
        finfo_close($finfo);
    }
    
  
   
   public function upload() {
       $this->load->view('testing');
    }
    
    public function fileupload(){
        $name = $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
        $size = $_FILES['file']['type'];

        $tmp_name = $_FILES['file']['tmp_name'];
        $getexplod = explode(".", $name);
        $explode = end($getexplod);
        echo "<br/>  ";
        echo $explode;
        if(isset($name)){

                if(!empty($name)){
                $location = 'public/documents/';
                    if(move_uploaded_file($tmp_name, $location.$name)){
                            echo "file uploaded";
                    }
                }else{

                echo "please choose a file";
                }

        }
        
        
        $ext = pathinfo($location.$name, PATHINFO_EXTENSION);
        var_dump($ext);
        if($ext == 'msg'){
            echo "Yes";
        }
        
    }
  
}
