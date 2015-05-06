<div id="strobe" style="position:fixed; width:100%;height:100%;">
    
    
    
    
</div>

<script>
$( document ).ready(function() {

$('#content').css('width','100%');

$('#content').css('margin-left','0px');

setInterval(function(){
    
   strobe();


},100);

});

var itstrobe=false;

function strobe(){
    
    if(itstrobe==false){
        
          $("#strobe").css('background','#000' );
        
        itstrobe=true;
    }else{
         $("#strobe").css('background','#fff' );
        itstrobe=false;
    }
    
    
}

</script>