<?php
include("../../../myDatabase1.php");
$month = $_GET['month'];
$year = $_GET['year'];

$ro = new database1();

echo "<center><font size=6>".$ro->getReportInformation("hmoSOA_name")."</font>";
echo "<Br>";
echo "<center><font size=3>".$ro->getReportInformation("hmoSOA_address")."</font>";
echo "<br><Br>";
echo "<font size=5>Trial Balance</font><Br><font size=3>$month, $year</font>";
$ro->trialBalance($month,$year);

?>
