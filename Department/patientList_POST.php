<?php
include("../myDatabase2.php");
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
$username = $_GET['username'];
$branch = $_GET['branch'];

$myDate = $year."-".$month."-".$day;
$ro = new database2();
echo "<html>";
echo "<head>";
echo "<script src='http://".$ro->getMyUrl()."/jquery.js'></script>";
echo "<script>";
?>
function playBuzzer(){
        $("body").append("<embed src='doorbell.wav' autostart='true' loop='false' width='2' height='0'></embed>");
}

     var aSound = document.createElement('audio');
     aSound.setAttribute('src', 'doorbell.wav');

<?php

if( $module == "PHARMACY" ) {
$tag = "MEDICINE";
}else if( $module == "LABORATORY" ) {
$tag = "LABORATORY";
}else {
$tag = "CSR";
}

if( $ro->selectNow("requestCount","currentTotal","department",$tag) != $ro->countDeptRequest($tag,$myDate) ) {
$ro->editNow("requestCount","department",$tag,"currentTotal",$ro->countDeptRequest($tag,$myDate));
?>
aSound.play();
<?php
}
else { }
?>

<?php
echo "</script>";
echo "</head>";
echo "<body>";
echo "<font size=1>BRANCH:</font>&nbsp;<font size=2 color=red>$branch</font> ";
echo "<br><font size=1>DATE:</font>&nbsp;<font size=1>$month $day, $year</font>";
echo "<br><font size=1>$fromTime_hour:$fromTime_minutes:$fromTime_seconds - </font><font size=1>$toTime_hour:$toTime_minutes:$toTime_seconds</font>";
if( $module != "CSR"  ) {
echo "
<table border=1 cellpadding=0 cellspacing=0 rules=all>
<tr>
<th>&nbsp;#&nbsp;</th>
<th>&nbsp;Name&nbsp;</th>
<th>&nbsp;Amount&nbsp;</th>
</tr>";

$ro->getTransactionPatient($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$module,$username,$branch);
$ro->getReturnMedicine($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$module,$username,$branch);
}
else {
$datez = $year."-".$month."-".$day;
echo "
<table border=1 cellpadding=0 cellspacing=0 rules=all>
<tr>
<th>&nbsp;Name&nbsp;</th>
</tr>";
$ro->getRequestForCSR($datez,$username);
$ro->getTransactionPatient($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$module,$username,$branch);
}

/*
if($module == "PHARMACY" || $module == "CSR") {
$ro->getReturnMedicine($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$module,$username,$branch);
}else {
echo "";
}
*/
echo "</table>";
echo "</body>";
echo "</html>";
?>
