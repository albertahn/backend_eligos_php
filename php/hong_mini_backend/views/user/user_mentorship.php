<h1 style="text-align:center;margin-top: 70px;">Mentorship</h1> 

           
                

                 <div id="profile_content">
                     
                     
                 
              
                 </div> <!--end of profile content-->
                 
              <!--    <div class="box" id="box">
                 
                 <div  id="text">
                    
                     <center style="background: #aaaaff; border-radius:10px;">
                         <a href="#" style="width:100%" class="btn" onclick="return false" onmousedown="javascript:clickLoadMore();">scroll to load more</a></center>
                     
                        </div>
                 <div id="loadMore" style="display: none;">
                     <img src="<?php echo URL;?>public/images/bigLoader.gif" width="50" alt="loader" />
                     
                 </div>
                 </div>end of box-->
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
        url: URL+"user/load_more_products?lastMeetingIndex=" + $(".postedProduct:last").attr("id"),
        data: {meeting_creator : $(".meeting_creator").attr("id")},
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
        url: URL+"user/load_more_products?lastMeetingIndex=" + $(".postedProduct:last").attr("id"),
        data: {meeting_creator : $(".meeting_creator").attr("id")},
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
                 
                
             
                 
                 
           
         
