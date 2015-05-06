<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



class gcm_battle_static{
    
    /**
     *
     * @param string $algo the algorithm md5, sha1, etc
     *  @data the data to encode
     * @param string $salt the salt(this should be same through system
     * @data the data to encode
     * @return string
     * 
     */
    
    public static function add_send($my_id, $message, $regid_array)
    { 
        $db = new database;
        
          $sth22=  $db -> prepare("SELECT * FROM `members_view` WHERE `index` =:sender_index");
        $sth22-> execute(array(
            ':sender_index' => $my_id
        ));
        
        $otherguy = $sth22->fetch();
        
	$api_key = "AIzaSyCTjUd8G4AinO0krIXZW1iJuxzspvCQwyE";
        
        
	$url = 'https://android.googleapis.com/gcm/send';
	$fields = array(
                'registration_ids'  => $regid_array,
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
        
    }
    
    
    
    
    
    }//end all static
    
    