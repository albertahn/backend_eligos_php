<?php

class index extends controller {
           
	function __construct() {
		parent::__construct();
                 session::init();
	
	}
			function index() {
                            
			
                           
                                
                                
                               $this->view->render('index/index');
			      //header('location:'.URL.'stream/');
                             
                         
		       
		}
}

?>