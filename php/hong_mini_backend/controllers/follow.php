<?php

class follow extends controller  {

public function __construct() {
		parent::__construct();
                
                session::init();
               // $this->view->css = array('friend/css/friend.css');
             
              
              
             }
             
             
             
   public function show_user_followers($id){
       
       
     $this->model->show_user_followers($id);
     
     
       
       
   }
   
   
   public function people_im_following($id){
       
      $this->model->people_im_following($id);
     
    // $this->view->render('follow/people_im_following');  
       
       
   }
             
             
         
                 

}

