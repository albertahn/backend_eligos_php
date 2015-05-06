<?php

class reply_model extends model {

function __construct() {
    parent::__construct();
}



public function insert_reply($data){
    
    
     $isban= $this->check_ban($data['user_index']);
     
     if($isban =="0"){
         
         $sth= $this->db->prepare('INSERT INTO `comment` 
             (`comment`, `members_index`, `courses_index`, `reply_to`) 
      VALUES (:comment, :members_index, :courses_index, :reply_to)');


                       $sth->execute(array(
                           
                           ':comment'=>$data['reply'],
                           ':members_index'=>$data['user_index'],
                           ':courses_index'=>$data['courses_index'],
                           ':reply_to'=>$data['comment_index']
                           
                           ));
                      
              $comment_index = $this->db->lastInsertId();
                      
                      
                  $sth2= $this->db->prepare('SELECT * FROM `course_comment_view` WHERE
                            `comment_index` =:comment_id');

                       

                       $sth2->execute(array(':comment_id'=> $comment_index));
                      $data2= $sth2->fetch();
                      

                        echo json_encode($data2);  

                       gcm_push_static::group_chat($data['user_index'], $data['reply']);

         }else{//not banned
                                   //for peopl banned 
                                   
                                   echo '{"members_index":"1", "username":"error ask Albert", "profile_picture":"ask", "comment_index":"1",  "comment_text":"error there is. Ask Albert for help."}';
                               
                                   
         }//not banned
      
      
  }
  
  
   function check_ban($user_index){
         
            $sth2= $this->db->prepare('SELECT * FROM `members` WHERE `index`=:user_index AND `status` =:ban ');

                       $sth2->execute(array(
                           ':user_index'=> $user_index,
                           ':ban' =>"ban"
                           ));
                       
                      $data2 = $sth2->rowCount();
                      
                      return $data2;
                     
         
     }//check ban
  
  
  
  public function show_replies($comment_id){
      
      
                        $sth= $this->db->prepare('SELECT * FROM `course_comment_view` WHERE
                            `reply_to` =:comment_id ORDER BY `comment_index`');

                       $sth->execute(array(':comment_id'=>$comment_id)
                               );
                      $data= $sth->fetchAll();
                      
                     
      echo $_GET['callback'].'('.json_encode($data).')';
			
  }


}