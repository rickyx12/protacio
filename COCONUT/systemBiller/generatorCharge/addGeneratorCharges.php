<?php
include("../../../myDatabase2.php");
$registrationNo  = $_GET['registrationNo'];
$chargeNo = $_GET['chargeNo'];
$count = count($chargeNo);
$username = $_GET['username'];

$ro = new database2();
$ro->getPatientProfile($registrationNo);

$roomType =  $ro->selectNow("room","type","Description",$ro->getRegistrationDetails_room());
$sp = 0; //room Selling PRice

if( $roomType == "WARD" ) {
$sp = 0.16;
}else {
$sp = 0.41;
}

//public function addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room)
for( $x=0;$x<$count;$x++ ) {
$gt = round(($ro->selectNow("generatorCharge","hours","chargeNo",$chargeNo[$x]) * $sp )); //totalPrice

$ro->addCharges_cash("UNPAID",$registrationNo,"330","Generator Charge (".$ro->selectNow("generatorCharge","dateStart","chargeNo",$chargeNo[$x]).")",$sp,"0",$gt,$gt,"0","0",$ro->getSynapseTime(),date("M_d_Y"),$username,"Electricity","GENERATOR_CHARGE","Cash","0","0", $ro->selectNow("generatorCharge","hours","chargeNo",$chargeNo[$x]) ,"","Pagadian",$ro->getRegistrationDetails_room());
}

header("Location: /COCONUT/patientProfile/SOAoption/summary.php?registrationNo=$registrationNo&username=$username");


?> 
