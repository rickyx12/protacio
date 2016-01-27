<?php
include($_SERVER['DOCUMENT_ROOT']."/coreClass/inventory/movement/inventoryMovement.php");
include("../../../myDatabase.php");

if( isset($_GET['inventoryLocation']) ) {
$inventoryLocation = $_GET['inventoryLocation'];
}else {
$inventoryLocation = "PHARMACY";
}

$type = $_GET['type'];
$im = new inventoryMovement();
$ro = new database();
$ro->coconutDesign();

echo "<form method='get' action='inventoryMovementMonthly.php'>";
$ro->coconutHidden("type",$type);
echo "Location:&nbsp;&nbsp;<select name='inventoryLocation' onchange='this.form.submit()' style='border:solid 1px #ff0000'>";
echo "<option value='$inventoryLocation'>$inventoryLocation</option>";
echo "<option value='ER'>ER</option>";
echo "<option value='OR'>OR</option>";
echo "<option value='WARD'>WARD</option>";
echo "<option value='PHARMACY'>PHARMACY</option>";
$ro->coconutComboBoxStop();
$im->showInventoryForMovement($type,$inventoryLocation);
echo "</form>";



?>
