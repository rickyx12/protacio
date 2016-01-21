<?php
include("../../../myDatabase3.php");

$ro = new database3();

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

tr.border_bottom td {
  border-bottom:1pt solid #CCCCCC;
}

</style>";


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

$ro->stockCardMerge();

echo "</table>";
echo "<input type='submit' value='Proceed'>";
echo "</form>";


?>
