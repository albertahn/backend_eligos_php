<?php

class blog extends controller  {

function __construct() {
		parent::__construct();
                
		session::init();
                
               // $this->view->js = array('dashboard/js/default.js');
		
		}
function motivation() {
    
                      $this->view->render('blog/motivation', $noinclude= true);
			
		
		}
                
               
                
function change_and_success() {
                       $this->view->render('blog/change_and_success', $noinclude= true); 
    
                         }

}


?>