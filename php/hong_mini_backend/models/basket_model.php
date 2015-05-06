<?php

class basket_model extends model {

function __construct() {
    parent::__construct();
}

function basket($meeting_index) {
    
    //member_has_meeting as admin insert
         $sth = $this->db->prepare('INSERT INTO `member_has_meeting` (`members_index`, `meeting_index`, `status`) 
                                                  VALUES (:members_index, :meeting_index, :norm)');
        
         $sth->execute(array( 
            ':members_index'=>session::get('index'),
            ':meeting_index'=>$meeting_index,
            ':norm'=>'norm'
            ));
    
}

function un_basket($meeting_index){
     $sth = $this->db->prepare('DELETE FROM `member_has_meeting` WHERE `meeting_index`=:meeting_index AND `members_index`=:members_index');
    $sth->execute(array( 
            ':members_index'=>session::get('index'),
            ':meeting_index'=>$meeting_index
            ));
    
}
          
      
        

}
