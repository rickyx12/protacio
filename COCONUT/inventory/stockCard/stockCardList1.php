<?php
include("../../../myDatabase3.php");
$stockCardNo = $_GET['stockCardNo'];
$startLetter = $_GET['startLetter'];
$count = count($stockCardNo);

$ro = new database3();
/*
for($x=0;$x<$count;$x++) {
echo $stockCardNo[$x]."- ".$ro->selectNow("inventoryStockCard","description","stockCardNo",$stockCardNo[$x])."<Br>";
}

echo "<br>";
echo "<a href='stockCardList2.php?stockCardNo1=".$stockCardNo[0]."&stockCardNo2=".$stockCardNo[1]."'>Merge ".$stockCardNo[0]." to ".$stockCardNo[1]."</a>";
*/

for($x=0;$x<$count;$x++) {
$ro->editNow("inventory","stockCardNo",$stockCardNo[$x],"stockCardNo",end($stockCardNo));
$ro->editNow("patientCharges","stockCardNo",$stockCardNo[$x],"stockCardNo",end($stockCardNo));
}

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/inventory/stockCard/stockCardList.php?startLetter=$startLetter");

?>
