<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$charges = $_GET['charges'];
$username = $_GET['username'];



$ro = new database2();

$ro->changeItem($username,$registrationNo,$itemNo,$charges);

?>
