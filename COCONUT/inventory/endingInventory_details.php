<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$inventoryCode = $_POST['inventoryCode'];

$ro = new database();
$ro4 = new database4();

echo "Invoice#: ".$ro->selectNow("inventory","invoiceNo","inventoryCode",$inventoryCode);
echo "<br>";
echo "Stock#: ".$ro->selectNow("inventory","stockCardNo","inventoryCode",$inventoryCode);
echo "<br>";
echo "Added: ".$ro4->formatDate($ro->selectNow("inventory","dateAdded","inventoryCode",$inventoryCode));
echo "<Br>";
echo "User: ".$ro->selectNow("inventory","addedBy","inventoryCode",$inventoryCode);

?>
