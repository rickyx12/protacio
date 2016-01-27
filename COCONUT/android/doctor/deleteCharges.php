<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$ro = new database2();

echo "<Br><br><Br>";

echo "<div style='background:#47a3da; margin:10px; height:100px; width:500px; border-radius:15px;' >";
echo "<center><br><br>";
echo "<font color='white'><b>Delete ".$ro->selectNow("patientCharges","description","itemNo",$itemNo)."?</b></font>";
echo "</div>";
echo "<Br>";

echo "<div style='border:0px; width:500px;'>";
echo "<center>";
echo "<table border=0 width='100%'>";
echo "<tr>";
echo "<td>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/android/doctor/deleteCharges1.php");
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<input type='submit' style='width:100px; height:50px; background:#47a3da; border:0px; border-radius:50px; color:white; font-weight:bold;' value='Yes'>";
$ro->coconutFormStop();
echo "</td>";


echo "<td align='right'>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/android/doctor/viewHospitalCharges.php");
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<input type='submit' style='width:100px; height:50px; background:#47a3da; border:0px; border-radius:50px; color:white; font-weight:bold;' style='width:100px; height:50px;' value='No'>";
$ro->coconutFormStop();
echo "</td>";

echo "</tr>";
echo "</table>";
echo "</div>";


?>
