<?php

class group_model extends model 
{
    
    public function __construct()
    {
       
        parent::__construct();
    }
    
    
    //all groups
    
     public function group_list(){
        
        $sth = $this->db->prepare('SELECT * FROM `group` ORDER BY `index` DESC LIMIT 0,2');
        $sth->execute();
       return $sth->fetchAll();
   
     }
     //all groups load more
     
     public function group_list_load_more($last_group_index){
         
          $sth = $this->db->prepare('SELECT * FROM `group` WHERE `index`<:last_group_index ORDER BY `index` DESC LIMIT 0,2');
        $sth->execute(array( ':last_group_index'=>$last_group_index ));
       $data= $sth->fetchAll();
       
       foreach($data as $key => $value) {
            echo '<tr>';
            
    echo ' <td style="color:white;"><a href="'.URL.'group/inside_group/'.$value['index'].'"><img src="'.URL.'public/uploads/group_pic/'.$value['group_pic'].'" width="50px" height="50px" alt="group_pic"><a/></td>';
    echo ' <td style="color:white;" class="group_index" id="'.$value['index'].'">'.$value['index'].'</td>';
    echo ' <td style="color:white;">'.$value['name'].'</td>';
    echo ' <td style="color:white;">'.$value['location'].'</td>';
    
   
    if($value['creator_index']== session::get('index')){
    echo ' <td>
        <a class="uiButton" href="'.URL.'group/edit_group_page/'.$value['index'].'">edit</a> 
        <a class="uiButton" href="'.URL.'user/delete/'.$value['index'].'">delete</a>
          </td>';
    }
    
    echo '</tr>';                       
}
       
      
         
         
     }
     
    //my groups
     
      public function my_group_list(){
        
        $sth = $this->db->prepare('SELECT * FROM `mygroup_view` WHERE `members_index`= :id');
        $sth->execute(array(
         ':id'=> session::get('index')   
        ));
       return $sth->fetchAll();
   
     }
     
     //inside the group bundle
//list of all meeting
     
     public function meeting_list($id){
          $sth = $this->db->prepare('SELECT * FROM `meeting` WHERE `index` IN(SELECT `meeting_index` FROM `group_has_meeting` WHERE `group_index`= :id) ORDER BY `index` DESC');
        $sth->execute(array(':id'=> $id));
       return $sth->fetchAll();
         
     }
     //see if members has group
     
      public function has_group($id){
          $sth = $this->db->prepare('SELECT * FROM `members_has_group` WHERE `group_index` = :id AND `members_index` = :my_id');
        $sth->execute(array(
                            ':id'=> $id,
                            ':my_id'=>session::get('index')
                            ));
        return $sth->fetch();
      
         
     }
     //all members 
   /**  public function all_members_of_group($id){
          $sth = $this->db->prepare('SELECT * FROM `members_has_group` WHERE `group_index` = :id');
        $sth->execute(array(
                            ':id'=> $id
                            ));
        return $sth->fetchAll();
      
         
     }**/
     //all admins
     public function all_admins_of_group($id){
          $sth = $this->db->prepare('SELECT * FROM `mygroup_view` WHERE `group_index` = :id AND `status`=:admin');
        $sth->execute(array(
                            ':id'=> $id,
                            ':admin'=>admin
                            ));
        return $sth->fetchAll();
      
         
     }
     //group info of $id
      public function group_info($id){
          $sth = $this->db->prepare('SELECT * FROM `group` WHERE `index` = :id');
          $sth->execute(array(':id'=> $id));
          return $sth->fetch();
       
         
     }
     //group pic only
     public function group_social($id){
          $sth = $this->db->prepare('SELECT * FROM `group` WHERE `index` = :id');
          $sth->execute(array(':id'=> $id));
          return $sth->fetch();
       
         
     }
     
     //the bundle for joining groups
     //open group
     public function join_group_open($group_index){
        
         
          $sth = $this->db->prepare('INSERT INTO members_has_group (members_index, group_index, status) VALUES (:members_index, :group_index, :status)');
          $sth->execute(array(':members_index'=>session::get('index'), 
                              ':group_index'=>$group_index, 
                             ':status'=>user
              ));
          header('location: '.URL.'group/inside_group/'.$group_index);
         
         
     }
     //password group
     public function join_group_password($data){
         $sth = $this->db->prepare('SELECT * FROM `group` WHERE `index` = :id');
       
         $sth->execute(array(
            ':id'=>$data['group_index']
        ));
         
         $group_info=$sth->fetch();
         
         $input=hash::create('sha256', $data['password'], HASH_key);
         
         if($input==$group_info['password']){
             //insert data into members has index as user because he knows the password
             $sth = $this->db->prepare('INSERT INTO members_has_group (members_index, group_index, status) VALUES (:members_index, :group_index, :status)');
             $sth->execute(array(':members_index'=>session::get('index'), 
                              ':group_index'=>$group_info['index'], 
                             ':status'=>user
                 ));
             
             //header location
         header('location: '.URL.'group/inside_group/'.$group_info['index']);
             
         }else{
            header('location: '.URL.'error/wrong_password');// $this->error->wrong_password;
         }
         
     }
     
     //permission based group
     public function join_group_permission($group_index){
         
         
         
         $sth = $this->db->prepare('INSERT INTO members_has_group (members_index, group_index, status) VALUES (:members_index, :group_index, :status)');
          $sth->execute(array(':members_index'=>session::get('index'), 
                              ':group_index'=>$group_index, 
                             ':status'=>pending
              ));
          
           header('location: '.URL.'group/inside_group/'.$group_index);
         
     }
     // member join page for permission based groups
      public function group_join_requests_page($id){
          $sth = $this->db->prepare('SELECT * from mygroup_view WHERE `creator_index`= :my_id AND `status` = :pending');
          $sth->execute(array(':my_id'=>session::get('index'), 
                              ':pending'=>pending
              ));
             return $sth->fetchAll();
         
      }
      // accept join group for perm based group
      
       public function accept_join_group($data){
           $sth = $this->db->prepare('UPDATE `members_has_group` 
              
                SET `status` = :user
                 WHERE `members_index` = :members_index And `group_index`=:group_index
             ');
           $sth -> execute(array(
            ':members_index'=>$data['members_index'],
            ':group_index'=>$data['group_index'],   
            ':user'=>user
        ));
          
            
         //header  back to group requests link
           header('location: '.URL.'group/group_join_requests_page/'.session::get('index'));
           
       }
       
       //reject the guy from joining the group
       
        public function reject_join_group($data){
            
             $sth = $this->db->prepare('DELETE FROM `members_has_group` WHERE `members_index`= :members_index AND `group_index`=:group_index');
        $sth -> execute(array(
            ':members_index'=>$data['members_index'],
            ':group_index'=>$data['group_index']
            
        ));
         header('location: '.URL.'group/group_join_requests_page/'.session::get('index'));
        
            
        }
     
     
     //DELETE GROUP
        
        //delete warnin
       public function delete_group_warning($group_index){
           $sth = $this->db->prepare('SELECT * from `group` WHERE `index` =:id');
          $sth->execute(array(':id'=>$group_index
                              
              ));
           
           //  print_r($sth->fetchAll());
             return $sth->fetch();
          
          
       }
        //real delete
     
      public function delete_group($group_index)
    {
          
          //see if real admin
          $sth = $this->db->prepare('SELECT * from `members_has_group` WHERE `group_index` =:group_id AND `members_index`=:members_index');
          $sth->execute(array(
              ':group_id'=>$group_index,
              ':members_index'=>session::get('index')
                              
              ));
           
           //  print_r($sth->fetchAll());
             $group= $sth->fetch();
             
        if($group['status']==admin){
        $sth = $this->db->prepare('DELETE FROM `group` WHERE `index`= :id');
        $sth -> execute(array(
            ':id'=>$group_index
            
        ));
      header('location: '.URL.'group/index/');  
        }
        else{
            header('location: '.URL.'error/not_admin/');  
        }
    }
    //edit group page show the stuff already there
    
    public function edit_group_page($id){
        
        $sth = $this->db->prepare('SELECT * FROM `group` WHERE `index` = :id');
       
        $sth->execute(array(
            ':id'=>$id
        ));
       return $sth->fetch();
       
      
     
       
    }
    
    
     //edit group
     public function edit_group($data){
         
         
         if(!($data[group_picture]=getimagesize($_FILES['group_picture']['tmp_name']))){
            echo "please upload a valid image file.";
        }
        else {
         
        
        
        
       
       
        
       $pic_suffix= substr($_FILES['group_picture']['type'], strpos($_FILES['group_picture']['type'], "/")+1); 
       $picture_name=md5($data['group_picture'].time()).".".$pic_suffix;
       $picture_path= 'public/uploads/group_pic/'.$picture_name;
       
        if(!move_uploaded_file($_FILES['group_picture']['tmp_name'], $picture_path)){
           echo "file can't be uploaded at this time.";
        }
        
        else{
            
            //delete the image file that was there before
        
        
        $sth= $this->db-> prepare("SELECT `group_pic` FROM `group` WHERE `index`= :index");
        $sth-> execute(array(
           ':index'=>$data['id']
        ));
        
        $delete_pic = $sth->fetch();
        
       // echo '<br />'.'pic to be deleted: public/uploads/group_pic/'.$delete_pic['group_pic'];
       
        $old = getcwd(); // Save the current directory
        chdir('public/uploads/group_pic/');
        
       
        unlink($delete_pic['group_pic']);
        chdir($old); // Restore the old working directory 
        
       
        
        
        //update and set the new data
         
          $sth = $this->db->prepare('UPDATE `group` 
              
                SET `name` = :name, `password` = :password, `location` = :location, `type` = :type, `profile` = :profile, `group_pic` = :group_pic
                 WHERE `index` = :id
             ');
          
          $sth->execute(array(
            ':id' => $data['id'],
           ':name'=> $data['name'] , 
            ':password'=> hash::create('sha256', $data['password'], HASH_key), 
            ':location'=> $data['location'], 
            //':creator_index'=> session::get(index), 
            ':type'=> $data['groupType'], 
            ':profile'=> $data['profile'], 
            ':group_pic'=> $picture_name 
            ));
          
            header('location: '.URL.'group/inside_group/'.$group_id['group_id']);
        }
     }
     }  
     //create group
     
    public function create_group($data)
    {
        
        if(!($data[group_picture]=getimagesize($_FILES['group_picture']['tmp_name']))){
            
           header('location: '.URL.'error/valid_image');
            //$this->error->valid_image;
           // echo "please upload a valid image file.";
        }
        else {
         
        
        
        
       
       
        
       $pic_suffix= substr($_FILES['group_picture']['type'], strpos($_FILES['group_picture']['type'], "/")+1); 
       $picture_name=md5($data['group_picture'].time()).".".$pic_suffix;
       $picture_path= 'public/uploads/group_pic/'.$picture_name;
       
        if(!move_uploaded_file($_FILES['group_picture']['tmp_name'], $picture_path)){
            
           //$this->error->file_upload;
            echo "file can't be uploaded at this time.";
        }
        
        else{
        
       
        $sth = $this->db->prepare('INSERT INTO `group` (name, password, location, creator_index, type, profile, group_pic, fb_group_id) VALUES (:name, :password, :location, :creator_index, :type, :profile, :group_pic, :facebook_group)');
        
        
        $sth->execute(array(
            
            ':name'=> $data['name'] , 
            ':password'=> hash::create('sha256', $data['password'], HASH_key), 
            ':location'=> $data['location'], 
            ':creator_index'=> session::get(index), 
            ':type'=> $data['groupType'], 
            ':profile'=> $data['profile'],
            ':facebook_group'=> $data['facebook_group'],
            ':group_pic'=> $picture_name 
            ));
        
        $group_id = array('group_id'=> $this->db->lastInsertId());
       
       $sth2= $this->db->prepare('INSERT INTO `members_has_group` (`members_index`, `group_index`, `status`) VALUES (:members_index, :group_index, :status)');
       $sth2->execute(array(
           ':members_index'=> session::get(index),
           ':group_index'=> $group_id['group_id'],
           ':status'=> 'admin'
           
           
       ));
       
    header('location: '.URL.'group/inside_group/'.$group_id['group_id']);

        }
    }
    }
    
   
    
    
    //facebook groups list
    
    function get_facebook_groups(){
        
         $sth = $this->db->prepare('SELECT * FROM `members` WHERE `index` = :id');
                $sth->execute(array(':id'=> session::get('index')));
                $my_info=$sth->fetch();
                
       //access code 
       
        
        $code=session::get('fb_code');
        $url2 = 'https://graph.facebook.com/'.$my_info['FID'].'/groups?access_token=AAACEdEose0cBAGBGO8b4rDxqZCti5jqffZBLZADzfSzVXlZAqM5nZCPjNsiK04TxZB4NtYcScjgQlTTV1eIVxZBBOV9RmmcmZBirFDfHWWkjsgZDZD';//
        $data = json_decode(file_get_contents($url2));
        
        return $data;
        
    }
    
    
//facebook comment
     function facebook_group_comment($data){
         
         
         
         $fb_group_id=$data['fb_group_id'];
         //session
          $status=$data['status'];
         $facebook_access_token='AAACEdEose0cBAMoF0eCLZBBPemVbElNUYXsVpXoXldp9trqGXaexU1wNBrxfjEoLdLk3p2H2ZApQEhWyAZCE2CWsF5THgzF1PJG1S3akAZDZD';
//Facebook Wall Update
  $params = array('access_token'=>$facebook_access_token, 'message'=>$data['status']);
$url = "https://graph.facebook.com/".$fb_group_id."/feed";



$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => $url,
CURLOPT_POSTFIELDS => $params,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_SSL_VERIFYPEER => false,
CURLOPT_VERBOSE => true
));
$result = curl_exec($ch);



$fields = array(
    'access_token'=>$facebook_access_token,
    'message'=>$status,
                );
/**
//url-ify the data for the POST
foreach($fields as $key=>$value){ 
    $fields_string .= $key.'='.$value.'&amp;';
    }
rtrim($fields_string,'&amp;');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

//execute post
 $result = curl_exec($ch);

//close connection
curl_close($ch);

print_r($params);
 * 
 */
/**
$facebook = new Facebook(array(
  'appId' => '372413362797737',
  'secret' => 'f46ef4272759e2edc71d9b1708e233a2',
  'cookie' => true,
));

//post on users wall     
     $args = array(
    'message'   => '너네 아직도 싸이클럽 쓰냐?우리 동아리는 "미팅미팅앱" 쓴다.',
    'link'      => 'http://apps.facebook.com/meetingmeeting/',
    'caption'   => 'This is the facebook group exstenstion app.그룹관리 페이스북 앱 미팅미팅 입니다.',
    'picture'   => 'http://meetingmeeting.com/public/images/logo.png',
     'name'     => 'meetingmeeting app',
     'description' =>'페이스북 그룹을위한 게시판만들기와 구글 지도에 이벤트만들기.초대 코드가 있어야 가입 가능합니다.Create bulletin boards for your facebook group and create events on google maps~!Exclusive and invitational join only.'
);
$post_id = $facebook->api("/".$fb_group_id."/feed", "post", $args);
 
 * 
 
$facebook = new Facebook(array(
  'appId' => '372413362797737',
  'secret' => 'f46ef4272759e2edc71d9b1708e233a2',
  'cookie' => true,
));

//post on users wall     
     $args = array(
    'message'   => '너네 아직도 싸이클럽 쓰냐?우리 동아리는 "미팅미팅앱" 쓴다.'
    
);
$post_id = $facebook->api($url, "post", $params);
                   
 * 
 * 
 * **/

          
     }
        
    
    
}
