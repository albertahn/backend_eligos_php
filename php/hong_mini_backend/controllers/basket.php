<?php

class basket extends controller  {

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
//in basket               
function basket($meeting_index) {
    
                       
                        $this->model->basket($meeting_index);
			
		
		}
//out of basket                
            function un_basket($meeting_index) {
    
                       
                        $this->model->un_basket($meeting_index);
			
		
		}
                
}


?>