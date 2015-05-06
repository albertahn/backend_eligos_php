<?php

    class message extends controller  {

public function __construct() {
		parent::__construct();
                
                session::init();
                
                $this->view->css = array('message/css/message.css');
             
                 $this->view->js = array('message/js/message.js');
             
             }
             
             public function test_gcm($message){
                 
                 
                 gcm_push_static::test_group_chat('23', $message);
                 
             }

             



             public function input_message(){
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
         $data= array();
        
       $data['input_val'] = mysqli_real_escape_string($dbc, trim($_POST['input_val']));
       $data['input_val']= stripslashes( $data['input_val']);
       $data['sending_to'] = mysqli_real_escape_string($dbc, trim($_POST['sending_to']));
       $data['my_id'] =mysqli_real_escape_string($dbc, trim($_POST['my_id']));
     
       if($data['sending_to']!=$data['my_id']){
       
          
           
       $this->model->input_message($data);
       
         gcm_push_static::message($data['my_id'], $data['sending_to'], $data['input_val']);
        
       }
      
     //echo json_encode($data);
       
   }
   
   
   public function show_this_message($my_id, $other_id){
       
      $this->model->show_this_message($my_id, $other_id);
     
       
   }//end show
   
   public function list_message_summary($userid){
       
       $this->model->list_message_summary($userid);
       
   }
   
   
      
         
                 

}

