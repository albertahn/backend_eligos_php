<?php

class schedule extends controller  {

function __construct() {
		parent::__construct();
                
		session::init();
                $logged = session::get('loggedin');
                if ($logged == false){
                    
                    session::destroy();
                    header('location: '.URL. 'login');
                    exit;
                    
                }
               // $this->view->js = array('dashboard/js/default.js');
		
		}
//in basket               
function input_blueprint() {
    
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    $data = array();
                    $data['count_checked'] = mysqli_real_escape_string($dbc, trim($_POST['count_checked']));
                     $data['season'] = mysqli_real_escape_string($dbc, trim($_POST['season']));
                      $data['year'] = mysqli_real_escape_string($dbc, trim($_POST['year']));    
                    /*
                    
                    echo'<pre>';
                       
                      print_r($_POST);
                        echo'</pre>';
                        */
                      
                        for($i=0; $i<$data['count_checked']; $i++){
                            $data['class_index']=mysqli_real_escape_string($dbc, trim($_POST['class_input'.$i]));
                         if(!empty($data['class_index'])){ 
                            
                            $this->model->input_blueprint($data);
                         }else{
                             
                             header('location: '.URL. 'product/create_product_page');
                             
                         }
                        }
                     //   $this->model->input_blueprint($data);
		
		}
//out of basket                
 function takeout_blueprint($course_index){
    
                       
                        $this->model->takeout_blueprint($course_index);
			
		
		}
                
                
 function add_semester_year($table,$year, $season){
     //echo  $table;
     
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $data = array();
      $data['table'] = mysqli_real_escape_string($dbc, trim($table));  
      $data['year'] = mysqli_real_escape_string($dbc, trim($year));  
      $data['season'] = mysqli_real_escape_string($dbc, trim($season)); 
      
     $this->model->add_semester_year($data);
 }
 
 function add_my_course($course_id){
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $data = array();
        
        $data['course'] = mysqli_real_escape_string($dbc, trim($course_id)); 
    
        $this->model->add_my_course($data);
 }
 
 function delete_my_course($course_id){
     
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $data = array();
        
        $data['course'] = mysqli_real_escape_string($dbc, trim($course_id)); 
    
        $this->model->delete_my_course($data);
 }
 
 function first_year_page(){
     //check if the member has course
      $sth0 = $this->db->prepare('SELECT * FROM `has_semester` WHERE `members_index`= :id ' );
        $sth0->execute(array(
              ':id'=> session::get('index')
            ));
  $count = $sth0->rowCount();
  
  
     if($count>0){  //they scheduled before
         
         header('location:'.URL.'facebook/invite');
         
     }else{
     $this->view->render('schedule/first_year_page');
     }
 }
 
 function submit_first_year(){
     
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $data = array();
        
        
        $data['year'] = mysqli_real_escape_string($dbc, trim($_POST['year'])); 
    
        $data['season']= mysqli_real_escape_string($dbc, trim($_POST['season'])); 
        $this->model->submit_first_year($data);
     
 }
                
}


?>