<h1>user</h1>

<?php print_r($this->user) ?>

<form method="post" action="<?php echo URL; ?>user/create" >
    
    
    <label>name</label><input type="text" name="name"/><br />
    <label>email</label><input type="text" name="email"/><br />
    <label>password</label><input type="password" name="password"/><br />
<!--    <label>password-retype</label><input type="password" name="password2"/><br /> -->
    <label>role</label>
    <select name="role">
         <option value="default">default</option>  
         <option value="admin">admin</option>  
        
        
    </select>
    <br />
    
    <label>&nbsp;</label><input type="submit"/>
        
    
    
</form>

<table>
   
<?php 

foreach($this->user_list as $key => $value) {
    echo '<tr>';
    echo ' <td>'.$value['index'].'</td>';
    echo ' <td>'.$value['name'].'</td>';
    echo ' <td>'.$value['email'].'</td>';
   
    echo ' <td>
        <a href="'.URL.'user/edit/'.$value['index'].'">edit</a> 
        <a href="'.URL.'user/delete/'.$value['index'].'">delete</a>
          </td>';
    
    
    echo '</tr>';
}

   // print_r($this->user_list);
    
?>
        
      

    </table>