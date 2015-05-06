<?php

class user extends controller  {

public function __construct() {
		parent::__construct();
                
                  $this->view->css = array('user/css/user.css');
		session::init();
                $logged = session::get('loggedin');
              
               /* if ($logged == false )
                    {
                
                    
                    session::destroy();
                    header('location: ../login');
                    exit;
                
                }*/
                $this->view->js = array('user/js/js.js');
}
                


     
                
 /*     //show all users
                
 public function all_users(){
          $this->view->all_users= $this->model->all_users();
          $this->view->render('user/all_users');
          
          
      }
  
  
     //loadmore all users
     public function all_users_load_more(){
         $lastUserIndex=$_GET['lastUserIndex'];
         $this->model->all_users_load_more($lastUserIndex);
     }
* */

public function user_courses($id){
    
    $this->model->user_courses($id);
    
}

     public function user_profile($id){
                    
                     $this->view->user_profile = $this->model->user_profile($id);
         
     }
     
   
     
     public function user_products_switch($members_index){
                       // $this->view->user_profile=$this->model->user_profile($members_index);
                        $this->view->user_products_switch = $this->model->user_products_switch($members_index);
			//$this->view->render('user/user_profile_products');
                     
         
     }
     
   /*                    
    public function load_more_products(){
       
        $last= array();
        
        
        $last['lastMeetingIndex'] = $_GET['lastMeetingIndex'];
        $last['meeting_creator'] = $_POST['meeting_creator'];
        
        //print_r($last);
       $this->model->load_more_products($last);
    }          
*/
     //switch groups
     public function user_groups_switch($members_index){
            // $this->view->user_profile=$this->model->user_profile($members_index);
             $this->view->user_groups_switch=$this->model->user_groups_switch($members_index);
			
            //   $this->view->render('user/user_profile_groups');
     }
                        
  /*                      
       public function load_more_groups(){
       
        $last= array();
        $last['lastGroupIndex'] = $_GET['lastGroupIndex'];
        $last['membersIndex'] = $_POST['membersIndex'];
        
        
        $this->model->load_more_groups($last);
    }     
    
  */  
   //panel for user friends 
     public function user_friends_switch($members_index){
         $this->view->user_friends_switch=$this->model->user_friends_switch($members_index);
         
	 //$this->view->user_profile=$this->model->user_profile($members_index);		
           
         
     }
     //load more friends
 /*    
 public function load_more_friends(){
       
        $last= array();
        $last['lastFriendIndex'] = $_GET['lastFriendIndex'];
        $last['myIndex'] = $_POST['myIndex'];
        
        
        $this->model->load_more_friends($last);
    }   
    
   //side change
  */  
   public function change_side(){
       
       $this->model->change_side($_GET['membersIndex']);
       
   }
   
   
   //get memories together
   
   public function memories_together($members_index){
       $this->model->memories_together($members_index);
       
   }
   
      
 //whether to add delete friend   
  public function user_add_delete_friend($my_index, $friend_index){
      
     $this->model->user_add_delete_friend($my_index, $friend_index);
      
  }  
  
}

?>
