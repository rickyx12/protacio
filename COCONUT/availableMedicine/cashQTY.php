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

if( isset($_GET['stockCardNo']) ) {
$stockCardNo = $_GET['stockCardNo'];
}else {
$stockCardNo = "";
}

$ro = new database();
$allowableRequest = ($ro->selectNow("inventory","quantity","inventoryCode",$chargesCode) - $ro->total_request($chargesCode,$title)); 
?>

<script src="../../jquery-2.1.4.min.js"></script>
<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>

<script>
	$(document).ready(function() {
		var allowableReq1 = <? echo $allowableRequest ?>;
		
		$("#greaterZero").hide();
		$("#zero").hide();

		if( allowableReq1 < 1 ) {
			$("#proceed").hide();
			$("#zero").show();
			
		}else {
			$(document).on("keyup","#quantity",function() {
				var qty = $("#quantity").val();
				var allowableReq = <? echo $allowableRequest ?>;				
				
				if(qty > allowableReq) {
					$("#proceed").hide();
					$("#greaterZero").show();
				}else {
					$("#proceed").show();
					$("#greaterZero").hide();
				}

			});
		}

	});
</script>

<?php
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
if( $ro->total_request($chargesCode,$title) > 0 ) {
	echo "<br><Br><center>Pending Request <font color=red>(".$ro->total_request($chargesCode,$title).")</font> Pcs</center>";
}else {
	echo "<Br><br>";
}
echo "<center>Maximum Allowable Request <font color=blue>(".($ro->selectNow("inventory","quantity","inventoryCode",$chargesCode) - $ro->total_request($chargesCode,$title)).")</font> Pcs</center><br>";
?>

	<div class="container">
		<div class="col-md-3 text-center">
			
		</div>

		<div class="col-md-6 text-center">

			<div id="greaterZero" class="alert alert-info">
				Ooops! hanggang <? echo $allowableRequest ?> lang ang pwede mo ilagay sa quantity  =)
			</div>

			<div id="zero" class="alert alert-info">
				Sorry, hindi ka na pwede mag request dahil meron naka pending na request sa ibang Px
			</div>
		</div>

		<div class="col-md-3">
			
		</div>
	</div>

<?php
echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/availableMedicine/addCharges_cash.php'>";
echo "<center><div style='border:1px solid #000000; width:400px; height:100px;	'>";
echo "<br><table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font size=4>Quantity:</font></td>";
echo "<td><input type=text id='quantity' class='qty' name='quantity' value='1' autocomplete='off'></td>";
echo "</tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr>";
echo "<td><input type='button' class='button' value=' Back  '
onClick='javascript: history.go(-1)' style='border:1px solid #000000; background-color:transparent;'></td>";
echo "<td>&nbsp;&nbsp;</td>";
echo "<td><input type=submit id='proceed' value='Proceed' style='border:1px solid #000000; background-color:transparent; color:red; height:20px;'></td>";
echo "<input type=hidden name='status' value='$status'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='chargesCode' value='$chargesCode'>";
echo "<input type=hidden name='description' value='$description'>";
echo "<input type=hidden name='sellingPrice' value='$sellingPrice'>";
echo "<input type=hidden name='dateCharge' value='".date("Y-m-d")."'>";
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


?>
