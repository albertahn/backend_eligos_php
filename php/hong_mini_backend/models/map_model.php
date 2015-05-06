<?php

class map_model extends model 
{
    
    public function __construct()
    {
       
        parent::__construct();
    }
    
    
    //list products
    public function show_friends_meetings($id){
      
           
            $sth = $this->db->prepare('SELECT * FROM `meeting` WHERE `index` IN (SELECT `meeting_index` FROM `member_has_meeting` WHERE `members_index` = :id) ORDER BY `index` DESC LIMIT 0,1');
        $sth->execute(array(':id'=> $id));
       
        $return= $sth->fetchAll();
       
           
       
      echo $_GET['callback'].'('.json_encode($return).')'; 
      
    /*   
        echo '<pre>';
        print_r($json_string);
         echo '<pre>';
      
         */
     }
     
     
     function update_my_position($lat, $lng){
         
         $sth = $this->db->prepare('UPDATE `members` 
                   SET `lat` = :lat,
                       `lng` = :lng
                        WHERE `index` = :member_index

                        ');
         $sth->execute(array(
             
             ':lat'=> $lat,
             ':lng'=> $lng,
             ':member_index'=>session::get('index')
             
             ));
         
         $return="success";
         
         echo $_GET['callback'].'('.json_encode($return).')'; 
       }
     
}
