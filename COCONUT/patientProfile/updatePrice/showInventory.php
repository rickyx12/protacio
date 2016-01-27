<?php
include("../../../myDatabase1.php");

$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$type = $_GET['type'];
$status = $_GET['status'];

$ro = new database1();

$ro->coconutFormStart("get","showInventory.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("type",$type);
$ro->coconutHidden("status","yes");
$ro->coconutButton("Check All");
$ro->coconutFormStop();

$ro->updatePrice_inventory($registrationNo,$username,$type,$status);

?>
