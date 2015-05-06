<?php

class stream extends controller  {

function __construct() {
		parent::__construct();
                
                $this->view->css = array('stream/css/stream.css');
		
                $this->view->js = array('stream/js/stream.js');
		
		}
  //stream              
                
                function published_walls() {
		     //$this->view->product_social = $this->model->product_social();
                     $this->model->published_walls();
                 
		}
                
                function more_pub_walls($chat_id){
                    
                    $this->model->more_pub_walls($chat_id);
                }

}

