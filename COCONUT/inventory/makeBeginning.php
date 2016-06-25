<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$inventoryCode = $_POST['inventoryCode'];

$ro = new database();
$ro4 = new database4();

for($x=0;$x<count($inventoryCode);$x++) {
echo $inventoryCode[$x]."<br>";

$stockCardNo = $ro->selectNow("inventory","stockCardNo","inventoryCode",$inventoryCode[$x]);
$description = $ro->selectNow("inventory","description","inventoryCode",$inventoryCode[$x]);
$genericName = $ro->selectNow("inventory","genericName","inventoryCode",$inventoryCode[$x]);
$preparation = $ro->selectNow("inventory","preparation","inventoryCode",$inventoryCode[$x]);
$unitcost 	 = $ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode[$x]);
$quantity 		 = $ro->selectNow("endingInventory","endingQTY","inventoryCode",$inventoryCode[$x]);
$expiration  = $ro->selectNow("inventory","expiration","inventoryCode",$inventoryCode[$x]);
$inventoryLocation = $ro->selectNow("inventory","inventoryLocation","inventoryCode",$inventoryCode[$x]);
$inventoryType = $ro->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode[$x]);
$criticalLevel = $ro->selectNow("inventory","criticalLevel","inventoryCode",$inventoryCode[$x]);
$supplier = $ro->selectNow("inventory","supplier","inventoryCode",$inventoryCode[$x]);
$suppliesUNITCOST = $ro->selectNow("inventory","suppliesUNITCOST","inventoryCode",$inventoryCode[$x]);
$classification = $ro->selectNow("inventory","classification","inventoryCode",$inventoryCode[$x]);
$addedBy = $ro->selectNow("inventory","addedBy","inventoryCode",$inventoryCode[$x]);
$ipdPrice = $ro->selectNow("inventory","ipdPrice","inventoryCode",$inventoryCode[$x]);
$opdPrice = $ro->selectNow("inventory","opdPrice","inventoryCode",$inventoryCode[$x]);
$invoiceNo = $ro->selectNow("inventory","InvoiceNo","inventoryCode",$inventoryCode[$x]);
$fgQuantity = $ro->selectNow("inventory","fgQuantity","inventoryCode",$inventoryCode[$x]);
$unitOfMeasure = $ro->selectNow("inventory","unitOfMeasure","inventoryCode",$inventoryCode[$x]);
$locked = $ro->selectNow("inventory","locked","inventoryCode",$inventoryCode[$x]);
$from_inventoryCode = $inventoryCode[$x];
$remarks = "Beginning Inventory from the last Ending Inventory";
$beginningQTY = $quantity;


$data = array(

	"stockCardNo" => $stockCardNo,
	"description" => $description,
	"genericName" => $genericName,
	"preparation" => $preparation,
	"unitcost" => $unitcost,
	"quantity" => $quantity,
	"expiration" => $expiration,
	"inventoryLocation" => $inventoryLocation,
	"inventoryType" => $inventoryType,
	"criticalLevel" => $criticalLevel,
	"supplier" => $supplier,
	"suppliesUNITCOST" => $suppliesUNITCOST,
	"classification" => $classification,
	"ipdPrice" => $ipdPrice,
	"opdPrice" => $opdPrice,
	"invoiceNo" => $invoiceNo,
	"fgQuantity" => $fgQuantity,
	"unitOfMeasure" => $unitOfMeasure,
	"locked" => $locked,
	"dateAdded" => date("Y-m-d"),
	"timeAdded" => date("H:i:s"),
	"addedBy" => $addedBy,
	"from_inventoryCode" => $from_inventoryCode,
	"remarks" => $remarks,
	"beginningQTY" => $beginningQTY

	);


$ro4->insertNow("inventory",$data);
$ro->editNow("inventory","inventoryCode",$inventoryCode[$x],"status","DELETED_system[for ending inventory]_".date("Y-m-d H:is"));

/*
echo "stockCardNo=".$stockCardNo."<br>";
echo "description=".$description."<br>";
echo "genericName=".$genericName."<br>";
echo "preparation=".$preparation."<br>";
echo "unitcost".$unitcost."<br>";
echo "qty=".$qty."<br>";
echo "expiration=".$expiration."<br>";
echo "inventoryLocation=".$inventoryLocation."<br>";
echo "inventoryType=".$inventoryType."<br>";
echo "Critical Level=".$criticalLevel."<br>";
echo "Supplier=".$supplier."<br>";
echo "suppliesUNITCOST=".$suppliesUNITCOST."<br>";
echo "classification=".$classification."<br>";
echo "ipdPrice=".$ipdPrice."<br>";
echo "opdPrice=".$opdPrice."<br>";
echo "invoiceNo=".$invoiceNo."<br>";
echo "fgQuantity=".$fgQuantity."<br>";
echo "unitOfMeasure".$unitOfMeasure."<br>";
echo "locked=".$locked."<br>";
echo "<Br><Br>------------------";
*/

}


?>