
function blueprintCourseInsert(id){
    
    
    $("#clicked_class_index").val(id);
   
                        $('.blueprint_insert_dialog').dialog('open');
                        //$(".cam_button").button();

}

function insertBlueprintMajor(season, table){
    
   clickedClassIndex=$("#clicked_class_index").val();
    
    
    $.ajax({
        type: 'POST',
        url: URL+"major/input_blueprint/",
        data: { 'season': season,
               'year': table,
               'class_index': clickedClassIndex},
       
        success: function(obj)
        {
            
            obj=jQuery.parseJSON(obj);
           
            
        $("#year"+obj['year']+obj['season']).append('<tr><th id="course'+obj["course_index"]+'"><a class="classbp_inserted" href="'+URL+'product/inside_product/'+obj['course_index']+'">'
                 +obj['abbreviation']+'</a></th><tr>');
            
          //  alert(obj);
            
           
       
       }
       
        
   });
    
    
    //$('.blueprint_insert_dialog').dialog('close');  //close 
    
    
}