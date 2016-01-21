<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$fromTime_hour = $_GET['fromTime_hour'];
$fromTime_minutes = $_GET['fromTime_minutes'];
$fromTime_seconds = $_GET['fromTime_seconds'];
$toTime_hour = $_GET['toTime_hour'];
$toTime_minutes = $_GET['toTime_minutes'];
$toTime_seconds = $_GET['toTime_seconds'];
$module = $_GET['module'];
$nod = $_GET['nod'];

$ro = new database2();
$ro->coconutDesign();

$dateCharge = $year."-".$month."-".$day;
$from = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$to = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;

echo "Reg#:".$registrationNo."<br>";
echo "Patient:&nbsp;".$ro->selectNow("patientRecord","completeName","patientNo",$ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo));

$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/Department/patientDepartmentProfile.php");
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=red>NOD:</font>&nbsp;";
$ro->coconutComboBoxStart_long("nod");
echo "<option value='$nod'>$nod</option>";
$ro->selectedNOD($registrationNo,$dateCharge,$from,$to);
$ro->coconutComboBoxStop();
echo "&nbsp;&nbsp;";
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("module",$module);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("month",$month);
$ro->coconutHidden("day",$day);
$ro->coconutHidden("year",$year);
$ro->coconutHidden("fromTime_hour",$fromTime_hour);
$ro->coconutHidden("fromTime_minutes",$fromTime_minutes);
$ro->coconutHidden("fromTime_seconds",$fromTime_seconds);
$ro->coconutHidden("toTime_hour",$toTime_hour);
$ro->coconutHidden("toTime_minutes",$toTime_minutes);
$ro->coconutHidden("toTime_seconds",$toTime_seconds);
$ro->coconutButton("Proceed");
echo "<br>";
$ro->coconutFormStop();

echo "<table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'></font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'></font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'></font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'></font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Description</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Price</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>QTY</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Disc</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Total</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Time</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Date</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>User</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Status</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Payment</font>&nbsp;</th>";
echo "</tr>";

$ro->getPatientChargesByTitle($registrationNo,$module,$month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,"PHARMACY",$nod);

?>
