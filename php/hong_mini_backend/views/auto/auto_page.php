
<h1>Automatic upload courses through school api</h1><br />
<?php

/*
echo '<pre>';
print_r($this->major_course_data);
echo '</pre>';
 */
/* this good one

foreach ($this->major_course_data->ClassOffering as $$key=>$value) {
    
    foreach($value->sections as $key1=>$value1){
    echo '<pre>';
    print_r($value1->sectionId);
    print_r($value1->sectionMeetings);
    echo '</pre>';    
    }
    
}
*/


echo'<form enctype="multipart/form-data" method="post" action="'.URL.'auto/insert_data" style="" >';
echo'<input type="hidden" name="major_abrev" value="'.$this->input.'" />';
echo'<input type="submit" value="submit" />';
echo'</form>';

foreach ($this->major_course_data->ClassOffering as $key=>$value) {
    
    echo '<h2>Class Title: '.$value->courseTitle.'</h2>';
    echo'classUID: <input type="text" name="classUID" value="'.$value->classUID.'" /><br />';
   // print_r($value->classUID);
    echo 'courseNumber: <input type="text" name="courseNumber" value="'.$value->courseNumber.'" /><br />';
    echo 'courseTitle: <input type="text" name="courseTitle" value="'.$value->courseTitle.'" /><br />';
    
      echo 'departmentCode: <input type="text" name="departmentCode" value="'.$value->departmentCode.'" /><br />';
        echo 'lowerUnits: <input type="text" name="lowerUnits" value="'.$value->lowerUnits.'" /><br />';
          echo 'termYear: <input type="text" name="termYear" value="'.$value->termYear.'" /><br />';
     
          echo'<h3>sections</h3>';
         if(!empty($value->sections)){
          
             if(count($value->sections)>1){
             
                      foreach ($value->sections as $key1=>$value1) {
                          echo'<h4>'.$key1.' section'.$value1->sectionId.'</h4>';
                       echo 'sectionId: <input type="text" name="sectionId" value="'.$value1->sectionId.'" /><br />';

                       echo 'building: <input type="text" name="building" value="'.$value1->sectionMeetings->building.'" /><br />';
                        echo 'startTime: <input type="text" name="startTime" value="'.$value1->sectionMeetings->startTime.'" /><br />';
                       echo 'endTime: <input type="text" name="endTime" value="'.$value1->sectionMeetings->endTime.'" /><br />';
                       echo 'instructorNames: <input type="text" name="instructorNames" value="'.$value1->sectionMeetings->instructorNames.'" /><br />';
                       echo 'meetingDay: <input type="text" name="meetingDay" value="'.$value1->sectionMeetings->meetingDay.'" /><br />';
                        echo 'room: <input type="text" name="room" value="'.$value1->sectionMeetings->room.'" /><br />';
                      }

          
          }else{
               echo 'sectionId:<input type="text" name="sectionId" value="'.$value->sections->sectionId.'" /><br />';

                       echo 'building: <input type="text" name="building" value="'.$value->sections->sectionMeetings->building.'" /><br />';
                        echo 'startTime:<input type="text" name="startTime" value="'.$value->sections->sectionMeetings->startTime.'" /><br />';
                       echo 'endTime: <input type="text" name="endTime" value="'.$value->sections->sectionMeetings->endTime.'" /><br />';
                       echo 'instructorNames: <input type="text" name="instructorNames" value="'.$value->sections->sectionMeetings->instructorNames.'" /><br />';
                       echo 'meetingDay: <input type="text" name="meetingDay" value="'.$value->sections->sectionMeetings->meetingDay.'" /><br />';
                        echo 'room: <input type="text" name="room" value="'.$value->sections->sectionMeetings->room.'" /><br />';
              
          }
      }
}



?>

<script>
    /*
    
 $(document).ready(function (){   
     
    var majorClassData= <?php echo $theData;?>;
    var parsedMajor = jQuery.parseJSON(majorClassData);
    
console.log(parsedMajor);


    for(x in parsedMajor){
        
        $('#content').append(parsedMajor[x]);
    }


});*/
</script>
    