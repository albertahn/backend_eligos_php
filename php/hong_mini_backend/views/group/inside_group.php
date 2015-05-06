

<table class="fancy" style="width:100%; height:200px;">
    
<?php

//echo '<a href="'.URL.'product/create_product_page" class="uiButton" style="float:right;">Make a meeting</a>';

echo'
    <tr><th class="intro" rowspan="4" style="width: 300px;"><img src="'.GROUPS_PIC.'/'.$this->group_info['group_pic'].'" style=" margin: 10px;width:200px; max-height:200px;" alt="product_pic"/></th></tr>
    <tr><th class="header">'.$this->group_info['name'].' </th></tr>
    <tr><th class="intro">location :  '.$this->group_info['location'].' </th></tr>
    <tr><th class="intro">admins:';
    
    foreach($this->all_admins_of_group as $key=>$value){
               echo'<a href="'.URL.'user/user_profile/'.$value['members_index'].'"<div style="">
                            <div >
                   <img style="width:30px; height:30px;" src="'.MEMBERS_PIC.'/'.$value['requestor_profile_picture'].'"/>
                            </div>
                            <div style=" font-size:12px;">
                            '.$value['requestor_name'].'
                             </div>
                    </div></a>';
          
               }
   echo'</th></tr>
       
    <tr>
     <th>
     <a href="'.URL.'group/inside_group/'.$this->group_info['index'].'" id="meetings_panel" class="meetings_panel" style="color:#000;">Posts  </a>
     <a href="#" onclick="return false" onmousedown="javascript:changeGroupPanel(\'group_members\','.$this->group_info['index'].' )" id="group_members" class="members_panel">members</a>
     <a href="#" onclick="return false" onmousedown="javascript:changeGroupPanel(\'rankings\','.$this->group_info['index'].' )" id="rankings" class="rank_panel">Rankings</a>
    </th>
    
<th>
setting
</th>
    </tr>
 </table>
';
//echo '<p class="small_header" style="margin-top:50px;">'.$this->group_info['name'].' group meetings</p>';

//bottom table 
//log the person in
if(session::get('loggedin')==false){
    
    echo'<p style="background:white; color:blue; border-radius:3px;">&nbsp;&nbsp;Please Login to join the group. <br /><=Click the Blue button on the left. Thank you.</p>';
}
else if($this->has_group['members_index'] == session::get('index') && $this->has_group['status'] !==pending){
    
    echo '<a href="'.URL.'product/create_product_in_group/'.$this->group_info['index'].'" class="uiButton" style="float:right;">Make a meeting</a>';
    if($this->has_group['status'] == admin){
        echo'<a href="'.URL.'group_control/group_control_panel/'.$this->has_group['group_index'].'" class="uiButton" style="float:right;">Group Control Panel</a>
            <a style="float:right;" class="uiButton" href="'.URL.'/group/edit_group_page/'.$this->has_group['group_index'].'">edit group</a>
                <a style="float:right;" class="uiButton" href="'.URL.'group/delete_group_warning/'.$this->has_group['group_index'].'">delete group</a>
            
            ';
        
    }
echo'<div id="group_content" class="">
   ';
    
 echo'<table class="group_meetings_table">
                     <tr class="">
                     <th style="font-size:11px;">id</th>
                     <th style="font-size:11px;">name</th>
                     <th style="font-size:11px;">location</th>
                     <th style="font-size:9px;">edit</th>
                     <th style="font-size:9px;">delete</th>
                     <th style="font-size:9px;">tickets</th>
                     <th style="font-size:9px;">copy</th>
                     </tr>
                        ';
    
    foreach($this->meeting_list as $key => $value) {
    echo '<tr class="" >';
    
    echo ' <td><a style="" href="'.URL.'product/inside_product/'.$value['index'].'">'.$value['index'].'</a></td>';
    echo ' <td><a style="" href="'.URL.'product/inside_product/'.$value['index'].'">'.$value['name'].'</a></td>';
     echo ' <td><a style="" href="'.URL.'product/inside_product/'.$value['index'].'">'.$value['location'].'</a></td>';
   
    
     if($this->has_group['status']==admin){
   
         
      
         echo ' <td>
        <a style="" href="'.URL.'product/edit_meeting_page/'.$value['index'].'"><img style="width:30px; float:left;" src="'.URL.'public/images/small_edit.png" title="edit" /></a> </td>
       <td> <a style="color:white;" href="'.URL.'product/delete_meeting_page/'.$value['index'].'"><img style="width:30px; float:right;" src="'.URL.'public/images/small_minus.png" title="Delete meeting" /></a></td>
          </td>
          <td><a style="color:white;" href="'.URL.'tickets/make_tickets_page/'.$value['index'].'"><img style="width:30px; float:right;" src="'.URL.'public/images/make_tickets.png" title="Tickets Panel" /></a></td>
          <td><a style="color:white;" href="'.URL.'product/copy_meeting_page/'.$value['index'].'/'.$this->group_info['index'].'"><img style="width:30px; float:right;" src="'.URL.'public/images/small_copy.png" title="Copy" /></a></td>';
         
     }
     else{
         echo"";
     }
    
    echo '</tr>';
   }
   //end group content
   echo '</table></div>';
   
 //***********************************************facebook chat---------------------
 echo'<div class="fb-comments" data-href="'.URL.'group/inside_group/'.$this->group_info['index'].'" data-num-posts="30" data-width="940"></div>';
  // echo'<div class="fb-live-stream" data-event-app-id="312684782094658" data-width="530" data-height="500" data-xid="'.$this->group_info['index'].'" data-via-url="http://www.meetingmeeting.net/group/" data-always-post-to-friends="false"></div>';

}
 else if($this->has_group['members_index'] == session::get('index') && $this->has_group['status'] == pending)
 {
     echo '<p style="background:white; color:blue; border-radius:3px;">&nbsp;&nbsp;Please wait until the creator of the group permits you to join the group. Thank you.</p>';
     
 }
     
     
else if(session::get('loggedin')==true) {
    
     echo '<p>Do you wish to join the group?</p>';
     
     echo 'group type:'.$this->group_info['type'].'<br />';
     
     
     switch ($this->group_info['type']) {
    case open:
        
        
        echo 'open group<br /> <a class="uiButton" href="'.URL.'group/join_group_open/'.$this->group_info['index'].'">Click here to join open group</a>';
        
        
        break;
    case password:
        echo 'password<br />
            <form action="'.URL.'group/join_group_password/'.$this->group_info['index'].'" method="post">
              <input type="password" name="password" />
              <input  class="uiButton" type="submit" value="submit" />
    
                </form>
                ';
        
        
        break;
    case permission:
        echo 'permission based group: <a class="uiButton" href="'.URL.'group/join_group_permission/'.$this->group_info['index'].'"> ask permission to join this group</a>';
        
        
        break;
}

 //else over    
}


   
    
?>
