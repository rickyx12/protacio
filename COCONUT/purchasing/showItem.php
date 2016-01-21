<?php
include("../../myDatabase3.php");
$invoiceNo = $_GET['invoiceNo'];
$username = $_GET['username'];
$ro = new database3();

echo "<br><br><font size=4 color=red><a href='/COCONUT/maintenance/searchStockCard.php?username=$username' style='color:red; text-decoration:none;'>Add Item</a></font>";

$ro->invoiceItem($invoiceNo);

?>
