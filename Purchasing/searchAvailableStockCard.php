<?php
include("../myDatabase.php");
$description=$_GET['description'];
$username=$_GET['username'];
$sino=$_GET['sino'];
$page=$_GET['page'];
$invoiceNo=$_GET['invoiceNo'];

$ro=new database();

$ro->getMasterListStockCardpurch($description,$username,$sino,$page,$invoiceNo);
?>

