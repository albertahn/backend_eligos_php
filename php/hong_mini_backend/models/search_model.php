<?php

class search_model extends model {

function __construct() {
    parent::__construct();
}


            //earch user my name
	public function search_user($search){
            
          
            
          //$search_exploded = explode(" ", $search);
                   
                  // echo $search;
                        
                      
                     $construct =$this->db->prepare('SELECT * FROM `members` WHERE `username` LIKE :search OR `email` LIKE :search');
                    $construct->execute(array(
                        ':search'=>"%".$search."%"
                        
                    ));
                    
                    
                    $return= $construct->fetchAll();
                    
                   
                    echo json_encode($return);
                    
                    
                    
                }
                    
               //search user by email
                
                public function search_email($search){
            
          
            
          $search_exploded = explode(" ", $search);
                   
                    foreach($search_exploded as $search_each)
                        
                    {
                        
                       
                     $construct =$this->db->prepare('SELECT * FROM `members` WHERE `email` LIKE :search');
                    $construct->execute(array(
                        ':search'=>$search_each
                        
                    ));
                    
                    return $construct->fetchAll();
                    
                   
                    } 
                    
                }
                
               //search product name
                
               public function search_product_name($search){
                   
                    
          $search_exploded = explode(" ", $search);
                   
                    foreach($search_exploded as $search_each)
                        
                    {
                        
                       
                     $construct =$this->db->prepare('SELECT * FROM `meeting` WHERE `product_name` LIKE :search');
                    $construct->execute(array(
                        ':search'=>$search_each
                        
                    ));
                    
                    return $construct->fetchAll();
                    
                   
                    } 
                    
                   
                   
               }
               
               
               
               
             
              
              public function search_group_name($search){
                   $search_exploded = explode(" ", $search);
                   
                    foreach($search_exploded as $search_each)
                        
                    {
                        
                       
                      $construct =$this->db->prepare('SELECT * FROM `group` WHERE `name` LIKE :search');
                    $construct->execute(array(
                        ':search'=>$search_each
                        
                    ));
                    
                    return $construct->fetchAll();
                    
                   
                    } 
                    
                  
                  
              }
              
              
              //group location
              
              public function search_group_location($search){
                  $search_exploded = explode(" ", $search);
                   
                    foreach($search_exploded as $search_each)
                        
                    {
                        
                       
                      $construct =$this->db->prepare('SELECT * FROM `group` WHERE `location` LIKE :search');
                    $construct->execute(array(
                        ':search'=>$search_each
                        
                    ));
                    
                    return $construct->fetchAll();
                    
                   
                    } 
                  
                  
                  
              }
              
              
                
                
        

}
