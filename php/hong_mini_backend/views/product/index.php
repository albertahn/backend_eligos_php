


<a href="<?php echo URL; ?>group/create_group_page" onclick="going();">create_group</a>

<p>My group</p>

<hr />
<p>All groups</p>
<table>

<?php 

foreach($this->group_list as $key => $value) {
    echo '<tr>';
    echo ' <td><a href="'.URL.'group/inside_group/'.$value['index'].'"><img src="'.URL.'public/uploads/group_pic/'.$value['group_pic'].'" width="50px" height="50px" alt="group_pic"><a/></td>';
    echo ' <td>'.$value['index'].'</td>';
    echo ' <td>'.$value['name'].'</td>';
    echo ' <td>'.$value['location'].'</td>';
   
    echo ' <td>
        <a href="'.URL.'user/edit/'.$value['index'].'">edit</a> 
        <a href="'.URL.'user/delete/'.$value['index'].'">delete</a>
          </td>';
    
    
    echo '</tr>';
}

 //  print_r($this->user_list);
    
?>
</table>