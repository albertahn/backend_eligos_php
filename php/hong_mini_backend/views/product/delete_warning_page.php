<?php

echo'Are you sure you want to delete "'.$this->delete_meeting_page['name'].'"?<br />
    
      <a class="btn" href="'.URL.'product/delete_meeting_submit/'.$this->delete_meeting_page['index'].'/'.$this->group_has_meeting['group_index'].'">delete </a> 
          
    <a  class="uiButton" href="'.URL.'group/inside_group/'.$this->delete_meeting_page['group_index'].'"> Cancel</a>';

?>
