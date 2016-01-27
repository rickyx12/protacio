<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$paymentFor = $_GET['paymentFor'];
$amountPaid = $_GET['amountPaid'];
$timePaid = $_GET['timePaid'];
$datePaid = $_GET['datePaid'];
$paymentNo = $_GET['paymentNo'];

$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />


<?php

echo "<form method='get' action='editPayment1.php'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='paymentNo' value='$paymentNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<br><br><br><center><div style='border:1px solid #000000; width:600px; height:170px; border-color:black black black black;'>";
echo "<Br>";
echo "<Table border=0>";
echo "<tr>";
echo "<td><font class='labelz'>Payment For&nbsp;</font></tD>";
echo "<tD>";
echo "<select name='paymentFor' class='comboBox'>";
echo "<option value='$paymentFor'>$paymentFor</option>";
echo "<option value='ADVANCE PAYMENT'>ADVANCE PAYMENT</option>";
echo "<option value='PARTIAL PAYMENT'>PARTIAL PAYMENT</option>";
echo "<option value='FULL PAYMENT'>FULL PAYMENT</option>";
echo "<option value='DISCOUNTED PAYMENT'>DISCOUNTED PAYMENT</option>";
echo "<option value='Medallion'>Medallion</option>";
echo "<option value='Medi-Serv'>Medi-Serv</option>";
echo "<option value='Meditech'>Meditech</option>";
echo "</select>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Amount</font></tD>";
echo "<td><input type=text name='amountPaid' value='$amountPaid' class='shortField'></tD>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Time</font></tD>";
echo "<td><input type=text name='timePaid' value='$timePaid' class='shortField'></tD>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Date</font></tD>";
echo "<td><input type=text name='datePaid' value='$datePaid' class='shortField'></tD>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "<input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white'>";
echo "</div>";
echo "</form>";
?>
