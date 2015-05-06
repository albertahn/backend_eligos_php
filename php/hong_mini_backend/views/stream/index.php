<?php

 if (session::get('loggedin')==false){
     
     echo'
          



<div id="main_page_register" style="width: 100%; left: 0; position: absolute;">
   <div class="before_login_stuff" >
         <h1>SHARING HAPPINESS</h1>
        <p class="transparent_text">Share Basket is an exclusive marketplace for Cal Bears. Join and share the joy.</p>
      ';
     
     echo'    <br />
    
    <div id="fb-root" ></div><script src="http://connect.facebook.net/en_US/all.js
#appId=226061124076656&amp;xfbml=1"></script><fb:facepile data-width="70" style="margin-right:10px; " data-colorscheme="dark"></fb:facepile>
     
<br /><br /> <br />                    ';
     

    require 'views/invite/index.php';

    
    //stream for the thing
    echo'<br /><br /> <br /><br /><br />';
    
echo'</div>'; // end before_login_stuff   
//entry stream  
    echo'<div id="entry_stream">';
  
    foreach($this->inside_product AS $key=> $value){
    
    if(!empty($value['main_picture']))
        {
    
    
$db=new database;
$sth= $db->prepare('SELECT * FROM `member_has_meeting` WHERE `meeting_index`= :meeting_index AND `members_index`=:members_index');
$sth->execute(array(
           ':meeting_index'=>$value['index'],
           ':members_index'=>session::get('index')
));

$member_has_meeting=$sth->fetch();

    
 echo'   <div class="stream_item"> 
         <table class="meeting_table" style="width:200px;">
         
          <tr><th align="left" class="sfancy_background">
          ';
          if(!empty($value['main_picture'])){
                 echo '<a href="'.URL.'product/inside_product/'.$value['index'].'" onClick="return false" onmousedown="window.open(this.href)"><img src="'.PRODUCTS_PIC.'/'. $value['main_picture'].'" style="width:200px; display: block;margin-left: auto;margin-right: auto" /></a>';
                 }else{
                     echo'';
                 }
      
      echo'</th></tr> 
          <tr><th align="center" class="sfancy_background">'.$value['name'].'
          
          </th></tr>
          <tr>
          <th align="left" class="sfancy_background">';
     echo' <div id="in_or_out_basket_'.$value['index'].'"> ';
//in basket or out basket for user
        if (session::get('loggedin')==true) {
          
             
 }
 else
     {echo "";
 }
      echo'</div>
          </th>
          </tr>';
      
//***********************************************facebook chat---------------------
 echo'<tr><th>';
     
     
echo'</th></tr>';


echo'</table>';


echo ' </div>'; 


      }


}//end stream item for each

echo'</div>';  // end  id="entry_stream"



echo'</div>';  //end div for entry






 }else{ // if logged in



foreach($this->inside_product AS $key=> $value){
    
    if(!empty($value['main_picture']))
        {
    
$db=new database;
$sth= $db->prepare('SELECT * FROM `member_has_meeting` WHERE `meeting_index`= :meeting_index AND `members_index`=:members_index');
$sth->execute(array(
           ':meeting_index'=>$value['index'],
           ':members_index'=>session::get('index')
));

$member_has_meeting=$sth->fetch();

    
 echo'   
         <div class="stream_item"> 
         <table class="meeting_table" style="width:200px;">
         
          <tr><th align="left" class="sfancy_background">
          ';
          if(!empty($value['main_picture'])){
                 echo '<a href="'.URL.'product/inside_product/'.$value['index'].'" onClick="return false" onmousedown="window.open(this.href)"><img src="'.PRODUCTS_PIC.'/'. $value['main_picture'].'" style="width:200px; display: block;margin-left: auto;margin-right: auto" /></a>';
                 }else{
                     echo'';
                 }
      
      echo'</th></tr> 
          <tr><th align="center" class="sfancy_background">'.$value['name'].'
          
          </th></tr>
          <tr>
          <th align="left" class="sfancy_background">';
     echo' <div id="in_or_out_basket_'.$value['index'].'"> ';
//in basket or out basket for user
        if (session::get('loggedin')==true) {
          
             
 }
 else
     {echo "";
 }
      echo'</div>
          </th>
          </tr>';
      
//***********************************************facebook chat---------------------
 echo'<tr><th>';
     
     
echo'</th></tr>';


echo'</table>';

echo ' </div>'; //end stream item


      }


 }

 }

?>
     
