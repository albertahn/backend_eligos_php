<?php

class group_control_model extends model 
{
    
    public function __construct()
    {
       
        parent::__construct();
    }
    
    
    //all groups
    
     public function  group_control_panel($group_index){
    
    $sth = $this->db->prepare('SELECT * FROM `mygroup_view` WHERE `group_index` = :id');
                $sth->execute(array(':id'=> $group_index));
                return $sth->fetchAll();
    
   
    
     }
    
     public function edit_member_page($members_index, $group_index){
         $sth = $this->db->prepare('SELECT * FROM `mygroup_view` WHERE `group_index` = :id AND `members_index`=:members_id');
                $sth->execute(array(
                    ':id'=> $group_index,
                    ':members_id'=> $members_index
                ));
                return $sth->fetch();
     }
       
        public function edit_member_submit($data){
            
           $sth = $this->db->prepare('UPDATE `members_has_group` 
              
                SET `status` = :status, `points_in_group` = :points_in_group
                 WHERE `members_index` = :members_index AND `group_index`=:group_index
             ');
          
          $sth->execute(array(
            ':status' => $data['edit_status_select'],
           ':points_in_group'=> $data['points_in_group'] , 
            ':members_index'=> $data['members_index'], 
            ':group_index'=> $data['group_index']
            
              
            ));
        
          
          header('location: '.URL.'group_control/group_control_panel/'.$data['group_index']);
        }
        
        public function delete_member_group_page($members_index, $group_index){
            $sth = $this->db->prepare('SELECT * FROM `mygroup_view` WHERE `group_index` = :id AND `members_index`=:members_id');
                $sth->execute(array(
                    ':id'=> $group_index,
                    ':members_id'=> $members_index
                ));
                return $sth->fetch();
            
            
        }
    
        public function delete_member_group_submit($members_index, $group_index){
             $sth = $this->db->prepare('DELETE FROM `members_has_group` WHERE `group_index` = :id AND `members_index`=:members_id');
                $sth->execute(array(
                    ':id'=> $group_index,
                    ':members_id'=> $members_index
                ));
            header('location: '.URL.'group_control/group_control_panel/'.$group_index);
           
        }
}
