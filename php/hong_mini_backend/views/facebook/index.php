
<?php
 
//check to see if her got the invite code right
 //if(session::get('has_code')==true){
     
 echo '
     <h1 style="text-align:center;margin-top: 120px;">To register</h1> 
<p class="header" style="color:#888;font-family: "My Custom Font", Verdana, Tahoma;">Click the button below</p>

<a href="#" onclick ="javascript:registerValidPerson();"><img src="'.URL.'public/images/flogin.png" style="margin-right:auto; margin-left:auto; margin-top:30px;  display: block; " ></a>
<p class="header" style="color:#888; font-family: \'My Custom Font\', Verdana, Tahoma;"> or </p> 
<div><a href="'.URL.'register" class="header btn btn-warning" style="color:rgb(51, 123, 172); padding-top: 10px; color: white; height: 30px; width: 320px; font-size: 20px; display: block; margin: auto;">Create A New Account </a></div>
';
 
 
 
 /** }
 
 else{
     
     echo'<p class="header">Please request a code first</p>';
 }**/
?>
