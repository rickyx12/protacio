<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$inventoryCode = $_POST['inventoryCode'];

$ro = new database();
$ro4 = new database4();

echo "<b>Invoice#:</b>&nbsp;".$ro->selectNow('inventory','invoiceNo','inventoryCode',$inventoryCode);
echo "<br>";

if( $ro->selectNow('inventory','expiration','inventoryCode',$inventoryCode) != "--" ) {
	echo "<b>Expiration:</b>&nbsp;".$ro4->formatDate($ro->selectNow('inventory','expiration','inventoryCode',$inventoryCode));
}else if( $ro->selectNow('inventory','expiration','inventoryCode',$inventoryCode) == "" ) {
	echo "<b>Expiration:</b>";
}
else {
	echo "<b>Expiration:</b>";
}
echo "<br>";

echo "<b>Supplier:</b>&nbsp;".$ro->selectNow('inventory','supplier','inventoryCode',$inventoryCode);

echo "<br>";

if( $ro->selectNow('inventory','dateAdded','inventoryCode',$inventoryCode) != "" ) {
	echo "<b>Added:</b>&nbsp;".$ro4->formatDate($ro->selectNow('inventory','dateAdded','inventoryCode',$inventoryCode));
}else {
	echo "<b>Added:</b>";
}
echo "<br>";
echo "<b>User:</b>&nbsp;".$ro->selectNow('inventory','addedBy','inventoryCode',$inventoryCode);

?>