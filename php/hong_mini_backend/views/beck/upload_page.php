<h1>upload your homework</h1>

<form enctype="multipart/form-data" method="post" action="<?php echo URL?>beck/upload_file">

<table>
           <tr>
               <td><div class="form_label">Upload file: </div></td>
               
               <td><input type="file" id="upload_file" name="upload_file" class="btn" /></td>
           </tr>
           
           <tr>
               <td>
                   <div class="form_label">Name:</div>
               </td>
               
               <td><div class="form_label">
                       <input type="text" name="name" placeholder="your name" />
                   </div>
               </td>
           </tr>
           
           <tr>
               <td>
                   <div class="form_label">email:</div>
               </td>
               
               <td><div class="form_label">
                       <input type="text" name="email" placeholder="your email" />
                   </div>
               </td>
           </tr>
           
           
           
            <tr>
               <td><div class="form_label">Major</div></td>
               
               <td><div class="form_label"><input type="text" name="major" placeholder="Your major" /></div></td>
           </tr>
           
           
           <tr>
               <td></td>
               <td> <input type="hidden" name="beck_date" value="" id="beck_date" /></td>
               
           </tr>
           
           <tr>
               <td></td>
               <td> <input type="submit" value="submit homework" class="btn btn-primary"/></td>
               
           </tr>
           
           
           
</table>      

   

</form>


<script>
    date= new Date()
   $('#beck_date').val(date);

</script>