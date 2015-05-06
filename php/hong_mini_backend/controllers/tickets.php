<?php

class tickets extends controller  {

function __construct() {
		parent::__construct();
                 $this->view->js = array('tickets/js/tickets.js');
                $this->view->css = array('tickets/css/tickets.css');
                
		session::init();
                $logged = session::get('loggedin');
                if ($logged == false){
                    
                    session::destroy();
                    header('location: '.URL. 'login');
                    exit;
                    
                }
               // $this->view->js = array('dashboard/js/default.js');
		
		}
function make_tickets_page($id) {
                     $this->view->meeting_info=$this->model->meeting_info($id);
                     $this->view->current_tickets=$this->model->current_tickets($id);
                       $this->view->render('tickets/index',true);
		       
		      
		}
                
 function make_tickets_submit(){
     
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
     //new array for roles
     
                  
                   $tickets_array=array();
                   $tickets_array['num_tickets']=mysqli_real_escape_string($dbc, trim($_POST['number_of_tickets_box']));
                   $tickets_array['meeting_index']=mysqli_real_escape_string($dbc, trim($_POST['meeting_index']));
                   for ($i =1; $i <= $tickets_array['num_tickets']; $i++){
                       
                        
                        $tickets_array[$i]['code'] = mysqli_real_escape_string($dbc, trim($_POST[$i]));
                       
                   }
                   
                  $this->model-> make_tickets_submit($tickets_array);
 }
 
 //give tickets
 function give_ticket_page($ticket_id,$meeting_id){
     
     $this->view->group_members=$this->model->group_members($meeting_id);
             
     $this->view->edit_ticket_page=$this->model->edit_ticket_page($ticket_id);
     $this->view->render('tickets/give_ticket_page',true);
 }
 
 //
 function edit_ticket_page($ticket_id,$meeting_id){
     
     $this->view->group_members=$this->model->group_members($meeting_id);
             
     $this->view->edit_ticket_page=$this->model->edit_ticket_page($ticket_id);
     $this->view->render('tickets/edit_ticket_page',true);
 }
 
 
 //give tickets submit
 
 function give_ticket_submit(){
      
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $give_array=array();
        $give_array['ticket_index']=mysqli_real_escape_string($dbc, trim($_POST['ticket_index']));
        $give_array['ticket_state_select']=mysqli_real_escape_string($dbc, trim($_POST['ticket_state_select']));
        $give_array['members_index']=mysqli_real_escape_string($dbc, trim($_POST['members_index']));
        $give_array['meeting_index']=mysqli_real_escape_string($dbc, trim($_POST['meeting_index']));
     $this->model->give_ticket_submit($give_array);
     
 }
 
 function edit_ticket_submit(){
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $give_array=array();
        $give_array['ticket_index']=mysqli_real_escape_string($dbc, trim($_POST['ticket_index']));
        $give_array['ticket_state_select']=mysqli_real_escape_string($dbc, trim($_POST['ticket_state_select']));
        $give_array['members_index']=mysqli_real_escape_string($dbc, trim($_POST['members_index']));
        $give_array['meeting_index']=mysqli_real_escape_string($dbc, trim($_POST['meeting_index']));
     $this->model->edit_ticket_submit($give_array);
     
 }
 
 function delete_ticket($ticket_index, $meeting_index){
     $this->model->delete_ticket($ticket_index, $meeting_index);
     
 }
                
               
        

}


?>