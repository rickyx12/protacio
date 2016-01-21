<?php
include("../../myDatabase3.php");
$username = $_GET['username'];
$supplier = $_GET['supplier'];
$ro = new database3();


echo $ro->selectNow("supplier","supplierName","supplierCode",$supplier);
echo "<Br>";
echo $ro->selectNow("supplier","address","supplierCode",$supplier);
echo "<Br>";
echo $ro->selectNow("supplier","contactPerson","supplierCode",$supplier)." - ".$ro->selectNow("supplier","contactNo","supplierCode",$supplier);
$ro->purchasingPayables($supplier,$username);




?>
