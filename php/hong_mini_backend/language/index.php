<?php

/*
 * this is the language main index
 */


        
       
switch(session::get('language')){
case "en":
    
   require("all/eng.php"); // where the content in english is stored
break;
case "ko":
   
require("all/kor.php"); // where the content in chinese is stored
break;
case "ch":
//require("lang/chinese.php");
break;

case "zh-cn":
//require("lang/chinese.php");
break;

default:
    
require("all/eng.php");
break;

} 
     
    


?>
