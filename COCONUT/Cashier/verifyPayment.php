<?php
include("../../myDatabase.php");
$cashierPaid = $_GET['cashierPaid'];
$totalPaid = $_GET['totalPaid'];
$username = $_GET['username'];
$serverTime = $_GET['serverTime'];
$chargeStatus = $_GET['chargeStatus'];
$paymentType = $_GET['paymentType'];
$orNO = $_GET['orNO'];



$ro = new database();

echo "<br><br>";
$ro->coconutBoxStart_red("500","130");
echo "<br>";
echo "<font color=red>Are you sure you want to fully paid this patient?</font>";
echo "<br><Br>";
$ro->coconutFormStart("get","paymentManager.php");
$ro->coconutHidden("cashierPaid",$cashierPaid);
$ro->coconutHidden("totalPaid",$totalPaid);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("serverTime",$serverTime);
$ro->coconutHidden("chargeStatus",$chargeStatus);
$ro->coconutHidden("paymentType",$paymentType);
$ro->coconutHidden("orNO",$orNO);
$ro->coconutButton("Yes");
$ro->coconutFormStop();
$ro->coconutBoxStop();


?>
