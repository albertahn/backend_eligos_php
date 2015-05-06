<?php

class category_model extends model {

function __construct() {
    parent::__construct();
}


//for side panel
    function category_change($category){
        $sth = $this->db->prepare('SELECT * FROM `meeting` WHERE `category` = :category ');
        $sth->execute(array(
            ':category'=>$category
                ));
       return $sth->fetchAll();
        
    }
          
          
      
        

}
