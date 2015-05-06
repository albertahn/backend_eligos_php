<?php

require_once('facebook.php');
require_once('../../config/database.php');
require_once('../../config/paths.php');
require_once('../../libs/database.php');
require_once('../../libs/session.php');

// Create our Application instance.


$app_id = "226061124076656";
    $app_secret = "e55efcbe89af6e99850dbad85d8aad2f";
    $my_url = "http://sharebasket.com/public/facebook/facebook_login.php";

$facebook = new Facebook(array(
  'appId' => '226061124076656',
  'secret' => 'e55efcbe89af6e99850dbad85d8aad2f',
  'cookie' => true,
));


$session = $facebook->getSession();
$user = null;
//email, user_location, read_friendlists, publish_actions, user_about_me, user_online_presence, publish_stream

 $code = $_REQUEST["code"];
 if(empty($code)) {
        $dialog_url = "http://www.facebook.com/dialog/oauth?client_id=" 
            . $app_id . "&redirect_uri=" . urlencode($my_url)."&scope=email, user_location, read_friendlists, publish_actions, user_about_me, user_online_presence, user_birthday";

        echo("<script> top.location.href='" . $dialog_url . "'</script>");
    }
else{
    

 
   	if(!$facebook->getSession())
	{
		echo("<script> top.location.href='" . $facebook->getLoginUrl() . "'</script>");

	}
        

global $facebook;

    $loginUrl = $facebook->getLoginUrl(array(
                    'scope'=>'email, user_location, read_friendlists, publish_actions, user_about_me, user_online_presence, publish_stream'
                    
        ));
        
        

if (!empty($session))
{
	
		try {
	    	 $uid = $facebook->getUser();
	     	$user = $facebook->api('/me');
			} catch (Exception $e) {}

	if(!empty($user))
	{
			
	  		
	   		$u= $user['name'];
	   		
		    $fb_id=$user['id'];
		
  // see if the  user has logged in before and whether has registered with fb or manually
            
             $db = new database();
     $sth = $db->prepare('SELECT * FROM `members` WHERE `email`=:email');
        $sth->execute(array(
            ':email'=>$user['email']  
            
            ));
        
      $the_guy=$sth->fetch(); 
      $count=$sth->rowCount();
      
     // print_r($the_guy);
 //registered with fb     
     if($count>0 && $user['id']==$the_guy['FID']){
 //log him in
         
            session::init();
            session::set('username',  $the_guy['username']);
            session::set('usertype',  $the_guy['usertype']);
            session::set('profile_picture',  $the_guy['profile_picture']);
            session::set('index',  $the_guy['index']);
            session::set('password',  $the_guy['password']);
            session::set('loggedin', true);
            session::set('language', $the_guy['language']);
            header('location: '.URL);
         
     }
     
     else if($count>0 && $user['id']!==$the_guy['FID']){
 //registered manually
         //type in your password to login
       
         header('location: '.URL.'login/facebook_click/'.$user['email']);
         
     }
     
     
     else if(empty($count)){
 //create a new account
         //first install their picture
         
         $fql = 'SELECT pic_big FROM user WHERE uid ='.$fb_id;
	
	
	     $ret_obj = $facebook->api(array(
                                   'method' => 'fql.query',
                                   'query' => $fql,
                                 ));
		$imgurl=$ret_obj[0][pic_big];
		
		
//save the image
 		 $pic_suffix= substr($imgurl, strrpos($imgurl, ".")+1); 
     
		 $picture_name=md5($imgurl.time()).".".$pic_suffix;
        
        
		 $picture_path = '../uploads/members_pic/'.$picture_name;



//move files to members_pic

file_put_contents($picture_path, file_get_contents($imgurl));

 //register
        session::init();
        
        $db1 = new database();
        $sth = $db1->prepare('INSERT INTO `members` (username, first_name, last_name, birthday, email, profile_picture, usertype, FID)
                                                    VALUES (:username, :first_name, :last_name, :birthday, :email, :profile_picture, :usertype, :FID)');
        
        
        $sth->execute(array(
            ':username' => $user['name'],
            ':first_name'=>$user['first_name'],
            ':last_name'=>$user['last_name'],
            ':birthday'=>$user['birthday'], 
            
            ':email'=>$user['email'],
            ':profile_picture'=>$picture_name,
            ':usertype'=>fb,
            ':FID'=>$user['id']
            
            ));
        
        $index = $db1->lastInsertId();
       
        // resession the profile picutre
       session::destroy();
        
        //
         $db2 = new database();
        $sth= $db2-> prepare("SELECT * FROM members WHERE index = :index");
        $sth-> execute(array(
           ':index'=>$index        ));
        
        $data = $sth->fetch();
        
        
     
       
            
            session::init();
            
            session::set('usertype',  $data['usertype']);
            session::set('profile_picture',  $picture_name);
            session::set('index',  $index);
            session::set('password',  $data['password']);
            session::set('loggedin', true);
             session::set('language', $data['language']);
            
     header('location: '.URL);
         
         
     }
            


}
	else{
		  $url = $facebook->getLoginUrl();
       header ("Location: $url");
	
	}
}

else{
       $url = $facebook->getLoginUrl();
      header ("Location: $url");

}

}
?>