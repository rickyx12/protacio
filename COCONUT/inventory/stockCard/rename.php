<?php
include("../../../myDatabase.php");
$stockCardNo = $_GET['stockCardNo'];
$startLetter = $_GET['startLetter'];
$ro = new database();
$ro->coconutDesign();

echo "Description:&nbsp;<b>".$ro->selectNow("inventoryStockCard","description","stockCardNo",$stockCardNo)."</b>";
echo "<br>";
echo "Generic:&nbsp;<b>".$ro->selectNow("inventoryStockCard","genericName","stockCardNo",$stockCardNo)."</b>";

$ro->coconutFormStart("get","rename1.php");
$ro->coconutHidden("stockCardNo",$stockCardNo);
$ro->coconutHidden("startLetter",$startLetter);
echo "<Br><br>";
echo "New Description:";
$ro->coconutTextBox("description",$ro->selectNow("inventoryStockCard","description","stockCardNo",$stockCardNo));
echo "<br><bR>";
echo "New Generic Name";
$ro->coconutTextBox("genericName",$ro->selectNow("inventoryStockCard","genericName","stockCardNo",$stockCardNo));
echo "<br><br>";
$ro->coconutButton("Rename");
$ro->coconutFormStop();


?>
