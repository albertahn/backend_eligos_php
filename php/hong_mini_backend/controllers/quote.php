<?php

class quote extends controller  {

function __construct() {
		parent::__construct();
                
		}
                

 function get_free_quotes(){
     
     $this->model->get_free_quotes();
     
 }
 
 
 function get_all_store_products(){
     
     $this->model->get_all_store_products();
 }
                
                
}

