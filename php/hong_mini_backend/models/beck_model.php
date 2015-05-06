<?php

class beck_model extends model {

function __construct() {
    parent::__construct();
}

        function uploads(){

            $sth = $this->db->prepare('SELECT * FROM `beck_uploads`');
                $sth->execute();
               return $sth->fetchAll();

        }


        function upload_file($data){
            
            if(!($data['file_type']=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'))
                {
            
           header('location: '.URL.'error/valid_file');
            
                   }else{
                       
                       
                       $sth = $this->db->prepare('INSERT INTO `beck_uploads` (`name`, `email`, `major`, `file_name`, `date`) 
                                                  VALUES (:name, :email, :major, :file_name, :date)');
        
        
                        $sth->execute(array( 
                            ':name'=>$data['name'],
                            ':email'=>$data['email'],
                            ':major'=>$data['major'],
                            ':file_name'=>$data['file_name'],
                            ':date'=>$data['beck_date']
                            ));

                       
                       //move the file to folder after database upload
                       
                       
                         $file_path= 'public/uploads/files/'.$data['file_name'];
             
                          if(!move_uploaded_file($_FILES[upload_file]['tmp_name'], $file_path))
                               {
            
                             header('location: '.URL.'error/valid_file');
                               }else{
                                   
                                  header('location:'.URL.'beck');
                               }
                       
                   }
            
        }
        
        
        function login_beck($data){
            
            //print_r($data);
            
             $sth = $this->db->prepare('SELECT * FROM `beck` WHERE `username`=:username AND `password`=:password');
        
        
                        $sth->execute(array( 
                            ':username'=>$data['username'],
                            ':password'=>$data['password']
                            ));
                        
                   $beck_array=$sth->fetch(); 
                    
                    
                    
                    
                   $count= $sth->rowCount();
                    
                if($count>0){
                    session::init();
                    session::set('professor', $beck_array['username']);
                    
                    header('location: '.URL.'beck');
                }else{
                    
                    header('location: '.URL.'error/valid_login');
                }       

            
        }
        
        function download_file($file_name){
            
            $old = getcwd(); // Save the current directory
        chdir('public/uploads/files/');
            
            header('Content-disposition: attachment; filename='.$file_name);
header('Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
readfile($file_name);

 chdir($old);
        }
        

}
