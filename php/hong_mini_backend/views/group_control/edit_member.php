
    
<?php
echo'<form enctype="multipart/form-data" method="post" action="'.URL.'group_control/edit_member_submit" >';

echo'<table style="width:518px; " class="fancy">
                     <tr>
                     
                     <th style="font-size:11px;"></th>
                     <th style="font-size:11px;">name</th>
                     <th style="font-size:11px;">status</th>
                     <th style="font-size:11px;">points</th>
                     
                     </tr>
                        ';
                
                   echo '<tr>';
                        //hidden data
                        echo '<input type="hidden" name="members_index" value="'.$this->edit_member_page['members_index'].'" />';
                        echo '<input type="hidden" name="group_index" value="'.$this->edit_member_page['group_index'].'" />';
                   //shown data
                  echo ' <td><a href="'.URL.'user/user_profile/'.$this->edit_member_page['members_index'].'"><img src="'.MEMBERS_PIC.'/'.$this->edit_member_page['requestor_profile_picture'].'" style="width:50px;"/></a></td>';
                  echo ' <td><a href="'.URL.'user/user_profile/'.$this->edit_member_page['members_index'].'">'.$this->edit_member_page['requestor_name'].'</a></td>';
                  
                  
                  echo ' <td>
                      <select id="edit_status_select" name="edit_status_select">
                         ';
    // status options swtitch
                    
                    
                  if($this->edit_member_page['status']=='user'){
                      echo'<option selected="selected">user</option>
                          <option >admin</option>
                            ';
                  }else{
                      echo'<option>user</option>
                          <option selected="selected">admin</option>
                            ';
                  }
                          
                    
                  
                  echo'</select>
                      </td>';
                  
                  
   //edit points
                  echo ' <td> <input type="text" name="points_in_group" value="'.$this->edit_member_page['points_in_group'].'" /></td>';
    
    //edit delete part
                  
                      echo ' <td>
                      <input type="submit" class="uiButton" value="submit" style="color:white;" />
                      
                          </td>';
                        
    
                         echo '</tr>';   
                    
                        
                        echo'</table>';
?>

    
    </form>