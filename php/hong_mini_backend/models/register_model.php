<?php

class register_model extends model 
{
    
    public function __construct()
    {
        session::init();  
        parent::__construct();
    }
   
    
    
    //get the data of the editing person
   public function my_profile(){
       
       
        $sth = $this->db->prepare('SELECT * FROM `members` WHERE `index`= :id');
        $sth->execute(array(
            ':id' => session::get('index')
            
        ));
       
       
         return $sth->fetch();
    }
    //
    //edit profile
    //
    
    public function edit_profile($data){
        
        
        if(!($data['profile_picture']= getimagesize($_FILES['file']['tmp_name']))){
             echo'{"error":"not_valid_img"}';
            
        }else { 
            
            //upload new pic
            
            
            //delete old pic
              $sth1= $this->db-> prepare("SELECT `profile_picture` FROM `members` WHERE `index`= :index");
        $sth1-> execute(array(
           ':index'=>$data['members_index']
        ));
        
        $delete_pic = $sth1->fetch();
        
        $old = getcwd(); // Save the current directory
        chdir('../public_html/public/uploads/members_pic/');
        
       
        unlink($delete_pic['profile_picture']);
        chdir($old); 
        
        //update and select new data
         $rand= rand();
         //file path for docs        
                 $new_file_name = $rand.time().$_FILES['file']['name'];

                $file_path= '../public_html/public/uploads/members_pic/'.$new_file_name;
                 
                 if(move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
                         // image success
                         
                                    } else{
                                        
                                     echo '{"error":"file_not_uploaded'.$data['file_name'].'"}';
                                     
                                     
                                    }
        
         //update and set the new data
        
        $sth2 = $this->db->prepare('UPDATE `members`
                SET `username` = :username, `profile_picture` =:profile_picture
                WHERE `index` = :id
             ');
          
          $sth2->execute(array(
            ':id' => $data['members_index'],             
            ':username' => $data['username'],           
            ':profile_picture' =>$new_file_name
            ));
       
        
        $sth3= $this->db-> prepare("SELECT * FROM `members` WHERE `index`= :index");
        $sth3-> execute(array(
           ':index'=>$data['members_index']
        ));
        
        $data2 = $sth3->fetch();
        
        echo json_encode($data2);
            
        }//end else
        
        
    }
        
   
    
    //register first time
    
    public function reg($data)
    {
        
        $sth1 = $this->db->prepare('SELECT * FROM `members` WHERE `email` =:email'); 
        $sth1->execute(array(
            ':email'=>$data['email']
            
        ));
        
        if($sth1->rowCount()>0){
            
           echo'{"error":"already_email"}';
           
        }else {
    /*
        if(!($data['profile_picture']=getimagesize($_FILES['file']['tmp_name']))){
             echo'{"error":"not_valid_img"}';
            
        }else {
         
                  $rand= rand();
         //file path for docs        
                 $new_file_name = $rand.time().$_FILES['file']['name'];

                $file_path= '../public_html/public/uploads/members_pic/'.$new_file_name;
                 
                // $file_path = 'public/uploads/members_pic/'.$new_file_name;
                 
                 
                 if(move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
                         // image success
                         
                                    } else{
                                        
                                        
                                     echo '{"error":"file_not_uploaded'.$data['file_name'].'"}';
                                     
                                     
                                    }*/
       
        $stha = $this->db->prepare('INSERT INTO `members` (username, password, email,gold,cash)
                                                    VALUES (:username, :password, :email,:gold,:cash)');
        
        
        $stha->execute(array(
            ':username' => $data['name'],
            ':password' =>hash::create('sha256', $data['password'], HASH_key),
            ':email' => $data['email'],
            ':gold' => 0,
            ':cash' => 0
            /*
            ':profile_picture' => null, //$new_file_name ,
            ':usertype' => 'norm' */
            ));
        
        $index = array('index'=> $this->db->lastInsertId());
       
        //
        $sthk= $this->db-> prepare("SELECT * FROM members WHERE `index` = :index");
        $sthk-> execute(array(
           ':index'=>$index['index']
        ));
        
        $data = $sthk->fetch();
        
       //echo data to save and login person
        echo json_encode($data);
     
         }//end if valid
    
    
   
    
    } 
       
        
   
    }
   
   