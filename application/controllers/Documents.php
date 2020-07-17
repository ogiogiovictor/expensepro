<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('functions.php');

class Documents extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Phone : 07038807891
     */
    public function __construct() {
        parent::__construct();

        $this->load->driver('cache');
        $this->cache->clean();

        $this->output->cache(0);
        
        $pageTitle = "C&I :: Expense Pro Management";
        $values = ['pageTitle' => $pageTitle];
        $this->load->view('header', $values);
        //$this->load->model("datatablemodels"); 
        $this->gen->checkLogin();
    }

    public function index() {
        
        $title = "EXPENSE PRO :: MY DOCUMENT";

        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        
        $getallresult = $this->generalmd->getdresult("id", "cash_newrequestdb", "sessionID", $_SESSION['email']);
        
       
        $menu = $this->load->view('menu', '', TRUE);
        $sidebar = $this->load->view('sidebar', '', TRUE);
        $footer = $this->load->view('footer', '', TRUE);
        $values = ['title' => $title, 'getApprovalLevel' => $getApprovalLevel,  'getallresult' => $getallresult, 'sidebar' => $sidebar, 'menu' => $menu, 'footer' => $footer];
        $this->load->view('indexofhome/mydocuments', $values);
    }

    ////////////////////////////////////////////START OF INDEX2 WITH SERVER SIDE PROGRAMMING //////////////////////////////

    
    public function getallhod(){
       $json = [];
       
        $getallhod = $this->generalmd->getdresult("*", "cash_usersetup", "", "");
       //$data = [];
      
            if($getallhod){

            foreach($getallhod as $get){
                $id = $get->id;
                $fname = $get->fname;
                $lname = $get->lname;
                $email = $get->email;
                $alternativeEmail = $get->alternativeEmail;
             
           
            
            $data[] = ['dopt' => $id, 'fname'=>$fname, 'lname'=>$lname, 'email'=>$email, 'alternativeEmail'=>$alternativeEmail];
            }
            
            $json = ['ci'=>$data];
        }
     $this->output->set_content_type('application/json')->set_output(json_encode($json));
   }
   
   
   public function sendoctouser(){
       $json = [];
       if(isset($_POST['chkveg'])){
           
           $sendersEmail = $_SESSION['email'];
           $sendingToEmail =  $this->input->post('chkveg');
           $myCheck =  $this->input->post('checkbx');
           
           //Check if the document has ben shared before        $table, $columfield, $columvalue, $columfield2, $columvalue2, $columfield3, $columvalue3
            $checksharedbefore = $this->generalmd->getsharedbefore("sharedoc", "senderEmail", $sendersEmail, "sento", $sendingToEmail, "	documentID", $myCheck) ;
           if($checksharedbefore == TRUE){
              $json = ['status'=>0, 'msg'=>'That Document have been shared previously with this user'];     
           }else{
           //Insert into Shared Table
           $dataoption = [];
           $dataoption['senderEmail'] = $sendersEmail;
           $dataoption['sento'] = $sendingToEmail;
           $dataoption['documentID'] = $myCheck;
           
           $getdocName = $this->generalmd->getsinglecolumn("origFilename", "cash_fileupload", "fid", $myCheck);
            $options = array(
			'table' => 'sharedoc',
			'data'  => $dataoption
		   );
            
            $insertedFileId = $this->generalmd->create( $options );
            if($insertedFileId){
              
             $message = "<div>YOUR HAVE A SHARED DOCUMENT</div>";
             $message .= "<div>$sendersEmail shared a document with you, Kindly click on the link to view</div><br/>";
             $message .= "<div>Click here for details:</div>"
             . "<a href=".base_url()."public/documents/$getdocName>View Document</a>";
                        
	     $message .= "<br/><hr/>This is an automated email please do not reply<p><br/>";
                $config = array(
                    'mailtype' => "html"
                 );

             $this->email->initialize($config);
             $this->email->from("expensepro@c-iprocure.com", "TBS-EXPENSE PRO"); 
             $this->email->to($sendingToEmail);
             $this->email->subject('NEW SHARED DOCUMENT'); 
             $this->email->message($message); 
             $this->email->send();
                        
             $json = ['status'=>1, 'msg'=>'Document Successfully Shared, Please wait you will be redirected'];   
            }
           }
       }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
   }
    
}

// End of Class Home
