<?php
include "../../myDatabase4.php";
$registrationNo = $_GET['registrationNo'];
$ro = new database4();

$ro->get_patient_charges($registrationNo);
$itemNo = $ro->get_patient_charges_itemNo();
$itemNo_count = count($itemNo);

$myData = [];


for($x=0;$x<$itemNo_count;$x++) {
array_push($myData,[

	"itemNo" => $itemNo[$x],
	"description" => $ro->get_patient_charges_description()[$x],
	"sellingPrice" => $ro->get_patient_charges_sellingPrice()[$x],
	"quantity" => $ro->get_patient_charges_qty()[$x],
	"total" => $ro->get_patient_charges_total()[$x],
	"cashUnpaid" => $ro->get_patient_charges_cashUnpaid()[$x],
	"company" => $ro->get_patient_charges_company()[$x],
	"phic" => $ro->get_patient_charges_phic()[$x],
	"chargeBy" => $ro->get_patient_charges_chargeBy()[$x],
	"dateCharge" => $ro->formatDate($ro->get_patient_charges_dateCharge()[$x]),
	"timeCharge" => $ro->get_patient_charges_timeCharge()[$x],
	"checked" => $ro->get_patient_charges_checked()[$x]

	]);
}
$myJSON = json_encode($myData);
echo $myJSON;

?>