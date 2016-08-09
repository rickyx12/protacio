<?php
require_once "../authentication.php";
include("../../myDatabase3.php");
$supplier = $_POST['supplier'];
$ro = new database3();

$username = $ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']);

echo "<center>";
echo $ro->selectNow("supplier","supplierName","supplierCode",$supplier);
echo "<Br>";
echo $ro->selectNow("supplier","address","supplierCode",$supplier);
echo "<Br>";
echo $ro->selectNow("supplier","contactPerson","supplierCode",$supplier)." - ".$ro->selectNow("supplier","contactNo","supplierCode",$supplier);
$ro->purchasingPayables($supplier,$username);




?>
