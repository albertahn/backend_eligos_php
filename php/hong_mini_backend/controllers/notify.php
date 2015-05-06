<?php

class notify extends controller  {

function __construct() {
		parent::__construct();
                
		
		}
                
               
public function friend_requests() {
                        
                        
                        $this->model->friend_requests();
    
                         }
                         
  public function check_my_wall_posts(){
      
      $this->model->check_my_wall_posts();
  } 
  
  public function check_friends_wall_posts(){
         
         $this->model->check_friends_wall_posts();
         
     }
     
   public function notify_comment_toggle($user_index){
       
       $this->model->notify_comment_toggle($user_index);
       
   }//   
   
   
    public function check_mobile_notify($user_index){
        
         $this->model->check_mobile_notify($user_index);
         
     }//

}
