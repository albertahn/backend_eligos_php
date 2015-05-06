<?php

class feature extends controller  {

function __construct() {
		parent::__construct();
                
                $this->view->js = array('feature/js/feature.js');
                $this->view->css= array('feature/css/feature.css');
		}
                
                
                
    public function show_featured() {
                    $this->model->show_featured();
                }            
                
   public function apply_featured_page(){
       
       $this->view->render('feature/feature_apply_page');
       
   }             
   
   public function insert_expert(){
       
       $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                   $data=array();
                   $data['my_index'] = mysqli_real_escape_string($dbc, trim($_POST['my_index']));
                   $data['blurb'] = mysqli_real_escape_string($dbc, trim($_POST['blurb']));
                   $data['about_me'] = mysqli_real_escape_string($dbc, trim($_POST['about_me']));
                 
                   $data['blurb'] = stripslashes($data['blurb']);
                   $data['about_me'] = stripslashes($data['about_me']);
                   
                   //print_r($data);
       $this->model->insert_expert($data);       
   } //
   
   //get my application
   
   public function get_my_apply($my_index){
       
       $this->model->get_my_apply($my_index);
       
   }
                
                
                
}

