<?php

class major extends controller  {

function __construct() {
		parent::__construct();
                
                $this->view->css = array('major/css/major.css');
                
		session::init();
                /*$logged = session::get('loggedin');
                
                if ($logged == false){
                    
                    session::destroy();
                    header('location: '.URL. 'login');
                    exit;
                    
                }*/
                
                $this->view->js = array('major/js/major.js');
		
		}
function index() {
    
                      $this->view->all_majors=$this->model->all_majors(); 
                              
                              $this->view->render('major/index',$noinclude= true);
			
		}
  function reg_my_major(){
      
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $data = array();
                    
                  
                    
                    foreach ($_POST as $key => $value) {
                        
                        $data['select'.$value]=mysqli_real_escape_string($dbc, trim($value));
                    }
                    
                    /*
                    $count= count($_POST)+1;
                    
                    for($i=1;$i<=$count;$i++){
                        $data['select'.$i]=mysqli_real_escape_string($dbc, trim($_POST['major'.$i]));
                        
                        echo $_POST['major'.$i];
                    }
                    
            echo "count:".$count;  */     
       //  print_r($data);
        $this->model->reg_my_major($data);
        
  }              
     
  function remove_my_major(){
       $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $data = array();
                   
                    foreach ($_POST as $key => $value) {
                      $data[$key]=  mysqli_real_escape_string($dbc, trim($value));  
                    }
                    
                   
                    
                    $this->model->remove_my_major($data);
                  
      
  }
  
  
  function create_major_page(){
      $this->view->render('major/create_major_page');
      
  }
  
  function create_major_submit(){
      
      
       $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $data = array();
                   $data['name']=mysqli_real_escape_string($dbc, trim($_POST['name']));
                   $data['major_description']=mysqli_real_escape_string($dbc, trim($_POST['major_description']));
                   $data['auto_switch']=mysqli_real_escape_string($dbc, trim($_POST['auto_switch']));
                   $data['department_code']=mysqli_real_escape_string($dbc, trim($_POST['department_code']));
                   $data['department_code2']=mysqli_real_escape_string($dbc, trim($_POST['department_code2']));
                   
                   if(!empty($data['name'])){
                   $this->model->create_major_submit($data);
                   }else{
                        header('location: '.URL.'error/blanks');
                   }
  }
  
  function inside_major($id){
      //$this->view->member_has_courses=$this->model->member_has_courses();
      
      $this->view->my_blueprint=$this->model->my_blueprint();
      $this->view->inside_major=$this->model->inside_major($id);
      $this->view->major_courses=$this->model->major_courses($id);
      $this->view->requirements=$this->model->requirements($id);
      
      $this->view->view_member_has_major=$this->model->view_member_has_major($id);
      $this->view->render('major/inside_major');
      
      
  }
  
  function input_blueprint() {
    
      
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    $data = array();
                    
                     $data['season'] = mysqli_real_escape_string($dbc, trim($_POST['season']));
                      $data['year'] = mysqli_real_escape_string($dbc, trim($_POST['year']));    
                    $data['class_index']=mysqli_real_escape_string($dbc, trim($_POST['class_index']));
                   
                    /**echo'<pre>';
                       
                      print_r($_POST);
                        echo'</pre>';
                       **/ 
                        
                            
                           
                        
                        $this->model->input_blueprint($data);
		
		}
               
                


}


?>