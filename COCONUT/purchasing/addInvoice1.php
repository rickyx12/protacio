<?php
include("../../myDatabase3.php");
$invoiceNo = $_GET['invoiceNo'];
$supplier = $_GET['supplier'];
$terms = $_GET['terms'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$amount = $_GET['amount'];
$username = $_GET['username'];
$ro = new database3();

$dateReceived = $year."-".$month."-".$day;

$ro->addInvoice($invoiceNo,$supplier,$terms,$dateReceived,$amount,date("Y-m-d"),$username);

echo "<br><br><br><center><font size=4 color=red><a href='/COCONUT/purchasing/showItem.php?username=$username&invoiceNo=$invoiceNo' target='rightFrame' style='text-decoration:none; color:red'>Invoice Added</a></font>";
echo "<br><b>Inv#:</b>".$invoiceNo;
echo "<Br><b>Supplier:</b>".$supplier;
echo "<br><b>Terms:</b>".$terms;
echo "<br><b>Received:</b>".$dateReceived;

$ro->coconutFormStart("get","addInvoice.php");
echo "<br>";
$ro->coconutHidden("username",$username);
$ro->coconutButton("Encode another Invoice");
$ro->coconutFormStop();

?>
