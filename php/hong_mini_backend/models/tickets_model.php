<?php

class tickets_model extends model {

function __construct() {
    parent::__construct();
}



   //meeting info
    
    function meeting_info($id){
         $sth = $this->db->prepare('SELECT * FROM `meeting` WHERE `index`= :id');
        $sth->execute(array(':id'=> $id));
   return $sth->fetch();
        
        
    }

//show tickets
    function current_tickets($id){
         $sth = $this->db->prepare('SELECT * FROM `tickets_view` WHERE `meeting_index`= :id');
        $sth->execute(array(':id'=> $id));
   return $sth->fetchAll();
        
    }


//make tickets submit
    function make_tickets_submit($tickets_array){
        
        
       for ($i = 1; $i <= $tickets_array['num_tickets']; $i++){
         
             $sth = $this->db->prepare('INSERT INTO `tickets`(`code`,`state`,`meeting_index`) VALUES (:code, :state ,:meeting_index)');
                
                $sth->execute(array(
                    ':code'=>$tickets_array[$i]['code'],
                    ':state'=>available,
                    ':meeting_index'=>$tickets_array['meeting_index']
                    
                    ));
           }
          header('location: '.URL.'tickets/make_tickets_page/'.$tickets_array['meeting_index']); 
        
    }
    
//edit ticket part
    //group members
   function group_members($meeting_id){
        
       $sth = $this->db->prepare('SELECT * FROM `members` WHERE `index` IN (SELECT `members_index` FROM `members_has_group` WHERE `group_index` =(SELECT `group_index` FROM `meeting` WHERE `index`=:meeting_id))'); 
                
                $sth->execute(array(
                    ':meeting_id'=>$meeting_id
                    
                    ));
                return $sth->fetchAll(); 
                
             
       
   }
   
   function edit_ticket_page($ticket_id){
       $sth = $this->db->prepare('SELECT * FROM `tickets_view` WHERE `tickets_index` =:ticket_id '); 
                
                $sth->execute(array(
                    ':ticket_id'=>$ticket_id
                    
                    ));
                return $sth->fetch(); 
      
   }
   
  //give 
   function give_ticket_submit($give_array){
       //first insert person getting the ticket
      $sth = $this->db->prepare('INSERT INTO `has_ticket` (`members_index`, `tickets_index`) VALUES (:members_index, :ticket_index)'); 
                
                $sth->execute(array(
                    ':ticket_index'=>$give_array['ticket_index'],
                    ':members_index'=>$give_array['members_index']
                    
                    ));
 // update ticket state
   $sth = $this->db->prepare('UPDATE `tickets` SET `state`=:state WHERE `index`=:ticket_index'); 
                
                $sth->execute(array(
                    ':ticket_index'=>$give_array['ticket_index'],
                    ':state'=>$give_array['ticket_state_select']
                    
                    ));
                    
   header('location: '.URL.'tickets/make_tickets_page/'.$give_array['meeting_index']);     
   }
//edit submit   
   function edit_ticket_submit($give_array){
       //first insert person getting the ticket
      $sth = $this->db->prepare('UPDATE `has_ticket` set `members_index` =:members_index WHERE `tickets_index`=:ticket_index'); 
                
                $sth->execute(array(
                    ':ticket_index'=>$give_array['ticket_index'],
                    ':members_index'=>$give_array['members_index']
                    
                    ));
 // update ticket state
   $sth = $this->db->prepare('UPDATE `tickets` SET `state`=:state WHERE `index`=:ticket_index'); 
                
                $sth->execute(array(
                    ':ticket_index'=>$give_array['ticket_index'],
                    ':state'=>$give_array['ticket_state_select']
                    
                    ));
                    
   header('location: '.URL.'tickets/make_tickets_page/'.$give_array['meeting_index']);     
   }
 //delete ticket
   
   
   function delete_ticket($ticket_index, $meeting_index){
     $sth = $this->db->prepare('DELETE FROM `tickets` WHERE `index`=:ticket_index'); 
                
                $sth->execute(array(
                    ':ticket_index'=>$ticket_index   ));
   header('location: '.URL.'tickets/make_tickets_page/'.$meeting_index);               
     
 }
        

}
