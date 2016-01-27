<?php
include("../../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$type = $_GET['type'];
$month_discharged = $_GET['month_discharged'];
$year_discharged = $_GET['year_discharged'];

$ro = new database2();

$date = $year."-".$month."-".$day;
$discharged = $year_discharged."-".$month_discharged."%%%%%%%%%";

if( $month_discharged == "01" ) {
$monthWord = "January";
}else if( $month_discharged == "02" ) {
$monthWord = "February";
}else if( $month_discharged == "03" ) {
$monthWord = "March";
}else if( $month_discharged == "04" ) {
$monthWord = "April";
}else if( $month_discharged == "05" ) {
$monthWord = "May";
}else if( $month_discharged == "06" ) {
$monthWord = "June";
}else if( $month_discharged == "07" ) {
$monthWord = "July";
}else if( $month_discharged == "08" ) {
$monthWord = "August";
}else if( $month_discharged == "09" ) {
$monthWord = "September";
}else if( $month_discharged == "10" ) {
$monthWord = "October";
}else if( $month_discharged == "11" ) {
$monthWord = "November";
}else if( $month_discharged == "12" ) {
$monthWord = "December";
}else { }


echo "<center>Patient Discharged From $monthWord $year_discharged<br><br>";
$ro->phic_receivablesAging($discharged,$date,$type,30,60);

//echo $ro->phic_receivablesAging_links($discharged,$date,$type);

echo "<br>";
for($x=1;$x<=$ro->phic_receivablesAging_links($discharged,$date,$type);$x++) {
echo "<a href='#' style='color:black; text-decoration:none;'>".$x."</a>";
}


?>
