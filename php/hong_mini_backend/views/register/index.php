<?php
 
//check to see if her got the invite code right

// if(session::get('has_code')==true){
     
     
 echo'
<div style="width:300px; margin:auto;">
<h1 style="padding-top:20px;">Signup Instantly!</h1>
<form enctype="multipart/form-data" method="post" action="'.URL.'register/reg" >
    
    
    <label>Name:</label><input type="text" name="name"/><br />
    <label>Email:</label><input type="text" name="email" placeholder="email@berkeley.edu"/><br />
    <label>Password:</label><input type="password" name="password"/><br />
    
    <label>Password-retype:</label><input type="password" name="password2"/>
     <br />
    <label>Profile:</label><br /><textarea name="profile" id="memberJoinProfile" placeholder="Tell us about yourself" rows="4" cols="60"></textarea>
    <br />
    <label>Profile picture</label><input type="file" id="profile_picture" name="profile_picture" />
    
    <br />
    
    <label>&nbsp;</label><input type="submit"/>
        
    
    
</form>
     </div>
     ';
 /*
 }else{
     
     echo'Please get an invitation code first.';
 }
*/
?>