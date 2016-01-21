<?php
include("packageControl.php");
$desc = $_POST['desc'];
$packageName = $_POST['packageName'];
$packagePrice = $_POST['packagePrice'];
$phicPrice = $_POST['phicPrice'];
$qty = $_POST['qty'];
$unitcost = $_POST['unitcost'];
$Added = $_POST['Added'];


$package = new hospitalPackage();

$totalPrice = ($unitcost * $qty);

$package->addPackageInclude($packageName,$desc,$qty,$packagePrice,$totalPrice,$Added,$phicPrice);


?>
