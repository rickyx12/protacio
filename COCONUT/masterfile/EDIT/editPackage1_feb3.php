<?php
include("../../../myDatabase.php");

$packageNo = $_GET['packageNo'];
$description = $_GET['description'];
$price = $_GET['price'];

$ro = new database();

$ro->editNow("package","packageNo",$packageNo,"description",$description);
$ro->editNow("package","packageNo",$packageNo,"price",$price);


?>
