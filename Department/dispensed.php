<?php
$registrationNo = $_GET['registrationNo'];
$dispensed = $_GET['dispensed'];
$disp = count($dispensed);

echo "<table border=1 cellpadding=1 cellspacing=1>";
echo "<tr>";
echo "<th>Particulars</th>";
echo "<th>QTY</th>";
echo "</tr>";
echo "<Tr>";
for( $x=0;$x<$disp;$x++ ) {

$dispense = preg_split ("/\_/", $disp); 

echo "<tD>&nbsp;".$disp[1]."&nbsp;</td>";
echo "<tD>&nbsp;".$disp[2]."&nbsp;</td>";
}
echo "";
echo "</table>";

?>
