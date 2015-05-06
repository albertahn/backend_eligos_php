<?php

class email extends controller  {

function __construct() {
		parent::__construct();
                
		
		session::init();
                $logged = session::get('loggedin');
                if ($logged == false){
                    
                    session::destroy();
                    header('location: '.URL. 'login');
                    exit;
                }
               // $this->view->js = array('dashboard/js/default.js');
		
		}
                
                
public function send_confirm_mail($member_id) {
                        $this->model->send_confirm_mail($member_id);
		}
                
               
                
function recieve_confirm_mail() {
                        $contentVar= $_POST['contentVar'];
                        $group_index=$_POST['group_index'];
                        
                        $this->model->group_switch_content($contentVar,$group_index);    
    
                         }

}


?>