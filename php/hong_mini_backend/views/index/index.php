<?php


     echo '
<!-- Begin youtube vid -->

<div id="mc_embed_signup" style="width: 400px;
position: absolute;
background: rgb(111, 106, 106);
top: 170px;
left: 70px;
opacity: .8;
padding: 10px;
border-radius: 10px;
z-index:20;">


<iframe width="400" height="225" src="http://www.youtube.com/embed/4iRxfJGVW9E" frameborder="0" allowfullscreen></iframe>

</div>

<!--End youtube-->';
     
     echo'
<div id="main_page_register" >

   <div class="before_login_stuff" >
   
<iframe src="http://www.facebook.com/plugins/facepile.php? 
app_id=141896069328369" scrolling="no" frameborder="0" style="left: 500px; top:300px; position:absolute; border:none;  
overflow:hidden; width:200px;" allowTransparency="true"></iframe> 
   
         <p style="font-size: 45px; margin-top: 40px; color: white; font-family:my_font_family;">Change Your Habits Then Change The World.</p>
         
        ';
     
     

   // require 'views/invite/index.php';

    
    //login part or register
     if(session::get('loggedin')==false){
   echo  '<div id="reg_front" style="float:right">
     
<p class="header" style="color:#fff;font-family: "My Custom Font", Verdana, Tahoma;">Start Instantly</p>

<a href="#" onclick ="javascript:registerValidPerson();"><img src="'.URL.'public/images/flogin.png" style="margin-right:auto; margin-left:auto; margin-top:30px;  display: block; " ></a>
<p class="header" style="color:#fff; font-family: \'My Custom Font\', Verdana, Tahoma;"> or </p> 
<div><a href="'.URL.'register" class="header btn btn-warning" style="color:rgb(51, 123, 172); padding-top: 10px; color: white; height: 30px; width: 320px; font-size: 20px; display: block; margin: auto;"> Create A New Account </a></div>
 </div>
 ';
     } 
    
echo'</div>'; // end before_login_stuff   
//entry stream  
    




echo'</div>';  //end div main page register
//make the intro


echo'
    

    
<div class="intro-content container-fluid" style="z-index:20;">
    <div class="content">
        <div class="row-fluid">
           
            <div class="span4 offset1" style="margin-left:0px; font-family: my_font_family;">

            <h3 style="">Login</h3>
            <h4 style="" class="pagination-centered">Log in through Facebook or Register</h4>

            
            </div>
            
            <div class="span4" style="font-family: my_font_family;">
            <h3 style="">Create or Add a Habit</h3>
            <h4 class="pagination-centered" style="">
            Quickly and Easily find habits that others are building or create your own habits that will become a better person
            </h4>
            </div>
            
            <div class="span4" style="font-family: my_font_family;">
            <h3 style="">Share</h3>
            <h4 style="" class="pagination-centered">
            Keep your friends up to date with your habits and encourage them to never give up
            </h4>
            
            </div>
        </div>
    </div>
</div>';





?>

<?php
      $db= new database();

$sth = $db->prepare('SELECT * FROM `bp_examples_view`  ORDER BY `has_course_index` DESC LIMIT 0,2000');
        $sth->execute();
        
       $bp_examples= $sth->fetchAll();


?>
     

<div id="under_steps">
    <div id="people_example"> 
    <h3 style="text-align: center;">People of Change</h3>
  
    <div id="myCarousel" class="carousel slide" style="margin-top: 50px;" data-interval="2000">
  
  <!-- Carousel items -->
  <div class="carousel-inner">
        
                
            <?php
          
                 
 //create a array of unique member indexes            
       
            
   
  //for each unique example get data of the tables , we got the bp_examples
            $person_unique = array();
        
        foreach($bp_examples as $key=>$value){
            
            $person_unique[$key]=$value['members_index'];
        }
        
        $person_unique=array_unique($person_unique);
        
      //  print_r($person_unique);
           
       foreach($person_unique as $key=>$value){
           
           
    //make sure to input data within the cluster       
           echo'<div class="item" id="example'.$key.'">
                <div class="cluster" style="height: 100px;">';
           
           //echo the table and if the $this->bp_examples['member_index']==$value : 
           echo '<a href="'.URL.'user/user_profile/'.$value.'" style="position:absolute; left: 0px;top: 0px;" > 
               <img src="'.URL.'public/uploads/members_pic/'.$bp_examples[$key]['profile_picture'].'" style="border-radius:10px;height:70px; width:70px; "/>
                   <span style="float:left;padding:5px;">'.$bp_examples[$key]['members_username'].'</span></a>';
                  
           
                          
                                
                                   if($bp_examples[$key]['members_index']==$value){
                                      
                                    echo '<div class="courseName">'.$bp_examples[$key]['course_name'].'</div>';
                                     echo '<div class="successDays">'.$bp_examples[$key]['day'].' days, '.$bp_examples[$key]['success'].'  successes</div>';
                                    

                                   } //end when fall
                           
                           
                       
                   

           
           echo'</div>'; //end cluster
            echo'</div>'; // end item
           
       }
       
                    
                    
            
            ?>
                
                     
  </div>  <!--end carosel inner-->
  <!-- Carousel nav -->
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>   <!--end myCarousel -->
	
</div> <!--end people example-->
        
        
<div id="blogs">
    <h3 style="text-align: center;">Need Motivation?</h3>
    <div id="blog_list">
    <a href="<?php echo URL;?>blog/motivation" class="btn btn-info">Motivational Blog</a>
    <br />
    
    <a href="<?php echo URL;?>blog/change_and_success" class="btn btn-warning" style="margin-top:10px;">Change & Success Blog</a>
    
    
    
    </div>
</div>   
    
    
</div>  <!--end uner-->

<script>
   $('#example0').attr('class','item active');
  
</script>