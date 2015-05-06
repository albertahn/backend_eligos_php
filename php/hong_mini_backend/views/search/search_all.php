<?php

//all users 

echo '<a href="'.URL.'user/all_users" class="uiButton" style="float:right;">See all users</a>';



//sort by name
echo '<p class="line_break">Users</p>';
 foreach ($this->search_user as $key => $value) {
                
       echo'<div style="border-bottom: 1px solid #ccc; border-radius:10px; margin-top:22px;"><a href="'.URL.'user/user_profile/'.$value['index'].'">
           <img style=" margin-top:10px; float:right;" src="'.URL.'/public/images/arrow.png"/>
             <li style=" float:left; display: list-item; list-style: none;  text-align: center; overflow:hidden;">
                    <div>
                             <img src="'.MEMBERS_PIC.'/'.$value['profile_picture'].'"  alt="picture" style="background:#005554; border-right: 2px solid #ccc; border-bottom: 2px solid #fff; width:50px; height:50px; border-radius: 10px; float:left;"  />
                     </div><br />
                     <div style=" width:40px; font-size:11px; height:20px; overflow:hidden; float:left;">'.$value['username'].'
                     </div>
                     
            </li>';
       
            
       
        echo '<div style="border-radius:2px; height:70px; overflow:hidden;"><br />'.$value['profile'].
                '</div>
                    
                      </a>
                    
          </div>';
       
       
        }


//search product by name
echo '<p class="line_break">Courses</p>';

foreach ($this->search_product_name as $key => $value) {
    echo'<div style=" border-radius:10px; margin-top:22px;"><a href="'.URL.'product/inside_product/'.$value['index'].'">
          ';
       
            
       
        echo '<div style=" height:70px; overflow:hidden; border-bottom:solid 1px #ccc;">'.$value['abbreviation'].'&nbsp;'.$value['name'].':<br />'.$value['description'].
                '</div>
                    
                      </a>
                    
          </div>';
}

//search product by category





//search group by name

echo '<p class="line_break">Major</p>';

foreach ($this->search_group_name as $key => $value) {
    echo'<div style="background: url('.URL.'public/images/ring.jpg); border-radius:10px; margin-top:22px;"><a href="'.URL.'group/inside_group/'.$value['index'].'">
           <img style=" margin-top:10px; float:right;" src="'.URL.'/public/images/arrow.png"/>
             <li style=" float:left; display: list-item; list-style: none;  text-align: center; overflow:hidden;">
                    <div>
                             <img src="'.GROUPS_PIC.'/'.$value['group_pic'].'" width="50px" height="50px"  alt="picture" style="background:#005554; border-right: 2px solid #ccc; border-bottom: 2px solid #fff; border-radius: 10px; float:left;"  />
                     </div><br />
                     <div style=" width:40px; font-size:11px; height:20px; overflow:hidden; float:left;">'.$value['name'].'
                     </div>
                     
            </li>';
       
            
       
        echo '<div style="border-radius:2px; color: white; height:70px; overflow:hidden;">&nbsp;location:<br />'.$value['location'].
                '</div>
                    
                      </a>
                    
          </div>';
}


// search group by location






?>