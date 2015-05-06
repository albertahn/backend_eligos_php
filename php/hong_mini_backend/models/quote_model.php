<?php

class quote_model extends model 
{
    
    public function __construct()
    {
       
        parent::__construct();
    }
    
    
    function get_free_quotes(){
        
        
    $stha = $this->db->prepare('SELECT * FROM `quotes` where `status` =:free');
    $stha->execute(array(      
      ':free' =>"free"
      )); 
  
   $stream= $stha->fetchAll();
   $json = json_encode($stream);
   echo $json;
     
    }//get free end
    
    
    function get_all_store_products(){
     
    $stha = $this->db->prepare('SELECT * FROM `store_product_view` where `publish` =:yes');
    $stha->execute(array(      
      ':yes' =>"yes"
      )); 
  
   $stream= $stha->fetchAll();
   $json = json_encode($stream);
   echo $json;
     
    
 }
    
}
