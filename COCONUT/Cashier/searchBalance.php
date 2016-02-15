<?php
include("../../myDatabase.php");

$username = $_GET['username'];

$ro = new database();

?>

<script src="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/serverTime/serverTime.js"></script>

<script type='text/javascript'>

function showResult()
{
    
if (document.addCharge.patientBalance.value.length==0)
  {
  document.getElementById("livesearch").innerHTML="";
  document.getElementById("livesearch").style.border="0px";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
    document.getElementById("livesearch").style.border="0px solid #A5ACB2";
    }
  }
xmlhttp.open("GET","searchBalance1.php?username="+document.addCharge.username.value+"&serverTime="+document.addCharge.serverTime.value+"&balance="+document.addCharge.patientBalance.value,true);
xmlhttp.send();
}





var patient = 'Search Patient with Balance';
function SetMsg (txt,active) {
    if (txt == null) return;
    
 
    if (active) {
        if (txt.value == patient) txt.value = '';                     
    } else {
        if (txt.value == '') txt.value = patient;
    }
}

window.onload=function() { SetMsg(document.getElementById('patientBalance', false)); }

</script>

<?php

echo  "<body onload='DisplayTime();'>";
echo "<form name='addCharge'>";
echo "&nbsp;<input type=text name='patientBalance' id='patientBalance' style='   
	background:#FFFFFF no-repeat 4px 4px;
	padding:4px 4px 4px 2px;
	border:1px solid #CCCCCC;
	width:400px;
	height:25px;' class='txtBox'
	onfocus='SetMsg(this, true);'
    	onblur='SetMsg(this,false);'
	onkeyup='showResult();' 
	value='Search Patient with Balance'
	autocomplete='off'
>";

echo "<p id='curTime'></p>";
echo "<input type=hidden name='username' value='$username'>";
echo "</form>";
echo "<div id='livesearch'></div>";
echo "</body>";

?>



