<?php

class beck extends controller  {

function __construct() {
		parent::__construct();
                 session::init();
                 
                $this->view->js = array('beck/js/beck.js');
                $this->view->css = array('beck/css/beck.css');
		
		}
function index() {
            
			$this->view->uploads= $this->model->uploads();
                        $this->view->render('beck/index');
		
		}
                
                
                
 function upload_page(){
            
                 $this->view->render('beck/upload_page');
     
 }   
 
 
 function upload_file(){
     
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
     $data = array();
     $data['name'] = mysqli_real_escape_string($dbc, trim($_POST['name']));
     $data['email'] = mysqli_real_escape_string($dbc, trim($_POST['email']));
     $data['major'] = mysqli_real_escape_string($dbc, trim($_POST['major']));
     $data['beck_date'] = mysqli_real_escape_string($dbc, trim($_POST['beck_date']));    
     
     $data['file_name']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file][name]));
     $data['file_type']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file][type]));
    // print_r( $_FILES);
    
         
     if(!empty($data['file_name'])){
         
          
      $this->model->upload_file($data);  
     
     }else{
         echo'upload the file~!';
     }
   
 }   
 
 function login_page(){
     
     $this->view->render('beck/login_page');
     
 }
 
 function login_beck(){
     
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
     $data = array();
     $data['username'] = mysqli_real_escape_string($dbc, trim($_POST['beck_id']));
     $data['password'] = mysqli_real_escape_string($dbc, trim($_POST['password']));
     $this->model->login_beck($data); 
     
     
 }
 
 
 function download_file($file_name){
     
     $this->model->download_file($file_name);
 }
 
 function strobe(){
     $this->view->render('beck/strobe',$noinclude= true);
 }
               
                

}


?>