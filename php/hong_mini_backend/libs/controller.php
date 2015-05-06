<?php
	
	class controller {
	
		function __construct(){
		
		 	$this->view = new view();
                        $this ->db = new database();
                       
		}
                
	
                public function loadModel($name){
                    $path = 'models/'.$name.'_model.php';
                    
                     if (file_exists($path)){
                        require 'models/'.$name.'_model.php';
                            $modelName = $name. '_model';
                            $this->model = new $modelName();
                            
                     }
                     
                        
                  
               
                }
	
	}
