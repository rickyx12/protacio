<?php
include("updater.php");
$date = $_GET['date'];
$date1 = $_GET['date'];
$shift = $_GET['shift'];
$ro = new updater();

echo "<form method='get' action='".$_SERVER['PHP_SELF']."'>";
echo "date <input type='text' name='date' value='$date'><br>";
echo "date1 <input type='text' name='date1' value='$date1'><br>";
echo "Shift <input type='text' name='shift' value='$shift'><br><Br>";

$ro->collectionReportToTransfer($date,$date1,$shift);
echo "</form>";
?>
