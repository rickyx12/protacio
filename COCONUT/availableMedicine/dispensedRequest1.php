<?php
include("../../myDatabase.php");

$generic = $_GET['generic'];
$unitcost = $_GET['unitcost'];
$date = $_GET['date'];
$username = $_GET['username'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$serverTime = $_GET['serverTime'];
$inventoryLocation = $_GET['inventoryLocation'];
$branch = $_GET['branch'];
$inventoryType = $_GET['inventoryType'];
$transition = $_GET['transition'];
$remarks = $_GET['remarks'];
$quantity = $_GET['quantity'];
$currentQTY = $_GET['currentQTY'];
$verificationNo = $_GET['verificationNo'];
$inventoryCode = $_GET['inventoryCode'];


$description = $_GET['description'];
$requestingDepartment = $_GET['requestingDepartment'];
$requestingBranch = $_GET['requestingBranch'];
$verificationNo = $_GET['verificationNo'];
$quantityIssued = $_GET['quantityIssued'];
$username = $_GET['username'];

$ro = new database();
$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);
$ro->editNow("inventoryManager","verificationNo",$verificationNo,"dateIssued",date("Y-m-d"));
$ro->editNow("inventoryManager","verificationNo",$verificationNo,"timeIssued",date("H:i:s"));
$ro->editNow("inventoryManager","verificationNo",$verificationNo,"issuedBy",$username);
$ro->editNow("inventoryManager","verificationNo",$verificationNo,"status","dispensed");
$ro->editNow("inventoryManager","verificationNo",$verificationNo,"quantityIssued",$quantityIssued);

$newQTY = ( $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode) - $quantityIssued );
$ro->editNow("inventory","inventoryCode",$inventoryCode,"quantity",$newQTY);

//window.parent.location.reload();   refresh parent frame
/*
echo "
<script type='text/javascript'>
alert('$description is now for receiving on $requestingDepartment in $requestingBranch ');
window.reload();
</script>

";
*/


echo "

<script type='text/javascript' >
window.location = 'http://".$ro->getMyUrl()."/COCONUT/availableMedicine/receivingRequestDetails1.php?currentQTY=$currentQTY&verificationNo=$verificationNo&inventoryCode=$inventoryCode&description=$description&unitcost=$unitcost&generic=$generic&date=$date&username=$username&month=$month&day=$day&year=$year&serverTime=$serverTime&inventoryLocation=$inventoryLocation&branch=$branch&inventoryType=$inventoryType&transition=$transition&remarks=$remarks&quantity=$quantity';
</script>


";


?>
