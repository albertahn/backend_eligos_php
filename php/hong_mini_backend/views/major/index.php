<p class="header" style="background: #aaa;
margin-top: 70px;">Select Your Major(s)</p>
<div class="progress">
  <div class="bar" style="width: 90%;">90% Completed</div>
</div>


<form action="<?php echo URL;?>major/reg_my_major" method="post">
    
   

<table style="text-align:left;">
    <?php 
    
        $i=1;
        
    
    foreach($this->all_majors as $key => $value){
        
        echo '<tr><th style="font-size: 16px;line-height: 23px;"><input type="checkbox" name="major'.$i.'" value="'.$value['index'].'" />'
                .$value['name'].
            '</th></tr>';
        $i++;
    }
    ?>
    
    
</table>

     <input type="submit" class="btn btn-primary" style="padding: 20px;width: 400px;margin-left: auto;margin-right: auto;display: block;margin-top: 20px;font-size: 25px;" />
    
    
    </form>