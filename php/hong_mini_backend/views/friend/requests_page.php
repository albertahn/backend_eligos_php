<?php

echo '<a class="uiButton" href="'.URL.'group/group_join_requests_page/'.session::get('index').'">group requests</a>';

echo '<div id="requests_right_wrap">';

//friend request chunk
echo '<div id="friend_requests_chunk">';
// friend  requests I recieved
 
     
        
        echo '<div id="requests_you_recieved" style="background: url('.URL.'public/images/ring.jpg) " >';
        echo '<p align="center">Friend requests you recieved</p>';
            foreach ($this->friend_requests as $key => $value) {
                
         echo'<div style="background: url('.URL.'public/images/ring.jpg) repeat; margin-top:10px;" >
             <li style=" float:left; display: list-item; list-style: none;  text-align: center; overflow:hidden;">
             <div><a href="'.URL.'friend/friend_profile/'.$value['index'].'">
            <img src="'.MEMBERS_PIC.'/'.$value['profile_picture'].'" width="50px" height="50px"  alt="picture" style="background:#005554; border-right: 2px solid #ccc; border-bottom: 2px solid #fff; border-radius: 10px; float:left;"  /></a>
                </div><br />
                <div style=" width:40px; font-size:11px; height:20px; overflow:hidden; float:left;">'.$value['username'].'
            </div>
            </li>';
       
            
       echo'<div class="accept_button"><a  style=" background: url('.URL.'public/images/small_cell.jpg) 90%; font-size:20px;" href="'.URL.'friend/accept_friend/'.$value['index'].'">
           accept <img style=" margin-right:50px; " src="'.URL.'/public/images/arrow.png"/></a>
            
            <a class="uiButton" href="'.URL.'friend/reject_friend/'.$value['index'].'">reject </a> 
            </div>
            </div>';
        echo '<div style="border-radius:2px; height:50px; overflow:hidden;">&nbsp;Profile:<br />'.$value['profile'].'</div>';
       
       
        }
        echo '</div>';
         
         // friend requests that I sent

         
          echo '<div id="requests_you_sent" style="background: url("'.URL.'public/images/cell.jpeg");">';
        echo '<p>Friend requests you sent</p>';
        
        
            foreach ($this->friend_requests_sent as $key => $value) {
    
        echo '<li>';
        echo'<div>
            <a href="'.URL.'user/user_profile/'.$value['index'].'">
            <img src="'.MEMBERS_PIC.'/'.$value['profile_picture'].'"   alt="picture"  /></a></div>';
        echo '<div style="border-radius:10px; height:10px; width:20px; overflow:hidden;">'.$value['username'].'</div>';
       echo '</li>';
            }
            
         echo '</div>';
         
echo'</div>';

//end div right request wrap
echo '</div>';
     
         
?>



