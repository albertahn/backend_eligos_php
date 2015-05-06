
<h1>Welcome Professor</h1>
<form enctype="multipart/form-data" method="post" action="<?php echo URL?>beck/login_beck">

<table>
           <tr>
               <td><div class="form_label">ID</div></td>
               
               <td><input type="text" id="beck_id" name="beck_id" placeholder="type in id" /></td>
           </tr>
           
           <tr>
               <td>
                   <div class="form_label">Password:</div>
               </td>
               
               <td><div class="form_label">
                       <input type="password" name="password" placeholder="type in password" />
                   </div>
               </td>
           </tr>
           
           <tr>
               <td></td>
               <td> <input type="submit" value="Login as Professor" class="btn btn-primary"/></td>
               
           </tr>
           
           
</table>
    
</form>