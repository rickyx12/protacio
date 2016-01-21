<?php
include("../../myDatabase.php");

$currentQTY = $_GET['currentQTY'];
$verificationNo = $_GET['verificationNo'];
$inventoryCode = $_GET['inventoryCode'];

$description = $_GET['description']; // description
$unitcost = $_GET['unitcost']; // unitcost
$generic = $_GET['generic']; // generic
$date = $_GET['date']; // date
$username = $_GET['username']; // addedBy
$month = $_GET['month']; // month
$day = $_GET['day']; // day
$year = $_GET['year']; // year
$serverTime = $_GET['serverTime']; //serverTime
$inventoryLocation = $_GET['inventoryLocation']; // inventoryLocation
$branch = $_GET['branch']; // branch
$inventoryType = $_GET['inventoryType']; // inventoryType
$transition = $_GET['transition']; // transition
$remarks = $_GET['remarks']; // remarks
$quantity = $_GET['quantity']; // quantity

$ro = new database();

$ro->editNow("inventory","inventoryCode",$inventoryCode,"quantity",$currentQTY);
$ro->editNow("inventoryManager","verificationNo",$verificationNo,"status","Received");




echo "
<script type='text/javascript'>

window.location='http://".$ro->getMyUrl()."/COCONUT/inventory/addInventory_insert_GET.php?inventoryCode=$inventoryCode&description=$description&generic=$generic&unitcost=$unitcost&generic=$generic&date=$date&addedBy=$username&month=$month&day=$day&year=$year&serverTime=$serverTime&inventoryLocation=$inventoryLocation&branch=$branch&inventoryType=$inventoryType&transition=$transition&remarks=$remarks&quantity=$quantity';

</script>
";




?>
