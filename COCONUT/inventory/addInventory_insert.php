<?php
include("../../myDatabase.php");
$description = $_POST['description'];
$generic = $_POST['generic'];
$unitcost = $_POST['unitcost'];
$quantity = $_POST['quantity'];
$addedBy = $_POST['addedBy'];
$monthExpired = $_POST['monthExpired'];
$dayExpired = $_POST['dayExpired'];
$yearExpired = $_POST['yearExpired'];
$monthAdded = $_POST['monthAdded'];
$dayAdded = $_POST['dayAdded'];
$yearAdded = $_POST['yearAdded'];
$time = $_POST['serverTime'];
$inventoryLocation = $_POST['inventoryLocation'];
$inventoryType = $_POST['inventoryType'];
$branch = $_POST['branch'];
$transition = $_POST['transition'];
$remarks = $_POST['remarks'];
$preparation = $_POST['preparation'];
$phic = $_POST['phic'];
$additional = $_POST['additional'];
$pricing = $_POST['pricing'];
$criticalLevel = $_POST['criticalLevel'];
$supplier = $_POST['supplier'];
$phicPrice = $_POST['phicPrice'];
$companyPrice = $_POST['companyPrice'];
$autoDispense = $_POST['autoDispense'];
$stockCardNo = $_POST['stockCardNo'];
$status = $_POST['status'];
$classification = $_POST['classification'];
$description1 = $_POST['description1'];
$genericName1 = $_POST['genericName1'];
$ipdPrice = $_POST['ipdPrice'];
$opdPrice = $_POST['opdPrice'];
$beginningBalance = $_POST['beginningBalance'];
$unitOfMeasure = $_POST['unitOfMeasure'];
$biQTY = $_POST['biQTY'];
$biInventoryCode = $_POST['biInventoryCode'];
$invoiceNo = $_POST['invoiceNo'];
$lock = $_POST['lock'];

$ro = new database();



if( $beginningBalance != "" ) {
$begCapital = $beginningBalance;
}else {
$begCapital = ( $unitcost * $quantity );
}

$expiration = $yearExpired."-".$monthExpired."-".$dayExpired;
$dateAdded = $yearAdded."-".$monthAdded."-".$dayAdded;


if( $status == "new" ) { //new inventory w/ stock card
$ro->addInventoryStockCard($stockCardNo,$description,$generic,date("Y-m-d"),$addedBy,$inventoryType);
$incrementStockCardNo = ($ro->selectNow("trackingNo","value","name","stockCardNo") + 1);
$ro->editNow("trackingNo","name","stockCardNo","value",$incrementStockCardNo);

if( $inventoryType == "supplies" ) {
$ro->addNewMedicine($stockCardNo,$description,$generic,$pricing,$quantity,$expiration,$addedBy,$dateAdded,$ro->getSynapseTime(),$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,"",$criticalLevel,$supplier,$begCapital,$quantity,$unitcost,$autoDispense,$status,$classification,$description1,$genericName1,$ipdPrice,$opdPrice,$unitOfMeasure,$biQTY,$biInventoryCode,$quantity,$invoiceNo,$lock);
}else {
$ro->addNewMedicine($stockCardNo,$description,$generic,$unitcost,$quantity,$expiration,$addedBy,$dateAdded,$ro->getSynapseTime(),$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,$pricing."_".$additional,$criticalLevel,$supplier,$begCapital,$quantity,"",$autoDispense,$status,$classification,$description1,$genericName1,$ipdPrice,$opdPrice,$unitOfMeasure,$biQTY,$biInventoryCode,$quantity,$invoiceNo,$lock);
}

}else {

if( $inventoryType == "supplies" ) {
$ro->addNewMedicine($stockCardNo,$description,$generic,$pricing,$quantity,$expiration,$addedBy,$dateAdded,$ro->getSynapseTime(),$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,"",$criticalLevel,$supplier,$begCapital,$quantity,$unitcost,$autoDispense,$status,$classification,$description1,$genericName1,$ipdPrice,$opdPrice,$unitOfMeasure,$biQTY,$biInventoryCode,$quantity,$invoiceNo,$lock);
}else {
$ro->addNewMedicine($stockCardNo,$description,$generic,$unitcost,$quantity,$expiration,$addedBy,$dateAdded,$ro->getSynapseTime(),$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,$pricing."_".$additional,$criticalLevel,$supplier,$begCapital,$quantity,"",$autoDispense,$status,$classification,$description1,$genericName1,$ipdPrice,$opdPrice,$unitOfMeasure,$biQTY,$biInventoryCode,$quantity,$invoiceNo,$lock);
}


}





?>
