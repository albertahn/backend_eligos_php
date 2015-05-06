function showMoreComments(id){
    //alert(id);
    
  var commentBox = document.getElementById("commentBox"+id);

commentBox.style.maxHeight = "1000px";


$('div#moreCommentClick'+id).hide();


    $('div#lessCommentClick'+id).show();
    
    
}


function showLessComments(id){
     var commentBox = document.getElementById("commentBox"+id);

commentBox.style.maxHeight = "300px";


$('div#moreCommentClick'+id).show();


    $('div#lessCommentClick'+id).hide();
    
    
}

//ajax put in basket

function putInBasket(meetingIndex){
    
  //  alert(meetingIndex);
     
    $('#in_or_out_basket_'+meetingIndex).html('<img src="'+URL+'/public/images/bigLoader.gif" width="50" alt="loader" />').show();
        //change this later
	var url=URL+'basket/basket/'+meetingIndex;
	$.post(url,{meeting_index: meetingIndex},
        function(data){
	 $('#in_or_out_basket_'+meetingIndex).html('<a href="#" onClick="return false" onmousedown="">Take out <img src="'+URL+'public/images/out_basket.png" style="width:20px;" /></a>').show()
	 
	 });
}

//take out basket

function takeOutBasket(meetingIndex){
    
  //  alert(meetingIndex);
     
    $('#in_or_out_basket_'+meetingIndex).html('<img src="'+URL+'/public/images/bigLoader.gif" width="50" alt="loader" />').show();
        //change this later
	var url=URL+'basket/un_basket/'+meetingIndex;
	$.post(url,{meeting_index: meetingIndex},
        function(data){
	 $('#in_or_out_basket_'+meetingIndex).html('<a href="#" onClick="return false" onmousedown="">Put in <img src="'+URL+'public/images/in_basket.png" style="width:20px;" /></a>').show()
	 
	 });
}
