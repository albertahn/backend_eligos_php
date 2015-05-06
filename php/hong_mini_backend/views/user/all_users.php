<h1 class="header">See all the users of meetingmeeting</h1>


<?php
 echo '<div id="all_users_board">';
 
foreach ($this->all_users as $key => $value) {
   echo '<li style="display: list-item; list-style: none; text-align: center; float:left; overflow:hidden;">';
    echo '<div  class="everyone_user_index" id="'.$value['index'].'">
                 <a href="'.URL.'user/user_profile/'.$value['index'].'"><img style="width:50px; height:50px;" src="'.MEMBERS_PIC.'/'.$value['profile_picture'].'"></a>
         </div>';
    echo '<div style="font-size:10px; display: list-item; list-style: none; text-align: center; float:left;height:10px; width:50px; overflow:hidden;">'.$value['username'].
         '</div>';
    echo '</li>';
}

echo '</div>';

?>



<div class="box" id="box" style="clear:both;">
                 
                 <div  id="text">
                    
                     <center style="background: #aaaaff; border-radius:10px;">
                         <a href="#" onclick="return false" onmousedown="javascript:clickLoadMore();">click to load more</a></center>
                     
                        </div>
                 <div id="loadMore" style="display: none;">
                     <img src="<?php echo URL;?>public/images/bigLoader.gif" width="50" alt="loader" />
                     
                 </div>
                 </div><!--end of box-->



<script>
    
    var ajaxReal = true;
    
    $(window).scroll(function(){
	if($(window).scrollTop() == $(document).height() - $(window).height() && ajaxReal){
            
            
            ajaxReal = false;
 	    $("div#text").hide();
            
 		$('div#loadMore').show();
                
               
               
                
              //console.log($(".product_creator").attr("id"));
        
    
    $.ajax({
        type: 'POST',
        url: URL+"user/all_users_load_more?lastUserIndex=" + $(".everyone_user_index:last").attr("id"),
        //data: {myIndex : $(".friend_profile").attr("id")},
        success: function(obj)
        {
            
          //  alert($(".user_index:last").attr("id"));
           // $(".user_index:last").css({backgroundColor: 'yellow', fontWeight: 'bolder'});
            
            if(obj)
            {
               
               $('div#loadMore').hide();
               $('#all_users_board').append(obj);
               $("div#text").show();
                 ajaxReal = true;
            }
          else
          {
              $('div#text').replaceWith('<div style="background: #333; color:white; margin-top:50px; border-radius:10px;" id="finished_loading" class="box"><center>finished loading all meetings</center></div>');
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
        url: URL+"user/all_users_load_more?lastUserIndex=" + $(".everyone_user_index:last").attr("id"),
        //data: {myIndex : $(".friend_profile").attr("id")},
        success: function(obj)
        {
            
           // alert(obj);
            
            if(obj)
            {
               
               $('div#loadMore').hide();
               $('#all_users_board').append(obj);
               $("div#text").show();
                 ajaxReal = true;
            }
          else
          {
              $('div#text').replaceWith('<div style="background: #333; color:white; margin-top:50px; border-radius:10px;" id="finished_loading" class="box"><center>finished loading all meetings</center></div>');
                $("div#loadMore").hide();
          }
        
       }
   });
 
 
 }

</script>