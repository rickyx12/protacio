<?php
include("../../../myDatabase2.php");
$type = $_GET['type'];
$medicineType = $_GET['medicineType'];
$username = $_GET['username'];
$year = $_GET['year'];

$ro = new database2();

echo "<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovement.php?type=medicine&medicineType=all&username=$username&year=$year' style='text-decoration:none; color:red;'>Medicine</a> | <a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovement.php?type=supplies&medicineType=all&username=$username&year=$year' style='text-decoration:none; color:blue;'>Supplies</a> ";

if($type == "medicine") {
echo "<br><a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovement.php?type=medicine&medicineType=all&username=$username&year=$year' style='text-decoration:none; color:red;'>ALL</a> | <a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovement.php?type=medicine&medicineType=ORAL&username=$username&year=$year' style='text-decoration:none; color:red;'>ORAL</a> | <a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovement.php?type=medicine&medicineType=AMPULE&username=$username&year=$year' style='text-decoration:none; color:red;'>AMPULE</a> | <a href='http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovement.php?type=medicine&medicineType=IV FLUID&username=$username&year=$year' style='text-decoration:none; color:red;'>IV FLUID</a>";
}else { }

$ro->inventoryMovement_list($year,$type,$medicineType,$username);


?>
