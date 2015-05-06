
<h1 style="margin-bottom: 50px;">Commemoration to professor Steve Beck</h1>


<a href="<?echo URL;?>beck/login_page" class="btn btn-primary">Click if you are Professor Beck</a>

<a href="<?echo URL;?>beck/upload_page" class="btn btn-warning">Click to submit homework</a>

<p style="color:blue;margin-top: 10px;">*if you have any questions contact Joong Hyuk An at contendera@gmail.com or call him at 510-701-4059</p>

<h4 style="margin-top: 100px;">Check homework submission below</h4>

<table class="show_all">
    <tr>
        <th>id</th>
        <th>Name</th>
        <th>email</th>
        <th>major</th>
        <th>File Name</th>
        <th>Date and Time</th>
        <th>Download</th>
    </tr>
    
    <?php 
    
    foreach($this->uploads as $key=>$value){
        
        echo'<tr>';
        
           echo'<td>'.$value['index'].'</td>';
         echo'<td>'.$value['name'].'</td>';
          echo'<td>'.$value['email'].'</td>';
          echo'<td>'.$value['major'].'</td>';
           echo'<td>'.$value['file_name'].'</td>';
            echo'<td>'.$value['date'].'</td>';
            
            if (session::get('professor')=='sbeck123') {
                
                echo'<td> <a href="'.URL.'beck/download_file/'.$value['file_name'].'" class="btn btn-warning">download</a></td>';
                
            }else{
                
               echo'<td> <a href="'.URL.'beck/login_page" class="btn btn-primary">download</a></td>';
            }
        
        echo'</tr>';
        
        
    }
    
    
   
    
    ?>
    
    
    
    
    
    
    
</table>

<!--fb comments-->
<div style="margin-top: 100px;" class="fb-comments" data-href="http://classblueprint.com/beck" data-width="1000" data-num-posts="10"></div>