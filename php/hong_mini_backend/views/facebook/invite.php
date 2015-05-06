<h1 style="text-align:center; margin-top:70px;">Invite Your Friends To Change & Success</h1>
    <div class="progress">
  <div class="bar" style="width: 30%;">30% Completed</div>
</div>

<div id="invite_div" style="padding-bottom: 50px;text-align: center;">
    <span onclick="sendAppRequests();" class="btn-primary btn" style="width: 200px;">Invite</span> <a href="<?php echo URL;?>product/first_create_product/" class="btn">Skip</a>
    
    
</div>

<span class="btn" onclick="selectAll();" style="display: block;width: 100px;">Select All</span>


    <script>
      FB.init({
        appId  : '141896069328369',
        frictionlessRequests: true,
        authResponse: true,
        cookie:true
      });


      function sendRequestViaMultiFriendSelector() {
        //see if logged in
                            FB.getLoginStatus(function(response) {
                      if (response.status === 'connected') {
                        // the user is logged in and has authenticated your
                        // app, and response.authResponse supplies
                        // the user's ID, a valid access token, a signed
                        // request, and the time the access token 
                        // and signed request each expire
                        getFriends();
                       
                        var uid = response.authResponse.userID;
                        var accessToken = response.authResponse.accessToken;
                      } else if (response.status === 'not_authorized') {
                          
                        // the user is logged in to Facebook, 
                        // but has not authenticated your app
                        $("#invite_div").append('<span id="connectFb" class="btn btn-primary" onclick="getFriends();">Connect with Facebook</span>');
                         
                      } else {
                        // the user isn't logged in to Facebook.
                         $("#invite_div").append('<span id="connectFb" class="btn btn-primary" onclick="getFriends();" style="margin: auto;display: block;width: 200px;">Connect with Facebook</span>');
                         
                         
                      }
                     });
       
        
        
      }
      
      function requestCallback(response) {
      //alert(response);
      location.href = URL+'product/first_create_product';
      
      //  window.Open= URL+'major';
      }
  //get friends
  
  function getFriends() {
      
       FB.init({
      appId      : '141896069328369', // App ID from the App Dashboard
      channelUrl : 'contendera.com/channel.html', // Channel File for x-domain communication
      status     : true, // check the login status upon init?
      cookie     : true, // set sessions cookies to allow your server to access the session?
      xfbml      : true  // parse XFBML tags on this page?
    });
    
   
    
    
    FB.login(function(response){
             fbAccessToken = response.authResponse.accessToken;
             
             if (response.authResponse){
             
             FB.api('/me/friends', function(response) {
                            $.each(response.data,function(index,friend) {
                                              $("#content").append('<div style="float:left; width:200px;overflow:hidden;height: 50px;" class="btn" onclick="checkToggle('+friend.id+');">'
                                                  +'<input id="idcheck'+friend.id+'" onclick="checkToggle('+friend.id+');" name="idcheck'+friend.id+'" value="'+friend.id+'" type="checkbox" />    '
                                                  +'<img src="http://graph.facebook.com/'+friend.id+'/picture" /><span >'
                                                      + friend.name
                                                 +'</span></div>'
                                              );
                            });          
                    });
             } else {
            
             console.log('User cancelled login or did not fully authorize.');
             }
			 }, {scope: "email, publish_stream, user_photos "});
          
          
          $("#connectFb").hide();
 }
 
 
 function sendAppRequests(){
 
   var allInputs = document.getElementsByTagName("input");
            for (var i = 0, max = allInputs.length; i < max; i++){
                
                
                if (allInputs[i].checked == true){
                    
                  //  alert(allInputs[i].value);
                    
                    
                        //send the request           

                                  FB.ui({method: 'apprequests',
                                    message: 'Hey lets build better habits together at changeandsuccess.com',
                                    to: allInputs[i].value
                                  }, requestCallback);

                         
                    
                }
                    
            }
 
            
            
            /*
            for(i in ids){
                
                  FB.ui({method: 'apprequests',
                    message: 'My Great Request',
                    to: ids[i]
                  }, requestCallback);
                  
             }//end for i
             
             */
 }
 
 function checkToggle(id){
     
     
     
   if($('#idcheck'+id).prop('checked')==false){
       
       
    $('#idcheck'+id).attr('checked','checked');
      
       
   }else{
       
        $('#idcheck'+id).removeAttr('checked');

                
             }
 }
 
 
 function selectAll(){
     
             var allInputs = document.getElementsByTagName("input");
            for (var i = 0, max = allInputs.length; i < max; i++){
                if (allInputs[i].type === 'checkbox')
                    allInputs[i].checked = true;
            }

     
 }
    

      
   $(document).ready(function (){   
   
      sendRequestViaMultiFriendSelector();
      
    //  getFriends(); 
    



$("#content").css('width','100%');


$("#content").css('background','#fff');
$("#content").css('height','100%');

$("#content").css('margin-left','10px');

   });
    </script>