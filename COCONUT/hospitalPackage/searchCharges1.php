<?php
include("packageControl.php");
$desc = $_GET['desc'];
$packageName = $_GET['packageName'];

$package = new hospitalPackage();

$package->searchItem($desc,$packageName);


?>
