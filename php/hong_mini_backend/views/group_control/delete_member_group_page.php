<?php
echo'<p style="background:white; font-size:1em; color:blue; border-radius:5px;">  Do you really want to delete '.$this->delete_member_group_page['requestor_name'].' from the group? 
    
    <br /><a class="uiButton" href="'.URL.'group_control/delete_member_group_submit/'.$this->delete_member_group_page['members_index'].'/'.$this->delete_member_group_page['group_index'].'">
    Yes delete    
   </a>
   <a class="uiButton" href='.URL.'group_control/group_control_panel/'.$this->delete_member_group_page['group_index'].'">NO GO BACK</a>
   
</p> ';
?>
