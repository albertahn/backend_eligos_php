<?php

class comment_model extends model {

function __construct() {
    parent::__construct();
    
}


 public function update_num_reply($comment_index){
         
     
                        $sth2= $this->db->prepare('SELECT * FROM `course_comment_view` WHERE `reply_to`=:course_id ORDER BY `comment_index` DESC');

                       $sth2->execute(array(':course_id'=> $comment_index));
                      $count= $sth2->rowCount();
     
          $sth = $this->db->prepare('UPDATE comment
                SET reply_num = :reply_num
                WHERE `index` = :id
             ');
          
          $sth->execute(array(
            ':id' => $comment_index,
              
            ':reply_num' => $count
            ));
          
         // echo $comment_index;
     }//end
     
  public function like_comment($comment_index){
      
        $sth2= $this->db->prepare('SELECT `likes` FROM `comment` WHERE `index`=:com_index ');

                       $sth2->execute(array(':com_index'=> $comment_index));
                       $num_likes = $sth2->fetch();
         // print_r($num_likes);        
                       
                       $newlikes= $num_likes['likes']+1;
     
                       //make use of the last db insert
          $sth = $this->db->prepare('UPDATE `comment`
                SET `likes` = :like_num
                WHERE `index` = :id
             ');
          //last instert id in square
          
          /*echo'<pre>';
          print_r($sth);
           echo'</pre>';*/
          
          $sth->execute(array(
            ':id' => $comment_index,
              
            ':like_num' => $newlikes
            ));
          
         // print_r($num_likes);
          
          echo'{"likes":"'.$newlikes.'"}';
      
  }//end like   

//the comment list

function get_course_comments($id) {
    
                        $sth= $this->db->prepare('SELECT * FROM `course_comment_view` WHERE `courses_index`=:course_id ORDER BY `comment_index` DESC LIMIT 0,200');
                       $sth->execute(array(':course_id'=> $id));
                      $data= $sth->fetchAll();
                      
      echo json_encode($data);
      
      foreach ($data as $key => $value) {
          
         $this->update_num_reply($value['comment_index']);
          
      }//end forech
		}//end get comment
                
 function get_course_replies($comment_index) {
    
                        $sth= $this->db->prepare('SELECT * FROM `course_comment_view` WHERE `reply_to`=:course_id ORDER BY `comment_index` DESC');

                       $sth->execute(array(':course_id'=> $comment_index));
                      $data= $sth->fetchAll();
                     
      echo json_encode($data);
			
		}              
                
//when it is just text and no files                
 function insert_course_comment($data){
     
     $isban = $this->check_ban($data['user_index']);
     
     if($isban ==0){
     
          $sth= $this->db->prepare('INSERT INTO `comment` (`comment`,`members_index`, `courses_index`) 
                                                              VALUES (:comment, :members_index, :courses_index)');

                       $sth->execute(array(
                           ':comment'=>$data['comment'],
                           ':members_index'=>$data['user_index'],
                           ':courses_index'=>$data['courses_index']
                           ));
                      
              $comment_index = $this->db->lastInsertId();
                      
                  $sth2= $this->db->prepare('SELECT * FROM `course_comment_view` WHERE `comment_index`=:comment_index');

                       $sth2->execute(array(':comment_index'=> $comment_index));
                      $data2= $sth2->fetch();
                      
       //send notifications to entire ppl in goal    
      //email_static::goal_mail($data['courses_index'], session::get('profile_picture'), session::get('username'), $data['comment']);
                     
                          gcm_push_static::group_chat($data['user_index'], $data['comment']);    
                          
                               echo json_encode($data2);
                               
                               
                               }else{//not banned
                                   //for peopl banned 
                                   
                                   echo '{"members_index":"1", "username":"error ask Albert", "profile_picture":"ask", "comment_index":"1",  "comment_text":"error there is. Ask Albert for help."}';
                               }
              
     }//end
     
     
     function check_ban($user_index){
         
            $sth2= $this->db->prepare('SELECT * FROM `members` WHERE `index`=:user_index AND `status` =:ban ');

                       $sth2->execute(array(
                           ':user_index'=> $user_index,
                           ':ban' =>"ban"
                           ));
                       
                      $data2 = $sth2->rowCount();
                      
                      return $data2;
                     
         
     }
        
        
        
//when with file
        
 function course_picture_comment($data){



                     $check_image=getimagesize($data['tmp_name']);

                  $rand= rand();

         //file path for docs        
                 $new_file_name=$rand.$data['file_name'];

                 $file_path= 'public/uploads/product_pic/'.$new_file_name;


                        if($check_image[mime]==$data['file_type']){

                                  if(!move_uploaded_file($_FILES[upload_file]['tmp_name'], $file_path))
                                       {

                                     // echo $check_image[mime];
                                     //header('location: '.URL.'error/valid_file');
                                      
                                      echo '{"error":"error"}';
                                       }


                                        $sth= $this->db->prepare('INSERT INTO `comment` (`comment`,`members_index`, `courses_index`, `picture`) 
                                                                      VALUES (:comment, :members_index, :courses_index, :picture)');



                               $sth->execute(array(

                                   ':comment'=>$data['comment'],
                                   ':members_index'=>session::get('index'),
                                   ':courses_index'=>$data['courses_index'],
                                   ':picture'=>$new_file_name

                                   ));
                               
                               $last_index = $this->db->lastInsertId();
                               
                               
                          $sth2= $this->db->prepare('SELECT * FROM `course_comment_view` WHERE `comment_index`=:comment_index');

                       $sth2->execute(array(':comment_index'=> $last_index));

                               $alldata = $sth2->fetch();
                               
                               echo json_encode($alldata);

 //header('location: '.URL.'product/inside_product/'.$data['courses_index']);
                      

                        } //end if move file   
        
     
        }//end pic
        
        
     function delete_course_comment($data){
         
                     $sth= $this->db->prepare('DELETE FROM `comment` WHERE `index`=:comment_index');

                       $sth->execute(array(
                           ':comment_index'=>$data['comment_index']
                           ));
                     
      echo '{"success":"success"}';   
         
     }//end delete comment
   
        
     
     
     function show_profile_comments($id){
         
       
         
         
          $sth2= $this->db->prepare('SELECT * FROM `wall_chat_view` WHERE `wall_index`=:wall_index ORDER BY `chat_index` DESC LIMIT 0,200');

                       

                       $sth2->execute(array(':wall_index'=> $id));
                      $data= $sth2->fetchAll();
                      
                       echo $_GET['callback'].'('.json_encode($data).')';
         
     }
     
     
     
     //get one course comment for replies dialog
     
     
     function get_one_comment($comment_index){
     
        $sth2= $this->db->prepare('SELECT * FROM `course_comment_view` WHERE `comment_index`=:comment_index');

                       $sth2->execute(array(':comment_index'=> $comment_index));
                      $data = $sth2->fetch();
                      
                      echo json_encode($data);
                      
 }
     
}