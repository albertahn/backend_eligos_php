$(function(){
    
    $.get('dashboard/xhrGetListings', function(o){
        for (var i =0; i < o.length; i++)
            {
                $('#listInserts').append('<div>'+o[i].text+'<a class="del" rel="'+o[i].chat_id+'" href="#">x</a></div>');
            }
            
           
        $('.del').live('click', function(){
            
            delItem = $(this);
            var id= $(this).attr('rel');
           
          
           //post call            
             $.post('dashboard/xhrDeleteListing', {'id':id}, function(o){
           
         
             delItem.parent().remove();
       },'json');
       
      
       
        
        return false;
        
          });
        
    }, 'json');
    
   
    
   $('#randomInsert').submit(function(){
       var url =$(this).attr('action');
       var data = $(this).serialize();
       
       $.post(url, data, function(o){
           
       
           $('#listInserts').append('<div>' + o.text + '<a class="del" rel="'+o.chat_id+'" href="#">x</a></div>');
           
       },'json');
       
       return false;
       
   }); 
    
    
});
