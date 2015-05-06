<!-- index for news feed-->
<h1 class="header">News Feed</h1>


<?php



$merge=array_merge($this->has_group, $this->has_friend);

$merge2=array_merge($merge, $this->friend_request_role);

$len=sizeof($merge2);



function mySort( array $a, array $b)
{
    if ($a['timestamp'] == $b['timestamp']) {
        return 0;
    }
    return ($a['timestamp'] < $b['timestamp']) ? -1 : 1;
}

foreach ($merge2 as $key=> $value)  {
    usort($merge2, mySort);
    
    

}
/**
foreach ($merge2 as $key=> $value) {
    echo $value['timestamp'].'<br />';
    

}
 * 
 */

      // now show
for($i=0; $i<$len; $i++){
    
      switch ($merge2[$i]['news_type']) {
          
          
//when it is a group a friend has joined
          
    case 'has_group':
        echo '<ul><li style="list-style:none;">';
        echo '<span style="color:red;">
            <div style="float:left; height:70px;">
                <div style="float:right;">
            <img class="news_members_pic" src="'.MEMBERS_PIC.'/'.$merge2[$i]['requestor_profile_picture'].'" width="50px" height="50px"  alt="picture"   />
                 </div>
                 <div style="text-align:center; color:black;">'
        .$merge2[$i]['requestor_name'].'
                 </div>
            </div>
                &nbsp; has joined group &nbsp;
                
            <img class="news_group_pic" src="'.GROUPS_PIC.'/'.$merge2[$i]['group_pic'].'" width="50px" height="50px"  alt="picture"   />&nbsp;
                <span style ="color:black;">'.$merge2[$i]['group_name'].'</span>
                <div style="font-size:11px; color:white;">'.$merge2[$i]['timestamp'].'</div></span><br />';
        echo '</li></ul>
            <hr />';
        break;
//when it is a friend adding a new friend
    case 'friends':
        echo '<br />'.$merge2[$i]['my_name'].'
            <img class="news_members_pic" src="'.MEMBERS_PIC.'/'.$merge2[$i]['my_pic'].'" width="50px" height="50px"  alt="picture"   />
                &nbsp; has friended &nbsp;
                '.$merge2[$i]['friend_name'].'
                 <img  src="'.MEMBERS_PIC.'/'.$merge2[$i]['friend_pic'].'" width="50px" height="50px"  alt="picture"   />
                <div style="color:white; font-size:11px;">
                '.$merge2[$i]['timestamp'].'</div><br />
                    <hr />';
        break;
//when a friend requested a role
    case 'request_role':
        echo '<span style="color:blue;">
            <img class="news_members_pic" src="'.MEMBERS_PIC.'/'.$merge2[$i]['profile_picture'].'" width="50px" height="50px"  alt="picture"   />
            &nbsp;'.$merge2[$i]['friend_username'].'
                &nbsp; has requested a role &nbsp; 
               <span style="color:black;"> '.$merge2[$i]['role'].' </span>
                    &nbsp;for meeting: &nbsp; 
                 <span style="color:black;">   '.$merge2[$i]['meeting_name'].'</span>
            <div style="color:white; font-size:11px;">'.$merge2[$i]['timestamp'].'</div></span><br />
                <hr />';
        break;
    
      }
}

?>