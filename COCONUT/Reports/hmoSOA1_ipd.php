<?php
include("../../myDatabase.php");
$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$toYear = $_GET['toYear'];
$branch = $_GET['branch'];
$company = $_GET['company'];

$ro = new database();

echo "<center>".$ro->getReportInformation("hmoSOA_name")."</center>";
echo "<center>".$ro->getReportInformation("hmoSOA_address")."</center>";
echo "<center><font size=5>Statement of Account</font><center>";
echo "<center>$company</center>";
echo "<center><font size=2>$fromMonth $fromDay, $fromYear - $toMonth $toDay, $toYear</font></center><br>";
echo "<font size=2>We are billing you the amount below representing the hospitalization charge incured by<br> your cardholders</font>";
$ro->hmoSOA_ipd($company,$fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear,$branch);


?>
