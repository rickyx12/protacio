<?php
include("../../../myDatabase1.php");
$packageName = $_GET['packageName'];

$ro = new database1();

$ro->deleteNow("hospitalPackage","packageName",$packageName);


?>
