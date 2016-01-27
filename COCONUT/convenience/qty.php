<?php
include("../../convenienceDB.php");
$inventoryNo = $_GET['inventoryNo'];
$transactionNo = $_GET['transactionNo'];
$description = $_GET['description'];
$price = $_GET['price'];
$username = $_GET['username'];

$ro = new convenienceDB();
$ro->coconutDesign();

echo "<br><br><br><br><bR>";


$ro->coconutFormStart("get","addSales.php");
$ro->coconutHidden("inventoryNo",$inventoryNo);
$ro->coconutHidden("transactionNo",$transactionNo);
$ro->coconutHidden("description",$description);
$ro->coconutHidden("price",$price);
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("400","80");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>QTY&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox_short("qty","1");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
