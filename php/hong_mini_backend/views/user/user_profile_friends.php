
           <h1 style="text-align: center; margin-bottom: 20px;margin-top: 70px;">Friends</h1>
           
                

                 <div id="profile_content">         
                 
              <?php
              
             echo'<table class="friend_profile" id="'.$this->user_profile['index'].'">
                 <tr>
                       
                       <th>Picture</th>
                       <th>Name</th>
                       <th>Blueprint</th>
                       
                 </tr>
                 
<tr><td colspan="3"><hr /></td></tr>
                ';
             
   
             foreach($this->user_friends_switch as $key => $value){
                    //id maker
      echo '
          <tr>
             
             <td style="width: 10px;">
              <a href="'.URL.'user/user_profile/'.$value['index'].'">
                  <img src="'.URL.'public/uploads/members_pic/'.$value['profile_picture'].'" width="50px" height="50px" alt="profile_pic" />
               </a>   
                  </td>
              
         <td class="membersIndex" id="'.$value['index'].'" style="width: 10px;">
             
                 '.$value['username'].'
                     </td>';
                    
                  echo '<td style="width: 10px;">
                      <a href="'.URL.'user/user_profile/'.$value['index'].'">
                      <img src="'.URL.'public/images/ArrowRight.png" />
                          </a></td>
                       </tr>';
  
   
    
 
                }//end foreach
                
                echo'</table>';
              ?>
                 </div> <!--end of profile content-->
                 
                  <div class="box" id="box">
                 
                 <div  id="text">
                    
                     <center style="background: #aaaaff; border-radius:10px;">
                         <a href="#" onclick="return false" onmousedown="javascript:clickLoadMore();">Load More Friends</a></center>
                     
                        </div>
                 <div id="loadMore" style="display: none;">
                     <img src="<?php echo URL;?>public/images/bigLoader.gif" width="50" alt="loader" />
                     
                 </div>
                 </div><!--end of box-->
<script>
    
    $(document).ready(function (){
    
    
//change left side for users
   
  changeLeftSide('+<?php echo $this->user_profile['index'];?>+');
  });
    
    var ajaxReal = true;
    
    $(window).scroll(function(){
	if($(window).scrollTop() == $(document).height() - $(window).height() && ajaxReal){
            
            
            ajaxReal = false;
 	    $("div#text").hide();
            
 		$('div#loadMore').show();
                
               // var url='users/load_more_products';
                
                
              //console.log($(".product_creator").attr("id"));
        
    
    $.ajax({
        type: 'POST',
        url: URL+"user/load_more_friends?lastFriendIndex=" + $(".membersIndex:last").attr("id"),
        data: {myIndex : $(".friend_profile").attr("id")},
        success: function(obj)
        {
            
           // alert(obj);
            
            if(obj)
            {
               
               $('div#loadMore').hide();
               $('.friend_profile').append(obj);
               $("div#text").show();
                 ajaxReal = true;
            }
          else
          {
              $('div#text').replaceWith('<div id="finished_loading" class="box"><center>finished loading all friends</center></div>');
                $("div#loadMore").hide();
          }
        
       }
   });
    
    
                       
                       
                        
 	}
});

//click load more

 function clickLoadMore(){
    ajaxReal = false;
 	    $("div#text").hide();
            
 		$('div#loadMore').show();
                
               // var url='users/load_more_products';
                
                
              //console.log($(".product_creator").attr("id"));
        
    
    $.ajax({
        type: 'POST',
        url: URL+"user/load_more_friends?lastFriendIndex=" + $(".membersIndex:last").attr("id"),
        data: {myIndex : $(".friend_profile").attr("id")},
        success: function(obj)
        {
            
            if(obj)
            {
               
               $('div#loadMore').hide();
               $('.friend_profile').append(obj);
               $("div#text").show();
                 ajaxReal = true;
            }
          else
          {
              $('div#text').replaceWith('<div id="finished_loading" class="box"><center></center></div>');
                $("div#loadMore").hide();
          }
        
       }
   });
 
 
 }

</script>
                 
                
             
                 
                 
           
         
