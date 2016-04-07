<?php
include("../../myDatabase3.php");
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
$paycash = $_GET['paycash'];
$remarks = $_GET['remarks'];

$ro = new database3();
$ro->coconutDesign();
if( $title == "BALANCE" ) {
echo "<br><br>";
$ro->coconutFormStart("get","/COCONUT/availableCharges/addCharges.php");
$ro->coconutBoxStart("500","80");
$ro->coconutHidden("status",$status);
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("chargesCode",$chargesCode);
$ro->coconutHidden("description",$description);
$ro->coconutHidden("discount",$discount);
$ro->coconutHidden("timeCharge",$timeCharge);
$ro->coconutHidden("chargeBy",$chargeBy);
$ro->coconutHidden("service",$service);
$ro->coconutHidden("title",$title);
$ro->coconutHidden("paidVia",$paidVia);
$ro->coconutHidden("cashPaid",$cashPaid);
$ro->coconutHidden("batchNo",$batchNo);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("quantity",$quantity);
$ro->coconutHidden("inventoryFrom",$inventoryFrom);
$ro->coconutHidden("paycash",$paycash);
$ro->coconutHidden("remarks",$remarks);
echo "<Br>";
echo "<table>";
echo "<tr>";
echo "<td>Balance</td>";
echo "<td>";
$ro->coconutTextBox("sellingPrice","");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();
}else if($title == "OT") {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/therapyCharges.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$chargesCode&description=$description&sellingPrice=$sellingPrice&discount=$discount&timeCharge=$timeCharge&chargeBy=$chargeBy&service=$service&title=$title&paidVia=$paidVia&cashPaid=$cashPaid&batchNo=$batchNo&username=$username&quantity=$quantity&inventoryFrom=$inventoryFrom&paycash=$paycash&remarks=$remarks");
}
else {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/availableCharges/addCharges.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$chargesCode&description=$description&sellingPrice=$sellingPrice&discount=$discount&timeCharge=$timeCharge&chargeBy=$chargeBy&service=$service&title=$title&paidVia=$paidVia&cashPaid=$cashPaid&batchNo=$batchNo&username=$username&quantity=$quantity&inventoryFrom=$inventoryFrom&paycash=$paycash&remarks=$remarks");
}


?>
