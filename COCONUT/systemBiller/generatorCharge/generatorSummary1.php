<?php
include("../../../myDatabase2.php");
$chargeNo = $_GET['chargeNo'];
$username = $_GET['username'];
$ro = new database2();
$ro->coconutDesign();
echo "<Br><Br><BR><br><center>";
$ro->coconutBoxStart("500","150");
echo "<Br>";
echo "<center><font color=red>Generator Summary</font><center>";
echo "<table border=0>";
echo "<tr>";
echo "<td><font> Start: <b>". $ro->selectNow("generatorCharge","timeStart","chargeNo",$chargeNo) ."</b> </font></td>";
echo "</tr>";
echo "<Tr>";
echo "<td><font> Stop: <b>". $ro->selectNow("generatorCharge","timeStop","chargeNo",$chargeNo) ."</b> </font></td>";
echo "</tr>";
echo "<Tr>";
echo "<td><font>Minutes: <b>". $ro->selectNow("generatorCharge","hours","chargeNo",$chargeNo) ."</b> </font></td>";
echo "</tr>";
echo "</table>";
echo "<Br>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/systemBiller/generatorCharge/reset.php?username=$username&chargeNo=$chargeNo' style='text-decoration:none; color:black;'>Reset</a>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/systemBiller/generatorCharge/deleteGenerator_new.php?username=$username&chargeNo=$chargeNo' style='text-decoration:none; color:black;'>Delete</a>";

echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/systemBiller/generatorCharge/stopGenerator_new.php?username=$username&chargeNo=$chargeNo' style='text-decoration:none; color:black;'>Stop</a>";

$ro->coconutBoxStop();

?>
