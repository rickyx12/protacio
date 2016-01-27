<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$pf = $_GET['pf'];
$admitting = $_GET['admitting'];
$amountPaid = $_GET['amountPaid'];
$paymentNo = $_GET['paymentNo'];
$timePaid = $_GET['timePaid'];

$ro = new database2();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />


<?php

$ro->getPatientProfile($registrationNo);

echo "<form method='get' action='editPayment1.php'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='paymentNo' value='$paymentNo'>";
echo "<input type=hidden name='timePaid' value='$timePaid'>";
echo "<br>";
echo "<font color=reD>".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()." </font>";
echo "<br><br><br><center><div style='border:1px solid #000000; width:600px; height:265px; border-color:black black black black;'>";
echo "<Br>";
echo "<Table border=0>";
echo "<tr>";
echo "<td><font class='labelz'>Payment For&nbsp;</font></tD>";
echo "<tD>";
echo "<select name='paymentFor' class='comboBox'>";
echo "<option value='HOSPITAL BILL'>HOSPITAL BILL</option>";
echo "<option value='ADVANCE PAYMENT'>ADVANCE PAYMENT</option>";
echo "<option value='PARTIAL PAYMENT'>PARTIAL PAYMENT</option>";
echo "<option value='FULL PAYMENT'>FULL PAYMENT</option>";
echo "<option value='DISCOUNTED PAYMENT'>DISCOUNTED PAYMENT</option>";
echo "<option value='DEPOSIT FOR PHIC REQ'>DEPOSIT FOR PHIC REQ</option>";
echo "<option value='AR-TRADE'>AR-TRADE</option>";

//$ro->showOption("Category","Category");
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<td><font class='labelz'>Paid Via&nbsp;</font></tD>";
echo "<td><select name='paidVia' class='comboBox'>";
echo "<option value='Cash'>Cash</option>";
echo "<option value='Check'>Check</option>";
$ro->getAllCompany();
echo "</select></tD>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>OR#:</font></tD>";
echo "<td><input type=text name='orNo' class='shortField'></tD>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Hospital Bill</font></tD>";
echo "<td><input type=text name='amountPaid' value='".round($amountPaid)."' class='shortField'></tD>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>PF</font></tD>";
echo "<td><input type=text name='pf' value='".round($pf)."' class='shortField'></tD>";
echo "</tr>";


echo "<tr>";
echo "<td><font class='labelz'>Admitting</font></tD>";
echo "<td><input type=text name='admitting' value='".round($admitting)."' class='shortField'></tD>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Date</font></tD>";
echo "<td><input type=text name='datePaid' value='".date("M_d_Y")."' class='shortField'></tD>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "<input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white'>";
echo "</div>";
echo "</form>";
?>
