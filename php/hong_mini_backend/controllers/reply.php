<?php

class reply extends controller  {

function __construct() {
		parent::__construct();
                
		session::init();
                /*$logged = session::get('loggedin');
                
                if ($logged == false){
                    
                    session::destroy();
                    header('location: '.URL. 'login');
                    exit;
                    
                }*/
               // $this->view->js = array('dashboard/js/default.js');
		
		}
                
                
  public function insert_reply(){
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $data = array();
                    
                    $data['user_index']=  mysqli_real_escape_string($dbc, trim($_POST['user_index']));
                    $data['comment_index']=  mysqli_real_escape_string($dbc, trim($_POST['comment_index']));
                    $data['courses_index']=  mysqli_real_escape_string($dbc, trim($_POST['courses_index']));
                    $data['reply'] = mysqli_real_escape_string($dbc, trim($_POST['reply']));
                    $data['reply'] =stripslashes($data['reply']);
      
      
                    //echo json_encode($data);
      $this->model->insert_reply($data);
      
      
  }      
  
  
  
  
  public function show_replies($comment_id){
      
      $this->model->show_replies($comment_id);
  }

  
  public function test_insert_reply($inputText){
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                   mysqli_query('set names utf8'); 
                    $data = array();
                    
                    $data['user_index']=  mysqli_real_escape_string($dbc, trim($_POST['user_index']));
                    $data['comment_index']=  mysqli_real_escape_string($dbc, trim($_POST['comment_index']));
                    $data['courses_index']=  mysqli_real_escape_string($dbc, trim($_POST['courses_index']));
                    $data['reply'] = mysqli_real_escape_string($dbc, trim($inputText));
                    $data['reply'] =stripslashes($data['reply']);
      
      
                    //echo json_encode($data);
      $this->model->insert_reply($data);
      
  }//test insert reply

}


?>