<?php

class notify_model extends model {

function __construct() {
    parent::__construct();
}



   public  function friend_requests() {

         $sth = $this->db->prepare('SELECT * FROM `members_view` WHERE `index` IN (SELECT `my_index` FROM`friends` WHERE `friend_index`=:my_index AND `status`=:pending ORDER BY `index` DESC)');
        $sth->execute(array(
            ':my_index'=>session::get('index'),
            ':pending'=>'pending'
                ));
       $data= $sth->fetchAll();
       
       $json_data=json_encode($data);
       
       echo $json_data;

     }   
     
     
     public function check_my_wall_posts(){
         
         $sth = $this->db->prepare('SELECT * FROM `wall_chat_view` WHERE `wall_index` =:my_index ORDER BY `chat_index` DESC LIMIT 0,10');
        $sth->execute(array(
            ':my_index'=>session::get('index')
                ));
       $data= $sth->fetchAll();
      
       $json_data=json_encode($data);
       
       echo $json_data;
         
     }
     
     public function check_friends_wall_posts(){
         
         
          
         $sth = $this->db->prepare('SELECT * FROM `wall_chat_view` WHERE `wall_index` IN (SELECT `my_index` FROM`friends` WHERE `friend_index`=:my_index AND `status`=:pending ORDER BY `index` DESC)');
        $sth->execute(array(
            ':my_index'=>session::get('index'),
            ':pending'=>'pending'
                ));
       $data= $sth->fetchAll();
      
       $json_data=json_encode($data);
       
       echo $json_data;
         
         
     }

     
     public function notify_comment_toggle($user_index){
         
           $sth = $this->db->prepare('SELECT * FROM `has_device` WHERE `members_index` =:user_index');
        $sth->execute(array(
            ':user_index'=>$user_index
                ));
       $data = $sth->fetchAll();
       
       //print_r($data);
      
        if($data[0]['notify']=="no"){ //update all to yes
       
             $sth2 = $this->db->prepare('UPDATE `has_device` SET `notify` = :yes WHERE `members_index` =:user_index');
        $sth2->execute(array(
            ':user_index'=>$user_index,
            ':yes'=>"yes"
                ));
       
               echo'{"result":"yes"}';
       
        }else{//end if:  update all to no
            
            $sth3 = $this->db->prepare('UPDATE `has_device` SET `notify` = :no WHERE `members_index` =:user_index');
        $sth3->execute(array(
            
            ':user_index'=>$user_index,
            ':no'=>"no"
            
                ));
        
             echo'{"result":"no"}';
            
        }//end else
       
     }//toggle end
     
     
     public function check_mobile_notify($user_index){
         
          $sth = $this->db->prepare('SELECT * FROM `has_device` WHERE `members_index` =:user_index');
        $sth->execute(array(
            ':user_index'=>$user_index
                ));
       $data = $sth->fetchAll();
       
          if($data['0']['notify']=="no"){ //update all to yes
              
              echo'{"result":"no"}';
              
          }else{
              
                $sth2 = $this->db->prepare('UPDATE `has_device` SET `notify` = :yes WHERE `members_index` =:user_index');
        $sth2->execute(array(
            ':user_index'=>$user_index,
            ':yes'=>"yes"
                ));
              
              echo'{"result":"yes"}';
              
          }//end else
        
         
     }//end check notify
      
        

}
