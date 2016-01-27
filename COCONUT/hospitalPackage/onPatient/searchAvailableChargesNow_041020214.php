<?php
include("../packageControl.php");
$charges = $_GET['charges'];
$packageNo = $_GET['packageNo'];

$ro = new hospitalPackage();

$ro->searchReplaceItem($packageNo,$charges);


?>
