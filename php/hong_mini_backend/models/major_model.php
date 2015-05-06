<?php

class major_model extends model {

function __construct() {
    parent::__construct();
}


//all majors

function all_majors(){
    
      
      $sth = $this->db->prepare('SELECT * FROM `major`');
        $sth->execute();
       return $sth->fetchAll();
        
       
        }
        
 function reg_my_major($data){
      
      foreach($data as $key=>$value){
          //print_r($value);
          
                       $sth1 = $this->db->prepare('SELECT * FROM `member_has_major` WHERE `members_index` = :members_index AND `major_index` = :major_index');
                    $sth1->execute(array(
                        ':members_index'=>session::get('index'),
                        ':major_index'=>$value

                    ));

                     $count = $sth1->rowCount();
                    if($count==0){

                      $sth = $this->db->prepare('INSERT INTO `member_has_major` (members_index, major_index)
                                                                VALUES (:members_index, :major_index)');
                    $sth->execute(array(
                        ':members_index'=>session::get('index'),
                        ':major_index'=>$value

                    ));                         
        

                }


              }

      // set as not first time
         $sth = $this->db->prepare('UPDATE members 
                SET first_time = :first_time
                WHERE `index` = :id
             ');
          
          $sth->execute(array(
            ':id' => session::get('index'),
              
            ':first_time' => 0
            ));
          
          session::set('first_time', 0);
      
       header('location: '.URL);  
        
 }
 
 
 function remove_my_major($data){
     
        foreach($data as $key=>$value){
          $sth = $this->db->prepare('DELETE FROM `member_has_major` WHERE `members_index`= :members_index AND `major_index`= :major_index ');
        $sth->execute(array(
            ':members_index'=>session::get('index'),
            ':major_index'=>$value
            
        ));
        
      }
        header('location: '.URL); 
 }
 
 
//whats inside major 
 function inside_major($id){
      
      
       $sth1 = $this->db->prepare('SELECT * FROM `major` WHERE `index` = :major_index');
                    $sth1->execute(array(
                        ':major_index'=>$id
                    ));
                    
          return $sth1->fetch();          
      
  }
  
  function create_major_submit($data){
      
        $sth = $this->db->prepare('INSERT INTO `major` (name, description, department_code)
                                                                VALUES (:name, :description, :department_code)');
                    $sth->execute(array(
                        ':name'=>$data['name'],
                        ':description'=>$data['major_description'],
                        ':department_code'=> $data['department_code']

                    )); 
                    
                    
      $major_index = $this->db->lastInsertId();
      
      //member has major as admin
      
        $sth = $this->db->prepare('INSERT INTO `member_has_major` (members_index, major_index, status)
                                                                VALUES (:members_index, :major_index, :status)');
                    $sth->execute(array(
                        ':members_index'=>session::get('index'),
                        ':major_index'=>$major_index,
                        ':status'=> 'admin'
                    )); 
      
      
      if($data['auto_switch']=='yes' && !empty($data['department_code'])){
              
              header('location: '.URL.'auto/major_has_course/'.$major_index);
      
       }else{
           header('location: '.URL.'major_inside_major/'.$major_index);
           
       }

   }
  //all the courses of the major 
   function major_courses($id){
       
        $sth1 = $this->db->prepare('SELECT * FROM `courses` WHERE `index` IN (SELECT `courses_index` FROM `major_has_courses` WHERE `major_index`=:major_index )');
                    $sth1->execute(array(
                        ':major_index'=>$id
                    ));
            return $sth1->fetchAll();
       
       
   }
   
   function requirements($id) {
       
        $sth1 = $this->db->prepare('SELECT * FROM `major_requirements_view` WHERE `major_index` =:major_index ');
                    $sth1->execute(array(
                        ':major_index'=>$id
                    ));
            return $sth1->fetchAll();
       
   }
   
   function view_member_has_major($id){
       
        $sth = $this->db->prepare('SELECT * FROM `members_view` WHERE `index` IN (SELECT `members_index` FROM `member_has_major` WHERE `major_index`= :id)');
        $sth->execute(array(
            ':id'=> $id
            ));
   return $sth->fetchAll();
       
   }
   
   function my_blueprint(){
       
        $sth = $this->db->prepare('SELECT * FROM `bp_examples_view` WHERE `members_index`=:my_index AND blueprint_insert=:blueprint_insert');
        $sth->execute(array(
            ':my_index'=> session::get('index'),
            ':blueprint_insert'=>1
            ));
   return $sth->fetchAll();
       
   }
   
   //insert into blueprint ajax
   
   function input_blueprint($data) {
   
    
    //check if the member has course
      $sth = $this->db->prepare('SELECT * FROM `member_has_course` WHERE `members_index`= :id AND `course_index`=:course_index');
        $sth->execute(array(
              ':id'=> session::get('index'),
              ':course_index'=>$data['class_index']
            ));
  $count = $sth->rowCount();
  
      
    if($count>0){
        //just update the season, insert and year
        //echo'has course';
        //print_r($data);
        
        $sth1 = $this->db->prepare('UPDATE `member_has_course` 
                                  SET 
                                  `season` = :season,
                                  `year` = :year,
                                   `blueprint_insert` =:blueprint_insert
                                    WHERE `members_index`= :id AND `course_index`=:course_index
                                    ');
                                 $sth1->execute(array(
            
                                ':season'=>$data['season'], 
                                ':year'=>$data['year'],
                                ':blueprint_insert'=>1,
                                ':id'=>session::get('index'),
                                ':course_index'=>$data['class_index']
                             
                                ));
                                 
          //return all the data                       
           
                                 $sth3 = $this->db->prepare('SELECT * FROM `bp_examples_view` WHERE `members_index`= :id AND `course_index`=:course_index');
                                $sth3->execute(array(
                                      ':id'=> session::get('index'),
                                      ':course_index'=>$data['class_index']
                                    ));
                                
                                echo json_encode($sth3->fetch());  
   
                                


//put it in the blueprint
    
    }else{// else//member_has_meeting as admin insert
        
        //echo'no data';
         $sth2 = $this->db->prepare('INSERT INTO `member_has_course` (`members_index`, `course_index`, `season`, `year`, `blueprint_insert`) 
                                                  VALUES (:members_index, :course_index, :season, :year, :blueprint_insert)');
        
         $sth2->execute(array( 
            ':members_index'=>session::get('index'),
            ':course_index'=>$data['class_index'],
            ':season'=>$data['season'],
             ':year'=>$data['year'],
             ':blueprint_insert'=>1
            ));
        
      //retrieve allt the data  
                             $sth4 = $this->db->prepare('SELECT * FROM `bp_examples_view` WHERE `members_index`= :id AND `course_index`=:course_index');
                                $sth4->execute(array(
                                      ':id'=> session::get('index'),
                                      ':course_index'=>$data['class_index']
                                    ));
                                
                                echo json_encode($sth4->fetch());  
  //  print_r($data);   
                                
                                
         //put it in the blueprint
                                
                                
        
    }
    
  
    
    
}
   
}