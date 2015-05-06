<form enctype="multipart/form-data" method="post" action="<?php echo URL; ?>group/create_group" >
    
    
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Group name:</label>
    
    <input type="text" name="name"/><br />
    
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Location: &nbsp;&nbsp;&nbsp;&nbsp; </label>
    
    <input type="text" name="location"/><br />
    
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Group type:</label>
    
    <select id="groupType" name="groupType" onchange="going();">
         <option value="password">Password needed group</option>  
        <option value="open">Open group</option>  
        
         <option value="permission">Permissioned based group</option>
        
    </select>
    
    <br />
    
    
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;password:&nbsp;&nbsp;&nbsp;</label>
    
    <input id="password" type="password" name="password"/><br />
   
    <label>password-retype:</label><input id="password2" type="password" name="password2"/>
     <br />
    <label>Profile:</label><br /><textarea name="profile" id="memberJoinProfile" placeholder="Tell us about the group" rows="4" cols="60"></textarea>
    <br />
    <label>Group main picture</label><input onclick="hidePasswordInput();" type="file" id="group_picture" name="group_picture" />
    
    <br />
    
    <label>&nbsp;</label><input type="submit" />
        
    
    
</form>