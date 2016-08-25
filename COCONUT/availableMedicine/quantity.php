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
$stockCardNo = $_GET['stockCardNo'];
$ro = new database();

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


if( $classification == "noInventory" ) {

echo "<br><Br><Br>";
echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/availableMedicine/addMe.php'>";
echo "<center><div style='border:1px solid #000000; width:400px; height:100px;	'>";
echo "<br><table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font size=4>Quantity:</font></td>";
echo "<td><input type=text class='qty' name='quantity' autocomplete='off' value='1'></td>";
echo "</tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr>";
echo "<td><input type='button' class='button' value=' Back  '
onClick='javascript: history.go(-1)' style='border:1px solid #000000; background-color:transparent;'></td>";
echo "<td>&nbsp;&nbsp;</td>";
echo "<td><input type=submit value='Proceed' style='border:1px solid #000000; background-color:transparent; color:red; height:20px;'></td>";
echo "<input type=hidden name='status' value='$status'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='chargesCode' value='$chargesCode'>";
echo "<input type=hidden name='description' value='$description'>";
echo "<input type=hidden name='sellingPrice' value='$sellingPrice'>";
echo "<input type=hidden name='timeCharge' value='$timeCharge'>";
echo "<input type=hidden name='chargeBy' value='$chargeBy'>";
echo "<input type=hidden name='service' value='$service'>";
echo "<input type=hidden name='title' value='$title'>";
echo "<input type=hidden name='paidVia' value='$paidVia'>";
echo "<input type=hidden name='cashPaid' value='$cashPaid'>";
echo "<input type=hidden name='batchNo' value='$batchNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='discount' value='$discount'>";
echo "<input type=hidden name='inventoryFrom' value='$inventoryFrom'>";
echo "<input type=hidden name='room' value='$room'>";
echo "<input type=hidden name='paycash' value='$paycash'>";
echo "<input type=hidden name='remarks' value='$remarks'>";
echo "<input type=hidden name='stockCardNo' value='$stockCardNo'>";
echo "<input type=hidden name='dateCharge' value='".date("Y-m-d")."'>";
echo "</form>";
echo "</tr>";
echo "</table>";
echo "</div>";


//$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/availableMedicine/addMe.php?status=$status&registrationNo=$registrationNo&chargesCode=$chargesCode&description=$description&sellingPrice=$sellingPrice&discount=$discount&timeCharge=$timeCharge&room=$room&chargeBy=$chargeBy&service=$service&title=$title&paidVia=$paidVia&cashPaid=$cashPaid&batchNo=$batchNo&username=$username&inventoryFrom=$inventoryFrom&paycash=$paycash&remarks=&quantity=1&month=".date("m")."&day=".date("d")."&year=".date("Y")."");
}else {

if($ro->selectNow("inventory","quantity","inventoryCode",$chargesCode) < 1 ) {
$ro->getBack("Sorry, Out of Stock");
}


//addCharges.php
echo "<br><Br><Br>";
echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/availableCharges/addCharges.php'>";
echo "<center><div style='border:1px solid #000000; width:400px; height:100px;	'>";
echo "<br><table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font size=4>Quantity:</font></td>";
echo "<td><input type=text class='qty' name='quantity' autocomplete='off' value='1'></td>";
echo "</tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr>";
echo "<td><input type='button' class='button' value=' Back  '
onClick='javascript: history.go(-1)' style='border:1px solid #000000; background-color:transparent;'></td>";
echo "<td>&nbsp;&nbsp;</td>";
echo "<td><input type=submit value='Proceed' style='border:1px solid #000000; background-color:transparent; color:red; height:20px;'></td>";
echo "<input type=hidden name='status' value='$status'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='chargesCode' value='$chargesCode'>";
echo "<input type=hidden name='description' value='$description'>";
echo "<input type=hidden name='sellingPrice' value='$sellingPrice'>";
echo "<input type=hidden name='timeCharge' value='$timeCharge'>";
echo "<input type=hidden name='chargeBy' value='$chargeBy'>";
echo "<input type=hidden name='service' value='$service'>";
echo "<input type=hidden name='title' value='$title'>";
echo "<input type=hidden name='paidVia' value='$paidVia'>";
echo "<input type=hidden name='cashPaid' value='$cashPaid'>";
echo "<input type=hidden name='batchNo' value='$batchNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='discount' value='$discount'>";
echo "<input type=hidden name='inventoryFrom' value='$inventoryFrom'>";
echo "<input type=hidden name='room' value='$room'>";
echo "<input type=hidden name='paycash' value='$paycash'>";
echo "<input type=hidden name='remarks' value='$remarks'>";
echo "<input type=hidden name='stockCardNo' value='$stockCardNo'>";
echo "</form>";
echo "</tr>";
echo "</table>";
echo "</div>";

}

?>
