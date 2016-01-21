<?php
include("../../../myDatabase.php");

$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$toYear = $_GET['toYear'];
$type = $_GET['type'];
$branch = $_GET['branch'];

$ro = new database();

echo "<center>";
//echo "<font size=6>".$ro->getReportInformation("hmoSOA_name")."</font>";
//echo "<br><font size=3>".$ro->getReportInformation("hmoSOA_address")."</font>";
//echo "<Br><font size=3>($branch)</font>";

echo "<center><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/mendero.png' width='60%' height='20%'></center>";

echo "<font size=5>Registration Census For $type</font>";
echo "<br><font size=2>($fromMonth $fromDay, $fromYear - $toMonth $toDay, $toYear)</font>";
$ro->censusRegistered($fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear,$type,$branch);

?>
