<?php
include("../../../myDatabase2.php");
$monthEncoded = $_POST['monthEncoded'];
$dayEncoded = $_POST['dayEncoded'];
$yearEncoded = $_POST['yearEncoded'];
$monthEncoded1 = $_POST['monthEncoded1'];
$dayEncoded1 = $_POST['dayEncoded1'];
$yearEncoded1 = $_POST['yearEncoded1'];
$username = $_POST['username'];

$ro = new database2();

$date = $yearEncoded."-".$monthEncoded."-".$dayEncoded;
$date1 = $yearEncoded1."-".$monthEncoded1."-".$dayEncoded1;


$ro->searchDisbursementEntry($date,$date1,$username);


?>
