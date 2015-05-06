<div  class="sc_menu_wrapper" style="height:100px;">
<div class="sc_menu"> 
    <div id="friend_list"><p><a href="<?php echo URL; ?>friend/get_friends_list" style="font-family: cursive; color: whitesmoke; -webkit-border-radius: 10px;  -webkit-box-shadow: 0 1px 0 rgba(9, 9, 9, 1); background-color: #AAAAAA; text-align: center; "  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;friends list&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></p><br /></div>
 <?php
 
           $this ->db = new database();
     $sth = $this->db->prepare('SELECT * FROM `members` 
         WHERE `index` IN (SELECT `friend_index` FROM `friends` 
         WHERE `my_index`=:id AND `status`=:status)');
        $sth->execute(array(
            ':id'=>session::get('index'),
             ':status'=> accepted   
            
            ));
        
     //  return $sth->fetchAll();
        $friend_list =$sth->fetchAll();
        
            foreach ($friend_list as $key => $value) {
    

        echo'<div><a href="'.URL.'user/user_profile/'.$value['index'].'">
            <img src="'.MEMBERS_PIC.'/'.$value['profile_picture'].'" width="50px" height="50px"  alt="picture" style="background:#005554; border-right: 2px solid #ccc; border-bottom: 2px solid #fff; padding:5px; border-radius: 10px;"  /></a>
             </div> ';
        echo $value['username'];
                
        }
        ?> 
    
    </div>
    
    </div>