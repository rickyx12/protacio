<?php
include($_SERVER['DOCUMENT_ROOT']."/coreClass/inventory/movement/inventoryMovement.php");
include($_SERVER['DOCUMENT_ROOT']."/myDatabase2.php");

$stockCardNo = $_GET['stockCardNo'];
$description = $_GET['description'];
$generic = $_GET['generic'];
$unitcost = $_GET['unitcost'];
$quantity = "";
$expiration = $_GET['expiration'];
$addedBy = $_GET['addedBy'];
$inventoryLocation = "";
$inventoryType = $_GET['inventoryType'];
$branch = $_GET['branch'];
$transition = $_GET['transition'];
$remarks = $_GET['remarks'];
$preparation = $_GET['preparation'];
$phic = $_GET['phic'];
$added = $_GET['added'];
$criticalLevel = $_GET['criticalLevel'];
$supplier = $_GET['supplier'];
$begCapital = "";
$begQTY = "";
$suppliesUNITCOST = $_GET['suppliesUNITCOST'];
$autoDispense = $_GET['autoDispense'];
$status = $_GET['status'];
$classification = $_GET['classification'];
$description1 = "";
$genericName1 = "";
$ipdPrice = $_GET['ipdPrice'];
$opdPrice = $_GET['opdPrice'];
$unitOfMeasure = $_GET['unitOfMeasure'];
$biQTY = "";
$biInventoryCode = "";
$encodedQTY = "";

$inventoryCode = $_GET['inventoryCode'];

$im = new inventoryMovement();
$ro = new database2();

$ro->coconutDesign();

$ro->coconutFormStart("get","transferInventory1.php");
echo "<Br>";
$ro->coconutBoxStart("500","200");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Description</td>";
echo "<td><font color=red size=2>$description</font></td>";
echo "</tr>";
echo "<Tr>";
echo "<td>Generic</td>";
echo "<td><font color=red size=2>($generic)</font></td>";
echo "</tr>";
echo "<Tr>";
echo "<td>QTY</td>";
echo "<td>";
$ro->coconutTextBox_short("quantity","");
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Transfer To</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("inventoryLocation");
echo "<option></option>";
echo "<option value='ER'>ER</option>";
echo "<option value='OR'>OR</option>";
echo "<option value='WARD'>WARD</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutHidden("stockCardNo",$stockCardNo);
$ro->coconutHidden("description",$description);
$ro->coconutHidden("generic",$generic);
$ro->coconutHidden("unitcost",$unitcost);
$ro->coconutHidden("expiration",$expiration);
$ro->coconutHidden("addedBy",$addedBy);
$ro->coconutHidden("inventoryType",$inventoryType);
$ro->coconutHidden("branch",$branch);
$ro->coconutHidden("transition",$transition);
$ro->coconutHidden("remarks",$remarks);
$ro->coconutHidden("preparation",$preparation);
$ro->coconutHidden("phic",$phic);
$ro->coconutHidden("added",$added);
$ro->coconutHidden("criticalLevel",$criticalLevel);
$ro->coconutHidden("supplier",$supplier);
$ro->coconutHidden("suppliesUNITCOST",$suppliesUNITCOST);
$ro->coconutHidden("autoDispense",$autoDispense);
$ro->coconutHidden("status",$status);
$ro->coconutHidden("classification",$classification);
$ro->coconutHidden("ipdPrice",$ipdPrice);
$ro->coconutHidden("opdPrice",$opdPrice);
$ro->coconutHidden("unitOfMeasure",$unitOfMeasure);
$ro->coconutHidden("inventoryCode",$inventoryCode);
$ro->coconutFormStop();







?>
