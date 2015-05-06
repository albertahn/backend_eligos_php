<h1 style="text-align:center;margin-top: 70px;">Your Courses</h1> 

<a style="margin-bottom: 20px;" href="<?php echo URL?>product/create_product_page" class="btn" ><img src="http://sharebasket.com/public/images/AddButton.png" style="width:20px;">  Create A Habit</a>
           
                

                 <div id="profile_content">         
                 
              <?php
              
             echo'<table class="table table-hover" style="width:100%;" id="'.$this->user_profile['index'].'">
                   <tr>
                       <th></th>
                       
                       <th class="product_tb_h">Name</th>
                       <th class="product_tb_h">Date</th>
                       <th class="product_tb_h">Delete?</th>
                  </tr>';
 // print($this->user_products_switch);
  
    foreach($this->user_products_switch as $key => $value){
               
            //id maker
        echo '
        <tr>
              <td><a href="'.URL.'product/inside_product/'.$value['index'].'">
                  <center> </center>
                      </a>
              </td>
                
              
             <td class="postedProduct" id="'.$value['index'].'">
               <a href="'.URL.'product/inside_product/'.$value['index'].'">
                 '.$value['name'].'
               </a>
             </td>';
                    
                  echo '<td class="meeting_creator" id="'.$this->user_profile['index'].'"><a href="'.URL.'product/inside_product/'.$value['index'].'">
                      '.$value['register_date'].'
                          </a>
                          </td>
                          
                       <td>
                           <a style="color:white;" href="'.URL.'product/delete_meeting_page/'.$value['index'].'">
                                  <img style="width:10px;margin-left: 20px;" src="'.URL.'public/images/Cross.png" alt="Delete meeting" title="Delete meeting" />
                           </a>
                       </td>
         </tr>';
 
                  }//end foreach
                
        echo'</table>';
              ?>
                 </div> <!--end of profile content-->
                 
                  <div class="box" id="box">
                 
                 <div  id="text">
                    
                     <center style="background: #aaaaff; border-radius:10px;">
                         <a href="#" style="width:100%" class="btn" onclick="return false" onmousedown="javascript:clickLoadMore();">scroll to load more</a></center>
                     
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
                 
                
             
                 
                 
           
         
