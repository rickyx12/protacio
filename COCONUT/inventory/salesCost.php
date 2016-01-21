<?php
include("../../myDatabase3.php");
$stockCardNo = $_GET['stockCardNo'];
$ro = new database3();

//$stockCardNo = "1720";

$highestCost = $ro->salesCost("MAX",$stockCardNo);

$lowestCost = $ro->salesCost("MIN",$stockCardNo);

$average = (( $highestCost + $lowestCost ));
$average1 = ( $average / 2 );


echo $ro->selectNow("inventoryStockCard","description","stockCardNo",$stockCardNo);
echo "<br>";
echo "Highest:&nbsp;".$highestCost;
echo "<br>";
echo "Lowest:&nbsp;".$lowestCost;
echo "<br>";
echo "Average:&nbsp;".$average1;
echo "<br>";
echo "Dispense:&nbsp;".$ro->countDispense($stockCardNo);
echo "<br>";
echo "Cost of Sales&nbsp;".number_format(($ro->countDispense($stockCardNo) * $average1),2);
?>
