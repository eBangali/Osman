<script>
if(navigator.geolocation)
{
navigator.geolocation.getCurrentPosition(showPosition, uSererror, {enableHighAccuracy:true,timeout:5000});
}
//
function showPosition(position)
{
var uSerlati = position.coords.latitude;
var uSerlong = position.coords.longitude;
//
$(document).ready(function(){ 
//
$.ajax({
type: "POST",
url: "<?php echo themeResource; ?>/a-common-gps.php",
data: {uSerlati: position.coords.latitude, uSerlong:position.coords.longitude},
dataType: 'json',
success: function(data){
//alert("Data: " + data + "\nStatus: " + status);
},
error: function(){
}
});
//
}); 
}
//
function uSererror(whicherror)
{
//if (whicherror.code==1) { alert("Permission Denied"); }
//if (whicherror.code==2) { alert("Network or Satellites Down"); }
//if (whicherror.code==3) { alert("GeoLocation timed out"); }
}
</script>
<?php include_once (eblayout.'/a-common-gps.php'); ?>