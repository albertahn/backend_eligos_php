<?php

class group_control extends controller  {

public function __construct() {
		parent::__construct();
                
                $this->view->js = array('group_control/js/control.js');
               $this->view->css = array('group_control/css/control.css');
                session::init();
                $logged = session::get('loggedin');
              
                if ($logged == false )
                    {
                
                    
                    session::destroy();
                    header('location: ../login');
                    exit;
                    
                }
                
                
             }
             
             
                
                
public function group_control_panel($group_index){
     
    $this->view->group_control_panel=$this->model->group_control_panel($group_index);
    $this->view->render('group_control/group_control_panel');
     
         }
 
 public function edit_member_page($members_index, $group_index){
     
    $this->view->edit_member_page= $this->model->edit_member_page($members_index, $group_index);
    $this->view->render('group_control/edit_member'); 
        }
                
               
 public function edit_member_submit(){
     
     $data=array();
     
     $data['members_index']=$_POST['members_index'];
     $data['group_index']=$_POST['group_index'];
     $data['edit_status_select']=$_POST['edit_status_select'];
     $data['points_in_group']=$_POST['points_in_group'];
     
     
     $this->model->edit_member_submit($data);
    // print_r($data);
     
     
     
        }
        
        public function delete_member_group_page($members_index, $group_index){
            
         $this->view->delete_member_group_page= $this->model->delete_member_group_page($members_index, $group_index);
          $this->view->render('group_control/delete_member_group_page'); 
        }
        
        public function delete_member_group_submit($members_index, $group_index){
            
            $this->model->delete_member_group_submit($members_index, $group_index);
        }

}

