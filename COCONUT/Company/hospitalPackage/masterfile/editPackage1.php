<?php
include("../../../myDatabase1.php");
$packageName = $_GET['packageName'];
$packagePrice = $_GET['packagePrice'];

$ro = new database1();

$ro->editNow("hospitalPackage","packageName",$packageName,"packagePrice",$packagePrice);


?>
