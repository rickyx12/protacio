<?php
include("packageControl.php");
$desc = $_POST['desc'];
$packageName = $_POST['packageName'];
$qty = $_POST['qty'];
$unitcost = $_POST['unitcost'];
$Added = $_POST['Added'];


$package = new hospitalPackage();

$totalPrice = ($unitcost * $qty);

$package->addPackageInclude($packageName,$desc,$qty,$totalPrice,$Added);


?>
