<?php
include("../../../myDatabase2.php");
$stockCardNo = $_GET['stockCardNo'];
$description = $_GET['description'];
$movementNo = $_GET['movementNo'];

$ro = new database2();
$ro->coconutDesign();

echo "<br>";
echo "<center><b><i>".$description."</i></b></center>";
$ro->coconutBoxStart("400","400");

echo "<Br>";

echo "<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovementOption1.php?menu=beginningBalance&stockCardNo=$stockCardNo' style='text-decoration:none; color:red;'>Beginning Balance</a>";
echo "<br><Br>";

if( $movementNo != "" )  {
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovementOption1.php?menu=firstThreePurchases&stockCardNo=$stockCardNo&movementNo=$movementNo' style='text-decoration:none; color:red;'>3 months Purchases Jan/Feb/Mar</a>";
echo "<hr>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovementOption1.php?menu=secondThreePurchases&stockCardNo=$stockCardNo&movementNo=$movementNo' style='text-decoration:none; color:blue;'>3 months Purchases Apr/May/Jun</a>";
echo "<hr>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovementOption1.php?menu=thirdThreePurchases&stockCardNo=$stockCardNo&movementNo=$movementNo' style='text-decoration:none; color:red;'>3 months Purchases Jul/Aug/Sep</a>";
echo "<hr>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovementOption1.php?menu=fourthThreePurchases&stockCardNo=$stockCardNo&movementNo=$movementNo' style='text-decoration:none; color:blue;'>3 months Purchases Oct/Nov/Dec</a>";
echo "<hr>";
echo "<br><br><br>";
echo "<hr>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovementOption1.php?menu=medicineType&stockCardNo=$stockCardNo&movementNo=$movementNo' style='text-decoration:none; color:red;'>Medicine Type</a>";
echo "<hr>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/inventory/addInventory.php?username=xx&status=old&stockCardNo=$stockCardNo&description=$description&genericName=".$ro->selectNow("inventoryStockCard","genericName","stockCardNo",$stockCardNo)."' style='text-decoration:none; color:blue;'>Add New Quantity</a>";
echo "<hr>";
}else {

echo "<a href='#' style='text-decoration:none; color:gray;'>3 months Purchases Jan/Feb/Mar</a>";
echo "<hr>";
echo "<a href='#' style='text-decoration:none; color:gray;'>3 months Purchases Apr/May/Jun</a>";
echo "<hr>";
echo "<a href='#' style='text-decoration:none; color:gray;'>3 months Purchases Jul/Aug/Sep</a>";
echo "<hr>";
echo "<a href='#' style='text-decoration:none; color:gray;'>3 months Purchases Oct/Nov/Dec</a>";
echo "<hr>";
echo "<br><br><br>";
echo "<hr>";
echo "<a href='#' style='text-decoration:none; color:gray;'>Medicine Type</a>";
echo "<hr>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/inventory/addInventory.php?username=xx&status=old&stockCardNo=$stockCardNo&description=$description&genericName=".$ro->selectNow("inventoryStockCard","genericName","stockCardNo",$stockCardNo)."' style='text-decoration:none; color:blue;'>Add New Quantity</a>";
echo "<hr>";
}
$ro->coconutBoxStop();

?>
