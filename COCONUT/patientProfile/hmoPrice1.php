<?php
include("../../myDatabase2.php");
$itemNo = $_GET['itemNo'];
$hmoPrice = $_GET['hmoPrice'];
$company = $_GET['company'];

$ro = new database2();


$ro->editNow("patientCharges","itemNo",$itemNo,"hmoPrice",$hmoPrice);
$ro->editNow("patientCharges","itemNo",$itemNo,"company",$company);

?>
