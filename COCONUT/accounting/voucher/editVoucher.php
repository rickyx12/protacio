<?php
include("../../../myDatabase2.php");
$controlNo = $_GET['controlNo'];

$ro = new database2();
$ro->coconutDesign();

echo "<Br><br><br>";

$ro->coconutFormStart("get","editVoucher1.php");
$ro->coconutHidden("controlNo",$controlNo);
$ro->coconutBoxStart("500","220");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<Td>Checked No#&nbsp;</tD>";
echo "<td>".$ro->coconutTextBox_return("checkedNo",$ro->selectNow("vouchers","checkedNo","controlNo",$controlNo))."</tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>Description&nbsp;</tD>";
echo "<td>".$ro->coconutTextBox_return("description",$ro->selectNow("vouchers","description","controlNo",$controlNo))."</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>Amount&nbsp;</tD>";
echo "<td>".$ro->coconutTextBox_return("amount",$ro->selectNow("vouchers","amount","controlNo",$controlNo))."</tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>Payee&nbsp;</tD>";
echo "<td>".$ro->coconutTextBox_return("payee",$ro->selectNow("vouchers","payee","controlNo",$controlNo))."</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>Date&nbsp;</tD>";
echo "<td>".$ro->coconutTextBox_return("date",$ro->selectNow("vouchers","date","controlNo",$controlNo))."</tD>";
echo "</tr>";

echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
