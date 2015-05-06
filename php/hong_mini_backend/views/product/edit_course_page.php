<h1 style="text-align: center;">Edit Course</h1>

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
                       <input style="margin-top: 20px;" type="text" value="<?php echo $this->edit_course_page['name']?>" name="name" placeholder="Type Title of the Course" />
                   
               </td>
           </tr>
           
           <tr>
               <td colspan="2"><div class="form_description">
               <label  class="form_label" style="margin-bottom:0px;">Description:</label><br />
               <textarea name="description" id="description" placeholder="Tell us more..." rows="4" cols="90" style="width:432px; margin-left: 10px;
              "><?php   $descrip = str_replace('\r\n','<br />', $this->edit_course_page[description]);
             $clean = str_replace('\"','"', $descrip);
             echo $clean;
             ?>
               </textarea>
               </div>
               </td>
               
           </tr>
           
           <tr>
               
               <td>
                   <div class="form_label">Is it a Major Course?</div>
                   
               </td>
               
               
               <td>
                   <?php
                   //check if the major is selected or not
                   if(!empty ($this->major_has_courses)){
                           
                       echo ' <select id="is_major" name="is_major"><!--onChange="showMajorSelect();"-->
                                     <option id="is_major_true" value="true" selected="selected">Yes</option>
                                     <option id="is_major_false" value="false">No</option>  

                             </select> ';
                   }else{
                        echo ' 
                            <select id="is_major" name="is_major"><!--onChange="showMajorSelect();"-->
                                 <option id="is_major_true" value="true">Yes</option>
                                 <option id="is_major_false" value="false" selected="selected">No</option>  

                            </select> ';
                       
                   }
                   
                   ?>
                   
               </td>
               
           </tr>
           
           <tr style="" id="upload_major_select">
               <td><div class="form_label">For Which Major?</div></td>
               
               <td><select id="major_index" name="major_index">
                                    <option value="not_choose">Select a Major</option>
                           
                                    <?php

                            foreach($this->all_majors as $key => $value) {

                                echo '<option value="'.$value['index'].'">'.$value['name'].'</option>';
                                }

                            ?>


                                </select>
               </td>
           </tr>
           
           <tr>
               <td>
                   <div class="form_label">Semester:</div>
                   
               </td>
               
               <td>

                        <select id="season" name="season">
                             <option value="fall" id="season_fall">Fall</option>
                             <option value="spring" id="season_spring">Spring</option>
                             <option value="summer" id="season_summer">Summer</option> 
                        </select>
                   
               </td>
               
           </tr>
           
           <tr>
               <td>
                   <div class="form_label">Year:</div>
                   
               </td>
               
               <td>

                       <select name="year" id="year" />
                       
                                
                                 <option value="2010">2010</option>
                                  <option value="2011">2011</option>
                                   <option value="2012">2012</option>
                                   <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    
                                   
                       </select>
                   
               </td>
               
           </tr>
           
           <tr><td><div class="form_label">CCN: </div></td>
               <td><input type="text" name="CCN" placeholder="Type CCN"/></td>
           </tr>
           <tr><td><div class="form_label">Units: </div></td>
               <td><input type="text" name="units" placeholder="Type Number of Units"/></td>
           </tr>
           
           <tr><td><div class="form_label">Prerequisites:</div></td>
               <td><input type="text" name="prerequisites" placeholder="Type Prerequisites for this Class"/></td>
           </tr>
           
           <tr><td><div class="form_label">Instructor: </div></td>
               <td> <input type="text" name="instructor" placeholder="Last Name, First Name "/></td>
           </tr>
           
           <tr><td><div class="form_label">Is it Required to Graduate?</div></td>
               <td>
                    <select id="category" name="category">
                        <option value="is_required">Yes</option>   
                        <option value="not_required">No</option>  
                         
                         

                    </select></td>
           </tr>
           
           
           <tr>
               <td><div class="form_label">Class Homepage:</div></td>
               <td><input type="text" name="homepage" placeholder="Type in your Class Homepage" /></td>
               
           </tr>
           
           <tr>
               <td>
                   <div class="form_label">Location</div>
               </td>
               
               <td>
                       <input type="text" name="location" placeholder="Where is the Class?" />
                   
               </td>
           </tr>
     
           <tr>
             
               <td colspan="2">
                  
               </td>
             
           </tr>
           
           
           
           
       </table>
       
    <div id="map_cluster">
      <div class="form_label">Show on Map
                   </div> 
                   <p style="margin-left:10px;">(click on map or drag icon)</p>
                   <input type="hidden" name="geo_lat" id="geo_lat" />
                   <input type="hidden" name="geo_lng" id="geo_lng" />
               
               
                   <div id="map" style=" margin: 10px; width: 400px; height: 300px;"></div>
                    <label>&nbsp;</label><input type="submit" value="submit" class="btn btn-primary" style="display: block;margin: auto;width:170px; height:40px;  color:#fff;  font-size:16px;"/>
    </div><!--end map_cluster-->
   
    <!--main picture-->    
    <br />
    
    
   
    
        
    
    
    
</form>

<script>
    
    $(document).ready(function(){
       
         initializeMap(37.871686, -122.25740);
       
        $('#search').bind('click',function(){
            initialize($('#search_place').val());    
        });
    });
    
//selected options
$('#<?php echo $this->edit_course_page['category']; ?>').attr('selected','selected');
    
$("#season_<?php echo $this->edit_course_page['season']?>").attr('selected','selected'); 
    
    </script>
    
    
<?php echo $this->edit_course_page['season']?>






<!--old stuff--> 


<script>
    
    $(document).ready(function(){
     
     //get the seleced category   
        $('#<?php echo $this->edit_meeting_page['category']; ?>').attr('selected','selected');
     //get the selected  
      $('#privacy_<?php echo $this->edit_meeting_page['privacy']; ?>').attr('selected','selected');
  
        $('#search').bind('click',function(){
            initialize($('#search_place').val());    
        });
    });
    
    
    </script>



