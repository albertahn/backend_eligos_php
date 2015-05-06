
<h1 style="margin-top:70px; text-align: center;"><?php echo $this->inside_major['name'];?></h1>
    


<?php
//unique major requirements



 $requirment_unique = array();
        
        foreach($this->requirements as $key=>$value){
            
            if(!empty($value)){
            
            $requirment_unique[$key]=$value['requirement'];
            }else{
                
                array_push($requirment_unique, $value['requirement']);  //$requirment_unique[90000]=$value['requirement'];
            }
         }
        
            $requirment_unique = array_unique($requirment_unique);
            
            
          
      //order them
          
        foreach($requirment_unique as $ke=>$valu){  
          if(!empty($valu)){
            
            $requirment_unique[$ke]=$valu;
            }else{
                
              //  array_push($requirment_unique, $valu);  //$requirment_unique[90000]=$value['requirement'];
            }
        }
      /*  
         echo'<pre>';
         print_r($requirment_unique);
          echo'</pre>';
            */
echo'<div class="accordion" id="requirement_accordion">';
echo'<h3>Major Requirements</h3>';



foreach ($requirment_unique as $key => $value) {
    
     echo'<div class="accordion-group">';
   
 

                        echo'
                            

                                     <div class="accordion-heading" style="background:rgba(137,157,223,0.2);">
                                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#'.$value.'_req">';
                                            if(!empty($value)){
                                                echo $value.'    <span style="text-decoration:none;font-size:14px; margin-left:-100px; float:right; color:black;"> '.$this->requirements[$key]['req_num_courses'].'</span><span class="caret" style="float:right;margin-right:-10px;"></span>';
                                            }else{
                                                echo'Other<span class="caret" style="float:right;margin-right:-10px;"></span>';
                                            }
                                          echo'</a>';
                       echo'              </div>'; //end acordian heading

                       echo'<div id="'.$value.'_req" class="accordion-body collapse">';

                       //the courses

                       foreach ($this->requirements as $key2 => $value2) {

                           if($value2['requirement']==$value){
                               echo'<div class="accordion-inner">
                                   <a style="width: 500px;" href="'.URL.'product/inside_product/'.$value2['courses_index'].'">'.$value2['abbreviation'].' &nbsp;&nbsp;&nbsp;&nbsp;         '.$value2['course_name'].'</a>
                                   ';
                                   if(session::get('loggedin')==true){
                                       echo'<span class="btn" onclick="blueprintCourseInsert('.$value2['courses_index'].');" style="font-weight:bold;font-family:open sans; font-size:11px;float:right;margin-top: -5px;" >Add to Blueprint</span>';
                                   }


                                   echo' </div>'; //end inner
                           }

                       }


                           echo' </div>'; //accordion-body collapse

                       
    
  
   
    echo'</div>'; //end acorian group
  
}

echo'</div>';// end requirement_accordion

 

?>


<div id="major_description">
    <h3>Major Description</h3>
    <?php echo $this->inside_major['description'] ?>
</div>


<div id="people_in_major">
         <h3 style="text-align: center; width:100%;">In This Major</h3>
         <?php 
            
         foreach($this->view_member_has_major as $key => $value){
             
            echo '<a href="'.URL.'user/user_profile/'.$value['index'].'">';
            echo '<img src="'.URL.'public/uploads/members_pic/'.$value['profile_picture'].'" style="width:50px; float:left; height:50px;padding:5px;"/>';
            echo'</a>';
            
         }
         
         ?>
     </div>
<div class="blueprint_insert_dialog" style="width:1200px;">
  
      
      
</div>

<?php  $my_bp=json_encode($this->my_blueprint);?>



<script>

               var myBlueprint= <?php echo $my_bp;?>

//now set the dialog for inserting blueprint
    
   
               var blueprintInsertDialog = $('.blueprint_insert_dialog').html();
                
              
//courses dialog

var blueprintInsertDialog = $('<div class="blueprint_insert_dialog" style="text-align: center;">'
          +'<h1>Add To Your Blueprint</h1>'
          +'<table id="year0fall" class="semester1 table table-hover" style="width: 68px; float:left;font-size: 10px;">'
                +'<tr>'
                        +'<th id="0header_fall">Fall<th>'
               +'</tr>' 
        //btn   
              +'<tr>'
                    +'<th style="font-weight:normal;">'
                    +'<span onclick="insertBlueprintMajor(\'fall\', 0);" class="btn" style="width: 29px; font-size:8px;"><img src="'+URL+'public/images/Plus.png" style="width: 10px;">  Add</a>'
                     +'</th>'
              +'</tr>'
          +'</table>'
        //table
         +'<table id="year0spring" class="semester1 table table-hover" style="width: 68px; float:left;font-size: 10px;">'
                +'<tr>'
                        +'<th id="0header_fall">Spring<th>'
               +'</tr>' 
           
           //btn   
              +'<tr>'
                    +'<th style="font-weight:normal;">'
                    +'<span onclick="insertBlueprintMajor(\'spring\', 0);" class="btn" style="width: 29px; font-size:8px;"><img src="'+URL+'public/images/Plus.png" style="width: 10px;">  Add</a>'
                     +'</th>'
              +'</tr>'
          +'</table>'
        //table
         +'<table id="year0summer" class="semester1 table table-hover" style="width: 68px; float:left;font-size: 10px;">'
                +'<tr>'
                        +'<th id="0header_fall">Summer<th>'
               +'</tr>' 
           
           //btn   
              +'<tr>'
                    +'<th style="font-weight:normal;">'
                    +'<span onclick="insertBlueprintMajor(\'summer\', 0);" class="btn" style="width: 29px; font-size:8px;"><img src="'+URL+'public/images/Plus.png" style="width: 10px;">  Add</a>'
                     +'</th>'
              +'</tr>'
          +'</table>'

//////year1
        +'<table id="year1fall" class="semester1 table table-hover" style="width: 68px; float:left;font-size: 10px;">'
                +'<tr>'
                        +'<th id="1header_fall">Fall<th>'
               +'</tr>' 
            //btn   
              +'<tr>'
                    +'<th style="font-weight:normal;">'
                    +'<span onclick="insertBlueprintMajor(\'fall\', 1);" class="btn" style="width: 29px; font-size:8px;"><img src="'+URL+'public/images/Plus.png" style="width: 10px;">  Add</a>'
                     +'</th>'
              +'</tr>'
          +'</table>'
        //table
         +'<table id="year1spring" class="semester1 table table-hover" style="width: 68px; float:left;font-size: 10px;">'
                +'<tr>'
                        +'<th id="1header_fall">Spring<th>'
               +'</tr>' 
            //btn   
              +'<tr>'
                    +'<th style="font-weight:normal;">'
                    +'<span onclick="insertBlueprintMajor(\'spring\', 1);" class="btn" style="width: 29px; font-size:8px;"><img src="'+URL+'public/images/Plus.png" style="width: 10px;">  Add</a>'
                     +'</th>'
              +'</tr>'
          +'</table>'
        //table
         +'<table id="year1summer" class="semester1 table table-hover" style="width: 68px; float:left;font-size: 10px;">'
                +'<tr>'
                        +'<th id="1header_summer">Summer<th>'
               +'</tr>' 
            //btn   
              +'<tr>'
                    +'<th style="font-weight:normal;">'
                    +'<span onclick="insertBlueprintMajor(\'summer\', 1);" class="btn" style="width: 29px; font-size:8px;"><img src="'+URL+'public/images/Plus.png" style="width: 10px;">  Add</a>'
                     +'</th>'
              +'</tr>'
          +'</table>'

//////year2

        +'<table id="year2fall" class="semester1 table table-hover" style="width: 68px; float:left;font-size: 10px;">'
                +'<tr>'
                        +'<th id="2header_fall">Fall<th>'
               +'</tr>' 
           
           //btn   
              +'<tr>'
                    +'<th style="font-weight:normal;">'
                    +'<span onclick="insertBlueprintMajor(\'fall\', 2);" class="btn" style="width: 29px; font-size:8px;"><img src="'+URL+'public/images/Plus.png" style="width: 10px;">  Add</a>'
                     +'</th>'
              +'</tr>'
          +'</table>'
        //table
         +'<table id="year2spring" class="semester1 table table-hover" style="width: 68px; float:left;font-size: 10px;">'
                +'<tr>'
                        +'<th id="2header_fall">Spring<th>'
               +'</tr>' 
           //btn   
              +'<tr>'
                    +'<th style="font-weight:normal;">'
                    +'<span onclick="insertBlueprintMajor(\'spring\', 2);" class="btn" style="width: 29px; font-size:8px;"><img src="'+URL+'public/images/Plus.png" style="width: 10px;">  Add</a>'
                     +'</th>'
              +'</tr>'
          +'</table>'
        //table
         +'<table id="year2summer" class="semester1 table table-hover" style="width: 68px; float:left;font-size: 10px;">'
                +'<tr>'
                        +'<th id="2header_fall">Summer<th>'
               +'</tr>' 
           //btn   
              +'<tr>'
                    +'<th style="font-weight:normal;">'
                    +'<span onclick="insertBlueprintMajor(\'summer\', 2);" class="btn" style="width: 29px; font-size:8px;"><img src="'+URL+'public/images/Plus.png" style="width: 10px;">  Add</a>'
                     +'</th>'
              +'</tr>'
          +'</table>'

//////year3

        +'<table id="year3fall" class="semester1 table table-hover" style="width: 68px; float:left;font-size: 10px;">'
                +'<tr>'
                        +'<th id="3header_fall">Fall<th>'
               +'</tr>' 
           
           //btn   
              +'<tr>'
                    +'<th style="font-weight:normal;">'
                    +'<span onclick="insertBlueprintMajor(\'fall\', 3);" class="btn" style="width: 29px; font-size:8px;"><img src="'+URL+'public/images/Plus.png" style="width: 10px;">  Add</a>'
                     +'</th>'
              +'</tr>'
          +'</table>'
        //table
         +'<table id="year3spring" class="semester1 table table-hover" style="width: 68px; float:left;font-size: 10px;">'
                +'<tr>'
                        +'<th id="3header_fall">Spring<th>'
               +'</tr>' 
           
           //btn   
              +'<tr>'
                    +'<th style="font-weight:normal;">'
                    +'<span onclick="insertBlueprintMajor(\'spring\', 3);" class="btn" style="width: 29px; font-size:8px;"><img src="'+URL+'public/images/Plus.png" style="width: 10px;">  Add</a>'
                     +'</th>'
              +'</tr>'
          +'</table>'
        //table
         +'<table id="year3summer" class="semester1 table table-hover" style="width: 68px; float:left;font-size: 10px;">'
                +'<tr>'
                        +'<th id="3header_fall">Summer<th>'
               +'</tr>' 
           
           //btn   
              +'<tr>'
                    +'<th style="font-weight:normal;">'
                    +'<span onclick="insertBlueprintMajor(\'summer\', 3);" class="btn" style="width: 29px; font-size:8px;"><img src="'+URL+'public/images/Plus.png" style="width: 10px;">  Add</a>'
                     +'</th>'
              +'</tr>'
          +'</table>'

//////year4
  +'<input type="hidden" id="clicked_class_index" />'
//+'</div>'//end span0 
	+'</div>'
	    ).dialog({
                                modal:true,
				autoOpen: false,
                                 width: 1150,
                                 height:500,
                                buttons: { 'Cancel': function() {
                                                            $(this).dialog("close"); 
                                                          }, 'Done': function() {
                                                            $(this).dialog("close"); 
                                                          }
                                          }
			});
                        
                       
                       // $(".blueprint_insert_dialog").button();
                       
                       
 //add blueprint courses
    var blueprintCourses= myBlueprint;
    
   
    var years = new Array(0,1,2,3);
       
     for(y in blueprintCourses){
       for(x in years){
           
           if(years[x]==blueprintCourses[y]['year'] && blueprintCourses[y]['season']=='spring'){
               
             $('#year'+years[x]+'spring').append('<tr><th id="course'+blueprintCourses[y]["course_index"]+'"><a class="classbp_inserted" href="'+URL+'product/inside_product/'+blueprintCourses[y]['course_index']+'">'
                 +blueprintCourses[y]['abbreviation']+'</a></th><tr>');
           
                
            // alert('blu cours '+blueprintCourses[y]['year']+' in year'+years[x]);
           }
           
           if(years[x]==blueprintCourses[y]['year'] && blueprintCourses[y]['season']=='fall'){
               
             $('#year'+years[x]+'fall').append('<tr><th id="course'+blueprintCourses[y]["course_index"]+'" style="width:70px; overflow:hidden;"><a class="classbp_inserted" href="'+URL+'product/inside_product/'+blueprintCourses[y]['course_index']+'">'+blueprintCourses[y]['abbreviation']
                 +'</a> </th><tr>');
               
       
            }
           
           
           if(years[x]==blueprintCourses[y]['year'] && blueprintCourses[y]['season']=='summer'){
               
             $('#year'+years[x]+'summer').append('<tr><th id="course'+blueprintCourses[y]["course_index"]+'"><a class="classbp_inserted" href="'+URL+'product/inside_product/'+blueprintCourses[y]['course_index']+'">'+blueprintCourses[y]['abbreviation']
                 +'</a> </th><tr>');
                
               
            }
        }//end for y   
      }
                   
$(".ui-dialog-titlebar").hide();

</script>