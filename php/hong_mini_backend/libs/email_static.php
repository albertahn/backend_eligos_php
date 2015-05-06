<?php


class email_static{
    
    /**
     *
     * @param string $algo the algorithm md5, sha1, etc
     *  @data the data to encode
     * @param string $salt the salt(this should be same through system
     * @data the data to encode
     * @return string
     * 
     */
    
    public static function goal_mail($goal_id, $pro_pic, $username, $comment)
    {
        
                    $header = 'From: no-reply@tanggoal.com' . "\r\n" .
                'Reply-To: no-reply@tanggoal.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
                    
                    // $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    

                    $subject= "Your friend just made an accomplishment on Tanggoal! ".$name;

             
             $email_text_area = '
	<div style="width:100%; height:220px;">
        
<a href="'.URL.'product/inside_product/'.$goal_id.'" target="_blank" >
            <img src="'.URL.'views/about/images/about_logo.png" />
        
            <img src="'.URL.'public/uploads/members_pic/'.$pro_pic.'"
            style="width:100px;  height:50px; float: right;" 
            />
        </a>
        
         
	
	
        
        <p>Your friend '.$username.' just commented on your goal! Check it our <a href="'.URL.'product/inside_product/'.$goal_id.'" >here</a></p>
	

   <div class="comment">
   <a href="'.URL.'product/inside_product/'.$goal_id.'" target="_blank" >
    <img src="'.URL.'public/uploads/members_pic/'.$pro_pic.'" style="width:50px; height:50px;" /> 
    <span style="color: #4A69B8; font-size: 16px;"> "'.$comment.'"</span>
   </a>
   </div>
</div>
        
' ;
             
             
             
             
        $db = new database;
        
        $sth=  $db -> prepare("SELECT `email` FROM members WHERE `index` IN 
            (SELECT `members_index` FROM `member_has_course` 
            WHERE `course_index` =:course_index)");
        $sth-> execute(array(
            ':course_index' => $goal_id
        ));
        
        $data = $sth->fetchAll();
        
             
  $emails =  $data;  
             
   /**
     foreach($emails as $key => $value){
   echo'<script>alert("'.$value['email'].'");

            </script>';
   }
    * **/
                
             
    
                   foreach($emails as $key=>$value){

            $mailed = mail($value['email'], $subject, $email_text_area, $header);
            if($mailed){
                //echo "Thanks for the feedback!";
            }else{
                echo "Notice was not sent...Try it again :(";
            }
                }
                /*
                echo'<script>alert("Thanks for your feedback! Your voice means everything to us.");

            </script>

            ';
   */
        
    }  //goal mail
}
?>
