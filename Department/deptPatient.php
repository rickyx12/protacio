<?php
include("../myDatabase2.php");
$username = $_GET['username'];

$ro = new database2();

echo "<font size=2>Date&nbsp;</font>&nbsp;<font size=2 color=red>".date("Y-m-d")."</font>";
$ro->getPatientForBill(date("Y-m-d"),$username);


?>
