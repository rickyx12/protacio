<?php
include("../../../myDatabase2.php");
$chargeNo = $_GET['chargeNo'];
$username = $_GET['username'];

$ro = new database2();

$ro->deleteNow("generatorCharge","chargeNo",$chargeNo);

echo "<center>";
echo "<Br><br><Br><Br><Br><Br>";
echo "<font color=red>Deleted!</font>";
echo "</center>";
?>
