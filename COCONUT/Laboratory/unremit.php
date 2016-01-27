<?php
include("../../myDatabase1.php");
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];


$ro = new database1();

$ro->editNow("patientCharges","itemNo",$itemNo,"departmentStatus","");

echo "Pls Click the Patient's Name to view his/her Laboratories..";

?>
