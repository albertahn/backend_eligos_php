




           <h1 style="text-align: center; margin-bottom: 20px;">Major</h1>
           
                <a style="margin-bottom: 20px; float:right;" href="<?php echo URL?>major/create_major_page" class="btn" ><img src="http://sharebasket.com/public/images/AddButton.png" style="width:20px;">Create A Major</a>

                         
                 
              <?php
              
             echo'<table class="major" style="float: left;width:40%" id="'.$this->user_profile['index'].'">
                 <tr>
                       
                       
                       <th>Your Major</th>
                      
                       
                 </tr>
                 
<tr><td colspan="3"><hr /></td></tr>
                ';
             
   
             foreach($this->user_major_switch as $key => $value){
                    //id maker
      echo '
          <tr>
             
             
              
         <td class="membersIndex" id="'.$value['index'].'" style="width: 10px;">
             
                 <a href="'.URL.'major/inside_major/'.$value['index'].'" >'.$value['name'].'</a>
                     </td>';
                   
  
                }//end foreach
                
                echo'</table>';
                
 //other majors               
                
                echo'<table class="major" style="float:right;width:40%" id="'.$this->user_profile['index'].'">
                 <tr>
                       
                       
                       <th>Other Majors</th>
                      
                       
                 </tr>
                 
<tr><td colspan="3"><hr /></td></tr>
                ';
             
   
             foreach($this->all_majors as $key => $value){
                   
      echo '
          <tr>
             
             
              
         <td class="membersIndex" id="'.$value['index'].'" style="width: 10px;">
             
                 <a href="'.URL.'major/inside_major/'.$value['index'].'" >'.$value['name'].'</a>
                     
                     </td>';
                   
  
                }//end foreach
                
                echo'</table>';
              ?>
                
             
                 
                 
           
         

             
                 
                 
           
         
