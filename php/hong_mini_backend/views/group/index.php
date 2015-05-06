

<a href="<?php echo URL; ?>group/create_group_page" onclick="going();" class="uiButton">create_group</a>


<hr />
<p class="small_header">All groups</p>
<div style="  width:100%;">
    
<table width="100%" id="all_groups_table">
    <tr><th></th><th>id</th><th>name</th><th>location</th></tr>
<?php 

foreach($this->group_list as $key => $value) {
            echo '<tr>';
            
    echo ' <td style="color:#000; text-align:center;"><a href="'.URL.'group/inside_group/'.$value['index'].'"><img src="'.URL.'public/uploads/group_pic/'.$value['group_pic'].'" width="50px" height="50px" alt="group_pic"><a/></td>';
    echo ' <td style="color:#000; text-align:center;" class="group_index" id="'.$value['index'].'">'.$value['index'].'</td>';
    echo ' <td style="color:#000; text-align:center;">'.$value['name'].'</td>';
    echo ' <td style="color:#000; text-align:center;">'.$value['location'].'</td>';
    
    
    echo '</tr>';                       
}

  
  
?>
</table>
    </div>


<div class="box" id="box">
                 
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
        url: URL+"group/group_list_load_more?lastGroupIndex=" + $(".group_index:last").attr("id"),
        //data: {myIndex : $(".friend_profile").attr("id")},
        success: function(obj)
        {
            
           // alert(obj);
            
            if(obj)
            {
               
               $('div#loadMore').hide();
               $('#all_groups_table').append(obj);
               $("div#text").show();
                 ajaxReal = true;
            }
          else
          {
              $('div#text').replaceWith('<div id="finished_loading" class="box"><center>finished loading all meetings</center></div>');
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
        url: URL+"group/group_list_load_more?lastGroupIndex=" + $(".group_index:last").attr("id"),
        //data: {myIndex : $(".friend_profile").attr("id")},
        success: function(obj)
        {
            
           // alert(obj);
            
            if(obj)
            {
               
               $('div#loadMore').hide();
               $('#all_groups_table').append(obj);
               $("div#text").show();
                 ajaxReal = true;
            }
          else
          {
              $('div#text').replaceWith('<div id="finished_loading" class="box"><center>finished loading all meetings</center></div>');
                $("div#loadMore").hide();
          }
        
       }
   });
 
 
 }

</script>