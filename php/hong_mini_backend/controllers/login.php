<?php

class login extends controller {
    
         

	function __construct() {
		parent::__construct();
		session::init();
                
                $this->view->js = array('login/js/login.js');
	}

	function index() {
			$this->view->render('login/index');
		}
                
       function run(){
           
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                   
                   $data=array();
                   //$callback=mysqli_real_escape_string($dbc, trim($_GET['callback']));
                   
                  // $data['email2']=mysqli_real_escape_string($dbc, trim($_GET["email"]));
                   
                   $data['email']=mysqli_real_escape_string($dbc, trim($_POST["email"]));
                   $data['password']=mysqli_real_escape_string($dbc, trim($_POST["password"]));
                  // echo $callback.'('.json_encode($data).')';
                  $this->model->run($data);
               // print_r($data);
                    
       }
                
        function logout(){
                    session::destroy();
                   $callback= $_GET[callback];
                   
                   echo $callback.'({loggedin:false})';
                   // header('location: '.URL);
                    exit;
                }
                
                
       function facebook_click($email){
           $this->view->facebook_data= $email;
           $this->view->render('login/facebook_click');
           
       }
       
     //fblogin
       
       function facebook_login($email, $id){
           
             $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                   
                   $inputdata=array();
                   $callback=mysqli_real_escape_string($dbc, trim($_GET['callback']));
                   $inputdata['name']=mysqli_real_escape_string($dbc, trim($_GET['name']));
                   $inputdata['FID']=mysqli_real_escape_string($dbc, trim($_GET['FID']));
                   $inputdata['email']=mysqli_real_escape_string($dbc, trim($_GET['email']));
                   $inputdata['fbAccessToken']=mysqli_real_escape_string($dbc, trim($_GET['fbAccessToken']));
           
            $this->model->facebook_login($callback, $inputdata);
           
       }
                

}

//codes_left, code, date




