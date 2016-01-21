<?php
include("../../../myDatabase2.php");
$fromYear = $_GET['fromYear'];
$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$toYear = $_GET['toYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$exam = $_GET['exam'];
$title = $_GET['title'];
$ro = new database2();


$startMonth="";
$endMonth="";
/*
if( $fromMonth == "01" ) {
$startMonth = "Jan";
}else if( $fromMonth == "02" ) {
$startMonth = "Feb";
}else if( $fromMonth == "03" ) {
$startMonth = "Mar";
}else if( $fromMonth == "04" ) {
$startMonth = "Apr";
}else if( $fromMonth == "05" ) {
$startMonth = "May";
}else if( $fromMonth == "06" ) {
$startMonth = "Jun";
}else if( $fromMonth == "07" ) {
$startMonth = "Jul";
}else if( $fromMonth == "08" ) {
$startMonth = "Aug";
}else if( $fromMonth == "09" ) {
$startMonth = "Sep";
}else if( $fromMonth == "10" ) {
$startMonth = "Oct";
}else if( $fromMonth == "11" ) {
$startMonth = "Nov";
}else if( $fromMonth == "12" ) {
$startMonth = "Dec";
}
*/

$dateFrom = $fromYear."-".$fromMonth."-".$fromDay;
$dateTo = $toYear."-".$toMonth."-".$toDay;

//$dateFrom = $startMonth."_".$fromDay."_".$fromYear;
//$dateTo = $startMonth."_".$toDay."_".$toYear;


echo "<center>";
echo "<font size=5>Census of ".$ro->selectNow("availableCharges","description","chargesCode",$exam)."</font>";
echo "<br>";
echo "($dateFrom - $dateTo)";
$ro->laboratoryCensus($dateFrom,$dateTo,$exam,$title);



?>
