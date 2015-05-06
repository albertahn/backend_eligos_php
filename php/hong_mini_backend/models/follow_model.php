<?php

class follow_model extends model 
{
    
    public function __construct()
    {
       session::init();
        parent::__construct();
    }
    
    
   
             
   public function show_user_followers($id){
       
             $sth = $this->db->prepare('SELECT * FROM `members_view` WHERE `index` IN (SELECT `student_index` FROM `mentorship` 
         WHERE `mentor_index` =:mentor_index)');
        $sth->execute(array(':mentor_index'=> $id));
        
            
        $data = $sth->fetchAll();
        
      // print($data);
      echo json_encode($data);
       
       
       
   }          
       
   
     public function people_im_following($id){
       
           $sth = $this->db->prepare('SELECT * FROM `members_view` WHERE `index` IN (SELECT `mentor_index` FROM `mentorship` 
         WHERE `student_index` =:student_index)');
        $sth->execute(array(':student_index'=> $id));
        
            
        $data = $sth->fetchAll();
        
      
       $return= $data;
      
       echo json_encode($return);
       
   }    
       
       
      
       
    
}
