<?php

class file_model extends model {

function __construct() {
    parent::__construct();
}

          
      function upload_course_file($data){
          
          //check if image
          $check_image=getimagesize($data['tmp_name']);
          
          $rand= rand();
          
         $fh = @fopen($data['tmp_name'], "r");
 //file path for docs        
         $new_file_name=$rand.$data['file_name'];
         
         $file_path= 'public/uploads/files/'.$new_file_name;
         
         
        // echo $fh;
   
            if (!$fh) {
              print "ERROR: couldn't open file.\n";
              exit(126);
            }

            $blob = fgets($fh, 5);

            fclose($fh);
            
//check if its a valid format
            if (strpos($blob, 'Rar') !== false) {
                
              //print "Looks like a Rar.\n";
                
               //  move the file to to doc file folder
                
                         if(!move_uploaded_file($_FILES[upload_file]['tmp_name'], $file_path))
                               {
            
                             header('location: '.URL.'error/valid_file');
                               }
                                  
                               
                
                
              
            } else if (strpos($blob, 'PK') !== false) {
                
             // print "Looks like a ZIP.\n";
                                 if(!move_uploaded_file($_FILES[upload_file]['tmp_name'], $file_path))
                               {
            
                             header('location: '.URL.'error/valid_file');
                               }
                
                
              
            } else if($check_image[mime]==$data['file_type']){
                
             //move image file to folder  
                
                                 if(!move_uploaded_file($_FILES[upload_file]['tmp_name'], $file_path))
                               {
            
                             header('location: '.URL.'error/valid_file');
                               }
                
            }else if($data['file_type']=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
                    
                                 if(!move_uploaded_file($_FILES[upload_file]['tmp_name'], $file_path))
                               {
            
                             header('location: '.URL.'error/valid_file');
                               }
                
                
            }else{  //non of these formats
              
               header('location: '.URL.'error/valid_file/');
               
              exit(1);
            }
            
            
            //isert in database
            
            
            
            $sth = $this->db->prepare('INSERT INTO `course_files` (`file_name`, `courses_index`, `members_index`, `description`) 
                                                  VALUES (:file_name, :courses_index, :members_index, :description)');
        
        
                        $sth->execute(array( 
                            ':file_name'=>$new_file_name,
                            ':courses_index'=>$data['course_index'],
                            ':members_index'=>session::get('index'), 
                            ':description'=>$data['description']
                            ));
                        
                        
            
         //send back to product   
          header('location:'.URL.'product/inside_product/'.$data['course_index']);
      }
      
 //download file     
     function download_product_file($file_name){
          
         $old = getcwd(); // Save the current directory
        chdir('public/uploads/files/');
            
                    header('Content-disposition: attachment; filename='.$file_name);
        //header('Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        readfile($file_name);

         chdir($old);
          
          
      }
      
      
 //delete the file
      
   function delete_file($id,$filename, $course_index){
       
//delete from db       
       $sth = $this->db->prepare('DELETE FROM `course_files` WHERE `index`= :id');
        $sth -> execute(array(
            ':id'=>$id
            
        ));
        
       
       
       
       
 //delete the file in folder      
         $old = getcwd(); // Save the current directory
        chdir('public/uploads/files/');
        
       
        unlink($filename);
        chdir($old); // Restore the old working directory 
        
   //send to product
        
  //header('location:'.URL.'product/inside_product/'.$course_index);
       
   }      
      

}
