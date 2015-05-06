<?php

class user_model extends model 
{
    
    public function __construct()
    {
       
        parent::__construct();
    }
    
    
    
    public function user_courses($id){
        
          $sth = $this->db->prepare('SELECT * FROM `courses` WHERE `index` IN (SELECT `course_index` FROM `member_has_course` WHERE `members_index` =:members_index) ORDER BY `index` DESC LIMIT 0,200');
        $sth->execute(array(
            ':members_index'=>$id
             ));
        $return= $sth->fetchAll();
       $json= json_encode($return);
       
       echo $json;
        
    }
        
    
    // SHOW ALL USERS     
    /*
    public function all_users(){
        
         $sth = $this->db->prepare('SELECT * FROM `members` ORDER BY `index` DESC LIMIT 0,20');
         $sth->execute();
        
       return $sth->fetchAll();
        
        
        
    }
     
    public function all_users_load_more($lastUserIndex){
        
         $sth = $this->db->prepare('SELECT * FROM `members` WHERE `index`< :lastUserIndex ORDER BY `index` DESC LIMIT 0,2');
         $sth->execute(array( ':lastUserIndex'=>$lastUserIndex));
        
       $data= $sth->fetchAll();
       
       foreach ($data as $key => $value) {
   echo '<li style="display: list-item; list-style: none; text-align: center; float:left; overflow:hidden;">';
    echo '<div class="user_index" id="'.$value['index'].'">
        <a href="'.URL.'user/user_profile/'.$value['index'].'"><img width="50" height="50" src="'.MEMBERS_PIC.'/'.$value['profile_picture'].'"></a></div>';
    echo '<div style="font-size:10px; display: list-item; list-style: none; text-align: center; float:left;height:10px; width:50px; overflow:hidden;">'.$value['username'].'</div>';
    echo '</li>';
}
        
        
        
    }
    * 
     */
    
    //start bundle for seeing user profile
    public function user_profile($id){
        
          $sth = $this->db->prepare('SELECT * FROM `members` WHERE `index`= :id');
          $sth->execute(array(':id'=> $id));
        
          $return= $sth->fetch();
     
          echo json_encode($return);
   //echo $_GET['callback'].'('.json_encode($return).')';
         
     }
     
    
     
    
    
    
       //end bundle
     
     public function user_products_switch($members_index){
         
	//contentVar
        
         $sth = $this->db->prepare('SELECT * FROM `meeting` WHERE `index` IN (SELECT `meeting_index` FROM `member_has_meeting` WHERE `members_index` = :id AND `status`!=:not_received) ORDER BY `index` DESC LIMIT 0,20');
        $sth->execute(array(
            ':id'=> $members_index,
            ':not_received'=>'not_received'
            ));
       
        $return= $sth->fetchAll();
      
      echo $_GET['callback'].'('.json_encode($return).')';	
	
         
     }
     //friend gifts
     /*
     public function friends_gift_switch($members_index){
         
	//contentVar
        
         $sth = $this->db->prepare('SELECT * FROM `meeting` WHERE `index` IN (SELECT `meeting_index` FROM `member_has_meeting` WHERE `members_index` = :id) ORDER BY `index` DESC LIMIT 0,20');
        $sth->execute(array(':id'=> $members_index));
       
        $return= $sth->fetchAll();
      
      echo $_GET['callback'].'('.json_encode($return).')';	
	
         
     }
      * 
      */
     public function user_groups_switch($members_index){
        
         
         $sth = $this->db->prepare('SELECT * FROM `mygroup_view` WHERE `members_index`= :id ORDER BY `group_index`');
       $sth->execute(array(':id'=> $members_index));
       
      $return= $sth->fetchAll();
      
      echo $_GET['callback'].'('.json_encode($return).')';
      
         
     }
     
     
     //switch friends panel
     
     public function user_friends_switch($members_index){
         $sth = $this->db->prepare('SELECT * FROM `members` 
         WHERE `index` IN (SELECT `friend_index` FROM `friends` 
         WHERE `my_index`=:id AND `status`=:status) ORDER BY `index` DESC LIMIT 0,10');
       $sth->execute(array(
           ':id'=> $members_index,
           ':status'=>accepted
           ));
       
     $return= $sth->fetchAll();
      
      echo $_GET['callback'].'('.json_encode($return).')';
         
         
     }
     
    //memories together with user
     
    public function memories_together($members_index){
        
        //contentVar
        
         $sth = $this->db->prepare('SELECT * FROM `meeting` WHERE `index` IN 
                                   (SELECT `meeting_index` FROM `member_has_meeting` WHERE `members_index` = :id)
                                   AND `index` IN 
                                   (SELECT `meeting_index` FROM `member_has_meeting` WHERE `members_index` = :my_id)
                                   ORDER BY `index` DESC LIMIT 0,20');
        $sth->execute(array(
            ':id'=> $members_index,
            ':my_id'=> session::get('index')
            ));
       
        $return= $sth->fetchAll();
      
      echo $_GET['callback'].'('.json_encode($return).')';
        
        
    }
    
 //whether to add delete friend   
  public function user_add_delete_friend($my_index, $friend_index){
      
      $sth = $this->db->prepare('SELECT * FROM `friends` 
         WHERE (`my_index`=:id  AND `friend_index`=:friend_index) OR (`my_index`=:friend_index  AND `friend_index`=:id)');
         $sth->execute(array(
             ':id'=>$my_index,
            
             ':friend_index'=>$friend_index
            
        ));
        $return= $sth->fetchAll();
      
      echo $_GET['callback'].'('.json_encode($return).')';
      
      
  }   
    
/*

    public function load_more_products($last){
       //  SELECT * FROM `meeting` WHERE `index` IN (SELECT `meeting_index` FROM `member_has_meeting` WHERE `members_index` = :id) ORDER BY `index` DESC LIMIT 0,2
          $sth = $this->db->prepare('SELECT * FROM `meeting` WHERE `index`IN (SELECT `meeting_index` FROM `member_has_meeting` WHERE `members_index` = :id) AND `index`<:last_index ORDER BY `index` DESC LIMIT 0,2');
        $sth->execute(array(
            ':last_index'=> $last['lastMeetingIndex'],
            ':id'=>$last['meeting_creator'] 
            ));
       
        $data= $sth->fetchAll();
        
        
      
       foreach($data as $key => $value){
               
            //id maker
      echo '
          <tr>
          <td><a href="'.URL.'group/inside_product/'.$value['index'].'">
              <center><img src="'.PRODUCTS_PIC.'/'.$value['main_picture'].'" style="width:50px; height:50px;" /> </center>
                  </a></td>
          <td><a href="'.URL.'product/inside_product/'.$value['index'].'">
              '.$value['index'].'
                  </a>
                  </td>
              
         <td class="postedProduct" id="'.$value['index'].'">
            <a href="'.URL.'product/inside_product/'.$value['index'].'">
                 '.$value['name'].'
                     </a>
                     </td>';
                    
                  echo '<td class="meeting_creator" id="'.$this->user_profile['index'].'"><a href="'.URL.'product/inside_product/'.$value['index'].'">
                      '.$value['location'].'
                          </a>
                          </td>
                          
                        <td><a href="'.URL.'product/inside_product/'.$value['index'].'">
                      '.$value['meeting_date'].'
                          </a></td>
                       </tr>';
 
   
    
 
                }//end foreach
        
        
        }
        
        //load mroe gorups
        
        public function load_more_groups($last){
         
          $sth = $this->db->prepare('SELECT * FROM `mygroup_view` WHERE `members_index`= :id AND `group_index`<:last_index ORDER BY `group_index` DESC LIMIT 0,2');
        $sth->execute(array(
            ':last_index'=> $last['lastGroupIndex'],
            ':id'=>$last['membersIndex'] 
            ));
       
        $data= $sth->fetchAll();
        
        
      
        foreach($data as $key=>$value){
                 
                 echo '<tr>
                     <td>
                     <a href="'.URL.'group/inside_group/'.$value['group_index'].'">
                     <img src="'.URL.'public/uploads/group_pic/'.$value['group_pic'].'" width="50px" height="50px" alt="group_pic"/>
                     <a/>
                     </td>
                         ';
    //name
    echo '<td class="groupIndex" id="'.$value['group_index'].'">
                 <a href="'.URL.'group/inside_group/'.$value['group_index'].'">
            '.$value['group_name'].'
                </a>
                </td>';
    
    //location
    echo  '<td class="membersIndex" id="'.$value['members_index'].'" >
           <a href="'.URL.'group/inside_group/'.$value['group_index'].'">
          '.$value['location'].'
              </a>
              </td>
           </tr>';
   
             
 
                }//end foreach
        
        
        }
        
        //loadmore friends
         public function load_more_friends($last){
         
          $sth = $this->db->prepare('SELECT * FROM `members` 
         WHERE `index` IN (SELECT `friend_index` FROM `friends` 
         WHERE (`my_index`=:id) AND (friend_index < :lastFriendIndex) AND `status`=:status) ORDER BY `index` DESC LIMIT 0,4');
       $sth->execute(array(
           ':id'=> $last['myIndex'],
          ':lastFriendIndex'=>$last['lastFriendIndex'],
           ':status'=>accepted
           ));
       
         
      
        $data= $sth->fetchAll();
        
       
      
        foreach($data as $key=>$value){
                    //id maker
      echo '
          <tr>
             <td>'.$value['index'].'</td>
             <td><a href="'.URL.'user/user_profile/'.$value['index'].'">
              <img  class="fancy" src="'.URL.'public/uploads/members_pic/'.$value['profile_picture'].'" width="50px" height="50px" alt="profile_pic" />
                  </a>
                  </td>
              
         <td class="membersIndex" id="'.$value['index'].'">
             <a href="'.URL.'user/user_profile/'.$value['index'].'">
                 '.$value['username'].'
                     </a></td>';
                    
                  echo '<td>
                      <a href="'.URL.'user/user_profile/'.$value['index'].'">
                      '.$value['profile'].'
                          </a></td>
                       </tr>';
  
   
    
 
                }//end foreach
        
        
        }
        
        
        //change side
        
        public function change_side($members_index){
            $sth = $this->db->prepare('SELECT * FROM `members` WHERE `index`= :id');
            $sth->execute(array(':id'=> $members_index));
            $data= $sth->fetch();
           
            echo'<div id="leftWrap"><p style="text-align:center;">'.$data['username'].'</p><br />';
                  
            
            if(!empty($data['profile_picture'])){
                echo'<a href="'.URL.'user/user_profile/'.$data['index'].'">
                    <img  class="fancy" src="'.URL.'public/uploads/members_pic/'.$data['profile_picture'].'" width="130px" height="130px" alt="profile picture" onClick="window.open(this.src)" />
                        </a>';
                 //meetings button
              echo'<a class="uiButton" href="'.URL.'user/user_friends_switch/'.$data['index'].'">friends</a><br />';
              echo '<a class="uiButton" href="'.URL.'user/user_products_switch/'.$data['index'].'">basket</a><br />';
              echo'<a class="uiButton" href="'.URL.'user/user_groups_switch/'.$data['index'].'">groups</a><br />';
              
              echo'<a class="uiButton" href="'.URL.'user/user_profile/'.$data['index'].'">info</a>';
            }
            else{
                  echo'<img  class="fancy" src="'.URL.'public/images/blank_profile_pic.jpg" width="130px" height="130px" alt="profile picture" /><br />
                      <p>Click a member on the right to see profile.</p>';
                  
            }
                      
           
            
            
              echo'</div>'; //end of leftwrap
            
        }
      
        
         
  */   
        
    
    
}
