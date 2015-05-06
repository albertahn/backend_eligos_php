function deleteComments(id){
    
    
      $.ajax({
        type: 'POST',
        url: URL+"comment/delete_course_comment/" + id,
       // data: {membersIndex : $(".membersIndex").attr("id")},
        success: function(obj)
        {
            
            $('#comnum'+id).replaceWith('');
        }
    
  
  
       });
}

 function memoryComments(id, myIndex){

                 // var myIndex = <?php echo session::get('index');?>;
               // alert(myIndex);

                $.getJSON(URL+'comment/get_course_comments/'+id+'?callback=?',function(res){

                   var lastone = res.length-1;


                     for(comnum in res){

                         if(res[comnum].members_index == myIndex){
                        $('#commentList').append('<div class="commentDiv" id="comnum'+res[comnum].comment_index+'">'

                                                      +'<a href="'+URL+'user/user_profile/'+res[comnum].members_index+'" class="commentProPic">' 
                                                      +'<img src="'+URL+'public/uploads/members_pic/'+res[comnum].profile_picture+'" style="width:30px; height:30px;"/>'
                                                      +'</a>'
                                                      +'<a href="'+URL+'user/user_profile/'+res[comnum].members_index+'" class="commentName">'
                                                      +res[comnum].username
                                                      +'</a>'
                                                      +'<p class="textPart" style="margin-left: 50px;">'
                                                      +res[comnum].comment_text
                                                      +'  <img onclick="deleteComments('+res[comnum].comment_index+');" src="'+URL+'public/images/Cross.png" style="width:10px; cursor: pointer;"/> </p>'

                                                 +'</div>');
                                             }else{
                                                     $('#commentList').append('<div class="commentDiv" id="comnum'+comnum+'">'

                                                      +'<a href="'+URL+'user/user_profile/'+res[comnum].members_index+'" class="commentProPic">' 
                                                      +'<img src="'+URL+'public/uploads/members_pic/'+res[comnum].profile_picture+'" style="width:30px; height:30px;"/>'
                                                      +'</a>'
                                                      +'<a href="'+URL+'user/user_profile/'+res[comnum].members_index+'" class="commentName">'
                                                      +res[comnum].username
                                                      +'</a>'
                                                      +'<p class="textPart" style="margin-left: 50px;">'
                                                      +res[comnum].comment_text
                                                      +'   </p>'

                                                 +'</div>');

                                             }
                     }

                });


            }



//submitComment('+id+')

function submitComment(id){
    
    var memComment= $('#commentOnMeeting').val();
    
     $.getJSON(URL+'comment/insert_course_comment/'+id+'?callback=?',
   {
    'comment': memComment
    
   }
  ,
  function(res){
      
      
      //alert(res.comment_index);
      
      
      $('#commentList').prepend('<div class="commentDiv" id="comnum'+res.comment_index+'">'
            
                                          +'<a href="'+URL+'user/user_profile/'+res.members_index+'" class="commentProPic">' 
                                          +'<img src="'+URL+'public/uploads/members_pic/'+res.profile_picture+'" style="width:30px; height:30px;"/>'
                                          +'</a>'
                                          +'<a href="'+URL+'user/user_profile/'+res.members_index+'" class="commentName">'
                                          +res.username
                                          +'</a>'
                                          +'<p class="textPart" style="margin-left: 50px;">'
                                          +res.comment_text
                                      +'<img onclick="deleteComments('+res.comment_index+');" src="http://classblueprint.com/public/images/Cross.png" style="width: 10px;cursor: pointer;"/>'
                                          +'</p>'
                                          
                                     +'</div>');
     
       memComment= $('#commentOnMeeting').val('');                  
      
  });
    
    
}




function showMajorSelect(){
var isMajorSelect=document.getElementById("is_major");

if(isMajorSelect.options[1].selected==true){
    
    $('#upload_major_select').hide();
    
        }else{
            
            $('#upload_major_select').show();
        }

}

  



 function addToMyList(courseId){
     
     $.ajax({
        type: 'POST',
        url: URL+"schedule/add_my_course/" + courseId,
       // data: {membersIndex : $(".membersIndex").attr("id")},
        success: function(obj)
        {
            
            $('#add_delete_button').html('<div class="btn" href="" onclick="deleteFromMyList('+courseId+');">Delete from your course list</div>');
        }
    
  
  
       });
     
     
 }                      
                       
function deleteFromMyList(courseId){
   
    
     $.ajax({
        type: 'POST',
        url: URL+"schedule/delete_my_course/" + courseId,
       // data: {membersIndex : $(".membersIndex").attr("id")},
        success: function(obj)
        {
            
            $('#add_delete_button').html('#add_delete_button').html('<div class="btn" onclick="addToMyList('+courseId+');" >Add to your course list</div>');
        }
    
  
  
       });
     
    
}  


//inside product update day

function addDay(habitID){
    
     var totalDays=parseInt($('#total_days').html(), 10)+1;
      
     
      
    $.ajax({
        type: 'POST',
        url: URL+"day/update_day/" + habitID,
        data: {total_days : totalDays},
        success: function(obj)
        {
             $("#total_days").html(totalDays);
       
         
        }
    
  
  
       });
    
}


function minusDay(habitID){
    
    var totalDays=parseInt($('#total_days').html(), 10)-1;
      
     
      
    $.ajax({
        type: 'POST',
        url: URL+"day/update_day/" + habitID,
        data: {total_days : totalDays},
        success: function(obj)
        {
             $("#total_days").html(totalDays);
       
         
        }
    
  
  
       });
    
}
    
//update success


function addSuccess(habitID){
    
     var totalDays=parseInt($('#total_success').html(), 10)+1;
      
     
      
    $.ajax({
        type: 'POST',
        url: URL+"day/update_success/" + habitID,
        data: {total_days : totalDays},
        success: function(obj)
        {
             $("#total_success").html(totalDays);
       
         
        }
    
  
  
       });
    
}


function minusSuccess(habitID){
    
    var totalDays=parseInt($('#total_success').html(), 10)-1;
      
     
      
    $.ajax({
        type: 'POST',
        url: URL+"day/update_success/" + habitID,
        data: {total_days : totalDays},
        success: function(obj)
        {
             $("#total_success").html(totalDays);
       
         
        }
    
  
  
       });
    
}

function deleteFile(id, filename,courseIndex){
    
    $.ajax({
        type: 'POST',
        url: URL+"file/delete_file/" + id+'/'+filename+'/'+courseIndex,
      //  data: {total_days : totalDays},
        success: function(obj)
        {
             $("#file"+id).html('');
       
        
        }
    
  
  
       });
    
    
    
}

function doneFirstTime(){
    
   $.ajax({
        type: 'POST',
        url: URL+"user/done_first_time/",
      //  data: {total_days : totalDays},
        success: function(obj)
        {
       
        }
    
  
  
       });
}