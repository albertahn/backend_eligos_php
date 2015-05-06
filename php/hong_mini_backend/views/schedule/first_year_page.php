<h1 style="text-align: center;margin-top: 70px;">Select Your First Year Of School</h1>

<h4 style="text-align: center;margin-top: 10px; color: #bbb">What Year Were You A Freshman?</h4>


<div class="progress">
  <div class="bar" style="width: 20%;">20% Completed</div>
</div>

<form style="margin-top: 100px; text-align: center;"  enctype="multipart/form-data" method="post" action="<?php echo URL; ?>schedule/submit_first_year">
    
    <span style="font-weight: bold;font-size: 18px;">First Year:  </span><select name="year" id="year">
        <option value="08">2008</option>
        <option value="09">2009</option>
        <option value="10">2010</option>
        <option value="11">2011</option>
        <option value="12">2012</option>
        <option value="13">2013</option>
        <option value="14">2014</option>
        <option value="15">2015</option>
        
    </select>
    <br /> 
    <span style="font-weight: bold;font-size: 18px;">Season:  </span><select name="season" id="year">
        <option value="fall">Fall</option>
        <option value="spring">Spring</option>
       
        
    </select>
    <br />
    
    <input type="submit" class="btn btn-primary" />
    
</form>