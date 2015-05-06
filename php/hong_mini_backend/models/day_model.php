<?php

class day_model extends model {

function __construct() {
    parent::__construct();
}


function update_day($data){
    
   
                                  $sth = $this->db->prepare('UPDATE `member_has_course` 
                                  SET 
                                  `day` = :day
                                    WHERE `course_index` = :course_index
                                    AND `members_index` =:members_index
                                    ');
                                 $sth->execute(array(
                                ':day'=>$data['total_days'],
                                ':course_index'=>$data['habit_index'], 
                                ':members_index'=>session::get('index')
                             
                                ));
}



function update_success($data){
    
     $sth = $this->db->prepare('UPDATE `member_has_course` 
                                  SET 
                                  `success` = :success
                                    WHERE `course_index` = :course_index
                                    AND `members_index` =:members_index
                                    ');
                                 $sth->execute(array(
                                ':success'=>$data['total_days'],
                                ':course_index'=>$data['habit_index'], 
                                ':members_index'=>session::get('index')
                             
                                ));
    
}
          
          
      
        

}
