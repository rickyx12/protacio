<?php
include("../../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$username = $_GET['username'];

$ro = new database2();

$selectedDate = $year."-".$month."-".$day;

/*
if( $ro->selectNow("generatorCharge","status","dateStop",$selectedDate) == "" ) {

if( $ro->selectNow("generatorCharge","status","dateStart",$selectedDate) != "on" ) {
echo "<BR><Br><BR><Br><Br>";
$ro->coconutBoxStart("500","100");
echo "<BR>";
echo "<Table border=0>";
echo "<Tr>";
echo "<Td><a href='generatorStart.php?username=$username&month=$month&day=$day&year=$year' style='text-decoration:none;'><font color=red>Start Generator</font></a></tD>";
echo "</tr>";
echo "</table>";
$ro->coconutBoxStop();
}else {
echo "<Br><Br><Br><br>";
echo "<center>Generator Charge Started @ <font color=red> ". $ro->selectNow("generatorCharge","timeStart","dateStart",$selectedDate ) ." </font></center>";
echo "<BR>";
echo "<center><a href='stopGenerator.php?dateStarted=$selectedDate&username=$username' style='text-decoration:none;'> Stop Generator </a></center>";
}

}else {
header("Location: /COCONUT/systemBiller/generatorCharge/generatorSummary.php?date=$selectedDate&username=$username");
}
*/




header("Location: /COCONUT/systemBiller/generatorCharge/showList.php?month=$month&day=$day&year=$year&username=$username");


?>
