<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$itemNo = $_GET['itemNo'];


$ro = new database();
$ro->getPatientProfile($registrationNo);

/*
$ro->getBatchNo();
$myFile = "/opt/lampp/htdocs/COCONUT/trackingNo/batchNo.dat";
$fh = fopen($myFile, 'r');
$batchNo = fread($fh, 100);
fclose($fh);
*/


//selectNow($table,$cols,$identifier,$identifierData)

//if( $ro->selectNow("registeredUser","module","username",$username) != "PHARMACY" && $ro->selectNow("registeredUser","module","username",$username) != "BILLING" ) {
//echo "<br><Br><Br>";
//echo "<center><div style='border:1px solid #FF0000; width:800px; height:70px;	'>";
//echo "<br><font size=2 color=red>Simula Dec 26, 2012 Pharmacy na lamang ang mag eencode ng medicine at supplies, magbigay na lamang kayo ng reseta sa pasyente at pharmacy na ang bahala mag encode</font>";
//echo "</div>";
//}else {

?>

<script src="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/serverTime/serverTime.js"></script>
<script type='text/javascript'>


function showResult()
{
    
if (document.addCharge.availableCharges.value.length==0)
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
xmlhttp.open("GET","searchAvailableMedicineNow_changeItem.php?username="+document.addCharge.username.value+"&itemNo="+document.addCharge.itemNo.value+"&registrationNo="+document.addCharge.registrationNo.value+"&charges="+document.addCharge.availableCharges.value,true);
xmlhttp.send();
}





var charges = 'Search Medicine';
function SetMsg (txt,active) {
    if (txt == null) return;
    
 
    if (active) {
        if (txt.value == charges) txt.value = '';                     
    } else {
        if (txt.value == '') txt.value = charges;
    }
}

window.onload=function() { SetMsg(document.getElementById('charges', false)); }

</script>


<?php
echo  "<body onload='DisplayTime();'>";
echo "<form name='addCharge'>";
echo "&nbsp;<input type=text name='availableCharges' id='charges' style='   
	background:#FFFFFF no-repeat 4px 4px;
	padding:4px 4px 4px 2px;
	border:1px solid #CCCCCC;
	width:400px;
	height:25px;' class='txtBox'
	onfocus='SetMsg(this, true);'
    	onblur='SetMsg(this,false);'
	onkeyup='showResult();' 
	value='Search Medicine'
>";
echo "<input type=hidden name='itemNo' value='$itemNo'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "</form>";
echo "<div id='livesearch'></div>";
echo "</body>";

//}

?>
