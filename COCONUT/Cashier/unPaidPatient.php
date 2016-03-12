<?php
include("../../myDatabase.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$fromTime_hour = $_GET['fromTime_hour'];
$fromTime_minutes = $_GET['fromTime_minutes'];
$fromTime_seconds = $_GET['fromTime_seconds'];
$toTime_hour = $_GET['toTime_hour'];
$toTime_minutes = $_GET['toTime_minutes'];
$toTime_seconds = $_GET['toTime_seconds'];
$username = $_GET['username'];
$branch = $_GET['branch'];
$type = $_GET['type'];
$shift = $_GET['shift'];


$ro = new database();

//
$ptime=date("YmdHis");

$s1s=date("Ymd")."083000";
$s1e=date("Ymd")."123000";

$s2s=date("Ymd")."123001";
$s2e=date("Ymd")."160000";

$s3s1s=date("Ymd")."160001";
$s3s1e=date("Ymd")."235959";
$s3s2s=date("Ymd")."000000";
$s3s2e=date("Ymd")."082959";

echo "<font size=1>BRANCH:</font> <font size=2 color=red>$branch</font>";
echo "<br><font size=1>DATE:</font> <font size=1>$year-$month-$day</font><br><font size=1>$fromTime_hour:$fromTime_minutes:$fromTime_seconds - $toTime_hour:$toTime_minutes:$toTime_seconds</font>";

/*
if((($ptime>=$s1s)&&($ptime<=$s1e))&&($shift!=1)){
echo "
<br /><br />
<font color='red'>Wrong shift!!! Change to Shift 1 Now.</font>
<br /><br />
";
}
else if((($ptime>=$s2s)&&($ptime<=$s2e))&&($shift!=2)){
echo "
<br /><br />
<font color='red'>Wrong shift!!! Change to Shift 2 Now.</font>
<br /><br />
";
}
else if(((($ptime>=$s3s1s)&&($ptime<=$s3s1e))||(($ptime>=$s3s2s)&&($ptime<=$s3s2e)))&&($shift!=3)){
echo "
<br /><br />
<font color='red'>Wrong shift!!! Change to Shift 3 Now.</font>
<br /><br />
";
}
*/

$ro->getUnpaidPatient($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$branch,$type,$shift);

$ro->getUnpaidPatient($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$branch,"walkin",$shift);

$ro->getUnpaidPatientCompany($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$branch,$type,$shift);

?>
