<h1 style="text-align: center;margin-top: 70px;">Changing For The Better</h1>
<a style="margin-bottom: 20px;" href="<?php echo URL?>product/create_product_page" class="btn" ><img src="http://sharebasket.com/public/images/AddButton.png" style="width:20px;">  Create A Habit</a>
 

 <div class="stream_item"> 
         <table style="width:100%;" class="table table-hover">
             <tr>
                 <th>Habit</th>
                 <th>People On This Habit</th>
                 <th>Go</th>
             </tr>

<?php


if(!empty($this->category_change[0])){

foreach($this->category_change AS $key=> $value){
    
    
    
$db=new database;
$sth= $db->prepare('SELECT * FROM `members_view` WHERE `index` IN(SELECT `members_index` FROM `member_has_course` WHERE `course_index`= :course_index)');
$sth->execute(array(
           ':course_index'=>$value['index']
));

$member_has_habit=$sth->fetchAll();

$count_ppl=$sth->rowCount();
      
      echo'
          <tr>
                <th><a class="btn btn-info" href="'.URL.'product/inside_product/'.$value['index'].'">'.$value['name'].'</a>
                   
                </th>';
      
       echo'<th>';
       echo'<div style="float:left; margin: 5px;">('.$count_ppl.')</div>';
      
         
       foreach ($member_has_habit as $key1 => $value1){
       
           
           echo'<img src="'.URL.'public/uploads/members_pic/'.$value1['profile_picture'].'" style="width:30px; height:30px; float:left;" />';
       }
       
        echo'</th>';
       
        //count
        //
        echo'<th><a class="btn" href="'.URL.'product/inside_product/'.$value['index'].'"><img src="'.URL.'public/images/ArrowRight.png" /></a></th>';
// people in it.                
     
         /* 
             
            echo'<th>';  //add or delete
      
           echo' <div id="in_or_out_basket_'.$value['index'].'"> ';
//in basket or out basket for user
            if (session::get('loggedin')==true) {


          if(empty($member_has_meeting['index'])){
              echo'<a onClick="return false" onmousedown="javascript:putInBasket('.$value['index'].')"><img src="'.URL.'public/images/Plus.png" style="width:20px;" /></a>';
            //  print_r($member_has_meeting);

          }
          else{
              echo'<a onClick="return false" onmousedown="javascript:takeOutBasket('.$value['index'].')"><img src="'.URL.'public/images/Cross.png" style="width:20px;" /></a>';
             // print_r($member_has_meeting);
          }
             }
             else
                 {echo "";
             }
                  echo'</div>'; 
         echo' </th>';  //end add or delete
          
         */
         

         echo' </tr>';   //end whole tr
      

}


} //endif(!empty($this->category_change[0])){
else{
    
    echo '<span style="color:#888; text-align:center;">Nobody posted here yet. Why not be the first~!</span>';

    echo'';
    
}

//print_r($this->in_habit);

?>
    
        
         
</table>
     
</div>  <!--end stream item-->