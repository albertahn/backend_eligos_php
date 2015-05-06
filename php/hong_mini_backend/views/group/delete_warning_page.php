<?php


echo'Are you sure you want to delete '.$this->delete_group_warning['name'].'?<br />
    
      <a class="uiButton" href="'.URL.'group/delete_group/'.$this->delete_group_warning['index'].'">
          delete group
      </a> 
      <a  class="uiButton" href="../"> NO</a>';

?>
