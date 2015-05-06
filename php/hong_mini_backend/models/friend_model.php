<?php

class friend_model extends model 
{
    
    public function __construct()
    {
       session::init();
        parent::__construct();
    }
    
    //just for the coach profile
    function check_if_battle_sent($my_index, $friend_index){
        
            $sth = $this->db->prepare('SELECT * FROM `friends` 
         WHERE `friend_index` IN (:my_index, :friend_index) AND `my_index` IN (:my_index, :friend_index)');
        $sth->execute(array(
            
            ':my_index'=>$my_index,
             ':friend_index'=>$friend_index
            
        ));
        
        $count = $sth->rowCount();
        
        $data = $sth->fetchAll();
        
        if($count>0){
            
           echo json_encode($data);
            
        }else{
            
            echo '[{"status":"not_sent_yet"}]';
            
        }
        
       
        
    }
    
    //add new friend to battle request
    public function add_friend_battle($my_index, $friend_index){
        
         $sth = $this->db->prepare('INSERT INTO `friends` (`my_index`, `friend_index`, `status`) VALUES (:my_index, :friend_index, :status)');
         $sth->execute(array(
             
                 ':my_index' => $my_index,
                 ':friend_index' => $friend_index, 
                 ':status' => 'pending'
             
         )); 
         
         $return=array();
         $return['status']='pending';
         
         echo json_encode($return); 
         
    }//add friend
    
    public function get_battle_list($my_index){
        
         $sth = $this->db->prepare('SELECT * FROM `battle_view` WHERE `my_index`= :my_index AND `status`=:status');
         
         $sth->execute(array(
            ':my_index'=>$my_index,
             ':status'=> "accepted"   
            
                 ));
        
       $return= $sth->fetchAll();
       
         echo json_encode($return);
       
      
        
    }  //end get battle list
    
    
    public function get_battle_request_list($my_index){
        
          $sth2 = $this->db->prepare('SELECT * FROM `battle_view` 
          WHERE `other_friend_index`= :my_index AND `status`=:status');
        
        $sth2->execute(array(
            
            ':my_index'=>$my_index,
             ':status'=>'pending'   
            
        ));
        
        $return2 = $sth2->fetchAll();
        
        //print_r($return2);
        
        
        $return = array();
        
        foreach($return2 as $key=>$value){ 
            
            //echo $value['my_index'];
         
             $sth3 = $this->db->prepare('SELECT * FROM `members_view` 
          WHERE `index`= :my_index');
        
        
        $sth3->execute(array(
            
            ':my_index'=>$value['my_index']
            
        ));
        
        $return3 = $sth3->fetchAll();
        
        
        
        $return = array_merge($return, $return3);
            
          //array_push($return, $return3); 
         
        }//end foreach
       
       /* echo '<pre>';
        print_r($return);
         echo '</pre>';*/
       
       echo json_encode($return);
        
    } //end battle reque list
    
//action when done
    public function check_if_friend($my_index, $friend_index){
        
         $sth = $this->db->prepare('SELECT * FROM `friends` 
         WHERE `friend_index` IN (:my_index, :friend_index) AND `my_index` IN (:my_index, :friend_index)');
        $sth->execute(array(
            
            ':my_index'=>$my_index,
             ':friend_index'=>$friend_index
            
        ));
        
        $count = $sth->rowCount();
        
        if($count>0){
            
            $this->battle_friend($my_index, $friend_index);
            
        }else{
            
            $this->add_friend_battle($my_index, $friend_index);
            
        }
        
    } //check if friend

//just update    
    public function battle_friend($my_index, $friend_index){
        
        //update that guy's friend to "accepted"
        $sth = $this->db->prepare('UPDATE `friends`
                SET `battle` = :yes WHERE `my_index` = :my_index AND `friend_index`=:friend_index
             ');
        
         $sth->execute(array(
                 
                 ':yes' => "yes",
                 ':my_index' => $my_index,
             ':friend_index' =>$friend_index
             
         )); 
         
         //for other side
          $sth2 = $this->db->prepare('UPDATE `friends`
                SET `battle` = :yes WHERE `my_index` = :my_index AND `friend_index`=:friend_index
             ');
         $sth2->execute(array(
                 
                 ':yes' => "yes",
                 ':my_index' => $friend_index,
             ':friend_index' =>$my_index
             
         ));      
      
         echo '{"result":"success"}';
         
        
    }//
     
    
     
     
     
       public function see_battle_score($my_index, $friend_index){
           
           
        $sth = $this->db->prepare('SELECT * FROM `battle_view` WHERE `my_index`= :my_index AND `other_friend_index`=:friend_index');
        $sth->execute(array(
            ':my_index'=>$my_index,
            ':friend_index'=> $friend_index
            
        ));
        
         $return= $sth->fetch();
        
         echo json_encode($return);
           
       }
       
       
       public function new_see_battle_score($my_index, $friend_index){
           
           
           $sth = $this->db->prepare('SELECT * FROM `battle_view` WHERE `my_index`= :my_index AND `other_friend_index`=:friend_index');
           $sth->execute(array(
            ':my_index'=>$my_index,
            ':friend_index'=> $friend_index
            
        ));
           
          $return = $sth->fetch();
          
          $data['friend_index']=$return['other_friend_index'];
          $data['friend_name']=$return['friend_username'];
          $data['friend_profile_picture']=$return['friend_profile_picture'];
          $data['friend_score'] =$this->get_user_score($return['other_friend_index']);
          
           
            $sth2 = $this->db->prepare('SELECT * FROM `battle_view` WHERE `my_index`= :my_index AND `other_friend_index`=:friend_index');
           $sth2->execute(array(
            ':my_index'=>$friend_index,
            ':friend_index'=>$my_index
            
        ));
         $return3 = $sth2->fetch();
         
          $data['my_index']=$return3['other_friend_index'];
          $data['my_name']=$return3['friend_username'];
          $data['my_profile_picture']=$return3['friend_profile_picture'];
          $data['my_score'] =$this->get_user_score($my_index);
          
         
         //$return = array_merge($return, $return3);
         
         echo json_encode($data);
           
       }
       
       
       public function get_user_score($user_id){
           
           $sth = $this->db->prepare('SELECT * FROM `member_has_course` WHERE `members_index`= :my_index AND `course_index` ="1"');
           $sth->execute(array(
            ':my_index'=>$user_id
        ));
           
          $return = $sth->fetch();
          
          
         // print_r($return['success']);
          return $return['success'];
          
       }
     
     
     
     //accept friend
     public function accept_battle($my_index, $friend_index){
       
         //insert into my friends
          $sth = $this->db->prepare('INSERT INTO `friends` (`my_index`, `friend_index`, `status`, `battle`)
                                                    VALUES (:my_index, :friend_index, :status, :battle)');
         $sth->execute(array(
                 ':my_index' => $my_index,
                 ':friend_index' => $friend_index,
                 ':status' => 'accepted',
                 ':battle'=>"yes"
             
         ));      
         
         //update that guy's friend to "accepted"
        $sth = $this->db->prepare('UPDATE friends 
                SET `status` = :status, `battle` =:battle WHERE `my_index` = :id AND `friend_index`=:my_index
             ');
         $sth->execute(array(
                 
                 ':status' => "accepted",
                 ':id' => $friend_index,
             ':battle' =>"yes",
             ':my_index' =>$my_index
             
         ));      
         
      $return=array();
         $return['status']='accepted';
         
          echo json_encode($return);  
         
      
     }//accept
     
      // reject friend
     
      public function delete_battle_friend($my_index, $friend_index){
          
          $sth = $this->db->prepare('DELETE FROM `friends` WHERE `my_index`= :id AND friend_index=:me');
        $sth -> execute(array(
            ':id'=>$friend_index,
            ':me'=>$my_index
        ));
        
        $sth = $this->db->prepare('DELETE FROM `friends` WHERE `my_index`= :id AND friend_index=:me');
        $sth -> execute(array(
            ':id'=>$my_index,
            ':me'=>$friend_index
        ));  
        
        echo '{"result":"success"}';
        
       //header('location: '.URL.'user/user_profile/'.$id);  
       
      }
     

      
     //DELETE GROUP
     
     /* public function delete_friend($id){
        
        $sth = $this->db->prepare('DELETE FROM `friends` WHERE `my_index`= :id AND friend_index=:me');
        $sth -> execute(array(
            ':id'=>$id,
            ':me'=>session::get('index')
        ));
        
        $sth2 = $this->db->prepare('DELETE FROM `friends` WHERE `my_index`= :id AND friend_index=:me');
        $sth2 -> execute(array(
            ':id'=>session::get('index'),
            ':me'=>$id
        ));
        
          
         $return=array();
         $return['status']='deleted';
         
          echo $_GET['callback'].'('.json_encode($return).')';
        
        
                
    } //STOP*/
    
    //***************requests view page
    //
   //
    
   
    
    
    
    
    
}
