<?php

class register extends controller  {

public function __construct() {
		parent::__construct();
                
             }
                
                
                
                //the action edit
                public function edit_profile(){
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    //echo json_encode($_FILES['file']);
                    
                    $data = array();
                    $data['username'] = mysqli_real_escape_string($dbc, trim($_POST['username']));
                    $data['email'] = mysqli_real_escape_string($dbc, trim($_POST['email']));
                     $data['members_index'] = mysqli_real_escape_string($dbc, trim($_POST['members_index']));
                    
                    $data['profile_picture'] = mysqli_real_escape_string($dbc, trim($_FILES['file']['name']));
                    $data['tmp_name']=  mysqli_real_escape_string($dbc, trim($_FILES['file']['tmp_name']));
                    $data['pic_size']= mysqli_real_escape_string($dbc, trim($_FILES['file']['size'])); 
                    
                    //error checking
                   if(!empty($data['username']) && !empty($data['email']) )
                        {
                       
                      // echo json_encode($_POST);
                       
                    $this->model->edit_profile($data);
                    
                          }else{
                              echo "please fill in all the data and make sure your password was written correctly.";
                          }
                    
                }


                public function reg()
                {
                  //  echo json_encode($_POST);
                    
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $data = array();
                    $data['name'] = mysqli_real_escape_string($dbc, trim($_POST['username']));
                    $data['email'] = mysqli_real_escape_string($dbc, trim($_POST['email']));
                    $data['password'] =  mysqli_real_escape_string($dbc, trim($_POST['password']));
                    $data['password2'] =  mysqli_real_escape_string($dbc, trim($_POST['password2']));
                    
                     
                    
                    //error checking
                    if(!empty($data['name']) && !empty($data['email'])&& !empty($data['password']))
                        {
                    
                        $this->model->reg($data);
                        
                        /*if($data['pic_size']<20000000){
                            
                             $this->model->reg($data);
                             
                        }else{
                            
                            echo'{"error":"too_large"}';
                        }*/
                        
                          }
                          
              
                }
                
               
                 

}

