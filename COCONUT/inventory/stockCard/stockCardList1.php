<?php
include("../../../myDatabase3.php");
$stockCardNo = $_GET['stockCardNo'];
$count = count($stockCardNo);

$ro = new database3();

for($x=0;$x<$count;$x++) {
echo $stockCardNo[$x]."- ".$ro->selectNow("inventoryStockCard","description","stockCardNo",$stockCardNo[$x])."<Br>";
}

echo "<br>";
echo "<a href='stockCardList2.php?stockCardNo1=".$stockCardNo[0]."&stockCardNo2=".$stockCardNo[1]."'>Merge ".$stockCardNo[0]." to ".$stockCardNo[1]."</a>";

?>
