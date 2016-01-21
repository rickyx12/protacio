<?php
include("../../convenienceDB.php");
$description = $_GET['description'];
$username = $_GET['username'];
$transactionNo = $_GET['transactionNo'];

$ro = new convenienceDB();

$ro->searchInventory($username,$description,$transactionNo);



?>
