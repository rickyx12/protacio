<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$title = $_GET['title'];
$username = $_GET['username'];
$title = $_GET['title'];
$show = $_GET['show'];
$desc = $_GET['desc'];


$ro = new database();


echo "
<style type='text/css'>
.head {
font-size:13px;
}
</style>

";

echo "<table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'></font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Description</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Price</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>QTY</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Disc</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Total</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Time</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Date</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>User</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Service</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Status</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Payment</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Balance</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Company</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>PhilHealth</font>&nbsp;</th>";
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white class='head'>Paid</font>&nbsp;</th>";
echo "</tr>";
$ro->getPatientChargesDependsOnTitle($registrationNo,$title,$username,$show,$desc);
echo "</table>";
?>
