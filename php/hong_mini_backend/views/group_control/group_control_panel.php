
<p class="header">Group control panel</p>

<?php
echo'<a href="'.URL.'group/inside_group/'.$this->group_control_panel[0]['group_index'].'" ><img style="width:70px; float:left;" src="'.URL.'public/images/small_back_button.png" title="back to group" /></a>';

echo'<table style="width:518px; " class="fancy">
                     <tr>
                     
                     <th style="font-size:11px;"></th>
                     <th style="font-size:11px;">name</th>
                     <th style="font-size:11px;">status</th>
                     <th style="font-size:11px;">points</th>
                     
                     </tr>
                        ';
                foreach ($this->group_control_panel as $key => $value) {
                   echo '<tr>';
    
                  echo ' <td><a href="'.URL.'user/user_profile/'.$value['members_index'].'"><img src="'.MEMBERS_PIC.'/'.$value['requestor_profile_picture'].'" style="width:50px;"/></a></td>';
                  echo ' <td><a href="'.URL.'user/user_profile/'.$value['members_index'].'">'.$value['requestor_name'].'</a></td>';
                  echo ' <td><a href="'.URL.'user/user_profile/'.$value['members_index'].'">'.$value['status'].'</a></td>';
                  echo ' <td><a href="'.URL.'user/user_profile/'.$value['members_index'].'">'.$value['points_in_group'].'</a></td>';
    
    //edit delete part
                  
                      echo ' <td>
                      <a class="uiButton" href="'.URL.'group_control/edit_member_page/'.$value['members_index'].'/'.$value['group_index'].'">edit</a> 
                      <a class="uiButton" href="'.URL.'group_control/delete_member_group_page/'.$value['members_index'].'/'.$value['group_index'].'">delete</a>
                          </td>';
                        
    
                         echo '</tr>';   
                    
                        }
                        echo'</table>';
?>
