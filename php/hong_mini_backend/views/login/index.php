<?php


                echo'<h1 style="text-align: center; margin-top: 120px;">Login</h1>';
                echo"<h1 style='text-align: center; background:#fff; padding: 30px; width: 50%;margin: auto;'>
                    
                   ";  
                
               echo'
                   
                   <form action="'.URL.'login/run" method="post">
    <label></label><input type="text" name="email" placeholder="email"/><br />
    <label></label><input type="password" name="password" placeholder="password"/><br />
    <label></label><input  class="btn" value="login" style="" type="submit" /> <a style="font-size:10px;" href="" >      forgot password?</a>
   
</form>

<!--
<form name="fb_login_hidden" action="'.URL.'facebook/facebook_login" method="post">
    
    <input type="hidden" name="email" id="hidden_email"/>
    <input type="hidden" name="access_code" id="hidden_access_code" />
    <input type="hidden" name="FID" id="hidden_FID" />
    
   
</form>-->

    <!-- <a href="'.URL.'register" >register</a>-->
                 <p style="color:#aaa; font-size:20px; text-align:center;">OR </p> ';
               
       echo"<a href='#' onclick ='javascript:registerValidPerson();'>
                    <img src='".URL."public/images/flogin.png' style='display:block; margin-left:auto; margin-right:auto; margin-top: 10px;' />
                       </a>
            </h1> "; //end h1 for all    

?>
