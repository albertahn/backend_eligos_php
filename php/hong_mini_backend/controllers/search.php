<?php

class search extends controller  {

function __construct() {
		parent::__construct();
                
		
               // $this->view->js = array('search/js/search.js');
		 //$this->view->css = array('search/css/search.css');
		}

                
                public function search_all(){
                    
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    $search = mysqli_real_escape_string($dbc, trim($_GET['search']));
                    
                    //users
                   $this->view->search_user=$this->model->search_user($search);
                   $this->view->search_email=$this->model->search_email($search);
                   
                   //products
                   $this->view->search_product_name=$this->model->search_product_name($search);
                   //$this->view->search_product_catergory=$this->model->search_product_catergory($search);
                   
                   //groups
                   $this->view->search_group_name=$this->model->search_group_name($search);
                   $this->view->search_group_location=$this->model->search_group_location($search);
                   $this->view->render('search/search_all');
                   }

                   
                   
        public function search_user($search){
            
             //$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
               //     $search = mysqli_real_escape_string($dbc, trim($_GET['search']));
            
            $this->model->search_user($search);
           // echo $_GET['callback'].'('.json_encode($search).')';
            
        }            

}


?>