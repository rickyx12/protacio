<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$toYear = $_GET['toYear'];
$type = $_GET['type'];

$ro = new database();


echo "<center>";
echo "<font size=6>".$ro->getReportInformation("hmoSOA_name")."</font><bR>";
echo "<font size=3>".$ro->getReportInformation("hmoSOA_address")."</font><br><bR>";
echo "<font size=4><b>Doctor's PF Summary ($type)</b></font><br>";
echo "<font size=2>($fromMonth $fromDay, $fromYear - $toMonth $toDay, $toYear)</font><br><br>";
echo "<center>";
echo "<table border=2 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th>&nbsp;Doctor&nbsp;</th>";
$ro->getHeaderBranch(); // ggwing table header ung mga branch
echo "<th>&nbsp;<b>TOTAL</b>&nbsp;</th>";
echo "</tr>";
$ro->listDoctorAsRow($type,$fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear);
echo "</table>";

?>



