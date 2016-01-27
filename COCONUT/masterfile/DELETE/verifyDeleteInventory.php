<?php
include("../../../myDatabase1.php");
$description = $_GET['description'];
$inventoryCode = $_GET['inventoryCode'];
$username = $_GET['username'];

$ro = new database1();

$ro->coconutDesign();

echo "<Br><Br><Br>";

$ro->coconutFormStart("get","deleteInventory.php");
$ro->coconutHidden("inventoryCode",$inventoryCode);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("description",$description);
$ro->coconutBoxStart_red("600","85");
echo "<br>";
echo "<font color=red size=2>";
echo "Are you sure you want to delete the<br>";
echo $description." ?";
echo "</font>";
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
