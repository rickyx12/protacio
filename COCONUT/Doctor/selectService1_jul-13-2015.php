<?php
include("../../myDatabase.php");
$status = $_GET['status'];
$registrationNo = $_GET['registrationNo'];
$chargesCode = $_GET['chargesCode'];
$description = $_GET['description'];
$sellingPrice = $_GET['sellingPrice'];
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
$discount = $_GET['discount'];
$specialization = $_GET['specialization'];
$room = $_GET['room'];
$remarks = $_GET['remarks'];
$paycash = $_GET['paycash'];

echo "
<style type='text/css'>

.txtBox {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 320px;
	padding:4px 4px 4px 5px;
}


</style>

";


$ro = new database();
$ro->getDoctorSpecialization($description);
$ro->doctorServiceRate($specialization,$service);
$ro->getPatientProfile($registrationNo);

/*
if($discount=="Senior") {
$docShare = (($ro->cashAmount() * $ro->doctorShare()) - $ro->serviceDiscount() ); //PRA SA SENIOR
}else {
$docShare = ($ro->cashAmount() * $ro->doctorShare()); //PRA SA CASH
}
$companyDocShare = ($ro->getCompanyRate($ro->getRegistrationDetails_company(),$ro->companyRate()) * $ro->doctorShare); // PRA SA COMPANY
*/

if($paidVia == "Cash") { // (paidVia == CASH)

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/availableCharges/addCharges.php'>";
echo "<input type=hidden name='status' value='$status'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='chargesCode' value='$chargesCode'>";
echo "<input type=hidden name='description' value='$description'>";
echo "<input type=hidden name='room' value='$room'>";
echo "<input type=hidden name='sellingPrice' value='0/0'>";
echo "<input type=hidden name='discount' value='$discount'>'";
echo "<input type=hidden name='timeCharge' value='$timeCharge'>";
echo "<input type=hidden name='chargeBy' value='$chargeBy'>";
echo "<input type=hidden name='chargesCode' value='$chargesCode'>";
echo "<input type=hidden name='service' value='$service'>";
echo "<input type=hidden name='title' value='$title'>";
echo "<input type=hidden name='paidVia' value='$paidVia'>";
echo "<input type=hidden name='cashPaid' value='$cashPaid'>";
echo "<input type=hidden name='batchNo' value='$batchNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='quantity' value='$quantity'>";
echo "<input type=hidden name='inventoryFrom' value='$inventoryFrom'>";
echo "<input type=hidden name='remarks' value='$remarks'>";
echo "<input type=hidden name='paycash' value='$paycash'>";
/*
if($discount == 'Senior') {
echo "<input type=hidden name='discount' value='".$ro->cashAmount() * $ro->percentage("senior")."'>";
}else {
echo "<input type=hidden name='discount' value='$discount'>";
}
*/
echo "<table border=0>";
echo "<tr>";
echo "<td>&nbsp;</td><td><font class='labelz' color=black><b>$description</b></font></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Service</font></td><td><input type=text class='txtBox' name='service' value='$service'></td>";
echo "</tr>";
echo "<tr>";
//echo "<td><font class='labelz'>Rate / PF Share</font></td><td><input type=text name='sellingPrice' class='txtBox' value=".$ro->cashAmount()."/".$docShare."></td>";


if( $service == "Consultation" ) {
echo "<td><font class='labelz'>Rate / PF Share</font></td><td><input type=text name='sellingPrice' class='txtBox' value='1/1'></td>";
}else {
echo "<td><font class='labelz'>Rate / PF Share</font></td><td><input type=text name='sellingPrice' class='txtBox' value='1/1'></td>";
}


echo "</tr>";
if($discount == "Senior") {
echo "<tr>";
echo "<td><font class='labelz'>Discount</td><td><input type=text name='discount' class='txtBox' value='".$ro->cashAmount() * $ro->percentage("senior")."'></td>";
echo "</tr>";
}else {
echo "";
}
//echo "<br>&nbsp;<font class='labelz'>PF Share</font>&nbsp;<font class='labelz' color=red>".$docShare."</font>";
echo "<tr>";
echo "<Td>&nbsp;</td><td><input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white'></td>";
echo "</tr>";
echo "</form>";

} // (paidVia == CASH)


else { // (paidVia == COMPANY)

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/availableCharges/addCharges.php'>";
echo "<input type=hidden name='status' value='$status'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='chargesCode' value='$chargesCode'>";
echo "<input type=hidden name='description' value='$description'>";
//echo "<input type=hidden name='sellingPrice' value='".$ro->getCompanyRate($ro->getRegistrationDetails_company(),$ro->companyRate())."/".$companyDocShare."'>";
echo "<input type=hidden name='timeCharge' value='$timeCharge'>";
echo "<input type=hidden name='chargeBy' value='$chargeBy'>";
echo "<input type=hidden name='chargesCode' value='$chargesCode'>";
//echo "<input type=hidden name='service' value='$service'>";
echo "<input type=hidden name='title' value='$title'>";
echo "<input type=hidden name='paidVia' value='$paidVia'>";
echo "<input type=hidden name='cashPaid' value='$cashPaid'>";
echo "<input type=hidden name='batchNo' value='$batchNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='quantity' value='$quantity'>";
echo "<input type=hidden name='discount' value='$discount'>";
echo "<input type=hidden name='room' value='$room'>";
echo "<input type=hidden name='inventoryFrom' value='$inventoryFrom'>";


echo "<table border=0>";
echo "<tr>";
echo "<td>&nbsp;</td><td><font class='labelz' color=black><b>$description</b></font></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Service</font></td><td><input type=text class='txtBox' name='service' value='$service'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Rate / PF Share</font></td><td><input type=text class='txtBox' name='sellingPrice' value='500/500".$companyDocShare."'></td>";
echo "</tr>";
//echo "<br>&nbsp;<font class='labelz'>PF Share</font>&nbsp;<font class='labelz' color=red>".$companyDocShare."</font>";
echo "<tr>";
echo "<td>&nbsp;</td><td><input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white'></td>";
echo "</tr>";
echo "</table>";
echo "</form>";


} // (paidVia == COMPANY)

?>

