<?php

class group extends controller  {

public function __construct() {
		parent::__construct();
                $this->view->js = array('group/js/group.js');
               $this->view->css = array('group/css/group.css');
               
                session::init();
                $logged = session::get('loggedin');
              
                
                
                
             }
             
             
                
                
public function index() {
                            //my group list
			$this->view->my_group_list = $this->model->my_group_list();
                        //all groups
                        $this->view->group_list= $this->model->group_list();
			$this->view->render('group/index');
		
                        }
                        
           //group list load more
  public function group_list_load_more(){
      
               $last_group_index= $_GET['lastGroupIndex'];
              
               $this->model->group_list_load_more($last_group_index);
           }


           


 //inside group
                
                public function inside_group($id){
         //fetch individual group
                     $this->view->group_social = $this->model->group_social($id);
                     $this->view->has_group = $this->model->has_group($id);
                     $this->view->group_info = $this->model->group_info($id);
            //meeting list         
                     $this->view->meeting_list = $this->model->meeting_list($id);
                     //$this->view->all_members_of_group= $this->model->all_members_of_group($id);
                     $this->view->all_admins_of_group= $this->model->all_admins_of_group($id);
                     $this->view->render('group/inside_group');
        
     }
     
     
     //join group bunch
     //join open group
     
     public function join_group_open($group_index){
         $this->model->join_group_open($group_index);
         
     }
     
     //password needed group
      public function join_group_password($group_index){
          
          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
          
          $data = array();
          $data['password'] = mysqli_real_escape_string($dbc, trim($_POST['password']));
          $data['group_index'] = $group_index;
         $this->model->join_group_password($data);
         
     }

     //permission based group
     public function join_group_permission($group_index){
         $this->model->join_group_permission($group_index);
         
     }
     
     //page to view group join requests
     public function group_join_requests_page($id){
          
         $this->view->group_join_requests_page=$this-> model->group_join_requests_page($id);
         $this->view->render('group/group_join_requests_page');
     }
    
    // accept group member for permission based groups
    public function accept_join_group($group_index, $members_index){
        $data= array();
        
        $data['group_index']=$group_index;
        $data['members_index']=$members_index;
        
        $this->model->accept_join_group($data);
        
        
    }
    //reject and delete the guy from joining the group
    public function reject_join_group($group_index, $members_index){
        $data= array();
        
        $data['group_index']=$group_index;
        $data['members_index']=$members_index;
        
        $this->model->reject_join_group($data);
        
        
    }
    

    //crud
     
     //DELETE GROUP
    //delete group warning
   public function delete_group_warning($group_index){
       $this->view->delete_group_warning = $this->model->delete_group_warning($group_index);
       $this->view->render('group/delete_warning_page');
   }
    
    //really delete 
      public function delete_group($id)
                {
                     $this->model->delete_group($id);
                 //   header('location:'.URL.'user');
                    
                }
               


// edit group page render
                
                public function edit_group_page($id){
                    
                    $this->view->get_facebook_groups=$this->model->get_facebook_groups();
                    $this->view->edit_group_page = $this->model->edit_group_page($id);
                    
                    $this->view->render('group/edit_group_page');
                    
                    
              
                    
                }
                
                
                
                
     
     //edit group and save
     
     public function edit_group(){
         
                     
          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $data = array();
                    
                    $data['id'] = mysqli_real_escape_string($dbc, trim($_POST['index']));
                    $data['name'] = mysqli_real_escape_string($dbc, trim($_POST['name']));
                  //faceboo group  
                    $data['facebook_group'] = mysqli_real_escape_string($dbc, trim($_POST['facebook_group']));
                    $data['location'] = mysqli_real_escape_string($dbc, trim($_POST['location']));
                    $data['groupType'] = mysqli_real_escape_string($dbc, trim($_POST['groupType']));
                    $data['password'] =  mysqli_real_escape_string($dbc, trim($_POST['password']));
                    $data['password2'] =  mysqli_real_escape_string($dbc, trim($_POST['password2']));
                    $data['profile'] =  mysqli_real_escape_string($dbc, trim($_POST['profile']));
                    $data['group_picture'] = mysqli_real_escape_string($dbc, trim($_FILES['group_picture']['tmp_name']));
                    $data['pic_type'] = mysqli_real_escape_string($dbc, trim($_FILES['group_picture']['type']));
                    $data['pic_size']= mysqli_real_escape_string($dbc, trim($_FILES['group_picture']['size'])); 
                    
                    
                     //error checking
                    if(!empty($data['name'])&& !empty($data['location']) && $data['password']==$data['password2'])
                        {
                    
                       // echo $_POST[index];
                    $this->model->edit_group($data);
                    
                          }
                          else{
                              $this->error->blanks_meeting;
                              //echo "please fill in all the data and make sure your password was written correctly.";
                          }
     }


     //create group           
      public function create_group_page()
      {
          $this->view->get_facebook_groups=$this->model->get_facebook_groups();
          $this->view->render('group/create_group');
      }
                
                public function create_group()
                {
                    
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $data = array();
                    $data['name'] = mysqli_real_escape_string($dbc, trim($_POST['name']));
                    //facebook group
                    $data['facebook_group'] = mysqli_real_escape_string($dbc, trim($_POST['facebook_group']));
                    $data['location'] = mysqli_real_escape_string($dbc, trim($_POST['location']));
                    $data['groupType'] = mysqli_real_escape_string($dbc, trim($_POST['groupType']));
                    $data['password'] =  mysqli_real_escape_string($dbc, trim($_POST['password']));
                    $data['password2'] =  mysqli_real_escape_string($dbc, trim($_POST['password2']));
                    $data['profile'] =  mysqli_real_escape_string($dbc, trim($_POST['profile']));
                    $data['group_picture'] = mysqli_real_escape_string($dbc, trim($_FILES['group_picture']['tmp_name']));
                    $data['pic_type'] = mysqli_real_escape_string($dbc, trim($_FILES['group_picture']['type']));
                    $data['pic_size']= mysqli_real_escape_string($dbc, trim($_FILES['group_picture']['size'])); 
                    
                    
                    
                     
                     
                    //error checking
                    if(!empty($data['name'])&& !empty($data['location']) && $data['password']==$data['password2'])
                        {
                    
                         
                    $this->model->create_group($data);
                    
                          }
                          else{
                              
                               header('location: '.URL.'error/blanks');
                             // echo "please fill in all the data and make sure your password was written correctly.";
                          }
              //   header('location:'.URL.'register');
              
                    }
                   
                
// facebook_group_comment               
                 function facebook_group_comment(){
                     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                     
                     $data = array();
                     $data['status'] = mysqli_real_escape_string($dbc, trim($_POST['status']));
                     $data['fb_group_id'] = mysqli_real_escape_string($dbc, trim($_POST['fb_group_id']));
                     //print_r($data);
                  $this->model->facebook_group_comment($data);
                 }

}

