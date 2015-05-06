<?php

class map extends controller  {

public function __construct() {
		parent::__construct();
              //  $this->view->css = array('product/css/product.css');
              //  $this->view->js = array('product/js/product.js');
             
                session::init();
                //$logged = session::get('loggedin');
              
                
                
                
             }
             
        
                
         //inside group
                
    public function show_friends_meetings($id){
         //fetch individual group
                    
                     $this->model->show_friends_meetings($id);
                     
         
                         }
                         
                         
     function update_my_position($lat, $lng){
                             
            $this->model->update_my_position($lat, $lng); 
                         }
        
               
                 

}

