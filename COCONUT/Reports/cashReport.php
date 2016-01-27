<?php
include("../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];
$type = $_GET['type'];
$paidVia = $_GET['paidVia'];

$ro = new database2();

echo "<center><font size=4><b>( $month $day, $year - $month1 $day1, $year1 )</b></font></center>";

if( $paidVia == "cashUnpaid" ) {
echo "<center><b>BALANCE</b></center>";
}else if( $paidVia == "Company" ) {
echo "<center><b>COMPANY</b></center>";
}else if( $paidVia == "phic" ) {
echo "<center><b>PhilHealth</b></center>";
}else {
echo "<center>Actual</center>";
}

echo "<Br><Br><Br>";
$ro->monthlySalesReport($month,$day,$year,$month1,$day1,$year1,$type,$paidVia);

?>
