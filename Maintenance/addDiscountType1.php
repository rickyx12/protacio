<?php
include("../myDatabase3.php");
$discountType = $_POST['discountType'];

$ro = new database3();
$ro->addDiscountTypez($discountType);
$ro->gotoPage("http://".$ro->getMyUrl()."/Maintenance/addDiscountType.php");
?>
