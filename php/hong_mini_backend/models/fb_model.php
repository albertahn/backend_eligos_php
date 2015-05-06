<?php

class fb_model extends model {

function __construct() {
    
    parent::__construct();
}


        
        
//register the guy with facebook
        
        
  public function loginfacebook($register_data){
      
     // header('location: '.URL);  
       
     // get profile pic this way http://graph.facebook.com/sujeong.kim.5876/picture
      
      
      //if they have been here before or already registered, log them in
      
      
        $sth= $this->db-> prepare("SELECT * FROM `members` WHERE `email`= :email");
        $sth-> execute(array(
            ':email' => $register_data['email']
        ));
        
        $dataman = $sth->fetch();
        
        //echo json_encode($register_data);
        
        //if fid changeed update\
        
        if($dataman['FID']!==$register_data['FID']){
            // echo json_encode($dataman);
            
             $this->update_fid($register_data);
        }
            
           
        $count = $sth->rowCount();
        if($count>0){
           
           echo json_encode( $dataman);
            
           
        }else{
          
            //insert the picture
           $imgurl= 'http://graph.facebook.com/'.$register_data['FID'].'/picture?type=large';
            
            $pic_suffix= 'jpg';
     
            $picture_name = md5($imgurl.time()).".".$pic_suffix;
           
            $picture_path= '../public_html/public/uploads/members_pic/'.$picture_name;
          file_put_contents($picture_path, file_get_contents($imgurl));
          
  //insert
          //$db1 = new database();   
        $sth2 = $this->db->prepare('INSERT INTO `members` (username, email, profile_picture, usertype, FID)
                                                    VALUES (:username, :email,  :profile_picture, :usertype, :FID)');
        
        
        $sth2->execute(array(
            ':username' => $register_data['username'],
            ':email'=>$register_data['email'],
            
            ':profile_picture'=>$picture_name,
            ':usertype'=>'fb',
            ':FID'=>$register_data['FID']
            
            ));
        
         $index = $this->db->lastInsertId();
  //make a wall for that person       
          $sthk = $this->db->prepare('INSERT INTO `wall` (`index`, `members_index`)
                                                    VALUES (:wall_index, :members_index)');
        
        $sthk->execute(array(
            ':wall_index' => $index,
            ':members_index' =>$index
            ));
         
  //now login      
       
         $sthq= $this->db-> prepare("SELECT * FROM `members` WHERE `index`= :index");
        $sthq-> execute(array(
            ':index' => $index
        ));
        
        $datalogin = $sthq->fetch();
        
        echo json_encode($datalogin);
        
        }//end else
        
        
        
   } //fuck this has ended well 
        
   
    
   //update facebook id of user
   public function update_fid($register_data){
     
        $sthk = $this->db->prepare('UPDATE `members`
                SET `FID` = :FID
                WHERE `email` = :email
             ');
        
        $sthk->execute(array(
            ':FID' => $register_data['FID'],
            ':email' =>$register_data['email']
            ));
         
       
     
   } //update fid
        
          
          
      
        

}
