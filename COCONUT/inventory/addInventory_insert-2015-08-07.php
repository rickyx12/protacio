<?php
include("../../myDatabase.php");
$description = $_POST['description'];
$generic = $_POST['generic'];
$unitcost = $_POST['unitcost'];
$quantity = $_POST['quantity'];
$date = $_POST['date'];
$addedBy = $_POST['addedBy'];
$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];
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

$ro = new database();


$begCapital = ( $unitcost * $quantity );
$expiration = $year."-".$month."-".$day;



if( $status == "new" ) { //new inventory w/ stock card
$ro->addInventoryStockCard($stockCardNo,$description,$generic,date("Y-m-d"),$addedBy,$inventoryType);

if( $inventoryType == "supplies" ) {
$ro->addNewMedicine($stockCardNo,$description,$generic,$pricing,$quantity,$expiration,$addedBy,$date,$ro->getSynapseTime(),$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,"",$criticalLevel,$supplier,$begCapital,$quantity,$unitcost,$autoDispense,$status,$classification,$description1,$genericName1,$ipdPrice,$opdPrice);
}else {
$ro->addNewMedicine($stockCardNo,$description,$generic,$unitcost,$quantity,$expiration,$addedBy,$date,$ro->getSynapseTime(),$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,$pricing."_".$additional,$criticalLevel,$supplier,$begCapital,$quantity,"",$autoDispense,$status,$classification,$description1,$genericName1,$ipdPrice,$opdPrice);
}

}else {

if( $inventoryType == "supplies" ) {
$ro->addNewMedicine($stockCardNo,$description,$generic,$pricing,$quantity,$expiration,$addedBy,$date,$ro->getSynapseTime(),$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,"",$criticalLevel,$supplier,$begCapital,$quantity,$unitcost,$autoDispense,$status,$classification,$description1,$genericName1,$ipdPrice,$opdPrice);
}else {
$ro->addNewMedicine($stockCardNo,$description,$generic,$unitcost,$quantity,$expiration,$addedBy,$date,$ro->getSynapseTime(),$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,$pricing."_".$additional,$criticalLevel,$supplier,$begCapital,$quantity,"",$autoDispense,$status,$classification,$description1,$genericName1,$ipdPrice,$opdPrice);
}


}





?>
