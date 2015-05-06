<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class level extends controller  {

function __construct() {
		parent::__construct();
                
               // $this->view->js = array('dashboard/js/default.js');
		
		}//end construct
                
            
    public function update_level(){
       
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $data = array();
                    $data['user_index']=mysqli_real_escape_string($dbc, trim($_POST['user_index']));
                    $data['new_level'] = mysqli_real_escape_string($dbc, trim($_POST['new_level']));
                    
        
        $this->model-> update_level($data);
        
        
        
        
    }//end updeate
    
    
    public function level_ranking(){
        
        $this->model->level_ranking();
        
    }
    
    //get last success date from server to app
    
    
    public function get_last_success_day($user_index){
        $this->model->get_last_success_day($user_index);
        
    }
    
}//end class