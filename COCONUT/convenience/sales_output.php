<?php
include("../../convenienceDB.php");
$transactionNo = $_GET['transactionNo'];
$ro = new convenienceDB();

$ro->showSales($transactionNo);

?>
