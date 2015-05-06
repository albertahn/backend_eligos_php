<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class module extends controller  {

function __construct() {
		parent::__construct();
                
               
		}
                
   public function create_lesson(){
       
         $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
         
     $data['file_name']=  mysqli_real_escape_string($dbc, trim($_FILES['file']['name']));
     $data['file_type']=  mysqli_real_escape_string($dbc, trim($_FILES['file']['type']));
      $data['file_size']=  mysqli_real_escape_string($dbc, trim($_FILES['file']['size']));
      $data['tmp_name']=  mysqli_real_escape_string($dbc, trim($_FILES['file']['tmp_name']));
    
      $data['lesson_title'] = mysqli_real_escape_string($dbc, trim($_POST['lesson_title']));
      $data['descrip'] = mysqli_real_escape_string($dbc, trim($_POST['descrip']));
      $data['user_index'] = mysqli_real_escape_string($dbc, trim($_POST['user_index']));
      $data['youtube'] = mysqli_real_escape_string($dbc, trim($_POST['youtube']));
      $data['course_index'] = mysqli_real_escape_string($dbc, trim($_POST['course_index']));
    
       $this->model->create_lesson($data);
       
   }
   
   public function get_module($mod_index){
       
       $this->model->get_module($mod_index);
   }
   
   public function delete_module($mod_index){
       
       $this->model->delete_module($mod_index);
       
       
   }
   
   public function all_modules(){
       
       $this->model->all_modules();
   }
                
                
}