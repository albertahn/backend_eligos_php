<p class="header" style="background:#aaa; margin-top:20px; ">You already have the code? </p><p>Please type your Berkeley email and insert the code.</p>
<form enctype="multipart/form-data" method="post" action="<?php echo URL; ?>invite/verify_code" >
    *Berkeley email: <input type="text" name="org_email" id="org_email" value="<?php echo $this->berk_email;?>" placeholder="email" />
    <p id="invite_code_warning" style="display: none; color:red;">Not a valid email of a registered school.</p>
    <br />*code: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" name="code" value="<?php echo $this->code;?>" />
<label>&nbsp;</label><input type="submit"/>
</form>

<script>
$(document).ready(function(){
     
     
        var emailInput= document.getElementById("org_email");   
        
      if(emailInput){
          
          emailInput.oninput = function () {
    
                     checkEmail();
   
            }
      }

    
    });

</script>