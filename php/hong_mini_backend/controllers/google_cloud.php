<?php

class google_cloud extends controller  {

function __construct() {
		parent::__construct();
                
		
		}// end construct
                
                
                
    public function check_gcm_device($user_index, $gcm_id, $device_name){
        //$data[0]=$user_index;
       // $data[1]=$device_name;
        //echo json_encode($data);
        $this->model->check_gcm_device($user_index, $gcm_id, $device_name);
        
    }
    
   
    public function test($user_index, $gcm_id, $device_name){ 
        
        
        $this->model->delete_old_codes($user_index, $gcm_id, $device_name);
    }
                
                
               
}
