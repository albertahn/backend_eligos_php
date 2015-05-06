 $(document).ready(function(){
     
     
        var emailInput= document.getElementById("inviteMail");   
        
      if(emailInput){
          
          emailInput.oninput= function () {
    
     
    
                     checkEmail();
   
                
            }
      }


    
    });
    
    

function checkEmail(){
    
    
     console.log("working?");
    var inviteMail= $("#inviteMail").val();
    
    $.ajax({
        type: 'POST',
        url: URL+"invite/check_email/"+inviteMail,
       
        success: function(obj)
        {
            
            if(obj)
            {
              $("#invite_code_warning").html(obj);
              
             $("#invite_code_warning").css("color","blue");
             $("#register_first_submit").removeAttr("disabled");     
            }
            else{
                $("#invite_code_warning").css("color","red");
                $("#invite_code_warning").html('Not a valid email of a registered school.');
                $("#invite_code_warning").show();
                
                $("#register_first_submit").attr("disabled", "disabled");
                
            }
       
       }
   });
    
}




