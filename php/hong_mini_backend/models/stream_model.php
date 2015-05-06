<?php

class stream_model extends model {

function __construct() {
    parent::__construct();
}


          
      public function published_walls(){
          
          
          $sth = $this->db->prepare('SELECT * FROM `wall_chat_view` WHERE `publish`=1 AND `members_index`=`wall_index` ORDER BY `chat_index` DESC LIMIT 0,20');
          $sth->execute();
          $thisman = $sth->fetchAll();
         
       echo json_encode($thisman);
   
      }
      
      public function more_pub_walls($chat_id){
          
          
          $sth = $this->db->prepare('SELECT * FROM `wall_chat_view` WHERE `publish`=1 AND `chat_index`< :lastIndex ORDER BY `chat_index` DESC LIMIT 0,20');
          $sth->execute(array(':lastIndex'=>$chat_id));
          $thisman = $sth->fetchAll();
         
       echo json_encode($thisman);
   
      }
     
     
        

}
