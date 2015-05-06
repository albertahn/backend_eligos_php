<?php

class product_model extends model 
{
    
    public function __construct()
    {
       
        parent::__construct();
    }
    
    
    //list products
     public function my_goals_list($my_index){
        
        $sth = $this->db->prepare('SELECT * FROM `bp_examples_view` WHERE `members_index`= :id');
         $sth->execute(array(
            ':id'=> $my_index
            ));
       $return= $sth->fetchAll();
       
      
      echo $_GET['callback'].'('.json_encode($return).')';
   
     }
     
     
     
 //**inside product page
     public function inside_product($id){
          $sth = $this->db->prepare('SELECT * FROM `courses` WHERE `index`= :id');
        $sth->execute(array(':id'=> $id));
  
   
      $return= $sth->fetch();
      
      echo json_encode($return);
         
     }
    
     public function product_modules($id){
      
          $sth = $this->db->prepare('SELECT * FROM `course_modules` WHERE `courses_index`= :id');
        $sth->execute(array(':id'=> $id));
  
   
      $return= $sth->fetchAll();
      
      echo json_encode($return);
         
     }


public function upload_admin($id){
     
        $sth = $this->db->prepare('SELECT * FROM `member_has_course` WHERE `course_index`= :id AND `status`=:admin');
        $sth->execute(array(
            ':id'=> $id,
            ':admin'=>'admin'
            ));
   $has_meeting = $sth->fetch();
      $sth2= $this->db->prepare('SELECT * FROM `members_view` WHERE `index`= :user_index');
      $sth2->execute(array(
            ':user_index'=> $has_meeting['members_index']
            ));
      $return= $sth2->fetch();
      
      echo json_encode($return);
   }
  //create the product 
     public function create_product($data){ 
         
         foreach($data as $key => $value){
             
             if(empty($value)){
                 $data[$key]=""; 
                 
             }
         }
         
        
//insert data       
        $sth = $this->db->prepare('INSERT INTO `courses` (`name`, `description`, `privacy`) 
                                                  VALUES (:name, :description, :privacy)');
        
        $sth->execute(array(
            ':name'=>$data['name'], 
            ':description'=>$data['description'], 
            // ':category'=>$data['category'],
            ':privacy'=>$data['privacy']
        ));
        
        
      
//the last inserted index          
         $course_index = $this->db->lastInsertId();
 //member_has_meeting as admin insert
         $sth1 = $this->db->prepare('INSERT INTO `member_has_course` (`members_index`, `course_index`, `status`) 
                                                  VALUES (:members_index, :course_index, :admin)');
        
        $sth1 ->execute(array( 
            ':members_index'=>$data['user_index'],
            ':course_index'=>$course_index,
            ':admin'=>'admin'
            ));
         
         echo $course_index;
         
    } //end create product
    
    
    
    
    
 public function edit_course_submit($data){
    
              $sth = $this->db->prepare('UPDATE `courses` SET 
                                  `name` = :name,
                                  `privacy` =:privacy,
                                   `description` = :description
                                    WHERE `index` = :course_index
                                    ');
             $sth->execute(array(
                                ':name'=>$data['name'], 
                                ':privacy'=>$data['privacy'], 
                                ':description'=>$data['description'],
                                ':course_index'=>$data['course_index']
                             
                                ));
                               
                 echo "successfully edited ";        
                // echo json_encode($data);
         
   }
    
}
