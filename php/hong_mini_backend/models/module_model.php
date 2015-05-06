<?php

class module_model extends model 
{
    
    public function __construct()
    {
       session::init();
        parent::__construct();
    }
    
    public function create_lesson($data){
        
        
        $pic_suffix= substr($_FILES['file']['type'], strpos($_FILES['file']['type'], "/")+1); 
                     $check_image= getimagesize($data['tmp_name']);

                  $rand= rand();

         //file path for docs        
                 $new_file_name=$rand.time().$data['file_name'];

                 $file_path= '../public_html/public/uploads/product_pic/'.$new_file_name;



                     if(move_uploaded_file($data['tmp_name'], $file_path)) {
                         
                         //echoit
                         
                                    } else{
                                     //   echo "fail";
                                    }

                        

                                     $sth= $this->db->prepare('INSERT INTO `course_modules` (`module_name`,`courses_index`, `members_index`, `description`, `youtube`, `image`) 
                                                              VALUES (:module_name,:courses_index, :members_index, :description, :youtube, :image)');

                       $sth->execute(array(
                           ':module_name'=> $data['lesson_title'],
                           ':courses_index'=>$data['course_index'], 
                           ':members_index'=>$data['user_index'],
                           ':description'=>$data['descrip'], 
                           ':youtube'=>$data['youtube'], 
                           ':image'=>$new_file_name
                           ));
                                    
                       $mod_index = $this->db->lastInsertId();
                                 
                                   
                           $sth2= $this->db->prepare('INSERT INTO `member_has_module` (`members_index`,`module_index`, `status`) 
                                                              VALUES (:members_index, :module_index, :status)');

                       $sth2->execute(array(
                           ':members_index'=> $data['user_index'],
                           ':module_index'=>$mod_index, 
                           ':status'=>'admin'
                          
                           ));
                                    
                       
                       echo json_encode($_POST);
                       
                       
    } //end create lesson
    
    
    
    public function get_module($mod_index){
        
           $sth= $this->db->prepare('SELECT * FROM `course_modules` WHERE `index` = :mod_index');

                       $sth->execute(array(
                           ':mod_index'=> $mod_index
                           ));
                       
                       $data = $sth->fetch();
                       
                       echo json_encode($data);
    }//end get mod
    
    
    public function delete_module($mod_index){
        
         $sth= $this->db->prepare('SELECT * FROM `course_modules` WHERE `index` = :mod_index');

                       $sth->execute(array(
                           ':mod_index'=> $mod_index
                           ));
                       
                       $data = $sth->fetch();
                       
                      if(!empty($data['image'])){
                          
                          $old = getcwd(); // Save the current directory
                            chdir('../public_html/public/uploads/product_pic/');


                            unlink($data['image']);
                            chdir($old); // Restore the old working directory 
                          
                      }
                      
           //after delete image delete data
                      
                      $sth1= $this->db->prepare('DELETE FROM `course_modules` WHERE `index` = :mod_index');

                       $sth1->execute(array(
                           ':mod_index'=> $mod_index
                           ));
                       
                       echo json_encode($data);
        
    }//end delete module
    
    
     public function all_modules(){
         
          $sth= $this->db->prepare('SELECT * FROM `course_modules` ORDER BY `index` DESC LIMIT 0,50');

                       $sth->execute(array(
                           ':mod_index'=> $mod_index
                           ));
                       
                       $data = $sth->fetchAll();
                       
                       echo json_encode($data);
         
     }
    
}