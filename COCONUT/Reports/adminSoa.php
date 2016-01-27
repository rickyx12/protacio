<?php
include("../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];

$ro = new database2();
$datez = $year."-".$month."-".$day;

$month1="";

if( $month == "01" ) {
$month1 = "Jan";
}else if( $month == "02" ) {
$month1 = "Feb";
}else if( $month == "03" ) {
$month1 = "Mar";
}else if( $month == "04" ) {
$month1 = "Apr";
}else if( $month == "05" ) {
$month1 = "May";
}else if( $month == "06" ) {
$month1 = "Jun";
}else if( $month == "07" ) {
$month1 = "Jul";
}else if( $month == "08" ) {
$month1 = "Aug";
}else if( $month == "09" ) {
$month1 = "Sep";
}else if( $month == "10" ) {
$month1 = "Oct";
}else if( $month == "11" ) {
$month1 = "Nov";
}else if( $month == "12" ) {
$month1 = "Dec";
}else { }

echo "<table border=0 width='95%'>";
echo "<tr>";
echo "<th style='background-color:#00FFFF;'>Patient<br><font size=2 color=red>$month1 $day, $year</font></th>";
echo "</tr>";
$ro->adminSOA($datez,"0:00:00","24:00:00");
//$ro->adminSOA("2014-08-26","17:00:00","08:00:00");
echo "</th>";

?>
