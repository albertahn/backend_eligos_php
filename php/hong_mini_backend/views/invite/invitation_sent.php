<?php
echo'<p class="header" style="background:#aaa;margin-top:20px;">Invitation will be sent to your email soon.</p><p> Please check after a while(max 1 hour).
        Servers are verifying your email.</p>';

 $to= "albert@berkeley.edu";
 
 
$school_mail= substr( strrchr( $to, '@' ), 1 );
 
 
//preg_match($pattern, $to, $school_mail);


//print_r($school_mail);

//print_r($this->request_invite);
         

?>
