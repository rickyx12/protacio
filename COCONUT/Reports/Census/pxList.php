<?php
include("../../../myDatabase2.php");

$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$toYear = $_GET['toYear'];
$dateType = $_GET['dateType'];
$type = $_GET['type'];
$username = $_GET['username'];

$ro = new database2();

$date = $fromYear."-".$fromMonth."-".$fromDay;
$date1 = $toYear."-".$toMonth."-".$toDay;
$dateTypeWord="";

if( $dateType == "dateRegistered" ) {
$dateTypeWord = "Date Register";
}else {
$dateTypeWord = "Date Discharge";
}


echo "<b>Date</b>:&nbsp;from ".$date." to ".$date1;
echo "<br><b>Type</b>:&nbsp;".$type;
echo "<br><b>Date Type</b>:&nbsp;".$dateTypeWord;
echo "<br><b>Total Px</b>:&nbsp;".$ro->patientList_countPx($dateType,$type,$date,$date1,$username);
echo "<br>";
$ro->patientList($dateType,$type,$date,$date1,$username);


?>
