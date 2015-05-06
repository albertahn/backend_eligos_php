
<p class="header"> copy Meeting</p>



<form enctype="multipart/form-data" method="post" action="<?php echo URL; ?>product/create_product" >
    
    
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;meeting name:</label>
    
    <input type="text" name="name" value="<?php echo $this->edit_meeting_page['name']; ?>"/><br />
    
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;location: &nbsp;&nbsp;&nbsp;&nbsp; </label>
    
    <input type="text" name="location" value="<?php echo $this->edit_meeting_page['location']; ?>"/><br />
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;google maps URL: &nbsp;&nbsp;&nbsp;&nbsp; </label>
    
    <input type="text" name="google_map" value="<?php echo $this->edit_meeting_page['google_map']; ?>"/><br />
    
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;meeting date: &nbsp;&nbsp;&nbsp;&nbsp; </label>
    
    <input type="text" name="meeting_date" value="<?php echo $this->edit_meeting_page['meeting_date']; ?>"/><br />
    
    <input type="hidden" id="group_index" value="<?php echo $this->group_id; ?>" name="group_index" />
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View Setting:</label>
    
    <select id="privacy" name="privacy">
        <option value="public">public</option>  
         <option value="group">group</option>  
          
         <option value="hide">hide</option>
        
    </select>
    <br />
     <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category:</label>
        
    <select id="category" name="category">
         <option id="event" value="event">Event</option>  
         <option id="art" value="art">Art</option>  
         <option id="books" value="books">books</option> 
         <option id="music" value="music">music</option>
         <option id="automobile" value="automobile">automobile</option>
         <option id="tech_science" value="tech_science">tech & science</option>
         <option id="health_fitness" value="health_fitness">health & fitness</option>
         <option id="design" value="design">design</option>
         <option id="sports" value="sports">sports</option>
         <option id="humor" value="humor">humor</option>
         <option id="fashion" value="fashion">fashion</option>
         <option id="travel_places" value="travel_places">travel_places</option>
         <option id="products" value="products">products</option>
         <option id="other" value="other">other</option>
         
         
         
        
    </select>
    <!--main picture-->    
    <br />
    <br />
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Main picture:</label><input type="file" id="main_picture" name="main_picture" /><br />
     <br />
     <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;source link of picture: &nbsp;&nbsp;&nbsp;&nbsp; </label>
    
    <input type="text" name="link" value="<?php echo $this->edit_meeting_page['link'];?>"/><br />
    <br />
    
    <br />
    <br />
    
    <br />
   <!--just roles created -->
   
    <p id="info_roles" style="font-size:.4em; color:blue;"></p>
    <div id="meeting_roles">
      

        
    <table>
     <?php 
        
              
              echo '<tr><th>Roles:</th><th>Assign Role</th></tr>';
      //make a array separate and fro each ++ array [[i] = index
        $length = sizeof($this->edit_roles);
              for($i=0 ; $i < $length;$i++)
              {  
                  $j=$i+1;
                  
                  echo '<tr><th>role '.$j.'
                      <input type="text" name="'.$j.'" value = "'.$this->edit_roles[$i]['role'].'" />
                      <input type="hidden" name="role_index'.$i.'" value = "'.$this->edit_roles[$i]['index'].'" />
                       </th>
                       
                        <th>
                        <input type="text" name="assigned_person'.$i.'" value = "'.$this->edit_roles[$i]['assigned_person'].'" /><br />
                        
                        
                        </th>
                        </tr>';
                  
                  
                   }
    //end table
    echo '</table>';
                   //secret place for number of roles
                    echo'<input type="hidden" name="number_of_roles_box" value="'.$length.'" />
                         <input type="hidden" name="meeting_index" value="'.$this->edit_meeting_page['index'].'" />
                        
                        ';
              
         
        ?>
       
    </div>
    
   
    
    
    <label>Description</label><br />
    <textarea name="description" id="description" placeholder="Tell us about the meeting" rows="4" cols="60">
     <?php echo$this->edit_meeting_page['description']; ?>

    </textarea>
    <br />
    
    
    <br />
    
    <label>&nbsp;</label><input type="submit" />
        
    
    
</form>


<script type="text/javascript">
     $(function(){
         $('#<?php echo $this->edit_meeting_page['category']; ?>').attr('selected','selected');
     }); 
    </script> 