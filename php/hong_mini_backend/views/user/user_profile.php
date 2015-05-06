<div id="slider_example_map">
    
    <?php
     $user_unique = array();
        
        foreach($this->bp_examples as $key=>$value){
            
            $user_unique[$key]=$value['members_index'];
         }
         
            $user_unique = array_unique($user_unique);
            
            
    
    ?>
    
    <h1 style="text-align: center;">Examples</h1>
  
    <div id="myCarousel" class="carousel slide" style="margin-top: 50px;" data-interval="3000">
  
  <!-- Carousel items -->
  <div class="carousel-inner">
        
                
            <?php
          
                 
 //create a array of unique member indexes            
       
            
   
  //for each unique example get data of the tables , we got the bp_examples
            $ex_has_semester = array();
            
       foreach($user_unique as $key=>$value){
           
           
           $this ->db = new database();
           $sth1 = $this->db->prepare('SELECT * FROM `has_semester` WHERE `members_index`=:id');
           $sth1->execute(array(':id'=>$value));
         
           $ex_has_semester= $sth1->fetchAll();
           
          
           
    //make sure to input data within the cluster       
           echo'<div class="item" id="example'.$key.'">
                <div class="cluster">';
           
           //echo the table and if the $this->bp_examples['member_index']==$value : 
           echo '<a href="'.URL.'user/user_profile/'.$value.'" style="position:absolute; left: 0px;top: 0px;" /> 
               <img src="'.URL.'public/uploads/members_pic/'.$this->bp_examples[$key]['profile_picture'].'" style="height:50px; width:50px; "/>'
                .$this->bp_examples[$key]['members_username'].'</a>';
                    //tables!!!!!!!!!!!!
           
                      for($k=0;$k<12; $k++){
                          
                                 $t=$k+1;
                                   if($this->bp_examples[$key]['members_index']==$value){
                                        
                                       //first when fall 
                                       echo '<table id="example_table'.$k.'" class="semester1 table table-hover" style="font-size:12px;width: 58px; float:left; margin-top:60px;">';
                                                //header
                                                echo'<tr><th style="font-size:10px;">'. $t.'</th></tr>';
                                       //if fall then make table 
                                       foreach($this->bp_examples as $key2=>$value2){
                                           

                                           if($value2['members_index']==$value && $value2['year']==$k && $value2['blueprint_insert']==1){


                                              echo '<tr><td><a href="'.URL.'product/inside_product/'.$value2['course_index'].'">'.$value2['abbreviation'].'</a></td></tr>';
                                           }

                                       }


                                       echo '</table>';

                                    

                                   } //end when fall
                           
                           
                       }
                   

           
           echo'</div>'; //end cluster
            echo'</div>'; // end item
           
       }
       
                    
                    
            
            ?>
                
                     
  </div>  <!--end carosel inner-->
  <!-- Carousel nav -->
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>   <!--end myCarousel -->
	
</div><!--end myCarousel-->	

<div id="user_blueprint_profile"><!--wraps rest of everything here-->
    
<?php 
         $this ->db = new database();
         $sth = $this->db->prepare('SELECT * FROM `friends` 
         WHERE `my_index`=:id  AND `friend_index`=:friend_index');
         $sth->execute(array(
             ':id'=>session::get('index'),
            
             ':friend_index'=>$this->user_profile['index']
            
        ));
         
$friend_info= $sth->fetch();
$count= $sth->rowCount();
//echo session::get('index');
//echo $count;
 

 if($friend_info['status']==accepted){
     echo '<p style="float:right;">
         <a class="btn" href="'.URL.'friend/delete_friend/'.$this->user_profile['index'].'">
        Remove friend</a>
        </p>';

        
 }
 else{
     if($this->user_profile['index'] != session::get('index') && $friend_info['my_index'] !=session::get('index'))
         {
       
      echo '<p class="friend_status" style="float:right;">
          
    <a class="btn btn-primary" href="#" onclick="return false" onmousedown="javascript:addFriend('.$this->user_profile['index'].');">
        Add friend</a></p>';
      }
       else
           {
           //see whether it's pending or not
           if($friend_info['status']==pending){
               
               echo '<p class="friend_status" style=" width: 180px; "><a href="#" class="btn btn-primary">friend request pending</a></p>';
           }
           else if($friend_info['status']==rejected){
               
               echo '<p class="friend_status" style=" width: 180px; "><a href="#" class="btn btn-primary">User has rejected you...</a></p>';
               
           }
           
               
               
           
           
       }
 }
 
 //the mentor add button
 
 echo'<div class="btn-group" style="float:right;">';
 
 //check if added before
 /*
 $this ->db = new database();
     $sthho = $this->db->prepare('SELECT * FROM `mentorship` 
         WHERE `mentor_index` =:mentor_index AND `student_index`=:student_index ');
        $sthho->execute(array(
            ':mentor_index'=> $user_id,
            ':student_index'=>session::get('index')
        ));
        
       $mentorship= $sth->fetch();
            print_r( $mentorship);
        $count = $sth->rowCount();
        
        if($count>0){
            
             echo'<span style=" margin-right:10px;" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><span id="mentor_b_text">'.$mentorship['category'].'</span> <span class="caret"></span></span>';
            
        }else{*/
            
             echo'<span style=" margin-right:10px;" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><span id="mentor_b_text">Follow As Mentor</span> <span class="caret"></span></span>';
            
       // }
 
 

 
 ?>
   <!--drop down for mentorship-->
     <ul class="dropdown-menu" style="float:right;">
                      
                      <li class="disabled"> <a tabindex="-1" href="#" style="color:#12d4c5;">Health</a></li>
                            
                                    <li> <a href="" onclick="return false;" onmousedown="add_mentor(<?php echo $this->user_profile['index'];?>, 'fitness');">Fitness</a></li> 
                                     <li> <a href="" onclick="return false;" onmousedown="add_mentor(<?php echo $this->user_profile['index'];?>, 'diet');">Diet</a></li>
                                     <li> <a href="" onclick="return false;" onmousedown="add_mentor(<?php echo $this->user_profile['index'];?>, 'spiritual');">Spiritual</a></li>
                                     <li> <a href="" onclick="return false;" onmousedown="add_mentor(<?php echo $this->user_profile['index'];?>, 'mental');">Mental</a></li>
                                      <li> <a href="" onclick="return false;" onmousedown="add_mentor(<?php echo $this->user_profile['index'];?>, 'addiction');">Addiction</a></li>
                                      
                           
                         
                         
                          <li style="margin:0px;" class="divider"></li>
                         <li class="disabled"> <a tabindex="-1" href="#" style="color:#12d4c5;">Wealth</a></li>
                              
                                    <li> <a href="" onclick="return false;" onmousedown="add_mentor(<?php echo $this->user_profile['index'];?>, 'skills');">Skills</a></li> 
                                     <li> <a href="" onclick="return false;" onmousedown="add_mentor(<?php echo $this->user_profile['index'];?>, 'business');">business</a></li>
                                    <li> <a href="" onclick="return false;" onmousedown="add_mentor(<?php echo $this->user_profile['index'];?>, 'career');">Career</a></li>
                                    <li> <a href="" onclick="return false;" onmousedown="add_mentor(<?php echo $this->user_profile['index'];?>, 'finance');">Finance</a></li>
                                   <li> <a href="" onclick="return false;" onmousedown="add_mentor(<?php echo $this->user_profile['index'];?>, 'investing');">Investing</a></li>
                               
                         
                         
                        <li style="margin:0px;" class="divider"></li>
                         <li class="disabled"><a tabindex="-1" href="#" style="color:#12d4c5;">Relationships</a></li> 
                         
                         
                                   <li> <a href="" onclick="return false;" onmousedown="add_mentor(<?php echo $this->user_profile['index'];?>, 'social');">Social</a></li>
                                    <li> <a href="" onclick="return false;" onmousedown="add_mentor(<?php echo $this->user_profile['index'];?>, 'men');">For Men</a></li> 
                                     <li> <a href="" onclick="return false;" onmousedown="add_mentor(<?php echo $this->user_profile['index'];?>, 'women');">For Women</a></li>
                                     <li> <a href="" onclick="return false;" onmousedown="add_mentor(<?php echo $this->user_profile['index'];?>, 'gay');">For Gay</a></li>
                                    <li> <a href="" onclick="return false;" onmousedown="add_mentor(<?php echo $this->user_profile['index'];?>, 'les');">For Lesbian</a></li>
                                 
                           
                         <li style="margin:0px;" class="divider"></li>
                         <li>
                             <a href="mailto:contendera@gmail.com" target="_blank">Suggest Category</a>
                             
                         </li>
                  </ul>
</div>
    <?php
 //whose profile
 
 if($this->user_profile['index']==session::get('index')){
      echo '<h1 style="text-align:center; margin-top: 70px;">Your Profile</h1>';
 }else{
     
      echo '<h1 style="text-align:center; margin-top: 70px;">'.$this->user_profile['username'].'\'s Profile</h1>';
 }
 
    
    echo'          
        <div class="white_container" class="friend_profile" id="'.$this->user_profile['index'].'">
    
	       <div id="suggested_drop_click" class="right_suggested" style="padding-top:6px; text-align:right;">
                        <a class="btn" href="#" onclick="return false"  onmousedown="openExampleMap()" style="margin-top: 8px;
margin-right: 100px; color:#000; text-decoration:none;">Show suggestions
                        <img src="'.URL.'public/images/downbro.png" style="width: 16px;" />
                         </a>
                </div> <!--end suggested_drop_click-->
                
             <div class="major_box" style="height:60px; width: 700px; overflow: hidden;"> ';
    
    if($this->user_profile['index'] == session::get('index')){
                                           echo '
                                            <a href="#" onclick="editMajor();">
                                                  <img src="'.URL.'public/images/icons/187-pencil.png" style="width: 12px; margin-bottom:5px;" />
                                            </a>
                                            ';  
                                         }
                                         echo' <b>Groups:</b>';
     foreach($this->user_majors as $key=>$value){
         
         
         

                                               echo '<a href="'.URL.'major/inside_major/'.$value['index'].'">  '.$value['name'].'</a>     ';
                                           }

                                         
    
    
    
    
      
                                          

                                       
echo'</div>'; //end major_box
        
      
        ?>
    
<div style="margin-top: 40px; font-size: 12px;">
    <!--the changer of the semester-->
   
   
    <h3 style="text-align:center;">Habits For Each Month Of The Year</h3> 
    
    
       <?php
  //user table for 12 months
       
       for($i=0;$i<12; $i++ ){
           $k=$i+1;
         
           echo'
              
<table id="year'.$i.'" class="semester1 table table-hover" style="width: 68px; float:left;">
                <tr>
	           <th style="height: 29px;">'.$k;
                 echo'</th>
	       </tr>
               ';
       if($this->user_profile['index']==session::get('index')){
          echo'
             <tr>
                    <th style="font-weight:normal;">
                        <a href="" onclick="return false;" onmousedown="insertBlueprint('.$i.');"><img src="'.URL.'public/images/white_b_cross.png">Habit</a>
                    </th>
              </tr>';
          
       }
          echo'
                
   </table>';
           
       }
       
       ?>
  
         
       
</div>


    
</div> <!--end white container-->
<!--user calander javascript-->

<script>
    //this time just add hasSemester
    
    var hasSemester= <?php echo json_encode($this->has_semester);?>;
    
    for(k in hasSemester){
        
        //replace the select with
        //alert(hasSemester[k]['season']);
        
        
        var firstCap = capitaliseFirstLetter(hasSemester[k]['season']);
        
        $('#'+hasSemester[k]['table']+hasSemester[k]['season']).html(firstCap+' '+hasSemester[k]['year']);
        
        
    }
  
    
    //add blueprint courses
    var blueprintCourses= <?php echo json_encode($this->blueprint_courses);?>;
    var myUserIndex= <?php echo session::get('index');?>;
    var profileUserIndex= <?php echo $this->user_profile['index'];?>;
    
    var years = new Array(0,1,2,3,4,5,6,7,8,9,10,11);
       
     for(y in blueprintCourses){
       for(x in years){
           
           if(years[x]==blueprintCourses[y]['year']){
               
             $('#year'+years[x]).append('<tr><th id="course'+blueprintCourses[y]["course_index"]+'"><a class="classbp_inserted" href="'+URL+'product/inside_product/'+blueprintCourses[y]['course_index']+'">'
                 +blueprintCourses[y]['abbreviation']+'</a></th><tr>');
           
                if(myUserIndex==profileUserIndex){
                    $('#course'+blueprintCourses[y]["course_index"]).append('<img onclick="takeoutBlueprint('+blueprintCourses[y]["course_index"]+');" style="width:7px; cursor:pointer;" src="'+URL+'public/images/Cross.png" alt="Delete course" title="Delete course" />');
                    }
            // alert('blu cours '+blueprintCourses[y]['year']+' in year'+years[x]);
           }
           
           
           
            
        }//end for y   
      }



</script>


<!-- end blueprint -->
<div class="divider_wood"> <!--all habits-->
    <table class="table table-hover">
        <tr>
            <th>Habit</th><th>Days</th><th>Successes</th>
        </tr>
    <?php  
    echo'';
              
    
     //print_r($this->all_habits);
      echo'';
      foreach ($this->all_habits as $keys => $values) {
          
          echo'<tr>
                 <td><a href="'.URL.'product/inside_product/'.$values['course_index'].'">'.$values['course_name'].'</a></td>';
                    echo'<td>'.$values['day'].'</td>';
                   echo'<td>'.$values['success'].'</td>
               </tr>';
      }
    
    ?>
    
  </table>  
</div><!--end wood-->


<!-- ~~~~~~~~~~~~~Comments Area~~~~~~~~~~~~ -->

<div class="" style="background: #ffffff url('/public/images/linedpaper.png'); margin-top: 10px;">
  
    <?php

echo '<p style="margin-top:30px;">Comments</p>';
 if(session::get('loggedin')==true){
     
     
     echo '<input type="text" style="width:860px; margin-left:10px;" placeholder="Write something..." id="commentOnProfile" /> 
           <a href="" onclick="return false" onmousedown="submitProfileComment('.$this->user_profile['index'].')" class="btn" style="margin-bottom:9px;">submit</a>';
     
 }else{
     
     echo '<input type="text" style="width:800px;" placeholder="write something..." id="fakecommentOnMeeting" /> 
            <a onclick="alert(\'please log in to comment\');" class="btn" style="">submit</a>';
 }
 //all the comments
 
 echo'<div id="commentList"></div>';
?>
</div> <!--end requirements-->

<!--schedule table-->


<?php

//set the arrays for the modals
echo '
<script>
   majorArray= '.json_encode($this->user_majors).'
            allMajorArray= '.json_encode($this->all_majors).'
   
 var userMajorCourses= '.json_encode($this->major_courses).'
var userCourses = '.json_encode($this->user_courses).'


</script>    

';

 $my_index=session::get('index');
 
 if(empty($my_index)){
     $my_index=0;
 }
 

?>


<script>
    //doc ready function
    
$(document).ready(function (){
    
   
    //the example0 active
    
    $('#example0').attr('class','item active');
    
//change left side for users
   
  changeLeftSide('+<?php echo $this->user_profile['index'];?>+');
       
       
       
 //shoe comments
 
       var myIndex=<?php echo $my_index;?>;
       showWallPosts('<?php echo $this->user_profile['index'];?>',myIndex);


       
//also set up the major change thing

  var currentCamDialog= $('.cam_dialog_pop').html();
                
               
                
    var currentCamDialog = $(
'<div class="cam_dialog_pop">'

+'<form action="'+URL+'major/remove_my_major" method="post" style="float:left;width:200px">'
	+'<span> Your Majors</span>'
            +' <div id="my_majors_selected" class="span12" style="height:180px; width:200px; float:left;overflow: scroll;">'
        +' </div>'
    
        +'<input type="submit" value="remove" style="margin-left: 20px;float: left;" />'
	+'</form>' 
    
    +' <span style="float:right;"> other majors</span>' 

    +'<form action="'+URL+'major/reg_my_major"  method="post" style="">'
	 +' <div id="all_major_select" class="span12" style="height:180px; width:200px; float:right;overflow: scroll;">'
        +'  </div>'
     +'<input type="submit" value="Add" style="margin-right:20px; float:right;" />'
	+'</form>'  
        +'</div>').dialog({     modal:true,
                                autoOpen: false,
                                open: function(event, ui) { $(".ui-dialog-titlebar-close", ui.dialog || ui).hide(); },
				title: 'Edit your major',
                                width: 500,
                                buttons: { 'Cancel': function() {
                                                            $(this).dialog("close"); 
                                                          }
                                                          
                                          }
			});
 
    $(".ui-dialog-titlebar").hide();
    
    
    //put the majors in
    
      for(x in majorArray){
          
        $("#my_majors_selected").append('<input type="checkbox" name="major'+majorArray[x]['index']+'" value="'+majorArray[x]['index']+'"/>'+majorArray[x]['name']+'<br />');
        //alert(majorArray[x]['name']);
    }
    
    for(x in allMajorArray){
        
       $("#all_major_select").append('<input type="checkbox" name="major'+allMajorArray[x]['index']+'" value="'+allMajorArray[x]['index']+'"/>'+allMajorArray[x]['name']+'<br />');
        
    }
    
    

       
});
</script>

<script>

//now set the dialog for inserting blueprint
    
   
 var blueprintInsertDialog = $('.blueprint_insert_dialog').html();
                
              
//courses dialog

var blueprintInsertDialog = $('<div class="blueprint_insert_dialog" style="text-align: center;">'
  
  +'<a href="'+URL+'product/create_product_page" class="btn btn-warning" style="float:right;"><img src="'+URL+'public/images/Plus.png" />  Create A Habit</a>'

  +'<form method="post" action="'+URL+'search/search_all" >'
                            
                           +'<input style="border-radius:10px;" onclick="alert("hi");" id="searchCourseAuto" placeholder=" Search Course" type="text" name="search"/>'
                             +'<input  type="image" src="'+URL+'public/images/MagGlass.png" style="border-radius: 10px;top: 7px;width: 20px;right: 10px;" />'
                             +'</form>'
    //tbas                     
         +'<ul class="nav nav-tabs" id="myBPTab">'
    +  '<li class="active"><a href="#allCourses">All Of Your Habits</a></li>'
    +  '<li><a href="#major">Group Habits</a></li>'


+'</ul>'
 
+'<div class="tab-content">'

+'<div class="tab-pane active" id="allCourses">' //all of your courses

+'<form id="blueprint_insert_form" action="'+URL+'schedule/input_blueprint" method="post" style="float:left;">'  
	 +' <div id="all_my_courses" class="span12" style="height:250px; width:670px; overflow: scroll;">'
        +'<p style="background: #aaa;">Your Habits</p>' 
            +'  </div>'
    +'<input type="hidden" name="count_checked" id="count_checked_all" value="" />'    
     +'<input type="submit" class="btn btn-primary" value="Submit" style="width: 100px;margin-top: 20px;margin-right:20px; float:right; clear:both;" />'
      
+'</form>'

    +'</div>' //end all courses


+  '<div class="tab-pane" id="major">'
        // major classes 
        +'<form id="major_blueprint_insert_form" action="'+URL+'schedule/input_blueprint" method="post" style="float:left;">'  



	
      +' <div id="my_major_courses" class="span12" style="height:250px; width:670px; overflow:scroll;">'
       +'<p style="background: #aaa;">Your Group Habits</p>'
      +'</div>' //end my major courses
       
   +'<input type="hidden" name="count_checked" id="count_checked_major" value="" />'    
     +'<input type="submit" class="btn btn-primary" value="Submit" style="width: 100px;margin-top: 20px;margin-right:20px; float:right; clear:both;" />'

+'</form>' 
    
        
            +'</div>' //end major


+'</div>'
             
    //tbas end   
    

       

	+'</div>'
	    ).dialog({
                                modal:true,
				autoOpen: false,
				 width: 750,
                                buttons: { 'Cancel': function() {
                                                            $(this).dialog("close"); 
                                                          }
                                          }
			});
                        
                       
                       // $(".blueprint_insert_dialog").button();
                   
$(".ui-dialog-titlebar").hide();

//console.log(userMajorCourses);
for(k in userMajorCourses){
    $("#my_major_courses").append("<input onclick='countCheckedInsertMajor();' type='checkbox' name='class_input' value='"+userMajorCourses[k]['index']+"'/>"+userMajorCourses[k]['abbreviation']+"    "+userMajorCourses[k]['name']+"<br />");
      //  $("#my_major_courses").append('<input type="checkbox" name="major'+userMajorCourses[0]+'" value="'+majorArray[index]+'"/>'+majorArray["name"]+'<br />');
        //alert(userMajorCourses[x]['name']);
      //  console.log(userMajorCourses);
    
      }
    
    for(k in userCourses){
       
       $("#all_my_courses").append("<input onclick='countCheckedInsertAll();' type='checkbox' name='class_input"+k+"' value='"+userCourses[k]['index']+"'/>"+userCourses[k]['name']+"<br />");
       // console.log(userCourses);
    }
    

</script>

</div> <!--user_blueprint_profile end-->

<!--dialog of select major-->
<div class="cam_dialog_pop">
  
       </div>

<div class="blueprint_insert_dialog"></div>

<div class="req_blueprint_insert_dialog"></div>



 
<script>
  
  //tab click function for inserting blueprint
$('#myBPTab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
})


//major requirement tab

$('#major_req_tab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
  
})
 
 $('#major_req_tab a:first').tab('show');
</script>



