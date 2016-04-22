<?
include "../../../myDatabase.php";

$itemNo = $_POST['itemNo'];
$discTotal = 0;
$ro = new database();

for($x=0;$x<count($itemNo);$x++) {
	$discTotal += ($ro->selectNow("patientCharges","total","itemNo",$itemNo[$x]) * 0.20);
}

echo "Total Discount: ".number_format($discTotal,2);

?>