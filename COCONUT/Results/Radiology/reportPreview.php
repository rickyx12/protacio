<?php
include("../../../myDatabase1.php");
$reportNo = $_GET['reportNo'];

$ro = new database1();

echo $ro->selectNow("radioReportList","title","reportNo",$reportNo);
echo "<Br><Br>";
echo $ro->selectNow("radioReportList","report","reportNo",$reportNo);

?>
