<?php
include("../../myDatabase1.php");
$packageNo = $_GET['packageNo'];
$packageName = $_GET['packageName'];
$ro = new database();

$ro->deleteNow("hospitalPackage","packageNo",$packageNo);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/hospitalPackage/showAddedPackage_update.php?packageName=$packageName");


?>
