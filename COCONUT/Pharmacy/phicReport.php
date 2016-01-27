<?php
include("../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];
$ro = new database2();

echo "<br><Br>";
echo "<center><font size=5>PhilHealth Receivable for PHARMACY</font></center>";
echo "<center><font size=3>( $month $day, $year - $month1 $day1, $year1 )</font></center>";
echo "<Br>";

echo "<center>";
$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("Discharged");
$ro->coconutTableHeader("Patient");
$ro->coconutTableHeader("MEDICINE");
$ro->coconutTableHeader("SUPPLIES");
$ro->coconutTableRowStop();
$ro->discharged_name($month,$day,$year,$month1,$day1,$year1);
$ro->coconutTableRowStart();
$ro->coconutTableData("<b>TOTAL</b>");
$ro->coconutTableData("");
$ro->coconutTableData("&nbsp;<B>".number_format($ro->discharged_name_medicine(),2)."</b>");
$ro->coconutTableData("&nbsp;<B>".number_format($ro->discharged_name_supplies(),2)."</b>");
$ro->coconutTableRowStop();
$ro->coconutTableStop();

?>
