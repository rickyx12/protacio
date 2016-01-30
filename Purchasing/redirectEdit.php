<?php
include("../myDatabase3.php");
$inventoryCode = $_GET['inventoryCode'];
$username  = $_GET['username'];
$ro = new database3();

$stockCardNo = $ro->selectNow("inventory","stockCardNo","inventoryCode",$inventoryCode);
$description = $ro->selectNow("inventory","description","inventoryCode",$inventoryCode);
$genericName = $ro->selectNow("inventory","genericName","inventoryCode",$inventoryCode);
$unitcost = $ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode);
$quantity = $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode);
$expiration = $ro->selectNow("inventory","expiration","inventoryCode",$inventoryCode);
$addedBy = $ro->selectNow("inventory","addedBy","inventoryCode",$inventoryCode);
$dateAdded = $ro->selectNow("inventory","dateAdded","inventoryCode",$inventoryCode);
$timeAdded = $ro->selectNow("inventory","timeAdded","inventoryCode",$inventoryCode);
$inventoryLocation = $ro->selectNow("inventory","inventoryLocation","inventoryCode",$inventoryCode);

$inventoryType = $ro->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode);
$branch = $ro->selectNow("inventory","branch","inventoryCode",$inventoryCode);
$transition = $ro->selectNow("inventory","transition","inventoryCode",$inventoryCode);
$remarks = $ro->selectNow("inventory","remarks","inventoryCode",$inventoryCode);
$preparation = $ro->selectNow("inventory","preparation","inventoryCode",$inventoryCode);
$phic = $ro->selectNow("inventory","phic","inventoryCode",$inventoryCode);
$pricing = $ro->selectNow("inventory","Added","inventoryCode",$inventoryCode);
$criticalLevel = $ro->selectNow("inventory","criticalLevel","inventoryCode",$inventoryCode);
$supplier = $ro->selectNow("inventory","supplier","inventoryCode",$inventoryCode);
$phicPrice = $ro->selectNow("inventory","phicPrice","inventoryCode",$inventoryCode);
$companyPrice = $ro->selectNow("inventory","companyPrice","inventoryCode",$inventoryCode);
$autoDispense = $ro->selectNow("inventory","autoDispense","inventoryCode",$inventoryCode);
$invoiceNo = $ro->selectNow("inventory","invoiceNo","inventoryCode",$inventoryCode);


if($inventoryType == "medicine") {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/masterfile/EDIT/editInventory.php?username=$username&inventoryCode=$inventoryCode&stockCardNo=$stockCardNo&description=$description&genericName=$genericName&unitcost=$unitcost&quantity=$quantity&expiration=$expiration&addedBy=$addedBy&dateAdded=$dateAdded&timeAdded=$timeAdded&inventoryLocation=$inventoryLocation&inventoryType=$inventoryType&branch=$branch&transition=$transition&remarks=$remarks&preparation=$preparation&phic=$phic&pricing=$pricing&criticalLevel=$criticalLevel&supplier=$supplier&phicPrice=$phicPrice&companyPrice=$companyPrice&autoDispense=$autoDispense&invoiceNo=$invoiceNo");
}else {
	$suppliesUnitcost = $ro->selectNow("inventory","suppliesUNITCOST","inventoryCode",$inventoryCode);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/masterfile/EDIT/editInventory_supplies.php?username=$username&inventoryCode=$inventoryCode&stockCardNo=$stockCardNo&description=$description&sellingPrice=$unitcost&suppliesUNITCOST=$suppliesUnitcost&quantity=$quantity&dateAdded=$dateAdded&inventoryLocation=$inventoryLocation&phic=$phic&remarks=$remarks&supplier=$supplier&criticalLevel=$criticalLevel");

}

?>