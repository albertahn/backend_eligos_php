

$(document).ready(function(){
    
   var content = document.getElementById("content");
var width=parseInt(content.style.width);

//now add 10 to the width
content.style.width = (width + 300)+"px";

});

function makeTickets(){
     //$('p#toastmasters_roles').replaceWith('<p id="meeting_roles"></p>'); 
    $('p#made_tickets').replaceWith('<p id="made_tickets"></p>'); 
    
//num of tickets    
    var num_tickets;
   num_tickets = document.getElementById('number_of_tickets_box').value;
   
   for (var i =1; i <= num_tickets; i++)
   {
    //random vars
             var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
                var string_length = 8;
                var randomstring = '';
                for (var j=0; j<string_length; j++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
                 }
    
   
   
     $('p#made_tickets').append('ticket '+i+' <input type="text" name="'+i+'" value="'+randomstring+'" /><br />');
  
    }// end ticket numbers
}