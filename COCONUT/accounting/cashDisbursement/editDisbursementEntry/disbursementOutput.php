<?php
include("../../../../myDatabase2.php");
$transactionNo = $_GET['transactionNo'];
$username = $_GET['username'];
$ro = new database2();

echo "<style>

.matrix {
font-family:courier;
}

</style>";

echo "<Br><br>";
echo "<table border=1 rules=all width='100%' cellspacing=0 cellpadding=1>";
echo "<tr>";
echo "<th><font size=2 class='matrix'>AcctNo</font></th>";
echo "<th><font size=2 class='matrix'>Acct-Paid To</font></th>";
echo "<th><font size=2 class='matrix'>Narration</font></th>";
echo "<th><font size=1 class='matrix'>Chq/LPO/<br>Invoice No</font></th>";
echo "<th><font size=2 class='matrix'>Dated</font></th>";
echo "<th><font size=2 class='matrix'>Dr</font></th>";
echo "<th><font size=2 class='matrix'>Cr</font></th>";
echo "</tr>";

echo "<Tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->disbursementOutput($transactionNo,$username,"edit");

echo "</table>";

?>
