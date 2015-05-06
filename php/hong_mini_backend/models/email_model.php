<?php

class email_model extends model {

function __construct() {
    parent::__construct();
}


//for side panel
    function send_confirm_mail($member_id) {
        
        $sth = $this->db->prepare('SELECT * FROM `members` WHERE `index` = :id');
                $sth->execute(array(':id'=> $member_id));
                $member_info= $sth->fetch();
                       
        $to      = $member_info['email'];
        $subject = 'confirmation email from meetingmeeting.com';
        $message = 'Welcome';
        $headers = 'From: services@meetingmeeting.com' . "\r\n" .
        'Reply-To: services@meetingmeeting.com' . "\r\n" .
         'X-Mailer: PHP/' . phpversion();

          mail($to, $subject, $message, $headers);
		   
		}
                //white list mx record
         
        
          
          
      
        

}
