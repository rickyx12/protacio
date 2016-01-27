<?php
include("../../myDatabase3.php");
$siNo = $_GET['siNo'];
$count = count($siNo);

$ro = new database3();

$invoiceTotal1="";

for($x=0;$x<$count;$x++) {

$invoiceTotal = ( $ro->purchasingPayablesTotal($siNo[$x]));

echo $siNo[$x]." - ".$invoiceTotal."<br>";

$invoiceTotal1 += $invoiceTotal;

}

echo $invoiceTotal1;

$vattable = round(($invoiceTotal1 / 1.12),2);
$vat = round(($invoiceTotal1 - $vattable),2);
$wTax = round(($vattable * 0.01),2);
$netTotal = round($invoiceTotal1 - $wTax,2);

echo "<br><Br><br>";
echo "Vattable-".$vattable;
echo "<Br>";
echo "Vat-".$vat;
echo "<Br>";
echo "Total-".$invoiceTotal1;
echo "<br>";
echo "W/ Tax-".$wTax;
echo "<br>";
echo "Net-".$netTotal;
?>
