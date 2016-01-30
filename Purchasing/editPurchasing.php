<?php
include("../myDatabase3.php");
$inventoryCode = $_GET['inventoryCode'];
$refNo = $_GET['refNo'];
$sino = $_GET['sino'];
$page = $_GET['page'];
$username = $_GET['username'];
$ro = new database3();
$ro->coconutDesign();

$description = $ro->selectNow("salesInvoiceItems","description","inventoryCode",$inventoryCode);
$generic = $ro->selectNow("inventory","genericName","inventoryCode",$inventoryCode);
$unitcost = $ro->selectNow("salesInvoiceItems","unitPrice","inventoryCode",$inventoryCode);
$qty = $ro->selectNow("salesInvoiceItems","quantity","inventoryCode",$inventoryCode);
$fgqty = $ro->selectNow("salesInvoiceItems","fgquantity","inventoryCode",$inventoryCode);
$unit = $ro->selectNow("salesInvoiceItems","unit","inventoryCode",$inventoryCode);

echo "<br><br>";
$ro->coconutFormStart("post","editPurchasing1.php");
$ro->coconutHidden("inventoryCode",$inventoryCode);
$ro->coconutHidden("refNo",$refNo);
$ro->coconutHidden("sino",$sino);
$ro->coconutHidden("page",$page);
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","300");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Description</td>";
echo "<td>";
$ro->coconutTextBox("description",$description);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Generic</td>";
echo "<td>";
$ro->coconutTextBox("generic",$generic);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Unitcost</td>";
echo "<td>";
$ro->coconutTextBox("unitcost",$unitcost);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>QTY</td>";
echo "<td>";
$ro->coconutTextBox_short("qty",$qty);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>FG QTY</td>";
echo "<td>";
$ro->coconutTextBox_short("fgqty",$fgqty);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Unit</td>";
echo "<td>";
$ro->coconutTextBox_short("unit",$unit);
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
