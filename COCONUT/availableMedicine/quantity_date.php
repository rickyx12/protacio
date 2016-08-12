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


echo "<script src='../js/jquery-2.1.4.min.js'></script>";
echo "<script src='../js/jquery-ui.min.js'></script>";
echo "<link rel='stylesheet' href='../myCSS/coconutCSS.css'></link>";
echo "<link rel='stylesheet' href='../myCSS/jquery-ui.css'></link>";

echo "
<script>
	$(document).ready(function(){
		$('#dateCharge').datepicker({
			dateFormat:'yy-mm-dd'
		});
	});
</script>

";

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
echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/availableMedicine/addMe_date.php'>";
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

//$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/availableMedicine/addMe_date.php?status=$status&registrationNo=$registrationNo&chargesCode=$chargesCode&description=$description&sellingPrice=$sellingPrice&discount=$discount&timeCharge=$timeCharge&room=$room&chargeBy=$chargeBy&service=$service&title=$title&paidVia=$paidVia&cashPaid=$cashPaid&batchNo=$batchNo&username=$username&inventoryFrom=$inventoryFrom&paycash=$paycash&remarks=&quantity=1");

}else {

$ro->coconutDesign();
if($ro->selectNow("inventory","quantity","inventoryCode",$chargesCode) < 1 ) {
$ro->getBack("Sorry, Out of Stock");
}

//addCharges.php
echo "<br><Br><Br>";
echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/availableCharges/addCharges_date1.php'>";
echo "<center><font color=red>$description</font><div style='border:1px solid #000000; width:480px; height:140px;'>";
echo "<br><table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font size=4>Quantity:</font></td>";
echo "<td><input type=text class='qty' name='quantity' autocomplete='off' value='1'></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size=2>Date Charge</font>&nbsp;</td>";
echo "<td>";
/*
$ro->coconutComboBoxStart_short("month");
echo "<option value='".date("m")."'>".date("M")."</option>";
echo "<option value='01'>Jan</option>";
echo "<option value='02'>Feb</option>";
echo "<option value='03'>Mar</option>";
echo "<option value='04'>Apr</option>";
echo "<option value='05'>May</option>";
echo "<option value='06'>Jun</option>";
echo "<option value='07'>Jul</option>";
echo "<option value='08'>Aug</option>";
echo "<option value='09'>Sep</option>";
echo "<option value='10'>Oct</option>";
echo "<option value='11'>Nov</option>";
echo "<option value='12'>Dec</option>";
$ro->coconutComboBoxStop();

echo "-";

$ro->coconutComboBoxStart_short("day");
echo "<option value='".date("d")."'>".date("d")."</option>";
for( $x=1;$x<32;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}

$ro->coconutComboBoxStop();

echo "-";

$ro->coconutTextBox_short("year",date("Y"));
*/
echo "<input type='text' id='dateCharge' name='dateCharge' class='shortField' value='".date("Y-m-d")."' readonly>";
echo "</td>";
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
