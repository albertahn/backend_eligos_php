<?php

class gifts_model extends model {

function __construct() {
    parent::__construct();
}

function show_my_gifts($id){
    
         $sth = $this->db->prepare('SELECT * FROM `meeting` WHERE `index` IN (SELECT `meeting_index` FROM `member_has_meeting` WHERE `members_index` = :id AND `status`=:not_received) ORDER BY `index` DESC');
        $sth->execute(array(
            ':id'=> $id,
            ':not_received'=>'not_received'
            
            ));
       
        $return= $sth->fetchAll();
      
      echo $_GET['callback'].'('.json_encode($return).')';
       
		}
                
                
function gift_lists_near($id){
     
         $sth = $this->db->prepare('SELECT * FROM `gift_sender_view` WHERE `meeting_index` = :id AND `status`=:admin ORDER BY `meeting_index` DESC');
        $sth->execute(array(
            ':id'=> $id,
            ':admin'=>'admin'
            
            ));
       
        $return= $sth->fetchAll();
      
      echo $_GET['callback'].'('.json_encode($return).')';
 }  
 
 
 //received update
 function received_gift($userID, $giftID){
     
     $sth = $this->db->prepare('UPDATE member_has_meeting
                SET status = :received
                WHERE `members_index` = :members_index
                AND `meeting_index` = :meeting_index
             ');
        $sth->execute(array(
            ':received'=> 'received',
            ':members_index'=>$userID,
            ':meeting_index'=>$giftID
            
            ));
       
        $return= "successs";
      
      echo $_GET['callback'].'('.json_encode($return).')';
     
 }

}
