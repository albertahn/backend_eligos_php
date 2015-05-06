<?php

class index_model extends model 
{
   
function __construct() {
    parent::__construct();
}
    
        
  function bp_man(){
        
        $sth = $this->db->prepare('SELECT * FROM `bp_examples_view` WHERE `blueprint_insert`=:blueprint_insert ORDER BY `has_course_index` DESC LIMIT 0,2000');
        $sth->execute(array(
            
            ':blueprint_insert'=>1
             ));
        
       return $sth->fetchAll();
       
       
        
        
        
    }
 
}
