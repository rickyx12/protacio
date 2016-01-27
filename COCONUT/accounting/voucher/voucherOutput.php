<?php
include("../../../myDatabase3.php");
$invoiceNo = $_GET['invoiceNo'];
$ro = new database3();

//$invoiceNo = "7738";

echo "<style>

tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";


echo "<center>";
echo "<font size=5><b>Protacio Hospital</b></font>";
echo "<Br><br>";
echo "<font size=3>Check Voucher</font>";
echo "<br><br>";
echo "<table border=0 width='80%' cellspacing=0>";
echo "<Tr>";
echo "<td><b>Vendor or Payee</b></td>";
echo "</tr>";
echo "<Tr>";
echo "<td>&nbsp;".$ro->selectNow("vouchers","payee","invoiceNo",$invoiceNo)."</td>";
echo "<td align='right'>NO#:&nbsp;<a href='#'>".$ro->selectNow("vouchers","voucherNo","invoiceNo",$invoiceNo)."</a></td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";
echo "</table>";

echo "<br>";
echo "<table border=1 cellspacing=0 style='border:1px solid #000000;' width='80%'>";
echo "<Tr>";
echo "<th>Description</th>";
echo "<th>Amount</th>";
echo "</tr>";
$ro->voucher_items($invoiceNo);
echo "</table>";

echo "<br><br>";

echo "<table border=1 cellspacing=0 width='80%'>";
echo "<tr>";
echo "<th>Account Title</th>";
echo "<th>Debit</th>";
echo "<th>Credit</th>";
echo "</tr>";
$ro->tAccount_journal($invoiceNo);
echo "</table>";

echo "<Br><br>";

echo "<table border=0 width='80%'>";
echo "<tr>";
echo "<td><font size=2>Payment Date:</font>&nbsp;<input type='text' style='border-top:0px; border-right:0px; border-left:0px; border-bottom:1px solid #000000; width:150px;' value='".$ro->selectNow("vouchers","date","invoiceNo",$invoiceNo)."'></td>";

echo "<td><font size=2>Bank:</font>&nbsp;<input type='text' style='border-top:0px; border-right:0px; border-left:0px; border-bottom:1px solid #000000; width:150px;' value='".$ro->selectNow("vouchers","bank","invoiceNo",$invoiceNo)."'></td>";

echo "<td><font size=2>Check#:</font>&nbsp;<input type='text' style='border-top:0px; border-right:0px; border-left:0px; border-bottom:1px solid #000000; width:150px;' value='".$ro->selectNow("vouchers","checkedNo","invoiceNo",$invoiceNo)."'></td>";

echo "</tr>";
echo "</table>";
echo "<Br><Br><Br>";
echo "<table border=0 width='80%'>";
echo "<Tr>";
echo "<td><font size=2>Prepared By</font><br><br><BR><br><input type='text' style='border-top:1px solid #000; border-right:0px; border-left:0px; border-bottom:0px solid #000000;' value='Signature/Date'></td>";


echo "<td><font size=2>Checked By</font><br><br><BR><br><input type='text' style='border-top:1px solid #000; border-right:0px; border-left:0px; border-bottom:0px solid #000000;' value='Signature/Date'></td>";

echo "<td><font size=2>Approved By</font><br><br><BR><br><input type='text' style='border-top:1px solid #000; border-right:0px; border-left:0px; border-bottom:0px solid #000000;' value='Signature/Date'></td>";

echo "<td><font size=2>Received By</font><br><br><BR><br><input type='text' style='border-top:1px solid #000; border-right:0px; border-left:0px; border-bottom:0px solid #000000;' value='Signature/Date'></td>";

echo "</tr>";
echo "</table>";

?>
