<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$ro = new database();
$ro->coconutDesign();
?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/flow/rickyCSS1.css" />

<?php

$ro->getPatientProfile($registrationNo);

echo "<br><font>Patient:</font>&nbsp;<font class='labelz'><b>".$ro->getPatientRecord_completeName()." - $registrationNo</b></font>";
echo "<br><br>";
echo "<table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white ></font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'></font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white size=2>Description</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white size=2>Price</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white size=2>QTY</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white size=2>Disc</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white size=2>Total</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white size=2>Time Bal.</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white size=2>Date Bal.</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white size=2>Paid By</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white size=2>Status</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white size=2>Payment</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white size=2>Paid</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white size=2>Balance</font>&nbsp;</th>";
echo "</tr>";
$ro->getPatientCharges_balance($registrationNo,$username);
echo "</table>";
?>
