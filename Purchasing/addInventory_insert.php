<?php
include("../myDatabase.php");
$description = $_POST['description'];
$generic = $_POST['generic'];
$unitcost = $_POST['unitcost'];
$quantity = $_POST['quantity'];
$dated = $_POST['dated'];
$datem = $_POST['datem'];
$datey = $_POST['datey'];
$date=$datey."-".$datem."-".$dated;
$addedBy = $_POST['addedBy'];
$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];
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
$username = $_POST['addedBy'];
$invoiceNo=$_POST['invoiceNo'];
$sino = $_POST['sino'];
$page = $_POST['page'];
$freegoods = $_POST['fgquantity'];

$ro = new database();

$quantity1=$quantity+$freegoods;
$unitcost1=($unitcost*$quantity)/$quantity1;

$begCapital = ( $unitcost1 * $quantity1 );
$expiration = $year."-".$month."-".$day;

if( $status == "new" ) { //new inventory w/ stock card
$ro->addInventoryStockCard($stockCardNo,$description,$generic,date("Y-m-d"),$addedBy,$inventoryType);

if( $inventoryType == "supplies" ) {

if((!is_numeric($quantity))||(!is_numeric($unitcost))||(!is_numeric($pricing))||(!is_numeric($freegoods))||(!is_numeric($criticalLevel))){
echo "
<script type='text/javascript' >
  alert('Invalid number. Try again!');
  window.location='addInventory_supplies.php?username=$username&sino=$sino&page=$page&invoiceNo=$invoiceNo&status=$status&stockCardNo=$stockCardNo&description=$description';
</script>
";
}
else{
$ro->addNewMedicinepurch($stockCardNo,$description,$generic,$pricing,$quantity1,$expiration,$addedBy,$date,$ro->getSynapseTime(),$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,"",$criticalLevel,$supplier,$begCapital,$quantity1,$unitcost1,$autoDispense,$status,$classification,$description1,$genericName1,$ipdPrice,$opdPrice,$username,$sino,$page,$invoiceNo,$freegoods,$unitcost,$quantity);
}
}else {
if((!is_numeric($quantity))||(!is_numeric($unitcost))||(!is_numeric($additional))||(!is_numeric($freegoods))||(!is_numeric($criticalLevel))||(!is_numeric($opdPrice))||(!is_numeric($ipdPrice))){
echo "
<script type='text/javascript' >
  alert('Invalid number. Try again!');
  window.location='addInventory.php?username=$username&sino=$sino&page=$page&invoiceNo=$invoiceNo&status=$status&stockCardNo=$stockCardNo&description=$description&genericName=$genericName';
</script>
";
}
else{
$ro->addNewMedicinepurch($stockCardNo,$description,$generic,$unitcost1,$quantity1,$expiration,$addedBy,$date,$ro->getSynapseTime(),$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,$pricing."_".$additional,$criticalLevel,$supplier,$begCapital,$quantity1,"",$autoDispense,$status,$classification,$description1,$genericName1,$ipdPrice,$opdPrice,$username,$sino,$page,$invoiceNo,$freegoods,$unitcost,$quantity);
}
}

}else {

if( $inventoryType == "supplies" ) {
if((!is_numeric($quantity))||(!is_numeric($unitcost))||(!is_numeric($pricing))||(!is_numeric($freegoods))||(!is_numeric($criticalLevel))){
echo "
<script type='text/javascript' >
  alert('Invalid number. Try again!');
  window.location='addInventory_supplies.php?username=$username&sino=$sino&page=$page&invoiceNo=$invoiceNo&status=$status&stockCardNo=$stockCardNo&description=$description';
</script>
";
}
else{
$ro->addNewMedicinepurch($stockCardNo,$description,$generic,$pricing,$quantity1,$expiration,$addedBy,$date,$ro->getSynapseTime(),$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,"",$criticalLevel,$supplier,$begCapital,$quantity1,$unitcost1,$autoDispense,$status,$classification,$description1,$genericName1,$ipdPrice,$opdPrice,$username,$sino,$page,$invoiceNo,$freegoods,$unitcost,$quantity);
}
}else {
if((!is_numeric($quantity))||(!is_numeric($unitcost))||(!is_numeric($additional))||(!is_numeric($freegoods))||(!is_numeric($criticalLevel))||(!is_numeric($opdPrice))||(!is_numeric($ipdPrice))){
echo "
<script type='text/javascript' >
  alert('Invalid number. Try again!');
  window.location='addInventory.php?username=$username&sino=$sino&page=$page&invoiceNo=$invoiceNo&status=$status&stockCardNo=$stockCardNo&description=$description&genericName=$generic';
</script>
";
}
else{
$ro->addNewMedicinepurch($stockCardNo,$description,$generic,$unitcost1,$quantity1,$expiration,$addedBy,$date,$ro->getSynapseTime(),$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,$pricing."_".$additional,$criticalLevel,$supplier,$begCapital,$quantity1,"",$autoDispense,$status,$classification,$description1,$genericName1,$ipdPrice,$opdPrice,$username,$sino,$page,$invoiceNo,$freegoods,$unitcost,$quantity);
}
}

}

?>
