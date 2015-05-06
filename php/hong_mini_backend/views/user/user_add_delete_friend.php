<?php

         $this ->db = new database();
         $sth = $this->db->prepare('SELECT * FROM `friends` 
         WHERE `my_index`=:id  AND `friend_index`=:friend_index');
         $sth->execute(array(
             ':id'=>session::get('index'),
            
             ':friend_index'=>$this->user_profile['index']
            
        ));
         
$friend_info= $sth->fetch();
$count= $sth->rowCount();
//echo session::get('index');
//echo $count;
 

 if($friend_info['status']==accepted){
     echo '<th align="right">
         <a class="uiButton" href="'.URL.'friend/delete_friend/'.$this->user_profile['index'].'">
        Remove friend</a></th>';

        
 }
 else{
     
     if($this->user_profile['index'] != session::get('index') && $friend_info['my_index'] !=session::get('index'))
         {
      echo '<th align="right">
    <a class="uiButton" href="'.URL.'friend/add_friend/'.$this->user_profile['index'].'">
        Add friend'.$this->user_profile['index'].'</a></th>';
      }
       else
           {
           //see whether it's pending or not
           if($friend_info['status']==pending){
               echo '<p style=" width: 180px; font-family: fantasy; background: white; border-radius:10px;">friend request pending</p>';
           }
           else if($friend_info['status']==rejected){
               
               echo "User has rejected you...";
               
               
               
           }
           else{
              // echo "Your profile";
               
               echo'<div class="white_container">
    
	
	 <div class="right_suggested" style="padding-top:6px; text-align:right;">Suggested GradMap
                <a href="index.html"><img src="'.URL.'public/images/down_arrow.png" style="width: 12px;" />
                    </a>
          </div>
	<b>Major:</b> Mechanical Engineering 
                <a href="#">
                      <img src="'.URL.'public/images/icons/187-pencil.png" style="width: 12px;" />
                </a>
	<br>
	<b>Current Semester:</b> Fall 2013 
                <a href="#">
                     <img src="'.URL.'public/images/icons/187-pencil.png" style="width: 12px;" />
                  </a>
	<br>
	
    
</div> <!--end white container-->
<br />  ';
           }
           
           
       }
 }
        
    
    
       
      





?>
