<?php

class google_cloud_model extends model 
{
    
    public function __construct()
    {
       
        parent::__construct();
    }
  
    public function check_gcm_device($user_index, $gcm_id, $device_name){
        
        
        // $this->check_banned($user_index, $gcm_id, $device_name);
        
          $sth = $this->db->prepare('SELECT * FROM `has_device` WHERE
                   `gcm_reg_code` = :gcm_id AND `members_index`=:members_index');
          $sth->execute(array(
              ':gcm_id'=> $gcm_id,
              ':members_index'=>$user_index
                  ));
          $return= $sth->fetch();
          
          if(!empty($return)){
            
              //echo the return
              echo json_encode($return);
              
          }else{ //insert the data then retrieve
              
              
          $sth2 = $this->db->prepare('INSERT INTO `has_device` (members_index, device_type, gcm_reg_code) VALUES
                                  (:members_index, :device_type, :gcm_reg_code)');
          $sth2->execute(array(':members_index'=>$user_index, 
                                ':device_type'=>$device_name, 
                                ':gcm_reg_code'=>$gcm_id
              ));
          
          
           $device_index = $this->db->lastInsertId();   
           
            $sth4 = $this->db->prepare('SELECT * FROM `has_device` WHERE
                   `index` = :device_index');
            $sth4->execute(array(':device_index'=> $device_index));
            
          $return2= $sth4->fetch();
          
          echo json_encode($return2);
              
          }
       
       $this->check_banned($user_index, $gcm_id, $device_name);
       
       $this->delete_old_codes($user_index, $gcm_id, $device_name);
        
    }//end
    
    
    public function check_banned($user_index, $gcm_id, $device_name) {
        
        //select if already in device and is banned
        
     
        
            $sth1 = $this->db->prepare('SELECT * FROM `has_device` WHERE
                   `device_type` = :device_name AND `gcm_reg_code` = :gcm_id AND `status` = :banned ');
            
            $sth1->execute(array(
                ':device_name' => $device_name,
                ':gcm_id' =>$gcm_id,
                ':banned' =>"ban"
                    
                    ));
            
         // $is_banned = $sth1->fetchAll();
        //rebann user index in members update
          
          $count = $sth1->rowCount();
          
          if($count>0){
              //bann the user
              
              echo 'ban';
              
              $sth2 = $this->db->prepare('UPDATE `members` 
                SET `status` = :status
                WHERE `index` = :id
                
             ');
              
              $sth2->execute(array(
                  
                  ':status' =>'ban',
                  ':id' => $user_index
                  
              ));
              
              
          }else{ //end if
              
              $sth2 = $this->db->prepare('UPDATE `members` 
                SET `status` = :status
                WHERE `index` = :id
             ');
              
              $sth2->execute(array(
                  
                  ':status' =>'good',
                  ':id' => $user_index
                  
              ));
              
              
          }//end else
          
        
    }//end check banned
    
    
   public function delete_old_codes($user_index, $gcm_id, $device_name){
       
        $sth1 = $this->db->prepare('SELECT * FROM `has_device` WHERE
                   `members_index` = :user_index ORDER BY `index` ASC');
            
            $sth1->execute(array(
                ':user_index' =>$user_index
                    
                    ));
            
         // $is_banned = $sth1->fetchAll();
        //rebann user index in members update
          
          $count = $sth1->rowCount();
          $data = $sth1->fetchAll();
          
          if($count>1){
              $sth2 = $this->db->prepare('DELETE FROM `has_device` WHERE
                   `index` = :index');
            
              $sth2->execute(array(
                'index' =>$data[0]['index']
                    
                    ));
          }
          
          
          /*echo'<pre>';
              print_r($data);
              echo'</pre>';*/
       
   }
                
}//end class