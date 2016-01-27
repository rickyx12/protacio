<?php
include("../../myDatabase.php");
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


$ro = new database();

$cashUnpaid = 0;
$phic=0;
$company=0;



$dateCharge = date("Y-m-d");

if($title == "PROFESSIONAL FEE") {
$price = preg_split ("/\//", $sellingPrice ); 
$currentTotal = $quantity * $price[0];
}else {
$currentTotal = $quantity * $sellingPrice;
}

$totalDiscount = $quantity * $discount;
$grandTotal = $currentTotal - $totalDiscount;
$ro->getPatientProfile($registrationNo);
$ro->getPHIClimit_setter($ro->getRegistrationDetails_caseType());

$currentSupplies = $ro->getCurrentPHIC_check($registrationNo,"SUPPLIES") - $ro->getPHIClimit_supplies();
$currentMedicine = $ro->getCurrentPHIC_check($registrationNo,"MEDICINE") - $ro->getPHIClimit_medicine();





if( $ro->getPatientRecord_phic() == "YES" && $ro->getRegistrationDetails_company() == "" && $ro->selectNow("inventory","phic","inventoryCode",$chargesCode) == "yes"  ) { //for phic


if($title != "MEDICINE" && $currentSupplies < 0) { 
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,0,$grandTotal,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}else if( $title != "MEDICINE" && $currentSupplies >= 0 ) {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}

else if($title == "MEDICINE" && $currentMedicine < 1 && $ro->selectNow("inventory","phic","inventoryCode",$chargesCode) == "yes" ) {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,0,$grandTotal,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}else if( $title == "MEDICINE" && $currentMedicine > 0 && $ro->selectNow("inventory","phic","inventoryCode",$chargesCode) == "yes" ) {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}
else { 
echo "";
}

}








else if($ro->getRegistrationDetails_company() != "" && $ro->getPatientRecord_phic() == "NO") { //for hmo/company
$currentHMO = $ro->getRegistrationDetails_limitHMO() - $ro->getTotal("company","",$registrationNo);

//if($grandTotal > $currentHMO ) { //check kung pde icover Lhat

//$totalCover = $grandTotal - $currentHMO;

if($ro->getRegistrationDetails_company() == "MEDITECH"  ) { //HMO pero dpat nsa cashUnpaid
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}else if($ro->getRegistrationDetails_company() == "MEDALLION"  ) { //HMO pero dpat nsa cashUnpaid
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}else if($ro->getRegistrationDetails_company() == "MEDI-SERV"  ) { //HMO pero dpat nsa cashUnpaid
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}
else { //HMO n nsa hmo column
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,0,0,$grandTotal,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}



/*
}else {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,0,0,$grandTotal,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}
*/

}




else if($ro->getRegistrationDetails_company() != "" && $ro->getPatientRecord_phic() == "YES" ) {
$currentHMO = $ro->getTotal("company","",$registrationNo) - $ro->getRegistrationDetails_limitHMO();

if($title != "MEDICINE" && $currentSupplies < 0 ) { 
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,0,$grandTotal,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}

else if( $title != "MEDICINE" && $currentSupplies >= 0 ) {
if($currentHMO < $ro->getRegistrationDetails_limitHMO()) {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,0,0,$grandTotal,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}else {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}

}

else if($title == "MEDICINE" && $currentMedicine < 0 && $ro->selectNow("inventory","phic","inventoryCode",$chargesCode) == "yes" ) { 
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,0,$grandTotal,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}


else if( $title == "MEDICINE" && $currentMedicine >= 0 && $ro->selectNow("inventory","phic","inventoryCode",$chargesCode) == "yes" ) {



if( $currentHMO < $ro->getRegistrationDetails_limitHMO()   ) {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,0,0,$grandTotal,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}else {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}




}else {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}




}








else {// no phic and company

$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);


}







$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/availableMisc/showMisc.php?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo");





/*
else if($ro->getRegistrationDetails_company() != "" && $ro->getPatientRecord_phic() == "YES" && $ro->getRegistrationDetails_limitHMO() > $ro->getTotal("company","",$registrationNo)) { //for cashs


if($grandTotal > $ro->getRegistrationDetails_limitHMO()) {
$currentHMO = $ro->getRegistrationDetails_limitHMO() - $ro->getTotal("company","",$registrationNo);
$hmo = $grandTotal - $ro->getPHIClimit_supplies();
$cash = $hmo - $ro->getRegistrationDetails_limitHMO();
$phic =  $grandTotal - $hmo ;
$hmo1 = $hmo - $cash;

$hmo_med = $grandTotal - $ro->getPHIClimit_medicine();
$cash_med = $hmo_med - $ro->getRegistrationDetails_limitHMO();
$phic_med =  $grandTotal - $hmo_med ;
$hmo1_med = $hmo_med - $cash_med;
$cash1_med = $cash_med ;
}else {
$currentHMO = $ro->getRegistrationDetails_limitHMO() - $ro->getTotal("company","",$registrationNo);
$hmo = $grandTotal - $ro->getPHIClimit_supplies();
$cash =$hmo - $ro->getRegistrationDetails_limitHMO();
if($cash < 0) $cash=0;
$phic =  $grandTotal - $hmo ;
$hmo1 = $hmo;

$hmo_med = $grandTotal - $ro->getPHIClimit_medicine();
$cash_med = $hmo_med - $ro->getRegistrationDetails_limitHMO();
$phic_med =  $grandTotal - $hmo_med ;
$hmo1_med = $hmo_med ; 
$cash1_med = $cash_med ; if($cash1_med < 0) $cash1_med=0;

}



//$hmo1 = $ro->getRegistrationDetails_limitHMO() - $hmo;
//$cash = $ro->getTotal("company","",$registrationNo) - $hmo;

//$myCash = $ro->getTotal("company","",$registrationNo) - $currentSupplies;

//$cash_med = $grandTotal - $ro->getPHIClimit_medicine();
//$currentMed =  $grandTotal - $cash_med ;

/*
if($title == "SUPPLIES" && $ro->getPHIClimit_supplies() > $ro->getCurrentPHIC_check($registrationNo,"SUPPLIES")  ) {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$cash,$phic,$hmo1,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}else if($title == "MEDICINE" && $ro->getPHIClimit_medicine() > $ro->getCurrentPHIC_check($registrationNo,"MEDICINE") ) {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$cash1_med,$phic_med,$hmo1_med,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}
}

else if($ro->getPHIClimit_medicine() > $ro->getCurrentPHIC_check($registrationNo,"MEDICINE")) {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,232,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}



else if($ro->getRegistrationDetails_limitHMO() > $ro->getTotal("company","",$registrationNo) ) {

$currentHMO = $ro->getRegistrationDetails_limitHMO() - $ro->getTotal("company","",$registrationNo);
if($grandTotal > $currentHMO) {
$newCash = $ro->getTotal("company","",$registrationNo) - $currentSupplies;
$company = $grandTotal - $ro->getTotal("company","",$registrationNo);
$hmo = $ro->getRegistrationDetails_limitHMO() - $ro->getTotal("company","",$registrationNo);
$myCash = $grandTotal - $hmo;
}else {
$newCash = $ro->getTotal("company","",$registrationNo) - $currentSupplies;
$company = $grandTotal - $ro->getTotal("company","",$registrationNo);
$hmo = $ro->getRegistrationDetails_limitHMO() - $ro->getTotal("company","",$registrationNo);
$myCash = $grandTotal - $hmo;
}


$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,0,0,$grandTotal,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);


}else {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$cashUnpaid,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}






/* ORIGINAL CHARGING START HERE
if($paidVia == "Company") { //IF ($paidVia == "Company")

if($ro->getRegistrationDetails_company() != "") { //IF ($ro->getRegistrationDetails_company != "")
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,0,$phic,$grandTotal,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}//IF ($ro->getRegistrationDetails_company != "")
else {
echo "<script type='text/javascript'>";
echo "alert('".$ro->getPatientRecord_completeName()." has no Company');";
echo "history.back();";
echo "</script>";
}


}//IF ($paidVia == "Company")
else { //ELSE ($paidVia == "Cash")
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,$phic,$company,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}//ELSE ($paidVia == "Cash")

*/



?>
