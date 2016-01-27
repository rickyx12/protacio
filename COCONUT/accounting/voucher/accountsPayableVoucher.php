<?php
include("../../../myDatabase3.php");
$invoiceNo = $_GET['invoiceNo'];
$ro = new database3();

echo "<Br>";
echo "<center><font size=5>Protacio Hospital</font>";
echo "<br><br><br>";
echo "<font size=4>Accounts Payable Voucher</font>";

echo "<Table border='0' width='80%'>";
echo "</tr>";
echo "<td align='right'>AP.NO.<input type='text' style='border-top:0px; border-right:0px; border-left:0px; border-bottom:1px solid #000000; width:15%;' value='".$ro->selectNow("purchaseJournal","vouchersCode","invoiceNo",$invoiceNo)."'></td>";
echo "</tr>";

$date = $ro->selectNow("purchaseJournal","date","invoiceNo",$invoiceNo);
$yearDate = substr($date,"0","4");
$monthDate = substr($date,"5","2");
$dayDate = substr($date,"6","2");


echo "</tr>";
echo "<td align='right'>Date.<input type='text' style='border-top:0px; border-right:0px; align:center; border-left:0px; border-bottom:1px solid #000000; width:15%;' value='$yearDate-$monthDate-$dayDate'></td>";
echo "</tr>";

echo "</table>";

echo "<Table border='1' cellspacing=0 width='80%'>";
echo "<tr>";
echo "<th>PARTICULARS</th>";
echo "</tr>";
$ro->purchaseJournal_items($invoiceNo);
echo "</table>";

echo "<Br><br>";

echo "<Table border='1' width='80%' cellspacing=0>";
echo "<tr>";
echo "<th>Description</th>";
echo "<th>Debit</th>";
echo "<th>Credit</th>";
echo "</tr>";

$ro->purchaseJournal_acctTitle($invoiceNo);
echo "</table>";
echo "<Br><br>";
echo "<table border='0' width='80%'>";
echo "<Tr>";
echo "<td>&nbsp;Prepared By<Br><br><br><input type='text' style='border-bottom:0px; border-right:0px; border-left:0px; border-top:1px solid #000000;' value='Signature/Date'><Br></td>";
echo "<td>&nbsp;Checked By<Br><br><br><input type='text' style='border-bottom:0px; border-right:0px; border-left:0px; border-top:1px solid #000000;' value='Signature/Date'><Br></td>";
echo "<td>&nbsp;Approved By<Br><br><br><input type='text' style='border-bottom:0px; border-right:0px; border-left:0px; border-top:1px solid #000000;' value='Signature/Date'><Br></td>";
echo "</tr>";
echo "</table>";
?>
