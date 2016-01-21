<?php
include("../../../myDatabase2.php");
$menu = $_GET['menu'];
$stockCardNo = $_GET['stockCardNo'];
$movementNo = $_GET['movementNo'];
$type = $_GET['type'];
$medType = $_GET['medType'];
$control = $_GET['control'];
$username = $_GET['username'];
$year = $_GET['year'];
$ro = new database2();


if( $menu == "firstThreePurchases" ) {
$endingInventory1 = $_GET['endingInventory1'];

if( $control == "encode" ) {
$ro->inventoryMovement_insertEndingInventory($stockCardNo,"endingInventory",$endingInventory1);
}else {
$ro->doubleEditNow("inventoryMovement","movementNo",$movementNo,"stockCardNo",$stockCardNo,"endingInventory",$endingInventory1);
}

}else if( $menu == "secondThreePurchases" ) {
$endingInventory2 = $_GET['endingInventory2'];

if( $control == "encode" ) {
$ro->inventoryMovement_insertEndingInventory($stockCardNo,"endingInventory1",$endingInventory2);
}else {
$ro->doubleEditNow("inventoryMovement","movementNo",$movementNo,"stockCardNo",$stockCardNo,"endingInventory1",$endingInventory2);
}


}else if( $menu == "thirdThreePurchases" ) {
$endingInventory3 = $_GET['endingInventory3'];

if( $control == "encode" ) {
$ro->inventoryMovement_insertEndingInventory($stockCardNo,"endingInventory2",$endingInventory3);
}else {
$ro->doubleEditNow("inventoryMovement","movementNo",$movementNo,"stockCardNo",$stockCardNo,"endingInventory2",$endingInventory3);
}

}else if( $menu == "fourthThreePurchases" ) {
$endingInventory4 = $_GET['endingInventory4'];

if( $control == "encode" ) {
$ro->inventoryMovement_insertEndingInventory($stockCardNo,"endingInventory3",$endingInventory4);
}else {
$ro->doubleEditNow("inventoryMovement","movementNo",$movementNo,"stockCardNo",$stockCardNo,"endingInventory3",$endingInventory4);
}

}else if( $menu == "medicineType" ) {
$medicineType = $_GET['medicineType'];
$ro->doubleEditNow("inventoryMovement","movementNo",$movementNo,"stockCardNo",$stockCardNo,"medicineType",$medicineType);

}else { }


$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovement.php?username=$username&type=$type&medicineType=$medType&year=$year");


?>
