<h1 style="text-align:center; margin-top: 70px;">Upload File</h1>

<form enctype="multipart/form-data" method="post" action="<?php echo URL?>file/upload_course_file">

<table>
           <tr>
               <td><div class="form_label">Upload file: </div></td>
               
               <td><input type="file" id="upload_file" name="upload_file" class="btn" /><span style="font-size:10px;">(zip, rar, word doc or pdf less than 20MB)</span></td>
           </tr>
           
           <tr>
               <td>
                   <div class="form_label">Description:</div>
               </td>
               
               <td><div class="form_label">
                       <textarea name="description" id="description" placeholder="Tell us more..." rows="4" cols="90" style="width:432px; margin-left: 10px;margin-top: 10px;"></textarea>
                   </div>
               </td>
           </tr>
           
           
           <tr>
               <td> <input type="hidden" name="course_index" value="<?php echo $this->course_index; ?>" /></td>
               
               
           </tr>
           
           <tr>
               <td></td>
               <td> <input type="submit" value="Upload" class="btn btn-primary"/></td>
               
           </tr>
           
           
           
</table>      

   

</form>


<script>
    date= new Date()
   $('#beck_date').val(date);

</script>