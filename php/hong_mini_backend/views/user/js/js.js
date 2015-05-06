

//onload function
function changeLeftSide(id){
    
    $.ajax({
        type: 'POST',
        url: URL+"user/change_side?membersIndex=" + id,
       // data: {membersIndex : $(".membersIndex").attr("id")},
        success: function(obj)
        {
            
            $('#leftWrap').replaceWith(obj);
            
             friendSuggestions();
        }
    
  
  
       });
}

 

function openExampleMap(){
    
    $('#slider_example_map').animate({
        top: 10
    }, 200, function() {


    });
    
     $('#user_blueprint_profile').animate({
        top: 472
    }, 200, function() {
     

    });
    
    
    $('#suggested_drop_click').html('<a class="btn" href="#" onclick="return false" onmousedown="closeExampleMap();" style="color:#000; margin-right: 100px;">Close Suggestion <img src="'+URL+'public/images/upbro.png" style="width: 16px;" /></a>');
  $("#rightWrap").hide();
}

function closeExampleMap(){
 
    $('#slider_example_map').animate({
        top: -800
    }, 200, function() {
    
    });
    
     $('#user_blueprint_profile').animate({
        top: 10
    }, 200, function() {
        
    });
    
    
    $('#suggested_drop_click').html('<a class="btn" href="#" onclick="return false" onmousedown="openExampleMap();" style="color:#000; margin-right: 100px;">Show suggestions <img src="'+URL+'public/images/downbro.png" style="width: 12px;" /></a>');
    $("#rightWrap").show();
}

function selectClassDialog(){


  var currentCamDialog= $('.cam_dialog_pop').html();
                
               if(currentCamDialog==null){
                
var $dialog = $('<div class="cam_dialog_pop">'

+'<form action="coursechange.php">'
	 +' <select multiple="multiple" class="span12" style="height:180px; width:270px;">'
              
	  +'  <option value="op1" class="green">Sample Course 101</option>'
	  +'  <option value="op2" class="green">Sample Course 102</option>'
	  +'  <option value="op3" class="green">Sample Course 103</option>'
	  +'  <option value="op4" class="red">Sample Course 104</option>'
	  +'  <option value="op5" class="red">Sample Course 105  <span style="color:red;">fulfills requirement</span></option>'
	  +'  <option value="op6" class="red">Sample Course 106</option>'
	  +'  <option value="op7" class="red">Sample Course 107</option>'
	  +'  <option value="op8" class="red">Sample Course 108</option>'
	  +'  <option value="op9" class="red">Sample Course 109</option>'
	 +'   <option value="op10" class="red">Sample Course 110</option>'
	+'  </select>'
	+'<div class="controls controls-row">'
	+'  <select class="span4" style="width:270px;">'
	+'    <option value="f">Fall</option>'
	+'    <option value="s">Spring</option>'
	+'  </select>'
	  
	+''
	+''
	+'</div>'
	+'</form>'     )
			
			.dialog({
				autoOpen: false,
				title: 'Choose<input type="text" placeholder="search courses"/>'
                                ,
                                buttons: {'Add': function() {
                                                            $(this).dialog("close"); 
                                                          }
                                          }
			});
                        
                        $dialog.dialog('open');
                        $(".cam_button").button();
                        
                    }
                    else
                    {
                    
                        
                $('.cam_dialog_pop').dialog('open');
                        
                    }
}


//global

function editMajor(){
                        $('.cam_dialog_pop').dialog('open');
                        //$(".cam_button").button();

}



function addFriend(id){
    
   
   $.ajax({
        type: 'POST',
        url: URL+"friend/add_friend/"+id,
       
        success: function(obj)
        {
            
            //alert(obj);
            
           if(obj)
            {
               
           
               $(".friend_status").html('<p class="friend_status" style=" width: 180px; "><a href="#" class="btn btn-primary">friend request pending</a></p>');
            }
       
       }
   });
}


//comment time

function submitProfileComment(userIndex){
    
    
    var memComment= $('#commentOnProfile').val();
    
    
    
    
     $.getJSON(URL+'comment/insert_profile_comment/'+userIndex+'?callback=?',
   {
    'chat': memComment
    
   }
  ,
  function(res){
      
      //alert(res.comment_index);
      
      //alert(res);
      $('#commentList').prepend('<div class="commentDiv" id="chatnum'+res.chat_index+'">'
            
                                          +'<a href="'+URL+'user/user_profile/'+res.members_index+'" class="commentProPic">' 
                                          +'<img src="'+URL+'public/uploads/members_pic/'+res.profile_picture+'" style="width:30px; height:30px;"/>'
                                          +'</a>'
                                          +'<a href="'+URL+'user/user_profile/'+res.members_index+'" class="commentName">'
                                          +res.username
                                          +'</a>'
                                          +'<p class="textPart">'
                                          +res.chat_post
                                          +'  <img onclick="deleteWallChat('+res.chat_index+');" src="'+URL+'public/images/Cross.png" style="width:10px; cursor: pointer;"/>'
                                          +'</p>'
                                          
                                     +'</div>');
     
       memComment= $('#commentOnMeeting').val('');                  
      
  });
    
}


//show comments on wall

function showWallPosts(userWall, myIndex){
  
  
  
    $.getJSON(URL+'comment/show_profile_comments/'+userWall+'?callback=?',function(res){
        
        //alert(res);
        
     // console.log(res);
      
       
       var lastone = res.length-1;
       
         for(comnum in res){
             if(res[comnum].members_index == myIndex || myIndex==userWall){
            $('#commentList').append('<div class="commentDiv" id="chatnum'+res[comnum].chat_index+'">'
            
                                          +'<a href="'+URL+'user/user_profile/'+res[comnum].members_index+'" class="commentProPic">' 
                                          +'<img src="'+URL+'public/uploads/members_pic/'+res[comnum].profile_picture+'" style="width:30px; height:30px;"/>'
                                          +'</a>'
                                          +'<a href="'+URL+'user/user_profile/'+res[comnum].members_index+'" class="commentName">'
                                          +res[comnum].username
                                          +'</a>'
                                          +'<p class="textPart">'
                                          +res[comnum].chat_post
                                          +'  <img onclick="deleteWallChat('+res[comnum].chat_index+');" src="'+URL+'public/images/Cross.png" style="width:10px; cursor: pointer;"/></p>'
                                          
                                     +'</div>');
                                 
                                 }else{
                                     
                                     $('#commentList').append('<div class="commentDiv" id="chatnum'+res[comnum].chat_index+'">'
            
                                          +'<a href="'+URL+'user/user_profile/'+res[comnum].members_index+'" class="commentProPic">' 
                                          +'<img src="'+URL+'public/uploads/members_pic/'+res[comnum].profile_picture+'" style="width:30px; height:30px;"/>'
                                          +'</a>'
                                          +'<a href="'+URL+'user/user_profile/'+res[comnum].members_index+'" class="commentName">'
                                          +res[comnum].username
                                          +'</a>'
                                          +'<p class="textPart">'
                                          +res[comnum].chat_post
                                          +'</p>'
                                          
                                     +'</div>');
                                     
                                     
                                 }
                                 
         }
                
    });
    
  
  
  
}

//delete deleteWallChat
function deleteWallChat(chatId){
 
    
      $.ajax({
        type: 'POST',
        url: URL+"comment/delete_profile_comment/" + chatId,
       // data: {membersIndex : $(".membersIndex").attr("id")},
        success: function(obj)
        {
            
            $('#chatnum'+chatId).replaceWith('');
        }
    
  
  
       });
    
}


function insertBlueprint(year){
    
 
     $("#my_major_courses").append("<input type='hidden' name='year' value='"+year+"'/>");
    $("#all_my_courses").append("<input type='hidden' name='year' value='"+year+"'/>");
    
    $('.blueprint_insert_dialog').dialog('open');
    
    
}

function countCheckedInsertMajor(){

            var formobj = document.getElementById("major_blueprint_insert_form");

       var counter = 0;
        for (var j = 0; j < formobj.elements.length; j++)
        {
            if (formobj.elements[j].type == "checkbox")
            {
                if (formobj.elements[j].checked)
                {
                    
                  //  alert(formobj.elements[j].name);
                   // console.log(formobj.elements[j]);
                    
                    formobj.elements[j].name='class_input'+counter;
                    counter++;
                    
                    //alert(counter);
                }
            }       
        }

        //alert(counter);
        $("#count_checked_major").val(counter);
       
}

function countCheckedInsertAll(){

            var formobj = document.getElementById("blueprint_insert_form");

        var counter = 0;
        for (var j = 0; j < formobj.elements.length; j++)
        {
            if (formobj.elements[j].type == "checkbox")
            {
                if (formobj.elements[j].checked)
                {
                    
                    //alert(formobj.elements[j].name);
                   // console.log(formobj.elements[j]);
                    
                    formobj.elements[j].name='class_input'+counter;
                    counter++;
                }
            }       
        }

        //alert(counter);
        $("#count_checked_all").val(counter);
      
}

function takeoutBlueprint(courseID){
    
    $('#course'+courseID).hide();
    
     $.ajax({
        type: 'POST',
        url: URL+"schedule/takeout_blueprint/"+courseID
       
        
   });
    
    
    //+URL+'schedule/takeout_blueprint/'+blueprintCourses[y]['course_index']
    
    
}

function yearChange(table, year, season){
    
   //alert(table+' '+year+' '+season);
   var firstUp = capitaliseFirstLetter(season);
   
   $('#'+table+season).html(firstUp+' '+year);
   
    $.ajax({
        type: 'POST',
        url: URL+"schedule/add_semester_year/"+table+"/"+year+"/"+season,
       
        success: function(obj)
        {
            
           // alert(obj);
            
           
       
       }
       
        
   });
   
   
}


function capitaliseFirstLetter(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function searchCourseAuto(){
   
   alert('hi');
    
 /*  var searchCourseAuto= document.getElementById("searchCourseAuto"); 
    
   // searchCourseAuto.focus();
    
    searchCourseAuto.oninput= function () {
    
      if($('#searchCourseAuto').val()!==""){
    
                     searchCourseDatabase();
   
                    } 
    }
    */
}

function searchCourseDatabase(){
    alert('ji');
    
   
}



function blueprintCourseInsert(id){
    
    
    $("#clicked_class_index").val(id);
   
                        $('.req_blueprint_insert_dialog').dialog('open');
                        //$(".cam_button").button();

}


function insertBlueprintMajor(season, table){
    
   clickedClassIndex=$("#clicked_class_index").val();
    
    
    $.ajax({
        type: 'POST',
        url: URL+"major/input_blueprint/",
        data: { 'season': season,
               'year': table,
               'class_index': clickedClassIndex},
       
        success: function(obj)
        {
            
            obj=jQuery.parseJSON(obj);
           
            
        $("#req_year"+obj['year']+obj['season']).append('<tr><th id="course'+obj["course_index"]+'"><a class="classbp_inserted" href="'+URL+'product/inside_product/'+obj['course_index']+'">'
                 +obj['abbreviation']+'</a></th><tr>');
             
                   
        $("#year"+obj['year']+obj['season']).append('<tr><th id="course'+obj["course_index"]+'"><a class="classbp_inserted" href="'+URL+'product/inside_product/'+obj['course_index']+'">'
                 +obj['abbreviation']+'</a></th><tr>');
            
            
          //  alert(obj);
            
           
       
       }
       
        
   });
    
    
    //$('.blueprint_insert_dialog').dialog('close');  //close 
    
    
}


function friendSuggestions(){
    
    $.ajax({  url: URL+"friend/friend_suggestions/",
        
        success: function(obj)
        {
            
            obj=jQuery.parseJSON(obj);
           
           
           for(x in obj){
               
               $(".friend_suggestions").append('<a style="display: block;width: 50px;" class="btn" href="'+URL+'user/user_profile/'+obj[x]['index']+'" >'
                   +'<img style="width:50px;" src="'+URL+'public/uploads/members_pic/'+obj[x]['profile_picture']+'"/>'
                   +'<span class="suggested_name">'+obj[x]['username']+'</span>'
                       +'</a>');
           }
            
            
           
           
       
       }
       
        
   });
    
}


function add_mentor(id, category){
    
   $.ajax({  url: URL+"mentorship/add_mentor/"+id+"/"+category,
        
        success: function(obj)
        {
            
            $("#mentor_b_text").html('Mentor for '+category);
           
       
       }
       
        
   });
    
   
    
    
    
    
}