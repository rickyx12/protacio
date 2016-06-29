<?
include "../../myDatabase.php";
$newQTY = $_POST['newQTY'];
$endingNo = $_POST['endingNo'];
$ro = new database();

echo "Ending#: ".$endingNo;
echo "<br>";
echo "new QTY: ".$newQTY;

$ro->editNow("endingInventory","endingNo",$endingNo,"endingQTY",$newQTY);


?>