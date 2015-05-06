<?php

class file extends controller  {

function __construct() {
		parent::__construct();
                
		session::init();
                $logged = session::get('loggedin');
                        if ($logged == false){

                            session::destroy();
                            header('location: '.URL. 'login');
                            exit;

                        }
                       // $this->view->js = array('dashboard/js/default.js');
                
                
		
		}
                
              
     function course_upload_page($course_index){
         
         $this->view->course_index=$course_index;
         $this->view->render('file/course_upload_page');
     }
     
     function upload_course_file(){
       /*  
         echo'<pre>';
         print_r($_POST);
         
         print_r($_FILES);
           echo'</pre>';
        */   
           
     
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
     $data = array();
    
     $data['description'] = mysqli_real_escape_string($dbc, trim($_POST['description']));
     $data['course_index'] = mysqli_real_escape_string($dbc, trim($_POST['course_index']));
     
     
     $data['file_name']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file][name]));
     $data['file_type']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file][type]));
      $data['file_size']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file][size]));
      $data['tmp_name']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file]['tmp_name']));
    // print_r( $_FILES);
    
         
     if(!empty($data['file_name'])){
          
         if($data['file_size']<41943040){
             
           $this->model->upload_course_file($data);    
           
         }else{ //file too big
              header('location: '.URL.'error/valid_file/');
             
         }
          
           
     
     }else{
         header('location: '.URL.'error/valid_file/');
     }
         
     }
     
//download it     
     function download_product_file($file_name){
         
       $this->model->download_product_file($file_name);
         
     }
     
//delete the file
     
     function delete_file($id, $filename, $course_index){
         
         $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
         
         $id = mysqli_real_escape_string($dbc, trim($id));
         $filename=mysqli_real_escape_string($dbc, trim($filename));
         $course_index=mysqli_real_escape_string($dbc, trim($course_index));
         
         $this->model->delete_file($id, $filename, $course_index);
         
     }

}


?>