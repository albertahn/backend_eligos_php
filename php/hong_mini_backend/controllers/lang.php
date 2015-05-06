<?php

class lang extends controller  {

function __construct() {
		parent::__construct();
                session::init();
		
               // $this->view->js = array('dashboard/js/default.js');
		
		}
function change_language($lang) {
    
                          $lang_array= array();
			$lang_array['lang']=$lang;
                        $this->model->change_language($lang_array);
			
		
		}
                
               
     
}


?>