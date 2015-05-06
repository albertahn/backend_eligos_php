
<p class="small_header">Ticket Information</p>   
<?php

 echo'<form enctype="multipart/form-data" method="post" action="'.URL.'tickets/edit_ticket_submit" >';
echo'<table id="edit_ticket_table" style="width:700px;" class="fancy">';
  
echo'
    <tr><th>ticket ID</th> <th>Code</th><th>State</th><th>Given to</th><th>Reciever email</th></tr>
  

    <tr><th>'.$this->edit_ticket_page['tickets_index'].'
        <input type="hidden" name="ticket_index" value="'.$this->edit_ticket_page['tickets_index'].'" />
         <input type="hidden" name="meeting_index" value="'.$this->edit_ticket_page['meeting_index'].'" />    
       </th>
       <th>'.$this->edit_ticket_page['tickets_code'].'</th>';
//let edit ticket state  
echo' <th style="color:red;">';
echo '<select id="ticket_state_select" name="ticket_state_select">';
                         
    
                    
                    
                  if($this->edit_ticket_page['state']=='available'){
                      echo'<option selected="selected">available</option>
                          <option >used</option>
                            ';
                  }else{
                      echo'<option>available</option>
                          <option selected="selected">used</option>
                            ';
                  }
                          
                    
                  
                  echo'</select>';

     echo'</th>'; //end ticket state
  if(!empty($value['username'])){
      echo'<th><img src="'.MEMBERS_PIC.'/'.$this->edit_ticket_page['profile_picture'].'" style="width:30px; float:left;" /><div style="width:30px; float:left;">'.$this->edit_ticket_page['username'].'</div></th>
          
            ';
  }else{
      echo'<th>empty</th>';
  }

       echo' 
        <th>'.$this->edit_ticket_page['email'].'</th>
             
   </tr>
   ';
//end table
    echo'</table>';
 echo '<p style="color: #3344aa; font-size:1em;">Give ticket to:</p>';   
     echo'<table class="people_table">';
    echo '<tr><th></th> <th>Name</th> <th>email</th> <th style="width:70px;">select person</th></tr>';
//all members in group      
foreach ($this->group_members as $key => $value) {
   
    
     echo '<tr>
                    <th><img src="'.MEMBERS_PIC.'/'.$value['profile_picture'].'" style="width:50px; height:50px;"/></th>
                     <th>'.$value['username'].'</th>
                     <th>'.$value['email'].'</th>
                    <th><input type="radio" name="members_index" value="'.$value['index'].'" /></th>
         
           </tr>';
}
      
   echo'</table>';//end table
                  
                      echo '
                      <input type="submit" value="submit" />
                      <input type ="reset" value="Clear"/>
                      
                          ';
                        
    
                         echo '</tr>';   
                    
?>

    
    </form>