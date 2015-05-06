<h1 style="text-align:center;margin-top: 10px;">Create Major</h1>

<form style="margin-left:20px;" enctype="multipart/form-data" method="post" action="<?php echo URL; ?>major/create_major_submit"  >
    
    
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Major Name:</label>
    
    <input type="text" name="name"/><br />
    
    <br />
    
    
     <br />
    <label>Description:</label><br /><textarea name="major_description" id="memberJoinProfile" placeholder="Tell us about the major" rows="4" cols="60"></textarea>
   
    <br />
    <label>Automatically Add Courses From Berkeley Api?:</label>Yes: <input type="radio" name="auto_switch" value="yes" />
    <br /> No: <input type="radio" name="auto_switch" value="no" />
    
    <br /> <span>Department Code:  </span><input type="text" name="department_code" placeholder="Type Department code"/>
    <span onclick="window.open('https://schedulebuilder.berkeley.edu/explore/', '_blank');" style="color:blue;font-size: 10px;">click here to lookup department codes</span>
    <label>&nbsp;</label><input type="submit" />
    
    
</form>