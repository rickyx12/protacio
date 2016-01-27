<?php
include("../../../myDatabase2.php");
$controlNo = $_GET['controlNo'];
$checkedNo = $_GET['checkedNo'];
$description = $_GET['description'];
$amount = $_GET['amount'];
$payee = $_GET['payee'];
$date = $_GET['date'];

$ro = new database2();

$ro->editNow("vouchers","controlNo",$controlNo,"checkedNo",$checkedNo);
$ro->editNow("vouchers","controlNo",$controlNo,"description",$description);
$ro->editNow("vouchers","controlNo",$controlNo,"amount",$amount);
$ro->editNow("vouchers","controlNo",$controlNo,"payee",$payee);
$ro->editNow("vouchers","controlNo",$controlNo,"date",$date);


?>
