
<?php echo'<a href="'.URL.'product/inside_product/'.$this->meeting_info['index'].'" ><img style="width:70px; float:left;" src="'.URL.'public/images/small_back_button.png" title="back" /></a>'; ?>
<p style="clear:both;"> tickets for event in group</p>



<div id="make_tickets">
    
    <form enctype="multipart/form-data" method="post" action="<?php echo URL; ?>tickets/make_tickets_submit" >
        <span>Type number of tickets:</span>
            
     <input type="text" style="width:20px;" name="number_of_tickets_box" id="number_of_tickets_box" />
     <input type="hidden" name="meeting_index" id="meeting_index" value="<?php echo $this->meeting_info['index']; ?>"/>
   <!--how to add role 도움-->
   
    <a href="#" class="uiButton" onclick="return false" onmousedown="javascript:makeTickets();">Make Tickets</a>
    
    <p style="font-size: 12px; color:#2233aa;">number of tickets and codes</p>
    <p id="made_tickets"></p>
    
    
    
    
    
    
  <label>&nbsp;</label><input type="submit" value="make tickets"/>
    
    
    </form>
    
    
    
    
    
    
    
</div><!--end make_tickets-->





<!--current_tickets-->
<div id="current_tickets">
    <p style="text-align: center;">Current tickets</p>
    <table id="current_tickets_table">
        <tr class="table_header"><th>ticket ID</th> <th>Code</th><th>State</th><th>Given to</th><th>Reciever email</th><th>Give</th><th>Edit</th><th style="font-size:10px;">Delete</th></tr>
   <?php
   
   foreach($this->current_tickets as $key=>$value){
   echo'
   <tr><th>'.$value['tickets_index'].'</th>
       <th>'.$value['tickets_code'].'</th>
        <th style="color:red;">'.$value['state'].'</th>';
  if(!empty($value['username'])){
      echo'<th><img src="'.MEMBERS_PIC.'/'.$value['profile_picture'].'" style="width:30px; float:left;" /><div style="width:30px; float:left;">'.$value['username'].'</div></th>
          
            ';
  }else{
      echo'<th style="font-size:11px; color:#00f;">empty</th>';
  }

       echo' 
        <th style="font-size:12px;">'.$value['email'].'</th>
            <th><a href="'.URL.'tickets/give_ticket_page/'.$value['tickets_index'].'/'.$this->meeting_info['index'].'"><img src="'.URL.'/public/images/send.png" style="width:30px;" /></a></th>
       <th><a href="'.URL.'tickets/edit_ticket_page/'.$value['tickets_index'].'/'.$this->meeting_info['index'].'"><img src="'.URL.'/public/images/small_edit.png" style="width:30px; float:left;" /></a></th>
        <th><a href="'.URL.'tickets/delete_ticket/'.$value['tickets_index'].'/'.$this->meeting_info['index'].'"><img src="'.URL.'/public/images/small_minus.png" style="width:30px; float:left;" /></a></th>
   </tr>
   ';
   
  
   }
   
   ?>
    </table>
    
    
    
    
    
</div><!--end_current_tickets-->

