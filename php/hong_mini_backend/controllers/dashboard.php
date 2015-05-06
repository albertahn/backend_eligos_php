<?php

class dashboard extends controller  {

function __construct() {
		parent::__construct();
                
		session::init();
                $logged = session::get('loggedin');
                if ($logged == false){
                    
                    session::destroy();
                    header('location: '.URL. 'login');
                    exit;
                    
                }
                $this->view->js = array('dashboard/js/default.js');
		
		}
function index() {
			
			$this->view->render('dashboard/index');
		
		}
                
               
                
                function xhrInsert()
                {
                    $this->model->xhrInsert();
                    
                }
                
                function xhrGetListings()
                {
                    $this->model->xhrGetListings();
                }
                
                function xhrDeleteListing(){
                    $this->model->xhrDeleteListing();
                }


}


?>