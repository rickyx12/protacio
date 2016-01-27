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
echo "<font size=6>".$ro->getReportInformation("hmoSOA_name")."</font><br>";
echo "<font size=3>".$ro->getReportInformation("hmoSOA_address")."<font><br><br>";
echo "<font size=4><b>Company/HMO Bill Summary for $type</b></font><br>";
echo "<font size=2>( ".$fromMonth." ".$fromDay.", ".$fromYear." - ".$toMonth." ".$toDay.", ".$toYear." )</font>";
echo "<center><br>";
echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;HMO&nbsp;</th>";
$ro->getHeaderBranch();
echo "<th>&nbsp;<b>TOTAL</b>&nbsp;</th>";
echo "</tr>";
echo $ro->listHMO($fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear,$type);
echo "</table>";


?>
