<h1>user edit</h1>


<form enctype="multipart/form-data" method="post" action="<?php echo URL; ?>register/edit_profile" >
    
    <label>name</label><input type="text" name="name" value="<?php echo $this->my_profile['username']; ?>"/><br />
    <label>email</label><input type="text" name="email" value="<?php echo $this->my_profile['email']; ?>"/><br />
    <label>password:</label><input type="password" name="password"/><br />
    
    <label>password-retype:</label><input type="password" name="password2"/>
     <br />
    <label>Profile:</label><br /><textarea name="profile" id="memberJoinProfile"  rows="4" cols="60"> <?php echo $this->my_profile['profile']; ?></textarea>
    <br />
   
    
    <label>profile picture</label><input type="file" id="profile_picture2" name="profile_picture2" />
    
    <br />
  
 
    
    <label>&nbsp;</label><input type="submit"/>
        
    
    
</form>

 <?php echo '<img src="'.MEMBERS_PIC.'/'.session::get('profile_picture').'" width="150px" height="180px"  alt="picture" style="background:#005554; border-right: 2px solid #ccc; border-bottom: 2px solid #fff; padding:5px; border-radius: 10px;"  />'; ?>
 
 