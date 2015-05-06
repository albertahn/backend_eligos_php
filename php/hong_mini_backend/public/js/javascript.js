var URL = 'http://changeandsuccess.com/';
//var MOBILEURL= 'http://groupgreat.com/';


//The ajax page loader




	function swapContent(cv){
	
	$("#side_ajax_load").html('<img src="'+URL+'/public/images/bigLoader.gif" width="50" alt="loader" />').show();
        //change this later
	var url=URL+'ajax_loader/ajax_load';
	$.post(url,{contentVar: cv}, function(data){
	 $("#side_ajax_load").html(data).show()
	 
	 });
	 
	 }


//user control on right
function showUserControlTab(){
   
   $('#user_control_tab').show();
   $('#control_tab_button').attr('onmousedown','javascript:hideUserControlTab();');
   $('#control_tab_button').html('<img src="'+URL+'public/images/up_arrow_man.png" style="background:#fff;margin-right: 200px;" />');
    
}

function hideUserControlTab(){
     $('#user_control_tab').hide();
    $('#control_tab_button').attr('onmousedown','javascript:showUserControlTab();');
    $('#control_tab_button').html('<img src="'+URL+'public/images/down_arrow.png" style="background:#fff;margin-right: 200px;" />');
}
//inside language on right
function showAllLanguages(){
    
   $('#all_languages').show();
   $('#language_change').attr('onmousedown','javascript:hideAllLanguages();');
   
}

function hideAllLanguages(){
    $('#all_languages').hide();
   $('#language_change').attr('onmousedown','javascript:showAllLanguages();');
    
}



function showLogin(){
     $.ajax({
        type: 'POST',
        url: URL+"invite/login_content",
       
        success: function(obj)
        {
            
            //alert(obj);
            
            if(obj)
            {
               
           
               $('div#content').replaceWith("<div id='content'>"+obj+"</div>");
            }
       
       }
   });
    //
     
            
    
}



function dump(arr,level) {
	var dumped_text = "";
	if(!level) level = 0;
	
	//The padding given at the beginning of the line.
	var level_padding = "";
	for(var j=0;j<level+1;j++) level_padding += "    ";
	
	if(typeof(arr) == 'object') { //Array/Hashes/Objects 
		for(var item in arr) {
			var value = arr[item];
			
			if(typeof(value) == 'object') { //If it is an array,
				dumped_text += level_padding + "'" + item + "' ...\n";
				dumped_text += dump(value,level+1);
			} else {
				dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
			}
		}
	} else { //Stings/Chars/Numbers etc.
		dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
	}
        
	console.log(dumped_text);
}

function openMenu(){
    
    
	$('#leftWrap').animate({
        left: -409
    }, 100, function() {
      //  $('#menu_button').html('<a href="#" onClick="openMenu()" > <img class="menu_icon" src="images/categories_dark_k.png" alt="menu_icon"/></a>');

    });
}

function notifyFriendReq(){

        $.ajax({
        type: 'POST',
        url: URL+"notify/friend_requests",
       
        success: function(obj)
        {
            
            //alert(obj);
            
            if(obj)
            {
                 var real = jQuery.parseJSON(obj);
                 
                 
                 
                var numarray= real.length;
           
           if(numarray>0){
               $('#notify_li_friends_req').html('<div id="number_of_friend_req" data-toggle="dropdown">'+numarray+'</div>'
                                                   + '<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">'
                         +'<img src="'+URL+'public/images/BLUEPRINT_friends_requests.png" style="width: 20px; margin-left: 5px; float:left;" alt="friends" /> </a>'
                                                 +'<ul id="notify_ul_friends_req" class="dropdown-menu" role="menu" aria-labelledby="drop1" style="margin-left:8px; margin-top:-6px; width:300px;"></ul>'
                                                   );
           
                for(x in real){
                    
                        $('#notify_ul_friends_req').append('<li role="presentation">'
                        +'<a href="'+URL+'user/user_profile/'+real[x]['index']+'" style="float: left;">'
                        +'<img src="'+URL+'public/uploads/members_pic/'+real[x]['profile_picture']+'" style="width: 50px; height:50px; margin-left: 5px;" alt="friends" />'
                            +'</a>'
                        +'<div class="req_name" style="font-size: 12px;">'+real[x]['username']+'</div>'
                        +'<div class="span2">'
                        +'<div class="confirm_friend btn btn-primary" style="color:#fff;font-size: 11px;" tabindex="-1" onclick="confirm_friend_req('+real[x]['index']+')">Confirm</div>'
                        +'<div class="confirm_friend btn" style="font-size: 11px;" tabindex="-1" onclick="notNow_friend_req('+real[x]['index']+')">Not Now</div>'
                        +'</div>'    
                                
                                    
                                        +'</li><li role="presentation" class="divider" style="width: 100%;"></li>');
                      }
                      
                     }else{
                         
                         $('#notify_li_friends_req').html('<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">'
                         +'<img src="'+URL+'public/images/BLUEPRINT_friends_requests.png" style="width: 20px; margin-left: 5px;" alt="friends" />'
                            +'</a>');
                     } 
           }
      
       }
   });

}
//button confirm
function confirm_friend_req(id){
    
    
   $.ajax({
        type: 'POST',
        url: URL+"friend/accept_friend/"+id,
       
        success: function(obj)
        {  
         
            notifyFriendReq(); 
            
        }
   });
   
  
    
}
//button reject
function notNow_friend_req(id){
   $.ajax({
        type: 'POST',
        url: URL+"friend/reject_friend/"+id,
       
        success: function(obj)
        {
           notifyFriendReq(); 
           
           consol.log(obj);
            
        }
   });
    
}

//notify wall posts

function notifyWallPosts(){
    $.ajax({
        type: 'POST',
        url: URL+"notify/check_my_wall_posts",
       
        success: function(obj)
        {
            
            //alert(obj);
            
            if(obj)
            {
                 var real = jQuery.parseJSON(obj);
                 
                 
                 
                var numarray= real.length;
           
           if(numarray>0){
               $('#notify_li_wall_posts_req').html('<a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">'
                   +'<span id="notify_posts_badge" class="badge badge-important">'+numarray+'</span>'
                   +'</a>'
                       +'<ul id="ul_notify_wall_posts_req" class="dropdown-menu" role="menu" aria-labelledby="drop1" style="margin-left:8px; margin-top:-6px; width:270px;"></ul>'
                         );
           
                for(x in real){
                    
                        $('#ul_notify_wall_posts_req').append('<li role="presentation">'
                        +'<a href="'+URL+'user/user_profile/'+real[x]['wall_index']+'" style="float: left; width:100%;">'
                        +'<img src="'+URL+'public/uploads/members_pic/'+real[x]['profile_picture']+'" style="width: 50px; height:50px; margin-left: 5px; float:left;" alt="friends" />'
                            
                        +'<div class="req_name" style="float:left;width:170px;height: 60px;font-size: 12px;padding-left: 10px;"><div style="color: #333;font-weight: bold;">'+real[x]['username']+'</div> wrote on your wall: <br /> '+real[x]['chat_post'] +'</div>'
                         +'</a>'
                                
                                    
                                        +'</li><li role="presentation" class="divider" style="width: 100%;"></li>');
                      }
                      
                     }else{
                         
                         $('#notify_li_wall_posts_req').html('<a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">'
                         +'<span id="notify_posts_badge" class="badge">0</span>'
                            +'</a>');
                     } 
           }
      
       }
   });
    
    
}

$(document).ready(function (){
    notifyFriendReq();
    notifyWallPosts();
    
});