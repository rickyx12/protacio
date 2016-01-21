<?php
include("../../../myDatabase2.php");
$date = $_GET['date'];
$username = $_GET['username'];
$ro = new database2();
$ro->coconutDesign();
echo "<Br><Br><BR><br><center>";
$ro->coconutBoxStart("500","150");
echo "<Br>";
echo "<center><font color=red>Generator Summary</font><center>";
echo "<table border=0>";
echo "<tr>";
echo "<td><font> Start: <b>". $ro->selectNow("generatorCharge","timeStart","dateStart",$date) ."</b> </font></td>";
echo "</tr>";
echo "<Tr>";
echo "<td><font> Stop: <b>". $ro->selectNow("generatorCharge","timeStop","dateStart",$date) ."</b> </font></td>";
echo "</tr>";
echo "<Tr>";
echo "<td><font>Minutes: <b>". $ro->selectNow("generatorCharge","hours","dateStart",$date) ."</b> </font></td>";
echo "</tr>";
echo "</table>";
echo "<Br>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/systemBiller/generatorCharge/manual.php?username=$username&date=$date' style='text-decoration:none; color:black;'>Edit</a>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/systemBiller/generatorCharge/deleteGenerator.php?username=$username&date=$date' style='text-decoration:none; color:black;'>Delete</a>";
$newDate = preg_split ("/\-/", $date ); 
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/systemBiller/generatorCharge/generatorStart.php?month=$newDate[1]&day=$newDate[2]&year=$newDate[0]&username=$username' style='text-decoration:none; color:black;'>Start Again</a>";

echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/systemBiller/generatorCharge/showList.php?month=$newDate[1]&day=$newDate[2]&year=$newDate[0]&username=$username' style='text-decoration:none; color:black;'>View All</a>";

$ro->coconutBoxStop();

?>
