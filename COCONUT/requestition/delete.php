<?php
include("../../myDatabase.php");
$verificationNo = $_GET['verificationNo'];
$requestingDepartment = $_GET['requestingDepartment'];
$requestTo_department = $_GET['requestTo_department'];
$username = $_GET['username'];

$ro = new database();

$ro->editNow("inventoryManager","verificationNo",$verificationNo,"status","DELETED_".$username);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/availableMedicine/showRequestList.php?requestingDepartment=$requestingDepartment&requestTo_department=$requestTo_department&username=$username");

?>
