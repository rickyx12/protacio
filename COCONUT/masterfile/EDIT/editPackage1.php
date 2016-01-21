<?php
include("../../../myDatabase.php");

$packageNo = $_GET['packageNo'];
$description = $_GET['description'];
$price = $_GET['price'];
$pf = $_GET['pf'];

$ro = new database();

$ro->editNow("package","packageNo",$packageNo,"description",$description);
$ro->editNow("package","packageNo",$packageNo,"price",$price);
$ro->editNow("package","packageNo",$packageNo,"pf",$pf);

?>
