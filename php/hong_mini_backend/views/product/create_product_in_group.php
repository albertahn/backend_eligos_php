
<p class="header">Upload to group</p>
<form enctype="multipart/form-data" method="post" action="<?php echo URL; ?>product/create_product" >
     <div class="form_label">  
<!--main picture-->    
    
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Main picture:</label><input type="file" id="main_picture" name="main_picture" />
    </div>
    <div class="form_label">  
   
     <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;source link to picture: &nbsp;&nbsp;&nbsp;&nbsp; </label>
    
    <input type="text" name="link"/><br />
    </div>
    
    <div class="form_label">  
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Title:</label>
    <input type="text" name="name"/><br />
    </div>
    
    
    <div class="form_label">  
     <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;iframe<span style="font-size:12px; color:blue;">(google maps, wikileaks, or website. )</span> &nbsp;&nbsp;&nbsp;&nbsp; </label>
    <input type="text" name="google_map"/><br />
    </div>
    
    
    <input type="hidden" id="group_index" value="<?php echo $this->group_id; ?>" name="group_index" />
       
    
    <div class="form_label">  
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View Setting:</label>
    
    <select id="privacy" name="privacy">
        <option value="public">public</option>  
         <option value="group">group</option>  
          
         <option value="hide">hide</option>
        
    </select>
    </div>
    <div class="form_label">  
     <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category:</label>
    
    <select id="category" name="category">
        <option value="event">Event</option>  
         <option value="art">Art</option>  
           <option value="books">books</option> 
         <option value="music">music</option>
         <option value="automobile">automobile</option>
         <option value="tech_science">tech & science</option>
         <option value="health_fitness">health & fitness</option>
         <option value="design">design</option>
         <option value="sports">sports</option>
         <option value="humor">humor</option>
         <option value="fashion">fashion</option>
         <option value="travel_places">travel_places</option>
         <option value="products">products</option>
         <option value="other">other</option>
         
         
         
        
    </select>
    </div>
    
   
   <!--onmouseover="bigImg(this)"  말onmouseout="normalImg(this)"  onClick="return false" onmousedown="javascript:swapContent(\'friends\');">friends</a> -->
   <span><input type="text" style="width:20px;" name="number_of_roles_box" id="number_of_roles_box" /></span>
   <!--how to add role 도움-->
   <a href="#" style="font-size:.1em;" onclick="return false" onmouseover="howToAddRole()" onmouseout="hideHowToAddRole()">   ?</a>
    <a href="#" class="uiButton" onclick="return false" onmousedown="javascript:add_role();" onmouseover="howToAddRole()" onmouseout="hideHowToAddRole()">Add roles  </a>
    <a href="#" class="uiButton" onclick="return false" onmousedown="javascript:autoToastmasters();"> Auto Toastmasters roles list</a>
    <p id="info_roles" style="font-size:.4em; color:blue;"></p>
    <p id="meeting_roles"></p>
    
    <br />
    
    <div class="form_description">
    <label>Description</label><br /><textarea name="description" id="description"  placeholder="Tell us more" rows="4" cols="90"></textarea>
    </div>
    
    <br />
    
    <label>&nbsp;</label><input type="submit" value="upload" class="uiButton" style="width:70px; height:40px; float:right; color:#fff; background:#000; font-size:16px;"/>
        
    
    
</form>