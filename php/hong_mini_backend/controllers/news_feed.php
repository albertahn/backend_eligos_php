<?php

class news_feed extends controller  {

function __construct() {
		parent::__construct();
                
                $this->view->js = array('news_feed/js/news_feed.js');
                $this->view->css = array('news_feed/css/news_feed.css');
                
		session::init();
                $logged = session::get('loggedin');
                if ($logged == false){
                    
                    session::destroy();
                    header('location: '.URL. 'login');
                    exit;
                    
                }
                
		
		}
                
                
                
function index() {
    
    //echo $_GET['callback'].'(' . "{'fullname' : 'Jeff Hansen', 'cop':'ho', 'hi':'hi'}" . ')';
    /*
			$this->view->has_group=$this->model->has_group();
                       $this->view->has_friend=$this->model->has_friend();
                        $this->view->friend_request_role=$this->model->friend_request_role();
			//$this->view->render('news_feed/index');
		*/
                $this->view->has_group=$this->model->newsFeed();
    
		}
                  
               
                
               

}


?>