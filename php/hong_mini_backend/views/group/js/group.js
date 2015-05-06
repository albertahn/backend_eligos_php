function going(){
    
    
    
    var chosenoption=document.getElementById("groupType").selectedIndex;
    
 
 switch(chosenoption)
 {
     
        case 0:
            
        
            
              document.getElementById("password").disabled=false;
             document.getElementById("password2").disabled=false;
           
            
            break;
            
        case 1:
              document.getElementById("password").disabled=true;
               document.getElementById("password2").disabled=true;
           
            
            break;
            
            case 2:
              
                
             document.getElementById("password").disabled=true;
               document.getElementById("password2").disabled=true;
                break;
     
     
     
     
     
     
 }


}

//page switch

function changeGroupPanel(cv, group_index){
    //alert(group_index);
    
      
    
       // switch use and make bottom disapear   $('.meetings_panel').css("border-bottom", "hidden");
    
    $("#group_content").html('<img src="'+URL+'/public/images/bigLoader.gif" width="50" alt="loader" />').show();
        //change this later
	var url=URL+'ajax_loader/group_switch_content';
	$.post(url,{contentVar: cv, group_index: group_index}, function(data){
	 $("#group_content").html(data).show()
	 
	 });
    
    //change the tab color
    
    switch(cv){
    case 'group_members':
      
        
        $("#meetings_panel").css('background', '#888');
        $("#rankings").css('background', '#888');
       $("#group_members").css('background', '#ebebe8');
       $("#group_members").css('color', '#000');
        
        break;
    case 'rankings': 
          $("#meetings_panel").css('background', '#888');
        $("#rankings").css('background', '#ebebe8');
        $("#rankings").css('color', '#000');
       $("#group_members").css('background', '#888');
            
            break;

    default :
        
        break;    
     }
    
}