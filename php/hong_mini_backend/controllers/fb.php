<?php

class fb extends controller  {

public function __construct() {
		parent::__construct();
                
             
                session::init();
                //$logged = session::get('loggedin');
              
             }
     
                
                
 function loginfacebook(){
      
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
      
    // echo json_encode($_POST); 
                   
     
                   $data=array();
                   
                   $data['username']=mysqli_real_escape_string($dbc, trim($_POST['username']));
                  $data['email']=mysqli_real_escape_string($dbc, trim($_POST['email']));
                   $data['FID']=mysqli_real_escape_string($dbc, trim($_POST['FID']));
                    $data['access_token']=mysqli_real_escape_string($dbc, trim($_POST['access_token']));
                   
             
               //echo $username;    
                   
                    if(!empty( $data['FID'])){
                        
                          $this->model->loginfacebook($data);
                    }//end
          
  
  }//end loginfb
                

}


?>