<?php

class invite_model extends model {

            function __construct() {
             parent::__construct();
            }

             
            
            function codes_left(){
           $sth = $this->db->prepare('SELECT * FROM `new_register`');
          $sth->execute();
          return $sth->fetch();
            }
            
            
           
            
//request invite
            
            function request_invite($to, $subject, $message){
                
            
             //how many left?
               $sth = $this->db->prepare('SELECT `codes_left` FROM `new_register`');
                $sth->execute();
                $codes_left=$sth->fetch();
              
             
               
               
              if($codes_left['codes_left']>0){
                   $sth = $this->db->prepare('UPDATE `new_register` set `codes_left` =:codes_left
                                            WHERE `index`=:index');
               $sth->execute(array(
                   ':codes_left'=>$codes_left['codes_left']-1,
                  
                   ':index'=>1
                   
               ));
                  
                  
                  //send mail    
               
              email_static::mail($to, $subject, $message);
              
              echo $to, $subject, $message;
             // header('location: '.URL.'invite/invitation_sent');
              }
              else{
                  //send error message
                    header('location: '.URL.'error/no_codes_left');
                  
              }
               
               
            }  
   //show how much time left till next batch of codes available         
           function time_left(){
                $sth = $this->db->prepare('SELECT `date` FROM `new_register`');
               $sth->execute();
               $last_update= $sth->fetch();
               
            // date_default_timezone_set('Asia/Seoul');
             
            $time_zone = date_default_timezone_get();
            $server_time = time();
  
            $client_time = date('Ymd H:i:s',$server_time);
            $time_left= "14:00:00-$client_time";
            $left= $last_update['date']+60*20-$server_time;
            
            
             //echo $time_left.'<br />';
             //echo $client_time .'<br />';
             echo date('H:i:s',$left);
             
             if($left==0){
                 $sth = $this->db->prepare('UPDATE `new_register` set `codes_left` =:codes_left,
                                            `date`=:date
                                            WHERE `index`=:index');
               $sth->execute(array(
                   ':codes_left'=>30,
                   ':date'=>time(),
                   ':index'=>1
                   
               ));
                 
                 
             }
             
               
           }
           
//verify code
            function verify_code($input_code){
                $sth = $this->db->prepare('SELECT * FROM `new_register`');
                $sth->execute();
                $code=$sth->fetch();
                
                if( $code['code']==$input_code){
                    session::init();
                    
                    session::set('has_code', true);
                  header('location: '.URL.'invite/register');  
                }
                else{
                    //echo $input_code;
                    header('location: '.URL.'error/no_codes_left'); 
                }
                
                  
            }
            
  //login content
            function login_content(){
                echo'<h1  class="header">Welcome<h1>';
                echo"<a href='".URL."public/facebook/facebook_login_only.php'><p style='background: #627BA8; color:#fff;' class='small_header'>
                    <img src='".URL."public/images/small_fb.png' style='width:30px;' style='display:block;, margin-top: 10px;' />
                        Login with facebook</p></a>";  
                
            }
            
            

}
