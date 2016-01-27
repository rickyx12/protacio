<?php
include("../../myDatabase3.php");

$ro = new database3();

if( isset($_GET['datez']) ) {
$datez = $_GET['datez'];
}else {
$datez = date("Y-m-d");
}

echo "<center><a href='/COCONUT/flow/opdTransaction.php?datez=$datez' style='text-decoration:none; color:black;'>Floating OPD Transaction</a>";
echo "<form method='get' action='floatingPx.php'>";
echo "<input type='text' autocomplete=off name='datez' style='border:1px solid #ff0000;' value='".$datez."'>";
echo "</form>";

$ro->opdTransaction_float($datez,"no");

?>
