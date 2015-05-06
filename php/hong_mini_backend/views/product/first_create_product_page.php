<h1 style="text-align: center;  margin-top:60px;">Build A Habit</h1>
<div class="progress">
<div class="bar" style="width: 70%;">70% Completed</div>
</div>
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
                   <input onclick="doneFirstTime();" type="submit" value="submit" class="btn btn-primary" style="display: block;margin: auto;width:170px; height:40px;  color:#fff;  font-size:16px;"/>
               </td>
           </tr>
          
           
           
           
           
       </table>
      
    
   
</form>



<div id="another_persons">
    
<h3>Or Join One From Another Person</h3>

<div id="people_example"> 
  
                
            <?php
            
              $db= new database();

       $sth = $db->prepare('SELECT * FROM `bp_examples_view`  ORDER BY `has_course_index` DESC LIMIT 0,20');
        $sth->execute();
        
       $bp_examples= $sth->fetchAll();

                 
 //create a array of unique member indexes            
       
            
   
  //for each unique example get data of the tables , we got the bp_examples
            $person_unique = array();
        
        foreach($bp_examples as $key=>$value){
            
            $person_unique[$key]=$value['members_index'];
        }
        
        $person_unique=array_unique($person_unique);
        
      //  print_r($person_unique);
           
       foreach($person_unique as $key=>$value){
           
           
    //make sure to input data within the cluster       
           echo'<div class="item" id="example'.$key.'">
                <div class="cluster" style="height: 100px;">';
           
           //echo the table and if the $this->bp_examples['member_index']==$value : 
           echo '<a class="btn" onclick="doneFirstTime();" style="width: 350px;" href="'.URL.'product/inside_product/'.$bp_examples[$key]['course_index'].'">
               <div style="float: left;width: 60px;height:90px;overflow: hidden;" /> 
               <img src="'.URL.'public/uploads/members_pic/'.$bp_examples[$key]['profile_picture'].'" style="border-radius:10px;height:70px; width:70px; "/>
                   <span style="float:left;padding:5px;">'.$bp_examples[$key]['members_username'].'</span>
                       </div>';
                  
           
                          
                                
                                   if($bp_examples[$key]['members_index']==$value){
                                      
                                    echo '<div class="courseName">'.$bp_examples[$key]['course_name'].'</div>';
                                     echo '<div class="successDays">'.$bp_examples[$key]['day'].' days, '.$bp_examples[$key]['success'].'  successes</div></a>';
                                    

                                   } //end when fall
                           
                           
                       
                   

           
           echo'</div>'; //end cluster
            echo'</div>'; // end item
           
       }
       
                    
                    
            
            ?>
                
                     
  <!-- Carousel nav -->
  
	
</div>

</div>

<script>
$( document ).ready(function() {
    
    

doneFirstTime();

});
</script>



