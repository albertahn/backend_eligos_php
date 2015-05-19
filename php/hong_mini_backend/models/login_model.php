<?php

class login_model extends model 
{
    
    public function __construct()
    {
       
        parent::__construct();
    }
    
    public function run($data){
        
       
        $sth= $this->db-> prepare("SELECT * FROM members WHERE email= :email AND password= :password");
        $sth-> execute(array(
            ':email' => $data['email'],
            ':password' => hash::create('sha256', $data['password'], HASH_key)
        ));
        
        $data = $sth->fetch();
       
            
            
        $count = $sth->rowCount();
        if($count>0){
            
            
            $data[`loggedin`]=true;
            
            session::init();
            session::set('username',  $data['username']);
            session::set('index',  $data['index']);
            session::set('password',  $data['password']);
            session::set('loggedin', $data[`loggedin`]);
            session::set('language', $data['language']);
            
             echo json_encode($data);
          // header('location: '.URL);
        }else
            {
            //show error
        // header('location: '.URL.'error/wrong_password');
            echo json_encode($data);
        }
        
        
     
    }
    
    
    function facebook_login($callback, $inputdata){
        
        
        $sth= $this->db-> prepare("SELECT * FROM members WHERE email= :email AND FID= :fid");
        $sth-> execute(array(
            ':email' => $inputdata['email'],
            ':fid' => $inputdata['FID']
        ));
        
        $data = $sth->fetch();
        
        
            $dataman['loggedin']=true;
            $dataman['index']=$data['index'];
            $dataman['username']=$data['username'];
            $dataman['email']=$data['email'];
            $dataman['profile_picture']=$data['profile_picture'];
            $dataman['lat']=$data['lat'];
            $dataman['lng']= $data['lng'];
            $dataman['FID']=$data['FID'];
            $dataman['fbAccessToken']=$inputdata['fbAccessToken'];
           // $data['loggedin']=true;
            
        $count = $sth->rowCount();
        if($count>0){
            
            session::init();
            session::set('username',  $data['username']);
            session::set('usertype',  $data['usertype']);
            session::set('profile_picture',  $data['profile_picture']);
            session::set('index',  $data['index']);
            session::set('password',  $data['password']);
            session::set('loggedin', $dataman['loggedin']);
            session::set('language', $data['language']);
            
            echo $callback.'('.json_encode($dataman).')';
          
        }else
            {
            
            
            //insert the picture
            $imgurl= 'http://graph.facebook.com/'.$inputdata['FID'].'/picture';
            
            $pic_suffix= 'jpg';
     
            $picture_name = md5($imgurl.time()).".".$pic_suffix;
           
            $picture_path= '../public_html/public/uploads/members_pic/'.$picture_name;
          file_put_contents($picture_path, file_get_contents($imgurl));
  //insert
       $db1 = new database();   
        $sth2 = $db1->prepare('INSERT INTO `members` (username, email, profile_picture, usertype, FID, lat, lng)
                                                    VALUES (:username, :email, :profile_picture, :usertype, :FID, :lat, :lng)');
        
        
        $sth2->execute(array(
            ':username' => $inputdata['name'],
            
            ':email'=>$inputdata['email'],
            ':profile_picture'=>$picture_name,
            ':usertype'=>fb,
            ':FID'=>$inputdata['FID'],
            ':lat'=> '37.883656228487574',
            ':lng'=>'237.7182559394423'
            
            ));
        
         $index = $db1->lastInsertId();
         
  //now login      
        
       // $data2 = $sth3->fetch();
            $data2['loggedin']=true;
            $data2['index']=$index;
            $data2['username']=$inputdata['name'];
            $data2['email']=$inputdata['email'];
            $data2['profile_picture']=$picture_name;
            $data2['lat']='37.883656228487574';
            $data2['lng']='237.7182559394423';
            $data2['FID']=$inputdata['FID'];
            $data2['fbAccessToken']=$inputdata['fbAccessToken'];
            
           session::init();
            session::set('username',  $data2['username']);
            session::set('usertype',  $data2['usertype']);
            session::set('profile_picture',  $data2['profile_picture']);
            session::set('index',  $data2['index']);
            session::set('password',  $data2['password']);
            session::set('loggedin', $data2['loggedin']);
            session::set('language', $data2['language']);
            
            $token=$fbAccessToken;
          echo $callback.'('.json_encode($data2).')';
            
        }
        
        }
        
    
    
    
}
?>
