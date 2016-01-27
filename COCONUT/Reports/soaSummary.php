<?php
include("../../myDatabase2.php");

$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$toYear = $_GET['toYear'];

$ro = new database2();

$date1 = $fromYear."-".$fromMonth."-".$fromDay;
$date2 = $toYear."-".$toMonth."-".$toDay;

$month1 = "";
$month2 = "";
if( $fromMonth == "01" ) {
$month1 = "Jan";
}else if( $fromMonth == "02" ) {
$month1 = "Feb";
}else if( $fromMonth == "03" ) {
$month1 = "Mar";
}else if( $fromMonth == "04" ) {
$month1 = "Apr";
}else if( $fromMonth == "05" ) {
$month1 = "May";
}else if( $fromMonth == "06" ) {
$month1 = "Jun";
}else if( $fromMonth == "07" ) {
$month1 = "Jul";
}else if( $fromMonth == "08" ) {
$month1 = "Aug";
}else if( $fromMonth == "09" ) {
$month1 = "Sep";
}else if( $fromMonth == "10" ) {
$month1 = "Oct";
}else if( $fromMonth == "11" ) {
$month1 = "Nov";
}else if( $fromMonth == "12" ) {
$month1 = "Dec";
}else { }



if( $toMonth == "01" ) {
$month2 = "Jan";
}else if( $toMonth == "02" ) {
$month2 = "Feb";
}else if( $toMonth == "03" ) {
$month2 = "Mar";
}else if( $toMonth == "04" ) {
$month2 = "Apr";
}else if( $toMonth == "05" ) {
$month2 = "May";
}else if( $toMonth == "06" ) {
$month2 = "Jun";
}else if( $toMonth == "07" ) {
$month2 = "Jul";
}else if( $toMonth == "08" ) {
$month2 = "Aug";
}else if( $toMonth == "09" ) {
$month2 = "Sep";
}else if( $toMonth == "10" ) {
$month2 = "Oct";
}else if( $toMonth == "11" ) {
$month2 = "Nov";
}else if( $toMonth == "12" ) {
$month2 = "Dec";
}else { }



echo "<center><br><font size=4>Discharged</font><Br><font size=3>($month1 $fromDay, $fromYear to $month2 $toDay, $toYear )</font>";
$ro->soaSummary($date1,$date2);

?>
