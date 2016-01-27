<?php
include("packageControl.php");
$packageName = $_GET['packageName'];

$package = new hospitalPackage();

$package->showAddedPackage($packageName);


?>
