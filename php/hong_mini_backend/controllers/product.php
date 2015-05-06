<?php

class product extends controller  {

public function __construct() {
		parent::__construct();
                $this->view->css = array('product/css/product.css');
                $this->view->js = array('product/js/product.js');
             
                session::init();
                //$logged = session::get('loggedin');
              
             }
             
             
                
                
public function my_goals_list($id){
    
                  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $my_index = mysqli_real_escape_string($dbc, trim($id)); 
    
	            $this->model->my_goals_list($my_index);
			
		
		}
                
         //inside group
                
    public function inside_product($id){
         
                     $this->view->inside_product = $this->model->inside_product($id);
                  
         
                         }
                         
   public function product_modules($id){
       
       $this->model->product_modules($id);
   } 
   
  public function upload_admin($id){
     
        $this->model->upload_admin($id);
   }
            
   
   public function create_product(){
                   
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $data = array();
                    
                    //echo json_encode($_POST);
                    
                    $data['name'] = mysqli_real_escape_string($dbc, trim($_POST['course_title']));
                  //  $data['category'] =  mysqli_real_escape_string($dbc, trim($_POST['category']));

                    $data['privacy'] =  mysqli_real_escape_string($dbc, trim($_POST['privacy']));
                    
                    $data['description'] = mysqli_real_escape_string($dbc, trim($_POST['course_descrip']));
                    $data['user_index'] = mysqli_real_escape_string($dbc, trim($_POST['user_index']));
                    
                    //error checking
                    if(!empty($data['name'])){
                        
                 
                           $this->model->create_product($data);
                     }
                          
             
  }//end create
                    
            
                    
//edit product            
     public function  edit_course_submit(){
        
                     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $data = array();
                    
                    $data['course_index'] = mysqli_real_escape_string($dbc, $_POST['course_index']);
                    
                    $data['name'] = mysqli_real_escape_string($dbc, trim($_POST['course_title']));
                     $data['description'] =  mysqli_real_escape_string($dbc, trim($_POST['course_descrip']));
                      $data['privacy'] =  mysqli_real_escape_string($dbc, trim($_POST['privacy']));
                   // $data['category']=  mysqli_real_escape_string($dbc, trim($_POST['category']));
                    
                  
                     
                    //error checking
                    if(!empty($data['name']))
                        {
                        
                       // echo json_encode($data);
                         $this->model->edit_course_submit($data);
                       
                          }
             }// edit course
    
    
    //delete group warning
   public function delete_meeting_page($meeting_index){
       $this->view->delete_meeting_page = $this->model->delete_meeting_page($meeting_index);
       $this->view->group_has_meeting=$this->model->group_has_meeting($meeting_index);
       $this->view->render('product/delete_warning_page');
   }
    
    //really delete 
    
    //delete product
    
    public function delete_meeting_submit($id, $group_id)
                {
                     $this->model->delete_meeting_submit($id, $group_id);
                 //   header('location:'.URL.'user');
                }
               
               
                 

}

