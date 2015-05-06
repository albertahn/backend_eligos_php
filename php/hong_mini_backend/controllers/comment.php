<?php

class comment extends controller  {

function __construct() {
		parent::__construct();
                
		session::init();
               
		}
                
function get_course_comments($id) {
    
                        $this->model->get_course_comments($id);
		
		}
                
  function get_course_replies($comment_index){
      
      $this->model->get_course_replies($comment_index);
      
      
  }
  
 function get_one_comment($comment_index){
     
     $this->model->get_one_comment($comment_index);
 }
                
  function insert_course_comment(){
      
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $data = array();
                    $data['courses_index']=mysqli_real_escape_string($dbc, trim($_POST['course_index']));
                    $data['comment'] = mysqli_real_escape_string($dbc, trim($_POST['comment']));
                    $data['comment']= stripslashes($data['comment']);
                    
                    $data['user_index']= mysqli_real_escape_string($dbc, trim($_POST['user_index']));
                      
     $data['file_name']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file][name]));
     $data['file_type']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file][type]));
      $data['file_size']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file][size]));
      $data['tmp_name']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file]['tmp_name']));
    
      
      //send notifications to entire ppl in goal    
     // email_static::goal_mail($id, session::get('profile_picture'), session::get('username'), $data['comment']);
    
                   
                    if(!empty($data['comment']) && $data['user_index']!=="" &&  $data['user_index']!=="1"){
                        
                        //check if image
                        
                        if($data['file_name']==""){
                            
      //this is for when no file is attached                      
                            
                            //echo json_encode($data);
                               $this->model->insert_course_comment($data);
                               
                               
                                
                        }else{
                        //file size
                                 if($data['file_size']<41943040){
             
                                  $this->model->course_picture_comment($data);    
                                   

                                 }else{ //file too big
                                      echo 'file is too big...';

                                 }
                                 
                        }
                        
                         
                    }else{
                      echo 'Write something.';
                        
                    }
                    
                    
        
  } //end insert_course_comment
 //delete_course_comment 
  function delete_course_comment($comment_index){
      
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $data = array();
                    
                    $data['comment_index'] = mysqli_real_escape_string($dbc, trim($comment_index));
                    
        if(!empty($data['comment_index'])){
            
        $this->model->delete_course_comment($data);
        
        }
        
  }
  
  //delete comment for course
  
  public function check_ban($user_index){
      
      $this->model->check_ban($user_index);
  }
  
      
      
   function show_profile_comments($id){
       
        // echo $_GET['callback'].'('.json_encode($id).')';  
       
         $this->model->show_profile_comments($id);
   }   
                
  function delete_profile_comment($id){
      
      
      $this->model->delete_profile_comment($id);
  }
  
  function insert_comment_wall($id){ //old versions
    
      
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $data = array();
                    $data['wall_index']=$id;
                    $data['chat'] = mysqli_real_escape_string($dbc, trim($_POST['chat']));
                    $data['chat']= stripslashes($data['chat']);
                    
                      
     $data['file_name']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file][name]));
     $data['file_type']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file][type]));
      $data['file_size']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file][size]));
      $data['tmp_name']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file]['tmp_name']));
    
      
      
      
     // print_r($_POST);
                   
                    if(!empty ($data['chat'])){
                        
                        //check if image
                        
                        if($data['file_name']==""){
    //this one is the one without file uploading                        
                                $this->model->insert_profile_comment($data);
                        }else{
                        //file size
                                 if($data['file_size']<41943040){
             
                                     $this->model->insert_comment_wall($data);    
                                   

                                 }else{ //file too big
                                      echo 'file is too big...';

                                 }
                        }
                    }else{
                      echo 'fill out all the fields!';
                        
                    }
      
  }//end insert comment wall
  
  
  function update_num_reply($comment_index){
      
      $this->model->update_num_reply($comment_index);
  }
  
  public function like_comment($comment_index){
      
      $this->model->like_comment($comment_index);
  }
      
  //new version comment
  function test_course_comment($input_text){
      
     // echo print_r($_POST);
      
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
     
     mysqli_query('set names utf8');
     
     
                    
                    $data = array();
                    $data['courses_index']=mysqli_real_escape_string($dbc, trim($_POST['course_index']));
                    $data['comment'] = mysqli_real_escape_string($dbc, trim($input_text));//$_POST['comment']));
                    $data['comment']= stripslashes($data['comment']);
                    
                    $data['user_index']= mysqli_real_escape_string($dbc, trim($_POST['user_index']));
                      
     $data['file_name']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file][name]));
     $data['file_type']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file][type]));
      $data['file_size']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file][size]));
      $data['tmp_name']=  mysqli_real_escape_string($dbc, trim($_FILES[upload_file]['tmp_name']));
    
      
      //send notifications to entire ppl in goal    
     // email_static::goal_mail($id, session::get('profile_picture'), session::get('username'), $data['comment']);
      
    
     // echo json_encode($data);
                   
                    if(!empty($data['comment']) && $data['user_index']!=="" &&  $data['user_index']!=="1"){
                        
                        //check if image
                        
                        if($data['file_name']==""){
                            
      //this is for when no file is attached                      
                            
                            //echo json_encode($data);
                               $this->model->insert_course_comment($data);
                                
                        }else{
                        //file size
                                 if($data['file_size']<41943040){
             
                                  $this->model->course_picture_comment($data);    
                                   

                                 }else{ //file too big
                                      echo 'file is too big...';

                                 }
                        }
                        
                        
                      
                    }else{//empty
                      echo 'Write something.';
                        
                    }
                    
                  //gcm push
                    
                    
                    
   
  }//end test


}//end class
