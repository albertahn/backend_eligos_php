<h1 class="small_header">
    Login</h1>
<p>You have signed up without facebook connect before. Please type in your password to continue login.</p>

<form action="<?php echo URL;?>login/run" method="post">
    
    <input type="hidden" name="email" value="<?php echo $this->facebook_data; ?>"/><br />
    <label>password</label><input type="password" name="password" /><br />
    <label></label><input  class="uiButton" value="login" style="color:#fff; background:#000;" type="submit" />
     <br />
</form>
<!--<a href="<?php echo URL; ?>register" style="float: right;"  class="uiButton">register</a> -->
