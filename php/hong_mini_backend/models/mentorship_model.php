<?php

class mentorship_model extends model 
{
    
    public function __construct()
    {
       session::init();
        parent::__construct();
    }
    
    
    
   
     
  //add Mentor
     public function add_mentor($my_id, $coach_id){
         
 //check if exist 
         
           $sth = $this->db->prepare('SELECT * FROM `mentorship` 
         WHERE `mentor_index` =:mentor_index AND `student_index`=:student_index ');
        $sth->execute(array(
            ':mentor_index'=> $coach_id,
            ':student_index'=>$my_id
        ));
        
        $count = $sth->rowCount();
        
        $data = $sth->fetch();
        if($count>0){
            echo json_encode($data);

            
        }else{ //not added before so newly add
        
                 $sth1 = $this->db->prepare('INSERT INTO `mentorship` (mentor_index, student_index, status)
                     VALUES (:mentor_index, :student_index, :status)');
                 $sth1->execute(array(
                         ':mentor_index'=>$coach_id,
                         ':student_index' => $my_id,
                         ':status' => 'accepted'

                 )); 
                 
              
                 
                 echo '{"success":"success"}';
        }
        
        
     } //end add mentor
     
     
//show all the user's mentorship relations and count
     
   public function show_mentorship($my_id, $coach_id){
       
         $sth = $this->db->prepare('SELECT * FROM `mentorship` 
         WHERE `mentor_index` =:mentor_index AND `student_index`=:student_index ');
        $sth->execute(array(
            ':mentor_index'=> $coach_id,
            ':student_index'=> $my_id
        ));
        
            
        $data = $sth->fetch();
        
       
          echo json_encode($data); 
       
   } //end show mentorship
     
     
     

      
     //DELETE mentor
     
      public function delete_mentor($my_id, $coach_id)
    {     
        $sth = $this->db->prepare('DELETE FROM `mentorship` WHERE student_index = :my_id AND mentor_index = :mentor_index');
        $sth -> execute(array(
            ':mentor_index'=>$coach_id,
            ':my_id'=>$my_id
        ));
        
         echo '{"success":"success"}';
        
    }
    
    //***************requests view page
    //
   //
    public function mentor_requests(){
        
         $sth = $this->db->prepare('SELECT * FROM `members` 
         WHERE `index` IN (SELECT `my_index` FROM `friends` 
         WHERE `friend_index`=:id AND `status`=:status)');
        $sth->execute(array(
            
            ':id'=>session::get('index'),
             ':status'=>pending   
            
        ));
        
        return $sth->fetchAll();
    }
    
    //group_mentor
    
    public function all_group_mentees($mentor_index, $group_index){
        
        $sth = $this->db->prepare('SELECT * FROM `members_view` 
         WHERE `index` IN (SELECT `student_index` FROM `mentorship` 
         WHERE `mentor_index`=:mentor_index AND `group_index`=:group_index)');
        $sth->execute(array(
            
            ':mentor_index'=>$mentor_index,
             ':group_index'=>$group_index
        ));
        
        echo json_encode($sth->fetchAll());
        
    } //end all group mentees
    
    
 //get all the  mentors I follow within the group
    
     public function my_group_mentorship_status($groupID){
                  
       
          $sth = $this->db->prepare('SELECT * FROM `mentorship` 
         WHERE `group_index`=:group_index AND `student_index`=:my_index');
        $sth->execute(array(
            
            ':group_index'=>$groupID,
             ':my_index'=>session::get('index')
            
        ));
        
        echo json_encode($sth->fetchAll());
        
       }
       
       public function new_group_mentor($data, $num){
           
           for($i=0; $i < $num; $i++){
           
            $sth1 = $this->db->prepare('INSERT INTO `mentorship` (mentor_index, category, status, group_index)
                     VALUES (:mentor_index, :category, :status, :group_index)');
                 $sth1->execute(array(
                         ':mentor_index'=>$data['checked'.$i],
                         ':category'=>$data['category'],
                         ':status' => 'accepted',
                        ':group_index' =>$data['group_index']

                 )); 
           }//end for
           
            header('location: '.URL.'major/inside_major/'.$data['group_index']);
       }
 //specific mentorship goal
       
       
       public function specific_mentorship_goal($data){
           
           //print_r($data);
           
          
           $sth = $this->db->prepare('SELECT * FROM `bp_examples_view` WHERE `members_index`=:student_index AND `course_index` IN 
               (SELECT `course_index` FROM `mentorship_has_course` WHERE `mentorship_index` IN 
               (SELECT `index` FROM `mentorship` WHERE `mentor_index`=:mentor_index  AND `student_index`=:student_index))');
       
           $sth ->execute(array(
                         ':mentor_index'=>$data['mentor_index'],
                        
                        ':student_index' =>$data['student_index']

                 ));  
           
           
            echo json_encode($sth->fetchAll());
           
       }
       
       public function add_exist_group_mentorship_goal($data){
           
               //set the var for me and get the mentor index first
               $my_index = session::get('index');
            

            //mentorship index
                 $sth = $this->db->prepare('SELECT `index` FROM `mentorship` WHERE `mentor_index`=:mentor_index  AND `student_index` = :student_index');

               $sth ->execute(array(
                             ':mentor_index'=>$data['mentor_index'],
                            ':student_index' =>$my_index

                     ));  
               //still array
               $mentorship_index = $sth ->fetch();
               
               
//check if the mentorship has course exists

               $sth_mentorship = $this->db->prepare('SELECT * FROM `mentorship_has_course` WHERE `mentorship_index`=:mentorship_index  AND `course_index` = :course_index');

               $sth_mentorship ->execute(array(
                             ':mentorship_index'=>$mentorship_index['index'],
                            ':course_index'=>$data['goal_index']

                     ));  
               $mentorship_has_goal = $sth_mentorship->rowCount();
               
               if($mentorship_has_goal<1){
             //insert into mentorship has course if not exists mentoship has course

                $sth1 = $this->db->prepare('INSERT INTO `mentorship_has_course` (course_index, mentorship_index)
                         VALUES (:course_index, :mentorship_index)');
                     $sth1 -> execute(array(
                         ':course_index'=>$data['goal_index'],    
                         ':mentorship_index'=>$mentorship_index['index']

                            )); 
                     
                      echo 'Successfully added';

               }else{ //$mentorship_has_goal exists
                   
                   echo 'You already added this goal';
                   
               }
                //check if both mentor and i have that goal

                //mentor has goal check     
               $sth2 = $this->db->prepare('SELECT * FROM `member_has_course` WHERE `members_index`=:members_index  AND `course_index` = :course_index');

               $sth2 ->execute(array(
                             ':members_index'=>$data['mentor_index'],
                            ':course_index'=>$data['goal_index']

                     ));  
               $mentor_has_goal = $sth2->rowCount();

               //if not exists insert
               if($mentor_has_goal<1){

                     $sth3 = $this->db->prepare('INSERT INTO `member_has_course` (course_index, members_index)
                         VALUES (:course_index, :members_index)');
                     $sth3 -> execute(array(
                         ':course_index'=>$data['goal_index'],    
                         ':members_index'=>$data['mentor_index']

                            )); 


               } //end if not exists insert


       //I has goal check     
               $sth4 = $this->db->prepare('SELECT * FROM `member_has_course` WHERE `members_index`=:members_index  AND `course_index` = :course_index');

               $sth4 ->execute(array(
                             ':members_index'=>$my_index,
                            ':course_index'=>$data['goal_index']

                     ));  
               $i_has_goal = $sth4->rowCount();

               //if not exists insert
               if($i_has_goal<1){

                     $sth5 = $this->db->prepare('INSERT INTO `member_has_course` (course_index, members_index)
                         VALUES (:course_index, :members_index)');
                     $sth5 -> execute(array(
                         ':course_index'=>$data['goal_index'],    
                         ':members_index'=>$my_index

                            )); 


               } //end if not exists insert







             //echo $mentorship_index['index'];
           
       } //end the whole add_exist_group_mentorship_goal
       
       
       
       
    
}
