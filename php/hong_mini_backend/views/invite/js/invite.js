function getNow(){
                
                var currentTime = new Date()
                
                var rightNow = currentTime.getTime()/1000
                    
                    
                    document.getElementById('current_time').value=(rightNow);
                    
                         
           }
    
    
    
//verify the email of the organization


    
    /*

function checkEmail(){
    
    var inviteMail= $("#org_email").val();
    
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
                $("#invite_code_warning").show();
                
                $("#register_first_submit").attr("disabled", "disabled");
                
            }
       
       }
   });
    
}


*/