<?php
include("../../../myDatabase2.php");
$batchNo = $_GET['batchNo'];
$registrationNo = $_GET['registrationNo'];
$room = $_GET['room'];
$username = $_GET['username'];

$ro = new database2();

?>

<script style="text/javascript">

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
    document.getElementById("livesearch").style.border="0px solid #47a3da";
    }
  }
xmlhttp.open("GET","searchAvailableMedicineNow.php?searchFrom="+document.addCharge.searchFrom.value+"&searchBy="+document.addCharge.searchBy.value+"&username="+document.addCharge.username.value+"&batchNo="+document.addCharge.batchNo.value+"&registrationNo="+document.addCharge.registrationNo.value+"&charges="+document.addCharge.availableCharges.value+"&room="+document.addCharge.room.value,true);
xmlhttp.send();
}
</script>


<?php
echo "<body>";
echo "<div style='background:#47a3da; margin:10px; height:60px; width:350px; border-radius:15px;' >";
echo "<br><center>";
echo "<table border=0>";
echo "<tr>";
echo "<td>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/android/doctor/mobileAddCharges_charges.php");
$ro->coconutHidden("batchNo",$batchNo);
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("room",$room);
$ro->coconutHidden("username",$username);
echo "<input type='submit' style='background:#47a3da; border:0px; color:white; font-weight:bold; font-size:20px;' value='Charges'>";
$ro->coconutFormStop();
echo "</td>";

echo "<td>";
$ro->coconutFormStart("post","#");
echo "<input type='submit' style='background:#47a3da; border:0px; color:#47a3da; font-weight:bold; font-size:20px;' value='Medicine'>";
$ro->coconutFormStop();
echo "</td>";

echo "<td>";
$ro->coconutFormStart("post","#");
echo "<input type='submit' style='background:#47a3da; border:0px; color:yellow; font-weight:bold; font-size:20px;' value='Medicine'>";
$ro->coconutFormStop();
echo "</td>";

echo "</tr>";
echo "</table>";
echo "</div>";

echo "

<form name='addCharge'>
<input type='text' name='availableCharges' style='background:#FFFFFF no-repeat 4px 4px;
	padding:4px 4px 4px 2px;
	border:1px solid #47a3da;
	width:350px;
	height:25px;
	margin:10px;' 
	placeholder='Search Medicine' 
	onkeyup='showResult();'
	autocomplete='off' >

<br>
<font size=2>Search Mode:</font>&nbsp;<select name='searchBy' style='border: 1px solid #000; color: #000;'>
<option value='description'>Brand Name</option>
<option value='genericName'>Generic</option>
</select>

";
$ro->coconutHidden("batchNo",$batchNo);
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("room",$room);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("searchFrom","PHARMACY");
echo "</form>";
echo "<div id='livesearch' style='background:#47a3da; margin:10px; height:auto; width:400px; border-radius:15px;' ></div>";
echo "<br><br>";

echo "<table border=0 width='300px;'>";
echo "<th>";
echo "<form method='post' action='http://".$ro->getMyUrl()."/COCONUT/android/doctor/viewPatient_information.php' target='_parent'>";
//$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/android/doctor/viewPatient_information.php");
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<input type='submit' style='border-radius:10px; background:#47a3da; color:white; font-size:20px; border:0px;' value='Profile'>";
$ro->coconutFormStop();
echo "</th>";

echo "<th>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/android/doctor/mobileSOAP.php");
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<input type='submit' style='border-radius:10px; background:#47a3da; color:white; font-size:20px; border:0px;' value='S.O.A.P'>";
$ro->coconutFormStop();
echo "</th>";



echo "</body>";

?>




