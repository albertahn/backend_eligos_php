<?php

    class mentorship extends controller  {

public function __construct() {
		parent::__construct();
                
                session::init();
               // $this->view->css = array('friend/css/friend.css');
             
             }
             
             
         //add mentors on profile page  
                public function add_mentor($my_id, $coach_id){
                    
                      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                     
                       $this->model->add_mentor($my_id, $coach_id);
                    
                }
   //delete mentor
                
                public function delete_mentor($my_id, $coach_id){
                    
                    $this->model->delete_mentor($my_id, $coach_id);
                    
                    
                }
                
  //for the left side numbers             
                public function show_mentorship($my_id, $coach_id){
                    
                     
                    $this->model->show_mentorship($my_id, $coach_id);
                    
                    
                }
                

 //get mentee sprofiles from within group using mentor ids and grou index
                
                
              public function  all_group_mentees(){
                  
                  //echo $_POST['mentor_index'];
                  
                  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
      
                     $mentor_index=mysqli_real_escape_string($dbc, trim($_POST['mentor_index']));
                    $group_index=mysqli_real_escape_string($dbc, trim($_POST['group_index']));
                   
                     $this->model->all_group_mentees($mentor_index, $group_index);
                  
              }
              
 //get all the mentors within the group I follow
              
              public function my_group_mentorship_status($groupID){
                  
                  $this->model->my_group_mentorship_status($groupID);
              }
              
              
  //add group mentors
              
      public function new_group_mentor(){
        
            $num= count($_POST['options']);
            
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
            $data = array();
            $data['group_index'] = mysqli_real_escape_string($dbc, trim($_POST['group_index']));
            $data['category'] = mysqli_real_escape_string($dbc, trim($_POST['category']));
            
            $checked = $_POST['options'];
                for($i=0; $i < count($checked); $i++){
                   $data['checked'.$i] = mysqli_real_escape_string($dbc, trim($checked[$i])); //echo "Selected " . $checked[$i] . "<br/>";
                }
                
                //print_r($data);
            
           $this->model->new_group_mentor($data, $num);
     
      }
      
//specific group mentorship
      
      
      public function specific_mentorship_goal(){
          
             $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
            $data = array();
            $data['student_index'] = session::get('index');
            $data['mentor_index'] = mysqli_real_escape_string($dbc, trim($_POST['mentor_index']));
          
            $this->model->specific_mentorship_goal($data);
          
            
      }
      
//add existing group goal to my mentorship
      
       public function add_exist_group_mentorship_goal(){
           
             $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
            $data = array();
            
            $data['mentor_index'] = mysqli_real_escape_string($dbc, trim($_POST['mentor_index'])); 
            $data['goal_index'] = mysqli_real_escape_string($dbc, trim($_POST['goal_index']));
           
            
            $this->model->add_exist_group_mentorship_goal($data);
          
           
       }
                 

}

