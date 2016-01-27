<?php
include("../../myDatabase2.php");

$registrationNo = $_POST['registrationNo'];

$ro = new database2();

echo "<Br><Br><center>";
echo "Returns";
$ro->pxReturnInventory($registrationNo);

echo "<Br><Br><Br>";
echo "<table border=1 cellspacing=0>";
echo "<Tr>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;</th>";
echo "</tr>";
$ro->getDeletedMeds("",$registrationNo);
echo "</table>";

?>
