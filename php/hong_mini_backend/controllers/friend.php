<?php

class friend extends controller  {

public function __construct() {
		parent::__construct();
                
             
              
             }//
             
             
   public function test($my_index){
        
        $this->model->get_user_score($my_index);
        
    }//add friend battle*/
    
             
   function check_if_battle_sent($my_index, $friend_index){
       
       $this->model->check_if_battle_sent($my_index, $friend_index);
   }         
    

        public function get_battle_list($my_index){
                  
         
                   $this->model->get_battle_list($my_index);
             
                }//end get battle list
                
       public function get_battle_request_list($my_index){
           
           $this->model->get_battle_request_list($my_index);
           
       }        
       
                
                //battle a current friend
                
                public function battle_friend($my_index, $friend_index){
                    
                     $this->model->check_if_friend($my_index, $friend_index);
                    
                }//
               
                
         //friend profile
                
                public function friend_profile($id){
         //fetch individual group
                     
                     $this->view->friend_profile = $this->model->friend_profile($id);
                     $this->view->friend_products= $this->model->friend_products($id);
                     $this->view->friend_groups= $this->model->friend_groups($id);
                     $this->view->render('friend/friend_profile');
         
                    }//
                
     
     
     //see 1 row friend battle score
     
     public function see_battle_score($my_index, $friend_index){
         
         $this->model->see_battle_score($my_index, $friend_index);
         
     }//
     
     public function new_see_battle_score($my_index, $friend_index){
         
         
         $this->model->new_see_battle_score($my_index, $friend_index);
         
         
     }//
     
     
     //accept friend
     public function accept_battle($my_index, $friend_index){
         
           $this->model->accept_battle($my_index, $friend_index);
     }//
     
     //reject friend
      
    public function delete_battle_friend($my_index, $friend_index){
        
        // $this->model->reject_friend($id);
         $this->model->delete_battle_friend($my_index, $friend_index);
    }
     
    
      
      
     //DELETE friend not yet..
     
    /*  public function delete_friend($id)
                {
                     $this->model->delete_friend($id);
                 //   header('location:'.URL.'user');
                    
                }*/
               
             
                
                 

}

