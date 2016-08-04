<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];
$show = $_GET['show'];

$ro = new database();
$fromMonth_word = "";
$toMonth_word = "";
$oneDigit_fromDay;
$oneDigit_toDay;

if( $month == "01" ) {
$fromMonth_word = "JANUARY";
}else if ( $month == "02" ) {
$fromMonth_word = "FEBRUARY";
}else if ( $month == "03" ) {
$fromMonth_word = "MARCH";
}else if ( $month == "04" ) {
$fromMonth_word = "APRIL";
}else if ( $month == "05" ) {
$fromMonth_word = "MAY";
}else if ( $month == "06" ) {
$fromMonth_word = "JUNE";
}else if ( $month == "07" ) {
$fromMonth_word = "JULY";
}else if ( $month == "08" ) {
$fromMonth_word = "AUGUST";
}else if ( $month == "09" ) {
$fromMonth_word = "SEPTEMBER";
}else if ( $month == "10" ) {
$fromMonth_word = "OCTOBER";
}else if ( $month == "11" ) {
$fromMonth_word = "NOVEMBER";
}else if ( $month == "12" ) {
$fromMonth_word = "DECEMBER";
}else { }


if( $month1 == "01" ) {
$toMonth_word = "JANUARY";
}else if ( $month1 == "02" ) {
$toMonth_word = "FEBRUARY";
}else if ( $month1 == "03" ) {
$toMonth_word = "MARCH";
}else if ( $month1 == "04" ) {
$toMonth_word = "APRIL";
}else if ( $month1 == "05" ) {
$toMonth_word = "MAY";
}else if ( $month1 == "06" ) {
$toMonth_word = "JUNE";
}else if ( $month1 == "07" ) {
$toMonth_word = "JULY";
}else if ( $month1 == "08" ) {
$toMonth_word = "AUGUST";
}else if ( $month1 == "09" ) {
$toMonth_word = "SEPTEMBER";
}else if ( $month1 == "10" ) {
$toMonth_word = "OCTOBER";
}else if ( $month1 == "11" ) {
$toMonth_word = "NOVEMBER";
}else if ( $month1 == "12" ) {
$toMonth_word = "DECEMBER";
}else { }



if( $day == "01" ) {
$oneDigit_fromDay = 1;
}else if( $day == "02" ) {
$oneDigit_fromDay = 2;
}else if( $day == "03" ) {
$oneDigit_fromDay = 3;
}else if( $day == "04" ) {
$oneDigit_fromDay = 4;
}else if( $day == "05" ) {
$oneDigit_fromDay = 5;
}else if( $day == "06" ) {
$oneDigit_fromDay = 6;
}else if( $day == "07" ) {
$oneDigit_fromDay = 7;
}else if( $day == "08" ) {
$oneDigit_fromDay = 8;
}else if( $day == "09" ) {
$oneDigit_fromDay = 9;
}else {
$oneDigit_fromDay = $day;
}


if( $day1 == "01" ) {
$oneDigit_toDay = 1;
}else if( $day1 == "02" ) {
$oneDigit_toDay = 2;
}else if( $day1 == "03" ) {
$oneDigit_toDay = 3;
}else if( $day1 == "04" ) {
$oneDigit_toDay = 4;
}else if( $day1 == "05" ) {
$oneDigit_toDay = 5;
}else if( $day1 == "06" ) {
$oneDigit_toDay = 6;
}else if( $day1 == "07" ) {
$oneDigit_toDay = 7;
}else if( $day1 == "08" ) {
$oneDigit_toDay = 8;
}else if( $day1 == "09" ) {
$oneDigit_toDay = 9;
}else {
$oneDigit_toDay = $day1;
}

echo "<br><center><font size=3><b>MONTHLY OPD PROFESSIONAL FEE SUMMARY</b></font></center>";

if( $month == $month1 ) {
echo "<center><font size=2>$fromMonth_word $oneDigit_fromDay-$oneDigit_toDay, $year</font></center>";
}else {

}

echo "<br>";
$ro->getDoctorPFReport("OPD",$username,$month,$day,$year,$month1,$day1,$year1,$show);

?>
