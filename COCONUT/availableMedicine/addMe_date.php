<?php
include("../../storedProcedure.php");
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
$room = "";
$paycash = $_GET['paycash'];
$remarks = $_GET['remarks'];

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


$ro = new storedProcedure();
$ro->coconutDesign();

$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/availableMedicine/addMe.php");
echo "<br><br>";
$ro->coconutBoxStart("500","100");
echo "<Br>";
echo "<font color=red>$description</font>";
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<Td>Date Charge&nbsp;</td>";
echo "<Td>";
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

echo "</table>";
echo "<br>";
$ro->coconutHidden("status",$status);
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("chargesCode",$chargesCode);
$ro->coconutHidden("description",$description);
$ro->coconutHidden("sellingPrice",$sellingPrice);
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
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
