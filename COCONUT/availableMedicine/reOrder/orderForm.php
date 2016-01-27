<?php
include("../../../myDatabase2.php");
$batchNo = $_GET['batchNo'];

$ro = new database2();

echo "<center><br><Br><br>";

$ro->showOrderForm($batchNo);



?>
