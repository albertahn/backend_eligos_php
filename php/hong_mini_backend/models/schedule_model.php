<?php

class schedule_model extends model {

function __construct() {
    parent::__construct();
}


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
        
        
  //  print_r($data);   
        
    }
    
    header('location:'.URL.'user/user_profile/'.session::get('index'));
    
    
}

function takeout_blueprint($course_index){
    
    
      $sth = $this->db->prepare('UPDATE `member_has_course` 
                                  SET 
                                  `blueprint_insert` =:blueprint_insert
                                    WHERE `members_index`= :id AND `course_index`=:course_index
                                    ');
                                 $sth->execute(array(
            
                                
                                ':blueprint_insert'=>0,
                                ':id'=>session::get('index'),
                                ':course_index'=>$course_index
                             
                                ));
 
  header('location:'.URL);
    
}

function add_semester_year($data){
    
    //check if the member has course
      $sth = $this->db->prepare('SELECT * FROM `has_semester` WHERE `members_index`= :id AND `table`=:table AND `season`=:season' );
        $sth->execute(array(
              ':id'=> session::get('index'),
              ':table'=> $data['table'],
              ':season'=>$data['season']
            ));
  $count = $sth->rowCount();
  
  
     if($count>0){
        //just update the season, insert and year
        
        $sth = $this->db->prepare('UPDATE `has_semester` 
                                  SET 
                                 `year` = :year
                                    WHERE `members_index`= :id AND `table`=:table AND `season`=:season');
                                 $sth->execute(array(
                                     
                                ':year'=>$data['year'],
                                ':id'=>session::get('index'),
                                ':table'=>$data['table'],
                                ':season'=>$data['season'], 
                               
                                ));
        
    
    }else{
        
         $sth = $this->db->prepare('INSERT INTO `has_semester` (`members_index`, `table`, `year`, `season`) 
                                                  VALUES (:members_index, :table, :year, :season)');
        
         $sth->execute(array( 
            ':members_index'=>session::get('index'),
            ':table'=>$data['table'],
            ':season'=>$data['season'],
             ':year'=>$data['year']
            ));
        
    }
     
 }
 
 function add_my_course($data){
     
      $sth = $this->db->prepare('INSERT INTO `member_has_course` (`members_index`, `course_index`) 
                                                  VALUES (:members_index, :course_index)');
        
         $sth->execute(array( 
            ':members_index'=>session::get('index'),
            ':course_index'=>$data['course']
            
            ));
         
        // header('location:'.URL.'product/inside_product/'.$data['course']);
 }
 
 function delete_my_course($data){
     
     $sth = $this->db->prepare('DELETE FROM `member_has_course` WHERE `members_index`=:members_index AND `course_index`=:course_index');
        
         $sth->execute(array( 
            ':members_index'=>session::get('index'),
            ':course_index'=>$data['course']
            
            ));
         
        // header('location:'.URL.'product/inside_product/'.$data['course']);
     
 }
 
 
 //when loggin for the first time make the data work
 
 function submit_first_year($data){
     
     
     
     
     if($data['season']=='fall'){
     
             for($table=0;$table<4;$table++ ){

               $year=$data['year']+1+$table;

               
               //isert the data
               //fall
                    $sth = $this->db->prepare('INSERT INTO `has_semester` (`members_index`, `table`, `year`, `season`) 
                                                  VALUES (:members_index, :table, :year, :season)');
        
                     $sth->execute(array( 
                        ':members_index'=>session::get('index'),
                        ':table'=>'table'.$table,
                         ':year'=>$year-1,
                         ':season'=>'fall'

                        ));
                    //spring 
                     $sth1 = $this->db->prepare('INSERT INTO `has_semester` (`members_index`, `table`, `year`, `season`) 
                                                  VALUES (:members_index, :table, :year, :season)');
        
                     $sth1->execute(array( 
                        ':members_index'=>session::get('index'),
                        ':table'=>'table'.$table,
                         ':year'=>$year,
                         ':season'=>'spring'

                        ));
                     //summer
                     $sth2 = $this->db->prepare('INSERT INTO `has_semester` (`members_index`, `table`, `year`, `season`) 
                                                  VALUES (:members_index, :table, :year, :season)');
        
                     $sth2->execute(array( 
                        ':members_index'=>session::get('index'),
                        ':table'=>'table'.$table,
                         ':year'=>$year,
                         ':season'=>'summer'

                        ));

 
             }//end for
             
             //send to  header('location:'.URL.'facebook/invite');
             
              header('location:'.URL.'facebook/invite');
             // header('location:'.URL.'major');
             
     }else{ //spring admit
         
         
          for($table=0;$table<4;$table++ ){

               $year=$data['year']+$table;
               
               
               
               
                //fall
                    $sth = $this->db->prepare('INSERT INTO `has_semester` (`members_index`, `table`, `year`, `season`) 
                                                  VALUES (:members_index, :table, :year, :season)');
        
                     $sth->execute(array( 
                        ':members_index'=>session::get('index'),
                        ':table'=>'table'.$table,
                         ':year'=>$year-1,
                         ':season'=>'fall'

                        ));
                    //spring 
                     $sth1 = $this->db->prepare('INSERT INTO `has_semester` (`members_index`, `table`, `year`, `season`) 
                                                  VALUES (:members_index, :table, :year, :season)');
        
                     $sth1->execute(array( 
                        ':members_index'=>session::get('index'),
                        ':table'=>'table'.$table,
                         ':year'=>$year,
                         ':season'=>'spring'

                        ));
                     //summer
                     $sth2 = $this->db->prepare('INSERT INTO `has_semester` (`members_index`, `table`, `year`, `season`) 
                                                  VALUES (:members_index, :table, :year, :season)');
        
                     $sth2->execute(array( 
                        ':members_index'=>session::get('index'),
                        ':table'=>'table'.$table,
                         ':year'=>$year,
                         ':season'=>'summer'

                        ));

             }//end for
             
             //send to  header('location:'.URL.'facebook/invite');
             
              header('location:'.URL.'facebook/invite');
             // header('location:'.URL.'major');
         
          } //end else spring
     
    
     
 }
          
      
        

}
