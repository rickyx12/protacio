<?php
include("../../../myDatabase2.php");
$status = $_GET['status'];
$registrationNo = $_GET['registrationNo'];
$chargesCode = $_GET['chargesCode'];
$description = $_GET['description'];
$sellingPrice = $_GET['sellingPrice'];
$discount = $_GET['discount'];
$timeCharge = $_GET['timeCharge'];
$chargeBy = $_GET['chargeBy'];
$service = $_GET['service'];
$title = $_GET['title'];
$paidVia = $_GET['paidVia'];
$cashPaid = $_GET['cashPaid'];
$batchNo = $_GET['batchNo'];
$username = $_GET['username'];
$quantity = $_GET['quantity'];
$inventoryFrom = $_GET['inventoryFrom'];
$room = $_GET['room'];

$ro = new database2();

echo "<br><br>";
echo "<center><div style='background:#47a3da; margin:10px; height:100px; width:440px; border-radius:15px;'>";
echo "<br><br>";
echo "<font color='white' size=4><b><i>Do you want to add this charges to Hospital?</i></b></font>";
echo "</div>";

echo "<table width='50%;'>";
echo "<tr>";
echo "<th><a href='http://".$ro->getMyUrl()."/COCONUT/android/mobileECART/addCharges.php?status=$status&registrationNo=$registrationNo&chargesCode=$chargesCode&description=$description&sellingPrice=$sellingPrice&discount=$discount&timeCharge=$timeCharge&chargeBy=$chargeBy&service=$service&title=$title&paidVia=$paidVia&cashPaid=$cashPaid&batchNo=$batchNo&username=$username&quantity=$quantity&inventoryFrom=$inventoryFrom&room=$room&decision=yes' style='text-decoration:none;'><font size='5' color='#47a3da'><b><i>Yes</i></b></font></a></th>";

echo "<th><a href='http://".$ro->getMyUrl()."/COCONUT/android/mobileECART/addCharges.php?status=$status&registrationNo=$registrationNo&chargesCode=$chargesCode&description=$description&sellingPrice=$sellingPrice&discount=$discount&timeCharge=$timeCharge&chargeBy=$chargeBy&service=$service&title=$title&paidVia=$paidVia&cashPaid=$cashPaid&batchNo=$batchNo&username=$username&quantity=$quantity&inventoryFrom=$inventoryFrom&room=$room&decision=no' style='text-decoration:none;'><font size='5' color='#47a3da'><b><i>No</i></b></font></a></th>";

echo "</table>";
?>
