<?php

class error extends controller  {

function __construct() {
		parent::__construct();
		
		
		}
		function index() {
			$this->view->msg = 'This page doesnt exist';
			$this->view->render('error/index');
		
		}
                
                 function email_exists(){
                    
                     $this->view->msg = 'This email already exists. Please use another email to register.';
                     $this->view->render('error/index');
                     
                    //echo '<a href="../">click to go back</a>';
                }
                
                 function role_request_again(){
                    
                    $this->view->msg = 'You requested this role before.';
                     $this->view->render('error/index');
                }
                
               function role_request_empty(){
                    
                    $this->view->msg = 'You have not requested this role before.';
                     $this->view->render('error/index');
                }
                
                //havent selected group when making meeting
               function select_group(){
                    $this->view->msg = 'You have not selected a group. please go back and select a group when making a meeting.';
                     $this->view->render('error/index');
                    
                }
                
                function blanks_meeting(){
                    
                    $this->view->msg = 'please fill in all the data and make sure your password was written correctly.';
                $this->view->render('error/index');
                    }
               function blanks(){
                    
                    $this->view->msg = 'please fill in all the data.';
                $this->view->render('error/index');
                    }
                 
                function valid_image(){
                        
                         $this->view->msg = 'please upload a valid image file.';
                $this->view->render('error/index');
                    }
                    
             function wrong_password(){
                        
                         $this->view->msg = 'You have entered the wrong password.';
                $this->view->render('error/index');
                    }
                    
                 function click_facebook(){
                        
                         $this->view->msg = 'You have logged in with facebook before so please click the fb login button.';
                $this->view->render('error/index');
                    }
                    
                  function not_admin(){
                      $this->view->msg = 'You are not the administrator of the group.';
                $this->view->render('error/index');
                      
                  }
                  function no_codes_left(){
                      $this->view->msg = 'Sorry...There are no codes left to send today..Why not try again tomorrow?';
                $this->view->render('error/index');
                      
                  }

}


