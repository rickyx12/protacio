<?php
include("../../../myDatabase1.php");

$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$toYear = $_GET['toYear'];
$type = $_GET['type'];

$ro = new database1();

echo "<center><font size=6>".$ro->getReportInformation("hmoSOA_name")."</font></center>";
echo "<center><font size=4>".$ro->getReportInformation("hmoSOA_address")."</font></center>";

echo "<br><br>";
echo "<center><b><font size=4>$type</font></b></center>";
echo "<center><a href='http://".$ro->getMyUrl()."/COCONUT/philhealth/reconciled/reconcillation_update.php?month=$fromMonth&day=$fromDay&year=$fromYear&month1=$toMonth&day1=$toDay&year1=$toYear&type=$type' style='text-decoration:none; color:black;' target='_blank'>(PhilHealth Receivables)</a></center>";
echo "<br>";
echo "<center><b>(<font size=3>$fromMonth $fromDay, $fromYear - $toMonth $toDay, $toYear</font>)</b></center>";

$ro->getPhilHeealthReceivables($fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear,$type)

?>
