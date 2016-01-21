<?php
include("../../../myDatabase2.php");
$chargeNo = $_GET['chargeNo'];
$username = $_GET['username'];
$chargeNo = $_GET['chargeNo'];
$ro = new database2();

$ro->editNow("generatorCharge","chargeNo",$chargeNo,"dateStop","");
$ro->editNow("generatorCharge","chargeNo",$chargeNo,"timeStop","");
$ro->editNow("generatorCharge","chargeNo",$chargeNo,"hours","");

header("Location: /COCONUT/systemBiller/generatorCharge/generatorSummary1.php?chargeNo=$chargeNo&username=$username");

?>
