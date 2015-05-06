<?php

class day extends controller  {

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
                
                

                
    function update_day($habit_index){
        
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $data = array();
                  
                    $data['habit_index'] = mysqli_real_escape_string($dbc, trim($habit_index));
                    
                     $data['total_days'] = mysqli_real_escape_string($dbc, trim($_POST['total_days']));
                     
                     $this->model->update_day($data);
        
    } 
    
    
    function update_success($habit_index){
        
          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $data = array();
                  
                    $data['habit_index'] = mysqli_real_escape_string($dbc, trim($habit_index));
                    
                     $data['total_days'] = mysqli_real_escape_string($dbc, trim($_POST['total_days']));
                     
                     $this->model->update_success($data);
        
    }
}


?>