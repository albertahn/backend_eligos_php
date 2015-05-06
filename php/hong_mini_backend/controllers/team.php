<?php





class team extends controller  {

public function __construct() {
		parent::__construct();
//                
                
                $this->view->css = array('team/css/team.css');
             
                
                
             }
           
             public function index(){
                 
                 $this->view->render('team/index');
             }


                   
                
          
                 

}

