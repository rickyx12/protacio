<?php
include("../../../myDatabase.php");
$fromDate_month = $_GET['fromDate_month'];
$fromDate_day = $_GET['fromDate_day'];
$fromDate_year = $_GET['fromDate_year'];
$toDate_month = $_GET['toDate_month'];
$toDate_day = $_GET['toDate_day'];
$toDate_year = $_GET['toDate_year'];
$ro = new database();


echo "<br><center>";
echo "<font size=5>Collection Report (IPD)</font>";
echo "<br><font size=2>(".$fromDate_month." ".$fromDate_day.", ".$fromDate_year." - ".$toDate_month." ".$toDate_day.", ".$toDate_year.")</font>";
$ro->collectionIPD_admin($fromDate_month,$fromDate_day,$fromDate_year,$toDate_month,$toDate_day,$toDate_year);

?>
