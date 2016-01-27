<?php
include("../../myDatabase1.php");

$regNo = $_GET['regNo'];
$countz = count($regNo);

$ro = new database1();

for($x=0;$x<$countz;$x++) {
$ro->phicTransmit($regNo[$x]);
}


?>
