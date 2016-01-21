<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$requestingDepartment = $_GET['requestingDepartment'];
$requestingBranch = $_GET['requestingBranch'];
$requestTo_department = $_GET['requestTo_department'];
$requestTo_branch = $_GET['requestTo_branch'];
$quantity = $_GET['quantity'];
$verificationNo = $_GET['verificationNo'];

$ro = new database();

$ro->editNow("inventoryManager","verificationNo",$verificationNo,"quantity",$quantity);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/availableMedicine/showRequestList.php?username=$username&requestingDepartment=$requestingDepartment&requestingBranch=$requestingBranch&requestTo_department=$requestTo_department&requestTo_branch=$requestTo_branch");

?>
