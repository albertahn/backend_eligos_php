<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class battle extends controller  {

function __construct() {
		parent::__construct();
                
		
		
		}
                
                
                
 function add_btn_press($user_index, $day_number){ 
     
     $this->model->add_btn_press($user_index, $day_number);
     
     
 }
 
 
 
 
 function test_battle($user_index, $day_number){
     
    // gcm_battle_static::add_send("23", "testing battle");
     
    // $this->model->add_battle_friend_day($user_index, $day_number);
       $this->model->send_gcm_battle_array($user_index, $day_number);
 }
                
}//end class
