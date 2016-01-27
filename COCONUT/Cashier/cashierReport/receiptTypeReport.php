<?php
include("../../../myDatabase2.php");
$date = $_GET['date'];
$receiptType = $_GET['receiptType'];
$username = $_GET['username'];

$fromTime_hour = $_GET['fromTime_hour'];
$fromTime_minutes = $_GET['fromTime_minutes'];
$fromTime_seconds = $_GET['fromTime_seconds'];
$toTime_hour = $_GET['toTime_hour'];
$toTime_minutes = $_GET['toTime_minutes'];
$toTime_seconds = $_GET['toTime_seconds'];


$ro = new database2();

$fromTime = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTime = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;


echo "Date:&nbsp;$date<br>Type:&nbsp;$receiptType<br>Time:&nbsp;$fromTime - $toTime<br>User:&nbsp;$username<br><Br>";

$ro->receiptTypeReport($date,$receiptType,$username,$fromTime,$toTime);

echo "<br><br>";

$ro->receiptTypeReport1($date,$receiptType,$username,$fromTime,$toTime);

if( $receiptType == "medicine" ) {
echo "<Br><Br><b>Total:</b>&nbsp;".number_format($ro->receiptTypeReport_total() + $ro->receiptTypeReport1_total(),2);
}else if( $receiptType == "hospital" ) {
echo "<Br><Br><b>Total:</b>&nbsp;".number_format($ro->receiptTypeReport_total() + $ro->receiptTypeReport1_total(),2);
}else { }


?>
