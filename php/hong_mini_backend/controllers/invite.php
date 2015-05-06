<?php

class invite extends controller  {

function __construct() {
		parent::__construct();
                
                $this->view->js = array('invite/js/invite.js');
		
		}
                
                function index(){
                    $this->view->codes_left=$this->model->codes_left();
                    $this->view->render('invite/index');
                    
                }
                
                
function request_invite() {
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                   
                    
                    $to= mysqli_real_escape_string($dbc, trim($_POST['mail']));
                    
                    $subject="Your invite code from meetingmeeting";
                    
                    $message="Welcome to meetingmeeting~!!\nYour code to join for this month is 'daramji'.\n
            
                        Go to the site and register now~!\n
                        http://apps.facebook.com/meetingmeeting \n
                        or\n
                        http://meetingmeeting.com
                        
                        
                         
                      We hope you have a great time using our products.\r\n
                          Sincerely\n
                            -Albert An-
                      
                  


                        ";
                    $this->model-> request_invite($to, $subject, $message);
			
		
		}
                
   function time_left(){
       $this->model->time_left();
       
   }  
   
    function verify_code(){
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                   
                    
       $input_code= mysqli_real_escape_string($dbc, trim($_POST['code']));
       $this->model->verify_code($input_code);
       
   }
   
   function register(){
       
       $this->view->render('invite/register');
   }
  
   function login_content(){
        $this->model->login_content();
       
   }
   function invitation_sent(){
       
       $this->view->render('invite/invitation_sent');
   }
                
         
}


?>