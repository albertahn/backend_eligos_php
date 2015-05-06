<?php

class category extends controller  {

function __construct() {
		parent::__construct();
                 $this->view->css = array('category/css/category.css');
                 $this->view->js = array('category/js/category.js');
		
		}
    function category_change($category){
       $this->view->category_change= $this->model->category_change($category);
        $this->view->render('category/index');
        
    }
                

}


?>