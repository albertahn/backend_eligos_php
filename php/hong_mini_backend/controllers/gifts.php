<?php

class gifts extends controller  {

function __construct() {
		parent::__construct();
                
		
               // $this->view->js = array('dashboard/js/default.js');
		
		}
function show_my_gifts($id){
    
                   $this->model->show_my_gifts($id);
		
		}
                
 function gift_lists_near($id){
     
        $this->model-> gift_lists_near($id);
     
 }    
 
 function received_gift($userID, $giftID){
     
     $this->model->received_gift($userID, $giftID);
 }
                
               
}


?>