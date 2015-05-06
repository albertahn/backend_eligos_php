<div id="slider_example_map">
    
    <?php
     $user_unique = array();
        
        foreach($this->bp_examples as $key=>$value){
            
            $user_unique[$key]=$value['members_index'];
         }
         
            $user_unique = array_unique($user_unique);
            
            
    
    ?>
    
    <h1 style="text-align: center;">Examples</h1>
  
    <div id="myCarousel" class="carousel slide" style="margin-top: 50px;">
  
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
           
                      for($k=0;$k<4; $k++){
                          
                                 
                                   if($this->bp_examples[$key]['members_index']==$value){
                                        
                                       //first when fall 
                                       echo '<table id="example_table'.$k.'fall" class="semester1 table table-hover" style="font-size:12px;width: 58px; float:left; margin-top:60px;">';
                                                //header
                                                echo'<tr><th style="font-size:10px;">Fall '.$ex_has_semester[$k]['year'].'</th></tr>';
                                       //if fall then make table 
                                       foreach($this->bp_examples as $key2=>$value2){
                                           

                                           if($value2['members_index']==$value && $value2['season']=='fall' && $value2['year']==$k && $value2['blueprint_insert']==1){


                                              echo '<tr><td><a href="'.URL.'product/inside_product/'.$value2['course_index'].'">'.$value2['abbreviation'].'</a></td></tr>';
                                           }

                                       }


                                       echo '</table>';

                                     //second when spring
                                       
                                       echo '<table id="example_table'.$k.'spring" class="semester1 table table-hover" style="font-size:12px;width: 68px; float:left;margin-top:60px;">';
                                                //header
                                                echo'<tr><th style="font-size:10px;">Spring '.$ex_has_semester[$k]['year'].'</th></tr>';
                                       //if fall then make table 
                                       foreach($this->bp_examples as $key2=>$value2){
                                           

                                           if($value2['members_index']==$value && $value2['season']=='spring' && $value2['year']==$k && $value2['blueprint_insert']==1){


                                              echo '<tr><td><a href="'.URL.'product/inside_product/'.$value2['course_index'].'">'.$value2['abbreviation'].'</a></td></tr>';
                                           }

                                       }


                                       echo '</table>';
                                       

                                //third when summer
                                       
                                       echo '<table id="example_table'.$k.'summer" class="semester1 table table-hover" style="font-size:12px;width: 71px; float:left;margin-top:60px;">';
                                                //header
                                                echo'<tr><th style="font-size:10px;">Summer '.$ex_has_semester[$k]['year'].'</th></tr>';
                                       //if fall then make table 
                                       foreach($this->bp_examples as $key2=>$value2){
                                           

                                           if($value2['members_index']==$value && $value2['season']=='summer' && $value2['year']==$k && $value2['blueprint_insert']==1){
                                               

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
        Remove friend</a></p>';

        
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
 
 
 //whose profile
 
 if($this->user_profile['index']==session::get('index')){
      echo '<h1 style="text-align:center; margin-top: 70px;">Your Blueprint</h1>';
 }else{
     
      echo '<h1 style="text-align:center; margin-top: 70px;">'.$this->user_profile['username'].'\'s Blueprint</h1>';
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
                                         echo' <b>Major:</b>';
     foreach($this->user_majors as $key=>$value){
         
         
         

                                               echo '<a href="'.URL.'major/inside_major/'.$value['index'].'">  '.$value['name'].'</a>     ';
                                           }

                                         
    
    
    
    
      
                                          

                                       
echo'</div>'; //end major_box
        
      
        ?>
    
<div style="margin-top: 40px; font-size: 12px;">
    <!--the changer of the semester-->
   
    <?php 
    
    if($this->user_profile['index'] == session::get('index')){
        
        echo '<img src="'.URL.'public/images/icons/187-pencil.png" style="cursor:pointer; width:12px;position: absolute;top: 120px;left: 20px;" text="edit year of semester" alt="edit year" onclick="editBlueprintYears();"/>';
        
    }
    ?>
       
        
    
       <?php
       
       for($i=0;$i<4; $i++ ){
         
           echo'
              
<table id="year'.$i.'fall" class="semester1 table table-hover" style="width: 68px; float:left;">
                <tr>
	           <th id="table'.$i.'fall" style="height: 29px;">Fall ';
           
           if($this->user_profile['index'] == session::get('index')){           
           echo'<select onChange="yearChange(\'table'.$i.'\',this.options[this.selectedIndex].value, \'fall\');" class="year_select"  name="year" style="padding: 0px; width:16px; ">
                            <option value="none">Select Year</option>
                           
                            <option value="10">2010</option>
                            <option value="11">2011</option>
                            <option value="12">2012</option>
                            
                            <option value="13">2013</option>
                            <option value="14">2014</option>
                            <option value="15">2015</option>
                            <option value="16">2016</option>
                            <option value="17">2017</option>
                         </select>';
           }
           echo'</th>
	       </tr>
               ';
          
       if($this->user_profile['index']==session::get('index')){
           
          echo'
             <tr>
                    <th style="font-weight:normal;">
                    
                        <a href="" onclick="return false;" onmousedown="insertBlueprint(\'fall\', \''.$i.'\');"><img src="'.URL.'public/images/white_b_cross.png">course</a>
                     
                    </th>
              </tr>';
          
       }
          echo'
                
   </table>
    
                
  <table id="year'.$i.'spring" class=" semester2 table table-hover " style="width: 78px; float:left;">
                
                <tr>
	           <th id="table'.$i.'spring" style="height: 29px;">Spring  ';
          
          if($this->user_profile['index'] == session::get('index')){
                  echo'<select onChange="yearChange(\'table'.$i.'\',this.options[this.selectedIndex].value, \'spring\');" class="year_select" name="year" style="padding: 0px; width:16px; ">
                            <option value="none">Select Year</option>
                            
                            <option value="10">2010</option>
                            <option value="11">2011</option>
                            <option value="12">2012</option>
                            
                            <option value="13">2013</option>
                            <option value="14">2014</option>
                            <option value="15">2015</option>
                            <option value="16">2016</option>
                            <option value="17">2017</option>
                         </select>
                         ';
                         }
              
                  echo'</th>
	       </tr>';
          
            if($this->user_profile['index']==session::get('index')){  
          
          echo'
             
              <tr>
                    <th style="font-weight:normal;"><a href="" onclick="return false;" onmousedown="insertBlueprint(\'spring\', \''.$i.'\');"><img src="'.URL.'public/images/white_b_cross.png">course</a>
                     </th>
              </tr>';
          
            }
            
          echo'
                
     </table>
                
          <table id="year'.$i.'summer" class="semester3 table table-hover" style="width: 92px; float:left;">
                
                <tr>
	           <th id="table'.$i.'summer" style="height: 29px;">Summer ';
           if($this->user_profile['index']==session::get('index')){
               echo'<select onChange="yearChange(\'table'.$i.'\',this.options[this.selectedIndex].value, \'summer\');" class="year_select"  name="year" style="padding: 0px; width:16px;">
                            <option value="none">Select Year</option>
                            
                            <option value="10">2010</option>
                            <option value="11">2011</option>
                            <option value="12">2012</option>
                            <option value="13">2013</option>
                            <option value="14">2014</option>
                            <option value="15">2015</option>
                            <option value="16">2016</option>
                            <option value="17">2017</option>
                         </select>';
               
                         }
                         echo'</th>
	        </tr>';
      if($this->user_profile['index']==session::get('index')){  
          echo'
             
              <tr>
                    <th style="font-weight:normal;">
                    <a href="" onclick="return false;" onmousedown="insertBlueprint(\'summer\', \''.$i.'\');"><img src="'.URL.'public/images/white_b_cross.png">course</a>
                     </th>
              </tr>  ';
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
    
//editBlueprintYears(); function

function editBlueprintYears(){
    for(z in hasSemester){
        
        //alert(hasSemester[k]['table']+hasSemester[k]['season']);
        //replace the select with
       
        $('#'+hasSemester[z]['table']+hasSemester[z]['season']).html(hasSemester[z]['season']
        
        +'-<select onChange="yearChange(\''+hasSemester[z]['table']+'\',this.options[this.selectedIndex].value,\''+hasSemester[z]['season']+'\');'
                        +'" class="year_select" name="year" style="padding: 0px; width:16px;">'
                    
                           + '<option value="none">Select Year</option>'
                           
                            + '<option value="10">2010</option>'
                            + '<option value="11">2011</option>'
                            + '<option value="12">2012</option>'
                            
                            + '<option value="13">2013</option>'
                            + '<option value="14">2014</option>'
                            + '<option value="15">2015</option>'
                            + '<option value="16">2016</option>'
                            + '<option value="17">2017</option>'
         + '</select>'
    
        );
       
        
    }
}
    
    //add blueprint courses
    var blueprintCourses= <?php echo json_encode($this->blueprint_courses);?>;
    var myUserIndex= <?php echo session::get('index');?>;
    var profileUserIndex= <?php echo $this->user_profile['index'];?>;
    
    var years = new Array(0,1,2,3);
       
     for(y in blueprintCourses){
       for(x in years){
           
           if(years[x]==blueprintCourses[y]['year'] && blueprintCourses[y]['season']=='spring'){
               
             $('#year'+years[x]+'spring').append('<tr><th id="course'+blueprintCourses[y]["course_index"]+'"><a class="classbp_inserted" href="'+URL+'product/inside_product/'+blueprintCourses[y]['course_index']+'">'
                 +blueprintCourses[y]['abbreviation']+'</a></th><tr>');
           
                if(myUserIndex==profileUserIndex){
                    $('#course'+blueprintCourses[y]["course_index"]).append('<img onclick="takeoutBlueprint('+blueprintCourses[y]["course_index"]+');" style="width:7px; cursor:pointer;" src="'+URL+'public/images/Cross.png" alt="Delete course" title="Delete course" />');
                    }
            // alert('blu cours '+blueprintCourses[y]['year']+' in year'+years[x]);
           }
           
           if(years[x]==blueprintCourses[y]['year'] && blueprintCourses[y]['season']=='fall'){
               
             $('#year'+years[x]+'fall').append('<tr><th id="course'+blueprintCourses[y]["course_index"]+'" style="width:70px; overflow:hidden;"><a class="classbp_inserted" href="'+URL+'product/inside_product/'+blueprintCourses[y]['course_index']+'">'+blueprintCourses[y]['abbreviation']
                 +'</a> </th><tr>');
                if(myUserIndex==profileUserIndex){
                     $('#course'+blueprintCourses[y]["course_index"]).append('<img onclick="takeoutBlueprint('+blueprintCourses[y]["course_index"]+');" style="width:7px; cursor:pointer;" src="'+URL+'public/images/Cross.png" alt="Delete course" title="Delete course" />');
                }
       
            }
           
           
           if(years[x]==blueprintCourses[y]['year'] && blueprintCourses[y]['season']=='summer'){
               
             $('#year'+years[x]+'summer').append('<tr><th id="course'+blueprintCourses[y]["course_index"]+'"><a class="classbp_inserted" href="'+URL+'product/inside_product/'+blueprintCourses[y]['course_index']+'">'+blueprintCourses[y]['abbreviation']
                 +'</a> </th><tr>');
                
                if(myUserIndex==profileUserIndex){
                     $('#course'+blueprintCourses[y]["course_index"]).append('<img onclick="takeoutBlueprint('+blueprintCourses[y]["course_index"]+');" style="width:7px; cursor:pointer;" src="'+URL+'public/images/Cross.png" alt="Delete course" title="Delete course" />');
                }
            }
        }//end for y   
      }

</script>


<!-- end blueprint -->
<div class="divider_wood">
<div class="container" style="margin-top:160px;">
    <div class="row-fluid">
        
	
        
	<div class="span4" style="margin-left:70px;">
 <!--           
	<h3>Major Classes</h3>
	<hr/>
        <a href="#" onclick="selectClassDialog();"><img src="<?php echo URL;?>public/images/b_cross.png" /></a>
        
	<form  method="post" action="<?php echo URL;?>schedule/input_blueprint">
                      <div class="span12" style="height:180px; overflow: scroll; background:#fff;">
                          <?php

                          foreach($this->major_courses as $key=>$value){
                              echo '<input type="radio" name="major_class_input" value="'.$value['index']
                                      .'" ><a href="'.URL.'product/inside_product/'.$value['index'].'" ><img style="width: 20px;margin-left: 10px;" src="'.URL.'public/images/MagGlass.png" /></a>'.$value['name']
                                      .'-'.$value['year'].'-'.$value['season']
                                      .'<br />';   
                          }

                          ?>
                      </div>
                    <div class="controls controls-row">

                              <select class="span4" name="season">
                                  
                                <option value="fall">Fall</option>
                                <option value="spring">Spring</option>
                                  <option value="summer">Summer</option>
                              </select>
                      <select class="span4" name="year">
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                      </select>
                    &nbsp;
                      <button type="submit" id="submit" class="btn btn-primary">Move</button>
                    </div>
	</form> end major class form-->
        
	</div> <!--end span 4-->
<!--
<div class="span4">
    
	<h3>All your courses<i class="icon-pencil"></i></h3>
	<hr/>
        <a href="#" onclick="selectClassDialog();"><img src="<?php echo URL;?>public/images/b_cross.png" /></a>
	<form method="post" action="<?php echo URL;?>schedule/input_blueprint">
            
	  <div class="span12" style="height:180px; overflow: scroll; background:#fff;">
              <?php  
               foreach($this->user_courses as $key=>$value){
                   
                   echo'<input type="radio" name="major_class_input" value="'.$value['index']
                                      .'" ><a href="'.URL.'product/inside_product/'.$value['index'].'" ><img style="width: 20px;margin-left: 10px;" src="'.URL.'public/images/MagGlass.png" /></a>'.$value['name']
                                      .'-'.$value['year'].'-'.$value['season']
                                      .'<br />';   
               }
              ?>
	    
	  </div>
	<div class="controls controls-row">
	   <select class="span4" name="season">
	    <option value="fall">Fall</option>
	    <option value="spring">Spring</option>
	  </select>
	  <select class="span4" name="year">
	    <option value="2013">2013</option>
	    <option value="2014">2014</option>
	    <option value="2015">2015</option>
	    <option value="2016">2016</option>
	    <option value="2017">2017</option>
	  </select>
	&nbsp;
	  <button type="submit" id="submit" class="btn btn-primary">Move</button>
	</div>
	</form>
	</div>
-->
    </div> <!--row fluid-->
    
    
</div> <!--end container-->
</div><!--end wood-->


<!-- ~~~~~~~~~~~~~Major Requirements and Comments Area~~~~~~~~~~~~ -->

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
  
  +'<form method="post" action="'+URL+'search/search_all" >'
                            
                           +'<input style="border-radius:10px;" onclick="alert("hi");" id="searchCourseAuto" placeholder=" Search Course" type="text" name="search"/>'
                             +'<input  type="image" src="'+URL+'public/images/MagGlass.png" style="border-radius: 10px;top: 7px;width: 20px;right: 10px;" />'
                             +'</form>'
                         
                         
                         
+'<form id="blueprint_insert_form" action="'+URL+'schedule/input_blueprint" method="post" style="float:left;width:200px">'  
+'<div class="span6">'


	
      +' <div id="my_major_courses" class="span12" style="height:180px; width:200px; float:left;overflow:scroll;">'
       +'<p style="background: #aaa;">Your Major courses</p>'
           +'  </div>'
    
       

	 +' <div id="all_my_courses" class="span12" style="height:180px; width:200px; float:right; overflow: scroll;">'
        +'<p style="background: #aaa;">Your Courses</p>' 
            +'  </div>'
    +'<input type="hidden" name="count_checked" id="count_checked" value="" />'    
     +'<input type="submit" value="Add" style="margin-right:20px; float:right; clear:both;" />'


+'</form>'
+'</div>'//end span0 
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
    $("#my_major_courses").append("<input onclick='countCheckedInsert();' type='checkbox' name='class_input"+k+"' value='"+userMajorCourses[k]['index']+"'/>"+userMajorCourses[k]['name']+"<br />");
      //  $("#my_major_courses").append('<input type="checkbox" name="major'+userMajorCourses[0]+'" value="'+majorArray[index]+'"/>'+majorArray["name"]+'<br />');
        //alert(userMajorCourses[x]['name']);
      //  console.log(userMajorCourses);
    
      }
    
    for(k in userCourses){
       
       $("#all_my_courses").append("<input onclick='countCheckedInsert();' type='checkbox' name='class_input"+k+"' value='"+userCourses[k]['index']+"'/>"+userCourses[k]['name']+"<br />");
       // console.log(userCourses);
    }


</script>

</div><!--user_blueprint_profile end-->

<!--dialog of select major-->
<div class="cam_dialog_pop">
  
       </div>

<div class="blueprint_insert_dialog"></div>



