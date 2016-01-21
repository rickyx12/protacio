<?php
include("../../myDatabase2.php");
$packageNo = $_GET['packageNo'];
$packageName = $_GET['packageName'];
$price = $_GET['price'];

$ro = new database2();

$ro->editNow("hospitalPackage","packageNo",$packageNo,"Added",$price);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/hospitalPackage/showAddedPackage_update.php?packageName=$packageName");

?>
