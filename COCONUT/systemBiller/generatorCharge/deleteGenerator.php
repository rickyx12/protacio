<?php
include("../../../myDatabase2.php");
$date = $_GET['date'];
$username = $_GET['username'];

$ro = new database2();

$ro->deleteNow("generatorCharge","dateStart",$date);

echo "<center>";
echo "<Br><br><Br><Br><Br><Br>";
echo "<font color=red>Deleted!</font>";
echo "</center>";
?>
