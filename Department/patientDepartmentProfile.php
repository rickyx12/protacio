<?php
include("../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$module = $_GET['module'];
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

if( $module == "PHARMACY" ) {
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'></font>&nbsp;</th>";
}else { }

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
$ro->getPatientChargesByTitle($registrationNo,$module,$month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$module,$nod);
echo "</table>";
if( $module == "LABORATORY" ) {
//echo "<br><br><a href='http://".$ro->getMyUrl()."/COCONUT/Laboratory/labRequest.php?registrationNo=$registrationNo&dateCharge=$dateCharge' target='_blank'><font color=red size=2><< Print Lab Request >></font></a>";

echo "<br><br><a href='http://".$ro->getMyUrl()."/COCONUT/Laboratory/labFormPrint.php?registrationNo=$registrationNo&dateCharge=$dateCharge' target='_blank'><font color=red size=2><< Print Lab Request >></font></a>";

}else {

}
if( $module == "PHARMACY" ) {
echo "<Br><br><br>RETURNS<br>";
$ro->showReturnz($registrationNo,$username,$module,$month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$nod);
}else {

}

echo "<br><br>";
$ro->getPatientProfile($registrationNo);

echo "<form method='post' action='/COCONUT/currentPatient/patientInterface1.php' target='_blank'><input id='namez' style='border:1px solid #000; color:red;' type='submit' value='(".$registrationNo.") ".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."'>
<input type='hidden' name='registrationNo' value='$registrationNo'><input type='hidden' name='username' value='".$username."'></form>";

?>
