<h1 style="text-align: center;  margin-top:60px;">Build A Habit</h1>

<form enctype="multipart/form-data" method="post" action="<?php echo URL; ?>product/create_product" style="" >
    
    <table style="width:501px; float: left;">
         <!--  <tr>
               <td><div class="form_label">Main picture: </div></td>
               
               <td><input type="file" id="main_picture" name="main_picture" class="btn" /></td>
           </tr>-->
           
           <tr>
               <td>
                   <label class="form_label">Title:</label>
               </td>
               
               <td>
                       <input style="margin-top: 20px;" type="text" name="name" placeholder="Type Title of the Habit" />
                   
               </td>
           </tr>
           <tr>
               <td>
                   <label class="form_label">Abbreviation:</label>
               </td>
               
               <td>
                       <input style="margin-top: 20px;" type="text" maxlength="10" name="abbreviation" placeholder="e.g. NFC" />
                   
               </td>
           </tr>
           
           <tr>
               <td colspan="2"><div class="form_description">
               <label  class="form_label" style="margin-bottom:0px;">Description:</label><br /><textarea name="description" id="description" placeholder="Tell us more..." rows="4" cols="90" style="width:432px; margin-left: 10px;"></textarea>
               </div>
               </td>
               
           </tr>
           
           <tr>
               
               <td>
                   <div class="form_label">For Which Category</div>
                   
               </td>
               
               
               <td>
                      <select id="category" name="category">
                          
                       <option value="fitness">Fitness</option>
                       <option value="diet">Diet</option> 
                       <option value="spirit">Spiritual</option> 
                       <option value="mental">Mental</option> 
                       <option value="porn">Porn Addiction</option> 
                       <option value="skils">Skills</option> 
                      
                       <option value="business">Business</option> 
                        
                       <option value="career">Career</option>
                       <option value="finance">Finance</option> 
                       <option value="investing">Investing</option> 
                       
                       <option value="social">Social</option> 
                       <option value="men">For Men</option> 
                        
                       <option value="women">For Woment</option>
                       <option value="gay">For Gay</option> 
                       <option value="les">For Lesbian</option> 
                       
                       
                       
                           
                        

                    </select>
                   
               </td>
               
               
           </tr>
           
           
           
           <tr>
               <td></td>
               <td>
               <br />
                   <input type="submit" value="submit" class="btn btn-primary" style="display: block;margin: auto;width:170px; height:40px;  color:#fff;  font-size:16px;"/>
               </td>
           </tr>
          
           
           
           
           
       </table>
      
    
   
</form>





