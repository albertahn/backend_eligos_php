<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



class battle_model extends model {

function __construct() {
    
    parent::__construct();
    
    
}


  
 function add_btn_press($user_index, $day_number){
     
     //check if i am added to nfc goal number 1
     $added_goal = $this->check_add_nfc_goal($user_index, $day_number);
     
     if($added_goal=="yes"){
         
        // echo '{"added goal":"worked'.$day_number.'"}';
     
     // if is added add to day personal to ncf goal 1
     $this->updateDay($user_index, $day_number);
     
     //update my num days battle my friends
     $this->add_battle_friend_day($user_index, $day_number);
     
     //gcm send to my friends array of their GCm code     
     $this->send_gcm_battle_array($user_index, $day_number);
     
     
     }else{
         //add the goal and update
         echo '[{"added goal":"worked"}]';
         
           $sth1=  $this->db->prepare("INSERT INTO `member_has_course` (`members_index`, `course_index`, `success`) "
                   . "VALUES (:members_index, :course_index, :success)");
        $sth1-> execute(array(
            ':members_index'=> $user_index,
            ':course_index' => "1",
            ':success' =>$day_number
        ));
        
        //update my num days battle my friends
     $this->add_battle_friend_day($user_index, $day_number);
     
     //gcm send to my friends array of their GCm code     
     $this->send_gcm_battle_array($user_index, $day_number);
     }//end else
    
    
 }//end btn
 
 //check of add nfc goal
 function check_add_nfc_goal($user_index, $day_number){
     
          $sth1=  $this->db->prepare("SELECT * FROM `member_has_course` WHERE `members_index` =:user_index AND `course_index` = :course_index ");
        $sth1-> execute(array(
            ':user_index'=> $user_index,
            ':course_index' => "1"
        ));
        
        $count = $sth1->rowCount();
        
        if($count>0){
            
            //echo "yes";
            
            return "yes";
        }else{
            
            return "no";
        }
     
 }//end btn
 
 
 function updateDay($user_index, $day_number){
     
       $sth1=  $this->db->prepare("UPDATE `member_has_course`
                SET `success` = :day_number
                WHERE `members_index` = :user_index AND `course_index`=:course_index");
        $sth1-> execute(array(
            ':day_number'=>$day_number,
            ':user_index'=> $user_index,
            ':course_index' => "1"
        ));
        
        
        //update last success in the members db
        
         $sth2=  $this->db->prepare("UPDATE `members`
                SET `last_success` = :day_number
                WHERE `index` = :user_index");
        $sth2-> execute(array(
            ':day_number'=>$day_number,
            ':user_index'=> $user_index
        ));
     
        echo '[{"updatedday":"worked"}]';
 }//end addDay
 
 function add_battle_friend_day($user_index, $day_number){
     
     //select all friends Im battleing with   up one day  UPDATE `databasename`.`tablename` SET fieldB = fieldB + 1 WHERE fieldA='2';
     // echo $user_index.':'. $day_number;
     
      $sth2=  $this->db->prepare("UPDATE `friends`
                SET `friend_score` = friend_score+1
                WHERE `friend_index` = :user_index AND `battle` =:yes");
        $sth2-> execute(array(
            ':user_index'=> $user_index,
            ':yes' =>"yes"
        ));
     
     //for each friend update the day in has friend
     
 }// add battle
 
 
 
 function send_gcm_battle_array($user_index, $day_number){
     
     $message = "Battle Day: ".$day_number;
     
     //get all regids here first
     
     $sth1=  $this->db->prepare("SELECT * FROM `has_device` WHERE `members_index` IN (SELECT `my_index` FROM `friends`
                WHERE `friend_index` = :user_index AND `battle` =:yes)");
        $sth1-> execute(array(
            ':yes'=> "yes",
            ':user_index' =>$user_index
        ));
        
        
        $hasdev_array = $sth1->fetchAll();
        
        
         $regid_array = array();
        
        foreach ($hasdev_array as $key => $value) {
            
	// please enter the registration id of the device on which you want to send the message
	  array_push($regid_array, $value['gcm_reg_code']);
	
        }//end foreach
     
          gcm_battle_static::add_send($user_index, $message, $regid_array);
             
             
            /* echo '<pre>';
             
             print_r($hasdev_array);
             
             echo'</pre>';*/
    
 }
 
}//end class