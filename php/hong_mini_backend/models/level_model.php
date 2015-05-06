<?php

class level_model extends model {

function __construct() {
    parent::__construct();
}


         
    public function update_level($data){
        
        
        
        $sth = $this->db->prepare('SELECT * FROM `members` WHERE `index`=:id');
          
          $sth->execute(array(
            ':id' => $data['user_index']
                 ) );
         
          $user_data = $sth->fetch();
        
          
          if($user_data['level'] < $data['new_level']){
              
        $sth = $this->db->prepare('UPDATE `members`
                SET `level` = :level
                WHERE `index` = :id
             ');
          
          $sth->execute(array(
            ':id' => $data['user_index'],
              ':level' => $data['new_level']
            ));
       
          }
          echo'{"result":"levelup"}';
          
    }// end update

    
    public function level_ranking(){
        
        
        $sth = $this->db->prepare('SELECT `level`, COUNT(*) FROM `members`
                GROUP BY `level`
             ');
          
          $sth->execute();
          
          $result = $sth->fetchAll();
       
          
          echo json_encode($result);
        
    }//end level ranking
    
    public function get_last_success_day($user_index) {
        
           $sth = $this->db->prepare('SELECT * 
FROM  `bp_examples_view` 
WHERE  `course_index` =1
AND  `members_index` =:user_index
LIMIT 0 , 30 ');
          
          $sth->execute(array(
            ':user_index' => $user_index
            ));
          
          $result = $sth->fetch();
       
          
          echo json_encode($result);
        
    }
}
