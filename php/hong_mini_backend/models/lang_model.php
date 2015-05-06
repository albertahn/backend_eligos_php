<?php

class lang_model extends model {

function __construct() {
    parent::__construct();
}


function change_language($lang_array){
    
    $sth = $this->db->prepare('UPDATE `members` SET `language`=:language WHERE `index` = :id');
          
          $sth->execute(array(
              ':id' => session::get('index'),
               
              ':language'=>$lang_array['lang']
            ));
          
          session::set('language', $lang_array['lang']);
           header('location: '.URL);  
           
           $this->db=null;
}
      
        

}
