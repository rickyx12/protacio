<?php
include("packageControl.php");
$desc = $_GET['desc'];
$packageName = $_GET['packageName'];
$searchFrom = $_GET['searchFrom'];

$package = new hospitalPackage();

$package->searchInventory($desc,$packageName,$searchFrom);


?>
