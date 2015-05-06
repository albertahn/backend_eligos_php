<?php
 echo'<p class="small_header">Group join requests sent to you</p>';
 
 
echo' <table style="border: solid black 1px; border-radius:10px;">';
 
  foreach($this->group_join_requests_page as $key => $value) {
    echo '<tr>';
    echo ' <td><a href="'.URL.'user/user_profile/'.$value['members_index'].'"><img src="'.URL.'public/uploads/members_pic/'.$value['requestor_profile_picture'].'" width="50px" height="50px" alt="profile_pic"><a/></td>';
    echo ' <td>'.$value['requestor_name'].' has requested to join group :</td>';
    echo ' <td><a href="'.URL.'group/inside_group/'.$value['group_index'].'"><img src="'.URL.'public/uploads/group_pic/'.$value['group_pic'].'" width="50px" height="50px" alt="product_pic"><a/></td>';
    echo ' <td>'.$value['group_name'].'</td>';
    echo ' <td>'.$value['product_name'].'</td>';
    echo ' <td>'.$value['description'].'</td>';
   
    
     
    echo ' <td>
        <a class="uiButton" href="'.URL.'group/accept_join_group/'.$value['group_index'].'/'.$value['members_index'].'">accept</a> 
        <a class="uiButton" href="'.URL.'group/reject_join_group/'.$value['group_index'].'/'.$value['members_index'].'">reject</a> 
          </td>';
     
  }
 echo' </table>';