

<h1>group edit</h1>


<form enctype="multipart/form-data" method="post" action="<?php echo URL; ?>group/edit_group" >
    
     <input type="hidden" name="index" value="<?php echo $this->edit_group_page['index']; ?>" />
     <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Group name:</label>
    
    <input type="text" value="<?php echo $this->edit_group_page['name']; ?>" name="name"/><br />
    
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Location: &nbsp;&nbsp;&nbsp;&nbsp; </label>
    
    <input type="text" value="<?php echo $this->edit_group_page['location']; ?>" name="location"/><br />
    
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Group type:</label>
    
    <select id="groupType" name="groupType" onchange="going();">
         <option id="password_type" value="password">Password needed group</option>  
        <option id="open_type" value="open">Open group</option>  
        
         <option id="permission_type" value="permission">Permissioned based group</option>
        
    </select>
    
    <br />
    
    
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;password:&nbsp;&nbsp;&nbsp;</label>
    
    <input id="password" type="password" name="password"/><br />
   
    <label>password-retype:</label><input id="password2" type="password" name="password2"/>
     <br />
    <label>Profile:</label><br /><textarea name="profile" id="memberJoinProfile" rows="4" cols="60"><?php echo $this->edit_group_page['profile']; ?></textarea>
    <br />
    <label>Group main picture</label><input  type="file" id="group_picture" name="group_picture" />
    
    <br />
    
    <label>&nbsp;</label><input type="submit" />
       
    
</form>

<script type="text/javascript">
     $(function(){
         $('#<?php echo $this->edit_group_page['type'].'_type'; ?>').attr('selected','selected');
     }); 
    </script> 
 