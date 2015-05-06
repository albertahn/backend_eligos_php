<?php

class role_model extends model 
{
    
    public function __construct()
    {
       
        parent::__construct();
    }
    
    
    
    public function request_role($data){
        
      
        $sth1 = $this->db->prepare('SELECT * FROM `request_role` WHERE `roles_index`=:roles_index AND `members_index`=:members_index');
          
        $sth1->execute(array(
            ':roles_index'=>$data['role_id'],
            ':members_index'=>session::get('index')
            
            ));
        if( $sth1->rowCount() > 0 ){
            
            header('location:'.URL.'error/role_request_again');
            
        }
       
        else{
        $sth = $this->db->prepare('INSERT INTO `request_role` (`roles_index`, `members_index`, `status`)
                                                    VALUES (:roles_index, :members_index, :status)');
        
        
        $sth->execute(array(
            ':roles_index'=>$data['role_id'],
            ':members_index'=>session::get('index'),
            ':status'=>pending
           
            ));
        
        
        header('location:'.URL.'product/inside_product/'.$data['meeting_id']);
          // print_r($data);
             
                
       
        }

    }
    
    
    public function drop_role($data){
        
      
        $sth1 = $this->db->prepare('SELECT * FROM `request_role` WHERE `roles_index`=:roles_index AND `members_index`=:members_index');
          
        $sth1->execute(array(
            ':roles_index'=>$data['role_id'],
            ':members_index'=>session::get('index')
            
            ));
        if( $sth1->rowCount()== 0 ){
            
            header('location:'.URL.'error/role_request_empty');
            
        }
       
        else{
        $sth = $this->db->prepare('DELETE  FROM `request_role` WHERE `roles_index` = :roles_index AND `members_index` = :members_index');
        
        
        $sth->execute(array(
            ':roles_index'=>$data['role_id'],
            ':members_index'=>session::get('index')
           
           
            ));
        
        
        header('location:'.URL.'product/inside_product/'.$data['meeting_id']);
          // print_r($data);
             
                
       
        }

    }
    
    //accept trade
    /**
    
    public function accept_trade_page($trade_id){
          
        $sth = $this->db->prepare('SELECT * FROM`product_requests_view` WHERE `trade_index`=:id');
        
        
        $sth->execute(array(
            
            ':id'=>$trade_id
           
            ));
        
        return $sth->fetch();
        
       
          
      }
      
      
       public function accept_trade($trade_id){
          
        $sth = $this->db->prepare('UPDATE `trade` 
              
                SET `state` = :accepted
                 WHERE `index` = :id');
        
        
        $sth->execute(array(
            ':accepted'=>accepted,
            ':id'=>$trade_id
           
            ));
        
        
       
          
      }
     * 
     */
    
    
    
}
