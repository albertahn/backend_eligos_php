<?php

class gcm_push_static{
    
    /**
     *
     * @param string $algo the algorithm md5, sha1, etc
     *  @data the data to encode
     * @param string $salt the salt(this should be same through system
     * @data the data to encode
     * @return string
     * 
     */
    
    public static function message($my_id, $to_id, $message)
    {
        $db = new database;
      
        
         $st =  $db->prepare('SELECT * FROM  `has_message`
                WHERE  `reciever_index` IN ( :my_id, :other_id ) AND `sender_index` IN ( :my_id, :other_id)');
         
        $st->execute(array(
            ':my_id'=>$my_id,
            ':other_id'=>$to_id
                ));
        
        $has_message_array = $st->fetch();
        
        $has_message_id= $has_message_array['index'];
        
        
        if(!empty($has_message_id)){
            
            // $db = new database;
        
        $sth=  $db -> prepare("SELECT * FROM `has_message` WHERE `index`=:has_message_id");
        $sth-> execute(array(
            ':has_message_id' => $has_message_id
        ));
        
        $has_mes_stuff = $sth->fetch();
            
        
        }//end if has message id
        
        $sth1=  $db -> prepare("SELECT * FROM `has_device` WHERE `members_index`=:to_id");
        $sth1-> execute(array(
            ':to_id'=> $to_id
        ));
        
        $hasdev_array = $sth1->fetchAll();
  
        
//get stuff from person sending it        
          $sth2=  $db -> prepare("SELECT * FROM `members_view` WHERE `index` =:sender_index");
        $sth2-> execute(array(
            ':sender_index' => $my_id
        ));
        
        $otherguy = $sth2->fetch();
        
      
        //get the member gcm index
     
        // please enter the api_key you received from google console
	$api_key = "AIzaSyCTjUd8G4AinO0krIXZW1iJuxzspvCQwyE";
       
        foreach ($hasdev_array as $key => $value) {
            
            
	// please enter the registration id of the device on which you want to send the message
	$registrationIDs =  array($value['gcm_reg_code']);
	
	$url = 'https://android.googleapis.com/gcm/send';
	$fields = array(
                'registration_ids'  => $registrationIDs,
                'data'              => array( "message" => $message,
                                    "notify_type"=>"private_message",
                                    "has_message_id"=>$has_message_id,
                                    "otherguy_index"=>$otherguy['index'] ,
                                    "otherguyname"=>$otherguy['username'],
                                    "otherguy_pic"=> $otherguy['profile_picture'])
                );

	$headers = array(
					'Authorization: key=' . $api_key,
					'Content-Type: application/json');
					
					
					
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$result = curl_exec($ch);
	curl_close($ch);
        
  //echo json_encode($result);
        }//end foreach
	
	
        
    }//end public static function message($my_id, $to_id, $message)
    
    
    
 
    
    //test
    public static function testing($message)
    {
        
          // please enter the api_key you received from google console
	$api_key = "AIzaSyCTjUd8G4AinO0krIXZW1iJuxzspvCQwyE";
       
            
	// please enter the registration id of the device on which you want to send the message
	$registrationIDs= "APA91bGhhW8AI_5BjqYKnru9ID9wAUtZVUteQPaSkNV0AVE1OX1mXx9twqSA1wkqL2u17T9hCJ_1zZFDmvxjgBGZ7b8iR6hMrfkSMEEawjMSy-UEtRiX2wFr0aHko8GwPT4hHq575y6B0hhJc782WUUpmaIOPzahkzOE9QYHfWz3s_mWdscAk8o";
	
	$url = 'https://android.googleapis.com/gcm/send';
	$fields = array(
                'registration_ids'  => $registrationIDs,
                'data'              => array( "message" => $message),
                );

	$headers = array(
					'Authorization: key=' . $api_key,
					'Content-Type: application/json');
					
					
					
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        //curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$result = curl_exec($ch);
	curl_close($ch);
        
        print_r($result);
        
        echo json_encode( $fields );
        
    }//
    
    //group chat
    
    
    public static function group_chat($my_id, $message)
    { 
        
        $db = new database;
          $sth22=  $db -> prepare("SELECT * FROM `members_view` WHERE `index` =:sender_index");
        $sth22-> execute(array(
            ':sender_index' => $my_id
        ));
        
        $otherguy = $sth22->fetch();
        
          $sth1=  $db -> prepare("SELECT * FROM `has_device` WHERE `notify`=:yes");
        $sth1-> execute(array(
            ':yes'=> "yes"
        ));
        
        
        $hasdev_array= $sth1->fetchAll();
        
        // please enter the api_key you received from google console
	$api_key = "AIzaSyCTjUd8G4AinO0krIXZW1iJuxzspvCQwyE";
        
        $registrationIDs = array();
        
        foreach ($hasdev_array as $key => $value) {
            
	// please enter the registration id of the device on which you want to send the message
	  array_push($registrationIDs, $value['gcm_reg_code']);
	
        }//end foreach
        
        
	$url = 'https://android.googleapis.com/gcm/send';
	$fields = array(
                'registration_ids'  => $registrationIDs,
                'data'              => array( "message" => $message,
                                    "notify_type"=>"group_chat",
                                    
                                    "otherguy_index"=>$otherguy['index'] ,
                                    "otherguyname"=>$otherguy['username'],
                                    "otherguy_pic"=> $otherguy['profile_picture'])
                );

        
	$headers = array(
					'Authorization: key=' . $api_key,
					'Content-Type: application/json');
					
				
        
        $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$result = curl_exec($ch);
	curl_close($ch);
        
        
        /*
        echo'hi<pre>';
       print_r($registrationIDs);
       echo'</pre>';
    */
    }//end groupchat
    
    
    //test groupchat
    
    public static function test_group_chat($my_id, $message)
    { 
        
        $db = new database;
          $sth22=  $db -> prepare("SELECT * FROM `members_view` WHERE `index` =:sender_index");
        $sth22-> execute(array(
            ':sender_index' => $my_id
        ));
        
        $otherguy = $sth22->fetch();
        
          $sth1=  $db -> prepare("SELECT * FROM `has_device` WHERE `members_index` IN ('23','24','25', '27', '41')");
        $sth1-> execute(array(
            ':yes'=> "yes"
        ));
        
        
        $hasdev_array= $sth1->fetchAll();
        
        // please enter the api_key you received from google console
	$api_key = "AIzaSyCTjUd8G4AinO0krIXZW1iJuxzspvCQwyE";
        
        $registrationIDs = array();
        
        
        foreach ($hasdev_array as $key => $value) {
            
	// please enter the registration id of the device on which you want to send the message
	  array_push($registrationIDs, $value['gcm_reg_code']);
	
        }//end foreach
        
        
	$url = 'https://android.googleapis.com/gcm/send';
	$fields = array(
                'registration_ids'  => $registrationIDs,
                'data'              => array( "message" => $message,
                                    "notify_type"=>"group_chat",
                                    
                                    "otherguy_index"=>$otherguy['index'] ,
                                    "otherguyname"=>$otherguy['username'],
                                    "otherguy_pic"=> $otherguy['profile_picture'])
                );

        
	$headers = array(
					'Authorization: key=' . $api_key,
					'Content-Type: application/json');
					
				
        
        $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$result = curl_exec($ch);
	curl_close($ch);
        
        
       echo'<pre>';
       print_r($result);
       echo'</pre>';
    
    }
    
    }//end all static
    
    