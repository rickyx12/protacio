<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$stockCardNo = $_POST['stockCardNo'];

$ro = new database();
$ro4 = new database4();

$ro4->unitcost_list($stockCardNo);
echo "<font size=4><b>IPD Price</b></font><Br>";
echo "<Table>";
foreach( $ro4->unitcost_list_inventoryCode() as $inventoryCode ) {
	echo "<Tr>";
	echo "<td><font size=3>".number_format($ro->selectNow("inventory","ipdPrice","inventoryCode",$inventoryCode),2)."</font></td>";
	echo "<td>&nbsp;<font size=3>-</font>&nbsp;</td>";
	echo "<td><font size=3>".$ro4->formatDate($ro->selectNow("inventory","dateAdded","inventoryCode",$inventoryCode))."</font></td>";
	echo "<tr>";
}
echo "</table>";


?>
