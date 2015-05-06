
<div class="sc_menu_wrapper" style="height:150px;">
<div class="sc_menu"> 
 <?php
 
 echo'<p><a href="'.URL.'group/" style="font-family: cursive; color: whitesmoke; -webkit-border-radius: 10px;  -webkit-box-shadow: 0 1px 0 rgba(9, 9, 9, 1); background-color: #AAAAAA; text-align: center; "  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;group list&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></p><br />';
          try
            {
           $dbh = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
                              
                          }  
 catch (PDOException $e){
     echo $e->getMessage();
     
 }
 
     $sth = $dbh->prepare('SELECT * FROM `mygroup_view` WHERE `members_index`= :id AND `status`!= :user');
        $sth->execute(array(
     ':id'=> session::get('index'),
            ':user'=>pending
        
        ));
        
     //  return $sth->fetchAll();
        $group_list =$sth->fetchAll();
        
        
            foreach ($group_list as $key => $value) {
    

        echo'<div><a href="'.URL.'group/inside_group/'.$value['group_index'].'">
            <img src="'.URL.'public/uploads/group_pic/'.$value['group_pic'].'" width="50px" height="50px"  alt="picture" style=" background:#005554; border-right: 2px solid #ccc; border-bottom: 2px solid #fff; padding:5px; border-radius: 10px;"  /></a>
            </div>';
        echo '<span style="width:40px;  overflow:hidden;">'.$value['group_name'].'</span>';
            } 
        
        ?> 
    
    </div>
    </div>