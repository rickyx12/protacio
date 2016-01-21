<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$cash = $_GET['cash'];
$targetAmount = $_GET['targetAmount'];

$ro = new database2();

echo "<center><Br><br><Br><Br>";
echo "<font size=5 color=red>R-Banny is now Analyzing your data</font>";
echo "<br>";
//echo "<font size=4 color=blue>Preparing Cash".$cash."</font>";
//$ro->getReady_rBanny($registrationNo);
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/rBanny/analyzing_rBanny.php?registrationNo=$registrationNo&cash=$cash&targetAmount=$targetAmount");

?>
