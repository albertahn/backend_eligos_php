<?php

         $this ->db = new database();
         $sth = $this->db->prepare('SELECT * FROM `friends` 
         WHERE `my_index`=:id  AND `friend_index`=:friend_index');
         $sth->execute(array(
             ':id'=>session::get('index'),
            
             ':friend_index'=>$this->friend_profile['index']
            
        ));
         
$friend_info= $sth->fetch();
$count= $sth->rowCount();
//echo session::get('index');
 
//echo $count;
 //echo $this->friend_profile['index'];

 
 if($friend_info['status']==accepted){
     echo '<th align="right">
         <a class="uiButton" href="'.URL.'friend/delete_friend/'.$this->friend_profile['index'].'">
        Remove friend</a></th>';

        
 }
 else{
     
     if($this->friend_profile['index'] != session::get('index') && $friend_info['my_index'] !=session::get('index'))
         {
      echo '<th align="right">
    <a class="uiButton" href="'.URL.'friend/add_friend/'.$this->friend_profile['index'].'">
        Add friend'.$this->friend_profile['index'].'</a></th>';
      }
       else
           {
           //see whether it's pending or not
           if($friend_info['status']==pending){
               echo '<p style=" width: 180px; font-family: fantasy; background: white; border-radius:10px;">friend request pending</p>';
           }
           else{
               echo "your profile";
           }
           
           
       }
 }
    
       
      





?>
