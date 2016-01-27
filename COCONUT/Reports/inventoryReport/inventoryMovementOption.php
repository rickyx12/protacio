<?php
include("../../../myDatabase2.php");
$stockCardNo = $_GET['stockCardNo'];
$description = $_GET['description'];
$movementNo = $_GET['movementNo'];
$username = $_GET['username'];
$inventoryType = $_GET['inventoryType'];
$year = $_GET['year'];
$medType = $_GET['medType'];

$ro = new database2();
$ro->coconutDesign();

echo "
<script type='text/javascript'>
function goBack() {
    window.history.back()
}
</script>

";


echo "<br>";
echo "<input type='submit' onclick='goBack()' value='<< Back' style='border:1px solid #ff0000; width:10%; color:red;'>";
echo "<br>";


echo "<br>";
echo "<center><b><i>".$description."</i></b></center>";
$ro->coconutBoxStart("400","350");

echo "<Br>";


if( $movementNo != "" )  {
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovementOption1.php?menu=firstThreePurchases&stockCardNo=$stockCardNo&movementNo=$movementNo&inventoryType=$inventoryType&medType=$medType&control=edit&username=$username&year=$year' style='text-decoration:none; color:red;'>Edit Ending Inventory for Jan/Feb/Mar</a>";
echo "<hr>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovementOption1.php?menu=secondThreePurchases&stockCardNo=$stockCardNo&movementNo=$movementNo&inventoryType=$inventoryType&medType=$medType&control=edit&username=$username&year=$year' style='text-decoration:none; color:blue;'>Edit Ending Inventory for Apr/May/Jun</a>";
echo "<hr>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovementOption1.php?menu=thirdThreePurchases&stockCardNo=$stockCardNo&movementNo=$movementNo&inventoryType=$inventoryType&medType=$medType&control=edit&username=$username&year=$year' style='text-decoration:none; color:red;'>Edit Ending Inventory for Jul/Aug/Sep</a>";
echo "<hr>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovementOption1.php?menu=fourthThreePurchases&stockCardNo=$stockCardNo&movementNo=$movementNo&inventoryType=$inventoryType&medType=$medType&control=edit&username=$username&year=$year' style='text-decoration:none; color:blue;'>Edit Ending Inventory for Oct/Nov/Dec</a>";
echo "<hr>";
echo "<br><br>";
echo "<hr>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovementOption1.php?menu=medicineType&stockCardNo=$stockCardNo&movementNo=$movementNo&inventoryType=$inventoryType&medType=$medType&username=$username&control=' style='text-decoration:none; color:red;'>Medicine Type</a>";
echo "<hr>";

if( $inventoryType == "medicine" ) {
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/inventory/addInventory.php?username=$username&status=old&stockCardNo=$stockCardNo&description=$description&genericName=".$ro->selectNow("inventoryStockCard","genericName","stockCardNo",$stockCardNo)."' style='text-decoration:none; color:blue;'>Add New Quantity</a>";
}else {
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/inventory/addInventory_supplies.php?username=$username&status=old&stockCardNo=$stockCardNo&description=$description&genericName=".$ro->selectNow("inventoryStockCard","genericName","stockCardNo",$stockCardNo)."' style='text-decoration:none; color:blue;'>Add New Quantity</a>";
}

echo "<hr>";
}else {

echo "<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovementOption1.php?menu=firstThreePurchases&stockCardNo=$stockCardNo&movementNo=$movementNo&inventoryType=$inventoryType&medType=$medType&control=encode&username=$username&year=$year' style='text-decoration:none; color:red;'>Encode Ending Inventory for Jan/Feb/Mar</a>";
echo "<hr>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovementOption1.php?menu=secondThreePurchases&stockCardNo=$stockCardNo&movementNo=$movementNo&inventoryType=$inventoryType&medType=$medType&control=encode&username=$username&year=$year' style='text-decoration:none; color:red;'>Encode Ending Inventory for Apr/May/Jun</a>";
echo "<hr>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovementOption1.php?menu=thirdThreePurchases&stockCardNo=$stockCardNo&movementNo=$movementNo&inventoryType=$inventoryType&medType=$medType&control=encode&username=$username&year=$year' style='text-decoration:none; color:red;'>Encode Ending Inventory for Jul/Aug/Sep</a>";
echo "<hr>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovementOption1.php?menu=fourthThreePurchases&stockCardNo=$stockCardNo&movementNo=$movementNo&inventoryType=$inventoryType&medType=$medType&control=encode&username=$username&year=$year' style='text-decoration:none; color:red;'>Encode Ending Inventory for Oct/Nov/Dec</a>";
echo "<hr>";
echo "<br><br><br>";
echo "<hr>";
echo "<a href='#' style='text-decoration:none; color:gray;'>Medicine Type</a>";
echo "<hr>";

if( $inventoryType == "medicine" ) {
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/inventory/addInventory.php?username=$username&status=old&stockCardNo=$stockCardNo&description=$description&genericName=".$ro->selectNow("inventoryStockCard","genericName","stockCardNo",$stockCardNo)."' style='text-decoration:none; color:blue;'>Add New Quantity</a>";
}else {
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/inventory/addInventory_supplies.php?username=$username&status=old&stockCardNo=$stockCardNo&description=$description&genericName=".$ro->selectNow("inventoryStockCard","genericName","stockCardNo",$stockCardNo)."' style='text-decoration:none; color:blue;'>Add New Quantity</a>";
}


echo "<hr>";
}
$ro->coconutBoxStop();

?>
