<?php

class role extends controller  {

public function __construct() {
		parent::__construct();
                $this->view->css = array('role/css/role.css');
                
               // $this->view->js = array('product/js/product.js');
             
                session::init();
                $logged = session::get('loggedin');
              
                if ($logged == false )
                    {
                
                    
                    session::destroy();
                    header('location: ../login');
                    exit;
                    
                }
                
                
             }
             
             
                /**
                
public function index() {
    
			
                        $this->view->product_list= $this->model->product_list();
			$this->view->render('trade/index');
		
		}
                
                 * 
                 */
             
             public function request_role($id, $meeting_id){
                 
                 $data= array();
                 $data['role_id']=$id;
                 $data['meeting_id']=$meeting_id;
                 
                 $this->model->request_role($data);
                 
             }
             
             public function drop_role($id, $meeting_id){
                 $data= array();
                 $data['role_id']=$id;
                 $data['meeting_id']=$meeting_id;
                 
                 $this->model->drop_role($data);
                 
             }




             /**
             
      public function accept_trade_page($trade_id){
          
           $this->view->accept_trade_page=$this->model->accept_trade_page($trade_id);
            
          $this->view->render('trade/accept_trade_page');
          
          
         
          
         
      }
      
      public function accept_trade($trade_id){
          
           $this->model->accept_trade($trade_id);
            
         
          
          
         
          
         
      }* 
       */
       
              

}

