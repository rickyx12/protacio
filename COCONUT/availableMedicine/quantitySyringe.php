<?php
include("../../myDatabase.php");
$status = $_GET['status'];
$registrationNo = $_GET['registrationNo'];
$chargesCode = $_GET['chargesCode'];
$description = $_GET['description'];
$sellingPrice = $_GET['sellingPrice'];
$discount = $_GET['discount'];
$timeCharge = $_GET['timeCharge'];
$room = $_GET['room'];
$classification = $_GET['classification'];
$chargeBy = $_GET['chargeBy'];
$service = $_GET['service'];
$title = $_GET['title'];
$paidVia = $_GET['paidVia'];
$cashPaid = $_GET['cashPaid'];
$batchNo = $_GET['batchNo'];
$username = $_GET['username'];
$inventoryFrom = $_GET['inventoryFrom'];
$paycash = $_GET['paycash'];
$remarks = $_GET['remarks'];


$status2 = $_GET['status2'];
$qty2 = $_GET['qty2'];
$registrationNo2 = $_GET['registrationNo2'];
$chargesCode2 = $_GET['chargesCode2'];
$description2 = $_GET['description2'];
$sellingPrice2 = $_GET['sellingPrice2'];
$month2 = $_GET['month2'];
$day2 = $_GET['day2'];
$year2 = $_GET['year2'];
$timeCharge2 = $_GET['timeCharge2'];
$chargeBy2 = $_GET['chargeBy2'];
$service2 = $_GET['service2'];
$title2 = $_GET['title2'];
$paidVia2 = $_GET['paidVia2'];
$cashPaid2 = $_GET['cashPaid2'];
$batchNo2 = $_GET['batchNo2'];
$username2 = $_GET['username2'];
$discount2 = $_GET['discount2'];
$inventoryFrom2 = $_GET['inventoryFrom2'];
$room2 = $_GET['room2'];
$paycash2 = $_GET['paycash2'];
$remarks2 = $_GET['remarks2'];

$ro = new database();


if( $classification == "noInventory" ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/availableMedicine/addMe.php?status=$status&registrationNo=$registrationNo&chargesCode=$chargesCode&description=$description&sellingPrice=$sellingPrice&discount=$discount&timeCharge=$timeCharge&room=$room&chargeBy=$chargeBy&service=$service&title=$title&paidVia=$paidVia&cashPaid=$cashPaid&batchNo=$batchNo&username=$username&inventoryFrom=$inventoryFrom&paycash=$paycash&remarks=&quantity=1&month=".date("m")."&day=".date("d")."&year=".date("Y")."");
}else {

if(($chargesCode=='')&&($description=='')){
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/availableMedicine/addCharges_cash.php?status=$status2&quantity=$qty2&registrationNo=$registrationNo2&chargesCode=$chargesCode2&description=$description2&sellingPrice=$sellingPrice2&month=$month2&day=$day2&year=$year2&timeCharge=$timeCharge2&chargeBy=$chargeBy2&service=$service2&title=$title2&paidVia=$paidVia2&cashPaid=$cashPaid2&batchNo=$batchNo2&username=$username2&discount=$discount2&inventoryFrom=$inventoryFrom2&room=$room2&paycash=$paycash2&remarks=$remarks2");
}
else{

if($ro->selectNow("inventory","quantity","inventoryCode",$chargesCode) < 1 ) {
$ro->getBack("Sorry, Out of Stock");
}

echo "
<style type='text/css'>
.qty {
	border: 1px solid #000;
	color: #000;
	height:25px;
	width: 100px;
	padding:4px 4px 4px 10px;
}

</style>

";

//addCharges.php
echo "<br><Br><Br>";



$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/availableCharges/addChargesSyringe.php?quantity=1&status=$status&registrationNo=$registrationNo&chargesCode=$chargesCode&description=$description&sellingPrice=$sellingPrice&timeCharge=$timeCharge&chargeBy=$chargeBy&service=$service&title=$title&paidVia=$paidVia&cashPaid=$cashPaid&batchNo=$batchNo&username=$username&discount=$discount&inventoryFrom=$inventoryFrom&room=$room&paycash=$paycash&remarks=$remarks&status2=$status2&qty2=$qty2&registrationNo2=$registrationNo2&chargesCode2=$chargesCode2&description2=$description2&sellingPrice2=$sellingPrice2&month2=$month2&day2=$day2&year2=$year2&timeCharge2=$timeCharge2&chargeBy2=$chargeBy2&service2=$service2&title2=$title2&paidVia2=$paidVia2&cashPaid2=$cashPaid2&batchNo2=$batchNo2&username2=$username2&discount2=$discount2&inventoryFrom2=$inventoryFrom2&room2=$room2&paycash2=$paycash2&remarks2=$remarks2");


}

}

?>
