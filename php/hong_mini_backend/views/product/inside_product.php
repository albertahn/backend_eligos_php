<?php 

//see if the upload is in a group

if(!empty ($this->major_has_courses['major_index'])){
    echo'<a style="margin-left: 20px;margin-top: 20px;" href="'.URL.'major/inside_major/'.$this->major_has_courses['major_index'].'" class="btn" >Major for this course</a>';
}

// if admin of group then can edit the upload

$db=new database;
$sth= $db->prepare('SELECT * FROM members_has_group WHERE `group_index`= :group_index AND `members_index`=:my_index');
$sth->execute(array(
           ':group_index'=>$this->group_has_meeting['group_index'],
           ':my_index'=>session::get('index')
));

$has_group=$sth->fetch();

//if user is admin of group or upload can edit
if($has_group['status']=='admin' || $this->member_has_course['status']=='admin'){
    /*
    
    if($this->inside_product['published']==0){
        echo'<a href="'.URL.'stream/publish/'.$this->inside_product['index'].'" style=" background:#003300; text-align:center;"><img style="width:20px; float:right;" src="'.URL.'public/images/publish.png" title="Publish" /></a>';
    }
    else{
        echo'<a href="'.URL.'stream/unpublish/'.$this->inside_product['index'].'" style=" background:#003300; text-align:center;"><img style="width:20px; float:right;" src="'.URL.'public/images/unpublish.png" title="UNpublish" /></a>';
    }
   echo'<a href="'.URL.'product/edit_course_page/'.$this->inside_product['index'].'"><img style="width:20px; float:right;" src="'.URL.'public/images/Pencil.png" title="edit meeting" /></a>';
   // echo '<a href="'.URL.'tickets/make_tickets_page/'.$this->inside_product['index'].'"><img style="width:70px;  float:right;" src="'.URL.'public/images/make_tickets.png" title="Make Tickets" /></a>';
    echo'<a href="'.URL.'product/delete_meeting_page/'.$this->inside_product['index'].'"><img style="width:20px; float:right;" src="'.URL.'public/images/Cross.png" title="Delete" /></a>';
*/

}

 
?>

     <br />
     
     
     <table class="meeting_table" style="width:700px;margin-left: 10px;">
         <tr>
             <th colspan="3" align="left" class="header" style="text-align:center; line-height: 100%; color: #444;">
                  <?php  echo $this->inside_product['name'];

                  ?>
              </th>
              
          <tr>
              <th colspan="3" align="left" class="">
                 
                 <?php
                  //print_r($this->upload_admin);
               echo'<div class="posted_by">Posted By: 
                   
                       <a class="" href="'.URL.'user/user_profile/'.$this->upload_admin[index].'" >'.
                         '<img src="'.URL.'public/uploads/members_pic/'.$this->upload_admin[profile_picture].'" class="small_profile_role_pic"/>';
                            echo '  '.$this->upload_admin[username].
                               
                      '</a>';
                     
                  ?>        
              </th>
          </tr>
         
         <tr>
             <th colspan="3" align="left"  style="font-size:11px; color: grey; text-align: right;">
                 Updated At:<?php echo $this->inside_product['register_date'];?>
             </th>
         </tr>
        <tr>
             <th colspan="3"  style="color: grey; text-align: right;" id="add_delete_button">
                 <?php
   //see if loggedin
                 if(session::get('loggedin')==true){
                     if(!empty($this->member_has_course)){
                         echo'<div class="btn"  onclick="deleteFromMyList('.$this->inside_product['index'].');" >Delete from your habit list</div>';

                     }else{

                         echo'<div class="btn"  onclick="addToMyList('.$this->inside_product['index'].');" >Add to your habit list</div>';

                     }
                 }//end if true
                 
                 
                 ?>
                 
                 
                
             </th>
         </tr>
         
         <tr>
             <td style="text-align: center; font-size: 16px; font-weight: bold;">
                  Current Standing
             </td>
             
             
         </tr>
         <tr>
             
             <td style="text-align: left; font-size: 16px; font-weight: bold;">
                 Days: <?php echo '<span id="total_days">'.$this->member_has_course['day'].'</span>';
                 
                 if(!empty($this->member_has_course)){
                     
                     echo'<span class="btn btn-inverse" style="margin-left:145px; " onclick="addDay('.$this->inside_product['index'].');"><img src="'.URL.'public/images/Add.png" /></span>';
                     echo'<span class="btn btn-inverse"style="margin-left:10px;" onclick="minusDay('.$this->inside_product['index'].');"><img src="'.URL.'public/images/Remove.png" /></span>';
                 }
                 
                 ?>   
                 
             </td>
            
         </tr>
         
         <tr>
             
             <td style="text-align: left; font-size: 16px; font-weight: bold; border-top: solid 1px #aaa;">
                 Success: <?php echo '<span id="total_success">'.$this->member_has_course['success'].'</span>'; 
                 
                 if(!empty($this->member_has_course)){
                     
                     echo'<span class="btn btn-inverse" style="margin-left:120px;" onclick="addSuccess('.$this->inside_product['index'].');"><img src="'.URL.'public/images/Add.png" /></span>';
                     echo'<span class="btn btn-inverse" style="margin-left:10px;"  onclick="minusSuccess('.$this->inside_product['index'].');"><img src="'.URL.'public/images/Remove.png" /></span>';
                 }
                 ?>
                 
             </td>
            
         </tr>
     </table>
    
    
    <table style="width:100%; float: left;">
           
           <tr>
               <td>
                   <div class="form_description">
               <label  class="form_label" style="margin-bottom:0px;">Description:</label><br />
               
                <?php   $descrip = str_replace('\r\n','<br />', $this->inside_product[description]);
             $clean = str_replace('\"','"', $descrip);
             echo $clean;
             ?>
               </div>
               </td>
               
           </tr>
           
           
           </table>
     
   <ul class="nav nav-tabs" id="habitTab">
       <li class="active"><a href="#comments">Wall</a></li>
       <li><a href="#people">People</a></li>
       <li><a href="#uploads">Uploads</a></li>
       
    </ul> 
      
           <div class="tab-content">

                <div class="tab-pane active" id="comments">

                    
                <?php
 //***********************************************facebook chat---------------------
 //echo'<div class="fb-comments" data-href="'.URL.'product/inside_product/'.$this->inside_product['index'].'" data-num-posts="30" data-width="700"></div>';
 $logged = session::get('loggedin');
 
 $my_index=session::get('index');
 
 if(empty($my_index)){
     
     $my_index = cookie::get('index');
     
    
 }
 
 if(empty($my_index)){
     $my_index=0;
 }
 
echo' <script>

    
$(document).ready(function (){

                var myIndex='.$my_index.';
                            
                        memoryComments('.$this->inside_product['index'].','.$my_index.');
                            
                                
});




</script>
 ';

echo '<div class="span12">';

echo'<p style="margin-top:30px;">Comments</p>';
 if($logged==true){
     echo '<input type="text" style="width: 850px;" placeholder="write something..." id="commentOnMeeting" /> 
           <span onclick="submitComment('.$this->inside_product['index'].')" class="btn btn-primary" style="">submit</span>';
     
 }else{
     
     echo '<input type="text" style="width:850px;" placeholder="write something..." id="fakecommentOnMeeting" /> 
            <a onclick="alert(\'please log in to comment\');" class="btn btn-primary" style="">submit</a>';
 }
 //all the comments
 
 echo'<div id="commentList" style="clear: both;"></div>';
 echo'</div>'; //end span12
 
 
 ?>     
                    
                    
                    
                    
                    
               </div>  

                <div class="tab-pane" id="people">
                    
                    <table class="table table-hover">
                        
                        
                        <tr> 
                               <th>
                                 <span style="text-align: center; width:100%;">People On This Habit</span>
                               </th>
                               <th>Days</th>
                               <th>Successes</th>
                         </tr>  
                           <?php 
                         foreach($this->view_member_has_habit as $key2 => $value2){
                             echo'<tr> 
                                          <td>';
                                            echo '<a href="'.URL.'user/user_profile/'.$value2['members_index'].'">';
                                            echo '<img src="'.URL.'public/uploads/members_pic/'.$value2['profile_picture'].'" style="width:50px; float:left; height:50px;"/>';
                                             echo '<span style="font-size: 15px; margin-left:20px;">'.$value2['members_username'].'</span>';
                                            echo'</a>';

                                    echo' </td>';
                           
                                  echo'<td>'.$value2['day'].'</td>';  
                                     echo'<td>'.$value2['success'].'</td>';  
                                    
                                    
                             echo' </tr>  ';
                         }
                        ?>
                    </table>
               </div>  <!--end people-->
               
               <div class="tab-pane" id="uploads">
                  <?php
                   if(!empty($this->member_has_course)){
                       
                       echo'<a class="btn btn-primary" href="'.URL.'file/course_upload_page/'.$this->inside_product['index'].'"><img src="'.URL.'public/images/Add.png" />Upload</a>';
                   }
                   
                   //show all the 
                   
                  ?> 
                   
                   <table class="table table-hover">
                       <tr>

                           <th>File Name</th>
                           <th>Description</th>
                           <th>Uploaded by</th>
                           <th>Download</th>
                           <th></th>
                       </tr>
                       <?php
                       
                       foreach($this->uploaded_files as $kk=>$vv){
                           echo'<tr id="file'.$vv['index'].'">';
                           
                                                  echo'<th>'.$vv['file_name'].'</th>';
                                                  echo'<th>'.$vv['description'].'</th>';
                                                  echo'<th><a href="'.URL.'user/user_profile/'.$vv['members_index'].'">Profile</a></th>';
                           echo'<th><a class="btn" href="'.URL.'file/download_product_file/'.$vv['file_name'].'">Download</a></th>';
                          echo'<th>';// check if its the uploader
                           if($vv['members_index']==session::get('index')){
                               echo'<img onclick="deleteFile('.$vv['index'].',\''.$vv['file_name'].'\','.$this->inside_product['index'].');" alt="delete" style="cursor:pointer;" src="'.URL.'public/images/Cross.png" />';
                               
                           }
                           
                          echo'</th>'; 
                           echo'</tr>';
                           
                       }
                       
                          
                       ?>
                   </table>
               </div> <!-- end uploads-->

           </div>
  

 

 
                                

<script>
             
 $('#habitTab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
})
        
     
 </script>
                      