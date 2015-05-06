

<table class="friend_profile" about="<?php echo URL.'friend/friend_profile/'.$this->friend_profile['index']; ?>">
         <tr> 
             <th align="left" width="150px" rowspan="3"><img property="dc:profile_picture" class="fancy" src="<?php echo URL;?>public/uploads/members_pic/<?php echo $this->friend_profile['profile_picture'];?>" width="130px" height="130px" alt="product_pic"></th>
             <th align="left" style=" font-size: 12px; width: 250px; height: 10px;  overflow: hidden;">Name:<?php echo $this->friend_profile['username'];?></th>
             
             
             <?php require 'views/friend/add_delete_friend.php'; ?>
         </tr>
         
         
         <tr><th colspan="2" align="center" class="small_header" >profile</th></tr>
         <tr><td colspan="2" align="left" style="width:100px;" >
               <p style="width:370px; height:63px; overflow: scroll;" ><?php echo $this->friend_profile['profile'];?></p></td></tr>
         
        
         <tr><th colspan="3" class="small_header"><?php echo $this->friend_profile['username'];?>'s Products</th></tr>
         <tr><td colspan="3" align="left">
                 <div  style="height:140px; overflow:scroll; ">
              <?php
                foreach($this->friend_products as $key=>$value){
                 echo '<a href="'.URL.'product/inside_product/'.$value['index'].'"><img src="'.URL.'public/uploads/product_pic/'.$value['picture_path'].'" width="50px" height="50px" alt="group_pic"/><a/>';
    
    echo $value['product_name'];
    echo $value['location'];
   
    if($value['creator_index']= session::get('index')){
    echo '
        <a href="'.URL.'group/edit_group_page/'.$value['group_index'].'">edit</a> 
        <a href="'.URL.'user/delete/'.$value['group_index'].'">delete</a>
          ';
    echo '<br />';
    }
                }
                 
                 ?>
              </div>
                 
                 
             </td></tr>
         <tr><th colspan="3" class="small_header"><?php echo $this->friend_profile['username'];?>'s Groups</th></tr>
          <tr><td colspan="3" align="left" >
                  <div  style="height:140px; overflow:scroll; ">
              <?php
                foreach($this->friend_groups as $key=>$value){
                 echo '<a href="'.URL.'group/inside_group/'.$value['group_index'].'"><img src="'.URL.'public/uploads/group_pic/'.$value['group_pic'].'" width="50px" height="50px" alt="group_pic"/><a/>';
    
    echo $value['group_name'];
    echo $value['location'];
   
    if($value['creator_index']== session::get('index')){
    echo '
        <a href="'.URL.'group/edit_group_page/'.$value['group_index'].'">edit</a> 
        <a href="'.URL.'user/delete/'.$value['group_index'].'">delete</a>
          ';
    echo '<br />';
    }
                }
                 
                 ?>
              </div>
              </td></tr>
        
        
        
         

</table>


<?php
/**
print_r($this->friend_profile);
echo '<br />';
print_r($this->friend_groups);
echo '<br />';
print_r($this->friend_products);
 
 * 
 */
?>
