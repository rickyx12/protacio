<?php
include("../../../myDatabase3.php");
$startLetter = $_GET['startLetter'];
$ro = new database3();

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

tr.border_bottom td {
  border-bottom:1pt solid #CCCCCC;
}

</style>";

echo "<font><a href='sortStockCard.php' style='text-decoration:none; color:red;'>Stock Card starting letter $startLetter</a></font>";
echo "<form method='get' action='stockCardList1.php'>";
echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;</th>";
echo "<th>stockCardNo</th>";
echo "<th>Description</th>";
echo "<th>Generic</th>";
echo "<th>Inventory tbl</th>";
echo "<th>PatientCharges tbl</th>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$ro->stockCardMerge($startLetter);

echo "</table>";
$ro->coconutHidden("startLetter",$startLetter);
echo "<input type='submit' value='Proceed'>";
echo "</form>";


?>
