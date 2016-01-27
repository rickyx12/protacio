<?php
include("../../../myDatabase.php");
$paymentFor = $_GET['paymentFor'];
$amountPaid = $_GET['amountPaid'];
$registrationNo = $_GET['registrationNo'];
$paymentNo = $_GET['paymentNo'];
$username = $_GET['username'];


$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

echo "<br><br><br><Br><br>";

echo "<form method='get' action='deletePayment.php'>";
echo "<input type=hidden name='paymentNo' value='$paymentNo'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<center><div style='border:1px solid #ff0000; width:400px; height:120px;	'>";
echo "<br><font size=2 color=red>Are you sure you want to delete the Payment for<br>$paymentFor with an amount of $amountPaid  </font>";
echo "<br><Br><input type=submit value='Yes' style='border:1px solid #ff0000; background-color:transparent;'>";
echo "</div>";
echo "</form>";
?>
