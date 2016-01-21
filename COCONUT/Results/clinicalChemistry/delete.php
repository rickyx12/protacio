<?php
include("../../../myDatabase.php");
$savedNo = $_GET['savedNo'];
$itemNo = $_GET['itemNo'];

$ro = new database();

$ro->deleteNow("labSavedResult","savedNo",$savedNo);
$ro->deleteNow("core2_laboratoryResultChecker","itemNo",$itemNo);
$ro->editNow("patientCharges","itemNo",$itemNo,"departmentStatus","");
?>
