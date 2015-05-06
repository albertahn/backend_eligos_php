<?php

class message_model extends model 
{
    
    public function __construct()
    {
       session::init();
        parent::__construct();
    }
    
    
    public function input_message($data){
        
        
         $sth1 = $this->db->prepare('SELECT * FROM  `has_message`
                WHERE  `reciever_index` IN ( :my_id, :other_id ) AND `sender_index` IN ( :my_id, :other_id)');
         
        $sth1->execute(array(
            ':my_id'=>$data['my_id'],
            ':other_id'=>$data['sending_to']
                ));
        
        $has_message_index = $sth1->fetch();
        
       // echo json_encode( $has_message_index);
        
        if(!empty ($has_message_index['index'])){ //if not empty
            //input new message
            
            
            
                    $sth= $this->db->prepare('INSERT INTO `messages` 
                                 (`body`,`members_index`, `has_message_index`) 
                          VALUES (:body, :members_index, :has_message_index)');



                       $sth->execute(array(
                           
                           ':body'=>$data['input_val'],
                           ':members_index'=>$data['my_id'],
                           ':has_message_index'=>$has_message_index['index']
                           
                           ));
          
          $message_index = $this->db->lastInsertId(); 
      
           $sth2 = $this->db->prepare('SELECT * FROM `messages_view` WHERE `messages_index`=:messages_index');
        $sth2->execute(array(
            ':messages_index'=> $message_index
        ));
        
            
        $data2 = $sth2->fetch();
       
        $json=json_encode($data2);
        
         echo $json;
       
            
        }else{ //make a new hasmessage id
            
            // echo $data['input_val'];
            
            $sth= $this->db->prepare('INSERT INTO `has_message` 
               (`sender_index`,`reciever_index`) 
        VALUES (:sender_index, :reciever_index)');



                       $sth->execute(array(
                           
                           ':sender_index'=>$data['my_id'],
                           ':reciever_index'=>$data['sending_to']
                           
                           ));
          
          $has_message_index = $this->db->lastInsertId(); 
          
   //now input messge
          
          $sth2= $this->db->prepare('INSERT INTO `messages` 
               (`body`,`members_index`, `has_message_index`) 
        VALUES (:body, :members_index, :has_message_index)');



                       $sth2->execute(array(
                           
                           ':body'=>$data['input_val'],
                           ':members_index'=>$data['my_id'],
                           ':has_message_index'=>$has_message_index
                           
                           ));
          
          $message_index = $this->db->lastInsertId(); 
          
     //show the message view now
          
          
           $sth3 = $this->db->prepare('SELECT * FROM `messages_view` WHERE `messages_index`=:messages_index');
        $sth3->execute(array(
            ':messages_index'=> $message_index
        ));
        
            
        $data3 = $sth3->fetch();
        
       
        $json=json_encode($data3);
        
         echo $json;
            
        }//end else no has m index
        
    } //end input message
    
    
    
    
//show_this_message
    
    public function show_this_message($my_id, $other_id){
        
        
        
         $sth1 = $this->db->prepare('SELECT * FROM  `has_message`
                WHERE  `reciever_index` IN ( :my_id, :other_id ) AND `sender_index` IN ( :my_id, :other_id)');
         
        $sth1->execute(array(
            ':my_id'=>$my_id,
            ':other_id'=>$other_id
                ));
        
        $message_index= $sth1->fetch();
        
        
         $sth2 = $this->db->prepare('SELECT * FROM `messages_view`
              WHERE `has_message_index` =:ms_id
               ORDER BY `timestamp`');
         
        $sth2->execute(array(
            ':ms_id'=>$message_index['index']
                ));
        
       $data= $sth2->fetchAll();
       
       
       //echo($my_id.$other_id);
      // print_r($message_index);
       
      echo json_encode($data);
        
    }
    
    
    public function list_message_summary($userid){
        
        
          $sth = $this->db->prepare('SELECT * FROM `messages_view`
              WHERE `has_message_index` IN (select `index` from `has_message` where `reciever_index` = :my_index OR `sender_index` = :my_index )
              GROUP BY `timestamp` ORDER BY `timestamp` DESC LIMIT 0,290');
        $sth->execute(array(
            ':my_index'=>$userid
                ));
       $data= $sth->fetchAll();
       
       
       
        $has_message_array= array();
        
        foreach ($data as $key => $value) {
            
            $has_message_array[$key] = $value['has_message_index'];
            
        }//end foreach
        
        
       
        
        $has_message_array = array_unique($has_message_array);
        
        //$real_data = array();
        $i=0;
        foreach ($has_message_array as $key => $value) {
            //get other person profile
            
            
       $sth2 = $this->db->prepare('SELECT * FROM  `members_view` WHERE
               `index` IN (SELECT `sender_index` from
               `has_message` WHERE `index`=:has_message_index AND `sender_index`!=:my_index) 
               OR `index` IN (SELECT `reciever_index` from
               `has_message` WHERE `index`=:has_message_index AND `reciever_index`!=:my_index) ');    
       
       
       $sth2->execute(array(
            ':has_message_index'=>$value,
            ':my_index'=>$userid
                ));     
       
       $otherperson= $sth2->fetchAll();
            
          //set the text and other person profile  
            $real_data[$i]= $data[$key];
            
            $real_data[$i]['other_person_pic'] =$otherperson[0]['profile_picture'];
            
            $real_data[$i]['other_person_name'] =$otherperson[0]['username'];
            $real_data[$i]['other_person_index'] =$otherperson[0]['index'];
          
            
            $i++;
        }
        
        
        //$cockarray = $real_data;
        echo json_encode($real_data);
        
        
       /* echo'<pre>';
        print_r(array_values($real_data));
        echo'</pre>';*/
        
    }
     
    
    
}
