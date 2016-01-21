<?php
include("../storedProcedure.php");
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


$ro = new storedProcedure();


echo "<font size=1>BRANCH:</font>&nbsp;<font size=2 color=red>$branch</font> ";
echo "<br><font size=1>DATE:</font>&nbsp;<font size=1>$month $day, $year</font>";
echo "<br><font size=1>$fromTime_hour:$fromTime_minutes:$fromTime_seconds - </font><font size=1>$toTime_hour:$toTime_minutes:$toTime_seconds</font>";
echo "
<table border=1 cellpadding=0 cellspacing=0 rules=all>
<tr>
<th>&nbsp;Name&nbsp;</th>
<th>&nbsp;Amount&nbsp;</th>
</tr>";
$ro->getTransactionPatient($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$module,$branch,$username);
echo "</table>";

?>
